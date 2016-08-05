<?php    
class SoftQuote extends AppModel {
var $name = 'SoftQuote';
public $belongsTo = 'ShortApplication';
public $validate = array(
	'loan_amount' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter loan amount.'
	),
	'lien_position' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select lien position.'
	),
	
	'interest_rate' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter interest rate.'
	),
    'loan_term' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter loan term.'
	),
	'loan_interest_only' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select interest only loan (y/n).'
	),
	
	'per_payment_interest' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter per payment interest.'
	),
    
	'financing_allowed' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select financing allowed (y/n).'
	),
	
	'business_days' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter business days.'
	),
    'origination_fee' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter origination fee.'
	),
	'processing_fee' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select processing fee.'
	),
	
);
	
}

?>
