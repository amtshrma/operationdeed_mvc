<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
		<ul class="breadcrumb">
			<li>
				<p>YOU ARE HERE</p>
			</li>
			<li><a href="javascript:void(0);" class="active">Manage Video</a> </li>
		</ul>
		<div class="page-title">
			<h3><span class="semi-bold">Manage Video</span></h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-body">
						<div class="row form-row">
						<?php
							echo $this->Session->flash();
							echo $this->Form->create('Search', array('id'=>'templatesearch','type'=>'get'));
						?>
							<div class="col-lg-4 col-lg-search">   
							<?php
								echo $this->Form->input('video_name',array('label' => false,'div' => false,'value'=>(!empty($this->params->query['video_name'])) ? $this->params->query['video_name'] : '', 'placeholder' => 'Search By Video Name','class' => 'form-control search_control'));
							?>
							</div>
							<div class="col-lg-4 col-lg-search">
								<?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
								<?php echo $this->Html->link('List All',array('controller'=>'admins','action'=>'manageVideo'),array('class' => 'btn btn-default'));?>
							</div>
							<?php echo $this->Form->end(); ?>
							<div class="col-lg-2 col-lg-offset-2 col-lg-search">
								<?php echo $this->Html->link('Add Video Tutorial',array('controller'=>'admins','action'=>'admin_add_video_tutorial'),array('class' => 'btn btn-primary'));?>
							</div>
						</div>
						<br/>
						<div class="row">
						<?php if(isset($getData) && !empty($getData)){?>
						<table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Video Name</th>
									<th>Video URL</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach($getData as $key => $getData){?>
							<tr>
								<td class="v-align-middle"><?php echo ($key+1); ?></td>
								<td class="v-align-middle"><?php echo $getData['VideoTutorial']['title']; ?></td>
								<td class="v-align-middle"><?php echo $getData['VideoTutorial']['video_url']; ?></td>
								<td class="v-align-middle">
								<?php
									if($getData['VideoTutorial']['status']){
										echo $this->html->link('<i class="fa fa-check fa-1x"></i>',array('controller'=>'admins','action'=>'changeStatus/VideoTutorial/'.$getData['VideoTutorial']['id'].'/0'),array('class'=>'greenText','escape'=>false));
									}else{
										echo $this->html->link('<i class="fa fa-times fa-1x"></i>',array('controller'=>'admins','action'=>'changeStatus/VideoTutorial/'.$getData['VideoTutorial']['id'].'/1'),array('class'=>'redText','escape'=>false));
									}
								?>
								</td>
								<td class="v-align-middle">
									<?php
									echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),array('controller'=>'admins','action'=>'add_video_tutorial',base64_encode($getData['VideoTutorial']['id'])),array('escape' =>false));
									echo '  ';
									echo $this->html->link('<i class="fa fa-times fa-1x"></i>',array('controller'=>'admins','action'=>'changeDelete/VideoTutorial/'.$getData['VideoTutorial']['id']),array('class'=>'confirmAction','escape'=>false,'title'=>'Delete'));
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