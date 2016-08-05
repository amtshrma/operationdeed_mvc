<script type="text/javascript">
   function viewDetail(loanID ) {
	  $.ajax({
			type: "POST",
			url: '/commons/view_loan_detail',
			data: {"loanID": loanID},
			success: function(data) {
				$('.modal-content').html(data);
				$("#myModal").modal("show");
			}
		});
    }
</script>

<div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="content">    
	<div class="page-title" style="display:none">
		<a href="#" id="btn-back"><i class="icon-custom-left"></i></a>
        <h3>Back- <span class="semi-bold">Loan</span></h3>
     </div>		
		<div class="row"  id="inbox-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="no-border email-body" >
							<br>
							 <div class="row-fluid" >
							 <div class="row-fluid dataTables_wrapper">
								<h2 class=" inline">Loan </h2>
								<?php echo $this->Session->flash(); ?>
								
									<div class="clearfix"></div>
								</div>
								
								 <div class="grid-body ">
								<table class="table table-bordered table-condensed" id="example">
                                  <thead>
                                    <tr>
                                      <!--<th style="width:3%">
										<div class="checkbox check-default">
											<input id="checkall" type="checkbox" value="1" class="checkall">
											<label for="checkall"></label>
										</div></th>-->
                                      <th style="width:8%">Team</th>
									  <th style="width:8%">Borrower</th>
									  <th style="width:8%" data-hide="phone,tablet">Loan Date</th>
                                      <th style="width:8%" data-hide="phone,tablet">Property Location</th>
                                      
                                      <th style="width:8%" data-hide="phone,tablet">Loan Reason</th>
                                      <th style="width:8%" data-hide="phone,tablet">Loan Amount</th>
                                      <th style="width:8%" data-hide="phone,tablet">Processor Checklist</th>
									  <?php $userInfo  = $this->Session->read('userInfo');
										if(!empty($userInfo['user_type']) && $userInfo['user_type'] == 6) {
											
											echo '<th style="width:8%" data-hide="phone,tablet">Trust Deed Flyer</th>';
											echo '<th style="width:8%" data-hide="phone,tablet">LOI</th>';
										} ?>
										<th style="width:8%" data-hide="phone,tablet">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                 <?php
								 if(count($allLoans)>0) {
                                    foreach($allLoans as $i => $loan) {
										$checklist = '';
										$trustDeedLink = '';
										$loiLink = '';
										$loanPhase = '';
										$shortapploanofficer = '';
										$trustDeedDetail = '';
										$tombstoneExist = '';
										$arrPhases = '';
										$short_app_id = $loan['ShortApplication']['id'];
										$shortapploanofficer = $this->Common->shortapp_checkloanuser($short_app_id);
										$loanID = base64_encode($loan['Loan']['id']);
										$logged_in_id = $this->Session->read('userInfo');
										$link = $this->Common->getLoanProcessLink($loanID,$logged_in_id );
									
									    echo $this->Html->link($link['name'], $link['url']);
										$loanPhase = $this->Common->getDocumentSatus($loanID, 'B');
										
										$userDetail = $this->Common->getUserDetail($logged_in_id);
                                        $tempState = $loan['ShortApplication']['property_state'];
										$state =  !empty($tempState) ? $states[$tempState]:'';
										$tempPropertyType = $loan['ShortApplication']['property_type'];
										$propertyType =  $propertyTypes[$tempPropertyType];
										$tempLoanType = $loan['ShortApplication']['loan_type'];
										$loanType =  $loanTypes[$tempLoanType];
										$tempLoanReason = $loan['ShortApplication']['loan_reason'];
										$loanReason =  !empty($tempLoanReason) ? $loanReasons[$tempLoanReason]:'';
										$tempLoanAmount = $loan['ShortApplication']['loan_amount'];
										$loanAmount =  $loanAmounts[$tempLoanAmount];
										$tempLoanValue = $loan['ShortApplication']['loan_to_value'];
										$loanToValue =  $approxLoanValues[$tempLoanValue];
										// start checklist link
										if(!empty($loan['Loan']['team_id'])) {
											if(empty($loanPhase)){
												//echo $shortapploanofficer . ', '. $loggedinid;
												if(!empty($shortapploanofficer) &&  ($shortapploanofficer != $logged_in_id)){
													$detail = $this->Common->getUserDetail($shortapploanofficer);
													$checklist = 'Processor Check-list Document Requested by '.$detail['User']['name'];
												}elseif(!empty($shortapploanofficer) && ($shortapploanofficer == $logged_in_id)) {
													$checklist = $this->Html->link('Processor Check-list Document Request', array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']))); 
												
												}elseif(empty($shortapploanofficer)) {
													$checklist = $this->Html->link('Processor Check-list Document Request', array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']))); 
												
												}else {
													$checklist = '--';
												}
											} elseif(!empty($loanPhase) && $loanPhase == 1){ 
												$checklist = 'Processor Check-list Document Received';
											} else {
												$checklist = '--';
											}
										}elseif(empty($loan['Loan']['team_id']) && !empty($loanPhase) && $loanPhase == 1){
											$checklist = 'Processor Check-list Document Received';
										
										} else {
											$checklist = $this->Html->link('Processor Check-list Document Request', array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']))); 
										}
										//end  checklist link
										$loiConditionSatisfied = '';
										//start trust deed link 
										if(!empty($loan['Loan']['team_id'])) {
											$loiConditionSatisfied = $this->Common->checkLOICondition($loan['Loan']['id']);
											$loiPublishedUserId = $loiConditionSatisfied['Loi']['user_id'];
											$detail = $this->Common->getUserDetail($loiPublishedUserId);
											
											if(!empty($loanPhase) && $loanPhase == 1){ 
												
												//echo $trustDeedUserID . ', '. $loggedinid;
												if(!empty($loiConditionSatisfied) &&  ($loiPublishedUserId != $logged_in_id)){
													$loiLink = 'LOI created';
												}elseif(!empty($loiConditionSatisfied) && ($loiPublishedUserId == $logged_in_id)) {
													
													$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
												}elseif(empty($loiConditionSatisfied) && $loanPhase == 1) {
													
													$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
												}else {
													
													$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
												}
											} else {
												$loiLink = 'In-Process';
											}
										} else {
											$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
										}
										//end loi link
										
										//start Trust deed Link
										$trustDeedDetail = $this->Common->checkTrustDeed($loan['Loan']['id']);
										if(!empty($loan['Loan']['team_id'])) {
											
											$loiConditionSatisfied = $this->Common->checkLOICondition($loan['Loan']['id']);
											//pr($trustDeedDetail);
											$trustDeedUserID = $trustDeedDetail['TrustDeed']['user_id'];
											$userdetail = $this->Common->getUserDetail($trustDeedUserID);			
											//if Processor Check-list Documents Received, we check if trust deed is already created and logged in user Id is same as trust deed user Id
											
											if(!empty($loanPhase) && $loanPhase == 1){ 
												if(!empty($trustDeedDetail) &&  ($trustDeedUserID != $logged_in_id)){
													$trustDeedLink = 'Trust Deed drafted by '.$userdetail['User']['name'];
									
												}elseif(!empty($trustDeedDetail) && ($trustDeedUserID == $logged_in_id)) {
													$trustDeedLink = $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',$loanID,base64_encode(base64_encode($trustDeedDetail['TrustDeed']['id']))));
													
												}else {
													$trustDeedLink = $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',$loanID,base64_encode(base64_encode($trustDeedDetail['TrustDeed']['id']))));
												}
											}else {
												$trustDeedLink = 'In-Process';
											}
										}else {
											if(!empty($trustDeedDetail)){
												$trustDeedLink = $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',$loanID,base64_encode(base64_encode($trustDeedDetail['TrustDeed']['id']))));
											}else{
												$trustDeedLink = $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',$loanID));
											}
										}
										
										//end Trust deed Link
										
										?>
										<tr>
											<td>
											<?php
											//pr($loan);
											//echo $loan['Loan']['id'] . '---' .base64_decode($loanID);
											$teamId = $loan['Loan']['team_id'];
											$teamName = $this->Common->getTeamName($teamId);
											echo $this->Html->link($teamName, 'javascript:void(0)', array('class'=>'loanteam', 'data-toggle'=>'modal', 'data-target'=>'#myModal', 'id'=>base64_encode(base64_encode($teamId)))); ?>
										  </td>
											<td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['applicant_first_name']) . ' '.ucfirst($loan['ShortApplication']['applicant_last_name']). '<br/>'.$loan['ShortApplication']['applicant_email_ID']?></p>											
										  </td>
										  <td class="v-align-middle"><?php echo date('jS M, Y',strtotime($loan['Loan']['created']));?></p>											
										  </td>
										  <td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['property_name']). ' - '.$state. ', '.ucfirst($loan['ShortApplication']['property_city']); ?>
										  </td>										  
										  <td><span class="muted"><?php echo $loanReason; ?></span></td>
										  <td><span class="muted"><?php echo $loanAmount; ?></span></td>
										  <td><?php echo $checklist; ?></td>
										  <?php if(!empty($userInfo['user_type']) && $userInfo['user_type'] == 6) { ?>
											<td><?php echo $trustDeedLink; ?></td>
											<td><?php echo $loiLink; ?></td>
											
											<?php } ?>
											<td>
												<?php
												echo '&nbsp;&nbsp;';
												echo $this->Html->link('<i class="fa fa-sitemap"></i>', array('controller'=>'commons', 'action'=>'loan_logs', base64_encode(base64_encode($short_app_id))),array('escape' =>false, 'title'=>'View Loan Logs', 'alt'=>'View Loan Logs'));
												echo '&nbsp;&nbsp;';
												echo $this->Html->link('<i class="fa fa-anchor"></i>', array('controller'=>'commons', 'action'=>'loan_timeline', base64_encode(base64_encode($loan['Loan']['id']))),array('escape' =>false, 'title'=>'View Loan Timeline', 'alt'=>'View Loan Timeline'));
												echo '&nbsp;&nbsp;';
												echo $this->Html->link('<i class="fa fa-eye"></i>','javascript:void(0)',array('escape' =>false, 'title'=>'View Loan Detail', 'alt'=>'View Loan Detail','onclick' =>'return viewDetail('.$loan['Loan']['id'].');'));
												
												//pr($loan); die();
												if(isset($loan['LoanPhase']) && !empty($loan['LoanPhase'])) {
													$funderFlag = 0;
													foreach($loan['LoanPhase'] as $phase) {
														
														if($phase['loan_phase']=='D') {
															
															$funderFlag = 1;
														}
													}
												}
												
												if(isset($loan['LoanPhase']) && !empty($loan['LoanPhase'])) {
													
													foreach($loan['LoanPhase'] as $val) {
														
														$arrPhases[] = $val['loan_phase'];
													}
												}
												//pr($arrPhases);
												if(in_array('C', $arrPhases) && $this->Session->read('userInfo.user_type') == '5') {													
													echo '&nbsp;&nbsp;';
													echo $this->Html->link('<i class="fa fa-flag"></i>', array('controller'=>'processors', 'action'=>'review', base64_encode($loan['Loan']['id'])), array('escape' =>false, 'title'=>'Processor Review', 'alt'=>'Processor Review'));
												}
												
												if(in_array('D', $arrPhases) && $this->Session->read('userInfo.user_type')=='6') {													
													echo '&nbsp;&nbsp;';
													echo $this->Html->link('<i class="fa fa-coffee"></i>', array('controller'=>'funders', 'action'=>'review', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Funder Review', 'alt'=>'Funder Review'));
												}
												
												if($this->Session->read('userInfo.user_type') ==7) {
													
													echo '&nbsp;&nbsp;';
													echo $this->Html->link('<i class="fa fa-glass"></i>', array('controller'=>'tdinvestors', 'action'=>'td_inv_holdreq', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Trust Deed Investment Hold Request', 'alt'=>'Trust Deed Investment Hold Request'));
												}
												
												//if($this->Session->read('userInfo.user_type') ==6) {
												   $holdRequest = $this->Common->investorHoldRequest(base64_encode($loan['Loan']['id']));
												   //pr($holdRequest);
												   if(!empty($holdRequest) && $holdRequest != 0 && $this->Session->read('userInfo.user_type') ==6) {
													  echo '&nbsp;&nbsp;';
													  echo $this->Html->link('<i class="fa fa-glass"></i>', array('controller'=>'commons', 'action'=>'investor_request', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Trust Deed Investor Conditions Requested', 'alt'=>'Trust Deed Investor Conditions Requested'));
												   }
												//}
												
												if(in_array('G', $arrPhases) && $this->Session->read('userInfo.user_type')=='6'){
												   //if ($loan['Loan']['loan_life_cycle_phase'] > 18) {
													
													echo '&nbsp;&nbsp;';
													echo $this->Html->link('<i class="fa fa-briefcase"></i>', array('controller'=>'funders', 'action'=>'loan_document', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Loan Document', 'alt'=>'Loan Document'));
												   //}
													echo '&nbsp;&nbsp;';
													echo $this->Html->link('<i class="fa  fa-folder-open"></i>', array('controller'=>'funders', 'action'=>'doc_order_form', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Doc Order Form', 'alt'=>'Doc Order Form'));
												}
												
												if(in_array('D', $arrPhases)) {
													
													echo '&nbsp;&nbsp;';
													$tombstoneExist = $this->Common->checkTrustDeedTombstone(base64_encode($loan['Loan']['id']));
													if($tombstoneExist > 0) {
														echo $this->Html->link('<i class="fa fa-copy"></i>', array('controller'=>'commons', 'action'=>'download_tombstone', base64_encode($loan['Loan']['id'])),array('escape' =>false, 'title'=>'Download Trust Deed Tombstone', 'alt'=>'Download Trust Deed Tombstone'));
													} else {
														
														echo $this->Html->link('<i class="fa fa-bookmark"></i>', array('controller'=>'commons', 'action'=>'trust_deed_tombstone', base64_encode(base64_encode($loan['Loan']['id']))),array('escape' =>false, 'title'=>'Trust Deed Tombstone', 'alt'=>'Trust Deed Tombstone'));
													}
													
													
												}
												echo $this->Html->link('<i class="fa fa-copy"></i>', array('controller'=>'commons', 'action'=>'reconcile', base64_encode($loan['Loan']['id'])),array('escape' =>false, 'title'=>'Accounting - Loan Sales Comm, Reconiliation, Compliancy', 'alt'=>'Accounting - Loan Sales Comm, Reconiliation, Compliancy'));
												
												?>
											</td>
										</tr>
											<?php											
										}
									} else { ?>
                                        <tr>
                                            <td colspan="8" align="center">No loan for you.</td>
                                        </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
								<?php //echo $this->Form->select('assign_loan', $teams, array('div'=>false, 'label'=>false, 'empty'=>'Select One')); ?>
                              </div>							
							 </div>							
							</div>
							</div>	
						</div>
					</div>
				</div>	
		</div>		
  </div>
  
  <!-- END PAGE --> 
</div>