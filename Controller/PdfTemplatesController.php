<?php
/*
* PdfTemplatesController Controller class
* Functionality -  Manage EmailTemplate
* Created date - 27Aug2015
*/

class PdfTemplatesController extends AppController {
	
	//var $name = 'EmailTemplates';
	var $uses = array('EmailTemplate');
	var $components = array('Email','Cookie','Common','Paginator');
	public $paginate = array(
						'limit' => 10,
						'order' => array(
							'EmailTemplates.id' => 'DESC'
						)
	);

	function beforeFilter() {
		
		parent::beforeFilter();
	}
	
    /*
	* index function
	* Functionality -  index functionality
	* Created date - 27Aug2015
	*/
    
	public function admin_index() {
		
		$this->layout = 'admin';
		$this->loadAllModel(array('EmailTemplate'));
		$value ="";
		
		$criteria = "EmailTemplate.template_type='pdf'";
		
		if(!empty($this->params)){ 
			if(!empty($this->params->query['name']) && isset($this->params->query['name'])){
				$value = trim($this->params->query['name']);
				$criteria .= " AND EmailTemplate.name LIKE '%".$value."%' ";
			}			
		}
		
		$this->paginate['conditions'] = array($criteria);
		
		$this->Paginator->settings	= $this->paginate;		
		$getData =  $this->Paginator->paginate('EmailTemplate');
		$this->set('getData',$getData);
	}
    
	/*
	* add function
	* Functionality -  add  email template functionality
	* Created date - 27Aug2015
	*/
	public function admin_add($id = null) { 
		$this->layout = 'admin';
		if(isset($this->request->data) && !empty($this->request->data)){ 
			$this->request->data['EmailTemplate']['id'] = base64_decode($this->request->data['EmailTemplate']['id']);	
			$this->EmailTemplate->set($this->request->data['EmailTemplate']);
			if($this->EmailTemplate->validates()) {
				if($id){
					$msz= "Pdf Template updated sucessfully.";
				} else {
					$tempCode =  str_replace(' ', '_', $this->request->data['EmailTemplate']['name']);
					$templateCode = strtolower($tempCode);
					$this->request->data['EmailTemplate']['template_type'] = 'pdf';
					$this->request->data['EmailTemplate']['template_code'] = $templateCode;
					$msz= "Pdf Template saved sucessfully.";
				}	
				if($this->EmailTemplate->save($this->request->data['EmailTemplate'])){
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$errors = $this->EmailTemplate->validationErrors; 
				$this->set('errors',$errors);
			}   
		}else {
			$this->request->data = $this->EmailTemplate->read(null, base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
}