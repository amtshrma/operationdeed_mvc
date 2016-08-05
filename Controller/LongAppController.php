<?php
/*
* BorrowersController class
* Functionality -  Manage the Users (Borrowers)
* Created date - 9-Jul-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility');
App::import('Controller','Commons');

class LongAppController extends AppController {
	var $name = 'LongApp';
	var $uses = '';
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array();
	
	/**
	 * Summary :- beforeFilter
	 * @return	object :- NONE
	 * Description :- beforeFilter
	*/
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'dashboard_common';
		$this->set('step',$this->action);
		$allow = array();
		$this->checkUserSession($allow,1);
	}

	/**
	 * Description
	 * @var object
	*/
	
	function __entityType(){
		$entity = array('S-Corp' => 'S-Corp','C-Corp' => 'C-Corp','LLC' => 'LLC','LP' => 'LP','LLP' => 'LLP','Trust' => 'Truest','Non-profit Agency' => 'Non-profit Agency');
		$this->set('entityType',$entity);
	}
	
	/*
	* shortApp function 
	* Functionality -  shortApp functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function shortApp(){
		$this->loadAllModel(array('ShortApplication','State'));
		$this->getPropertyTypes();
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$states = $this->State->find('list',array('conditions'=>array('status'=>'1'),'fields'=>array('id','name'),'order'=>'name ASC'));
		$this->set('states',$states);
		if($this->request->data){
			$this->request->data['ShortApplication']['borrower_ID'] = $this->Session->read('userInfo.id');
			$this->request->data['ShortApplication']['broker_ID'] = 'Rockland';
			if($this->ShortApplication->save($this->request->data)){
				$this->Common->getDetailFromTitle365($this->ShortApplication->id);
				$this->redirect(array('controller'=>'longApp','action'=>'longAppStep1/'));
			}
		}
	}
	
	/*
	* longAppStep1 function 
	* Functionality -  longAppStep1 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep1() {
		// get user short app detail
		$this->loadModel('ShortApplication');
		$userShortAppInfo = $this->ShortApplication->find('first',array('conditions'=>array('applicant_email_ID' => $this->Session->read('userInfo.email_address')),'order'=>'ShortApplication.id DESC'));
		$this->Session->write('userShortAppInfo',$userShortAppInfo);
		$mortageArray = $this->Common->__moratgeTypes();
		$this->set('mortageValues',$mortageArray);
		$amortizationArray = $this->Common->__amortizationTypes();
		$this->set('amortizationValues',$amortizationArray);
		if($this->request->data){
			$this->Session->write('longAppData.LongAppDetail',$this->request->data['LongAppDetail']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep2/'.base64_encode('longAppStep2')));
		}else{
			// write session data
			if($this->Session->check('longAppData')){
				$this->request->data = $this->Session->read('longAppData');
			}
		}
	}
	
	/*
	* longAppStep2 function 
	* Functionality -  longAppStep2 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep2($action = null) {
		if(base64_decode($action) != $this->action){
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep1'));
		}
		$loanArray = $this->Common->__loanPurpose();
		$this->set('loanPurpose',$loanArray);
		$propertyArray = $this->Common->__propertyType();
		 $this->set('propertyArray',$propertyArray);
		
		$estimateArray = $this->Common->__estimateValues();
		$this->set('estimateArray',$estimateArray);
		$this->__entityType();
		$this->set('propertyType',$this->propertyTypes);
		if($this->request->data){
			$this->Session->write('longAppData.LongAppPropertyInformation',$this->request->data['LongAppPropertyInformation']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep3/'.base64_encode('longAppStep3')));
		}else{
			// write session data
			if($this->Session->check('longAppData')){
				$this->request->data = $this->Session->read('longAppData');
			}
		}
	}
	
	/*
	* longAppStep3 function 
	* Functionality -  longAppStep3 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep3($step = null) {
		if(base64_decode($step) != $this->action){
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep1'));
		}
		$maritalStatus = $this->Common->__maritalStatus();
		$this->set('maritalStatus',$maritalStatus);
		if($this->request->data){
			$this->Session->write('longAppData.LongAppBorrower',$this->request->data['LongAppBorrower']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep4/'.base64_encode('longAppStep4')));
		}else{
			// write session data
			if($this->Session->check('longAppData')){
				$this->request->data = $this->Session->read('longAppData');
			}
		}
	}
	
	/*
	* longAppStep4 function 
	* Functionality -  longAppStep4 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep4($step = null) {
		if(base64_decode($step) != $this->action){
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep1'));
		}
		if($this->request->data){
			$this->Session->write('longAppData.LongAppBorrowerEmployment',$this->request->data['LongAppBorrowerEmployment']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep5/'.base64_encode('longAppStep5')));
		}else{
			// write session data
			if($this->Session->check('longAppData')){
				$this->request->data = $this->Session->read('longAppData');
			}
		}
	}
	
	/*
	* __getEmploymentDetail function 
	* Functionality -  __getEmploymentDetail
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	/*public function getEmploymentDetail(){
		$this->layout = '';
		$this->autoRender = false;
		$URL = "https://demo.mortgagecreditlink.com/inetapi/AU/get_credit_report.aspx";
		$request = '<REQUEST_GROUP MISMOVersionID="2.3.1">
		   <RECEIVING_PARTY _Identifier="D1"/>
			<SUBMITTING_PARTY _Identifier="TestSubmittingPartyID">
			   <PREFERRED_RESPONSE _Format="Other" 
		  _FormatOtherDescription="HTML"></PREFERRED_RESPONSE>
			 </SUBMITTING_PARTY>
			<REQUEST RequestDatetime="2011-07-25T11:46:24" 
				LoginAccountIdentifier="D1-rcommercial"
				LoginAccountPassword="rockland2016">
			  <REQUEST_DATA>
				<CREDIT_REQUEST MISMOVersionID="2.3.1" LenderCaseIdentifier="interface test" RequestingPartyRequestedByName="">
				  <CREDIT_REQUEST_DATA CreditRequestID="CreditRequest1" BorrowerID="Borrower"  CreditReportProductDescription="MortgageReports" CreditReportRequestActionType="Submit" CreditRequestDateTime="2007-07-25T11:46:24" CreditRequestType="Individual">
				 <CREDIT_REPOSITORY_INCLUDED _EquifaxIndicator="Y" _ExperianIndicator="Y" _TransUnionIndicator="Y"></CREDIT_REPOSITORY_INCLUDED>
					  
				  </CREDIT_REQUEST_DATA>		
				  <LOAN_APPLICATION>
					<BORROWER BorrowerID="Borrower" _FirstName="'.$this->Session->read('userShortAppInfo.ShortApplication.applicant_first_name').'" _MiddleName="" _LastName="'.$this->Session->read('userShortAppInfo.ShortApplication.applicant_last_name').'" _NameSuffix="" _AgeAtApplicationYears="" _PrintPositionType="Borrower" _SSN="000000004" MaritalStatusType="NotProvided">
					  <_RESIDENCE _StreetAddress="'.$this->Session->read('userShortAppInfo.ShortApplication.applicant_first_name').'" _City="ANTHILL" _State="MO" _PostalCode="65488" BorrowerResidencyType="Current"></_RESIDENCE>
					</BORROWER>
				  </LOAN_APPLICATION>
				</CREDIT_REQUEST>
			  </REQUEST_DATA>
			</REQUEST>
		</REQUEST_GROUP>';
		$employeeData = $this->Common->executeCURL($request,$URL);
		pr($employeeData);
		$this->set('employeeData',simplexml_load_string($employeeData));
	}*/
	/*
	* longAppStep5 function 
	* Functionality -  longAppStep5 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep5($step = null) {
		if(base64_decode($step) != $this->action){
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep1'));
		}
		if($this->request->data){
			$this->Session->write('longAppData.LongAppBorrowerIncome',$this->request->data['LongAppBorrowerIncome']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep6/'.base64_encode('longAppStep6')));
		}
	}
	
	/*
	* longAppStep6 function 
	* Functionality -  longAppStep6 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep6() {
		$this->loadAllModel(array('State'));
		if($this->request->data){ 
			$this->Session->write('longAppData.LongAppBorrowerEmploymentInfo',$this->request->data['LongAppBorrowerEmploymentInfo']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep7/'.base64_encode('longAppStep7')));
		}
		$states = $this->State->find('list',array('conditions'=>array('status'=>'1'),'fields'=>array('id','name'),'order'=>'name ASC'));
		$this->set('states',$states);
	}
	
	/*
	* longAppStep7 function 
	* Functionality -  longAppStep7 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep7() {
		$this->getPropertyTypes();
		if($this->request->data){ 
			$this->Session->write('longAppData.LongAppBorrowerRealEstate',$this->request->data['LongAppBorrowerRealEstate']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep8/'.base64_encode('longAppStep8')));
		}
	}
	
	/*
	* longAppStep8 function 
	* Functionality -  longAppStep8 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep8() {
		if($this->request->data){
			$this->Session->write('longAppData.LongAppBorrowerTransaction',$this->request->data['LongAppBorrowerTransaction']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep9/'.base64_encode('longAppStep9')));
		}
	}
	
	/*
	* longAppStep9 function 
	* Functionality -  longAppStep9 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep9() {
		if($this->request->data){
			$this->Session->write('longAppData.LongAppBorrowerChecklist',$this->request->data['LongAppBorrowerChecklist']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppStep10/'.base64_encode('longAppStep10')));
		}
	}
	
	/*
	* longAppStep10 function 
	* Functionality -  longAppStep10 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppStep10() {
		if($this->request->data){
			$this->Session->write('longAppData.LongAppBorroweraAcknowledgement',$this->request->data['LongAppBorroweraAcknowledgement']);
			$this->redirect(array('controller'=>'longApp','action'=>'longAppSuccess/'.base64_encode('longAppSuccess')));
		}
	}
	
	/*
	* longAppStep10 function 
	* Functionality -  longAppStep10 functionality
	* Created date - 27 -1 -2016
	* Modified date - 
	*/
	
	public function longAppSuccess($fullAppPDF = null) {
		$this->loadAllModel(array('Loan','LoanLog','LoanPhase'));
		$data = array();
		if($this->Session->check('longAppData') && base64_decode($fullAppPDF) != 'pdf'){
			$data['borrower_id'] = $this->Session->read('userInfo.id');
			$data['short_app_id'] = $this->Session->read('userShortAppInfo.ShortApplication.id');
			$data['LongApp'] = json_encode($this->Session->read('longAppData.LongAppDetail'));
			$data['LongAppPropertyInformation'] = json_encode($this->Session->read('longAppData.LongAppPropertyInformation'));
			$data['LongAppBorrower'] = json_encode($this->Session->read('longAppData.LongAppBorrower'));
			$data['LongAppBorrowerEmployment'] = json_encode($this->Session->read('longAppData.LongAppBorrowerEmployment'));
			$data['LongAppBorrowerIncome'] = json_encode($this->Session->read('longAppData.LongAppBorrowerIncome'));
			$data['LongAppBorrowerEmploymentInfo'] = json_encode($this->Session->read('longAppData.LongAppBorrowerEmploymentInfo'));
			$data['LongAppBorrowerRealEstate'] = json_encode($this->Session->read('longAppData.LongAppBorrowerRealEstate'));
			$data['LongAppBorrowerTransaction'] = json_encode($this->Session->read('longAppData.LongAppBorrowerTransaction'));
			$data['LongAppBorrowerChecklist'] = json_encode($this->Session->read('longAppData.LongAppBorrowerChecklist'));
			$data['LongAppBorroweraAcknowledgement'] = json_encode($this->Session->read('longAppData.LongAppBorroweraAcknowledgement'));
			$data['team_id'] = $this->getUserTeam($data['borrower_id']);
			$data['soft_quate_id'] = ($this->Session->check('userShortAppInfo.SoftQuote.id')) ? $this->Session->read('userShortAppInfo.SoftQuote.id') : '';
			//need inputs on GFE and TIL, not sure about loan phase i.e adding 9 instead of 4
			$data['loan_life_cycle_phase'] = '4';
			$this->Loan->save($data);
			$loanID = $this->Loan->id;
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_number', 'LN-OTD-'.time().'-'.date('Y').'-'.$this->Loan->id);
			$this->set('loanID',$loanID);
			//Save notification for borrower long App
			$newLoans = $this->getLoanLifeCyclePhase();
			$action = $newLoans['4'] .'. Check <a href="'.BASE_URL.'commons/loan/">loan listing </a> to further process loan';
			$senderID = $this->Session->read('userInfo.id');
			$actionID = $loanID;
			$this->Common->saveNotifications($action, $senderID, $actionID);
			//save loan log
			$shortAppId = $this->getShortAppID($loanID);
			$name = $this->Session->read('userInfo.first_name'). ' '. $this->Session->read('userInfo.last_name');
			$logData['LoanLog']['user_id'] = $this->Session->read('userInfo.id');
			$logData['LoanLog']['short_application_ID'] = $shortAppId;
			$logData['LoanLog']['action'] = $newLoans['4'];
			$logData['LoanLog']['description'] = 'Loan Application applied by '. $name;
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			$this->Session->write('longAppData');
			//save loan phase
			$loanStatus = $this->LoanPhase->find('first',array('conditions'=>array('LoanPhase.loan_id'=>$loanID, 'LoanPhase.loan_phase' => 'A')));
			if(empty($loanStatus)) {
				$loanPhaseData['LoanPhase']['loan_phase'] = 'A';
				$loanPhaseData['LoanPhase']['loan_id'] = $loanID;
				$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;;
				$this->LoanPhase->save($loanPhaseData);
			}
			$this->full_app(base64_encode($loanID));
		}
	}
	
	/*
	* fillable_1003 function
	* Functionality - show fillable_1003 document
	* Created date - 23-Nov-2015
	*/
	
	function full_app($loanId = null) {
		$this->loadAllModel(array('SoftQuote', 'Review', 'EmailTemplate', 'DocOrderFormDoc', 'ShortApplication','Loan','TrustDeed','State'));
		$loanDetail = $this->Loan->find('first', array('conditions' => array('Loan.id' => base64_decode($loanId))));
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		foreach($loanDetail['Loan'] as $key =>$value) {
			$data[$key] = json_decode($value, true);
		}
		$mortageArray = $this->Common->__moratgeTypes();
		$this->set('mortageValues',$mortageArray);
		$amortizationArray = $this->Common->__amortizationTypes();
		$this->set('amortizationValues',$amortizationArray);
		$loanArray = $this->Common->__loanPurpose(); 
		$this->set('loanPurpose',$loanArray);
		$propertyArray = $this->Common->__propertyType();
		$this->set('propertyArray',$propertyArray);
		$estimateArray = $this->Common->__estimateValues();
		$this->set('estimateArray',$estimateArray);
		$maritalStatus = $this->Common->__maritalStatus();
		$this->set('maritalStatus',$maritalStatus);
		$this->set('states',$states);
		$propertyDetail = $this->TrustDeed->find('first', array('conditions' => array('TrustDeed.loan_id' => base64_decode($loanId)),'fields'=>array('TrustDeed.*')));
		$this->set('data', $data);
		$this->set('propertyDetail', $propertyDetail);
		$this->set('loanDetail', $loanDetail);
		$this->set('loanId', $loanId);
		$this->layout = '/pdf/default';
		$this->render('/Pdf/full_app');
		$this->redirect(array('controller'=>'longApp', 'action'=>'longAppSuccess/'.base64_encode('pdf')));
	}
	
	
	public function getEmploymentDetail(){
		$this->layout = '';
		$this->autoRender = false;
		$URL = "https://demo.mortgagecreditlink.com/inetapi/AU/get_credit_report.aspx";
		$request = '<REQUEST_GROUP MISMOVersionID="2.3.1">
		   <RECEIVING_PARTY _Identifier="D1"/>
			<SUBMITTING_PARTY _Identifier="TestSubmittingPartyID">
			   <PREFERRED_RESPONSE _Format="Other" 
		  _FormatOtherDescription="HTML"></PREFERRED_RESPONSE>
			 </SUBMITTING_PARTY>
			<REQUEST RequestDatetime="2011-07-25T11:46:24" 
				LoginAccountIdentifier="D1-rcommercial"
				LoginAccountPassword="rockland2016">
			  <REQUEST_DATA>
				<CREDIT_REQUEST MISMOVersionID="2.3.1" LenderCaseIdentifier="interface test" RequestingPartyRequestedByName="">
				  <CREDIT_REQUEST_DATA CreditRequestID="CreditRequest1" BorrowerID="Borrower"  CreditReportProductDescription="MortgageReports" CreditReportRequestActionType="Submit" CreditRequestDateTime="2007-07-25T11:46:24" CreditRequestType="Individual">
				 <CREDIT_REPOSITORY_INCLUDED _EquifaxIndicator="Y" _ExperianIndicator="Y" _TransUnionIndicator="Y"></CREDIT_REPOSITORY_INCLUDED>
					  
				  </CREDIT_REQUEST_DATA>		
				  <LOAN_APPLICATION>
					<BORROWER BorrowerID="Borrower" _FirstName="DAVID" _MiddleName="L" _LastName="TESTCASE" _NameSuffix="" _AgeAtApplicationYears="" _PrintPositionType="Borrower" _SSN="000000004" MaritalStatusType="NotProvided">
					  <_RESIDENCE _StreetAddress="504 N GRANDVIEW ST #2" _City="ANTHILL" _State="MO" _PostalCode="65488" BorrowerResidencyType="Current"></_RESIDENCE>
					</BORROWER>
				  </LOAN_APPLICATION>
				</CREDIT_REQUEST>
			  </REQUEST_DATA>
			</REQUEST>
		</REQUEST_GROUP> ';
		//pr($request); die();
		$employeeData = $this->Common->executeCURL($request,$URL);
		pr(simplexml_load_string($employeeData));
		$this->set('employeeData',simplexml_load_string($employeeData));
	}
}