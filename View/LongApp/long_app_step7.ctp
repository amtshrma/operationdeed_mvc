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
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div">
		<h2><center>Schedule of Real Estate Owned</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body" style="padding: 15px;">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="progress"><!-- Progress bar-->
							  <div style="width:60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" 
						class="progress-bar progress-bar-success progress-bar-striped"> <span class="sr-only">60% Complete (success)</span> </div>
							</div>
							<!-- /Progress bar-->
							<div class="row">
								<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
								<div class="col-sm-12">
									<p>Property Address (enter S if sold, PS if pending sale or R if rental being held for income)</p>
								</div>
								<?php echo $this->Form->create('LongAppBorrowerRealEstate',array('novalidate'=>'novalidate','class' => 'form-inline step4-frm'));?>
									<div class="clearfix"></div>
									<div class="col-sm-12">
										<?php echo $this->Form->hidden("option_count",array("value"=>'0',"id"=>"optionsPropertyCount"));?>
										<?php  echo $this->Html->link('Add Property <span class="glyphicon glyphicon-plus"></span>','javascript:void(0)',array('class'=>'addMoreProperty','title'=>'Click to add more property','onclick'=>'addMorePropertyOption();','escape'=>false,'style'=>'float: right;'));?>
									</div>
									<div  class="table-responsive mnthly">
										<table class="table owned" id="propertyTable">
											<tr id="headerColumn">
												<th width="150px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
												<th></th>
												<th>Type of Property</th>
												<th>Present Market Value</th>
												<th>Amount of Mortgages & Liens</th>
												<th>Gross Rental Income</th>
												<th>Mortgage Payments</th>
												<th>Insurance, Maintenance, Taxes & Misc.</th>
												<th>Net Rental Income</th>
											</tr>
											<tr class="propertyRow" id="borrowerProperties">
												<td width="150px" class="col-wd">
													<?php echo $this->Form->input('LongAppBorrowerRealEstate.other_property_address.0',array('label' => false,'div' => false, 'placeholder' => 'Address','class' => 'form-control','maxlength' => 100,'title' =>'Address')); ?>
												</td>
												<td class="col-wd">
												<?php echo $this->Form->input('',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','title' =>'')); ?>
												</td>
												<td>
													<?php echo $this->Form->input('LongAppBorrowerRealEstate.other_property_type.0',array('label' => false,'div' => false, 'empty' => 'Property Type','options'=>$propertyTypes,'class' => 'form-control','maxlength' => 100,'title' =>'Property Type')); ?>
												</td>
												<td><?php echo $this->Form->input('LongAppBorrowerRealEstate.present_market_value.0',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'maskIncome form-control marketValue'));?></td>
												<td>
													<?php echo $this->Form->input('LongAppBorrowerRealEstate.mortage_amount.0',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'maskIncome form-control mortageAmount'));?>
												</td>
												<td>
													<?php echo $this->Form->input('LongAppBorrowerRealEstate.rental_income.0',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'maskIncome form-control rentalIncome'));?>
												</td>
												<td>
													<?php echo $this->Form->input('LongAppBorrowerRealEstate.mortage_payment.0',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'maskIncome form-control mortagePayment'));?>
												</td>
												<td>
													<?php echo $this->Form->input('LongAppBorrowerRealEstate.misc_income.0',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'maskIncome form-control miscIncome'));?>
												</td>
												<td>
													<?php echo $this->Form->input('LongAppBorrowerRealEstate.total_income.0',array('label'=>false,'div'=>false,'placeholder'=>'$0.00','class'=>'rowTotal form-control totalIncome'));?>
												</td>
												<td>
													<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i>',"javascript:void(0);",array('title'=>'Remove Property Detail','style' => 'display:none;margin-top: 10px;text-align: right;','escape'=>false));?>
											
												</td>
											</tr>
											<tr class="ttl-scr">
												<td></td>
												<td></td>
												<td>Total($)</td>
												<td class="totalPresentValue">$0.00</td>
												<td class="totalMortageAmount">$0.00</td>
												<td class="totalGrossIncome">$0.00</td>
												<td class="totalMortage">$0.00</td>
												<td class="totalInsurance">$0.00</td>
												<td class="totalRentalIncome">$0.00</td>
											</tr>
										</table>
									</div>
									<div class="col-sm-11 mrg-cnt">
										<p>List any additional names under which credit has previously been received and indicate appropriate creditor name(s) and account number(s):</p>
									</div>
									<div class="col-sm-4">
										<label for="inputEmail3"><h4>Altername Name</h4></label>
										<?php echo $this->Form->input('altername_name',array('label'=>false,'div'=>false,'class'=>'form-control'));?>
									</div>
									<div class="col-sm-4">
										<label for="inputEmail3"><h4>Creditor Name</h4></label>
										<?php echo $this->Form->input('creditor_name',array('label'=>false,'div'=>false,'class'=>'form-control'));?>
									</div>
									<div class="col-sm-4">
										<label for="inputEmail3"><h4>Account Number</h4></label>
										<?php echo $this->Form->input('account_number',array('label'=>false,'div'=>false,'class'=>'form-control'));?>
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