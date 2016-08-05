<?php
/*
* Notifications Controller class
* Functionality -  Manage the Notification
* Created date - 8-Jul-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility'); 
class NotificationsController extends AppController {
		
	var $name = 'Notifications';
	public $useTable = 'notifications';
	var $components = array('Email','Cookie','Common','Paginator');
	
	public $paginate = array(
						'limit' => PAGINATION_LIMIT,
						'order' => array(
							'Notifications.id' => 'DESC'
						)
					);
	
	function beforeFilter() {
		$allow = array();
		parent::beforeFilter();
		$this->checkUserSession($allow);
	}
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function index($updateNotificationStatus = null){
		$this->loadModel('Notification');
		$this->Notification->updateAll(array('Notification.status' => '1'),array('Notification.receiver_id' => $this->Session->read('userInfo.id')));	
		$this->layout = 'dashboard_common';
		$loginData = $this->Session->read('userInfo'); //pr($loginData);
		$id = $loginData['id'];
		$criteria = array("Notification.receiver_id = $id");
		$this->paginate['conditions'] = $criteria;
		$this->paginate['order'] = 'id DESC';
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('Notification');
		$this->set('getData',$getData);		
	}
}
?>