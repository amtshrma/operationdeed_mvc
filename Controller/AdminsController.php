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
	var $components = array('Session','RequestHandler','Paginator','Email','Cookie','Common');
	// pagination
    public $paginate = array('limit' => PAGINATION_LIMIT, 'recursive' => 2);
	
	/**
	 * Summary - beforeFilter
	 * @return	NULL
	 * Description - beforeFilter
	*/
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	/*
	* admin_login function
	* Functionality -  Admin login functionality
	* Created date - 26-May-2015
	* Modified date - 
	*/

	function admin_login() {
		$this->loadAllModel(array('Admin','User'));
		$userId = $this->Session->read('loggedUserInfo.id');            
		if(!empty($userId)) {
			$this->redirect('dashboard');
		}
		$remember_me = '';
		$this->layout = 'admin_login';
		$this->set('title','Sign in'); 
		if(isset($this->request->data) && (!empty($this->request->data))) {
			$email = $this->request->data['Admin']['email'];
			$user_password  = md5($this->request->data['Admin']['password']);
			$this->User->unBindModel(array('hasOne' => array('UserDetail')));
			$userInfo = $this->User->find('first',array('fields'=>array('id','first_name','last_name','email_address','password'),'conditions'=>array("User.email_address" => $email,"User.password" => $user_password,"User.status"=>1,"User.is_deleted"=>0,"User.user_type"=>111)));
			if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $user_password) ) {
				$this->Session->write('loggedUserInfo', $userInfo['User']);
				$this->Session->write('ADMIN_SESSION', $userInfo['User']['id']);     
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
			} else {
				
				$this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'alert alert-danger'));			
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
		$this->set('navdashboard','class = "active"');
		$this->set('breadcrumb','Dashboard');
		// Get loan data
		$this->loadAllModel(array('Loan','Message','Notification','Todo','LoanPhase'));
		$allNotifications = $this->Notification->find('all', array('conditions'=>array('Notification.receiver_id'=>'1')));
		$allMessages = $this->Message->find('all', array('conditions'=>array('Message.receiver_id'=>'1')));
		$allTodos = $this->Todo->find('all', array('conditions'=>array('Todo.receiver_id'=>'1'),'order'=>'id DESC'));
		$this->set(compact('allNotifications','allMessages','allTodos'));
		// get all loans
		$loanArray = $loanTracking = $totalLoansPerMonth = array();
		$this->LoanPhase->bindModel(array(
				'belongsTo' => array(
					'Loan' => array(
						'foreignKey' => false,
						'conditions' => array('LoanPhase.loan_id = Loan.id')
					)
				)
		));
		$loanDetail = $this->LoanPhase->find('all',array('order'=>'LoanPhase.id desc'));
		foreach($loanDetail as $val){
			if(!in_array($val['LoanPhase']['loan_id'], $loanArray)){
				$month = date('m',strtotime($val['Loan']['created']));
				$loanArray[] = $val['LoanPhase']['loan_id'];
				// gets loan by months
				if($month <= date('m')){
					if(!empty($totalLoansPerMonth[$month])){
						$totalLoansPerMonth[$month] = $totalLoansPerMonth[$month] + 1;
					}else{
						$totalLoansPerMonth[$month] = 1;
					}
				}
				// get loans by phase
				if(!empty($loanTracking[$val['LoanPhase']['loan_phase']])){
					$loanTracking[$val['LoanPhase']['loan_phase']] = $loanTracking[$val['LoanPhase']['loan_phase']] + 1; 	
				}else{
					$loanTracking[$val['LoanPhase']['loan_phase']] = 1; 	
				}
			}
		}
		$this->set(compact('loanTracking','totalLoansPerMonth'));
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
		$userType = $this->Session->read('userInfo.user_type');
		if($userType != ""){
			$data = $this->Module->find('all',array('order'=>'module_name ASC'));
			$rolData = $this->RolePermission->find('first',array('conditions'=>array('role_id'=>$userType)));
			if(!empty($rolData)){
				$rolePermArr = explode(',',$rolData['RolePermission']['permission_ids']);
			}else{
				$rolePermArr[] = "";
			}
			$i = 0 ;
			$links[] = "";
			if(!empty($data)) {
				foreach($data as $module) {
					if(in_array($module['Module']['id'],$rolePermArr)) {
						$moduleId =  $module['Module']['id'];
						$links[$moduleId]['Controller'] =  $module['Module']['controller'];
						$links[$moduleId]['Action'] =  $module['Module']['action'];
						$links[$moduleId]['Name'] =  $module['Module']['module_name'];
						$links[$moduleId]['Icon'] =  $module['Module']['icon'];
						$i++;
					}
				}
			}
			ksort($links);
			return $links; 
		}else {
			$links[] = "";
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
		$this->loadAllModel(array('User'));
		$conditions1 = $conditions2 = array();
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
		$this->loadAllModel(array('Team', 'TeamMember'));
		//loggedUserInfo
		$userId  = base64_decode(base64_decode($userId));
		$arrTeamType = array("broker" =>"2", "smanager"=>"3", "sdirector"=>"4", "processor" => "5", 'funder'=>'6');
		$teamId = base64_decode(base64_decode($teamId));
		$this->set('teamId', $teamId);
		if(!empty($teamId)) { // Existing Team
			// Find Team Data
			$arrTeam = $this->Team->findById($teamId);
			$this->set('arrTeam', $arrTeam);
			$arrOptions = $tmid = array();
			if(!empty($arrTeam['TeamMember'])){
				foreach($arrTeam['TeamMember'] as $v) {
					if($v['status'] == '1'){
						$memberType = $v['member_type'];
						$arrOptions[$memberType][] = base64_encode(base64_encode($v['team_member_id']));
					}
					$teamMemberId = $v['id'];
					$tmid[$teamMemberId] = $v['team_member_id'];
				}
			}
			$this->set('arrOptions', $arrOptions);
		}
		// Save Team Data
		$data = array();
		if(!empty($this->request->data)){
			if($this->request->data['Team']['team_funder']){
				$this->request->data['TeamAssignment']['funder'][] = base64_encode(base64_encode($userId));
				if(empty($teamId)){
					$data['Team']['team_funder'] = $this->request->data['Team']['team_funder'];
					$data['Team']['funder_id'] = $userId;
					if($this->Team->save($data['Team'])) {
						$teamId = $this->Team->getInsertID();
					}
				}
				foreach($this->request->data['TeamAssignment'] as $key=>$val) {
					if(!empty($this->request->data['TeamAssignment'][$key])) {
						foreach($val as $v){
							$teamMemebers['TeamMember']['team_id'] = $teamId;
							$teamMemebers['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
							$memberTypeId = $arrTeamType[$key];
							$arrMemberId[] = $memberId = base64_decode(base64_decode($v));
							if($memberId){
								if(!empty($tmid)) {
									//edit section
									if(!in_array($memberId, $tmid)) { //save for new members
										$teamMemebers['TeamMember']['member_type'] = $memberTypeId;
										$teamMemebers['TeamMember']['team_member_id'] = $memberId;
										$teamMemebers['TeamMember']['funder_id'] = $userId;
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
								}else{
									// create section
									$teamMemebers['TeamMember']['member_type'] = $memberTypeId;
									$teamMemebers['TeamMember']['team_member_id'] = $memberId;
									$teamMemebers['TeamMember']['funder_id'] = $userId;
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
							}
							$this->Session->setFlash('Team memeber added successfully','default',array('class'=>'alert alert-success'));	
						}
					}
				}
				if(!empty($tmid) && !empty($arrMemberId)) {
					$arrRemovedMember = array_diff($tmid, $arrMemberId);
					foreach($arrRemovedMember as $rid=>$rv) {
						$this->TeamMember->delete($rid);
					}
				}
				$this->redirect(array('controller'=>'admins','action' => 'admin_team_listing', base64_encode(base64_encode($userId))));
			}else{
				$this->Session->setFlash('Please Enter team name ','default',array('class'=>'alert alert-danger'));	
			}
		}
	}
	
	/*
	* admin_team_listing function
	* Functionality - 
	* Created date - 01-Sep-2015
	* Created By - Manish
	*/
	
	function admin_team_listing($userId = null) {
		$this->loadAllModel(array('Team', 'TeamMember'));
		$userId  = base64_decode(base64_decode($userId));
		// Find Team Data
		$arrTeam = $this->Team->find('all', array('conditions'=>array('Team.funder_id'=>$userId, 'Team.status'=>'1')));
		krsort($arrTeam);
		$this->getUserTypes();
		$this->set(compact('userId', 'arrTeam'));
	}
	
	/*
	* loans function
	* Functionality - 
	* Created date - 08-Sep-2015
	* Created By - Manish
	*/
	
	function admin_loans($loanId = null) {
		if($this->RequestHandler->isAjax()) {
							$this->layout='ajax'; 
						}else {
							$this->layout = 'admin';  
						}
		$this->loadAllModel(array('Loan'));
		$this->getLoanTypes();
		$this->getLoanStatus();
		$this->getStatusClass();
		$criteria = '1';
		if(!empty($this->params)) {
			if(!empty($this->params->query['search'])) {
				$value = trim($this->params->query['search']);
				$criteria .= " AND (ShortApplication.loan_amount LIKE '%".$value."%' OR ShortApplication.property_type LIKE '%".$value."%')";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->paginate['recursive'] = 1;
		$this->Paginator->settings	= $this->paginate;
		$arrLoan = $this->Paginator->paginate('Loan');
		$this->set('loans', $arrLoan);
		if($this->RequestHandler->isAjax()){
			$this->render('/Elements/admin/loans');
			return;
		}
	}
	
	/*
	* loans function
	* Functionality - 
	* Created date - 08-Sep-2015
	* Created By - Manish
	*/
	
	function admin_loan_logs($shortAppId = null) {		
		$this->loadAllModel(array('LoanLog'));
		$shortAppId = !empty($shortAppId)?base64_decode(base64_decode($shortAppId)):'';
		$this->getLoanTypes();
		$this->getUserTypes();
		$arrLog = $this->LoanLog->find('all', array('conditions'=>array('LoanLog.short_application_id'=>$shortAppId), 'order'=>'LoanLog.created DESC'));
		$this->set('logs', $arrLog);
	}
	
	/*
	* loans function
	* Functionality - A common function to change status for admin section
	* Created date - 16-Sep-2015
	* Created By - Manish
	*/
	
	public function admin_status() {
		$this->layout = "ajax";
		$this->autoRender = false;
		$id = base64_decode($_GET['id']);
		$status = $_GET['status'];
		$model = $_GET['model'];
		$fld = $_GET['fld'];
		$this->loadModel($model);
		$this->$model->id = $id;
		if($status == 5){
			$this->$model->saveField($fld, 5);
			return 5;
		} else if($status == 0){
			$this->$model->saveField($fld, 1);
			return 1;
		}else{
			$this->$model->saveField($fld, 0);
			return 0;
		}
    }
	
	/*
	* loans function
	* Functionality - A common function to change status for admin section on change selectbox.
	* Created date - 17-Sep-2015
	* Created By - Manish
	*/
	
	public function admin_statusChange() {
		$this->layout = "ajax";
		$this->autoRender = false;
        if(!empty($this->request->data)) {
			$ids = $this->request->data['ids'];
			$status = $this->request->data['status'];
			$model = $this->request->data['model'];
			$fld = $this->request->data['fld'];
			$this->loadModel($model);
			$return = '';
			if(!empty($ids)) {
				foreach($ids as $eid) {
					$id = '';
					$id = base64_decode($eid);
					$this->$model->id = $id;
					if($status == "") {
						$this->Session->setFlash('<div class="errcolor">Please select an option to perform operation on records.<span style="float:right;cursorointer;">X</span></div>');
						return false;
					} elseif($status==0) {
						$this->$model->saveField($fld, 0);
						$return = array('value'=>'0', 'title'=>'Inactive', 'remvoeclass'=>'fa fa-thumbs-up green', 'addclass'=>'fa fa-thumbs-down red');
					} elseif($status==1) {
						$this->$model->saveField($fld, 1);
						$return = array('value'=>'1', 'title'=>'Active', 'remvoeclass'=>'fa-thumbs-down red', 'addclass'=>'fa-thumbs-up green');
					} elseif($status==2) {
						$this->$model->saveField($fld, 2);
						$return = array('value'=>'2', 'title'=>'Close', 'remvoeclass'=>'fa fa-thumbs-up green', 'addclass'=>'fa fa-thumbs-down red');
					} elseif($status==3) {
						$this->$model->saveField($fld, 3);
						$return = array('value'=>'3', 'title'=>'Turn Down', 'remvoeclass'=>'fa fa-thumbs-up green', 'addclass'=>'fa fa-thumbs-down red');
					} elseif($status==4) {
						$this->$model->saveField($fld, 4);
						$return = array('value'=>'4', 'title'=>'Hold', 'remvoeclass'=>'fa fa-thumbs-up green', 'addclass'=>'fa fa-thumbs-down red');
					} elseif($status==5) {
						$this->$model->saveField($fld, 5);
						$return = array('value'=>'5', 'title'=>'Deleted', 'remvoeclass'=>'fa fa-thumbs-up green', 'addclass'=>'fa fa-thumbs-down red');
					}
				}
				return json_encode($return);
			}
        }
    }
	
	/*
	* admin_loan_timeline function
	* Functionality - Loan Timeline / Loan Tracking System.
	* Created date - 18-Sep-2015
	* Created By - Manish
	*/
	
	function admin_loan_timeline($LoanId = null) {
		$this->loadAllModel(array('Loan', 'LoanLog', 'LoanPhase'));
		$LoanId = base64_decode(base64_decode($LoanId));
		$arrPhases = $this->LoanPhase->find('all', array('fields'=>array('LoanPhase.id', 'LoanPhase.loan_phase', 'LoanPhase.created'), 'conditions'=>array('LoanPhase.loan_id'=>$LoanId)));
		$arrCompletionPercent = array('A'=>'10', 'B'=>'20', 'C'=>'30', 'D'=>'40', 'E'=>'50', 'F'=>'60', 'G'=>'70', 'H'=>'80', 'I'=>'90', 'J'=>'100');
		$this->set('arrCompletionPercent', $arrCompletionPercent);
		$this->set(compact('arrCompletionPercent', 'arrPhases'));
	}
	
	/*
	* admin_template function
	* Functionality - manage templates.
	* Created date - 6-Oct-2015
	*/
	
	function admin_template() {
		$this->getAllCompany();
		$this->loadAllModel(array('CompanyTemplate'));
		$getData =  $this->Paginator->paginate('CompanyTemplate');
		$this->set('getData',$getData);
	}
	
	/*
	* admin_add_template function
	* Functionality - manage templates.
	* Created date - 6-Oct-2015
	*/
	
	function admin_add_template($id = null) {
		$this->getAllCompany();
		$this->loadAllModel(array('CompanyTemplate'));
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->request->data['CompanyTemplate']['id'] = base64_decode($this->request->data['CompanyTemplate']['id']);
			$this->CompanyTemplate->set($this->request->data['CompanyTemplate']);
			if($id) {
				$msz= "Template updated sucessfully.";
			}else {
				$msz= "Template saved sucessfully.";
			}
			$this->CompanyTemplate->save($this->request->data['CompanyTemplate']);
			$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
			$this->redirect(array('controller' => 'admins','action'=>'template'));
		}else {
			$this->request->data = $this->CompanyTemplate->read(null, base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
	/*
	   * admin_logout function
	   * Functionality -  list States 
	   * Created date - 10-Sep-2015
	   * Modified date - 
	*/
	
	function admin_list_states(){
		$this->set('stateCity',1);
		$this->loadAllModel(array('State'));
		$value = '';
		$criteria = '';
		if(!empty($this->params)){ 
			if(!empty($this->params->query['name'])){
				$value = trim($this->params->query['name']);
				$criteria .= " State.name LIKE '%".$value."%'";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('State');
		$this->set('getData',$getData);
	}
	
	/*
	* add function
	* Functionality -  add  State
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add_state($id = null){
		$this->set('stateCity',1);
		$this->loadAllModel(array('State'));
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->State->set($this->request->data['State']);
			if($this->State->validates()){
				if($id){
					$msz= "State updated sucessfully.";
				}else{
					$msz= "State saved sucessfully.";
				}
				if($this->State->save($this->request->data['State'])){
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('controller'=>'admins','action' => 'admin_list_states'));
				}
			}
		}else{
			$this->request->data = $this->State->findById(base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
	/*
	   * admin_logout function
	   * Functionality -  list States 
	   * Created date - 10-Sep-2015
	   * Modified date - 
	*/
	
	function admin_list_cities(){
		$this->set('stateCity',1);
		$this->loadAllModel(array('City'));
		$value = '';
		$criteria = '';
		if(!empty($this->params)){ 
			if(!empty($this->params->query['city'])){
				$value = trim($this->params->query['city']);
				$criteria .= " City.city LIKE '%".$value."%'";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->paginate['order'] = 'status desc';
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('City');
		$this->set('getData',$getData);
	}
	
	/*
	* add function
	* Functionality -  add  State
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add_city($id = null){
		$this->set('stateCity',1);
		$this->loadAllModel(array('City','State'));
		$states = $this->State->find('list',array('conditions'=>array('status'=>'1')));
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->City->set($this->request->data['City']);
			if($this->City->validates()){
				if($id){
					$msz= "City updated sucessfully.";
				}else{
					$msz= "City saved sucessfully.";
				}
				if($this->City->save($this->request->data['City'])){
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('controller'=>'admins','action' => 'admin_list_cities'));
				}
			}
		}else{
			$this->request->data = $this->City->findById(base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);
		$this->set('state',$states);
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
	/*
	   * admin_settings function
	   * Functionality -  list States 
	   * Created date - 10-Sep-2015
	   * Modified date - 
	*/
	
	function admin_settings($id = '1'){
		$this->loadAllModel(array('AdminSetting'));
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->AdminSetting->set($this->request->data['AdminSetting']);
			if($this->AdminSetting->validates()){
				if($this->AdminSetting->save($this->request->data['AdminSetting'])){
					$this->Session->setFlash('Settings updated','default',array('class'=>'alert alert-success'));	
					$this->redirect(array('controller'=>'admins','action' => 'admin_settings'));
				}
			}
		}else{
			$this->request->data = $this->AdminSetting->findById($id);
		}
		$this->set('navitems','class = "active"');			
	}
	
	/*
	   * admin_settings function
	   * Functionality -  list States 
	   * Created date - 10-Sep-2015
	   * Modified date - 
	*/
	
	function admin_loan_reasons(){        
		$this->loadAllModel(array('LoanReason'));
		$value = $criteria = '';
		if(!empty($this->params)){ 
			if(!empty($this->params->query['loan_reason'])){
				$value = trim($this->params->query['loan_reason']);
				$criteria .= " LoanReason.loan_reason LIKE '%".$value."%'";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('LoanReason');
		$this->set('getData',$getData); 
	}
	
	/*
	* add function
	* Functionality -  add  State
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add_loan_reason($id = null){
		$this->loadAllModel(array('LoanReason'));
		if(isset($this->request->data) && !empty($this->request->data)){ 
			$this->LoanReason->set($this->request->data['LoanReason']);
			if($this->LoanReason->validates()){
				if($id){
					$msz= "Loan Reason updated sucessfully.";
				}else{
					$msz= "Loan Reason saved sucessfully.";
				}
				if($this->LoanReason->save($this->request->data['LoanReason'])){
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('controller'=>'admins','action' => 'admin_loan_reasons'));
				}
			}
		}else{
			$this->request->data = $this->LoanReason->findById(base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
	/*
	* compose message function
	* Functionality -  show compose message
	* Created date - 29-Jan-2015
	* Modified date - 
	*/
	
	public function compose_message() {
		$this->loadAllModel(array('User','Message'));
		$this->layout = false;
		$this->autoRender = false;
		$allUsers = $this->User->find('all',array('fields'=>array('id','name','user_type'),'conditions'=>array("User.id !="=>ADMIN_ID,"User.status"=>1,"User.is_deleted"=>0)));
		if(isset($this->request->data) && (!empty($this->request->data))){ 
			$this->Message->set($this->request->data);
			if($this->Message->validates()){
				$this->request->data['Message']['sender_id'] = ADMIN_ID;
				$this->Message->save($this->request->data);
				$this->Session->setFlash('Message sent successfully','default',array('class'=>'alert alert-success'));	
				$this->redirect(array('admin' => true,'controller'=> 'admins','action'=>'dashboard'));
			}
		}
		$this->set('allUsers',$allUsers);
		$this->render('/Elements/model_window/compose_message');
		
	}
	
	/**
	  * Description :- getloandByPhase
	  * @var object :- $loanPhase
	*/
	
	function getloandByPhase($loanPhase = null){
		$this->layout = '';
		$loanPhase = explode(' ',base64_decode($loanPhase));
		$loanDetail = '';
		$this->getLoanReasons();
		if($loanPhase['1']){
			$this->loadAllModel(array('LoanPhase','Loan'));
			$this->LoanPhase->bindModel(array(
				'belongsTo' => array(
						'Loan' => array(
							'foreignKey' => false,
							'conditions' => array('LoanPhase.loan_id = Loan.id')
						)	
					)
			));
			$loanDetail = $this->LoanPhase->find('all',array('fields'=>'Loan.short_app_id,Loan.borrower_id,LoanPhase.loan_phase,LoanPhase.loan_id,LoanPhase.id','order'=>'LoanPhase.id DESC'));
			if($loanDetail){
				$shortAppId = ''; $notCheck = array();
				foreach($loanDetail as $key=>$val){
					if(!in_array($val['LoanPhase']['loan_id'],$notCheck)){
						if($val['LoanPhase']['loan_phase'] == $loanPhase['1']){
							$shortAppId[$val['Loan']['short_app_id']] = $val['Loan']['short_app_id'];	
						}
						$notCheck[] = $val['LoanPhase']['loan_id'];
					}
				}
				$loanDetailFull = $this->Loan->find('all',array('conditions'=>array('Loan.short_app_id' => $shortAppId),'recursive'=>2));
				$this->set('loanDetailFull',$loanDetailFull);
			}
		}
	}
	
	/**
	 * Description :- admin_loanPhases
	 * @var object :- NULL
	*/
	
	function admin_loanPhases(){
		$this->loadModel('PhaseName');
		$criteria = '';
		if(!empty($this->params)){
			if(isset($this->params->query['phase_name'])){
				$criteria .= " PhaseName.phase_name LIKE '%".trim($this->params->query['phase_name'])."%'";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->paginate['limit'] = 50;
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('PhaseName');
		$this->set('getData',$getData); 
	}
	
	/**
	 * Description :- admin_add_loan_phase
	 * @var object :- $id
	*/
	
	public function admin_add_loan_phase($id = null){
		$this->loadAllModel(array('PhaseName'));
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->PhaseName->set($this->request->data['PhaseName']);
			if($this->PhaseName->validates()){
				if($id){
					$msz= "Loan Phase updated sucessfully.";
				}else{
					$msz= "Loan Phase saved sucessfully.";
				}
				if($this->PhaseName->save($this->request->data['PhaseName'])){
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('controller'=>'admins','action' => 'admin_loanPhases'));
				}
			}
		}else{
			$this->request->data = $this->PhaseName->findById(base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
	/**
	 * Description :- admin_manageVideo
	 * @var object :- NULL
	*/
	
	public function admin_manageVideo(){
		$this->loadModel('VideoTutorial');
		$criteria = '';
		if(!empty($this->params)){
			if(isset($this->params->query['video_name'])){
				$criteria .= " VideoTutorial.title LIKE '%".trim($this->params->query['video_name'])."%'";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('VideoTutorial');
		$this->set('getData',$getData); 
	}
	
	/*
	* add function
	* Functionality -  add  State
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add_video_tutorial($id = null){
		$this->loadAllModel(array('VideoTutorial'));
		if(isset($this->request->data) && !empty($this->request->data)){
			$this->VideoTutorial->set($this->request->data['VideoTutorial']);
			if($this->VideoTutorial->validates()){
				if($id){
					$msz= "Video updated sucessfully.";
				}else{
					$msz= "Video saved sucessfully.";
				}
				if($this->VideoTutorial->save($this->request->data['VideoTutorial'])){
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('controller'=>'admins','action' => 'admin_manageVideo'));
				}
			}
		}else{
			$this->request->data = $this->VideoTutorial->findById(base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
	/*
	* admin_dashBoardDetail function
	* Functionality -  admin_dashBoardDetail
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	function admin_dashBoardDetail(){
		$this->autoRender = false;
		$this->loadModel('Loan');
		$returnDetail = array();
		$loans = $this->Loan->find('all');
		if(!empty($loans)){
			foreach($loans as $key=>$val){
				// get total loans
				if(!isset($returnDetail['totalLoans'])){
					$returnDetail['totalLoans'] = 1;	
				}else{
					$returnDetail['totalLoans'] = $returnDetail['totalLoans'] + 1;
				}
				// get total investment
				if(!isset($returnDetail['allLoansInvestment'])){
					$returnDetail['allLoansInvestment'] = $val['ShortApplication']['loan_amount'];	
				}else{
					$returnDetail['allLoansInvestment'] = $returnDetail['allLoansInvestment'] + $val['ShortApplication']['loan_amount'];
				}
				// get today investment
				if(date('d',strtotime($val['Loan']['created'])) === date('d')){
					// get today investment
					if(!isset($returnDetail['todaysInvestment'])){
						$returnDetail['todaysInvestment'] = $val['ShortApplication']['loan_amount'];	
					}else{
						$returnDetail['todaysInvestment'] = $returnDetail['todaysInvestment'] + $val['ShortApplication']['loan_amount'];
					}
					// get today loans
					if(!isset($returnDetail['todaysLoans'])){
						$returnDetail['todaysLoans'] = 1;	
					}else{
						$returnDetail['todaysLoans'] = $returnDetail['todaysLoans'] + 1;
					}
				}
			}
		}
		return json_encode($returnDetail);
	}
}
?>