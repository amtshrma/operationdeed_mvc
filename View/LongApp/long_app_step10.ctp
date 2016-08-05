<!-- Page Content -->
<?php
	echo $this->Html->css('signature_pad/signature-pad.css');
?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div">
		<h2><center>Acknowledgement And Agreement</center></h2>
		<div class="with-nav-tabs panel-default">
			<div class="panel-heading2">
				<?php echo $this->Element('longApp/longApp_steps');?>
			</div>
			<div class="panel-body">
				<div class="tab-content in-content">
					<div class="tab-pane fade in active" id="tab1default">
						<div class="col-sm-12">
							<div class="progress"><!-- Progress bar-->
								<div style="width:90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped"> <span class="sr-only">90% Complete (success)</span> </div>
							</div>
							<!-- /Progress bar-->
							<?php echo $this->Form->create('LongAppBorrowerAcknowledgement',array('novalidate'=>'novalidate','class' => 'form-horizontal step9-frm'));?>
								<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
								<div class="form-group">
									<p>
										Each of the undersigned specifically represents to Lender and to Lender?s actual or potential agents, brokers, processors, attorneys, insurers, servicers, successors and assigns and agrees and acknowledges that: (1) the information provided in this application is true and correct as of the date set forth opposite my signature and that any intentional or negligent misrepresentation of this information contained in this application may result in civil liability, including monetary damages, to any person who may suffer any loss due to reliance upon any misrepresentation that I have made on this application, and/or in criminal penalties including, but not limited to, fine or imprisonment or both under the provisions of Title 18, United States Code, Sec. 1001, et seq.; (2) the loan requested pursuant to this application (the ?Loan?)will be secured by a mortgage or deed of trust on the property described in this application; (3) the property will not be used for any illegal or prohibited purpose or use; (4) all statements made in this application are made for the purpose of obtaining a residential mortgage loan; (5) the property will be occupied as indicated in this application; (6) the Lender, its services, successors or assigns may retain the original and/or an electronic record of this application, whether or not the Loan is approved; (7) the Lender and its agents, brokers, insurers, servicers, successors, and assigns may continuously rely on the information contained in the application, and I am obligated to amend and/or supplement the information provided in this application if any of the material facts that I have represented herein should change prior to closing of the Loan; (8) in the event that my payments on the Loan become delinquent, the Lender, its servicers, successors or assigns may, in addition to any other rights and remedies that it may have relating to such delinquency, report my name and account information to one or more consumer reporting agencies; (9) ownership of the Loan and/or administration of the Loan account may be transferred with such notice as may be required by law; (10) neither Lender nor its agents, brokers, insurers, servicers, successors or assigns has made any representation or warranty, express or implied, to me  regarding the property or the condition or value of the property; and (11) my transmission of this application as an ?electronic record? containing my ?electronic signature,? as those terms are defined in applicable federal and/or state laws (excluding audio and video recordings), or my facsimile transmission of this application containing a facsimile of my signature, shall be as effective, enforceable and valid as if a paper version of this application were delivered containing my original written signature.
									</p>
									<p class="mar-tb">
										Acknowledgement. Each of the undersigned hereby acknowledges that any owner of the Loan, its servicers, successors and assigns, may verify or reverify any information contained in this application or obtain any information or data relating to the Loan, for any legitimate business purpose through any source, including a source named in this application or a consumer reporting agency.
									</p>
								</div>
								<div class="form-group">
									<div class="col-sm-8">
										<div id="smoothed_borrower" style="width: 100%;height: 200px;">
											<div class="m-signature-pad--body">
												<canvas style="width: 100%; height: 160px;" id="first"></canvas>
											</div>
											<input id="borrowerSignature" type="hidden" name="data[LongAppBorroweraAcknowledgement][borrower_signature]" class="output">
											<div class="signaturepad-footer">
												<button type="button" class="btn btn-default clear" data-action="clear">Clear</button>
												<button type="button" class="btn btn-primary save" data-action="save">Confirm</button>
											</div>
										</div>
									</div>
									<div class="col-sm-4 top60">
										<?php echo $this->Form->input('borrower_sign_date',array('label'=>false,'div'=>false,'placeholder'=>'Date','class'=>'form-control datepicker','title'=>'Date'));?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-8">
										<div id="smoothed_co_borrower" style="width: 100%;height: 200px;">
											<div class="m-signature-pad--body">
												<canvas style="width: 100%; height: 160px;" id="second"></canvas>
											</div>
											<input id="coBorrowerSignature" type="hidden" name="data[LongAppBorroweraAcknowledgement][co_borrower_signature]" class="output">
											<div class="signaturepad-footer">
												<button type="button" class="btn btn-default clear" data-action="clear">Clear</button>
												<button type="button" class="btn btn-primary save" data-action="save">Confirm</button>
											</div>
										</div>
									</div>
									<div class="col-sm-4 top60">
										<?php echo $this->Form->input('co_borrower_sign_date',array('label'=>false,'div'=>false,'placeholder'=>'Date','class'=>'form-control datepicker noValidate','title'=>'Date'));?>
									</div>
									<div class="col-sm-12 btn-top">
									<?php echo $this->Form->button('Submit',array('disabled'=>true,'type'=>'submit','class'=>'btn blue sumitButton','escape'=>false));?>
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
<style>
	p.error{
		text-align: center;
		color: #f00;
	}
</style>
<?php
echo $this->Html->script(array('signature_pad/signature_pad.js','signature_pad/borrower_signature.js'));
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
jQuery(document).ready(function() {
	// datepicker
	jQuery('document').ready(function(){
		jQuery('.datepicker').datepicker({
				changeMonth: true,
				changeYear : true
		});
	});
});
</script> 