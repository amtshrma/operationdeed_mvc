<center><h2 class="form-signin-heading-center"><?php echo $this->html->link($this->Html->image('logo.png'),array('controller'=>'homes','action'=>'registrationStartup'),array('escape'=>false)); ?></h2>
	<h3 class="form-signin-heading-center">Escrow Sign In</h3></center>
<?php
	echo $this->Form->create('User', array('class'=>'form-signin','novalidate'=>'novalidate','id'=>'loginForm'));
    echo $this->Form->hidden('User.user_type',array('value'=>11));
?>
    
	<div class="whitebox">
		<?php echo $this->Session->flash();?>
		<br />
		EMAIL ADDRESS
		<br />
		<?php echo $this->Form->input('email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','type' => 'text','maxlength' => 100));?>   
		<br />
		PASSWORD
		<br />
		<?php echo $this->Form->input('password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 100));?>
		<br />
		<br/>
		<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span> Sign in',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-lg btn-primary btn-block','value'=>'Log In','id'=>'login-submit','tabindex'=>'4','escape'=>false));?>
		<br />
		<div style="height: 2px; background-color: #D9E0E3; text-align: center">
			<span style="background-color: white; position: relative; top: -0.7em;">
				or
			</span>
		</div>
	</div>	
	<br />
	<br />
	<div style="text-align:center">Don't have an account?  <?php echo $this->Html->link('Escrow Register', array('controller'=>'escrows', 'action'=>'register'));?></div>
	
<?php echo $this->Form->end();?>