<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
*/
class CommonHelper extends Helper{

//function to fetch user detail 
	
	/**
	 * Description :- Decode loan Array
	 * @var object :- NONE;
	*/
	
	function loanArrayBase64Decode($data = array()){
		$notCountFields = array('id','short_app_id','soft_quate_id','borrower_id','team_id','status','loan_life_cycle_phase','created');
		if(count($data)){
			foreach($data['Loan'] as $key=>$val){
				if(!in_array($key,$notCountFields)){
					$data['Loan'][$key] = json_decode($val,true);
				}
			}
		}
		return $data;
	}
	
	/**
	 * Summary :- getUserDetail
	 * @param	Object	$userID	Description :- user ID
	 * @return	object			Description
	*/
	
	function getUserDetail($userID = null){
        App::import("Model", "User");  
        $model = new User();
        $options['conditions'] = array(
                   'User.id'=>$userID);
        $options['fields'] = array(
                   'User.id','User.first_name','User.last_name','User.name','User.email_address', 'User.user_type');       
		$data =  $model->find('first', $options);

        return $data;
	}
	
	/**
	 * Description
	 * @var object	
	*/
	
	function findShortApp($userId = null){
		App::import("Model", "ShortApplication");  
        $ShortApplication = new ShortApplication();
		// loan model
		App::import("Model", "Loan");  
        $Loan = new Loan();
        $options['conditions'] = array(
									'ShortApplication.borrower_ID'=>$userId
								);
		$options['recursive'] = -1;
		$data = $ShortApplication->find('first', $options);
		if($data){
			$loanDetail = $Loan->find('first',array('conditions'=>array('Loan.short_app_id' =>$data['ShortApplication']['id'])));
			if($loanDetail){
				return '2';
			}else{
				return '1';
			}
		}else{
			return false;
		}
	}
   
    /**
     * Summary:- getLienPositions
     * @return	array();
     * Description  :- getLienPositions
     */
    
    public function getLienPositions(){
		$lienPositions = array('1'=>'1st Trust Deed Notice', '2'=>'2nd Trust Deed Notice','3'=>'Other');
       return $lienPositions;
	}
    
     /**
     * Summary:- getGuaranteedInterests
     * @return	$guaranteedInterests
     * Description  :- getGuaranteedInterests
     */
    
    public function getGuaranteedInterests() {
		$guaranteedInterests = array(
									'1'=>'3 - Months Guaranteed Interest',
									'2'=>'6 - Months Guaranteed Interest',
									'3'=>'9 - Months Guaranteed Interest',
									'4'=>'12 - Months Guaranteed Interest',
									'5'=>'3 - Months Pre-payment Penalty',
									'6'=>'6 - Months Pre-payment Penalty',
									'7'=>'9 - Months Pre-payment Penalty',
									'8'=>'12 - Months Pre-payment Penalty',
									'9'=>'Other'
									);
        return $guaranteedInterests;
	}
    
     /**
     * Summary:- getLoanTerms
     * @return	$loanTerms
     * Description  :- getLoanTerms
     */
    
    public function getLoanTerms() {
		$loanTerms = array(
						   '6'=>'6 - Months',
						   '12'=>'12 - Months',
						   '24'=>'24 - Months',
						   '36'=>'36 - Months',
						   '60'=>'60 - Months',
						   'other'=>'Other');
        return $loanTerms;
	}
    
    /**
     * Summary:- getStateName
     * @return	$stateName
     * Description  :- getStateName
     */
    
    public function getStateName($stateID = null) {
		App::import("Model", "State");  
        $this->State = new State();
        $stateName = '';
        $stateDetail = $this->State->findById($stateID);
        if(count($stateDetail)){
            $stateName = $stateDetail['State']['name'];
        }
        return $stateName;
	}
    
	/**
     * Summary:- getStateName
     * @return	$stateName
     * Description  :- getStateName
     */
    
    public function getStates() {
		App::import("Model", "State");  
        $this->State = new State();
        $stateDetail = $this->State->find('list',array('conditions'=>array('status'=>1),'fields' => 'id,name'));
        if(count($stateDetail)){
            return $stateDetail;
        }
	}
	
	/**
	* Summary:- getGuaranteedInterests
	* @return	$guaranteedInterests
	* Description  :- getGuaranteedInterests
	*/
    
    public function getPrePayments() {
		$perPayments = array('1'=>'1%','2'=>'2%','3'=>'3%','4'=>'6-Months Interest','5'=>'12-Months Interest','6'=>'Other');
        return $perPayments;
	}
    
	/**
	* Summary:- getPropertyTypes
	* @return	$propertyTypes
	* Description  :- getPropertyTypes
	*/
    
    public function getPropertyTypes() {
		$propertyTypes = array('SFR'=>'SFR','Condo'=>'Condo','Town Home'=>'Town Home');
        return $propertyTypes;
	}
	
	/**
	* Summary		: getoBrrowerVesting
	* @return		:
	* Description  	: get Brrower Vesting
	*/
    
    public function getBrrowerVesting() {
		$bv = array('4'=>'Entity from Processing', 'other'=>'Other');
        return $bv;
	}
	
    /**
     * Summary:- getOccupancy
     * @return	$occupancy
     * Description  :- getOccupancy
     */
    
    public function getOccupancy() {
		
		$occupancy = array('Primary'=>'Primary','Investment'=>'Investment','2nd-Home'=>'2nd-Home');
        return $occupancy;
	}
    
	/**
	* Summary:- getEmploymentTypes
	* @return	$employmentTypes
	* Description  :- getEmploymentTypes
	*/
    
    public function getEmploymentTypes() {
		
		$employmentTypes = array('Self/E Type of Business'=>'Self/E Type of Business','W-2 Occupation'=>'W-2 Occupation');
        return $employmentTypes;
	}
    
	/**
	* Summary:- getEmploymentTypes
	* @return	$employmentTypes
	* Description  :- getEmploymentTypes
	*/
    
    public function getPropertyLiens() {
		$employmentTypes = array('1st Lien'=>'1st Lien','2nd Lien'=>'2nd Lien');
        return $employmentTypes;
	}
    
     /**
     * Summary:- getLoanPurposes
     * @return	$loanPurposes
     * Description  :- getLoanPurposes
     */
    
    public function getLoanPurposes() {
		$loanPurposes = array('Purchase'=>'Purchase','Refiance'=>'Refiance','Refiance Cash Out'=>'Refiance Cash Out','Construction Completion'=>'Construction Completion');
        return $loanPurposes;
	}
    
    /**
     * Summary:- getSoftQuoteLien
     * @return	$lienName
     * Description  :- if value of lien_position is other, other_lien_positon will be returned
     */
    
    public function getSoftQuoteLien($quoteID = null) {
		App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
        $lienName = '';
        $softQuoteDetail = $this->SoftQuote->findById($quoteID);
        if($quoteID != ''){
            $lienPosition = $softQuoteDetail['SoftQuote']['lien_position'];
            if($lienPosition == '3') {
                $lienName = $softQuoteDetail['SoftQuote']['other_lien_positon'];
            }else {
                $allLienPosition = $this->getLienPositions();
                $lienPosition = $softQuoteDetail['SoftQuote']['lien_position'];
                $lienName = $allLienPosition[$lienPosition];
            }
        }
        return $lienName;
	}
    
    /**
     * Summary:- getSoftQuotePerPayment
     * @return	$lienName
     * Description  :- if value of per_payment_interest is other, other_pre_payment_interest will be returned
     */
    
    public function getSoftQuotePerPayment($quoteID = null) {
		App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
        $perPaymentName = '';
        if($quoteID != ''){
             $softQuoteDetail = $this->SoftQuote->findById($quoteID);
            $perPayment = $softQuoteDetail['SoftQuote']['per_payment_interest'];
            if($perPayment == '9') {
                $perPaymentName = $softQuoteDetail['SoftQuote']['other_pre_payment_interest'];
            }else {
                $allGuaranteedInterests = $this->getGuaranteedInterests();
                $perPayment = $softQuoteDetail['SoftQuote']['per_payment_interest'];
                $perPaymentName = $allGuaranteedInterests[$perPayment];
            }
        }
        return $perPaymentName;
	}
   
   /**
     * Summary:- getSoftQuotePrePayment
     * @return	$lienName
     * Description  :- if value of per_payment_interest is other, other_pre_payment_interest will be returned
     */
    
    public function getSoftQuotePrePayment($quoteID = null) {
		App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
        $prePaymentName = '';
       
        if($quoteID != ''){
             $softQuoteDetail = $this->SoftQuote->findById($quoteID);
            $prePayment = $softQuoteDetail['SoftQuote']['pre-payment'];
            if(isset($prePayment) && $prePayment != ''){
                if($prePayment == '6') {
                    $prePaymentName = $softQuoteDetail['SoftQuote']['other_pre_payment'];
                }else {
                    $allPrePayments = $this->getPrePayments();
                    $prePayment = $softQuoteDetail['SoftQuote']['pre-payment'];
                    $prePaymentName = $allPrePayments[$prePayment];
                }
            }
        }
        return $prePaymentName;
	}
    
    /**
     * Summary:- getSoftQuotePrePayment
     * @return	$lienName
     * Description  :- if value of per_payment_interest is other, other_pre_payment_interest will be returned
     */
    
    public function getSoftQuoteloanTerm($quoteID = null) {
		App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
        $loanTermName = '';
        if($quoteID != ''){
            $softQuoteDetail = $this->SoftQuote->findById($quoteID);
            if($softQuoteDetail['SoftQuote']['loan_term']){
				$allLaonTerms = $this->getLoanTerms();
				$loanTerm = $softQuoteDetail['SoftQuote']['loan_term'];
				$loanTermName = $allLaonTerms[$loanTerm];
			}else{
				$loanTermName = $softQuoteDetail['SoftQuote']['other_loan_term'];
			}
            
        }
        return $loanTermName;
	}
   
	
	public function shortapp_checkloanuser($short_app_id){
		App::import("Model", "AskDocument");  
        $this->AskDocument = new AskDocument();
		$askdocument = $this->AskDocument->find('first',array('conditions'=>array('short_app_id'=>$short_app_id),'fields'=>array('loan_officer_id')));
		if(!empty($askdocument) && isset($askdocument)){
			return $askdocument['AskDocument']['loan_officer_id'];
		}
	}
	
	
	 /**
     * Summary:- getNotificationDetail
     * @return	notificationDetail
     * Description  :- notification link will be returned as per the action saved 
     */
    
    public function getNotificationDetail($notificationID = null) {
		App::import("Model", "Notification");
		App::import("Model", "ShortApplication");
		App::import("Model", "SoftQuote");
		App::import("Model", "Loan");
		App::import("Model", "Loi");
		App::import("Model", "DocOrderForm");
		App::import("Model", "DocOrderApproval");
        
		$this->SoftQuote = new SoftQuote();
		$this->Notification = new Notification();
		$this->ShortApplication = new ShortApplication();
		$this->Loan = new Loan();
		$this->Loi = new Loi();
		$this->DocOrderForm = new DocOrderForm();
		$this->DocOrderApproval = new DocOrderApproval();
		$sender = '';
		$notificationDetail = $this->Notification->findById($notificationID); 
		$site_Url = Configure::read('BASE_URL');
		$action = $notificationDetail['Notification']['action'];
		$senderID = $notificationDetail['Notification']['sender_id'];
		$senderDetail = $this->getUserDetail($senderID);
		if(is_array($senderDetail) && !empty($senderDetail)) {
			$sender = ' by '. $senderDetail['User']['name'];
		}
		$link = '';
		//if action = SoftQuote generated, action_id is $softQuoteID, else if action ='Processor Check-List Documents Requested', action_id is loanID
		if($action == 'Soft Quote generated') {
            $softQuoteID = $notificationDetail['Notification']['action_id'];
            $softQuoteDetail = $this->SoftQuote->findById($softQuoteID);
            $shortApplicationId = $softQuoteDetail['SoftQuote']['short_application_Id'];
			//check if Laon form is already filled for a $shortApplicationId, if exist link we be disabled
			$loanDetail = $this->Loan->find('first',array('conditions' => array('Loan.short_app_id' =>$shortApplicationId),'fields' =>array('Loan.short_app_id','ShortApplication.loan_objective' )));
			//pr($loanDetail);
			if(is_array($loanDetail) && !empty($loanDetail)) {
				$href = '<i class="fa fa-file-text"></i> Loan applied for '.$loanDetail['ShortApplication']['loan_objective'];
			}else {
			
				$href =  '<i class="fa fa-file-text"></i> We reviewed your Short App. Please review the Soft Quote.<a href = "' .$site_Url. 'borrowers/view_soft_quote/'.base64_encode($softQuoteID).'">Click here to view Soft Quote.</a>';
				
			}
			$link = $href;
		}elseif($action == 'Check-List Requested') {
			
            $loanID = $notificationDetail['Notification']['action_id'];
			$href =  '<a href = "' .$site_Url. 'borrowers/ask_document/'.base64_encode($loanID).'">Click here to view Checklist.</a>'; 
			$link = 'Check-List Requested. Kindly check the document that we need to proceed.'.$href;
		}elseif($action == 'Document Denied') {
			$enquiryID = $notificationDetail['Notification']['action_id'];
			$link = 'Document denied. <a href = "' .$site_Url. 'borrowers/enquiry/'.base64_encode($enquiryID).'">Click here to view details.</a>';
		}elseif($action == 'Processor Checklist Requested') {
			$link = 'Your loan is in processing the following items and documents are being requested.';
		}elseif($action == 'Loan Application Applied') {
			$link = 'Loan Application Applied '. $sender;
		}elseif($action == 'Letter of Intent (LOI) - Final Published') {
			$loanID = base64_encode($notificationDetail['Notification']['action_id']);
			$loiDetail = $this->Loi->find('first',array('conditions' => array('Loi.loan_id' =>$notificationDetail['Notification']['action_id'])));
			//pr($loanDetail);
			if(is_array($loiDetail) && (!empty($loiDetail['Loi']['borrower_upload_loi_pdf']) || !empty($loiDetail['Loi']['borrower_signed_pdf']))) {
				$link = '<i class="fa fa-file-text"></i> Loi signed';
			} else {

				$loanId = "'$loanID'";
				$pdfName = 'LetterOfIntent_'.$loanID.'.pdf';
				$link = 'Letter of Intent (LOI) - Final Published.<a href="/app/webroot/files/pdf/LetterOfIntent/'.$pdfName.'" target="_blank">Click here to review</a> <br/><br/>';
				$link .= 'Kindly <a href="/borrowers/loi/'.$loanID.'" title="Click here to sign LOI">sign letter of intent</a> for further process <br/><br/>';
				$link .= 'or <a href="/borrowers/downloadLOI/'.$loanID.'"  title="Click here to download">download</a> and save the document. Sign the LOI and then scan and <a href="javascript:void(0);"
				onclick="showLOIUpload('.$loanId.');" title="
				Click here to upload signed LOI">upload </a> or fax to us. Please make sure to upload the document correctly. ';
			}
		}elseif($action == 'Doc Order Form - Published') {
			$approvalID = $notificationDetail['Notification']['action_id'];
			$docApprovalDetail = $this->DocOrderApproval->find('first',array('conditions' => array('DocOrderApproval.id' =>$approvalID),'fields'=>array('DocOrderApproval.loan_id','DocOrderApproval.id','DocOrderApproval.remarks','DocOrderApproval.status')));
			
			if($docApprovalDetail['DocOrderApproval']['status'] == 0) {
				$loanID = $docApprovalDetail['DocOrderApproval']['loan_id'];
				$link = 'Doc Order Form - Published by '. $sender. ' Click here to <a href="/commons/doc_order_form/'.base64_encode($loanID).'/'.base64_encode($approvalID).'" title="Click to approve/deny">approve/deny</a><br/>';
			}else {
				$status = 'Approved';
				if($docApprovalDetail['DocOrderApproval']['status'] == 2) {
					$status = 'Denied';
				}
				$message = $status . ' - '. $docApprovalDetail['DocOrderApproval']['remarks'];
				
				$link = 'Doc Order Form ' .$message;
			}
		}else {
			$link = $action;
		}
        return $link;
	}
    
    
    /**
     * Summary:- softQuoteExist
     * @return	boolean
     * Description  :- If soft quote exist 
     */
    
    public function softQuoteExist($shortAppID = null) {
	
		App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
       
        $softQuoteCount = $this->SoftQuote->find('count', array('conditions' => array('SoftQuote.short_application_Id' => $shortAppID)));
        if($softQuoteCount > 0){
            return true;
        }else {
            return false;
        }
    }
    
    /**
    * Summary:- softQuoteExist
    * @return	boolean
    * Description  :- If soft quote exist 
    */
    
    public function getTrustDeedFields($fldName = null, $fldValue = null) {
	//echo $fldName . "-". $fldValue;
        if($fldName=='trustdeed_position') {
	    
	    if($fldValue=='1') { return '1st TD Loan'; }
	    if($fldValue=='2') { return '2nd TD Loan'; }
		}
	
		if($fldName=='pre_pay') {
			if($fldValue=='1') { return '3-months Guaranteed Interest'; }
			if($fldValue=='2') { return '6-months Guaranteed Interest'; }
			if($fldValue=='3') { return '9-months Guaranteed Interest'; }
			if($fldValue=='4') { return '12-months Guaranteed Interest'; }
			if($fldValue=='5') { return '3-Months Pre-payment Penalty'; }
			if($fldValue=='6') { return '6-Months Pre-payment Penalty'; }
			if($fldValue=='7') { return '9-Months Pre-payment Penalty'; }
			if($fldValue=='8') { return '12-Months Pre-payment Penalty'; }
			if($fldValue=='9') { return 'Other'; }
		}
	
		if($fldName=='loan_term') {
			if($fldValue=='3') { return '3-months'; }
			if($fldValue=='6') { return '6-months'; }
			if($fldValue=='12') { return '12-months'; }
			if($fldValue=='24') { return '24-months'; }
			if($fldValue=='36') { return '36-months'; }
			if($fldValue=='other') { return 'other'; }
		}
	
		if($fldName=='trans_type') {
			
			$arrTransType = array('purchase'=>'Purchase','ref_rate_n_term'=>'Refinance Rate & Term','ref_cash_out'=>'Refinace Cash-Out');
			
			if(array_key_exists($fldValue, $arrTransType)) {
			
			return $arrTransType[$fldValue];
			}
		}
	
		if($fldName=='entitlement_todate') {
			
			$arrEntitlement = array('NA'=>'Not Applicable','SCS'=>'Soft Costs Spent');
			
			if(array_key_exists($fldValue, $arrEntitlement)) {
			
			return $arrEntitlement[$fldValue];
			}
		}
	
		if($fldName=='property_type') {
			
			$arrPropertyType = array('sfr'=>'SFR','multifamily'=>'Multifamily','retail_neighborhood'=>'Retail Neighborhood','retail_single_tenant'=>'Retail Single Tenant','retail_strip_center'=>'Retail Strip Center','office'=>'Office','industrial'=>'Industrial','land'=>'Land');
			
			if(array_key_exists($fldValue, $arrPropertyType)) {
			
				return $arrPropertyType[$fldValue];
			}
		}
	
		if($fldName=='occupancy_type') {
			
			$arrOccupancyType = array('1'=>'Non-Owner', '2'=>'owner');
			
			if(array_key_exists($fldValue, $arrOccupancyType)) {
			
				return $arrOccupancyType[$fldValue];
			}
		}
	
		if($fldName=='borrower_entity_type') {
			
			$arrBorrower = array('individual'=>'Individual','ltd-liabiity-company'=>'Limited Liabiity Company','ltd-partnership'=>'Limited Partnership','corporation'=>'Corporation','trust'=>'Trust');
			
			if(array_key_exists($fldValue, $arrBorrower)) {
			
			return $arrBorrower[$fldValue];
			}
		}
	
		if($fldName=='exit_strategy') {
			
			$arrExitStrategy = array('refinance'=>'Refinance','cosntruction-loan'=>'Cosntruction Loan','sale-of-property'=>'Sale of the Property','other'=>'Other');
			
			if(array_key_exists($fldValue, $arrExitStrategy)) {
			
			return $arrExitStrategy[$fldValue];
			}
		}
    }
	
	
	/**
     * Summary:- getCommonNotificationDetail
     * @return	get notificationDetail for all user type except  borrower
     * Description  :- data will be returned as per the action 
     */
    
    public function getCommonNotificationDetail($notificationID = null) {
		App::import("Model", "Notification");
		App::import("Model", "ShortApplication");
		App::import("Model", "SoftQuote");
		App::import("Model", "Loan");
        
		$this->SoftQuote = new SoftQuote();
		$this->Notification = new Notification();
		$this->ShortApplication = new ShortApplication();
		$this->Loan = new Loan();
		$sender = $link = '';
		$notificationDetail = $this->Notification->findById($notificationID); 
		$action = $notificationDetail['Notification']['action'];
		$senderID = $notificationDetail['Notification']['sender_id'];
		$senderDetail = $this->getUserDetail($senderID);
		if(is_array($senderDetail) && !empty($senderDetail)) {
			$sender = ' by '. $senderDetail['User']['name'];
		}
		if($action == 'Soft Quote generated') {
            $softQuoteID = $notificationDetail['Notification']['action_id'];
            $softQuoteDetail = $this->SoftQuote->findById($softQuoteID);
			if(!empty($softQuoteDetail)) {
				$shortApplicationId = $softQuoteDetail['SoftQuote']['short_application_Id'];
				$link = 'Soft Quote generated'. $sender;
			}
		} else if($action == 'Short App') {
			$shortAppId = base64_encode($notificationDetail['Notification']['action_id']);
           $link =  '<a href = "' .BASE_URL. 'commons/propertyDetail/'.$shortAppId .'" onclick = "return read_common_notification('.$notificationID.');">'.$action.' '.$sender.'</a>';
		}else if($action == 'Loan Application Applied') {
           $link =  '<a href = "' .BASE_URL. 'commons/loan/" onclick = "return read_common_notification('.$notificationID.');">'.$action.' '.$sender.'</a>';
		}else if($action == 'Processor Check-List Documents Requested' || $action == 'Check-List Uploaded') {
			$loanID = $notificationDetail['Notification']['action_id'];
			$loanDetail = $this->Loan->findById($loanID);
			if(!empty($loanDetail)) {
				$shortAppID = $loanDetail['Loan']['short_app_id'];
				$link =  '<a href = "' .BASE_URL. 'commons/ask_document/'.base64_encode($shortAppID).'/'.base64_encode($loanID).'" onclick = "return read_common_notification('.$notificationID.');">'.$action.' '.$sender.'</a>';
			}
		}else if($action == 'Trust Deed Investor Hold Request') {
			$loanID = $notificationDetail['Notification']['action_id'];
			$link =  '<a href = "' .BASE_URL. 'commons/investor_request/'.base64_encode(base64_encode($loanID)).'" onclick = "return read_common_notification('.$notificationID.');">'.$action.' '.$sender.'</a>';
		}else if($action == 'Processor Checklist - Approval') {
			$loanID = $notificationDetail['Notification']['action_id'];
			$link = 'Processor Checklist - Approval';
		}else if($action == 'Processor Checklist Requested') {
			$link = 'Thanks for filling loan application. Click here to see the document we need to proceed.';
		}else if($action == 'Processor Checklist Requested') {
			$link = 'Thanks for filling loan application. Click here to see the document we need to proceed.';
		}else if($action == 'New Borrower Registered') {
			$link = 'New Borrower Registered'. $sender;
		}else if($action == 'Letter of Intent (LOI) - Final Signed by Borrower'){
				$link =  '<a href = "' .BASE_URL. 'commons/ask_document/'.base64_encode($shortAppID).'/'.base64_encode($shortAppID).'" onclick = "return read_common_notification('.$notificationID.');">'.$action.' '.$sender.'</a>';
		}else if($action == 'Escrow officer uploaded Loan documents'){
			$loanID = $notificationDetail['Notification']['action_id'];
				$link =  '<a href = "' .BASE_URL. 'loans/escrow_document/'.base64_encode($loanID).'" onclick = "return read_common_notification('.$notificationID.');">'.$action.' '.$sender.'</a>';
		}else{ 
			$link = $action;
		}
        return $link;
	}
	
	/**
     * Summary:- __getTeamByType
     * @return	To get user by type for team assignment
     * Description  :- To get user by type for team assignment
     */
	
	function __getTeamByType($userType=null, $teamId = null) {
		App::import("Model", "User");  
        $this->User = new User();
		App::import("Model", "TeamMember");
		$this->TeamMember = new TeamMember();
		$arrUser = $this->User->find('all', array('fields'=>array('User.id', 'User.first_name', 'User.last_name', 'User.email_address', 'UserDetail.mobile_phone,user_type'), 'conditions'=>array('User.user_type'=>$userType, 'status'=>'1', 'is_deleted'=>'0')));
		$selOption = array();
		if(!empty($arrUser)){
			foreach($arrUser as $v) {
				$userId = $v['User']['id'];
				$arrAssignedMembers = $this->TeamMember->find('first', array('fields'=>array('TeamMember.team_id','TeamMember.team_member_id'), 'conditions'=>array('TeamMember.team_member_id'=> $userId,'TeamMember.member_type'=>$userType,'TeamMember.status'=>'1')));
				$key = base64_encode(base64_encode($userId));
				$value = $v['User']['first_name'].' '.$v['User']['last_name'].' - '.$v['User']['email_address'];
				if(!empty($arrAssignedMembers['TeamMember']['team_member_id'])){
					if($teamId == $arrAssignedMembers['TeamMember']['team_id']){
						$selOption[$key] = $value;
					}
				}else{
					$selOption[$key] = $value;
				}
			}
		}
        return $selOption;
	}
	
	
	/**
     * Summary:- getTrustDeedPosition
     * @return	$deedPositions
     * Description  :- getTrustDeedPosition
     */
    
    public function getTrustDeedPosition() {
		$deedPositions = array('1'=>'1st TD Loan', '2'=>'2nd TD Loan');
        return $deedPositions;
	}
	
	/**
     * Summary:- getTrustDeedPrePay
     * @return	$deedPositions
     * Description  :- getTrustDeedPosition
     */
    
    public function getTrustDeedPrePay() {
		$deedPerPays = array('3'=>'3-months Guaranteed Interest','6'=>'6-months Guaranteed Interest','9'=>'9-months Guaranteed Interest','12'=>'3-months Guaranteed Interest');
        return $deedPerPays;
	}
	
	/**
     * Summary:- getTrustDeedLoanTerm
     * @return	$loanTerms
     * Description  :- getTrustDeedLoanTerm
     */
    
    public function getTrustDeedLoanTerm() {
		$loanTerms = array('3'=>'3-months','6'=>'6-months','12'=>'12-months','24'=>'24-months','other'=>'other');
        return $loanTerms;
	}
	
	/**
     * Summary:- getDeedTransactionTypes
     * @return	$transactionTypes
     * Description  :- getDeedTransactionTypes
     */
    
    public function getDeedTransactionTypes() {
		$transactionTypes = array('purchase'=>'Purchase','ref_rate_n_term'=>'Refinance Rate & Term','ref_cash_out'=>'Refinace Cash-Out');
        return $transactionTypes;
	}
	
    /**
     * Summary:- borrower_acceptance_status
     * @return	
     * Description  :- borrower_acceptance_status
     */
   
	public function borrower_acceptance_status($askDocumentId) {
	    
	    App::import("Model", "AskDocument");  
        $this->AskDocument = new AskDocument();
		$uploadDocument=$this->AskDocument->findById($askDocumentId);
        if(!empty($uploadDocument) && isset($uploadDocument)) {
			return $uploadDocument;
		}	
	}
	
	/**
	 * @function	: getTeamByLoanId
	 * @Description	: Get Team by loan id and status 1
	 * @Created Date: 9Sep2015
	 */
	
	function getTeamByLoanId($loanId = null) {
		
		App::import("Model", "TeamAssignment");  
        $this->TeamAssignment = new TeamAssignment();
		
		App::import("Model", "Team");  
        $this->Team = new Team();
		
		$arrTeam = $this->TeamAssignment->find('all', array('conditions'=>array('TeamAssignment.status'=>'1')));		
		return $arrTeam;
	}
	
	/**
     * Summary:- getCityName
     * @return	$cityName
     * Description  :- getCityName
     */
    
    public function getCityName($cityID = null) { 
		App::import("Model", "City");  
        $this->City = new City();
        $cityName = '';
        $cityDetail = $this->City->findById($cityID); 
        if(count($cityDetail)){
            $cityName = $cityDetail['City']['city'];
        }
        return $cityName;
	}
	
	/**
     * Summary:- getTeamName
     * @return	$teamName
     * Description  :- getTeamName
     */
    
    public function getTeamName($teamID = null) {
		App::import("Model", "Team");  
        $this->Team = new Team();
        $teamName = '';
        $teamDetail = $this->Team->findById($teamID);
        if(count($teamDetail)){
            $teamName = $teamDetail['Team']['team_funder'];
        }
        return $teamName;
	}
	
	 /**
     * Summary:- trustDeedExist
     * @return	boolean
     * Description  :- If trust Deed exist 
     */
    
    public function trustDeedExist($loan = null) {
	
		App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
       
        $softQuoteCount = $this->SoftQuote->find('count', array('conditions' => array('SoftQuote.short_application_Id' => $shortAppID,'SoftQuote.user_Id' => $userID)));
        if($softQuoteCount > 0){
            return true;
        }else {
            return false;
        }
    }
	
	 /**
     * Summary:- getBorrowerUpload
     * @return	$documentDetail
     * Description  :- If trust Deed exist 
     */
    
    public function getBorrowerUpload($documentID = null, $loanID = null, $documentType = null) {
	
		App::import("Model", "AskDocument");  
        $this->AskDocument = new AskDocument();
		
        $documentDetail = $this->AskDocument->find('first', array('conditions' => array('AskDocument.document_id' => $documentID,'AskDocument.document_type' => $documentType,'AskDocument.loan_id' => base64_decode($loanID))));
		return $documentDetail;
        
    }
	
	 /**
     * Summary:- getDeniedStatus
     * @return	
     * Description  :- 
     */
    
    public function getDeniedStatus($documentID = null, $shortAppId = null) {
		App::import("Model", "Enquiry");  
        $this->Enquiry = new Enquiry();
        $enquiryDetail = $this->Enquiry->find('first', array('conditions' => array('Enquiry.attachment' => $documentID,'Enquiry.short_app_id' => $shortAppId)));
		return $enquiryDetail;
        
    }
	
	/**
     * Summary:- checkAskedDocument
     * @return	
     * Description  :- checkAskedDocument
     */
	
	 public function checkAskedDocument($shortAppId, $loanId, $checklistvalue, $documentType) {
		App::import("Model", "AskDocument");  
        $this->AskDocument = new AskDocument();
        $options['conditions'] = array('document_type'=>$documentType,'short_app_id'=>base64_decode($shortAppId),'loan_id'=>base64_decode($loanId),'document_id' =>$checklistvalue);

		$data =  $this->AskDocument->find('first', $options);
		return $data;
   }
   
    /**
     * Summary:- getBorrowerUpload
     * @return	$documentDetail
     * Description  :- If trust Deed exist 
     */
    
    public function getDocumentDetail($documentID = null, $documentType = null) {
	
		App::import("Model", "Checklist");  
        $this->Checklist = new Checklist();
		App::import("Model", "LoanDocument");  
        $this->LoanDocument = new LoanDocument();
		
		if($documentType == 'loan') {
			  $documentDetail = $this->LoanDocument->find('first', array('conditions' => array('LoanDocument.id' => $documentID)));
			
		}else {
			$documentDetail = $this->Checklist->find('first', array('conditions' => array('Checklist.id' => $documentID)));
		}
		return $documentDetail;
        
    }
	
	
	/**
     * Summary:- getDocumentSatus
     * @return	status
     * Description  :- If any of document is not accepted
     */
    
    public function getDocumentSatus($loanID = null, $loanPhase = null) {
	
		App::import("Model", "LoanPhase");  
        $this->LoanPhase = new LoanPhase();
		$loanPhaseDetail = $this->LoanPhase->find('first', array('conditions' => array('LoanPhase.loan_id' => base64_decode($loanID), 'LoanPhase.loan_phase' => $loanPhase)));
		if(!empty($loanPhaseDetail)){
			return true;
		}else{
			return false;
		}	
    }
	
	 /*
	* getUserTeams function
	* Functionality -  getUserTeams
	* Created date - to get teamID for userID notification as read
	*/
	
	function getUserTeams($userID = null) {
		
		App::import("Model", "Team");
		App::import("Model", "TeamMember");
		App::import("Model", "User");
        $this->Team = new Team();
		$this->TeamMember = new TeamMember();
		$this->User = new User();
        $teamID = '';
        
        $userDetail  =  $this->User->find('first',array('fields'=>array('User.id','User.user_type'), 'conditions'=>array('User.id' =>$userID )));
		$userType = $userDetail['User']['user_type'];
		$teamNames = '';
		/*if($userType=='6') {
            $allTeamDetail = $this->Team->find('all',array('fields'=>array('Team.id'), 'conditions'=>array('Team.funder_id' =>$userID ),'recursive' => -1)); 
			foreach($allTeamDetail as $team) {
				$teamID = $team['Team']['id'];
				$teamDetail = $this->Team->find('first',array('fields'=>array('Team.team_funder'),'conditions'=>array('Team.id' =>$teamID)));
				$teamNames[] =  $teamDetail['Team']['team_funder'];
			}
			//$teamID = $teamDetail['Team']['id'];
        } else {*/
            
		$allTeamDetail = $this->TeamMember->find('all',array('conditions'=>array('TeamMember.team_member_id' =>$userID ),'fields'=>array('TeamMember.team_id'),'recursive' => -1));
		if($allTeamDetail) {
			foreach($allTeamDetail as $team) {
				$teamID = $team['TeamMember']['team_id'];
				$teamDetail = $this->Team->find('first',array('fields'=>array('Team.team_funder'),'conditions'=>array('Team.id' =>$teamID)));
				if(!empty($teamDetail)) {
					$teamNames[] =  $teamDetail['Team']['team_funder'];
				}
			}
			//$teamID = $teamDetail['TeamMember']['team_id'];
        //}
		}
		return $teamNames;
    }
	
	 /*
	* checkTrustDeed function
	* Functionality -  checkTrustDeed
	* Created date - to check if trust deed exist
	*/
	
	public function checkTrustDeed($loanId){ 
	 App::import("Model", "TrustDeed");  
        $this->TrustDeed = new TrustDeed();
		$trustDeed = $this->TrustDeed->find('first',array('conditions'=>array('loan_id'=>$loanId),'fields'=>array('id', 'user_id', 'created', 'status')));
		
		if(!empty($trustDeed) && isset($trustDeed)){
		 return $trustDeed;
		}
	}
	
	
	/*
	* checkLOICondition function
	* Functionality -  checkLOICondition
	* Created date - to check Letter of Intent (LOI) - Conditions Satisfied
	*/
	
	public function checkLOICondition($loanId){ 
	 App::import("Model", "Loi");  
        $this->Loi = new Loi();
		$loiSatus = $this->Loi->find('first',array('conditions'=>array('loan_id'=>$loanId),'fields'=>array('pdf_name', 'borrower_upload_loi_pdf', 'borrower_signed_pdf', 'condition_satisfied','user_id')));
		
		if(!empty($loiSatus) && isset($loiSatus)){
		 return $loiSatus;
		}
	}
	
	/*
	* checkLOICondition function
	* Functionality -  checkTrustDeedTombstone
	* Created date - to check Trust Deed Tombstone
	*/
	
	public function checkTrustDeedTombstone($loanId){ 
	    App::import("Model", "TrustDeedTombstone");  
        $this->TrustDeedTombstone = new TrustDeedTombstone();
		$tombstoneSatus = false;
		$tombstoneCount = $this->TrustDeedTombstone->find('all',array('conditions'=>array('loan_id'=>$loanId)));
		if(count($tombstoneCount) > 0 ){
		  $tombstoneSatus = true;
		}
		return $tombstoneSatus; 
	}
    
    /*
	* findHirarchy function
	* Functionality -  findHirarchy
	* Created date - to find team hierarchy
	*/
    
    public function findHirarchy($userType = null, $userId = null) {
		App::import("Model", "TeamMember");  
        $this->TeamMember = new TeamMember();
        // user
        App::import("Model", "User");  
        $this->User = new User();
        $teams = $this->TeamMember->find('all',array('conditions'=>array('team_member_id'=>$userId)));

        $returnArray = array();
        if(!empty($teams)){
            foreach($teams as $key=>$val){
                $members = $this->TeamMember->find('all',array('conditions'=>array('team_id'=>$val['TeamMember']['team_id'])));
				//pr($members);
                if(!empty($members)){
                    foreach($members as $k=>$v){
                        if(!empty($v['TeamMember']['team_member_id']) && $v['TeamMember']['member_type'] == $userType){
                            $userDetail = $this->User->findById($v['TeamMember']['team_member_id']);
                            if(!empty($userDetail)){
                                $returnArray[$userDetail['User']['id']] = $userDetail['User']['name'];
                            }
                        }
                    }
                }
            }
        }
        return json_encode($returnArray);
	}
	
	 /*
	* findHierarchyType function
	* Functionality -  findHierarchyType
	* Created date - to find usertype below the send usertype
	*/
    
    public function findHierarchyType($userType = null) {
		$hierarchyType = '';
		if($userType  == 4) {
			$hierarchyType = 3;
		}elseif($userType  == 3){
			$hierarchyType = 2;
		} 
		return  $hierarchyType;
	}
	
	 /*
	* findHierarchyType function
	* Functionality -  findHierarchyType
	* Created date - to find usertype below the send usertype
	*/
    
    public function getAllCommissions() {
		$allCommissions = array('10' =>'10%',
							   '20' =>'20%',
							   '30' =>'30%',
							   '40' =>'40%',
							   '50' =>'50%',
							   '60' =>'60%',
							   '70' =>'70%',
							   '80' =>'80%',
							   '90' =>'90%',
							   '100' =>'100%',
							);
		return  $allCommissions;
	}
	/*
	* investorHoldRequest function
	* Functionality -  investorHoldRequest
	* Created date - to check, if investor placed a hold request
	*/
	
	public function investorHoldRequest($loanId){ 
	 App::import("Model", "LoanHoldRequest");  
        $this->LoanHoldRequest = new LoanHoldRequest();
		$holdRequest = $this->LoanHoldRequest->find('count',array('conditions'=>array('loan_id'=>base64_decode($loanId))));
		
		if(!empty($holdRequest) && isset($holdRequest)){
		 return $holdRequest;
		}
	}
	
	
	/*
	* getTotalHoldFractional function
	* Functionality -  getTotalHoldFractional
	* Created date - to get total fractional investment
	*/
	
	public function getTotalHoldFractional($loanId){ 
	 App::import("Model", "LoanHoldRequest");  
        $this->LoanHoldRequest = new LoanHoldRequest();
		$holdRequests = $this->LoanHoldRequest->find('all',array('conditions'=>array('loan_id'=>$loanId)));
		$totalFractional = '0';
		foreach($holdRequests as $key =>$holdRequest) {
			if(!empty($holdRequest) && isset($holdRequest)){ 
				$fraction = $holdRequest['LoanHoldRequest']['inv_type_fraction'];
				$totalFractional += $fraction;
			}
		}
		return $totalFractional;
	}
	
	/**
     * Summary:- getLoanDetail
     * @return	array();
     * Description  :- getLoanDetail
     */
	
	function getLoanDetail($loanID = null){
        App::import("Model", "Loan");  
        $this->Loan = new Loan();
        $options['conditions'] = array('Loan.id' => $loanID);
        $options['fields'] = 'ShortApplication.*,Loan.created,Loan.short_app_id,Loan.soft_quate_id';
		$data =  $this->Loan->find('first', $options);
        return $data;
	}
   
   	/**
     * Summary:- getLoanDocument
     * @return	array();
     * Description  :- getLoanDocument
     */
	
	 function getLoanDocument(){
       
        $allDocuments = array('TIL' =>'app/webroot/files/pdf/TIL/TIL_',
							   'GFE' =>'app/webroot/files/pdf/GFE/GFE_',
							   '1003' =>'app/webroot/files/pdf/1003/1003_',
							  // 'Doc Order' =>'app/webroot/files/pdf/TIL_',
							   // 'LenderInstruction' =>'app/webroot/files/pdf/Lender Instruction/lender_instruction_'
							   
							   );
		return  $allDocuments;
   }
   
    /*
	* findUpperHierarchyType function
	* Functionality -  findUpperHierarchyType
	* Created date - to find upper usertype the send usertype
	*/
    
    public function findUpperHierarchyType($userType = null) {
		$hierarchyType = '';
		if($userType  == 3) {
			$hierarchyType = 4;
		}elseif($userType  == 2){
			$hierarchyType = 3;
		}  
		return  $hierarchyType;
	}
	
	 /*
	* getUpperHireachyUsers function
	* Functionality -  getUpperHireachyUsers
	* Created date - to find upper usertype the send usertype
	*/
    public function getUpperHireachyUsers($userType = null) {
		App::import("Model", "User");  
        $this->User = new User();
		$allUsers = $this->User->find('list',array('conditions'=>array('User.user_type'=>$userType),'fields'=>array('id','name')));
		return $allUsers;
		
	}
	 /*
	* getLoanProcessLink function
	* Functionality -  getUpperHireachyUsers
	* Created date - to get loan process link
	*/
	
    public function getLoanProcessLink($loanId = null,$loggedInId = null) {  
		App::import("Model", "Loan");  
        $this->Loan = new Loan();
		App::import("Model", "DocOrderApproval");  
        $this->DocOrderApproval = new DocOrderApproval();
		$loanID = base64_decode($loanId);
		$loan = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanID),'fields'=>array('Loan.id','Loan.loan_life_cycle_phase','ShortApplication.id')));
		$link['name'] = '';
		$link['url'] = 'javascript:void()';
		$link['attr'] = '';
		if($loan){
			$lifeCyclePhase = $loan['Loan']['loan_life_cycle_phase'];
			$loggedUserDetail = $this->getUserDetail($loggedInId);
			if($lifeCyclePhase == '4' || $lifeCyclePhase == '5'){
				$short_app_id = $loan['ShortApplication']['id'];
				$shortapploanofficer = $this->shortapp_checkloanuser($short_app_id);
				if(!empty($shortapploanofficer) &&  ($shortapploanofficer != $loggedInId)){
					$detail = $this->getUserDetail($shortapploanofficer);
					$link['name'] = 'Processor Check-list Document Requested by '.$detail['User']['name'];
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}elseif(!empty($shortapploanofficer) && ($shortapploanofficer == $loggedInId)) {
					$link['name']= 'Processor Check-list Document Request';
					$link['url'] = array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']));
					$link['attr'] = array('escape' =>false, 'title'=>'Processor Check-list Document Request', 'alt'=>'Processor Check-list Document Request');
					
				
				}elseif(empty($shortapploanofficer)) {
					$link['name']= 'Processor Check-list Document Request';
					$link['url'] = array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']));
					//$link = $this->Html->link('Processor Check-list Document Request', array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id'])));
					$link['attr'] = array('escape' =>false, 'title'=>'Processor Check-list Document Request', 'alt'=>'Processor Check-list Document Request');
				
				}else {
					$link['name']= '--';
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}
			}elseif($lifeCyclePhase == '5A' && $loggedUserDetail['User']['user_type'] == '5') {
				echo 'asda'.$status = $this->processorDocumentExist(base64_encode($loan['Loan']['id']));
				if($status) {
					$link['name']= 'Send Disclosure';
					$link['url'] = array('controller'=>'processors','action'=>'send_disclosure',base64_encode($loan['Loan']['id']));
					$link['attr'] = array('escape' =>false, 'title'=>'Review Disclosure', 'alt'=>'Review Disclosure');
					
				}else {
					$link['name']= 'Review Broker Checklist';
					$link['url'] = array('controller'=>'processors','action'=>'review_document',base64_encode($loan['Loan']['id']));
					$link['attr'] = array('escape' =>false, 'title'=>'Review Broker Checklist', 'alt'=>'Review Broker Checklist');
				}
			}elseif($loggedUserDetail['User']['user_type'] == '6' && ($lifeCyclePhase == '6' || $lifeCyclePhase == '7' || $lifeCyclePhase == '14')){ //Trust Deed flyer Draft  and Trust Deed flyer - Flyby Publish link
				$trustDeedDetail = $this->checkTrustDeed($loanID);
				$trustDeedUserID = $trustDeedDetail['TrustDeed']['user_id'];
				$userdetail = $this->getUserDetail($trustDeedUserID);
				if(!empty($trustDeedDetail) &&  ($trustDeedUserID != $loggedInId)){
					$link['name'] = 'Trust Deed drafted by '.$userdetail['User']['name'];
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}elseif(!empty($trustDeedDetail) && ($trustDeedUserID == $loggedInId)) {
					$link['name'] = 'Trust Deed';
					$link['url'] = array('controller'=>'commons','action'=>'trust_deed',$loanId,base64_encode(base64_encode($trustDeedDetail['TrustDeed']['id'])));
					$link['attr'] = array('escape' =>false, 'title'=>'Trust Deed', 'alt'=>'Trust Deed');
				}else {
					$link['name'] = 'Trust Deed';
					$link['url'] = array('controller'=>'commons','action'=>'trust_deed',$loanId,base64_encode(base64_encode($trustDeedDetail['TrustDeed']['id'])));
					$link['attr'] = array('escape' =>false, 'title'=>'Trust Deed', 'alt'=>'Trust Deed');
				}
			}elseif($loggedUserDetail['User']['user_type'] == 6 && ($lifeCyclePhase == '8' || $lifeCyclePhase == '11' || $lifeCyclePhase == '13')){
				$loiConditionSatisfied = $this->checkLOICondition($loanID);
				$loiPublishedUserId = $loiConditionSatisfied['Loi']['user_id'];
				$detail = $this->getUserDetail($loiPublishedUserId);
				if(!empty($loiConditionSatisfied) &&  ($loiPublishedUserId != $loggedInId)){
					$link['name'] = 'LOI created by '.$detail['User']['name'];
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
					
				}elseif(!empty($loiConditionSatisfied) && ($loiPublishedUserId == $loggedInId)) {
					$link['name'] = 'Letter of Intent (LOI)';
					$link['url'] = array('controller'=>'lois','action'=>'loi',$loanId);
					$link['attr'] = array('escape' =>false, 'title'=>'Letter Of Intent', 'alt'=>'Letter Of Intent');
				}elseif(empty($loiConditionSatisfied)) {
					$link['name'] = 'Letter of Intent (LOI)';
					$link['url'] = array('controller'=>'lois','action'=>'loi',$loanId);
					$link['attr'] = array('escape' =>false, 'title'=>'Letter Of Intent', 'alt'=>'Letter Of Intent');
				}else {
					$link['name'] = '--';
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}
				
			}elseif($lifeCyclePhase == '9' && $loggedUserDetail['User']['user_type'] == 5){
				$link['name'] = '<i class="fa fa-flag"></i>';
				$link['url'] = array('controller'=>'processors', 'action'=>'review', base64_encode($loanID));
				$link['attr'] = array('escape' =>false, 'title'=>'Processor Review', 'alt'=>'Processor Review');
				
			}elseif($lifeCyclePhase == '10' && $loggedUserDetail['User']['user_type'] == 6){
				$link['name'] = '<i class="fa fa-glass"></i>';
				$link['url'] = array('controller'=>'funders', 'action'=>'review', base64_encode(base64_encode($loanID)));
				$link['attr'] = array('escape' =>false, 'title'=>'Funder Review', 'alt'=>'Funder Review');
			}elseif($lifeCyclePhase == '15' && $loggedUserDetail['User']['user_type'] == 7){
				$link['name'] = '<i class="fa fa-coffee"></i>';	
				$link['url'] = array('controller'=>'tdinvestors', 'action'=>'td_inv_holdreq', base64_encode(base64_encode($loanID)));
				$link['attr'] = array('escape' =>false, 'title'=>'Trust Deed Investment Hold Request', 'alt'=>'Trust Deed Investment Hold Request');
				
			}elseif($lifeCyclePhase == '16' && $loggedUserDetail['User']['user_type'] == 6){
				$holdRequest = $this->investorHoldRequest(base64_encode($loanID));
				if(!empty($holdRequest) && $holdRequest != 0 && $loggedUserDetail['User']['user_type'] == 6) {
					$link['name'] = '<i class="fa fa-glass"></i>';
					$link['url'] = array('controller'=>'commons', 'action'=>'investor_request', base64_encode(base64_encode($loanID)));
					$link['attr'] = array('escape' =>false, 'title'=>'Trust Deed Investor Conditions Requested', 'alt'=>'Trust Deed Investor Conditions Requested');
					
				}else {
					$link['name'] = '--';
				
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}
			}elseif($lifeCyclePhase == '17' && $loggedUserDetail['User']['user_type'] == 6){
				$link['name'] = '<i class="fa fa-briefcase"></i>';	
				$link['url'] = array('controller'=>'funders', 'action'=>'loan_document', base64_encode($loanID));
				$link['attr'] = array('escape' =>false, 'title'=>'Loan Document', 'alt'=>'Loan Document');
				
				
			}elseif($lifeCyclePhase == '18' && $loggedUserDetail['User']['user_type'] == 6){
				$link['name'] = '<i class="fa  fa-folder-open"></i>';	
				$link['url'] = array('controller'=>'funders', 'action'=>'doc_order_form', base64_encode(base64_encode($loanID)));
				$link['attr'] =  array('escape' =>false, 'title'=>'Doc Order Form', 'alt'=>'Doc Order Form');
			}elseif($lifeCyclePhase == '21' && $loggedUserDetail['User']['user_type'] == 6){
				$tombstoneExist = $this->checkTrustDeedTombstone($loanID);
				if($tombstoneExist > 0) {
					$link['name'] = '<i class="fa fa-copy"></i>';	
					$link['url'] = array('controller'=>'commons', 'action'=>'download_tombstone', base64_encode($loanID));
					$link['attr'] =  array('escape' =>false, 'title'=>'Download Trust Deed Tombstone', 'alt'=>'Download Trust Deed Tombstone');
					
				} else {
					
					$link['name'] = '<i class="fa fa-bookmark"></i>';	
					$link['url'] =  array('controller'=>'commons', 'action'=>'trust_deed_tombstone', base64_encode(base64_encode($loanID)));
					$link['attr'] =  array('escape' =>false, 'title'=>'Trust Deed Tombstone', 'alt'=>'Trust Deed Tombstone');
				}
				
			}elseif($lifeCyclePhase == '20' && $loggedUserDetail['User']['user_type'] == 6){
				$link['name'] = '<i class="fa  fa-folder-open"></i>';	
				$link['url'] = array('controller'=>'loans', 'action'=>'escrow_document', base64_encode($loanID));
				$link['attr'] =  array('escape' =>false, 'title'=>'Review Escrow Document', 'alt'=>'Review Escrow Document');
			}elseif($lifeCyclePhase == '19A' && $loggedUserDetail['User']['user_type'] != 6){
				$link['name'] = 'Doc Order Form Published';
				$link['url'] = array('controller'=>'loans','action'=>'escrow_document',base64_encode($loanID));
				$link['attr'] = array('escape' =>false, 'title'=>'Click to review', 'alt'=>'Click to review');
			}elseif($lifeCyclePhase == '19'){
				$docOrderDetail = $this->DocOrderApproval->find('first',array('conditions'=>array('DocOrderApproval.loan_id'=>$loanID, 'DocOrderApproval.receiver_id' =>$loggedInId),'fields'=>array('doc_order_form_id')));
				$link['name'] = 'Doc Order Form Published';
				$link['url'] = array('controller'=>'commons','action'=>'doc_order_form',base64_encode($loan['Loan']['id']) ,base64_encode($docOrderDetail['DocOrderApproval']['doc_order_form_id']));
				$link['attr'] = array('escape' =>false, 'title'=>'Click to approve/deny', 'alt'=>'Click to approve/deny');
				
				
			}elseif($lifeCyclePhase == '6A' && $loggedUserDetail['User']['user_type'] == 2){
				$link['name'] = 'Review Loan Disclosure';
				$link['url'] = array('controller'=>'commons','action'=>'view_disclosure',base64_encode($loanID));
				$link['attr'] = array('escape' =>false, 'title'=>'Click to approve/deny disclosure', 'alt'=>'Click to approve/deny disclosure');
			}elseif($lifeCyclePhase == '6B' && $loggedUserDetail['User']['user_type'] == 5){
				$link['name'] = 'Approve Loan Disclosure';
				$link['url'] = array('controller'=>'processors','action'=>'send_disclosure',base64_encode($loanID));
				$link['attr'] = array('escape' =>false, 'title'=>'Click to approve disclosure', 'alt'=>'Click to approve disclosure');
			}elseif($lifeCyclePhase == '21')  {
				$link['name'] = 'Loan Closed';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			}elseif($lifeCyclePhase == '6B'){
				$link['name'] = 'In Process';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			}
		}
		return $link;
	}
	
	/*
	* getSoftQuoteDetail function
	* Functionality -  getSoftQuoteDetail
	* Created date - to get SoftQuote Detail
	*/
    public function getSoftQuoteDetail($softQuoteID = null) {
		App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
		$softQuoteDetail = $this->SoftQuote->find('first',array('conditions'=>array('SoftQuote.id'=>$softQuoteID),'fields'=>array('id','loan_amount')));
		return $softQuoteDetail;
		
	}
	
	 /*
	* findHierarchyType function
	* Functionality -  findHierarchyType
	* Created date - to find usertype below the send usertype
	*/
    
    public function getReferralComission($userId = null) {
		App::import("Model", "Commission");
		$this->Commission = new Commission();
		$commission = 0;
		$savedCommission = $this->Commission->find('first',array('conditions'=>array('Commission.user_id'=>$userId,'Commission.status'=>1),'fields' => array('commission')));
		if(!empty($savedCommission)){
			$commission = $savedCommission['Commission']['commission'];
		}
		return  $commission;
	}
	
	/*
	* shortAppExist function
	* Functionality -  shortAppExist
	* Created date - to check if short app exist for loan
	*/
    
    public function shortAppExist($loanId = null) {
		App::import("Model", "Loan");
		App::import("Model", "ShortApplication");
		$this->Loan = new Loan();
		$this->ShortApplication = new ShortApplication();
		$status = false;
		$loanDetail = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanId),'fields' => array('short_app_id')));
		if(!empty($loanDetail)){
			$shortAppID = $loanDetail['Loan']['short_app_id'];
			$shortAppDetail = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id'=>$shortAppID),'fields' => array('property_address')));
			if(!empty($shortAppDetail)){
				$status = true;
			}
		
		}
		return  $status;
	}
	
	 /**
     * Description :- getUserList
     * @var object :- NONE
    */
    
    function getUserList($loggedInUser = null){
        App::import("Model", "Chat");
		App::import("Model", "User");
		$this->Chat = new Chat();
		$this->User = new User();
        $senderId = $loggedInUser;
        // find user
        $userList = $this->User->find('all',array('conditions'=>array('NOT'=>array('User.user_type' => array('111','1')),'User.id !='=>$loggedInUser,'User.status !=' => '0'),'fields'=>'id,first_name,last_name,email_address,user_type,logged_in'));
        // find last message
        $chatMessages = $this->Chat->find('list',array('conditions'=>array('OR' => array('sender_id' => $senderId,'receiver_id' => $senderId),'modified_by !=' =>$senderId),'fields'=>'modified_by,modified_by'));
        $message = '';
        foreach($userList as $key=>$val){
            if(in_array($val['User']['id'],$chatMessages)){
                $val['User']['message'] = 1;
                $message += 1;
            }else{
                $val['User']['message'] = 0;
            }
            $userList[$key] = $val;
        }
        $data['chat'] = $message;
        $data['UserList'] = $userList;
        return json_encode($data);
    }
	
	/**
     * Summary :- getAllMessage
     * @return	NULL
     * Description :- getAllMessage
     */
    
	public function getAllMessage($userID = null) {
		App::import("Model", "Message");
		$this->Message = new Message();
		$allMessage = $this->Message->find('count', array('conditions'=>array('Message.receiver_id' =>$userID,'Message.status'=>0),'order'=>'id DESC'));
		return $allMessage;
	}
	
	/**
     * Summary :- getAllNotification
     * @return	NULL
     * Description :- getAllNotification
     */
    
	public function getAllNotification($userID = null) {
		App::import("Model", "Notification");
		$this->Notification = new Notification();
		$allNotifications = $this->Notification->find('count', array('conditions'=>array('Notification.receiver_id' =>$userID,'Notification.status'=>0),'order'=>'id DESC'));
		return $allNotifications;
	}
	
	/*
	* docOrderApproval function
	* Functionality -  docOrderApproval
	* Created date - to check if docOrderApproval exist for loan
	*/
    
    public function docOrderApproval($docApprovalID = null, $userID = null) {
		App::import("Model", "DocOrderApproval");
		$this->DocOrderApproval = new DocOrderApproval();
		$status = false;
		$approvalDetail = $this->DocOrderApproval->find('first',array('conditions'=>array('DocOrderApproval.doc_order_form_id'=>base64_decode($docApprovalID), 'DocOrderApproval.receiver_id'=>$userID,'DocOrderApproval.status' => 1),'fields' => array('id')));
		if(!empty($approvalDetail)){
			$status = true;
		}
		return  $status;
	}
	
	/*
	* investorHoldRequest function
	* Functionality -  investorHoldRequest
	* Created date - to check, if investor placed a hold request
	*/
	
	public function checkAvailableInvestment($loanId = null, $userId = null){
		App::import("Model", "LoanHoldRequest");
        $this->LoanHoldRequest = new LoanHoldRequest();
		$holdRequests = $this->LoanHoldRequest->find('all',array('conditions'=>array('loan_id'=>base64_decode(base64_decode($loanId)))));
		$status = $myStatus = false; $calculate = '';
		if(!empty($holdRequests)) {
			//pr($holdRequests);die;
			foreach($holdRequests as $holdRequest) {
				if($holdRequest['LoanHoldRequest']['investor_type'] == 'full_trust_deed') {
					if($holdRequest['LoanHoldRequest']['hold_by'] == $userId && $holdRequest['LoanHoldRequest']['status'] == '1'){
						$status = true;
					}
					break;
				} else {
					if($holdRequest['LoanHoldRequest']['inv_type_fraction']){
						if($holdRequest['LoanHoldRequest']['hold_by'] == $userId && $holdRequest['LoanHoldRequest']['status'] == '1'){
							$myStatus = true;
						}
						$calculate += $holdRequest['LoanHoldRequest']['inv_type_fraction'];
						if($calculate >= 100) {
							if($myStatus){
								$status = true;
							}else{
								$status = false;
							}
							break;
						}else{
							$status = true;
						}
					}
				}
			}
		}else{
			$status = true;
		}
		return $status;	
	}
	
	/*
	* getInvestorManagerList function
	* Functionality -  getInvestorManagerList
	* Created date - 9-6-2016
	*/
    
    public function getInvestorManagerList(){
		App::import("Model", "User");
		$this->User = new User();
		$investorList = $this->User->find('list',array('conditions'=>array('User.user_type'=>8),'fields' => 'id,name'));
		return $investorList;
	}
	
	 /*
	* getBorrowerLoanLink function
	* Functionality -  getBorrowerLoanLink
	* Created date - to get link for 
	*/
	
    public function getBorrowerLoanLink($loanId = null,$loggedInId = null) { 
		App::import("Model", "Loan");  
        $this->Loan = new Loan();
		App::import("Model", "DocOrderApproval");  
        $this->DocOrderApproval = new DocOrderApproval();
		$loanID = base64_decode($loanId);
		$loan = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanID),'fields'=>array('Loan.id','Loan.loan_life_cycle_phase','ShortApplication.id','Loan.soft_quate_id')));
		$link['name'] = 'In Process';
		$link['url'] = 'javascript:void()';
		$link['attr'] = '';
		if($loan){
			$lifeCyclePhase = $loan['Loan']['loan_life_cycle_phase'];
			$loggedUserDetail = $this->getUserDetail($loggedInId);
			if($lifeCyclePhase == '3') {
				if(!empty($loan['Loan']['soft_quate_id'])) {
					$link['name'] = 'Soft Quote - Published';
					$link['url'] = array('controller'=>'borrowers','action'=>'view_soft_quote',base64_encode($loan['Loan']['soft_quate_id']));
					$link['attr'] = array('escape' =>false, 'title'=>'View Soft quote', 'alt'=>'View Soft quote');
				}else {
					$link['name'] = 'In Process';
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}
			}
			elseif($lifeCyclePhase == '4' || $lifeCyclePhase == '5' ){
				$short_app_id = $loan['ShortApplication']['id'];
				$shortapploanofficer = $this->shortapp_checkloanuser($short_app_id);
				if(!empty($shortapploanofficer)){
					$link['name'] = 'Processor Check-list Document Requested';
					$link['url'] = array('controller'=>'borrowers','action'=>'ask_document',base64_encode($loan['Loan']['id']));
					$link['attr'] = '';
				}else { 
					$link['name']= 'In Process';
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}
			}elseif($lifeCyclePhase == '6'){
		
				$link['name']= 'Check-list Approved';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
				
			}elseif($lifeCyclePhase == '8'){ //Trust Deed flyer - Flyby Publish
				$pdfName = 'trust_deed_flyer_'.base64_encode($loan['Loan']['id']).'.pdf';	
				$link['name']= 'Trust Deed flyer - Flyby Publish';
				$link['url'] = BASE_URL.'app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName;
				$link['attr'] = array('escape' =>false, 'title'=>'View Trust Deed Flyer', 'alt'=>'View Trust Deed Flyer', 'target' =>'_blank');
			}elseif($lifeCyclePhase == '12'){ //Letter of Intent (LOI) - Final Published
				$link['name'] = 'Sign Letter Of Intent';
				$link['url'] = array('controller'=>'borrowers','action'=>'loi',base64_encode($loan['Loan']['id']));
				$link['attr'] = array('escape' =>false, 'title'=>'Click to sign letter Of Intent', 'alt'=>'Letter Of Intent');
			}elseif(($lifeCyclePhase == '19')){
				$docOrderDetail = $this->DocOrderApproval->find('first',array('conditions'=>array('DocOrderApproval.loan_id'=>$loanID, 'DocOrderApproval.receiver_id' =>$loggedInId),'fields'=>array('doc_order_form_id')));
				$link['name'] = 'Doc Order Form Published';
				$link['url'] = array('controller'=>'commons','action'=>'doc_order_form',base64_encode($loan['Loan']['id']) ,base64_encode($docOrderDetail['DocOrderApproval']['doc_order_form_id']));
				$link['attr'] = array('escape' =>false, 'title'=>'Click to approve/deny', 'alt'=>'Click to approve/deny');
			}/*elseif($lifeCyclePhase == '16'){
				$link['name'] = 'Trust Deed Investor Hold Request';	
				$link['url'] = array('controller'=>'commons', 'action'=>'investor_request', base64_encode(base64_encode($loanID)));
				$link['attr'] = array('escape' =>false, 'title'=>'Trust Deed Investor Conditions Requested', 'alt'=>'Trust Deed Investor Conditions Requested');
				
			}*/elseif($lifeCyclePhase == '16') {
				$link['name']= 'Trust Deed Investor Hold Request';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			
			}elseif($lifeCyclePhase == '6A'){
				$link['name'] = 'Review Loan Disclosure';
				$link['url'] = array('controller'=>'commons','action'=>'view_disclosure',base64_encode($loanID));
				$link['attr'] = array('escape' =>false, 'title'=>'Click to approve/deny disclosure', 'alt'=>'Click to approve/deny disclosure');
			}elseif($lifeCyclePhase == '21') {
				$link['name'] = 'Loan Closed';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			}
		}
		return $link;
	}

	 /*
	* getEscrowLoanLink function
	* Functionality -  getEscrowLoanLink
	* Created date - to get link for Escrow
	*/
	
    public function getEscrowLoanLink($loanId = null,$loggedInId = null) { 
		App::import("Model", "Loan");  
        $this->Loan = new Loan();
		$loan = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanId),'fields'=>array('Loan.id','Loan.loan_life_cycle_phase','ShortApplication.id','Loan.soft_quate_id')));

		$link['name'] = 'In Process';
		$link['url'] = 'javascript:void()';
		$link['attr'] = '';
		if($loan){
			$lifeCyclePhase = $loan['Loan']['loan_life_cycle_phase'];
			if($lifeCyclePhase == '19') {
				$link['name'] = 'Upload Loan Document';
				$link['url'] = array('controller'=>'escrows','action'=>'loan_document',base64_encode(base64_encode($loanId)));
				$link['attr'] = array('escape' =>false, 'title'=>'Upload Loan Document', 'alt'=>'Upload Loan Document');
			}
			elseif($lifeCyclePhase == '20A'){
				$link['name'] = 'Upload Final Document';
				$link['url'] = array('controller'=>'escrows','action'=>'final_document',base64_encode(base64_encode($loanId)));
				$link['attr'] = '';
			}elseif($lifeCyclePhase == '21'){
				$link['name']= 'Loan Closed';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			}else {
				$link['name']= 'In Process';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			}
		}
		return $link;
	}
	
	
	 /*
	* getInvestorTrustDeedLink function
	* Functionality -  getInvestorTrustDeedLink
	* Created date - to get link for Investor
	*/
	
    public function getInvestorTrustDeedLink($loanId = null,$loggedInId = null) { 
		App::import("Model", "Loan");  
        $this->Loan = new Loan();
		App::import("Model", "DocOrderApproval");  
        $this->DocOrderApproval = new DocOrderApproval();
		$loan = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanId),'fields'=>array('Loan.id','Loan.loan_life_cycle_phase','ShortApplication.id','Loan.soft_quate_id')));
		$link['name'] = 'In Process';
		$link['url'] = 'javascript:void()';
		$link['attr'] = '';
		if($loan){
			$lifeCyclePhase = $loan['Loan']['loan_life_cycle_phase'];
			if($lifeCyclePhase == '15' || $lifeCyclePhase == '16') {
                $status = $this->checkAvailableInvestment($loanId, $loggedInId);
                if($status) {
					$link['name'] = '<i class="fa fa-reply"></i>';
					$link['url'] = array('controller'=>'tdinvestors','action'=>'td_inv_holdreq',base64_encode(base64_encode($loanId)));
					$link['attr'] = array('escape' =>false, 'title'=>'Hold Request', 'alt'=>'Hold Request');
                }else {
					$link['name']= 'In Process';
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
				}
			}
			elseif($lifeCyclePhase == '18'){
				$docOrderDetail = $this->DocOrderApproval->find('first',array('conditions'=>array('DocOrderApproval.loan_id'=>$loanId, 'DocOrderApproval.receiver_id' =>$loggedInId),'fields'=>array('doc_order_form_id')));
				if(!empty($docOrderDetail)) {
					$link['name'] = 'Doc Order Form Published';
					$link['url'] = array('controller'=>'commons','action'=>'doc_order_form',base64_encode($loan['Loan']['id']) ,base64_encode($docOrderDetail['DocOrderApproval']['doc_order_form_id']));
					$link['attr'] = array('escape' =>false, 'title'=>'Click to approve/deny', 'alt'=>'Click to approve/deny');
				}else {
					$link['name']= 'In Process';
					$link['url'] = 'javascript:void()';
					$link['attr'] = '';
					
				}
			}elseif($lifeCyclePhase == '21'){
				$link['name']= 'Loan Closed';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			}else {
				$link['name']= 'In Process';
				$link['url'] = 'javascript:void()';
				$link['attr'] = '';
			}
		}
		return $link;
	}
	
	/**
     * Summary:- getFinalDocument
     * @return	array();
     * Description  :- getFinalDocument
     */
	
	function getFinalDocument(){
		$allDocuments = array('Final HUD' =>'HUD','Lender Instructions' =>'Lender Instructions',);
		return  $allDocuments;
	}
	
	/**
	 * Description :- getJuniorCommissionUser
	 * @var object :- $loanId, $userType
	*/
	
	function getJuniorCommissionUser($loanId = null, $userType = null){
		App::import("Model", "LoanUser");  
        $this->LoanUser = new LoanUser();
		App::import("Model", "UserPayment");  
        $this->UserPayment = new UserPayment();
		$return = false;
		$juniourUser = $this->LoanUser->find('first',array('conditions'=>array('loan_id'=>$loanId,'user_type'=>($userType-1))));
		if($juniourUser){
			$paymentDetail = $this->UserPayment->find('first',array('conditions'=>array('loan_id'=>$loanId,'user_id'=>$juniourUser['LoanUser']['user_id']),'recursive'=>-1));
			if(empty($paymentDetail)){
				$return = $juniourUser['LoanUser']['user_id'];
			}
		}
		return $return;
	}
	
	/**
     * Summary:- getLoanProcessingDetail
     * @return	status
     * Description  :- If any of document is not accepted
     */
    
    public function getLoanProcessingDetail($loanID = null) {
		App::import("Model", "LoanProcessDetail");  
        $this->LoanProcessDetail = new  LoanProcessDetail();
		$loanProcessDetail = $this->LoanProcessDetail->find('all', array('conditions' => array('LoanProcessDetail.loan_id' => base64_decode($loanID))));
		if(!empty($loanProcessDetail)){
			return false;
		}else {
			return true;
		}
    }
	
	/**
     * Summary:- getLoanDisclosureDetail
     * @return	status
     * Description  :- If any of document is not accepted
     */
    
    public function getLoanDisclosureDetail($loanID = null) { 
		App::import("Model", "DisclosureApproval");  
        $this->DisclosureApproval = new  DisclosureApproval();
		$loanDisclosureDetail = $this->DisclosureApproval->find('all', array('conditions' => array('DisclosureApproval.loan_id' => $loanID,'DisclosureApproval.status IN'=>array(0,2))));
		$return = '0';
		if(empty($loanDisclosureDetail)){
			$loanDisclosureDetail = $this->DisclosureApproval->find('all', array('conditions' => array('DisclosureApproval.loan_id' => $loanID,'DisclosureApproval.status'=>'1')));
			if(!empty($loanDisclosureDetail)){
				$return = '1';
			}
		}
		return $return;
    }
	
	 /**
     * Summary:- softQuoteExist
     * @return	boolean
     * Description  :- If soft quote exist 
     */
    
    public function askDocumentExist($loanID = null) {
		App::import("Model", "AskDocument");  
        $this->AskDocument = new AskDocument();
        $askDocumentCount = $this->AskDocument->find('count', array('conditions' => array('AskDocument.loan_id' => base64_decode($loanID))));
        if($askDocumentCount > 0){
            return true;
        }else {
            return false;
        }
    }
	
	/**
     * Summary:- processorDocumentExist
     * @return	status
     * Description  :- If any of document is not accepted
     */
    
    public function processorDocumentExist($loanID = null) {
		App::import("Model", "ProcessorDocument");  
        $this->ProcessorDocument = new  ProcessorDocument();
		$processorDocumentDetail = $this->ProcessorDocument->find('first', array('conditions' => array('ProcessorDocument.loan_id' => base64_decode($loanID))));
		if(!empty($processorDocumentDetail)){ 
			return true;
		}else {
			return false;
		}
    }
	
	/**
     * Summary:- getLoanLender
     * @return	lender name or multiple lender name if needed
     * Description  :- lender  or multiple lender name if needed
     */
    
    public function getLoanLender($loanID = null) {
		App::import("Model", "LoanHoldRequest");  
        $this->LoanHoldRequest = new LoanHoldRequest();
		$holdRequestDetail = $this->LoanHoldRequest->find('all', array('conditions' => array('LoanHoldRequest.loan_id' => base64_decode($loanID),'LoanHoldRequest.status' => 1)));
		$lenderName = '';
		if(!empty($holdRequestDetail)){
			foreach($holdRequestDetail as $key => $holdRequest) {
				$lenderID = $holdRequest['LoanHoldRequest']['hold_by'];
				$userDetail = $this->getUserDetail($lenderID);
				if($key == 0) {
					$lenderName .= $userDetail['User']['name'];
				}else {
					$lenderName .= ', '. $userDetail['User']['name'];
				}
			}
		}
		return $lenderName;
    }
	
	/**
	 * Description :- getLoanPercentage
	 * @var object :- $loanId
	*/
	
	public function getLoanPercentage($loanId = null) {
		App::import("Model", "LoanPhase");  
        $this->LoanPhase = new LoanPhase();
		$loanPhaseArray = array('A'=>'10','B'=>'20','C'=>'30','D'=>'40','E'=>'50','F'=>'60','G'=>'70','H'=>'80','I'=>'90','J'=>'100');
        $loanPhase = $this->LoanPhase->find('first',array('conditions'=>array('loan_id'=>base64_decode($loanId)),'order'=>'id DESC','fields'=>'LoanPhase.loan_phase'));
		$loanPercetage = '';
		if($loanPhase){
			$loanPercetage = $loanPhaseArray[$loanPhase['LoanPhase']['loan_phase']];
		}
		return $loanPercetage;
	}
	
	/**
	 * Description - getAllLoanIds
	 * @var object :- NULL
	*/
	
	public function getAllLoanIds(){
		App::import("Model", "UserPayment");  
        $this->UserPayment = new UserPayment();
		App::import("Model", "Loan");  
        $this->Loan = new Loan();
		$loaNumbers = '';
		$getAllLoanIds = $this->UserPayment->find('list',array('fields'=>'loan_id,loan_id','group' => 'UserPayment.loan_id'));
		if($getAllLoanIds){
			foreach($getAllLoanIds as $key=>$val){
				$loanDetail = $this->Loan->findById($val,array('fields'=>'loan_number'));
				$loaNumbers[base64_encode($key)] = $loanDetail['Loan']['loan_number'];
			}
		}
		return $loaNumbers;
	}
	
	/**
	 * Description - getFutureLoanPhase
	 * @var object :- NULL
	*/
	
	public function getFutureLoanPhase($loanPhaseCode = null){
		App::import("Model", "PhaseName");  
        $this->PhaseName = new PhaseName();
		$phase = '';
		$phaseDetail = $this->PhaseName->find('first',array('conditions'=>array('phase_code'=>$loanPhaseCode),'fields'=>'id, phase_name'));
		if(!empty($phaseDetail)){
			$id = $phaseDetail['PhaseName']['id'];
			//$futurePhaseDetail = $this->PhaseName->find('first',array('conditions'=>array('id'=>$id+1),'fields'=>'id, phase_name'));
			
			$phase = $phaseDetail['PhaseName']['phase_name'];
		}
		return $phase;
	}
	
	
	/*
	* escrowDocApproval function
	* Functionality -  escrowDocApproval
	* Created date - to check if escrow approval exist for loan
	*/
    
    public function escrowDocApproval($docApprovalID = null, $userID = null) {
		App::import("Model", "DocOrderApproval");
		$this->DocOrderApproval = new DocOrderApproval();
		$status = false;
		$approvalDetail = $this->DocOrderApproval->find('first',array('conditions'=>array('DocOrderApproval.doc_order_form_id'=>base64_decode($docApprovalID), 'DocOrderApproval.receiver_id'=>$userID,'DocOrderApproval.status' => 1),'fields' => array('id')));
		if(!empty($approvalDetail)){
			$status = true;
		}
		return  $status;
	}
	
	
}