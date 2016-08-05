<?php
/*
* EmailTemplates Controller class
* Functionality -  Manage EmailTemplate
* Created date - 6-Jul-2015
*/

App::uses('Sanitize', 'Utility');
class EmailTemplatesController extends AppController {
		
	var $name = 'EmailTemplates';        
	var $components = array('Email','Cookie','Common','Paginator');

	public $paginate = array(
						'limit' => 20,
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
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	public function admin_index() {
		$this->layout = 'admin';
		$this->loadAllModel(array('EmailTemplates'));
		$value ="";
		$criteria = '';
		$criteria .= "EmailTemplate.template_type='email'";
		if(!empty($this->params)) {
			if(!empty($this->params->query['name']) && isset($this->params->query['name'])) {
				$value = trim($this->params->query['name']);
				//$criteria .= " EmailTemplate.template_type = 'email'";
				$criteria .= " AND EmailTemplate.name LIKE '%".$value."%' ";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->paginate['order'] = 'EmailTemplate.id DESC';
		$this->Paginator->settings	= $this->paginate;		
		$getData =  $this->Paginator->paginate('EmailTemplate');
		$this->set('getData',$getData);
	}
	
    /*
	* add function
	* Functionality -  add  email template functionality
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add($id = null) {	
		$this->layout = 'admin';
		if(isset($this->request->data) && !empty($this->request->data)) {		
			$this->request->data['EmailTemplate']['id'] = base64_decode($this->request->data['EmailTemplate']['id']);	
			$this->EmailTemplate->set($this->request->data['EmailTemplate']);
			if($this->EmailTemplate->validates()) {	
				if($id) {			
					$msz= "Email Template updated sucessfully.";
				} else {			
					$tempCode =  str_replace(' ', '_', $this->request->data['EmailTemplate']['name']);
					$templateCode = strtolower($tempCode);
					$this->request->data['EmailTemplate']['template_type'] = 'email';
					$this->request->data['EmailTemplate']['template_code'] = $templateCode;
					$msz= "Email Template saved sucessfully.";
				}
				if($this->EmailTemplate->save($this->request->data['EmailTemplate'])) {		
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
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	public function admin_loan_doc() {
		$this->layout = 'admin';
		$this->loadAllModel(array('EmailTemplates'));
		$value ="";
		$criteria = '';
		$criteria .= "EmailTemplate.template_type='loan_doc'";
		if(!empty($this->params)) {
			if(!empty($this->params->query['name']) && isset($this->params->query['name'])) {
				$value = trim($this->params->query['name']);
				//$criteria .= " EmailTemplate.template_type = 'email'";
				$criteria .= " AND EmailTemplate.name LIKE '%".$value."%' ";
			}
		}
		$this->paginate['conditions'] = array($criteria);
		$this->paginate['order'] = 'EmailTemplate.id DESC';
		$this->Paginator->settings	= $this->paginate;		
		$getData =  $this->Paginator->paginate('EmailTemplate');
		$this->set('getData',$getData);
	}
	
	  /*
	* add function
	* Functionality -  add  email template functionality
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add_doc($id = null) {	
		$this->layout = 'admin';
		if(isset($this->request->data) && !empty($this->request->data)) {		
			$this->request->data['EmailTemplate']['id'] = base64_decode($this->request->data['EmailTemplate']['id']);	
			$this->EmailTemplate->set($this->request->data['EmailTemplate']);
			if($this->EmailTemplate->validates()) {	
				if($id) {			
					$msz= "Loan Doc Template updated sucessfully.";
				} else {			
					$tempCode =  str_replace(' ', '_', $this->request->data['EmailTemplate']['name']);
					$templateCode = strtolower($tempCode);
					$this->request->data['EmailTemplate']['template_type'] = 'loan_doc';
					$this->request->data['EmailTemplate']['template_code'] = $templateCode;
					$msz= "Loan Doc Template saved sucessfully.";
				}
				if($this->EmailTemplate->save($this->request->data['EmailTemplate'])) {		
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('controller'=>'email_templates','action' => 'loan_doc','admin'=>true));
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