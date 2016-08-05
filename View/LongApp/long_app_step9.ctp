<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Borrower / Co-Borrower Declaration</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="progress"><!-- Progress bar-->
								<div style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
									<span class="sr-only">80% Complete (success)</span>
								</div>
							</div>
							<!-- /Progress bar-->
							<?php echo $this->Form->create('LongAppBorrowerChecklist',array('novalidate'=>'novalidate','class' => 'form-horizontal step9-frm'));?>
								<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-8 control-label tx-bd">If you answer ?YES? to any questions a through i, please use continuation sheet for explanation.</label>
									<div class="col-sm-2 lbl-hd">
										<h4>Borrower</h4>
										<label class="hidden-xs">Yes</label>
										<label class="hidden-xs">No</label>
									</div>
									<div class="col-sm-2 lbl-hd">
										<h4>Co-Borrower</h4>
										<label class="hidden-xs">Yes</label>
										<label class="hidden-xs">No</label>
									</div>
								</div>
								<?php
								$checlistArray = array(
														'outstanding_judgment' => 'a. Are there any outstanding judgments against you',
														'declared_bankrupt' => 'b. Have you been declared bankrupt in the past 7 years',
														'property_forclosed' => 'c. Have you had property foreclosed upon or given title or deed in lieu thereof in the last 7 years',
														'party_lawsuit' => 'd. Are you a party to a lawsuit',
														'loan_foreclosure_judgement' => 'e. Have you directly or indirectly been obligated on any loan which resulted in foreclosure, transfer of title in lieu of foreclosure, or judgment',
														'federal_debt' => 'f. Are you currently delinquent or in default on any Federal debt or any other loan, mortgage, financial obligation, bond or loan guarantee? If "Yes," give details as described in the preceding question',
														'child_support' => 'g. Are you obligated to pay alimony, child support, or separate maintenance',
														'down_payment_borrowed' => 'h. Is any part of the down payment borrowed',
														'co-maker_endorser' => 'i. Are you a co-maker or endorser on a note',
														'us_citizen' => 'j. Are you a U.S. citizen',
														'permanent_resident_alien' => 'k. Are you a permanent resident alien'
													);
								foreach($checlistArray as $key=>$val){
								?>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-8 control-label"><?php echo $val;?>?</label>
									<div class="col-sm-2">
										<label>
											<input type="checkbox" name="data[LongAppBorrowerChecklist][borrower_<?php echo $key;?>]" value="yes">
											<span class="visible-xs">Yes</span>
										</label>
										<label>
											<input type="checkbox" name="data[LongAppBorrowerChecklist][borrower_<?php echo $key;?>]" value="no">
											<span class="visible-xs">No</span>
										</label>
									</div>
									<div class="col-sm-2">
										<label>
											<input type="checkbox" class="noValidate" name="data[LongAppBorrowerChecklist][co_borrower_<?php echo $key;?>]" value="yes">
											<span class="visible-xs">Yes</span>
										</label>
										<label>
											<input type="checkbox" class="noValidate" name="data[LongAppBorrowerChecklist][co_borrower_<?php echo $key;?>]" value="no">
											<span class="visible-xs">No</span>
										</label>
									</div>
								</div>
								<?php } ?>
								
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-9 control-label">l. Do you intend to occupy the property as your primary residence? If "Yes," complete question m below?</label>
									<div class="col-sm-3">
										<label>
											<input type="checkbox" name="data[LongAppBorrowerChecklist][borrower_primary_resident]" value="yes">
											<span class="visible-xs">Yes</span>
										</label>
										<label>
											<input type="checkbox" name="data[LongAppBorrowerChecklist][borrower_primary_resident]" value="no">
											<span class="visible-xs">No</span>
										</label>
									</div>
								</div>
								<div class="showDivM" style="display: none;">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-9 control-label">m. Have you had ownership interest in a property in the last three years?</label>
										<div class="col-sm-3">
											<label>
												<input type="checkbox" name="data[LongAppBorrowerChecklist][ownership_interest_property]" value="yes">
												<span class="visible-xs">Yes</span>
											</label>
											<label>
												<input type="checkbox" name="data[LongAppBorrowerChecklist][ownership_interest_property]" value="no">
												<span class="visible-xs">No</span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-9 control-label">1. What type of property did you own-principal residence (PR), second home (SH), or investment property (IP)?</label>
										<div class="col-sm-3">
											<label>
												<?php echo $this->Form->input('type_of_property_own',array('label'=>false,'div'=>false,'class'=>'liquidAssests maskIncome form-control','title'=>'Amount'));?>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-9 control-label">2. How did you hold title to the home-solely by yourself (S), jointly with your spouse (SP), or jointly with another person (O)?</label>
										<div class="col-sm-3">
											<label>
												<?php echo $this->Form->input('solely_jointly_property',array('label'=>false,'div'=>false,'class'=>'liquidAssests maskIncome form-control'));?>
											</label>
										</div>
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