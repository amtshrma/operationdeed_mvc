<?php
/*
* ProcessorsController class
* Functionality -  Manage the Users (Processors)
* Created date - 9-Jul-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility');

class ProcessorsController extends AppController {
	
	var $name = 'Processors';
    public $useTable = 'users';
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array();
	
	function beforeFilter() {
		ini_set('memory_limit', '256M');
		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		$this->layout = 'dashboard_common';
		$allow = array('generateTil','disclosure_statement','disclosure_statement_step2','disclosure_statement_step3','disclosure_statement_step4');
		parent::beforeFilter();    
		$this->checkUserSession($allow);
	}  
	
	/*
	* review function
	* Functionality - Processor Review
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function review($loanID = null) {
		$this->loadAllModel(array('Review','State','LoanLog','Notification','ShortApplication','LoanPhase','LoanProcessDetail','Loan','Todo','LoanUser'));
		$newLoans = $this->getLoanLifeCyclePhase();
		$loanID = base64_decode($loanID);
		$loanInfo = $this->getLoanInfo($loanID);
		if(isset($this->request->data) && !empty($this->request->data)) {
			$loanID = $this->request->data['review']['loanID'];
			unset($this->request->data['review']['loanID']);
			$this->Review->deleteAll(array('Review.loan_id' => $loanID,'Review.concern' => 5), false);
			foreach($this->request->data['review'] as $key =>$value) {
				if(!empty($value)){
					$saveReview['Review']['loan_id'] = $loanID;
					$saveReview['Review']['column_name'] = $key;
					$saveReview['Review']['column_value'] = $value;
					$saveReview['Review']['concern'] = 5;
					$saveReview['Review']['user_id'] = $this->Session->read('userInfo.id');
					$this->Review->create();
					$this->Review->save($saveReview);
				}
			}
			// save loan log
				$logData['LoanLog']['user_id']= $this->Session->read('userInfo.id');
				$logData['LoanLog']['short_application_ID']= $loanInfo['short_app_id'];
				$logData['LoanLog']['action']= 10;
				$logData['LoanLog']['description'] = 'Processor Review - Satisfied Processing Approval';
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->create();
				$this->LoanLog->save($logData);
			//save notification for all members
				$action = $loanInfo['loan_number'].' - '.$newLoans['10'];
				$this->Common->saveNotifications($action, $this->Session->read('userInfo.id'), $loanID);
			//save to borrowe notification
				$notificationData['Notification']['receiver_id'] = $loanInfo['borrower_id'];
				$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
				$notificationData['Notification']['action'] = $action;
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
			// update loan phase
				$loanPhaseData['LoanPhase']['loan_phase'] = 'D';
				$loanPhaseData['LoanPhase']['loan_id'] = $loanID;
				$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanPhase->save($loanPhaseData);
			//update loan_life_cycle_phase in loan table
				$loanCyclephase = $newLoans['10'];
				$this->Loan->id = $loanID;
				$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			//save Todo funder - funder review
				$funderDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanID,'user_type' => 6),'fields' =>array('LoanUser.user_id')));
			//save funder Todo
				if(!empty($funderDetail)) {
					$toDo = $action . ' Click to <a href="'.BASE_URL.'funders/review/'.base64_encode(base64_encode($loanID)).'">submit review</a>  and further process loan';
					$notificationData['Notification']['receiver_id'] = $funderDetail['LoanUser']['user_id'];
					$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
					$notificationData['Notification']['action'] = $toDo;
					$notificationData['Notification']['action_id'] = $loanID;
					$notificationData['Notification']['type'] = 2;
					$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
					//pr($notificationData);
					$this->Notification->create();
					$this->Notification->save($notificationData);
				}
			$this->Session->setFlash('Processor Review - Satisfied Processing Approval has been done successfully.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));			
		}
		// get loan processor detail
		$loanProcessDetail = $this->LoanProcessDetail->find('first', array('conditions' => array('LoanProcessDetail.loan_id' => $loanID)));
		$loanProcessDetail1 = json_decode($loanProcessDetail['LoanProcessDetail']['detail'], true);
		$processDetail = array_merge($loanProcessDetail['LoanProcessDetail'],$loanProcessDetail1);
		unset($processDetail['detail']);
		// get short app detail
		$shortApplicationData = $this->ShortApplication->find('first', array('conditions' => array('ShortApplication.id' => $loanInfo['short_app_id']),'fields'=>'ShortApplication.loan_amount, SoftQuote.interest_rate, SoftQuote.monthly_payment','recursive'=>-2));
		$this->set(compact(array('loanID','processDetail','shortApplicationData')));
	}
   	/*
	* review_document function
	* Functionality - review checklist submitted by broker
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function review_document($loanID = null) {
		$this->loadAllModel(array('AskDocument','State','LoanLog','Notification','ShortApplication','LoanPhase','Loan','LoanUser'));
		$loanID = base64_decode($loanID);
		$userData  = $this->Session->read('userInfo');
		$allDocuments = $this->AskDocument->find('all',array('conditions'=>array('loan_id'=>$loanID)));
		if(isset($this->request->data) && !empty($this->request->data)) { 
			if(!empty($this->request->data['checklist']['type'])){
				foreach($this->request->data['checklist']['type'] as $key=>$val){
					$postData = array();
					$postData['Checklist']['loan_id'] = base64_encode($loanID);
					$postData['Checklist']['type'] = $val;
					$postData['Checklist']['document'] = $this->request->data['checklist']['document'][$key];
					$postData['Checklist']['checklistname'] = $this->request->data['checklist']['checklistname'][$key];
					$this->Common->uploadAdditionalChecklist($postData);
				}
			}
			//update loan_life_cycle_phase in loan table
			$newLoans = $this->getLoanLifeCyclePhase();
			$loanCyclephase = 4;
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			//save notification to broker
			$brokerDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanID,'user_type' => 2),'fields' =>array('LoanUser.user_id')));
			if(!empty($brokerDetail)) {
				$shortAppID = $this->getShortAppID($loanID);
				$notificationData['Notification']['receiver_id'] = $brokerDetail['LoanUser']['user_id'];
				$notificationData['Notification']['sender_id'] = $userData['id'];
				$notificationData['Notification']['action'] = 'Additional document requested by processor.<a href="'.BASE_URL.'commons/ask_document/'.base64_encode($shortAppID).'/'.base64_encode($loanID).'">Click </a> to request to borrower';
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
			}
			$this->Session->setFlash('Additional Checklist sent to broker.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'processors', 'action'=>'review_document/'.base64_encode($loanID)));			
		}
		$this->set('loanID',$loanID);
		$this->set('allDocuments',$allDocuments);
    }
	
	/*
	* disclosure_statement function
	* Functionality - to fill  MLDS- GFE statement
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function disclosure_statement($loanID = null) {
		$this->loadAllModel(array('Loan','User'));
		$loanID = base64_decode($loanID);
		$this->Session->write('GFE_Loan_id',$loanID);
		$loanDetail = $this->Loan->findById($loanID);
		$borrowerDetail = $this->User->findById($loanDetail['Loan']['borrower_id']);
		if($this->request->data){
			$this->Session->write('GFE.GFEStep1', $this->request->data);
			$this->redirect(array('controller'=>'processors','action'=>'disclosure_statement_step2'));
		}else{
			$this->request->data = $this->Session->read('GFE.GFEStep1');
		}
		$this->set(compact(array('loanID','loanDetail','borrowerDetail')));
    }
	
	/*
	* disclosure_statement function
	* Functionality - to fill  MLDS- GFE statement
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function disclosure_statement_step2() {
		if($this->request->data){
			$this->Session->write('GFE.GFEStep2', $this->request->data);
			$this->redirect(array('controller'=>'processors','action'=>'disclosure_statement_step3'));
		}else{
			$this->request->data = $this->Session->read('GFE.GFEStep2');
		}
    }
	
	/*
	* disclosure_statement function
	* Functionality - to fill  MLDS- GFE statement
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function disclosure_statement_step3() {
		$this->loadAllModel(array('Loan','User','ShortApplication','ProcessorDocument'));
		$brokerDetail = '';
		$loanID = $this->Session->read('GFE_Loan_id');
		if($this->request->data){
			$this->Session->write('GFE.GFEStep3', $this->request->data);
			$data = $this->Session->read('GFE');
			$saveData['gfe'] = json_encode($data);
			$saveData['processor_id'] = $this->Session->read('userInfo.id');
			$saveData['loan_id'] = $loanID;
			$this->ProcessorDocument->save($saveData);
			$this->set('data',$data);
			$this->layout = '/pdf/default';
			$this->render('/Pdf/gfe');
			$this->Session->setFlash('Disclosure statement submit successfully.','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'processors', 'action'=>'generateTil/',base64_encode($loanID)));
		}else{
			$this->request->data = $this->Session->read('GFE.GFEStep3');
		}
		$loanDetail = $this->Loan->findById($loanID);
	
		//$shortApplication = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id'=>$loanDetail['Loan']['short_app_id']),'recursive'=>-1));
		$shortApplication = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id'=>$loanDetail['Loan']['short_app_id']),'fields' =>array('ShortApplication.broker_ID','ShortApplication.broker_ID','SoftQuote.id','ShortApplication.loan_amount','SoftQuote.interest_rate')));
		
		if(!empty($shortApplication['ShortApplication']['broker_ID'])){
			if($shortApplication['ShortApplication']['broker_ID'] == 'Rockland'){
				$brokerDetail['User']['name'] = 'Rockland';
			}else{
				$brokerDetail = $this->User->findById($shortApplication['ShortApplication']['broker_ID']);
			}
		}
		$this->set(compact(array('loanDetail','brokerDetail','shortApplication')));
    }
	
	/*
	* disclosure_statement function
	* Functionality - to fill  MLDS- GFE statement
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function generateGFEPDF(){
		$this->autoRender = false;
		$data = $this->Session->read('GFE');
		$this->set('data',$data);
		//pr($data);die;
		$this->layout = '/pdf/default';
		$this->render('/Pdf/gfe');	
	}
	
	public function disclosure_statement_step4() {
		$this->loadAllModel(array('AskDocument','Loan'));
		if($this->request->data){
			pr($this->request->data);die;
			$this->Session->setFlash('Disclosure statement submit successfully.','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons','action'=>'loan'));
		}
	}
	
	/*
	* review_document function
	* Functionality - review checklist submitted by broker
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function send_disclosure($loanID = null) {
		$this->loadAllModel(array('DisclosureApproval','LoanLog','Notification','ShortApplication','LoanPhase','Loan','LoanUser'));
		$loanID = base64_decode($loanID);
		$userData  = $this->Session->read('userInfo');
		$processorDocuments = $this->Common->processor_document();
		if(isset($this->request->data) && !empty($this->request->data)) { 
			// save processor Id in table loan_users
			$this->Common->updateLoanUser($loanID, $this->Session->read('userInfo.user_type'),$this->Session->read('userInfo.id'));
			$shortAppID = $this->getShortAppID($loanID);
			$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID'),'recursive'=>-1));
			$brokerDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanID,'user_type' => 2),'fields' =>array('LoanUser.user_id')));
			foreach($this->request->data['document'] as $key =>$document) {
				//save disclosure to  broker User ID
				$approvalData['DisclosureApproval']['sender_id'] = $userData['id'];
				$approvalData['DisclosureApproval']['receiver_id'] = $brokerDetail['LoanUser']['user_id'];
				$approvalData['DisclosureApproval']['document'] = $document;
				$approvalData['DisclosureApproval']['loan_id'] = $loanID;
				$approvalData['DisclosureApproval']['created'] = CURRENT_DATE_TIME_DB;
				$this->DisclosureApproval->create();
				$this->DisclosureApproval->save($approvalData);
				//save disclosure to  borrower User ID
				$approvalData['DisclosureApproval']['sender_id'] = $userData['id'];
				$approvalData['DisclosureApproval']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
				$approvalData['DisclosureApproval']['document'] = $document;
				$approvalData['DisclosureApproval']['loan_id'] = $loanID;
				$approvalData['DisclosureApproval']['created'] = CURRENT_DATE_TIME_DB;
				$this->DisclosureApproval->create();
				$this->DisclosureApproval->save($approvalData);
				
			}
			$newLoans = $this->getLoanLifeCyclePhase();
			// save disclosure notification to broker and borrower
			$loanNumber = $this->Common->getLoanNumber($loanID);
			
			$action =  $loanNumber . ' - '.$newLoans['6A'].'. Click to <a href="'.BASE_URL.'commons/view_disclosure/'.base64_encode($loanID).'">review and approve</a>';
			//save borrower disclosure notification
			$this->Common->saveBorrowerNotification($action, $userData['id'], $loanID);
			//save broker disclosure notification
			$this->Common->saveBrokerNotification($action, $userData['id'], $loanID);
			
			//update loan_life_cycle_phase in loan table
			
			$loanCyclephase = '6A';
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			$this->Session->setFlash('Loan Disclosure sent to broker and borrower.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));			
		}
		$this->set('loanID',$loanID);
		$this->set('processorDocuments',$processorDocuments);	
    }
	
	/*
	* notify_funder
	* Functionality -   notify funder to futher process loan
	* Created date - 12-Jul-2016
	* Modified date - 
	*/
	
	public function notify_funder($loanID = null) {
		$this->loadAllModel(array('LoanPhase','Loan','Notification'));
		$this->layout = false;
		$this->autoRender = false;
		$msg = 'There is some error please process again';
		if(!empty($loanID)){
			//$loanID = base64_decode($loanID);
			//update loan_life_cycle_phase in loan table
			$newLoans = $this->getLoanLifeCyclePhase();
			$loanCyclephase = 7;
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			$loanStatus = $this->LoanPhase->find('first',array('conditions'=>array('LoanPhase.loan_id'=>$loanID, 'LoanPhase.loan_phase' => 'B')));
			if(empty($loanStatus)) {
				$loanPhaseData['LoanPhase']['loan_phase'] = 'B';
				$loanPhaseData['LoanPhase']['loan_id'] = $loanID;
				$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanPhase->save($loanPhaseData);
			}
			$funderId = $this->Common->getTeamMember($this->Session->read('userInfo.id'), 6);
			if(!empty($funderId)) {
				$notificationData['Notification']['receiver_id'] = $funderId;
				$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
				$notificationData['Notification']['action'] = $newLoans['7'] .'<a href="'.BASE_URL.'commons/trust_deed/'.base64_encode($loanID).'">  Check </a> to further process loan';
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
		
				$msg = 'Request Sent to funder to review loan';
			}
		}
		$this->Session->setFlash($msg, 'default', array('class'=>'alert alert-success'));
		$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
	}
	
	/*
	* notify_funder
	* Functionality -   generateTil
	* Created date - 12-Jul-2016
	* Modified date - 
	*/
	
	function generateTil($loanId = null){
		$this->loadAllModel(array('ProcessorDocument','Loan'));
		$loanId = base64_decode($loanId);
		$this->set('loanId',$loanId);
		$this->set('loanNumber',$this->Common->getLoanNumber($loanId));
		if($this->request->data){
			$processorDoucment = $this->ProcessorDocument->find('first',array('conditions'=>array('loan_id'=>$loanId)));
			if($processorDoucment){
				$processorDoucment['ProcessorDocument']['til'] = json_encode($this->request->data);
				$this->ProcessorDocument->save($processorDoucment);
			}
			$this->set('data',$this->request->data);
			$this->layout = '/pdf/default';
			$this->render('/Pdf/til');
			$this->Session->setFlash('Review Loan Document is ready','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'processors', 'action'=>'send_disclosure/'.base64_encode($loanId)));
		}
		$loanDetail = $this->Loan->findById($loanId);
		$loanNumber = $this->Common->getLoanNumber($loanId);
		$this->set('loanDetail',$loanDetail);
		$this->set('loanNumber',$loanNumber);
	}

}