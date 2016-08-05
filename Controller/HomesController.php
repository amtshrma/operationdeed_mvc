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
	var $components = array('Email','Common','Paginator','Hybridauth');
	public $paginate = array('limit' => PAGINATION_LIMIT);
	
	/*
	* beforeFilter function
	* Functionality -  beforeFilter
	* Created date - 19-Jun-2015
	* Modified date - 
	*/
	
	function beforeFilter() {
		$allow = array('getCities','title365API','testApi','brokerStartup','investorStartup','investorStep3','registrationStartup','shortAppStartup','registerStep2','registerStep3','shortAppStep2','shortAppStep3','shortAppStep4','shortAppStep5','login','index','social_login','social_endpoint','shortApp','logout','register','thankyou_message','shortApp','short_app_notification','shortapp_message','onlineLoanApplication','successfulHybridauth','fetch_all_users','borrowerLogin','test','investor','investor_login','investor_register','getSavedCommission','forgot_password','create_pdf_document','managerStartup','managerStep3');
		parent::beforeFilter();
		$this->checkUserSession($allow);
	}
	
	/*
	* register function
	* Functionality -  register functionality
	* Created date - 19-Jun-2015
	* Modified date - 
	*/
	
	function register($userType = null, $referralID = null,$shortAppId = null){
		if(empty($userType)){
			$this->redirect(array('controller' => 'homes', 'action' => 'registrationStartup'));
		}
		if(!empty($userType)){
			$userType = base64_decode($userType);
			$this->Session->write('userTypeText',$this->userTypes[$userType]);
			$this->Session->write('userType',$userType);
			if($userType == '7' || $userType == '8'){
				$this->Session->write('activeMenu','investor');
			}else if($userType == '2' || $userType == '3' || $userType == '4'){
				$this->Session->write('activeMenu','broker');
			}else if($userType == '1'){
				$this->Session->write('activeMenu','borrower');
			}
		}
		$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog','Document','TeamMember'));
		//if is registering on referral by internal member
		if(!empty($referralID) && base64_decode($referralID) != '0'){
			$this->Session->write('referralID',$referralID);
		}
		$this->layout = 'short_app';
		//$this->getUserTypes();
		$this->getLicenceTypes();
		$this->getReferredBy();
		$roleTypes = $this->userTypes;
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->User->set($this->request->data['User']);
			$this->UserDetail->set($this->request->data['UserDetail']);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			if($userValidate && $userDetailValidate) {
				/*****************image upload*****************/
				if(!empty($this->request->data['UserDetail']['profile_pic']['name'])){ 
					if(!empty($this->request->data['UserDetail']['profile_pic']['name'])){
						$file = $this->request->data['UserDetail']['profile_pic'];
						$path = 'img/profile_pics';
						$folder_name = 'original';
						$multiple[] = array('folder_name'=>'thumb','height'=>'355','width'=>'300'); 
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
				}else{
					$filename = 'defaultUser.jpg';
					$this->request->data['UserDetail']['profile_picture'] = $filename;
				}
				unset($this->request->data['UserDetail']['profile_pic']);
				$password = $this->request->data['User']['password'];
				$this->request->data['User']['userPassword'] = base64_encode($password);
				$this->request->data['User']['password'] = md5($password);
				//pr($this->request->data);die;
				$this->Session->write('userData',$this->request->data);
				$this->Session->delete('shortApp');
				$this->redirect(array('controller'=>'homes','action'=>'registerStep2/'.base64_encode('step2').'/'.$shortAppId));
			} 
		}else if(empty($this->request->data) && !empty($shortAppId)){
			// if short app id filled previously
			$shortAppId = base64_decode($shortAppId);
			if($shortAppId){
				$shortAppData = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id'=>$shortAppId),'recursive'=>-1));
				$this->request->data['User']['first_name'] = $shortAppData['ShortApplication']['applicant_first_name'];
				$this->request->data['User']['last_name'] = $shortAppData['ShortApplication']['applicant_last_name'];
				$this->request->data['User']['email_address'] = $shortAppData['ShortApplication']['applicant_email_ID'];
				$this->request->data['UserDetail']['company_name'] = $shortAppData['ShortApplication']['applicant_company_name'];
				//$this->request->data['User']['email_address'] = $shortAppData['ShortApplication']['applicant_email_ID'];
				//$this->request->data['User']['email_address'] = $shortAppData['ShortApplication']['applicant_email_ID'];
			}
		}
		//pr($this->request->data);die;
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
		$legalDocuments = $this->Document->find('all',array('fields'=>array('document_description','upload'),'conditions'=>array("Document.document_type"=>'legal')));
		$this->set('states',$states);
		$this->set('users',$users);
		$this->set('legalDocuments',$legalDocuments);
	}
	
	/**
	 * Description:- registerStep2
	 * @var object :- none
	 */
	
	function registerStep2($step = null,$shortAppID = null){
		if(empty($step)){
			$this->redirect(array('controller'=>'homes','action' => 'register'));
		}
		if($this->Session->check('shortAppInfo.ShortApplication.id')){
			$shortAppID = base64_encode($this->Session->read('shortAppInfo.ShortApplication.id'));
		}
		$this->layout = 'short_app';
		$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog','Document','TeamMember'));
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->UserDetail->set($this->request->data['UserDetail']);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			if($userValidate && $userDetailValidate) {
				$userData = $this->Session->read('userData');
				foreach($this->request->data['UserDetail'] as $key=>$val){
					$userData['UserDetail'][$key] = $val;
				}
				if(!empty($userData)){
					if($userData['User']['user_type'] == 1) {
						unset($userData['User']['confirm_password']);
						$this->User->save($userData['User'],array('validate'=>false));
						$userID = $this->User->id;
						$teamID = $brokerID = '';
						if(isset($shortAppID) && !empty($shortAppID)){
							$this->ShortApplication->id = base64_decode($shortAppID);
							$this->ShortApplication->saveField('borrower_ID',$userID);
							$shortAppData = $this->ShortApplication->findById(base64_decode($shortAppID));
							if(!empty($shortAppData['ShortApplication']['broker_ID']) && $shortAppData['ShortApplication']['broker_ID'] != 'none'){
								if($shortAppData['ShortApplication']['broker_ID'] != 'Rockland'){ 
									$teamID = $this->getUserTeam($shortAppData['ShortApplication']['broker_ID']);
								}
							}
						}else{
							//if shortAppID is null, fetch ShortApplication data with matching email address. If exist, update borrower Id in ShortApplication table
							$checkShortApp = $this->ShortApplication->find('first',array('fields'=>array('id','broker_ID'),'conditions'=>array("ShortApplication.applicant_email_ID"=>$userData['User']['email_address']),'order' =>'id DESC'));
							pr($checkShortApp);
							if(!empty($checkShortApp)){
								
								$this->ShortApplication->id = $checkShortApp['ShortApplication']['id'];
								$this->ShortApplication->saveField('borrower_ID',$userID);
								if(!empty($checkShortApp['ShortApplication']['broker_ID']) && $checkShortApp['ShortApplication']['broker_ID'] != 'none'){
									if($checkShortApp['ShortApplication']['broker_ID'] != 'Rockland'){ 
										$teamID = $this->getUserTeam($checkShortApp['ShortApplication']['broker_ID']);
									}
								}
							}
						}
						if(empty($teamID)){
							$teamID = $this->Common->getInternalFunderTeam();
						}
						$memberData['TeamMember']['team_id'] = $teamID;
						$memberData['TeamMember']['member_type'] = 1;
						$memberData['TeamMember']['team_member_id'] = $userID;
						$memberData['TeamMember']['status'] = 1;
						$memberData['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
						$this->TeamMember->save($memberData);
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
						$userData['UserDetail']['user_id'] = $userID;
						$userData['UserDetail']['birthdate'] = $userData['UserDetail']['date_of_birth'];
						unset($userData['UserDetail']['date_of_birth']);
						$this->UserDetail->save($userData['UserDetail']);
						//welcome email notification
						$this->send_welcome_email($userData['User']);
						
						//User Logs
						$name = $userData['User']['first_name'] .' '. $userData['User']['last_name'];
						$logData['UserLog']['user_id'] = $userID;
						$logData['UserLog']['action'] = 'Registration';
						$logData['UserLog']['description'] = $name . ' registered in Operation trust deed';
						$this->UserLog->save($logData);
						$this->Session->setFlash('You have been registered successfully.','default',array('class'=>'alert alert-success'));
						$this->redirect(array('controller'=>'homes','action' => 'thankyou_message'));
					}else{
						$userDetail = $userData['UserDetail'];
						$userData = $userData['User'];
						$userSessionData = array_merge($userData,$userDetail);
						$this->Session->write('userSessionData', $userSessionData);
						if($userSessionData['user_type'] == '7'){
							$this->redirect(array('controller'=>'homes','action' => 'investorStep3/'.base64_encode('step3')));
						}elseif($userSessionData['user_type'] == '9' || $userSessionData['user_type'] == '12' || $userSessionData['user_type'] == '8'){
							$this->redirect(array('controller'=>'homes','action' => 'managerStep3/'.base64_encode('step3')));
						}else{
							$this->redirect(array('controller'=>'homes','action' => 'registerStep3/'.base64_encode('step3')));
						}
					}
				}
			}
		}else{
			$shortAppData = $this->ShortApplication->findById(base64_decode($shortAppID));
			if(count($shortAppData)){
				$this->request->data['User']['first_name'] = $shortAppData['ShortApplication']['applicant_first_name'];
				$this->request->data['User']['last_name'] = $shortAppData['ShortApplication']['applicant_last_name'];
				$this->request->data['User']['email_address'] = $shortAppData['ShortApplication']['applicant_email_ID'];
				$this->request->data['User']['user_type'] = '1';
				$this->request->data['User']['company_name'] = $shortAppData['ShortApplication']['applicant_company_name'];
				$this->request->data['UserDetail']['mobile_phone'] = $shortAppData['ShortApplication']['applicant_phone'];
			}
		}
		$states = $this->State->find('list',array('fields'=>array('id','name'),'conditions'=>array('status'=>'1'),'order'=>'name ASC'));
		$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status !="=>0,"User.is_deleted"=>0)));
		$legalDocuments = $this->Document->find('all',array('fields'=>array('document_description','upload'),'conditions'=>array("Document.document_type"=>'legal')));
		$this->set('shortAppID',$shortAppID);
		$this->set('states',$states);
		$this->set('users',$users);
		$this->set('legalDocuments',$legalDocuments);
	}
	
	/**
	 * Description:- registerStep3
	 * @var object :- none
	*/
	
	function registerStep3($step = null){
		if(empty($step)){
			$this->redirect(array('controller'=>'homes','action' => 'register'));
		}
		$userDetail = $this->Session->read('userSessionData'); //pr($userDetail);die;
		$referralID = '';
		if($this->Session->check('referralID')){
			$referralID = $this->Session->read('referralID');
		}
		$this->layout = 'short_app';
		$this->getUserTypes();
		$this->getLicenceTypes();
		$this->getReferredBy();
		//Configure::write('debug',2);
		$roleTypes = $this->userTypes;
		$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog','Document','TeamMember','Commission','UserDocument','Todo'));
		if(isset($this->request->data) && !empty($this->request->data)){
			foreach($this->request->data as $k=>$val){
				if(!empty($val) && is_array($val)){
					foreach($val as $k=>$v){
						$userDetail[$k] = $v;
					}
				}
			}
			unset($this->User->validate['confirm_password']);unset($this->User->validate['email_address']);
			$this->User->set($userDetail);
			$this->UserDetail->set($userDetail);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			if($userValidate && $userDetailValidate) {
				$newname = '';
				if($this->User->save($userDetail,array('validate'=>false))){ 
					$userID = $this->User->id;
					$userDetail['user_id'] = $userID;
					//save payment method
					$paymentMethod = 'none';
					if(!empty($userDetail['paymentMethod'])){
						$paymentMethod = $userDetail['paymentMethod'];
					}
					$userDetail['payment_method'] = $paymentMethod;
					if(!empty($userDetail['check_address'])) {
						$userDetail['check_address'] = $userDetail['check_address'];
					}
					$this->UserDetail->save($userDetail,array('validate'=>false));
					
					//save payment reference user ID
					if(!empty($userDetail['referred_by']) && $userDetail['referred_by'] != ''){
						$referredUserID = $userDetail['referred_by'];
						if(isset($referredUserID) && $referredUserID != ''){
							$teamID = $this->getUserTeam($referredUserID);
						}
					}else{
						//If new outside broker loan officer or Sales Manager: the broker will be auto assigned to a funder and a team. 
						$teamID = $this->Common->getInternalFunderTeam();
					}
					// save team
					if(!empty($teamID)){
						$referredData['TeamMember']['team_id'] = $teamID;
						$referredData['TeamMember']['member_type'] = $userDetail['user_type'];
						$referredData['TeamMember']['team_member_id'] = $userID;
						$referredData['TeamMember']['status'] = 1;
						$referredData['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
						$this->TeamMember->save($referredData);
					}
					// save self commission
					if(!empty($userDetail['commission']) && $userDetail['commission'] != '' && $userDetail['commission'] != 0){
						$commissionData['Commission']['user_id'] = $userID;
						$commissionData['Commission']['user_type'] = $userDetail['user_type'];
						$commissionData['Commission']['commission'] = $userDetail['commission'];
						$commissionData['Commission']['status'] = '0';
						$commissionData['Commission']['created'] = CURRENT_DATE_TIME_DB;
						$this->Commission->create();
						$this->Commission->save($commissionData);
					}
					// save hireachy commission, if exist
					if(!empty($userDetail['other_commission']) && $userDetail['other_commission'] != '' && $userDetail['other_commission'] != 0){
						$commissionData['Commission']['user_id'] = $userID;
						$commissionData['Commission']['user_type'] = $userDetail['hireachyType'];
						$commissionData['Commission']['commission'] = $userDetail['other_commission'];
						$commissionData['Commission']['status'] = '1';
						$commissionData['Commission']['created'] = CURRENT_DATE_TIME_DB;
						$this->Commission->create();
						$this->Commission->save($commissionData);
					}
					if(!empty($userDetail['agreement']) && $userDetail['agreement'] != ''){
						foreach($userDetail['agreement'] as $key=> $document) { //pr($document); die();
							$logDescription = $newname = '';
							if(isset($document['userDocument']['name']) && $document['userDocument']['name'] != '') {
								$flag = false;
								$str = explode('/',$document['userDocument']['type']);
								if($document['userDocument']['error'] != 0){
									$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
									$flag = 'false';
								}else if($document['userDocument']['size'] > 2000000) {
									$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
									$flag = 'false';
								} else {
									$upload_dir = USER_SIGNUP_DOCUMENT_PATH;
									$filename = explode(".",$document['userDocument']['name']);
									$encodeUserID = base64_encode($userID);	
									$newname = $encodeUserID.".".$document['userDocument']['name'];
									move_uploaded_file($document['userDocument']['tmp_name'], $upload_dir."/".$newname);
									$userDetail['user_id'] = $userID;
									$userDetail['document_name'] = $document['name'];
									$userDetail['file_name'] = $newname;
									$this->UserDocument->create();
									$this->UserDocument->save($userDetail,array('validate'=>false));
								}
							}
						}
					}
					//welcome Email Notification
					$this->send_welcome_email($userDetail);
					//User Logs
					$name = $userDetail['first_name'] .' '. $userDetail['last_name'];
					$logData['UserLog']['user_id'] = $userID;
					$logData['UserLog']['action'] = 'Registration';
					$logData['UserLog']['description'] = $name . ' registered in Operation trust deed';
					$this->UserLog->save($logData);
						
						//TODO
					$todo = $name .' - registered in Operation trust deed. <a href="'.BASE_URL.'admin/users/add/'. base64_encode($userID).'"> Click </a> to activate user';
					$toDoData['Todo']['receiver_id'] = ADMIN_ID;
					$toDoData['Todo']['to_do'] = $todo;
					$toDoData['Todo']['to_do_id'] = $userID;
					$this->Todo->save($toDoData);
					
					$this->Session->delete('userSessionData');
					//$this->Session->delete('referralID');
					$this->Session->setFlash('You have been registered successfully.','default',array('class'=>'alert alert-success'));
					$this->redirect(array('controller'=>'homes','action' => 'thankyou_message'));	
				}
			}else{
				if(!empty($this->UserDetail->validationErrors['paymentMethod']['0'])){
					$this->set('validationErrors',$this->UserDetail->validationErrors['paymentMethod']['0']);
				}
			}
		} 
		$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
		$legalDocuments = $this->Document->find('all',array('fields'=>array('document_description','upload','name'),'conditions'=>array("Document.document_type"=>'legal','Document.user_type like'=>'%'.$userDetail['user_type'].'%')));
		$this->set('referralID',$referralID);
		$this->set('userDetail',$userDetail);
		$this->set('users',$users);
		$this->set('legalDocuments',$legalDocuments);
	}
	
	/**
	 * Description:- investorStep3
	 * @var object :- none
	*/
	
	function investorStep3($step = null){
		if(empty($step)){
			$this->redirect(array('controller'=>'homes','action' => 'register'));
		}
		$userDetail = $this->Session->read('userSessionData');
		$this->layout = 'short_app';
		$this->getInvestorType();
		$this->getLicenceTypes();
		$roleTypes = $this->userTypes;
		$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog','Document','TeamMember','Commission','UserDocument'));
		if(isset($this->request->data) && !empty($this->request->data)){
			foreach($this->request->data as $k=>$val){
				if(!empty($val) && is_array($val)){
					foreach($val as $k=>$v){
						$userDetail[$k] = $v;
					}
				}
			}
			unset($this->User->validate['confirm_password']);
			unset($this->User->validate['email_address']);
			if(!empty($userDetail['investor_type'])){
				$userDetail['investor_type'] = implode(',',$userDetail['investor_type']);
			}
			$this->User->set($userDetail);
			$this->UserDetail->set($userDetail);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			if($userValidate && $userDetailValidate){
				$newname = '';
				if($this->User->save($userDetail,array('validate'=>false))){ 
					$userID = $this->User->id;
					$userDetail['user_id'] = $userID;
					//save payment method
					$paymentMethod = 'none';
					if(!empty($userDetail['paymentMethod'])){
						$paymentMethod = $userDetail['paymentMethod'];
					}
					$userDetail['payment_method'] = $paymentMethod;
					if(!empty($userDetail['check_address'])) {
						$userDetail['check_address'] = $userDetail['check_address'];
					}
					$this->UserDetail->save($userDetail,array('validate'=>false));
					if(!empty($userDetail['referred_by']) && $userDetail['referred_by'] != ''){
						$referredUserID = $userDetail['referred_by'];
						if(isset($referredUserID) && $referredUserID != ''){
							$teamID = $this->getUserTeam($referredUserID);
						}
					}else{
						//If new outside broker loan officer or Sales Manager: the broker will be auto assigned to a funder and a team. 
						$teamID = $this->Common->getInternalFunderTeam();
					}
					// save team
					if(!empty($teamID)){
						$referredData['TeamMember']['team_id'] = $teamID;
						$referredData['TeamMember']['member_type'] = $userDetail['user_type'];
						$referredData['TeamMember']['team_member_id'] = $userID;
						$referredData['TeamMember']['status'] = 1;
						$referredData['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
						$this->TeamMember->save($referredData);
					}
					// save self commission
					if(!empty($userDetail['commission']) && $userDetail['commission'] != ''){
						$commissionData['Commission']['user_id'] = $userID;
						$commissionData['Commission']['user_type'] = $userDetail['user_type'];
						$commissionData['Commission']['commission'] = $userDetail['commission'];
						$commissionData['Commission']['status'] = '0';
						$commissionData['Commission']['created'] = CURRENT_DATE_TIME_DB;
						$this->Commission->create();
						$this->Commission->save($commissionData);
					}
					// save hireachy commission, if exist
					if(!empty($userDetail['other_commission']) && $userDetail['other_commission'] != ''){
						$commissionData['Commission']['user_id'] = $userID;
						$commissionData['Commission']['user_type'] = $userDetail['hireachyType'];
						$commissionData['Commission']['commission'] = $userDetail['other_commission'];
						$commissionData['Commission']['status'] = '1';
						$commissionData['Commission']['created'] = CURRENT_DATE_TIME_DB;
						$this->Commission->create();
						$this->Commission->save($commissionData);
					}
					if(!empty($userDetail['agreement']) && $userDetail['agreement'] != ''){
						foreach($userDetail['agreement'] as $key=> $document) { //pr($document); die();
							$logDescription = $newname = '';
							if(isset($document['userDocument']['name']) && $document['userDocument']['name'] != '') {
								$flag = false;
								$str = explode('/',$document['userDocument']['type']);
								if($document['userDocument']['error'] != 0){
									$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
									$flag = 'false';
								}else if($document['userDocument']['size'] > 2000000) {
									$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
									$flag = 'false';
								} else {
									$upload_dir = USER_SIGNUP_DOCUMENT_PATH;
									$filename = explode(".",$document['userDocument']['name']);
									$encodeUserID = base64_encode($userID);	
									$newname = $encodeUserID.".".$document['userDocument']['name'];
									move_uploaded_file($document['userDocument']['tmp_name'], $upload_dir."/".$newname);
									$userDetail['user_id'] = $userID;
									$userDetail['document_name'] = $document['name'];
									$userDetail['file_name'] = $newname;
									$this->UserDocument->create();
									$this->UserDocument->save($userDetail,array('validate'=>false));
								}
							}
						}
					}
					//welcome Email Notification
					$this->send_welcome_email($userDetail);
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
			}else{
				if(!empty($this->UserDetail->validationErrors['paymentMethod']['0'])){
					$this->set('validationErrors',$this->UserDetail->validationErrors['paymentMethod']['0']);
				}
			}
		} 
		$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
		$legalDocuments = $this->Document->find('all',array('fields'=>array('document_description','upload','name'),'conditions'=>array("Document.document_type"=>'legal','Document.user_type like'=>'%'.$userDetail['user_type'].'%')));
		$this->set('userDetail',$userDetail);
		$this->set('users',$users);
		$this->set('legalDocuments',$legalDocuments);
	}
	
	/*
	* registrationStartup function
	* Functionality -  registrationStartup
	* Created date - 23-Jun-2015
	* Modified date - 
	*/
	
	function registrationStartup(){ 
		$this->layout = 'short_app';
		$this->Session->delete('activeMenu');
	}
	
	/*
	* registrationStartup function
	* Functionality -  shortAppStartup
	* Created date - 23-Jun-2015
	* Modified date - 
	*/
	
	function shortAppStartup(){
		$this->layout = 'short_app';
		$this->Session->write('activeMenu','borrower');
	}
	
	/*
	* brokerStartup function
	* Functionality -  brokerStartup
	* Created date - 23-Jun-2015
	* Modified date - 
	*/
	
	function brokerStartup(){
		$this->layout = 'short_app';
		$this->Session->write('activeMenu','broker');
	}
	
	/*
	* investorStartup function
	* Functionality -  investorStartup
	* Created date - 23-Jun-2015
	* Modified date - 
	*/
	
	function investorStartup(){
		$this->layout = 'short_app';
		$this->Session->write('activeMenu','investor');
	}
	
	/*
	* shortApp function
	* Functionality -  short Application for applying loan functionality
	* Created date - 23-Jun-2015
	* Modified date - 
	*/
	
	function shortApp() {
		$this->loadAllModel(array('User','ShortApplication'));
		$this->layout = 'short_app';
		if(isset($this->request->data) && (!empty($this->request->data))){
			$this->ShortApplication->set($this->request->data['ShortApplication']);
			if($this->ShortApplication->validates()){
				unset($this->request->data['ShortApplication']['broker_name']);
				$this->Session->write('shortApp',$this->request->data['ShortApplication']);
				$this->redirect(array('controller'=>'homes','action' => 'shortAppStep2/'.base64_encode('step2')));
			}
		}
		$brokers = $this->User->find('list',array('conditions'=>array('User.user_type'=>2,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','name'),'order'=>'name ASC'));
		$brokers['none'] = 'Your Mortgage Broker';
		$this->set('brokers',$brokers);	
	}
	
	/**
	 * Summary :- shortAppStep2
	 * @return	NONE
	 * Description:- shortAppStep2
	 */
	
	function shortAppStep2($step = null) {
		if(base64_decode($step) == 'step2'){
			$this->loadAllModel(array('ShortApplication'));
			$this->layout = 'short_app';
			if(isset($this->request->data) && (!empty($this->request->data))){
				$this->ShortApplication->set($this->request->data['ShortApplication']);
				if($this->ShortApplication->validates()){
					$shortApp = $this->Session->read('shortApp');
					foreach($this->request->data['ShortApplication'] as $key=>$val){
						$shortApp[$key] = $val;
					}
					$this->Session->write('shortApp',$shortApp);
					$this->redirect(array('controller'=>'homes','action' => 'shortAppStep3/'.base64_encode('step3')));
				}
			}
		}else{
			$this->Session->setFlash("Please complete step1",'default',array('class'=>'alert alert-danger'));
			$this->redirect(array('controller'=>'homes','action' => 'shortApp'));
		}
	}

	/**
	 * Summary :- shortAppStep3
	 * @return	NONE
	 * Description:- shortAppStep3
	 */
	
	function shortAppStep3($step = null){
		if(base64_decode($step) == 'step3'){
			$this->getPropertyTypes();
			$this->loadAllModel(array('ShortApplication','State'));
			$this->layout = 'short_app';
			if(isset($this->request->data) && (!empty($this->request->data))){
				$this->ShortApplication->set($this->request->data['ShortApplication']);
				if($this->ShortApplication->validates()){
					$cityName = $this->getCityName($this->request->data['ShortApplication']['property_city']);
					$stateCode = $this->getStateCode($this->request->data['ShortApplication']['property_state']);
					$request = array('Request'=>array(
									'ClientSystemID' => ClientSystemID,
									'T365ID'  => T365ID,
									'SubjectPropertyCity' => $cityName,
									'SubjectPropertyState' => $stateCode,
									'SubjectPropertyStreetAddress' => $this->request->data['ShortApplication']['property_address'],
									'SubjectPropertyZipCode' => $this->request->data['ShortApplication']['property_zipcode']
								)
							);
					$client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
					$response  = $client->GetPropertyHistory($request);
					if($response->GetPropertyHistoryResult->ResultCode == 'Success'){
						$shortApp = $this->Session->read('shortApp');
						foreach($this->request->data['ShortApplication'] as $key=>$val){
							$shortApp[$key] = $val;
						}
						$this->Session->write('shortApp',$shortApp);
						$this->redirect(array('controller'=>'homes','action' => 'shortAppStep4/'.base64_encode('step4')));
					}else{
						$this->Session->setFlash("Property address is not valid",'default',array('class'=>'alert alert-danger'));
					}
				}
			}
			$states = $this->State->find('list',array('conditions'=>array('status'=>'1'),'fields'=>array('id','name'),'order'=>'name ASC'));
			$this->set('states',$states);
		}else{
			$this->Session->setFlash("Please complete step2",'default',array('class'=>'alert alert-danger'));
			$this->redirect(array('controller'=>'homes','action' => 'shortAppStep2'));
		}
	}
	
	/**
	 * Summary :- shortAppStep3
	 * @return	NONE
	 * Description:- shortAppStep3
	 */
	
	function shortAppStep4($step = null){
		if(base64_decode($step) == 'step4'){
			$this->getLoanTypes();
			$this->getLoanReasons();
			$this->loadAllModel(array('ShortApplication','LoanLog'));
			$this->layout = 'short_app';
			if(isset($this->request->data) && (!empty($this->request->data))){
				//pr($this->request->data);die;
				$this->ShortApplication->set($this->request->data['ShortApplication']);
				if($this->ShortApplication->validates()){
					$shortApp = $this->Session->read('shortApp');
					//pr($shortApp);
					//pr($this->request->data);die;
					foreach($this->request->data['ShortApplication'] as $key=>$val){
						$shortApp[$key] = $val;
					}
					//die('asdsa');
					if(!empty($shortApp)){
						if($this->ShortApplication->save($shortApp)){
							$this->Session->delete('shortApp');
							$shortAppID = $this->ShortApplication->id;
							$logData['LoanLog']['short_application_ID'] = $shortAppID;
							$logData['LoanLog']['action'] = 'Applied';
							$logData['LoanLog']['description'] = 'Short App is applied';
							$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
							$this->LoanLog->save($logData);
							$shortApp['id'] = $shortAppID;
							$this->short_app_notification($shortApp);
							$this->redirect(array('controller'=>'homes','action' => 'shortAppStep5',base64_encode($shortAppID)));
						}
					}
				}
			}
		}else{
			$this->Session->setFlash("Please complete step3",'default',array('class'=>'alert alert-danger'));
			$this->redirect(array('controller'=>'homes','action' => 'shortAppStep3'));
		}
	}
	
	/**
	 * Summary :- shortAppStep3
	 * @return	NONE
	 * Description:- shortAppStep3
	*/
	
	function shortAppStep5($shortAppId = null){
		$this->layout = 'short_app';
		$this->Session->delete('activeMenu');
		$this->set('shortAppId',$shortAppId); 
		$this->Common->getDetailFromTitle365(base64_decode($shortAppId));
	}
	
	/*
	* Email Notification function
	* Functionality -  notify users of new loan application
	* Created date - 7-Jul-2015
	* Modified date - 
	*/
	
	function short_app_notification($data = array()) { 
		$this->loadAllModel(array('EmailTemplate','State','User','Notification','Todo'));
		$this->layout = '';
		$this->autoRender = false;
		$userTypeID = array(2,3,4,5);
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$notifiyUserEmail = $this->User->find('all',array('conditions'=>array('User.user_type'=>$userTypeID,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','email_address','name','user_type'),'order'=>'name ASC'));
		$link =  '<a href = "' .BASE_URL. 'homes/login/">Click to see application details </a>';
		$newLoans = $this->getLoanLifeCyclePhase();
		$alert = $newLoans['1'];
		foreach($notifiyUserEmail as $user) {
			//if broker Todo will be save else notification
			if($user['User']['user_type'] == 2){
				$todoData['Todo']['receiver_id'] = $user['User']['id'];
				$todoData['Todo']['sender_id'] = '';
				$todoData['Todo']['to_do'] = '<a href = "' .BASE_URL. 'commons/propertyDetail/'.base64_encode($data['id']).'">'.$alert.' </a>';
				$todoData['Todo']['to_do_id'] = $data['id'];
				$todoData['Todo']['created'] = CURRENT_DATE_TIME_DB;
				$this->Todo->create();
				$this->Todo->save($todoData);
			}else {
				//save Notification
				$notificationData['Notification']['receiver_id'] = $user['User']['id'];
				$notificationData['Notification']['action'] = $alert;
				$notificationData['Notification']['action_id'] = $data['id'];
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
				
			}
			// email notification
			$template = $this->EmailTemplate->getEmailTemplate('short_app_notification');
			$to = $user['User']['email_address'];
			$emailData = $template['EmailTemplate']['template'];					
			$logo = '<img src="'.BASE_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
			$name = $data['applicant_first_name'] . ' '. $data['applicant_last_name'];
			/*if($data['property_type'] != 'other'){
				$propertyType = $this->propertyTypes[$data['property_type']];
			}else{
				$propertyType = $data['other_property_type'];
			}*/
			$emailData = str_replace('{FirstName}',$user['User']['name'],$emailData);
			$emailData = str_replace('{Broker Email}',$data['email_address'],$emailData);
			$emailData = str_replace('{Name}',$name,$emailData);
			$emailData = str_replace('{Borrower Email Address}',$data['applicant_email_ID'],$emailData);
			$emailData = str_replace('{Borrower Phone}',$data['applicant_phone'],$emailData);
			$emailData = str_replace('{Property Name}',$data['property_address'],$emailData);
			$emailData = str_replace('{Property Type}',$data['property_type'],$emailData);
			$emailData = str_replace('{Property State}',$states[$data['property_state']],$emailData);
			$emailData = str_replace('{Property City}',$this->getCityName($data['property_city']),$emailData);
			$emailData = str_replace('{Loan Type}',$this->loanTypes[$data['loan_type']],$emailData);
			$emailData = str_replace('{Loan Reason}',$this->loanReasons[$data['loan_reason']],$emailData);
			$emailData = str_replace('{Loan Amount}',$data['loan_amount'],$emailData);
			$emailData = str_replace('{Loan To Value}',$data['loan_value'],$emailData);
			$emailData = str_replace('{Loan Objective}',$data['loan_objective'],$emailData);
			$emailData = str_replace('{Logo}',$logo,$emailData);
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
		$this->layout = 'short_app';
	}
	
	/**
	 * Description
	 * @var object
	 */
	

	
	function getCities(){
		$this->layout = '';
		$this->loadAllModel(array('City'));
		$stateCode = $this->request->data['stateName'];
		if($stateCode){
			$allCities = $this->City->find('list',array('conditions'=>array('City.state_code'=>trim($stateCode)),'fields' => array('city','city'),'order'=>'order DESC'));	
			$this->set('allCities',$allCities);
		}
	}
	
	/**
	 * Description
	 * @var object
	 */
	
	public function login() {
		$this->getRoleTypes();
		$remember_me = '';
		$this->layout = 'login';
		$this->loadAllModel(array('User'));
		if(isset($this->request->data) && (!empty($this->request->data))){
			$this->User->set($this->request->data);
			$email = $this->request->data['User']['email_address'];
			$userType = $this->request->data['User']['user_type'];
			$user_password  = md5($this->request->data['User']['password']);
			$userInfo = $this->User->find('first',array('conditions'=>array("User.email_address" => $email,"User.user_type" => $userType,"User.status !="=>0,"User.is_deleted"=>0)));
			
			if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $user_password)) {
				$this->User->id = $userInfo['User']['id'];
				$this->User->saveField('logged_in','1');
				$this->Session->write('userInfo', $userInfo['User']);
				$this->Session->write('userDetail', $userInfo['UserDetail']);
				if(!empty($this->request->data['User']['remember_me'])){
					$cookie_email = $this->request->data['User']['email'];						
					$this->Cookie->write('userEmail', $cookie_email, false, '+2 weeks');						
					$cookie_pass = $this->request->data['User']['password'];
					$this->Cookie->write('userPass', base64_encode($cookie_pass), false, '+2 weeks'); 
				}else{
					$this->Cookie->delete('userEmail');
					$this->Cookie->delete('userPass');     
				}
				echo $controller = $this->getControllerName($userType);
				$this->Session->write('userInfo.controller', $controller);
				$this->redirect(array("controller"=>'homes',"action" => "dashboard"));  
			}else{
				$this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'alert alert-danger'));
			}
		}elseif($this->Session->check('userInfo')){
			$controller = $this->Session->read('userInfo.controller');
			$this->redirect(array("controller"=>$controller,"action" => "dashboard"));
		}else{
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
	
	/**
	 * Summary :- logout
	 * @return	object	:- logout
	 * Description :- logout
	*/
	
	public function logout(){
		$this->loadModel('User');
		if($this->Session->read('userInfo.user_type') == 7){
			$action = "investor_login";
		}else if($this->Session->read('userInfo.user_type') == 1){
			$action = "borrowerLogin";
		}else {
			$action = "login";
		}
		$this->User->id = $this->Session->read('userInfo.id');
		$this->User->saveField('logged_in','0');
		$this->Session->delete('userInfo');
		$this->Session->destroy();
		$this->Hybridauth->logout();
		$this->redirect(array("controller"=>"homes","action" => $action));
	}
		
	/* social login functionality */
	
	public function social_login($provider=null,$userType=null) { 
		$this->Cookie->write('startSession',1);
		if( $this->Hybridauth->connect($provider) ){ 
			$this->successfulHybridauth($provider,$this->Hybridauth->user_profile,$userType);
		}else{
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
			$user = $this->User->find('first', array('conditions' => array('id' => $existingProfile['User']['id'])));
			//$this->doSocialLogin($user,true);
			$controller = $this->getControllerName($userType);
			$user['User']['controller'] = $controller;
			$this->Session->write('userInfo',$user['User']);
			
			//$this->redirect(array("controller"=>$controller,"action" => "dashboard/"));
			$this->redirect(array("controller"=>'homes',"action" => "dashboard"));  
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
			$this->redirect(array("controller"=>'homes',"action" => "dashboard")); 
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
			$this->redirect(array("controller"=>'homes',"action" => "dashboard"));  
		}else{
			$this->Session->setFlash(__('Unknown Error could not verify the user: '. $user['User']['first_name']));
		}	
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
    
	public function getAllNotification() {
		$this->loadAllModel(array('Notification')); 
		$userArray = $this->Session->read('userInfo');
		$userID = $userArray['id'];
		$allNotifications = $this->Notification->find('all', array('conditions'=>array('Notification.receiver_id' =>$userID,'Notification.status'=>0),'order'=>'id DESC'));
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
	
	/**
	 * Description:- borrowerLogin
	 * @var object:- borrowerLogin
	 */
	
	public function borrowerLogin(){
		$remember_me = '';
		$this->layout = 'login';
		$this->loadAllModel(array('User'));
		if(isset($this->request->data) && (!empty($this->request->data))){
			$this->User->set($this->request->data);
			$email = $this->request->data['User']['email_address'];
			$userType = '1';
			$user_password  = md5($this->request->data['User']['password']);					
			$userInfo = $this->User->find('first',array('conditions'=>array("User.email_address" => $email,"User.user_type" => $userType,"User.status != "=>0,"User.is_deleted"=>0)));
			if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $user_password)) { 
				$this->User->id = $userInfo['User']['id'];
				$this->User->saveField('logged_in','1');
				$this->Session->write('userInfo', $userInfo['User']);
				$this->Session->write('userDetail', $userInfo['UserDetail']);
				if(!empty($this->request->data['User']['remember_me'])){
					$this->Cookie->write('userEmail', $email, false, '+2 weeks');						
					$this->Cookie->write('userPass', base64_encode($this->request->data['User']['password']), false, '+2 weeks'); 
				}else{
					$this->Cookie->delete('userEmail');
					$this->Cookie->delete('userPass');     
				}
				$controller = $this->getControllerName($userType);
				$this->Session->write('userInfo.controller', $controller);
				$this->redirect(array("controller"=>'borrowers',"action" => "dashboard"));             
			}else{
				$this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'alert alert-danger'));
			}
		}else if($this->Session->check('userInfo')){
			$controller = $this->Session->read('userInfo.controller');
			$this->redirect(array("controller"=>'borrowers',"action" => "dashboard"));
		}else{
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
	
	/**
	 * Summary :- investor_login
	 * @return	object :- NONE
	 * Description :- investor_login
	*/
	
	public function investor_login() {
		$remember_me = '';
		$this->layout = 'login';
		$this->loadAllModel(array('User'));
		if(isset($this->request->data) && (!empty($this->request->data))){
			$this->User->set($this->request->data);
			$email = $this->request->data['User']['email_address'];
			$userType = '7';
			$user_password  = md5($this->request->data['User']['password']);
			$userInfo = $this->User->find('first',array('fields'=>array('id','first_name','last_name','email_address','password','user_type','status'),'conditions'=>array("User.email_address" => $email,"User.user_type" => $userType,"User.password" => $user_password,"User.status !=" => 0, "User.is_deleted" => 0)));
			if(!empty($userInfo)){ 
				$this->User->id = $userInfo['User']['id'];
				$this->User->saveField('logged_in','1');
				$this->Session->write('userInfo', $userInfo['User']);
				$controller = 'tdinvestors';
				$this->Session->write('userInfo.controller', $controller);
				$this->redirect(array("controller"=>'homes',"action" => "dashboard"));             
			}else{
				$this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'alert alert-danger'));
			}
		}else if($this->Session->check('userInfo')){
			$controller = $this->Session->read('userInfo.controller');
			$this->redirect(array("controller"=>$controller,"action" => "dashboard"));
		}else{
			$email = $this->Cookie->read('userEmail');
			$password = base64_decode($this->Cookie->read('userPass'));				
			if(!empty($email) && !empty($password)){
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
				/***************** image upload *****************/
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
				}else{
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
					$active =  '<a href = "' .$site_URL. 'users/secure_check/'.$hashCode.'">Click to activate your account </a>'; 
					$logo = '<img src="'.$site_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
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
	* create_pdf_document function
	* Functionality - create document if admin added description
	* Created date - 8-Jan-2016
	*/
	
	function create_pdf_document($documentName = null) {
		$userDetail = $this->Session->read('userSessionData');
		$this->loadAllModel(array('Document','Notification'));
		$this->Notification->updateAll(array('Notification.status'=>'1'),array('Notification.receiver_id'=>$this->Session->read('userInfo.id')));
		$pdfTemplate = $this->Document->find('first', array('conditions' => array('Document.name like' => '%'.$documentName.'%')));
		$this->set('pdfTemplate', $pdfTemplate);  //pr($pdfTemplate); die();
		$this->set('userDetail', $userDetail);
		$this->layout = '/pdf/default';
		$this->render('/Pdf/pdf_document');
	}
	
	/**
	 * Summary :- dashboard
	 * @return	object : NONE
	 * Description :- dashboard
	*/
		
	function dashboard(){
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('Loan','LoanUser','LoanPhase','Notification','Todo'));
		$this->Notification->updateAll(array('Notification.status'=>'1'),array('Notification.type'=>'1','Notification.receiver_id'=>$this->Session->read('userInfo.id')));
		$loanIds = $loanArray = $loanTracking = $totalLoansPerMonth = array();
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
		if($loanIds){
			$loanDetail = $this->LoanPhase->find('all',array('conditions'=>array('LoanPhase.loan_id' => $loanIds),'order'=>'LoanPhase.id desc'));
			foreach($loanDetail as $key=>$val){
				if(!in_array($val['LoanPhase']['loan_id'], $loanArray)){
					$loanArray[] = $val['LoanPhase']['loan_id'];
					// get loans by phase
					if(!empty($loanTracking[$val['LoanPhase']['loan_phase']])){
						$loanTracking[$val['LoanPhase']['loan_phase']] = $loanTracking[$val['LoanPhase']['loan_phase']] + 1; 	
					}else{
						$loanTracking[$val['LoanPhase']['loan_phase']] = 1; 	
					}
				}
			}
		}
		// get all notificationfor user
		$getData = $this->Notification->find('all', array('conditions'=>array('receiver_id' =>$this->Session->read('userInfo.id'),'type' =>1),'order'=>'id DESC','limit'=>'6'));
		// get all todo for user
		$allToDo = $this->Notification->find('all', array('conditions'=>array('status'=>0,'receiver_id' =>$this->Session->read('userInfo.id'),'type' =>2),'order'=>'id DESC'));
		$this->set(compact('getData','loanTracking','allToDo'));
	}
	
	/*
	* send_welcome_email function
	* Functionality - send_welcome_email
	* Created date - 8-Jan-2016
	*/
	
	function send_welcome_email($userData) { 
		//welcome email notification
		$this->loadAllModel(array('EmailTemplate'));
		$roleTypes = $this->userTypes;
		$hashCode =  md5(uniqid(rand(), true));
		$this->User->saveField('random_key',$hashCode, false);
		$site_URL = Configure::read('BASE_URL');
		$active =  '<a href = "' .$site_URL. 'users/secure_check/'.$hashCode.'">Click to activate your account </a>'; 
		$logo = '<img src="'.$site_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
		$template = $this->EmailTemplate->getEmailTemplate('user_registration');
		$to = $userData['email_address'];
		$emailData = $template['EmailTemplate']['template'];					
		$tempUserType = $userData['user_type'];
		$userType = $roleTypes[$tempUserType];
		$password = base64_decode($userData['userPassword']);
		$emailData = str_replace('{FirstName}',ucfirst($userData['first_name']),$emailData);
		$emailData = str_replace('{Email}',$userData['email_address'],$emailData);
		$emailData = str_replace('{Password}',$password,$emailData);
		$emailData = str_replace('{UserType}',$userType,$emailData);
		$emailData = str_replace('{Link}',$active,$emailData);
		$emailData = str_replace('{Logo}',$logo,$emailData);
		$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
		//pr($emailData); die();
		$this->sendEmail($to,$subject,$emailData);
	}
	
	/*
	* forgot_password function
	* Functionality - forgot password for user
	* Created date - 12-May-2016
	* Modified date - 
	*/
	
	function forgot_password($userType = null) {
		$this->loadAllModel(array('User','EmailTemplate'));
		$this->getRoleTypes();
		$this->layout = 'login';
		$redirectLink = 'login';
		if(base64_decode($userType) == 'borrowerLogin'){
			$redirectLink = 'borrowerLogin';
		}else if(base64_decode($userType) == 'investor_login'){
			$redirectLink = 'investor_login';
		}
		$this->set('redirectLink',$redirectLink);
		if(!empty($this->request->data)){
			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
			if(!empty($this->request->data['User']['email_address'])){
				$userArr = $this->User->find('first',array('conditions'=>array('User.email_address'=>trim($this->request->data['User']['email_address']),'User.user_type'=>trim($this->request->data['User']['user_type'])),'fields'=>array('User.id','User.name','User.first_name','User.last_name','User.email_address')));
					if(count($userArr)){  
						$passwd = $this->generatePassword();
						$data['id'] = $userArr['User']['id'];
						$data['status'] = 2;
						$data['password'] = md5($passwd);
						$data['userPassword'] = base64_encode($passwd);
						if($this->User->save($data)){
							$template = $this->EmailTemplate->getEmailTemplate('user_forgot_password');
							$emailData = $template['EmailTemplate']['template'];					
							$logo = '<img src="'.Configure::read('BASE_URL').'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
							$emailData = str_replace('{FirstName}',$userArr['User']['name'],$emailData);
							$emailData = str_replace('{Email}',$userArr['User']['email_address'],$emailData);
							$emailData = str_replace('{Password}', $passwd, $emailData);
							$emailData = str_replace('{Logo}',$logo,$emailData);
							$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
							$this->sendEmail($userArr['User']['email_address'], $subject, $emailData);	
							$this->Session->setFlash('Email with password sent to your account.','default',array('class'=>'alert alert-success'));
						}
					} else{ 
						$this->Session->setFlash('Email address does not exist.','default',array('class'=>'alert alert-danger'));
					}
			}else{
				$this->Session->setFlash('Please enter your email.','default',array('class'=>'alert alert-danger'));
			}
		}
	}
	
	/*
	* managerStartup function
	* Functionality -  managerStartup
	* Created date - 25-May-2015
	* Modified date - 
	*/
	
	function managerStartup(){
		$this->layout = 'short_app';
		$this->Session->write('activeMenu','manager');
	}
	
	/**
		* Description:- managerStep3
		* @var object :- none
	*/
	
	function managerStep3($step = null){
		if(empty($step)){
			$this->redirect(array('controller'=>'homes','action' => 'register'));
		}
		$userDetail = $this->Session->read('userSessionData');
		if(!empty($userDetail)) {
			$this->layout = 'short_app';
			$roleTypes = $this->userTypes;
			$this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog','Document','TeamMember','Commission','UserDocument'));
			unset($userDetail['confirm_password']);
			//unset($userDetail['email_address']);
			$this->User->set($userDetail);
			$this->UserDetail->set($userDetail);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			if($userValidate && $userDetailValidate){
				$newname = '';
				if($this->User->save($userDetail,array('validate'=>false))){ 
					$userID = $this->User->id;
					$userDetail['user_id'] = $userID;
					$this->UserDetail->save($userDetail,array('validate'=>false));
					// pr($userDetail);
					//welcome Email Notification
					$this->send_welcome_email($userDetail);
					//User Logs
					$name = $userDetail['first_name'] .' '. $userDetail['last_name'];
					$logData['UserLog']['user_id'] = $userID;
					$logData['UserLog']['action'] = 'Registration';
					$logData['UserLog']['description'] = $name . ' registered in Operation trust deed';
					$this->UserLog->save($logData);
					$this->Session->delete('userSessionData');
					$this->Session->setFlash('You have been registered successfully.','default',array('class'=>'alert alert-success'));
				}
			}else{
				if(!empty($this->UserDetail->validationErrors['paymentMethod']['0'])){
					$this->set('validationErrors',$this->UserDetail->validationErrors['paymentMethod']['0']);
				}
			}
		
			$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
			$this->set('userDetail',$userDetail);
			$this->set('users',$users);
		}else {
			$this->redirect(array('controller'=>'homes','action' => 'registrationStartup'));
		}
		
	}
	
	/*
	* admin_view_user Function
	* Functionality -  To View User Details
	* Created date - 10-Sep-2015
	*/
	
	function viewUser($userId = null) {
		$this->layout = 'dashboard_common';
		$userId = base64_decode(base64_decode($userId));
		$this->getUserTypes();
		$arrUser = $this->User->find('first', array('conditions'=>array('User.id'=>$userId)));
		//pr($arrUser);die;
		$this->set('arrUser', $arrUser);
	}
}
?>