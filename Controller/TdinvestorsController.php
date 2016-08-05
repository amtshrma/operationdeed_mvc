<?php
/*
* TdInvestorsController class
* Functionality -  Manage the Users (Investors)
* Created date - 12-Oct-2015
* Modified date - 
*/
App::uses('Sanitize', 'Utility');

class TdinvestorsController extends AppController {
	
	var $name = 'TdInvestors';
    var $uses = array('LoanLog', 'Notification');
	//public $useTable = 'users';
	var $components = array('Email','Cookie','Common','Paginator','CustomEmail');
	public $paginate = array();
	
	function beforeFilter() {
		
		$allow = array();
		parent::beforeFilter();    
		$this->checkUserSession($allow);
	}  
    
    /*
	* dashboard function
	* Functionality - Tdinvestors dashboard functionality
	* Created date - 12-Oct-2015
	* Modified date - 
	*/
	
	public function dashboard() {
		
        $this->layout = 'common';        
    }
	
	/**
	* view_short_app function
	* Functionality -  Trust Deed Investment Hold Requested
	* Created date - 06-Oct-2015
	* Modified date - 
	*/
   
	function td_inv_holdreq($loanID = null) {
		$newLoans = $this->getLoanLifeCyclePhase();
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('LoanHoldRequest','CounterOffer','ShortApplication','User','LoanPhase','LoanUser'));
		$userId = $this->Session->read('userInfo.id');
		if(!empty($loanID)) {
			$loanId = base64_decode(base64_decode($loanID));
		} else {
			$this->Session->setFlash('Please click on Trust Deed Investment Hold Request action.', 'error');
			$this->redirect(array('controller'=>'commons','action' => 'loan'));
		}
		$fractionalInvestor = $this->LoanHoldRequest->find('first', array('conditions'=>array('LoanHoldRequest.loan_id'=>$loanId),'fields'=>'sum(LoanHoldRequest.inv_type_fraction) AS investmentPercentageTotal'));
		
		$holdReq = $this->LoanHoldRequest->find('first', array('conditions'=>array('LoanHoldRequest.loan_id'=>$loanId, 'LoanHoldRequest.hold_by'=>$userId)));
		$this->set('holdReq', !empty($holdReq) ? $holdReq : '');
		if($this->request->data){
			$loanNumber = $this->Common->getLoanNumber($loanId);
			$this->request->data['LoanHoldRequest']['id'] = !empty($this->request->data['LoanHoldRequest']['id'])?base64_decode(base64_decode($this->request->data['LoanHoldRequest']['id'])):'';
			$this->request->data['LoanHoldRequest']['loan_id'] = $loanId;
			$this->request->data['LoanHoldRequest']['hold_by'] = $userId;
			$this->request->data['LoanHoldRequest']['hold_date'] = CURRENT_DATE_TIME_DB;
			if($this->request->data['LoanHoldRequest']['investor_type'] == 'full_trust_deed'){
				$getPrevInvestors = $this->LoanHoldRequest->findByLoanId($loanId);
				$this->Common->sendNotificationToInvestors($loanId,$getPrevInvestors);
				$this->LoanHoldRequest->updateAll(array('status'=>'0'),array('loan_id'=>$loanId));
			}
			if($this->LoanHoldRequest->save($this->request->data)) {
				$insertId = $this->LoanHoldRequest->id;
				if(!empty($this->request->data['CounterOffer']['Label'])) {
					$counterLog = ' Counter Offer<br/>';
					foreach($this->request->data['CounterOffer']['Label'] as $key => $formLabel) {
						if(!empty($formLabel)){
							$saveOffer['loan_id'] = $loanId;
							$saveOffer['loan_hold_request_id'] = $insertId;
							$saveOffer['label'] = $formLabel;
							$saveOffer['offer'] = $this->request->data['CounterOffer']['Offer'][$key];
							$saveOffer['expiration_date'] = _dateFormatDB($this->request->data['CounterOffer']['ExpirationDate'][$key]);
							$this->CounterOffer->create();
							$this->CounterOffer->save($saveOffer);
							$counterLog .= $this->request->data['CounterOffer']['Label'][$key] . ' - ' .$this->request->data['CounterOffer']['Offer'][$key] . ' Expiration Date - '. _dateFormatDB($this->request->data['CounterOffer']['ExpirationDate'][$key]) .'<br/>';
						}
					}
				}else{
					unset($this->request->data['CounterOffer']);
				}
				//End Counter Offer
				$action = 'Investor - Trust Deed Investment Hold Requested';
				if($counterLog != ''){
					$action .= $counterLog; 
				}
				//save loan logs
				$shortAppID = $this->getShortAppID($loanId);
				$logData['LoanLog']['user_id']= $userId;
				$logData['LoanLog']['short_application_ID']= $shortAppID;
				$logData['LoanLog']['action']= 16;
				$logData['LoanLog']['description'] = $action;
				$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
				$this->LoanLog->create();
				$this->LoanLog->save($logData);
				//save notification for all members
				$memberNotification = $loanNumber . ' - '. $newLoans['16'];
				$this->Common->saveNotifications($memberNotification, $userId, $loanId);
				//save notification to borrower
				$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
				$notificationData['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
				$notificationData['Notification']['sender_id'] = $userId;
				$notificationData['Notification']['action'] = 'Trust Deed Investor Hold Request';
				$notificationData['Notification']['action_id'] = $loanId;
				$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
				$this->Notification->create();
				$this->Notification->save($notificationData);
				//save funder Todo to approve counter Offer
				$funderDetail = $this->LoanUser->find('first',array('conditions'=>array('loan_id' => $loanId,'user_type' => 6),'fields' =>array('LoanUser.user_id')));
				if(!empty($funderDetail)) {
					$toDo = $loanNumber . ' - '.$newLoans['16'] . '<a href="'.BASE_URL.'commons/investor_request/'.base64_encode(base64_encode($loanId)).'"> Check investor request </a> to further process loan';
					$notificationData['Notification']['receiver_id'] = $funderDetail['LoanUser']['user_id'];
					$notificationData['Notification']['sender_id'] = $this->Session->read('userInfo.id');
					$notificationData['Notification']['action'] = $toDo;
					$notificationData['Notification']['action_id'] = $loanId;
					$notificationData['Notification']['type'] = 2;
					$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
					//pr($notificationData);
					$this->Notification->create();
					$this->Notification->save($notificationData);
				}
				//Trust Deed Investment Hold Requested
				$loanCyclephase = 16;
				$this->Loan->id = $loanId;
				$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
				
				$this->Session->setFlash('Trust Deed Investment Hold Requested has been saved successfully.','default',array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'tdinvestors','action' => 'trust_deed'));
			}
		}
		//$this->set('investmentPercentageTotal', !empty($fractionalInvestor) ? $fractionalInvestor['0']['investmentPercentageTotal'] : '0');
		//$this->set('fractionalInvestor', !empty($fractionalInvestor['LoanHoldRequest']) ? $fractionalInvestor['LoanHoldRequest'] : '');
		$this->set('fractionalInvestment', !empty($fractionalInvestor) ? $fractionalInvestor : '');
		$users = $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('user_type'=>8),'order'=>'first_name ASC'));
		$this->set('loanId',$loanId);
		$this->set('users',$users);
	}
	
	/*
	* fetch TD Investor function
	* Functionality -  fetch TD Investor
	* Created date - 5-Oct-2015
	* Modified date - 
	*/
	
	public function fetch_investor() {
		$this->layout = false;
		$this->autoRender = false;
		$this->loadAllModel(array('User'));
		if(!empty($this->request->data)) {	
			$loanId = isset($this->request->data['loanID'])?$this->request->data['loanID']:'';
			$trustDeedId = isset($this->request->data['trustDeedID'])?$this->request->data['trustDeedID']:'';
			
			$data = $this->User->find('all',array('conditions'=>array('User.user_type'=>7,'User.status'=>1)));
			$this->set('data', $data);
			$this->set('loanId', $loanId);
			$this->set('trustDeedId', $trustDeedId);
			$this->render('/Elements/model_window/investor_list');
		}
	}
	
	/*
	* trust_deed_recipients function
	* Functionality -  Trust Deed Flyer to TD Investor List via Email
	* Created date - 17-Oct-2015
	* Modified date - 
	*/
	
	public function trust_deed_recipients() { 
		$this->layout = false;
		$this->autoRender = false;
		$this->loadAllModel(array('User','Notification','ShortApplication','LoanLog','InvestorAvailableDeed'));
		$userData  = $this->Session->read('userInfo');
		if(isset($this->request->data) && !empty($this->request->data)) {
			$loanId = base64_decode($this->request->data['TrustDeed']['loanId']);
			$trustDeedId = base64_decode($this->request->data['TrustDeed']['trustDeedId']);
			$loanID = trim($this->request->data['TrustDeed']['loanId']);
			$pdfName = 'trust_deed_flyer_'.$loanID.'.pdf';
			$loanNumber = $this->Common->getLoanNumber($loanId);
			$newLoans = $this->getLoanLifeCyclePhase();
			if(isset($this->request->data['investor_Id'])){ //pr($this->request->data);
				foreach($this->request->data['investor_Id'] as $key => $investorID) {
					$userID = base64_decode($investorID);
					$userDetail = $this->User->find('first',array('conditions'=>array('id'=>$userID),'recursive' => -1));
					$emailAddress = $userDetail['User']['email_address'];
					$name = $userDetail['User']['name'];
					
					//save investor notifications
					$notificationData['Notification']['receiver_id'] = $userID;
					$notificationData['Notification']['sender_id'] = $userData['id'];
					$notificationData['Notification']['action'] = $loanNumber . ' - '. $newLoans['15'] . '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">Click here to review</a> and <a href="'.BASE_URL.'tdinvestors/trust_deed">hold</a> request';
					$notificationData['Notification']['action_id'] = $loanId;
					$notificationData['Notification']['type'] = 2;
					$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
					$this->Notification->create();
					$this->Notification->save($notificationData);
					//save loan logs
					$shortAppID = $this->getShortAppID($loanId);
					$logData['LoanLog']['user_id']= $userData['id'];
					$logData['LoanLog']['short_application_ID']= $shortAppID;
					$logData['LoanLog']['action']= 15;
					$logData['LoanLog']['description'] = 'Trust Deed Final sent to investor '.$name.  '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
					$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
					$this->LoanLog->create();
					$this->LoanLog->save($logData);
					//save notification for all members
					$actionNotify = $loanNumber . $newLoans['15'] .' to '. $name;
					$this->Common->saveNotifications($actionNotify, $userData['id'], $loanId);
					
					//save notification
					$data = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id' => $shortAppID),'fields' =>array('ShortApplication.borrower_ID')));
					$notification['Notification']['receiver_id'] = $data['ShortApplication']['borrower_ID'];
					$notification['Notification']['sender_id'] = $userData['id'];
					$notification['Notification']['action'] = $actionNotify .  '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
					$notification['Notification']['action_id'] = $loanId;
					$notification['Notification']['created'] = CURRENT_DATE_TIME_DB;
					$this->Notification->create();
					$this->Notification->save($notification);
					//save available trust deed if not exist
					$availableDeeds = $this->InvestorAvailableDeed->find('all',array('conditions'=>array('InvestorAvailableDeed.investor_id'=>$userID,'InvestorAvailableDeed.trust_deed_id' =>$trustDeedId),'fields'=>array('InvestorAvailableDeed.id')));
					if(count($availableDeeds) == 0) { 
						$trustDeedData['InvestorAvailableDeed']['trust_deed_id'] = $trustDeedId;
						$trustDeedData['InvestorAvailableDeed']['funder_id']= $userData['id'];
						$trustDeedData['InvestorAvailableDeed']['investor_id']= $userID;
						$trustDeedData['InvestorAvailableDeed']['created'] = CURRENT_DATE_TIME_DB;
						//pr($trustDeedData); 
						$this->InvestorAvailableDeed->create();
						$this->InvestorAvailableDeed->save($trustDeedData);
					}
		
					$this->CustomEmail->__sendTrustDeedFlyerEmail($name, $emailAddress, $loanID);
				} //die();
				//update loan_life_cycle_phase in loan table
				$newLoans = $this->getLoanLifeCyclePhase();
				$loanCyclephase = 15;
				$this->Loan->id = $loanId;
				$this->Loan->saveField('loan_life_cycle_phase',$loanCyclephase);
				$this->Session->setFlash('Trust Deed Flyer has been sent successfully.', 'default', array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'commons','action' => 'loan'));
			}
		}
	}
	
	
	/*
	* fetch recipients function
	* Functionality -  fetch investor to send Available Trust Deeds Email
	* Created date - 3-May-2016
	* Modified date - 
	*/
	
	public function fetch_recipients() {
		$this->layout = false;
		$this->autoRender = false;
		$this->loadAllModel(array('User'));
		if(!empty($this->request->data)) {
			$trustDeedIds = isset($this->request->data['ids'])?implode(',',$this->request->data['ids']):'';
			$data = $this->User->find('all',array('conditions'=>array('User.user_type'=>7,'User.status !='=>0),'recursive'=>-1));	
			$this->set('data', $data);
			$this->set('trustDeedIds', $trustDeedIds);
			$this->render('/Elements/model_window/recipient_list');
		}
	}
	
	/*
	* send_td_emails function
	* Functionality -  send mutiple or individual Available Trust Deeds Email and save investor trust deed
	* Created date - 3-May-2016
	* Modified date - 
	*/
	
	public function send_td_emails() {
		$this->layout = false;
		$this->autoRender = false;
		$this->loadAllModel(array('User'));
		$this->loadAllModel(array('User','Notification','ShortApplication','LoanLog','EmailTemplate','TrustDeed','InvestorAvailableDeed'));
		$userData  = $this->Session->read('userInfo');
		if(isset($this->request->data) && !empty($this->request->data)) { 
			if(!empty($this->request->data['TrustDeed']['trustDeedID'])){
				$html = '';
				$trustDeedID = explode(',',$this->request->data['TrustDeed']['trustDeedID']);
				foreach($trustDeedID as $key => $deedID) { 
					$imgSrc = '';
					$trustDeedDetail = $this->TrustDeed->find('first',array('conditions'=>array('TrustDeed.id'=>base64_decode($deedID)),'fields'=>array('TrustDeed.trustdeed_position','TrustDeed.note_rate','TrustDeed.req_loan_amount','TrustDeed.loan_term','TrustDeed.loan_id','TrustDeed.pdf_name')));
					if(count($trustDeedDetail)){
						$loanID = $trustDeedDetail['TrustDeed']['loan_id'];
						$shortAppID = $this->getShortAppID($loanID);
						$shortAppDetail = $this->ShortApplication->find('first',array('conditions'=>array('ShortApplication.id'=>$shortAppID),'fields'=>array('PropertyDetail.LastSaleAmt', 'PropertyDetail.LastSaleDate','PropertyDetail.SiteCity','PropertyDetail.SiteState')));
						if(!empty($shortAppDetail)) {
							$deedPosition  = $trustDeedDetail['TrustDeed']['trustdeed_position'];
							if($deedPosition == 2) {
								$trustDeedPosition = '2nd TD';
							}else{
								$trustDeedPosition = '1st TD';
							}
							$pdfName = $trustDeedDetail['TrustDeed']['pdf_name'];
							if(count($trustDeedDetail['TrustDeedUpload']) > 0){
								$image = $trustDeedDetail['TrustDeedUpload']['0']['property_image'];
								$img = BASE_URL."upload/TrustDeedFlyer/".$image;
								$imgSrc = '<img align="center" src="'.$img.'" height="200" width="300" border="0"  style="margin-top: 6%;"/>';
							}
							$pdfLink =  BASE_URL."files/pdf/TrustDeedFlyer/".$trustDeedDetail['TrustDeed']['pdf_name'];
							$html .= '<table style="width:100%">
									<tbody><tr><td align="center">'.$trustDeedPosition. '- $'.$trustDeedDetail['TrustDeed']['req_loan_amount'] .'</td></tr>' ;
							$html .= '<tr style="background:#162258;"><td>';
							$html .= '<table style="width:100%"><tbody><tr><td style="width:70%">&nbsp;
								<table class="whiteText" border="0" cellpadding="0" cellspacing="10" style="color:#FFFFFF;font-size:12px">
								<tbody>
										<tr>
											<td style="color: #ffffff">Interest Rate : ' .$trustDeedDetail['TrustDeed']['note_rate']. '% </td>
										</tr>
										<tr>
											<td style="color: #ffffff">Loan Term : ' .$trustDeedDetail['TrustDeed']['loan_term']. '- Months</td>
										</tr>
										<tr>
											<td style="color: #ffffff">Appraised Value : $'.$shortAppDetail['PropertyDetail']['LastSaleAmt'] .'</td>
										</tr>
										<tr>
											<td style="color: #ffffff">Date of Appraisal : '. date('M d, Y', strtotime($shortAppDetail['PropertyDetail']['LastSaleDate'])). '</td>
										</tr>
										<tr>
											<td style="color: #ffffff">'.$shortAppDetail['PropertyDetail']['SiteCity'].', ' . $shortAppDetail['PropertyDetail']['SiteState'].'</td>
										</tr>
								</tbody>
							</table>
							</td>
								<td style="width:30%"> '.$imgSrc.'</td>
								</tr>
								<tr><td colspan="2"><a style="color:#FFFFFF;" href="'.$pdfLink.'"  target="_blank">Click to see trust deed flyer</a></td></tr>
							</tbody>
						</table>
						</td></tr></table> <br /><hr />';
						}
					}
				}
				//echo $html; die();
				if(isset($this->request->data['investor_Id'])) {
					//pr($this->request->data);
					foreach($this->request->data['investor_Id'] as $key => $investorID) {
						$userID = base64_decode($investorID);
						$userDetail = $this->User->find('first',array('conditions'=>array('id'=>$userID),'recursive' => -1));
						$emailAddress = $userDetail['User']['email_address'];
						$name = $userDetail['User']['name'];
						//save investor notifications
						$notificationData['Notification']['receiver_id'] = $userID;
						$notificationData['Notification']['sender_id'] = $userData['id'];
						$notificationData['Notification']['action'] = 'New trust Deed Flyer published <br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">Click here to review</a> and <a href="'.BASE_URL.'tdinvestors/trust_deed">hold</a> request';
						$notificationData['Notification']['action_id'] = $loanID;
						$notificationData['Notification']['created'] = CURRENT_DATE_TIME_DB;
						$this->Notification->create();
						$this->Notification->save($notificationData);
						//save loan logs
						$logData['LoanLog']['user_id']= $userData['id'];
						$logData['LoanLog']['short_application_ID']= $shortAppID;
						$logData['LoanLog']['action']= 'Trust Deed Flyer - Final Publish';
						$logData['LoanLog']['description'] = 'Trust Deed Final sent to investor '.$name.  '<br/><a href="/app/webroot/files/pdf/TrustDeedFlyer/'.$pdfName.'" target="_blank">'.$pdfName.'</a>';
						$logData['LoanLog']['created'] = CURRENT_DATE_TIME_DB;
						$this->LoanLog->create();
						$this->LoanLog->save($logData);
						//save notification for all members
						$this->Common->saveNotifications('Available Trust Deed Flyer sent to investor '.$name, $userData['id'], $loanID);
							
						// save Available Trust deeds
						foreach($trustDeedID as $key => $deedID) {
							$availableDeeds = $this->InvestorAvailableDeed->find('all',array('conditions'=>array('InvestorAvailableDeed.investor_id'=>$userID,'InvestorAvailableDeed.trust_deed_id' =>base64_decode($deedID)),'fields'=>array('InvestorAvailableDeed.id')));
							if(count($availableDeeds) == 0) { 
								$trustDeedData['InvestorAvailableDeed']['trust_deed_id'] = base64_decode($deedID);
								$trustDeedData['InvestorAvailableDeed']['funder_id']= $userData['id'];
								$trustDeedData['InvestorAvailableDeed']['investor_id']= $userID;
								$trustDeedData['InvestorAvailableDeed']['created'] = CURRENT_DATE_TIME_DB;
								$this->InvestorAvailableDeed->create();
								$this->InvestorAvailableDeed->save($trustDeedData);
							}
						}
						//send Trust Deed Emails
						//echo $html;die;
						$this->CustomEmail->__sendAvailableTrustDeeds($name, $emailAddress, $loanID, $html);
					} 
					$this->Session->setFlash('Trust Deed Flyer has been sent successfully.', 'default', array('class'=>'alert alert-success'));
					$this->redirect(array('controller'=>'commons','action' => 'trust_deed_listing'));
				}
				
				
			}
		}	
	}
	
	/*
	* cancel_trust_deed function
	* Functionality -  fetch investor to send Available Trust Deeds Email
	* Created date - 5-May-2016
	* Modified date - 
	*/
	
	public function cancel_trust_deed() {
		$this->layout = false;
		$this->autoRender = false;
		$this->loadAllModel(array('TrustDeed'));
		if(!empty($this->request->data)) { 
			$trustDeedId = isset($this->request->data['trustDeedID'])?$this->request->data['trustDeedID']:'';
			$id = base64_decode($trustDeedId);
			$this->TrustDeed->id = $id;
			if($this->TrustDeed->updateAll(array('TrustDeed.status'=>0),array('TrustDeed.id'=>$id))) {
				return "true";
			}	
		}
	}
	/*
	* trust_deed function
	* Functionality -  fetch trust deed
	* Created date - 5-May-2016 
	*/
	
	public function trust_deed() {
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('TrustDeed','InvestorAvailableDeed'));
		$this->InvestorAvailableDeed->bindModel(array('belongsTo'=>array('TrustDeed')));
		$arrTrustDeed = $this->InvestorAvailableDeed->find('all', array('conditions'=>array('InvestorAvailableDeed.investor_id'  =>$this->Session->read('userInfo.id'),'InvestorAvailableDeed.status' => 1)));
		$this->set('arrTrustDeed', $arrTrustDeed);	
	}
}