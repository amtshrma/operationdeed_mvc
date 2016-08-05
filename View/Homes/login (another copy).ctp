<?php
	echo $this->Session->flash();
	echo $this->Form->create('User', array('class'=>'form-signin','novalidate'=>'novalidate'));
?>
    <h2 class="form-signin-heading-center">COMPANYLOGO</h2>
	<br /><br /><br />
	<div class="whitebox">
		EMAIL ADDRESS
		<br />
		<?php echo $this->Form->input('email_address',array('class'=>'form-control','label' => false,'div' => false, 'placeholder' => 'Email address','type' => 'email','maxlength' => 100,'tabindex'=>'1'));?>   
		<br />
		PASSWORD
		<br />
		<?php echo $this->Form->input('password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 100,'tabindex'=>'2'));?>
		<br />
		<?php echo $this->Form->input('user_type',array('label' => false,'div' => false, 'empty' => 'Select User Type','class' => 'form-control','options'=>$roleTypes,'tabindex'=>'3')); ?>
		<br/>
		<?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span> Sign in',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-lg btn-primary btn-block','value'=>'Log In','id'=>'login-submit','tabindex'=>'4','escape'=>false));?>
		<br />
		<div style="height: 2px; background-color: #D9E0E3; text-align: center">
			<span style="background-color: white; position: relative; top: -0.7em;">
				or
			</span>
		</div>
		<br />
		<?php
			echo $this->Html->link('&nbsp;&nbsp;&nbsp;&nbsp;Sign in with LinkedIn','javascript:void(0);',array('data-target' => '#userTypePopUp','data-toggle' => 'modal','escape' =>false,'class' => 'socialButton btn btn-lg btn-primary btn-block','id' =>'LinkedIn'));
			echo $this->Html->link('&nbsp;&nbsp;&nbsp;&nbsp;Sign in with Facebook','javascript:void(0);',array('data-target' => '#userTypePopUp','data-toggle' => 'modal','escape' =>false,'class' => 'socialButton btn btn-lg btn-facebook btn-block','id' =>'Facebook'));
			echo $this->Html->link('&nbsp;&nbsp;&nbsp;&nbsp;Sign in with Twitter','javascript:void(0);',array('data-target' => '#userTypePopUp','data-toggle' => 'modal','escape' =>false,'class' => 'socialButton btn btn-lg btn-primary btn-block','id' =>'Twitter'));
		?>
	</div>
	<br />
	<br />
	<div style="text-align:center">Don't have an account?  <?php echo $this->Html->link('<b>Register now</b>',array('controller'=>'homes','action'=>'register'),array('escape'=>false));?></div>
<?php echo $this->Form->end();?>
<!-- Modal -->
<div id="userTypePopUp" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="text-align: left;">Select User Type</h4>
			</div>
			<div class="modal-body">
				<?php
					echo $this->Form->hidden('provider',array('id'=>'selectedProvider'));
					echo $this->Form->input('role_type',array('label' => false,'div' => false, 'empty' => 'Select User Type','class' => 'form-control','options'=>$roleTypes,'id'=>'selectedSocialUser'));
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>