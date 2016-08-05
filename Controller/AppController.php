<?php
ob_start();
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
    var $helpers = array('Form','Html');
    var $components =array('Session','RequestHandler','Paginator','Email','Cookie','Common');
    var $loanReasons = array(
                        '1' => 'Purchase Loan - In contract',
                        '2' => 'Purchase Loan - No Contract',
                        '3' => 'Rate & Term Refinance',
                        '4' => 'Cash-out Refinance',
                        '5' => 'Rehab to Sell',
                        '6' => 'Rehab to Rent',
                        '7' => 'Others'
    );
      
    var $propertyTypes = array(
        'sfr'=> 'SFR',
        'Multifamily' => array('2-4 unit multi-family'=>'2-4 Unit Multi-Family',
                               '5+ unit multi-family'=>'5+ Unit Multi-Family'),
        'retail_neighborhood' => 'Retail Neighborhood',
        'retail_single_tenant' => 'Retail Single Tenant',
        'retail_strip_center' => 'Retail Strip Center',
        'Commercial' => array('office' => 'Office',
                        'industrial' => 'Industrial',
                        'retail' => 'Retail',
                        'mixed-use' => 'Mixed Use'
                        )
    );
    
    var $loanTypes = array(
                    "1" => "Short Term Bridge",
                    "2" => "Rehab Loan",
                    "3" => "2nd Position Loan"
    );
    
    var $userTypes = array(
                    "1" => "Borrower",
                    "2" => "Broker or Loan Officer",
                    "3" => "Sales Manager",
                    "4" => "Sales Director",
                    "5" => "Processor",
                    "6" => "Funder",
                    "7" => "Investor",
                    "8" => "Investment Manager",
                    "9" => "Marketing Manager",
                    "11" => "Escrow Officer",
                    "12" => "Accounting Manager"
    );
    
    var $investorTypes = array(
            "1" =>"Trust Deed Investor",
            "2" =>"Equity Investor"        
    );
    
    var $roleTypes = array(
        "2" =>"Broker/Loan Officer",
        "3"=>"Sales Manager",
        "4"=>"Sales Director",
        "5" => "Processor",
        "6" =>"Funder",
        "7" => "Investor",
        "8" => "Investment Manager",
        "9" => "Marketing Manager",
        "12" => "Accounting Manager"
    );
    
    var $loanStatus = array('0'=>'Inactive',
                            '1'=>'Active',
                            '2'=>'Close',
                            '3'=>'Turn Down',
                            '4'=>'Hold',
                            '5'=>'Delete'
    );
    
    var $arrStatus = array('0'=>'Inactive',
                            '1'=>'Active',
                            '2'=>'OnHold',
                            '5'=>'Delete'
    );
    
    var $logIcons = array(
                        'Short App' => '<i class="fa fa-file-text"></i>',
                        'Long App' => '<i class="fa fa-file-text"></i>',
                        'Soft Quote' => '<i class="fa fa-file-reply"></i>',
                        'Processor Check-list Document Requests' =>'<i class="fa fa-download"></i>',
                        'Trust Deed Draft'=>'<i class="fa fa-download"></i>',
                        'Processor Check-List Document Received'=>'<i class="fa fa-upload"></i>',
                        'tack'=>'<i class="fa fa-thumb-tack"></i>',
                        'info'=>'<i class="fa fa-info"></i>',
                        'glass'=>'<i class="fa fa-glass"></i>',
                        'ban'=>'<i class="fa fa-ban"></i>',//denied
                        'thumbs-up'=>'<i class="fa fa-thumbs-up"></i>',
                        'thumbs-down'=>'<i class="fa fa-thumbs-down"></i>'
    );
    
    var $statusClass = array('0'=>'status fa fa-thumbs-down text-error',
                            '1'=>'status fa fa-thumbs-up text-success',
                            '2'=>'status fa fa-thumbs-down text-purple',
                            '3'=>'status fa fa-thumbs-down text-grey',
                            '4'=>'status fa fa-thumbs-down text-black'
    );
    
    var $documentTypes = array("legal" =>"Legal Document");
    
    /**
     * Summary :- beforeRender
     * @return	object		 = NULL
     * Description   :- beforeRender
    */
    
    function beforeRender() {
        if($this->name == 'CakeError') {
            $this->layout = 'error';
        }
    }
    
    /**
     * Summary :- loadAllModel
     * @return	object		Null
     * @params:- $model // array of models
    */
    
    function loadAllModel($model = array()) {
        if(count($model)) {
            foreach($model as $model) {
                $this->loadModel("$model");
            }
        }
    }
    
    /**
     * Summary
     * @return	NULL
     * object NULL
     * Description  beforeFilter
    */
    
    function beforeFilter() {
        $actions = array('admin_login','admin_forgot_password','admin_secure_check','admin_getlogodata','getAdminSetting');
        $this->set('activeController', $this->params['controller']);
        if(!in_array($this->params['action'],$actions) && ($this->params['prefix'] == 'admin')) {   
            $this->checkAdminSession();
            $this->layout = 'admin';
        }
        // create admin setting session
        if($this->Session->check('adminSettings') == false){
            $this->loadModel('AdminSetting');
            $adminSettings = $this->AdminSetting->find('first');
            if(count($adminSettings)){
                $this->Session->write('adminSettings',$adminSettings['AdminSetting']);
            }
        }
        // validate action permision to user
        $this->set('userTypes',$this->userTypes);
    }
    
    /**
     * Description : checkAdminSession
     * @var object :- NONE
    */
    
    function checkAdminSession() {
        if(!$this->Session->check('loggedUserInfo')) {
            $this->redirect('/admin/admins/login');
		}else{
            $loggedUserInfo = $this->Session->read('loggedUserInfo');
            $this->set('loggedUserInfo',$loggedUserInfo);
        }
	}
    
    /**
     * Summary :- checkUserSession
     * @return	NULL
     * Description:- checkUserSession
    */
    
    function checkUserSession($actions = array(), $roleID = null) {
        if($this->Cookie->check('startSession')){
            session_start();
            $this->Cookie->delete('startSession');
        }
        if(!in_array($this->action,$actions)){
            $userArray = $this->Session->read('userInfo');
            if(!empty($userArray)){ 
                $this->__getUserAccess($this->Session->read('userInfo.user_type'), $this->request->params['controller'], $this->request->params['action']);
            }else{
                $this->redirect(array('controller' => 'homes', 'action' => 'login'));
            }
        }
    }
    
    /**
     * Summary :- __getUserTypes
     * @return	NULL
     * Description :- __getUserTypes
    */
    
    public function getUserTypes(){    
		$this->set('userTypes',$this->userTypes);		
	}
    
    /**
     * Summary :- __getLicenceTypes
     * @return	NULL
     * Description :- __getLicenceTypes
    */
    
    public function getLicenceTypes() {    
		$licenceTypes = array("bre" =>"BRE Broker","cfl" =>"CFL");
		$this->set('licenceTypes',$licenceTypes);
	}
    
    /**
     * Summary:- __getReferredBy
     * @return	NULL
     * Description  :- __getReferredBy
    */
    
    public function getReferredBy() {    
		$referredBy = array(
                            "1" =>"Borrower",
                            "2" =>"Broker",
                            "3" =>"Sales Manager",
                            "4" =>"Sales Director",
                            "7" =>"Investor" 
        );
        $this->set('referredBy',$referredBy);		
	}
    
    /**
    * @Date: Jul 1, 2015
    * @Method : generate_password
    * @Purpose: - generate_password
    **/

    function generatePassword($length = 8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars),0,$length);
        return $password;
    }
    
    /*
	* This function is used to send email with template
	* @copyright     smartData Enterprise Inc.
	* @method        sendEmail
	* @param         $to, $subject, $messages, $from, $reply,$path,$file_name
	* @return        void 
	* @since         version 0.0.1
	* @version       0.0.1 
	*/
    
	public function sendEmail($to = null, $subject ='', $messages = null, $from=null, $reply = null,$path=null,$file_name = null) {
		$this->Email->smtpOptions = array(
            'transport' => 'Smtp',
			'host' => 'ssl://smtp.gmail.com',
			'username' => 'osgroup.sdei@gmail.com',
			'password' => 'mohali2378',
			'timeout' => '60',
            'port' => '465'
		);
        //possible values smtp or mail 
		$this->Email->delivery = 'smtp'; 
        $admin_name = Configure::read('ADMIN_NAME');
        if(empty($reply)) {
			$reply = $admin_name.'<'.Configure::read('replytoEmail').'>';
		}
		if(empty($from)) {   
			$from = $admin_name.'<'.Configure::read('fromEmail').'>';
		}
		$this->Email->from = $from;
		$this->Email->replyTo = $reply;
        if($to == 'admin') {
			$this->Email->to = $from;
		} else {
			$this->Email->to = $to;
		}
		if(!empty($path) && !empty($file_name)){
            $this->Email->attachments = array($file_name,$path.$file_name);
        }
        if(empty($subject)) {
            $subject='Admin'; 
        }
        $this->Email->subject = $subject;
        $this->set('content',$messages);
        $this->set('smtp_errors', $this->Email->smtpError);
        $this->Email->sendAs= 'both';
        $this->Email->template='default';
		if($this->Email->send()){
			return true;
		} else {
			return false;
		}
	}
    
    /**
    * Summary:- getPropertyTypes
    * @return	NULL
    * Description  :- getPropertyTypes
    */
    
    public function getPropertyTypes() {
		$this->set('propertyTypes',$this->propertyTypes);		
	}
    
    /**
     * Summary:- getLoanAmounts
     * @return	NULL
     * Description  :- getLoanAmounts
    */
    
    public function getLoanAmounts() {
		$this->set('loanAmounts',$this->loanAmounts);		
	}
    
    /**
     * Summary:- getLoanReasons
     * @return	NULL
     * Description  :- getLoanReasons
    */
    
    public function getLoanReasons(){
		$this->set('loanReasons',$this->loanReasons);		
	}
    
    /**
     * Summary:- getLoanTypes
     * @return	NULL
     * Description  :- getLoanTypes
    */
    
    public function getLoanTypes() {
        $this->set('loanTypes',$this->loanTypes);		
	}
    
    /**
     * Summary:- getApproxLoanValues
     * @return	NULL
     * Description  :- getApproxLoanValues
    */
    
    public function getApproxLoanValues() {
		$this->set('approxLoanValues',$this->approxLoanValues);		
	}
    
    
    /**
     * Summary:- getInvestorType
     * @return	NULL
     * Description  :- getInvestorType
    */
    
    public function getInvestorType() {
		$this->set('investorTypes',$this->investorTypes);		
	}

    /**
     * Summary :- getRoleTypes
     * @return	NULL
     * Description :- getRoleTypes
    */
    
    public function getRoleTypes() {
		$this->set('roleTypes',$this->roleTypes);
	}
    
    public function getLoanStatus() {
        $this->set('loanStatus', $this->loanStatus);
    }
    
    public function getArrStatus() {
        $this->set('arrStatus', $this->arrStatus);
    }
    
    public function getLogIcons() {
        $this->set('logIcons', $this->logIcons);
    }
    
    public function getStatusClass() {
        $this->set('statusClass', $this->statusClass);
    }
    
      /**
    * Summary:-getControllerName
    * @return object
    * Description:- return controller name as per user type
    */
    
    public function getControllerName($user_type = null) {
        
        if($user_type == 1 || $user_type == 2 || $user_type == 3 || $user_type == 4 || $user_type == 5 || $user_type == 6 || $user_type == 7) {
		$controller =  'homes';
        }
        return $controller;
    }
    
    /**
    * Summary:-getPdf
    * Description : Preview or Download Pdf
    * @attr : $filename and $download (true / false) - true for download and false for preview pdf.
    */
    
    public function getPdf($filename = null, $download) {
        $this->viewClass = 'Media';
        $params = array(	
           'id' => $filename,                                               //'test.pdf',
           'name' => 'your_test' ,
           'download' => $download,
           'extension' => 'pdf',
           'path' => WWW_ROOT . 'files/pdf' . DS
        );
        $this->set($params);		
    }
    
    /*
	* getTeam function
	* Functionality -  getTeam
	* Created date - to get teamID for userID notification as read
	*/
	
	function getTeam($userID = null) {
        $this->loadModel('Team');
        $this->loadModel('TeamMember');
        $userDetail  =  $this->User->find('first',array('fields'=>array('User.id','User.user_type'), 'conditions'=>array('User.id' =>$userID )));
		$userType = $userDetail['User']['user_type'];
        $teamDetail = $this->TeamMember->find('first',array('conditions'=>array('TeamMember.team_member_id' =>$userID),'fields'=>'team_id,team_member_id'));            
        if($teamDetail){
            return $teamDetail['TeamMember']['team_id'];
        }else{
            return false;
        }
    }
    
    /**
    * Summary:- getShortAppID
    * @return	$shortAppID
    * Description  :- getShortAppID
    */
    
    public function getShortAppID($loanID = null) {
		$this->loadModel('Loan');
        $shortAppID = '';
        $loanDetail = $this->Loan->findById($loanID);
        if(count($loanDetail)) {
            $shortAppID = $loanDetail['Loan']['short_app_id'];
        }
        return $shortAppID;
	}
    
    /**
    * Summary:- getLoanInfo
    * @return	$shortAppID
    * Description  :- getLoanInfo
    */
    
    public function getLoanInfo($loanID = null) {
		$this->loadModel('Loan');
        $loanDetail = $this->Loan->findById($loanID,array('fields'=>'Loan.loan_number,Loan.short_app_id,Loan.soft_quate_id,Loan.borrower_id,Loan.team_id'));
        if(count($loanDetail)) {
            $shortAppID = $loanDetail['Loan'];
        }
        return $shortAppID;
	}
    
    /**
     * Summary:- getDocumentType
     * @return	
     * Description  :- getDocumentType
    */
    
    public function getDocumentType() {
		$this->set('documentTypes', $this->documentTypes);
	}
    
    /*
	* getUserTeam function
	* Functionality -  getUserTeam
	* Created date - to get teamID for userID notification as read
	*/
	
	function getUserTeam($userID = null) {
        $this->loadModel('TeamMember');
        $this->loadAllModel(array('User','TeamMember','Team'));
        $teamID = '';
        $userDetail = $this->User->find('first',array('fields'=>array('User.id','User.user_type'), 'conditions'=>array('User.id' =>$userID )));
		$userType = $userDetail['User']['user_type'];
        $teamDetail = $this->TeamMember->find('first',array('conditions'=>array('TeamMember.team_member_id' =>$userID ),'fields'=>array('TeamMember.team_id')));
        if(!empty($teamDetail)) {
            $teamID = $teamDetail['TeamMember']['team_id'];
        }
        return $teamID;
    }
    
    /**
    * Summary:- getAllCompany
    * @return	
    * Description  :- getAllCompany
    */
    
    public function getAllCompany(){
        $companies = array('Rockland'=> 'Rockland','RocklandFund' => 'RocklandFund');
		$this->set('companies', $companies);
	}
    
    /*
	* download function
	* Functionality -  Force download document - Put file name with path
	* Created date - 14-Oct-2015
	*/
	
	function downloadDoc($fileName) { 
		$this->response->file($fileName, array('download' => true));
		return $this->response;
	}
    
     /**
     * Summary :- getLoanPhase
     * @return	NULL
     * Description :- getLoanPhase
     */
     
     
    public function getLoanPhases() {
        $this->loadModel('PhaseName');
        $loanPhases = $this->PhaseName->find('list', array('fields' => 'phase_code,phase_name'));
        $this->set('loanPhases', $loanPhases);
    }
     
    public function getLoanLifeCyclePhase() {
        $this->LoadModel('PhaseName');
        $loanPhases = $this->PhaseName->find('list', array('fields' => 'phase_code,phase_name'));
        return $loanPhases;
    }
    
    /**
     * Summary :- getCityName
     * @param :-	$cityID
     * Object :-	$cityID
     * Description :- getCityName
     * @return	$cityName
     * Description :- getCityName
    */
    
    public function getCityName($cityID = null) { 
		$this->loadModel("City");  
        $cityName = '';
        $cityDetail = $this->City->findById($cityID); 
        if(count($cityDetail)){
            $cityName = $cityDetail['City']['city'];
        }
        return $cityName;
	}
	
    /**
     * Summary
     * @param	Object	$stateID
     * @return	description - getStateName
    */
    
    public function getStateName($stateID = null) { 
		$this->loadModel("State");  
        $stateName = '';
        $stateDetail = $this->State->findById($stateID); 
        if(count($stateDetail)){
            $stateName = $stateDetail['State']['name'];
        }
        return $stateName;
	}
    
    /**
     * Summary :- getStateCode
     * @param :-	$stateId
     * Object :-	$stateId
     * Description :- getStateCode
     * @return	$stateCode
     * Description :- getStateCode
    */
    
    public function getStateCode($stateId = null) { 
		$this->loadModel("State");  
        $stateCode = '';
        $stateDetail = $this->State->findById($stateId); 
        if(count($stateDetail)){
            $stateCode = $stateDetail['State']['code'];
        }
        return $stateCode;
	}
    
	/**
	 * Name:- Amit Sharma
     * Summary :- changeStatus
     * @return	object	Null
     * @params:- 
    */
    
    function admin_changeStatus($model = null,$id = null, $status = null){ 
        $this->loadAllModel(array("$model"));
        $this->$model->id = $id;
        $this->$model->saveField('status',$status);
        $this->Session->setFlash('Status updated successfuly','default',array('class'=>'alert alert-success'));
        $this->redirect($this->referer());
    }
    
    /**
	 * Name:- Amit Sharma
     * Summary :- delete
     * @return	object	Null
     * @params:- 
    */
    
    function admin_changeDelete($model = null,$id = null, $status = null){
        $this->loadAllModel(array("$model"));
        $this->$model->delete($id);
        $this->Session->setFlash('Deleted successfuly','default',array('class'=>'alert alert-success'));
        $this->redirect($this->referer());
    }
    
    /**
	 * Name:- Amit Sharma
     * Summary :- changeStatus
     * @return	object	Null
     * @params:- 
    */
    
    function admin_changeOrder($model = null,$id = null, $status = null){ 
        $this->loadAllModel(array("$model"));
        $this->$model->id = $id;
        $this->$model->saveField('order',$status);
        $this->Session->setFlash('Order updated successfuly','default',array('class'=>'alert alert-success'));
        $this->redirect($this->referer());
    }
    
    /**
	 * Name:- Amit Sharma
     * Summary :- changeStatus
     * @return	object	Null
     * @params:- 
    */
    
    function getAdminSetting(){ 
        $this->loadAllModel(array("AdminSetting"));
        return $this->AdminSetting->find('first');
    }
    
    /**
     * Description :- getGrantorRelation
     * @var object :- NONE
     */
    
    function getAccountType(){
        return array('1' => 'Checking','2' => 'Savings','3' => 'Money Market','4' => 'CD','5' => 'Mutual Fund or Stock','6' => 'Gift from');
    }
    
    /**
     * Description :- getGrantorRelation
     * @var object : NONE
     */
    
    function getGrantorRelation(){
        return array('1' => 'Relative','2' => 'Significant other','3' => 'Life friend','4' => 'Other');
    }
    
    /**
     * Description :- getUserListUpdated
     * @var object :- NULL
    */
    
    function getUserListUpdated(){
        $this->autoRender = false;
        $this->loadAllModel(array('Chat','User'));
        $loggedInUser = $this->Session->read('userInfo.id');
        // find user
        $userList = $this->User->find('all',array('conditions'=>array('NOT'=>array('User.user_type' => array('111','1')),'User.id !='=>$loggedInUser,'User.status !=' => '0'),'fields'=>'id,first_name,last_name,email_address,user_type,logged_in'));
        // find last message
        $senderId = $this->Session->read('userInfo.id');
        $chatMessages = $this->Chat->find('list',array('conditions'=>array('OR' => array('sender_id' => $senderId,'receiver_id' => $senderId),'modified_by !=' =>$senderId),'fields'=>'modified_by,modified_by'));
        $message = $userListStr = '';
        foreach($userList as $val){
            $functionCon = "'".$val['User']['first_name']."'". ",". "'".$val['User']['id']."'";
            $Icolor = ($val['User']['logged_in'] == '1') ? 'greenText' : '';
            if(in_array($val['User']['id'],$chatMessages)){
                $chatClass = '';
                $val['User']['message'] = 1;
                $message += 1;
                $chatClass = ($val['User']['message']) ? 'greenText' : '';
                $userListStr .= '<li><a class="'.$chatClass.'" onclick="openChatWindow('.$functionCon.')" href="javascript:void(0);"><i class="fa fa-user" aria-hidden="true"></i><i>'.$val['User']['first_name'].' '.$val['User']['last_name'].'</i> <i class="'.$Icolor.' fa fa-circle" aria-hidden="true"></i></a></li>';
            }else{
                $val['User']['message'] = 0;
                $userListStr .= '<li><a onclick="openChatWindow('.$functionCon.')" href="javascript:void(0);"><i class="fa fa-user" aria-hidden="true"></i><i>'.$val['User']['first_name'].' '.$val['User']['last_name'].'</i> &nbsp;&nbsp;<i class="'.$Icolor.' fa fa-circle" aria-hidden="true"></i></a></li>';
            }
        }
        $data['chat'] = $message;
        $data['UserList'] = $userListStr;
        return json_encode($data);
    }
    
    /**
     * Description :- getUserDetail
     * @var object :- getUserDetail
     */
    
    function getUserDetail($userId = null,$bindModel = null){
        if(empty($bindModel)){
            $this->User->unbindModel(array('hasOne'=>array('UserDetail')));
        }
        return $this->User->findById($userId);
    }
    
    /**
     * Description
     * @var object      
    */
    
    function getUserMessages($receiverId = null){
        $this->autoRender = false;
        $senderId = $this->Session->read('userInfo.id');
        $receiverDetail = $this->getUserDetail($receiverId);
        $returnStr = '';
        if(!empty($senderId) && !empty($receiverId)){
            $this->loadModel('Chat');
            $chatMessages = $this->Chat->find('first',array(
                                                          'conditions'=>array('OR' => array(array('sender_id' => $senderId,'receiver_id' => $receiverId),array('sender_id' => $receiverId,'receiver_id' => $senderId)))
                                                        )
                                            );
            if(count($chatMessages)){
                if($chatMessages['Chat']['modified_by'] != $senderId){
                    $upDateChat = array('id'=>$chatMessages['Chat']['id'],'modified_by'=>'');
                    $this->Chat->save($upDateChat);
                }
                foreach(json_decode($chatMessages['Chat']['message'],true) as $val){
                    if($val['sender_id'] == $senderId){
                        $class = 'right';
                        $name = $this->Session->read('userInfo.first_name');
                    }else{
                        $class = 'left';
                        $name = $receiverDetail['User']['first_name'];
                    }
                    $returnStr .= '<li class="'.$class.'"><i>'.$name.'</i><br />'.$val['message'].'</li>';
                }   
            }else{
                $returnStr = '<li style="text-align: center;">No Message Found</li>';
            }
        }
        return $returnStr;
    }
    
    /**
     * Description
     * @var object
     */
    
    function postUserMessages($receiverId = null, $message = null){
        $this->autoRender = false;
        $this->loadModel('Chat');
        $senderId = $this->Session->read('userInfo.id');
        $receiverDetail = $this->getUserDetail($receiverId);
        $returnStr = '';
        $data = array(
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message
        );
        $chatMessages = $this->Chat->find('first',array('conditions'=>array('OR' => array(array('sender_id' => $senderId,'receiver_id' => $receiverId),array('sender_id' => $receiverId,'receiver_id' => $senderId)))));
        if(count($chatMessages)){
            $chat = json_decode($chatMessages['Chat']['message'],true);
            $chat[] = $data;
            $saveData['id'] = $chatMessages['Chat']['id'];
            $saveData['message'] = json_encode($chat);
            $saveData['modified_by'] = $senderId;
            $this->Chat->save($saveData, array('validate'=>false));
            foreach($chat as $key=>$val){
                if($val['sender_id'] == $senderId){
                    $class = 'right';
                    $name = $this->Session->read('userInfo.first_name');
                }else{
                    $class = 'left';
                    $name = $receiverDetail['User']['first_name'];
                }
                $returnStr .= '<li class="'.$class.'"><i>'.$name.'</i><br />'.$val['message'].'</li>';
            }   
        }else{
            $data = array();
            $data[] = array(
                    'sender_id' => $senderId,
                    'receiver_id' => $receiverId,
                    'message' => $message
                );
            $saveData['message'] = json_encode($data);
            $saveData['sender_id'] = $senderId;
            $saveData['receiver_id'] = $receiverId;
            $saveData['modified_by'] = $senderId;
            $this->Chat->save($saveData, array('validate'=>false));
            $data = json_decode($saveData['message'], true);
            foreach($data as $key=>$val){
                if($val['sender_id'] == $senderId){
                    $class = 'right';
                    $name = $this->Session->read('userInfo.first_name');
                }else{
                    $class = 'left';
                    $name = $receiverDetail['User']['first_name'];
                }
                $returnStr .= '<li class="'.$class.'"><i>'.$name.'</i><br />'.$val['message'].'</li>';
            } 
        }
        return $returnStr;
    }
    
    /**
     * Description calculateCommissionForLoan
     * @var object  :- loanId
    */
    
    function calculateCommissionForLoan($loanId = null) {
        $this->autoRender = false;
        $loanId = base64_decode($loanId);
        $this->loadAllModel(array('Loan','User','LoanUser','UserPayment','LoanPhase'));
        if(!empty($loanId)){
            $loanDetail = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$loanId),'fields'=>'ShortApplication.loan_amount,ShortApplication.id'));
            if(!empty($loanDetail)){
                $loanAmount =  $loanDetail['ShortApplication']['loan_amount'];
                $loanUser = $this->LoanUser->find('all',array('conditions'=>array('loan_id'=>$loanId)));
                if(!empty($loanUser)){
                    $data['user_id'] = '1';
                    $data['loan_id'] = $loanId;
                    $data['loan_amount'] = $loanAmount;
                    $data['commission_percentage'] = $this->Session->read('adminSettings.rockland_commission');
                    $data['commission'] = ($this->Session->read('adminSettings.rockland_commission') * $loanAmount) / 100;
                    $this->UserPayment->save($data);
                    foreach($loanUser as $key=>$val){
                        $newloanAmount = $loanAmount;
                        if(in_array($val['LoanUser']['user_type'],array('5','6'))){
                            $newloanAmount = $data['commission'];
                        }
                        $this->__calculateLoanForAllTeam($val['LoanUser']['user_id'],$val['LoanUser']['user_type'],$newloanAmount,$loanId);
                    }
                }
                $loanStatus = $this->LoanPhase->find('first',array('conditions'=>array('LoanPhase.loan_id'=>$loanId, 'LoanPhase.loan_phase' => 'J')));
                if(empty($loanStatus)) {
                    $loanPhaseData['LoanPhase']['loan_phase'] = 'J';
                    $loanPhaseData['LoanPhase']['loan_id'] = $loanId;
                    $loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;;
                    $this->LoanPhase->save($loanPhaseData);
                }
            }
        }
        return true;
    }
    
    function __calculateLoanForAllTeam($loanOfficeId = null, $userType = null,$loanAmount = null, $loanId = null){
         $this->User->bindModel(array(
            'hasOne' => array(
                'Commission' => array(
                    'className'  => 'Commission',
                    'foreignKey' => false
                ),
            ),
        ));
        $loanOfficerDetail = $this->User->findById($loanOfficeId,array('fields'=>'UserDetail.referred_by_user_id,Commission.commission'));
        $userTypes = array('2','3','4','7','8');
        $data['user_id'] = $loanOfficeId;
        $data['rockland_commission_percentage'] = '';
        $data['loan_id'] = $loanId;
        $data['loan_amount'] = $loanAmount;
        if(in_array($userType,$userTypes)){
            if(empty($loanOfficerDetail['UserDetail']['referred_by_user_id'])){
                $data['commission_percentage'] = $loanOfficerDetail['Commission']['commission'];
                $data['commission'] = ($loanOfficerDetail['Commission']['commission'] * $loanAmount) / 100;
            }else{
                $this->__calculateLoanForAllTeam($loanOfficerDetail['UserDetail']['referred_by_user_id'],($userType+1),$loanAmount,$loanId);
            }
        }else if($userType == '5'){
            // processor
            $data['loan_amount'] = ($loanAmount/$this->Session->read('adminSettings.rockland_commission')) * 100;
            $data['rockland_commission_percentage'] = $this->Session->read('adminSettings.rockland_commission');
            $data['commission_percentage'] = $this->Session->read('adminSettings.processor_fee');
            $data['commission'] = ($this->Session->read('adminSettings.processor_fee') * $loanAmount) / 100;
        }else if($userType == '6'){
            // funder
            $data['rockland_commission_percentage'] = $this->Session->read('adminSettings.rockland_commission');
            $data['loan_amount'] = ($loanAmount/$this->Session->read('adminSettings.rockland_commission')) * 100;
            $data['commission_percentage'] = $this->Session->read('adminSettings.funder_fee');
            $data['commission'] = ($this->Session->read('adminSettings.funder_fee') * $loanAmount) / 100;
        }
        $this->UserPayment->create();
        $this->UserPayment->save($data);
    }
    
    /**
     * Description :- getUserAccess
     * @var object :- userType
    */
    
    function __getUserAccess($userType = null,$controllerName = null,$actionName = null){
        require_once(WWW_ROOT.'userAccessFile/userAccessFile.php');
        $notAllowAction = false;
        if(isset($this->notCheckAccessArray[$controllerName])){
            if(!in_array($actionName,$this->notCheckAccessArray[$controllerName])){
                if(!empty($this->userAccessArray[$userType][$controllerName])){
                    if(!in_array($actionName,$this->userAccessArray[$userType][$controllerName])){
                        $notAllowAction = true;
                    }
                }else{
                    $notAllowAction = true;
                }      
            }
        }else if(isset($this->userAccessArray[$userType][$controllerName])){
            if(!in_array($actionName,$this->userAccessArray[$userType][$controllerName])){
                $notAllowAction = true;
            }
        }else{
            $notAllowAction = true;
        }
        if($notAllowAction){
            $this->Session->setFlash('You are not authorize to view this page','default',array('class'=>'alert alert-danger'));
            if($userType == '1'){
                $this->redirect(array('controller'=>'borrowers','action'=>'dashboard'));
            }else{
                $this->redirect(array('controller'=>'homes','action'=>'dashboard'));
            }
        }
    }
}