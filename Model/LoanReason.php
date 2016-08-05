<?php    
class LoanReason extends AppModel {
    var $name = 'LoanReason';
   
    public $validate = array(
        'name' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter Loan Reason'
        ),
        'loan_value_max' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter Max Value'
        )
    );
}
?>
