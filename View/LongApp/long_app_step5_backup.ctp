<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
		<h2><center>Assets And Liabilities</center></h2>
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
							<center>
								<h2>Monthly Income And Combined Housing Expense Information</h2>
							</center>
							<div class="row">
								<div class="col-sm-12">
									<p>* Self Employed Borrower(s) may be required to provide additional documentation such as tax returns and financial statements</p>
								</div>
								<?php echo $this->Form->create('LongAppBorrowerIncome',array('novalidate'=>'novalidate','class' => 'form-inline step6-frm'));?>
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
												<td>
													<?php echo $this->Form->input('borrower_base_empl_income',array('label'=>false,'div'=>false,'placeholder'=>'Base Empl Income','class'=>'form-control'));?>
												</td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
											</tr>
											<tr>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="Base Empl. Income"></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
											</tr>
											<tr class="ttl-scr">
												<td>Total</td>
												<td>$0.00</td>
												<td>$0.00</td>
												<td>$0.00</td>
											</tr>
										</table>
									</div>
									<div class="col-sm-12">
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Other income (before selecting and completing, see the notice below.)
											</label>
										</div>
										<p class="mar-tb">Notice: Alimony, child support, or separate maintenance income need not be revealed if the Borrower (B) or Co-Borrower (C) does not choose to have it considered for repaying this loan.</p>
									</div>
									<div class="col-sm-12">
										<table class="table">
											<tr>
												<th colspan="2">Describe Other Income</th>
												<th>Monthly Amount</th>
											</tr>
											<tr>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="B/C"></td>
												<td><input type="text" class="form-control" id="inputEmail3" ></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
											</tr>
											<tr>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="B/C"></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder=""></td>
												<td><input type="text" class="form-control" id="inputEmail3" placeholder="$0.00"></td>
											</tr>
										</table>
									</div>
									<div class="col-sm-12 btn-top">
										<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right"></span>Next',array('type'=>'submit','class'=>'btn blue','escape'=>false));?>
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