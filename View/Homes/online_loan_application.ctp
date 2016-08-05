<?php echo $this->Html->script('loan');
echo $this->Html->css('bootstrap-datepicker/datepicker');
?>
<div class="section first">
<div class=" p-b-60">
    <div class="section dark-grey p-t-20  p-b-20 m-b-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Loan Application</h2>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="container">
        <div class="row login-container">
            <?php echo $this->Form->create('Loan',array('id'=>'loanForm','novalidate' => true));
            echo $this->Form->hidden('borrower_id',array('value' => $shortAppDetail['ShortApplication']['borrower_ID']));?>
            <div class="row column-seperation">
                <div class="col-lg-12">
                    <h2>Borrower Information</h2><br/>
                    <div class="form-group col-lg-3">
                        <label>First Name</label>
                        <?php echo $this->Form->input('first_name',array('label'=>false,'div'=>false,'placeholder'=>'First Name','class' => 'form-control','type' =>'text','maxlength'=>50,'id'=>'brokerFirstName','readonly'=>'readonly','value'=>$shortAppDetail['ShortApplication']['applicant_first_name']));?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Last Name</label>
                        <?php echo $this->Form->input('last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'brokerLastName','readonly'=>'readonly','value'=>$shortAppDetail['ShortApplication']['applicant_last_name']));?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Address</label>
                        <?php echo $this->Form->input('address',array('label' => false,'div' => false, 'placeholder' => 'Address','class' => 'form-control','type' => 'text','maxlength' => 100,'id'=>'brokeraddress','value'=>$shortAppDetail['ShortApplication']['property_address']));?>
                    </div> 
                    <div class="form-group col-lg-3">
                        <label>City</label>
                        <?php echo $this->Form->input('city',array('label' => false,'div' => false, 'placeholder' => 'City','class' => 'form-control','maxlength' => 100,'id'=>'userCities','readonly'=>'readonly','value'=>$this->Common->getCityName($shortAppDetail['ShortApplication']['property_city'])));?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>State</label>
                        <?php echo $this->Form->input('state',array('label' => false,'div' => false, 'placeholder' => 'State','class' => 'form-control','type' => 'text','maxlength' => 100,'id'=>'userStates','readonly'=>'readonly','value'=>$this->Common->getStateName($shortAppDetail['ShortApplication']['property_state'])));?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Loan Amount</label>
                        <?php echo $this->Form->input('loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Loan Amount','class' => 'form-control','type' => 'text','maxlength' => 100, 'readonly'=>'readonly','value'=>isset($softQuoteDetail['SoftQuote']['loan_amount']) ? $softQuoteDetail['SoftQuote']['loan_amount'] : ''));?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Purpose of Loan</label>
                        <?php echo $this->Form->input('purpose_of_loan',array('empty'=>'Select Loan Purpose','label' => false,'div' => false, 'placeholder' => 'Laon Purpose','class' => 'form-control','id'=>'loanPurpose','options'=>$this->Common->getLoanPurposes()));?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row column-seperation">
                <div class="col-lg-12">
                    <h2>Property Information</h2>
                    <div class="form-group col-lg-4">
                        <label>Property Value As-Is<span class="required">*</span></label>
                          
                           <?php echo $this->Form->input('property_value_as',array('label' => false,'div' => false, 'placeholder' => 'Property Value As Is','class' => 'form-control','type' => 'text','maxlength' => 100));?>
                        
                        
                    </div>
                    <div class="form-group  col-lg-4">
                        <label>Property Value After-Repaired-Value (ARV) ($)<span class="required"> * </span></label>
                        
                            <?php echo $this->Form->input('property_value_after',array('label' => false,'div' => false, 'placeholder' => 'Property Value After','class' => 'form-control','type' => 'text','maxlength' => 100));?>
                    
                    </div> 
                    <div class="form-group col-lg-4">
                        <label>Property Value Appraised ($)<span class="required"> * </span></label>
                        
                        <?php echo $this->Form->input('property_value_appraised',array('label' => false,'div' => false, 'placeholder' => 'Property Value Appraised','class' => 'form-control','type' => 'text','maxlength' => 100));?>
                        
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Property Appraisal Date<span class="required"> * </span></label>
                        <?php echo $this->Form->input('property_appraise_date',array('label' => false,'div' => false, 'placeholder' => 'Property Appraise Date','class' => 'form-control','type' => 'text','maxlength' => 100, 'id'=>'appraisalDate'));?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Property Type<span class="required"> * </span></label>
                        <?php echo $this->Form->input('proprty_type',array('empty'=>'Select Property Type','label' => false,'div' => false, 'placeholder' => 'Property Type','class' => 'form-control','options'=>$propertyTypes,'selected'=>$shortAppDetail['ShortApplication']['property_type'],'disabled'=>true));?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Occupancy<span class="required"> * </span></label>
                        <?php echo $this->Form->input('occupancy',array('empty'=>'Select Occupancy','label' => false,'div' => false, 'placeholder' => 'Property Type','class' => 'form-control','options'=>$this->Common->getOccupancy()));?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Condition Of Property<span class="required"> * </span></label>
                        <?php echo $this->Form->input('condition_of_property',array('label' => false,'div' => false, 'placeholder' => 'Condition Of Property','class' => 'form-control'));?>
                    </div>
                    <?php //pr($this->request->data['Loan']['purpose_of_loan']);die;?>
                    <div class="form-group col-lg-4">
                        <label>Gross Rental Income<span class="required"> * </span></label>
                        <?php echo $this->Form->input('gross_rental_income',array('label' => false,'div' => false, 'placeholder' => 'Gross Rental Income','class' => 'form-control'));?>
                    </div>
                    <!-- refinence loan -->
                    <div class="<?php echo (isset($this->request->data['Loan']['purpose_of_loan']) && $this->request->data['Loan']['purpose_of_loan']  == 'Refiance') ? '': 'off';?> refience Loan form-group col-lg-4">
                        <label>Date of Purchase<span class="required"> * </span></label>
                        <?php echo $this->Form->input('refinance_date_of_purchase',array('label' => false,'div' => false, 'placeholder' => 'Date Of Purchase','class' => 'form-control'));?>
                    </div>
                    <div class="<?php echo (isset($this->request->data['Loan']['purpose_of_loan']) && $this->request->data['Loan']['purpose_of_loan']  == 'Refiance') ? '': 'off';?> refience Loan form-group col-lg-4">
                        <label>Original Purchase Price<span class="required"> * </span></label>
                        <?php echo $this->Form->input('refience_original_purchase_price',array('label' => false,'div' => false, 'placeholder' => 'Original Purchase Price','class' => 'form-control'));?>
                    </div>
                    <!-- if how much cash in hand -->
                    <div class="<?php echo (isset($this->request->data['Loan']['purpose_of_loan']) && $this->request->data['Loan']['purpose_of_loan']  == 'Refiance Cash Out') ? '': 'off';?> cashOut form-group col-lg-4">
                        <label>How Much Cash-in-Hand<span class="required"> * </span></label>
                        <?php echo $this->Form->input('cash_in_hand',array('label' => false,'div' => false, 'placeholder' => 'Cash In Hand','class' => 'form-control'));?>
                    </div>
                    <div class="<?php echo (isset($this->request->data['Loan']['purpose_of_loan']) && $this->request->data['Loan']['purpose_of_loan']  == 'Refiance Cash Out') ? '': 'off';?> cashOut form-group col-lg-4">
                        <label>Purpose of Cash-out<span class="required"> * </span></label>
                        <?php echo $this->Form->input('cash_out',array('label' => false,'div' => false, 'placeholder' => 'Cash Out','class' => 'form-control'));?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Existing Liens on Property<span class="required"> * </span></label>
                        <?php echo $this->Form->input('liens_property',array('label' => false,'div' => false, 'empty' => 'Select Liens Property','class' => 'form-control','options'=>$this->Common->getPropertyLiens()));?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Employment<span class="required"> * </span></label>
                        <?php echo $this->Form->input('employment',array('label' => false,'div' => false, 'empty' => 'Select Employment','class' => 'form-control','options'=>$this->Common->getEmploymentTypes()));?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row column-seperation">
                <div class="col-lg-12">
                    <h1>Description Of Income</h1>
                    <div class="form-group col-lg-3">
                        <label>Current Monthly Gross Income<span class="required"> * </span></label>
                        <?php echo $this->Form->input('monthly_gross_income',array('label' => false,'div' => false, 'empty' => 'Monthly Gross Income','class' => 'form-control','maxlength' => 100));?>
                    </div>
                    <?php if($softQuoteDetail['SoftQuote']['loan_term'] == '6') { ?>
                    <div class="form-group col-lg-3">
                        <label>Loan Term Requested - Other</label>
                        <?php echo $this->Form->input('loan_term_requested',array('label' => false,'div' => false,'class' => 'form-control','readonly'=>'readonly','empty' => 'Select Loan Term','value'=>$softQuoteDetail['SoftQuote']['other_loan_term']. 'months'));?>
                    </div>
                    <?php } else {
                        
                        ?>
                        <div class="form-group col-lg-3">
                            <label>Loan Term Requested<span class="required"> * </span></label>
                        <?php echo $this->Form->input('loan_term_requested',array('label' => false,'div' => false,'class' => 'form-control','disabled'=>true,'empty' => 'Select Loan Term','options'=>$this->Common->getLoanTerms(),'selected'=>$softQuoteDetail['SoftQuote']['loan_term']));?>
                        </div>
                   <?php }?>
                    <div class="form-group col-lg-3">
                        <label>Income Documenation Provide<span class="required"> * </span></label>
                        <?php echo $this->Form->input('income_documentation',array('label' => false,'div' => false,'class' => 'form-control','type' => 'textarea','rows'=>'3'));?>
                    </div>
                    
                    
                    <div class="form-group col-lg-3">
                        <label>Repayment of this Loan (exit strategy)<span class="required"> * </span></label>
                        <?php echo $this->Form->input('repayment_strategy',array('label' => false,'div' => false,'class' => 'form-control','type' => 'textarea','rows'=>'3'));?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Liquiid Assets<span class="required"> * </span></label>
                        <?php echo $this->Form->input('liquid_assests',array('label' => false,'div' => false,'class' => 'form-control','type' => 'textarea','rows'=>'3'));?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Other Real Estate Owned</label>
                        <?php echo $this->Form->input('other_real_estate',array('label' => false,'div' => false,'class' => 'form-control','type' => 'textarea','rows'=>'3'));?>
                    </div>
                    
                    <div class="form-group col-lg-3">
                        <label>Notes </label>
                        <?php echo $this->Form->input('notes',array('label' => false,'div' => false,'class' => 'form-control','type' => 'textarea','rows'=>'3'));?>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <?php echo $this->Form->button('Apply', array('type' => 'submit','class' => 'btn btn-primary btn-cons'));?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');?>
<script type="text/javascript">
jQuery(document).ready(function(){ 
    $('#appraisalDate').datepicker({
		format: "mm/dd/yyyy",
    });
});
</script>