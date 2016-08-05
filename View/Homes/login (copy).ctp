<div class="section first">
<div class=" p-b-60">
<div class="section dark-grey p-t-20  p-b-20 m-b-50">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Sign In</h2>
      </div>
      
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="container">
  <div class="row login-container column-seperation">  
        <div class="col-md-5 col-md-offset-1">
          <h2>Sign in to Rockland</h2>
          <p>Use Facebook, Twitter or your email to sign in.<br>
            <?php echo $this->Html->link('Sign up Now!', array('controller'=>'homes', 'action'=>'register')) ;?>
            
            for a Rockland account,It's free and always will be..</p>
          <br>
			<div class="row">
				<?php echo $this->Html->link('<span class="pull-left"><i class="icon-facebook"></i></span>
					<span class="bold">Login with Facebook</span>','#',array('escape' =>false,'class' => 'socialButton btn btn-block btn-info col-md-8','style'=>'color:#FFFFFF;','id' =>'Facebook'));
				?>
			   
			   
					<?php echo $this->Html->link('<span class="pull-left"><i class="icon-twitter"></i></span>
					 <span class="bold">Login with Twitter</span>','#',array('escape' =>false,'class' => 'socialButton btn btn-block btn-success col-md-8','id' =>'Twitter','style'=>'color:#FFFFFF;')); ?>
		
				
				   <?php echo $this->Html->link('<span class="pull-left"><i class="icon-linkedin"></i></span>
					<span class="bold">Login with Linked In</span>','#',array('escape' =>false,'class' => 'socialButton btn btn-block btn-success col-md-8','id' =>'LinkedIn','style'=>'color:#FFFFFF;')); ?>
			</div>
			<div  class="row">
				<h3>Sign-up for our mailing list of</h3><?php
				$mailingList = array('1'=>'New lending programs','2'=>'Recently closed transactions','3'=>'Quarterly Company updates');
				echo $this->Form->input('subcription_type',array('label' => false,'div' => false,'class' => 'form-control','options'=>$mailingList));?>
            </div> 
        </div>
        <div class="col-md-5 "> <br>
        <?php echo $this->Session->flash();?>
		  <?php echo $this->Form->create('User', array('url' => array('controller' => 'homes', 'action' => 'login'),'id'=>'loginForm')); ?>
		 <div class="row">
		 <div class="form-group col-md-10">
            <label class="form-label">Email</label>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<i class=""></i>
					<?php echo $this->Form->input('email_address',array('label' => false,'div' => false, 'placeholder' => 'Email','class' => 'form-control','type' => 'text','maxlength' => 100,'tabindex'=>'1'));?>                                 
				</div>
            </div>
          </div>
          </div>
		  <div class="row">
            <div class="form-group col-md-10">
              <label class="form-label">Password</label>
              <span class="help"></span>
              <div class="controls">
                  <div class="input-with-icon  right">                                       
                      <i class=""></i>
                      <?php echo $this->Form->input('password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 100,'tabindex'=>'2'));?>                                 
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-10">
              <label class="form-label">User Type</label>
              <span class="help"></span>
              <div class="controls">
                  <div class="input-with-icon  right">                                       
					<i class=""></i>
					<?php
					echo $this->Form->input('user_type',array('label' => false,'div' => false, 'empty' => 'Select User Type','class' => 'form-control','options'=>$roleTypes,'tabindex'=>'3')); ?>
                  </div>
              </div>
            </div>
          </div>
		  <div class="row">
          <div class="control-group  col-md-10">
            <div class="checkbox checkbox check-success">
            <?php echo $this->Form->input('remember',array('label' => 'Remember Me','div' => false,'type '=> 'checkbox','checked' => $remember_me,'hiddenField'=>false));?>
              
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-10">
            <?php echo $this->Form->input('submit',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-primary btn-cons pull-right','value'=>'Log In','id'=>'login-submit','tabindex'=>'4'));?>
            </div>
          </div>
		   <?php echo $this->Form->end();?>
        </div>
  </div>
</div>
<div id="backgroundPopup"></div>
<div id="toPopup">
    <div class="close"></div>
    <div id="popup_content" class="row">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center"><h1><b>User Type</b></h1></div>
                     <sub class="blue">Before logging in, please select user type</sub>
                </div>
            </div>
            <hr>
        </div>
         <div class="form-group col-lg-10">
            <?php echo $this->Form->hidden('provider',array('id'=>'selectedProvider'));
            echo $this->Form->input('role_type',array('label' => false,'div' => false, 'empty' => 'Select User Type','class' => 'form-control','options'=>$roleTypes,'id'=>'selectedSocialUser'));?>   
         </div> 
    </div>
</div>
</div>
</div>