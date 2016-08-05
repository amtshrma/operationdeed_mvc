<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<center>
			<h1>Borrower Long Application</h1>
			<br>
			<div class="panel panel-default">
				<div id="navigation-tabs">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#">Step 1</a></li>
						<li><a>Step 2</a></li>
						<li><a>Step 3</a></li>
						<li><a>Step 4</a></li>
						<li><a>Step 5</a></li>
						<li><a>Step 6</a></li>
						<li><a>Step 7</a></li>
						<li><a>Step 8</a></li>
						<li><a>Step 9</a></li>
					</ul>
				</div>
				<div class="panel-body">
					<!--div class="progress" style="margin:10px">
						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
							<span class="sr-only">0% Complete (success)</span>
						</div>
					</div-->
					<?php echo $this->Form->create('LongApp',array('novalidate'=>'novalidate'));?>
					<h3>Types Of Mortage And Terms Of Loan</h3>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
						<label>Mortage Applied For :</label>
						<br>
						<?php
						if(!empty($mortageValues)){
							foreach($mortageValues as $key=>$val){?>
								<label class="checkbox-inline"><input name="data[LongApp][mortage]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>	
							<?php
								if($key == 'Conventional'){
									echo "<br />";
								}
							}
						}
						?>
					</div>
					<div id="mortageOtherDiv" class="form-group" style="display: none;float:left;text-align:left;padding-top:35px;margin-right:40px;">
						<?php echo $this->Form->input('mortage_other',array('label'=>false,'div'=>false,'placeholder'=>'Mortage Other','class'=>'form-control form-control-short'));?>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
					<?php
						echo $this->Form->input('agency_case_number',array('label'=>false,'div'=>false,'placeholder'=>'Agency Case Number','class'=>'form-control form-control-long'));
						echo $this->Form->input('lender_case_number',array('label'=>false,'div'=>false,'placeholder'=>'Lender Case Number','class'=>'form-control form-control-long'));
						echo $this->Form->input('amount',array('label'=>false,'div'=>false,'placeholder'=>'Amount','class'=>'form-control form-control-short'));
						echo $this->Form->input('interest_rate',array('label'=>false,'div'=>false,'placeholder'=>'Interest Rate','class'=>'form-control form-control-short'));
						echo $this->Form->input('number_of_months',array('label'=>false,'div'=>false,'placeholder'=>'Number Of Months','class'=>'form-control form-control-long'));
					?>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
						<label>Amortization Type:</label>
						<br>
						<?php
						if(!empty($amortizationValues)){
							foreach($amortizationValues as $key=>$val){?>
								<label class="checkbox-inline"><input name="data[LongApp][amortization_type]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>	
							<?php
								if($key == 'GPM'){
									echo "<br />";
								}
							}
						}
						?>
					</div>
					<div id="ARMType" class="form-group" style="display: none;float:left;text-align:left;padding-top:35px;margin-right:40px;">
						<?php echo $this->Form->input('arm_type',array('label'=>false,'div'=>false,'placeholder'=>'ARM Type','class'=>'form-control form-control-long'));?>
					</div>
					<div id="amortizationTypeOther" class="form-group" style="display: none;float:left;text-align:left;padding-top:35px;margin-right:40px;">
						<?php echo $this->Form->input('amortization_type',array('label'=>false,'div'=>false,'placeholder'=>'Other','class'=>'form-control form-control-long'));?>
					</div>
					<div style="clear:both"></div>
					<!-- property informaion -->
					<h3>Property Information and purpose of loan</h3>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
					<?php
						echo $this->Form->input('property_address',array('label'=>false,'div'=>false,'placeholder'=>'Property Address','class'=>'form-control form-control-long'));
						echo $this->Form->input('number_of_unit',array('label'=>false,'div'=>false,'placeholder'=>'Number Of Unit','class'=>'form-control form-control-short'));
						echo $this->Form->input('year_built',array('label'=>false,'div'=>false,'placeholder'=>'Year Built','class'=>'form-control form-control-short'));
						echo $this->Form->input('property_description',array('label'=>false,'div'=>false,'placeholder'=>'Legal Description of property','class'=>'form-control form-control-long'));
					?>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
						<label>Purpose Of Loan:</label>
						<br>
						<?php
						if(!empty($loanPurpose)){
							foreach($loanPurpose as $key=>$val){?>
								<label class="checkbox-inline"><input name="data[LongApp][loan_purpose]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>	
							<?php
								if($key == 'Construction'){
									echo "<br />";
								}
							}
						}
						?>
					</div>
					<div id="loanPurpose" class="form-group" style="display: none;float:left;text-align:left;padding-top:35px;margin-right:40px;">
						<?php echo $this->Form->input('mortage_other',array('label'=>false,'div'=>false,'placeholder'=>'Other Purpose','class'=>'form-control form-control-short'));?>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
						<label>Property Will Be:</label>
						<br>
						<?php
						if(!empty($propertyArray)){
							foreach($propertyArray as $key=>$val){?>
								<label class="checkbox-inline"><input name="data[LongApp][property_purpose]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label>
						<?php
							}
						}
						?>
					</div>
					<div id="constructionDetail" class="form-group" style="float:left;text-align:left;padding-left:10px">
					<?php
						echo $this->Form->input('property_addres',array('label'=>false,'div'=>false,'placeholder'=>'Property Address','class'=>'form-control form-control-long'));
						echo $this->Form->input('number_of_unit',array('label'=>false,'div'=>false,'placeholder'=>'Number Of Unit','class'=>'form-control form-control-short'));
						echo $this->Form->input('year_built',array('label'=>false,'div'=>false,'placeholder'=>'Year Built','class'=>'form-control form-control-short'));
						echo $this->Form->input('property_description',array('label'=>false,'div'=>false,'placeholder'=>'Legal Description of property','class'=>'form-control form-control-long'));
					?>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
					<?php
						echo $this->Form->input('title_name',array('label'=>false,'div'=>false,'placeholder'=>'Title will be held in what name (s)','class'=>'form-control form-control-long'));
						echo $this->Form->input('title_manner',array('label'=>false,'div'=>false,'placeholder'=>'Manner in which title held','class'=>'form-control form-control-long'));
						echo $this->Form->input('source_downpayment',array('label'=>false,'div'=>false,'placeholder'=>'Source OF Down Payment','class'=>'form-control form-control-long'));
					?>
						<div class="estimatesDiv">
							<label>Estate will be held in:</label>
							<br />
							<?php
							if(!empty($estimateArray)){
								foreach($estimateArray as $key=>$val){?>
									<label class="checkbox-inline"><input name="data[LongApp][estimates]" type="checkbox" value="<?php echo $key;?>"><?php echo $val;?></label><br />
							<?php
								}
							}
							?>
						</div>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">

					</div>
					<center>
						<div style="clear:both"></div>
						<br>
						<table border="0" width="100%">
							<tr>
								<td align="left">
									<!--button class="btn btn-lg btn-cancel" type="submit"><span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel</button-->
								</td>
								<td align="right">
									<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('type'=>'submit','class'=>'btn btn-lg btn-primary','escape'=>false));?>
								</td>
							</tr>
						</table>
						<br>
					</center>
					<?php echo $this->Form->end();?>
				</div>
				<!-- /.panel-body -->
			</div>
		</center>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->