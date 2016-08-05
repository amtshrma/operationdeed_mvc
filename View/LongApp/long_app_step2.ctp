<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Property Information And Purpose Of Loan</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">			
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<!-- Progress bar-->
							<div class="progress">
								<div style="width:10%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
									<span class="sr-only">10% Complete (success)</span>
								</div>
							</div>
							<!-- /Progress bar-->
							<div class="row">
								<?php //pr($this->Session->read('userShortAppInfo')); ?>
								<?php echo $this->Form->create('LongAppPropertyInformation',array('novalidate'=>'novalidate'));?>
									<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
									<div class="row">
										<div class="col-sm-12 propty ">
											<div class="pr-type">
												<?php echo $this->Form->input('property_type',array('div'=>false,'label'=>false,'class'=>'form-control selectpicker','title'=>'Property Type','value'=>$this->Session->read('userShortAppInfo.ShortApplication.property_type'),'readonly'=>true));?>
											</div>
											<div class="pr-addrs">
												<?php echo $this->Form->input('property_address',array('label'=>false,'div'=>false,'placeholder'=>'Property Address','title'=>'Property Address','class'=>'form-control','value'=>$this->Session->read('userShortAppInfo.ShortApplication.property_address'),'readonly'=>true));?>
											</div>
											<div class="pr-city">
												<?php echo $this->Form->input('property_city',array('label'=>false,'div'=>false,'class'=>'form-control','title'=>'Property City','value'=>$this->Common->getCityName($this->Session->read('userShortAppInfo.ShortApplication.property_city')),'readonly'=>true));?>
											</div>
											<div class="pr-state">
												<?php
												$legalDisable = $unitDisable = $yearDisable = $stateDisable = '';
												$propertyState = $this->Session->read('userShortAppInfo.ShortApplication.property_state');
												if(!empty($propertyState)) {
													$stateDisable = 'readonly';
												}
												
												echo $this->Form->input('property_state',array('div'=>false,'label'=>false,'class'=>'form-control selectpicker','title'=>'Property State','value'=>$this->Common->getStateName($propertyState), $stateDisable));?>
											</div>
											<div class="pr-zip">
												<?php echo $this->Form->input('property_zip_code',array('label'=>false,'div'=>false,'title'=>'Property Zip Code','class'=>'form-control','value'=>$this->Session->read('userShortAppInfo.ShortApplication.property_zipcode'),'readonly'=>true));?>
											</div>
										</div>
									</div>
									<div class="form-group col-sm-6">
										<?php
										
										$legalDescription = $this->Session->read('userShortAppInfo.PropertyDetail.LegalDesc');
										if(!empty($legalDescription)) {
											$legalDisable = 'readonly';
										}
										echo $this->Form->input('property_legal_description',array('label'=>false,'div'=>false,'class'=>'form-control','title'=>'Legal Description','value'=>$legalDescription, $legalDisable));?>
									</div>
									<div class="form-group col-sm-3">
										<?php
										//pr($this->Session->read('userShortAppInfo.PropertyDetail.Units'));
										$units = $this->Session->read('userShortAppInfo.PropertyDetail.Units');
										if(!empty($units)) {
											$unitDisable = 'readonly';
										} 
										echo $this->Form->input('property_number_of_units',array('label'=>false,'div'=>false,'class'=>'form-control','value'=>$units,'title'=>'Number Of Units', $unitDisable));?>
									</div>
									<div class="form-group col-sm-3">
										<?php
										$yearBuit = $this->Session->read('userShortAppInfo.PropertyDetail.YearBuilt');
										if(!empty($yearBuit)) {
											$yearDisable = 'readonly';
										}
										
										echo $this->Form->input('property_year_built',array('label'=>false,'div'=>false,'class'=>'form-control','value'=>$yearBuit,'title'=>'Year Built',$yearDisable));?>
									</div>
									<div class="col-sm-6 pr-loan">
										<h4>Purpose of Loan</h4>
									<?php
										if(!empty($loanPurpose)){
											foreach($loanPurpose as $key=>$val){
											$checked = (!empty($this->request->data['LongAppPropertyInformation']['loan_purpose']) && $this->request->data['LongAppPropertyInformation']['loan_purpose'] == $key) ? 'checked' : '';	
											?>
												<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppPropertyInformation][loan_purpose]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>	
											<?php
												if($key == 'Construction'){
													echo "<br />";
												}
											}
										}
									?>
									</div>
									<div class="col-sm-6">
										<h4>Property will be:</h4>
										<?php
											if(!empty($propertyArray)){
												foreach($propertyArray as $key=>$val){
													$checked = (!empty($this->request->data['LongAppPropertyInformation']['property_purpose']) && $this->request->data['LongAppPropertyInformation']['property_purpose'] == $key) ? 'checked' : '';		
												?>
													<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppPropertyInformation][property_purpose]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
											<?php
												}
											}
										?>
									</div>
									<div id="loanPurposeOther" class="loanPurpose col-sm-7 form-group top-mrg" style="display: none;">
										<?php echo $this->Form->input('property_other_loan',array('label'=>false,'div'=>false,'placeholder'=>'Other Purpose','title'=>'Other','class'=>'form-control'));?>
									</div>
									<!-- construction and contruction permanant loan -->
									<div id="constructionDetail" class="loanPurpose per-ln col-sm-12" style="display: none;">
										<hr/>
										<h4>Construction or Construction-Permanent Loan</h4>
										<div class="form-group col-sm-2">
											<label>Year Lot Acquired</label>
											<?php echo $this->Form->input('cons_year_acquired',array('label'=>false,'div'=>false,'placeholder'=>'Year Of Acquired','class'=>'form-control','value'=> date('d M Y',strtotime($this->Session->read('userShortAppInfo.PropertyDetail.LastSaleDate'))),'readonly'=>true,'title'=>'Year Of Acquired'));?>
										</div>
										<div class="form-group col-sm-2">
											<label>Original Cost ($)</label>
											<?php echo $this->Form->input('cons_original_cost',array('label'=>false,'div'=>false,'placeholder'=>'Original Cost','class'=>'form-control','value'=>$this->Session->read('userShortAppInfo.PropertyDetail.ValueTotal'),'readonly'=>true,'title'=>'Original Cost'));?>
										</div>
										<div class="form-group col-sm-2">
											<label>Amount Existing Liens ($)</label>
											<?php echo $this->Form->input('cons_amount_existing',array('label'=>false,'div'=>false,'placeholder'=>'Amount Existing','class'=>'form-control','value'=>0,'readonly'=>true,'title'=>'Amount Existing Liens'));?>
										</div>
										<div class="form-group col-sm-2">
											<label>(a) Present Value of Lot ($)</label>
											<?php echo $this->Form->input('cons_present_value',array('label'=>false,'div'=>false,'placeholder'=>'Present Value','class'=>'form-control cons_totalA','value'=>$this->Session->read('userShortAppInfo.PropertyDetail.AvmPropertyValue'),'title'=>'Present Value of Lot'));?>
										</div>
										<div class="form-group col-sm-2">
											<label>(b) Cost of Improvements ($)</label>
											<?php echo $this->Form->input('cons_cost_improvements',array('label'=>false,'div'=>false,'placeholder'=>'Cost Of Improvement','class'=>'form-control cons_totalB','title'=>'Cost Of Improvement')); ?>
										</div>
										<div class="form-group col-sm-2">
											<label>Total (a + b) ($)</label>
											<?php echo $this->Form->input('cons_total_cost',array('label'=>false,'div'=>false,'placeholder'=>'Total (a + b)','class'=>'form-control cons_total_final','readonly'=>true,'placeholder'=>'Total'));?>
										</div>
									</div>
									<!-- Refinanace loan -->
									<div id="refinanceDetail" class="loanPurpose made per-ln col-sm-12" style="display: none;">
										<hr/>
										<h4>Refinance Loan</h4>
										<div class="form-group col-sm-2">
											<label>Year Lot Acquired</label>
											<?php echo $this->Form->input('ref_year_acquired',array('label'=>false,'div'=>false,'placeholder'=>'Year Of Acquired','class'=>'form-control','value'=>date('d M Y',strtotime($this->Session->read('userShortAppInfo.PropertyDetail.LastSaleDate'))),'readonly'=>true,'title'=>'Year Of Acquired'));?>
										</div>
										<div class="form-group col-sm-2">
											<label>Original Cost ($)</label>
											<?php echo $this->Form->input('ref_original_cost',array('label'=>false,'div'=>false,'placeholder'=>'Original Cost','class'=>'form-control','value'=>$this->Session->read('userShortAppInfo.PropertyDetail.LastSaleAmt'),'readonly'=>true,'title'=>'Original Cost'));?>
										</div>
										<div class="form-group col-sm-2">
											<label>Amount Existing Liens ($)</label>
											<?php echo $this->Form->input('ref_amount_existing',array('label'=>false,'div'=>false,'placeholder'=>'Amount Existing','class'=>'form-control','value'=>0,'title'=>'Amount Existing Liens'));?>
										</div>
										<div class="form-group col-sm-6">
											<label>Purpose of Refinance</label>
											<?php echo $this->Form->input('ref_purpose_refinance',array('label'=>false,'div'=>false,'placeholder'=>'Purpose Of Refinance','class'=>'form-control','value'=>$this->Session->read('userShortAppInfo.ShortApplication.loan_objective'),'title'=>'Purpose of Refinance'));?>
										</div>
										<label class="sm-tx">Describe Improvements</label>
										<div class="col-sm-6 form-group">
											<?php echo $this->Form->input('ref_cost_improvements',array('label'=>false,'div'=>false,'placeholder'=>'Cost Of Improvement','class'=>'form-control','title'=>'Cost Of Improvement'));?>
										</div>
										<div class="col-sm-6">
										<?php
											$improvementArray = array('made'=>'Made','to be made' => 'To be made');
											foreach($improvementArray as $key=>$val){
												$checked = (!empty($this->request->data['LongAppPropertyInformation']['ref_des_improvements']) && $this->request->data['LongAppPropertyInformation']['ref_des_improvements'] == $key) ? 'checked' : '';	
												?>
												<label class="checkbox-inline" style="min-height: 10px;"><input <?php echo $checked;?> name="data[LongAppPropertyInformation][ref_des_improvements]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
											<?php
											}
										?>
										</div>
									</div>
									<hr/>
									<div class="col-sm-4">
										<label class="sm-tx">Title will be held in what Name(s)</label>
										<?php echo $this->Form->input('title_name',array('label'=>false,'div'=>false,'class'=>'form-control','value'=>$this->Session->read('userShortAppInfo.PropertyDetail.Vesting')));?>
									</div>
									<div class="col-sm-4">
										<label class="sm-tx">Manner in which Title will be held</label>
										<?php echo $this->Form->input('title_manner',array('label'=>false,'div'=>false,'placeholder'=>'Manner in which title held','class'=>'form-control'));?>
									</div>
									<div class="col-sm-2 pad-off est">
										<label class="sm-tx">Estate will be held in</label>
										<?php 
											if(!empty($estimateArray)){
												
												foreach($estimateArray as $key=>$val){
												$checked = '';
												if(!empty($this->request->data['LongAppPropertyInformation']['estimates']) && $this->request->data['LongAppPropertyInformation']['estimates']) {
													$checked = $this->request->data['LongAppPropertyInformation']['estimates'];
												}elseif($key == 'Fee Simple')  { 
													$checked = 'checked';
												} 
												//$checked = (!empty($this->request->data['LongAppPropertyInformation']['estimates']) && $this->request->data['LongAppPropertyInformation']['estimates'] == $key) ? 'checked' : '';			
												?>
													<label class="checkbox-inline"><input <?php echo $checked;?> name="data[LongAppPropertyInformation][estimates]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
											<?php
												}
											}
										?>
									</div>
									<div class="col-sm-2 pad-off">
										<?php echo $this->Form->input('expiration_date',array('label'=>false,'div'=>false,'placeholder'=>'Expiry Date','class'=>'maskYear form-control','title'=>'Expiry Date'));?>
									</div>
									<div class="form-group col-sm-12 src">
										<h5>Source of Down Payment, Settlement Charges,  and/or Subordinate Financing (explain)</h5>
										<?php echo $this->Form->input('source_down_payment',array('label'=>false,'div'=>false,'placeholder'=>'Source Of Down Payment','class'=>'form-control','title'=>'Source Of Down Payment'));?>
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