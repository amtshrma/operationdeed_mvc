<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Loan Documents</a> </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <h3><span class="semi-bold">Loan Documents</span></h3>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">
            <div class="grid-body">
				<div class="row">
					<div class="col-lg-12">
					<div class="toolbar">
						<div class="table-tools-actions">
							<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New Document</button>',array('controller'=>'checklists','action'=>'add_loan_document'),array('escape' => false,'title' => 'Add New Document'));?>
						</div>
					</div>
					<?php echo $this->Session->flash();?>   
					</div>         
				</div>
			<br/>
            <?php 
			$recordExits = false;          
			if(isset($getData) && !empty($getData))
			{
			   $recordExits = true;            
			} 
			?>	
			<br/>
			<div class="row">
			<?php if($recordExits){ ?>
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th style="width:6%" ><?php echo $this->Paginator->sort('checklistname', 'Document Name'); ?></th>
					<th style="width:6%" ><?php echo $this->Paginator->sort('checklistname', 'Loan Type'); ?></th>
					<th style="width:5%" >Actions</th>
                  </tr>
                </thead>
                <tbody>
				<?php //pr($getData);
					foreach($getData as $key => $getData){ 
						$pid = $getData['LoanDocument']['id'];
                        $loanType = $getData['LoanDocument']['loan_type'];
						if($loanType == '0'){
							$type = 'All';
						}else {
							$type = $loanTypes[$loanType];
						}
					?>
                  <tr>
                    <td class="v-align-middle"><?php echo $getData['LoanDocument']['checklistname']; ?></td>
                    <td class="v-align-middle"><?php echo $type; ?></td>
					<td class="v-align-middle"><?php echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),array('controller'=>'checklists','action'=>'add_loan_document',base64_encode($getData['LoanDocument']['id'])),array('escape' =>false)); ?></td>
					
                  </tr>
                 <?php } ?>
                </tbody>
              </table>
				<div class="row">                                    
                     <div class="col-lg-12">
						<div class="dataTables_paginate paging_bootstrap pagination">
						<?php
						   if($this->Paginator->param('pageCount') > 1)
						   {
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
                }else{ 
                    echo $this->element('admin/no_record_exists');
                } ?>
			  </div>
            </div>
          </div>
        </div>
      </div>
      
      
    </div>
    
 
  </div>