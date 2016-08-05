<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
	<div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Type Of Mortgage And Terms Of Loan</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="row">
								<?php echo $this->Form->create('LongAppDetail',array('novalidate'=>'novalidate','class'=>'form-inline'));?>
									<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
									<div class="arm-type row">
										<div class="form-group col-sm-12">
											<div class="col-sm-6">
												<label class="control-label" for="inputEmail3">Mortage Applied For</label>
												<div class="clearfix"></div>
											<?php
												if(!empty($mortageValues)){
													foreach($mortageValues as $key=>$val){
														$checked = (!empty($this->request->data['LongAppDetail']['mortage']) && $this->request->data['LongAppDetail']['mortage'] == $key) ? 'checked' : '';
														?>
														<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppDetail][mortage]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>	
													<?php
														if($key == 'Conventional'){
															echo "<br />";
														}
													}
												}
											?>
											</div>
											<div id="mortageOtherDiv" class="col-sm-6" style="display: none;">
												<?php echo $this->Form->input('mortage_other',array('label'=>false,'div'=>false,'placeholder'=>'Mortage Other','class'=>'form-control'));?>
											</div>
										</div>
									</div>
									<div class="form-group col-sm-6">
										<?php echo $this->Form->input('agency_case_number',array('label'=>false,'div'=>false,'placeholder'=>'Agency Case Number','title'=>'Agency Case Number','class'=>'form-control'));?>
									</div>
									<div class="form-group col-sm-6">
										<?php echo $this->Form->input('lender_case_number',array('label'=>false,'div'=>false,'placeholder'=>'Lender Case Number','title'=>'Lender Case Number','class'=>'form-control'));?>
									</div>
									<div class="form-group col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<?php
											//echo pr($this->Session->read('userShortAppInfo.ShortApplication'));
											echo $this->Form->input('amount',array('label'=>false,'div'=>false,'placeholder'=>'Amount $','class'=>'form-control noValidate','value'=>$this->Session->read('userShortAppInfo.ShortApplication.loan_amount'),'title'=>'Amount','readonly'=> true));?>
										</div>
									</div>
									<div class="form-group col-sm-4">
										<?php
										if($this->Session->read('userShortAppInfo.SoftQuote.interest_rate') != 0){
											echo $this->Form->input('interest_rate',array('label'=>false,'div'=>false,'placeholder'=>'Interest Rate','title'=>'Interest Rate','class'=>'form-control noValidate','value'=>$this->Session->read('userShortAppInfo.SoftQuote.interest_rate'),'readonly'=>'readonly'));
										}else{
											echo $this->Form->input('interest_rate',array('label'=>false,'div'=>false,'placeholder'=>'Interest Rate','title'=>'Interest Rate','class'=>'form-control noValidate','min'=>'0','readonly'=>true));
										}
										?>
									</div>
									<div class="form-group col-sm-4">
										<?php
										if($this->Session->read('userShortAppInfo.SoftQuote.loan_term') != 0){
											echo $this->Form->input('number_of_months',array('label'=>false,'div'=>false,'placeholder'=>'Number Of Months','title'=>'Number Of Months','class'=>'form-control noValidate','value'=>$this->Session->read('userShortAppInfo.SoftQuote.loan_term'),'readonly'=>'readonly'));
										}else if($this->Session->read('userShortAppInfo.SoftQuote.other_loan_term') != 0){
											echo $this->Form->input('number_of_months',array('label'=>false,'div'=>false,'placeholder'=>'Number Of Months','title'=>'Number Of Months','class'=>'form-control noValidate','value'=>$this->Session->read('userShortAppInfo.SoftQuote.other_loan_term'),'readonly'=>'readonly'));
										}else{
											echo $this->Form->input('number_of_months',array('label'=>false,'div'=>false,'placeholder'=>'Number Of Months','title'=>'Number Of Months','class'=>'form-control noValidate','min'=>0,'readonly'=>true));
										}
										?>
									</div>
									<div class="clearfix"></div>
									<div class="arm-type row">
										<div class="form-group col-sm-12">
											<div class="col-sm-6">
												<label class="control-label" for="inputEmail3">Amortization Type</label>
												<div class="clearfix"></div>
											<?php
												if(!empty($amortizationValues)){
													foreach($amortizationValues as $key=>$val){
														$checked = (!empty($this->request->data['LongAppDetail']['amortization_type']) && $this->request->data['LongAppDetail']['amortization_type'] == $key) ? 'checked' : '';
														?>
														<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppDetail][amortization_type]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>	
													<?php
														if($key == 'GPM'){
															echo "<br />";
														}
													}
												}
											?>
											</div>
											<div id="ARMType" class="col-sm-6" style="display: none;">
												<?php echo $this->Form->input('arm_type',array('label'=>false,'div'=>false,'placeholder'=>'ARM Type','class'=>'form-control'));?>
											</div>
											<div id="amortizationTypeOther" class="col-sm-6" style="display: none;">
												<?php echo $this->Form->input('amortization_other',array('label'=>false,'div'=>false,'placeholder'=>'Other','Title'=>'Other','class'=>'form-control'));?>
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