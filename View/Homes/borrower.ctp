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
          <h2>Borrower Login</h2>
        </div>
        <div class="col-md-5 "> <br>
        <?php echo $this->Session->flash();?>
		  <?php echo $this->Form->create('User', array('url' => array('controller' => 'homes', 'action' => 'borrower'),'id'=>'loginForm'));
         echo $this->Form->hidden('user_type',array('value'=>1));
          ?>
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