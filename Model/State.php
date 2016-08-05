<?php
/**
 * Summary
 */

class State extends AppModel {
    var $name = 'State';
	public $validate = array(
        'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter state name',
				'last' => true,
			),
			'unique' => array(
				'rule'    => 'nameUnique',
			    'message' => 'This Name already has been added.',
			    'last'=>true
			)
        )
    );
	
	/**
	* @Date:Sep 9, 2015
	* @Method : nameUnique
	* Created By: Amit Sharma
	* @Purpose: get unique content
	* @Param: none
	* @Return: none 
	**/
	
	function nameUnique(){
		if(!empty($this->data['State']['id'])){
			$data = $this->findByName($this->data['State']['name']);
			if(count($data)){
				if($data['State']['id'] == $this->data['State']['id']){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			$data = $this->findByName($this->data['State']['name']);
			if($data){
				return false;
			}else{
				return true;
			}
		}
	}
}
?>
