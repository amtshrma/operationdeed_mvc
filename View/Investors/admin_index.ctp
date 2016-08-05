<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Investors</a> </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <div class="col-sm-8">
			<h3><span class="semi-bold">Investors</span></h3>
		</div>
		<div class="col-sm-3" align="right">
			<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New Investor</button>',array('controller'=>'investors','action'=>'add'),array('escape' => false,'title' => 'Users'));?>
		</div>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">
			<div class="grid-title">
				<?php echo $this->Element('admin/investor_search'); ?>
			</div>
            <div class="grid-body">
				<div class="row">
					<?php echo $this->Session->flash();?>   
				</div>
				<br/>
				<div class="row">
					<?php echo $this->Element('admin/investor_listing'); ?>			
				</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>