<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h3>Change Password</h3><hr />
		<div class="row">	
		<?php echo $this->Session->flash();?>
        <?php echo $this->Form->create('User', array('url' => array('controller' => 'commons', 'action' => 'change_password'),'id'=>'passwordForm','novalidate' => true,'class'=>'form-no-horizontal-spacing')); ?>
			<center>
				<div style="width: 40%;">
					<?php echo $this->Form->input('User.current_password',array('label' => false,'div' => false, 'placeholder' => 'Current Password','class' => 'form-control','maxlength' => 55,'title'=>'Current Password','type'=>'password'));?>      
					<?php echo $this->Form->input('User.password',array('label' => false,'div' => false, 'placeholder' => 'New Password','class' => 'form-control','maxlength' => 55,'title'=>'New Password','type'=>'password'));?>      
					<?php echo $this->Form->input('User.cpassword',array('label' => false,'div' => false, 'placeholder' => 'Confirm Password','class' => 'form-control','maxlength' => 55,'title'=>'Confirm Password','type'=>'password'));?>      
					<?php echo $this->Form->button('<span class="glyphicon" style="color:#8ecaf9"></span>Update', array('type' => 'submit','class' =>'btn btn-lg btn-primary sumitButton','style'=>'float: right;')); ?>
				</div>
			</center>
		<?php echo $this->Form->end(); ?>
	</div>
    </div>
</div>
  <!-- END PAGE --> 
<?php echo $this->Element('fronts/loader');?>