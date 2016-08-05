<?php
/*
* Tests Controller class
* Functionality -  Manage the data
* Created date - 8-Jul-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility');

class MailchimpSubscribersController extends AppController {
	
	var $uses = array('Commons', 'User', 'short_applications', 'LoanLog', 'Notification');
	var $components = array('Email','Cookie','Common','Paginator', 'CustomEmail', 'RequestHandler', 'Session');
	var $helpers = array('Common');
	
	public $paginate = array(
						'limit' => 10,
						'order' => array(
							'short_applications.id' => 'DESC'
						)
					);
	function beforeFilter(){
		//$allow = array();
		//parent::beforeFilter();
		//$this->checkUserSession($allow);
	}

	public function test() {
				$this->autoRender = false;
				if( isset( $this->data['MailchimpSubscriber']['emailaddress'] ) && $this->data['MailchimpSubscriber']['emailaddress'] != null ) {
				$email = $this->data['MailchimpSubscriber']['emailaddress'];
				} else {
					$this->set( 'email', '' );
				}
		 
				//if the page is posted
				if( !empty( $this->data )  ) {
					//pr($this->data);die;
					$this->loadModel( 'MailchimpSubscriber' );
					$this->MailchimpSubscriber->set($this->data );
					//check to see if the data validates
					
					if( $this->MailchimpSubscriber->validates() ) {
						//save the data
						if( $this->MailchimpSubscriber->save($this->data) ) {
							
							$this->set('success', true );
							echo 'Yes';
						} else {
							
							//some error occured in the saving of the data
							//do a request to see if the email adres already exists
							$check = $this->MailchimpSubscriber->find( 'all', array( 'conditions' => array( 'emailaddress' => $this->data['MailchimpSubscriber']['emailaddress'])) );
							//if the email address exists in the mailchimp db
							if ( isset($check['email']) ) {
								//flash msg here
								$this->set( 'already_subscribed', true );
							} else {
								//some other error occured at the mailchimp side
								$this->set( 'unknown_error', true );
							}
						}
					}
				}
				
		}
}
?>