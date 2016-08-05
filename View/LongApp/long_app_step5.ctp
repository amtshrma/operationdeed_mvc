<?php echo $this->Html->script('jquery.maskMoney.js'); ?>

<script>
	jQuery('document').ready(function(){
		jQuery(".maskIncome").maskMoney({allowZero:false, allowNegative:true, defaultZero:false});
	});
</script>
<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Borrower / Co- Borrower Income And Expenses</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="progress"><!-- Progress bar-->
								<div style="width:40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
									<span class="sr-only">11% Complete (success)</span>
								</div>
							</div>
							<!-- /Progress bar-->
							<h2>Monthly Income And Combined Housing Expense Information</h2><hr />
							<div class="row">
								<div class="col-sm-12">
									<p>* Self Employed Borrower(s) may be required to provide additional documentation such as tax returns and financial statements</p>
								</div>
								<?php echo $this->Form->create('LongAppBorrowerIncome',array('novalidate'=>'novalidate','class' => 'form-inline step6-frm'));?>
									<br/>
									<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
									<div class="clearfix"></div>
									<div class="table-responsive mnthly">
										<table class="table">
											<tr>
												<th>Gross Monthly Income</th>
												<th>Borrower</th>
												<th>Co- Borrower</th>
												<th>Total</th>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Base Empl. Income ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_base_income',array('label'=>false,'div'=>false,'placeholder'=>'Base Empl. Income','class'=>'maskIncome form-control form-control-short income bo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_base_income',array('label'=>false,'div'=>false,'placeholder'=>'Base Empl. Income','class'=>'noValidate maskIncome form-control form-control-short income cbo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('total_income',array('label'=>false,'div'=>false,'placeholder'=>'Total','class'=>'form-control form-control-short totalIncome tbo','readonly'=>true));?>
												</td>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Overtime ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_overtime',array('label'=>false,'div'=>false,'placeholder'=>'Overtime','class'=>'maskIncome form-control form-control-short overtime bo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_overtime',array('label'=>false,'div'=>false,'placeholder'=>'Overtime','class'=>'noValidate maskIncome form-control form-control-short overtime cbo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('total_overtime',array('label'=>false,'div'=>false,'placeholder'=>'Total Overtime','class'=>'form-control form-control-short totalOvertime tbo','readonly'=>true));?>
												</td>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Bonuses ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_bonus',array('label'=>false,'div'=>false,'placeholder'=>'Bonus','class'=>'maskIncome form-control form-control-short bonus bo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_bonus',array('label'=>false,'div'=>false,'placeholder'=>'Bonus','class'=>'noValidate maskIncome form-control form-control-short bonus cbo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('total_bonus',array('label'=>false,'div'=>false,'placeholder'=>'Total Bonus','class'=>'form-control form-control-short totalBonus tbo','readonly'=>true));?>
												</td>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Commissions ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_commission',array('label'=>false,'div'=>false,'placeholder'=>'Commission','class'=>'maskIncome form-control form-control-short commission bo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_commission',array('label'=>false,'div'=>false,'placeholder'=>'Commission','class'=>'noValidate maskIncome form-control form-control-short commission cbo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('total_commission',array('label'=>false,'div'=>false,'placeholder'=>'Total Commission','class'=>'form-control form-control-short totalCommission tbo','readonly'=>true));?>
												</td>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Dividends/Interest ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_dividend',array('label'=>false,'div'=>false,'placeholder'=>'Dividend','class'=>'form-control form-control-short dividend bo maskIncome'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_dividend',array('label'=>false,'div'=>false,'placeholder'=>'Dividend','class'=>'noValidate form-control form-control-short dividend cbo maskIncome'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('total_dividend',array('label'=>false,'div'=>false,'placeholder'=>'Total Dividend','class'=>'form-control form-control-short totalDividend tbo','readonly'=>true));?>
												</td>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Net Rental Income ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_rental_income',array('label'=>false,'div'=>false,'placeholder'=>'Rental Income','class'=>'form-control form-control-short rental bo maskIncome'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_rental_income',array('label'=>false,'div'=>false,'placeholder'=>'Rental Income','class'=>'noValidate form-control form-control-short rental cbo maskIncome'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('total_rental_income',array('label'=>false,'div'=>false,'placeholder'=>'Total Rental Income','class'=>'form-control form-control-short totalRental tbo','readonly'=>true));?>
												</td>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Other <span style="font-size: 10px;">(before completing, see the notice in "describe other income," below)</span></p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_other',array('label'=>false,'div'=>false,'placeholder'=>'Other','class'=>'maskIncome noValidate form-control form-control-short other bo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_other',array('label'=>false,'div'=>false,'placeholder'=>'Other','class'=>'noValidate maskIncome form-control form-control-short other cbo'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('total_other',array('label'=>false,'div'=>false,'placeholder'=>'Other Total','class'=>'noValidate form-control form-control-short totalOther tbo','readonly'=>true));?>
												</td>
											</tr>
											<tr class="ttl-scr">
												<td align="left"><p style="padding-top: 10px">Total ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('borrower_total',array('label'=>false,'div'=>false,'placeholder'=>'Total','class'=>'form-control form-control-short totalbo','readonly'=> true));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('co_borrower_total',array('label'=>false,'div'=>false,'placeholder'=>'Total','class'=>'noValidate form-control form-control-short totalcbo','readonly'=> true));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('final_total',array('label'=>false,'div'=>false,'placeholder'=>'Final Total','class'=>'form-control form-control-short totaltbo','readonly'=>true));?>
												</td>
											</tr>
										</table>
									</div>
									<div class="col-sm-12">
										<div class="checkbox">
										  <label>
											<?php echo $this->Form->input('select_other_income',array('label'=>false,'div'=>false,'type'=>'checkbox','class'=>'')); ?>
											Other income (before selecting and completing, see the notice below.)</label>
										</div>
										<p class="mar-tb">Notice: Alimony, child support, or separate maintenance income need not be revealed if the
										  Borrower (B) or Co-Borrower (C) does not choose to have it considered for repaying this loan.</p>
									</div>
									<div class="col-sm-12">
										<table class="table">
										  <tr>
											<th colspan="2">Describe Other Income</th>
											<th>Monthly Amount</th>
										  </tr>
										  <tr>
											<td style="width:10%">
												<?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'B/C','class'=>'noValidate form-control form-control-short'));?>
											</td>
											<td style="width:65%"><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'','class'=>'noValidate form-control form-control-short'));?></td>
											<td style="width:25%"><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'$','class'=>'noValidate form-control form-control-short'));?></td>
										  </tr>
										  <tr>
											<td><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'B/C','class'=>'noValidate form-control form-control-short'));?></td>
											<td><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'','class'=>'noValidate form-control form-control-short'));?></td>
											<td><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'$','class'=>'noValidate form-control form-control-short'));?></td>
										  </tr>
											<tr>
											<td><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'B/C','class'=>'noValidate form-control form-control-short'));?></td>
											<td><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'','class'=>'noValidate form-control form-control-short'));?></td>
											<td><?php echo $this->Form->input('other_income',array('label'=>false,'div'=>false,'placeholder'=>'$','class'=>'noValidate form-control form-control-short'));?></td>
										  </tr>
										</table>
									</div>
									<div class="table-responsive mnthly">
										<table class="table">
											<tr>
												<th>Combined Monthly Housing Expense</th>
												<th>Present</th>
												<th>Proposed</th>
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Rent ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('present_rate',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome form-control form-control-short presentData'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_rate',array('label'=>false,'div'=>false,'class'=>'noValidate maskIncome form-control form-control-short  proposedData','readonly'=>true));?>
												</td>
												
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">First Mortgage (P&I) ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('present_mortage',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome form-control form-control-short presentData'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_mortage',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome form-control form-control-short proposedData'));?>
												</td>
												
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Other Financing (P&I) ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('present_financing',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome form-control form-control-short presentData'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_financing',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome form-control form-control-short proposedData'));?>
												</td>
												
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Hazard Insurance ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('present_hazard_insurance',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome form-control form-control-short presentData'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_hazard_insurance',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome form-control form-control-short proposedData'));?>
												</td>
												
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Real Estate Taxes  ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('present_real_taxes',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate form-control form-control-short presentData maskIncome'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_real_taxes',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate form-control form-control-short proposedData maskIncome'));?>
												</td>
												
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Mortage Insurance ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('present_mortage_insurance',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate form-control form-control-short presentData maskIncome'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_mortage_insurance',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate form-control form-control-short proposedData maskIncome'));?>
												</td>
												
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Homeowner Assn. Dues ($) </p></td>
												<td align="left">
													<?php echo $this->Form->input('present_homeowner_dues',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome noValidate form-control form-control-short presentData'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_homeowner_dues',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate maskIncome form-control form-control-short proposedData'));?>
												</td>
											
											</tr>
											<tr>
												<td align="left"><p style="padding-top: 10px">Other ($) </p></td>
												<td align="left">
													<?php echo $this->Form->input('present_other',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'maskIncome noValidate form-control form-control-short presentData'));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_other',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate maskIncome form-control form-control-short proposedData'));?>
												</td>
											
											</tr>
											<tr class="ttl-scr">
												<td align="left"><p style="padding-top: 10px">Total ($)</p></td>
												<td align="left">
													<?php echo $this->Form->input('present_total',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate form-control form-control-short totalPresentData','readonly'=> true));?>
												</td>
												<td align="left">
													<?php echo $this->Form->input('proposed_total',array('label'=>false,'div'=>false,'placeholder'=>'$.00','class'=>'noValidate form-control form-control-short totalProposedData','readonly'=> true));?>
												</td>
												
											</tr>
										</table>
									</div>
									
									<div class="col-sm-12 btn-top">
										<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('type'=>'submit','class'=>'btn blue sumitButton','escape'=>false));?>
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