<!-- Page Content -->
<?php
    echo $this->Html->script(array('jquery.maskMoney.js','front/processor.js'));
?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3>Mortage Loan Disclosure Statement / Good Faith Estimate</h3><hr/>
		<?php echo $this->Session->flash();?>
		<div class="with-nav-tabs panel-default">
            <div class="panel-heading2" >
				<ul class="nav nav-tabs" id="disclosure-container">
					<li class="active"><a href="javascript:void(0);">Step 1</a></li>
					<li><a href="javascript:void(0);">Step 2</a></li>
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
							<div class="heading-ttl text-center">
								<h2>Mortage Loan Disclosure Statement/ Good Faith Estimate </h2>
								<h2>NontraditionaL Mortgage Product (One To Four Residential Units)</h2>
							</div>
							<div class="form-row">
								<span>RE 885 (Rev. 8/08)</span><hr style="margin: 10px 0px;"/>
							</div>
							<div class="form-row">
								Borrowers Name(s):
									<?php echo $this->Form->input('borrower_name',array('class'=>'form-control custom-form-control', 'title'=>'Borrower Name','div'=>false,'label'=>false,'value'=>$borrowerDetail['User']['name'],'readonly'=>true));?>
								Real Property Collateral: The intended security for this proposed loan will be a Deed of Trust on (street address or legal description)
									<?php echo $this->Form->input('legal_description',array('class'=>'form-control custom-form-control', 'title'=>'Legal Description','div'=>false,'label'=>false,'value'=>$loanDetail['ShortApplication']['loan_objective']));?>
								This joint Mortgage Loan Disclosure Statement/Good Faith Estimate is being provided by
									<?php
									echo $loanDetail['ShortApplication']['broker_ID'];
									//$brokerDetail = $this->Common->getUserDetail($loanDetail['ShortApplication']['broker_ID']);
									//echo $this->Form->input('broker_name',array('class'=>'form-control custom-form-control', 'title'=>'Broker Name','div'=>false,'label'=>false,'value'=>$brokerDetail['User']['name'],'readonly'=>true));?>
								, a real estate broker acting as a mortgage broker, pursuant to the Federal Real Estate Settlement Procedures Act (RESPA) if applicable and similar California law. In a transaction subject to RESPA, a lender will provide you with an additional Good Faith Estimate within three business days of the receipt of your loan application. You will also be informed of material changes before settlement/close of escrow. The name of the intended lender to  whom your loan application will be delivered is:
								  <?php echo $this->Form->input('lender_type',array('type'=>'checkbox','value'=>'unknown', 'title'=>'Lender Type','div'=>false,'hiddenField'=>false,'label'=>false,'style'=>'margin-right:6px;'));?> Unknown
								  <?php echo $this->Form->input('lender_type',array('type'=>'checkbox','value'=>'known', 'title'=>'Lender Type','div'=>false,'hiddenField'=>false,'label'=>false,'style'=>'margin-right:6px;'));?> (Name of lender, if known)
								  <?php echo $this->Form->input('lender_name',array('class'=>'noValidate form-control custom-form-control', 'title'=>'Lender Name','div'=>false,'label'=>false));?>
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