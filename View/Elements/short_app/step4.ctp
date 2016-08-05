<?php
    $adminSetting = $this->Session->read('adminSettings');
?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1>Short Application</h1>
            <br>
            <div class="wizard-container">
                <div class="wizard-step-complete"><span class="wizard-badge-complete">1</span><div class="step-number-complete">Step 1</div></div>
                <div class="wizard-step-complete"><span class="wizard-badge-complete">2</span><div class="step-number-complete">Step 2</div></div>
                <div class="wizard-step-complete"><span class="wizard-badge-complete">3</span><div class="step-number-complete">Step 3</div></div>
                <div class="wizard-step-active"><span class="wizard-badge-active">4</span><div class="step-number-active">Step 4</div></div>
                <div class="wizard-step"><span class="wizard-badge">5</span><div class="step-number">Step 5</div></div>
                <div style="clear:both"></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Step 4 - Loan Request</h3>
                    <br />
                    <center>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('loan_type',array('label' => false,'div' => false, 'empty' => 'Select Loan Type','options'=>$loanTypes,'class' => 'form-control placeholder loanTypeInput','maxlength' => 100, 'title' => 'Select Loan Type'));?>
                        </div>
                        <div class="col-lg-6">
                            <?php echo $this->Form->input('loan_reason',array('label' => false,'div' => false, 'empty' => 'Reason for the loan','options'=>$loanReasons,'class' => 'otherLoanReasons form-control placeholder','maxlength' => 100, 'title' => 'Reason for the loan'));?>
                        </div>
                        <div class="col-lg-2">
                            <?php echo $this->Form->input('fico_score',array('label' => false,'div' => false, 'placeholder' => 'Fico Score','class' => 'form-control placeholder','value'=>$adminSetting['fico_score'],'readonly'=>true, 'title' => 'Fico Score'));?>
                        </div>
                        <div class="otherLoanReasons" style="display:none">
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('other_loan_reason',array('label' => false,'div' => false, 'placeholder' => 'Other Reason for loan','class' => 'form-control placeholder','maxlength' => 150, 'title' => 'Other Reason for loan'));?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <?php
                            echo '<div class="input-group">';
                            echo '<span class="input-group-addon">$</span>';
                                echo $this->Form->input('loan_amount',array('placeholder'=>'Total Loan Amount','type'=>'number','label' => false,'div' => false,'class' => 'form-control loanAmount','maxlength' => 100,'min'=>$adminSetting['min_loan_amount'],'max'=>$adminSetting['max_loan_amount'],'title'=>'Total Loan Amount'));
                            echo '</div>';
                        ?>
                        </div>
                        <div class="col-lg-6">
                            <?php echo $this->Form->input('loan_to_value',array('label' => false,'div' => false, 'placeholder' => 'Down Payment Percentage','class' => 'form-control placeholder downPaymentPercentage','min' => '50','max'=>'100','aria-describedby'=>'basic-addon2','title'=>'Down Payment Percentage'));?>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <?php echo $this->Form->input('down_payment',array('label' => false,'div' => false, 'placeholder' => 'Down Payment','class' => 'form-control finalDownPayment','readonly'=>true,'title'=>'Down Payment'));?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <?php echo $this->Form->input('loan_value',array('label' => false,'div' => false, 'placeholder' => 'Final Loan Amount','class' => 'form-control finalLoanAmount','readonly'=>true,'title'=>'Final Loan Amount'));?>
                            </div>
                        </div>
                        
                        <div class="rehabInformation" style="display: none;">
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('bank_name',array('label' => false,'div' => false, 'placeholder' => 'Bank Name','class' => 'form-control', 'title' => 'Bank Name'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php
                                $accountType = $this->requestAction('/app/getAccountType');
                                echo $this->Form->input('account_type',array('empty'=>'Select account type','options'=>$accountType,'label' => false,'div' => false,'class' => 'form-control accountTypeGift', 'title' => 'Select account type'));?>
                            </div>
                            <div class="accountTypeGift" style="display: none;">
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('grantor_name',array('label' => false,'div' => false, 'placeholder' => 'Grantor Name','class' => 'form-control', 'title' => 'Grantor Name'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php
                                    $grantorRelation = $this->requestAction('/app/getGrantorRelation');
                                    echo $this->Form->input('grantor_relation',array('empty'=>'Select Relation','options'=>$grantorRelation,'label' => false,'div' => false,'class' => 'form-control', 'title' => 'Select Relation'));?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <?php echo $this->Form->input('account_balance',array('label' => false,'div' => false, 'placeholder' => 'Account Balance','class' => 'form-control accountBalance','title'=>'Account Balance'));?>
                                </div>
                            </div>
                            <div class="anotherAccount" style="display: none;">
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('another_bank_name',array('label' => false,'div' => false, 'placeholder' => 'Other Bank Name','class' => 'form-control', 'title' => 'Other Bank Name'));?>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <?php echo $this->Form->input('another_account_balance',array('label' => false,'div' => false, 'placeholder' => 'Other Bank Account Balance','class' => 'form-control', 'title' => 'Other Bank Account Balance'));?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('loan_objective',array('label' => false,'div' => false, 'placeholder' => 'Specific Loan Objective','class' => 'form-control','type'=>'textarea','maxlength' => 100, 'title' => 'Specific Loan Objective'));?>
                        </div>
                        <div class="rehabLoanDiscription" style="display: none;">
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('rehab_description',array('label' => false,'div' => false, 'placeholder' => 'Rehab loan description','class' => 'form-control','type'=>'textarea','maxlength' => 100, 'title' => 'Rehab loan description'));?>
                            </div>
                        </div> 
                    </div>
                    <div style="clear:both"></div>
                    <br />
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