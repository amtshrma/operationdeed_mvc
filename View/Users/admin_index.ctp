<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Users</a> </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <h3><span class="semi-bold">Users</span></h3>
		<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New User</button>',array('controller'=>'users','action'=>'add'),array('escape' => false,'title' => 'Users'));?>
      </div>
	  
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">
			<div class="grid-title">
				<?php echo $this->Element('admin/users_search'); ?>
			</div>
            <div class="grid-body">
				<div class="row">
					<div class="col-lg-12 show_message">					
					<?php echo $this->Session->flash();?>   
					</div>         
				</div>				
				<br/>			
				<div class="row">
					<?php echo $this->Element('admin/loader'); ?>
					<section id="paginatedata">
						<?php echo $this->Element('admin/users'); ?>
					</section>
				</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
