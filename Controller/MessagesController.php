<?php
/*
* Messages Controller class
* Functionality -  Manage the Messages
* Created date - 8-Jul-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility'); 
class MessagesController extends AppController {
		
	var $name = 'Messages';
    public $useTable = 'messages';
	var $components = array('Email','Cookie','Common','Paginator');
	
	public $paginate = array(
						'limit' => 10,
						'order' => array(
							'Messages.id' => 'DESC'
						)
					);
	
	function beforeFilter(){
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
	
	public function index($updateMessageStatus = null) {
		$this->loadAllModel(array('Message'));
		if(base64_decode($updateMessageStatus) == '1'){
			$this->Message->updateAll(array('Message.status' => '1'),array('Message.receiver_id' => $this->Session->read('userInfo.id')));	
		}
		$this->layout = 'dashboard_common';
		$loginData = $this->Session->read('userInfo');
		$id = $loginData['id'];
		$criteria = "Message.receiver_id = $id";
		$this->paginate['conditions'] = array($criteria);
		$this->paginate['order'] = 'id DESC';
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('Message');
		$this->set('getData',$getData);			
	}

	/*
	* compose function
	* Functionality -  compose functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function compose() {
		$this->loadAllModel(array('User','Message','EmailTemplate'));
		$this->layout = 'dashboard_common';
		$this->getUserTypes();
		if(isset($this->request->data) && (!empty($this->request->data))){
			$this->Message->set($this->request->data);
			if($this->Message->validates()){
				$this->request->data['Message']['sender_id'] = $this->Session->read('userInfo.id');
				$this->Message->save($this->request->data,array('validate'=>false));
				if($this->request->data['Message']['email_type'] == '2'){
					$template = $this->EmailTemplate->getEmailTemplate('common_template');
					$receiverDetail = $this->getUserDetail($this->request->data['Message']['receiver_id']);
					$to = $receiverDetail['User']['email_address'];
					$emailData = $template['EmailTemplate']['template'];
					$logo = '<img src="'.BASE_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
					$emailData = str_replace('{Name}',$receiverDetail['User']['name'],$emailData);
					$emailData = str_replace('{Message}',$this->request->data['Message']['message'],$emailData);
					$subject = ucfirst($this->request->data['Message']['subject']);
					$this->sendEmail($to,$subject,$emailData,$this->Session->read('userInfo.email_address'));	
				}
				$this->Session->setFlash('Message sent successfully','default',array('class'=>'alert alert-success'));	
				$this->redirect(array('controller'=>'messages','action' => 'index'));
			}
		}
		$allUsers = $this->User->find('all',array('fields'=>array('id','name','user_type'),'conditions'=>array("User.status"=>1,"User.is_deleted"=>0)));
		$this->set('allUsers',$allUsers);
	}
	
	/*
	* sent function
	* Functionality -  sent functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function sent() {
			
		$this->loadAllModel(array('Message'));
		$this->layout = 'dashboard_common';
		$loginData = $this->Session->read('userInfo');
		$id = $loginData['id'];
		$criteria = "Message.sender_id = $id";
		$this->paginate['conditions'] = array($criteria);
		$this->Paginator->settings	= $this->paginate;
		
		$getData =  $this->Paginator->paginate('Message');
		$this->set('getData',$getData);
		
	}
}
?>