<!-- Page Content -->
<?php
    echo $this->Html->script(array('front/short_app.js'));
    $adminSetting = $this->Session->read('adminSettings');
?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
	<div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<div class="row">
			<h3>Borrower Basic Information</h3><hr />
			<?php echo $this->Form->create('ShortApplication',array('novalidate'=>'novalidate','class'=>'form-inline'));?>
				<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
                <div class="arm-type row">
                    <div class="form-group col-sm-12">
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('applicant_first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','maxlength' => 100,'value' => $this->Session->read('userInfo.first_name'),'readonly' => true,'title' => 'First Name'));?>
                        </div>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('applicant_last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','maxlength' => 100,'value' => $this->Session->read('userInfo.last_name'),'readonly' => true, 'title' => 'Last Name'));?>
                        </div>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('applicant_email_ID',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','maxlength' => 100,'value' => $this->Session->read('userInfo.email_address'),'readonly' => true, 'title' => 'Email Address'));?>
                        </div>
                    </div>
                </div>
                <div class="arm-type row">
                    <div class="col-lg-4">
                    <?php 
                        $selectCompany = array('Individual'=>'Individual','LLC'=>'LLC','LLP'=>'LLP','Trust'=>'Trust','S-Corp'=>'S-Corp','C-Corp'=>'C-Corp');
                        echo $this->Form->input('company_select',array('label' => false,'div' => false, 'empty' => 'Borrower Type','class' => 'form-control','options' => $selectCompany, 'id'=>'companyOption', 'title' => 'Borrower Type'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('applicant_company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control noValidate','maxlength' => 100, 'title' => 'Company Name'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('applicant_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### - ####','class' => 'form-control maskInput','maxlength' => 100, 'title' => 'Phone'));?>
                    </div>
                </div>
                <h3>Property Detail</h3><hr />
                <!-- property information -->
                <div class="arm-type row">
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('property_address',array('label' => false,'div' => false, 'placeholder' => 'Property Address','class' => 'form-control','type' => 'text','maxlength' => 100, 'title' => 'Property Address'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php
                            $propertyTypes['other'] = 'Other';
                            echo $this->Form->input('property_type',array('label' => false,'div' => false, 'empty' => 'Property Type','options'=>$propertyTypes,'class' => 'form-control placeholder otherOption','maxlength' => 100,'id'=>'propertyType', 'title' => 'Property Type'));
                        ?>
                    </div>
                    <div class="other_Property_Type col-lg-4" style="display: none;">
                    <?php
                        echo $this->Form->input('other_property_type',array('label' => false,'div' => false, 'placeholder' => 'Other Property Type','type'=>'text','class' => 'form-control otherOption off','maxlength' => 100,'id'=>'other_Property_Type', 'title' => 'Other Property Type'));
                    ?>
                    </div>
                </div>
                <div class="arm-type row">
                    <div class="col-lg-4">
                        <?php
                        $alt = (!empty($this->request->data['ShortApplication']['property_city'])) ? $this->request->data['ShortApplication']['property_city'] : '';
                        echo $this->Form->input('property_state',array('label' => false,'div' => false, 'empty' => 'Select Property State','class' => 'form-control placeholder','options' => $states,'tabindex'=>'9','id'=>'userStates','alt'=>$alt, 'title'=>'Property State'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('property_city',array('label' => false,'div' => false, 'empty' => 'Select City','class' => 'form-control placeholder','options'=>'','id'=>'userCities', 'title'=>'Property City'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('property_zipcode',array('label' => false,'div' => false, 'placeholder' => 'Property ZipCode','class' => 'form-control placeholder','maxlength' => 20, 'title'=>'Property Zipcode'));?>
                    </div>
                </div>
                <!-- loan request -->
                <h3>Loan Request</h3><hr />
                <!-- property information -->
                <div class="arm-type row">
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('loan_type',array('label' => false,'div' => false, 'empty' => 'Select Loan Type','options'=>$loanTypes,'class' => 'form-control placeholder loanTypeInput','maxlength' => 100, 'title'=>'Loan Type'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('loan_reason',array('label' => false,'div' => false, 'empty' => 'Reason for the loan','options'=>$loanReasons,'class' => 'otherLoanReasons form-control placeholder','maxlength' => 100, 'title'=>'Loan Reason'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('fico_score',array('label' => false,'div' => false, 'placeholder' => 'Fico Score','class' => 'form-control placeholder','min' => $adminSetting['fico_score'],'value' => $adminSetting['fico_score'],'max'=>'850', 'title'=>'Fico Score'));?>
                    </div>
                </div>
                <div class="arm-type row">
                    <div class="col-lg-4 otherLoanReasons" style="display:none">
                        <?php echo $this->Form->input('other_loan_reason',array('label' => false,'div' => false, 'placeholder' => 'Other Reason for loan','class' => 'form-control placeholder','maxlength' => 150, 'title'=>'Other Reason for loan'));?>
                    </div>
                    <div class="col-lg-3">
                    <?php
                        $min = (!empty($adminSetting['min_loan_amount'])) ? $adminSetting['min_loan_amount'] : '';
                        $max = (!empty($adminSetting['max_loan_amount'])) ? $adminSetting['max_loan_amount'] : '';
                        echo '<div class="input-group">';
                        echo '<span class="input-group-addon">$</span>';
                            echo $this->Form->input('loan_amount',array('placeholder'=>'Total Loan Amount','type'=>'number','label' => false,'div' => false,'class' => 'form-control loanAmount','maxlength' => 100,'min'=>$min,'max'=>$max, 'title'=>'Loan Amount'));
                        echo '</div>';
                    ?>
                    </div>
                    <div class="col-lg-3">
                        <?php echo $this->Form->input('loan_to_value',array('label' => false,'div' => false, 'placeholder' => 'Down Payment Percentage','class' => 'form-control placeholder downPaymentPercentage','min' => '50','max'=>'100','aria-describedby'=>'basic-addon2', 'title'=>'Down Payment Percentage'));?>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <?php echo $this->Form->input('down_payment',array('label' => false,'div' => false, 'placeholder' => 'Down Payment','class' => 'form-control finalDownPayment','readonly'=>true, 'title'=>'Down Payment'));?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <?php echo $this->Form->input('loan_value',array('label' => false,'div' => false, 'placeholder' => 'Final Loan Amount','class' => 'form-control finalLoanAmount','readonly'=>true,'title' => 'Final Loan Amount'));?>
                        </div>
                    </div>
                </div>
                <div class="arm-type row rehabInformation" style="display: none;">
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('bank_name',array('label' => false,'div' => false, 'placeholder' => 'Bank Name','class' => 'form-control'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        $accountType = $this->requestAction('/app/getAccountType');
                        echo $this->Form->input('account_type',array('empty'=>'Select account type','options'=>$accountType,'label' => false,'div' => false,'class' => 'form-control accountTypeGift','title' => 'Account Type'));?>
                    </div>
                    <div class="accountTypeGift" style="display: none;">
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('grantor_name',array('label' => false,'div' => false, 'placeholder' => 'Grantor Name','class' => 'form-control', 'title' => 'Grantor Name'));?>
                        </div>
                        <div class="col-lg-4">
                            <?php
                            $grantorRelation = $this->requestAction('/app/getGrantorRelation');
                            echo $this->Form->input('grantor_relation',array('empty'=>'Select Relation','options'=>$grantorRelation,'label' => false,'div' => false,'class' => 'form-control', 'title' => 'Grantor Relation'));?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <?php echo $this->Form->input('account_balance',array('label' => false,'div' => false, 'placeholder' => 'Account Balance','class' => 'form-control accountBalance', 'title' => 'Account Balance'));?>
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
                <div class="arm-type row">
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('loan_objective',array('label' => false,'div' => false, 'placeholder' => 'Specific Loan Objective','class' => 'form-control','type'=>'textarea','maxlength' => 100, 'title' => 'Specific Loan Objective'));?>
                    </div>
                    <div class="rehabLoanDiscription" style="display: none;">
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('rehab_description',array('label' => false,'div' => false, 'placeholder' => 'Rehab loan description','class' => 'form-control','type'=>'textarea','maxlength' => 100, 'title' => 'Rehab loan description'));?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12 btn-top">
                    <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right"></span>Submit',array('type'=>'submit','class'=>'btn blue sumitButton','escape'=>false));?>
                </div>
			<?php echo $this->Form->end();?>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- /#page-content-wrapper --> 
</div>