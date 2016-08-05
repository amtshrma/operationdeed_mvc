<?php
	
	echo $this->Form->create('User', array('class'=>'form-signin','novalidate'=>'novalidate'));
?>
    <center><h2 class="form-signin-heading-center"><?php echo $this->html->link($this->Html->image('logo.png'),array('controller'=>'homes','action'=>'registrationStartup'),array('escape'=>false)); ?></h2>
	<h3 class="form-signin-heading-center">Borrower Sign In</h3></center>
	</center>
	<br />
	<div class="whitebox">
		<?php echo $this->Session->flash(); ?>
		EMAIL ADDRESS
		<br />
		<?php echo $this->Form->input('email_address',array('class'=>'form-control','label' => false,'div' => false, 'placeholder' => 'Email address','type' => 'email','maxlength' => 100,'tabindex'=>'1'));?>   
		<br />
		PASSWORD
		<br />
		<?php echo $this->Form->input('password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 100,'tabindex'=>'2'));?>
		<br />
		<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span> Sign in',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-lg btn-primary btn-block','value'=>'Log In','id'=>'login-submit','tabindex'=>'4','escape'=>false));?>
		<br />
	</div>
	<br />
	<br />
	<div style="text-align:center">Don't have an account?  <?php echo $this->Html->link('<b>Register now</b>',array('controller'=>'homes','action'=>'register/MQ=='),array('escape'=>false));?></div>
	<div style="text-align:center"><?php echo $this->Html->link('<b>Forgot Password</b>',array('controller'=>'homes','action'=>'forgot_password/'.base64_encode('borrowerLogin')),array('escape'=>false));?></div>
	<!--div style="text-align:center">Don't have an account?  <?php //echo $this->Html->link('<b>Register now</b>',array('controller'=>'','action'=>''),array('escape'=>false));?></div-->
<?php echo $this->Form->end();?>