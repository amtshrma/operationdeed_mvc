<?php
/*
* FundersController class
* Functionality -  Manage the Users (Funders)
* Created date - 9-Jul-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility'); 
class FundersController extends AppController {
	
	var $uses = array('User', 'Team', 'TeamMember', 'LoanLog', 'Notification');
	var $name = 'Funders';
    public $useTable = 'users';
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array();
	
	function beforeFilter() {
		
		$allow = array();
		parent::beforeFilter();    
		$this->checkUserSession($allow,6);   
	}
    
    /*
	* dashboard function
	* Functionality - user dashboard functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function dashboard() {
		
        $this->layout = 'dashboard_common';        
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
	* team_assignment function
	* Functionality - 
	* Created date - 28-Aug-2015
	* Created By - Manish
	*/
	
	function team_assignment($teamId = null) {
		
		$this->layout = 'common';
		
		$userType  = $this->Session->read('userInfo.user_type');
		$userId  = $this->Session->read('userInfo.id');
		
		$arrTeamType = array("broker" =>"2", "smanager"=>"3", "sdirector"=>"4", "processor" => "5");
		
		if($userType!='6') {
			
			$this->Session->setFlash('You are not authorised for team assignment.', 'error');
			$this->redirect(array('controller'=>'funders','action' => 'team_assignment'));
		}
		
		if(!empty($teamId)) { // Existing Team
			
			$teamId = base64_decode(base64_decode($teamId));
		}
		
		$teamFunderCode = '';
		if(empty($teamId)) { // New Team
			
			$count = $this->Team->find('count', array('conditions'=>array('Team.funder_id'=>$userId), 'group'=>'Team.team_funder'));
			$teamFunder = $count + 1;
			$teamFunderCode = 'Team-'.$teamFunder;
		}
		
		// Find Team Data
		$arrTeam = $this->Team->find('first', array('conditions'=>array('Team.id'=>$teamId)));
		$this->set('arrTeam', $arrTeam);
		//pr($arrTeam);
		$arrOptions = array();
		$tmid = array();
		
		if(isset($arrTeam['TeamMember']) && !empty($arrTeam['TeamMember'])) {
			
			foreach($arrTeam['TeamMember'] as $v) {
				
				if($v['status']=='1') {
					
					$memberType = $v['member_type'];
					$arrOptions[$memberType][] = base64_encode(base64_encode($v['team_member_id']));
				}
				
				//
				$teamMemberId = $v['id'];
				$tmid[$teamMemberId] = $v['team_member_id'];
			}			
		}
		
		$this->set('arrOptions', $arrOptions);
		
		// Save Team Data
		
		$data = array();
		$flipArr = array();
		if(!empty($this->request->data) ) {
			
			$i = 0;
			foreach($this->request->data['TeamAssignment'] as $key=>$val) {
				
				if(!empty($this->request->data['TeamAssignment'][$key])) {
					
					if(empty($teamId)) {
						
						$data['Team']['team_funder'] = $teamFunderCode;
						$data['Team']['funder_id'] = $userId;
						
						if($this->Team->save($data['Team'])) {
							
							$teamId = $this->Team->getInsertID();						
						}
					}
					
					foreach($val as $v) {
						
						$teamMemebers['TeamMember']['team_id'] = $teamId;
						$teamMemebers['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
						$memberTypeId = $arrTeamType[$key];
						$memberId = base64_decode(base64_decode($v));
						
						if(!empty($tmid)) {//edit section
							
							if(!in_array($memberId, $tmid)) { //save for new members
								
								$teamMemebers['TeamMember']['member_type'] = $memberTypeId;
								$teamMemebers['TeamMember']['team_member_id'] = $memberId;
								
								$this->TeamMember->create();
								//$this->TeamMember->save($teamMemebers['TeamMember']);
							}
							
							if(in_array($memberId, $tmid)) {
								
								$arrMemberId[] = $memberId;
							}
						} else { // create section
							
							$teamMemebers['TeamMember']['member_type'] = $memberTypeId;
							$teamMemebers['TeamMember']['team_member_id'] = $memberId;
							
							$this->TeamMember->create();
							$this->TeamMember->save($teamMemebers['TeamMember']);
						}
						$i++;
					}
				}
			}
			
			if(!empty($tmid) && !empty($arrMemberId)) {
				
				$arrRemovedMember = array_diff($tmid, $arrMemberId);
				
				foreach($arrRemovedMember as $rid=>$rv) {
					
					$this->TeamMember->id = $rid;
					$this->TeamMember->saveField('status', '0');
				}
			}
			
			$this->redirect(array('controller'=>'funders','action' => 'team_listing'));
		}
	}
	
	/*
	* team_listing function
	* Functionality - 
	* Created date - 01-Sep-2015
	* Created By - Manish
	*/
	
	function team_listing() {
		
		$this->layout = 'common';
		
		$userId  = $this->Session->read('userInfo.id');
		
		// Find Team Data
		$arrTeam = $this->Team->find('all', array('conditions'=>array('Team.funder_id'=>$userId, 'Team.status'=>'1')));
		
		krsort($arrTeam);
		
		$this->getUserTypes();
		$this->set(compact('arrTeam'));
	}
	
	/*
	* loan function
	* Functionality -  list all loan, for which loan application form is filled
	* Created date - 12-Aug-2015
	* Modified date - 
	*/
	
	public function loan() {
		
		$this->layout = ($this->RequestHandler->isAjax()) ? "ajax" : "common";
		$this->loadAllModel(array('Loan','State', 'Team', 'TeamAssignment'));
		
		$userId  = $this->Session->read('userInfo.id');
		
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		$allLoans = $this->Loan->find('all');
		$this->set('allLoans',$allLoans);
		$this->set('states',$states);
		
		// Get Team to assign loan.
		$teams = $this->Team->find('list', array('fields'=>array('Team.id', 'Team.team_funder'), 'conditions'=>array('Team.funder_id'=>$userId, 'Team.status'=>'1'), 'group'=>'Team.team_funder'));
		
		$this->set('teams', $teams);
		
		// Assign Loan to Team.
		if(!empty($this->request->data)) { //if($this->RequestHandler->isAjax()) {
			
			$this->autoRender = false;
			
			if(isset($this->request->data['row']) && !empty($this->request->data['row'])) {
				
				$data['TeamAssignment']['team_id'] =  $this->request->data['teamval'];
				
				$arrLoan = $this->request->data['row'];
				if(!empty($arrLoan)) {
					
					$saveCount = 0;
					foreach($arrLoan as $lid) {
						
						$data['TeamAssignment']['loan_id'] = base64_decode(base64_decode($lid));
						$data['TeamAssignment']['assigned_date'] = CURRENT_DATE_TIME_DB;
						
						$this->TeamAssignment->create();
						if($this->TeamAssignment->save($data)) {
							
							$savedLoans[] = $lid;
							$saveCount = $saveCount + 1;
						}
					}
				}
				
				$loan = ($saveCount>1)?$saveCount.' Loans':$saveCount.' Loan';
				$msg = $loan.' has been assigned successfully.';
				$returnArr = array('message'=>$msg, 'saved_loans'=>$savedLoans);
				return json_encode($returnArr);
				
				$this->Session->setFlash($loan.' has been assigned successfully.', 'success');
				//$this->redirect(array('controller'=>'funders','action' => 'loan'));die('here');
			}
		}
	}
	
	/*
	* review function
	* Functionality -  Funder Review Form
	* Created date - 09-Oct-2015
	* Modified date - 
	*/
	
	function review($loanId = null) { 
		$this->layout = 'dashboard_common';		
		$loanId = base64_decode(base64_decode($loanId));
		$userData  = $this->Session->read('userInfo');
		$newLoans = $this->getLoanLifeCyclePhase();
		$loanNumber = $this->Common->getLoanNumber($loanId);
		$this->loadAllModel(array('Loan', 'LoanDocument','Checklist', 'AskDocument', 'Review', 'ShortApplication', 'LoanPhase','LoanUser'));
		$arrLoanDoc = $this->AskDocument->find('all', array('conditions'=>array('AskDocument.loan_id'=>$loanId)));
		if($arrLoanDoc){
			foreach($arrLoanDoc as $key=>$val){
				if($val['AskDocument']['document_type'] == 'property'){
					$document = $this->Checklist->findById($val['AskDocument']['document_id']);
					if($document){
						$arrLoanDoc[$key]['AskDocument']['document_detail'] = $document['Checklist'];
					}
				}else{
					$document = $this->LoanDocument->findById($val['AskDocument']['document_id']);
					if($document){
						$arrLoanDoc[$key]['AskDocument']['document_detail'] = $document['LoanDocument'];
					}
				}
			}
		}
		$this->set('arrLoanDoc', $arrLoanDoc);
		//$this->Review->id = $loanId;
		//$this->data = $this->Review->read();
		$funderReviews = $this->Review->find('list', array('fields'=>array('Review.column_name', 'Review.column_value'), 'conditions'=>array('Review.loan_id'=>$loanId, 'concern'=>'6')));
		$this->set('funderReviews', $funderReviews);
		if(isset($this->request->data['Review']) && !empty($this->request->data['Review'])) {
			//$loanID = $this->request->data['review']['loanID'];
			//unset($this->request->data['review']['loanID']);
			$this->Review->deleteAll(array('Review.loan_id' => $loanId,'Review.concern' => 6), false);
			foreach($this->request->data['Review'] as $key =>$value) {
				if(!empty($value)) {
					
					$saveReview['Review']['loan_id'] = $loanId;
					$saveReview['Review']['column_name'] = $key;
					$saveReview['Review']['column_value'] = $value;
					$saveReview['Review']['concern'] = 6;
					$saveReview['Review']['user_id'] = $userData['id'];
					//pr($saveReview);die('here');
					$this->Review->create();
					$this->Review->save($saveReview);
				}
			}
			$shortAppID = $this->getShortAppID($loanId);
			//save loan logs
			$logData['LoanLog']['user_id']= $userData['id'];
			$logData['LoanLog']['short_application_ID']= $shortAppID;
			$logData['LoanLog']['action']=  11;
			$logData['LoanLog']['description'] = 'Funder Review - Satisfied Processing Approval';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->create();
			$this->LoanLog->save($logData);
			//save notification for all members
			//$this->Commons = new CommonsController;
			$action = $loanNumber . ' - '.$newLoans['11'];
			$this->Common->saveNotifications($action, $userData['id'], $loanId);
			//save notification
			$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
			$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
			$notificationData['Notification']['sender_id'] = $userData['id'];
			$notificationData['Notification']['action'] = $newLoans['11'];
			$notificationData['Notification']['action_id'] = $loanId;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			$loanPhaseData['LoanPhase']['loan_phase'] = 'E';
			$loanPhaseData['LoanPhase']['loan_id'] = $loanId;
			$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;;
			$this->LoanPhase->save($loanPhaseData);
			//update loan_life_cycle_phase in loan table
			
			$loanCyclephase = 11;
			$alert = $newLoans[$loanCyclephase];
			$this->Loan->id = $loanId;
			$this->Loan->saveField('loan_life_cycle_phase', $loanCyclephase);
			$funderDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanID,'user_type' => 6),'fields' =>array('LoanUser.user_id')));
			//save TODo notification
			if(!empty($funderDetail)) {
				$notificationData['Notification']['receiver_id'] = $funderDetail['LoanUser']['user_id'];
                $notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
                $notificationData['Notification']['action'] = $action .  'Click to <a href="'.BASE_URL.'lois/loi/'.base64_encode($loanID).'">final publish LOI </a>  and further process loan.';;
                $notificationData['Notification']['action_id'] = $loanID;
                $notificationData['Notification']['type'] = 2;
                $notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
                //pr($notificationData);
                $this->Notification->create();
                $this->Notification->save($notificationData);
			}
			$this->Session->setFlash('Funder review has been completed successfully.','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
		}
	}
	
	/*
	* download function
	* Functionality -  Force download document.
	* Created date - 09-Oct-2015
	*/
	
	function downloadDoc($fileName) {
		$this->autoRender = false;
		$file = WWW_ROOT.'upload'.DS.$fileName;
		$this->response->file($file, array('download' => true));
		//Return reponse object to prevent controller from trying to render a view		
		return $this->response;
	}
	
	/*
	* doc_order_form function
	* Functionality - doc order form.
	* Created date - 15-Oct-2015
	*/
	
	function doc_order_form($loanId = null, $action = null) {
		$this->layout = 'dashboard_common';
		$newLoans = $this->getLoanLifeCyclePhase(); 
		$this->loadAllModel(array('Loan','SoftQuote', 'LoanProcessDetail', 'DocOrderForm', 'DocOrderFormDoc', 'ShortApplication', 'DocOrderApproval','LoanHoldRequest','CompanyTemplate', 'EmailTemplate','LoanPhase','TeamMember'));
		$userId  = $this->Session->read('userInfo.id');
		$loanId = base64_decode(base64_decode($loanId));
		// get loan detail
			$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => $loanId),'fields'=>array('Loan.id','Loan.short_app_id','Loan.loan_number','ShortApplication.loan_objective','ShortApplication.loan_amount','ShortApplication.property_address','ShortApplication.borrower_ID','ShortApplication.applicant_phone','Loan.created', 'Loan.soft_quate_id','Loan.team_id')));
		// get soft quote
			$shortAppId = $loanDetail['Loan']['short_app_id'];
			$softQuoteDetail = $this->SoftQuote->find('first', array('conditions'=>array('SoftQuote.short_application_Id'=>$shortAppId)));
		// get loan processing detail
			$loanProcessDetail = $this->LoanProcessDetail->find('first', array('conditions' => array('LoanProcessDetail.loan_id' => $loanId)));
			$loanProcessDetail1 = json_decode($loanProcessDetail['LoanProcessDetail']['detail'], true);
			$arrReview = array_merge($loanProcessDetail['LoanProcessDetail'],$loanProcessDetail1);
		unset($arrReview['detail']);
		$loanNumber = $loanDetail['Loan']['loan_number'];
		$this->set('sqd', $softQuoteDetail);
		$this->set('loanDetail', $loanDetail);
		$this->set('loanId', $loanId);
		$this->set('reviews', $arrReview);
		$this->set('loanNumber', $loanNumber);
		$this->set('upload_url', '/funders/upload_docs');
		if(isset($this->request->data) && !empty($this->request->data)) {
			if(isset($this->request->data['SoftQuote']) && !empty($this->request->data['SoftQuote'])) { 
				$this->request->data['SoftQuote']['id'] = $softQuoteDetail['SoftQuote']['id'];
				$this->request->data['SoftQuote']['short_application_Id'] = $shortAppId;
				$this->SoftQuote->create();						
				$this->SoftQuote->save($this->request->data['SoftQuote']);
			}
			if(isset($this->request->data['ShortApplication']) && !empty($this->request->data['ShortApplication'])) {
				$this->request->data['ShortApplication']['id'] = $shortAppId;
				$this->ShortApplication->create();						
				$this->ShortApplication->save($this->request->data['ShortApplication']);
			}
			if(isset($this->request->data['DocOrderForm']) && !empty($this->request->data['DocOrderForm'])) {
				//$this->request->data['DocOrderForm']['id'] = (isset($arrDocOrder['DocOrderForm']['id']) && !empty($arrDocOrder['DocOrderForm']['id']))?$arrDocOrder['DocOrderForm']['id']:'';
				$this->request->data['DocOrderForm']['id'] = (isset($this->request->data['DocOrderForm']['id']) && !empty($this->request->data['DocOrderForm']['id']))?$this->request->data['DocOrderForm']['id']:'';
				$this->request->data['DocOrderForm']['loan_id'] = $loanId;
				$this->request->data['DocOrderForm']['req_signing_date'] = _dateFormatDB($this->request->data['DocOrderForm']['req_signing_date']);
				//pr($this->request->data['DocOrderForm']);
				$this->DocOrderForm->create();						
				$this->DocOrderForm->save($this->request->data['DocOrderForm']);
				$docOrderFormId = $this->DocOrderForm->id;
			}
			if(isset($this->request->data['Review']) && !empty($this->request->data['Review'])) {
				//$this->request->data['Review']['id'] = $softQuoteDetail['Review']['id'];
				//pr($this->request->data['Review']);
				//$this->Review->create();						
				//$this->Review->save($this->request->data['Review']);
			}
			$userName = $this->Session->read('userInfo.first_name'). ' '. $this->Session->read('userInfo.last_name');
			$teamID = $loanDetail['Loan']['team_id'];
			//$loanDocOrderID = $loanDocOrderID;
			$pdfName = 'doc_order_form_'.base64_encode($loanId).'.pdf';
			$notification = $newLoans['19'];
			//start save loan logs
			$description = $newLoans['19'] .' by '.$userName. '<br/><a href="/app/webroot/files/pdf/doc_order_form/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
			$logData['LoanLog']['user_id']= $this->Session->read('userInfo.id');
			$logData['LoanLog']['short_application_ID']= $shortAppId;
			$logData['LoanLog']['action']= 19;
			$logData['LoanLog']['description'] = $description;
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->create();
			$this->LoanLog->save($logData);
			//end save loan logs
			
			//start save loan phase
			$loanPhaseData['LoanPhase']['loan_phase'] = 'H';
			$loanPhaseData['LoanPhase']['loan_id'] = $loanId;
			$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;;
			$this->LoanPhase->save($loanPhaseData);
			//end save loan phase
			//save notification for all members
			$notificationLink = $loanNumber. ' - ' . $newLoans['19'] .' by '.$userName. '<br/><a href="/app/webroot/files/pdf/doc_order_form/'.$pdfName.'" target="_blank">Review</a>, and <a href="'.BASE_URL.'commons/doc_order_form/'.base64_encode($loanId).'/'.base64_encode($docOrderFormId).'" title="Click here to approve">Approve</a> to further process loan';
			
			$this->Common->saveNotifications($notificationLink, $this->Session->read('userInfo.id'), $loanId);
			//save borrower notification
			$shortAppID = $this->getShortAppID($loanId);
			$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
			$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
			$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
			$notificationData['Notification']['action'] =  $newLoans['19'] . ' by '.$userName. '<br/><a href="/app/webroot/files/pdf/doc_order_form/'.$pdfName.'" target="_blank">Review</a>, and <a href="'.BASE_URL.'commons/doc_order_form/'.base64_encode($loanId).'/'.base64_encode($docOrderFormId).'" title="Click here to approve">Approve</a>';
			$notificationData['Notification']['action_id'] = $loanId;
			$notificationData['Notification']['type'] = 2;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			//save investor notification
			$loanInvestors = $this->LoanHoldRequest->find('all', array('conditions'=>array('LoanHoldRequest.loan_id' => $loanId,'LoanHoldRequest.status' =>1),'fields' =>array('LoanHoldRequest.hold_by')));
			foreach($loanInvestors as $key => $investor) {
				$notificationData['Notification']['receiver_id'] = $investor['LoanHoldRequest']['hold_by'];
				$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
				$notificationData['Notification']['action'] = $newLoans['19'] . ' by '.$userName. '<br/><a href="/app/webroot/files/pdf/doc_order_form/'.$pdfName.'" target="_blank">Review</a>, and <a href="'.BASE_URL.'commons/doc_order_form/'.base64_encode($loanId).'/'.base64_encode($docOrderFormId).'" title="Click here to approve">Approve</a>';
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['action_id'] = $loanId;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
			}
			//update loan_life_cycle_phase in loan table	
			$loanCyclephase = 19;
			$this->Loan->id = $loanId;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			//start save doc_order_approval for borrower, broker, processor and funder.
			$this->save_approval($teamID, $docOrderFormId, $shortAppId, $loanId);
			//end save doc_order_approval for borrower, broker, processor and funder. 
			$templateHeader = $this->CompanyTemplate->find('first');
			$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'doc_order_form')));
			
			$arrDocOrder = $this->DocOrderForm->find('first', array('conditions'=>array('DocOrderForm.loan_id' => $loanId)));
			$this->getLoanTypes();
			$this->set('pdfTemplate', $pdfTemplate);
			$this->set('templateHeader', $templateHeader);
			$this->set('arrDocOrder', $arrDocOrder);
			$this->layout = '/pdf/default';
			$this->render('/Pdf/doc_order_form');
			$this->Session->setFlash('Doc Order Form - Published successfully.','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
		}
	}
	
	/*
	* upload_docs function
	* Functionality - doc order form - upload and save docs.
	* Created date - 19-Oct-2015
	*/
	
	function upload_docs($loanId = null) {
		
		$this->autoRender = false;
		
		if(!empty($this->request->data)) {
			
			$loanId = base64_decode(base64_decode($loanId));			
			
			$tmp = (isset($_FILES['file']) && !empty($_FILES['file']))?$_FILES['file']:'';
			
			if(isset($tmp['name']) && !empty($tmp['name'])) {
				
				$newname = '';
				$flag = false;
				$str = explode('/',$tmp['type']);
				
				$valid  = array('image/jpeg','image/png','image/gif','image/jpg', 'jpeg', 'jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls');
				
				if(!in_array($str[1], $valid)) {
					
					$this->Session->setFlash('Invalid document type!', 'error');
					$flag = false;
					
				} else if($tmp['size'] > 2000000) {
					
					$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
					$flag = 'false';
				} else {
					
					$parts=pathinfo($tmp['name']);
					$ext=strtolower($parts['extension']);
					
					//doc loanId rendom number and file extention
					$newname = 'doc_'.$loanId.'_'.rand(00000000001,999999999999).'.'.$ext;
					
					$file_path = WWW_ROOT."files/doc_order_form/".$newname;
					
					if(move_uploaded_file($tmp['tmp_name'], $file_path)) {
						
						$saveDoc['loan_id'] = $loanId;
						$saveDoc['form_docs'] = $newname;						
						
						$this->loadModel('DocOrderFormDoc');
						$this->DocOrderFormDoc->create();						
						$this->DocOrderFormDoc->save($saveDoc);
						
						$flag = 'true';
					}
				}
			}
			return $newname;
		}
		
		//die('here.');
	}
	/*
	* loan_document function
	* Functionality - loan_document.
	* Created date - 23-Nov-2015
	*/
	function loan_document($loanId = null) {
		$this->layout = 'dashboard_common';	
		$this->loadAllModel(array('SoftQuote', 'Review', 'EmailTemplate', 'DocOrderFormDoc', 'ShortApplication','Loan','TrustDeed'));
		$userData  = $this->Session->read('userInfo');
		$newLoans = $this->getLoanLifeCyclePhase();
		if(!empty($this->request->data)) {  //pr($this->request->data); die();
			$loanID = isset($this->request->data['Loan Document']['loanID'])?base64_decode($this->request->data['Loan Document']['loanID']):'';
			$loanNumber = $this->Common->getLoanNumber($loanID);
			$this->Loan->updateAll(array('loan_life_cycle_phase' =>18), array('Loan.id' => $loanID));
			$shortAppID = $this->getShortAppID($loanID);
			$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
			$logData['LoanLog']['user_id'] = $userData['id'];
			$logData['LoanLog']['short_application_ID'] = $shortAppID;
			$logData['LoanLog']['action'] = $newLoans['18'];
			$logData['LoanLog']['description'] = 'Loan Documents - Conditions Satisfied.';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			
			$this->Common->saveNotifications($loanNumber .' - '. $newLoans['18'], $userData['id'], $loanID);
			//save notification for borrower
			$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
			$notificationData['Notification']['sender_id'] = $userData['id'];
			$notificationData['Notification']['action'] = $newLoans['18'];
			$notificationData['Notification']['action_id'] = $loanID;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			$this->Session->setFlash($newLoans['18'], 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons','action' => 'loan'));
		}
		
		//$this->set('loanId', $loanId);
		//$loanId = base64_decode(base64_decode($loanId));
		$loanDocs = $this->EmailTemplate->find('all', array('conditions' => array('EmailTemplate.template_type' => 'loan_doc'),'fields'=>array('EmailTemplate.id','EmailTemplate.name')));
		$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => base64_decode($loanId)),'fields'=>array('ShortApplication.borrower_ID','	ShortApplication.applicant_phone')));
		$propertyDetail = $this->TrustDeed->find('first', array('conditions' => array('TrustDeed.loan_id' => base64_decode($loanId)),'fields'=>array('TrustDeed.*')));
		
		//pr($loanDetail); die();
		$this->set('loanDocs', $loanDocs);
		$this->set('propertyDetail', $propertyDetail);
		$this->set('loanDetail', $loanDetail);
		$this->set('loanId', $loanId);
		//$this->layout = '/pdf/default';
		//$this->render('/Pdf/gfe');
	}
	
	/*
	* save_approval function
	* Functionality - loan_document.
	* Created date - 23-Nov-2015
	*/
	function save_approval($teamID = null, $loanDocOrderID = null, $shortAppId = null, $loanId = null) {
		$this->layout = '';
		$this->autoRender = false;
		$userData  = $this->Session->read('userInfo');
		if(!empty($teamID)) {
			$userTypeArray = array('2','5'); 
			$notifyUser = $this->TeamMember->find('all',array('conditions'=>array('TeamMember.team_id'=>$teamID, 'TeamMember.member_type' => $userTypeArray, 'TeamMember.team_member_id !='=> $userData['id']),'fields' => array('TeamMember.team_member_id')));
			//pr($notifyUser); die();
			$detail = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppId),'fields' =>array('ShortApplication.borrower_ID')));
			$notification = 'Doc Order Form - Published';
			foreach($notifyUser as $receiver) { 
				//save Notification
				$data['DocOrderApproval']['doc_order_form_id'] = $loanDocOrderID;
				$data['DocOrderApproval']['loan_id'] = $loanId;
				$data['DocOrderApproval']['receiver_id'] = $receiver['TeamMember']['team_member_id'];
				$data['DocOrderApproval']['sender_id'] = $userData['id'];
				$data['DocOrderApproval']['created'] = CURRENT_DATE_TIME_DB;
				$this->DocOrderApproval->create();
				$this->DocOrderApproval->save($data);
				$docOrderApproval = $this->DocOrderApproval->id;
			}
		}
		// save borrower approval
		$approvalData['DocOrderApproval']['doc_order_form_id'] = $loanDocOrderID;
		$approvalData['DocOrderApproval']['loan_id'] = $loanId;
		$approvalData['DocOrderApproval']['receiver_id'] = $detail['ShortApplication']['borrower_ID'];
		$approvalData['DocOrderApproval']['sender_id'] = $userData['id'];
		$approvalData['DocOrderApproval']['created'] = CURRENT_DATE_TIME_DB;
		$this->DocOrderApproval->create();
		$this->DocOrderApproval->save($approvalData);
		$borrowerApprovalID = $this->DocOrderApproval->id;
		// save investor approval
		$loanInvestors = $this->LoanHoldRequest->find('all', array('conditions'=>array('LoanHoldRequest.loan_id' => $loanId,'LoanHoldRequest.status' =>1),'fields' =>array('LoanHoldRequest.hold_by')));
		foreach($loanInvestors as $key => $investor) {
			$approvalData['DocOrderApproval']['doc_order_form_id'] = $loanDocOrderID;
			$approvalData['DocOrderApproval']['loan_id'] = $loanId;
			$approvalData['DocOrderApproval']['receiver_id'] = $investor['LoanHoldRequest']['hold_by'];
			$approvalData['DocOrderApproval']['sender_id'] = $userData['id'];
			$approvalData['DocOrderApproval']['created'] = CURRENT_DATE_TIME_DB;
			$this->DocOrderApproval->create();
			$this->DocOrderApproval->save($approvalData);
		}
		
	}
	
	/*
	* notify_funder
	* Functionality -   notify funder to futher process loan
	* Created date - 12-Jul-2016
	* Modified date - 
	*/
	
	public function approve_all_counter_offer($loanId = null) {
		$this->loadAllModel(array('CounterOffer'));
		$this->layout = false;
		$this->autoRender = false;
		$msg = 'Trust Deed Investor - Conditions satisfied';
		if(!empty($loanId)){
			$newLoans = $this->getLoanLifeCyclePhase();
			$loanID = isset($loanId)?base64_decode($loanId) : '';
			$shortAppID = $this->getShortAppID($loanID);
			$loanNumber = $this->Common->getLoanNumber($loanID);
			//update all counter Offer
			$this->CounterOffer->updateAll(array('status' =>'2'), array('loan_id' => $loanID));
			$this->Common->approveInvestorCounterOffer($loanID, $loanNumber, $shortAppID, $newLoans['17']);
		}
		$this->Session->setFlash($msg, 'default', array('class'=>'alert alert-success'));
		$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
	}
}