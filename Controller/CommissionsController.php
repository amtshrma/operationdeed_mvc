<?php
/*
* Commissions Controller class
* Functionality -  Manage Commission
* Created date - 5-Nov-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 

class CommissionsController extends AppController {

	var $name = 'Commissions';
	var $components = array('Email','Cookie','Common','Paginator');

	public $paginate = array(
						'limit' => 10,
						'order' => array(
							'documents.id' => 'DESC'
						)
					);

	function beforeFilter() {
		parent::beforeFilter();		
	}
	
	/*
	* manage function
	* Functionality -  manage functionality
	* Created date - 5-Nov-2015
	* Modified date - 
	*/
	
	public function manage() {
        $this->layout = 'common';		
        $this->loadAllModel(array('LoanLog'));
    }

	
}     