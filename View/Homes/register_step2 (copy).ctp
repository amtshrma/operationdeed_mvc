<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top"></nav>
    <center><h1>User Registration</h1></center>
    <div class="content-container-topalign">
        <div class="whitebox-wrapper">
                <div class="content-nomargin">
                    <div data-step="1" class="wizard-step-complete"><span class="wizard-badge-active">1</span><div class="step-number-active">Step 1</div></div>
                    <div data-step="2" class="wizard-step-active"><span class="wizard-badge">2</span><div class="step-number">Step 2</div></div>
                    <?php if(empty($shortAppID)){ ?>
                        <div data-step="3" class="wizard-step"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                    <?php } ?>
                    
                    <div style="clear:both"></div>
                </div>
                <?php echo $this->Form->create('User', array('id'=>'registerForm','type' => 'file','novalidate'=>'novalidate'));?>
                    <div class="whitebox">
                        <h3>Step 2 - Postal Information</h3>
                        <br />
                        <center>
                            <div class="form-group">
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.mailing_address',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address','class' => 'form-control','tabindex'=>'11'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.mailing_address2',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address 2','class' => 'form-control','type' => 'text','tabindex'=>'12'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'placeholder' => 'State','class' => 'form-control','options'=>$states,'tabindex'=>'13','id'=>'userStates'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.city',array('label' =>false,'div' => false, 'placeholder' => 'City','class' => 'form-control','tabindex'=>'14','options'=>'','id'=>'userCities'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','type' => 'text','maxlength' => 10,'tabindex'=>'15'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false, 'placeholder' => 'Fax Number','class' => 'form-control maskInput','type' => 'text','tabindex'=>'16'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### ####','class' => 'form-control maskInput','type' => 'text','tabindex'=>'17'));?>
                                </div>
                                <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### ####','class' => 'form-control maskInput','type' => 'text','maxlength' => 15,'tabindex'=>'18'));?>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="buttons">
                        <table border="0" width="106%">
                            <tr>
                                <td align="left"></td>
                                <td align="right">
                                    <?php
                                    $title = (!empty($shortAppID)) ? 'Save' : 'Next';
                                    echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>'.$title,array('class'=>'btn btn-lg btn-primary step','type'=>'submit','escape'=>false,'id'=>'step1'));?>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php echo $this->Form->end();?>
            </div>
    </div>
</div>