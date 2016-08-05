<?php
/*
* Homes Controller class
* Functionality -  Manage the front end
* Created date - 18-Jun-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility');
//App::import('Controller','Commons');

class HomesController extends AppController {
		
		var $uses = array('User');
		var $name = 'Homes';
		var $components = array('Email','Cookie','Common','Paginator','Hybridauth');
	
		function beforeFilter() {
			$allow = array('login','index','social_login','social_endpoint','shortApp','logout','register','thankyou_message','shortApp','short_app_notification','shortapp_message','onlineLoanApplication','successfulHybridauth','fetch_all_users','borrower','test','investor','investor_login','investor_register','detail','getSavedCommission','create_ndnca');
			parent::beforeFilter();
			$this->checkUserSession($allow);
		}             
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 18-Jun-2015
	* Modified date - 
	*/
		function index() {
			$this->getRoleTypes();
			$this->layout = 'front';
		}
	
	/*
	* index function
	* Functionality -  onlineLoanApplication functionality
	* Created date - 18-Jun-2015
	* Modified date - 
	*/
	
		function onlineLoanApplication($shortAppID = null, $softQuateId = null) {
			$this->LoadAllModel(array('ShortApplication','Loan','LoanLog','SoftQuote','LoanPhase','TeamMember'));
			$this->layout = 'borrower_dashboard';
			$this->getLoanReasons();
			$this->getPropertyTypes();
			$shortAppId = base64_decode($shortAppID);
			$userData  = $this->Session->read('userInfo');
			$name = $userData['first_name']. ' '. $userData['last_name'];
			$shortAppDetails = $this->ShortApplication->findById($shortAppId);
			$this->set('shortAppDetail',$shortAppDetails);
			$softQuoteDetail = $this->SoftQuote->findById(base64_decode($softQuateId));
			
			if(!empty($this->request->data)) {			
				$userID = $softQuoteDetail['SoftQuote']['user_Id'];
				$teamID = $this->getUserTeam($userID);
				$this->request->data['Loan']['team_id'] = $teamID;
				$this->request->data['Loan']['short_app_id'] = $shortAppId;
				$this->request->data['Loan']['soft_quate_id'] = base64_decode($softQuateId);
				$this->request->data['Loan']['loan_life_cycle_phase'] = 4;
				$this->Loan->set($this->request->data);
				if($this->Loan->validates()){
					$this->Loan->save($this->request_data);
					$loanID = $this->Loan->id;
					//save loan Phase
					$loanPhaseData['LoanPhase']['loan_phase'] = 'A';
					$loanPhaseData['LoanPhase']['loan_id'] = $loanID;
					$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;
					$this->LoanPhase->save($loanPhaseData);
					
					//Assign Borrower to team if borrower team is empty, borrower will be assigned to user who have generated the soft quote
					if(!empty($teamID)) {
						$memberID = $this->request->data['Loan']['borrower_id'];
						$borrowerTeam = $this->TeamMember->find('first', array('condition' => array('team_member_id'=>$memberID,'member_type' =>1)));
						if(!empty($borrowerTeam) && isset($borrowerTeam['TeamMember']['team_id'])) {
							$memberData['TeamMember']['team_id'] = $teamID;
							$memberData['TeamMember']['member_type'] = 1;
							$memberData['TeamMember']['team_member_id'] = $memberID;
							$memberData['TeamMember']['status'] = 1;
							$memberData['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
							$this->TeamMember->save($memberData);
						}
					}
					//Save notification for borrower registration
					$action = 'Loan Application Applied';
					$senderID = $this->request->data['Loan']['borrower_id'];
					$actionID = $loanID;
					
					$this->Common->saveNotifications($action, $senderID, $actionID);
					//save loan log
					$logData['LoanLog']['user_id'] = $userData['id'];
					$logData['LoanLog']['short_application_ID'] = $shortAppId;
					$logData['LoanLog']['action'] = 'Loan Application';
					$logData['LoanLog']['description'] = 'Loan Application applied by '. $name;
					$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
					$this->LoanLog->save($logData);
					$this->redirect('loanSuccessMessage');
				}
			}
			$this->set('softQuoteDetail', $softQuoteDetail);
		}
	
	/*
	* register function
	* Functionality -  loanSuccessMessage
	* Created date - 19-Jun-2015
	* Modified date - 
	*/
	
		function loanSuccessMessage(){
			$this->layout = 'borrower_dashboard';
		}
	
	/*
	* register function
	* Functionality -  register functionality
	* Created date - 19-Jun-2015
	* Modified date - 
	*/
		function register($shortAppID = null) {  
				$this->layout = 'page';
				$this->getUserTypes();
				$this->getLicenceTypes();
				$this->getReferredBy();
				$roleTypes = $this->userTypes;
				$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog','Document','TeamMember'));
				if(isset($this->request->data) && !empty($this->request->data)){ //pr($this->request->data);
					$this->User->set($this->request->data['User']);
					$this->UserDetail->set($this->request->data['UserDetail']);
					$userValidate = $this->User->validates();
					$userDetailValidate = $this->UserDetail->validates();
					if($userValidate && $userDetailValidate) {
						/*****************image upload*****************/
						if(!empty($this->request->data['UserDetail']['profile_pic'])){ 
							if(isset($this->request->data['UserDetail']['profile_pic']['name']) && $this->request->data['UserDetail']['profile_pic']['name'] != ""){
								$file = $this->request->data['UserDetail']['profile_pic'];
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
									$this->request->data['UserDetail']['profile_picture'] = $filename;	
								}
							}
						}else {
							$filename = 'defaultUser.jpg';
							$this->request->data['UserDetail']['profile_picture'] = $filename;
						} 
						$password = $this->request->data['User']['password'];
						$this->request->data['User']['userPassword'] = base64_encode($password);
						$this->request->data['User']['password'] = md5($password);
						if($this->request->data['User']['user_type'] == 1) {
							$this->User->save($this->request->data['User']);
							$userID = $this->User->id;
							if(isset($shortAppID) && !empty($shortAppID)){
								$this->ShortApplication->id = base64_decode($shortAppID);
								$this->ShortApplication->saveField('borrower_ID',$userID);
								//assign borrower to broker's team, if broker has applied loan on behalf of borrower
								$shortAppData = $this->ShortApplication->findById(base64_decode($shortAppID));
								
								$brokerID = $shortAppData['ShortApplication']['broker_ID'];
								if(isset($brokerID) && $brokerID != 'Rockland'){
									$teamID = $this->getUserTeam($brokerID);
									
								}else {
									// If borrower direct to a Rockland website:the borrower will automatically be assigned to a funder or a broker loan officer working for Rockland. 
									$teamID = $this->Common->getInternalFunderTeam();		
								}
								if(!empty($teamID)) {
									$memberData['TeamMember']['team_id'] = $teamID;
									$memberData['TeamMember']['member_type'] = 1;
									$memberData['TeamMember']['team_member_id'] = $userID;
									$memberData['TeamMember']['status'] = 1;
									$memberData['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
									$this->TeamMember->save($memberData);
								}
								//Save notification for borrower registration
								$action = 'New Borrower Registered';
								$senderID = $userID;
								$actionID = $userID;
								
								//$this->Commons->saveNotifications($action, $senderID, $actionID);
								// Update Loan log - user_id once user registers
							
								$this->LoanLog->updateAll(
								  array('LoanLog.user_id' => $userID),
								  array('LoanLog.short_application_ID' => base64_decode($shortAppID), 'LoanLog.action' => 'Applied')
								); 
								
							}
							$this->request->data['UserDetail']['user_id'] = $userID;
							$this->request->data['UserDetail']['birthdate'] = $this->request->data['UserDetail']['date_of_birth'];
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
							$tempUserType = $this->request->data['User']['user_type'];
							$userType = $roleTypes[$tempUserType];
							$emailData = str_replace('{FirstName}',ucfirst($this->request->data['User']['first_name']),$emailData);
							$emailData = str_replace('{Email}',$this->request->data['User']['email_address'],$emailData);
							$emailData = str_replace('{Password}',$password,$emailData);
							$emailData = str_replace('{UserType}',$userType,$emailData);
							$emailData = str_replace('{Link}',$active,$emailData);
							$emailData = str_replace('{Logo}',$logo,$emailData);
							$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
							$this->sendEmail($to,$subject,$emailData);
							
							//User Logs
							$name = $this->request->data['User']['first_name'] .' '. $this->request->data['User']['last_name'];
							$logData['UserLog']['user_id'] = $userID;
							$logData['UserLog']['action'] = 'Registration';
							$logData['UserLog']['description'] = $name . ' registered in Operation trust deed';
							$this->UserLog->save($logData);
							$this->Session->setFlash('You have been registered successfully.','default',array('class'=>'alert alert-success'));
							$this->redirect(array('controller'=>'homes','action' => 'thankyou_message'));
						} else {
							$userData = $this->request->data['User'];
							$userDetailData = $this->request->data['UserDetail'];
							$userSessionData = array_merge($userData,$userDetailData);
							$this->Session->write('userSessionData', $userSessionData);
							$this->redirect(array('controller'=>'homes','action' => 'detail'));
						}
					} else {
						$userError = $this->User->validationErrors;
						$userDetailError = $this->UserDetail->validationErrors;
						$this->set('errors',array_merge($userError,$userDetailError));
					}   
				} else {
					$shortAppData = $this->ShortApplication->findById(base64_decode($shortAppID));
					if(count($shortAppData)) {
						$this->request->data['User']['first_name'] = $shortAppData['ShortApplication']['applicant_first_name'];
						$this->request->data['User']['last_name'] = $shortAppData['ShortApplication']['applicant_last_name'];
						$this->request->data['User']['email_address'] = $shortAppData['ShortApplication']['applicant_email_ID'];
						$this->request->data['User']['user_type'] = '1';
						$this->request->data['User']['company_name'] = $shortAppData['ShortApplication']['applicant_company_name'];
						$this->request->data['UserDetail']['mobile_phone'] = $shortAppData['ShortApplication']['applicant_phone'];
					}
				}
				$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
				$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
				$legalDocuments = $this->Document->find('all',array('fields'=>array('document_description','upload'),'conditions'=>array("Document.document_type"=>'legal')));
				$this->set('states',$states);
				$this->set('users',$users);
				$this->set('legalDocuments',$legalDocuments);
		}
	
	/*
	* shortApp function
	* Functionality -  short Application for applying loan functionality
	* Created date - 23-Jun-2015
	* Modified date - 
	*/
	
		function shortApp() {
				$this->loadAllModel(array('State','User','ShortApplication','LoanLog','TeamMember'));
				$this->getLoanTypes();
				$this->getLoanReasons();
				$this->getLoanAmounts();
				$this->getApproxLoanValues();
				$this->getPropertyTypes();
				$this->layout = 'short_app';
				if(isset($this->request->data) && (!empty($this->request->data))){ //pr($this->request->data['ShortApplication']); 
					$this->ShortApplication->set($this->request->data['ShortApplication']);
					if($this->ShortApplication->validates()) {
						if(!empty($this->request->data['ShortApplication']['broker_ID']) && $this->request->data['ShortApplication']['broker_ID'] != 'none'){
							
							$this->request->data['ShortApplication']['broker_ID'] = $this->request->data['ShortApplication']['broker_ID'];
						}else { 
							//unset($this->request->data['ShortApplication']['broker_ID']);
							$this->request->data['ShortApplication']['broker_ID'] = $this->request->data['ShortApplication']['default_broker'];
						}//pr($this->request->data['ShortApplication']); die();
						if($this->ShortApplication->save($this->request->data['ShortApplication'])) {
							$shortAppID = $this->ShortApplication->id;
							//Loan Logs
							$logData['LoanLog']['short_application_ID'] = $shortAppID;
							$logData['LoanLog']['action'] = 'Applied';
							$logData['LoanLog']['description'] = 'Short App is applied';
							$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
							$this->LoanLog->save($logData);
							$this->request->data['ShortApplication']['id'] = $shortAppID;
							$this->short_app_notification($this->request->data);
							$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
							//$this->redirect(array('action' => 'shortapp_message'));
							$this->redirect(array('controller'=>'homes','action' => 'register',base64_encode($shortAppID)));
						}
					}
				}
				$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
				$brokers = $this->User->find('list',array('conditions'=>array('User.user_type'=>2,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','name'),'order'=>'name ASC'));
				$this->set('states',$states);
				$this->set('brokers',$brokers);	
		}
	
	/*
	* Email Notification function
	* Functionality -  notify users of new loan application
	* Created date - 7-Jul-2015
	* Modified date - 
	*/
		function short_app_notification($data = array()) { 
			$this->loadAllModel(array('EmailTemplate','State','User','Notification'));
			$this->layout = '';
			$this->autoRender = false;
			$userTypeID = array(2,5);
			$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
			$notifiyUserEmail = $this->User->find('all',array('conditions'=>array('User.user_type'=>$userTypeID,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','email_address','name'),'order'=>'name ASC'));
			
			$site_Url = Configure::read('BASE_URL');
			$link =  '<a href = "' .$site_Url. '/homes/login/">Click to see application details </a>';
			foreach($notifiyUserEmail as $user) { 
				//save Notification
				$notificationData['Notification']['receiver_id'] = $user['User']['id'];
				$notificationData['Notification']['action'] = 'Short App';
				$notificationData['Notification']['action_id'] = $data['ShortApplication']['id'];
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
				
				$template = $this->EmailTemplate->getEmailTemplate('short_app_notification');
				$to = $user['User']['email_address'];
				$emailData = $template['EmailTemplate']['template'];					
				$logo = '<img src="'.$site_Url.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
				$name = $data['ShortApplication']['applicant_first_name'] . ' '. $data['ShortApplication']['applicant_last_name'];
				$propertyType = $data['ShortApplication']['property_type'];
				$propertyState = $data['ShortApplication']['property_state'];
				$loanType = $data['ShortApplication']['loan_type'];
				$loanReason = $data['ShortApplication']['loan_reason'];
				$loanAmount = $data['ShortApplication']['loan_amount'];
				$loanToValue = $data['ShortApplication']['loan_to_value'];
				$emailData = str_replace('{FirstName}',$user['User']['name'],$emailData);
				$emailData = str_replace('{Broker Email}',$this->request->data['ShortApplication']['email_address'],$emailData);
				$emailData = str_replace('{Name}',$name,$emailData);
				$emailData = str_replace('{Borrower Email Address}',$data['ShortApplication']['applicant_email_ID'],$emailData);
				$emailData = str_replace('{Borrower Phone}',$data['ShortApplication']['applicant_phone'],$emailData);
				$emailData = str_replace('{Property Name}',$data['ShortApplication']['property_name'],$emailData);
				$emailData = str_replace('{Property Type}',$this->propertyTypes[$propertyType],$emailData);
				$emailData = str_replace('{Property State}',$states[$propertyState],$emailData);
				$emailData = str_replace('{Property City}',$data['ShortApplication']['property_city'],$emailData);
				$emailData = str_replace('{Loan Type}',$this->loanTypes[$loanType],$emailData);
				$emailData = str_replace('{Loan Reason}',$this->loanReasons[$loanReason],$emailData);
				$emailData = str_replace('{Loan Amount}',$this->loanAmounts[$loanAmount],$emailData);
				$emailData = str_replace('{Loan To Value}',$this->approxLoanValues[$loanToValue],$emailData);
				$emailData = str_replace('{Loan Objective}',$data['ShortApplication']['loan_objective'],$emailData);
				$emailData = str_replace('{Logo}',$logo,$emailData);
				//pr($emailData); die();
				$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
				$this->sendEmail($to,$subject,$emailData);			
			}
		}
	
	/*
	* thankyou_message function
	* Functionality -  thankyou_message registration
	* Created date - 18-Jun-2015
	* Modified date - 
	*/
	
		function thankyou_message() { 
			$this->layout = 'page';
		}
	
		public function login() {
			
			$this->getRoleTypes();
			$remember_me = '';
			$this->layout = 'page';
			$this->loadAllModel(array('User'));
			if(isset($this->request->data) && (!empty($this->request->data))){
				$this->User->set($this->request->data);
				$email = $this->request->data['User']['email_address'];
				$userType = $this->request->data['User']['user_type'];
				$user_password  = md5($this->request->data['User']['password']);
				
				$userInfo = $this->User->find('first',array('fields'=>array('id','first_name','last_name','email_address','password','user_type'),'conditions'=>array("User.email_address" => $email,"User.user_type" => $userType,"User.password" => $user_password,"User.status"=>1,"User.is_deleted"=>0)));
		
				if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $user_password)) { 
					$this->Session->write('userInfo', $userInfo['User']);
					if(!empty($this->request->data['User']['remember_me'])) {
						$email = $this->Cookie->read('userEmail');
						$password = base64_decode($this->Cookie->read('userPass'));						
						if(!empty($email) && !empty($password)) {
							$this->Cookie->delete('userEmail');
							$this->Cookie->delete('userPass');     
						} 						
						$cookie_email = $this->request->data['User']['email'];						
						$this->Cookie->write('userEmail', $cookie_email, false, '+2 weeks');						
						$cookie_pass = $this->request->data['User']['password'];
						$this->Cookie->write('userPass', base64_encode($cookie_pass), false, '+2 weeks'); 
					}else {
						$email = $this->Cookie->read('userEmail');
						$password = base64_decode($this->Cookie->read('processorPass'));
						if(!empty($email) && !empty($password)) {
							$this->Cookie->delete('userEmail');
							$this->Cookie->delete('userPass');     
						}
					}
					$controller = $this->getControllerName($userType);
					
					$this->Session->write('userInfo.controller', $controller);
					//pr($this->Session->read('userInfo')); die();
					//$this->redirect(array("controller"=>$controller,"action" => "dashboard"));
					$this->redirect(array("controller"=>'commons',"action" => "loan"));  
				} else {
					$this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'flashError'));
				}
			}elseif($this->Session->check('userInfo')){
				$controller = $this->Session->read('userInfo.controller');
				$this->redirect(array("controller"=>$controller,"action" => "dashboard"));
				
			}else {
				$email = $this->Cookie->read('userEmail');
				$password = base64_decode($this->Cookie->read('userPass'));				
				if(!empty($email) && !empty($password)) {
					$remember_me  = true;
					$this->request->data['User']['email_address']  = $email;
					$this->request->data['User']['password']  = $password;					
				}				
			}
			$this->set('remember_me',$remember_me);
		}

		public function logout() {
			$this->Session->delete('userInfo');
			$this->Hybridauth->logout();
			$this->Session->delete('userInfo');
			$this->redirect(array("controller"=>"homes","action" => "login"));
		}
		
		/* social login functionality */
		public function social_login($provider=null,$userType=null) { 
			$this->Cookie->write('startSession',1);
			if( $this->Hybridauth->connect($provider) ){ 
				$this->successfulHybridauth($provider,$this->Hybridauth->user_profile,$userType);
			}else{
				// error
				$this->Session->setFlash($this->Hybridauth->error);
				$this->redirect(array("controller"=>"homes","action" => "dashboard"));
			}
			
		}

		public function social_endpoint($provider = null) {
				
				$this->Hybridauth->processEndpoint();
		}
	
		public function successfulHybridauth($provider, $incomingProfile,$userType) {
				$this->loadAllModel(array('Notification'));
				$roleTypes = $this->getRoleTypes();
				// #1 - check if user already authenticated using this provider before
				$this->User->recursive = -1;
				$existingProfile = $this->User->find('first', array(
					'conditions' => array('social_network_id' => $incomingProfile['User']['social_network_id'], 'social_network_name' => $provider,'user_type' =>$userType)
				));
				
				//pr($existingProfile); die();
				if ($existingProfile) { 
					// #2 - if an existing profile is available, then we set the user as connected and log them in
					$user = $this->User->find('first', array(
						'conditions' => array('id' => $existingProfile['User']['id'])
					));
					
					//$this->doSocialLogin($user,true);
					
					$controller = $this->getControllerName($userType);
					$user['User']['controller'] = $controller;
					$this->Session->write('userInfo',$user['User']);
					
					//$this->redirect(array("controller"=>$controller,"action" => "dashboard/"));
					$this->redirect(array("controller"=>'commons',"action" => "loan"));  
				} else { 
					$incomingProfile['User']['user_type']  = $userType;
					$this->User->save($incomingProfile, $validate = false);
					//code to save notification, Welcome New User on Sales Director Dashboard, Sales Manager Dashboard, Broker/Loan Officer Dashboard
					$userTypeID = array(2,3,4);
					$notifiyUserEmail = $this->User->find('all',array('conditions'=>array('User.user_type'=>$userTypeID,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','email_address','name','user_type'),'order'=>'name ASC'));
					foreach($notifiyUserEmail as $user) {
						$userType = $user['User']['user_type'];
						$addedUserType =  $roleTypes[$userType];
						$newUser = $user['User']['name'];
						$notificationData['Notification']['receiver_id'] = $user['User']['id'];
						$notificationData['Notification']['action'] = 'New'.$addedUserType. $newUser .'registered in Operation Trust Deed';
						$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
						$this->Notification->save($notificationData);
					}
					$this->Session->setFlash('Your ' . $incomingProfile['User']['social_network_name'] . ' account is now linked to your account.');
					//$this->doSocialLogin($incomingProfile);
					$controller = $this->getControllerName($userType);
					$user['User']['controller'] = $controller;
					$this->Session->write('userInfo',$user['User']);
					//$this->redirect(array("controller"=>$controller,"action" => "dashboard/"));
					$this->redirect(array("controller"=>'commons',"action" => "loan")); 
				}	
		}
	
		public function doSocialLogin($user, $returning = false) {
			//$action = base64_encode(json_encode($user)); 
			if($user){
				$userType = $user['User']['user_type'];
				if($returning){
					$this->Session->setFlash(__('Welcome back, '. $user['User']['first_name']));
				}else{
					$this->Session->setFlash(__('Welcome to our community, '. $user['User']['first_name']));
				} 
				$this->Session->write('userInfo',$user); 
				$controller = $this->getControllerName($userType);
				$this->Session->write('userInfo.controller', $controller);
				
				//$this->redirect(array("controller"=>$controller,"action" => "dashboard/"));
				$this->redirect(array("controller"=>'commons',"action" => "loan"));  
			}else{
				$this->Session->setFlash(__('Unknown Error could not verify the user: '. $user['User']['first_name']));
			}	
		}
	
	/*
	* thankyou_message function
	* Functionality -  thankyou_message for loan Inquiry
	* Created date - 18-Jun-2015
	* Modified date - 
	*/
	
		function shortapp_message() { 
			$this->layout = 'page';
		}
	
	/*
	* list all user with selected role ID
	* Functionality -  list all user with selected role ID
	* Created date - 7-Aug-2015
	* Modified date - 
	*/
	
		function fetch_all_users() {
			
			$this->layout = '';
			$this->loadAllModel(array('User')); 
			$userType = $this->request->data['user_type'];
			$allUsers = $this->User->find('list',array('conditions'=>array('User.user_type'=>$userType,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','name'),'order'=>'name ASC'));
			$this->set('allUsers',$allUsers);		
		}
	
	/**
     * Summary :- getAllNotification
     * @return	NULL
     * Description :- getAllNotification
     */
    
		public function getAllNotification(){
			$this->loadAllModel(array('Notification')); 
			$userArray = $this->Session->read('userInfo');
			$userID = $userArray['id'];
			$allNotifications = $this->Notification->find('all', array('conditions'=>array('Notification.receiver_id' =>$userID,'Notification.status'=>0),'order'=>'id DESC'));//pr($allNotifications);die;
			return $allNotifications;
		}
		
	/**
     * Summary :- getAllNotification
     * @return	NULL
     * Description :- getAllNotification
     */
    
		public function getUnreadNotification(){
			$this->loadAllModel(array('Notification')); 
			$userArray = $this->Session->read('userInfo');
			$userID = $userArray['id'];
			$notificationCount = $this->Notification->find('count', array('conditions'=>array('Notification.status'=>0,'Notification.receiver_id' =>$userID)));
			return $notificationCount;
		}
	
	
		public function borrower() {
			
			$remember_me = '';
			$this->layout = 'page';
			$this->loadAllModel(array('User'));
			if(isset($this->request->data) && (!empty($this->request->data))){
				$this->User->set($this->request->data);
				$email = $this->request->data['User']['email_address'];
				$userType = $this->request->data['User']['user_type'];
				$user_password  = md5($this->request->data['User']['password']);					
				$userInfo = $this->User->find('first',array('fields'=>array('id','first_name','last_name','email_address','password','user_type'),'conditions'=>array("User.email_address" => $email,"User.user_type" => $userType,"User.password" => $user_password,"User.status"=>1,"User.is_deleted"=>0)));
	
				if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $user_password)) { 
					$this->Session->write('userInfo', $userInfo['User']);
					if(!empty($this->request->data['User']['remember_me'])) {
						$email = $this->Cookie->read('userEmail');
						$password = base64_decode($this->Cookie->read('userPass'));						
						if(!empty($email) && !empty($password)) {
							$this->Cookie->delete('userEmail');
							$this->Cookie->delete('userPass');     
						} 						
						$cookie_email = $this->request->data['User']['email'];						
						$this->Cookie->write('userEmail', $cookie_email, false, '+2 weeks');						
						$cookie_pass = $this->request->data['User']['password'];
						$this->Cookie->write('userPass', base64_encode($cookie_pass), false, '+2 weeks'); 
					}else {
						$email = $this->Cookie->read('userEmail');
						$password = base64_decode($this->Cookie->read('processorPass'));
						if(!empty($email) && !empty($password)) {
							$this->Cookie->delete('userEmail');
							$this->Cookie->delete('userPass');     
						}
					}
					$controller = $this->getControllerName($userType);
					
					$this->Session->write('userInfo.controller', $controller);
					//pr($this->Session->read('userInfo')); die();
					$this->redirect(array("controller"=>$controller,"action" => "dashboard"));             
				} else {
					$this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'flashError'));
				}
			}elseif($this->Session->check('userInfo')){
				$controller = $this->Session->read('userInfo.controller');
				$this->redirect(array("controller"=>$controller,"action" => "dashboard"));
				
			}else {
				$email = $this->Cookie->read('userEmail');
				$password = base64_decode($this->Cookie->read('userPass'));				
				if(!empty($email) && !empty($password)) {
					$remember_me  = true;
					$this->request->data['User']['email_address']  = $email;
					$this->request->data['User']['password']  = $password;					
				}				
			}
			$this->set('remember_me',$remember_me);
		}

		public function borrower_logout() {
			$this->Session->delete('userInfo');
			$this->Session->delete('userInfo');
			$this->redirect(array("controller"=>"homes","action" => "borrower"));
		}
	
	
		public function investor_login() {
			$remember_me = '';
			$this->layout = 'page';
			$this->loadAllModel(array('User'));
			if(isset($this->request->data) && (!empty($this->request->data))){
				$this->User->set($this->request->data);
				$email = $this->request->data['User']['email_address'];
				$userType = $this->request->data['User']['user_type'];
				$user_password  = md5($this->request->data['User']['password']);
				
				$userInfo = $this->User->find('first',array('fields'=>array('id','first_name','last_name','email_address','password','user_type'),'conditions'=>array("User.email_address" => $email,"User.user_type" => $userType,"User.password" => $user_password,"User.status"=>1,"User.is_deleted"=>0)));
		
				if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $user_password)) { 
					$this->Session->write('userInfo', $userInfo['User']);
					if(!empty($this->request->data['User']['remember_me'])) {
						$email = $this->Cookie->read('userEmail');
						$password = base64_decode($this->Cookie->read('userPass'));						
						if(!empty($email) && !empty($password)) {
							$this->Cookie->delete('userEmail');
							$this->Cookie->delete('userPass');     
						} 						
						$cookie_email = $this->request->data['User']['email'];						
						$this->Cookie->write('userEmail', $cookie_email, false, '+2 weeks');						
						$cookie_pass = $this->request->data['User']['password'];
						$this->Cookie->write('userPass', base64_encode($cookie_pass), false, '+2 weeks'); 
					}else {
						$email = $this->Cookie->read('userEmail');
						$password = base64_decode($this->Cookie->read('processorPass'));
						if(!empty($email) && !empty($password)) {
							$this->Cookie->delete('userEmail');
							$this->Cookie->delete('userPass');     
						}
					}
					
					$controller = 'tdinvestors';
					
					$this->Session->write('userInfo.controller', $controller);
					//pr($this->Session->read('userInfo')); die();
					$this->redirect(array("controller"=>$controller,"action" => "dashboard"));             
				} else {
					$this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'flashError'));
				}
			}elseif($this->Session->check('userInfo')){
				$controller = $this->Session->read('userInfo.controller');
				$this->redirect(array("controller"=>$controller,"action" => "dashboard"));
				
			}else {
				$email = $this->Cookie->read('userEmail');
				$password = base64_decode($this->Cookie->read('userPass'));				
				if(!empty($email) && !empty($password)) {
					$remember_me  = true;
					$this->request->data['User']['email_address']  = $email;
					$this->request->data['User']['password']  = $password;					
				}				
			}
			$this->set('remember_me',$remember_me);
		}
	
	
	/*
	* investor_register function
	* Functionality -  investor_register functionality
	* Created date - 19-Jun-2015
	* Modified date - 
	*/
		function investor_register() {  
			$this->layout = 'page';
			$this->getInvestorType();
			$this->getLicenceTypes();
			
			$roleTypes = $this->userTypes;
			$this->loadAllModel(array('State','User','UserDetail','UserLog','Notification','LoanLog','Document','EmailTemplate'));
			if(isset($this->request->data) && !empty($this->request->data)){ //pr($this->request->data);
				 
				$this->User->set($this->request->data['User']);
				$this->UserDetail->set($this->request->data['UserDetail']);
				$userValidate = $this->User->validates();
				$userDetailValidate = $this->UserDetail->validates();
				if($userValidate && $userDetailValidate) {
					/*****************image upload*****************/
					if(!empty($this->request->data['UserDetail']['profile_pic'])){ 
						if(isset($this->request->data['UserDetail']['profile_pic']['name']) && $this->request->data['UserDetail']['profile_pic']['name'] != ""){ 
							$file = $this->request->data['UserDetail']['profile_pic'];
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
								$this->request->data['UserDetail']['profile_picture'] = $filename;	
							}
						}
					}else {
						$filename = 'defaultUser.jpg';
						$this->request->data['UserDetail']['profile_picture'] = $filename;
					} 
					$password = $this->request->data['User']['password'];
					$this->request->data['User']['password'] = md5($password);
				    if(count($this->request->data['User']['investor_type'])) {
						
						$this->request->data['User']['investor_type'] = implode(',',$this->request->data['User']['investor_type']);
					}
					if($this->User->save($this->request->data['User'])){
						$userID = $this->User->id;
						
						$this->request->data['UserDetail']['user_id'] = $userID;
						$this->request->data['UserDetail']['birthdate'] = $this->request->data['UserDetail']['date_of_birth'];
						/*$birthDate = '';
						if(count($this->request->data['UserDetail']['date_of_birth'])){
							foreach($this->request->data['UserDetail']['date_of_birth'] as $birth){
								if($birth){
									$birthDate .= $birth.'-';
								}
							}
						}
						unset($this->request->data['UserDetail']['date_of_birth']);
						$this->request->data['UserDetail']['birthdate'] = substr($birthDate,0,-1);*/
					
						
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
						$tempUserType = $this->request->data['User']['user_type'];
						
						$userType = 'Investor';
						$emailData = str_replace('{FirstName}',ucfirst($this->request->data['User']['first_name']),$emailData);
						$emailData = str_replace('{Email}',$this->request->data['User']['email_address'],$emailData);
						$emailData = str_replace('{Password}',$password,$emailData);
						$emailData = str_replace('{UserType}',$userType,$emailData);
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
				} else {
					$userError = $this->User->validationErrors;
					$userDetailError = $this->UserDetail->validationErrors;
					$this->set('errors',array_merge($userError,$userDetailError));
				}   
			} 
			$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
			$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
			$legalDocuments = $this->Document->find('all',array('fields'=>array('document_description','upload'),'conditions'=>array("Document.document_type"=>'legal')));
			$this->set('states',$states);
			$this->set('users',$users);
			$this->set('legalDocuments',$legalDocuments);
		}
	/*
	* register function
	* Functionality -  register functionality
	* Created date - 19-Jun-2015
	* Modified date - 
	*/
		function detail() {
			$userDetail = $this->Session->read('userSessionData'); //print_r($userDetail);
			$this->layout = 'page';
			$this->getUserTypes();
			$this->getLicenceTypes();
			$this->getReferredBy();
			
			$roleTypes = $this->userTypes;
			$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog','Document','TeamMember','Commission','UserDocument'));
			if(isset($this->request->data) && !empty($this->request->data)){ pr($this->request->data);
				$this->request->data['User']['first_name'] =  $userDetail['first_name'];
				$this->request->data['User']['last_name'] =  $userDetail['last_name'];
				$this->request->data['User']['email_address'] =  $userDetail['email_address'];
				$this->request->data['User']['password'] =  $userDetail['password'];
				$this->request->data['User']['user_type'] =  $userDetail['user_type'];
				$this->request->data['UserDetail']['company_name'] =  $userDetail['company_name'];
				$this->request->data['UserDetail']['company_position'] =  $userDetail['company_position'];
				$this->request->data['UserDetail']['birthdate'] =  $userDetail['date_of_birth'];
				$this->request->data['UserDetail']['mailing_address'] =  $userDetail['mailing_address'];
				$this->request->data['UserDetail']['state'] =  $userDetail['state'];
				$this->request->data['UserDetail']['city'] =  $userDetail['city'];
				$this->request->data['UserDetail']['fax_number'] =  $userDetail['fax_number'];
				$this->request->data['UserDetail']['zipcode'] =  $userDetail['zipcode'];
				$this->request->data['UserDetail']['mobile_phone'] =  $userDetail['mobile_phone'];
				$this->request->data['UserDetail']['office_phone'] =  $userDetail['office_phone'];
				$this->User->set($this->request->data['User']);
				$this->UserDetail->set($this->request->data['UserDetail']);
				$userValidate = $this->User->validates();
				$userDetailValidate = $this->UserDetail->validates();
					if($userValidate && $userDetailValidate) {
						/*****************image upload*****************/
						if(!empty($userDetail['profile_pic'])){ 
							if(isset($userDetail['profile_pic']['name']) && $userDetail['profile_pic']['name'] != ""){
								$file = $userDetail['profile_pic'];
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
									$this->request->data['UserDetail']['profile_picture'] = $filename;	
								}
							}
						}else {
							$filename = 'defaultUser.jpg';
							$this->request->data['UserDetail']['profile_picture'] = $filename;
						}
						$newname = '';
					
						if($this->User->save($this->request->data['User'])){ 
							$userID = $this->User->id;
							
							$this->request->data['UserDetail']['user_id'] = $userID;
							//save payment method
							$paymentMethod = 'none';
							if(!empty($this->request->data['paymentMethod'])){
								$paymentMethod = $this->request->data['paymentMethod'];
							}
							$this->request->data['UserDetail']['payment_method'] = $paymentMethod;
							if(!empty($this->request->data['UserDetail']['check_address'])) {
								$this->request->data['UserDetail']['check_address'] = $this->request->data['check_address'];
							}
							//pr($this->request->data['UserDetail']); die('hgjgh');
							$this->UserDetail->save($this->request->data['UserDetail'],array('validate'=>false));
							
							//save payment reference user ID
							if(!empty($this->request->data['UserDetail']['referred_by']) && $this->request->data['UserDetail']['referred_by'] != ''){
								$referredUserID = $this->request->data['UserDetail']['referred_by'];
								if(isset($referredUserID) && $referredUserID != ''){
									$teamID = $this->getUserTeam($referredUserID);
								} 
							}else {
								//If new outside broker loan officer or Sales Manager: the broker will be auto assigned to a funder and a team. 
								$teamID = $this->Common->getInternalFunderTeam();
								
							}
							// save team
							if(!empty($teamID)) {
								$referredData['TeamMember']['team_id'] = $teamID;
								$referredData['TeamMember']['member_type'] = $this->request->data['User']['user_type'];
								$referredData['TeamMember']['team_member_id'] = $userID;
								$referredData['TeamMember']['status'] = 1;
								$referredData['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
								
								$this->TeamMember->save($referredData);
						     }
							// save self commission
							if(!empty($this->request->data['User']['commission']) && $this->request->data['User']['commission'] != ''){
								$commissionData['Commission']['user_id'] = $userID;
								$commissionData['Commission']['user_type'] = $this->request->data['User']['user_type'];
								$commissionData['Commission']['commission'] = $this->request->data['User']['commission'];
								$commissionData['Commission']['status'] = '0';
								$commissionData['Commission']['created'] = CURRENT_DATE_TIME_DB;
								$this->Commission->create();
								$this->Commission->save($commissionData);
							
							}
							// save hireachy commission, if exist
							if(!empty($this->request->data['User']['other_commission']) && $this->request->data['User']['other_commission'] != ''){
								$commissionData['Commission']['user_id'] = $userID;
								$commissionData['Commission']['user_type'] = $this->request->data['User']['hireachyType'];
								$commissionData['Commission']['commission'] = $this->request->data['User']['other_commission'];
								$commissionData['Commission']['status'] = '1';
								$commissionData['Commission']['created'] = CURRENT_DATE_TIME_DB;
								$this->Commission->create();
								$this->Commission->save($commissionData);
							}
							
						// save user legal documents
						//pr($this->request->data['UserDetail']['agreement']);
						if(!empty($this->request->data['UserDetail']['agreement']) && $this->request->data['UserDetail']['agreement'] != ''){
						foreach($this->request->data['UserDetail']['agreement'] as $key=> $document) { //pr($document); die();
							$logDescription = '';
							$newname = '';
								if(isset($document['userDocument']['name']) && $document['userDocument']['name'] != '') {
									$flag = false;
									$str = explode('/',$document['userDocument']['type']);
									if($document['userDocument']['error'] != 0) {
										$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
										$flag = 'false';
									} else if($document['userDocument']['size'] > 2000000) {
										$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
										$flag = 'false';
									} else {
										$upload_dir = USER_SIGNUP_DOCUMENT_PATH;
										$filename = explode(".",$document['userDocument']['name']);
										$encodeUserID = base64_encode($userID);	
										$newname = $encodeUserID.".".$document['userDocument']['name'];
										move_uploaded_file($document['userDocument']['tmp_name'], $upload_dir."/".$newname);
										$this->request->data['UserDocument']['user_id'] = $userID;
										$this->request->data['UserDocument']['document_name'] = $document['name'];
										$this->request->data['UserDocument']['file_name'] = $newname;
										$this->UserDocument->create();
										$this->UserDocument->save($this->request->data['UserDocument']);
										//$logDescription .= '<a href= '.$upload_dir.$newname.'"target="_blank">'.$document['name'].'</a>';
										//$logDescription .= "<br/>";
									}
								}
							}
						}
					die();
							//welcome email notification
							
							
							//$hashCode =  md5(uniqid(rand(), true));
							//$this->User->saveField('random_key',$hashCode, false);
							//$site_URL = Configure::read('BASE_URL');
							//$active =  '<a href = "' .$site_URL. '/users/secure_check/'.$hashCode.'">Click to activate your account </a>'; 
							$logo = '<img src="'.$site_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
							$template = $this->EmailTemplate->getEmailTemplate('welcome_to_operation_trust_deed');
							$to = $this->request->data['User']['email_address'];
							$emailData = $template['EmailTemplate']['template'];					
							//$tempUserType = $this->request->data['User']['user_type'];
							$userType = $roleTypes[$tempUserType];
							$emailData = str_replace('{FirstName}',ucfirst($this->request->data['User']['first_name']),$emailData);
							/*$emailData = str_replace('{Email}',$this->request->data['User']['email_address'],$emailData);
							$emailData = str_replace('{Password}',base64_decode($userDetail['userPassword']),$emailData);
							$emailData = str_replace('{UserType}',$userType,$emailData);
							$emailData = str_replace('{Link}',$active,$emailData);
							$emailData = str_replace('{Logo}',$logo,$emailData);
							$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));*/
							//pr($emailData);
							$this->sendEmail($to,$subject,$emailData);
							
							//User Logs
							$name = $userDetail['first_name'] .' '. $userDetail['last_name'];
							$logData['UserLog']['user_id'] = $userID;
							$logData['UserLog']['action'] = 'Registration';
							$logData['UserLog']['description'] = $name . ' registered in Operation trust deed';
							$this->UserLog->save($logData);
							$this->Session->delete('userSessionData');
							$this->Session->setFlash('You have been registered successfully.','default',array('class'=>'alert alert-success'));
							$this->redirect(array('controller'=>'homes','action' => 'thankyou_message'));	
						}
					} else {
						$userError = $this->User->validationErrors;
						$userDetailError = $this->UserDetail->validationErrors;
						$this->set('errors',array_merge($userError,$userDetailError));
					}   
			} 
			
			$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
			$legalDocuments = $this->Document->find('all',array('fields'=>array('document_description','upload','name'),'conditions'=>array("Document.document_type"=>'legal','Document.user_type like'=>'%'.$userDetail['user_type'].'%')));
			
			$this->set('userDetail',$userDetail);
			$this->set('users',$users);
			$this->set('legalDocuments',$legalDocuments);
		}
	/*
	* getSavedCommission
	* Functionality -  getSavedCommission for selected user type decided by immediate senior team member i.e broker commisson decided by sales manager
	* Created date - 24-Dec-2015
	* Modified date - 
	*/
	
		function getSavedCommission() {
			$this->layout = '';
			$this->autoRender = false;
			$this->loadAllModel(array('Commission')); 
			$userId = $this->request->data['user_id'];
			$commission = '0';
			$savedCommission = $this->Commission->find('first',array('conditions'=>array('Commission.user_id'=>$userId,'Commission.status'=>1),'fields' => array('commission')));
			if(!empty($savedCommission)){
				$commission = $savedCommission['Commission']['commission'];
			}
			echo $commission;
			die();
		}
		
		/*
	* create_ndnca function
	* Functionality - create NDNCA document
	* Created date - 8-Jan-2016
	*/
	function create_ndnca() {
		$userDetail = $this->Session->read('userSessionData'); //pr($userDetail);
		$this->loadAllModel(array('Document'));
		$pdfTemplate = $this->Document->find('first', array('conditions' => array('Document.name like' => '%NDNCA%')));
		$this->set('pdfTemplate', $pdfTemplate);  //pr($pdfTemplate);
		$this->set('userDetail', $userDetail);
		$this->layout = '/pdf/default';
		$this->render('/Pdf/ndnca');
	
	}
		
}
?>