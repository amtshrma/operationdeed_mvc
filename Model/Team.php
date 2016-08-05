<?php    
class Team extends AppModel {

    var $name = 'Team';
    public $actsAs = array('Containable');
    var $hasMany= array(
			   'TeamMember' => array(
				'className' => 'TeamMember',
				'foreignKey' => 'team_id'
			   )
			);
	public $validate = array(
		'team_funder' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter team name'
			),
			'isUnique' => array(
				'rule' => 'uniqueTeamName',
				'message' => 'Team name already exist',
			)
		)
	);
	
	/**
	 * Description:- Team Unique
	 * @var object :- NULL
	 */
	
	function uniqueTeamName(){
		if(!empty($this->data['Team']['id'])){
			$data = $this->find('first',array('conditions'=>array('team_funder' => $this->data['Team']['team_funder'],'funder_id' => $this->data['Team']['funder_id'])));
			if(count($data)){
				if($data['Team']['id'] == $this->data['Team']['id']){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			$data = $this->find('first',array('conditions'=>array('team_funder' => $this->data['Team']['team_funder'],'funder_id' => $this->data['Team']['funder_id'])));
			if($data){
				return false;
			}else{
				return true;
			}
		}
	}
}
?>