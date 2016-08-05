<?php echo $this->Html->script('admin/admin_user'); ?>
<div class="row padding_btm_20">
	<label class="brand_div">Users</label>
	<?php echo $this->Html->link('Add New User',array('controller'=>'users','action'=>'add'),array('class' => 'icon-file-alt','title' => 'Users'));?>
</div>
<?php 
$recordExits = false;          
if(isset($getData) && !empty($getData))
{
   $recordExits = true;            
} 
echo $this->Form->create('Search', array('url' => array('controller' => 'users', 'action' => 'index'),'id'=>'userssearch','type'=>'get'));    ?>
	<div class="row padding_btm_20">
			<div class="col-lg-4 col-lg-search">   
				<?php
				$keyword = '';
				if(!empty($this->params->query)&& ($this->params->query['first_name'] !='')) {
					$keyword = $this->params->query['first_name'];	
				}
				echo $this->Form->input('first_name',array('label' => false,'div' => false,'value'=>$keyword, 'placeholder' => 'Search By Name','class' => 'form-control search_control'));?>
					
			</div>
				<div class="col-lg-4 col-lg-search">   
				<?php
				$search_email = '';
				if(!empty($this->params->query)&& ($this->params->query['search_email'] !='')) {
					$search_email = $this->params->query['search_email'];	
				}
				echo $this->Form->input('search_email',array('label' => false,'div' => false,'value'=>$search_email, 'placeholder' => 'Search By Email','class' => 'form-control search_control'));?>
					
			</div>
			<div class="col-lg-4 col-lg-search">   
				<?php
				$selectedType = '';
				if(!empty($this->params->query)&& ($this->params->query['search_user_type'] !='')) {
					$selectedType = $this->params->query['search_user_type'];	
				}
				
				echo $this->Form->input('search_user_type',array('label' => false,'div' => false, 'options'=>$userTypes,'empty' => 'Search By User Type','class' => 'form-control search_control','selected' => $selectedType));?>
			</div>
			
			<div class="col-lg-4 col-lg-search">                        
				<?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
				<?php echo $this->Html->link('List All',array('controller'=>'users','action'=>'index'),array('class' => 'btn btn-default'));?>
			</div>
	</div>
    <?php echo $this->Form->end(); ?>  
<div class="row">
	<div class="col-lg-12">                        
		 <?php echo $this->Session->flash();?>   
	</div>            
</div>
<?php echo $this->Form->create('User', array('url' => array('controller' => 'items', 'action' => 'index'),'id'=>'showroomFormId'));  ?>
    <div class="row">
        <div class="col-lg-12">            
            <div class="table-responsive">         
                <?php if($recordExits){ ?>
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th class="th_checkbox"><input type="checkbox" class="checkall"></th>        
                            <th class="th_checkbox"><?php echo $this->Paginator->sort('status', 'Status'); ?> </th>
                            <th><?php echo $this->Paginator->sort('first_name', 'Name'); ?></th>
							<th><?php echo $this->Paginator->sort('email_address', 'Email Address'); ?></th>
							<th><?php echo $this->Paginator->sort('user_type', 'User Type'); ?></th>
							<th><?php echo $this->Paginator->sort('company_name', 'Company Name'); ?></th>
							<th><?php echo $this->Paginator->sort('company_position', 'Company Position'); ?></th>
							<th><?php echo $this->Paginator->sort('state', 'State'); ?></th>
							<th><?php echo $this->Paginator->sort('city', 'City'); ?></th>
							<th class="th_checkbox">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="dyntable">
                        <?php //pr($getData);
                        foreach($getData as $key => $getData){ 
                            $class = ($key%2 == 0) ? ' class="active"' : '';
                            $userTypeID = $getData['User']['user_type'];
							$stateID = $getData['UserDetail']['state'];
							?>
                        <tr <?php echo $class;?>>
                            <td align="center"><input type="checkbox" name="checkboxes[]" class ="checkboxlist" value="<?php echo base64_encode($getData['User']['id']);?>" ></td>
                             <?php  $status = $getData['User']['status'];
                                    $statusImg = ($getData['User']['status'] == 1) ? 'active' : 'inactive';
                                    echo $this->Form->hidden('status',array('value'=>$status,'id'=>'statusHidden_'.$getData['User']['id'])); ?>
                            <?php  $pid = $getData['User']['id'];?>
                            <td align="center"><?php echo $this->Html->link($this->Html->image("admin/".$statusImg.".png", array("alt" => ucfirst($statusImg),"title" => ucfirst($statusImg))),'javascript:void(0)',array('escape'=>false,'id'=>'link_status_'.$getData['User']['id'],'onclick'=>'setStatus('.$pid.')')) ; ?></td>
                            <td align="center"><?php echo ucfirst($getData['User']['first_name']). ' '.ucfirst($getData['User']['last_name']);?></td>
							<td align="center"><?php
								if(isset($getData['User']['email_address'])){
									echo $getData['User']['email_address'];
								} else {
									echo '--';
								}?>
							</td>
							<td align="center"><?php
								if(isset($getData['User']['user_type'])){
									echo $userTypes[$userTypeID];
								} else {
									echo '--';
								}?>
							</td>
							<td align="center"><?php
								if(isset($getData['UserDetail']['company_name'])){
									echo $getData['UserDetail']['company_name'];
								} else {
									echo '--';
								} ?>
							</td>      
                            <td align="center"><?php
								if(isset($getData['UserDetail']['company_position'])){
									echo $getData['UserDetail']['company_position'];
								} else {
									echo '--';
								} ?>
							</td>
							<td align="center"><?php
								if(isset($getData['UserDetail']['state'])){
									echo $states[$stateID];
								} else {
									echo '--';
								} ?>
							</td>
							<td align="center"><?php
								if(isset($getData['UserDetail']['city'])){
									echo $getData['UserDetail']['city'];
								} else {
									echo '--';
								} ?>
							</td>
                            <td align="center">
							<?php echo $this->Html->link($this->Html->image("admin/edit.png", array("alt" => "Edit","title" => "Edit")),array('controller'=>'users','action'=>'add',base64_encode($getData['User']['id'])),array('escape' =>false));
							echo $this->Html->link($this->Html->image("admin/delete.png", array("alt" => "Delete","title" => "Delete")),"/admin/users/delete/".base64_encode($getData['User']['id']),array('escape' =>false),"Are you sure to delete selected User?");
							?>
                            </td>                    
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="row">                                    
                     <div class="col-lg-12"> <?php
                        if($this->Paginator->param('pageCount') > 1)
                        {
                            echo $this->element('admin/pagination');                 
                        }
                        ?>
                     </div>
                 </div>
                <div class="row padding_btm_20 ">
                     <div class="col-lg-2"> LEGENDS:</div>
                     <div class="col-lg-2"><?php echo $this->Html->image("admin/delete.png"). " Delete &nbsp;"; ?></div>
                     <div class="col-lg-2"> <?php echo $this->Html->image("admin/edit.png"). " Edit"; ?> </div>
                     <div class="col-lg-2"> <?php echo $this->Html->image("admin/active.png"). " Active"; ?> </div>
                     <div class="col-lg-2"> <?php echo $this->Html->image("admin/inactive.png"). " Inactive"; ?> </div>
                     <div class="col-lg-2"> <?php echo $this->Html->image("admin/view.png"). " View"; ?> </div>
				</div>
			   <?php
                }else{ 
                    echo $this->element('admin/no_record_exists');
                } ?>
            </div>
        </div>         
    </div><!-- /.row -->
   <?php  echo $this->Form->end(); ?>