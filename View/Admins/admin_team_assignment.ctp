<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Team Assignment</a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3><span class="semi-bold">Team Assignment</span></h3>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">
            <div class="grid-body">
				<div class="row" align="right">
					<div class="col-lg-12">
						<div class="toolbar">
							<div class="table-tools-actions">
								<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New Funder</button>',array('controller'=>'users','action'=>'add'),array('escape' => false,'title' => 'Add New Funder'));?>
							</div>
						</div>
						<?php echo $this->Session->flash();?>   
					</div>         
				</div>
			<br/>	
			<div class="row form-row">
			<?php
			$recordExits = false;          
			if(isset($funders) && !empty($funders)) {
				
				$recordExits = true;            
			} 
			echo $this->Form->create('Search', array('url' => array('controller' => 'admins', 'action' => 'team_assignment'),'id'=>'teamsearch','type'=>'get')); ?>
				<div class="col-lg-9 col-lg-search">
					<?php
					$keyword = '';
					if(!empty($this->params->query)&& ($this->params->query['name'] !='')) {
						$keyword = $this->params->query['name'];	
					}
					echo $this->Form->input('name',array('label' => false,'div' => false,'value'=>$keyword, 'placeholder' => 'Search By Funder Name, Email and Phone','class' => 'form-control search_control'));?>		
				</div>
				<div class="col-lg-3 col-lg-search">                        
					<?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
					<?php echo $this->Html->link('List All',array('controller'=>'admins','action'=>'team_assignment'),array('class' => 'btn btn-default'));?>
				</div>
			<?php echo $this->Form->end(); ?>
			</div>
			<br/>
			<div class="row">
			<?php if($funders) { ?>
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th style="width:16%" >Funder Name<?php //echo $this->Paginator->sort('name', 'Template Name'); ?></th>
                    <th>Email</th>
					<th>Company Name</th>
					<th>Office Phone</th>
					<th>Mobile Phone</th>
					<th>Fax Number</th>
					<th style="width:5%" >Actions</th>
                  </tr>
                </thead>
                <tbody>
				<?php
				if(!empty($funders)) {
					
					foreach($funders as $key => $getData) {
					  ?>
					  <tr>
						<td class="v-align-middle"><?php echo $getData['User']['first_name'].' '.$getData['User']['last_name']; ?></td>
						<td class="v-align-middle"><?php echo $getData['User']['email_address']; ?></td>
						<td class="v-align-middle"><?php echo $getData['UserDetail']['company_name']; ?></td>
						<td class="v-align-middle"><?php echo $getData['UserDetail']['office_phone']; ?></td>
						<td class="v-align-middle"><?php echo $getData['UserDetail']['mobile_phone']; ?></td>
						<td class="v-align-middle"><?php echo $getData['UserDetail']['fax_number']; ?></td>
						<td class="v-align-middle">
							<?php
							echo $this->Html->link('<i class="fa fa-plus"></i>', array('controller'=>'admins','action'=>'manage_team', base64_encode(base64_encode($getData['User']['id']))), array('title'=>'Create New Team', 'escape' =>false));							
							echo '&nbsp;&nbsp;';
							echo $this->Html->link('<i class="fa fa-group"></i>',array('controller'=>'admins','action'=>'team_listing', base64_encode(base64_encode($getData['User']['id']))), array('title'=>'View and Edit Teams', 'escape' =>false)); ?>
						</td>
					  </tr>
					<?php
					}
				}
				?>
                </tbodWe need an HTML code snipet they can input into their website, and an API that their webmaster/programmer can integrate their existing systems/website into.y>
              </table>
				<div class="row">                                    
                     <div class="col-lg-12">
						<div class="dataTables_paginate paging_bootstrap pagination">
						<?php
						if($this->Paginator->param('pageCount') > 1) {
							
							echo $this->element('admin/pagination');                 
						}
						?>
						</div>
					</div>
                 </div>
                <div class="row form-row">
                     <div class="col-lg-2"> LEGENDS:</div>
                     <div class="col-lg-2"> <?php echo $this->Html->image("admin/edit.png"). " Edit"; ?> </div>
				</div>
				<?php
                } else {
					
                    echo $this->element('admin/no_record_exists');
                } ?>
			  </div>
            </div>
          </div>
        </div>
      </div>
	</div>
  </div>