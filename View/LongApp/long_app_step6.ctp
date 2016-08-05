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
<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Borrower / Co-Borrower Assets And Liabilities</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="progress"><!-- Progress bar-->
								<div style="width:50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" 
						class="progress-bar progress-bar-success progress-bar-striped"> <span class="sr-only">50% Complete (success)</span> </div>
							</div>
							<!-- /Progress bar-->
							<h2>Borrower Assests / Liabilities</h2><hr />
							<div class="row">
								<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
								<div class="col-sm-12">
								  <p>This statement and any applicable supporting schedules may be completed jointly by both
									married and unmarried Co-Borrowers if their assets and liabilities are sufficiently joined so 
									that the Statement can be meaningfully and fairly presented on a combined basis; otherwise,
									separate Statements and Schedules are required. If the Co-Borrower section was completed 
									about a non-applicant spouse or other person, this Statement and supporting schedules
									must be completed about that spouse and other person also.</p>
								</div>
								<?php echo $this->Form->create('LongAppBorrowerEmploymentInfo',array('novalidate'=>'novalidate','class' => 'form-inline step6-frm'));?>
									<div class="form-group wd col-sm-12 text-rt com">
										<label class="checkbox-inline">
											<input type="checkbox"  name="data[LongAppBorrowerEmploymentInfo][account_type]" value="completed">Completed
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="data[LongAppBorrowerEmploymentInfo][account_type]" value="jointly">Jointly
										</label>
										<label class="checkbox-inline">
											<input type="checkbox"  name="data[LongAppBorrowerEmploymentInfo][account_type]" value="not_jointly">Not Jointly
										</label>
									</div>
									<div class="col-sm-6">
										<h5>
											List checking and savings accounts below
										</h5>
									</div>
									<div class="col-sm-6">
										<?php  echo $this->Html->link('Add Account <span class="glyphicon glyphicon-plus"></span>','javascript:void(0)',array('class'=>'addMoreAccount','title'=>'Click to add more account','onclick'=>'addMoreBankOption();','escape'=>false,'style'=>'float: right;'));?>
									</div>
									
									<div class="row assetRow">
										<?php echo $this->Form->hidden("option_count",array("value"=>'0',"id"=>"optionsBankCount"));?>
										<div id="firstRow">
											<div class="form-group wd mr-20">
												<div class="col-sm-8">
													<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.bank_name.0',array('label'=>false,'div'=>false,'placeholder'=>'Name of Bank, S&L or Credit Union','class'=>'form-control','title'=>'Name of Bank,S&L or Credit Union'));?>
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.account_no.0',array('label'=>false,'div'=>false,'placeholder'=>'Acct No.','class'=>'form-control','title'=>'Acct No.'));?>
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.amount.0',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'liquidAssests maskIncome form-control','title'=>'Amount'));?>
												
												</div>
											</div>
											<div class="form-group wd">
												<div class="col-sm-5">
													<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.bank_address.0',array('label'=>false,'div'=>false,'placeholder'=>'Bank, S&L or Credit Union Address','class'=>'form-control','title'=>'Bank,S&L or Credit Union Address'));?>
													
												</div>
												<div class="col-sm-3">
													<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.bank_city.0',array('label'=>false,'div'=>false,'placeholder'=>'City','class'=>'form-control','title'=>'City'));?>
	
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.bank_state.0',array('label'=>false,'div'=>false,'title'=>'State','class'=>'form-control selectpicker stateOption','empty'=>'Select State','options'=>$states));?>
													
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.bank_zip_code.0',array('label'=>false,'div'=>false,'placeholder'=>'Zip Code','class'=>'form-control','title'=>'Zip Code','style'=>'width: 70%;float: left;'));?>
													<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i>',"javascript:void(0);",array('title'=>'Remove Bank Detail','style' => 'display:none;margin-top: 12px;text-align: center;','escape'=>false));?>
												</div>
											</div>
										</div>
										<div id="otherOptions"></div>
									</div>
									<div id="accountContainer"></div>
									<div class="stock">
										<div class="form-group wd">
											<label for="inputEmail3" class="col-sm-6 control-label">Stocks & Bonds (Company name/ number & description) </label>
											<div class="col-sm-6">
												<?php echo $this->Form->input('stocks_and_bonds',array('label'=>false,'div'=>false,'placeholder'=>'Stocks and Bonds','class'=>'liquidAssests maskIncome form-control hg-50'));?>
											</div>
										</div>
										<div class="form-group wd">
											<label for="inputEmail3" class="col-sm-6 control-label">Life Insurance net cash value Face amount; $0.00 </label>
											<div class="col-sm-6">
												<?php echo $this->Form->input('life_insurance',array('label'=>false,'div'=>false,'placeholder'=>'Life Insurance','class'=>'liquidAssests maskIncome form-control hg-50'));?>
											</div>
										</div>
										<div class="form-group wd">
											<label for="inputEmail3" class="col-sm-6 control-label">
												<h4>Subtotal Liquid Assets </h4>
											</label>
											<div class="col-sm-6">
												<?php echo $this->Form->input('subtotal_liquid_assests',array('label'=>false,'div'=>false,'placeholder'=>'Sub Total','class'=>'finalLiquidAssests assests maskIncome form-control hg-50','readonly'=>true));?>
											</div>
										</div>
										<div class="form-group wd">
											<label for="inputEmail3" class="col-sm-6 control-label">Real estate owned (enter market value from schedule of real estate owned)</label>
											<div class="col-sm-6">
												<?php echo $this->Form->input('real_estate_owned',array('label'=>false,'div'=>false,'placeholder'=>'Real Estate Owned','class'=>'assests maskIncome form-control hg-50'));?>
											</div>
										</div>
										<div class="form-group wd">
											<label for="inputEmail3" class="col-sm-6 control-label">Vested interest in retirement fund </label>
											<div class="col-sm-6">
												<?php echo $this->Form->input('interest_on_retirement_fund',array('label'=>false,'div'=>false,'placeholder'=>'Interest On Retirement Fund','class'=>'assests maskIncome form-control hg-50'));?>
											</div>
										</div>
										<div class="form-group wd">
											<label for="inputEmail3" class="col-sm-6 control-label">Net worth of businesses owned (attach financial statement) </label>
											<div class="col-sm-6">
												<?php echo $this->Form->input('business_owned',array('label'=>false,'div'=>false,'placeholder'=>'Busness Owned Worth','class'=>'assests maskIncome form-control hg-50'));?>
											</div>
										</div>
										<div class="form-group wd">
											<div class="col-sm-6">
												<label for="inputEmail3" class="col-sm-6 control-label">Automobiles owned (make and year) </label>
											</div>
											<div class="col-sm-6">
												<?php echo $this->Form->input('automobile_owned',array('label'=>false,'div'=>false,'placeholder'=>'Automobile Owned Price','class'=>'assests maskIncome form-control hg-50'));?>
											</div>
										</div>
										<div class="form-group wd">
											<div class="col-sm-6">
												<label for="inputEmail3" class="col-sm-6 control-label">Other Assets (itemize)</label>
											</div>
											<div class="col-sm-6">
												<?php echo $this->Form->input('other_assests',array('label'=>false,'div'=>false,'placeholder'=>'Other Assests','class'=>'assests maskIncome form-control hg-50'));?>
											</div>
										</div>
										<div class="form-group wd">
											<label for="inputEmail3" class="col-sm-6 control-label text-right"><strong>Total Assets a.</strong></label>
											<div class="col-sm-6">
												<?php echo $this->Form->input('total_assests',array('label'=>false,'div'=>false,'placeholder'=>'Total Assests','class'=>'totalAssests maskIncome form-control hg-50','readonly'=>true));?>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<p>
											<strong>Liabilities and Pledged Assets.</strong> List the creditor?s name, address, and account number for all
											outstanding debts, including automobile loans, revolving charge accounts, real estate loans,
											alimony, child support, stock pledges, etc. Use continuation sheet, if necessary. Indicate by (*)
											those liabilities, which will be satisfied upon sale of real estate owned or upon refinancing of 
											the subject property.
										</p>
									</div>
									<div class="col-sm-12">
										<?php echo $this->Form->hidden("option_count",array("value"=>'0',"id"=>"optionsLibCount"));?>
										<?php  echo $this->Html->link('Add Account <span class="glyphicon glyphicon-plus"></span>','javascript:void(0)',array('class'=>'addMoreAccount','title'=>'Click to add more account','onclick'=>'addMorelibilitiesOption();','escape'=>false,'style'=>'float: right;'));?>
									</div>
									<div class="un-paid">
										<div id="borrowerLiabilities" class="form-group wd">
											<div class="col-sm-5">
												<label for="inputEmail3" class="control-label sm-bd">Liabilities</label>
												<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.lib_company_address.0',array('label'=>false,'div'=>false,'placeholder'=>'Name and address of Company','class'=>'form-control'));?>
												<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.lib_company_account_number.0',array('label'=>false,'div'=>false,'placeholder'=>'Acct. No.','class'=>'form-control'));?>
											</div>
											<div class="col-sm-3">
												<label for="inputEmail3" class="control-label sm-bd">Monthly Payment & Months Left to Pay</label>
												<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.lib_company_payment_per_month.0',array('label'=>false,'div'=>false,'title'=>'$ Payments/Months','placeholder'=>'$ Payments/Months','class'=>'liabilities maskIncome form-control hg-95'));?>
											</div>
											<div class="col-sm-3">
												<label for="inputEmail3" class="control-label sm-bd">Unpaid Balance</label>
												<?php echo $this->Form->input('LongAppBorrowerEmploymentInfo.lib_company_unpaid_balance.0',array('label'=>false,'div'=>false,'title'=>'Unpaid Balance','placeholder'=>'Unpaid Balance','class'=>'liabilities maskIncome form-control hg-95'));?>
											</div>
											<div class="col-sm-1">
												<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i>',"javascript:void(0);",array('title'=>'Remove Bank Detail','style' => 'display:none;margin-top: 70px;text-align: right;','escape'=>false));?>
											</div>
										</div>
										<div id="addMoreLiabilities"></div>
									</div>
									<div class="top-sp">
										<div class="col-sm-6">
											<label>Alimony/Child Support/Separate Maintenance Payments Owed to:</label>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('lib_child_support',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'liabilities maskIncome form-control hg-95'));?>
										</div>
										<div class="col-sm-6">
											<label>Job Related Expense (child care, union dues, etc.)</label>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('lib_job_expanse',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'liabilities maskIncome form-control hg-95'));?>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-group wd">
										<div class="col-sm-6">
											<h5>Total Monthly Income</h5>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('total_liabilities',array('label'=>false,'div'=>false,'placeholder'=>'Total Liabilities $0.00','class'=>'totalLiabilities maskIncome form-control hg-95','readonly'=>true));?>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('final_assests',array('label'=>false,'div'=>false,'placeholder'=>'Total $0.00','class'=>'finalAssests maskIncome form-control hg-95','readonly'=>true));?>
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