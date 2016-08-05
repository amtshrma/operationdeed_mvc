<?php
/**
 * Summary
 */

class VideoTutorial extends AppModel {
    var $name = 'VideoTutorial';
	public $validate = array(
        'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter title',
				'last' => true,
			),
			'unique' => array(
				'rule'    => 'titleUnique',
			    'message' => 'This title already has been posted.',
			    'last'=>true
			)
		),
		'video_url' => array(
            'rule'    => 'url',
            'message' => 'Please enter url'
        )
    );
	
	/**
	* @Date:Sep 9, 2015
	* @Method : titleUnique
	* Created By: Amit Sharma
	* @Purpose: get unique content
	* @Param: none
	* @Return: none 
	**/
	
	function titleUnique(){
		if(!empty($this->data['Video']['id'])){
			$data = $this->findByTitle($this->data['VideoTutorial']['title']);
			if(count($data)){
				if($data['VideoTutorial']['id'] == $this->data['VideoTutorial']['id']){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			$data = $this->findByTitle($this->data['VideoTutorial']['title']);
			if($data){
				return false;
			}else{
				return true;
			}
		}
	}
}
?>
