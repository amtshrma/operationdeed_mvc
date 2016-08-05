<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
		<div class="row">
			<span class="pull-right">
				<?php echo $this->Html->link('<button class="btn btn-lg btn-primary" type="button"><span class="glyphicon" style="color:#8ecaf9"></span>Approve Condition</button>','javascript:void(0);',array('escape' => false,'title' => 'Approve Condition','style'=>'padding:10px;','class'=>'pull-right','id'=>'approveTDInvestorRequest')); ?>
			</span>
		</div>
		<?php echo $this->Form->create('LoanHoldRequest', array('novalidate' => true,'id'=>'trustDeedInvHoldReqForm','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data'));
		echo $this->Form->input('holdRequestID', array('name'=>"holdRequestID",'type' => 'hidden','value'=>base64_encode($holdReqs[0]['LoanHoldRequest']['id']),'id'=>'holdRequestID'));
		echo $this->Form->input('loanID', array('name'=>"loanID",'type' => 'hidden','value'=>base64_encode($holdReqs[0]['LoanHoldRequest']['loan_id']),'id'=>'loanID'));
		?>
		<div class="row">
			<?php echo $this->Session->flash();?>
			<div id="investorRequestContainer">
			<?php  
			foreach($holdReqs as $key => $holdReq) {
				$investorDetail = $this->Common->getUserDetail($holdReq['LoanHoldRequest']['hold_by']);
				$managerID = $holdReq['LoanHoldRequest']['inv_manager_refby'];
				$managerDetail = $this->Common->getUserDetail($managerID);
				$mangerName = (!empty($managerDetail['User']['name'])) ? $managerDetail['User']['name'] : '';
				$investorType = '';
				$loanID = "'".base64_encode(base64_encode($holdReq['LoanHoldRequest']['loan_id']))."'";
				if($holdReq['LoanHoldRequest']['investor_type'] == 'full_trust_deed') {
					$investorType = 'Full Trust Deed';
				}else if($holdReq['LoanHoldRequest']['investor_type'] == 'fractional_trust_deed') {
					$investorType = 'Fractional Trust Deed  - '.$holdReq['LoanHoldRequest'] ['inv_type_fraction'] . '%';
				}
				if($holdReq['LoanHoldRequest']['add_doc_need'] == '1') {
					$documentationNeeded = 'Yes';
				}else if($holdReq['LoanHoldRequest']['add_doc_need'] == '0') {
					$documentationNeeded = 'No';
				}
				?>
				<h3><?php echo $investorDetail['User']['name'] .' Hold Request' ;?> -- Click Here to View</h3>
				<div>
					<p>Investment Manager Referred by  <b> : </b> <?php echo $mangerName; ?> </p>
					<br />
					<p>Investor Type <b> : </b> <?php echo $investorType; ?></p>
					<br />
					<p>Fractional Requested Standby Hold <b> : </b> <?php echo $holdReq['LoanHoldRequest']['fr_req_hold'].'- weeks'; ?></p>
					<br />
					<p>48-hour Hold Requested (Full Only) <b> : </b> <?php echo $holdReq['LoanHoldRequest']['hrs_hold_req']; ?></p>
					<br />
					<p>Needed Yield Requested To Hold <b> : </b> <?php echo $holdReq['LoanHoldRequest']['yld_req_tohold']; ?></p>
					<br />
					<p>Needed Term Requested To Hold <b> : </b> <?php echo $holdReq['LoanHoldRequest']['term_req_tohold']; ?></p>
					<br />
					<p>Needed Loan Amount Requested To Hold <b> : </b>  <?php echo !empty($holdReq['LoanHoldRequest']['loanamt_req_tohold']) ? $holdReq['LoanHoldRequest']['loanamt_req_tohold'] : ''; ?></p>
					<br />
					<p>Back-up Hold Requested (Order Received) <b> : </b> <?php echo $holdReq['LoanHoldRequest']['bkup_hold_req']; ?></p>
					<br />
					<p>Requesting Access to Full Loan File <b> : </b> <?php echo $holdReq['LoanHoldRequest']['req_access_flf']; ?></p>
					<br />
					<p>Additional Documentation <b> : </b> <?php echo $documentationNeeded; ?></p>
					<br />
					<p>Commiting to fund within Days of Full File <b> : </b> <?php echo $holdReq['LoanHoldRequest']['file_fund_days']; ?></p>
					<br />
					<?php
					if(!empty($holdReq['CounterOffer'])){
						echo '<h3>Counter Option / Offer</h3><br />';
						foreach($holdReq['CounterOffer'] as $key => $field) {
						   $acceptLink = $declineLink = '';
							echo '<div class="col-lg-12">';
							if(isset($field['label']) && $field['label'] != ''){
								$acceptLink = '<a class="greenText" href="javascript:void(0);" onclick="return accept('.$field['id'].','.$loanID.');">Accept</a>';
								$declineLink = '<a class="redText" href="javascript:void(0);" onclick="return decline('.$field['id'].','.$loanID.');">Decline</a>';
								echo  '<div class="form-group col-lg-3">'.$field['label'].'</div>';
								echo  '<div class="form-group col-lg-3">'.$field['offer'].'</div>';
								echo  '<div class="form-group col-lg-3">'.$field['expiration_date'].'</div>';
								
								if($this->Session->read('userInfo.user_type') == 6){
									$status = $field['status'];
									if($status == 2) {
										$acceptLink = 'Offer Accepted';
										$declineLink = '';
									}elseif($status == 1) {
										$acceptLink = '';
										$declineLink = 'Offer Declined';
									}
									
									echo  '<div class="form-group col-lg-3">'.$acceptLink.'&nbsp;&nbsp;'.$declineLink.'</div>';
								}
								
							}
							echo "</div>";
						}
					}
				echo '</div>';
			}  ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>	
</div>
    
<!-- END PAGE --> 

<script>
    jQuery('.investor_type').click(function(e) {
        if(jQuery(this).val()=='fractional_trust_deed') {
            jQuery('.invtype').removeClass('hide');
        } else {
            jQuery('.invtype').addClass('hide');
        }
    });
</script>
<style>
	div.ui-accordion-content{
		border: none;
	}
	div#investorRequestContainer h3[aria-expanded="false"]{
		background: #334148;
		color: #fff;
	}
</style>