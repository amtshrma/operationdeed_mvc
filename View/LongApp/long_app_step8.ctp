<!-- Page Content -->
<?php
    echo $this->Html->script('jquery.maskMoney.js');
?>
<script>
jQuery('document').ready(function(){
	jQuery(document).on('focus','.maskIncome',function() {
		jQuery('.maskIncome').maskMoney({allowZero:false, allowNegative:false, defaultZero:true});
	});
});
</script>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Details Of Transaction</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
						<div class="tab-pane fade in active" id="tab1default">
							<div class="col-sm-12">
								<div class="progress"><!-- Progress bar-->
									<div style="width:70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
										<span class="sr-only">70% Complete (success)</span>
									</div>
								</div>
								<!-- /Progress bar-->
								<?php echo $this->Form->create('LongAppBorrowerTransaction',array('novalidate'=>'novalidate','class' => 'form-horizontal step8-frm'));?>
									<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">a. Purchase Price</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_purchase_price',array('label'=>false,'div'=>false,'placeholder'=>'Purchase Price','class'=>'maskIncome totali form-control'));?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">b. Alterations, improvements, repairs</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_repair_improvement',array('label'=>false,'div'=>false,'placeholder'=>'Alterations, improvements, repairs','class'=>'maskIncome totali form-control'));?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">c. Land (if acquired separately)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_land',array('label'=>false,'div'=>false,'placeholder'=>'Land (if acquired separately)','class'=>'maskIncome form-control totali'));?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">d. Refinance (incl. debts to be paid off)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_refinance_debt',array('label'=>false,'div'=>false,'placeholder'=>'Refinance (incl. debts to be paid off)','class'=>'maskIncome totali form-control'));?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">e. Estimated prepaid items</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_estimated',array('label'=>false,'div'=>false,'placeholder'=>'Estimated prepaid items','class'=>' maskIncome form-control totali'));?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">f. Estimated closing costs</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_prepaid_estimate',array('label'=>false,'div'=>false,'placeholder'=>'Estimated prepaid items','class'=>'maskIncome form-control totali'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">g. PMI, MIP, Funding Fee</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_pmi_funding',array('label'=>false,'div'=>false,'placeholder'=>'PMI, MIP, Funding Fee','class'=>'maskIncome form-control totali'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">h. Discount (if Borrower will pay)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_discount',array('label'=>false,'div'=>false,'placeholder'=>'Discount (if Borrower will pay)','class'=>'maskIncome form-control totali'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">i. Total costs (add items a through h)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_total_transaction_a_to_h',array('label'=>false,'div'=>false,'placeholder'=>'Total costs (add items a through h)','class'=>'maskIncome form-control Itotal','readonly'=>true));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">j. Subordinate financing</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_subordinate_financing',array('label'=>false,'div'=>false,'placeholder'=>'Subordinate financing','class'=>'maskIncome form-control psubtract'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">k. Borrower's closing costs paid by Seller</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_costs_pais_by_seller',array('label'=>false,'div'=>false,'placeholder'=>"Borrower's closing costs paid by Seller",'class'=>'maskIncome form-control psubtract'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">l. Other Credits (explain)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_other_credit',array('label'=>false,'div'=>false,'placeholder'=>"Other Credits (explain)",'class'=>'maskIncome form-control psubtract'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">m. Loan amount (exclude PMI, MIP,Funding Fee financed)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_loan_amount_without_fee',array('label'=>false,'div'=>false,'placeholder'=>"Loan amount (exclude PMI, MIP,Funding Fee financed)",'class'=>'maskIncome totalo form-control'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">n. PMI, MIP, Funding Fee financed</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_pmi_funding_fee',array('label'=>false,'div'=>false,'placeholder'=>"PMI, MIP, Funding Fee financed",'class'=>'maskIncome form-control totalo'));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">o. Loan amount (add m &amp; n)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_loan_amount',array('label'=>false,'div'=>false,'placeholder'=>"Loan amount (add m &amp; n)",'class'=>'maskIncome form-control OTotal psubtract','readonly'=>true));?>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-6 control-label">p. Cash from/to Borrower (subtract j,k,l & o from i)</label>
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_final_cash',array('label'=>false,'div'=>false,'placeholder'=>"Cash from/to Borrower (subtract j,k,l & o from i)",'class'=>'maskIncome PTotal form-control','readonly'=>true));?>
										</div>
									</div>
									
									<div class="col-sm-12 btn-top">
										<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right"></span>Next',array('type'=>'submit','class'=>'btn blue sumitButton','escape'=>false));?>
									</div>
								<?php echo $this->Form->end();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
  <!-- /#page-content-wrapper --> 
</div>