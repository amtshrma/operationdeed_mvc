<?php

/**
 * Summary : City
 */

class City extends AppModel {
    var $name = 'City';
	public $validate = array(
        'city' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter city name',
				'last' => true,
			),
			'unique' => array(
				'rule'    => 'cityUnique',
			    'message' => 'This city already has been added.',
			    'last'=>true
			)
        ),
        /*'state_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select State',
			)
        )*/
    );
    
	/**
	* @Date:Sep 9, 2015
	* @Method : cityUnique
	* Created By: Amit Sharma
	* @Purpose: get cityUnique content
	* @Param: none
	* @Return: none 
	**/
	
	function cityUnique(){
		if(!empty($this->data['City']['id'])){
			$data = $this->find('first',array('conditions'=>array('city' => $this->data['City']['city'],'state_id' => $this->data['City']['state_id'])));
            if(count($data)){
				if($data['City']['id'] == $this->data['City']['id']){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			$data = $this->findByName($this->data['City']['city']);
			if($data){
				return false;
			}else{
				return true;
			}
		}
	}
}

?>