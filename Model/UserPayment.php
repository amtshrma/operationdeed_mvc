<?php    
class UserPayment extends AppModel {
    var $name = 'UserPayment';
    public $belongsTo = array('User','Loan');
}
?>
