<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
		<ul class="breadcrumb">
			<li>
				<p>YOU ARE HERE</p>
			</li>
			<li><a href="javascript:void(0);" class="active">Cities</a> </li>
		</ul>
		<div class="page-title">
			<h3><span class="semi-bold">Cities</span></h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="toolbar">
									<div class="table-tools-actions">
										<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New City</button>',array('controller'=>'admins','action'=>'add_city'),array('escape' => false,'title' => 'Video'));?>
									</div>
								</div>
							</div>         
						</div>
						<br/>	
						<div class="row form-row">
						<?php
							echo $this->Session->flash();
							$recordExits = false;          
							if(isset($getData) && !empty($getData)){
								$recordExits = true;            
							}
							echo $this->Form->create('Search', array('id'=>'templatesearch','type'=>'get'));
						?>
							<div class="col-lg-4 col-lg-search">   
							<?php
								$keyword = '';
								if(!empty($this->params->query)&& ($this->params->query['city'] !='')) {
									$keyword = $this->params->query['city'];	
								}
								echo $this->Form->input('city',array('label' => false,'div' => false,'value'=>$keyword, 'placeholder' => 'Search By Name','class' => 'form-control search_control'));?>		
							</div>
							<div class="col-lg-4 col-lg-search">                        
							<?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
							<?php echo $this->Html->link('List All',array('controller'=>'admins','action'=>'list_cities'),array('class' => 'btn btn-default'));?>
							</div>
							<?php echo $this->Form->end(); ?>
						</div>
						<br/>
						<div class="row">
						<?php if($recordExits){ ?>
						<table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('city', 'State Name'); ?></th>
									<th><?php echo $this->Paginator->sort('status', 'Status'); ?></th>
									<th><?php echo $this->Paginator->sort('state_code', 'State Code'); ?></th>
									<th><?php echo $this->Paginator->sort('order', 'Order'); ?></th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach($getData as $key => $getData){ ?>
							<tr>
								<td class="v-align-middle"><?php echo $getData['City']['city']; ?></td>
								<td class="v-align-middle">
								<?php
									if($getData['City']['status']){
										echo $this->html->link('<i class="fa fa-check fa-1x"></i>',array('controller'=>'admins','action'=>'changeStatus/City/'.$getData['City']['id'].'/0'),array('class'=>'green','escape'=>false));
									}else{
										echo $this->html->link('<i class="fa fa-times fa-1x"></i>',array('controller'=>'admins','action'=>'changeStatus/City/'.$getData['City']['id'].'/1'),array('class'=>'red','escape'=>false));
									}
								?>
								</td>
								<td class="v-align-middle"><?php echo $getData['City']['state_code']; ?></td>
								<td class="v-align-middle">
								<?php
									if($getData['City']['order']){
										echo $this->html->link('<i class="fa fa-check fa-1x"></i>',array('controller'=>'admins','action'=>'changeOrder/City/'.$getData['City']['id'].'/0'),array('class'=>'green','escape'=>false));
									}else{
										echo $this->html->link('<i class="fa fa-times fa-1x"></i>',array('controller'=>'admins','action'=>'changeOrder/City/'.$getData['City']['id'].'/1'),array('class'=>'red','escape'=>false));
									}
								?>
								</td>
								<td class="v-align-middle">
									<?php echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),array('controller'=>'admins','action'=>'add_city',base64_encode($getData['City']['id'])),array('escape' =>false));
									echo '  ';
									echo $this->html->link('<i class="fa fa-times fa-1x"></i>',array('controller'=>'admins','action'=>'changeDelete/City/'.$getData['City']['id']),array('class'=>'confirmAction','escape'=>false,'title'=>'Delete'));
									?>
								</td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
						<div class="row">                                    
								<div class="col-lg-12">
								<div class="dataTables_paginate paging_bootstrap pagination">
								<?php
									if($this->Paginator->param('pageCount') > 1){
										echo $this->element('admin/pagination');                 
									}
								?>
								</div>
							</div>
						</div>
						<div class="row form-row">
							<div class="col-lg-2"> LEGENDS:</div>
							<div class="col-lg-2">
							   <?php echo $this->Html->image("admin/edit.png"). " Edit"; ?>
							   
							</div>
							<div class="col-lg-2">
							   <i class="fa fa-times fa-1x"></i> Inactive
							</div>
							<div class="col-lg-2">
							   <i class="fa fa-check fa-1x"></i> Active
							</div>
							
						</div>
						<?php
						}else{ 
							echo $this->element('admin/no_record_exists');
						}
						?>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
</div>