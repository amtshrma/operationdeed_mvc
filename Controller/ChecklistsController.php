<?php
/*
* Checking Controller class
* Functionality -  Manage the Messages
* Created date - 3-Aug-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 

class ChecklistsController extends AppController {

	var $name = 'Checklists';
    public $useTable = 'checklists';
	var $components = array('Email','Cookie','Common','Paginator');

	public $paginate = array(
						'limit' => PAGINATION_LIMIT,
						'order' => array(
							'Checklist.id' => 'DESC'
						)
					);

	function beforeFilter() {
		
		$allow = array();
		parent::beforeFilter();		
	}
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 3-Aug-2015
	* Modified date - 
	*/
	
	public function index() {
		
    }
	
    /*
	* processor function
	* Functionality -  processor functionality
	* Created date - 3-Aug-2015
	* Modified date - 
	*/
	
	public function processor() {
		
        $this->layout = 'common';
    }	
	
	/*
	* index function
	* Functionality -  index functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function admin_index() {
		
		$this->layout = 'admin';
		$this->getPropertyTypes();
		$this->loadAllModel(array('Checklist'));
		$this->paginate['conditions'] = array('Checklist.user_id' => '1');
		$this->Paginator->settings = $this->paginate;
		$getData =  $this->Paginator->paginate('Checklist'); 
		$this->set('getData',$getData);		
	}
	
	/*
	* add function
	* Functionality -  add  Checklist
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add($id = null) {
		$this->layout = 'admin';
		$this->getPropertyTypes();
		$this->loadModel('Checklist');
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->request->data['Checklist']['id'] = base64_decode($this->request->data['Checklist']['id']);
			$this->Checklist->set($this->request->data['Checklist']);
			if($this->Checklist->validates()) { die('adsa');
				$valid  = array('docx','pdf');
				$str = explode('/',$this->request->data['Checklist']['document']['type']);
				if(isset($this->request->data['Checklist']['document']['name']) && !empty($this->request->data['Checklist']['document']['name'])) {					
					if($this->request->data['Checklist']['document']['error']!=0) {
						$this->Session->setFlash('You can only upload docx, pdf files!!', 'error');
						$flag = 'false';
					} else if(!in_array($str[1], $valid)) {
						$this->Session->setFlash('You can only upload docx, pdf files!!', 'error');
						$flag = false;
					} else if($this->request->data['Checklist']['document']['size'] > 2000000) {
						$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
						$flag = false;
					} else {
						$name = $this->Common->sanitize_document_name($this->request->data['Checklist']['document']['name']);
						$file_path = WWW_ROOT."upload/".$name;
						$oldDocument = $this->request->data['Checklist']['old_document'];
						if(file_exists(WWW_ROOT.'upload/'.$oldDocument) && !empty($oldDocument)) {
							unlink(WWW_ROOT.'upload/'.$oldDocument);
						}
						if(move_uploaded_file($this->request->data['Checklist']['document']['tmp_name'], $file_path)) {
							$data['Checklist']['checklistname'] = $this->request->data['Checklist']['checklistname'];
							$data['Checklist']['value'] = $name;
							$data['Checklist']['id'] = $this->request->data['Checklist']['id'];
							$data['Checklist']['type'] = $this->request->data['Checklist']['property_type'];
							$data['Checklist']['download_form'] = 1;
						}	
					}
				}else {
					$data['Checklist']['checklistname'] = $this->request->data['Checklist']['checklistname'];
					$data['Checklist']['id'] = $this->request->data['Checklist']['id'];
					$data['Checklist']['type'] = $this->request->data['Checklist']['property_type'];
					$data['Checklist']['download_form'] = 0;
				}
				$msz= "Document added sucessfully.";
				if($this->Checklist->save($data)) {
					$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
					$this->redirect(array('action' => 'index'));
				}
			}
		}else{
			$this->request->data = $this->Checklist->read(null, base64_decode($id));
		}
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
	/*
	* loan documents function
	* Functionality -  loan_documents functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function admin_loan_document() {
		
		$this->layout = 'admin';
		$this->getLoanTypes();
		$this->loadAllModel(array('LoanDocument'));
		//$criteria = '';
		$this->paginate['conditions'] = array('user_id' => '1');
		$this->Paginator->settings = $this->paginate;
		$getData =  $this->Paginator->paginate('LoanDocument'); 
		$this->set('getData',$getData);		
	}
	
	/*
	* add function
	* Functionality -  add  Loan Document
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add_loan_document($id = null) {
		
		$this->layout = 'admin';
		$this->getLoanTypes();
		$this->loadAllModel(array('LoanDocument'));
		
		if(isset($this->request->data) && !empty($this->request->data)){
			
			$this->request->data['LoanDocument']['id'] = base64_decode($this->request->data['LoanDocument']['id']);			
			$valid  = array('docx','pdf');
			$str = explode('/',$this->request->data['LoanDocument']['document']['type']);
			
			if(isset($this->request->data['LoanDocument']['document']['name']) && !empty($this->request->data['LoanDocument']['document']['name'])) {
				
				if($this->request->data['LoanDocument']['document']['error']!= 0) {
					
					$this->Session->setFlash('You can only upload docx, pdf files!!', 'error');
					$flag = 'false';
				}  else if($this->request->data['LoanDocument']['document']['size'] > 2000000) {
					
					$this->Session->setFlash('The file size must be Max 2MB!!', 'error');
					$flag = false;
				} else {
					
					$name = $this->Common->sanitize_document_name($this->request->data['LoanDocument']['document']['name']);
					$file_path = WWW_ROOT."document/".$name;
					$oldDocument = $this->request->data['LoanDocument']['old_document'];
					
					if(file_exists(WWW_ROOT.'document/'.$oldDocument) && !empty($oldDocument)) {
						
						unlink(WWW_ROOT.'document/'.$oldDocument);
					}
					
					if(move_uploaded_file($this->request->data['LoanDocument']['document']['tmp_name'], $file_path)) { 
						$data['LoanDocument']['checklistname'] = $this->request->data['LoanDocument']['checklistname'];
						$data['LoanDocument']['name'] = $name;
						$data['LoanDocument']['id'] = $this->request->data['LoanDocument']['id'];
						$data['LoanDocument']['loan_type'] = $this->request->data['LoanDocument']['loan_type'];
						$data['LoanDocument']['download_form'] = 1;
					}	
				}
			}else {
				
				$data['LoanDocument']['checklistname'] = $this->request->data['LoanDocument']['checklistname'];
				$data['LoanDocument']['id'] = $this->request->data['LoanDocument']['id'];
				$data['LoanDocument']['loan_type'] = $this->request->data['LoanDocument']['loan_type'];
				$data['LoanDocument']['download_form'] = 0;
			}
			
			$msz= "Document added sucessfully.";
			
			if($this->LoanDocument->save($data)) {
				
				$this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
				$this->redirect(array('controller'=>'checklists','action' => 'loan_document'));
			}
			
		}
		
		$this->request->data = $this->LoanDocument->read(null, base64_decode($id));
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}        
}     