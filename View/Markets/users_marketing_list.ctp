<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3>Market List</h3><hr />
		<p><?php echo $this->Session->flash();?></p>
        <?php echo $this->Form->create('UserList', array('id'=>'UserList', 'novalidate'=>'novalidate'));?>
            <div class="col-md-12">
                <div class="col-md-4">
                    <?php echo $this->Form->input('UserList.User.user_type',array('options'=>$userTypes,'label' => false, 'div' => false, 'empty'=>'Select User Type', 'class' => 'form-control','id'=>'NewsletterTemplate'));?>
                </div>
				<div class="col-md-6">
					<?php
						echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-success btn-cons'));
						echo '&nbsp;';
						echo $this->Html->link('Reset',array('controller'=>'markets','action'=>'usersMarketingList/'.base64_encode('1')),array('escape'=>false,'class' => 'btn btn-default btn-cons'));
					?>
				</div>
				<div class="col-md-2">
					<?php
						echo $this->Html->link('Export As Excel', array('controller' => 'markets','action'=>'createExcelUserList'),array('class' => 'btn btn-success btn-cons'));
					?>
				</div>
            </div><br /><br /><br />
        <?php echo $this->Form->end(); ?>
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-hover" id="Market List">
				<thead>
					<tr>
						<th style="width:8%">Sr. No.</th>
						<th style="width:8%">Name</th>
						<th style="width:8%">Email</th>
						<th style="width:8%">Phone</th>
						<th style="width:8%">Avatar</th>
						<th style="width:8%" data-hide="phone,tablet">User Type</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(count($userData)){
						foreach($userData as $key=>$val){?>
							<tr>
								<td><?php echo ($key+1);?></td>
								<td><?php echo $val['User']['first_name'].' '.$val['User']['last_name'];?></td>
								<td><?php echo $val['User']['email_address'];?></td>
								<td><?php echo $val['UserDetail']['mobile_phone'];?></td>
								<td>
									<?php
										$path = BASE_URL.'img/profile_pics/original/';
										$img = (!empty($val['UserDetail']['profile_picture'])) ? $path.$val['UserDetail']['profile_picture'] : BASE_URL.'img/index.png';
										echo $this->Html->image($img,array('style'=>'height : 50px; border-radius : 50%;'));
									?>
								</td>
								<td><?php echo $userTypes[$val['User']['user_type']];?></td>
							</tr>
						<?php }
					}
					?>
				</tbody>
			</table>
			<?php echo $this->Element('/admin/pagination');?>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    jQuery(".date").datepicker({
			dateFormat : 'mm/dd/yy'
	});
});
</script>