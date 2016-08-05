<script>
	// datepicker
	jQuery('document').ready(function(){
		jQuery('.datepicker').datepicker({
				changeMonth: true,
				changeYear : true,
				endDate: '+0d',
		});
	});
</script>
<style>
	.borroweragesDiv .form-control.form-control-short, .agesDivCob .form-control.form-control-short{
		width : 120px
	}
</style>

<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Borrower / Co-Borrower Information</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">			
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="progress"><!-- Progress bar-->
								<div style="width:20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
									<span class="sr-only">20% Complete (success)</span>
								</div>
							</div>
							<!-- /Progress bar-->
							<h2>Borrower Information</h2><hr />
							<div class="row">
								<?php echo $this->Form->create('LongAppBorrower',array('novalidate'=>'novalidate','class' => 'form-inline step3-frm'));?>
									<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
									<div class="row">
										<div class="col-sm-12 propty ">
											<div class="pr-type">
												<?php echo $this->Form->input('borrower_name',array('label'=>false,'div'=>false,'class'=>'form-control','value'=>$this->Session->read('userShortAppInfo.ShortApplication.applicant_first_name').' '.$this->Session->read('userShortAppInfo.ShortApplication.applicant_last_name'),'title'=>'Borrower Name'));?>
											</div>
											<div class="pr-addrs">
												<?php echo $this->Form->input('borrower_social_security_number',array('label'=>false,'div'=>false,'placeholder'=>'Social Security Number','class'=>'form-control form-control-long maskSSN','title'=>'SSN'));?>
											</div>
											<div class="pr-city">
												<?php echo $this->Form->input('borrower_home_phone',array('label'=>false,'div'=>false,'placeholder'=>'Home Phone with Area Code','class'=>'maskInput form-control','title'=>'Home Phone with Area Code'));?>
											</div>
											<div class="pr-state">
												<?php echo $this->Form->input('borrower_dob',array('label'=>false,'div'=>false,'placeholder'=>'DOB','class'=>'form-control datepicker','title'=>'DOB'));?>
											</div>
											<div class="pr-zip">
												<?php echo $this->Form->input('borrower_school_year',array('label'=>false,'div'=>false,'placeholder'=>'School Year','class'=>'maskYear form-control','title'=>'School Year'));?>
											</div>
										</div>
									</div>
									<div class="form-group col-sm-12">
										<?php
											if(!empty($maritalStatus)){
												foreach($maritalStatus as $key=>$val){
													$checked = (!empty($this->request->data['LongAppBorrower']['marital_status']) && $this->request->data['LongAppBorrower']['marital_status'] == $key) ? 'checked' : '';		
												?>
													<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppBorrower][marital_status]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
											<?php
												}
											}
										?>
									</div>
									<div class="col-sm-12">
										<h5>Dependants (not listed by Co-Borrower)</h5>
									</div>
									<div class="form-group col-sm-2">
										<?php echo $this->Form->input('borrower_dependent_number',array('label'=>false,'div'=>false,'placeholder'=>'Dependents','class'=>'form-control borrowerdependentNumber'));?>
									</div>
									<!-- ages div bind here -->
									<div class="form-group col-sm-10 borroweragesDiv"></div>
									<div class="clearfix"></div>
									<!-- ages div bind here -->
									<div class="form-group" style="margin-top: 10px;">
										<div class="col-sm-6">
											<?php echo $this->Form->input('borrower_present_address',array('label'=>false,'div'=>false,'placeholder'=>'Present Address (street, city, state, ZIP)','class'=>'form-control presentAddress','title'=>'Present Address'));?>
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_city',array('label'=>false,'div'=>false,'placeholder'=>'City','class'=>'form-control mailingAddress','title'=>'City'));?>
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_state',array('options'=>$this->Common->getStates(),'div'=>false,'label'=>false,'class'=>'form-control selectpicker','empty' => 'Select State','title'=>'State'));?>
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->input('borrower_zip_code',array('label'=>false,'div'=>false,'placeholder'=>'ZipCode','class'=>'form-control maskZipCode','title'=>'ZipCode'));?>
										</div>
									</div>
									<div class="col-sm-7">
										<?php echo $this->Form->input('borrower_mailing_address',array('label'=>false,'div'=>false,'placeholder'=>'Mailing Address (street, city, state, ZIP)','class'=>'form-control mailingAddress','title'=>'Mailing Address'));?>
									</div>
									<div class="col-sm-2 block">
										<?php
											// Own / Rent
											$houseType = array('Own' => 'Own','Rent'=>'Rent');
											if(!empty($houseType)){
												foreach($houseType as $key=>$val){
													$checked = (!empty($this->request->data['LongAppBorrower']['borrower_house_type']) && $this->request->data['LongAppBorrower']['borrower_house_type'] == $key) ? 'checked' : '';		
												?>
													<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppBorrower][borrower_house_type]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
													<br />
											<?php
												}
											}
										?>
									</div>
									<div id="rentHouse" class="col-sm-3">
										<?php echo $this->Form->input('borrower_on_rent_years',array('label'=>false,'div'=>false,'placeholder'=>'No. Of Years','class'=>'form-control onRentYears maskUnit'));?>
									</div>
									<!-- if current address less then 2 years -->
									<div class="col-sm-12" id="formerAddress" style="display: none;">
										<h6>If residing at present address for less than two years, complete the following:</h6>
										<div class="col-sm-5">
											<?php echo $this->Form->input('borrower_former_address',array('label'=>false,'div'=>false,'placeholder'=>'Former Address (street, city, state, ZIP)','class'=>'form-control formerAddress','title'=>'Former Address'));?>
										</div>
										<div class="col-sm-3">
										<?php
											$houseType = array('Own' => 'Own','Rent'=>'Rent');
											if(!empty($houseType)){
												foreach($houseType as $key=>$val){
													$checked = (!empty($this->request->data['LongAppBorrower']['borrower_former_house_type']) && $this->request->data['LongAppBorrower']['borrower_former_house_type'] == $key) ? 'checked' : '';		
												?>
													<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppBorrower][borrower_former_house_type]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
													<br/>
											<?php
												}
											}
										?>
										</div>
										<div id="formerRentHouse" class="col-sm-4">
											<?php echo $this->Form->input('borrower_former_on_rent_years',array('label'=>false,'div'=>false,'placeholder'=>'No. Of Years','class'=>'form-control form-control-long maskUnit'));?>
										</div>
									</div>
									<hr/>
									<div class="clearfix"></div>
									<center>
										<label style="float: left;" class="checkbox-inline"><input class="co-borrower noValidate" name="co-borrower" type="checkbox" value="1"><b>Do you have Co-Borrower ?</b></label>	
									</center>

									<div class="co-borrower" style="display: none;">
										<div class="clearfix"></div>
										<h2>Co Borrower Information</h2><hr />
										<div class="row">
											<div class="col-sm-12 propty ">
												<div class="pr-type">
													<?php echo $this->Form->input('co_borrower_name',array('label'=>false,'div'=>false,'placeholder'=>'Co Borrower Name','class'=>'form-control','title'=>'Co Borrower Name'));?>
												</div>
												<div class="pr-addrs">
													<?php echo $this->Form->input('co_borrower_social_security_number',array('label'=>false,'div'=>false,'placeholder'=>'Social Security Number','class'=>'form-control maskSSN','title'=>'Co Borrower SSN'));?>
												</div>
												<div class="pr-city">
													<?php echo $this->Form->input('co_borrower_home_phone',array('label'=>false,'div'=>false,'placeholder'=>'Home Phone with Area Code','class'=>'maskInput form-control','title'=>'Home Phone with Area Code'));?>
												</div>
												<div class="pr-state">
													<?php echo $this->Form->input('co_borrower_dob',array('label'=>false,'div'=>false,'placeholder'=>'DOB','class'=>'form-control datepicker','title'=>'DOB'));?>
												</div>
												<div class="pr-zip">
													<?php echo $this->Form->input('co_borrower_school_year',array('label'=>false,'div'=>false,'placeholder'=>'School Year','class'=>'form-control maskYear','title'=>'School Year'));?>
												</div>
											</div>
										</div>
										<div class="form-group col-sm-12">
											<?php
												// marital status
												if(!empty($maritalStatus)){
													foreach($maritalStatus as $key=>$val){
														$checked = (!empty($this->request->data['LongAppBorrower']['cob_marital_status']) && $this->request->data['LongAppBorrower']['cob_marital_status'] == $key) ? 'checked' : '';		
													?>
														<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppBorrower][cob_marital_status]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
												<?php
													}
												}
											?>
										</div>
										<div class="col-sm-12">
											<h5>Dependants (not listed by Borrower)</h5>
										</div>
										<div class="form-group col-sm-2">
											<?php echo $this->Form->input('co_borrower_dependent_number',array('label'=>false,'div'=>false,'placeholder'=>'Dependents (not listed by Borrower)','class'=>'form-control form-control-short cob_dependentNumber'));?>
										</div>
										<!-- ages div bind here -->
										<div class="form-group col-sm-10 agesDivCob"></div>
										<div class="clearfix"></div>
										<!-- ages div bind here -->
										<div class="form-group mrg-top">
											<div class="col-sm-6">
												<?php echo $this->Form->input('co_borrower_present_address',array('label'=>false,'div'=>false,'placeholder'=>'Present Address (street, city, state, ZIP)','class'=>'form-control form-control-long presentAddress','title'=>'Present Address'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('co_borrower_city',array('label'=>false,'div'=>false,'placeholder'=>'City','class'=>'form-control mailingAddress','title'=>'City'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('co_borrower_state',array('options'=>$this->Common->getStates(),'div'=>false,'label'=>false,'class'=>'form-control selectpicker','empty' => 'Select State','title'=>'State'));?>
											</div>
											<div class="col-sm-2">
												<?php echo $this->Form->input('co_borrower_zip_code',array('label'=>false,'div'=>false,'placeholder'=>'ZipCode','class'=>'form-control','title'=>'Zip Code'));?>
											</div>
										</div>
										<div class="col-sm-7">
											<?php echo $this->Form->input('co_borrower_mailing_address',array('label'=>false,'div'=>false,'placeholder'=>'Mailing Address (street, city, state, ZIP)','class'=>'form-control form-control-long mailingAddress','title'=>'Mailing Address'));?>
										</div>
										<div class="col-sm-2 block">
											<?php
												// Own / Rent
												$houseType = array('Own' => 'Own','Rent'=>'Rent');
												if(!empty($houseType)){
													foreach($houseType as $key=>$val){
														$checked = (!empty($this->request->data['LongAppBorrower']['co_borrower_house_type']) && $this->request->data['LongAppBorrower']['co_borrower_house_type'] == $key) ? 'checked' : '';		
													?>
														<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppBorrower][co_borrower_house_type]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
														<br />
												<?php
													}
												}
											?>
										</div>
										<div id="rentHouseCob" class="col-sm-3 form-group">
											<?php echo $this->Form->input('co_borrower_on_rent_years',array('label'=>false,'div'=>false,'placeholder'=>'No. Of Years','class'=>'form-control form-control-long onRentYearsCob maskUnit','title'=>'Rent No. of Years'));?>
										</div>
										<!-- if current address less then 2 years -->
										<div class="col-sm-12" id="formerAddressCob" style="display: none;">
											<h6>If residing at present address for less than two years, complete the following:</h6>
											<div class="col-sm-5">
												<?php echo $this->Form->input('co_borrower_former_address',array('label'=>false,'div'=>false,'placeholder'=>'Former Address (street, city, state, ZIP)','class'=>'form-control formerAddressCob'));?>
											</div>
											<div class="col-sm-3">
											<?php
												$houseType = array('Own' => 'Own','Rent'=>'Rent');
												if(!empty($houseType)){
													foreach($houseType as $key=>$val){
														$checked = (!empty($this->request->data['LongAppBorrower']['co_borrower_former_house_type']) && $this->request->data['LongAppBorrower']['co_borrower_former_house_type'] == $key) ? 'checked' : '';		
													?>
														<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppBorrower][co_borrower_former_house_type]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
														<br/>
												<?php
													}
												}
											?>
											</div>
											<div id="formerRentHouseCob" class="col-sm-4">
												<?php echo $this->Form->input('co_borrower_former_on_rent_years',array('label'=>false,'div'=>false,'placeholder'=>'No. Of Years','class'=>'form-control maskUnit','title'=>'No. of Years'));?>
											</div>
										</div>
										<hr/>
									</div>
									<div class="clearfix"></div>
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