<?php
/*
* Admins Controller class
* Functionality -  Manage the admin login,listing,add 
* Created date - 26-May-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 
class AccountsController extends AppController {
    var $uses = array('UserPayment','Loan');
    var $name = 'Account';        
	// pagination
    public $paginate = array(
							'limit' => PAGINATION_LIMIT
						);
	
	function beforeFilter() {
		$allow = array();
		parent::beforeFilter();
		$this->checkUserSession($allow);
		$this->layout = 'dashboard_common';
	}

	/*
	* admin_index function
	* Functionality -  Admin Index functionality
	* Created date - 24-Fed-2016
	* Modified date - 
	*/

	function index() {
		$condition = array();
		if(!empty($this->request->query['search'])){
			$condition['UserPayment.status'] = base64_decode($this->request->query['search']);
		}
		if(!empty($this->request->query['loan_id'])){
			$condition['UserPayment.loan_id'] = base64_decode($this->request->query['loan_id']);
		}
		$this->paginate['order'] = 'UserPayment.id DESC';
		$this->paginate['fields'] = 'UserPayment.*,User.first_name,User.last_name,User.email_address,Loan.short_app_id,Loan.soft_quate_id,Loan.borrower_id,Loan.team_id';
		$this->paginate['conditions'] = $condition;
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('UserPayment');
		$this->set('userPayments', $getData);
	}
	
	/*
	* admin_dashboard function
	* Functionality -  Dashboard functionality
	* Created date - 26-May-2015
	* Modified date - 
	*/
	
	function updatePaymentStatus($userPaymentId = null,$status = null){
		if($this->request->data){
			if(!empty($this->request->data)){
				if(!empty($this->request->data['UserPayment']['cheque_image']['name'])){
					$file = $this->request->data['UserPayment']['cheque_image'];
					$path = 'img/uploadCheckImages/';					
					$folder_name = 'original';
					$multiple[] = array('folder_name'=>'thumb','height'=>'355','width'=>'300'); 
					// Code to upload the image
					$response = $this->Common->upload_image($file, $path, $folder_name, true, $multiple);
					// check if filename return or error return
					$is_image_error = $this->Common->is_image_error($response);
					if(in_array($response , array('exist_error', 'size_mb_error', 'size_mb_error'))) {
						$this->Session->setFlash($is_image_error,'error');
					}else{
						$filename = $response;
						$this->request->data['UserPayment']['cheque_image'] = $filename;	
					}	
				}else{
					unset($this->request->data['UserPayment']['cheque_image']);
				}
			}
			$this->request->data['UserPayment']['id'] = base64_decode($userPaymentId);
			$this->request->data['UserPayment']['status'] = base64_decode($status);
			$this->UserPayment->save($this->request->data);
			$this->Session->setFlash('Payment Status Updated Successfully.','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'accounts','action'=>'index'));
		}
		$userPaymentDetail = $this->UserPayment->findById(base64_decode($userPaymentId));
		$this->set('userPaymentDetail',$userPaymentDetail);
	}
	
	/**
	 * Description
	 * @var object
	*/
	
	function showCommissionList(){
		$this->loadModel('UserPayment');
		$this->paginate['conditions'] = array('UserPayment.user_id' => $this->Session->read('userInfo.id'));
		$this->paginate['fields'] = 'UserPayment.*,User.first_name,User.last_name,User.email_address,Loan.id,Loan.loan_number,Loan.short_app_id,Loan.soft_quate_id,Loan.borrower_id,Loan.team_id';
		$this->Paginator->settings	= $this->paginate;
		$getData =  $this->Paginator->paginate('UserPayment');
		$this->set('userPayments', $getData);
	}
	
	/**
	 * Description
	 * @var object
	 */
	
	public function requestPayment($loanId = null){
		$this->loadModel('UserPayment');
		$this->UserPayment->id = base64_decode($loanId);
		$this->UserPayment->saveField('payment_request','1');
		$this->Session->setFlash('Payment request sent Successfully.','default',array('class'=>'alert alert-success'));
		$this->redirect(array('controller'=>'accounts','action'=>'showCommissionList'));
	}
	
	/**
	 * Description :- updateStaffPayment
	 * @var object :- $userId, $status
	*/
	
	public function updateStaffPayment($userId = null, $paymentId = null){
		$userPaymentDetail = $this->UserPayment->find('first',array('conditions'=>array('id'=>base64_decode($paymentId)),'recursive'=>-1));
		if($this->request->data){
			$this->request->data['UserPayment']['user_id'] = base64_decode($userId);
			$this->request->data['UserPayment']['loan_id'] = $userPaymentDetail['UserPayment']['loan_id'];
			$this->request->data['UserPayment']['loan_amount'] = $userPaymentDetail['UserPayment']['loan_amount'];
			$this->request->data['UserPayment']['paid_by'] = $this->Session->read('userInfo.id');
			$this->request->data['UserPayment']['status'] = '1';
			$this->UserPayment->save($this->request->data);
			$this->Session->setFlash('Payment Status Updated Successfully.','default',array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'accounts','action'=>'showCommissionList'));
		}
		$userPaymentDetail = $this->UserPayment->find('first',array('conditions'=>array('id'=>base64_decode($paymentId)),'recursive'=>-1));
		$this->set(compact(array('userPaymentDetail','userId')));
	}
}
?>