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
	<div class="page-title" style="display:none"> <a href="#" id="btn-back"><i class="icon-custom-left"></i></a>
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
											
											echo '<th style="width:8%" data-hide="phone,tablet">LOI</th>';
											echo '<th style="width:8%" data-hide="phone,tablet">Trust Deed Flyer</th>';
										} ?>
										<th style="width:8%" data-hide="phone,tablet">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                 <?php
								 if(count($allLoans)>0) {
									$checklist = '';
                                    foreach($allLoans as $i => $loan) { 
										$short_app_id = $loan['ShortApplication']['id'];
										$shortapploanofficer = $this->Common->shortapp_checkloanuser($short_app_id);
										$loanID = base64_encode($loan['Loan']['id']);
										$loanPhase = $this->Common->getDocumentSatus($loanID, 'B');
										$loggedinid = $_SESSION['userInfo']['id'];
										$userDetail = $this->Common->getUserDetail($loggedinid);
                                        $tempState = $loan['ShortApplication']['property_state'];
										$state =  $states[$tempState];
										$tempPropertyType = $loan['ShortApplication']['property_type'];
										$propertyType =  $propertyTypes[$tempPropertyType];
										$tempLoanType = $loan['ShortApplication']['loan_type'];
										$loanType =  $loanTypes[$tempLoanType];
										$tempLoanReason = $loan['ShortApplication']['loan_reason'];
										$loanReason =  $loanReasons[$tempLoanReason];
										$tempLoanAmount = $loan['ShortApplication']['loan_amount'];
										$loanAmount =  $loanAmounts[$tempLoanAmount];
										$tempLoanValue = $loan['ShortApplication']['loan_to_value'];
										$loanToValue =  $approxLoanValues[$tempLoanValue];
										// start checklist link
										if(!empty($loan['Loan']['team_id'])) {
											if(empty($loanPhase)){
												//echo $shortapploanofficer . ', '. $loggedinid;
												if(!empty($shortapploanofficer) &&  ($shortapploanofficer != $loggedinid)){
													$detail = $this->Common->getUserDetail($shortapploanofficer);
													$checklist = 'Processor Check-list Document Requested by '.$detail['User']['name'];
												}elseif(!empty($shortapploanofficer) && ($shortapploanofficer == $loggedinid)) {
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
										} else {
											$checklist = $this->Html->link('Processor Check-list Document Request', array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']))); 
										}
										//end  checklist link
										
										//start trust deed link 
										if(!empty($loan['Loan']['team_id'])) {
											$loiConditionSatisfied = $this->Common->checkLOICondition($loan['Loan']['id']);
											
											$loiPublishedUserId = $loiConditionSatisfied['Loi']['user_id'];
											$detail = $this->Common->getUserDetail($loiPublishedUserId);
											
											if(empty($loanPhase)){ 
												
												//echo $trustDeedUserID . ', '. $loggedinid;
												if(!empty($loiConditionSatisfied) &&  ($loiPublishedUserId != $loggedinid)){
													$loiLink = 'LOI created';
												}elseif(!empty($loiConditionSatisfied) && ($loiPublishedUserId == $loggedinid)) {
													
													$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
												}elseif(empty($loiConditionSatisfied) && $loanPhase == 1) {
													
													$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
												}else {
													
													$loiLink = 'In-Process';
												}
											} elseif(!empty($loanPhase) && $loanPhase == 1){ 
												$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
											} else {
												$loiLink = 'In-Process';
											}
										} elseif(!empty($loanPhase) && $loanPhase == 1){
											$loiLink = $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi',$loanID));
										}
										//end loi link
										
										//start Trust deed Link
										if(!empty($loan['Loan']['team_id'])) {
											$trustDeedDetail = $this->Common->checkTrustDeed($loan['Loan']['id']);
											$loiConditionSatisfied = $this->Common->checkLOICondition($loan['Loan']['id']);
											$trustDeedUserID = $trustDeedDetail['TrustDeed']['user_id'];
											$userdetail = $this->Common->getUserDetail($trustDeedUserID);			
											//if Letter of Intent (LOI) - Conditions Satisfied, we check if trust deed is already created and logged in user Id is same as trust deed user Id
											if(!empty($loiConditionSatisfied) && $loiConditionSatisfied['Loi']['condition_satisfied'] == '1'){
												if(!empty($trustDeedDetail) &&  ($trustDeedUserID != $loggedinid)){
													$trustDeedLink = 'Trust Deed drafted by '.$userdetail['User']['name'];
									
												}elseif(!empty($trustDeedDetail) && ($trustDeedUserID == $loggedinid)) {
													$trustDeedLink = $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',$loanID,base64_encode(base64_encode($trustDeedDetail['TrustDeed']['id']))));
													
												}elseif(empty($trustDeedDetail) && !empty($loiConditionSatisfied) && $loiConditionSatisfied['Loi']['condition_satisfied'] == '1') {
													$trustDeedLink = $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',$loanID,base64_encode(base64_encode($trustDeedDetail['TrustDeed']['id']))));
												}else {
													$trustDeedLink = 'In-Process';
												}
											}else {
												$trustDeedLink = 'In-Process';
											}
										}
										
										//end Trust deed Link
										
										?>
										<tr>
											<td>
											<?php //pr($loan);
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
										  <?php if(!empty($userInfo['user_type']) && $userInfo['user_type'] == 6){ ?>
											<td><?php echo $loiLink; ?></td>
											<td><?php echo $trustDeedLink; ?></td>
											
											
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
												
												$arrLoanPhase = $reverse = array_reverse($loan['LoanPhase'], false);
												$currentLoanPhase = isset($arrLoanPhase[0]['loan_phase'])?$arrLoanPhase[0]['loan_phase']:'';
												//if($this->Session->read('userInfo.user_type'=='6')) {
													
													// && $funderFlag=='1'
												
												if($currentLoanPhase=='C') {
													
													echo '&nbsp;&nbsp;';
													echo $this->Html->link('<i class="fa fa-flag"></i>', array('controller'=>'processors', 'action'=>'review', base64_encode($loan['Loan']['id'])), array('escape' =>false, 'title'=>'Processor Review', 'alt'=>'Processor Review'));
												}
												
												if($currentLoanPhase=='D') {
													
													echo '&nbsp;&nbsp;';
													echo $this->Html->link('<i class="fa fa-coffee"></i>', array('controller'=>'funders', 'action'=>'review', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Funder Review', 'alt'=>'Funder Review'));
												}
												
												
												if($this->Session->read('userInfo.user_type'=='7')) {
												echo '&nbsp;&nbsp;';
												echo $this->Html->link('<i class="fa fa-glass"></i>', array('controller'=>'tdinvestors', 'action'=>'td_inv_holdreq', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Trust Deed Investment Hold Request', 'alt'=>'Trust Deed Investment Hold Request'));
												}
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