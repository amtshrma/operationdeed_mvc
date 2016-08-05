<?php    
class Message extends AppModel {
    var $name = 'Message';
    public $validate = array(
        'receiver' => array(
            'rule'    => 'notEmpty',
            'message' => 'Please select receiver'
        ),
        'subject' => array(
            'rule'    => 'notEmpty',
            'message' => 'Please enter subject'
        ),
        'message' => array(
            'rule'    => 'notEmpty',
            'message' => 'Please enter message'
        )
    );	
}
?>
