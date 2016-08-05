<?php
    echo $this->Html->script(array('jquery.maskMoney.js','front/processor.js'));
?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3>Federal Truth In Lending Disclosure Statement</h3><hr/>
		<div class="with-nav-tabs panel-default">
			<div class="panel-body">
				<div class="tab-content in-content">
                    <div class="tab-row">
                        <?php echo $this->Form->create('DisclosureStatement',array('noValidate' => false));?>
						<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
						<div class="row-fluid">
							<div class="col-md-6">
								<label>Creditor : </label>
								<?php echo $this->Form->input('til_creater',array('class'=>'form-control custom-form-control','div'=>false, 'label'=>false,'value'=>$this->Session->read('userInfo.name'),'readonly'=>true));?>
							</div>
							<div class="col-md-6">
								<p>
								<label>Loan Number : </label>
								<?php echo $loanNumber;?>
								</p><br />
								<p>
								<label>Borrower Name : </label>
								<?php echo $loanDetail['ShortApplication']['name'];?>
								</p>
							</div><hr />
							<div class="col-md-3">
								<p class="text-center textBold">Annual % Rate</p>
								<p>The cost of your credit as a yearly rate : <br /><br />
								<?php echo $this->Form->input('til_annual_percentage_rate',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>%</p>
							</div>
							<div class="col-md-3">
								<p class="text-center textBold">Finance Charge</p>
								<p>The dollar amount the credit will cost you :<br /><br />
								$<?php echo $this->Form->input('til_finance_charge',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?></p>
							</div>
							<div class="col-md-3">
								<p class="text-center textBold">Amount Financed</p>
								<p>The amount of credit provided to you or on your behalf : <br /><br />
								$<?php echo $this->Form->input('til_amount_credit',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?></p>
							</div>
							<div class="col-md-3">
								<p class="text-center textBold">Total Of Payments</p>
								<p>The amount you will have paid after you have made all payments as scheduled : <br />
								$<?php echo $this->Form->input('til_total_of_payemtns',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?></p>
							</div><hr/>
							<h4>Your payment schedule will be:</h4><br />
							<div class="col-md-3">
								<p class="text-center textBold">Number Of Payment</p><br />
								<?php echo $this->Form->input('til_balloon_pay_1',array('class'=>'form-control custom-form-control','div'=>false, 'label'=>false));?></p>
							</div>
							<div class="col-md-3">
								<p class="text-center textBold">Amount of Payments </p><br />
								$<?php echo $this->Form->input('til_balloon_pay_2',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?></p>
							</div>
							<div class="col-md-6">
								<p class="textBold">When Payments are Due</p><br />
								<?php echo $this->Form->input('til_balloon_pay_3',array('class'=>'form-control custom-form-control','div'=>false, 'label'=>false));?>$</p>
							</div>
							<hr />
							<div class="col-md-3">
								<h2 style="font-weight: normal;">Insurance</h2>
							</div>
							<div class="col-md-9">
								<p>Credit life and disability insurance is not required to obtain credit, and will not be provided unless you sign and agree to pay the additional cost. You may obtain property insurance from anyone you want that is acceptable to creditor.</p>
							</div><hr/>
							<div class="col-md-3">
								<h2 style="font-weight: normal;">Security</h2>
							</div>
							<div class="col-md-9">
								<p>You are giving a security interest in <?php echo $this->Form->input('security_interest',array('class'=>'form-control custom-form-control','div'=>false, 'label'=>false));?></p>
							</div><hr/>
							<div class="col-md-3">
								<h2 style="font-weight: normal;">Late Charges</h2>
							</div>
							<div class="col-md-9">
								<p>If a payment is late, you will be charged $ <?php echo $this->Form->input('til_late_payment_charged',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?> of the payment.</p>
							</div><hr/>
							<div class="col-md-3">
								<h2 style="font-weight: normal;">Filing Fees</h2>
							</div>
							<div class="col-md-9">
								<p>$ <?php echo $this->Form->input('til_filing_fee',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?></p>
							</div><hr/>
							<div class="col-md-3">
								<h2 style="font-weight: normal;">Pre-Payment</h2>
							</div>
							<div class="col-md-9">
								<p>If you pay off your loan early, you
									<?php echo $this->Form->input('til_pre_payment_pay',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'may','div'=>false,'label'=>false));?> may
									<?php echo $this->Form->input('til_pre_payment_pay',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'may_not','div'=>false,'label'=>false));?> may not 
								have to pay a penalty.If you pay off early, you
								<?php echo $this->Form->input('til_pre_payment_pay_early',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'may','div'=>false,'label'=>false));?> may
								<?php echo $this->Form->input('til_pre_payment_pay_early',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'may_not','div'=>false,'label'=>false));?> may not
									
								be entitled to a refund of part of the finance charge.</p>
							</div><hr/>
							<div class="col-md-3">
								<h2 style="font-weight: normal;">Assumption</h2>
							</div>
							<div class="col-md-9">
								<p>Someone buying your property
								<?php echo $this->Form->input('til_assumption',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'may','div'=>false,'label'=>false));?> may
								<?php echo $this->Form->input('til_assumption',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'may_not','div'=>false,'label'=>false));?> may not
								be allowed to assume the remainder of the mortgage on the original terms.</p>
							</div><hr/>
							<div class="col-md-12">
								See your contract documents for any additional information about non-payment, default, and required repayment in full before the scheduled date, and penalties.
							</div>
							<div class="col-md-12">
								<h2 class="text-center">Itemization Of The Amount Financed</h2>
							</div>
							
							<div class="col-md-8">
								1. Amount Given to You Directly
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_directly_amount',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								2. Amount Paid on Your Account
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_paid_account',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-12">
								3.Amounts Paid to Others on Your Behalf: 
							</div>
							<div class="col-md-8">
								<span class="m-l-30">1. Lender's Title Insurance</span> 
							</div>
							<div class="col-md-4">
								$<?php echo $this->Form->input('til_lenders_insurance',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								<span class="m-l-30">2. Notary Fee</span>
							</div>
							<div class="col-md-4">
								$<?php echo $this->Form->input('til_notary_fee',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								<span class="m-l-30">3. Recording Fees</span>
							</div>
							<div class="col-md-4">
								$<?php echo $this->Form->input('til_recording_fee',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								<span class="m-l-30">4. Settlement or Closing/Escrow Pad</span>
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_closing_pad',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								<span class="m-l-30">5. Settlement or Closing/Escrow Fee</span>
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_closing_fee',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-12">
								4.Amounts Paid to Creditor or Agent on Your Behalf (not a prepaid finance charge):
							</div>
							<div class="col-md-8">
								<span class="m-l-30">1. Wire Transfer Fee - Rockland Commercial, Inc.</span>
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_wire_tranfer_fee',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?></td>
							</div>
							<div class="col-md-8">
								<span class="m-l-30">2. Rockland Commercial Wire Transfer F - Rockland Commercial, Inc</span>
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_rocland_wire_tranfer',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								<span class="m-l-30">3. Rockland Commercial Credit Investig</span>
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_recoland_credit_investment',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								5. Amount Financed
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_amount_financed',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							<div class="col-md-8">
								6. Prepaid Finance Charge
							</div>
							<div class="col-md-4">
								$ <?php echo $this->Form->input('til_prepaid_finance',array('class'=>'priceMask form-control custom-form-control','div'=>false, 'label'=>false));?>
							</div>
							
							<div class="col-md-12">
								<p><?php echo $this->Form->input('til_if_checked',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'if_checked','div'=>false,'label'=>false));?> If checked, a credit life and disability insurance disclosure is attached.</p>
							</div><hr />
							<div class="col-md-12">
								<b>This property : </b>
								<ul>
									<li><?php echo $this->Form->input('til_principal_dwelling',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'is','div'=>false,'label'=>false));?> is my principal dwelling</li>
									<li><?php echo $this->Form->input('til_principal_dwelling',array('type'=>'checkbox', 'hiddenField'=>false,'value'=>'is_not','div'=>false,'label'=>false));?> is not my principal dwelling</li>
								</ul>
							</div>
							<div class="col-md-12">
								<b>I/We acknowledge receipt of a copy of this statement.</b>
							</div>
							<div class="col-md-6 col-md-offset-6">
								<div class="col-md-6 col-md-offset-6">
									<p style="font-weight: bold;font-family: cursive;font-style: italic;text-align: center;font-size: 25px;"><?php echo $loanDetail['ShortApplication']['name'];?></p>
									<?php echo $this->Form->input('today_date',array('class'=>'form-control date','label'=>false,'div'=>false));?>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="form-row pull-right">
								<?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-primary sumitButton','escape'=>false));?>
							</div>
						</div>
						<?php echo $this->Form->end();?>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
    </div>
    <!-- /#page-content-wrapper --> 
</div>
<style>
	p.textBold{
		font-size: 20px;
		font-weight: bold;
	}
	input.custom-form-control{
		width: 190px;
	}
</style>