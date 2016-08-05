<?php    
class Review extends AppModel {
var $name = 'Review';

public $validate = array(
	'NOD' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter NOD.'
	),
	'NTS' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter NTS.'
	),
	'financial_audited' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter financial audited.'
	),
	'position' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please select position.'
	),
	'interest_rate' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter interest rate.'
	),
	'beneficiary' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter beneficiary.'
	),
	'principal_balance' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter principal balance.'
	),
	'monthly_payment' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter principal balance.'
	),
	'maturity_date' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter maturity date.'
	),
	'fair_market_value' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter Fair Market Value.'
	),
	'escrow_officer_name' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter escrow officer email eddress.'
	),
	'escrow_email' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter escrow officer email address.'
	),
	'title_officer_name' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter Title Officer name.'
	),
    'title_officer_email' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter Title Officer Email Address.'
	)
);

}

?>
