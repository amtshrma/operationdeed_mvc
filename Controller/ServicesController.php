<?php
App::uses('Sanitize','Utility');
App::uses('AppController', 'Controller');
App::import('Controller','Commons');

/**
 * Services Controller
 *
 * @property AuthComponent 
 * @property SessionComponent 
 */

class ServicesController extends AppController {
    
/**
 * add user method
 *
 * @return void
 */

    public $googleApiKey = 'AIzaSyDWSrIo1p8iz28yN2_aHao0SSi9JWDEfYE';
	var $components = array();

	public function beforeFilter() {
		$this->layout = '';
		$this->autoRender = false;
		parent::beforeFilter();
	}
	
	/**
	* @Date: June 15, 2016
	* @Method : validateShortApp
	* Created By: Amit Sharma
	* @Purpose: validateShortApp
	**/
	
	public function postShortAppData(){
		$return = array();
		if($this->request->data){
			$this->loadAllModel(array('LoanLog','City','ShortApplication'));
			$reqFieldsArray = array('applicant_first_name','applicant_last_name','applicant_email_ID','company_select','applicant_phone','property_address','property_state','property_type','property_zipcode','loan_type','loan_reason','loan_amount','loan_to_value','company_select','applicant_company_name','loan_to_value');
			foreach($reqFieldsArray as $key=>$val){
				if(empty($this->request->data[$val])){
					$this->request->data[$val] = '';
				}
			}
			$this->ShortApplication->set($this->request->data);
			if($this->ShortApplication->validates()){
				$cityDetail = $this->City->find('first',array('conditions' => array('city' => $this->request->data['property_city'],'state_id'=>$this->request->data['property_state'])));
				if(count($cityDetail)){
					$this->request->data['property_city'] = $cityDetail['City']['id'];
					$this->request->data['loan_value'] = $this->request->data['loan_amount'] - (($this->request->data['loan_to_value'] * $this->request->data['loan_amount']) / 100);
					if($this->ShortApplication->save($this->request->data,array('validate' => false))){
						$shortAppID = $this->ShortApplication->id;
						$logData['LoanLog']['short_application_ID'] = $shortAppID;
						$logData['LoanLog']['action'] = 'Applied';
						$logData['LoanLog']['description'] = 'Short App is applied';
						$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
						$this->LoanLog->save($logData);
						$this->request->data['id'] = $shortAppID;
						$this->shortAppNotification($this->request->data);
						$this->Common->getDetailFromTitle365($shortAppID);
						$return = array(
							'statusCode' => 200,
							'result' => 'Short application posted successfully'
						);	
					}else{
						$return = array(
							'statusCode' => 201,
							'error' => 'Some technical error occured, try again'
						);
					}
				}else{
					$return = array(
						'statusCode' => 201,
						'error' => 'City Not Found'
					);
				}
			}else{
				$return = array(
					'statusCode' => 201,
					'error' => $this->ShortApplication->validationErrors
				);
			}
		}
		return json_encode($return);
	}
	
	/**
	* @Date: June 15, 2016
	* @Method : shortAppNotification
	* Created By: Amit Sharma
	* @Purpose: shortAppNotification
	**/
	
	function shortAppNotification($data = array()) { 
		$this->loadAllModel(array('EmailTemplate','State','User','Notification'));
		$this->layout = '';
		$this->autoRender = false;
		$userTypeID = array(2,3,4,5);
		$states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
		$notifiyUserEmail = $this->User->find('all',array('conditions'=>array('User.user_type'=>$userTypeID,'User.status'=>1,'User.is_deleted' =>0),'fields' => array('id','email_address','name'),'order'=>'name ASC'));
		$link =  '<a href = "' .BASE_URL. 'homes/login/">Click to see application details </a>';
		foreach($notifiyUserEmail as $user) { 
			//save Notification
			$notificationData['Notification']['receiver_id'] = $user['User']['id'];
			$notificationData['Notification']['action'] = 'Short App';
			$notificationData['Notification']['action_id'] = $data['id'];
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			$template = $this->EmailTemplate->getEmailTemplate('short_app_notification');
			$to = $user['User']['email_address'];
			$emailData = $template['EmailTemplate']['template'];					
			$logo = '<img src="'.BASE_URL.'img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
			$name = $data['applicant_first_name'] . ' '. $data['applicant_last_name'];
			$emailData = str_replace('{FirstName}',$user['User']['name'],$emailData);
			//$emailData = str_replace('{Broker Email}',$data['email_address'],$emailData);
			$emailData = str_replace('{Name}',$name,$emailData);
			$emailData = str_replace('{Borrower Email Address}',$data['applicant_email_ID'],$emailData);
			$emailData = str_replace('{Borrower Phone}',$data['applicant_phone'],$emailData);
			$emailData = str_replace('{Property Name}',$data['property_address'],$emailData);
			$emailData = str_replace('{Property Type}',$data['property_type'],$emailData);
			$emailData = str_replace('{Property State}',$states[$data['property_state']],$emailData);
			$emailData = str_replace('{Property City}',$this->getCityName($data['property_city']),$emailData);
			$emailData = str_replace('{Loan Type}',$this->loanTypes[$data['loan_type']],$emailData);
			$emailData = str_replace('{Loan Reason}',$this->loanReasons[$data['loan_reason']],$emailData);
			$emailData = str_replace('{Loan Amount}','$ '.$data['loan_amount'],$emailData);
			$emailData = str_replace('{Loan To Value}','$ '.$data['loan_value'],$emailData);
			$emailData = str_replace('{Loan Objective}',$data['loan_objective'],$emailData);
			$emailData = str_replace('{Logo}',$logo,$emailData);
			$subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
			$this->sendEmail($to,$subject,$emailData);			
		}
	}
}