<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Manage Documents</a> </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <h3><span class="semi-bold">Manage Documents</span></h3>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">
            <div class="grid-body">
				<div class="row">
					<div class="col-lg-12">
					<div class="toolbar">
						<div class="table-tools-actions">
							<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New Document</button>',array('controller'=>'documents','action'=>'add'),array('escape' => false,'title' => 'Add New Document'));?>
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
					<th style="width:6%" ><?php echo $this->Paginator->sort('document_type', 'Document Type'); ?></th>
					<th style="width:6%" ><?php echo $this->Paginator->sort('name', 'Document Name'); ?></th>
					<th style="width:6%" ><?php echo $this->Paginator->sort('user_type', 'User Type'); ?></th>
					<th style="width:5%" >Actions</th>
                  </tr>
                </thead>
                <tbody>
				<?php
				$designationTypes = array("2" =>"Broker/Loan Officer", "3"=>"Sales Manager","4"=>"Sales Director","5" => "Processor","6" =>"Funder","7"=>"Investor","8"=>"Investment Manager","9"=>"Marketing Manager");
				//pr($getData);
				
					foreach($getData as $key => $getData){ 
						$pid = $getData['Document']['id'];
                        $documentType = $getData['Document']['document_type'];
                        $type = !empty($documentTypes[$documentType]) ? $documentTypes[$documentType] : '';
						$userTypes = explode(',',$getData['Document']['user_type']);
						$designation = '';
						foreach($userTypes as $key => $userType) {
							
							$designation[$key] = !empty($designationTypes[$userType]) ? $designationTypes[$userType] : ''; 
						}
						$designationType = implode(', ',$designation);
						
					?>
                  <tr>
					<td class="v-align-middle"><?php echo $type; ?></td>
					<td class="v-align-middle"><?php echo $getData['Document']['name']; ?></td>
					<td class="v-align-middle"><?php echo $designationType; ?></td>
					<td class="v-align-middle"><?php echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),array('controller'=>'documents','action'=>'add',base64_encode($getData['Document']['id'])),array('escape' =>false)); ?></td>
					
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