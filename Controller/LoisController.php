<?php
/*
* Users Controller class
* Functionality -  Letter of Intent (LOI)
* Created date - 25-August-2015
* Created - Manish
*/

App::uses('Sanitize', 'Utility'); 

class LoisController extends AppController {

    var $uses = array('SoftQuote', 'EmailTemplate');
    var $components = array('Email','Cookie','Common','Paginator','CustomEmail');
    
    function beforeFilter(){
        $allow = array();
        parent::beforeFilter();
        $this->checkUserSession($allow);
    }
    
    /**
     *@create_loi function
     *@Functionality    : To Create Letter of Intent (LOI)
     *@Created date     :25Aug2015
     *@Modified date    :    
     */
    
    function create_loi($loiId = null) {
        
        $this->layout = 'common';
    }
    
    /**
     *@loi function
     *@Functionality    : To Create Letter of Intent (LOI) Pdf
     *@Created date     :25Aug2015
     *@Modified date    :    
     */
    
    function loi($loanId = null, $loiId = null) { 
        $this->layout = 'dashboard_common';
        $this->loadAllModel(array('SoftQuote','LoiCondition','CompanyTemplate','LoanLog','Loan','EmailTemplate','Loi','Notification','LoanLog','ShortApplication','LoanPhase','Todo'));
		$newLoans = $this->getLoanLifeCyclePhase(); 
        $shortAppId = $this->getShortAppID(base64_decode($loanId));
		$loanNumber = $this->Common->getLoanNumber(base64_decode($loanId));
        $userId = $this->Session->read('userInfo.id');
        $userData  = $this->Session->read('userInfo'); 
	$userName = $userData['first_name']. ' '. $userData['last_name'];
        $pdfTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.template_code LIKE' => 'pdf_loi')));
        $this->set('pdfTemplate', $pdfTemplate);
        $letterOfIntentPdf = '';
        // Pdf data
        $softQuoteDetail = $this->SoftQuote->find('first', array('conditions'=>array('SoftQuote.short_application_Id'=>$shortAppId)));
		$propertyDetail = $this->ShortApplication->find('first',array('conditions'=>array('PropertyDetail.short_application_id'=>$shortAppId),'fields'=>array('PropertyDetail.Baths','ShortApplication.loan_amount', 'PropertyDetail.Rooms','PropertyDetail.Beds','ShortApplication.property_address','PropertyDetail.Units','PropertyDetail.YearBuilt','PropertyDetail.SqFtLot', 'PropertyDetail.SqFtStruc', 'ShortApplication.company_select','ShortApplication.loan_to_value', 'ShortApplication.property_city','ShortApplication.property_state', 'ShortApplication.loan_objective','ShortApplication.property_city', 'ShortApplication.applicant_first_name', 'ShortApplication.applicant_last_name')));
		$this->set('softQuoteDetail', $softQuoteDetail);
		$this->set('propertyDetail',$propertyDetail);	
		$loiCondition = $this->LoiCondition->find('all', array('conditions'=>array('LoiCondition.short_app_id'=>$shortAppId,'LoiCondition.loan_id'=>base64_decode($loanId))));
		$this->set('loiCondition', $loiCondition);
		$this->set('loanId', $loanId);
		$letterOfIntentPdf = $this->Loi->find('first', array('conditions'=>array('Loi.loan_id'=>base64_decode($loanId))));
		//pr($letterOfIntentPdf);
		$this->set('letterOfIntentPdf', $letterOfIntentPdf);
		$templateHeader = $this->CompanyTemplate->find('first');
		$this->set('templateHeader', $templateHeader);
		$loanDetail = $this->Loan->find('first', array('conditions'=>array('Loan.id'=>base64_decode($loanId)),'fields'=>array('Loan.id')));
		$this->set('loanDetail', $loanDetail);
		
		$save['LoiCondition']['loan_id'] = base64_decode($loanId);
		$save['LoiCondition']['short_app_id'] = $shortAppId;
		$save['LoiCondition']['user_id'] = $userId;		
		$loiId = base64_decode($loiId);
		if(isset($this->request->data['LoiCondition']) && !empty($this->request->data['LoiCondition'])) {   //pr($this->request->data['LoiCondition']);
		foreach($this->request->data['LoiCondition']['condition'] as $key => $condition) { //pr($condition);
			if(isset($condition) && !empty($condition)) {
				if(isset($this->request->data['LoiCondition']['id'][$key]) && $this->request->data['LoiCondition']['id'][$key] != '') {
					$save['LoiCondition']['id'] = base64_decode($this->request->data['LoiCondition']['id'][$key]);	
					}else {
						$save['LoiCondition']['id'] = '';
					}
					$save['LoiCondition']['condition'] = $condition;
					//pr($save);
					$this->LoiCondition->create();
					$this->LoiCondition->save($save);
				}
			}
			$logData['LoanLog']['user_id'] = $userId;
			$logData['LoanLog']['short_application_ID'] = $shortAppId;
			$logData['LoanLog']['action'] = 9;
			$logData['LoanLog']['description'] = 'Letter Of Intent condition added by '.$userName;
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			//save PDF to directory
			$pdfName = 'LetterOfIntent_'.$loanId.'.pdf';
			$loi['Loi']['pdf_name'] = $pdfName;
			$loi['Loi']['loan_id'] = base64_decode($loanId);
			$loi['Loi']['user_id'] = $userId;
			$this->Loi->save($loi);
			$loiID = $this->Loi->id; 
			$this->layout = '/pdf/default';
            $this->render('/Pdf/loi');
			//fly by publish
			$templateHeader = $this->CompanyTemplate->find('first');
			$loanID = base64_decode($loanId);
			$action = $loanNumber .' - '. $newLoans['9'];
			$this->Common->saveNotifications($action, $userId, $loanID);
			//save to do for processor
			$processorId = $this->Common->getTeamMember($this->Session->read('userInfo.id'), 5);
			if(!empty($processorId)) {
				$notificationData['Notification']['receiver_id'] = $processorId;
                $notificationData['Notification']['sender_id'] = $userId;
                $notificationData['Notification']['action'] = $action . ' <a href="'.BASE_URL.'processors/review/'.base64_encode($loanID).'"> Click to review</a> and submit to further process loan';
                $notificationData['Notification']['action_id'] = $loanID;
                $notificationData['Notification']['type'] = 2;
                $notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
                //pr($notificationData);
                $this->Notification->create();
                $this->Notification->save($notificationData);
			}
			//save loan log
			$logData['LoanLog']['user_id'] = $userId;
			$logData['LoanLog']['short_application_ID'] = $shortAppId;
			$logData['LoanLog']['action'] = 9;
			$logData['LoanLog']['description'] = 'Letter of Intent (LOI) Flyby published by '.$userName. '<br/>'.'<a href="/app/webroot/files/pdf/LetterOfIntent/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			//save Loan phase
			$loanPhaseData['LoanPhase']['loan_phase'] = 'C';
			$loanPhaseData['LoanPhase']['loan_id'] = base64_decode($loanId);
			$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;;
			$this->LoanPhase->save($loanPhaseData);
			
			//update loan_life_cycle_phase in loan table
			$loanCyclephase = 9;
			$this->Loan->id = base64_decode($loanId);
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			$this->Session->setFlash('Letter of Intent (LOI) - Flyby Published.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));
		} else {
			unset($this->request->data['LoiCondition']);
		}
		
		
		//Letter of Intent (LOI) - Final Published
		 if(!empty($loiId) && $loiId == 'final_publish') {
			$loanID = base64_decode($loanId);
			$action = $loanNumber .' - '.$newLoans['12'];
			$this->Common->saveNotifications($action, $userId, $loanID);
			//save loan log
			$logData['LoanLog']['user_id'] = $userId;
			$logData['LoanLog']['short_application_ID'] = $shortAppId;
			$logData['LoanLog']['action'] = 12;
			$logData['LoanLog']['description'] = $newLoans['12'] .'published by '.$userName. '<br/>'.'<a href="/app/webroot/files/pdf/LetterOfIntent/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			
			$shortAppDetail = $this->ShortApplication->find('first', array('conditions'=>array('ShortApplication.id'=>$shortAppId)));
			//pr($shortAppDetail);
			//save notification for borrower
			$toDo  = $loanNumber. ' - ' .$action. ' Check <a href="'.BASE_URL.'borrowers/borrowerLoans/">loan </a> to further process loan';
			$notification['Notification']['receiver_id'] = $shortAppDetail['ShortApplication']['borrower_ID'];
			$notification['Notification']['sender_id'] = $userId;
			$notification['Notification']['action'] = $toDo;
			$notification['Notification']['action_id'] = base64_decode($loanId);
			$notification['Notification']['type'] = 2;
			$notification['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notification);
			
			//update loan_life_cycle_phase in loan table
			$loanCyclephase = '12';
			$this->Loan->id = base64_decode($loanId);
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			
			//send email notification
			$email = $shortAppDetail['ShortApplication']['applicant_email_ID'];
			$userName = $shortAppDetail['ShortApplication']['applicant_first_name'] . ' ' . $shortAppDetail['ShortApplication']['applicant_last_name'];
			$this->CustomEmail->__sendLOIEmail($userName, $email, $loanId);
			$this->Session->setFlash('Letter of Intent (LOI) - Final Published.', 'default', array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'commons', 'action'=>'loan'));

			//$this->CustomEmail->__sendTrustDeedFlyerEmail('Manish', 'johnksmd@gmail.com');
           
		 }
    }
	/*
	* LOI condition_satisfied function
	* Functionality -  LOI condition_satisfied
	* Created date - 5-Oct-2015
	* Modified date - 
	*/
	function condition_satisfied() {
		$this->loadAllModel(array('LoanPhase','LoanLog','Notification','Loi','ShortApplication','LoanUser'));
		$this->layout = false;
		$this->autoRender = false;
		$userData  = $this->Session->read('userInfo');
		$newLoans = $this->getLoanLifeCyclePhase();
		if(!empty($this->request->data)) {
			$loanID = isset($this->request->data['loanID']) ? base64_decode($this->request->data['loanID']) : '';
			$loanStatus = $this->LoanPhase->find('first',array('conditions'=>array('LoanPhase.loan_id'=>$loanID, 'LoanPhase.loan_phase' => 'F')));
			if(empty($loanStatus)) {
				$loanPhaseData['LoanPhase']['loan_phase'] = 'F';
				$loanPhaseData['LoanPhase']['loan_id'] = $loanID;
				$loanPhaseData['LoanPhase']['created'] = CURRENT_DATE_TIME_DB;;
				$this->LoanPhase->save($loanPhaseData);
			}
			$shortAppID = $this->getShortAppID($loanID);
			$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
			$logData['LoanLog']['user_id'] = $userData['id'];
			$logData['LoanLog']['short_application_ID'] = $shortAppID;
			$logData['LoanLog']['action'] = 14;
			$logData['LoanLog']['description'] = 'Letter of Intent (LOI) - Conditions Satisfied.';
			$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
			$this->LoanLog->save($logData);
			$loanNumber = $this->Common->getLoanNumber($loanID);
			$action =  $loanNumber. ' - ' .$newLoans['14'];
			$this->Common->saveNotifications($action, $userData['id'], $loanID);
			//save notification for borrower
			$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
			$notificationData['Notification']['sender_id'] = $userData['id'];
			$notificationData['Notification']['action'] = $action;
			$notificationData['Notification']['action_id'] = $loanID;
			$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
			$this->Notification->create();
			$this->Notification->save($notificationData);
			//save funder Todo
			$funderDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanID,'user_type' => 6),'fields' =>array('LoanUser.user_id')));
			if(!empty($funderDetail)) {
				$toDo = $loanNumber . ' - '.$newLoans['14'] . ' Check <a href="'.BASE_URL.'commons/loan"> loan listing</a>';
				$notificationData['Notification']['receiver_id'] = $funderDetail['LoanUser']['user_id'];
				$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
				$notificationData['Notification']['action'] = $toDo;
				$notificationData['Notification']['action_id'] = $loanID;
				$notificationData['Notification']['type'] = 2;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				//pr($notificationData);
				$this->Notification->create();
				$this->Notification->save($notificationData);
			}
			
			
			$this->Loi->updateAll(array('condition_satisfied' =>1), array('loan_id' => $loanID));
			//update loan_life_cycle_phase in loan table
			
			$loanCyclephase = '14';
			$this->Loan->id = $loanID;
			$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
			$this->Session->setFlash('Letter of Intent (LOI) - Conditions Satisfied', 'default', array('class'=>'alert alert-success'));
			//$this->redirect(array('controller'=>'commons','action' => 'loan'));
		}
		die();
	}
}