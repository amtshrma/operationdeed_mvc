<div class="page-content">
<div class="clearfix"></div>
<div class="content">
  <ul class="breadcrumb">
	<li>
	  <p>YOU ARE HERE</p>
	</li>
	<li><a href="#" class="active">Loan</a> </li>
  </ul>
  <div class="page-title"> <i class="icon-custom-left"></i>
	<h3><span class="semi-bold">Loan</span></h3>
  </div>
  <div class="show_message"></div>
  <div class="row-fluid">
	<div class="span12">
	  <div class="grid simple">
		<div class="grid-title">
			<?php echo $this->Element('admin/loan_search'); ?>
		</div>
		<div class="grid-body">
			<div class="row">
				<?php echo $this->Session->flash();?>
			</div>
			<br/>
			<div class="row">
				<?php echo $this->Element('admin/loans'); ?>
			</div>
		</div>
	  </div>
	</div>
  </div>
</div>
</div>