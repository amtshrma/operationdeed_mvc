<?php
/*
* Checking Controller class
* Functionality -  Manage the Documents
* Created date - 3-Aug-2015
* Modified date - 
*/

App::uses('Sanitize', 'Utility'); 

class DocumentsController extends AppController {

	var $name = 'Documents';
	var $components = array('Email','Cookie','Common','Paginator');

	public $paginate = array(
						'limit' => 10,
						'order' => array(
							'documents.id' => 'DESC'
						)
					);

	function beforeFilter() {
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
	* index function
	* Functionality -  index functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function admin_index() {
		
		$this->layout = 'admin';
		$this->getDocumentType();
		$this->loadAllModel(array('Document'));
		//$criteria = '';
		//$this->paginate['conditions'] = array($criteria);
		$getData =  $this->Paginator->paginate('Document'); 
		$this->set('getData',$getData);		
	}
	
	/*
	* add function
	* Functionality -  add  Document
	* Created date - 6-Jul-2015
	* Modified date - 
	*/
	
	public function admin_add($id = null) {
		$this->layout = 'admin';
		$this->getDocumentType();
		$this->loadAllModel(array('Document'));
		if(isset($this->request->data) && !empty($this->request->data)) { //pr($this->request->data); 
			$this->request->data['Document']['id'] = base64_decode($this->request->data['Document']['id']);
			$template = '';
			if(isset($this->request->data['document_description'])){
				$template = $this->request->data['document_description'];
			}
            $str = explode('/',$this->request->data['Document']['document']['type']);
            if(isset($this->request->data['Document']['document']['name']) && !empty($this->request->data['Document']['document']['name'])) {
                if($this->request->data['Document']['document']['error']!=0) {
                    
                    $this->Session->setFlash('You can only upload docx, pdf files!!', 'error');
                    $flag = 'false';
                } else if($this->request->data['Document']['document']['size'] > 2000000) {
                    
                    $this->Session->setFlash('The file size must be Max 2MB!!', 'error');
                    $flag = false;
                } else {
                    $name = $this->Common->sanitize_document_name($this->request->data['Document']['document']['name']);
                    $file_path = ADMIN_DOCUMENT.$name;
                    $oldDocument = $this->request->data['Document']['old_document'];
                    
                    if(file_exists(ADMIN_DOCUMENT.$oldDocument) && !empty($oldDocument)) {
                        
                        unlink(ADMIN_DOCUMENT.$oldDocument);
                    }
					
                    if(move_uploaded_file($this->request->data['Document']['document']['tmp_name'], $file_path)) {
                        $data['Document']['upload'] = $name;
                        $data['Document']['id'] = $this->request->data['Document']['id'];
                        $data['Document']['document_type'] = $this->request->data['Document']['document_type'];
						$data['Document']['user_type'] = implode(',',$this->request->data['Document']['user_type']);
                        $data['Document']['document_description'] = $template;
						$data['Document']['name'] = $this->request->data['Document']['document_name'];
                    }	
                }
            }else {
                $data['Document']['id'] = $this->request->data['Document']['id'];
                $data['Document']['document_type'] = $this->request->data['Document']['document_type'];
				$data['Document']['user_type'] = implode(',',$this->request->data['Document']['user_type']);
                $data['Document']['document_description'] = $template;
				$data['Document']['name'] = $this->request->data['Document']['document_name'];
            } //pr($data); die();
            $msz= "Document added sucessfully.";
            if($this->Document->save($data)) {
                
                $this->Session->setFlash($msz,'default',array('class'=>'alert alert-success'));	
                $this->redirect(array('action' => 'index'));
            }
		}
		$this->request->data = $this->Document->read(null, base64_decode($id));
		$textAction = ($id == null) ? 'Add' : 'Edit';
		$this->set('navitems','class = "active"');			
		$this->set('action',$textAction);			
		$this->set('breadcrumb','Users/'.$textAction);
		$buttonText = ($id == null) ? 'Save' : 'Update';	
		$this->set('buttonText',$buttonText);
	}
	
}     