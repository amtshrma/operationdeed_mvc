<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Compose Message</h4>
</div>
<?php
echo $this->Html->css('bootstrap-wysihtml5/bootstrap-wysihtml5');
echo $this->Form->create('Message');?> 
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="grid simple" >
							
<div class="grid-body no-border" style="min-height: 550px;" >
<br>
 <div class="row-fluid " >
	<h2>New Message </h2>
	<div class="row">
	<div class="form-group col-md-4">
		<label class="form-label">To</label>
		<div class="controls">
			<?php
			$selectUser = array(); 
			foreach($allUsers as $user){ 
				$id = $user['User']['id'];
				if($id != '' && $id != 0) {
				  $name = $user['User']['name'];
				  $tempUsertype = $user['User']['user_type'];
				  if($tempUsertype != '' && $tempUsertype != 0) {
					if($tempUsertype == ADMIN_USER_TYPE) {
						$userType = 'Super Admin';
					}else {
						$userType = $userTypes[$tempUsertype];
					
					}
				  }
				  $selectUser[$id] = 	$name .' - '.$userType;
				}
			}
			echo $this->Form->input('receiver_id',array('label' => false,'div' => false, 'empty' => 'Name - User Type','class' => 'form-control','options'=>$selectUser, 'empty' => 'Select One'));?> 
		</div>
	</div>
	</div>
	<div class="row">
	<div class="form-group col-md-6">
		<label class="form-label">Subject</label>
		<div class="controls">
			<?php echo $this->Form->input('subject',array('label' => false,'div' => false, 'Subject' => 'City','class' => 'form-control','maxlength' =>100));?>    
		</div>
	</div>
	</div>	
	<div class="row">
		<div class="form-group col-md-12">
			<?php echo $this->Form->input('message',array('label' => false,'div' => false, 'placeholder' => 'Enter message ...','class' => 'form-control','id'=>'text-editor','maxlength' => 55,'rows'=>'15'));?>
		</div>							
	</div>							
	</div>							
 </div>							


</div>
        
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit('save',array('div'=>false,'class'=>'btn btn-primary')); ?>
</div>
 <?php echo $this->Form->end();  ?>
<!-- Modal End -->
<?php
   echo $this->Html->script('bootstrap-wysihtml5/wysihtml5-0.3.0');
   echo $this->Html->script('bootstrap-wysihtml5/bootstrap-wysihtml5');
?>
<script>
$(document).ready(function() {
    $('#text-editor').wysihtml5();	
  	
});		
</script> 