<?php
/*
* Admins Controller class
* Functionality -  Manage the admin login,listing,add 
* Created date - 26-May-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility'); 
class AdminsController extends AppController {
	
	var $uses = array('Notification');
	var $name = 'Admins';        
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array('limit' => 10,);

	function beforeFilter(){
		
		parent::beforeFilter();
	}
	/*
	* admin_login function
	* Functionality -  Admin login functionality
	* Created date - 26-May-2015
	* Modified date - 
	*/
	
	function admin_login() { 
		$userId = $this->Session->read('loggedUserInfo.id');            
		if(!empty($userId)) {
			$this->redirect('dashboard');
		}
		$this->loadModel('Admin');
		$remember_me = '';
		$this->layout = 'admin_login';
		$this->set('title','Sign in'); 
		if(isset($this->request->data) && (!empty($this->request->data)))
		{	
			//$this->Admin->set($this->request->data);
			//$this->Admin->validator()->remove('email', 'rule1');			
			if($this->Admin->validates(array('fieldList' => array('email', 'password')))) 
			{	
				$email = $this->request->data['Admin']['email'];
				$user_password  = md5($this->request->data['Admin']['password']);					
				$userInfo = $this->Admin->find('first',array('fields'=>array('id','first_name','last_name','email','password','admin_role_id'),'conditions'=>array("Admin.email" => $email,"Admin.password" => $user_password,"Admin.status"=>1,"Admin.is_deleted"=>0)));
				if(!empty($userInfo['Admin']['password']) && ($userInfo['Admin']['password'] == $user_password) ) {
					$this->Session->write('loggedUserInfo', $userInfo['Admin']);
					$this->Session->write('ADMIN_SESSION', $userInfo['Admin']['id']);     
					if(!empty($this->request->data['Admin']['remember_me'])) {
						$email = $this->Cookie->read('AdminEmail');
						$password = base64_decode($this->Cookie->read('AdminPass'));						
					if(!empty($email) && !empty($password)) {
						$this->Cookie->delete('AdminEmail');
						$this->Cookie->delete('AdminPass');     
					} 						
					$cookie_email = $this->request->data['Admin']['email'];						
					$this->Cookie->write('AdminEmail', $cookie_email, false, '+2 weeks');						
					$cookie_pass = $this->request->data['Admin']['password'];
					$this->Cookie->write('AdminPass', base64_encode($cookie_pass), false, '+2 weeks'); 
					}else {
						$email = $this->Cookie->read('AdminEmail');
						$password = base64_decode($this->Cookie->read('AdminPass'));
					if(!empty($email) && !empty($password)) {
						$this->Cookie->delete('AdminEmail');
						$this->Cookie->delete('AdminPass');     
						}
					}
					$this->redirect('dashboard');                    
				}
				else {						
					$this->Session->setFlash("Email or Password is incorrect.",'default',array('class'=>'flashError'));			
					}
			}else{
				$this->Session->setFlash("Please enter the valid Email or Password.",'default',array('class'=>'flashError'));	
			}
		}else {
			$email = $this->Cookie->read('AdminEmail');
			$password = base64_decode($this->Cookie->read('AdminPass'));				
			if(!empty($email) && !empty($password)) {
				$remember_me  = true;
				$this->request->data['Admin']['email']  = $email;
				$this->request->data['Admin']['password']  = $password;					
			}				
		}
		$this->set('remember_me',$remember_me);
	}     
	
	/*
	* admin_dashboard function
	* Functionality -  Dashboard functionality
	* Created date - 26-May-2015
	* Modified date - 
	*/
	
	function admin_dashboard() {
		
		$this->layout = 'admin';
		$this->set('navdashboard','class = "active"');
		$this->set('breadcrumb','Dashboard');
	}
	
	/*
	   * admin_logout function
	   * Functionality -  Logout Admin 
	   * Created date - 26-May-2015
	   * Modified date - 
	*/
	
	function admin_logout() {
		
		$this->Session->delete('loggedUserInfo');			
		$this->redirect('login');
	}
	
	/*
	   * admin_getAllLinks function
	   * Functionality -  get all links as per user login access 
	   * Created date - 23-Jun-2015
	   * Modified date - 
	*/
	
	function getAllLinks() {
		
		$this->loadModel('RolePermission');
		$this->loadModel('Module');
		$id = $this->Session->read('userInfo.user_type');
		
		if($id != ""){
			$data = $this->Module->find('all',array('order'=>'module_name ASC'));
			$rolData = $this->RolePermission->find('first',array('conditions'=>array('role_id'=>$id)));
			if(!empty($rolData)){
				$rolePermArr = explode(',',$rolData['RolePermission']['permission_ids']);
			}else{
				$rolePermArr[] ="";
			}
			$i =0 ;
			$links[] ="";
			foreach($data as $module){
				if(in_array($module['Module']['id'],$rolePermArr)){
					$links[$i]['Controller'] =  $module['Module']['controller'];
					$links[$i]['Action'] =  $module['Module']['action'];
					$links[$i]['Name'] =  $module['Module']['module_name'];
					$links[$i]['Icon'] =  $module['Module']['icon'];
					$i++;
				}
			}
			return $links; 
		}else{
			$links[] ="";
			return $links; 
		}
	}
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function admin_message() {  
		
		$this->layout = 'admin';
		$this->loadAllModel(array('Message'));
		$loginData = $this->Session->read('loggedUserInfo'); 
		$id = $loginData['id'];
		$criteria = "Message.receiver_id = $id";
		$this->paginate['conditions'] = array($criteria);
		$this->Paginator->settings	= $this->paginate;
		
		$getData =  $this->Paginator->paginate('Message'); 
		$this->set('getData',$getData);
	}
	
	/*
	* admin_team_assignment function
	* Functionality -  Team Assignment functionality functionality
	* Created date - 28-Aug-2015
	*/
	
	function admin_team_assignment($search = null) {
		
		$this->layout = 'admin';		
		$this->loadAllModel(array('User'));
		
		$conditions1 = array();
		$conditions2 = array();
		
		$conditions1 = array('User.user_type'=>'6', 'User.status'=>'1', 'User.is_deleted'=>'0');
		$keyword = '';
		if(!empty($this->params->query)&& ($this->params->query['name'] !='')) {
			
			$keyword = $this->params->query['name'];
			$conditions2 = array('OR'=>array('User.first_name LIKE'=>$keyword, 'User.last_name LIKE'=>$keyword, 'User.email_address LIKE'=>$keyword));
		}
		
		$conditions = array_merge($conditions1, $conditions2);
		
		$arrFunder = $this->User->find('all', array('fields'=>array('User.id', 'User.first_name', 'User.last_name', 'User.email_address', 'UserDetail.company_name', 'UserDetail.office_phone', 'UserDetail.mobile_phone', 'UserDetail.fax_number'), 'conditions'=>$conditions));
		
		$this->set('funders', $arrFunder);
	}
	
	/*
	* admin_team_assignment function
	* Functionality - 
	* Created date - 28-Aug-2015
	* Created By - Manish
	*/
	
	function admin_manage_team($userId = null, $teamId = null) {
		
		$this->layout = 'admin';
		
		$this->loadAllModel(array('Team', 'TeamMember'));
		
		//loggedUserInfo
		$userId  = base64_decode(base64_decode($userId));
		
		$arrTeamType = array("broker" =>"2", "smanager"=>"3", "sdirector"=>"4", "processor" => "5");
		
		if(!empty($teamId)) { // Existing Team
			
			$teamId = base64_decode(base64_decode($teamId));
			// Find Team Data
			$arrTeam = $this->Team->find('first', array('conditions'=>array('Team.id'=>$teamId)));
			$this->set('arrTeam', $arrTeam);
			
			$arrOptions = array();
			$tmid = array();
			
			if(isset($arrTeam['TeamMember']) && !empty($arrTeam['TeamMember'])) {
				
				foreach($arrTeam['TeamMember'] as $v) {
					
					if($v['status']=='1') {
						
						$memberType = $v['member_type'];
						$arrOptions[$memberType][] = base64_encode(base64_encode($v['team_member_id']));
					}
					
					//
					$teamMemberId = $v['id'];
					$tmid[$teamMemberId] = $v['team_member_id'];
				}			
			}
			
			$this->set('arrOptions', $arrOptions);
		}
		
		$teamFunderCode = '';
		if(empty($teamId)) { // New Team
			
			$count = $this->Team->find('count', array('conditions'=>array('Team.funder_id'=>$userId), 'group'=>'Team.team_funder'));
			$teamFunder = $count + 1;
			$teamFunderCode = 'Team-'.$teamFunder;
		}
		
		// Save Team Data
		
		$data = array();
		$flipArr = array();
		if(!empty($this->request->data) ) {
			
			$i = 0;
			foreach($this->request->data['TeamAssignment'] as $key=>$val) {
				
				if(!empty($this->request->data['TeamAssignment'][$key])) {
					
					if(empty($teamId)) {
						
						$data['Team']['team_funder'] = $teamFunderCode;
						$data['Team']['funder_id'] = $userId;
						
						if($this->Team->save($data['Team'])) {
							
							$teamId = $this->Team->getInsertID();						
						}
					}
					
					foreach($val as $v) {
						
						$teamMemebers['TeamMember']['team_id'] = $teamId;
						$teamMemebers['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
						$memberTypeId = $arrTeamType[$key];
						$memberId = base64_decode(base64_decode($v));
						
						if(!empty($tmid)) {//edit section
							
							if(!in_array($memberId, $tmid)) { //save for new members
								
								$teamMemebers['TeamMember']['member_type'] = $memberTypeId;
								$teamMemebers['TeamMember']['team_member_id'] = $memberId;
								
								$this->TeamMember->create();
								if($this->TeamMember->save($teamMemebers['TeamMember'])) {
									// send Notifications to team members
									
									$notify['receiver_id'] = $memberId;
									$notify['action'] = 'Team assignment.';
									$notify['action_id'] = $memberId;
									
									$this->Notification->create();
									$this->Notification->save($notify);
								}
							}
							
							if(in_array($memberId, $tmid)) {
								$arrMemberId[] = $memberId;
							}
						}else { // create section
							
							$teamMemebers['TeamMember']['member_type'] = $memberTypeId;
							$teamMemebers['TeamMember']['team_member_id'] = $memberId;
							$this->TeamMember->create();
							if($this->TeamMember->save($teamMemebers['TeamMember'])) {
								
								// send Notifications to team members
									
									$notify['receiver_id'] = $memberId;
									$notify['action'] = 'Team assignment.';
									$notify['action_id'] = $memberId;
									pr($notify);
									$this->Notification->create();
									$this->Notification->save($notify);
							}
						}
						$i++;
					}
				}
			}
			
			if(!empty($tmid) && !empty($arrMemberId)) {
				
				$arrRemovedMember = array_diff($tmid, $arrMemberId);
				
				foreach($arrRemovedMember as $rid=>$rv) {
					
					$this->TeamMember->id = $rid;
					$this->TeamMember->saveField('status', '0');
				}
			}
			
			$this->redirect(array('controller'=>'admins','action' => 'admin_team_listing', base64_encode(base64_encode($userId))));
		}
	}
	
	/*
	* admin_team_listing function
	* Functionality - 
	* Created date - 01-Sep-2015
	* Created By - Manish
	*/
	
	function admin_team_listing($userId = null) {
		
		$this->layout = 'admin';		
		$this->loadAllModel(array('Team', 'TeamMember'));
		
		$userId  = base64_decode(base64_decode($userId));
		
		// Find Team Data
		$arrTeam = $this->Team->find('all', array('conditions'=>array('Team.funder_id'=>$userId, 'Team.status'=>'1')));
		
		krsort($arrTeam);
		
		$this->getUserTypes();
		$this->set(compact('userId', 'arrTeam'));
	}
}
?>