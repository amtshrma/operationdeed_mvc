<?php    
class TrustDeed extends AppModel {

var $name = 'TrustDeed';

var $hasMany = array(
    'TrustDeedUpload' => array(
        'className'     => 'TrustDeedUpload',
        
    ),
    'TrustDeedField' => array(
          'className'     => 'TrustDeedField',
          
    )
); 
public $validate = array(
	'trustdeed_position' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select Trust Deed Position.'
	),
	'note_rate' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please Enter Note Rate.'
	),
	
	'pre_pay' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select Pre-pay.'
	),
        'loan_term' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter loan term.'
	),
	'trans_type' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select Transaction Type.'
	),
	
	'purchase_price' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter Purchase Price.'
	),
    
	'entitlement_todate' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select Entitlements To Date.'
	),
	
	'cost_to_date' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter Total Cost To Date.'
	),
        'req_loan_amount' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter Requested Loan Amount.'
	),
	'ltv' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter ltv.'
	),
	'property_type' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter Property Type.'
	),
);
	
}

?>
