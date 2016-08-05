<?php
/*
* SalesManagersController class
* Functionality -  Manage the Users (Sales Manager)
* Created date - 9-Jul-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 
class SalesManagersController extends AppController {
	var $name = 'SalesManagers';
	public $useTable = 'users';
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array();
	function beforeFilter() {
		$allow = array();
		parent::beforeFilter();    
		$this->checkUserSession($allow,3);
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
    
	/*
	* short_app function
	* Functionality - short_app listing
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function short_app() {
		$this->loadAllModel(array('ShortApplication','State'));
		$this->layout = 'front';
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		$allApplications = $this->ShortApplication->find('all');
		$this->set('allApplications',$allApplications);
		$this->set('states',$states);        
	}
	
    /*
	* short_app_detail function
	* Functionality - short_app_detail dashboard functionality
	* Created date - 9-Jul-2015
	* Modified date - 
	*/
	
	public function short_app_detail() {
		$this->layout = 'front';			
	}
	
	/**
	 * Description
	 * @var object
	*/
	
	function salesCommission(){
		$this->layout = 'dashboard_common';
	}
}