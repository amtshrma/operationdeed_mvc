<?php
/**
 *@Created 	: 20 August 2015
 *@Developer	: Manish Kumar
 *@Uses		: Common component for send emails
 */


App::uses('Component', 'Controller');

class CustomEmailComponent extends Component {

    var $components = array('Session','RequestHandler', 'Email');
    
    /*
    * This function is used to send email with template
    * @copyright     smartData Enterprise Inc.
    * @method        sendEmail
    * @param         $to, $subject, $messages, $from, $reply,$path,$file_name
    * @return        void 
    * @since         version 0.0.1
    * @version       0.0.1 
    */
    
    function sendEmail($to = null, $subject ='', $messages = null, $from=null, $reply = null,$path=null,$file_name = null) {
		
		$this->Email->smtpOptions = array(
            'transport' => 'Smtp',
			'host' => 'ssl://smtp.gmail.com',
			'username' => 'osgroup.sdei@gmail.com',
			'password' => 'mohali2378',
			'timeout' => '60',
            'port' => '465'
		);
		$this->Email->delivery = 'smtp';//possible values smtp or mail 
	$admin_name = Configure::read('ADMIN_NAME');
		
		if(empty($reply)){
			$reply = $admin_name.'<'.Configure::read('replytoEmail').'>';
		}
		
		if(empty($from)){
			
			$from = $admin_name.'<'.Configure::read('fromEmail').'>';
		}
		
		$this->Email->from = $from;
		$this->Email->replyTo = $reply;
		
		if($to == 'admin'){
			$this->Email->to = $from;
		} else {
			$this->Email->to = $to;
		}
		
		if(!empty($path) && !empty($file_name)){
			$this->Email->attachments = array($file_name,$path.$file_name);
		}
		if(empty($subject)){
		   $subject='Admin'; 
		}
		$this->Email->subject = $subject;
		$this->Email->sendAs= 'both';
		$this->Email->template='default';
		if($this->Email->send($messages)){
			return true;
		} else {
			return false;
		}
    }
	
	/**
     *@Created	: 20 August 2015
     *@Developer: Manish Kumar
     *@uses	: To get email template by - Template Code
     */
    
    function __getEmailTemplate($templateCode = null) {
        
        App::import('Model','EmailTemplate');
        $this->EmailTemplate = new EmailTemplate;
        
        if(!empty($templateCode)) {
            $result = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => "$templateCode")));
            if(is_array($result) && !empty($result)) { 
                return ($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	
	/**
	 * @Custom Functions for Sending Email with Operation Trust Deed Project
	 */
	
	function __sendEmailNotificationOnAddUser($hashCode, $firstName, $email, $password) {
		
		$active =  '<a href = "' .BASE_URL. '/users/secure_check/'.$hashCode.'">Click to activate your account </a>'; 
		$logo = '<img src="'.BASE_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		
		// Get Template
        $template=$this->__getEmailTemplate('welcome_to_site');
		
		$to = $this->request->data['User']['email_address'];
		
		$data = $template['EmailTemplate']['template'];
		
		$data = str_replace('{FirstName}', ucfirst($firstName), $data);
		$data = str_replace('{Email}', $email, $data);
		$data = str_replace('{Password}', $password, $data);
		$data = str_replace('{Link}', $active, $data);
		$data = str_replace('{Logo}', $logo, $data);
		$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
		if($this->sendEmail($to,$subject,$data)) {
			return true;
        }else{
			return false;
        }
	}    
    
    /**
    *@Created	: 21 July 2015
    *@Developer: Manish Kumar
    *@uses	: To send email - Forget password email
    */
    
    function __sendTrustDeedFlyerEmail($firstName = null, $email = null, $loanID = null) {
        // Get Template
        $template=$this->__getEmailTemplate('trust_deed_flyer_final_publish');
		$to = $email;
		$subject = $template['EmailTemplate']['name'];
		$link =  '<a href = "' .BASE_URL. 'homes/register/'.base64_encode('7').'">Click </a>';
        $data = $template['EmailTemplate']['template'];        
        $data = str_replace('{FirstName}',$firstName, $data);
		$logo = '<img src="'.BASE_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$data = str_replace('{Logo}', $logo, $data);
		$data = str_replace('{Link}', $link, $data);	
		$path = WWW_ROOT."files/pdf/TrustDeedFlyer/";		
		$fileName = 'trust_deed_flyer_'.$loanID.'.pdf';
        if($this->sendEmail($to,$subject,$data, null, null, $path, $fileName)) {
			return true;
        }else{
			return false;
        }
    }
	
	/**
    *@Created	: 05 Oct 2015
    *@Developer: Manish Kumar
    *@uses	: To send email - API - Registration Email
    */
    
    function __sendRegistrationEmailAPI($userDetail = null) {
		// Get Template
        $template=$this->__getEmailTemplate('user_registration');
        $active =  '<a href = "' .BASE_URL. '/users/secure_check/'.$userDetail['random_key'].'">Click to activate your account </a>';
		$to = $userDetail['email_address'];
		$subject = $template['EmailTemplate']['name'];
        $data = $template['EmailTemplate']['template'];
		$data = str_replace('{FirstName}', ucfirst($userDetail['first_name']), $data);
		$data = str_replace('{Email}', $userDetail['email_address'], $data);
		$data = str_replace('{Password}', $userDetail['password'], $data);
		$data = str_replace('{UserType}', $userDetail['user_type'], $data);
		$data = str_replace('{Link}', $active, $data);
		$logo = '<img src="'.BASE_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$data = str_replace('{Logo}', $logo, $data);
        if($this->sendEmail($to, $subject, $data)){
		    return true;
        } else {
			return false;
        }
    }
	
	/**
    *@Created	: 05 Oct 2015
    *@Developer	: Manish Kumar
    *@uses		: To send email - API - Short App
    */
	
	function __sendShortAppEmailNotification($arrShortApp = null) {
        $appObj = new AppController();
		// Get Template
        $template = $this->__getEmailTemplate('short_app_notification');
		$data = $template['EmailTemplate']['template'];
		App::import('Model','State');
        $this->State = new State;		
		App::import('Model','User');
        $this->User = new User;
		App::import('Model','Notification');
        $this->Notification = new Notification;
		$userTypeID = array(2,5);
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$notifiyUserEmail = $this->User->find('all',array('conditions'=>array('User.user_type'=>$userTypeID,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','email_address','name'),'order'=>'name ASC'));
		foreach($notifiyUserEmail as $user) {
			//save Notification
			$notificationData['Notification']['receiver_id'] = $user['User']['id'];
			$notificationData['Notification']['action'] = 'Short App';
			$notificationData['Notification']['action_id'] = $arrShortApp['id'];
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			$to = $user['User']['email_address'];
			$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
			$logo = '<img src="'.BASE_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
			$name = $arrShortApp['applicant_first_name'] . ' '. $arrShortApp['applicant_last_name'];
			$propertyType = $arrShortApp['property_type'];
			$propertyState = $arrShortApp['property_state'];
			$loanType = $arrShortApp['loan_type'];
			$loanReason = $arrShortApp['loan_reason'];
			$loanAmount = $arrShortApp['loan_amount'];
			$loanToValue = $arrShortApp['loan_to_value'];
			$data = str_replace('{FirstName}',$user['User']['name'],$data);
			$data = str_replace('{Broker Email}',$this->request->data['ShortApplication']['email_address'],$data);
			$data = str_replace('{Name}',$name,$data);
			$data = str_replace('{Borrower Email Address}',$arrShortApp['applicant_email_ID'],$data);
			$data = str_replace('{Borrower Phone}',$arrShortApp['applicant_phone'],$data);
			$data = str_replace('{Property Name}',$arrShortApp['property_name'],$data);
			$data = str_replace('{Property Type}',$appObj->propertyTypes[$propertyType],$data);
			$data = str_replace('{Property State}',$states[$propertyState],$data);
			$data = str_replace('{Property City}',$arrShortApp['property_city'],$data);
			$data = str_replace('{Loan Type}',$appObj->loanTypes[$loanType],$data);
			$data = str_replace('{Loan Reason}',$appObj->loanReasons[$loanReason],$data);
			$data = str_replace('{Loan Amount}',$appObj->loanAmounts[$loanAmount],$data);
			$data = str_replace('{Loan To Value}',$appObj->approxLoanValues[$loanToValue],$data);
			$data = str_replace('{Loan Objective}',$arrShortApp['loan_objective'],$data);
			$data = str_replace('{Logo}',$logo,$data);
			return $this->sendEmail($to, $subject, $data);			
		}
	}
	
	/**
    *@Created	: 16 Nov 2015
    *@Developer: Manish Kumar
    *@uses	: To send email - API - Staff Registration Email
    */
    
    function __sendStaffRegistrationEmailAPI($userDetail = null) {
		// Get Template
        $template=$this->__getEmailTemplate('staff_registration');
        $active =  '<a href = "' .BASE_URL. '/users/secure_check/'.$userDetail['random_key'].'">Click to activate your account </a>';
		$to = $userDetail['email_address'];
		$subject = $template['EmailTemplate']['name'];
        $data = $template['EmailTemplate']['template'];
		$data = str_replace('{FirstName}', ucfirst($userDetail['first_name']), $data);
		$data = str_replace('{Email}', $userDetail['email_address'], $data);
		$data = str_replace('{Password}', $userDetail['password'], $data);
		$data = str_replace('{UserType}', $userDetail['user_type'], $data);
		// User Company Details - 
		$data = str_replace('{Link}', $active, $data);
		$logo = '<img src="'.BASE_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$data = str_replace('{Logo}', $logo, $data);
        if($this->sendEmail($to, $subject, $data)) {
		    return true;
        } else {
			return false;
        }
    }
	
	/**
    *@Created	: 04 May 2016
    *@uses	: To send email - Forget password email
    */
    
    function __sendAvailableTrustDeeds($firstName=null, $email=null, $loanID = null, $html = null) {
        // Get Template
        $template=$this->__getEmailTemplate('available_trust_deeds');
		$to = $email;
		$subject = $template['EmailTemplate']['name'];
        $data = $template['EmailTemplate']['template'];        
        $data = str_replace('{FirstName}',$firstName, $data);
		$logo = '<img src="'.BASE_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$data = str_replace('{Logo}',$logo,$data);
		$data = str_replace('{Date}',date('M d, Y', strtotime(CURRENT_DATE_TIME_DB)), $data);
		$data = str_replace('{Trust Deeds}',$html,$data);
        if($this->sendEmail($to,$subject,$data, null, null)) {
            return true;
        } else {
            return false;
        }
    }

	/**
    *@Created	: 20 May 2016
    *@uses	: To send LOI to borrower
    */
    
    function __sendLOIEmail($firstName=null, $email=null, $loanID = null, $html = null) {
        // Get Template
        $template=$this->__getEmailTemplate('borrower_loi_notification');
		$to = $email;
		$subject = $template['EmailTemplate']['name'];
		$site_Url = Configure::read('BASE_URL');
        $data = $template['EmailTemplate']['template'];
		$link =  '<a href = "' .$site_Url. 'homes/borrowerLogin/">Login to see</a>';
        $data = str_replace('{FirstName}',$firstName, $data);
		$logo = '<img src="'.BASE_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$data = str_replace('{Logo}',$logo,$data);
		$data = str_replace('{Link}',$link,$data);
        if($this->sendEmail($to,$subject,$data, null, null)) {
            return true;
        } else {
            return false;
        }
    }
	
	/**
    *@Created	: 13 Jun 2016
    *@uses	: To send  loan documents to the escrow officer 
    */
    
    function __sendEscrowEmail($firstName = null, $email = null, $loanID = null) {
        // Get Template
        $template=$this->__getEmailTemplate('escrow_notification');
		$to = $email;
		$subject = $template['EmailTemplate']['name'];
		$link =  '<a href = "' .BASE_URL. 'escrows/index/">Click </a>';
        $data = $template['EmailTemplate']['template'];        
		$logo = '<img src="'.BASE_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$data = str_replace('{Logo}', $logo, $data);
		$data = str_replace('{Link}', $link, $data);
        if($this->sendEmail($to,$subject,$data, null, null)) {
            return true;
        } else {	
            return false;
        }
    }
	
	/**
    *@Created	: 20 May 2016
    *@uses	: To send LOI to borrower
    */
    
    function __sendProcessorEmail($userName = null, $processorId = null) {
		App::import('Model','User');
        $this->User = new User();
		$receiverDetail = $this->User->find('first', array('conditions'=>array('User.id'=>$processorId),'fields'=>array('User.first_name', 'User.last_name', 'User.email_address')));
        $template=$this->__getEmailTemplate('new_submission_loan');
        //$to = 'connectanything@gmail.com';
		$to = $receiverDetail['User']['email_address'];
		$subject = $template['EmailTemplate']['name'];
		$site_Url = Configure::read('BASE_URL');
        $data = $template['EmailTemplate']['template'];
		$link =  '<a href = "' .$site_Url. 'homes/login/">Login</a>';
        $data = str_replace('{FirstName}',$receiverDetail['User']['first_name'], $data);
		$data = str_replace('{SenderName}',$userName, $data);
		$logo = '<img src="'.BASE_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$data = str_replace('{Logo}',$logo,$data);
		$data = str_replace('{Link}',$link,$data);
        if($this->sendEmail($to, $subject, $data, null, null)) {
            return true;
        } else {
            return false;
        }
    }
}
?>