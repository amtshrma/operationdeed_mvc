<?php    
class PhaseName extends AppModel {
    var $name = 'PhaseName';
   
    public $validate = array(
        'phase_name' => array(
            'rule'    => 'notEmpty',
            'message' => 'Enter Loan Phase Name'
        )
    );
}
?>
