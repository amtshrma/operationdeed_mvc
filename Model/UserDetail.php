<?php    
class UserDetail extends AppModel {
    var $name = 'UserDetail';
    public $belongsTo = 'User';
    public $validate = array(
        /*'company_name' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter company name'
        ),
        'company_position' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter company position'
        ),*/
        'mailing_address' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter mailing address'
        ),
        'state' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select state'
        ),
        'city' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select city'
        ),
        'zipcode' => array(
            'rule'    => 'numeric',
            'message' => 'Enter numeric zip code'
        ),
        'mobile_phone' => array(
            'rule'    => 'isValidUSPhoneFormat',
            'message' => 'Enter valid mobile number'
        ),
        'fax_number' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter numeric fax number'
        ),
        'employer_licence_type' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select licence type'
        ),
        'bre_license_number' => array(
            'rule'    => 'validateLicenceType',
            'message' => 'Enter BRE/CFL No.'
        ),
        'cfl_license_number' => array(
            'rule'    => 'validateLicenceType',
            'message' => 'Enter BRE/CFL No.'
        ),
		'paymentMethod' => array(
            'rule'    => 'checkForPaymentOption',
            'message' => 'Select payment option'
        ),
		'accept_terms' => array(
            'rule'    => 'notEmpty',
            'message' => 'Accept legal terms'
        ),
        'lending_profile' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter lending profile'
        ),
        'loan_amount_outstanding' => array(
            'rule'    => 'Numeric',
            'message' => 'Enter numeric outstanding loan amount'
        ),
        'trust_deed_lending_year' => array(
            'rule'    => 'Numeric',
            'message' => 'Enter numeric lending year'
        ),
        'counties' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter counties'
        )
    );
    
	/**
	 * Summary :- checkForPaymentOption
	 * @return	object : NONE
	 * Description :- checkForPaymentOption
	 */
	
	function checkForPaymentOption(){
		if($this->data['UserDetail']['paymentMethod'] == 'wire'){
            if(empty($this->data['UserDetail']['agree_wire_option'])){
                return false;
            }else{
                return true;
            }
        }else if($this->data['UserDetail']['paymentMethod'] == 'check'){
            if(empty($this->data['UserDetail']['agree_check_option'])){
                return false;
            }else{
                return true;
            }
        }
	}
		
    /**
	* @Date:Sep 9, 2015
	* @Method : validateLicenceType
	* Created By: Amit Sharma
	* @Purpose: get unique content
	* @Param: none
	* @Return: none 
	**/
    
    function validateLicenceType(){
		if($this->data['User']['user_type'] == 2 && $this->data['User']['user_type'] == 3){
			if(!empty($this->data['UserDetail']['employer_licence_type'])){
				if(empty($this->data['UserDetail']['bre_license_number']) && empty($this->data['UserDetail']['cfl_license_number'])){
					return false;
				}else{
					return true;
				}
			}
		}else{
			return true;
		}
    }
    
    /**
	* @Date:Sep 9, 2015
	* @Method : isValidUSPhoneFormat
	* Created By: Amit Sharma
	* @Purpose: get unique content
	* @Param: none
	* @Return: none 
	**/
	
	function isValidUSPhoneFormat(){
		$phoneNo = $this->data['UserDetail']['mobile_phone'];
		$errors = '';
		if(empty($phoneNo)){
			$errors = "Please enter Phone Number";
		}else if (!preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s.]{0,1}[0-9]{3}[-\s.]{0,1}[0-9]{4}$/', $phoneNo)) {
			$errors = "Please enter valid Phone Number";
		} 
		if(!empty($errors)){
			//return implode("\n", $errors);
			return false;
		}else{
			return true;
		}
	}
}
?>
