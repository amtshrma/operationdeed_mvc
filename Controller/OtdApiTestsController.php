<?php
/*
* OtdApiTests Controller class
* Functionality -  
* Created date - 2nd, Nov 2015
*
* Basecamp Links for API
* http://172.24.2.222:8126/otd_api_tests/get_users
* https://basecamp.com/2162665/projects/9738468/documents/9732361
* https://basecamp.com/2162665/projects/9738468/documents/9732350
* https://basecamp.com/2162665/projects/9738468/documents/9752382
*/

App::uses('Sanitize', 'Utility');

class OtdApiTestsController extends AppController {
	
	var $uses = array();
	var $components = array('Email', 'CustomEmail', 'Session');
	
	function beforeFilter() {
		
		//parent::beforeFilter();
	}
	
	/**
	* @short_app function
	* @Description : shortapp api for loan application - 
	* @Created date - 2nd, Nov 2015
	*/
	
	function short_app() { //short app api test.
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		//$arrDbFields = array('applicant_first_name',
		//						 'applicant_last_name',
		//						 'applicant_email_ID',
		//						 'applicant_phone',
		//						 'applicant_company_name',
		//						 'property_name',
		//						 'property_type',
		//						 'property_state',
		//						 'property_city',
		//						 'loan_type',
		//						 'loan_reason',
		//						 'loan_amount',  // Dropdown
		//						 'loan_to_value',
		//						 'loan_objective');
		
		$fields = array('robert',
						'api',
						'robert@mailinator.com',
						'8699296930',
						'PI Company',
						'MN Properties',
						'retail_single_tenant',
						'Mohali',
						'Punjab',
						'2',
						'Home Loan',
						'1000000 - 2000000',
						'4',
						'1');
		
		$arr = $obj->shortApp($fields);
		
		//pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* register function
	* Description : registration api for user registration
	* Created date - 2th, Nov 2015
	*/
	
	function register() { //register api test.
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$token = 'b62a58e79a293095a6ef512ddad6b6536c1b0d890ff90445e4f32b10749ede8c';
		//array contains - first name, last name, email, oassword and user type(1,2,3,4,5,6,7,8,9)
		$fields = array($token, 'Robert', 'Api', 'robert@mailinator.com', '123456', '1', 'Bre', '123456');
		
		$arr = $obj->registration($fields, $token);
		//pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* login
	* Description : login api for user login
	* Created date - 2th, Nov 2015
	*/
	
	function login() { //login api test.
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		// array contains - email id, password, and user type(1,2,3,4,5,6,7,8,9)
		$fields = array('manishksmd@gmail.com', 'manishaaaa', '5');		
		$arr = $obj->login($fields);
		
		//pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* loan_app 
	* Description : loan_app api for loan application
	* Created date - 4th, Nov 2015
	*/
	
	function loan_app() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$token = 'b62a58e79a293095a6ef512ddad6b6536c1b0d890ff90445e4f32b10749ede8c';
		
		$fields = array($token,
						'450000', // Borrower Information
						'Purchase',
						'500000', // Property Information
						'800000',
						'900000',
						'2015-04-04',
						'Condo',
						'Investment',
						'Good Condition',
						'20000',
						'',
						'',
						'',
						'',
						'1st Lien',
						'Self/E Type of Business',
						'monthly_gross_income', // Description of income
						'loan_term_requested',
						'income_documentation',
						'repayment_strategy',
						'liquid_assests',
						'other_real_estate',
						'notes'
						);
		
		$arr = $obj->loanApp($fields); //pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_users
	* Description : To get borker array
	* Created date - 4th, Nov 2015
	* 
	*/
	
	function get_users() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$userType = array('2', '5');
		
		$arr = $obj->getUsers($userType); //pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_property_types
	* Description : To get user types
	* Created date - 9th, Nov 2015
	*/
	
	function get_property_types() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$arr = $obj->getPropertyTypes(); //pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_property_types
	* Description : To get loan types
	* Created date - 9th, Nov 2015
	*/
	
	function get_loan_types() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$arr = $obj->getLoanTypes(); //pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_loan_amount
	* Description : To get loan amount range array - used for select box
	* Created date - 9th, Nov 2015
	*/
	
	function get_loan_amount_range() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$arr = $obj->getLoanAmountRange(); //pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_reason_for_loan
	* Description : To get loan amount array
	* Created date - 9th, Nov 2015
	*/
	
	function get_reason_for_loan() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$arr = $obj->getLoanReason(); //pr($arr);
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_reason_for_loan
	* Description : To get loan amount array
	* Created date - 9th, Nov 2015
	*/
	
	function get_apx_loan_values() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$arr = $obj->getApproxLoanValues();
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_states
	* Description : To get state array
	* Created date - 9th, Nov 2015
	*/
	
	function get_states() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$arr = $obj->getStates();
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* get_cities
	* Description : To get city array
	* Created date - 9th, Nov 2015
	*/
	
	function get_cities() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$arr = $obj->getCities();
		echo '<br><br><br>';die('stop');
	}
	
	/**
	* staff_registration
	* Description 	: staff_registration api - Sales Director - Sales Manager/Broker/CFL Company Registration
	* Created date	: 10th, Nov 2015
	*/
	
	function staff_registration() {
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$fields = array('Jason',
						'Moron',
						'jason@mailinator.com',
						'123456',
						'1',
						'Rockland',
						'Rockland Commercial, Inc. 222 N Sepulveda Blvd STE 2000 El Segundo, CA 90245
',
						'(310)709-5752
',
						'8699296930',
						'clf',
						'',
						'CFL 001 RLC');
		
		$arr = $obj->staffRegistration($fields);
		echo '<br><br><br>';die('stop');
	}
}
?>