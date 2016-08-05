<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1>Short Application</h1>
            <br>
            <div class="wizard-container">
                <div class="wizard-step-complete"><span class="wizard-badge-complete">1</span><div class="step-number-complete">Step 1</div></div>
                <div class="wizard-step-active"><span class="wizard-badge-active">2</span><div class="step-number-active">Step 2</div></div>
                <div class="wizard-step"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                <div class="wizard-step"><span class="wizard-badge">4</span><div class="step-number">Step 4</div></div>
                <div class="wizard-step"><span class="wizard-badge">5</span><div class="step-number">Step 5</div></div>
                <div style="clear:both"></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Step 2 - Borrower Information</h3>
                    <br />
                    <center>
                    <div class="form-group">
                        <div class="col-lg-4">
                        <?php echo $this->Form->input('applicant_first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','maxlength' => 100));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('applicant_last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','maxlength' => 100));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('applicant_email_ID',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','maxlength' => 100));?>
                        </div>
                        <div class="col-lg-4">
                            <?php 
                            $selectCompany = array('Individual'=>'Individual','LLC'=>'LLC','LLP'=>'LLP','Trust'=>'Trust','S-Corp'=>'S-Corp','C-Corp'=>'C-Corp');
                            echo $this->Form->input('company_select',array('label' => false,'div' => false, 'empty' => 'Borrower Type','class' => 'form-control','options' => $selectCompany, 'id'=>'companyOption'));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('applicant_company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control','maxlength' => 100));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('applicant_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### - ####','class' => 'form-control maskInput','maxlength' => 100));?>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <br>
                    <span class="redText">* All fields are required to move on to next step.</span>
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
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php echo $this->Element('fronts/loader');?>