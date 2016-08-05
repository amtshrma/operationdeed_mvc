<?php
/*
* Escrows Controller class
* Functionality -  Manage Ecsrow
* Created date - 18-Dec-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility');
//App::import('Controller','Commons');

class EscrowsController extends AppController {
		
    var $uses = array('User');
    var $name = 'Escrows';
    var $components = array('Email','Cookie','Common','Paginator','Hybridauth');

    function beforeFilter() {
        $allow = array('index','register','thankyou_message');
		parent::beforeFilter();
        $this->checkUserSession($allow);
    }    
	/*
	* register function
	* Functionality -  register functionality
	* Created date - 19-Jun-2015
	* Modified date - 
	*/
    function register($shortAppID = null) {  
        $this->layout = 'short_app';
        $this->getUserTypes();
        $this->getLicenceTypes();
        $this->getReferredBy();
        $roleTypes = $this->userTypes;
        $this->loadAllModel(array('State','User','UserDetail','UserLog','EmailTemplate','ShortApplication','Notification','LoanLog'));
        if(isset($this->request->data) && !empty($this->request->data)){ 
            $this->User->set($this->request->data['User']);
            $userValidate = $this->User->validates();
            if($userValidate) { 
                $password = $this->request->data['User']['password'];
                $this->request->data['User']['userPassword'] = base64_encode($password);
                $this->request->data['User']['password'] = md5($password);
                $this->User->save($this->request->data['User'], array('validate'=>false));
                $userID = $this->User->id;
                $this->request->data['UserDetail']['user_id'] = $userID;
               // $this->request->data['UserDetail']['birthdate'] = $this->request->data['UserDetail']['date_of_birth'];
				$this->UserDetail->save($this->request->data['UserDetail'], array('validate'=>false));
                //welcome email notification
                $hashCode =  md5(uniqid(rand(), true));
                $this->User->saveField('random_key',$hashCode, false);
                $site_URL = Configure::read('BASE_URL');
                $active =  '<a href = "' .$site_URL. '/users/secure_check/'.$hashCode.'">Click to activate your account </a>'; 
                $logo = '<img src="'.$site_URL.'/img/logo.png" style="height:100px; width:157px;padding-bottom: 12px;float:left;" />';
                $template = $this->EmailTemplate->getEmailTemplate('user_registration');
                $to = $this->request->data['User']['email_address'];
                $emailData = $template['EmailTemplate']['template'];
                $userType = 'Escrow';
                $emailData = str_replace('{FirstName}',ucfirst($this->request->data['User']['first_name']),$emailData);
                $emailData = str_replace('{Email}',$this->request->data['User']['email_address'],$emailData);
                $emailData = str_replace('{Password}',$password, $emailData);
                $emailData = str_replace('{UserType}',$userType, $emailData);
                $emailData = str_replace('{Link}',$active, $emailData);
                $emailData = str_replace('{Logo}',$logo, $emailData);
                $subject = ucfirst(str_replace('_', ' ', $template['EmailTemplate']['name']));
                $send_mail = $this->sendEmail($to,$subject, $emailData);
                //User Logs
                $name = $this->request->data['User']['first_name'] .' '. $this->request->data['User']['last_name'];
                $logData['UserLog']['user_id'] = $userID;
                $logData['UserLog']['action'] = 'Registration';
                $logData['UserLog']['description'] = $name . ' registered in Operation trust deed';
                $this->UserLog->save($logData);
                $this->Session->setFlash('You have been registered successfully.','default',array('class'=>'alert alert-success'));
                $this->redirect(array('controller'=>'escrows','action' => 'thankyou_message'));
                
            } else {
                $userError = $this->User->validationErrors;
                $userDetailError = $this->UserDetail->validationErrors;
                $this->set('errors',array_merge($userError,$userDetailError));
            }   
        } 
        $states = $this->State->find('list',array('conditions'=>array('status'=>'1'),'fields'=>array('id','name'),'order'=>'name ASC'));
        $this->set('states',$states);
    }

    function thankyou_message() { 
        $this->layout = 'short_app';
    }
	
    public function index() {
        $this->getRoleTypes();
        $remember_me = '';
        $this->layout = 'login';
        $this->loadAllModel(array('User'));
        if(isset($this->request->data) && (!empty($this->request->data))){
            $this->User->set($this->request->data);
            $email = $this->request->data['User']['email_address'];
            $userType = $this->request->data['User']['user_type'];
            $user_password  = md5($this->request->data['User']['password']);
 
            $userInfo = $this->User->find('first',array('fields'=>array('id','first_name','last_name','email_address','password','user_type'),'conditions'=>array("User.email_address" => $email,"User.user_type" => $userType,"User.password" => $user_password,"User.status !="=>0,"User.is_deleted"=>0)));
    
            if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $user_password)) { 
                $this->Session->write('userInfo', $userInfo['User']);
                if(!empty($this->request->data['User']['remember_me'])) {
                    $email = $this->Cookie->read('userEmail');
                    $password = base64_decode($this->Cookie->read('userPass'));						
                    if(!empty($email) && !empty($password)) {
                        $this->Cookie->delete('userEmail');
                        $this->Cookie->delete('userPass');     
                    } 						
                    $cookie_email = $this->request->data['User']['email'];			
                    $this->Cookie->write('userEmail', $cookie_email, false, '+2 weeks');						
                    $cookie_pass = $this->request->data['User']['password'];
                    $this->Cookie->write('userPass', base64_encode($cookie_pass), false, '+2 weeks'); 
                }else {
                    $email = $this->Cookie->read('userEmail');
                    $password = base64_decode($this->Cookie->read('processorPass'));
                    if(!empty($email) && !empty($password)) {
                        $this->Cookie->delete('userEmail');
                        $this->Cookie->delete('userPass');     
                    }
                }
                $controller = $this->getControllerName($userType);
                
                $this->Session->write('userInfo.controller', $controller);
                //pr($this->Session->read('userInfo')); die();
                //$this->redirect(array("controller"=>$controller,"action" => "dashboard"));
                $this->redirect(array("controller"=>'escrows',"action" => "dashboard"));  
            } else {
                $this->Session->setFlash("Email or Password is incorrect",'default',array('class'=>'flashError'));
            }
        }elseif($this->Session->check('userInfo')){
            $controller = $this->Session->read('userInfo.controller');
            $this->redirect(array("controller"=>$controller,"action" => "dashboard"));
            
        }else {
            $email = $this->Cookie->read('userEmail');
            $password = base64_decode($this->Cookie->read('userPass'));				
            if(!empty($email) && !empty($password)) {
                $remember_me  = true;
                $this->request->data['User']['email_address']  = $email;
                $this->request->data['User']['password']  = $password;					
            }				
        }
        $this->set('remember_me',$remember_me);
    }
    public function logout() {
        $this->Session->delete('userInfo');
        $this->Hybridauth->logout();
        $this->Session->delete('userInfo');
        $this->redirect(array("controller"=>"escrows","action" => "index"));
    }
    
    /**
     * Summary :- dashboard
     * @return	NULL
     * Description :- dashboard
     */
    
	public function dashboard() {
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('LoanProcessDetail','State'));
	    $this->getLoanTypes();
		$this->getLoanReasons();
		$this->getLoanAmounts();
		$this->getApproxLoanValues();
		$this->getPropertyTypes();
		$userArray = $this->Session->read('userInfo');
		$email = $userArray['email_address'];
		$escrowLoans = $this->LoanProcessDetail->find('all', array('conditions'=>array('LoanProcessDetail.escrow_email_address'=>$email)));
        $states = $this->State->find('list',array('fields'=>array('id','name'),'order'=>'name ASC'));
        $this->set('escrowLoans',$escrowLoans);
        $this->set('states',$states);
    }
	
	/**
     * Summary :- loan_document
     * @return	NULL
     * Description :- instructions and get all loan documents signed, initialed, and hand written where needed.... then scan in all documents and upload them back into the system.
     */
    
	public function loan_document($loan_ID = null) {
		$this->layout = 'dashboard_common';
		if(isset($this->request->data) && (!empty($this->request->data))){ 
			$returnStatus = $this->upload_document($this->request->data);
			if($returnStatus){
				$this->redirect(array("controller"=>"escrows","action" => "dashboard"));
			}
		}
		$this->set('loanID',$loan_ID);
        
    }
	
	/**
     * Summary :- final document
     * @return	NULL
     * Description :- upload final closing statement.
     */
    
	public function final_document($loan_ID = null) {
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('EscrowDocApproval','LoanHoldRequest','Notification','LoanUser'));
		if(isset($this->request->data) && (!empty($this->request->data))){ 
			$returnStatus = $this->upload_document($this->request->data);
			if($returnStatus){
				$this->redirect(array("controller"=>"escrows","action" => "dashboard"));
			}
		}
		$this->set('loanID',$loan_ID);
	}
	/**
     * Summary :- upload_document
     * @return	NULL
     * Description :- upload document(loan and final).
     */
    
	public function upload_document($data = array()) {
		$newLoans = $this->getLoanLifeCyclePhase();
		
		$this->loadAllModel(array('EscrowDocument','LoanLog','LoanPhase','LoanUser','Notification'));
        $userData  = $this->Session->read('userInfo');
		$logDescription = '';
		$this->request->data = $data;
		if(isset($this->request->data) && (!empty($this->request->data))){
			$loanID = base64_decode(base64_decode($this->request->data['EscowDocument']['loanID']));
			$loanNumber = $this->Common->getLoanNumber($loanID);
			$status = $this->request->data['EscowDocument']['status'];
			$shortAppId = $this->getShortAppID($loanID);
			$escrowFiles = false;
			foreach($this->request->data['upload'] as $key => $document) { 
				$newname = '';
				if(isset($document['name']) && $document['name'] != '') {
					$flag = false;
					$str = explode('/',$document['type']);
					if($document['error'] != 0) {
						$this->Session->setFlash('You can only upload png,jpeg,gif and jpg files!!', 'error');
						$flag = false;
					} else if($document['size'] > 2000000) {
						$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
						$flag = false;
					} else {
						$escrowFiles = true;
						$upload_dir = ESCROW_DOCUMENT_PATH;
						$filename = explode(".",$document['name']);
							
						$newname = date("Y_m_d_H_i_s").$key.".".$document['name'];
						
						move_uploaded_file($document['tmp_name'], $upload_dir."/".$newname);
						$this->request->data['EscrowDocument']['loan_id'] = $loanID;
						$this->request->data['EscrowDocument']['escrow_officer_id'] = $userData['id'];
						$this->request->data['EscrowDocument']['document'] = $newname;
						$this->request->data['EscrowDocument']['status'] = $status;
						$this->EscrowDocument->create();
						$this->EscrowDocument->save($this->request->data['EscrowDocument']);
						$logDescription .= '<a href="/app/webroot/escrow_document/'.$newname.'"target="_blank">'.$document['name'].'</a>';
						$logDescription .= "<br/>";
					}
				}
			}
			if($escrowFiles){
				if($status == 1) {
					$action = $loanNumber . ' - ' .$newLoans['20B'];
					$loanCyclephase = '20B';
					$loanStatus = $this->LoanPhase->find('first',array('conditions'=>array('LoanPhase.loan_id'=>$loanID, 'LoanPhase.loan_phase' => 'I')));
					if(empty($loanStatus)) {
						$loanPhaseData['LoanPhase']['loan_phase'] = 'I';
						$loanPhaseData['LoanPhase']['loan_id'] = $loanID;
						$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;
						$this->LoanPhase->save($loanPhaseData);
					}
					$toDoLink = $newLoans['20B'] .  ' Click to <a href="'.BASE_URL.'loans/view_loan_document/'.base64_encode($loanID).'"> review and approve</a>';
					$this->saveEscrowTeamApproval($newLoans['20B'], $loanID);
	
				}else {
					$action = $newLoans['20'];
					$loanCyclephase = 20;
					//save Todo funder - funder review loan document
					$funderDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanID,'user_type' => 6),'fields' =>array('LoanUser.user_id')));
					//save funder Todo
					if(!empty($funderDetail)) {
						$toDo = $action . ' Click to <a href="'.BASE_URL.'loans/escrow_document/'.base64_encode($loanID).'">review</a>  and approve loan document.';
						$notificationData['Notification']['receiver_id'] = $funderDetail['LoanUser']['user_id'];
						$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
						$notificationData['Notification']['action'] = $toDo;
						$notificationData['Notification']['action_id'] = $loanID;
						$notificationData['Notification']['type'] = 2;
						$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
						//pr($notificationData);
						$this->Notification->create();
						$this->Notification->save($notificationData);
					}
					
				}
				//Loan Log
				$this->request->data['LoanLog']=array(
					'user_id' => $userData['id'],
				   'short_application_ID' => $shortAppId,
				   'action' => $action,
				   'description'=> $logDescription,
				   'created' => CURRENT_DATE_TIME_DB
				); 
				$this->LoanLog->create();
				$this->LoanLog->save($this->request->data);
				//escrow upload loan document
			
				$this->Loan->id = $loanID;
				$this->Loan->saveField('loan_life_cycle_phase', $loanCyclephase);
				//Notification Data
				$this->Common->saveNotifications($action, $userData['id'], $loanID);
				//Investor Notification
				$investorNotification = $action . 'Kindly fund the loan, all the process has been completed';
				$this->Common->sendInvestorNotification($investorNotification, $userData['id'], $loanID);
				$this->Session->setFlash('Document Uploaded Sucessfully.', 'default', array('class'=>'alert alert-success'));
				return true;
			}else{
				$this->Session->setFlash('Select Document to Upload', 'default', array('class'=>'alert alert-danger'));
				return false;
			}
		}
		
    }
	/**
     * Summary :- upload_document
     * @return	NULL
     * Description :- upload document(loan and final).
     */

	public function saveEscrowTeamApproval($msg = null, $loanID = null) {
		// save Escrow Approval
		$loanInfo = $this->getLoanInfo($loanID);
		// save investor approval and notification
		$loanUsers = $this->LoanUser->find('all', array('conditions'=>array('LoanUser.loan_id' => $loanID),'fields' =>array('LoanUser.user_id')));
			foreach($loanUsers as $key => $user) {
				$approvalData['EscrowDocApproval']['loan_id'] = $loanID;
				$approvalData['EscrowDocApproval']['receiver_id'] = $user['LoanUser']['user_id'];
				$approvalData['EscrowDocApproval']['sender_id'] = $this->Session->read('userInfo.id');
				$approvalData['EscrowDocApproval']['created'] = CURRENT_DATE_TIME_DB;
				$this->EscrowDocApproval->create();
				$this->EscrowDocApproval->save($approvalData);
				$approvalID = $this->EscrowDocApproval->id;
				$notificationData['Notification']['receiver_id'] = $user['LoanUser']['user_id'];
				$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
				$notificationData['Notification']['action'] = $msg .  ' Click to <a href="'.BASE_URL.'loans/view_loan_document/'.base64_encode($loanID).'/'.base64_encode($approvalID).'"> review and approve</a>';
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				
				$this->Notification->create();
				$this->Notification->save($notificationData);
			} 
		return true;
	}
}
?>