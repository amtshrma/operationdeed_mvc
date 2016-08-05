<?php
/*
* Tests Controller class
* Functionality -  Manage the data
* Created date - 8-Jul-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility');

class TestsController extends AppController {
	
	var $uses = array('Commons', 'User', 'short_applications', 'LoanLog', 'Notification');
	var $components = array('Email','Cookie','Common','Paginator', 'CustomEmail', 'RequestHandler', 'Session');
	var $helpers = array('Common');
	
	public $paginate = array(
						'limit' => 10,
						'order' => array(
							'short_applications.id' => 'DESC'
						)
					);
	function beforeFilter(){
		//$allow = array();
		//parent::beforeFilter();
		//$this->checkUserSession($allow);
	}
	
	/*
	* soft_quote function
	* Functionality -  save soft_quote functionality
	* Created date - 25-Jun-2015
	* Modified date - 
	*/
	
	public function ask_document($shortAppId = null, $loanID = null) {
		
		$this->loadModel('AskDocument');
		$this->loadModel('LoanLog');
		$this->loadAllModel(array('ShortApplication','Notification','LoanDocument'));
		$this->layout = 'common';
		$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => base64_decode($shortAppId))));
		if(isset($this->request->data) && !empty($this->request->data)){ pr($this->request->data); die();
			
			$document = $this->request->data['document'];
			$check_doc = array();
			foreach($document as $doc){
				if($doc != '0'){
					$check_doc[] = $doc;
				}
			} 
			$document_check = json_encode($check_doc);
			$shortappId = base64_decode($this->request->data['shortappId']);
			$loanID = base64_decode($this->request->data['$loanID']);
			$userData  = $this->Session->read('userInfo');
			$this->request->data['AskDocument']['short_app_id'] = $shortappId;
			$this->request->data['AskDocument']['loan_id'] = $loanID;
			$this->request->data['AskDocument']['document'] = $document_check;
			$this->request->data['AskDocument']['loan_officer_id'] =$userData['id'];
			$total_record=$this->AskDocument->find('count',array('conditions'=>array('AskDocument.short_app_id'=>$shortappId, 'AskDocument.short_app_id'=>$loanID)));
			
			if($total_record>0){ 
			
				$askdocumentinfo1=$this->AskDocument->find('first',array('conditions'=>array('AskDocument.short_app_id' => $shortappId),'fields'=>array('AskDocument.document')));
				
				$documents = json_decode($askdocumentinfo1['AskDocument']['document']);
				$document = $this->request->data['document'];
				$check_doc = array();
				foreach($document as $doc){
					if($doc != '0'){
						$check_doc[] = $doc;
					}
				}
				$total_documents = array_merge($documents, $check_doc);
				$doc1 = json_encode($total_documents);
			   
				 $this->request->data['LoanLog']=array(
					'short_application_ID' => $shortappId,
					'action' => 'Document attached asked by '.$userData['id'],
					'description' => $doc1
					);
				  $this->LoanLog->save($this->request->data['LoanLog']);
				  $this->AskDocument->updateAll(array('document' =>"'".$doc1."'"), array('short_app_id' => $shortappId));
					//Save notification for Processor Check-List Documents Requested to Sales Manager, Sales Director, Loan Officer
					$action = 'Processor Check-List Documents Requested';
					$senderID = $userData['id'];
					$actionID = $shortappId;
					$this->saveNotifications($action, $senderID, $actionID);
					
				  //Save notification for Processor Check-List Documents Requested to borrower
		
					$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
					$notificationData['Notification']['sender_id'] = $userData['id'];
					$notificationData['Notification']['action'] = 'Processor Check-List Documents Requested';
					$notificationData['Notification']['action_id'] = $shortappId;
					$this->Notification->save($notificationData);
					
					$this->redirect(array('controller'=>'commons','action' => 'loan'));
			}else {
				
				$this->request->data['LoanLog']=array(
					'short_application_ID'=>$shortappId,
					'action'=>'Document attached asked by '.$userData['id'],
					'description'=>$document_check
					);
				$this->LoanLog->save($this->request->data['LoanLog']);
				//Save notification for Processor Check-List Documents Requested to Sales Manager, Sales Director, Loan Officer
				$action = 'Processor Check-List Documents Requested';
				$senderID = $userData['id'];
				$actionID = $shortappId;
				$this->saveNotifications($action, $senderID, $actionID);
				
			  //Save notification for Processor Check-List Documents Requested to borrower
				
				$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
				$notificationData['Notification']['sender_id'] = $userData['id'];
				$notificationData['Notification']['action'] = 'Processor Check-List Documents Requested';
				$notificationData['Notification']['action_id'] = $shortappId;
				$this->Notification->save($notificationData);
				
				$this->AskDocument->create();
				if($this->AskDocument->save($this->request->data['AskDocument'])){
					$this->redirect(array('controller'=>'commons','action' => 'loan'));
				}
			}
		}
		
		$this->loadModel('Checklist');
		$propertyType  = $data['ShortApplication']['property_type'];
		$loanType  = $data['ShortApplication']['loan_type'];
		$propertyDocuments = $this->Checklist->find('all',array('conditions'=>array('type'=>$propertyType)));
		$loanDocuments = $this->LoanDocument->find('all',array('conditions'=>array('loan_type'=>$loanType)));
		
		$askdocumentinfo = $this->AskDocument->find('first',array('conditions'=>array('AskDocument.short_app_id' => base64_decode($shortAppId)),'fields'=>array('AskDocument.document')));
		$this->set(compact(array('askdocumentinfo','shortAppId','propertyDocuments','loanDocuments','loanID')));
	}
	
	/**
	* Summary :- test
	* Description : Test function for OTD API
	* 
	*/
	
	public function register() { //register api test.
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$fields = array('Manish', 'Singh', 'manishksmd@gmail.com', 'manish', '5');
		
		$arr = $obj->registration($fields);
		//pr($arr);
		//echo '<br><br><br>';die('stop');
	}
	
	public function login() { //login api test.
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$fields = array('manishksmd@gmail.com', 'manish', '5');		
		$arr = $obj->login($fields);
		
		//pr($arr);
		//echo '<br><br><br>';die('stop');
	}
	
	public function shortapp() { //short app api test.
		
		$this->autoRender = false;
		
		App::import('Vendor', 'OtdRestApi');
		$obj = new OtdRestApi();
		
		$fields = array('manishksmd@gmail.com', 'manish', '5');		
		$arr = $obj->shortApp($fields);
		
		//pr($arr);
		//echo '<br><br><br>';die('stop');
	}
	public function test() {
				$this->layout = 'ajax';
				if( isset( $this->data['MailchimpSubscriber']['emailaddress'] ) && $this->data['MailchimpSubscriber']['emailaddress'] != null ) {
				$email = $this->data['MailchimpSubscriber']['emailaddress'];
				} else {
					$this->set( 'email', '' );
				}
		 
				//if the page is posted
				if( !empty( $this->data )  ) {
					//lazy load the model to not do any unused http calls
					$this->loadModel( 'MailchimpSubscriber' );
					//load the data to ...
					$this->MailchimpSubscriber->set( $this->data );
					//check to see if the data validates
					if( $this->MailchimpSubscriber->validates() ) {
						//save the data
						if( $this->MailchimpSubscriber->save( $this->data) ) {
							$this->set( 'success', true );
						} else {
							//some error occured in the saving of the data
							//do a request to see if the email adres already exists
							$check = $this->MailchimpSubscriber->find( 'all', array( 'conditions' => array( 'emailaddress' => $this->data['MailchimpSubscriber']['emailaddress'])) );
							//if the email address exists in the mailchimp db
							if ( isset($check['email']) ) {
								//flash msg here
								$this->set( 'already_subscribed', true );
							} else {
								//some other error occured at the mailchimp side
								$this->set( 'unknown_error', true );
							}
						}
					}
				}
				
		}
		
		
	function getPropertyHistory(){ 
        $client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => '3D7B085B-1152-4B4D-896C-D08868658C0B',
								   'T365ID'  => 'DD17CF2E-8208-4665-9873-B1CF08C1933E',
								   'SubjectPropertyCity' => 'Alpine',
									'SubjectPropertyState' => 'AZ',
									'SubjectPropertyStreetAddress' => "42694 Highway 180"
					)
        );
        pr($request);  
        $reponse  = $client->GetPropertyHistory($request);
        echo "<h2>Response</h2>";   
        pr($reponse);
        die;
    }
	
	
	function  getPlatMaps(){ 
        $client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => '3D7B085B-1152-4B4D-896C-D08868658C0B',
								   'T365ID'  => 'DD17CF2E-8208-4665-9873-B1CF08C1933E',
								   'SubjectPropertyCity' => 'Alpine',
									'SubjectPropertyState' => 'AZ',
									'SubjectPropertyStreetAddress' => "42694 Highway 180"
					)
        );
        pr($request);  
        $reponse  = $client->GetPlatMaps($request);
        echo "<h2>Response</h2>";   
        pr($reponse);
        die;
    }
	
	
	function getSalesComparables(){ 
        $this->loadModel('PropertyComparable');
		$client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => '3D7B085B-1152-4B4D-896C-D08868658C0B',
									'T365ID'  => 'DD17CF2E-8208-4665-9873-B1CF08C1933E',
									'SubjectPropertyCity' => 'Concho',
									'SubjectPropertyState' => 'AZ',
									'SubjectPropertyStreetAddress' => "141 Cr 8209",
									'SalePriceMax' => '',
									'SalePriceMin' => '',
                                    'SearchRadiusInMiles' => '5'
					)
        );
        pr($request);  
        $reponse  = $client->getSalesComparables($request);
		pr($reponse);die;
		foreach($reponse->GetSalesComparablesResult->SalesComparables->SalesComparable as $key=>$val){
			$val->short_application_id = '12';
			$this->PropertyComparable->save($val);
			$this->PropertyComparable->create();
		}
		die('done');
    }
	
	function searchProperties(){ 
        $client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => '3D7B085B-1152-4B4D-896C-D08868658C0B',
								   'T365ID'  => 'DD17CF2E-8208-4665-9873-B1CF08C1933E',
								   'City' => 'Bisbee',
									'State' => 'AZ',
									'StreetAddress' => "238 W Purdy Ln",
									"ZipCode" =>'85603'
					)
        );
        pr($request);  
        $reponse  = $client->searchProperties($request);
        echo "<h2>Response</h2>";   
        pr($reponse);
        die;
    }
	
	function getPropertyDetail(){ 
        $client = new SoapClient('https://testapi.title365.com/PropertyData.svc?singleWsdl');
		$request = array('Request'=>array(
									'ClientSystemID' => '3D7B085B-1152-4B4D-896C-D08868658C0B',
								   'T365ID'  => 'DD17CF2E-8208-4665-9873-B1CF08C1933E',
								   'City' => 'Bisbee',
									'State' => 'AZ',
									'StreetAddress' => "238 W Purdy Ln",
									"ZipCode" =>'85603'
					)
        );
        pr($request);  
        $reponse  = $client->GetPropertyDetail($request);
        echo "<h2>Response</h2>";   
        pr($reponse);
        die;
    }
	
	function AVM(){ 
	   $URL = "https://test.pitchpointsolutions.com/riskinsight-services-
ws/resources/sami/001/0000000000000009862 HTTP/1.1";
	   $request = '<Sami></Sami>';
		$ch = curl_init($URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=='));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		echo $output; die();
		curl_close($ch);
		$xml = simplexml_load_string($output);
		echo json_encode($xml);
		die;
    }
	
	function cobrandLogin(){
		$this->autoRender = false;
		require WWW_ROOT.'yoodle/src/restclient.class.php';
		$URL = "https://rest.developer.yodlee.com/services/srest/restserver/v1.0/";
		$config = array(
					"cobrandLogin"   => 'sbCobsamit.sdei',
					"cobrandPassword"=> 'f40e7e41-67ae-472c-a354-40c496183f10'
				);
		$coblogin_response   = Yodlee\restClient::Post($URL.'authenticate/coblogin', $config);
		echo '<b>Cobrand Login Response</b>';
		pr($coblogin_response);
		// user login
		$config = array(
					"login" => 'sbMemsamit.sdei1',
					"password" => 'sbMemsamit.sdei1#123',
					"cobSessionToken" => $coblogin_response['Body']->cobrandConversationCredentials->sessionToken
				);
		$userlogin_response   = Yodlee\restClient::Post($URL.'authenticate/login', $config);
		echo '<b>Login Response</b>';
		pr($userlogin_response);
		// search site
		$config = array(
					"cobSessionToken" => $coblogin_response['Body']->cobrandConversationCredentials->sessionToken,
					"userSessionToken" => $userlogin_response['Body']->userContext->conversationCredentials->sessionToken,
					"siteSearchString" => 'Bank Of America'
				);
		$sitesearch_response   = Yodlee\restClient::Post($URL.'jsonsdk/SiteTraversal/searchSite', $config);
		echo '<b>Search Site</b>';
		pr($sitesearch_response);
    }
}
?>