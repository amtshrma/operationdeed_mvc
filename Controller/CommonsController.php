<?php
/*
* Commons Controller class
* Functionality -  Manage the data
* Created date - 8-Jul-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility');

class CommonsController extends AppController {
	var $name = 'Commons';
	var $uses = array('User', 'short_applications', 'LoanLog', 'Notification');
	var $components = array('Email','Cookie','Common','Paginator', 'CustomEmail', 'RequestHandler', 'Session');
	var $helpers = array('Common');
	
	public $paginate = array(
						'limit' => PAGINATION_LIMIT,
						'order' => array(
							'short_applications.id' => 'DESC'
						)
	);
	
	/**
	 * Summary :- beforeFilter
	 * @return	NULL
	 * Description :- beforeFilter
	*/
	
	function beforeFilter(){
		$this->layout = 'dashboard_common';
		$allow = array();
		parent::beforeFilter();
		$this->checkUserSession($allow);
	}
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function short_app() {
        $this->loadAllModel(array('ShortApplication','State'));
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$this->set('states',$states);
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		$this->paginate['order'] = 'ShortApplication.id DESC';
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('ShortApplication');
		$this->set('allApplications', $getData);
	}
	
	/**
	 * Summary :- save_remarks
	 * @return	object :- NULL
	 * Description :- save_remarks
	*/
	
	public function save_remarks(){ 
		$this->loadAllModel(array('LoanLog','Notification','ShortApplication','AskDocument'));
		if($this->request->data){
			$shortAppDetail = $this->ShortApplication->findById($this->request->data['Enquiry']['short_app']);
			$userData  = $this->Session->read('userInfo');
			$this->loadModel('Enquiry');
			$id=$userData['id'];
			$this->request->data['AskDocument']['id'] =  $this->request->data['Enquiry']['document'];
			$this->request->data['AskDocument']['enquiry'] =  $this->request->data['Enquiry']['description'];
			$this->request->data['AskDocument']['status'] =  '3';
			if($this->AskDocument->save($this->request->data['AskDocument'])){
				// save notification
				$notificationData['Notification']['receiver_id'] = $shortAppDetail['ShortApplication']['borrower_ID'];
				$notificationData['Notification']['sender_id'] = $id;
				$notificationData['Notification']['action'] = 'Document Denied';
				$notificationData['Notification']['action_id'] = $this->request->data['Enquiry']['document'];
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
				//Loan Logs
				$logData['LoanLog']['user_id'] = $id;
				$logData['LoanLog']['short_application_ID'] = $this->request->data['Enquiry']['short_app'];
				$logData['LoanLog']['action'] = 'Document Denied';
				$logData['LoanLog']['description'] = $this->request->data['Enquiry']['description'];
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->save($logData);
			}
		}
		$this->redirect($this->referer());		
	}
	
	/*
	* soft_quote function
	* Functionality -  save soft_quote functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function soft_quote($shortAppId = null,$gfeRedirect = null) {
        $this->loadAllModel(array('SoftQuote','State','LoanLog','ShortApplication'));
		$gfeRedirect = base64_decode($gfeRedirect);
		if(isset($gfeRedirect) && is_numeric($gfeRedirect)){
			$this->Session->write('GFERedirect_loanID',$gfeRedirect);
		}
		$userData  = $this->Session->read('userInfo');
		if(isset($this->request->data) && (!empty($this->request->data))){ 
			$this->SoftQuote->set($this->request->data);
			if($this->SoftQuote->validates()) {
				$this->request->data['SoftQuote']['short_application_Id'] = base64_decode($this->request->data['SoftQuote']['short_application_Id']);
				$this->request->data['SoftQuote']['user_Id'] = $userData['id'];
				if($this->SoftQuote->save($this->request->data['SoftQuote'])){
					$softQuoteID = $this->SoftQuote->id;			
					$this->redirect(array('controller'=>'commons','action' => 'view_soft_quote',base64_encode($softQuoteID)));
				}
			}   
		}
		$propertyDetail = $this->ShortApplication->find('first',array('conditions'=>array('PropertyDetail.short_application_id'=>base64_decode($shortAppId)),'fields'=>array('PropertyDetail.Baths','ShortApplication.loan_amount', 'PropertyDetail.Rooms','PropertyDetail.Beds','PropertyDetail.Baths','PropertyDetail.Units','PropertyDetail.YearBuilt','PropertyDetail.SqFtLot', 'PropertyDetail.SqFtStruc', 'ShortApplication.*')));
		$this->set('propertyDetail',$propertyDetail);
		$this->set('shortAppId',$shortAppId);
	}
	
	/*
	* ask_document function
	* Functionality -  save ask_document functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function ask_document($shortAppId = null, $loanID = null) {
		$this->loadAllModel(array('AskDocument','LoanLog','ShortApplication','Notification','LoanDocument','Checklist','LoanDocument','EmailTemplate','Loan','UserLog'));
		$shortAppIdd = $shortAppId; $loanIDD = $loanID;
		$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => base64_decode($shortAppId))));
		
		$loanDetail = $this->Loan->find('first',array('conditions'=>array('Loan.id' => base64_decode($loanID))));
		if(isset($this->request->data) && !empty($this->request->data)){
			$userData  = $this->Session->read('userInfo');
			//if loan is not assigned to team, loan officer team will be assigned to loan
			$loanTeam = $loanDetail['Loan']['team_id'];
			if(empty($loanTeam)){
				$teamID = $this->getUserTeam($userData['id']);
				$this->Loan->id = base64_decode($loanID);
				$this->Loan->saveField('team_id', $teamID); 
			}
			$check_doc = array();
			$shortappId = base64_decode($this->request->data['shortappId']);
			$loanID = base64_decode($this->request->data['loanID']);
			$this->request->data['AskDocument']['short_app_id'] = $shortappId;
			$this->request->data['AskDocument']['loan_id'] = $loanID;
			$this->request->data['AskDocument']['loan_officer_id'] = $userData['id'];
			if(!empty($this->request->data['document'])) {
				$document = $this->request->data['document'];
				foreach($document as $doc) {
					if($doc != '0'){  
						$this->request->data['AskDocument']['document_id'] = $doc;
						$this->request->data['AskDocument']['document_type'] = 'property';
						$this->request->data['AskDocument']['status'] = '2';
						$this->AskDocument->create();
						$this->AskDocument->save($this->request->data['AskDocument']);
						$check_doc[] = $doc;
					}
				}
				$document_check = implode(',',$check_doc);
				$this->saveLogDescription($loanID, $document_check, 'property');
			}
			if(!empty($this->request->data['loan_document'])) {
				$loanDocument = $this->request->data['loan_document'];
				foreach($loanDocument as $loanDoc){
					if($loanDoc != '0'){
						$this->request->data['AskDocument']['document_id'] = $loanDoc;
						$this->request->data['AskDocument']['document_type'] = 'loan';
						$this->request->data['AskDocument']['status'] = '2';
						$this->AskDocument->create();
						$this->AskDocument->save($this->request->data['AskDocument']);
						$loan_doc[] = $loanDoc;
					}
				}
				$loan_check = implode(',',$loan_doc);
				$this->saveLogDescription($loanID, $loan_check, 'loan');
			}
			//update loan_life_cycle_phase in loan table
			$newLoans = $this->getLoanLifeCyclePhase();
			$loanCyclephase = 5;
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			//Save notification for Processor Check-List Documents Requested to Sales Manager, Sales Director, Loan Officer
			$propertyDocuments = '';
			if(count($check_doc)){
				foreach($check_doc as $checklistID) {
					$documentData = $this->Checklist->find('first', array('conditions'=>array('Checklist.id'=>$checklistID),'fields'=>array('Checklist.checklistname')));
					$documentName = $documentData['Checklist']['checklistname']; 
					$propertyDocuments .= '<p>'.$documentName.'</p>';
				}
			}
			if(count($loan_doc)){	
				foreach($loan_doc as $documentID) {
					$loanDocumentData = $this->LoanDocument->find('first', array('conditions'=>array('LoanDocument.id'=>$documentID),'fields'=>array('LoanDocument.checklistname')));
					$documentName = $loanDocumentData['LoanDocument']['checklistname']; 
					$propertyDocuments .= '<p>'.$documentName.'</p>';
				}
			}
			$action = $newLoans['5'];
			$senderID = $userData['id'];
			$actionID = $shortappId;
			$this->Common->updateLoanUser($loanID, 2, $this->Session->read('userInfo.id'));
			$this->Common->saveNotifications($action, $senderID, $actionID);
			$loanNumber = $this->Common->getLoanNumber($loanID);
			$toDo  = $loanNumber. ' - ' .$action. '. Click to <a href="'.BASE_URL.'borrowers/ask_document/'.base64_encode($loanID).'">upload</a>.';
			//Save notification for Processor Check-List Documents Requested to borrower
			$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
			$notificationData['Notification']['sender_id'] = $userData['id'];
			$notificationData['Notification']['action'] = $toDo;
			$notificationData['Notification']['action_id'] = $loanID;
			$notificationData['Notification']['type'] = 2;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			
			$this->Notification->create();
			$this->Notification->save($notificationData);	
		  //email notification to borrower regarding processor checklist
			$site_URL = Configure::read('BASE_URL');
			$logo = '<img src="'.$site_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
			$apply = '<a href="'.$site_URL.'homes/borrowerLogin/">Please login to see checklist </a>';
			$template = $this->EmailTemplate->getEmailTemplate('processor_checklist_request');
			$to = $data['ShortApplication']['applicant_email_ID'];
			$emailData = $template['EmailTemplate']['template'];
			$emailData = str_replace('{FirstName}',ucfirst($data['ShortApplication']['applicant_first_name']),$emailData);
			$emailData = str_replace('{Documents}',$propertyDocuments,$emailData);
			$emailData = str_replace('{Link}',$apply,$emailData);
			$emailData = str_replace('{Logo}',$logo,$emailData);
			$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
			$this->sendEmail($to,$subject,$emailData);
			$this->Session->setFlash('Check-list requests sent to borrower.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons','action' => 'ask_document/'.$shortAppIdd.'/'.$loanIDD));
		}
		$propertyType = array('all');
		if($data){
			$propertyType[]  = $data['ShortApplication']['property_type'];
			$loanType[]  = $data['ShortApplication']['loan_type'];
		}
		$loanType = array('0');
		$propertyDocument = $this->Checklist->find('all',array('conditions'=>array('OR' =>array('type'=>$propertyType,'loan_id'=> base64_decode($loanID)))));
		$loanDocuments = $this->LoanDocument->find('all',array('conditions'=>array('OR'=>array('loan_type'=>$loanType,'loan_id'=> base64_decode($loanID)))));
		$this->set(compact(array('shortAppId','propertyDocument','loanDocuments','loanID', 'loanDetail')));
	}
	
	/*
	 *
	* view soft_quote function
	* Functionality -  save soft_quote functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function view_soft_quote($softQuoteId = null) {
		if($softQuoteId != '') {
			$quoteID = base64_decode($softQuoteId);
			$this->loadAllModel(array('SoftQuote','LoanLog','EmailTemplate','Notification'));
			$userData  = $this->Session->read('userInfo'); 
			$name = $userData['first_name']. ' '. $userData['last_name'];
			$data = $this->SoftQuote->find('first',array('conditions'=>array('SoftQuote.id'=>$quoteID)));
			if(isset($this->request->data) && (!empty($this->request->data))){ 
				$date = date("jS F, Y", strtotime($data['SoftQuote']['created']));
			    $lienPosition = $this->request->data['SoftQuote']['lienPositions'];
				$prePayments = $this->request->data['SoftQuote']['prePayments'];
				$interestRate = $data['SoftQuote']['interest_rate'];
				$loanTerm = $this->request->data['SoftQuote']['loanTerm'];
				$businessDays = $data['SoftQuote']['business_days'];
				$borrowerName = $data['ShortApplication']['applicant_first_name'] . ' '. $data['ShortApplication']['applicant_last_name'];
				$propertyAdress = $data['ShortApplication']['property_city'];
				$objective = $data['ShortApplication']['loan_objective'];
				$softQuoteID = base64_encode($data['SoftQuote']['id']);
				$shortAppID =  base64_encode($data['SoftQuote']['short_application_Id']);
				$apply = '<a href="'.BASE_URL.'homes/register/'.base64_encode('1').'/'.base64_encode('0').'/'.base64_encode($data['SoftQuote']['short_application_Id']).'">Register</a>';
				$logo = '<img src="'.BASE_URL.'img/logo.png" style="height:100px;padding-bottom: 12px;" />';
				$template = $this->EmailTemplate->getEmailTemplate('soft_quote_borrower_notification');
				$to = $data['ShortApplication']['applicant_email_ID'];
				$emailData = $template['EmailTemplate']['template'];
				$emailData = str_replace('{FirstName}',ucfirst($data['ShortApplication']['applicant_first_name']),$emailData);
				$emailData = str_replace('{Date}',$date,$emailData);
				$emailData = str_replace('{Lien Position}',$lienPosition,$emailData);
				$emailData = str_replace('{Interest Rate}',$interestRate,$emailData);
				$emailData = str_replace('{Per Payment Interest}',$prePayments,$emailData);
				$emailData = str_replace('{Loan Term}',$loanTerm,$emailData);
				$emailData = str_replace('{Business Days}',$businessDays,$emailData);
				$emailData = str_replace('{Borrower Name}',$borrowerName,$emailData);
				$emailData = str_replace('{Property Address}',$propertyAdress,$emailData);
				$emailData = str_replace('{Origination Fee}',$data['SoftQuote']['origination_fee'],$emailData);
				$emailData = str_replace('{Processing Fee}',$data['SoftQuote']['processing_fee'],$emailData);
				$emailData = str_replace('{Objective}',$objective,$emailData);
				$emailData = str_replace('{Link}',$apply,$emailData);
				$emailData = str_replace('{Logo}',$logo,$emailData);
				$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
				//Loan Logs
				$newLoans = $this->getLoanLifeCyclePhase();
				$action = $newLoans['3'];
				
				$logData['LoanLog']['user_id'] = $userData['id'];
				$logData['LoanLog']['short_application_ID'] = $data['SoftQuote']['short_application_Id'];
				$logData['LoanLog']['action'] = $action;
				$logData['LoanLog']['description'] = $action .' generated by '. $name;
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->save($logData);
				//save notification for borrower
				
				$senderID =  $userData['id'];
				$actionID = $data['SoftQuote']['id'];
				$this->Common->saveNotifications($action, $senderID, $actionID);
				
				$this->sendEmail($to,$subject,$emailData);
				// per - request email
				if($data['ShortApplication']['loan_type'] == '2'){
					$template = $this->EmailTemplate->getEmailTemplate('rehab_pre_requesting_loan');
					$to = $data['ShortApplication']['applicant_email_ID'];
					$emailData = $template['EmailTemplate']['template'];
					$emailData = str_replace('{{ADDRESS_LINE}}',ucfirst($data['ShortApplication']['property_address']),$emailData);
					$emailData = str_replace('{{CITY_STATE}}',$this->getCityName($data['ShortApplication']['property_city']).', '.$this->getStateName($data['ShortApplication']['property_state']).', '.$this->getCityName($data['ShortApplication']['property_zipcode']),$emailData);
					$emailData = str_replace('{{DATE}}',date('M d Y'),$emailData);
					$emailData = str_replace('{{BORROWER_NAME}}',ucfirst($data['ShortApplication']['applicant_first_name']).' '.ucfirst($data['ShortApplication']['applicant_last_name']),$emailData);
					$emailData = str_replace('{{LOAN_AMOUNT}}',$data['ShortApplication']['loan_amount'],$emailData);
					$emailData = str_replace('{{LOAN_PERCENTAGE}}',$data['ShortApplication']['loan_to_value'],$emailData);
					$emailData = str_replace('{{HOME_PRICE}}',$data['ShortApplication']['loan_amount'],$emailData);
					$emailData = str_replace('{{MONTHLY_PAYMENT}}',$data['SoftQuote']['monthly_payment'],$emailData);
					$emailData = str_replace('{{CLOSING_COST}}',$data['SoftQuote']['rehab_closing_cost'],$emailData);
					$emailData = str_replace('{{BROKER_NAME}}',$this->Session->read('userInfo.first_name').' '.$this->Session->read('userInfo.last_name'),$emailData);
					$emailData = str_replace('{{BROKER_PHONE}}',$this->Session->read('userDetail.mobile_phone'),$emailData);
					$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
					$this->sendEmail($to,$subject,$emailData);
				}
				$this->Session->setFlash('Email notification with Soft Quote sent to Borrower successfully.', 'default', array('class'=>'alert alert-success'));
				if($this->Session->check('GFERedirect_loanID')){
					$loanId = $this->Session->read('GFERedirect_loanID');
					$this->loadModel('Loan');
					$loanUpdateSoftQuate['id'] = $loanId;
					$loanUpdateSoftQuate['soft_quate_id'] = $quoteID;
					$this->Loan->save($loanUpdateSoftQuate);
					$this->Session->delete('GFERedirect_loanID');
					$this->redirect(array('controller'=>'processors','action' => 'disclosure_statement/'.base64_encode($loanId)));
				}else{
					$this->redirect(array('controller'=>'commons','action' => 'short_app'));
				}
			}
			$this->set('data',$data);
		}else{
			$this->redirect(array('controller'=>'commons','action' => 'short_app'));
		}
	}
	
	public function accept_document($documentID){
		$this->loadModel('AskDocument');
		$this->loadModel('LoanLog');
		$this->AskDocument->updateAll(array('status' =>'1'), array('id' => $documentID));
		$documentDetail = $this->AskDocument->find('first',array('conditions'=>array('AskDocument.id'=>$documentID),'fields' => array('id','short_app_id','loan_id'),'order'=>'id ASC'));
		$this->Session->setFlash('Document accepted.', 'default', array('class'=>'alert alert-success'));
		$this->redirect(array('controller'=>'commons','action' => 'ask_document',base64_encode($documentDetail['AskDocument']['short_app_id']),base64_encode($documentDetail['AskDocument']['loan_id'])));
	}	
	
	/*
	* loan function
	* Functionality -  list all loan, for which loan application form is filled
	* Created date - 12-Aug-2015
	* Modified date - 
	*/
	
	public function loan() {
		$this->loadAllModel(array('Loan','State', 'Team', 'TeamAssignment','LoanUser'));
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$this->set('states',$states);
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		$this->getLoanPhases();
		$loanIds = $InLoanIds = $notInLoanIds = array();
		if($this->Session->read('userInfo.user_type') == '2'){
			$loanIds = $this->LoanUser->find('all');
			if($loanIds){
				foreach($loanIds as $val){
					if(!in_array($val['LoanUser']['loan_id'],$notInLoanIds)){
						$notInLoanIds[] = $val['LoanUser']['loan_id']; 
					}
					if($val['LoanUser']['user_type'] == $this->Session->read('userInfo.user_type') && $val['LoanUser']['user_id'] == $this->Session->read('userInfo.id')){
						if(!in_array($val['LoanUser']['loan_id'],$InLoanIds)){
							$InLoanIds[] = $val['LoanUser']['loan_id']; 
						}
					}
				}
			}
			$notCheckLoanIDs = $this->Loan->find('list',array('conditions'=>array('Loan.id !='=>$notInLoanIds)));
			$InLoanIds = array_merge($notCheckLoanIDs,$InLoanIds);
		}
		$this->paginate['order'] = 'Loan.id DESC';
		$this->paginate['recursive'] = 1;
		$this->paginate['fields'] = 'Loan.id,Loan.short_app_id,Loan.soft_quate_id,Loan.borrower_id,Loan.team_id,Loan.created,Loan.loan_life_cycle_phase,ShortApplication.*';
		if($this->Session->read('userInfo.user_type') == '2'){
			$this->paginate['conditions'] = array('Loan.id'=>$InLoanIds);
		}else{
			$userTeamId = $this->getUserTeam($this->Session->read('userInfo.id'));
			$this->paginate['conditions'] = array('Loan.team_id'=>$userTeamId);
		}
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('Loan');
		
		$this->set('allLoans', $getData);
	}
	
	/*
	* loans function :- loan_logs
	* Functionality -  loan_logs
	* Created date - 08-Sep-2015
	* Updated Date 11 - May 2016
	* Created By - Manish
	*/
	
	function loan_logs($shortAppId = null) {
		$this->loadAllModel(array('LoanLog'));
		$shortAppId = (!empty($shortAppId)) ? base64_decode(base64_decode($shortAppId)) : '';
		$this->getLoanTypes();
		$this->getUserTypes();
		$this->getLogIcons();
		$this->getLoanPhases();
		$arrLog = $this->LoanLog->find('all', array('conditions'=>array('LoanLog.short_application_id'=>$shortAppId), 'order'=>'LoanLog.created DESC'));
		$this->set('logs', $arrLog);
	}
	
	/**
	 * Summary :- trust_deed_listing
	 * @return	NULL
	 * Description	:- trust_deed_listing
	*/	
	
	public function trust_deed_listing() {
		$this->loadAllModel(array('TrustDeed','TrustDeedUpload'));
		$userId = $this->Session->read('userInfo.id');
		$arrTrustDeed = $this->TrustDeed->find('all', array('conditions'=>array('TrustDeed.user_id'=>$userId)));
		$this->set('arrTrustDeed', $arrTrustDeed);
	}
	
	/*
	* trust_deed function
	* Functionality -  
	* Created date - 17-Aug-2015
	*/
	
	public function trust_deed($loanID = null,$action = null) {
		$newLoans = $this->getLoanLifeCyclePhase();
		$userId = $this->Session->read('userInfo.id');
		$userData  = $this->Session->read('userInfo'); 
		$userName = $userData['first_name']. ' '. $userData['last_name'];
		$this->getPropertyTypes();
		$this->loadAllModel(array('TrustDeed','TrustDeedUpload','TrustDeedField','Loan','CompanyTemplate','EmailTemplate','TeamMember','User','ShortApplication','SoftQuote'));
		$this->getPropertyTypes();
		//Title 365 Info - Property Detail
		$shortAppID = $this->getShortAppID(base64_decode($loanID));
		$loanDetail = $this->Loan->find('first', array('conditions'=>array('Loan.id'=>base64_decode($loanID)), 'fields'=>array('Loan.id','Loan.team_id','ShortApplication.property_type','Loan.soft_quate_id','Loan.loan_number')));
		$this->ShortApplication->unbindModel(array(
											'hasMany'=>array('PropertyHistory','PropertyComparable')
											));
		$propertyDetail = $this->ShortApplication->find('first',array('conditions'=>array('PropertyDetail.short_application_id'=>$shortAppID)));
		$loanNumber =  $loanDetail['Loan']['loan_number'];
		if(!empty($this->request->data)) { 
			$this->request->data['TrustDeed']['user_id'] = $userId;			
			$this->request->data['TrustDeed']['id'] = base64_decode($this->request->data['TrustDeed']['id']);
			$this->request->data['TrustDeed']['loan_id'] = base64_decode($loanID);
			$this->TrustDeed->create();
			if($this->TrustDeed->save($this->request->data['TrustDeed'])) {
				$insertId = $this->TrustDeed->id;
				if(isset($this->request->data['TrustDeedUpload']) && !empty($this->request->data['TrustDeedUpload'])) {
					$valid  = array('image/jpeg','image/png','image/gif','image/jpg', 'jpeg', 'jpg', 'png', 'gif');
					$i = 1;
					foreach($this->request->data['TrustDeedUpload'] as $tmp) {
						if(isset($tmp['name']) && !empty($tmp['name'])) {
							$newname = '';
							$flag = false;
							$str = explode('/',$tmp['type']);
							if($tmp['error']!=0) {
								
								$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
								$flag = 'false';
							} else if(!in_array($str[1], $valid)) {
								
								$this->Session->setFlash('You can only upload png, gif, jpeg, and jpg files!!', 'error');
								$flag = false;
								
							} else if($tmp['size'] > 2000000) {
								$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
								$flag = 'false';
							} else {
								$parts=pathinfo($tmp['name']);
								$ext=strtolower($parts['extension']);
								$newname = 'img_'.$i.'_'.rand(1,999999999999).'.'.$ext;
								$file_path = WWW_ROOT."upload/TrustDeedFlyer/".$newname;
								if(move_uploaded_file($tmp['tmp_name'], $file_path)) {
									$saveImg['id'] = base64_decode($this->request->data['TrustDeedUpload']['id'][$i]);
									$saveImg['trust_deed_id'] = $insertId;
									$saveImg['property_image'] = $newname;
									$saveImg['created'] = CURRENT_DATE_TIME_DB;
									$this->TrustDeedUpload->create();
									$this->TrustDeedUpload->save($saveImg);
									$flag = 'true';
								}
							}
						}
						$i++;
					}
				}else{
					unset($this->request->data['TrustDeedUpload']);
				}
				//Start Added more fields in Trust deed Flyer form
				if(isset($this->request->data['TrustDeedField']) && !empty($this->request->data['TrustDeedField'])) {	
					foreach($this->request->data['TrustDeedField']['FormLabel'] as $key => $formLabel) {
						if(isset($formLabel) && $formLabel != '') {
							$saveField['id'] = base64_decode($this->request->data['TrustDeedField']['id'][$key]);
							$saveField['trust_deed_id'] = $insertId;
							$saveField['form_label'] = $this->request->data['TrustDeedField']['FormLabel'][$key];
							$saveField['form_value'] = $this->request->data['TrustDeedField']['FormField'][$key];
							$saveField['created'] = CURRENT_DATE_TIME_DB;
							$saveField['modified'] = CURRENT_DATE_TIME_DB;
							$this->TrustDeedField->create();
							$this->TrustDeedField->save($saveField);
						}
					}
				}else{
					unset($this->request->data['TrustDeedField']);
				}
				//End Added more fields in Trust deed Flyer form
				//Loan Logs
				$shortAppID = $this->getShortAppID(base64_decode($loanID));
				$logData['LoanLog']['user_id'] = $userId;
				$logData['LoanLog']['short_application_ID'] = $shortAppID;
				$logData['LoanLog']['action'] = '7';
				$logData['LoanLog']['description'] = 'Trust Deed created by '.$userName;
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->save($logData);
				//update loan_life_cycle_phase in loan table
				$loanCyclephase = '7';
				$this->Loan->id = base64_decode($loanID);
				$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
				//save Trust Deed PDF
				$arrTrustDeed = $this->TrustDeed->find('first', array('conditions'=>array('TrustDeed.loan_id'=>base64_decode($loanID))));
				$templateHeader = $this->CompanyTemplate->find('first');
				$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'trust_deed_flyer_draft')));
				$this->set('pdfTemplate', $pdfTemplate);
				$this->set('arrTrustDeed', $arrTrustDeed);
				$this->set('templateHeader', $templateHeader);
				$this->layout = '/pdf/default';
				$this->render('/Pdf/trust_deed_flyer');
				
				//Trust Deed flyer - Flyby Publish
				$cyclephase = '8';
				$this->Loan->id = base64_decode($loanID);
				$this->Loan->saveField('loan_life_cycle_phase',$cyclephase);
				
				//save Trust deed Flyer Pdf name
				$pdfName = 'trust_deed_flyer_'.$loanID.'.pdf';
				$this->TrustDeed->id = $arrTrustDeed['TrustDeed']['id'];
				$this->TrustDeed->saveField('pdf_name', $pdfName);
				
				//save loan log
				$shortAppID = $this->getShortAppID(base64_decode($loanID));
				$logData['LoanLog']['user_id'] = $userId;
				$logData['LoanLog']['short_application_ID'] = $shortAppID;
				$logData['LoanLog']['action'] = '8';
				$logData['LoanLog']['description'] = 'Trust Deed Flyby published  by '.$userName. '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->save($logData);
				//save notification
				$action = $loanNumber . '-'. $newLoans['8'].' '.$userName. '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
				//save funder Id in Loan User table
				$this->Common->updateLoanUser(base64_decode($loanID), $this->Session->read('userInfo.user_type'),$this->Session->read('userInfo.id'));
				//save notification
				$this->Common->saveNotifications($action, $senderID, base64_decode($loanID));
				$this->Session->setFlash('Trust Deed Flyer has been saved successfully. Please fill LOI', 'default', array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
			}
		}
		$action = base64_decode($action);
		if($action == 'final_publish'){
			$arrTrustDeed = $this->TrustDeed->find('first', array('conditions'=>array('TrustDeed.loan_id'=>base64_decode($loanID))));
			//save Trust deed Flyer Pdf name
			$pdfName = 'trust_deed_flyer_'.$loanID.'.pdf';
			//save loan log
			$shortAppID = $this->getShortAppID(base64_decode($loanID));
			$logData['LoanLog']['user_id'] = $userId;
			$logData['LoanLog']['short_application_ID'] = $shortAppID;
			$logData['LoanLog']['action'] = '15';
			$logData['LoanLog']['description'] = 'Trust Deed published  by '.$userName. '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			
			//send email notification
			$shortAppDetail = $this->ShortApplication->find('first', array('conditions'=>array('ShortApplication.id'=>$shortAppID)));
			//save notification for borrower
			$notification['Notification']['receiver_id'] = $shortAppDetail['ShortApplication']['borrower_ID'];
			$notification['Notification']['sender_id'] = $userId;
			$notification['Notification']['action'] = $newLoans['15'];
			$notification['Notification']['action_id'] = base64_decode($loanID);
			$notification['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notification);
			$action = $loanNumber .' - ' .$newLoans['15'] . ' by '.$userName. '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
			$this->Common->saveNotifications($action, $userData['id'], base64_decode($loanID));
			
			$email = $shortAppDetail['ShortApplication']['applicant_email_ID'];
			$userName = $shortAppDetail['ShortApplication']['applicant_first_name'] . ' ' . $shortAppDetail['ShortApplication']['applicant_last_name'];
			$this->Session->setFlash('Trust Deed Flyer has been published successfully.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
		}
		if($action != 'preview' && $action != 'publish'){
			$trustDeedId = base64_decode($action);
			$this->TrustDeed->id = $trustDeedId; 
			$this->data = $this->TrustDeed->read();
			$this->set('trustDeedId', $trustDeedId);
		}
		$this->set(compact(array('loanDetail','propertyDetail')));
	}
	
	/*
	* changeStatus function
	* Functionality -  changeStatus
	* Created date - to mark notification as read
	*/
		
	public function changeStatus($notificationID = null){
		$this->loadModel('Notification');
		$this->autoRender = false;
		$this->layout = '';
		$this->Notification->id = $notificationID;
		$this->Notification->saveField('status', '1');
		echo true;
		
	}
	
	/*
	* returnLogDescription function
	* Functionality -  returnLogDescription
	* Created date - return description as html
	*/
		
	public function saveLogDescription($loanID = null, $document = null, $documentType = null){
		$this->loadAllModel(array('Checklist','LoanDocument','LoanLog'));
		$userData  = $this->Session->read('userInfo');
		$shortAppID = $this->getShortAppID($loanID);
		$document = explode(',',$document);
		$loanNumber = $this->Common->getLoanNumber($loanID);
		$newLoans = $this->getLoanLifeCyclePhase();
		$action = $newLoans['5'];
		if($documentType == 'loan'){
			$loanDocuments = $this->LoanDocument->find('all',array('conditions'=>array('LoanDocument.id'=>$document)));
			if(!empty($loanDocuments)){
				$saveData = $loanNumber . ' - '.$action. '<br/>';
				foreach($loanDocuments as $key=>$val){
					if($val['LoanDocument']['download_form'] == 1) {
						$saveData .= '<a href="/app/webroot/document/'.$val['LoanDocument']['name'].'" target="_blank">'.$val['LoanDocument']['checklistname'].'</a>';
						$saveData .="<br/>";
					}else {
						$saveData .= $val['LoanDocument']['checklistname'];
						$saveData .="<br/>";	
					}
				}
				$logData['LoanLog']['user_id']= $userData['id'];
				$logData['LoanLog']['short_application_ID']= $shortAppID;
				$logData['LoanLog']['action']= $action;
				$logData['LoanLog']['description'] = $saveData;
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->create();
				$this->LoanLog->save($logData);
			}
		}else {
			$checkListData = $this->Checklist->find('all',array('conditions'=>array('Checklist.id'=>$document)));
			if(!empty($checkListData)){
				$saveData = $loanNumber . ' - '.$action. '<br/>';
				foreach($checkListData as $key=>$val){
					if($val['Checklist']['download_form'] == 1) {
						$saveData .= '<a href="/app/webroot/upload/'.$val['Checklist']['value'].'" target="_blank">'.$val['Checklist']['checklistname'].'</a>';
						$saveData .="<br/>";
					}else {
						$saveData .= $val['Checklist']['checklistname'];
						$saveData .="<br/>";
					}
				}
				$logData['LoanLog']['user_id']= $userData['id'];
				$logData['LoanLog']['short_application_ID']= $shortAppID;
				$logData['LoanLog']['action']= $action;
				$logData['LoanLog']['description'] = $saveData;
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->create();
				$this->LoanLog->save($logData);
			}
		}
	}
	
	/*
	* enquiry_document function
	* Functionality -  
	* 
	* Created date - 
	*/
	
	function enquiry_document() {
		$this->layout = false;
		$this->autoRender = false;
		if(!empty($this->request->data)) {	
			$shortAppId = isset($this->request->data['appid'])?base64_decode($this->request->data['appid']):'';
			$docID = isset($this->request->data['doc'])?$this->request->data['doc']:'';
			$this->set('shortAppId', $shortAppId);
			$this->set('docID', $docID);
			$this->render('/Elements/model_window/enquiry');
		}
	}
	
	/*
	* approve_document function
	* Functionality -  
	* 
	* Created date - 
	*/
	
	function approve_document() {
		$this->loadAllModel(array('AskDocument','LoanPhase','LoanLog','Notification','Team','ShortApplication','Loan','LoanProcessDetail', 'Message'));
		$this->layout = false;
		$this->autoRender = false;
		$userData  = $this->Session->read('userInfo');
		$userName = $userData['first_name'] . ' ' .$userData['last_name'];
		if(!empty($this->request->data['loanID']) && isset($this->request->data['loanID'])) { 
			$loanID = isset($this->request->data['loanID'])?base64_decode($this->request->data['loanID']):'';
			$this->set('loanID', $loanID);
			$this->render('/Elements/model_window/save_required_contact');	
		}
		if(isset($this->request->data['LoanReviewer']) && !empty($this->request->data['LoanReviewer'])) { 
			$loanID = $saveData['loan_id'] = isset($this->request->data['LoanReviewer']['loanID']) ? $this->request->data['LoanReviewer']['loanID'] : '';
			$saveData['escrow_email_address'] = $this->request->data['LoanReviewer']['escrow_email_address'];
			$saveData['detail'] = json_encode($this->request->data['LoanReviewer']);
			// save data to loan processor detail
			$this->LoanProcessDetail->save($saveData, array('validate'=>false));
			$this->AskDocument->updateAll(array('status' =>1), array('loan_id' => $loanID));
			//update loan_life_cycle_phase in loan table
			$newLoans = $this->getLoanLifeCyclePhase();
			$loanCyclephase = '5A';
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			$action = $newLoans['5A'];
			//get loan Info
			$loanDetail = $this->getLoanInfo($loanID);
			$logData['LoanLog']['user_id'] = $userData['id'];
			$logData['LoanLog']['short_application_ID'] = $loanDetail['short_app_id'];
			$logData['LoanLog']['action'] = $action;
			$logData['LoanLog']['description'] = $action;
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			$loanNumber = $loanDetail['loan_number'];
			$this->Common->saveNotifications($loanNumber . ' - '.$action , $userData['id'], $loanID);
			//save notification for borrower
			$notificationData['Notification']['receiver_id'] = $loanDetail['borrower_id'];
			$notificationData['Notification']['sender_id'] = $userData['id'];
			$notificationData['Notification']['action'] = $loanNumber. ' - '. $action;
			$notificationData['Notification']['action_id'] = $loanID;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			//Internal message to Processor and email
			$processorId = $this->Common->getTeamMember($userData['id'], 5);
			if(!empty($processorId)) {
				$message['Message']['receiver_id'] = $processorId;
				$message['Message']['sender_id'] = $userData['id'];
				$message['Message']['subject'] = 'New Submission - Loan # -' . $loanNumber;
				$message['Message']['message'] = 'New Submission - Loan # -' .$loanNumber. 'from. ' .$userName.'. Check <a href="'.BASE_URL.'commons/loan/">loan listing </a> to further process loan';
				$message['Message']['created'] = CURRENT_DATE_TIME_DB;
				$message['Message']['modified'] = CURRENT_DATE_TIME_DB;
				$this->Message->create();
				$this->Message->save($message);
				//Todo notification - Processor
				$toDo  = $loanNumber. ' - ' .$action. '<a href="'.BASE_URL.'processors/review_document/'.base64_encode($loanID).'">Click </a> to further process loan';
				$notificationData['Notification']['receiver_id'] = $processorId;
				$notificationData['Notification']['sender_id'] = $userData['id'];
				$notificationData['Notification']['action'] = $toDo;
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
				//email notification
				$this->CustomEmail->__sendProcessorEmail($userName, $processorId);
			}
			$this->Session->setFlash('Document has been sent to processor.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
		}
	}
	
	/*
	* loan_timeline function
	* Functionality -  To show charts for a loan.
	* Created date - 24 Sep 2015
	*/
	
	function loan_timeline($LoanId = null) {
		$this->loadAllModel(array('Loan', 'LoanLog', 'LoanPhase'));
		$LoanId = base64_decode(base64_decode($LoanId));
		$arrPhases = $this->LoanPhase->find('all', array('fields'=>array('LoanPhase.id', 'LoanPhase.loan_phase', 'LoanPhase.created'), 'conditions'=>array('LoanPhase.loan_id'=>$LoanId)));
		$arrCompletionPercent = array('A'=>'10', 'B'=>'20', 'C'=>'30', 'D'=>'40', 'E'=>'50', 'F'=>'60', 'G'=>'70', 'H'=>'80', 'I'=>'90', 'J'=>'100');
		$this->set('arrCompletionPercent', $arrCompletionPercent);
		$this->set(compact('arrCompletionPercent', 'arrPhases'));
	}
	
	/*
	* view_short_app function
	* Functionality -  view short app detail
	* Created date - 5-Oct-2015
	* Modified date - 
	*/
	public function view_loan_detail($loanId = null) {
		$this->layout = false;
		$this->autoRender = false;
		if(!empty($this->request->data)) {	
			$loanId = isset($this->request->data['loanID'])?$this->request->data['loanID']:'';
			$this->loadAllModel(array('Loan'));
			$data = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanId),'recursive' => 2));
			$this->set('data',$data);
			$this->render('/Elements/model_window/loan_detail');
		}
	}
	
	/**
	* trust_deed_tombstone function
	* Functionality -  trust_deed_tombstone published
	* Created date - 21-Oct-2015
	* Modified date - 
	*/
	
	function trust_deed_tombstone($loanId = null) { 
		$this->loadAllModel(array('TrustDeedTombstone','TrustDeed','CompanyTemplate','EmailTemplate'));
		$loanID = !empty($loanId)?base64_decode(base64_decode($loanId)):''; 
		$arrTrustDeed = $this->TrustDeed->find('first', array('conditions'=>array('TrustDeed.loan_id'=>$loanID)));
		$this->set('arrTrustDeed', $arrTrustDeed);
		if(isset($this->request->data) && !empty($this->request->data)) {
			$notArrayKey = array('trust_deed_upload','trust_deed_field'); 
			foreach($this->request->data as $key=>$val){
				if(!in_array($key, $notArrayKey)){
					if($val['option'] == 'yes'){
						$data[$key]['published_field'] = $key;
						$data[$key]['published_field_value'] = $val['value'];
					}
				}else if(!empty($val)){
					foreach($val as $v){
						if($v['option'] == 'yes' && !empty($v['value'])){
							$data[$key]['published_field'] = $key;
							$data[$key]['published_field_value'] = $v['value'];
						}
					}
				}
			}
			$tombstoneData['user_id'] = $this->Session->read('userInfo.id');
			$tombstoneData['loan_id'] = $loanID;
			$tombstoneData['created'] = CURRENT_DATE_TIME_DB;
			$tombstoneData['modified'] = CURRENT_DATE_TIME_DB;
			$this->TrustDeedTombstone->save($tombstoneData, false);
			$templateHeader = $this->CompanyTemplate->find('first');
			$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'trust_deed_flyer_draft')));
			$this->set('publishedFields', $data);
			$this->set('pdfTemplate', $pdfTemplate);
			$this->set('loanId', base64_encode($loanID));
			$template = (!empty($templateHeader['CompanyTemplate']['template'])) ? $templateHeader['CompanyTemplate']['template'] : '';
			$this->set('templateHeader', $template);
			$this->layout = '/pdf/default';
			$this->render('/Pdf/trust_deed_tombstone');
			$this->Session->setFlash('Trust Deed Tombstone Pdf saved successfully.', 'default', array('class'=>'alert alert-success.'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
		}
	}
	
	public function download_tombstone($loanID) {
		$this->autoRender = false;
		$this->layout = '';
		$pdfName = 'trust_deed_tombstone_'.$loanID.'.pdf';
		$file = 'webroot/files/pdf/TrustDeedTombstone'.DS.$pdfName;
		$this->downloadDoc($file);
	}
	
	/*
	* my_account function
	* Functionality -  my_account
	* Created date - 7-Nov-2015
	* Modified date - 
	*/
	
	public function my_account() {
		$this->getUserTypes();
		$this->getLicenceTypes();
		$this->getReferredBy();
		$this->loadAllModel(array('User','State','UserDetail','Todo','UserDocument'));
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->request->data['User']['id'] = base64_decode($this->request->data['User']['id']);
			$this->request->data['UserDetail']['id'] = base64_decode($this->request->data['UserDetail']['id']);
			$this->request->data['UserDetail']['user_id'] = $this->request->data['User']['id'];
			$this->User->set($this->request->data['User']);
			$this->UserDetail->set($this->request->data);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			if($userValidate && $userDetailValidate) {
				//Image Upload
				if(!empty($this->request->data['UserDetail']['profile_pic']) && $this->request->data['UserDetail']['profile_pic']['name'] != "") {
					$file = $this->request->data['UserDetail']['profile_pic'];
					$path = 'img/profile_pics';					
					$folder_name = 'original';
					$multiple[] = array('folder_name'=>'thumb','height'=>'355','width'=>'300'); 
					// Code to upload the image
					$response = $this->Common->upload_image($file, $path, $folder_name, true, $multiple);
					// check if filename return or error return
					$is_image_error = $this->Common->is_image_error($response);
					if(in_array($response == array('exist_error','size_mb_error','type_error'))){
						$this->Session->setFlash($is_image_error,'error');
					}else {
						$filename = $response;
						if($this->request->data['UserDetail']['old_profile_pic'] != 'index.png' && !empty($this->request->data['UserDetail']['old_profile_pic'])){
							$fileLinkThumb = IMAGES.'profile_pics/thumb/'.$this->request->data['UserDetail']['old_profile_pic'];
							if(file_exists($fileLinkThumb)){
								unlink($fileLinkThumb);
							}
							$fileLinkOriginal = IMAGES.'profile_pics/original/'.$this->request->data['UserDetail']['old_profile_pic'];
							if(file_exists($fileLinkOriginal)){
								unlink($fileLinkOriginal);
							}
						}
						$this->Session->write('userDetail.profile_picture',$filename);
						$this->request->data['UserDetail']['profile_picture'] = $filename;	
					}
				}
				unset($this->request->data['UserDetail']['profile_pic']);
				$msz= "User information saved sucessfully.";
				$this->User->save($this->request->data['User']); 
				$this->UserDetail->save($this->request->data['UserDetail']);
				$userID = $this->request->data['User']['id'];
				if(!empty($this->request->data['UserDetail']['agreement'])){
					foreach($this->request->data['UserDetail']['agreement'] as $document) {
						$newname = '';
						if(isset($document['userDocument']['name']) && $document['userDocument']['name'] != '') {
							if($document['userDocument']['error'] != 0) {
								$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
							} else if($document['userDocument']['size'] > 2000000) {
								$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
							} else {
								$upload_dir = USER_SIGNUP_DOCUMENT_PATH;
								$filename = explode(".",$document['userDocument']['name']);
								$encodeUserID = base64_encode($userID);	
								$newname = $encodeUserID."_".$document['userDocument']['name'];
								move_uploaded_file($document['userDocument']['tmp_name'], $upload_dir."/".$newname);
								$this->request->data['UserDocument']['user_id'] = $userID;
								$this->request->data['UserDocument']['document_name'] = $document['name'];
								$this->request->data['UserDocument']['file_name'] = $newname;
								$this->UserDocument->create();
								$this->UserDocument->save($this->request->data['UserDocument']);
								//TODO
								$name = $this->request->data['User']['first_name'] . ' '. $this->request->data['User']['last_name'];
								$todo = $name .' - updated user detail. <a href="'.BASE_URL.'admin/users/add/'. base64_encode($userID).'"> Click </a> to activate user';
								$toDoData['Todo']['sender_id'] = $userID;
								$toDoData['Todo']['receiver_id'] = ADMIN_ID;
								$toDoData['Todo']['to_do'] = $todo;
								$toDoData['Todo']['to_do_id'] = $userID;
								$this->Todo->save($toDoData);
							}
						}
					}
				}
				$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
				$this->redirect(array('controller'=>'commons','action' => 'my_account'));
			} else {
				$userError = $this->User->validationErrors;
				$userDetailError = $this->UserDetail->validationErrors;
				$this->set('errors',array_merge($userError,$userDetailError));
			}   
		}
		$userID = $this->Session->read('userInfo.id');
		$this->User->bindModel(
							array(
							   'hasMany'=>array(
									'UserDocument' => array(
														'className'=>'UserDocument'
													)	
									)
								)
						);
		$data = $this->User->find('first',array('conditions'=>array('User.id'=>$userID)));
		$states = $this->State->find('list',array('conditions'=>array('status'=>1),'fields'=>array('id','name'),'order'=>'name ASC'));
		$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
		$this->set('data',$data);
		$this->set('states',$states);
		$this->set('users',$users);
	}
	
	/**
	* investor_request function
	* Functionality -  Trust Deed Investment Hold Requested
	* Created date - 17-Nov-2015
	* Modified date - 
	*/
	
	function investor_request($loanId = null) {
		$this->loadAllModel(array('LoanHoldRequest', 'ShortApplication','LoanPhase', 'Loan', 'CounterOffer'));
		$userId = $this->Session->read('userInfo.id');
		$newLoans = $this->getLoanLifeCyclePhase();
		$holdReqs = $this->LoanHoldRequest->find('all', array('conditions'=>array('LoanHoldRequest.status'=>'1','LoanHoldRequest.loan_id'=>base64_decode(base64_decode($loanId)))));
		$this->set('holdReqs', !empty($holdReqs)?$holdReqs:'');
		if(isset($this->request->data) && !empty($this->request->data)) {
		   $holdRequestId = isset($this->request->data['holdRequestID'])?base64_decode($this->request->data['holdRequestID']):'';
		   $this->CounterOffer->updateAll(
				array('CounterOffer.status' => 2),
				array('CounterOffer.loan_hold_request_id' => $holdRequestId)
			);	
			//save loan logs
			$shortAppID = $this->getShortAppID(base64_decode(base64_decode($loanId)));
			$logData['LoanLog']['user_id']= $userId;
			$logData['LoanLog']['short_application_ID']= $shortAppID;
			$logData['LoanLog']['action']= 'Trust Deed Investor - Counter Offer Approved';
			$logData['LoanLog']['description'] = 'Trust Deed Investor - Counter Offer Approved';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->create();
			$this->LoanLog->save($logData);
			//save notification for all members
			$this->Common->saveNotifications('Trust Deed Investor - Counter Offer Approved. Check <a href="'.BASE_URL.'commons/loan/">loan listing </a> to further process loan', $userId, $loanId);
			//save notification to borrower
			$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
			$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
			$notificationData['Notification']['sender_id'] = $userId;
			$notificationData['Notification']['action'] = 'Trust Deed Investor - Counter Offer Approved';
			$notificationData['Notification']['action_id'] = base64_decode(base64_decode($loanId));
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			
			$this->Session->setFlash('Trust Deed Investor - Counter Offer Approved successfully.','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons','action' => 'loan'));
			
		}
	}
	
	/*
	* decline_offer function
	* Functionality - decline counter offer added by TD investor
	* Created date - 
	*/
	
	function decline_offer($counterID = null, $loanID =  null) {
		$this->layout = false;
		$this->autoRender = false;
		$this->loadAllModel(array('CounterOffer','LoanLog','ShortApplication','LoanHoldRequest'));
		$userId = $this->Session->read('userInfo.id');
		$this->CounterOffer->updateAll(array('status' =>'1'), array('id' => $counterID));
		//save loan logs
		$counterDetail = $this->CounterOffer->find('first',array('conditions'=>array('id'=>$counterID)));
		$counterLog = $counterDetail['CounterOffer']['label'] . ' - ' .$counterDetail['CounterOffer']['offer'];
		$holdRequestID = $counterDetail['CounterOffer']['loan_hold_request_id'];	
		$holdReqDetail = $this->LoanHoldRequest->find('first', array('fields'=>array('hold_by'),'conditions'=>array('id'=>$holdRequestID)));
		$investorID = $holdReqDetail['LoanHoldRequest']['hold_by'];
		
		$loanId = base64_decode(base64_decode($loanID));
		$shortAppID = $this->getShortAppID($loanId);
		$logData['LoanLog']['user_id']= $userId;
		$logData['LoanLog']['short_application_ID']= $shortAppID;
		$logData['LoanLog']['action']= 'Trust Deed Investment Hold Requested';
		$logData['LoanLog']['description'] = 'Counter Offer - Declined : '.$counterLog;
		$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
		$this->LoanLog->create();
		$this->LoanLog->save($logData);
		//save notification for all members
		$this->Common->saveNotifications('Counter-Offer Declined: '.$counterLog, $userId, $loanId);
		//save notification
		$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
		$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
		$notificationData['Notification']['sender_id'] = $userId;
		$notificationData['Notification']['action'] = 'Counter Offer - Declined : '.$counterLog;
		$notificationData['Notification']['action_id'] = $loanId;
		$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
		$this->Notification->create();
		$this->Notification->save($notificationData);
		//save notification to investor
		$investorNotification['Notification']['receiver_id'] = $investorID;
		$investorNotification['Notification']['sender_id'] = $userId;
		$investorNotification['Notification']['action'] = 'Counter Offer - Declined : '.$counterLog;
		$investorNotification['Notification']['action_id'] = $loanId;
		$investorNotification['Notification']['created'] = CURRENT_DATE_TIME_DB;
		$this->Notification->create();
		$this->Notification->save($investorNotification);
		$this->Session->setFlash('Counter Offer declined.', 'default', array('class'=>'alert alert-success'));
		//$this->redirect(array('controller'=>'commons','action' => 'loan'));
		$this->redirect(array('controller'=>'commons','action' => 'investor_request',base64_encode(base64_encode($loanId))));
	}
	
	/*
	* accept_offer function
	* Functionality - accept counter offer added by TD investor
	* Created date - 
	*/
	
	public function accept_offer($counterID = null, $loanID = null){ //echo $counterID . ' ' .$loanID; 
		$this->layout = false;
		$this->autoRender = false;
		$newLoans = $this->getLoanLifeCyclePhase();
		
		$userId = $this->Session->read('userInfo.id');
		$this->loadAllModel(array('CounterOffer','LoanLog','ShortApplication','LoanHoldRequest','Loan','LoanPhase')); 
		$this->CounterOffer->updateAll(array('status' =>'2'), array('id' => $counterID));
		$counterDetail = $this->CounterOffer->find('first',array('conditions'=>array('id'=>$counterID)));
		//save loan logs
		$counterLog = $counterDetail['CounterOffer']['label'] . ' - ' .$counterDetail['CounterOffer']['offer'];
		$holdRequestID = $counterDetail['CounterOffer']['loan_hold_request_id'];	
		$holdReqDetail = $this->LoanHoldRequest->find('first', array('fields'=>array('hold_by'),'conditions'=>array('id'=>$holdRequestID)));
		$investorID = $holdReqDetail['LoanHoldRequest']['hold_by'];
		$loanId = base64_decode(base64_decode($loanID));
		$loanNumber = $this->Common->getLoanNumber($loanId);
		
		$shortAppID = $this->getShortAppID($loanId);
		$logData['LoanLog']['user_id']= $userId;
		$logData['LoanLog']['short_application_ID'] = $shortAppID;
		$logData['LoanLog']['action'] = 17;
		$logData['LoanLog']['description'] = 'Counter Offer - Accepted : '.$counterLog;
		$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
		$this->LoanLog->create();
		$this->LoanLog->save($logData);
		//save notification for all members
		$this->Common->saveNotifications($loanNumber.  ' - Counter Offer - Accepted : '.$counterLog, $userId, $loanId);
		//save notification
		$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
		$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
		$notificationData['Notification']['sender_id'] = $userId;
		$notificationData['Notification']['action'] = 'Counter Offer - Accepted : '.$counterLog;
		$notificationData['Notification']['action_id'] = $loanId;
		$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
		$this->Notification->create();
		$this->Notification->save($notificationData);
		//save notification to investor
		$investorNotification['Notification']['receiver_id'] = $investorID;
		$investorNotification['Notification']['sender_id'] = $userId;
		$investorNotification['Notification']['action'] = 'Counter Offer - Accepted : '.$counterLog;
		$investorNotification['Notification']['action_id'] = $loanId;
		$investorNotification['Notification']['created'] = CURRENT_DATE_TIME_DB;
		$this->Notification->create();
		$this->Notification->save($investorNotification);
		$approvedCounter = $this->CounterOffer->find('all',array('conditions'=>array('CounterOffer.loan_id' => $loanId, 'CounterOffer.status IN' => array(0,1))));
		if(count($approvedCounter) == 0) {
			$this->Common->approveInvestorCounterOffer($loanId, $loanNumber, $shortAppID,  $newLoans['17']);
			$this->Session->setFlash('Trust Deed Investor - Conditions satisfied.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons','action' => 'loan'));
		}
		$this->Session->setFlash('Counter Offer accepted.', 'default', array('class'=>'alert alert-success'));
		$this->redirect(array('controller'=>'commons','action' => 'investor_request',base64_encode(base64_encode($loanId))));
	}
	
	/*
	* doc_order_form function
	* Functionality -  doc_order_form functionality
	* Created date - 15-Dec-2015
	* Modified date - 
	*/
	
	public function doc_order_form($loanId = null, $docApprovalID = null) {
		$this->loadAllModel(array('SoftQuote', 'LoanProcessDetail', 'DocOrderForm','ShortApplication','CompanyTemplate', 'EmailTemplate','DocOrderApproval'));
		$userData  = $this->Session->read('userInfo'); 
		$shortAppId = $this->getShortAppID(base64_decode($loanId));
		$userName = $userData['first_name']. ' '. $userData['last_name'];
		$arrDocOrder = $this->DocOrderForm->find('first', array('conditions'=>array('DocOrderForm.loan_id'=>base64_decode($loanId))));
		$sqd = $this->SoftQuote->find('first', array('conditions'=>array('SoftQuote.short_application_Id'=>$shortAppId)));
		// loan process detail
		$loanProcessDetail = $this->LoanProcessDetail->find('first', array('conditions' => array('LoanProcessDetail.loan_id' => base64_decode($loanId))));
		$loanProcessDetail1 = json_decode($loanProcessDetail['LoanProcessDetail']['detail'], true);
		$reviews = array_merge($loanProcessDetail['LoanProcessDetail'],$loanProcessDetail1);
		unset($reviews['detail']);
		// temaplte header
		$templateHeader = $this->CompanyTemplate->find('first');
		$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'doc_order_form')));
		$this->getLoanTypes();
		$this->set(compact(array('pdfTemplate','templateHeader','arrDocOrder','loanId','docApprovalID','reviews','sqd')));
	}
	
	/*
	* show_modal function
	* Functionality -  show_modal to save remarks for approval and denial
	* Created date - 16-Dec-2015
	* Modified date - 
	*/
	
	public function show_doc_order_modal($shortAppId = null){
		$this->layout = false;
		$this->autoRender = false;
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		if(!empty($this->request->data)){
			$docID = isset($this->request->data['docID'])?$this->request->data['docID']:'';
			$status = isset($this->request->data['status'])?$this->request->data['status']:'';
			$loanID = isset($this->request->data['loanID'])?$this->request->data['loanID']:'';
			$this->set('docID',$docID);
			$this->set('status',$status);
			$this->set('loanID',$loanID);
			$this->render('/Elements/model_window/doc_order_modal');
		}
	}
	
	/*
	* save_doc_order_remarks function
	* Functionality -  save_doc_order_remarks
	* Created date - 16-Dec-2015
	* Modified date - 
	*/
	
	public function save_doc_order_remarks(){ 
		$newLoans = $this->getLoanLifeCyclePhase();
		$this->loadAllModel(array('LoanLog','Notification','ShortApplication','AskDocument','DocOrderApproval','Review','LoanProcessDetail'));
		$userData  = $this->Session->read('userInfo'); //pr($userData); die();
		$id = $userData['id'];
		$docID =  base64_decode($this->request->data['Approval']['documentID']);
		$remarks =  $this->request->data['Approval']['remarks'];
		$status =  $this->request->data['Approval']['status'];
		$loanId = base64_decode($this->request->data['Approval']['loanID']);
		$shortAppId = $this->getShortAppID($loanId);
		$action = 'Approved';
		if($this->request->data['Approval']['status'] == 2){
			$action = 'Denied';
		}
		$this->DocOrderApproval->updateAll(
			array('DocOrderApproval.status' => $status,'DocOrderApproval.remarks' => "'".$remarks."'"),
			array('DocOrderApproval.doc_order_form_id' => $docID,'DocOrderApproval.receiver_id' => $id)
		);
		$saveAction = 'Loan Doc Form '. $action .' by ' .$userData['name'] .  ' Remarks - '. $this->request->data['Approval']['remarks'];
		$this->Common->saveNotifications($saveAction, $id, $loanId);
		//Loan Logs
		$logData['LoanLog']['user_id'] = $id;
		$logData['LoanLog']['short_application_ID'] = $shortAppId;
		$logData['LoanLog']['action'] = 'Loan Doc Form '. $action .' by ' .$userData['name'] .  ' Remarks - '. $this->request->data['Approval']['remarks'];
		$logData['LoanLog']['description'] = 'Loan Doc Form '. $action .' by '.$userData['name'] .' Remarks - '. $this->request->data['Approval']['remarks'];
		$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
		$this->LoanLog->save($logData);
		// check if doc Order approval have status 1 for all doc_order_form_id
		$deniedCount = $this->DocOrderApproval->find('count', array('conditions'=>array('DocOrderApproval.doc_order_form_id' => $docID,'DocOrderApproval.status' => 0)));
		if($deniedCount == 0) {
			//$funderAction = 'Doc Order Form Approved by team, <a href="">Click</a> to approve and further process loan.'
			$docFormData = $this->DocOrderApproval->findByLoanId($loanId);
			$notificationData['Notification']['receiver_id'] = $docFormData['DocOrderApproval']['sender_id'];
			$notificationData['Notification']['sender_id'] = $userData['id'];
			$notificationData['Notification']['action'] = 'Doc Order Form - Accepted';
			$notificationData['Notification']['action_id'] = $loanId;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			// emailed to the escrow officer
			$arrReview = $this->LoanProcessDetail->find('first', array('fields'=>array('LoanProcessDetail.escrow_email_address'), 'conditions'=>array('LoanProcessDetail.loan_id'=>$loanId)));
			$this->CustomEmail->__sendEscrowEmail('', $arrReview['LoanProcessDetail']['escrow_email_address'], $loanId);
		}
		$this->Session->setFlash('Remarks saved successfully.', 'default', array('class'=>'alert alert-success'));
		if($this->Session->read('userInfo.user_type') == 1) {
			$this->redirect(array('controller'=>'borrowers','action' => 'borrowerLoans'));
		}else {
			$this->redirect(array('controller'=>'commons','action' => 'loan'));
		}	
	}
	
	/**
	* my_hierarchy function
	* Functionality -  
	* Created date - return description as html
	*/
	
	function my_hierarchy() {
		$this->loadAllModel(array('User', 'Team', 'TeamMember'));
		$userId = $this->Session->read('userInfo.id');
		$this->Common->calculateCommission($userId);
		$this->set('userId', $userId);
		$userType = $this->Session->read('userInfo.user_type');
		$teamMemberTypes = array("1" =>"Borrower", "2" =>"Broker/Loan Officer", "3"=>"Sales Manager","4"=>"Sales Director", "5" => "Processor","6" =>"Funder");
		$this->set('userTypes', $teamMemberTypes);
		$arrTeam = array();
		if(array_key_exists($userType, $this->userTypes)) {
			if($userType!='6') {
				$arrTeamId = $this->TeamMember->find('list', array('fields'=>array('TeamMember.id', 'TeamMember.team_id'),'conditions'=>array('TeamMember.team_member_id'=>$userId, 'TeamMember.member_type'=>$userType, 'TeamMember.status'=>'1')));
				if(!empty($arrTeamId)) {
					foreach($arrTeamId as $tid) {
						$this->Team->bindModel(array('belongsTo'=>array(
							'User' => array(
								'className'=> 'User',
								'foreignKey' => 'funder_id')
						)));
						$this->TeamMember->bindModel(array('belongsTo'=>array(
							'User' => array(
								'className'=> 'User',
								'foreignKey' => 'team_member_id'
							)
						)));
						$contain = array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type','TeamMember.id','TeamMember.team_id','TeamMember.member_type','TeamMember.team_member_id','TeamMember.status' => array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type'));
						$arrTeam[] = $this->Team->find('first', array('contain'=>$contain,'fields'=>array('Team.id','Team.funder_id','Team.team_funder','Team.status'), 'conditions'=>array('Team.id'=>$tid,'Team.status'=>'1')));
					}
				}
			}
			if($userType=='6') {
			//funder
				$teamId = $userId;
				$this->Team->bindModel(array('belongsTo'=>array(
					'User' => array(
						'className'=> 'User',
						'foreignKey' => 'funder_id')	
				)));
				$this->TeamMember->bindModel(array('belongsTo'=>array(
					'User' => array(
						'className'=> 'User',
						'foreignKey' => 'team_member_id',
					)
				)));
				$contain = array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type','TeamMember.id','TeamMember.team_id','TeamMember.member_type','TeamMember.team_member_id','TeamMember.status' => array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type'));
				$arrTeam[] = $this->Team->find('first', array('contain'=>$contain,'fields'=>array('Team.id','Team.funder_id','Team.team_funder','Team.status'), 'conditions'=>array('Team.funder_id'=>$teamId,'Team.status'=>'1')));
			}
		}
		$this->set('team', $arrTeam);
	}
	
	/*
	* show_modal function
	* Functionality -  Accounting - Loan Sales Comm, Reconiliation, Compliancy
	* Created date - 28-Dec-2015
	* Modified date - 
	*/
	
	public function reconcile($shortAppId = null) {
		if(isset($this->request->data) && !empty($this->request->data)) {
			pr($this->request->data);
		}
	}
	
	/**
	 * Description :- propertyDetail
	 * @var object : $shrotAppId
	*/
	
	function propertyDetail($shrotAppId = null, $getPropertyDetail = null) {
		$shrotAppId = base64_decode($shrotAppId);
		if(base64_decode($getPropertyDetail) == 'yes'){
			$this->Common->getDetailFromTitle365($shrotAppId);
			$this->Session->setFlash('Property detail import successfully.', 'default', array('class'=>'alert alert-success'));
		}
		$this->loadModel('ShortApplication');
		$shortAppDetail = $this->ShortApplication->findById($shrotAppId);
		$this->set('shortAppDetail',$shortAppDetail);
	}
	
	/*
	* show_invitee_modal
	* Functionality -  show invite member modal function
	* Created date - 11-Feb-2016
	* Modified date - 
	*/
	
	public function show_invitee_modal() {
		$this->loadAllModel(array('User','Message'));
		$this->layout = false;
		$this->autoRender = false;
		if(isset($this->request->data) && (!empty($this->request->data))){ 
			$userID = isset($this->request->data['userID'])?$this->request->data['userID']:'';
			$userType = isset($this->request->data['userType'])?$this->request->data['userType']:'';
			$inviteeuserType = isset($this->request->data['inviteeUserType'])? $this->request->data['inviteeUserType']:'';
			$this->set('userID',$userID);
			$this->set('userType' , $userType);
			$this->set('inviteeUserType',$inviteeuserType);
		}
		$this->render('/Elements/model_window/invitee_modal');
	}
	
	/*
	* send_invitee
	* Functionality -  send email to email address
	* Created date - 11-Feb-2016
	* Modified date - 
	*/
	
	public function send_invitee() {
		$this->loadAllModel(array('User','EmailTemplate'));
		$this->layout = false;
		$this->autoRender = false;
		if(isset($this->request->data) && (!empty($this->request->data))){ 
			$userID = isset($this->request->data['TeamMember']['userID'])? base64_decode($this->request->data['TeamMember']['userID']):'';
			$userType = isset($this->request->data['TeamMember']['userType'])?$this->request->data['TeamMember']['userType']:'';
			$emailID = isset($this->request->data['TeamMember']['emailAddress'])?$this->request->data['TeamMember']['emailAddress']:'';
			$inviteeUserType = isset($this->request->data['TeamMember']['inviteeUserType'])?base64_decode($this->request->data['TeamMember']['inviteeUserType']) : '';
			$userDetail = $this->User->find('first', array('conditions'=>array('User.id' =>$userID),'fields'=>array('User.name','User.id')));
			$site_URL = Configure::read('BASE_URL');
			$active =  '<a href = "' .$site_URL. 'homes/register/'.base64_encode($inviteeUserType).'/'.base64_encode($userID).'">Click to register</a>'; 
			$logo = '<img src="'.$site_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
			$template = $this->EmailTemplate->getEmailTemplate('invite_member');
			$to = $emailID;
			$emailData = $template['EmailTemplate']['template'];
			$emailData = str_replace('{Member}', $userDetail['User']['name'], $emailData);
			$emailData = str_replace('{Link}', $active, $emailData);
			$emailData = str_replace('{Logo}', $logo, $emailData);
			$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
			$send_mail = $this->sendEmail($to,$subject,$emailData);
		}
	}
	
	/**
	 * Description :- change_password
	 * @var object : $shrotAppId
	*/
	
	function change_password() {
		$this->loadModel('User');
		if(!empty($this->request->data)) {
			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
			if(!empty($this->request->data)){
				if(trim($this->request->data['User']['password']) != trim($this->request->data['User']['cpassword'])){
					$this->Session->setFlash('Password and confirm password does not match.','default',array('class'=>'alert alert-danger'));
				}else{
					$userArr = $this->User->find('first',array('conditions'=>array('User.password'=>md5(trim($this->request->data['User']['current_password'])),'User.id' => $this->Session->read('userInfo.id')),'fields'=>array('User.id','User.first_name')));
					if(count($userArr)){
						if(!empty($this->request->data['User']['password']) && $this->request->data['User']['password'] == $this->request->data['User']['cpassword']){
							$data['id'] = $this->Session->read('userInfo.id');
							$data['password'] = md5($this->request->data['User']['password']);
							$data['userPassword'] = base64_encode($this->request->data['User']['cpassword']);
							if($this->User->save($data,array('validate'=>false))){
								$this->Session->setFlash('Password has been changed.','default',array('class'=>'alert alert-success'));
								$this->request->data = '';
							}
						}else{
							$this->Session->setFlash('Please enter new password or confirm password.','default',array('class'=>'alert alert-danger'));
						}
					}else{
						$this->Session->setFlash('Current password does not match.','default',array('class'=>'alert alert-danger'));
					}
				}
			}
		}
	}
	
	/**
		* Description :- getloandByPhase
		* @var object :- $loanPhase
	*/
	
	function getloandByPhase($loanPhase = null){
		$this->layout = '';
		$loanPhase = explode(' ',base64_decode($loanPhase));
		$loanDetail = $return = '';
		$loanIds = array();
		$this->getLoanReasons();
		if($loanPhase['1']){
			$this->loadAllModel(array('LoanPhase','Loan','LoanUser'));
			if($this->Session->read('userInfo.user_type') == '2'){
				$loanDetail = $this->LoanUser->find('all',array('conditions'=>array('user_id' => $this->Session->read('userInfo.id'),'user_type' => $this->Session->read('userInfo.user_type'))));
				if($loanDetail){
					foreach($loanDetail as $key=>$val){
						$loanIds[] = $val['LoanUser']['loan_id'];
					}
				}
			}else{
				$userTeamId = $this->getUserTeam($this->Session->read('userInfo.id'));
				$loanIds = $this->Loan->find('list',array('conditions'=>array('Loan.team_id'=>$userTeamId)));
			}
			$this->LoanPhase->bindModel(array(
				'belongsTo' => array(
						'Loan' => array(
							'foreignKey' => false,
							'conditions' => array('LoanPhase.loan_id = Loan.id')
						)
					)
			));
			$loanDetail = $this->LoanPhase->find('all',array('conditions'=>array('LoanPhase.loan_id'=>$loanIds),'fields'=>'Loan.short_app_id,LoanPhase.loan_phase,LoanPhase.loan_id','order' => 'LoanPhase.id DESC'));
			if($loanDetail){
				$shortAppId = ''; $notCheck = array();
				foreach($loanDetail as $key=>$val){
					if(!in_array($val['LoanPhase']['loan_id'],$notCheck)){
						if($val['LoanPhase']['loan_phase'] == $loanPhase['1']){
							$shortAppId[$val['Loan']['short_app_id']] = $val['Loan']['short_app_id'];	
						}
						$notCheck[] = $val['LoanPhase']['loan_id'];
					}
				}
				$loanDetailFull = $this->Loan->find('all',array('conditions'=>array('Loan.short_app_id' => $shortAppId),'recursive'=>2));
				$this->set('loanDetailFull',$loanDetailFull);
			}
		}
	}
	
	/*
	* approve_document function
	* Functionality -  
	* 
	* Created date - 
	*/
	
	function show_add_modal() {
		$this->loadAllModel(array('AskDocument','LoanPhase','LoanLog','Notification','Team','ShortApplication','Loan','LoanProcessDetail', 'Message'));
		$this->layout = false;
		$this->autoRender = false;
		$userData  = $this->Session->read('userInfo');
		$userName = $userData['first_name'] . ' ' .$userData['last_name'];
		$email = $userData['email_address'];
		if(!empty($this->request->data['loanID']) && isset($this->request->data['loanID'])) { 
			$loanID = isset($this->request->data['loanID'])?base64_decode($this->request->data['loanID']):'';
			$this->set('loanID', $loanID);
			$this->render('/Elements/model_window/save_required_contact');	
		}
		if(isset($this->request->data['LoanReviewer']) && !empty($this->request->data['LoanReviewer'])) { 
			$loanID = isset($this->request->data['LoanReviewer']['loanID']) ? $this->request->data['LoanReviewer']['loanID']:'';
			foreach($this->request->data['LoanReviewer'] as $key =>$value) {
				if(!empty($value)){
					$saveData['LoanProcessDetail']['loan_id'] = $loanID;
					$saveData['LoanProcessDetail']['column_name'] = $key;
					$saveData['LoanProcessDetail']['column_value'] = $value;
					$saveData['LoanProcessDetail']['user_id'] = $this->Session->read('userInfo.id');
					//pr($saveReview);
					$this->LoanProcessDetail->create();
					$this->LoanProcessDetail->save($saveData);
				}
			}
			$this->AskDocument->updateAll(array('status' =>1), array('loan_id' => $loanID));
			//update loan_life_cycle_phase in loan table
			$newLoans = $this->getLoanLifeCyclePhase();
			$loanCyclephase = $newLoans['5A'];
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			//Loan Logs
			$shortAppID = $this->getShortAppID($loanID);
			$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
			$logData['LoanLog']['user_id'] = $userData['id'];
			$logData['LoanLog']['short_application_ID'] = $shortAppID;
			$logData['LoanLog']['action'] = 6;
			$logData['LoanLog']['description'] = 'Loan Submitted to Processing.';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			$loanNumber = $this->Common->getLoanNumber($loanID);
			$this->Common->saveNotifications($loanNumber . ' - Loan Submitted to Processing.', $userData['id'], $loanID);
			//save notification for borrower
			$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
			$notificationData['Notification']['sender_id'] = $userData['id'];
			$notificationData['Notification']['action'] = $loanNumber. ' - Loan  Submitted to Processing';
			$notificationData['Notification']['action_id'] = $loanID;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			//Internal message to Processor and email
			$processorId = $this->Common->getTeamMember($userData['id'], 5);
			if(!empty($processorId)) {
				$message['Message']['receiver_id'] = $processorId;
				$message['Message']['sender_id'] = $userData['id'];
				$message['Message']['subject'] = 'New Submission - Loan # -' . $loanNumber;
				$message['Message']['message'] = 'New Submission - Loan # -' .$loanNumber. ' from. ' .$userName.'.Check <a href="'.BASE_URL.'commons/loan/">loan listing </a> to further process loan';
				$message['Message']['created'] = CURRENT_DATE_TIME_DB;
				$message['Message']['modified'] = CURRENT_DATE_TIME_DB;
				$this->Message->create();
				$this->Message->save($message);
				$this->CustomEmail->__sendProcessorEmail($userName, $processorId);
			}
			$this->Session->setFlash('Data has been saved successfully.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
		}
	}
	
	/*
	* upload_additional_checklist
	* Functionality -   Broker will also need the ability to upload additional supporting collateral, not just the required upload able documents.
	* Created date - 11-Feb-2016
	* Modified date - 
	*/
	
	public function upload_additional_document() { 
		$this->loadAllModel(array('User','Message'));
		$this->layout = false;
		$this->autoRender = false;
		if(isset($this->request->data) && (!empty($this->request->data))){ 
			$checklist_type = isset($this->request->data['checklist_type'])?$this->request->data['checklist_type']:'';
			$loanId = isset($this->request->data['loanID'])?$this->request->data['loanID']:'';
			$this->set('checklist_type',$checklist_type);
			$this->set('loanId',$loanId);
			$this->render('/Elements/model_window/upload_additional_checklist');
		}
		if(!empty($this->request->data['Checklist'])) { 
		 $this->Common->uploadAdditionalChecklist($this->request->data);
		 $this->Session->setFlash('Checklist saved successfully.', 'default', array('class'=>'alert alert-success'));
			$this->redirect($this->referer());
			
		}
	}
	
	/*
	* notifyProcessor
	* Functionality -   notify processor regarding additional document asked by processor
	* Created date - 11-Feb-2016
	* Modified date - 
	*/
	
	public function notify_processor($loanID = null) {
		$this->loadAllModel(array('AskDocument','Loan','Notification'));
		$this->layout = false;
		$this->autoRender = false;
		$msg = 'There is some error please process again';
		if(!empty($loanID)){
			$loanID = base64_decode($loanID);
			$this->AskDocument->updateAll(array('status' =>1), array('loan_id' => $loanID));
			//update loan_life_cycle_phase in loan table
			$newLoans = $this->getLoanLifeCyclePhase();
			$loanCyclephase = '5A';
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			$processorId = $this->Common->getTeamMember($this->Session->read('userInfo.id'), 5);
			if(!empty($processorId)) {
				$notificationData['Notification']['receiver_id'] = $processorId;
				$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
				$notificationData['Notification']['action'] = $loanNumber. ' - Additional document submitted by broker.<a href="'.BASE_URL.'processors/review_document/'.base64_encode($loanID).'"> Review </a> to further process loan';
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
				$msg = 'Request Sent to processor to review checklist';
			}
		}
		$this->Session->setFlash($msg, 'default', array('class'=>'alert alert-success'));
		
		$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
	}
	
	/*
	* view_disclosure function
	* Functionality - review dislosure sent by processor
	* Created date - 9-Jul-2016
	* Modified date - 
	*/
	
	public function view_disclosure($loanID = null) {
		$this->loadAllModel(array('DisclosureApproval','LoanLog','Notification','ShortApplication','LoanPhase','Loan','LoanUser'));
		$loanID = base64_decode($loanID);
		$userData  = $this->Session->read('userInfo');
		$disclosureDocuments = $this->DisclosureApproval->find('all',array('conditions'=>array('DisclosureApproval.loan_id' => $loanID,'DisclosureApproval.receiver_id'=>$userData['id'])));
		$disclosure = $this->Common->processor_document();
		$this->set(compact(array('loanID','disclosureDocuments','disclosure')));
    }
	
	/*
	* view_disclosure function
	* Functionality - deny/accept dislosure sent by processor
	* Created date - 9-Jul-2016
	* Modified date - 
	*/
	
	public function edit_document() {
		$this->loadAllModel(array('LoanLog','Notification','Loan','LoanUser'));
		$this->layout = false;
		$this->autoRender = false;
		$userData  = $this->Session->read('userInfo'); 
		if(!empty($this->request->data['render']) && isset($this->request->data['render'])) { 
			$approvalID = isset($this->request->data['approvalID']) ? base64_decode($this->request->data['approvalID']) : '';
			$status = isset($this->request->data['status']) ? base64_decode($this->request->data['status']) : '';
			$model = isset($this->request->data['model']) ? base64_decode($this->request->data['model']) : '';
			$loanID = isset($this->request->data['loanID']) ? $this->request->data['loanID'] : '';
			$documentt = isset($this->request->data['document']) ? $this->request->data['document'] : '';
			$this->set(compact(array('approvalID','status','model','loanID','documentt')));
			$this->render('/Elements/model_window/edit_approval');	
		} else {
			$model = $this->request->data['EditDocument']['model'];
			$this->loadModel($model);
			$this->$model->id = base64_decode($this->request->data['EditDocument']['id']);
			$disclosure = $this->request->data['EditDocument']['document'];
			unset($this->request->data['EditDocument']['document']);
			$this->$model->save($this->request->data['EditDocument']);
			$loanID = base64_decode($this->request->data['EditDocument']['loanID']);
			$processorDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanID,'user_type' => 5),'fields' =>array('LoanUser.user_id')));
			$deniedCount = $this->$model->find('all', array('conditions'=>array($model.'.loan_id' => $loanID, $model.'.status IN' =>array(0,2))));

			if($this->request->data['EditDocument']['status'] == 2) {
				$status = 'Denied';
			}else {
				$status = 'Accepted';
			}
			if(!empty($this->request->data['EditDocument']['upload']) && $this->request->data['EditDocument']['upload']['name'] != ''){
				$newname = '';
				
				$str = explode('/',$this->request->data['EditDocument']['upload']['type']);
				$valid  = array('application/pdf', 'pdf');
				if(!in_array($str[1], $valid)) {
					$this->Session->setFlash('Invalid document type!', 'error');
					
				} else if($this->request->data['EditDocument']['upload']['size'] > 2000000) {
					$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
				} else {
					$parts = pathinfo($this->request->data['EditDocument']['upload']['name']);
					$ext = strtolower($parts['extension']);
					//doc loanId rendom number and file extention
					$newname = $disclosure.'_'.base64_encode($loanID).'.'.$ext;
					$file_path = WWW_ROOT."files/pdf/".$disclosure .'/';
					copy($file_path.$newname, $file_path.'processor_document/'.$newname);
					move_uploaded_file($this->request->data['EditDocument']['upload']['tmp_name'], $file_path.$newname);
				}
			}
			$url = array('controller'=>'commons', 'action'=>'view_disclosure',base64_encode($loanID));
			if(count($deniedCount) == 0) {
				$newLoans = $this->getLoanLifeCyclePhase();
				$loanCyclephase = '6B';
				
				$notificationData['Notification']['receiver_id'] = $processorDetail['LoanUser']['user_id'];
				$notificationData['Notification']['sender_id'] = $userData['id'];
				$notificationData['Notification']['action'] = $newLoans['6B'] .'Check <a href="'.BASE_URL.'commons/loan/">loan listing </a> to further process loan';
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
				//update loan_life_cycle_phase in loan table
				
				$this->Loan->id = $loanID;
				$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
				$this->Session->setFlash('Loan Disclosure'. $status, 'default', array('class'=>'alert alert-success'));
				if($this->Session->read('userInfo.user_type') == 1) {
					$url = array('controller'=>'borrowers', 'action'=>'borrowerLoans');
				}else {
					$url = array('controller'=>'commons', 'action'=>'loan');
				}
			}
			$this->Session->setFlash('Loan Disclosure '. $status, 'default', array('class'=>'alert alert-success'));
			$this->redirect($url);			
		}	
    }
	
	/*
	* changeStatus function
	* Functionality -  changeStatus
	* Created date - to mark notification as read
	*/
		
	public function updateTodoStatus($todo_id = null){
		$this->loadModel('Notification');
		$this->autoRender = false;
		$this->Notification->id = base64_decode($todo_id);
		$this->Notification->saveField('status', 1);
		return true;
	}
}
?>