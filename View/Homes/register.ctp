<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1><?php echo $this->Session->read('userTypeText');?> Registration</h1>
            <br>
			<?php if($this->Session->read('userType') == 9 || $this->Session->read('userType') == 12 || $this->Session->read('userType') == 8) { ?>
				 <div class="wizard-container two-step">
                <div data-step="1" class="wizard-step-active"><span class="wizard-badge-active">1</span><div class="step-number-active">Step 1</div></div>
                <div data-step="2" class="wizard-step"><span class="wizard-badge">2</span><div class="step-number">Step 2</div></div>
                <div style="clear:both"></div>
            </div>
			<?php } else { ?>
				 <div class="wizard-container" style="margin-right: 0;">
                <div data-step="1" class="wizard-step-active"><span class="wizard-badge-active">1</span><div class="step-number-active">Step 1</div></div>
                <div data-step="2" class="wizard-step"><span class="wizard-badge">2</span><div class="step-number">Step 2</div></div>
                <div data-step="3" class="wizard-step"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                <div style="clear:both"></div>
            </div>
			<?php } ?>
            <?php echo $this->Form->create('User', array('id'=>'registerForm','type' => 'file','novalidate'=>'novalidate'));?>
			<div class="panel panel-default">
                <div class="panel-body">
                    <h3>Step 1 - Basic Information</h3>
					<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
                    <hr />
                    <center>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','maxlength' => 25));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','maxlength' => 25));?>                                 
                            </div>
                            <?php echo $this->Form->hidden('User.user_type',array('label' => false,'div' => false, 'placeholder' => 'User Type','class' => 'form-control','type'=>'text','value'=>$this->Session->read('userType')));?>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('User.email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control'));?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('User.password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 20));?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('User.confirm_password',array('label' => false,'div' => false, 'placeholder' => 'Confirm Password','class' => 'form-control','type' => 'password','maxlength' => 20));?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('UserDetail.company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control','type' => 'text','maxlength' => 30));?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('UserDetail.company_position',array('label' => false,'div' => false, 'placeholder' => 'Company Position','class' => 'form-control','type' => 'text','maxlength' => 30));?>
                            </div>
                            <div class="col-lg-6" style="text-align: left;">
                                <?php echo $this->Form->input('UserDetail.birthdate',array('label' => 'Birthday','div' => false, 'placeholder' => 'Birthday','class' => 'form-control','id'=>'dateOfBirth'));?>
                            </div>
                            <div class="col-lg-6" style="text-align: left;">
                                <?php echo $this->Form->input('UserDetail.profile_pic',array('label'=>'Profile Picture','div'=>false,'title' => 'Profile Picture','class' => '','type' => 'file','class' => 'form-control'));?>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        * Kindly fill all required fields and proceed.
                    </center>
                </div>
                <!-- /.panel-body -->
            </div>
            <div class="buttons">
            <table border="0" width="100%">
                <tr>
                    <td align="left">
                        <?php //echo $this->Html->link('<span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel',array('controller'=>'homes','action'=>'shortAppStartup'),array('escape'=>false,'class'=>'btn btn-lg btn-cancel'));?>
                    <td align="right">
                        <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('class'=>'btn btn-lg btn-primary sumitButton','title'=>'step2','type'=>'submit','escape'=>false));?>
                    </td>
                </tr>
            </table>
            <br><br>
            </div>
            <?php echo $this->Form->end();?>
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<style>
    input[type='file']{
        margin-top: 5px;
    }
</style>
<!-- /#page-wrapper -->