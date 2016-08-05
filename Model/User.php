<?php    
class User extends AppModel {
var $name = 'User';
public $hasOne = 'UserDetail';
public $virtualFields = array(
    'name' => 'CONCAT(User.first_name, " ", User.last_name)'
);
public $validate = array(
		'first_name' => array(
			'rule'    => 'notEmpty',
			'message' => 'Enter first name'
		),
		'last_name' => array(
			'rule'    => 'notEmpty',
			'message' => 'Enter last name'
		),
		'email_address' => array(
			'isUnique' => array(
				'rule' => array('checkUniqueEmailID'),
				'message' => 'Email already exist',
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Enter valid email address'
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Enter email address'
			)
		),
		'password'=> array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter password'
			)
		),
		'confirm_password'=> array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter confirm password'
			),
			'confirmPassword' => array(
				'rule' => 'confirmPassword',
				'message' => 'Password not matched'
			)
		),
		'user_type' => array(
			'rule'    => 'notEmpty',
			'message' => 'Select user type'
		)
	);
	
	/**
	 * Summary
	 * @param	deletebyid	$id	deletebyid
	 * @return	deletebyid		deletebyid
	 */
	
	public function deletebyid($id){
		if($this->delete($id)){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Summary :- confirmPassword
	 * @return	NONE
	 * Description :- confirmPassword
	 */
	
	function confirmPassword(){
		if($this->data['User']['password'] != $this->data['User']['confirm_password']){
			return false;
		}else{
			return true;
		}
	}
	
	/**
	 * Description:- checkUniqueEmailID
	 * @var NONE
	 */
	
	public function checkUniqueEmailID(){
		if(!empty($this->data['User']['id'])){
			return true;
		}else{
			$data = $this->find('first',array('conditions'=>array('User.email_address'=>$this->data['User']['email_address'],'User.user_type'=>$this->data['User']['user_type'])));    
			if(!empty($data)){
				return false;
			}else{
				return true;
			}
		}
	}
}
?>
