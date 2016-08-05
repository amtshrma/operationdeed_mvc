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
								<?php echo $this->Session->flash();?> 
								<!--
								<div class="col-md-9"><h2 class=" inline">Loan </h2></div>
								<div class="col-md-3"><?php //echo $this->Form->select('assign_loan', $teams, array('div'=>false, 'label'=>false, 'empty'=>'Select One')); ?></div>
								<div class="pull-right margin-top-20">
									<div class="dataTables_paginate paging_bootstrap pagination">
										<ul>
											<li class="prev disabled"><a href="#"><i class="fa fa-chevron-left"></i></a></li>
											<li class="active"><a href="#">1</a></li><li><a href="#">2</a></li>
											<li class="next"><a href="#"><i class="fa fa-chevron-right"></i></a></li>
										</ul>
									</div>
									<div class="dataTables_info hidden-xs" id="example_info">Showing <b>1 to 10</b> of 14 entries</div></div-->
									<div class="clearfix"></div>
								</div>
								
								 <div class="grid-body ">
								<table class="table table-bordered table-condensed" id="example">
                                  <thead>
                                    <tr>
                                      <th style="width:3%">
										<div class="checkbox check-default">
											<input id="checkall" type="checkbox" value="1" class="checkall">
											<label for="checkall"></label>
										</div></th>
                                      <th style="width:8%">Team</th>
									  <th style="width:8%">Borrower Name</th>
                                      <th style="width:8%" data-hide="phone,tablet">Property Location</th>
                                      
                                      <th style="width:8%" data-hide="phone,tablet">Loan Reason</th>
                                      <th style="width:8%" data-hide="phone,tablet">Loan Amount</th>
                                      <th style="width:8%" data-hide="phone,tablet">Documents</th>
									  <?php $userInfo  = $this->Session->read('userInfo');
										if(!empty($userInfo['user_type']) && $userInfo['user_type'] == 6){
											  echo '<th style="width:8%" data-hide="phone,tablet">Trust Deed Flyer</th>';
											  echo '<th style="width:8%" data-hide="phone,tablet">LOI</th>';
										} ?>
					
                                    </tr>
                                  </thead>
                                  <tbody>
                                 <?php if(count($allLoans)>0){
									$i=0;
                                    foreach($allLoans as $loan) {
										$short_app_id=$loan['ShortApplication']['id'];
										$shortapploanofficer=$this->Common->shortapp_checkloanuser($short_app_id);
										$loggedinid=$_SESSION['userInfo']['id'];
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
										if(!empty($shortapploanofficer)){
											if($shortapploanofficer == $loggedinid){
											?>
										<tr>
											<td class="v-align-middle">
												<div class="checkbox check-default">
													<input id="checkbox<?php echo $i; ?>" type="checkbox" value="<?php echo base64_encode(base64_encode($loan['Loan']['id'])); ?>" class="chld">
													<label for="checkbox<?php echo $i; ?>"></label>
												</div>											
											</td>
											<td>
												<?php echo 'Team Name'; ?>
											</td>
											<td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['applicant_first_name']) . ' '.ucfirst($loan['ShortApplication']['applicant_last_name']);?></p>
											
										  </td>
										  <td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['property_name']). ' - '.$state. ', '.ucfirst($loan['ShortApplication']['property_city']); ?>
										  </td>
										  
										  <td><span class="muted"><?php echo $loanReason; ?></span></td>
										  <td><span class="muted"><?php echo $loanAmount; ?></span></td>
										  <td><?php echo $this->Html->link('Ask Document', array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']))); ?></td>
										  <?php if(!empty($userInfo['user_type']) && $userInfo['user_type'] == 6){ ?>
										   <td><?php echo $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',base64_encode($loan['Loan']['id']))); ?></td>
											<td><?php echo $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi')); ?></td>
											<?php } ?> 
										</tr>
										<?php
										} }else { ?>
										<tr>
										  <td class="v-align-middle">
										    <div class="checkbox check-default">
												<input id="checkbox<?php echo $i; ?>" type="checkbox" value="<?php echo base64_encode(base64_encode($loan['Loan']['id'])); ?>" class="chld">
												<label for="checkbox<?php echo $i; ?>"></label>
											</div>
										  </td>
										  <td>
											<?php echo 'Team Name'; ?>
										  </td>
										  <td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['applicant_first_name']) . ' '.ucfirst($loan['ShortApplication']['applicant_last_name']);?></p> </td>
										  <td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['property_name']). ' - '.$state. ', '.ucfirst($loan['ShortApplication']['property_city']); ?></td>
										  <td><span class="muted"><?php echo $loanReason; ?></span></td>
										  <td><span class="muted"><?php echo $loanAmount; ?></span></td>
										  <td><?php echo $this->Html->link('Ask Document', array('controller'=>'commons','action'=>'ask_document',base64_encode($loan['ShortApplication']['id']),base64_encode($loan['Loan']['id']))); ?></td>
										  <?php if(!empty($userInfo['user_type']) && $userInfo['user_type'] == 6){ ?>
											<td><?php echo $this->Html->link('Create Trust Deed', array('controller'=>'commons','action'=>'trust_deed',base64_encode($loan['Loan']['id']))); ?></td>
											<td><?php echo $this->Html->link('Letter of Intent (LOI)', array('controller'=>'lois','action'=>'loi')); ?></td>
											<?php } ?> 
										</tr>
										<?php } $i++;} } else {?>
                                        <tr>
                                            <td colspan="4">No Short App</td>
                                        </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
								<?php echo $this->Form->select('assign_loan', $teams, array('div'=>false, 'label'=>false, 'empty'=>'Select One')); ?>
                              </div>							
							 </div>							
							</div>
							</div>	
						</div>
					</div>
				</div>	
		</div>		
  </div>
  
  <!-- Trigger the modal with a button 
  <h2>Small Modal</h2>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button>
  -->
  <!-- END PAGE --> 
</div>

