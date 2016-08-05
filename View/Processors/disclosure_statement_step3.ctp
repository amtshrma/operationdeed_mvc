<!-- Page Content -->
<?php
	echo $this->Html->css('signature_pad/signature-pad.css');
    echo $this->Html->script(array('jquery.maskMoney.js','front/processor.js'));
?>
<style>
	li > .row{
		margin-bottom: 10px;
		border-bottom: 1px solid #eee;
	}
</style>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3>Mortage Loan Disclosure Statement / Good Faith Estimate</h3><hr/>
		<div class="with-nav-tabs panel-default">
            <div class="panel-heading2" >
				<ul class="nav nav-tabs" id="disclosure-container">
					<li><a href="javascript:void(0);">Step 1</a></li>
					<li><a href="javascript:void(0);">Step 2</a></li>
					<li class="active"><a href="javascript:void(0);">Step 3</a></li>
					<li><a href="javascript:void(0);">Step 4</a></li>
				</ul>
            </div>
			<div class="panel-body">
				<div class="tab-content in-content">
                    <div  class="tab-pane active tab-1 tab-row" id="disclosure-tab1">
                        <?php echo $this->Form->create('DisclosureStatement',array('noValidate' => false));?>
						<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
						<div class="form-row-1">
							<div class="heading-ttl">
							   <h2>ADDITIONAL REQUIRED CALIFORNIA DISCLOSURES</h2>
							</div>
						</div>
						<div class="clousure-form clearfix">
							<ul>
								<li>
									 <div class="clousure-form-rw row">
										 <label class="clousure-form-label1 col-sm-9">Proposed Loan Amount:</label>
										 <div class="clousure-input-cell col-sm-3">
											 <div class="input-group"><span id="basic-addon1" class="input-group-addon">$</span>
												 <?php 
												  echo $this->Form->input('proposed_loan_amount',array('class'=>'form-control noValidate priceMask', 'title'=>'Proposed Loan Amount','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1','value'=>$shortApplication['ShortApplication']['loan_amount'],'readonly'=>true));?>
											 </div>
										 </div>
									 </div>
									 <div class="clousure-form-rw row">
										 <label class="clousure-form-label col-sm-7 col-sm-offset-2">Initial Commissions, Fees, Costs and Expenses Summarized on Page 1:</label>
										 <div class="clousure-input-cel1 col-sm-3">
											 <div class="input-group"> <span class="input-group-addon" id="basic-addon1">$</span>
												 <?php echo $this->Form->input('expanses_summarized_total',array('class'=>'form-control noValidate priceMask', 'title'=>'Expanses Summarized','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											 </div>
										 </div>
									 </div>
									 <div class="clousure-form-rw row">
										 <label class="clousure-form-label col-sm-7 col-sm-offset-2">Payment of Other Obligations (List): Credit Life and/or Disability Insurance (see XIV below)</label>
										 <div class="clousure-input-cel1 col-sm-3">
											 <div class="input-group"> <span class="input-group-addon" id="basic-addon1">$</span>
												 <?php echo $this->Form->input('payment_of_other_obligation',array('class'=>'form-control noValidate priceMask', 'title'=>'Payment Of Other Obligation','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											 </div>
										 </div>
									 </div>
									 <div class="clousure-form-rw row">
										 <div class=" col-sm-7 col-sm-offset-2">
											 <?php echo $this->Form->input('other1_payment_of_other_obligation',array('class'=>'priceMask form-control noValidate', 'title'=>'Payment Of Other Obligation','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										 </div>
										 <div class="clousure-input-cel1 col-sm-3">
											 <div class="input-group"> <span class="input-group-addon" id="basic-addon1">$</span>
												 <?php echo $this->Form->input('other2_payment_of_other_obligation',array('class'=>'form-control noValidate priceMask', 'title'=>'Payment Of Other Obligation','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											 </div>
										 </div>
									 </div>
									 <div class="clousure-form-rw row">
										 <label class="clousure-form-label1  col-sm-9"><b>Subtotal of All Deductions:</b></label>
										 <div class="clousure-input-cell col-sm-3">
											 <div class="input-group"> <span class="input-group-addon" id="basic-addon1">$</span>
												 <?php echo $this->Form->input('subtotal_of_all_deduction',array('class'=>'form-control noValidate priceMask', 'title'=>'Subtotal of all Deduction','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											 </div>
										 </div>
									 </div>
									 <div class="clousure-form-rw row">
										 <label class="clousure-form-label1  col-sm-9">
											 <strong>Estimated Cash at Closing</strong>
											 <div class="checkbox-inline-cell">
												 <label class="checkbox-inline">
													 <?php echo $this->Form->input('closing_cash_to_you',array('type'=>'numeric','type'=>'checkbox','value'=>'to you', 'title'=>'Closing Cash To You','div'=>false,'label'=>false));?> 
													 <strong>To You</strong></label>
												 <label class="checkbox-inline">
													 <?php echo $this->Form->input('closing_cash_to_you',array('type'=>'numeric','type'=>'checkbox','value'=>'you pay', 'title'=>'Closing Cash That You pay','div'=>false,'label'=>false));?> 
													 <strong> That you must pay</strong>
												 </label>
											 </div>
										 </label>
										 <div class="clousure-input-cell  col-sm-3">
											 <div class="input-group"> <span class="input-group-addon" id="basic-addon1">$</span>
												 <?php echo $this->Form->input('closing_loanAmount_to_you',array('class'=>'form-control noValidate priceMask', 'title'=>'Closing Loan Amount','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											 </div>
										 </div>
									 </div>
								</li>
								<li>
									 <div class="clousure-form-rw row">
										 <label class="clousure-form-label1 clousure-lbl-inpt col-sm-8">Proposed Loan Term:</label>
										 <div class="clousure-input-cell col-sm-3">
											<?php
											$loanTerm = $this->Common->getSoftQuoteloanTerm($shortApplication['SoftQuote']['id']);
											echo $this->Form->input('proposed_loan_term',array('type'=>'text','class'=>'form-control noValidate', 'title'=>'Proposed Loan Terms','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1','value' =>$loanTerm,'readonly'=>true));?>
										 </div>
										 <div class="clousure-input-cell clousure-chk-inpt-cell  col-sm-1">
											 <div class="checkbox-inline-cell">
												 <?php echo $this->Form->input('proposed_loan_term_type',array('type'=>'checkbox','value'=>'years', 'title'=>'Proposeed Loan terms Type','div'=>false,'label'=>false,'hiddenField'=>false,'disabled'=>true));?> Years <br />
												 <?php echo $this->Form->input('proposed_loan_term_type',array('type'=>'checkbox','value'=>'months', 'title'=>'Proposeed Loan terms Type','div'=>false,'label'=>false,'hiddenField'=>false,'checked'=>'checked','disabled'=>true));?>Month
											 </div>
										 </div>
									 </div>
								</li>
								<li>
									<div class="clousure-form-rw row">
										<label class="clousure-form-label1 clousure-lbl-inpt col-sm-6">Proposed Interest Rate:</label>
										<div class="clousure-input-cell col-sm-3">
											<div class="clousure-input-cell">
												<div class="input-group">
													<?php echo $this->Form->input('proposed_interest_rate',array('class'=>'priceMask form-control noValidate', 'title'=>'Proposed Interest Rate','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1','value'=>$shortApplication['SoftQuote']['interest_rate'],'readonly'=>true));?>
													<span class="input-group-addon">%</span>
												</div>
											</div>
										</div> 
										<div class="clousure-input-cell clousure-chk-inpt-cell  col-sm-3">
											<div class="checkbox-inline-cell">
												<?php echo $this->Form->input('proposed_interest_rate_type',array('type'=>'checkbox','value'=>'fixed_rate', 'title'=>'Proposeed Interest Rate Type','div'=>false,'label'=>false,'hiddenField'=>false,'checked'=>'checked','disabled'=>true));?> Fixed Rate<br />
												<?php echo $this->Form->input('proposed_interest_rate_type',array('type'=>'checkbox','value'=>'adjustable_rate', 'title'=>'Proposeed Interest Rate Type','div'=>false,'label'=>false,'hiddenField'=>false,'disabled'=>true));?> Initial Adjustable Rate<br />
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="clousure-form-rw row">
										<label class="clousure-form-label1 col-sm-8">Initial Adjustable Rate in effect for</label>
										<div class="clousure-input-cell col-sm-3">
										   <?php echo $this->Form->input('initial_adjustable_rate_for_months',array('class'=>'form-control noValidate', 'title'=>'Initial Adjustable rate','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										</div>
										<div class="clousure-chk-inpt-cell col-sm-1">
										   <label class=""> Months</label>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
								<li>
								   <div class="clousure-form-rw row">
										<label class="clousure-form-label1 col-sm-8">Fully Indexed Interest Rate</label>
										<div class="clousure-input-cell col-sm-4">
											<div class="clousure-input-cell">
												<div class="input-group">
													<?php echo $this->Form->input('full_indexed_interest_rate',array('class'=>'form-control noValidate priceMask', 'title'=>'Full Indexed Interest Rate','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
													<span class="input-group-addon">%</span>
												</div>
											</div>
										</div>
									 </div>
								</li>
								<li>
									<div class="clousure-form-rw row">
										<label class="clousure-form-label1 col-sm-8">Maximum Interest Rate</label>
										<div class="clousure-input-cell col-sm-4">
											<div class="clousure-input-cell">
												<div class="input-group">
												   <?php echo $this->Form->input('maximum_interest_rate',array('class'=>'form-control noValidate priceMask', 'title'=>'Maximum Interest Rate','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
												   <span class="input-group-addon">%</span>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="clousure-form-rw row">
										<label class="clousure-form-label1 col-sm-8">Proposed Initial (Minimum) Loan</label>
										<div class="clousure-input-cell col-sm-3">
											<div class="input-group"> <span id="basic-addon1" class="input-group-addon">$</span>
												<?php echo $this->Form->input('proposed_initial_loan',array('class'=>'form-control noValidate priceMask', 'title'=>'Proposed Minimum Loan','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</div>
										<div class="clousure-input-cell clousure-chk-inpt-cell  col-sm-1">
										   <label class="">Monthly</label>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
								<li>
									<div class="clousure-form-rw row">
										<label class="clousure-form-label1 col-sm-6">Interest Rate can Increase</label>
										<div class="clousure-input-cell col-sm-2">
											<div class="clousure-input-cell">
												<div class="input-group">
													<?php echo $this->Form->input('interest_rate_can_increase',array('class'=>'form-control noValidate priceMask', 'title'=>'Proposed Increase Interest Rate','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
													<span class="input-group-addon">%</span>
												</div>
											</div>
										</div>
										<div class="clousure-each-mnth col-sm-4">
											<div class="input-group"> <span class="input-group-addon">Each</span>
												<?php echo $this->Form->input('interest_rate_can_increase_months',array('class'=>'form-control noValidate', 'title'=>'Months','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
												<span class="input-group-addon">Months</span>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="clousure-form-rw row">
										<label class="clousure-form-label1 col-sm-3">Payment Options end after</label>
										<div class="clousure-input-cell col-sm-2">
											<?php echo $this->Form->input('payment_options_end_after_months',array('class'=>'form-control noValidate', 'title'=>'Payment Options After','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										</div>
										<div class="col-sm-7">
											<div class="row">
												<label style="vertical-align: top;" class="clousure-chk-inpt-cell col-sm-2">Months or</label>
												<span style="" class="inline-block col-sm-6">
													<?php echo $this->Form->input('payment_options_end_after_percent_loan',array('class'=>'form-control noValidate', 'title'=>'Months','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
												</span>
												<span class="inline-block clousure-chk-inpt-cell col-sm-4">% of Original Balance, whichever comes first </span>
											</div>
										</div>
									</div>
								</li>
								<li class="li-pos">
								   <div class="clousure-form-rw clousure-form-inline clousure-inline-inpt ">After
										<?php echo $this->Form->input('after_these_months',array('type'=>'numeric','class'=>'form-control noValidate custom-form-control', 'title'=>'After Months','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?> months you will not have the option to make minimum or interest only payments and negative amortization (increases in your principal balance), if any, will no longer be allowed. Assuming you have made minimum payments, you may then have to make principal and interest payments of $ <?php echo $this->Form->input('capital_interest_payment',array('class'=>'form-control noValidate custom-form-control priceMask', 'title'=>'Capital Interest Payment','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?> at the maximum interest rate in effect for the remaining months of the loan. These payments.
								   </div>
								</li>
								<li>
									<div class="clousure-form-rw clousure-form-inline clousure-inline-inpt ">If your loan contains negative amortization, at the time no additional negative amortization will accrue, your loan balance will be $<?php echo $this->Form->input('you_loan_balance_will_be',array('class'=>'priceMask form-control noValidate custom-form-control', 'title'=>'Your Loan Balance Will Be','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?> assuming minimum payments are made.</div>
								</li>
								<li>
									<div class="clousure-form-rw clousure-form-inline clousure-inline-inpt ">The loan is subject to a balloon payment:
										<div class="checkbox-inline-cell margin-tp-12px">
											<label class="checkbox-inline">
												<?php echo $this->Form->input('balloon_payment',array('type'=>'checkbox','value'=>'no', 'title'=>'Balloon Payment','div'=>false,'label'=>false,'hiddenField'=>false));?> No
											</label>
											<label class="checkbox-inline">
											<?php echo $this->Form->input('balloon_payment',array('type'=>'checkbox','value'=>'yes', 'title'=>'Balloon Payment','div'=>false,'label'=>false,'hiddenField'=>false));?> Yes
											</label>
										</div>
										If Yes, the following paragraph applies and a final balloon payment of $ will be due on $ <?php echo $this->Form->input('balloon_payment_amount',array('class'=>'priceMask form-control noValidate custom-form-control', 'title'=>'Balloon Payment Amount','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?> will be due on <?php echo $this->Form->input('balloon_payment_due_date',array('type'=>'numeric','class'=>'form-control noValidate custom-form-control datepicker', 'title'=>'Ballon Payment Due On','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?> <em>[estimated date (month/day/year)]</em>.
									<p style="font-style: italic; line-height: 20px;font-weight: bold; text-align: justify;">NOTICE TO BORROwER: IF YOU DO NOT HAVE THE FUNDS TO PAY THE BALLOON PAYMENT wHEN IT COMES DUE, YOU MAY HAVE TO OBTAIN A NEw LOAN AGAINST YOUR PROPERTY TO MAkE THE BALOON PAYMENT. IN THAT CASE, YOU MAY AGAIN HAVE TO PAY COMMISSIONS, FEES, AND EXPENSES FOR THE ARRANGING OFTHE NEw LOAN. IN ADDITION, IFYOU ARE UNABLE TO MAkE THE MONTHLY PAYMENTS OR THE BALLOON PAYMENT, YOU MAY LOSE THE PROPERTY AND ALL OF YOUR EQUITY THROUGH FORECLOSURE. kEEP THIS IN MIND IN DECIDING UPON THE AMOUNT AND TERMS OF THIS LOAN.</p><br/>
									</div>
								</li>
								<li class="li-pos">
								   <div class="payment-row">
									  <p>Prepayments: The proposed loan has the following prepayment provisions:</p>
									  <div class="payment-item">
										 <ul>
											<li>
												<div class="payment-check-info">
													<?php echo $this->Form->input('penalty_options',array('type'=>'checkbox','value'=>'no_prepayment', 'title'=>'Balloon Payment','div'=>false,'label'=>false,'hiddenField'=>false));?> No prepayment penalty (you will not be charged a penalty to pay off or refinance the loan before maturity)</div>
											</li>
											<li class="clousure-inline-inpt clousure-form-inline">
												<div class="payment-check-info">
													<?php echo $this->Form->input('penalty_options',array('type'=>'checkbox','value'=>'yes_prepayment', 'title'=>'Penalty Checkbox','div'=>false,'label'=>false,'hiddenField'=>false));?> You will have to pay a prepayment penalty if the loan is paid off or refinanced in the first <?php echo $this->Form->input('penelty_years',array('type'=>'numeric','class'=>'form-control noValidate custom-form-control', 'title'=>'Penalty Years','div'=>false,'label'=>false));?> years. The prepayment penalty could be as much as <?php echo $this->Form->input('penelty_amount',array('type'=>'numeric','class'=>'form-control noValidate custom-form-control', 'title'=>'Penalty Amount','div'=>false,'label'=>false));?>. Any prepayment of principal in excess of 20% of the
												</div>
												<div class="payment-check-rw payment-check-sub">
													<ul>
														<li>
															<div class=""><?php echo $this->Form->input('original_loan_balance',array('type'=>'checkbox','value'=>'original_loan_balance', 'title'=>'Original Loan balance','div'=>false,'label'=>false,'hiddenField'=>false));?> original loan balance or</div>
														</li>
														<li>
															<div class=""><?php echo $this->Form->input('original_loan_balance',array('type'=>'checkbox','value'=>'unpaid_loan_balance', 'title'=>'Unpaid balance','div'=>false,'label'=>false,'hiddenField'=>false));?> unpaid balance</div>
														</li>
													</ul>
												</div>
											for the first <?php echo $this->Form->input('penalty_first_years',array('type'=>'numeric','class'=>'form-control noValidate custom-form-control', 'title'=>'Penalty Years','div'=>false,'label'=>false));?> years will include a penalty not to exceed <?php echo $this->Form->input('penelty_not_exceed',array('type'=>'numeric','class'=>'form-control noValidate custom-form-control', 'title'=>'Penalty Not Exceed Months','div'=>false,'label'=>false));?> months interest at the note interest rate but not more than the interest you would be charged if the loan were paid to maturity.
											</li>
											<li class="">
												<div class="payment-check-info">
													<?php echo $this->Form->input('penalty_options',array('type'=>'checkbox','value'=>'other_prepayment', 'title'=>'Penalty Checkbox','div'=>false,'label'=>false,'hiddenField'=>false));?> Other - you will have to pay a prepayment penalty if the loan is paid off or refinanced in the first <?php echo $this->Form->input('repayment_penalty_years',array('type'=>'numeric','class'=>'form-control noValidate custom-form-control', 'title'=>'Repayment Penalty Years','div'=>false,'label'=>false));?> years as follows:
												<?php echo $this->Form->input('penalty_other_1',array('class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
												<?php echo $this->Form->input('penalty_other_2',array('class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
												</div>
											</li>
										 </ul>
									  </div>
								   </div>
								</li>
							   <li class="clousure-inline-inpt clousure-form-inline">
								  <div class="payment-row">
									 <p>Taxes and Insurance:</p>
									 <div class="payment-item">
										<ul>
											<li>
												<?php echo $this->Form->input('taxes_and_insurance',array('type'=>'checkbox','value'=>'impound_escrow', 'title'=>'Texas And Insurence','div'=>false,'label'=>false,'hiddenField'=>false));?> There will be an impound (escrow) account which will collect approximately $ <?php echo $this->Form->input('escrow_collection_appx',array('class'=>'priceMask form-control noValidate custom-form-control', 'div'=>false,'label'=>false));?> a month in addition to your principal and interest payments for the payment of
												<?php echo $this->Form->input('taxes_escrow_insurance',array('type'=>'checkbox','value'=>'county_property', 'title'=>'County property','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> county property taxes*
												<?php echo $this->Form->input('taxes_escrow_insurance',array('type'=>'checkbox','value'=>'hazard_insurance', 'title'=>'Hazard Insurance','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> hazard insurance
												<?php echo $this->Form->input('taxes_escrow_insurance',array('type'=>'checkbox','value'=>'mortgage_insurance', 'title'=>'Mortgage Insurance','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> mortgage insurance
												<?php echo $this->Form->input('taxes_escrow_insurance',array('type'=>'checkbox','value'=>'flood_insurance', 'title'=>'Flood Insurance','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> flood insurance
												<?php echo $this->Form->input('taxes_escrow_insurance',array('type'=>'checkbox','value'=>'other', 'title'=>'Other','div'=>false,'label'=>false,'class'=>'noValidate'));?> other. <?php echo $this->Form->input('escrow_other_option_description',array('class'=>'form-control noValidate custom-form-control', 'div'=>false,'label'=>false,'hiddenField'=>false));?>
											</li>
											<li>
													<?php echo $this->Form->input('taxes_and_insurance',array('type'=>'checkbox','value'=>'no_impound_escrow', 'title'=>'Texas And Insurance','div'=>false,'label'=>false,'hiddenField'=>false));?> If there is no impound (escrow) account you will have to plan for the payment of <?php echo $this->Form->input('taxes_no_escrow_insurance',array('type'=>'checkbox','value'=>'county_property', 'title'=>'County property','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> county property taxes*
												<?php echo $this->Form->input('taxes_no_escrow_insurance',array('type'=>'checkbox','value'=>'hazard_insurance', 'title'=>'Hazard Insurance','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> hazard insurance
												<?php echo $this->Form->input('taxes_no_escrow_insurance',array('type'=>'checkbox','value'=>'mortgage_insurance', 'title'=>'Mortgage Insurance','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> mortgage insurance
												<?php echo $this->Form->input('taxes_no_escrow_insurance',array('type'=>'checkbox','value'=>'flood_insurance', 'title'=>'Flood Insurance','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> flood insurance
												<?php echo $this->Form->input('taxes_no_escrow_insurance',array('type'=>'checkbox','value'=>'other', 'title'=>'Other','div'=>false,'label'=>false,'hiddenField'=>false,'class'=>'noValidate'));?> other of approximately $ <?php echo $this->Form->input('no_escrow_other_option_description',array('class'=>'priceMask form-control noValidate custom-form-control priceMask', 'div'=>false,'label'=>false,'hiddenField'=>false));?> per year.
										   </li>
											<li>
												*** In a purchase transaction, county property taxes are calculated based on the sales price of the property and may require the payment of an additional (supplemental) tax bill from the county tax authority by your lender (if escrowed) or you ifnot escrowed. 
											</li>
										</ul>
									 </div>
								  </div>
							   </li>
							   <li class="">Credit Life and/or Disability Insurance: The purchase of credit life and/or disability insurance by a borrower is NOT required as a condition of making this proposed loan. </li>
							   <li>Other Liens: Are there liens currently on this property for which the borrower is obligated?
								  <?php echo $this->Form->input('other_liens_property_obligated',array('type'=>'checkbox','value'=>'no', 'title'=>'No','div'=>false,'label'=>false,'hiddenField'=>false));?> No
								 <?php echo $this->Form->input('other_liens_property_obligated',array('type'=>'checkbox','value'=>'yes', 'title'=>'Yes','div'=>false,'label'=>false,'hiddenField'=>false));?> Yes
								  Yes If Yes, describe below:
								  <div class="row input-cell-block">
									 <div class="input-cell-row">
										<div class="col-sm-4">
										   <label>Lienholder's Name</label>
										   <?php echo $this->Form->input('lien_holder_name_1',array('title'=>'Lien Holder Name','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('lien_holder_name_2',array('title'=>'Lien Holder Name','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('lien_holder_name_3',array('title'=>'Lien Holder Name','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										</div>
										<div class="col-sm-4">
										   <label>Amount Owing</label>
											<?php echo $this->Form->input('lien_owing_amount_1',array('title'=>'Lien Owing Amount','class'=>'priceMask form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('lien_owing_amount_2',array('title'=>'Lien Owing Amount','class'=>'priceMask form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('lien_owing_amount_3',array('title'=>'Lien Owing Amount','class'=>'priceMask form-control noValidate', 'div'=>false,'label'=>false));?>
										</div>
										<div class="col-sm-4">
										   <label>Priority</label>
											<?php echo $this->Form->input('lien_priority_1',array('title'=>'Lien Priority','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
											<?php echo $this->Form->input('lien_priority_2',array('title'=>'Lien Priority','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
											<?php echo $this->Form->input('lien_priority_3',array('title'=>'Lien Priority','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										</div>
									 </div>
								  </div>
								  <div class="row input-cell-block">
									 <p>Liens that will remain or are anticipated on this property after the proposed loan for which you are applying is made or arranged (including the proposed loan for which you are applying):</p>
								  </div>
								  <div class="row input-cell-block">
									 <div class="input-cell-row">
										<div class="col-sm-4">
										   <label>Lienholder's Name</label>
										   <?php echo $this->Form->input('anticipated_lien_holder_name_1',array('title'=>'Anticipated Lien Holder Name','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('anticipated_lien_holder_name_2',array('title'=>'Anticipated Lien Holder Name','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('anticipated_lien_holder_name_3',array('title'=>'Anticipated Lien Holder Name','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										</div>
										<div class="col-sm-4">
										   <label>Amount Owing</label>
											<?php echo $this->Form->input('anticipated_lien_owing_amount_1',array('title'=>'Anticipated Lien Owing Amount','class'=>'priceMask form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('anticipated_lien_owing_amount_2',array('title'=>'Anticipated Lien Owing Amount','class'=>'priceMask form-control noValidate', 'div'=>false,'label'=>false));?>
										   <?php echo $this->Form->input('anticipated_lien_owing_amount_3',array('title'=>'Anticipated Lien Owing Amount','class'=>'priceMask form-control noValidate', 'div'=>false,'label'=>false));?>
										</div>
										<div class="col-sm-4">
										   <label>Priority</label>
											<?php echo $this->Form->input('anticipated_lien_priority_1',array('title'=>'Anticipated Lien Priority','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
											<?php echo $this->Form->input('anticipated_lien_priority_2',array('title'=>'Anticipated Lien Priority','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
											<?php echo $this->Form->input('anticipated_lien_priority_3',array('title'=>'Anticipated Lien Priority','class'=>'form-control noValidate', 'div'=>false,'label'=>false));?>
										</div>
									 </div>
								  </div>
								  <div class="row input-cell-block">
									 <p>NOTICE TO BORROWER: Be sure that you state the amount of all liens as accurately as possible. If you contract with the broker to arrange this loan, but it cannot be arranged because you did not state these liens correctly, you may be liable to pay commissions, costs, fees, and expenses even though you do not obtain the loan.</p>
								  </div>
							   </li>
							   <li class="">
								  <div class="head-info"> Article 7 Compliance: If this proposed loan is secured by a first deed of trust in a principal amount of less than $30,000 or secured by a junior lien in a principal amount of less than $20,000, the undersigned broker certifies that the loan will be made in compliance with Article 7 of Chapter 3 of the Real Estate Law. </div>
								  <div class="head-item">
									 <ul>
										<li> This loan <br />
												<?php echo $this->Form->input('article7_compaliance_option',array('type'=>'checkbox','value'=>'may', 'title'=>'may','div'=>false,'label'=>false,'hiddenField'=>false));?> may <br />
												<?php echo $this->Form->input('article7_compaliance_option',array('type'=>'checkbox','value'=>'will', 'title'=>'will','div'=>false,'label'=>false,'hiddenField'=>false));?> will <br />
												<?php echo $this->Form->input('article7_compaliance_option',array('type'=>'checkbox','value'=>'will_not', 'title'=>'will not','div'=>false,'label'=>false,'hiddenField'=>false));?> will not <br />
												be made wholly or in part from broker controlled funds as defined in Section 10241(j) ofj) of the Business and Professions Code. </li>
										<li> If the broker indicates in the above statement that the loan "may" be made out of broker-controlled funds, the broker must inform the borrower prior to the close of escrow if the funds to be received by the borrower are in fact broker-controlled funds. </li>
									 </ul>
								  </div>
							   </li>
								<li class="">
									<div class="head-info">This loan is based on limited or no documentation of your income and/or assets and may have a higher interest rate, or more points or fees than other products requiring documentation:
									<?php echo $this->Form->input('limited_loan_option',array('type'=>'checkbox','value'=>'no', 'title'=>'no','div'=>false,'label'=>false,'hiddenField'=>false));?>No
									<?php echo $this->Form->input('limited_loan_option',array('type'=>'checkbox','value'=>'yes', 'title'=>'yes','div'=>false,'label'=>false,'hiddenField'=>false));?>Yes</div>
								</li>
							</ul>
							<div class="notice-block">
							  <h2 class="text-center">Notice To Broker</h2><hr />
							   <p><strong>If any of the columns in section XIX, Comparison of Sample Mortgage Features, on page 4 of this RE 885 form, are not completed, you must certify to the following:</strong></p>
							   <div class="certify-rw">
								  <div class="heading-ttl text-center">
									 <h3>CERTIFICATION</h3>
								  </div>
								  <div class="certify-msg">
									<p> I, <?php echo $this->Form->input('certification_borrower_name',array('class'=>'form-control noValidate custom-form-control', 'title'=>'Borrower name','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1','readonly'=>true, 'value'=>$brokerDetail['User']['name']));?>
										hereby certify (or declare) that the failure to complete the information in any or all of the columns (with the exception of the last column "Proposed Loan" in the Typical Mortgage Transactions portion of this RE 885) is either because (1) after a diligent search, I have determined that the product specified in that column is not available to consumers from mortgage lenders, or (2) the borrower to whom this form applies does not qualify for that particular product.
									</p>
									 <p>I certify (or declare) under penalty of perjury under the laws of the State of California that the foregoing is true and correct.</p>
								  </div>
								  <div class="certify-input-rw text-center">
									 <div class="row">
										<div class="col-sm-6 certify-col">
											<div id="smoothed_broker_signature" style="width: 100%;height: 200px;">
												<div class="m-signature-pad--body">
													<canvas style="width: 100%; height: 160px;" id="first"></canvas>
												</div>
												<input id="brokerSignature" type="hidden" name="data[DisclosureStatement][brokerSignature]" class="output">
												<div class="signaturepad-footer">
													<button type="button" class="btn btn-default clear" data-action="clear">Clear</button>
													<button type="button" class="btn btn-primary save" data-action="save">Confirm</button>
												</div>
											</div>
										</div>
										<div class="col-sm-3 col-sm-offset-3 certify-col certify-date-input" style="margin-top: 5%;">
										   <?php echo $this->Form->input('certification_date',array('class'=>'form-control datepicker','title'=>'Certification Date','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										</div>
									 </div>
								  </div>
								<div class="certify-textarea" style="margin-top: 2%;">
									<?php echo $this->Form->input('disclosure_description',array('label'=>false, 'div'=> false, 'class'=>'form-control noValidate','rows'=>'2','style'=>'resize : none'));?>
								</div>
							   </div>
							</div>
							<div class="form-row pull-right">
								<?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-primary sumitButton disbaledButton','escape'=>false));?>
							</div>
						<?php echo $this->Form->end();?>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
    <!-- /#page-content-wrapper --> 
</div>
<?php echo $this->Html->css('jquery-ui.css'); ?>

<script>
	jQuery('document').ready(function(){
		jQuery('.datepicker').datepicker({
				changeMonth: true,
				changeYear : true
		});
	});
</script>
<?php
echo $this->Html->script(array('signature_pad/signature_pad.js','signature_pad/processor_signature.js'));
?>
