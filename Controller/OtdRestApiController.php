<?php
/** http://172.24.2.222:8126/otd_api_tests/get_users
 * @OtdRestApiController Controller class
 * @Functionality -  Manage APIs for various actions
 * @Created date - 1 Sep 2015
 */

App::uses('Sanitize', 'Utility');

class OtdRestApiController extends AppController {
	
	var $uses = array('User',
					  'UserDetail',
					  'ShortApplication',
					  'SoftQuote',
					  'LoanLog',
					  'Notification',
					  'Token',
					  'Loan',
					  'LoanPhase',
					  'TeamMember',
					  'State',
					  'City');
	
	var $components = array('Email', 'Common', 'CustomEmail', 'RequestHandler', 'Session');
	
	// Custom Variables (said - short app, uid - userid)
	var $arrTokenReference = array('said', 'uid');
	
	function beforeFilter() {
		
		Configure::write('debug',2);
		//parent::beforeFilter();
	}
	
	/**
	 *@created	: 03 Nov 2015
	 *@uses		: generate token for the external users
	 *@desc		: Every single request will require the token.
	 *			  This token should be sent in the HTTP header
	 *			  so that we keep with the idea of stateless HTTP requests.
	 */
	
	protected function __generateToken() {
		
		return $token = bin2hex(openssl_random_pseudo_bytes(32));
	}
	
	/**
	* @Created	: 06th, Oct 2015
	* @uses		: api to get users by user type.
	* 
	*/
	
	function get_users() {
		
		$this->autoRender = false;
		$return = '';
		
		//$userTypes = $this->userTypes;
		
		if(!empty($this->request->data)) {
			
			$allowedUserTypes = array('2', '5', '7');			
			//pr($allowedUserTypes); pr($this->request->data);
			
			$flag = 0;
			$userTypes = $this->request->data;
			foreach($userTypes as $userType) {
				
				if(!in_array($userType, $allowedUserTypes)) {
					
					$flag = 1;
				}
			}
			
			if($flag=='1') {
				
				$return = 'Invalid user type passed. Send valid user types in array.';
				return json_encode($return);
			}
			
			$users = $this->User->find('all', array('fields'=>array('User.id', 'User.first_name', 'User.last_name', 'User.email_address'), 'conditions'=>array('User.user_type'=>$userTypes)));
			
			//$arrUser = array();
			//if(!empty($users)) {
			//	$i=0;
			//	foreach($users as $user) {
			//		
			//		$arrUser[$i]['id'] = base64_encode($user['User']['id']);
			//		$arrUser[$i]['first_name'] = $user['User']['first_name'];
			//		$arrUser[$i]['last_name'] = $user['User']['last_name'];
			//		$arrUser[$i]['email_address'] = $user['User']['email_address'];
			//		$i++;					
			//	}
			//}
			
			return json_encode($users);
		} else {
			
			$return = array('error'=>'No array found.');
			return json_encode($return);
		}
	}
	
	/**
	* @Created	: 09th, Oct 2015
	* @uses		: api to get property type.
	* 
	*/
	
	function get_property_types() {
		
		$this->autoRender = false;
		$return = '';
		
		$propertyTypes = $this->userTypes;
		return json_encode($propertyTypes);
	}
	
	/**
	 *get_loan_types
	* @Created	: 09th, Oct 2015
	* @uses		: api to get loan
	*/
	
	function get_loan_types() {
		
		$this->autoRender = false;
		$return = '';
		
		$loanTypes = $this->loanTypes;
		return json_encode($loanTypes);
	}
	
	/**
	 *get_loan_types
	* @Created	: 09th, Oct 2015
	* @uses		: api to get loan amount array
	*/
	
	function get_loan_amount_range() {
		
		$this->autoRender = false;
		$return = '';
		
		$loanAmounts = $this->loanAmounts;
		return json_encode($loanAmounts);
	}
	
	/**
	 *get_loan_types
	* @Created	: 09th, Oct 2015
	* @uses		: api to get loan amount array
	*/
	
	function get_reason_for_loan() {
		
		$this->autoRender = false;
		$return = '';
		
		$loanReasons = $this->loanReasons;
		return json_encode($loanReasons);
	}
	
	/**
	 *get_loan_types
	* @Created	: 09th, Oct 2015
	* @uses		: api to get loan amount array
	*/
	
	function get_apx_loan_values() {
		
		$this->autoRender = false;
		$return = '';
		
		$apxLoanValues = $this->approxLoanValues;
		return json_encode($apxLoanValues);
	}
	
	/**
	 *get_states
	* @Created	: 09th, Oct 2015
	* @uses		: api to get state array
	*/
	
	function get_states() {
		
		$this->autoRender = false;
		$return = '';
		
		$arrState = $this->State->find('all'); //pr($arrState);
		return json_encode($arrState);
	}
	
	/**
	 *get_cities
	* @Created	: 09th, Oct 2015
	* @uses		: api to get city array
	*/
	
	function get_cities() {
		
		$this->autoRender = false;
		$return = '';
		
		$arrCity = $this->City->find('all'); // pr($arrCity);
		return json_encode($arrCity);
	}
	
	/**
	* @Created	: 06th, Oct 2015
	* @uses		: shortapp api for loan application
	*/
	
	function short_app() {
		
		$this->autoRender = false;
		$return = '';
		
		if(!empty($this->request->data)) {
			
			$arrDbFields = array('applicant_first_name',
								 'applicant_last_name',
								 'applicant_email_ID',
								 'applicant_phone',
								 'applicant_company_name',
								 'property_name',
								 'property_type',
								 'property_state',
								 'property_city',
								 'loan_type',
								 'loan_reason',
								 'loan_amount',
								 'loan_to_value',
								 'loan_objective');
			
			if(count($arrDbFields)!=count($this->request->data)) {
				
				$return = 'Argument mismatch. All arguments are required.';
				return json_encode($return);
			}
			
			if(isset($this->request->data) && (!empty($this->request->data))) {
				
				$arrShortApp = array_combine($arrDbFields, $this->request->data);
				
				$this->ShortApplication->set($arrShortApp);
				if($this->ShortApplication->validates()) {
					
					//pr($arrShortApp);
					//die('<br><br>here');
					
					if($this->ShortApplication->save($arrShortApp)) {
						
						$shortAppId = $this->ShortApplication->id;
						
						//Save token for the short app request. - Save token only when create short app
						$token = $this->__generateToken();
						
						$arrToken = array();
						$arrToken['reference'] = 'said';
						$arrToken['reference_id'] = $shortAppId;
						$arrToken['token'] = $token;
						
						$this->Token->save($arrToken);
						
						//Loan Logs
						$logData['LoanLog']['short_application_ID'] = $shortAppId;
						$logData['LoanLog']['action'] = 'Applied';
						$logData['LoanLog']['description'] = 'Short App is applied';
						$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
						$this->LoanLog->save($logData);
						
						$arrShortApp['id'] = $shortAppId;
						$this->CustomEmail->__sendShortAppEmailNotification($arrShortApp);
						
						$return = array('success'=>'Short app saved. Save token for the further reference.', 'token'=>$token);
					} else {
						
						$return = array('error'=>'Problem in saving short app details. Please check fields properly.');
					}
				} else {
					
					$arrE = $this->ShortApplication->validationErrors;
					return json_encode($arrE);
				}
			}
		} else {
			$return = array('error'=>'No array found.');
			return json_encode($arrE);
		}
	}
	
	/**
	* @Created	: 06th, Oct 2015
	* @uses		: token api - use short app token for user registration.
	*/
	
	function __getTokenByTokenId($token=null) {
		
		$arrToken = $this->Token->find('first', array('conditions'=>array('Token.token'=>$token,  'Token.status'=>'0')));
		return $arrToken;
	}
	
	/**
	* @Created	: 06th, Oct 2015
	* @uses		: registration api - use short app token for user registration.
	*/
	
	function registration() {
		
		$this->autoRender = false;
		$return = '';
		
		if(!empty($this->request->data)) {
			
			$arrDbFields = array('token', 'first_name', 'last_name', 'email_address', 'password', 'user_type');//
			
			//$employer_licence_type = array("bre" =>"BRE Broker", "cfl" =>"CFL");
			
			if(count($arrDbFields)!=count($this->request->data)) {
				
				$return = 'Argument mismatch. All arguments are required.';
				return json_encode($return);
			}
			
			if(count($arrDbFields)==count($this->request->data)) {
				
				$arrUserData = array_combine($arrDbFields, $this->request->data);
				
				if($arrUserData['user_type']!='1') {
					
					$return = 'Invalid user type. Pass user type 1 only.';
					return json_encode($return);
				}
				
				//Get Token
				$shortAppId = '';
				//$tokenId = '';
				$arrToken = $this->__getTokenByTokenId($arrUserData['token']);
				if(!empty($arrToken)) {
					
					$reference = $arrToken['Token']['reference'];
					if(in_array($reference, $this->arrTokenReference)) {
						
						//$tokenId = $arrToken['Token']['id'];
						$shortAppId = $arrToken['Token']['reference_id'];
					}
				} else {
					
					$return = array('error'=>'Invalid token.');
					return json_encode($return);
				}
				
				unset($arrUserData['token']);
				$arrUserData['password'] = md5($arrUserData['password']);
				
				//pr($arrUserData);die();
				
				$this->User->set($arrUserData);
				if($this->User->validates()) {
					
					if($this->User->save($arrUserData)) {
						
						$userId = $this->User->id;
						if(!empty($arrUserData['bre_license_number']) || $arrUserData['bre_license_number']) {
							
							$arrUserDetail['user_id'] = $userId;
							$arrUserDetail['employer_licence_type'] = $arrUserData['employer_licence_type'];
							$arrUserDetail['bre_license_number'] = $arrUserData['bre_license_number'];
						}
						$this->UserDetail->save($arrUserDetail);
						
						$hashCode =  md5(uniqid(rand(), true));
						$this->User->saveField('random_key',$hashCode, false);
						
						// Save Soft Quote - borrowerid
						if(!empty($shortAppId)) {
							
							$this->ShortApplication->id = $shortAppId;
							$this->ShortApplication->saveField('borrower_ID', $userId);
							
							//Expire token
							//$this->Token->id = $tokenId;
							//$this->Token->saveField('status', 1);
						}
						
						$arrSuccess = array('success'=>'User has been registered successfully. Our staff will review and activate your account soon. Please check your email for more details.');
						
						$arrUserData['random_key'] = $hashCode;
						
						// Send Email notification to user on registration.
						$userType = $arrUserData['user_type'];
						$arrUserData['user_type'] = $this->userTypes[$userType];
						$this->CustomEmail->__sendRegistrationEmailAPI($arrUserData);
						
						return json_encode($arrSuccess);
					}
				} else {
					
					$arrE = $this->User->validationErrors;
					return json_encode($arrE);
				}
			}
		}
		
		return $return;
	}
	
	/**
	* @Created	: 06th, Oct 2015
	* @uses		: user login api
	*/
	
	function login() {
		
		$this->autoRender = false;
		$return = '';
		
		if(!empty($this->request->data)) {
			
			$arrDbFields = array('email_address', 'password', 'user_type');
			
			if(count($arrDbFields)!=count($this->request->data)) {
				
				$return = 'Argument mismatch. All arguments are required.';
				return json_encode($return);
			}
			
			if(count($arrDbFields)==count($this->request->data)) {
				
				$arrUserData = array_combine($arrDbFields, $this->request->data);
				
				//$this->User->unbindValidation('keep', array('email'), true);
				unset($this->User->validate['email_address']['isUnique']);
				
				$this->User->set($arrUserData);
				if($this->User->validates()) {
					
					$arrUserData['password'] = !empty($arrUserData['password'])?md5($arrUserData['password']):'';
					$userInfo = $this->User->find('first', array('fields'=>array('id', 'email_address', 'password', 'user_type'), 'conditions'=>array("User.email_address" => $arrUserData['email_address'], "User.user_type" => $arrUserData['user_type'], "User.password" => $arrUserData['password'], "User.status"=>1, "User.is_deleted"=>0)));
					
					//pr($userInfo);
					
					if(!empty($userInfo['User']['password']) && ($userInfo['User']['password'] == $arrUserData['password'])) {
						
						$return = array('success'=>'Logged in successfully.');
					} else {
						
						$return = array('error'=>'Email or password is incorrect.');
					}
				} else {
					
					$arrE = $this->User->validationErrors;
					return json_encode($arrE);
				}
			}
		}
		
		return json_encode($return);
	}
	
	/**
	 *@created	: 04 Nov 2015
	 *@uses		: 
	 *@desc		: 
	 */
	
	function loan_app() {
		
		$this->autoRender = false;
		$return = '';
		
		if(!empty($this->request->data)) {
			
			//purpose_of_loan - dropdown - needs api
			//proprty_type  - dropdown - needs api
			//occupancy - dropdown - needs api
			//loan_term_requested - dropdown - needs api
			
			$arrDbFields = array('token',
								 'loan_amount', // Borrower Information
								 'purpose_of_loan',
								 'property_value_as', // Property Information
								 'property_value_after',
								 'property_value_appraised',
								 'property_appraise_date',
								 'proprty_type',
								 'occupancy',
								 'condition_of_property',
								 'gross_rental_income',
								 'refinance_date_of_purchase',
								 'refience_original_purchase_price',
								 'cash_in_hand',
								 'cash_out',
								 'liens_property',
								 'employment',
								 'monthly_gross_income', // Description of income
								 'loan_term_requested',
								 'income_documentation',
								 'repayment_strategy',
								 'liquid_assests',
								 'other_real_estate',
								 'notes'
								 );
			
			if(count($arrDbFields)!=count($this->request->data)) {
				
				$return = 'Argument mismatch. All arguments are required.';
				return json_encode($return);
			}
			
			if(isset($this->request->data) && (!empty($this->request->data))) {
				
				$arrLoan = array_combine($arrDbFields, $this->request->data);
				
				//Get Token
				$shortAppId = '';
				$arrToken = $this->__getTokenByTokenId($arrLoan['token']);
				
				if(!empty($arrToken)) {
					
					$reference = $arrToken['Token']['reference'];
					if(in_array($reference, $this->arrTokenReference)) {
						
						$shortAppId = $arrToken['Token']['reference_id'];
					}
				} else {
					
					$return = array('error'=>'Invalid token.');
					return json_encode($return);
				}				
				unset($arrLoan['token']);
				
				$softQuateId = base64_encode('6');
				
				//soft_quotes
				$softQuoteDetail = $this->SoftQuote->find('first', array('fields'=>array('SoftQuote.id', 'SoftQuote.user_Id', 'ShortApplication.borrower_ID'), 'conditions'=>array('SoftQuote.id'=>base64_decode($softQuateId))));
				//pr($softQuoteDetail);die;
				
				$userID = $softQuoteDetail['SoftQuote']['user_Id'];
				$borrowerId = $softQuoteDetail['ShortApplication']['borrower_ID'];
				$teamID = $this->getUserTeam($userID);
				$arrLoan['team_id'] = $teamID;
				$arrLoan['short_app_id'] = $shortAppId;
				$arrLoan['soft_quate_id'] = base64_decode($softQuateId);
				
				// Get user - borrower by userid/borrowerid
				$arrUser = $this->User->find('first', array('fields'=>array('User.first_name', 'User.last_name'), 'conditions'=>array('User.id'=>$borrowerId)));
				$name = $arrUser['User']['first_name'].''.$arrUser['User']['last_name'];
				
				$this->Loan->set($arrLoan);
				if($this->Loan->validates()) { //pr($arrLoan);die('----here');
					
					if($this->Loan->save($arrLoan)) {
						
						$loanID = $this->Loan->id;
						
						//save loan Phase
						$loanPhaseData['LoanPhase']['loan_phase'] = 'A';
						$loanPhaseData['LoanPhase']['loan_id'] = $loanID;
						$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;;
						$this->LoanPhase->save($loanPhaseData);
						
						//Assign Borrower to team
						if(!empty($teamID)) {
							
							$memberID = $borrowerId;
							$borrowerTeam = $this->TeamMember->find('first', array('condition' => array('team_member_id'=>$memberID,'member_type' =>1)));
							
							if(!empty($borrowerTeam) && isset($borrowerTeam['TeamMember']['team_id'])) {
								
								$memberData['TeamMember']['team_id'] = $teamID;
								$memberData['TeamMember']['member_type'] = 1;
								$memberData['TeamMember']['team_member_id'] = $memberID;
								$memberData['TeamMember']['status'] = 1;
								$memberData['TeamMember']['added_date'] = CURRENT_DATE_TIME_DB;
								$this->TeamMember->save($memberData);
							}
						}
						
						//Save notification for borrower registration
						$action = 'Loan Application Applied';
						$senderID = $borrowerId;
						$actionID = $loanID;
						
						$this->Common->saveNotifications($action, $senderID, $actionID);
						
						//save loan log
						$logData['LoanLog']['user_id'] = $borrowerId;
						//--session user/borrower id--$userData['id'];
						$logData['LoanLog']['short_application_ID'] = $shortAppId;
						$logData['LoanLog']['action'] = 'Loan Application';
						$logData['LoanLog']['description'] = 'Loan Application applied by '. $name;
						$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
						$this->LoanLog->save($logData);
						$this->redirect('loanSuccessMessage');
						
						//---						
						$return = array('success'=>'Loan application saved. Save token for the further reference.', 'token'=>$token);
					} else {
						
						$return = array('error'=>'Problem in saving loan application. Please check fields properly.');
					}
				} else {
					
					$arrE = $this->Loan->validationErrors;
					return json_encode($arrE);
				}
			}
			
			return json_encode($return);
		} else {
			$return = array('error'=>'No array found for the processing.');
			return json_encode($arrE);
		}
	}
	
	/**staff_registration
	* @Created	: 10th, Nov 2015
	* @uses		: staff_registration api - Sales Director - Sales Manager/Broker/CFL Company Registration
	*/
	
	//	SALES DIRECTOR INPUTS THIS INTO THE SYSTEM-
	//- Broker Name
	//- Broker Company Name
	//- Broker Email
	//- License Type - BRE or CFL
	//- License Number
	//- Company Address
	//- Company Phone Number
	//- Broker Direct Phone Number
	
	function staff_registration() {
		
		$this->autoRender = false;
		$return = '';
		
		if(!empty($this->request->data)) {
			
			$arrDbFields = array('first_name',
								 'last_name',
								 'email_address',
								 'password',
								 'user_type',
								 'company_name',
								 'mailing_address',
								 'office_phone',
								 'mobile_phone',
								 'employer_licence_type',
								 'bre_license_number',
								 'cfl_license_number');
			
			//$employer_licence_type = array("bre" =>"BRE Broker", "cfl" =>"CFL");
			
			if(count($arrDbFields)!=count($this->request->data)) {
				
				$return = 'Argument mismatch. All arguments are required.';
				return json_encode($return);
			}
			
			if(count($arrDbFields)==count($this->request->data)) {
				
				$arrUserData = array_combine($arrDbFields, $this->request->data);
				
				$arrAllowedUserTypes = array('2', '3', '4');
				if(in_array($arrUserData['user_type'], $arrAllowedUserTypes)) {
					
					$return = 'Invalid user type. Pass valid user type in array.';
					return json_encode($return);
				}
				
				$arrUserData['password'] = md5($arrUserData['password']);
				
				//pr($arrUserData);die();
				
				$this->User->set($arrUserData);
				if($this->User->validates()) {
					
					if($this->User->save($arrUserData)) {
						
						$userId = $this->User->id;
						
						$arrUserDetail['user_id'] = $userId;
						$arrUserDetail['company_name'] = $arrUserData['company_name'];
						$arrUserDetail['mailing_address'] = $arrUserData['mailing_address'];
						$arrUserDetail['office_phone'] = $arrUserData['office_phone'];
						$arrUserDetail['mobile_phone'] = $arrUserData['mobile_phone'];
						
						$arrUserDetail['employer_licence_type'] = $arrUserData['employer_licence_type'];
						$arrUserDetail['bre_license_number'] = $arrUserData['bre_license_number'];
						$arrUserDetail['cfl_license_number'] = $arrUserData['cfl_license_number'];
						
						$this->UserDetail->save($arrUserDetail);
						
						$hashCode =  md5(uniqid(rand(), true));
						$this->User->saveField('random_key',$hashCode, false);
						
						//Save token for the short app request. - Save token only when create short app
						$token = $this->__generateToken();						
						$arrToken = array();
						$arrToken['reference'] = 'uid';
						$arrToken['reference_id'] = $userId;
						$arrToken['token'] = $token;
						$this->Token->save($arrToken);
						
						$arrSuccess = array('success'=>'User has been registered successfully. Our staff will review and activate your account soon. Please check your email for more details.', 'token'=>$token);
						
						$arrUserData['random_key'] = $hashCode;
						
						// Send Email notification to user on registration.
						$userType = $arrUserData['user_type'];
						$arrUserData['user_type'] = $this->userTypes[$userType];
						$this->CustomEmail->__sendStaffRegistrationEmailAPI($arrUserData);
						
						return json_encode($arrSuccess);
					}
				} else {
					
					$arrE = $this->User->validationErrors;
					return json_encode($arrE);
				}
			}
		}
		
		return $return;
	}
}
?>