<?php
class Loan extends AppModel {
	var $name = 'Loan';
	public $belongsTo = array(
        'ShortApplication' => array(
            'className' => 'ShortApplication',
            'foreignKey' => 'short_app_id'
        )
    );
    var $validate = array(
		'loan_amount' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter loan amount",
			'last' => true
			)
		),
		'purpose_of_loan' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please select purpose of loan",
			'last' => true
			)
		),
		'property_value_as' => array(
			'notEmpty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter property value as is'
			)
		),
		'property_value_after' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter property value after",
			'last' => true
			)
		),
		'property_value_appraised' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter property value appraised",
			'last' => true
			)
		),
		'property_appraise_date' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter property appraise date",
			'last' => true
			)
		),
		'proprty_type' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter property type",
			'last' => true
			)
		),
		'occupancy' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter occupancy",
			'last' => true
			)
		),
		'condition_of_property' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter condition of property",
			'last' => true
			)
		),
		'gross_rental_income' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter gross rental income",
			'last' => true
			)
		)/*,
		'refinance_date_of_purchase' => array(
			'notEmpty' => array(
                'rule'    => array('customValidate','refinance_date_of_purchase','Refiance'),
                'message' => "Please enter refience date of purchase",
                'last' => true
			)
		),
		'refience_original_purchase_price' => array(
			'notEmpty' => array(
                'rule'    => array('customValidate','refience_original_purchase_price','Refiance'),
                'message' => "Please enter refience original purchase price",
                'last' => true
			)
		),
		'cash_in_hand' => array(
			'notEmpty' => array(
                'rule'    => array('customValidate','cash_in_hand','Refiance Cash Out'),
                'message' => "Please enter cash in hand",
                'last' => true
			)
		),
		'cash_out' => array(
			'notEmpty' => array(
			'rule'    => array('customValidate','cash_out','Refiance Cash Out'),
			'message' => "Please enter cash out",
			'last' => true
			)
		)*/,
		'liens_property' => array(
			'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => "Please select liens property",
                'last' => true
			)
		),
		'employment' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please select employment",
			'last' => true
			)
		),
		'income_documentation' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter income detail",
			'last' => true
			)
		),
		'monthly_gross_income' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter monthly gross income",
			'last' => true
			)
		),
		'liquid_assests' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter liquid assets detail",
			'last' => true
			)
		),
		/*'other_real_estate' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter other real estate value",
			'last' => true
			)
		),*/
		'loan_term_requested' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter loan term requested",
			'last' => true
			)
		),
		'repayment_strategy' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter repayment stratey",
			'last' => true
			)
		),
		/*'notes' => array(
			'notEmpty' => array(
			'rule' => 'notEmpty',
			'message' => "Please enter notes",
			'last' => true
			)
		)*/
    );
    
    /**
	* @Date:July 18, 2015
	* @Method : customRfienceValidate
	* Created By: Amit Sharma
	* @Purpose: customRfienceValidate
	* @Param: none
	* @Return: none 
	**/
	
	function customValidate($check = null, $field = null,$checkField = null){
		if(isset($this->data['Loan']['purpose_of_loan']) && $this->data['Loan']['purpose_of_loan'] == "$checkField"){
            if(isset($this->data['Loan'][$field]) && $this->data['Loan'][$field] != ''){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
	}
}

?>