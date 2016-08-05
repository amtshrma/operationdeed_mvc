<center><h2 class="form-signin-heading-center"><?php echo $this->html->link($this->Html->image('logo.png'),array('controller'=>'homes','action'=>'registrationStartup'),array('escape'=>false)); ?></h2></center>
<?php echo $this->Form->create('User', array('class'=>'form-signin','novalidate'=>'novalidate','id'=>'forgotPasswordForm')); ?>
	<div class="whitebox">
		<?php echo $this->Session->flash(); ?>
		<h3>Forgot Password</h3>
		
		EMAIL ADDRESS
		<br />
		<?php echo $this->Form->input('email_address',array('class'=>'form-control','label' => false,'div' => false, 'placeholder' => 'Email address','type' => 'email','maxlength' => 100,'tabindex'=>'1'));?>   
		<br />
		<?php
		$roleTypes['1'] = 'Borrower';
		$roleTypes['7'] = 'Investor';
		echo $this->Form->input('user_type',array('label' => false,'div' => false, 'empty' => 'Select User Type','class' => 'form-control','options'=>$roleTypes,'tabindex'=>'3'));
		?>
		<br/>
		<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span> Submit',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-lg btn-primary btn-block','value'=>'Submit','id'=>'login-submit','tabindex'=>'4','escape'=>false));?>
		<br />
		<div style="text-align:center"><?php echo $this->Html->link('<b>Login Now</b>',array('controller'=>'homes','action'=>$redirectLink),array('escape'=>false));?></div>
	</div>
	
<?php echo $this->Form->end();?>
