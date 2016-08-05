<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Company Templates</a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3><span class="semi-bold">Company Templates</span></h3>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">
            <div class="grid-body">
				<div class="row">
					<div class="col-lg-12">
					<div class="toolbar">
						<div class="table-tools-actions">
							<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New Company Template</button>',array('controller'=>'admins','action'=>'add_template'),array('escape' => false,'title' => 'Users'));?>
						</div>
					</div>
					<?php echo $this->Session->flash();?>   
					</div>         
				</div>
			<br/>
			<div class="row">
			<?php
            $recordExits = false;          
			if(isset($getData) && !empty($getData)) {
				
				$recordExits = true;            
			} 
            if($recordExits){ ?>
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th style="width:6%"><?php echo $this->Paginator->sort('company_id', 'Company'); ?></th>
					<th style="width:3%">Name</th>
					<th style="width:5%">Edit</th>
                  </tr>
                </thead>
                <tbody>
				<?php //pr($getData);
					$i=1;
					foreach($getData as $key => $getData) { 
						$class = ($key%2 == 0) ? ' class="active"' : '';
						$pid = $getData['CompanyTemplate']['id'];
						?>
				
                  <tr>
                   <td>
						<?php
						$tempCompany = $getData['CompanyTemplate']['company_id'];
						if(isset($companies[$tempCompany])){
							echo $companies[$tempCompany];
						} else {
							echo '--';
						}?>
					</td>
					<td>
						<?php
						if(isset($getData['CompanyTemplate']['name'])){
							echo $getData['CompanyTemplate']['name'];
						} else {
							echo '--';
						}?>
					</td>
					
					<td class="v-align-middle">
						<?php
						
						echo $this->Html->link('<i class="fa fa-edit"></i>', array('controller'=>'admins','action'=>'add_template',base64_encode($getData['CompanyTemplate']['id'])),array('escape' =>false, 'title'=>'Edit', 'alt'=>'Edit'));
						echo '&nbsp;&nbsp;';
						?>						
					</td>
                  </tr>
                 <?php $i++;} ?>
                </tbody>
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
                     <div class="col-lg-2"><?php echo '<i class="fa fa-eye"></i> View &nbsp;'; ?></div>
					 <div class="col-lg-2"><?php echo '<i class="fa fa-edit"></i> Edit &nbsp;'; ?></div>
					 <div class="col-lg-2"><?php echo '<i class="fa fa-trash-o"></i> Delete &nbsp;'; ?></div>
                     <div class="col-lg-2"><?php echo '<i class="fa fa-thumbs-up green"></i> Active &nbsp;'; ?></div>
					 <div class="col-lg-2"><?php echo '<i class="fa fa-thumbs-down red"></i> Inactive &nbsp;'; ?></div>
                     <div class="col-lg-2"> <?php //echo $this->Html->image("admin/active.png"). " Active"; ?> </div>
                     <div class="col-lg-2"> <?php //echo $this->Html->image("admin/inactive.png"). " Inactive"; ?> </div>                     
				</div>
				<?php
                }else { 
                    echo $this->element('admin/no_record_exists');
                } ?>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>