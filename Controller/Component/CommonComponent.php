<?php
/**
 * Custom component
 *
 * PHP 5
 *
 * Date Of Creation   : 23 Feb 2015
 * 
 */

App::uses('Component', 'Controller');

/**
 * Custom component
 */
class CommonComponent extends Component {
    
/**
 * This component uses the component
 *
 * @var array
 */    
    var $components = array('Cookie','Session','Email','Upload','Easyphpthumbnail');
    
/*
 * Function to generate the random password
 */

    public function getRandPass() {
        
        // Array Declaration
        $pass = array();
        
        // Variable declaration
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for($i = 0; $i < 8; $i++){
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    /**
     * Upload Original Image
     * @copyright     smartData Enterprise Inc.
     * @method        image_upload
     * @param         $file, $path, $folder_name, $thumb, $multiple
     * @return        $filename or $err_type
     * @since         version 0.0.1
     * @version       0.0.1 
     */

    public function upload_image($file, $path, $folder_name, $thumb = false, $multiple = array()){
        
        // Variable containing File type
        $extType = $file['type'];
         
        // Variable containing extension in lowercase 
        $ext = strtolower($extType);				
         
        // Condition checking File extension
        if($ext=='image/jpg' || $ext=='image/png' || $ext=='image/jpeg' || $ext=='image/gif'){					
         
            // Condition checking File size
            if($file['size'] <= 10485760){					
            
                // Filename 
                $filename = time().'_'.$file['name'];
                
                // Folder path
                $folder_url = WWW_ROOT.$path.'/'.$folder_name;
                
                // Condition checking File exist or not 
                if (!file_exists($folder_url.'/'.$filename)){
                   
                    // create full filename
                    $full_url = $folder_url.'/'.$filename;			
                  
                    // upload the file					
                    $success = move_uploaded_file($file['tmp_name'], $full_url);
                
                    //
                    if($thumb){
                        // If multiple folder upload required then pass TRUE as last parameter
                        $this->upload_thumb_image($filename, $path, $folder_name, $multiple);
                    }
                     
                    return $filename;
                }else{
                    return 'exist_error';
                }
            }else{
                return 'size_mb_error';
            }
        }else{
            return 'type_error';
        }
    }
   
    /**
     * Upload Thumb Image
     * @copyright     smartData Enterprise Inc.
     * @method        upload_thumb_image
     * @param         $filename, $path, $folder_name, $multiple
     * @return        void
     * @since         version 0.0.1
     * @version       0.0.1 
     */
    
    public function upload_thumb_image($filename, $path, $folder_name, $multiple = array()){
        
        // image path from where pic taken
        $dircover = str_replace(chr(92),chr(47),getcwd()).'/'.$path.'/'.$folder_name.'/'.$filename;
        if(!empty($multiple) && count($multiple)> 0){
        	foreach($multiple as $result){
        		$this->Easyphpthumbnail-> Thumblocation = str_replace(chr(92),chr(47),getcwd()).'/'.$path.'/'.$result['folder_name'].'/';
        		$this->Easyphpthumbnail-> Thumbheight = $result['height'];
        		$this->Easyphpthumbnail-> Thumbwidth =  $result['width'];
        		$this->Easyphpthumbnail-> Createthumb($dircover,'file');
        	}
        }
    }    
    
    
    /**
     * Handle image errors
     * @copyright     smartData Enterprise Inc.
     * @method        is_image_error
     * @param         $image_name
     * @return        error msg
     * @since         version 0.0.1
     * @version       0.0.1 
     */
    
    public function is_image_error($image_name = null){
        $errmsg = '';
        switch($image_name){
            case 'exist_error':
                $errmsg = 'File already exist.';
                break;
            
            case 'size_mb_error':
                $errmsg = 'Only mb of file is allowed to upload.';
                break;
            
            case 'type_error':
                $errmsg = 'Only JPG, JPEG, PNG & GIF are allowed.';
                break;
        }
        return $errmsg;
    }
    
    /**
     * Delete image
     * @copyright     smartData Enterprise Inc.
     * @method        delete_image
     * @param         $image_name, $path, $thumb_path
     * @return        void
     * @since         version 0.0.1
     * @version       0.0.1 
     */
    
    public function delete_image($imagename = null, $path = null, $folder_name = null, $thumb = false, $multiple = array()){
        
        if(!empty($path)){
            $full_path = WWW_ROOT.$path.'/'.$folder_name.'/'.$imagename;
            if(file_exists($full_path)){
                unlink($full_path);
            }
            
            if($thumb){
                if(!empty($multiple) && count($multiple)> 0){
                    foreach($multiple as $result){
                        $full_thumb_path = WWW_ROOT.$path.'/'.$result['folder_name'].'/'.$imagename;
                        if(file_exists($full_thumb_path)){
                            unlink($full_thumb_path);
                        }
                    }
                }
            }
            
        }
    }
    
    /* Get State List */
    function getStateList()
	{
		return $statelist = array("AL" => "Alabama","AK" => "Alaska","AZ" => "Arizona","AR" => "Arkansas","AS" => "American Samoa","CA" => "California","CO" => "Colorado","CT" => "Connecticut","DE" => "Delaware","DC" => "District of Columbia","FL" => "Florida","GA" => "Georgia","GU" => "Guam","HI" => "Hawaii","ID" => "Idaho","IL" => "Illinois","IN" => "Indiana","IA" => "Iowa","KS" => "Kansas","KY" => "Kentucky","LA" => "Louisiana","ME" => "Maine","MD" => "Maryland","MA" => "Massachusetts","MI" => "Michigan","MN" => "Minnesota","MS" => "Mississippi","MO" => "Missouri","MT" => "Montana","NE" => "Nebraska","NV" => "Nevada","NH" => "New Hampshire","NJ" => "New Jersey","NM" => "New Mexico","NY" => "New York","NC" => "North Carolina","ND" => "North Dakota","MP" => "Northern Marianas Islands","OH" => "Ohio","OK" => "Oklahoma","OR" => "Oregon","PA" => "Pennsylvania","PR" => "Puerto Rico","RI" => "Rhode Island","SC" => "South Carolina","SD" => "South Dakota","TN" => "Tennessee","TX" => "Texas","UT" => "Utah","VT" => "Vermont","VA" => "Virginia","VI" => "Virgin Islands","WA" => "Washington","WV" => "West Virginia","WI" => "Wisconsin","WY" => "Wyoming");
	}
    
     /**
     * @Date: Sep 14, 2015
     * @Method : sanitize_document_name
     * @Purpose: used to sanitize name by removing special characters
     * @Param:  $document_name
     * @Return: $documentName {String}
     * */
    
    public static function sanitize_document_name($document_name = null) {
        
        // our list of "dangerous characters", add/remove characters if necessary
        $replace_characters = array(
            " ", '"', "'", "&", "/", "\\", "?", "#", "*", "~",
            "@", "^", ";", ",", "+", "(", ")", "$", "%"
        );
        // every forbidden character is replace by an underscore
        $documentName = str_replace($replace_characters, '-', $document_name);
        
        return $documentName;
    }
    
    /**
    * @Date: Oct 12, 2015
    * @Method : saveNotifications
    * @Purpose: used to sanitize name by removing special characters
    * @Param:  $document_name
    * @Return: $documentName {String}
    * */
    
    
    public function saveNotifications($action = null, $senderID = null, $actionID =  null){
        App::import("Model", "Notification");  
        $this->Notification = new Notification();
        App::import("Model", "User");  
        $this->User = new User();
		App::import("Model", "TeamMember");
		$this->TeamMember = new TeamMember();
        //(array('Notification','User', 'TeamMember'));
		$userTeam = $this->getTeam($senderID);
		//if user is assigned to team, all team members will be notified
		if(!empty($userTeam)) {
			$userTypeArray = array('2','3','4','5','6'); 
			$notifyUser = $this->TeamMember->find('all',array('conditions'=>array('TeamMember.team_id'=>$userTeam, 'TeamMember.member_type' => $userTypeArray, 'TeamMember.team_member_id !='=> $senderID),'fields' =>array('TeamMember.team_member_id')));
            foreach($notifyUser as $user) { 
				$notificationData['Notification']['receiver_id'] = $user['TeamMember']['team_member_id'];
				$notificationData['Notification']['sender_id'] = $senderID;
				$notificationData['Notification']['action'] = $action;
				$notificationData['Notification']['action_id'] = $actionID;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				//pr($notificationData);
                $this->Notification->create();
                $this->Notification->save($notificationData);
			}
		} else {
			//else users will be notified
			$userTypeArray = array('2','3','4','5','6'); 
			$notifyUser = $this->User->find('all',array('conditions'=>array('User.user_type' => $userTypeArray, 'User.id !='=> $senderID),'fields' =>array('User.id')));
			foreach($notifyUser as $user) {
				//save Notification
				$notificationData['Notification']['receiver_id'] = $user['User']['id'];
				$notificationData['Notification']['sender_id'] = $senderID;
				$notificationData['Notification']['action'] = $action;
				$notificationData['Notification']['action_id'] = $actionID;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				//pr($notificationData);
				$this->Notification->create();
				$this->Notification->save($notificationData);
			}
        }
        return true;
	}
    
    /**
     * @Date: Oct 12, 2015
     * @Method : saveNotifications
     * @Purpose: used to sanitize name by removing special characters
     * @Param:  $document_name
     * @Return: $documentName {String}
     * */
    
    
    public function saveNotificationsInvestor($action = null, $senderID = null, $actionID =  null,$investorId = null){
        App::import("Model", "Notification");
        $this->Notification = new Notification();
        App::import("Model", "User");
        $this->User = new User();
		//if user is assigned to team, all team members will be notified
        $investorDetail = $this->User->findById($investorId);
		if(!empty($investorDetail)){
            $notificationData['Notification']['receiver_id'] = $investorId;
            $notificationData['Notification']['sender_id'] = $senderID;
            $notificationData['Notification']['action'] = $action;
            $notificationData['Notification']['action_id'] = $actionID;
            $notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
            $this->Notification->create();
            $this->Notification->save($notificationData);
			if(!empty($investorDetail['UserDetail']['referred_by_user_id'])){
				$notificationData['Notification']['receiver_id'] = $investorDetail['UserDetail']['referred_by_user_id'];
				$notificationData['Notification']['sender_id'] = $senderID;
				$notificationData['Notification']['action'] = $action;
				$notificationData['Notification']['action_id'] = $actionID;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
                $this->Notification->create();
                $this->Notification->save($notificationData);
			}
		}
        return true;
	}
    
    /**
     * Summary
     * @param	Object	$userID	Description
     * @return	object			Description
    */
    
    public function getTeam($userID = null) {
        App::import("Model", "User");  
        $this->User = new User();
		
		App::import("Model", "TeamMember");
		$this->TeamMember = new TeamMember();
        
        App::import("Model", "Team");
		$this->Team = new Team();
       
        $teamID = '';
        
        $userDetail  =  $this->User->find('first',array('fields'=>array('User.id','User.user_type'), 'conditions'=>array('User.id' =>$userID )));
		$userType = $userDetail['User']['user_type'];
        
		/*if($userType=='6') {
            
            $teamDetail = $this->Team->find('list',array('fields'=>array('Team.id'), 'conditions'=>array('Team.funder_id' =>$userID )));           
        } else {*/
            
            $teamDetail = $this->TeamMember->find('list',array('conditions'=>array('TeamMember.team_member_id' =>$userID ),'fields'=>array('TeamMember.team_id')));            
        //}
       
		return $teamDetail;
    }
    
      /**
     * @Date: Nov 9, 2015
     * @Method : getInternalFunder
     * @Purpose: find funder and team based on a condition i.e funder with least number of loans
        Note - once  client will confirm the condition we can change it. 
     * @Param:  $document_name
     * @Return: $documentName {String}
     * */
    
    // the borrower will automatically be assigned to a funder or a broker loan officer working for Rockland.    We need a mechanism that will control who the new borrower will be auto assigned to..    similar to the team assignment..    the borrower will be auto-assigned to a particular funder or broker loan officer and also assigned to a team.
    
    
    public function getInternalFunderTeam($userID = null) {
		
        App::import("Model", "Team");  
        $this->Team = new Team();
		App::import("Model", "Loan");
		$this->Loan = new Loan();
        $teamID = '';
        $teamCount = $this->Loan->find('first', array('conditions'=>array('Loan.team_id !=' => ''),'group'=>array('Loan.team_id'),'fields'=>array('Loan.team_id','COUNT(Loan.id) as Count'),'order'=> 'Count ASC'));        
        $teamID = '';
        if(empty($teamCount)){
            $teamDetail = $this->Team->find('first');
            if($teamDetail){
                $teamID = $teamDetail['Team']['id'];
            }
        }else if(!empty($teamCount)){
            $teamID = $teamCount['Loan']['team_id'];
        }
		return $teamID;
    }
    
      /**
     * @Date: Nov 9, 2015
     * @Method : sendInvestorNotification
     * @Purpose: send notfication to investor for a loan,  if full trust deed mail/notification will be send one investor, else if fractional mail/notification will be send to all investors
     * @Param:  $loanID
     * @Return: Null
     * */
    
    public function sendInvestorNotification($action = null, $senderID = null, $loanID =  null) {
        App::import("Model", "LoanHoldRequest");  
        $this->LoanHoldRequest = new LoanHoldRequest();
        App::import("Model", "Notification");
		$this->Notification = new Notification();
        $allInvestors = $this->LoanHoldRequest->find('all', array('conditions'=>array('LoanHoldRequest.loan_id' => $loanID),'fields'=>array('LoanHoldRequest.hold_by','LoanHoldRequest.inv_manager_refby')));
        if(count($allInvestors)>0) {
            foreach($allInvestors as $key=>$investor){
                $notificationData['Notification']['receiver_id'] = $investor['LoanHoldRequest']['hold_by'];
				$notificationData['Notification']['sender_id'] = $senderID;
				$notificationData['Notification']['action'] = $action;
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
            }
        } 
    }
    
    
    /* @Date: Nov 9, 2015
     * @Method : calculateCommission
     * @Purpose: 
     * @Param:  $userID
     * @Return: Null
     * */
    
   /*
	* calculateCommission function
	* Functionality -  calculateUserCommission
	* Created date - to calculate commmission, we need to check commission decided by immediate senior i.e if referred by  Sales manager we check commission decided by Sales manager for broker 
	*/
    public function calculateCommission($userId = null) {
		App::import("Model", "User");  
        $this->User = new User();
		App::import("Model", "Commission");  
        $this->Commission = new Commission();
		$referredUserDetail = $this->User->find('first',array('conditions'=>array('UserDetail.user_id'=>$userId),'fields'=>array('UserDetail.referred_by_user_id','User.user_type')));
        //if referred by team member check commission saved by team member else get self commission
		if(!empty($referredUserDetail) && $referredUserDetail['UserDetail']['referred_by_user_id'] != ''){ 
			$referredUserID = $referredUserDetail['UserDetail']['referred_by_user_id'];
			$userType = $referredUserDetail['User']['user_type'];
			$userCommission = $this->Commission->find('first',array('conditions'=>array('Commission.user_id'=>$referredUserID,'Commission.user_type'=>$userType,'Commission.status'=>1),'fields'=>array('Commission.commission')));
			
		}else { 
            $userCommission = $this->Commission->find('first',array('conditions'=>array('Commission.user_id'=>$userId,'Commission.status'=>0),'fields'=>array('Commission.commission')));
			
        }
	}
     /*
	* calculateFundingNumber function
	* Functionality -  calculateFundingNumber
	* Created date - to calculate funding numbers  for the Lender = Loan Amount - odd days interest (at daily rate) - and fees of lender,  
	*/
    public function calculateFundingNumber($loanId = null){ 
        App::import("Model", "Loan");  
        $this->Loan = new Loan();
        App::import("Model", "SoftQuote");  
        $this->SoftQuote = new SoftQuote();
        $loanDetail = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanId)));
        $softQuoteID = $loanDetail['Loan']['soft_quate_id'];
        $softQuoteDetail = $this->SoftQuote->find('first',array('conditions'=>array('SoftQuote.id'=>$softQuoteID),'fields'=>array('SoftQuote.interest_rate')));
        $loanAmount = $loanDetail['ShortApplication']['loan_amount'];
        $interestRate = (!empty($softQuoteDetail['SoftQuote']['interest_rate'])) ? $softQuoteDetail['SoftQuote']['interest_rate'] : '';
        $amount = number_format(($interestRate/100)*$loanAmount,2);
    }
    
    /**
     * Description :- getDetailFromTitle365
     * @var object :- $shortAppId
    */
        
    function getDetailFromTitle365($shortAppId = null){
        // shortapplication
        App::import("Model", "ShortApplication");  
        $this->ShortApplication = new ShortApplication();
		// Property detail
        App::import("Model", "PropertyDetail");  
        $this->PropertyDetail = new PropertyDetail();
        // Property History
        App::import("Model", "PropertyHistory");  
        $this->PropertyHistory = new PropertyHistory();
        // Property Comparables
        App::import("Model", "PropertyComparable");  
        $this->PropertyComparable = new PropertyComparable();
        //City
        App::import("Model", "City");  
        $this->City = new City();
        // State
        App::import("Model", "State");  
        $this->State = new State();
        $shortAppDetail = $this->ShortApplication->findById($shortAppId);
        $client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
        // get property detail Start
        $cityName = $stateCode = '';
        $cityDetail = $this->City->findById($shortAppDetail['ShortApplication']['property_city']); 
        if(count($cityDetail)){
            $cityName = $cityDetail['City']['city'];
        }
        $stateCode = '';
        $stateDetail = $this->State->findById($shortAppDetail['ShortApplication']['property_state']); 
        if(count($stateDetail)){
            $stateCode = $stateDetail['State']['code'];
        }
        $request = array('Request'=>array(
                                    'ClientSystemID' => ClientSystemID,
                                    'T365ID'  => T365ID,
                                    'City' => $cityName,
                                    'State' => $stateCode,
                                    'StreetAddress' => $shortAppDetail['ShortApplication']['property_address'],
                                    'ZipCode' => $shortAppDetail['ShortApplication']['property_zipcode']
                                )
        );
        $reponse  = $client->GetPropertyDetail($request);
        if($reponse->GetPropertyDetailResult->ResultCode == 'Success'){
            $propertyId = $this->_savePropertyDetail($reponse->GetPropertyDetailResult->PropertyDetail,$shortAppId);
            // get property history
            $this->_savePropertyHistory($cityName,$stateCode,$shortAppDetail,$propertyId);
            // get property image
            $this->_savePropertyImage($cityName,$stateCode,$shortAppDetail,$propertyId);
            // get property comparables
            $this->_savePropertyComaprable($cityName,$stateCode,$shortAppDetail);
            //get AVM - Pitch Point
            $this->_saveAVM($cityName,$stateCode,$shortAppDetail,$propertyId);
        }else{
            $this->Session->setFlash($reponse->GetPropertyDetailResult->ResultCode, 'default', array('class'=>'alert alert-error'));
        }
    }
    
    /**
	 * Description :- _savePropertyDetail
	 * @var object : $propertyDetail, $shrotAppId
	*/
	
	function _savePropertyDetail($propertyDetail = array(), $shortAppId = null){
		$propertyDetail->short_application_id = $shortAppId;
		$this->PropertyDetail->save($propertyDetail,array('validate'=>false));
		return $this->PropertyDetail->id;
	}
	
	/**
	 * Description :- _savePropertyHistory
	 * @var object : $shrotAppId
	*/
	
	function _savePropertyHistory($cityName = null,$stateCode = null,$shortAppDetail = array(),$propertyDetailId = null){
		$client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => ClientSystemID,
									'T365ID'  => T365ID,
									'SubjectPropertyCity' => $cityName,
									'SubjectPropertyState' => $stateCode,
									'SubjectPropertyStreetAddress' => $shortAppDetail['ShortApplication']['property_address'],
									'SubjectPropertyZipCode' => $shortAppDetail['ShortApplication']['property_zipcode']
					)
        );
        $response  = $client->GetPropertyHistory($request);
        if($response->GetPropertyHistoryResult->ResultCode == 'Success'){
			if(count($response->GetPropertyHistoryResult->HistoryItems->PropertyHistoryItem) > 1){
				foreach($response->GetPropertyHistoryResult->HistoryItems->PropertyHistoryItem as $key=>$val){
					$val->short_application_id = $shortAppDetail['ShortApplication']['id'];
					$val->property_detail_id = $propertyDetailId;
					$this->PropertyHistory->save($val,array('validate'=>false));
					$this->PropertyHistory->create();
				}
			}else{
				$val = '';
				$val = $response->GetPropertyHistoryResult->HistoryItems->PropertyHistoryItem;
				$val->short_application_id = $shortAppDetail['ShortApplication']['id'];
				$val->property_detail_id = $propertyDetailId;
				$this->PropertyHistory->save($val,array('validate'=>false));
				$this->PropertyHistory->create();
			}
		}
		return true;
	}
	
	/**
	 * Description :- _savePropertyImage
	 * @var object : $shrotAppId
	*/
	
	function _savePropertyImage($cityName = null,$stateCode = null,$shortAppDetail = array(),$propertyDetailId = null){
		$client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => ClientSystemID,
									'T365ID'  => T365ID,
									'SubjectPropertyCity' => $cityName,
									'SubjectPropertyState' => $stateCode,
									'SubjectPropertyStreetAddress' => $shortAppDetail['ShortApplication']['property_address'],
									'SubjectPropertyZipCode' => $shortAppDetail['ShortApplication']['property_zipcode']
					)
        );
        $response  = $client->GetPlatMaps($request);
		if($response->GetPlatMapsResult->ResultCode == 'Success'){
			$update['id'] = $propertyDetailId;
			$update['MapImageURL'] = $response->GetPlatMapsResult->MapImageURLs->string['1'];
			$this->PropertyDetail->save($update);
		}
		return true;
	}
	
	/**
	 * Description :- _savePropertyComaprable
	 * @var object : $shrotAppId
	*/
	
	function _savePropertyComaprable($cityName = null,$stateCode = null,$shortAppDetail = array(),$propertyDetailId = null){
		$client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => ClientSystemID,
									'T365ID' => T365ID,
									'SubjectPropertyCity' => $cityName,
									'SubjectPropertyState' => $stateCode,
									'SubjectPropertyStreetAddress' => $shortAppDetail['ShortApplication']['property_address'],
									'SalePriceMax' => '',
									'SalePriceMin' => '',
                                    'SearchRadiusInMiles' => '5'
					)
        );
		$response  = $client->getSalesComparables($request);
		if($response->GetSalesComparablesResult->ResultCode == 'Success'){
			if(count($response->GetSalesComparablesResult->SalesComparables->SalesComparable) > 1){
				foreach($response->GetSalesComparablesResult->SalesComparables->SalesComparable as $key=>$val){
					$val->short_application_id = $shortAppDetail['ShortApplication']['id'];
					$this->PropertyComparable->save($val);
					$this->PropertyComparable->create();
				}
			}else{
				$val = '';
				$val = $response->GetSalesComparablesResult->SalesComparables->SalesComparable;
				$val->short_application_id = $shortAppDetail['ShortApplication']['id'];
				$this->PropertyComparable->save($val);
				$this->PropertyComparable->create();
			}
		}
		return true;
	}
	
	/**
	 * Description :- _saveAVM
	 * @var object : $shrotAppId
	*/
	
	function _saveAVM($cityName = null,$stateCode = null,$shortAppDetail = array(),$propertyDetailId = null){
		$propertyName = $shortAppDetail['ShortApplication']['property_address'];
		$request = '<Sami>
   <Terms><Term><Property><Address><AddressLine1>'.$propertyName.'</AddressLine1><City>'.$cityName.'</City>
<PostalCode>'.$shortAppDetail['ShortApplication']['property_zipcode'].'</PostalCode><State>'.$stateCode.'</State></Address></Property></Term></Terms></Sami>';
		$username = PITCH_POINT_USERNAME;
		$password = PITCH_POINT_PASSWORD;
		$URL='https://intg.pointservices.com/riskinsight-services-ws/resources/sami/001/AvmValuationQualityReport/PDF-001';
		$upload_dir = PROPERTY_AVM_DOCUMENT_PATH;
		$output = $this->executeCURL($request, $URL, $username, $password);
		$xml = simplexml_load_string($output);
		if($xml->Messages->Message->Code == 'I001' && $xml->Messages->Message->Description == 'Success') {
			$document = $xml->Attachments->Attachment->Document;
			$newname = time()."_AVM_".base64_encode($propertyDetailId).".pdf";
			$status = $this->convertToPDF($document, $upload_dir. $newname);
			if(isset($status)) {
				//move_uploaded_file($pdf, $upload_dir."/".$newname);
				$update['id'] = $propertyDetailId;
				$update['AVM'] = $newname;
				$this->PropertyDetail->save($update);
			}
		}
		return true;
	}
    
    function convertToPDF($base64 = null,$pdfName = null){
        $binary = base64_decode($base64);
        file_put_contents($pdfName, $binary);
		return true;
    }
    
    function executeCURL($request = null, $URL = null, $username = null, $password = null) {
        $ch = curl_init();
		$headr = array();
		$headr[] = 'Content-type: application/xml;charset=UTF-8';
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
		curl_setopt($ch, CURLOPT_POST,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false ); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , false );
		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		$output = curl_exec($ch);
		//echo $output; 
		curl_close($ch);
        return $output;
    }
    
    /**
	 * Description :- updateLoanUser
	 * @var object :- $loanId, $userType, $userId
	*/
	function updateLoanUser($loanId = null, $userType = null, $userId = null){
		App::import("Model", "LoanUser");  
        $this->LoanUser = new LoanUser();
		$data['loan_id'] = $loanId;
		$data['user_type'] = $userType;
		$data['user_id'] = $userId;
		$alreadyExist = $this->LoanUser->find('first',array('conditions'=>array('loan_id'=>$loanId,'user_type'=>$userType,'user_id'=>$userId)));
		if(empty($alreadyExist)){
			$this->LoanUser->create();
			$this->LoanUser->save($data);
			$userDetail = $this->getUserDetail($userId,'1');
			if(!empty($userDetail['UserDetail']['referred_by_user_id'])){
				$userDetail = $this->getUserDetail($userDetail['UserDetail']['referred_by_user_id']);
				$this->updateLoanUser($loanId,$userDetail['User']['user_type'],$userDetail['User']['id']);
			}
		}
		return true;
	}
    /**
	 * Description :- getLoanNumber
	 * @var object :- $loanId, $userType, $loanDate
	*/
    function getLoanNumber($loanId = null) { 
        App::import("Model", "Loan");  
        $this->Loan = new Loan();
        $loanNumber = '';
        $loanDetail = $this->Loan->find('first',array('conditions'=>array('id'=>$loanId),'fields'=>array('Loan.loan_number'),'recursive'=>-1));
        if(!empty($loanDetail)) {
            
            $loanNumber = $loanDetail['Loan']['loan_number'];
        }
        return $loanNumber;
    }
    
     /**
	 * Description :- getTeamMember
	 * @var object :- $userID, $userType
	*/
    function getTeamMember($userID = null, $userType =  null) {
        $teamId = $this->getTeam($userID);
        App::import("Model", "TeamMember");  
        $this->TeamMember = new TeamMember();
        $memberDetail = $this->TeamMember->find('first',array('conditions'=>array('team_id'=>$teamId, 'member_type' => $userType),'fields'=>array('TeamMember.team_member_id')));
        $memberID = '';
        if(!empty($memberDetail)) {
            $memberID = $memberDetail['TeamMember']['team_member_id'];
        }
        return $memberID;
        
    }
    
    /**
    * Description :- uploadAdditionalChecklist - to upload additional supporting collateral, not just the required upload able documents.
	* @var object :- $userID, $userType
    */
    
    function uploadAdditionalChecklist($postData) {
        App::import("Model", "Checklist");  
        $this->Checklist = new Checklist();
        App::import("Model", "LoanDocument");  
        $this->LoanDocument = new LoanDocument();
        $valid  = array('docx','pdf');
        if(!empty($postData['Checklist'])) { 
            if($postData['Checklist']['type'] == 'property'){
                $path = WWW_ROOT."upload/";
                $model = 'Checklist';
                $field = 'value';
            }else {
                $path = WWW_ROOT."document/";
                $model = 'LoanDocument';
                $field = 'name';
            }
        
            if(isset($postData['Checklist']['document']['name']) && !empty($postData['Checklist']['document']['name'])) {
                $name = $this->sanitize_document_name($postData['Checklist']['document']['name']);
                $file_path = $path.$name;
                if($postData['Checklist']['document']['error']!=0) {
                    $flag = false;
                } else if($postData['Checklist']['document']['size'] > 2000000) {
                    $flag = false;
                } else {
                    if(move_uploaded_file($postData['Checklist']['document']['tmp_name'], $file_path)) {
                       $data[$model][$field] = $name;
                       $data[$model]['download_form'] = 1;
                    }	
                }
            }
            $data[$model]['checklistname'] = $postData['Checklist']['checklistname'];
            $data[$model]['user_id'] = $this->Session->read('userInfo.id');
            $data[$model]['loan_id'] = base64_decode($postData['Checklist']['loan_id']);
            $this->$model->save($data);
        }
    }
    
    /**
     * Description :- sendNotificationToInvestors
     * @var object $loanId, $investorsList
    */
    
    function sendNotificationToInvestors($loanId = null, $investorsList = array()){
        App::import("Model", "LoanHoldRequest");  
        $this->LoanHoldRequest = new LoanHoldRequest();
        if(!empty($investorsList)){
            foreach($investorsList as $key=>$val){
                $message = "Hello {{NAME}}, <br/><br/> Thanks for your interest with on investment on loan with OTD. <br /><br/> Unfortunately we are not able to consider you investment on this loan, as we have an investor who is willing to invest 100% on this loan. <br /><br/> Thanks and sorry for the inconvenience.<br /><br /><br/> Thanks & Regards <br/> OTD TEAM";
                $this->sendMessageToUser($val['hold_by'], '1','Notification : On Loan Investment with OTD', $message);
            }
        }
        return true;
    }
    
    /**
     * Description :- sendMessageToUser
     * @var object $receiverId, $senderId, $subject $message
    */
    
    function sendMessageToUser($receiverId = null, $senderId = null, $subject = null, $message = null){
        App::import("Model", "Message");  
        $this->Message = new Message();
        $this->Message->create();
        $userDetail = $this->getUserDetail($receiverId);
        $message = str_replace('{{NAME}}', $userDetail['User']['first_name'].' '.$userDetail['User']['last_name'], $message);
        return $this->Message->save(array('receiver_id' => $receiverId,'sender_id' => $senderId, 'subject' => $subject, 'message' => $message));
    }
    
    /**
     * Summary :- Get User Detail
     * @param	Object	$userId		Description :- UserId
     * @param	Object	$bindModel	Description :- BindModel
     * @return	object				Description :- Get User Detail
    */
    
    function getUserDetail($userId = null,$bindModel = null){
        App::import("Model", "User");  
        $this->User = new User();
        if(empty($bindModel)){
            $this->User->unbindModel(array('hasOne'=>array('UserDetail')));
        }
        return $this->User->findById($userId);
    }
    
    /**
     * Description :- __moratgeTypes
     * @var object :- __moratgeTypes
    */
    
    function __moratgeTypes() {
        $mortageArray =  array(
                            'VA' => 'VA',
                            'Conventional' => 'Conventional',
                            'FHA' => 'FHA',
                            'USDA/Rural Housing Service' => 'USDA Service',
                            'Other' => 'Other (explain):'
                        );
        return $mortageArray;
        
    }
    
        /**
     * Description :- __amortizationTypes
     * @var object :- __amortizationTypes
    */
    
    function __amortizationTypes(){
        $amortizationArray =  array(
                            'Fixed Rate' => 'Fixed Rate',
                            'GPM' => 'GPM',
                            'ARM' => 'ARM (type)',
                            'Other' => 'Other (explain):'
                        );
        return $amortizationArray;
       
    }
    /**
     * Description :- __loanPurpose
     * @var object :- __loanPurpose
    */
    
    function __loanPurpose(){
        $loanArray =  array(
                            'Purchase' => 'Purchase',
                            'Construction' => 'Construction',
                            'Refinance' => 'Refinance',
                            'Construction-Permanent' => 'Construction-Permanent',
							'Other' => 'Other (explain):'
                        );
        return $loanArray;
        
    }
    
    /**
     * Description :- __propertyType
     * @var object :- __propertyType
    */
    
    function __propertyType(){
        $propertyArray =  array(
                            'Primary Residence' => 'Primary Residence',
                            'Secondary Residence' => 'Secondary Residence',
                            'Investment' => 'Investment'
                        );
        return $propertyArray;
       
    }
    
    
	/**
     * Description :- __estimateValues
     * @var object :- __estimateValues
    */
    
    function __estimateValues(){
        $estimateArray =  array(
                            'Fee Simple' => 'Fee Simple',
                            'leasehold' => 'Leasehold'
                        );
       return $estimateArray;
    }
    
      
	/**
	 * Summary
	 * @return	object		Description
	 */
	
	function __maritalStatus(){
		$maritalStatus = array('Married'=>'Married','Unmarried'=>'Unmarried(includes single, divorced, widowed)','Separated'=>'Separated');
        return $maritalStatus;
		
	}
    
    /**
     * Description :- processor_document
     * @var object :-
    */
    
    function processor_document(){
        $processorDocuments =  array(
                            'FullApp' => '1003',
                            'MLDS' => 'GFE',
                            'TIL' => 'TIL'
                        );
       return $processorDocuments;
    }
    
    /**
	 * Description :- saveBorrowerNotification
	 * @var object :- $action, $senderID, $loanID
	*/
    function saveBorrowerNotification($action = null, $senderID = null, $loanID =  null) {
        App::import("Model", "Notification");  
        $this->Notification = new Notification();
        App::import("Model", "ShortApplication");  
        $this->ShortApplication = new ShortApplication();
        App::import("Model", "Loan");  
        $this->Loan = new Loan();
		$loanDetail = $this->Loan->findById($loanID);
        if(count($loanDetail)) {
            $shortAppID = $loanDetail['Loan']['short_app_id'];
            $data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
            if(!empty($data)) {
                $notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
                $notificationData['Notification']['sender_id'] = $senderID;
                $notificationData['Notification']['action'] = $action;
                $notificationData['Notification']['action_id'] = $loanID;
                $notificationData['Notification']['type'] = 2;
                $notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
                //pr($notificationData);
                $this->Notification->create();
                $this->Notification->save($notificationData);
            }
        }
    }
    
    /**
	 * Description :- saveBrokerNotification
	 * @var  :- $action, $senderID, $loanID
	*/
    function saveBrokerNotification($action = null, $senderID = null, $loanID =  null) {
        App::import("Model", "Notification");  
        $this->Notification = new Notification();
        App::import("Model", "LoanUser");  
        $this->User = new LoanUser();
		$broker = $this->LoanUser->find('first',array('conditions'=>array('loan_id'=>$loanID,'user_type'=>2)));
		if(!empty($broker)) {
            $notificationData['Notification']['receiver_id'] = $broker['LoanUser']['user_id'];
            $notificationData['Notification']['sender_id'] = $senderID;
            $notificationData['Notification']['action'] = $action;
            $notificationData['Notification']['action_id'] = $loanID;
            $notificationData['Notification']['type'] = 2;
            $notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
            $this->Notification->create();
            $this->Notification->save($notificationData);
        }
    }
    
    /**
	 * Description :- saveToDo
	 * @var  :- $action, $senderID, $loanID
	*/
    function saveToDo($todo = null, $receiverID = null, $senderID = null, $toDoId =  null) {
        App::import("Model", "Todo");  
        $this->Todo = new Todo();
        $todoData['Todo']['receiver_id'] = $receiverID;
        $todoData['Todo']['sender_id'] = $senderID;
        $todoData['Todo']['to_do'] = $todo;
        $todoData['Todo']['to_do_id'] = $toDoId;
        $todoData['Todo']['created'] = CURRENT_DATE_TIME_DB;
        pr($todoData); die();
        $this->Todo->create();
        $this->Todo->save($todoData);
       
    }

    /**
	 * Description :- saveToDo
	 * @var  :- $action, $senderID, $loanID
	*/
    function approveInvestorCounterOffer($loanId = null, $loanNumber = null, $shortAppID = null, $dynamicNotification = null) {
        App::import("Model", "LoanPhase");  
        $this->LoanPhase = new LoanPhase();
        App::import("Model", "LoanHoldRequest");  
        $this->LoanHoldRequest = new LoanHoldRequest();
        App::import("Model", "LoanUser");  
        $this->LoanUser = new LoanUser();
        App::import("Model", "LoanLog");  
        $this->LoanLog = new LoanLog();
        App::import("Model", "Notification");  
        $this->Notification = new Notification();
        App::import("Model", "LoanLog");  
        $this->LoanLog = new LoanLog();
    
        $this->LoanHoldRequest->updateAll(array('status' =>1), array('loan_id' => $loanId));
		$loanStatus = $this->LoanPhase->find('first',array('conditions'=>array('LoanPhase.loan_id'=>$loanId, 'LoanPhase.loan_phase' => 'G')));
        if(empty($loanStatus)) {
            $loanPhaseData['LoanPhase']['loan_phase'] = 'G';
            $loanPhaseData['LoanPhase']['loan_id'] = $loanId;
            $loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;
            $this->LoanPhase->save($loanPhaseData);
        }
        //Trust Deed Investor - Conditions Approved
        $loanCyclephase = 17;
        $this->Loan->id = $loanId;
        $this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
        $funderDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanId,'user_type' => 6),'fields' =>array('LoanUser.user_id')));
        if(!empty($funderDetail)) {
            $notificationData['Notification']['receiver_id'] = $funderDetail['LoanUser']['user_id'];
            $notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
            $notificationData['Notification']['action'] = $loanNumber .' - ' . $dynamicNotification .' Check <a href="'.BASE_URL.'funders/loan_document/'.base64_encode($loanId).'"> loan documents </a> to further process loan';
            $notificationData['Notification']['action_id'] = $loanId;
            $notificationData['Notification']['type'] = 2;
            $notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
            $this->Notification->create();
            $this->Notification->save($notificationData);
            $msg = 'Trust Deed Investor - Conditions Requested';
        }
        
		$logData['LoanLog']['user_id']= $this->Session->read('userInfo.id');
		$logData['LoanLog']['short_application_ID']= $shortAppID;
		$logData['LoanLog']['action']= 17;
		$logData['LoanLog']['description'] = 'Trust Deed Investor - Conditions Accepted ';
		$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
		$this->LoanLog->create();
		$this->LoanLog->save($logData);
        //save investor Id in loan user
        $loanInvestors = $this->LoanHoldRequest->find('all', array('conditions'=>array('LoanHoldRequest.loan_id' => $loanId,'LoanHoldRequest.status' =>1),'fields' =>array('LoanHoldRequest.hold_by')));
        foreach($loanInvestors as $key => $investor) {
            //update investor user id in loan user table
            $this->updateLoanUser($loanId, 7, $investor['LoanHoldRequest']['hold_by']);
        }
       return true;
    }
    
        /**
	 * Description :- getLoanEscrowID
	 * @var  :- $action, $senderID, $loanID
	*/
    function getLoanEscrowID($loanID  =  null) {
        App::import("Model", "EscrowDocument");
        $this->EscrowDocument = new EscrowDocument();
        $escrowDetail = $this->EscrowDocument->find('first', array('conditions'=>array('EscrowDocument.loan_id' => $loanID),'fields' =>array('EscrowDocument.escrow_officer_id')));
       
        $escrow = '';
        if(!empty($escrowDetail)){
            $escrow  = $escrowDetail['EscrowDocument']['escrow_officer_id'];
        }
        return $escrow;
    }
    
}