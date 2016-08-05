<?php    
class LongApp extends AppModel {
    var $name = 'LongApp';
    public $validate = array(
        'agency_case_number' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter agency case number'
        ),
        'applicant_first_name' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter first name'
        ),
        'applicant_last_name' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter last name'
        ),
        'applicant_email_ID' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Enter valid email'
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Enter email address'
            )
        ),
        'company_select' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select borrower type'
        ),
		'applicant_company_name' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter company name'
        ),
        'applicant_phone' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter valid phone number'
        ),
        'property_name' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter property name'
        ),
        'property_type' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select property type'
        ),
        'other_property_type' => array(
            'rule'    => 'otherPropertyType',
            'message' => 'Enter other property type'
        ),
        'property_state' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select state'
        ),
        'property_city' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select city'
        ),
        'loan_type' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select loan type'
        ),
        'loan_reason' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select loan reason'
        ),
        'other_loan_reason' => array(
            'rule'    => 'otherLoanReason',
            'message' => 'Enter other loan reason'
        ),
        'loan_amount' => array(
            'rule'    => 'notEmpty',
            'message' => 'Select loan amount'
        ),
        'loan_to_value' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter loan to value'
        ),
        'loan_objective' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter loan objective'
        ),
        'account_type' => array(
            'rule'    => 'accountType',
            'message' => 'Select account type'
        ),
		'another_bank_name' => array(
            'rule'    => 'anotherBankName',
            'message' => 'Enter bank name'
        ),
        'another_account_balance' => array(
            'rule'    => 'anotherBankBalance',
            'message' => 'Account balance'
        ),
        'bank_name' => array(
            'rule'    => 'bankName',
            'message' => 'Enter bank name'
        ),
        'account_balance' => array(
            'rule'    => 'accountBalance',
            'message' => 'Account balance'
        ),
        'grantor_name' => array(
            'rule'    => 'grantorName',
            'message' => 'Enter grantor name'
        ),
        'grantor_relation' => array(
            'rule'    => 'grantorRelation',
            'message' => 'Grantor relationship'
        ),
        'fico_score' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter fico score'
        )
    );
    
    /**
     * Description :- accountType
     * @var object :- NONE
     */
    
    function accountType(){
        if($this->data['ShortApplication']['loan_type'] == '2'){
            if(empty($this->data['ShortApplication']['account_type'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        } 
    }
    
    /**
     * Description :- grantorRelation
     * @var object :- NONE
     */
    
    function grantorRelation(){
        if($this->data['ShortApplication']['account_type'] == '6'){
            if(empty($this->data['ShortApplication']['grantor_relation'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        } 
    }
    
    /**
     * Summary :- grantorName
     * @return	object :- NONE
     * Description :- grantorName
     */
    
    function grantorName(){
        if($this->data['ShortApplication']['account_type'] == '6'){
            if(empty($this->data['ShortApplication']['grantor_name'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        } 
    }
    
    /**
     * Summary :- anotherBankBalance
     * @return	object :- NONE
     * Description :- anotherBankBalance
     */
    
    function anotherBankBalance(){
        if(!empty($this->data['ShortApplication']['account_balance']) && $this->data['ShortApplication']['account_balance'] < $this->data['ShortApplication']['down_payment']){
            $finalTotal = $this->data['ShortApplication']['another_account_balance'] + $this->data['ShortApplication']['account_balance'];
            if(empty($this->data['ShortApplication']['another_account_balance']) || $finalTotal < $this->data['ShortApplication']['down_payment']){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        } 
    }
    
    /**
     * Description :- anotherBankName
     * @var object :- NONE
     */
    
    function anotherBankName(){
        if(!empty($this->data['ShortApplication']['account_balance']) && $this->data['ShortApplication']['account_balance'] < $this->data['ShortApplication']['down_payment']){
            if(empty($this->data['ShortApplication']['another_bank_name'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        } 
    }
    
	/**
     * Summary :- anotherBankBalance
     * @return	object :- NONE
     * Description :- anotherBankBalance
     */
    
    function accountBalance(){
        if($this->data['ShortApplication']['loan_type'] == '2'){
            if(empty($this->data['ShortApplication']['account_balance'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        } 
    }
    
    /**
     * Description :- anotherBankName
     * @var object :- NONE
     */
    
    function bankName(){
        if($this->data['ShortApplication']['loan_type'] == '2'){
            if(empty($this->data['ShortApplication']['bank_name'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        } 
    }
	
    /**
     * Summary :- otherLoanReason
     * @return	object :- NONE
     * Description :- otherLoanReason
     */
    
    function otherLoanReason(){
        if($this->data['ShortApplication']['loan_reason'] == '7'){
            if(empty($this->data['ShortApplication']['other_loan_reason'])){
                return false;
            }else{
                return true;
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
		$phoneNo = $this->data['ShortApplication']['applicant_phone'];
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
    
    /**
	* @Date:Sep 9, 2015
	* @Method : validateCompanyName
	* Created By: Amit Sharma
	* @Purpose: get unique content
	* @Param: none
	* @Return: none 
	**/
    
    function validateCompanyName(){
        if($this->data['ShortApplication']['company_select'] != '0'){
            if(empty($this->data['ShortApplication']['applicant_company_name'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
    
    /**
	* @Date:Sep 9, 2015
	* @Method : validateCompanyName
	* Created By: Amit Sharma
	* @Purpose: get unique content
	* @Param: none
	* @Return: none 
	**/
    
    function otherPropertyType(){
        if($this->data['ShortApplication']['property_type'] == 'other'){
            if(empty($this->data['ShortApplication']['other_property_type'])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
}

?>
