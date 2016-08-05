<?php    
class Checklist extends AppModel {
var $name = 'Checklist';
public $validate = array(
	'checklistname' => array(
		'rule'    => 'notEmpty',
		'message' => 'Please enter document name.'
	),
	
);
   
	
}

?>
