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
    
    /*var $loanReasons =  array(
        "1" => "Acquisition Loan - Under Contract",
        "2" => "Acquisition Loan - No Contract",
        "3" => "Refinance Loan",
        "4" => "Construction Loan",
        "5" => "Other"
    );*/
    var $loanReasons = array(
                        '1' => 'Purchase Loan - In contract',
                        '2' => 'Purchase Loan - No Contract',
                        '3' => 'Rate & Term Refinance',
                        '4' => 'Cash-out Refinance',
                        '5' => 'Rehab to Sell',
                        '6' => 'Rehab to Rent',
                        '7' => 'Others'
                    );
    
   /*var $propertyTypes =  array(
        "1" => "Multi-Family",
        "2" => "Retail Strip Center",
        "3" => "NNN",
        "4" => "Owner Occupied",
        "5" => "Industrial",
        "6" => "Office",
        "7" => "Self-Storage",
        "8" => "Hotel/Motel",
        "9" => "Assisted Living",
        "10" => "Manufactured Housing",
        "11" => "Restaurant",
        "12" => "Church",
        "13" => "Gas Station",
        "11" => "Restaurant",
        "12" => "Church",
        "13" => "Gas Station",
        "14" => "Raw Land",
        "15" => "SFR Rental",
        "16" => "Other"
        );*/
  
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
    
    var $loanAmounts =  array(
        "1-500000" => "Less than $500,000",
        "500000 - 1000000" => "$500,000 to $1 million",
        "1000000 - 2000000" => "$1 milliion to $2 million",
        "2000000 - 3000000" => "$2 million to $3 million",
        "3000000 - 8000000" => "$3 million to $8 million",
        "8000000 - 20000000" => "$8 million to $20 million",
        "20000000 - 100000000" => "$20 million to $100 million",
        "100000000 - above" => "$100 million +"
        );
    
    /*var $loanTypes =  array(
        "1" => "Permanent",
        "2" => "Short Term or Interim",
        "3" => "Construction",
        "4" => "Rehab",
        "5" => "Mezzanine",
        "6" => "Other"
    );*/
    var $loanTypes = array(
                    "1" => "Short Term Bridge",
                    "2" => "Rehab Loan",
                    "3" => "2nd Position Loan"
    );
    
    var $approxLoanValues =  array(
            "1" => "Less than 50%",
            "2" => "50% to 60%",
            "3" => "60% to 70%",
            "4" => "70% to 80%",
            "5" => "80% or more"
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
        "8" => "Investment Manager",
        "9" => "Marketing Manager",
        "12" => "Accounting Manager"
        );
    
    var $loanStatus = array('0'=>'Inactive',
                            '1'=>'Active',
                            '2'=>'Close',
                            '3'=>'Turn Down',
                            '4'=>'Hold',
                            '5'=>'Delete');
    
    var $arrStatus = array('0'=>'Inactive',
                            '1'=>'Active',
                            '2'=>'OnHold',
                            '5'=>'Delete');
    
    var $logIcons = array('Applied' => '<i class="fa fa-file-text"></i>',
                          'Loan Application' => '<i class="fa fa-file-text"></i>',
                          'Processor Check-list Document Requests' =>'<i class="fa fa-download"></i>',
                          'Trust Deed Draft'=>'<i class="fa fa-download"></i>',
                        'Processor Check-List Document Received'=>'<i class="fa fa-upload"></i>',
                        'tack'=>'<i class="fa fa-thumb-tack"></i>',
                        'info'=>'<i class="fa fa-info"></i>',
                        'glass'=>'<i class="fa fa-glass"></i>',
                        'ban'=>'<i class="fa fa-ban"></i>',//denied
                        'thumbs-up'=>'<i class="fa fa-thumbs-up"></i>',
                        'thumbs-down'=>'<i class="fa fa-thumbs-down"></i>');
    
    var $statusClass = array('0'=>'status fa fa-thumbs-down text-error',
                            '1'=>'status fa fa-thumbs-up text-success',
                            '2'=>'status fa fa-thumbs-down text-purple',
                            '3'=>'status fa fa-thumbs-down text-grey',
                            '4'=>'status fa fa-thumbs-down text-black');
    
    var $documentTypes = array("legal" =>"Legal Document");
    
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
                $userDetail = $this->Session->read('userInfo');
                $this->set('userDetail',$userDetail);
                if(isset($roleID) && $userArray['user_type'] != $roleID){
                    $this->redirect(array('controller' => 'homes', 'action' => 'logout'));
                }
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
		$referredBy = array("1" =>"Borrower",
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
			'host' => Configure::read('host'),
			'username' =>Configure::read('username'),
			'password' => Configure::read('password'),
			'timeout' => Configure::read('timeout')
		);                
        
		$this->Email->delivery = 'mail';//possible values smtp or mail 
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
		
		if(!empty($path) && !empty($file_name))
		$this->Email->attachments = array($file_name,$path.$file_name);
		
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
    
    public function getLoanReasons() {
        
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
        
        if($user_type == 1) {
			$controller =  'borrowers';
		}else if($user_type == 2) {
			$controller =  'brokers';
		}else if($user_type == 3) {
			$controller =  'sales_managers';
		}else if($user_type == 4) {
			$controller =  'sales directors';
		}else if($user_type == 5) {
			$controller =  'processors';
		}else if($user_type == 6) {
			$controller =  'funders';
		}else if($user_type == 7) {
			$controller =  'investors';
		}else {
			$controller =  'users';
		}
        return $controller;
    }
    
    /**
    * Summary:-getPdf
    * Description : Preview or Download Pdf
    * @attr : $fileName and $download (true / false) - true for download and false for preview pdf.
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
        $teamID = '';
        $userDetail  =  $this->User->find('first',array('fields'=>array('User.id','User.user_type'), 'conditions'=>array('User.id' =>$userID )));
		$userType = $userDetail['User']['user_type'];
		/*if($userType=='6') {
            $teamDetail = $this->Team->find('list',array('fields'=>array('Team.id'), 'conditions'=>array('Team.funder_id' =>$userID )));           
        } else {*/
        $teamDetail = $this->TeamMember->find('first',array('conditions'=>array('TeamMember.team_member_id' =>$userID),'fields'=>'team_id,team_member_id'));            
        //}
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
		
        $this->loadModel('Team');
        $this->loadModel('TeamMember');
        $teamID = '';
        
        $userDetail  =  $this->User->find('first',array('fields'=>array('User.id','User.user_type'), 'conditions'=>array('User.id' =>$userID )));
		$userType = $userDetail['User']['user_type'];
        
		/*if($userType=='6') {
            
            $teamDetail = $this->Team->find('first',array('fields'=>array('Team.id'), 'conditions'=>array('Team.funder_id' =>$userID )));
            $teamID = $teamDetail['Team']['id'];
        } else {*/
            
            $teamDetail = $this->TeamMember->find('first',array('conditions'=>array('TeamMember.team_member_id' =>$userID ),'fields'=>array('TeamMember.team_id')));
            if(!empty($teamDetail)) {
                $teamID = $teamDetail['TeamMember']['team_id'];
            }
        //}
       //pr($teamID);
		return $teamID;
    }
    
  /**
   * Summary:- getAllCompany
   * @return	
   * Description  :- getAllCompany
   */
    
    public function getAllCompany() {
		
        $companies = array('Rockland'=> 'Rockland',
                           'RocklandFund' => 'RocklandFund');
		$this->set('companies', $companies);
	}
    
    /*
	* download function
	* Functionality -  Force download document - Put file name with path
	* Created date - 14-Oct-2015
	*/
	
	function downloadDoc($fileName) { //die($fileName);
		$this->response->file($fileName, array('download' => true));
		return $this->response;
	}
    
     /**
     * Summary :- getLoanLifeCyclePhase
     * @return	NULL
     * Description :- getLoanLifeCyclePhase
     *  "4" => "Loan Application",
        "5" => "Processor Check-list Document Requests",
        "6" => "Processor Check-list Documents Received",
        "7" => "Trust Deed flyer Draft",
        "8" => "Trust Deed flyer - Flyby Publish",
        "9" => "Letter of Intent (LOI) - Flyby Published",
        "10" => "Processor Review - Satisfied Processing Approval",
        "11" => "Funder Review - Satisfied Conditional Loan Approval",
        "12" => "Letter of Intent (LOI) - Final Published",
        "13" => "Letter of Intent (LOI) - Final Signed by Borrower and Received",
        "14" => "Letter of Intent (LOI) - Conditions Satisfied",
        "15" => "Trust Deed Flyer - Final Publish",
        "16" => "Trust Deed Investor Hold Request",
        "17" => "Trust Deed Investor - Conditions Requested",
        "18" => "Doc Order Form - Published",
        "19" => "Doc Order Form - Published",
        "20" => "Loan Signing",
        "21" => "Loan Closed",
        "22" => "Trust Deed Tombstone - Published",
        "23" => "Accounting - Loan Sales Comm, Reconiliation, Compliancy",
     */
     
    public function getLoanLifeCyclePhase() {
        $loanPhases =  array(
            "4" => "4",
            "5" => "5",
            "6" => "6",
            "7" => "7",
            "8" => "8",
            "9" => "9",
            "10" => "10",
            "11" => "11",
            "12" => "12",
            "13" => "13",
            "14" => "14",
            "15" => "15",
            "16" => "16",
            "17" => "17",
            "18" => "18",
            "19" => "19",
            "20" => "20",
            "21" => "21",
            "22" => "22",
            "23" => "23",
        );
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
        return $accountType = array('1' => 'Checking','2' => 'Savings','3' => 'Money Market','4' => 'CD','5' => 'Mutual Fund or Stock','6' => 'Gift from');
    }
    
    /**
     * Description :- getGrantorRelation
     * @var object : NONE
     */
    
    function getGrantorRelation(){
        return array('1' => 'Relative','2' => 'Significant other','3' => 'Life friend','4' => 'Other');
    }
}