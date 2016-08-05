<?php
/*
* Users Controller class
* Functionality -  Manage the Users
* Created date - 25-Jun-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility');

class UsersController extends AppController {
		
		var $name = 'Users';        
		var $components = array('Session','RequestHandler','Paginator','Email','Cookie','Common');
		public $helpers = array('Js' => array('Jquery'), 'Paginator');
		
		public $paginate = array('limit' => PAGINATION_LIMIT, 'recursive' => 2);
		function beforeFilter() {
			$allow = array('admin_index', 'admin_add', 'admin_delete', 'admin_setnewStatus', 'admin_view_user','fetch_all_cities','check_existing_emailID','fetch_user_detail','secure_check', 'admin_verifyDocument','create_ndnca');
			parent::beforeFilter();
			//$this->checkUserSession($allow);
		}
		
		/*
		* index function
		* Functionality -  index functionality
		* Created date - 25-Jun-2015
		* Modified date - 
		*/
		
		public function admin_index() {
			if($this->RequestHandler->isAjax()) {
				$this->layout='ajax'; 
			} else {
				$this->layout = 'admin';  
			}
			$this->loadAllModel(array('User','UserDetail','State'));
			$this->getUserTypes();
			$this->getLicenceTypes();
			$this->getReferredBy();
			$this->getArrStatus();
			$this->getStatusClass();
			$value = "";
			$criteria = 'User.is_deleted = 0 AND User.user_type != 7 AND User.status != 5 AND User.id !='.ADMIN_ID;
			if(!empty($this->params)) {
				if(!empty($this->params->query['first_name']) && isset($this->params->query['first_name'])) {
					$value = trim($this->params->query['first_name']);
					$criteria .= " AND (User.first_name LIKE '%".$value."%' )";
				}
				if(!empty($this->params->query['search_email']) && isset($this->params->query['search_email'])) {
					$search_email = trim($this->params->query['search_email']);
					$criteria .= " AND (User.email_address LIKE '%".$search_email."%')";
				}
				if(!empty($this->params->query['search_user_type']) && isset($this->params->query['search_user_type'])) {
					$searchType = trim($this->params->query['search_user_type']);
					$criteria .= " AND (User.user_type = '$searchType' )";
				}
				if(!empty($this->params->query['search_staff']) && isset($this->params->query['search_staff'])) {
					$search_staff = trim($this->params->query['search_staff']);
					$criteria .= " AND (User.otd_staff = '$search_staff')";
				}
			}
			$this->paginate['conditions'] = array($criteria);
			$this->paginate['order'] = array('User.id' => 'desc'); 
			$this->Paginator->settings	= $this->paginate;
			$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
			$users = $this->User->find('list',array('fields'=>array('id','first_name'),'order'=>'first_name ASC'));
			$getData =  $this->Paginator->paginate('User');
			$this->set('getData', $getData);
			$this->set('states', $states);
			$this->set('users', $users);
			if($this->RequestHandler->isAjax()){
				$this->render('/Elements/admin/users');
				return;
			}
		}
	
	/*
	* add function
	* Functionality -  add  user functionality
	* Created date - 26-Jun-2015
	* Modified date - 
	*/
	
		public function admin_add($id = null) {
			$this->layout = 'admin';
			$this->loadAllModel(array('User','UserDetail','State','EmailTemplate','Message', 'Notification','Document','UserDocument'));
			$this->getRoleTypes();
			$this->getLicenceTypes();
			$this->getReferredBy();
			$states = $this->State->find('list',array('conditions'=>array('status'=>1),'fields'=>array('id','name'),'order'=>'name ASC'));
			$users = $this->User->find('list',array('fields'=>array('id','first_name'),'order'=>'first_name ASC'));
			if(isset($this->request->data) && !empty($this->request->data)){
				$this->request->data['User']['id'] = base64_decode($this->request->data['User']['id']);
				$this->request->data['UserDetail']['id'] = base64_decode($this->request->data['UserDetail']['id']);
				$this->User->set($this->request->data['User']);
				$this->UserDetail->set($this->request->data);
				$userValidate = $this->User->validates();
				$userDetailValidate = $this->UserDetail->validates();
				if($userValidate && $userDetailValidate) {	
					if($id) {
						$msz= "User updated sucessfully";
					}else {
						$password = $this->generatePassword();
						$this->request->data['User']['password'] = md5($password);
						$this->request->data['User']['userPassword'] = base64_encode($password);
						$this->request->data['User']['status'] = '1';
						$this->request->data['User']['otd_staff'] = '1';
						$msz= "User saved sucessfully";
					}
					//Image Upload
					if(!empty($this->request->data['UserDetail']['profile_pic']) && $this->request->data['UserDetail']['profile_pic']['name'] != "") {
						if(isset($this->request->data['UserDetail']['profile_pic']['name']) && $this->request->data['UserDetail']['profile_pic']['name'] != "") {
							$file = $this->request->data['UserDetail']['profile_pic']['name'];
							$path = 'img/profile_pics';					
							$folder_name = 'original';
							$multiple[] = array('folder_name'=>'thumb','height'=>'355','width'=>'300'); 
							// Code to upload the image
							$response = $this->Common->upload_image($file, $path, $folder_name, true, $multiple);
							// check if filename return or error return
							$is_image_error = $this->Common->is_image_error($response);
							if($response == 'exist_error') {
								$this->Session->setFlash($is_image_error,'error');
							}elseif($response == 'size_mb_error') {
								$this->Session->setFlash($is_image_error,'error');
							}elseif($response == 'type_error') {
								$this->Session->setFlash($is_image_error,'error');
							}else {
								$flag = true;
								$filename = $response;
								$this->request->data['UserDetail']['profile_picture'] = $filename;	
							}
						}
					}else{
						$filename = 'index.png';
						$this->request->data['UserDetail']['profile_picture'] = $filename;
					}
					$this->User->save($this->request->data['User']);				
					$userID = $this->User->id;
					$this->request->data['UserDetail']['user_id'] = $userID;
					$this->request->data['UserDetail']['birthdate'] = $this->request->data['UserDetail']['date_of_birth'];
					$this->UserDetail->save($this->request->data['UserDetail']);
					if(!empty($this->request->data['UserDetail']['agreement'])){
						foreach($this->request->data['UserDetail']['agreement'] as $key=> $document) {
							if(!empty($document['userDocument']['name'])) {
								$newname = $logDescription = '';
								$flag = false;
								$str = explode('/',$document['userDocument']['type']);
								if($document['userDocument']['error'] != 0) {
									$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
									$flag = 'false';
								}else if($document['userDocument']['size'] > 2000000){
									$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
									$flag = 'false';
								}else{
									$upload_dir = USER_SIGNUP_DOCUMENT_PATH;
									$filename = explode(".",$document['userDocument']['name']);
									$encodeUserID = base64_encode($userID);	
									$newname = $encodeUserID."_".$document['userDocument']['name'];
									move_uploaded_file($document['userDocument']['tmp_name'], $upload_dir."/".$newname);
									$this->request->data['UserDocument']['document_name'] = $document['name'];
									$this->request->data['UserDocument']['file_name'] = $newname;
								}
								$this->request->data['UserDocument']['id'] = $document['id'];
								$this->request->data['UserDocument']['user_id'] = $userID;
								$this->request->data['UserDocument']['status'] = $this->request->data['UserDetail']['document_status'][$key];
								$this->UserDocument->create();
								$this->UserDocument->save($this->request->data['UserDocument']);
							}
						}
					}
					//welcome email notification
					if(empty($id)){
						$hashCode =  md5(uniqid(rand(), true));
						$this->User->saveField('random_key',$hashCode, false);
						$active =  '<a href = "' .BASE_URL. 'users/secure_check/'.$hashCode.'">Click to login </a>'; 
						$logo = '<img src="'.BASE_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
						$template = $this->EmailTemplate->getEmailTemplate('welcome_to_site');
						$to = $this->request->data['User']['email_address'];
						$emailData = $template['EmailTemplate']['template'];
						$emailData = str_replace('{FirstName}',ucfirst($this->request->data['User']['first_name']),$emailData);
						$emailData = str_replace('{Email}',$this->request->data['User']['email_address'],$emailData);
						$emailData = str_replace('{Password}',$password,$emailData);
						$emailData = str_replace('{Link}',$active,$emailData);
						$emailData = str_replace('{Logo}',$logo,$emailData);
						$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
						$this->sendEmail($to,$subject,$emailData);
					}
				$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
				$this->redirect(array('action' => 'index'));
			}else{
				$userError = $this->User->validationErrors;
				$userDetailError = $this->UserDetail->validationErrors;
				$this->set('errors',array_merge($userError,$userDetailError));
			}   
		}else{
			$this->User->bindModel(
						array(
						   'hasMany'=>array(
								'UserDocument' => array(
													'className'=>'UserDocument'
												)	
								)
							)
					);
			$this->request->data = $this->User->read(null, base64_decode($id));
		}
		$this->set('states',$states);
		$this->set('users',$users);	
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}		
	
	/*
	* admin_verifyDocument function
	* Functionality -  admin_verifyDocument user
	* Created date - 26-Jun-2015
	* Modified date - 
	*/
	
	function admin_verifyDocument($id = null){
		$this->layout = 'admin';
		$this->loadAllModel(array('UserDocument'));
		if($this->request->data){
			if($this->request->data['UserDocument']['status'] == 'accept'){
				$this->request->data['UserDocument']['status'] = '1';
			}else{
				$this->request->data['UserDocument']['status'] = '0';
				$link = '<a href="'.BASE_URL.'">Upload Document</a>';
			}
			$this->UserDocument->save($this->request->data);
			$this->Session->setFlash('Document Denied.','default',array('class'=>'alert alert-success'));	
		}
		$userDocuments = $this->UserDocument->find('all',array('conditions' => array('user_id' => base64_decode($id))));
		$this->set('userDocuments',$userDocuments);
	}
	
	/*
	* admin_delete function
	* Functionality -  delete user
	* Created date - 26-Jun-2015
	* Modified date - 
	*/
	
	function admin_delete($id = null){
		$this->autoRender=false;
		$this->loadAllModel(array('User'));
		if(!empty($id)) {
			$id = base64_decode($id);
			$this->User->id = $id;
			if($this->User->updateAll(array('User.is_deleted'=>'1'),array('User.id'=>$id))) {
				$this->Session->setFlash('User deleted successfully.','default',array('class'=>'alert alert-success'));	
				$this->redirect(array("controller"=>"users","action" => "index"));
			}
		}else{
			$this->redirect(array("controller"=>"users","action" => "index"));	
		}
	}
		
	/*
	* secure_check function
	* Functionality -  activate user account
	* Created date - 1-Jul-2015
	* Modified date - 
	*/
	
	function secure_check($uniqueKey = null) {
		$this->layout = '';
		$this->loadAllModel(array('User'));
		$this->set('title', 'Activate Account');
		$this->set('title_for_layout', 'Activate Account');
		$this->set('uniqueKey', $uniqueKey);
		$data = $this->User->find('first',array('conditions'=>array('User.random_key'=>$uniqueKey)));
		$controller = 'homes';
		if(empty($data)){
			$this->Session->setFlash('Error Occured, Please check your secure code.', 'default', array('class'=>'alert alert-danger'));
			$this->redirect(array('controller'=>'homes', 'action'=>'registrationStartup'));
		} else {
			$userID = $data['User']['id'];
			$this->request->data['User']['id'] = $userID;
			$this->request->data['User']['status'] = '2';
			$this->request->data['User']['random_key'] = "";
			$this->User->save($this->request->data);
			$this->Session->setFlash('Account has been activated successfully.', 'default', array('class'=>'alert alert-success'));
			if($data['User']['user_type'] == 1) {
				$this->redirect(array('controller'=>'homes','action'=>'borrowerLogin'));	
			}elseif($data['User']['user_type'] == 11) {
				$this->redirect(array('controller'=>'escrows','action'=>'index'));	
			}else {
			   $this->redirect(array('controller'=>'homes','action'=>'login'));
			}
		}
	}
		
	/*
	* admin_setnewStatus function
	* Functionality -  Active/Deactivate Status
	* Created date - 3-Jul-2015
	* Modified date - 
	*/
	
	function admin_setnewStatus($id,$status,$model) {
		$this->loadModel($model);
		$this->autoRender = false;
		$this->request->data[$model]['id'] = $id;
		$this->request->data[$model]['status'] = $status;
		if($this->$model->save($this->request->data,false)) {
			return $status;
		}
	}
		
	/*
	* check_existing_email function
	* Functionality -  function to check existing email adresss
	* Created date - 3-Jul-2015
	* Modified date - 
	*/
	
	function check_existing_emailID() {
		$this->loadAllModel(array('User'));
		$this->autoRender = false;
		$emailAddress = $this->request->data['User']['email_address'];
		$userType = $this->request->data['User']['user_type'];
		$status = '';
		if(!empty($this->request->data['User']['id'])){
				
			$id = base64_decode($this->data['User']['id']);
			$data = $this->User->find('first',array('conditions'=>array('User.email_address'=>$emailAddress,'User.user_type' => $userType,'User.id !='=>$id)));
		}else{
				
			$data = $this->User->find('first',array('conditions'=>array('User.email_address'=>$emailAddress,'User.user_type' => $userType)));    
		}
		if(!empty($data) && count($data) > 0){
				
			return "false";
		}else{
				
			return "true";
		}
	}
	
	/*
	* fetch_user_detail function
	* Functionality -  function to fetch user detail
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	function fetch_user_detail() {
		$this->layout = '';
		$this->autoRender = false;
		$this->loadAllModel(array('User'));
		$userID = $this->request->data['userID'];
		$userDetail = array();
		$userData = $this->User->find('first',array('conditions'=>array('User.id'=>$userID),'fields'=>array('first_name','last_name','email_address'),'recursive'=>-1));
		foreach($userData as $key=>$value) {
			$userDetail[] = $value;
		}
		return json_encode($userDetail);			
	}

	
	/*
	* forgot_password function
	* Functionality -  forgot password functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	function forgot_password() {
		$remember_me = '';
		$this->layout = 'front';
		$this->loadAllModel(array('User','EmailTemplate'));
		if(isset($this->request->data) && (!empty($this->request->data))) {
				
				$this->User->set($this->request->data);
				$email = $this->request->data['User']['email_address'];
				
				$userInfo = $this->User->find('first',array('fields'=>array('id','first_name','last_name','email_address','password'),'conditions'=>array("User.email_address" => $email,"User.status"=>1,"User.is_deleted"=>0)));
				
				if(!empty($userInfo['User']['email_address']) && ($userInfo['User']['email_address'] != '') ) {
					$this->User->id = $userInfo['User']['id'];
					$password = $this->generatePassword();
					$md5Password = md5($password);
					$this->User->saveField('password', $md5Password);
					
					//Start Forgot Password Notification
					$site_URL = Configure::read('BASE_URL');
					$logo = '<img src="'.$site_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
					$template = $this->EmailTemplate->getEmailTemplate('user_forgot_password');
					$to = $userInfo['User']['email_address'];
					$emailData = $template['EmailTemplate']['template'];					
					
					$emailData = str_replace('{FirstName}',ucfirst($userInfo['User']['first_name']),$emailData);
					$emailData = str_replace('{Email}',$userInfo['User']['email_address'],$emailData);
					$emailData = str_replace('{Password}',$password,$emailData);
					$emailData = str_replace('{Logo}',$logo,$emailData);
					//pr($emailData);	die();
					$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
					//$send_mail = $this->sendEmail($to,$subject,$emailData);  
					//End Forgot Password Notification
					
					$this->Session->setFlash("Email has been sent to your email address, please check. ",'default',array('class'=>'alert alert-success'));
					$this->redirect(array("controller"=>"users","action" => "login"));      
					
				}else {
					$this->Session->setFlash("Email not exist",'default',array('class'=>'flashError'));
					$this->redirect(array("controller"=>"users","action" => "forgot_password"));      
				}
				
				$this->Session->setFlash("Please enter email address",'default',array('class'=>'flashError'));
				$this->redirect(array("controller"=>"users","action" => "forgot_password"));
			}
		}
	/*
	* list all cities with selected state ID
	* Functionality -  list all cities with selected state ID
	* Created date - 14-Aug-2015
	* Modified date - 
	*/
	function fetch_all_cities() {
		$this->layout = '';
		$this->loadAllModel(array('State','City')); 
		$stateID = $this->request->data['stateID'];
		$allCities = $this->City->find('list',array('conditions'=>array('City.state_id'=>$stateID),'fields' => array('id','city'),'order'=>'order DESC'));
		$this->set('allCities',$allCities);
	}
		
	/*
	* admin_view_user Function
	* Functionality -  To View User Details
	* Created date - 10-Sep-2015
	*/
	
	function admin_view_user($userId = null) {
		$this->layout = 'admin';
		$userId = base64_decode(base64_decode($userId));
		$this->getUserTypes();
		$arrUser = $this->User->find('first', array('conditions'=>array('User.id'=>$userId)));
		//pr($arrUser);die;
		$this->set('arrUser', $arrUser);
	}

    /**
	 * @get Team By Id - on model window Ajax Call
	 * @Date : 11 Sep 2015
	 * @Created : Manish
	 */
	
	function loan_execution_team() {
		
		$this->loadAllModel(array('User', 'Team', 'TeamMember'));
		$this->layout = false;
		$this->autoRender = false;
		$this->getUserTypes();
		
		if(!empty($this->request->data)) {
			
			$teamId = isset($this->request->data['team'])?base64_decode(base64_decode($this->request->data['team'])):'';
			
			$this->Team->bindModel(array('belongsTo'=>array(
										'User' => array(
											'className'=> 'User',
											'foreignKey' => 'funder_id',
											'fields' =>array('id','first_name', 'last_name', 'email_address')
										),
								)));
			
			$arrTeam = $this->Team->find('first', array('conditions'=>array('Team.id'=>$teamId,'Team.status'=>'1')));
			$this->set('arrTeam', $arrTeam);
			$this->set('modelHeader', 'Team and team members for this Loan Processing.');
			
			$this->render('/Elements/model_window/show_team');
		}
	}
		
   /**
	* my_hierarchy function
	* Functionality -  
	* Created date - return description as html
	*/
		
	function my_hierarchy() {
		$this->layout = 'common';
		$this->loadAllModel(array('User', 'Team', 'TeamMember'));
		
		$userId = $this->Session->read('userInfo.id');
		$this->set('userId', $userId);
		$userType = $this->Session->read('userInfo.user_type');
		
		//echo $userId.'--'.$userType;
		
		$teamMemberTypes = array("1" =>"Borrower", "2" =>"Broker/Loan Officer", "3"=>"Sales Manager","4"=>"Sales Director", "5" => "Processor","6" =>"Funder");
		$this->set('userTypes', $teamMemberTypes);
		$arrTeam = array();
		if(array_key_exists($userType, $this->userTypes)) {
				
				if($userType!='6') {
						
						$arrTeamId = $this->TeamMember->find('list', array('fields'=>array('TeamMember.id', 'TeamMember.team_id'),'conditions'=>array('TeamMember.team_member_id'=>$userId, 'TeamMember.member_type'=>$userType, 'TeamMember.status'=>'1')));
						
						if(!empty($arrTeamId)) {
								
								foreach($arrTeamId as $tid) {
										
										$this->Team->bindModel(array('belongsTo'=>array(
												'User' => array(
													'className'=> 'User',
													'foreignKey' => 'funder_id')
										)));
										
										$this->TeamMember->bindModel(array('belongsTo'=>array(
												'User' => array(
													'className'=> 'User',
													'foreignKey' => 'team_member_id'
												)
										)));
										
										$contain = array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type','TeamMember.id','TeamMember.team_id','TeamMember.member_type','TeamMember.team_member_id','TeamMember.status' => array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type'));
										
										$arrTeam[] = $this->Team->find('first', array('contain'=>$contain,'fields'=>array('Team.id','Team.funder_id','Team.team_funder','Team.status'), 'conditions'=>array('Team.id'=>$tid,'Team.status'=>'1')));
								}
						}
				}
				
				if($userType=='6') {//funder
						
						$teamId = $userId;
						$this->Team->bindModel(array('belongsTo'=>array(
								'User' => array(
									'className'=> 'User',
									'foreignKey' => 'funder_id')	
						)));
						
						$this->TeamMember->bindModel(array('belongsTo'=>array(
								'User' => array(
									'className'=> 'User',
									'foreignKey' => 'team_member_id',
									
								)
						)));
						
						$contain = array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type','TeamMember.id','TeamMember.team_id','TeamMember.member_type','TeamMember.team_member_id','TeamMember.status' => array('User.id','User.first_name', 'User.last_name', 'User.email_address','User.user_type'));
						
						$arrTeam[] = $this->Team->find('first', array('contain'=>$contain,'fields'=>array('Team.id','Team.funder_id','Team.team_funder','Team.status'), 'conditions'=>array('Team.funder_id'=>$teamId,'Team.status'=>'1')));
				}
		}
		
		$this->set('team', $arrTeam);
	}
		
	/**
	* dashboard function
	* Functionality -  
	* Created By - Manish Singh(17th Nov 2015)
	*/	
		
	function dashboard() {
			
		$this->layout = 'common';
		$this->set('navdashboard','class = "active"');
		//$this->set('breadcrumb','Dashboard');
		
		// Get loan data
		/*$this->loadModel('Loan');
		
		$loanStates = $this->Loan->find('count', array('fields'=>'DISTINCT(Loan.state)'));
		$loanCities = $this->Loan->find('count', array('fields'=>'DISTINCT(Loan.city)'));
		
		$totalLoans = $this->Loan->find('count');
		$activeLoan = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'1')));
		$alToday = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'1', 'date(Loan.created)'=>CURRENT_DATE_DB)));
		$alMonth = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'1', 'month(Loan.created)'=>CURRENT_MONTH_DB)));
		$alYear = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'1', 'year(Loan.created)'=>CURRENT_YEAR_DB)));
		
		$closedLoan = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'2')));
		$clToday = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'2', 'date(Loan.created)'=>CURRENT_DATE_DB)));
		$clMonth = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'2', 'month(Loan.created)'=>CURRENT_MONTH_DB)));
		$clYear = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'2', 'year(Loan.created)'=>CURRENT_YEAR_DB)));
		
		$turnDownLoan = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'3')));
		$tdlToday = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'3', 'date(Loan.created)'=>CURRENT_DATE_DB)));
		$tdlMonth = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'3', 'month(Loan.created)'=>CURRENT_MONTH_DB)));
		$tdlYear = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>'3', 'year(Loan.created)'=>CURRENT_YEAR_DB)));
		
		$hsArr = array('0', '3', '4');
		$holdLoan = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>$hsArr)));
		$hlToday = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>$hsArr, 'date(Loan.created)'=>CURRENT_DATE_DB)));
		$hlMonth = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>$hsArr, 'month(Loan.created)'=>CURRENT_MONTH_DB)));
		$hlYear = $this->Loan->find('count', array('conditions'=>array('Loan.status'=>$hsArr, 'year(Loan.created)'=>CURRENT_YEAR_DB)));
		
		$this->set(compact('totalLoans',
						   'loanStates',
						   'loanCities',
						   'activeLoan',
						   'alToday',
						   'alMonth',
						   'alYear',
						   'closedLoan',
						   'clToday',
						   'clMonth',
						   'clYear',
						   'turnDownLoan',
						   'tdlToday',
						   'tdlMonth',
						   'tdlYear',
						   'holdLoan',
						   'hlToday',
						   'hlMonth',
						   'hlYear'));*/
	}
		
		
    /*
	* create_ndnca function
	* Functionality - create NDNCA document
	* Created date - 8-Jan-2016
	*/
	
	function admin_create_ndnca() {
		
		$this->loadAllModel(array('Document'));
		if(!empty($this->request->data)) {
		    $userDetail['first_name'] = $this->request->data['firstName'];
		    $userDetail['last_name'] = $this->request->data['lastName'];
			$userDetail['company_name'] = '';
			$userDetail['company_position'] = '';
		    $pdfTemplate = $this->Document->find('first', array('conditions' => array('Document.name like' => '%NDNCA%')));
		    $this->set('pdfTemplate', $pdfTemplate);  //pr($pdfTemplate);
		    $this->set('userDetail', $userDetail);
		    $this->layout = '/pdf/default';
		    $this->render('/Pdf/ndnca');
		}
		
	}
	
	/*
	* show_message_modal function
	* Functionality -  show_enquiry_modal to message/enquiry for user
	* Created date - 05-Feb-2016
	* Modified date - 
	*/
	
	public function show_message_modal($userId = null) {
		$this->autoRender = false;
		if(!empty($this->request->data)) {	
			$userID = isset($this->request->data['userID'])?$this->request->data['userID']:'';
			$this->set('userID',$userID);
			$this->render('/Elements/model_window/update_status');
		}
	}
	
	/*
	* save_enquiry function
	* Functionality -  save_enquiry to message/enquiry for user
	* Created date - 05-Feb-2016
	* Modified date - 
	*/
	
	public function save_enquiry() {
		$this->autoRender = false;
		$this->loadAllModel(array('Message'));
		if(isset($this->request->data) && (!empty($this->request->data))){ pr($this->request->data);
			$this->Message->set($this->request->data);
			if($this->Message->validates()){
				//TODO
				$userID = base64_decode($this->request->data['Message']['receiver_id']);
				$message = 'Super Admin submitted enquiry '. $this->request->data['Message']['message'] .'<a href="'.BASE_URL.'commons/my_account/'.'"> Click </a> to update.';
		
				$this->request->data['Message']['sender_id'] = ADMIN_ID;
				$this->request->data['Message']['receiver_id'] = $userID;
				$this->request->data['Message']['message'] = $message;
				$this->Message->save($this->request->data);
				$this->Session->setFlash('Message sent successfully','default',array('class'=>'alert alert-success'));	
				$this->redirect(array('admin' => true,'controller'=> 'users','action'=>'index'));
			}
		}
	}
	
	
	/*
	* activate user to invite members function
	* Functionality - A common function to change status for admin section
	* Created date - 10-Feb-2016
	* Created By - Manish
	*/
	
	public function admin_allow_invitee() {
		$this->autoRender = false; 
		$id = base64_decode($this->request->query['id']);	
		$status = $this->request->query['status'];
		$this->loadModel('User');
		$this->User->id = $id;
		if($status == 0){
			$this->User->saveField('invite_member', 1);
			return 1;
		}else {
			$this->User->saveField('invite_member', 0);
			return 1;
		}
    }
	
}
?>