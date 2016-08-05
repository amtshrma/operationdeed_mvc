<?php
/*
* BorrowersController class
* Functionality -  Manage the Users (Borrowers)
* Created date - 9-Jul-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility');
App::import('Controller','Commons');

class BorrowersController extends AppController {

	var $name = 'Borrowers';
    public $useTable = 'users';
	var $components = array('Email','Cookie','Common','Paginator');
	var $helpers = array('Common');
	
	public $paginate = array(
						'limit' => PAGINATION_LIMIT,
						'order' => array(
							'notification.id' => 'DESC'
						)
	);
	function beforeFilter() {
		$allow = array('register','logout');
		parent::beforeFilter();    
		$this->checkUserSession($allow,1);
	}
		
    /*
	* index function 
	* Functionality -  index functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function index() {
		$this->layout = 'admin';
	} 
   
    /*
	* dashboard function
	* Functionality - user dashboard functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function dashboard(){
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('Notification')); 
		$this->Notification->updateAll(array('Notification.status'=>'1'),array('Notification.receiver_id'=>$this->Session->read('userInfo.id')));
		$criteria = array("Notification.receiver_id = ".$this->Session->read('userInfo.id'),'type' =>1);
		$this->paginate['conditions'] = $criteria;
		$this->paginate['order'] = 'id DESC';
		$this->paginate['limit'] = 6;
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('Notification');
		$allToDo = $this->Notification->find('all', array('conditions'=>array('status'=>1,'receiver_id' =>$this->Session->read('userInfo.id'),'type' =>2),'order'=>'id DESC'));
		$this->set(compact('getData','allToDo'));
	}
	
	/*
	* borrower shortapp function
	* Functionality -borrower shortapp listing
	* Created date - 6-Aug-2015
	* Modified date - 
	*/
	
	public function shortapp(){
		$this->loadAllModel(array('ShortApplication'));
		$this->layout = 'borrower_dashboard';
		$userdata=$this->Session->read('userInfo');
		$id=$userdata['id']; 
		$shortApplication=$this->ShortApplication->find('all',array('conditions'=>array('ShortApplication.borrower_ID'=>$id)));
		//$loanOfficerDoc=$this->AskDocument->find('all',array('conditions'=>array('loan_id'=>$loan_ID)));
		$this->set(compact(array('shortApplication')));
	}
	
	/*
	* borrower messages function
	* Functionality -borrower messages listing
	* Created date - 6-Aug-2015
	* Modified date - 
	*/
	
	public function messages() {
		$this->layout = 'borrower_dashboard';
	}
	
	/*
	* short_app function
	* Functionality - short_app listing
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function short_app() {
		$this->loadAllModel(array('ShortApplication','State'));
		$this->layout = 'admin';
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes(); 
		$allApplications = $this->ShortApplication->find('all');
		$this->set('allApplications',$allApplications);
		$this->set('states',$states);
	}

	public function ask_document($loan_Id = null) {
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('AskDocument','ChecklistForm', 'LoanLog','Notification','ShortApplication'));
		$newLoans = $this->getLoanLifeCyclePhase();
		if(isset($this->request->data) && !empty($this->request->data)) {
			$action = $newLoans['6'];
			if(!empty($this->request->data['Borrow']['loan_ID']) && isset($this->request->data['Borrow']['loan_ID'])) {
				$loan_id = $this->request->data['Borrow']['loan_ID'];
				$short_app_id = $this->request->data['Borrow']['short_app_id'];
				$receiver_id = $this->request->data['Borrow']['receiver_id'];
			}
			$userdata = $this->Session->read('userInfo');
			$userid = $userdata['id'];
			if(isset($this->request->data['ChecklistForm']) && !empty($this->request->data['ChecklistForm'])) { 
				$this->request->data['ChecklistForm']['id'] = $this->request->data['ChecklistForm']['id'];
				$this->request->data['ChecklistForm']['loan_id'] = $this->request->data['ChecklistForm']['loan_ID'];
				$this->ChecklistForm->save($this->request->data['ChecklistForm']);
				$this->Session->setFlash('Property details saved Sucessfully.', 'default', array('class'=>'alert alert-success'));
			}
			$logDescription = '';
			if(!empty($this->request->data['document'])) {
				$requestDcoumentStatus = false;
				$flag = true;
				foreach($this->request->data['document'] as $key => $document) {
					if(isset($document['name']) && $document['name'] != '') {	
						$newname = '';
						$str = explode('/',$document['type']);
						if($document['error'] != 0) {
							$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
							$flag = false;
						} else if($document['size'] > 2000000) {
							$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
							$flag = false;
						} else {
							$requestDcoumentStatus = true;
							$upload_dir=dirname(dirname(__FILE__)).'/webroot/borrower_document/';
							$filename = explode(".",$document['name']);
							$newname = date("Y_m_d_H_i_s").$key.".".$document['name'];
							$documentID = $this->request->data['askDocumentID'][$key];
							move_uploaded_file($document['tmp_name'], $upload_dir."/".$newname);
							$this->request->data['AskDocument']['id'] = $this->request->data['askDocumentID'][$key];
							$this->request->data['AskDocument']['borrower_document'] = $newname;
							$this->request->data['AskDocument']['enquiry'] = '';
							$this->request->data['AskDocument']['status'] = 0;
							//pr($this->request->data['AskDocument']);
							$this->AskDocument->save($this->request->data['AskDocument']);
							$logDescription .= '<a href="/app/webroot/borrower_document/'.$newname.'"target="_blank">'.$document['name'].'</a>';
							$logDescription .= "<br/>";
						}
					}
				}
				if($requestDcoumentStatus){
					//Loan Log
					$this->request->data['LoanLog']=array(
						'user_id'=>$userid,
					   'short_application_ID'=>$short_app_id,
					   'action'=> $action,
					   'description'=>$logDescription,
					   'created' => CURRENT_DATE_TIME_DB
					); 
					$this->LoanLog->create();
					$this->LoanLog->save($this->request->data);	
					//To Do Notification Data
					$loanNumber = $this->Common->getLoanNumber($loan_id);
					$toDo  = $loanNumber. ' - ' .$action. ' Click to <a href="'.BASE_URL.'commons/ask_document/'.base64_encode($short_app_id).'/'.base64_encode($loan_id).'">review</a>.';
					$notificationData['Notification']['receiver_id'] = $receiver_id;
					$notificationData['Notification']['sender_id'] = $userid;
					$notificationData['Notification']['action'] = $toDo;
					$notificationData['Notification']['action_id'] = $loan_id;
					$notificationData['Notification']['type'] = 2;
					$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
					$this->Notification->save($notificationData, array('validate'=>false));
					$this->Session->setFlash('Document Uploaded Sucessfully. Our team will notify you soon.', 'default', array('class'=>'alert alert-success'));
				}else{
					$this->Session->setFlash('Select document to send.', 'default', array('class'=>'alert alert-danger'));
				}
			}
		} 
		$loan_ID = base64_decode($loan_Id); 
		$this->loadModel('AskDocument');
		$this->loadModel('ChecklistForm');
		$ChecklistFormDoc = $this->ChecklistForm->find('first',array('conditions'=>array('loan_id'=>$loan_ID)));
		
		$loanOfficerDoc = $this->AskDocument->find('all',array('conditions'=>array('loan_id'=>$loan_ID)));
		
		$checklistname = '';
		$loanOfficerID = $loanOfficerDoc[0]['AskDocument']['loan_officer_id'];
		$shortAppID = $this->getShortAppID($loan_ID);
		$shortAppDetail = $this->ShortApplication->findById($shortAppID);
		//pr($loanOfficerDoc);die;
		//$this->request->data = $this->ChecklistForm->read(null, base64_decode($id));
		$this->set(compact(array('loanOfficerDoc','documentName','loan_ID','ChecklistFormDoc','shortAppID','loanOfficerID','shortAppDetail')));			
	}

    /*
	* short_app_detail function
	* Functionality - short_app_detail dashboard functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function short_app_detail() {
		$this->layout = 'admin';			
	}
    
    /*
	* checklistform function
	* Functionality - checklist form functionality
	* Created date - 7-Aug-2015
	* Developed by -Deepak 
	*/
	
	public function checklist() {
		$this->layout = 'borrower_dashboard';			
	}
	
	 /*
	* register function
	* Functionality -  register functionality
	* Created date - 5-Aug-2015
	* Modified date - 
	*/
	 
	public function register($shortAppID = null) {
		$this->layout = 'page';
		$appID = base64_encode($shortAppID);
		$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication'));
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->User->set($this->request->data['User']);
			$this->UserDetail->set($this->request->data['UserDetail']);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			if($userValidate && $userDetailValidate){
				//Image Upload
				if(!empty($this->request->data['profile_pic'])){
					if(isset($this->request->data['profile_pic']['name']) && $this->request->data['profile_pic']['name'] != ""){
						$file = $this->request->data['profile_pic']['name'];
						$path = 'img/profile_pics';					
						$folder_name = 'original';
						$multiple[] = array('folder_name'=>'thumb','height'=>'355','width'=>'300'); 
						// Code to upload the image
						$response = $this->Common->upload_image($file, $path, $folder_name, true, $multiple);
						// check if filename return or error return
						$is_image_error = $this->Common->is_image_error($response);
						if($response == 'exist_error'){
							$this->Session->setFlash($is_image_error,'error');
						}elseif($response == 'size_mb_error'){
							$this->Session->setFlash($is_image_error,'error');
						}elseif($response == 'type_error'){
							$this->Session->setFlash($is_image_error,'error');
						}else{							
							$flag = true;
							$filename = $response;
							$this->request->data['UserDetail']['profile_pic'] = $filename;	
						}
					}
				}else{
					$filename = 'defaultUser.jpg';
					$this->request->data['UserDetail']['profile_pic'] = $filename;
				}
				$password = $this->request->data['User']['password'];
				$this->request->data['User']['password'] = md5($password);
				if($this->User->save($this->request->data['User'])) {
					$userID = $this->User->id;
					$this->request->data['UserDetail']['user_id'] = $userID;
					$birthDate = '';
					if(count($this->request->data['UserDetail']['date_of_birth'])){
						foreach($this->request->data['UserDetail']['date_of_birth'] as $birth){
							if($birth){
								$birthDate .= $birth.'-';
							}
						}
					}
					unset($this->request->data['UserDetail']['date_of_birth']);
					$this->request->data['UserDetail']['birthdate'] = substr($birthDate,0,-1);
					$this->UserDetail->save($this->request->data['UserDetail']);
					//welcome email notification								
					$hashCode =  md5(uniqid(rand(), true));
					$this->User->saveField('random_key',$hashCode, false);
					$site_URL = Configure::read('BASE_URL');
					$active =  '<a href = "' .$site_URL. '/users/secure_check/'.$hashCode.'">Click to activate your account </a>'; 
					$logo = '<img src="'.$site_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
					$template = $this->EmailTemplate->getEmailTemplate('user_registration');
					$to = $this->request->data['User']['email_address'];
					$emailData = $template['EmailTemplate']['template'];					
					$emailData = str_replace('{FirstName}',ucfirst($this->request->data['User']['first_name']),$emailData);
					$emailData = str_replace('{Email}',$this->request->data['User']['email_address'],$emailData);
					$emailData = str_replace('{Password}',$password,$emailData);
					$emailData = str_replace('{Link}',$active,$emailData);
					$emailData = str_replace('{Logo}',$logo,$emailData);
					$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
					$send_mail = $this->sendEmail($to,$subject,$emailData);
					//User Logs
					$name = $this->request->data['User']['first_name'] .' '. $this->request->data['User']['last_name'];
					$logData['UserLog']['user_id'] = $userID;
					$logData['UserLog']['action'] = 'Registration';
					$logData['UserLog']['description'] = $name . ' registered in Operation trust deed';
					$this->UserLog->save($logData);
					$this->redirect(array('controller'=>'homes','action' => 'thankyou_message'));
				}
			}else{
				$userError = $this->User->validationErrors;
				$userDetailError = $this->UserDetail->validationErrors;
				$this->set('errors',array_merge($userError,$userDetailError));
			}   
		}
		$shortAppDetail = $this->ShortApplication->find('first',array('fields'=>array('applicant_first_name','applicant_last_name','applicant_email_ID','applicant_company_name','applicant_phone'),'conditions'=>array('id'=>$appID)));
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
		$this->set('states',$states);
		$this->set('users',$users);
		$this->set('shortAppDetail',$shortAppDetail);
	} 
	
	public function enquiry($enquiryId) {
		$this->layout = 'dashboard_common';
		$enquiryId = base64_decode($enquiryId);
		$this->loadModel('AskDocument');
		$enquiry = $this->AskDocument->findById($enquiryId);
		$this->set(compact(array('enquiry')));
	}
	
	/**
     * Summary :- getAllNotification
     * @return	NULL
     * Description :- getAllNotification
     */
    
	public function notifications() {
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('Notification')); 
		$userArray = $this->Session->read('userInfo');
		$userID = $userArray['id'];
		$this->paginate['order'] = 'Notification.id DESC';
		$this->paginate['conditions'] = array('Notification.receiver_id' =>$userID);
		$this->Paginator->settings	= $this->paginate;
		$allNotifications =  $this->Paginator->paginate('Notification');
		$this->set(compact(array('allNotifications')));       
	}
	
	/*
	* view soft_quote function
	* Functionality -  view_soft_quote functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
		
	public function view_soft_quote($softQuoteId = null) {
		if($softQuoteId != ''){
			$quoteID = base64_decode($softQuoteId);
			$this->loadAllModel(array('SoftQuote','LoanLog','EmailTemplate','Notification'));
			$this->layout = 'borrower_dashboard';
			$data = $this->SoftQuote->find('first',array('conditions'=>array('SoftQuote.id'=>$quoteID),'fields'=>array('SoftQuote.id','SoftQuote.loan_amount','SoftQuote.short_application_Id','SoftQuote.lien_position','SoftQuote.other_lien_positon','SoftQuote.interest_rate','SoftQuote.loan_term','SoftQuote.business_days','ShortApplication.applicant_first_name','ShortApplication.applicant_last_name','ShortApplication.property_name','ShortApplication.property_address','ShortApplication.property_city','ShortApplication.property_type','ShortApplication.property_state','ShortApplication.loan_objective', 'SoftQuote.created','ShortApplication.applicant_email_ID','ShortApplication.borrower_ID','SoftQuote.origination_fee','SoftQuote.processing_fee')));
			$this->set('data',$data);
		}
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
	* loi function
	* Functionality -  loi functionality
	* Created date - 13-Oct-2015
	* Modified date - 
	*/
		
	public function loi($loanId = null) {
		$this->layout = 'dashboard_common';
		$userData  = $this->Session->read('userInfo');
		$userName = $userData['first_name']. ' '. $userData['last_name'];
		if($loanId != '') {
			 $this->loadAllModel(array('SoftQuote','LoiCondition','CompanyTemplate','LoanLog','Loan','EmailTemplate','Loi','Notification','LoanLog','ShortApplication','LoanPhase','Loi','LoanUser'));
			$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => base64_decode($loanId))));
			$shortAppId = $loanDetail['Loan']['short_app_id'];
			$softQuoteId = $loanDetail['Loan']['soft_quate_id']; 
			$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'pdf_loi')));
			$letterOfIntentPdf = '';
			// Pdf data
			$shortAppDetail = $this->ShortApplication->find('first', array('conditions'=>array('ShortApplication.id'=>$shortAppId),'recursive' =>-1));
			$softQuoteDetail = $this->SoftQuote->find('first', array('conditions'=>array('SoftQuote.id'=>$softQuoteId)));
			$loiCondition = $this->LoiCondition->find('all', array('conditions'=>array('LoiCondition.short_app_id'=>$shortAppId,'LoiCondition.loan_id'=>base64_decode($loanId))));
			$letterOfIntentPdf = $this->Loi->find('first', array('conditions'=>array('Loi.loan_id'=>base64_decode($loanId)),'fields'=> array('Loi.pdf_name')));
			$templateHeader = $this->CompanyTemplate->find('first');
			$this->set('templateHeader', $templateHeader);
			$this->set('pdfTemplate', $pdfTemplate);
			$this->set('letterOfIntentPdf', $letterOfIntentPdf);
			$this->set('loiCondition', $loiCondition);
			$this->set('loanId', $loanId);
			$this->set('softQuoteDetail', $softQuoteDetail);
			$this->set('shortAppDetail', $shortAppDetail);
			$this->set('loanDetail', $loanDetail);
			if(isset($this->request->data) && !empty($this->request->data)) {
				$newLoans = $this->getLoanLifeCyclePhase();
				$loanNumber = $this->Common->getLoanNumber(base64_decode($loanId));
				if(isset($this->request->data['Loi']['signature']) && $this->request->data['Loi']['signature']){
					$pdfName = 'LetterOfIntent_'.$loanId.'.pdf';
					$signature = $this->request->data['Loi']['signature'];
					$this->Loi->updateAll(
						array('Loi.borrower_signed_pdf' => "'$pdfName'"),
						array('Loi.loan_id' => base64_decode($loanId),'Loi.pdf_name' =>$pdfName)
					);
					//Loan Logs
					$shortAppID = $this->getShortAppID(base64_decode($loanId));
					$logData['LoanLog']['user_id'] = $userData['id'];
					$logData['LoanLog']['short_application_ID'] = $shortAppID;
					$logData['LoanLog']['action'] = 13;
					$logData['LoanLog']['description'] = 'Letter of Intent (LOI) - Signed by borrower '.$userName. '<br/><a href="/app/webroot/files/pdf/LetterOfIntent/borrower/'.$pdfName.'" target="_blank" >'.$pdfName.'</a>';
					$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
					$this->LoanLog->save($logData);
					//save notification
					$action = $loanNumber . ' - '.$newLoans['13'] . '<a href="/app/webroot/files/pdf/LetterOfIntent/borrower/'.$pdfName.'" target="_blank">'. $pdfName. '</a>';
					$senderID =  $userData['id'];
					$actionID = base64_decode($loanId);
					$this->Common->saveNotifications($action, $senderID, $actionID);
					//update loan_life_cycle_phase in loan table
					
					$loanCyclephase = 13;
					$this->Loan->id = base64_decode($loanId);
					$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
					//save signed PDF
					$funderDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => base64_decode($loanId),'user_type' => 6),'fields' =>array('LoanUser.user_id')));
			//save funder Todo
					if(!empty($funderDetail)) {
						$toDo = $loanNumber . ' - '.$newLoans['13'] . '<a href="/app/webroot/files/pdf/LetterOfIntent/borrower/'.$pdfName.'" target="_blank">'. $pdfName. '</a>.  <a href="'.BASE_URL.'lois/loi/'.$loanId.'"> Submit LOI</a> to further process loan';
						$notificationData['Notification']['receiver_id'] = $funderDetail['LoanUser']['user_id'];
						$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
						$notificationData['Notification']['action'] = $toDo;
						$notificationData['Notification']['action_id'] = base64_decode($loanId);
						$notificationData['Notification']['type'] = 2;
						$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
						//pr($notificationData);
						$this->Notification->create();
						$this->Notification->save($notificationData);
					}
					
					$this->set('borrower_signature',$this->request->data['Loi']['signature']);
					$this->layout = '/pdf/default';
					$this->render('/Pdf/signed_loi/');
					$this->Session->setFlash('Loi Signed successfully.', 'default', array('class'=>'alert alert-success'));
					$this->redirect(array('controller'=>'borrowers','action' => 'borrowerLoans'));	
				}
			}
			
		}
	}

	/*
	* downloadLOI function
	* Functionality -  downloadLOI
	* Created date - to downloadLOI at borrower dashboard
	*/
		
	public function downloadLOI($loanID = null) {
		$this->autoRender = false;
		$this->layout = '';
		$pdfName = 'LetterOfIntent_'.$loanID.'.pdf';
		$file = WWW_ROOT.'files/pdf/LetterOfIntent'.DS.$pdfName;
		$this->downloadDoc($file);		
	}
	
	/*
	* downloadLOI function
	* Functionality -  downloadLOI
	* Created date - to downloadLOI at borrower dashboard
	*/
		
	public function showLOIUpload(){
		$this->layout = false;
		$this->autoRender = false;
		if(!empty($this->request->data)) {	
			$loanId = isset($this->request->data['loanID'])?base64_decode($this->request->data['loanID']):'';
			$this->set('loanId', $loanId);
			$this->render('/Elements/model_window/upload');
		}		
	}
	
	/*
	* saveSignedLOI function
	* Functionality -  saveSignedLOI functionality
	* Created date - 14-Oct-2015
	* Modified date - 
	*/
	 
	public function saveSignedLOI() {
		$this->layout = 'page';
		$userData  = $this->Session->read('userInfo');
		$userName = $userData['first_name']. ' '. $userData['last_name'];
		$this->loadAllModel(array('Loi','Notification','LoanLog'));
		if(isset($this->request->data) && !empty($this->request->data)) { 
			$loanId = $this->request->data['LOI']['loanId'];
			if(!empty($this->request->data['LOI']['borrower_loi'])){
				if(isset($this->request->data['LOI']['borrower_loi']['name']) && $this->request->data['LOI']['borrower_loi']['name'] != ""){
					$newname = '';
					$tmp = $this->request->data['LOI']['borrower_loi'];
					$str = explode('/',$tmp['type']);
					if($tmp['error']!=0) {
						
						$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
						$flag = 'false';
					} else if($tmp['size'] > 2000000) {
						
						$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
						$flag = 'false';
					} else {
						$parts=pathinfo($tmp['name']);
						$ext=strtolower($parts['extension']);
						$newname = 'LetterOfIntent_'.base64_encode($loanId).rand(00000000001,999999999999).'.'.$ext;
						$file_path = WWW_ROOT."files/pdf/LetterOfIntent/borrower/".$newname;
						if(move_uploaded_file($tmp['tmp_name'], $file_path)) {
							$pdfName = 'LetterOfIntent_'.base64_encode($loanId).'.pdf';
							$currentTime = CURRENT_DATE_TIME_DB;
							$this->Loi->updateAll(
								array('Loi.borrower_upload_loi_pdf' => "'$newname'",'Loi.borrower_pdf_signed_date' =>"'$currentTime'"),
								array('Loi.loan_id' => $loanId,'Loi.pdf_name' =>$pdfName)
							);
							//Loan Logs
							$shortAppID = $this->getShortAppID($loanId);
							$logData['LoanLog']['user_id'] = $userData['id'];
							$logData['LoanLog']['short_application_ID'] = $shortAppID;
							$logData['LoanLog']['action'] = 'Letter of Intent (LOI) - Final Signed by Borrower and Received';
							$logData['LoanLog']['description'] = 'Letter of Intent (LOI) - Final Signed by Borrower and Received'.$userName;
							$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
							$this->LoanLog->save($logData);
							//save notification
							$action = 'Letter of Intent (LOI) - Final Signed by Borrower and Received. Check <a href="'.BASE_URL.'"commons/loan/">loan listing </a> to further process loan';
							$senderID =  $userData['id'];;
							$actionID = $loanId;
							$this->Common->saveNotifications($action, $userId, $actionID);
							//update loan_life_cycle_phase in loan table
							$newLoans = $this->getLoanLifeCyclePhase();
							$loanCyclephase = $newLoans['13'];
							$this->Loan->id = $loanId;
							$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
							$this->redirect(array('controller'=>'borrowers','action' => 'dashboard'));	
						}
					}
				}
			}
		}
	}
	
	/*
	* doc_order_form function
	* Functionality -  doc_order_form functionality
	* Created date - 15-Dec-2015
	* Modified date - 
	*/
		
	public function doc_order_form($loanId = null,$docApprovalID = null) { 
		$this->loadAllModel(array('SoftQuote', 'Review', 'DocOrderForm','ShortApplication','CompanyTemplate', 'EmailTemplate','DocOrderApproval'));
		$this->layout = 'dashboard_common';
		$userData  = $this->Session->read('userInfo');
		$shortAppId = $this->getShortAppID(base64_decode($loanId));
		$userName = $userData['first_name']. ' '. $userData['last_name'];
		$arrDocOrder = $this->DocOrderForm->find('first', array('conditions'=>array('DocOrderForm.loan_id'=>base64_decode($loanId))));
		$softQuoteDetail = $this->SoftQuote->find('first', array('conditions'=>array('SoftQuote.short_application_Id'=>$shortAppId)));
		$arrReview = $this->Review->find('list', array('fields'=>array('Review.column_name', 'Review.column_value'), 'conditions'=>array('Review.loan_id'=>base64_decode($loanId), 'Review.status'=>'1')));
		$templateHeader = $this->CompanyTemplate->find('first');
		$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'doc_order_form')));
		$this->getLoanTypes();
		$this->set('pdfTemplate', $pdfTemplate);
		$this->set('templateHeader', $templateHeader);
		$this->set('sqd', $softQuoteDetail);
		$this->set('arrDocOrder', $arrDocOrder);
		$this->set('reviews', $arrReview);
		$this->set('loanId', $loanId);
		$this->set('docApprovalID',$docApprovalID);
	}
	
	/*
	* show_modal function
	* Functionality -  show_modal to save remarks for approval and denial
	* Created date - 16-Dec-2015
	* Modified date - 
	*/
	
	public function show_modal($shortAppId = null) {
		$this->layout = false;
		$this->autoRender = false;
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		if(!empty($this->request->data)) {	
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
	* save_remarks function
	* Functionality -  save_remarks
	* Created date - 16-Dec-2015
	* Modified date - 
	*/
	
	public function save_doc_order_remarks(){ 
		$this->loadAllModel(array('LoanLog','Notification','ShortApplication','AskDocument','DocOrderApproval'));
		$userData  = $this->Session->read('userInfo');
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
		//updateAll(array $fields, array $conditions) 
		$this->DocOrderApproval->updateAll(
			array('DocOrderApproval.status' => $status,'DocOrderApproval.remarks' => "'".$remarks."'"),
			array('DocOrderApproval.id' => $docID)
		);
		$action = 'Loan Doc Form '. $action .' by borrower - '. $this->request->data['Approval']['remarks'];
		$this->Common->saveNotifications($action, $id, $loanId);
		//Loan Logs
		$logData['LoanLog']['user_id'] = $id;
		$logData['LoanLog']['short_application_ID'] = $shortAppId;
		$logData['LoanLog']['action'] = 'Loan Doc Form '. $action .' by borrower - '. $this->request->data['Approval']['remarks'];
		$logData['LoanLog']['description'] = 'Loan Doc Form '. $action .' by borrower - '. $this->request->data['Approval']['remarks'];
		$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
		$this->LoanLog->save($logData);
		$this->Session->setFlash('Remarks saved successfully. Our team will notify soon.', 'default', array('class'=>'alert alert-success'));
		$this->redirect(array('controller'=>'borrowers','action' => 'dashboard'));		
	}
	
	/*
	* loan function
	* Functionality -  list all loan, for which loan application form is filled
	* Created date - 12-Aug-2015
	* Modified date - 
	*/
	
	public function borrowerLoans() {
		$this->layout = "dashboard_common";
		$this->loadAllModel(array('Loan','State', 'Team', 'TeamAssignment'));
		$userId  = $this->Session->read('userInfo.id');
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$this->set('states',$states);
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		$this->getLoanPhases();
		$this->Loan->bindModel(array(
									'hasMany'=>array(
											'LoanPhase'=>array(
													'className'=>'LoanPhase',
													'fields'=>array('loan_id', 'loan_phase')
													)
											)
									)
							);
		$cond = 'Loan.borrower_id = "'.$userId.'"';
		$this->paginate['order'] = 'Loan.id DESC';
		$this->paginate['recursive'] = 1;
		$this->paginate['conditions'] = $cond;
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('Loan');
		$this->set('allLoans', $getData);
		
	}
}