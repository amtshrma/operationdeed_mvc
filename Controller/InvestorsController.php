<?php
/*
* Investors Controller class
* Functionality -  Manage the Investor
* Created date - 8-Jul-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 

class InvestorsController extends AppController {
	
	var $name = 'Investors';
    public $useTable = 'users';
	var $components = array('Session','RequestHandler','Paginator','Email','Cookie','Common');
	
	// pagination
    public $paginate = array('limit' => PAGINATION_LIMIT, 'recursive' => 2);
	
	function beforeFilter() {
		
		$allow = array('index');
		parent::beforeFilter();
		//$this->checkUserSession($allow,7);
	}
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function admin_index() {
		
		$this->layout = 'admin';
		$this->loadAllModel(array('User','UserDetail','State'));
		$this->getInvestorType();
		$this->getLicenceTypes();
		$this->getReferredBy();
		$this->getArrStatus();
		$this->getStatusClass();
		
		$value ="";
		$criteria = 'User.is_deleted = 0 AND User.user_type =7';
		
		if(!empty($this->params)) {
			if(!empty($this->params->query['first_name']) && isset($this->params->query['first_name'])) {
				
				$value = trim($this->params->query['first_name']);
				$criteria .= " AND (User.first_name LIKE '%".$value."%' )";
			}
			
			if(!empty($this->params->query['search_email']) && isset($this->params->query['search_email'])) {
				
				$search_email = trim($this->params->query['search_email']);
				$criteria .= " AND (User.email_address = '$search_email')";
			}
		}
		
		$this->paginate['conditions'] = array($criteria);
		$this->Paginator->settings	= $this->paginate;
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$users = $this->User->find('list',array('fields'=>array('id','first_name'),'order'=>'first_name ASC'));
		$getData =  $this->Paginator->paginate('User');
		$this->set('getData',$getData);
		$this->set('states',$states);
		$this->set('users',$users);
	}
	
	/*
	* add function
	* Functionality -  add  user functionality
	* Created date - 26-Jun-2015
	* Modified date - 
	*/
	
	public function admin_add($id = null) {
		
		$this->layout = 'admin';
		$this->loadAllModel(array('User','UserDetail','State','EmailTemplate'));
		$this->getInvestorType();
		$this->getLicenceTypes();
		$this->getReferredBy();
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$users = $this->User->find('list',array('fields'=>array('id','first_name'),'order'=>'first_name ASC'));
		
		if(isset($this->request->data) && !empty($this->request->data)) {
			
			$this->request->data['User']['id'] = base64_decode($this->request->data['User']['id']);
			$this->request->data['UserDetail']['id'] = base64_decode($this->request->data['UserDetail']['id']);
			$this->User->set($this->request->data['User']);
			$this->UserDetail->set($this->request->data['UserDetail']);
			$userValidate = $this->User->validates();
			$userDetailValidate = $this->UserDetail->validates();
			
			if($userValidate && $userDetailValidate) {
				
				if($id) {
					
					$msz= "User updated sucessfully.";
				}else {
					
					//Image Upload
					if(!empty($this->request->data['profile_pic'])){
						if(isset($this->request->data['profile_pic']['name']) && $this->request->data['profile_pic']['name'] != ""){
							$file = $this->request->data['profile_pic']['name'];
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
								$this->request->data['UserDetail']['profile_pic'] = $filename;	
							}
						}
					}else {
						
						$filename = 'defaultUser.jpg';
						$this->request->data['UserDetail']['profile_pic'] = $filename;
					}
					
					$password = $this->generatePassword();
					$this->request->data['User']['password'] = md5($password);
					$msz= "User saved sucessfully.";
				}
				
				if(count($this->request->data['User']['investor_type'])) {
					
					$this->request->data['User']['investor_type'] = implode(',',$this->request->data['User']['investor_type']);
				}
				
				//unset($this->request->data['User']['investor_type']);
				
				if($this->User->save($this->request->data['User'])) {
					
					$userID = $this->User->id;
					$this->request->data['UserDetail']['user_id'] = $userID;
					$birthDate = '';
					
					if(count($this->request->data['UserDetail']['date_of_birth'])) {
						
						foreach($this->request->data['UserDetail']['date_of_birth'] as $birth) {
							
							if($birth) {
								
								$birthDate .= $birth.'-';
							}
						}
					}
					
					unset($this->request->data['UserDetail']['date_of_birth']);
					
					$this->request->data['UserDetail']['birthdate'] = substr($birthDate,0,-1);
					$this->UserDetail->save($this->request->data['UserDetail']);
					
					//welcome email notification
					if(!$this->request->data['User']['id']) {
						
						$hashCode =  md5(uniqid(rand(), true));
						$this->User->saveField('random_key',$hashCode, false);
						$site_URL = Configure::read('BASE_URL');
						$active =  '<a href = "' .$site_URL. '/users/secure_check/'.$hashCode.'">Click to activate your account </a>'; 
						$logo = '<img src="'.$site_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
						$template = $this->EmailTemplate->getEmailTemplate('welcome_to_site');
						$to = $this->request->data['User']['email_address'];
						$emailData = $template['EmailTemplate']['template'];					
						
						$emailData = str_replace('{FirstName}',ucfirst($this->request->data['User']['first_name']),$emailData);
						$emailData = str_replace('{Email}',$this->request->data['User']['email_address'],$emailData);
						$emailData = str_replace('{Password}',$password,$emailData);
						$emailData = str_replace('{Link}',$active,$emailData);
						$emailData = str_replace('{Logo}',$logo,$emailData);
						$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
						//$send_mail = $this->sendEmail($to,$subject,$emailData);  
					}
					
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$userError = $this->User->validationErrors;
				$userDetailError = $this->UserDetail->validationErrors;
				$this->set('errors',array_merge($userError,$userDetailError));
			}   
		}else {
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
	* admin_delete function
	* Functionality -  delete user
	* Created date - 26-Jun-2015
	* Modified date - 
	*/       
	
	function admin_delete($id = null) {
		
		$this->autoRender=false;
		$this->loadAllModel(array('User'));
		
		if(!empty($id)) {
			
			$id = base64_decode($id);
			$this->User->id = $id;
			
			if($this->User->updateAll(array('User.is_deleted'=>'1'),array('User.id'=>$id))) {
				
				$this->Session->setFlash('User deleted successfully.','default',array('class'=>'alert alert-success'));	
				$this->redirect(array("controller"=>"users","action" => "index"));
			}
		}
		else {
			
			$this->redirect(array("controller"=>"users","action" => "index"));	
		}
	}
	
	/*
	* secure_check function
	* Functionality -  activate user account
	* Created date - 1-Jul-2015
	* Modified date - 
	*/ 
	
	function secure_check($uniqueKey) {
		$this->layout = 'admin_login';
		$this->loadAllModel(array('User'));
		$this->set('title','Activate Account');
		$this->set('title_for_layout','Activate Account');
		$this->set('uniqueKey',$uniqueKey);
		$data = $this->User->find('first',array('conditions'=>array('User.random_key'=>$uniqueKey)));
		$controller = 'users';
		if(empty($data)) {
			$this->Session->setFlash('Error Occured, Please check your secure code.','default',array('class'=>'alert alert-danger'));
			$this->redirect(array('controller'=>'homes','action'=>'index'));
		}
		$userID = $data['User']['id'];
		$this->request->data['User']['id'] = $userID;
		$this->request->data['User']['status'] = '1';
		$this->request->data['User']['random_key'] = "";
		$this->User->save($this->request->data);
		$this->Session->setFlash('Account activated successfully','default',array('class'=>'alert alert-success'));
		if($data['User']['user_type'] == 1) {
			$controller =  'borrowers';
		}else if($data['User']['user_type'] == 2){
			$controller =  'brokers';
		}else if($data['User']['user_type'] == 3){
			$controller =  'sales_managers';
		}else if($data['User']['user_type'] == 4){
			$controller =  'sales directors';
		}else if($data['User']['user_type'] == 5){
			$controller =  'processors';
		}else if($data['User']['user_type'] == 6){
			$controller =  'funders';
		}else {
			$controller =  'users';
		}
		$this->redirect(array('controller'=>$controller,'action'=>'login'));	
	}
	
	/*
	* admin_setnewStatus function
	* Functionality -  Active/Deactivate Status
	* Created date - 3-Jul-2015
	* Modified date - 
	*/        
	
	function admin_setnewStatus($id,$status,$model) {
		
		$this->loadModel($model);
		$this->request->data[$model]['id'] = $id;
		$this->request->data[$model]['status'] = $status;
		
		if($this->$model->save($this->request->data,false)) {
			
			return $status; exit;
		}
	}
	
	/*
	* check_existing_email function
	* Functionality -  function to check existing email adresss
	* Created date - 3-Jul-2015
	* Modified date - 
	*/
	
	function check_existing_emailID() {
		
		$this->layout = '';
		$this->autoRender = false;
		$this->loadAllModel(array('User'));
		$emailAddress = $this->request->data['User']['email_address'];
		$userType = $this->request->data['User']['user_type'];
		$status = '';
		
		if(!empty($this->data['User']['id'])) {
			
			$id = base64_decode($this->data['User']['id']);
			$data = $this->User->find('first',array('conditions'=>array('User.email_address'=>$emailAddress,'User.user_type' => $userType,'User.id !='=>$id)));
		}else {
			
			$data = $this->User->find('first',array('conditions'=>array('User.email_address'=>$emailAddress,'User.user_type' => $userType)));    
		}
		
		if(!empty($data) && count($data) > 0) {
			
			return false;
		}else {
			
			return true;
		}
		exit;
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
		$data = $this->User->find('first',array('conditions'=>array('User.id'=>$userID),'fields'=>array('User.first_name','User.last_name','User.email_address')));
		
		$userDetail = array();
		if(!empty($data)) {
			
			foreach($data as $key=>$value) {
				
				$userDetail[] = $value;
			}
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
				
				$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
				//$send_mail = $this->sendEmail($to,$subject,$emailData);  
				
				//End Forgot Password Notification				
				$this->Session->setFlash("Email has been sent to your email address, please check. ",'default',array('class'=>'alert alert-success'));
				$this->redirect(array("controller"=>"users","action" => "login"));      
				
			} else {
				
				$this->Session->setFlash("Email not exist",'default',array('class'=>'flashError'));
				$this->redirect(array("controller"=>"users","action" => "forgot_password"));      
			}
			
			$this->Session->setFlash("Please enter email address",'default',array('class'=>'flashError'));
			$this->redirect(array("controller"=>"users","action" => "forgot_password"));     
		}
	}
	
	//1. Create Funders and Choose their team structure
	
	function index() {
		$this->layout = 'page';
	}
	
	/*
	* dashboard function
	* Functionality - user dashboard functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function dashboard() {
		
        $this->layout = 'common';        
    }
}
?>