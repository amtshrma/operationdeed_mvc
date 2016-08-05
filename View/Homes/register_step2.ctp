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
                <div data-step="1" class="wizard-step-complete"><span class="wizard-badge-complete">1</span><div class="step-number-complete">Step 1</div></div>
                <div data-step="2" class="wizard-step-active"><span class="wizard-badge-active">2</span><div class="step-number-active">Step 2</div></div>
                <div data-step="3" class="wizard-step"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                <div style="clear:both"></div>
            </div>
			<?php } ?>
            <?php echo $this->Form->create('User', array('id'=>'registerForm','type' => 'file','novalidate'=>'novalidate'));?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Step 2 - Postal Information</h3>
					<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
                    <hr />
                    <center>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.mailing_address',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address','class' => 'form-control'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.mailing_address2',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address 2','class' => 'form-control'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'placeholder' => 'State','class' => 'form-control','options'=>$states,'id'=>'userStates'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.city',array('label' =>false,'div' => false, 'placeholder' => 'City','class' => 'form-control','options'=>'','id'=>'userCities'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','maxlength' => 10));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false, 'placeholder' => 'Fax Number','class' => 'form-control maskInput'));?>
                            </div>
                            <div class="col-lg-4">
                            <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### ####','class' => 'form-control maskInput'));?>
                            </div>
                            <div class="col-lg-4">
                            <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### ####','class' => 'form-control maskInput','maxlength' => 15));?>
                            </div>
                        </div>
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
<!-- /#page-wrapper -->