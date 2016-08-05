<?php
/*
* Loans Controller class
* Functionality -  Loan Signing
* Created date - 9-Nov-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility');
class LoansController extends AppController {
	
	//var $uses = array();
	//var $name = 'Commons';
	
	var $uses = array('User', 'short_applications', 'LoanLog', 'Notification');
	var $components = array('Email','Cookie','Common','Paginator', 'CustomEmail', 'RequestHandler', 'Session');
	var $helpers = array('Common');
	
	public $paginate = array(
						'limit' => 10,
						'order' => array(
							'short_applications.id' => 'DESC'
						)
					);
	
	function beforeFilter(){
		$allow = array();
		parent::beforeFilter();
		$this->checkUserSession($allow);
	}
    
    public function lender_instruction($loanId = null) {
		$this->loadAllModel(array('SoftQuote', 'Review', 'EmailTemplate', 'DocOrderFormDoc', 'ShortApplication','Loan','TrustDeed','CompanyTemplate'));
        $templateHeader = $this->CompanyTemplate->find('first');
        $pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'lender_instructions')));
		$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => base64_decode($loanId)),'fields'=>array('Loan.id','Loan.purpose_of_loan','Loan.loan_amount','Loan.address','ShortApplication.borrower_ID','ShortApplication.applicant_phone')));
		$allReviews = $this->Review->find('list', array('conditions' => array('Review.loan_id' => base64_decode($loanId)),'fields'=>'column_name,column_value'));
		$propertyDetail = $this->TrustDeed->find('first', array('conditions' => array('TrustDeed.loan_id' => base64_decode($loanId)),'fields'=>array('TrustDeed.*')));
		$this->set('pdfTemplate', $pdfTemplate);
		$this->set('propertyDetail', $propertyDetail);
		$this->set('loanDetail', $loanDetail);
		$this->set('loanId', $loanId);
		$this->set('allReviews', $allReviews);
		$this->layout = '/pdf/default';
		$this->render('/Pdf/lender_instruction');
    }
	
	function loan_listing() {
		if($this->RequestHandler->isAjax()){
			$this->layout='ajax'; 
		}else{
			$this->layout = 'common';  
		}
		$this->loadAllModel(array('Loan'));
		$this->getLoanTypes();
		$this->getLoanStatus();
		$this->getStatusClass();
		$criteria = '1';
		if(!empty($this->params)) {
			if(!empty($this->params->query['search']) && isset($this->params->query['search'])) {
				$value = trim($this->params->query['search']);
				$criteria .= " AND (Loan.loan_amount LIKE '%".$value."%' OR Loan.state LIKE '%".$value."%' OR Loan.city LIKE '%".$value."%' OR Loan.proprty_type LIKE '%".$value."%')";
			}
			//	$ldvalue = trim($this->params->query['search_by_loan_date']);
			//	$criteria .= " AND (Loan.created LIKE '%"._dateFormatDB($ldvalue)."%')";
			
			if(isset($this->params->query['search_by_loan_status']) && $this->params->query['search_by_loan_status'] >= '0') {
				
				$statusValue = trim($this->params->query['search_by_loan_status']);
				$criteria .= " AND (Loan.status = '".$statusValue."')";
			}
		}
		//pr($this->params->query);pr($criteria);die;
		$this->paginate['conditions'] = array($criteria);
		$this->Paginator->settings	= $this->paginate;
		$this->paginate['fields'] = array('Loan.id', 'Loan.short_app_id', 'Loan.borrower_id', 'Loan.loan_amount', 'Loan.proprty_type', 'Loan.city', 'Loan.state', 'Loan.status', 'ShortApplication.id', 'ShortApplication.loan_type', 'ShortApplication.broker_ID');
		$this->Paginator->settings	= $this->paginate;
		$arrLoan = $this->Paginator->paginate('Loan');//pr($arrLoan);
		$this->set('loans', $arrLoan);
		if($this->RequestHandler->isAjax()){
			$this->render('/Elements/users/loan_listings');
			return;
		}
	}
	
	public function trust_in_lending($loanId = null) {
		$this->loadAllModel(array('Loan','CompanyTemplate','EmailTemplate'));
        $templateHeader = $this->CompanyTemplate->find('first');
        $pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'til')));
		$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => base64_decode($loanId)),'fields'=>array('Loan.id','Loan.purpose_of_loan','Loan.loan_amount','Loan.address','Loan.created','ShortApplication.borrower_ID','ShortApplication.applicant_phone')));
        $this->set('pdfTemplate', $pdfTemplate);
		$this->set('loanDetail', $loanDetail);
        $this->set('templateHeader', $templateHeader);
		$this->set('loanId', $loanId);
        $this->layout = '/pdf/default';
        $this->render('/Pdf/trust_in_lending');
    }

	/*
	* gfe function
	* Functionality - show gfe document
	* Created date - 23-Nov-2015
	*/

	function gfe($loanId = null) { 
		$this->loadAllModel(array('SoftQuote', 'Review', 'EmailTemplate', 'DocOrderFormDoc', 'ShortApplication','Loan','TrustDeed'));
		$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'good_faith_estimate%')));
		$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => base64_decode($loanId)),'fields'=>array('Loan.id','ShortApplication.loan_objective','ShortApplication.loan_amount','ShortApplication.property_address','ShortApplication.borrower_ID','ShortApplication.applicant_phone','Loan.created', 'Loan.soft_quate_id')));
		$softQuoteID = $loanDetail['Loan']['soft_quate_id'];
		$propertyDetail = $this->TrustDeed->find('first', array('conditions' => array('TrustDeed.loan_id' => base64_decode($loanId)),'fields'=>array('TrustDeed.*')));
		$softQuoteDetail = $this->SoftQuote->find('first', array('conditions' => array('SoftQuote.id' => $softQuoteID),'fields'=>array('SoftQuote.monthly_payment','SoftQuote.loan_term','SoftQuote.interest_rate','SoftQuote.origination_fee','SoftQuote.processing_fee','SoftQuote.lender_fees','SoftQuote.borker_fees','SoftQuote.other_fees')));
		$this->set('pdfTemplate', $pdfTemplate);
		$this->set('propertyDetail', $propertyDetail);
		$this->set('loanDetail', $loanDetail);
		$this->set('softQuoteDetail', $softQuoteDetail);
		$this->set('loanId', $loanId);
		$this->layout = '/pdf/default';
		$this->render('/Pdf/gfe');
	}
	
	/*
	* escrow_document function
	* Functionality - show document uploaded by escrow
	* Created date - 22-Dec-2015
	*/
	
	function escrow_document($loanId = null) {
		$this->layout = 'dashboard_common';
		$newLoans = $this->getLoanLifeCyclePhase();
		$this->loadAllModel(array('EscrowDocument', 'Loan','LoanLog'));
		if(isset($this->request->data) && !empty($this->request->data)) { //pr($this->request->data);
			$loanId = base64_decode($this->request->data['Loan Document']['loanID']);
			$escrowId = $this->Common->getLoanEscrowID($loanId);
			$loanNumber = $this->Common->getLoanNumber($loanId);
			//funder approve escrow uploaded loan document
			$loanCyclephase = '20A';
			$this->Loan->id = $loanId;
			$this->Loan->saveField('loan_life_cycle_phase', $loanCyclephase);
			//save notification for all members
			$action = $loanNumber . ' - '. $newLoans['20A'];
			$this->Common->saveNotifications($action, $this->Session->read('userInfo.id'), $loanId);
			//save notification to escrow
			$investorNotification['Notification']['receiver_id'] = $escrowId;
			$investorNotification['Notification']['sender_id'] = $this->Session->read('userInfo.id');
			$investorNotification['Notification']['action'] =  $action;
			$investorNotification['Notification']['action_id'] = $loanId;
			$investorNotification['Notification']['type'] = 2;
			$investorNotification['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($investorNotification);
			//save loan log
			$shortAppID = $this->getShortAppID($loanId);
			$logData['LoanLog']['user_id']= $this->Session->read('userInfo.id');;
			$logData['LoanLog']['short_application_ID']= $shortAppID;
			$logData['LoanLog']['action']= '20A';
			$logData['LoanLog']['description'] = '20A';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->create();
			$this->LoanLog->save($logData);
			
			$this->Session->setFlash($newLoans['20A'], 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons','action' => 'loan'));
			//$fundingNumber = $this->Common->calculateFundingNumber(base64_decode($loanId));
		}
		$escrowsDocuments = $this->EscrowDocument->find('all',array('conditions'=>array('EscrowDocument.loan_id'=>base64_decode($loanId))));
		$this->set('escrowsDocuments',$escrowsDocuments);
		$this->set('loanId',$loanId);
	}
	
	/*
	* arbitration_agreement function
	* Functionality - show Arbitration Agreement document
	* Created date - 18-Jul-2016
	*/

	function create_pdf($loanId = null, $documentID = null) { 
		$this->loadAllModel(array('SoftQuote', 'Review', 'EmailTemplate', 'DocOrderFormDoc', 'ShortApplication','Loan','TrustDeed'));
		$pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => base64_decode($documentID))));
		$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => base64_decode($loanId)),'fields'=>array('Loan.id','ShortApplication.loan_objective','ShortApplication.loan_amount','ShortApplication.property_address','ShortApplication.borrower_ID','ShortApplication.applicant_phone','Loan.created', 'Loan.soft_quate_id')));
		//pr($loanDetail); die();
		$softQuoteID = $loanDetail['Loan']['soft_quate_id'];
		$propertyDetail = $this->TrustDeed->find('first', array('conditions' => array('TrustDeed.loan_id' => base64_decode($loanId)),'fields'=>array('TrustDeed.*')));
		$softQuoteDetail = $this->SoftQuote->find('first', array('conditions' => array('SoftQuote.id' => $softQuoteID),'fields'=>array('SoftQuote.monthly_payment','SoftQuote.loan_term','SoftQuote.interest_rate','SoftQuote.origination_fee','SoftQuote.processing_fee','SoftQuote.lender_fees','SoftQuote.borker_fees','SoftQuote.other_fees')));
		$this->set('pdfTemplate', $pdfTemplate);
		$this->set('propertyDetail', $propertyDetail);
		$this->set('loanDetail', $loanDetail);
		$this->set('softQuoteDetail', $softQuoteDetail);
		$this->set('loanId', $loanId);
		$this->layout = '/pdf/default';
		$this->render('/Pdf/loan_doc');	
	}
	
	/*
	* view_loan_document function
	* Functionality - view_loan_document
	* Created date - 28-Jul-2016
	*/

	function view_loan_document($loanId = null, $approvalID = null) { 
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('EscrowDocument','EscrowDocApproval'));
		$escrowsDocuments = $this->EscrowDocument->find('all', array('conditions'=>array('EscrowDocument.loan_id'=>base64_decode($loanId))));
		$approvalData = $this->EscrowDocApproval->find('first', array('conditions'=>array('EscrowDocApproval.id'=>base64_decode($approvalID))));
		$this->set('loanId',$loanId);
		$this->set('approvalID', $approvalID);
		$this->set('escrowsDocuments',$escrowsDocuments);
		$this->set('approvalData',$approvalData);
	}
	
	/*
	* save_user_action function
	* Functionality - save_user_action on escrow final document
	* Created date - 29-Jul-2016
	*/

	function save_user_action() {
		$this->layout = false;
		$this->autoRender = false;
		$this->loadAllModel(array('LoanLog','Notification','EscrowDocApproval','Loan'));
		$newLoans = $this->getLoanLifeCyclePhase();
		if(isset($this->request->data) && !empty($this->request->data)) { 
			$status = isset($this->request->data['status']) ? $this->request->data['status'] : '';
			$loanId = isset($this->request->data['loanID']) ?  base64_decode($this->request->data['loanID']) : '';
			$approvalID = isset($this->request->data['approvalID']) ? base64_decode($this->request->data['approvalID']) : '';
			$this->EscrowDocApproval->updateAll(array('status' =>$status), array('id' => $approvalID));
			$deniedCount = $this->EscrowDocApproval->find('count', array('conditions'=>array('EscrowDocApproval.loan_id' => $loanId,'EscrowDocApproval.status IN' =>array(0,2))));
			if($deniedCount == 0) {
				$accountingUserId = '227';
				$loanNumber = $this->Common->getLoanNumber($loanId);
				//funder approve escrow uploaded loan document
				$loanCyclephase = '21';
				$this->Loan->id = $loanId;
				$this->Loan->saveField('loan_life_cycle_phase', $loanCyclephase);
				//save notification for all members
				$action = $loanNumber . ' - '. $newLoans['21'];
				$this->Common->saveNotifications($action, $this->Session->read('userInfo.id'), $loanId);
				//save notification to escrow
				$accountNotification['Notification']['receiver_id'] = $accountingUserId;
				$accountNotification['Notification']['sender_id'] = $this->Session->read('userInfo.id');
				$accountNotification['Notification']['action'] =  $newLoans['21']. 'Click to <a href="'.BASE_URL.'accounts/"> calculate commission</a>';
				$accountNotification['Notification']['action_id'] = $loanId;
				$accountNotification['Notification']['type'] = 2;
				$accountNotification['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($accountNotification);
				$this->Common->saveNotifications($action, $userData['id'], $loanId);
			
				//save loan log
				$shortAppID = $this->getShortAppID($loanId);
				$logData['LoanLog']['user_id']= $this->Session->read('userInfo.id');;
				$logData['LoanLog']['short_application_ID']= $shortAppID;
				$logData['LoanLog']['action']= 21;
				$logData['LoanLog']['description'] = 21;
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->create();
				$this->LoanLog->save($logData);
				//calculate commission function
				$this->calculateCommissionForLoan(base64_encode($loanId));
				$this->Session->setFlash($newLoans['21'], 'default', array('class'=>'alert alert-success'));
				return true;
			}
		}
	}
	
	
}