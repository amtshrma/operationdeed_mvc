<?php
    echo $this->Html->script(array('jquery.maskMoney.js','front/processor.js'));
?>
<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3>Mortage Loan Disclosure Statement / Good Faith Estimate</h3><hr/>
		<div class="with-nav-tabs panel-default">
            <div class="panel-heading2" >
				<ul class="nav nav-tabs" id="disclosure-container">
				   <li><a href="javascript:void(0);">Step 1</a></li>
				   <li class="active"><a href="javascript:void(0);">Step 2</a></li>
				   <li><a href="javascript:void(0);">Step 3</a></li>
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
							   <h2>GOOD FAITH ESTIMATE OF CLOSING COSTS</h2>
							</div>
							<p style="text-align: justify;line-height: 20px;">The information provided below reflects estimates of the charges you are likely to incur at the settlement of your loan. The fees, commissions, costs and expenses listed are estimates; the actual charges may be more or less. Your transaction may not involve a charge for every item listed and any additional items charged will be listed. The numbers listed beside the estimated items generally correspond to the numbered lines contained in the HUD-1 Settlement Statement which you will receive at settlement if this transaction is subject to RESPA. The HUD-1 Settlement Statement contains the actual costs for the items paid at settlement. When this transaction is subject to RESPA, by signing page four of this form you are also acknowledging receipt of the HUD Guide to Settlement Costs.</p>
							<div class="table-block table-responsive">
							   <table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th style="width: 16%;">HUD-1</th>
										<th style="width: 43%;">Item</th>
										<th style="width: 20%;">Paid to Others</th>
										<th>Paid to Broker</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td scope="row"><label>800</label></td>
										<td>Items Payable in Connection with Loan</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td scope="row"><label>801</label></td>
										<td>lender's Loan Origination Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('lender_origination_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Lender Origination Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('lender_origination_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Lender Origination Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>802</label></td>
										<td>Lender's Loan Discount Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('lender_loan_discount_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Lender Loan Discount Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('lender_loan_discount_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Lender Loan Discount Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>803</label></td>
										<td>Appraisal Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('appraisal_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Appraisal Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('appraisal_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Appraisal Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>804</label></td>
										<td>Credit Report</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('credit_report_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Credit Report Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('credit_report_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Credit Report Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>805</label></td>
										<td>Lender's Inspection Fee </td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('lender_inception_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Lender Inception Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('lender_inception_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Lender Inception Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>808-A</label></td>
										<td>Loan Arranging Broker Commission Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('loan_arranging_a_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Mortage Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('loan_arranging_a_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Mortage Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>808-B</label></td>
										<td>Loan Arranging Broker Commission Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('loan_arranging_b_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Mortage Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('loan_arranging_b_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Mortage Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>809</label></td>
										<td>Tax Service Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('tax_service_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Tax Service Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('tax_service_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Tax Service Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>810</label></td>
										<td>Rockland Processing Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('processing_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Processing Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1','readonly'=>true, 'value'=>$this->Session->read('adminSettings.processing_fee')));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('processing_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Processing Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>811</label></td>
										<td>Underwriting Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('underwriting_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Underwriting Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('underwriting_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Underwriting Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>812</label></td>
										<td>Wire Transfer Fee </td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('wire_transfer_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Wire Transfer Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('wire_transfer_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Wire Transfer Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row">
											<?php echo $this->Form->input('other1',array('class'=>'noValidate form-control', 'title'=>'Other1','div'=>false,'label'=>false));?>
										</td>
										<td>
											<?php echo $this->Form->input('other2',array('class'=>'noValidate form-control', 'title'=>'Other2','div'=>false,'label'=>false));?>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other3',array('class'=>'priceMask noValidate form-control', 'title'=>'Other3','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other4',array('class'=>'priceMask noValidate form-control', 'title'=>'Other4','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label><strong>900</strong></label></td>
										<td><i>Lender's Loan Discount Fee</i></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td><label>901</label></td>
										<td class="form-control-inline">
											<p style='line-height: 25px;'>Interest for
											<?php echo $this->Form->input('interest_for_days',array('type'=>'numeric','class'=>'noValidate custom-form-control', 'title'=>'Interest for days','div'=>false,'label'=>false));?>
											days at $ <br /><br />
											<?php echo $this->Form->input('interest_amount_per_day',array('class'=>'priceMask noValidate custom-form-control', 'title'=>'Interest Per Day','div'=>false,'label'=>false));?>
											per day</p>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('inetrest_to_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Interest To Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('inetrest_to_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Interest To Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>902</label></td>
										<td>Mortgage Insurance Premiums</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('mortage_insurance_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Mortage Insurance Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('mortage_insurance_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Mortage Insurance Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>903</label></td>
										<td>Hazard Insurance Premiums</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('hazard_insurance_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Hazard Insurance Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('hazard_insurance_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Hazard Insurance Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>904</label></td>
										<td>County Property Taxes</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('county_taxes_other',array('class'=>'priceMask noValidate form-control', 'title'=>'County Texes Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('county_taxes_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'County Texes Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>905</label></td>
										<td>VA Funding Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('va_funding_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'VA Funding Others','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('va_funding_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'VA Funding Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row">
											<?php echo $this->Form->input('other11',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<?php echo $this->Form->input('other21',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other31',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other41',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label><strong>1000</strong></label></td>
										<td><i>Reserves Deposited with Lender</i></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td><label>1001</label></td>
										<td class="form-control-inline">
											<p style='line-height: 25px;'>Hazard Insurance : 
											<?php echo $this->Form->input('hazard_insurance_months',array('type'=>'numeric','class'=>'noValidate custom-form-control', 'title'=>'Hazard Insurance Months','div'=>false,'label'=>false));?>
											days at $ <br /><br />
											<?php echo $this->Form->input('hazard_amount_per_month',array('class'=>'priceMask noValidate custom-form-control', 'title'=>'Hazard Per Month','div'=>false,'label'=>false));?>
											per day</p>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('reserve_hazard_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Reserve Hazard Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('reserve_hazard_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Reserve Hazard Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
									</tr>
									<tr>
										<td><label>1002</label></td>
										<td class="form-control-inline">
											<p style='line-height: 25px;'>Mortgage Insurance : 
											<?php echo $this->Form->input('mortagage_insurance_months',array('type'=>'numeric','class'=>'noValidate custom-form-control', 'title'=>'Mortgage Insurance Months','div'=>false,'label'=>false));?>
											days at $ <br /><br />
											<?php echo $this->Form->input('mortgage_amount_per_month',array('type'=>'numeric','class'=>'noValidate custom-form-control', 'title'=>'Mortgage Per Month','div'=>false,'label'=>false));?>
											per day</p>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('reserve_mortgage_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Reserve Mortgage Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('reserve_mortgage_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Reserve Mortgage Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
									</tr>
									<tr>
										<td><label>1004</label></td>
										<td class="form-control-inline">
											<p style='line-height: 25px;'>Co. Property Taxes: 
											<?php echo $this->Form->input('company_taxas_months',array('type'=>'numeric', 'class'=>'noValidate custom-form-control', 'title'=>'Company Texes Months','div'=>false,'label'=>false));?>
											days at $ <br /><br />
											<?php echo $this->Form->input('company_amount_taxes_per_month',array('class'=>'priceMask noValidate custom-form-control', 'title'=>'Company Texes Per Month','div'=>false,'label'=>false));?>
											per day</p>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('reserve_company_taxes_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Reserve Company Texes Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('reserve_company_taxes_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Reserve Company Texes Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
										   </div>
										</td>
									</tr>
									<tr>
										<td scope="row">
											<?php echo $this->Form->input('other12',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<?php echo $this->Form->input('other22',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other32',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other42',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
									   <td scope="row"><label><strong>1100</strong></label></td>
									   <td><i>Title Charges</i></td>
									   <td></td>
									   <td></td>
									</tr>
									<tr>
										<td scope="row"><label>1101</label></td>
										<td>Settlement or Closing/Escrow Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('setting_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Settlement Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('setting_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Settlement Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>1105</label></td>
										<td>Document Preparation Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('document_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Document Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('document_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Document Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>1106</label></td>
										<td>Notary Fee</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('notary_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Notary Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('notary_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Notary Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>1108</label></td>
										<td>Title Insurance</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('insurance_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Insurance Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('insurance_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Insurance Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row">
											<?php echo $this->Form->input('other13',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<?php echo $this->Form->input('other23',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other33',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other43',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label><strong>1200</strong></label></td>
										<td><i>Government Recording and Transfer Charges</i></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td scope="row"><label>1201</label></td>
										<td>Recording Fees</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('recording_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Recording Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('recording_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Recording Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label>1202</label></td>
										<td>City/County Tax/Stamps</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Other Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Other Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row">
											<?php echo $this->Form->input('other14',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<?php echo $this->Form->input('other24',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other34',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other44',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row"><label><strong>1300</strong></label></td>
										<td><i>Additional Settlement Charges</i></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td scope="row"><label>1302</label></td>
										<td>Pest Inspection</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('inspection_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Inspection Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('inspection_fee_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Inspection Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
										<td scope="row">
											<?php echo $this->Form->input('other15',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<?php echo $this->Form->input('other25',array('class'=>'noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false));?>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other35',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon">$</span>
												<?php echo $this->Form->input('other45',array('class'=>'priceMask noValidate form-control', 'title'=>'Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									<tr>
									   <td colspan="2" scope="row"><label><strong>Subtotals of Initial Fees, Commissions, Costs and Expenses</strong></	label></td>
										<td>
											<div class="input-group"> <span id="subtotal_expanses_fee" class="input-group-addon">$</span>
												<?php echo $this->Form->input('subtotal_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Sutotal & Expanses Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td>
											<div class="input-group"> <span class="input-group-addon" >$</span>
												<?php echo $this->Form->input('subtotal_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Sutotal & Expanses Fee Broker','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
									</tr>
									 <tr>
										<td scope="row" colspan="2"><label><strong>Total of Initial Fees, Commissions, Costs and Expenses</strong></label></td>
										<td>
											<div class="input-group"> <span id="subtotal_expanses_fee" class="input-group-addon">$</span>
												<?php echo $this->Form->input('total_fee_other_broker',array('class'=>'priceMask noValidate form-control', 'title'=>'Total Initial Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td></td>
									 </tr>
									 <tr>
										<td colspan="2" scope="row"><label><strong>Compensation to Broker (Not Paid Out of Loan Proceeds):</strong></label></td>
										<td></td>
										<td></td>
									 </tr>
									 <tr>
										<td colspan="2" scope="row"><label>Mortgage Broker Commission/Fee</label></td>
										<td>
											<div class="input-group"> <span id="subtotal_expanses_fee" class="input-group-addon">$</span>
												<?php echo $this->Form->input('mortage_broker_commission_fee_other',array('class'=>'priceMask noValidate form-control', 'title'=>'Total Initial Fee Other','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td></td>
									 </tr>
									 <tr>
										<td scope="row" colspan="2"><label>Any Additional Compensation from Lender</label>
											<div class="checkbox-inline-cell">
												<?php echo $this->Form->input('lender_conpensation_status',array('type'=>'checkbox','value'=>'no', 'title'=>'Lender Type','div'=>false,'label'=>false,'style'=>'margin-right:6px;'));?> No
								  <?php echo $this->Form->input('lender_conpensation_status',array('type'=>'checkbox','value'=>'yes', 'title'=>'Lender Type','div'=>false,'label'=>false,'style'=>'margin-right:6px;'));?> Yes
											</div>
											<p>(Approximate Yield Spread Premium or Other Rebate)</p></td>
										<td>
											<div class="input-group"> <span id="subtotal_expanses_fee" class="input-group-addon">$</span>
												<?php echo $this->Form->input('additional_compensation_from_lender',array('class'=>'priceMask noValidate form-control', 'title'=>'Additional Compensation From Lender','div'=>false,'label'=>false,'aria-describedby'=>'basic-addon1'));?>
											</div>
										</td>
										<td></td>
									 </tr>
								  </tbody>
							   </table>
							</div>
							<div class="form-row pull-right">
								<?php echo $this->Form->button('Next <span class="glyphicon glyphicon-chevron-right"></span>',array('type'=>'submit','class'=>'btn btn-primary sumitButton','escape'=>false));?>
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