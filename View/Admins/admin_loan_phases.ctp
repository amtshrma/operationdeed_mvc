<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
		<ul class="breadcrumb">
			<li>
				<p>YOU ARE HERE</p>
			</li>
			<li><a href="javascript:void(0);" class="active">Loan Phases</a> </li>
		</ul>
		<div class="page-title">
			<h3><span class="semi-bold">Loan Phases</span></h3>
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
								echo $this->Form->input('phase_name',array('label' => false,'div' => false,'value'=>(!empty($this->params->query['loan_reason'])) ? $this->params->query['loan_reason'] : '', 'placeholder' => 'Search By Loan Phases','class' => 'form-control search_control'));
							?>
							</div>
							<div class="col-lg-4 col-lg-search">
								<?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
								<?php echo $this->Html->link('List All',array('controller'=>'admins','action'=>'loanPhases'),array('class' => 'btn btn-default'));?>
							</div>
							<?php echo $this->Form->end(); ?>
						</div>
						<br/>
						<div class="row">
						<?php if(isset($getData) && !empty($getData)){?>
						<table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th><?php echo $this->Paginator->sort('phase_code', 'Phase Code'); ?></th>
									<th><?php echo $this->Paginator->sort('phase_name', 'Phase Name'); ?></th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach($getData as $key => $getData){?>
							<tr>
								<td class="v-align-middle"><?php echo ($key+1); ?></td>
								<td class="v-align-middle"><?php echo $getData['PhaseName']['phase_code']; ?></td>
								<td class="v-align-middle"><?php echo $getData['PhaseName']['phase_name']; ?></td>
								<td class="v-align-middle">
									<?php echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),array('controller'=>'admins','action'=>'add_loan_phase',base64_encode($getData['PhaseName']['id'])),array('escape' =>false));
									
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