<div id="wrapper" class="step step1 wrapper-fullwidth">
    <nav class="navbar navbar-default navbar-static-top"></nav>
    <center><h1>User Registration</h1></center>
    <div class="content-container-topalign">
        <div class="whitebox-wrapper">
                <div class="content-nomargin steps">
                    <div data-step="1" class="wizard-step-active"><span class="wizard-badge-active">1</span><div class="step-number-active">Step 1</div></div>
                    <div data-step="2" class="wizard-step"><span class="wizard-badge">2</span><div class="step-number">Step 2</div></div>
                    <?php if(empty($shortAppID)){ ?>
                        <div data-step="3" class="wizard-step"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                    <?php } ?>
                    
                    <div style="clear:both"></div>
                </div>
                <?php echo $this->Form->create('User', array('id'=>'registerForm','type' => 'file','novalidate'=>'novalidate'));?>
                    <div class="whitebox">
                        <h3>Step 1 - Basic Information</h3>
                        <br />
                        <center>
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','type' => 'text','maxlength' => 25,'tabindex'=>'1'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','type' => 'text','maxlength' => 25,'tabindex'=>'2'));?>                                 
                                </div>
                                <?php
                                if($this->Session->check('shortApp')){
                                    echo $this->Form->hidden('User.user_type',array('label' => false,'div' => false, 'placeholder' => 'User Type','class' => 'form-control','value'=>'','id'=>'userType'));
                                }else{
                                    if($this->Session->check('userType') && $this->Session->read('userType') == 'broker'){
                                        $userTypes = array("2" => "Broker or Loan Officer","3" => "Sales Manager","4" => "Sales Director");
                                    }else if($this->Session->check('userType') && $this->Session->read('userType') == 'investor'){
                                        $userTypes = array("7" => "Investor","8" => "Investment Manager");
                                    }
                                    echo '<div class="col-lg-4">';
                                    echo $this->Form->input('User.user_type',array('label' => false,'div' => false, 'placeholder' => 'User Type','class' => 'form-control','options'=>$userTypes,'tabindex'=>'3','id'=>'userType','empty'=>'Select Type'));
                                    echo '</div>';
                                }
                                ?>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('User.email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','type' => 'text','tabindex'=>'4'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('User.password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 20,'tabindex'=>'5'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('User.confirm_password',array('label' => false,'div' => false, 'placeholder' => 'Confirm Password','class' => 'form-control','type' => 'password','maxlength' => 20,'tabindex'=>'6'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control','type' => 'text','maxlength' => 30,'tabindex'=>'7','value'=>'None'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.company_position',array('label' => false,'div' => false, 'placeholder' => 'Company Position','class' => 'form-control','type' => 'text','maxlength' => 30,'tabindex'=>'8','value'=>'None'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.date_of_birth',array('label' => false,'div' => false, 'placeholder' => 'Birthday','class' => 'form-control','id'=>'dateOfBirth','type' => 'text','tabindex'=>'9'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.profile_pic',array('label' => false,'div' => false, 'placeholder' => 'Profile Picture','class' => '','type' => 'file','tabindex'=>'10'));?>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                            <br />
                            * If you are already a registered Broker in Operation Trust Deed, please select a Broker / None.
                        </center>
                    </div>
                    <div class="buttons">
                        <table border="0" width="106%">
                            <tr>
                                <td align="left">
                                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel',BASE_URL,array('class'=>'btn btn-lg btn-cancel','escape'=>false));?>
                                </td>
                                <td align="right">
                                    <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('class'=>'btn btn-lg btn-primary step','title'=>'step2','type'=>'submit','escape'=>false,'id'=>'step1'));?>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php echo $this->Form->end();?>
            </div>
    </div>
</div>