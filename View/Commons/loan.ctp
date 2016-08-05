<?php echo $this->Html->css('front/circle');?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3>Loans</h3><hr />
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="Loans" > 
            <thead>
                <tr>
					<th class="small-cell">Sr No.</th>
					<th class="small-cell">Team</th>
					<th class="small-cell">Borrower</th>
					<th class="small-cell">Date</th>
					<th class="small-cell">Property Location</th>
					<th class="small-cell">Loan Reason</th>
					<th class="small-cell">Amount ($)</th>
					<th class="small-cell">Tracking</th>
					<th class="small-cell">Action</th>
					<th class="small-cell">Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php
				if(count($allLoans)){ 
					foreach($allLoans as $i => $loan) { 
						$shortAppExist = $this->Common->shortAppExist($loan['Loan']['id']);
						if($shortAppExist == 1) { 
							$checklist = $trustDeedLink = $loiLink = $loanPhase = $shortapploanofficer = $trustDeedDetail = $tombstoneExist = $arrPhases = '';
							$short_app_id = $loan['ShortApplication']['id'];
							$shortapploanofficer = $this->Common->shortapp_checkloanuser($short_app_id);
							$loanID = base64_encode($loan['Loan']['id']);
							$logged_in_id = $this->Session->read('userInfo.id');
							$link = $this->Common->getLoanProcessLink($loanID,$logged_in_id );
							$loanPhase = $this->Common->getDocumentSatus($loanID, 'B');
							$userDetail = $this->Common->getUserDetail($logged_in_id);
							$softQuoteDetail = $this->Common->getSoftQuoteDetail($loan['Loan']['soft_quate_id']);
							$tempState = $loan['ShortApplication']['property_state'];
							$state =  !empty($tempState) ? $states[$tempState] : '';
							$tempPropertyType = $loan['ShortApplication']['property_type'];
							if(!empty($propertyTypes[$tempPropertyType])){
								$propertyType =  $propertyTypes[$tempPropertyType];
							}
							$tempLoanType = $loan['ShortApplication']['loan_type'];
							if(!empty($loanTypes[$tempLoanType])){
								$loanType =  $loanTypes[$tempLoanType];
							}
							$tempLoanReason = $loan['ShortApplication']['loan_reason'];
							$loanReason =  !empty($tempLoanReason) ? $loanReasons[$tempLoanReason]:'';
							//$tempLoanAmount = $loan['ShortApplication']['loan_amount'];
							//$loanAmount =  $loanAmounts[$tempLoanAmount];
							if(!empty($softQuoteDetail['SoftQuote']['loan_amount'])){
							   $loanAmount = $softQuoteDetail['SoftQuote']['loan_amount'];
							}else{
							   $loanAmount = $loan['ShortApplication']['loan_amount'];
							}
							$tempLoanValue = $loan['ShortApplication']['loan_to_value'];
							if(!empty($approxLoanValues[$tempLoanValue])){
								$loanToValue =  $approxLoanValues[$tempLoanValue];
							}
							?>
							<tr>
							   <td class="small-cell v-align-middle"><?php echo $i+1;?></td>
							   <td class="small-cell v-align-middle"><?php
									$teamId = $loan['Loan']['team_id'];
									$teamName = $this->Common->getTeamName($teamId);
									echo $teamName
								  ?>
							   </td>
							   <td class="small-cell v-align-middle">
									<?php echo ucfirst($loan['ShortApplication']['applicant_first_name']) . ' '.ucfirst($loan['ShortApplication']['applicant_last_name']). '<br/>'.$loan['ShortApplication']['applicant_email_ID']?></p>	
							   </td>
							   <td class="small-cell v-align-middle"><?php echo date('jS M, Y',strtotime($loan['Loan']['created']));?></td>
							   <td class="small-cell v-align-middle">
								  <?php echo ucfirst($loan['ShortApplication']['property_address']). ' - '.$state. ', '.ucfirst($this->Common->getCityName($loan['ShortApplication']['property_city']));
								?>
								</td>										  
								<td class="small-cell v-align-middle"><span class="muted"><?php echo $loanReason; ?></span></td>
							    <td class="small-cell v-align-middle"><span class="muted"><?php echo $loanAmount; ?></span></td>
							  <?php 
								echo '<td class="small-cell v-align-middle">';
								$loanPercentage = $this->Common->getLoanPercentage(base64_encode($loan['Loan']['id']));
								$loanClass = 'redText';
								if($loanPercentage > 40 && $loanPercentage < 70){
									$loanClass = 'yellowText';
								}else if($loanPercentage > 70 && $loanPercentage < 100){
									$loanClass = 'blueText';
								}else if($loanPercentage == 100){
									$loanClass = 'greenText';
								}
								
								echo "<div class='c100 p$loanPercentage small green'><span>$loanPercentage%</span><div class='slice'><div class='bar'></div><div class='fill'></div></div></div>";
								echo '<br /><p style="text-align : center;">';
								echo $this->Html->link('<i class="fa fa-sitemap"></i>', array('controller'=>'commons', 'action'=>'loan_logs', base64_encode(base64_encode($short_app_id))),array('escape' =>false, 'title'=>'View Loan Logs', 'alt'=>'View Loan Logs'));
								echo '&nbsp;&nbsp;';
								echo $this->Html->link('<i class="fa fa-anchor"></i>', array('controller'=>'commons', 'action'=>'loan_timeline', base64_encode(base64_encode($loan['Loan']['id']))),array('escape' =>false, 'title'=>'View Loan Timeline', 'alt'=>'View Loan Timeline'));
								echo '</p></td>';
								echo '<td class="small-cell v-align-middle">';
								echo '&nbsp;&nbsp;';
								echo $this->Html->link($link['name'], $link['url'],$link['attr']);
							?>
							</td>
							<td><?php
							$futureLoanPhase = $this->Common->getFutureLoanPhase($loan['Loan']['loan_life_cycle_phase']);
							echo !empty($futureLoanPhase) ?  '<b>Loan Status : </b>  <span class="hint greenText justify">' .$futureLoanPhase : '' ; ?></span></td>
						</tr>
					<?php											
						}
					}
				}else{?>
					<tr>
						<td colspan="10" align="center">No loan for you.</td>
					</tr>
			<?php } ?>
				</tbody>
			</table>
			<div class="paging" align="right">
			<?php
				if(count($allLoans)){?>
					<ul class="pagination">                
						<li class="disabled"><?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?></li>
						<li><?php  echo $this->Paginator->numbers(array('separator' => ''));?></li>
						<li><?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?></li>
					</ul>             
			<?php } ?>
			</div>
			<?php //echo $this->Form->select('assign_loan', $teams, array('div'=>false, 'label'=>false, 'empty'=>'Select One')); ?>
		</div>		
	</div>
  <!-- END PAGE --> 
</div>