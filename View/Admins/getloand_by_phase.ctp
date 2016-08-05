<div class="table-responsive whiteBG">
	<table class="table table-bordered table-hover" id="Loans" > 
		<thead>
			<tr>
				<th class="small-cell">Sr No.</th>
				<th class="small-cell">Team</th>
				<th class="small-cell">Borrower</th>
				<th class="small-cell">Property Location</th>
				<th class="small-cell">Loan Reason</th>
				<th class="small-cell">Amount ($)</th>
			</tr>
		</thead>
		<tbody>
		<?php
	if(count($loanDetailFull)){
		foreach($loanDetailFull as $i => $loan) {?>
			<tr>
				<td class="small-cell v-align-middle"><?php echo $i+1;?></td>
				<td class="small-cell v-align-middle">
					<?php
						$teamId = $loan['Loan']['team_id'];
						$teamName = $this->Common->getTeamName($teamId);
						echo $teamName
					?>
				</td>
				<td class="small-cell v-align-middle">
					<?php
						echo $this->Html->link(ucfirst($loan['ShortApplication']['applicant_first_name']) . ' '.ucfirst($loan['ShortApplication']['applicant_last_name']),array('controller'=>'users','action'=>'view_user',base64_encode(base64_encode($loan['Loan']['borrower_id'])),'admin' => true),array('target'=>'blank')). '<br/>'.$loan['ShortApplication']['applicant_email_ID']?></p>	
				</td>
				<td class="small-cell v-align-middle">
					<?php echo ucfirst($loan['ShortApplication']['property_address']). ' - '.ucfirst($this->Common->getStateName($loan['ShortApplication']['property_state'])). ', '.ucfirst($this->Common->getCityName($loan['ShortApplication']['property_city']));?>
				</td>										  
				<td class="small-cell v-align-middle"><span class="muted">
					<?php
						$tempLoanReason = $loan['ShortApplication']['loan_reason'];
						echo !empty($tempLoanReason) ? $loanReasons[$tempLoanReason]:'';
					?></span>
				</td>
				<td class="small-cell v-align-middle"><span class="muted">$<?php echo $loan['ShortApplication']['loan_amount']; ?></span></td>
			</tr>
		<?php
	}
	}else{?>
		<tr>
			<td colspan="8" align="center">No loan for you.</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>