<?php
/*
* Managers Controller class
* Functionality -  Manage the manager functionality
* Created date - 8-Jul-2016
* Modified date - 
*/
App::uses('Sanitize', 'Utility');

class ManagersController extends AppController {
	//var $uses = array();
	var $name = 'Managers';
	var $uses = array('User', 'short_applications', 'LoanLog', 'Notification');
	var $components = array('Email','Cookie','Common','Paginator', 'CustomEmail', 'RequestHandler', 'Session');
	var $helpers = array('Common');
	public $paginate = array();
	
	/**
	 * Summary :- beforeFilter
	 * @return	NULL
	 * Description :- beforeFilter
	*/
	function beforeFilter(){
		$allow = array();
		parent::beforeFilter();
		$this->checkUserSession($allow);
	}
    
    	/*
	* loans function :- tombstone
	* Functionality -  tombstone
	* Created date - 27-May-2016
	*/
	
	function tombstone() {
		$this->layout = 'dashboard_common';		
		$this->loadAllModel(array('TrustDeedTombstones','Loan'));
        $joins = array(
					array(
						'table' => 'loans',
						'alias' => 'Loan',
						'conditions' => array(
							'TrustDeedTombstones.loan_id = Loan.id'
						)
					),
					array(
						'table' => 'short_applications',
						'alias' => 'ShortApplication',
						'conditions' => array(
							'ShortApplication.id = Loan.short_app_id'
						)
					)
				);
		$trustDeedTombstones = $this->TrustDeedTombstones->find('all',array('joins'=>$joins,'fields'=>'TrustDeedTombstones.loan_id,Loan.short_app_id, Loan.created, ShortApplication.loan_amount, ShortApplication.applicant_first_name,   ShortApplication.applicant_last_name, ShortApplication.applicant_email_ID, ShortApplication.property_address,ShortApplication.property_state,ShortApplication.property_city'));
		//pr($trustDeedTombstones);
		$this->set('trustDeedTombstones', $trustDeedTombstones);
	}
	
}
?>