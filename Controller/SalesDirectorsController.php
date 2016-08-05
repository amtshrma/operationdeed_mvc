<?php
/*
* SalesDirectorsController class
* Functionality -  Manage the Users (SalesDirector)
* Created date - 9-Jul-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 
class SalesDirectorsController extends AppController {
	
	var $name = 'SalesDirectors';
    public $useTable = 'users';
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array();
	function beforeFilter(){
		$allow = array();
		parent::beforeFilter();    
		$this->checkUserSession($allow,4);
	}   
    
    /*
	* dashboard function
	* Functionality - user dashboard functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function user_list() {
        $this->layout = 'dashboard_common';
		$search = array(1,2,3);
		if(isset($this->request->query['search'])){
			$search = base64_decode($this->request->query['search']);
		}
		$this->loadAllModel(array('User', 'Team', 'TeamMember'));
		$this->paginate['order'] = 'User.id DESC';
		$this->paginate['conditions'] = array('User.user_type'=>$search, 'User.status'=>'1');
		$this->paginate['fields'] = array('User.id', 'User.email_address', 'User.name','User.user_type');
		$this->Paginator->settings	= $this->paginate;
		$allUsers =  $this->Paginator->paginate('User');
		
		$this->set('users', $allUsers);
    }
    
	
	/*
	* short_app function
	* Functionality - short_app listing
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	
}