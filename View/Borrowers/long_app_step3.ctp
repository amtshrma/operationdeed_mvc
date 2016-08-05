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
					<div class="progress" style="margin:10px">
						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 22%">
							<span class="sr-only">22% Complete (success)</span>
						</div>
					</div>
					<h3>Types Of Mortage And Terms Of Loan</h3>
					<center>
						<div class="form-group">
							<input type="text" id="inputPropertyAddress" class="form-control form-control-long" placeholder="Property Address" required autofocus>
							<input type="text" id="inputCity" class="form-control form-control-short" placeholder="City" required>
							<select name="inputState" class="form-control form-control-short placeholder" required>
								<option value="">State</option>
							</select>
							<input type="text" id="inputZip" class="form-control form-control-short" placeholder="Zip Code" required>
							<input type="text" id="inputLegalDescription" class="form-control form-control-longer" placeholder="Legal Description of Subject Property" required>
							<input type="text" id="inputNumUnits" class="form-control form-control-short" placeholder="No. of Units" required>
							<input type="text" id="inputYearBuilt" class="form-control form-control-short" placeholder="Year Built" required>
						</div>
						<div class="screen-padding"></div>
						<div style="clear:both"></div>
					</center>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
						<label>Purpose of Loan</label>
						<br>
						<label class="checkbox-inline"><input type="checkbox" value="">Purchase&nbsp;</label>
						<label class="checkbox-inline"><input type="checkbox" value="">Construction</label><br>
						<label class="checkbox-inline"><input type="checkbox" value="">Refinance</label>
						<label class="checkbox-inline"><input type="checkbox" value="">Other (explain):</label>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-top:25px;margin-right:40px;">
						<input type="text" id="inputOther" class="form-control form-control-medium" placeholder="Other" required>
					</div>
					<div class="form-group" style="float:left;text-align:left;padding-left:10px">
						<label>Property will be:</label>
						<div class="checkbox">
							<label><input type="checkbox" value="">Secondary Residence</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" value="">Investment</label>
						</div>
					</div>
					<center>
						<div style="clear:both"></div>
						<br>
						<table border="0" width="100%">
							<tr>
								<td align="left"><button class="btn btn-lg btn-cancel" type="submit"><span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel</button></td>
								<td align="right"><button class="btn btn-lg btn-primary" type="submit"><span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next</button></td>
							</tr>
						</table>
						<br>
					</center>
				</div>
				<!-- /.panel-body -->
			</div>
		</center>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->