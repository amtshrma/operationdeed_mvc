<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3><span class="semi-bold">Loans</span></h3>
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
					<th class="small-cell">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
				if(count($allLoans)){ 
					foreach($allLoans as $i => $loan) {
						$shortAppExist = $this->Common->shortAppExist($loan['Loan']['id']);
						if($shortAppExist == 1) { 
							$checklist = $trustDeedLink = $loiLink = $loanPhase = $trustDeedDetail = $tombstoneExist = $arrPhases = '';
							$short_app_id = $loan['ShortApplication']['id'];
							//$shortapploanofficer = $this->Common->shortapp_checkloanuser($short_app_id);
							$loanID = base64_encode($loan['Loan']['id']);
							$logged_in_id = $this->Session->read('userInfo.id');
							$link = $this->Common->getBorrowerLoanLink($loanID, $logged_in_id );
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
							  <?php /*
							  <td><?php echo $checklist; ?></td>
							  <?php //if(!empty($userInfo['user_type']) && $userInfo['user_type'] == 6) { ?>
								<td><?php echo $trustDeedLink; ?></td>
								<td><?php echo $loiLink; ?></td>
								
							<?php //} ?>
							*/
							echo '<td class="small-cell v-align-middle">';
								echo '&nbsp;&nbsp;';
								echo $this->Html->link('<i class="fa fa-sitemap"></i>', array('controller'=>'commons', 'action'=>'loan_logs', base64_encode(base64_encode($short_app_id))),array('escape' =>false, 'title'=>'View Loan Logs', 'alt'=>'View Loan Logs'));
								echo '&nbsp;&nbsp;';
								echo $this->Html->link('<i class="fa fa-anchor"></i>', array('controller'=>'commons', 'action'=>'loan_timeline', base64_encode(base64_encode($loan['Loan']['id']))),array('escape' =>false, 'title'=>'View Loan Timeline', 'alt'=>'View Loan Timeline'));
								echo '&nbsp;&nbsp;';
							echo '</td>';
							echo '<td class="small-cell v-align-middle">';
							   //echo $this->Html->link('<i class="fa fa-eye"></i>','javascript:void(0)',array('escape' =>false, 'title'=>'View Loan Detail', 'alt'=>'View Loan Detail','onclick' =>'return viewDetail('.$loan['Loan']['id'].');'));
							   echo '&nbsp;&nbsp;';
							   echo $this->Html->link($link['name'], $link['url'],$link['attr']);
							   /*echo '&nbsp;&nbsp;';
							   echo $this->Html->link('<i class="fa fa-briefcase"></i>', array('controller'=>'funders', 'action'=>'loan_document', base64_encode(base64_encode($loan['Loan']['id']))), array('escape' =>false, 'title'=>'Loan Document', 'alt'=>'Loan Document'));*/
							
							?>
							</td>
							<td><span class="hint"><?php echo !empty($loanPhases[$loan['Loan']['loan_life_cycle_phase']]) ?  '<b>Loan Status : </b>  ' .$loanPhases[$loan['Loan']['loan_life_cycle_phase']] : 'In Process' ; ?></span></td>
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