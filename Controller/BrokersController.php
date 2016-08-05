<?php
/*
* BrokersController class
* Functionality -  Manage the Users (Brokers)
* Created date - 9-Jul-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 

class BrokersController extends AppController {

	var $name = 'Brokers';
    public $useTable = 'users';
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array();

	function beforeFilter() {
		$allow = array();
		parent::beforeFilter();    
		$this->checkUserSession($allow,2);	
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
		$this->layout = 'admin';
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
		
        $this->layout = 'admin';        
    }
}