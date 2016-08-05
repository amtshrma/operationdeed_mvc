<?php

/*
 * Markets Controller class
 * @Date		22 December 2015
 * @author    	smartData
 * @link      	http://www.smartdatainc.net/
 */

class MarketsController extends AppController {
    
    public $uses=array('Newsletter', 'User');
    public $helpers = array('Session','Pagination','Html', 'Form', 'Js');
    public $components = array('Paginator','Session','RequestHandler', 'Email','Mailchimp');
	public $paginate = array();
	
    /**
	 * Summary :- beforeFilter
	 * @return	object		NONE
	*/
	
	function beforeFilter() {
		parent::beforeFilter();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    }
	
	/**
	 *@newsletter function
	 *@date	:	23Dec2015
	 *@Send newsletter for subscribed users
	*/
	
	function newsletter() {
		$this->layout = 'dashboard_common';
		//Get users email
		$arrUser = $this->User->find('list', array('fields'=>array('email_address'), 'conditions'=>array('status'=>'1', 'is_deleted'=>'0', 'user_type'=>'1')));
		$this->set('arrUser', $arrUser);
		require(dirname(dirname(__FILE__)).'/webroot/mailchimp/src/Mailchimp.php');
		$MailChimp = new Mailchimp('c14e1595edf4e4ba07f64c6f227afd3a-us12');		
		$list_id='eae5fc9973';		
		// Get Template List
		$templates = $MailChimp->templates->getList(array('user'=>true,'base'=> true));
		if(isset($templates['user']) && !empty($templates['user'])) {
			//pr($templates['user']);
			foreach($templates['user'] as $temp) {
				$tId = $temp['id'];
				$tName = $temp['name'];
				$tPreviewImage = $temp['preview_image'];
				$tOptions[$tId] = $tName;
				$tImageLink[$tId] = $tPreviewImage;
			}
		}
		//Change template preview image on ajax call
		if($this->RequestHandler->isAjax()) {
			$this->layout = false;
			$this->autoRender = false;
			if(isset($this->request->data['tid']) && !empty($this->request->data['tid'])) {
				$tempTid = $this->request->data['tid'];
				return $tImageLink[$tempTid];
			}
			exit;
		}
		$this->set('templates', $tOptions);
		if(!empty($this->request->data)) {
			$emailsTo = isset($this->request->data['Newsletter']['to']) ? $this->request->data['Newsletter']['to'] : '';
			$templateId = $this->request->data['Newsletter']['template'];
			$subject = $this->request->data['Newsletter']['subject'];
			$from_email = $this->request->data['Newsletter']['from_email'];
			$from_name = $this->request->data['Newsletter']['from_name'];
            $to_name = $this->request->data['Newsletter']['to_name'];
            $title = $this->request->data['Newsletter']['title'];
			if(empty($emailsTo)){
				$this->Session->setFlash("Please select at least one email to send newsletter.",'default',array('class'=>'alert alert-danger'));
			}else if(!empty($emailsTo)){
				$batch = array();
				foreach($emailsTo as $email){
					$batch[] = array('email' => array('email' => $email));
				}
				$batch_subscribe = $MailChimp->call('lists/batch-subscribe', array(
														'id' => $list_id,
														'batch' => $batch,
														'double_optin' => false,
														'update_existing' => false,
														'replace_interests' => true
													)
												);
				$add_count = $batch_subscribe['add_count']; //users subscribed
				$error_count = $batch_subscribe['error_count']; //users already subscribed
				$options = array(
								'list_id' => $list_id,
								'subject' => $subject,
								'from_email' => $from_email,
								'from_name' => $from_name,
								'to_name' => $to_name,
								'template_id' => $templateId,
								'title' => $title
							);
				
				$exp = ''; //to set $exp='example text'; here
				$content[] = array('text' => $exp);
				
				//CREATE COMPAIGN FROM LIST
				$compaigns = $MailChimp->call("campaigns/create", array(
													'type' => 'regular',
													'options' => $options,
													'content' => $content,
												)
											);
				//SEND MAIL FROM COMPAIGN
				if(!empty($compaigns)) {
					$send_mail = $MailChimp->call("campaigns/send", array('cid'=>$compaigns['id']));
					if(!empty($send_mail) && $send_mail['complete']=='1'){
						$this->Session->setFlash('Newsletter has been successfully sent to selected emails','default',array('class'=>'alert alert-success'));	
					}else{
						$this->Session->setFlash("Please select at least one email to send newsletter.",'default',array('class'=>'alert alert-error'));
					}
				}
			}
		}
	}
	
	/**
	 * Description :- marketingList
	 * @var object :- None
	 */
	
	function marketingList($reset = null){
		$this->layout = 'dashboard_common';
		$this->loadModel('ShortApplication');
		if($reset){
			$this->Session->delete('marketList');
		}
		$joins = array(
					array(
						'table' => 'loans',
						'alias' => 'Loan',
						'conditions' => array(
							'ShortApplication.id = Loan.short_app_id'
						)
					)/*,
					array(
						'table' => 'soft_quotes',
						'alias' => 'SoftQuote',
						'conditions' => array(
							'ShortApplication.id = SoftQuote.short_application_id'
						)
					)*/
				);
		$criteria = '1=1 ';
		$this->paginate = array(
			'limit' => PAGINATION_LIMIT,
			'order' => array(
					'ShortApplication.id' => 'ASC'
				),
			'joins' => $joins,
			'fields' => array('ShortApplication.*,Loan.*'),
			'recursive'=>-1
		);
		if(isset($this->request->data['MarketList'])){
			//pr($this->request->data['MarketList']);die;
			$this->Session->write('marketList',$this->request->data['MarketList']);
			foreach($this->request->data['MarketList'] as $key=>$val){
				foreach($val as $k=>$v){
					if($v){
						$criteria .= ' and ';
						if($k == 'create'){
							$v = date('Y-m-d',strtotime($v));
							$criteria .= "$key.created LIKE '%".$v."%'";
						}else{
							$criteria .= "$key.$k LIKE '%".$v."%'";
						}
					}
				}
			}
		}else if($this->Session->check('marketList')){
			$sessionData = $this->Session->read('marketList');
			if(is_array($sessionData)){
				foreach($sessionData as $key=>$val){
					foreach($val as $k=>$v){
						if($v){
							$criteria .= ' and ';
							if($k == 'create'){
								$v = date('Y-m-d',strtotime($v));
								$criteria .= "$key.created LIKE '%".$v."%'";
							}else{
								$criteria .= "$key.$k LIKE '%".$v."%'";
							}
						}
					}
				}
			}
		}
		//echo $criteria;die;
		$this->Paginator->settings = $this->paginate;
		$loanData = $this->Paginator->paginate('ShortApplication',$criteria);
		$this->set('loanData',$loanData);
		// set property type
		$this->set('property_type',$this->propertyTypes);
		// set loan to value
		$this->set('loanToValue',$this->approxLoanValues);
	}
	
	/**
	 * Description : generate excel from the provided data
	 * @var object Null
	 * function Name:- createExcel
	 */
	
	function createExcelMarketList(){
		$this->autoRender = false;
		$excelname = 'userList';
		$excelListData = array();
		$records = '';
		$this->loadModel('ShortApplication');
		$joins = array(
					array(
						'table' => 'loans',
						'alias' => 'Loan',
						'conditions' => array(
							'ShortApplication.id = Loan.short_app_id'
						)
					)/*,
					array(
						'table' => 'soft_quotes',
						'alias' => 'SoftQuote',
						'conditions' => array(
							'ShortApplication.id = SoftQuote.short_application_id'
						)
					)*/
				);
		$criteria = '1=1 ';
		$fields = 'ShortApplication.*,Loan.*';
		$criteria = array();
		$sessionData = $this->Session->read('marketList');
		if(is_array($sessionData)){
			foreach($sessionData as $key=>$val){
				foreach($val as $k=>$v){
					if($v){
						if($k == 'create'){
							$v = date('Y-m-d',strtotime($v));
							$criteria[] = "$key.created LIKE '%".$v."%'";
						}else{
							$criteria[] = "$key.$k LIKE '%".$v."%'";
						}
					}
				}
			}
		}
		$records = $this->ShortApplication->find('all',array('conditions'=>$criteria,'joins'=>$joins,'fields'=>$fields));
		if(count($records)){
			foreach($records as $val){
				$excelListData[] = array(
										//'Team' => 'Team - '.$val['Loan']['team_id'],
										"FirstName" => $val['ShortApplication']['applicant_first_name'],
										"LastName" => $val['ShortApplication']['applicant_last_name'],
										"EmailAddress" => $val['ShortApplication']['applicant_email_ID'],
										/*
										//'Team' => 'Team - '.$val['Loan']['team_id'],
										"FirstName" => $val['ShortApplication']['applicant_first_name'],
										"LastName" => $val['ShortApplication']['applicant_last_name'],
										"EmailAddress" => $val['ShortApplication']['applicant_email_ID'],
										"LoanDate" => date('M d Y',strtotime($val['Loan']['created'])),
										"PropertyLocation" => $val['ShortApplication']['property_address'].' '.$this->getStateName($val['ShortApplication']['property_state']).' '.$this->getCityName($val['ShortApplication']['property_city']),
										"LoanReason" => $val['ShortApplication']['loan_objective'],
										"LoanAmount" => '$'.$val['ShortApplication']['loan_amount'],
										"InterestRate" => (!empty($val['SoftQuote']['interest_rate'])) ? $val['SoftQuote']['interest_rate'] : 'N/A'.' %'
										*/
									);
			}
		}
		$filename = $excelname ."_". date('Y-m-d') . ".xlsx";
		$flag = false;
		$html = "";
		$count = 1;
		if(count($excelListData)){
			foreach($excelListData as $row){
				if(!$flag){
					$html .= implode("\t", array_keys($row)) . "\r\n";
					$flag = true;
				}
				$html .= implode("\t", array_values($row)) . "\r\n";
			}
		}
		file_put_contents(getcwd()."/users_excel/" . $filename, "$html");
		$this->redirect(BASE_URL.'users_excel/'.$filename);
	}
	
	/**
	 * Description :- marketingList
	 * @var object :- None
	 */
	
	function usersMarketingList($reset = null){
		$this->layout = 'dashboard_common';
		$this->loadModel('User');
		if($reset){
			$this->Session->delete('userList');
		}
		$criteria = 'User.user_type != 111 && User.status = 1 && User.is_deleted = 0 ';
		$this->paginate = array(
			'limit' => PAGINATION_LIMIT,
			'order' => array(
					'User.id' => 'ASC'
			),
		);
		if(isset($this->request->data['UserList'])){
			$this->Session->write('userList',$this->request->data['UserList']);
			foreach($this->request->data['UserList'] as $key=>$val){
				foreach($val as $k=>$v){
					if($v){
						$criteria .= ' and ';
						$criteria .= "$key.$k = $v";
					}
				}
			}
		}else if($this->Session->check('userList')){
			$sessionData = $this->Session->read('userList');
			if(is_array($sessionData)){
				foreach($sessionData as $key=>$val){
					foreach($val as $k=>$v){
						if($v){
							$criteria .= ' and ';
							$criteria .= "$key.$k = $v";
						}
					}
				}
			}
		}
		//echo $criteria;die;
		$this->Paginator->settings = $this->paginate;
		$this->set('userData',$this->Paginator->paginate('User',$criteria));
		// set property type
		$this->set('userTypes',$this->userTypes);
	}
	
	/**
	 * Description : generate excel from the provided data
	 * @var object Null
	 * function Name:- createExcel
	 */
	
	function createExcelUserList(){
		$this->autoRender = false;
		$excelname = 'userList';
		$excelListData = array();
		$records = '';
		$this->loadModel('User');
		$criteria = 'User.user_type != 111 ';
		$criteria = array();
		$sessionData = $this->Session->read('userList');
		if(is_array($sessionData)){
			foreach($sessionData as $key=>$val){
				foreach($val as $k=>$v){
					if($v){
						$criteria[] = "$key.$k = $v";
					}
				}
			}
		}
		$records = $this->User->find('all',array('conditions'=>$criteria));
		if(count($records)){
			foreach($records as $val){
				$excelListData[] = array(
										//'Team' => 'Team - '.$val['Loan']['team_id'],
										"FirstName" => $val['User']['first_name'],
										"LastName" => $val['User']['last_name'],
										"EmailAddress" => $val['User']['email_address'],
										//"LoanDate" => date('M d Y',strtotime($val['Loan']['created'])),
										//"PropertyLocation" => $val['ShortApplication']['property_name'].' '.$val['Loan']['state'].' '.$val['Loan']['city'],
										//"LoanReason" => $val['Loan']['purpose_of_loan'],
										//"LoanAmount" => '$'.$val['Loan']['loan_amount'],
										//"InterestRate" => $val['SoftQuote']['interest_rate'].' %'
									);
			}
		}
		$filename = $excelname ."_". date('Y-m-d') . ".xlsx";
		$flag = false;
		$html = "";
		$count = 1;
		if(count($excelListData)){
			foreach($excelListData as $row){
				if(!$flag){
					$html .= implode("\t", array_keys($row)) . "\r\n";
					$flag = true;
				}
				$html .= implode("\t", array_values($row)) . "\r\n";
			}
		}
		file_put_contents(getcwd()."/users_excel/" . $filename, "$html");
		$this->redirect(BASE_URL.'users_excel/'.$filename);
	}
	
	/**
	 * Summary :- get_list_subscribe
	 * @return	object	NONE
	*/
	
	function get_list_subscribe() {
		$firstName = 'Manish';
		$lastName = 'Singh';
		$email = 'manishksmd@gmail.com';
		require(dirname(dirname(__FILE__)).'/webroot/mailchimp/src/Mailchimp.php');
		$mc = new Mailchimp('d7e171e3372a34d3fcdd650d471dacca-us12');
		$list = $mc->campaigns->getList();
		if(!empty($list)) {
			foreach($list['data'] as $data) {
			//	/**Create campain done and working fine **/
				$lid = $data['list_id'];
				$result = $mc->campaigns->create('regular', 
													array('list_id'=>$lid,
														'subject'=>'RCM',
														'from_email'=>'johnksmd@gmail.com',
														'from_name'=>'John'),
														array('html'=>'<div>This is the test email.</div>',
														'text'=>'This is plain text for testing purpose.')
												);
				$mySend = $mc->campaigns->send($result['id']);
			}
		}
    }
	
	/**
	 * Summary :- emailMarket
	 * @param	Object	: NONE
	*/
	
	function emailMarketeting(){
		$this->layout = 'dashboard_common';
		$this->loadAllModel(array('TrustDeed','Loan','User'));
		if($this->request->data){
			if(isset($this->request->data['EmailMarketing']['trustdeedId']) && !empty($this->request->data['EmailMarketing']['title'])){
				$userDetail = $this->User->find('all',array('conditions'=>array('user_type'=>'2','status' => '1','is_deleted' => '0'),'limit'=>5,'order'=>'User.id desc'));
				$templateData2 = '<table width="190" align="right" border="0" cellspacing="0" cellpadding="0" class="top-events" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
				<tr>
					<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; text-transform:uppercase; color:#373737; padding:7px 10px; background:#e1e1e1;">Top Brokers</td>
				</tr>';
				if(count($userDetail)){
					foreach($userDetail as $key=>$val){
						$templateData2 .= '<tr>
							<td style="padding:10px 0; border-bottom:1px #bfbfbf dotted;">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
									<tr>
										<td style="float: left;font-family:Arial, Helvetica, sans-serif; font-size:12px; text-transform:capitalize; color:#4f276f; line-height:1; padding-bottom:5px;"><b>'.$val['User']['first_name'].' '.$val['User']['last_name'].'</b></td>
									</tr>
									<tr>
										<td style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:11px;padding: 3px 0px;"><b>Email : </b>'.$val['User']['email_address'].'</td>
									</tr>
									<tr>
										<td style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:11px;padding: 3px 0px;"><b>Phone : </b>'.$val['UserDetail']['mobile_phone'].'</td>
									</tr>
									<tr>
										<td style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:11px;padding: 3px 0px;"><b>Mailing : </b> '.$val['UserDetail']['mailing_address'].', '.$this->getCityName($val['UserDetail']['city']).', '.$this->getStateName($val['UserDetail']['state']).', '.$val['UserDetail']['zipcode'].'</td>
									</tr>
								</table>
							</td>
						</tr>';
					}
				}
				$templateData2 .= '</table>';
				// fetch loans for compaings
				if(isset($this->request->data['EmailMarketing']['trustdeedId']) && count($this->request->data['EmailMarketing']['trustdeedId'])){
					$templateData1 = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tbody>';
					foreach($this->request->data['EmailMarketing']['trustdeedId'] as $key=>$val){
						$trustDeedDetail = $this->TrustDeed->findById(base64_decode($val));
						$imgPath = BASE_URL.'upload/TrustDeedFlyer/';
						if(count($trustDeedDetail)){
							$loanDetail = $this->Loan->find('first',array('conditions'=>array('Loan.id'=>$trustDeedDetail['TrustDeed']['loan_id']),'recursive'=>2));
							$templateData1 .= '<tr><td>&nbsp;<br /></td></tr>
							<tr>
										<td style="padding:10px 0; border-bottom:1px #bfbfbf dotted;">
											<table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; text-transform:uppercase; font-weight:bold; color:#4f276f; line-height:1; padding-bottom:5px;">'.$loanDetail['ShortApplication']['PropertyDetail']['LegalDesc'].'</td>
													</tr>
													<tr>     
														<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#3e3e3e; line-height:18px; padding-bottom:10px;">
															<p style="text-align: left;margin:0; padding:0; color:#000000;">'.date('M d Y',strtotime($loanDetail['Loan']['created'])).'</p>
															<p style="text-align: left;margin:0; padding:0;">'.$loanDetail['ShortApplication']['PropertyDetail']['SiteCity'].', '.$loanDetail['ShortApplication']['PropertyDetail']['SiteCounty'].', '.$loanDetail['ShortApplication']['PropertyDetail']['SiteState'].', '.$loanDetail['ShortApplication']['property_zipcode'].'</p>
														</td>
													</tr>
													<tr>
														<td>
															<table width="100" cellspacing="0" cellpadding="0" border="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
																<tbody>
																	<tr>
																		<td class="main-pic"><img alt="" src="'.$imgPath.$trustDeedDetail['TrustDeedUpload']['0']['property_image'].'" height="120" style="height: 120px;"></td>
																	</tr>
																</tbody>
															</table>
															<table width="100" cellspacing="0" cellpadding="0" border="0" align="right" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="contenttable">
																<tbody>
																	<tr>     
																		<td style="text-align: justify;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#3e3e3e; line-height:18px;">
																		<p style="text-align: left;margin:0; padding:0; color:#000000;">
																			<b>Loan Amount :</b> $'.$loanDetail['ShortApplication']['loan_amount'].'<br/>
																			<b>Year Built :</b> '.$trustDeedDetail['TrustDeed']['year_built'].'<br/>
																			<b>Monthly Rental:</b> $'.$trustDeedDetail['TrustDeed']['monthly_rental_income'].'<br/>
																			<b>Borrower Name:</b> '.$loanDetail['ShortApplication']['applicant_first_name'].' '.$loanDetail['ShortApplication']['applicant_last_name'].'<br/>
																			<b>Interest Rate:</b> '.$loanDetail['ShortApplication']['SoftQuote']['interest_rate'].' %<br/>
																		</p>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>';
						}
						$templateData1 .= '</tbody></table>';
					}
					$this->sendCampaigns($templateData1,$this->request->data['EmailMarketing']['title'],$templateData2);
					$this->Session->setFlash('Campaings Send Successfully','default',array('class'=>'alert alert-success'));
					$this->request->data = '';
				}
			}else{
				$this->Session->setFlash('Enter campaings subject and select trustdeed to send','default',array('class'=>'alert alert-danger'));
			}
		}
		$criteria = 'status = 1';
		$this->paginate = array(
			'limit' => PAGINATION_LIMIT,
			'order' => array(
						'TrustDeed.id' => 'ASC'
					)
		);
		$this->Paginator->settings = $this->paginate;
		$trustDeedDetail = $this->Paginator->paginate('TrustDeed',$criteria);
		$this->set('trustDeedDetail',$trustDeedDetail);
	}
	
	/**
	 * Summary :- sendCampaigns
	 * @param	$template = data
	*/
	
	public function sendCampaigns($template1 = null,$subject = null,$template2 = null) { //die($template1);
		/*********************  MAILCHIMP CODE ********************/
	    $api_key = "c14e1595edf4e4ba07f64c6f227afd3a-us12";
	    $list_id='eae5fc9973';
	    $full="http://www.bookmyspasalon.com";
	    /*********************  Set API Key    *********************/
		$this->Mailchimp->set_api_key($api_key,$list_id);
	    $type ='regular';
	    $options = array(
					'subject' => $subject,
					'from_email' => 'shalinin.sdei@smartdatainc.net',
					'from_name' => 'OTD',
					'template_id' => '126133',
					'title' => $subject,
				);
	    $content = array(
						'sections' => array(
						'std_content100'=> $template1,
						'std_content101' => $template2,
					)
				);
	    $create_compaign = $this->Mailchimp->create_compaign($type,$options,$content,'');
        $compaign_id = $create_compaign['id'];
		$this->Mailchimp->send_email($compaign_id);
		return true;
    }
}