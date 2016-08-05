<?php
/*
* FormFields Controller class
* Functionality -  Manage the Form fields
* Created date - 23-Jun-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility'); 
class FormfieldsController extends AppController {
	var $uses = array();
	var $name = 'Formfields';        
	var $components = array('Email','Cookie','Common','Paginator');
	
	function beforeFilter(){
		parent::beforeFilter();    
	
	}        
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 23-Jun-2015
	* Modified date - 
	*/
	public function admin_index() { 
		$this->layout = 'admin';
		if($this->request->data) {
			pr($this->request->data);
		die();	
		}
		
	}

}
?>