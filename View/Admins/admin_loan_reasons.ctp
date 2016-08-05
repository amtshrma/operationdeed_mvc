<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
		<ul class="breadcrumb">
			<li>
				<p>YOU ARE HERE</p>
			</li>
			<li><a href="javascript:void(0);" class="active">Loan Reasons</a> </li>
		</ul>
		<div class="page-title">
			<h3><span class="semi-bold">Loan Reasons</span></h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="toolbar">
									<div class="table-tools-actions">
										<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New Loan Reason</button>',array('controller'=>'admins','action'=>'add_loan_reason'),array('escape' => false,'title' => 'Video'));?>
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
								if(!empty($this->params->query)&& ($this->params->query['loan_reason'] !='')) {
									$keyword = $this->params->query['loan_reason'];	
								}
								echo $this->Form->input('loan_reason',array('label' => false,'div' => false,'value'=>$keyword, 'placeholder' => 'Search By Loan Reason','class' => 'form-control search_control'));?>		
							</div>
							<div class="col-lg-4 col-lg-search">                        
							<?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
							<?php echo $this->Html->link('List All',array('controller'=>'admins','action'=>'loan_reasons'),array('class' => 'btn btn-default'));?>
							</div>
							<?php echo $this->Form->end(); ?>
						</div>
						<br/>
						<div class="row">
						<?php if($recordExits){ ?>
						<table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('loan_reason', 'Loan Reason'); ?></th>
									<th><?php echo $this->Paginator->sort('loan_value_max', 'LTV Max'); ?></th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach($getData as $key => $getData){ ?>
							<tr>
								<td class="v-align-middle"><?php echo $getData['LoanReason']['loan_reason']; ?></td>
								<td class="v-align-middle"><?php echo $getData['LoanReason']['loan_value_max']; ?>%</td>
								<td class="v-align-middle">
									<?php echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),array('controller'=>'admins','action'=>'add_loan_reason',base64_encode($getData['LoanReason']['id'])),array('escape' =>false));
									
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