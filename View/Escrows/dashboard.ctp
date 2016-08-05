<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <h3>Upload Documents</h3><hr />
        <div class="row">
			<p><?php echo $this->Session->flash();?></p>
            <div class="table-responsive">
				<table class="table table-bordered table-hover" id="Loans" >
				<?php
					if(count($escrowLoans) >0 ){ ?>
						<thead>
							<th style="width:8%">Borrower</th>
							<th style="width:8%" data-hide="phone,tablet">Loan Date</th>
							<th style="width:8%" data-hide="phone,tablet">Property Location</th>
							<th style="width:8%" data-hide="phone,tablet">Loan Reason</th>
							<th style="width:8%" data-hide="phone,tablet">Loan Amount</th>
							<th style="width:8%" data-hide="phone,tablet">Action</th>
						</thead>
						<tbody>
							<?php 
							foreach($escrowLoans as $key =>$escrowLoan) {
								$loanID = $escrowLoan['LoanProcessDetail']['loan_id'];
								$loan = $this->Common->getLoanDetail($loanID);
								$tempState = $loan['ShortApplication']['property_state'];
								$state =  !empty($tempState) ? $states[$tempState]:'';
								$tempPropertyType = ucfirst(str_replace('_', ' ' ,$loan['ShortApplication']['property_type']));
								$tempLoanType = $loan['ShortApplication']['loan_type'];
								$loanType =  $loanTypes[$tempLoanType];
								$tempLoanReason = $loan['ShortApplication']['loan_reason'];
								$loanReason =  !empty($tempLoanReason) ? $loanReasons[$tempLoanReason]:'';
								$tempLoanAmount = $loan['ShortApplication']['loan_amount'];
								
								$link = $this->Common->getEscrowLoanLink($loanID, $this->Session->read('userInfo.id'));
							?>
							<tr>
								<td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['applicant_first_name']) . ' '.ucfirst($loan['ShortApplication']['applicant_last_name']). '<br/>'.$loan['ShortApplication']['applicant_email_ID']?></p></td>
								<td class="v-align-middle">
									<?php echo date('jS M, Y',strtotime($loan['Loan']['created']));?></p>											
								</td>
								<td class="v-align-middle"><?php echo ucfirst($loan['ShortApplication']['property_address']). ' - '.$state. ', '.ucfirst($loan['ShortApplication']['property_city']); ?>
								</td>										  
								<td><?php echo $loanReason; ?></td>
								<td><?php echo $tempLoanAmount; ?></td>
								<td><?php echo $this->Html->link($link['name'], $link['url'],$link['attr']); ?></td>
							</tr>
						<?php
						}
						echo "</tbody>";
					}else{
						echo "<tr colspan='6'>No loans for you</tr>";
					}
					?>
				</table>
            </div>
        </div>  
    </div>
</div>