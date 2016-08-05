<script type="text/javascript">
   function viewDetail(appid ) {
	  $.ajax({
			type: "POST",
			url: '<?php echo BASE_URL;?>commons/view_short_app',
			data: {"appid": appid},
			success: function(data) {
				$('.modal-content').html(data);
				$("#myModal").modal("show");
			}
		});
    }
</script>

<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3>Short App</h3><hr />
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="emails" > 
                <thead>
                    <tr>
						<th class="small-cell">Sr No.</th>
						<th class="small-cell">Soft Quote</th>
						<th class="small-cell">Borrower Name</th>
                        <th class="small-cell">Borrower Email Address</th>
						<th class="small-cell">Property Location</th>
						<th class="small-cell">Loan Reason</th>
						<th class="small-cell">Loan Amount ($)</th>
						<th class="small-cell">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
					if(count($allApplications)){
						$userData = $this->Session->read('userInfo'); 
                        foreach($allApplications as $key=>$application){
							$short_app_id = $application['ShortApplication']['id'];
							$tempState = $application['ShortApplication']['property_state'];
							$state =  !empty($states[$tempState]) ? $states[$tempState]: '';
							$tempPropertyType = $application['ShortApplication']['property_type'];
							$propertyType =  !empty($propertyTypes[$tempPropertyType]) ? $propertyTypes[$tempPropertyType]:'';
							$tempLoanType = $application['ShortApplication']['loan_type'];
							$loanType =  !empty($loanTypes[$tempLoanType]) ? $loanTypes[$tempLoanType] : '';
							$tempLoanReason = $application['ShortApplication']['loan_reason'];
							$loanReason =  !empty($loanReasons[$tempLoanReason]) ? $loanReasons[$tempLoanReason] : '';
							$loanAmount = $application['ShortApplication']['loan_amount'];
							//$loanAmount =  !empty($loanAmounts[$tempLoanAmount]) ? $loanAmounts[$tempLoanAmount] : '';
							$tempLoanValue = $application['ShortApplication']['loan_to_value'];
							$loanToValue =  !empty($approxLoanValues[$tempLoanValue]) ? $approxLoanValues[$tempLoanValue] :'';
							$city = $this->Common->getCityName($application['ShortApplication']['property_city']);
							?>
							<tr>
								<td class="small-cell v-align-middle"><?php echo $key+1;?></td>
								<td class="small-cell v-align-middle">
								<?php
									$userID = $userData['id'];
									$softQuoteExist = $this->Common->softQuoteExist($application['ShortApplication']['id'], $userID);
									if($softQuoteExist) {
									   echo "Soft Quote <span style='color: green;font-style: italic'>Generated</span>";
									}else {
										echo $this->Html->link('Soft Quote', array('controller'=>'commons','action'=>'soft_quote',base64_encode($application['ShortApplication']['id'])),array('title'=>'Generate Soft Quote'));
									}
								?>
								</td>
								<td class="small-cell v-align-middle">
									<?php echo ucfirst($application['ShortApplication']['applicant_first_name']) . ' '.ucfirst($application['ShortApplication']['applicant_last_name']);?>
								</td>
                                <td class="small-cell v-align-middle">
									<?php echo $application['ShortApplication']['applicant_email_ID'];?>
								</td>
								<td class="small-cell v-align-middle">
									<?php echo ucfirst($application['ShortApplication']['property_address']). ' - '.$state. ', '.$city; ?>
								</td>
								<td class="small-cell v-align-middle"><span class="muted"><?php echo $loanReason; ?></span></td>
								<td class="small-cell v-align-middle"><span class="muted"><?php echo $loanAmount; ?></span></td>
								<td class="small-cell v-align-middle">
									<!--span class="muted"><a onclick="return viewDetail('<?php echo $short_app_id; ?>');" style="cursor:pointer;" title="Review Short App Detail"><i class="fa fa-file"></i></a></span-->
									<span class="muted">
										<?php echo $this->Html->link('<i class="fa fa-eye"></i>',array('controller'=>'commons','action'=>'propertyDetail/'.base64_encode($short_app_id)),array('escape'=>false));?>
									</span>
								</td>
							</tr>
				    <?php }
					}else{?>
                        <tr>
                            <td colspan="8" align="center">No Short App</td>
                        </tr>
                    <?php } ?>
                    </tbody>
            </table>
			<div class="paging" align="right">
			<?php
				if(count($allApplications)){?>
					<ul class="pagination">                
						<li class="disabled">
							<?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?>
						</li>
						<li>
							<?php  echo $this->Paginator->numbers(array('separator' => ''));?>
						</li>
						<li>
							<?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?>
						</li>
					</ul>
			<?php
				}                
			?>
			</div>
		</div>	
	</div>	
<!-- END PAGE --> 
</div>