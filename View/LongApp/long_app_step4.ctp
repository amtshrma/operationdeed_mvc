<?php echo $this->Html->script('jquery.maskMoney.js'); ?>
<script>
	// Date picker from and to Borrower
	//Borrower
jQuery('document').ready(function(){
	jQuery(".maskIncome").maskMoney({allowZero:false, allowNegative:true, defaultZero:false});
	jQuery("#fromBorrower").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				jQuery("#toBorrower").datepicker( "option", "minDate", selectedDate );
		  }
	});
	jQuery("#toBorrower").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				$( "#fromBorrower" ).datepicker( "option", "maxDate", selectedDate );
			}
	});
	// prev borrower
	jQuery(".borrower_prev_from").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				jQuery(".borrower_prev_to").datepicker( "option", "minDate", selectedDate );
		  }
	});
	jQuery(".borrower_prev_to").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				$( ".borrower_prev_from" ).datepicker( "option", "maxDate", selectedDate );
			}
	});
	// Co-Borrower
	jQuery(".co_borrower_job_from").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				jQuery(".co_borrower_job_to").datepicker( "option", "minDate", selectedDate );
		  }
	});
	jQuery(".co_borrower_job_to").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				$( ".co_borrower_job_from" ).datepicker( "option", "maxDate", selectedDate );
			}
	});
	// co-borrower prev job
	jQuery(".co_borrower_prev_job_from").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				jQuery(".co_borrower_prev_job_to").datepicker( "option", "minDate", selectedDate );
		  }
	});
	jQuery(".co_borrower_prev_job_to").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				$( ".co_borrower_job_prev_from" ).datepicker( "option", "maxDate", selectedDate );
			}
	});
});
</script>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Borrower / Co-Borrower Employment</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="progress"><!-- Progress bar-->
								<div style="width:30%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
									<span class="sr-only">30% Complete (success)</span>
								</div>
							</div>
							<!-- /Progress bar-->
							<h2>Borrower Employment Information</h2><hr />
							<div class="row">
								<?php echo $this->Form->create('LongAppBorrowerEmployment',array('novalidate'=>'novalidate','class' => 'form-inline step4-frm'));?>
									<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
									<div class="form-group wd">
										<div class="col-sm-3">
											<?php echo $this->Form->input('borrower_employer_name',array('label'=>false,'div'=>false,'placeholder'=>'Name Of Employer','class'=>'form-control','title'=>'Name Of Employer'));?>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('borrower_years_job',array('label'=>false,'div'=>false,'placeholder'=>'Year on this Job','class'=>'maskNumber form-control','title'=>'Year on this Job'));?>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('borrower_years_inthis_field',array('label'=>false,'div'=>false,'placeholder'=>'Yrs. employed in this line of work','class'=>'maskNumber form-control','title'=>'Yrs. employed in this line of work'));?>
										</div>
										<div class="col-sm-3">
											<label class="checkbox-inline mr-10">
												<input type="checkbox" id="inlineCheckbox1" value="self employed" name="data[LongAppBorrowerEmployment][borrower_self_employed]" class="noValidate">Self Employed
											</label>
										</div>
									</div>
									<div class="form-group wd">
										<div class="col-sm-4">
											<?php echo $this->Form->input('borrower_position',array('label'=>false,'div'=>false,'placeholder'=>'Position / Title/Type Of Business','class'=>'form-control','title'=>'Position / Title/Type Of Business'));?>
										</div>
										<div class="col-sm-4">
											<?php echo $this->Form->input('borrower_business_phone',array('label'=>false,'div'=>false,'placeholder'=>'Business Phone','class'=>'maskInput form-control','title'=>'Business Phone'));?>
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_job_from',array('label'=>false,'div'=>false,'placeholder'=>'Job From','class'=>'form-control','id'=>'fromBorrower','title'=>'Job From'));?>
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_job_to',array('label'=>false,'div'=>false,'placeholder'=>'Job To','class'=>'form-control','id'=>'toBorrower','title'=>'Job To'));?>
										</div>
									</div>
									<div class="form-group wd">
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_monthly_income',array('label'=>false,'div'=>false,'placeholder'=>'Monthly Income','class'=>'maskIncome form-control','title'=>'Monthly Income'));?>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('borrower_job_present_address',array('label'=>false,'div'=>false,'placeholder'=>'Present Address','class'=>'form-control','title'=>'Present Address'));?>
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_job_city',array('label'=>false,'div'=>false,'placeholder'=>'City','class'=>'form-control','title'=>'City'));?>
										</div>
										<div class="col-sm-3">
											<?php echo $this->Form->input('borrower_job_state',array('options'=>$this->Common->getStates(),'div'=>false,'label'=>false,'class'=>'form-control selectpicker','empty' => 'Select State','title'=>'State'));?>
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_job_zipcode',array('label'=>false,'div'=>false,'placeholder'=>'ZipCode','class'=>'form-control maskZipCode','title'=>'ZipCode'));?>
										</div>
									</div>
									<div class="grey-line"></div>
									<h6>
										<input class="noValidate employedYears" type="checkbox" name="employed">If employed in current position for less than two years or if currently employed in more than one position, complete the following:
									</h6>
									<div class="clearfix"></div>
									<div class="employedYears" style="display: none;">
										<div class="form-group wd">
											<div class="col-sm-3">
												<?php echo $this->Form->input('borrower_prev_employer_name',array('label'=>false,'div'=>false,'placeholder'=>'Name Of Employer','class'=>'form-control','title'=>'Name Of Employer'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('borrower_prev_years_job',array('label'=>false,'div'=>false,'placeholder'=>'Year on this Job','class'=>'maskNumber form-control','title'=>'Year on this Job'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('borrower_prev_years_inthis_field',array('label'=>false,'div'=>false,'placeholder'=>'Yrs. employed in this line of work','class'=>'maskNumber form-control','title'=>'Yrs. employed in this line of work'));?>
											</div>
											<div class="col-sm-3">
												<label class="checkbox-inline mr-10">
													<input type="checkbox" id="inlineCheckbox1" value="self employed" name="data[LongAppBorrowerEmployment][borrower_prev_self_employed]" class="noValidate">Self Employed
												</label>
											</div>
										</div>
										<div class="form-group wd">
											<div class="col-sm-4">
												<?php echo $this->Form->input('borrower_prev_position',array('label'=>false,'div'=>false,'placeholder'=>'Position / Title/TYpe Of Business','class'=>'form-control','title'=>'Position / Title/TYpe Of Business'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('borrower_prev_business_phone',array('label'=>false,'div'=>false,'placeholder'=>'Business Phone','class'=>'maskInput form-control','title'=>'Business Phone'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('borrower_prev_job_from',array('label'=>false,'div'=>false,'placeholder'=>'Job From','class'=>'form-control borrower_prev_from','title'=>'Job From'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('borrower_prev_job_to',array('label'=>false,'div'=>false,'placeholder'=>'Job To','class'=>'form-control borrower_prev_to','title'=>'Job To'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('borrower_prev_monthly_income',array('label'=>false,'div'=>false,'placeholder'=>'Monthly Income','class'=>'form-control','title'=>'Monthly Income'));?>
											</div>
										</div>
										<div class="form-group wd">
											<div class="col-sm-4">
												<?php echo $this->Form->input('borrower_prev_job_present_address',array('label'=>false,'div'=>false,'placeholder'=>'Present Address','class'=>'form-control','title'=>'Present Address'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('borrower_prev_job_city',array('label'=>false,'div'=>false,'placeholder'=>'City','class'=>'form-control','title'=>'City'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('borrower_prev_job_state',array('options'=>$this->Common->getStates(),'div'=>false,'label'=>false,'class'=>'form-control selectpicker','empty' => 'Select State','title'=>'State'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('borrower_prev_job_zipcode',array('label'=>false,'div'=>false,'placeholder'=>'ZipCode','class'=>'form-control','title'=>'ZipCode'));?>
											</div>
										</div>
									</div>
									<hr/>
									<div class="col-sm-12">
										<h6><input class="noValidate coBorrowerShow" type="checkbox" name="employed">Do you have Co-Borrower ?</h6>
									</div>
									<div class="coBorrowerShow" style="display: none;">
										<div class="col-sm-12">
											<h2>Co-Borrower Employment Information</h2><hr />
										</div>
										<div class="form-group wd">
											<div class="col-sm-3">
												<?php echo $this->Form->input('co_borrower_employer_name',array('label'=>false,'div'=>false,'placeholder'=>'Name Of Employer','class'=>'form-control','title'=>'Name Of Employer'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('co_borrower_years_job',array('label'=>false,'div'=>false,'placeholder'=>'Year on this Job','class'=>'maskNumber form-control','title'=>'Year on this Job'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('co_borrower_years_inthis_field',array('label'=>false,'div'=>false,'placeholder'=>'Yrs. employed in this line of work','class'=>'maskNumber form-control','title'=>'Yrs. employed in this line of work'));?>
											</div>
											<div class="col-sm-3">
												<label class="checkbox-inline mr-10">
													<input type="checkbox" id="inlineCheckbox1" value="self employed" name="data[LongAppBorrowerEmployment][co_borrower_self_employed]">Self Employed
												</label>
											</div>
										</div>
										<div class="form-group wd">
											<div class="col-sm-4">
												<?php echo $this->Form->input('co_borrower_position',array('label'=>false,'div'=>false,'placeholder'=>'Position / Title/TYpe Of Business','class'=>'form-control','title'=>'Position / Title/TYpe Of Business'));?>
											</div>
											<div class="col-sm-4">
												<?php echo $this->Form->input('co_borrower_business_phone',array('label'=>false,'div'=>false,'placeholder'=>'Business Phone','class'=>'maskInput form-control','title'=>'Business Phone'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('co_borrower_job_from',array('label'=>false,'div'=>false,'placeholder'=>'Job From','class'=>'form-control co_borrower_job_from','title'=>'Job From'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('co_borrower_job_to',array('label'=>false,'div'=>false,'placeholder'=>'Job To','class'=>'form-control co_borrower_job_to','title'=>'Job To'));?>
											</div>
										</div>
										<div class="form-group wd">
											<div class="col-sm-2">
												<?php echo $this->Form->input('co_borrower_monthly_income',array('label'=>false,'div'=>false,'placeholder'=>'Monthly Income','class'=>'form-control','title'=>'Monthly Income'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('co_borrower_job_present_address',array('label'=>false,'div'=>false,'placeholder'=>'Present Address','class'=>'form-control','title'=>'Present Address'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('co_borrower_job_city',array('label'=>false,'div'=>false,'placeholder'=>'City','class'=>'form-control','title'=>'City'));?>
											</div>
											<div class="col-sm-3">
												<?php echo $this->Form->input('co_borrower_job_state',array('options'=>$this->Common->getStates(),'div'=>false,'label'=>false,'class'=>'form-control selectpicker','empty' => 'Select State','title'=>'State'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('co_borrower_job_zipcode',array('label'=>false,'div'=>false,'placeholder'=>'ZipCode','class'=>'form-control','title'=>'ZipCode'));?>
											</div>
										</div>
										<div class="grey-line"></div>
										<h6><input class="noValidate cobEmployedYears" type="checkbox" name="employed">If employed in current position for less than two years or if currently employed in more than one position, complete the following:</h6>
										<div class="clearfix"></div>
										<div class="cobEmployedYears" style="display: none;">
											<div class="form-group wd">
												<div class="col-sm-3">
													<?php echo $this->Form->input('co_borrower_prev_employer_name',array('label'=>false,'div'=>false,'placeholder'=>'Name Of Employer','class'=>'form-control','title'=>'Name Of Employer'));?>
												</div>
												<div class="col-sm-3">
													<?php echo $this->Form->input('co_borrower_prev_years_job',array('label'=>false,'div'=>false,'placeholder'=>'Year on this Job','class'=>'maskNumber form-control','title'=>'Year on this Job'));?>
												</div>
												<div class="col-sm-3">
													<?php echo $this->Form->input('co_borrower_prev_years_inthis_field',array('label'=>false,'div'=>false,'placeholder'=>'Yrs. employed in this line of work','class'=>'maskNumber form-control','title'=>'Yrs. employed in this line of work'));?>
												</div>
												<div class="col-sm-3">
													<label class="checkbox-inline mr-10">
														<input type="checkbox" id="inlineCheckbox1" value="self employed" name="data[LongAppBorrowerEmployment][co_borrower_prev_self_employed]">Self Employed
													</label>
												</div>
											</div>
											<div class="form-group wd">
												<div class="col-sm-3">
													<?php echo $this->Form->input('co_borrower_prev_position',array('label'=>false,'div'=>false,'placeholder'=>'Position / Title/Type Of Business','class'=>'form-control','title'=>'Position / Title/Type Of Business'));?>
												</div>
												<div class="col-sm-3">
													<?php echo $this->Form->input('co_borrower_prev_business_phone',array('label'=>false,'div'=>false,'placeholder'=>'Business Phone','class'=>'maskInput form-control','title'=>'Business Phone'));?>
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('co_borrower_prev_job_from',array('label'=>false,'div'=>false,'placeholder'=>'Job From','class'=>'form-control co_borrower_prev_job_from','title'=>'Job From'));?>
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('co_borrower_prev_job_to',array('label'=>false,'div'=>false,'placeholder'=>'Job To','class'=>'form-control co_borrower_prev_job_to','title'=>'Job To'));?>
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('co_borrower_prev_monthly_income',array('label'=>false,'div'=>false,'placeholder'=>'Monthly Income','class'=>'form-control','title'=>'Monthly Income'));?>
												</div>
											</div>
											<div class="form-group wd">
												<div class="col-sm-4">
													<?php echo $this->Form->input('co_borrower_prev_job_present_address',array('label'=>false,'div'=>false,'placeholder'=>'Present Address','class'=>'form-control','title'=>'Present Address'));?>
												</div>
												<div class="col-sm-3">
													<?php echo $this->Form->input('co_borrower_prev_job_city',array('label'=>false,'div'=>false,'placeholder'=>'City','class'=>'form-control','title'=>'City'));?>
												</div>
												<div class="col-sm-3">
													<?php echo $this->Form->input('co_borrower_prev_job_state',array('options'=>$this->Common->getStates(),'div'=>false,'label'=>false,'class'=>'form-control selectpicker','empty' => 'Select State','title'=>'State'));?>
												</div>
												<div class="col-sm-2">
													<?php echo $this->Form->input('co_borrower_prev_job_zipcode',array('label'=>false,'div'=>false,'placeholder'=>'ZipCode','class'=>'form-control','title'=>'ZipCode'));?>
												</div>
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
</div>