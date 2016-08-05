<?php echo $this->Html->Script('assets/demo.js');?>
<?php echo $this->Html->Script('jquery.maskMoney.js');?>
<script>
jQuery('document').ready(function(){
	jQuery(document).on('focus','.maskIncome',function() {
		jQuery('.maskIncome').maskMoney({allowZero:false, allowNegative:false, defaultZero:true});
	});
});
</script>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-8 col-lg-12 whiteBG">
        <div class="row col-md-12">
            <h3>Soft Quote</h3><hr />
            <div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
            <?php
                echo $this->Form->create('SoftQuote', array('novalidate' => true,'class'=>'form-no-horizontal-spacing'));
                echo $this->Form->hidden('short_application_Id',array('value'=>$shortAppId,'id'=>'shortApplicationID'));
            ?>
            <div class="col-md-4 form-group">
                <label class="form-label">Loan Amount ($)<span class="required"> * </span></label>
                <div class="input-with-icon">                                     
                <?php
                    echo $this->Form->input('loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Loan Amount','class' => 'form-control','value'=>$propertyDetail['ShortApplication']['loan_amount'],'readonly'=>'readonly','maxlength' => 11));?>      
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Lien Position<span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                   <?php
                   $lienPosition = $this->Common->getLienPositions();
                   echo $this->Form->input('lien_position',array('label' => false,'div' => false, 'empty' => 'Lien Position','title' => 'Lien Position','class' => 'form-control otherOption','options'=>$lienPosition));?>      
                </div>
            </div>
            <div class="col-md-4 form-group" style="display: none;" id="other_Lien_Position">
                <label class="form-label">Other Lien Position<span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                   <?php
                   echo $this->Form->input('other_lien_positon',array('label' => false,'div' => false, 'empty' => 'Lien Position','title' => 'Lien Position','class' => 'form-control','type'=>'text','maxlength' => 50));?>      
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Interest Rate (%)<span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                    <?php echo $this->Form->input('interest_rate',array('label' => false,'div' => false, 'placeholder' => 'Interest Rate','class' => 'form-control'));?>     
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Loan Term Requested<span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                    <?php
                     $loanTerms = $this->Common->getLoanTerms();
                    echo $this->Form->input('loan_term',array('label' => false,'div' => false, 'empty' => 'Loan Term','class' => 'form-control otherOption','options'=>$loanTerms,'id'=>'loanTermSelectBox'));?>                                 
                </div>
            </div>
            <div class="col-md-4 form-group" style="display:none;" id="other_Loan_Term">
                <label class="form-label">Other Loan Term Requested (months)<span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                    <?php
                    echo $this->Form->input('other_loan_term',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term Requested','class' => 'form-control otherOption','min'=>20, 'maxlength' => 50));?>                                 
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Interest Only Loan<span class="required"> * </span></label>
                <div class="input-with-icon lineHeight55">                                       
                    <i class=""></i>
                    <?php
                    $radioOption = array('yes' =>'Yes','no' =>'No');
                    $checked ='yes';
                    echo $this->Form->radio('loan_interest_only',$radioOption,array('legend' => false,'label'=>false,'class' => '','value'=>$checked,'hiddenField' =>false,'style'=> "margin-left:12px"));?>                                 
                </div>
                <div id="interestError"></div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Monthly Payment ($)<span class="required"> * </span></label>
                <div class="input-with-icon">                                     
                  <?php
                   echo $this->Form->input('monthly_payment',array('label' => false,'div' => false, 'placeholder' => 'Monthly Payment','class' => 'form-control maskIncome','type'=>'text','maxlength' => 20));?>      
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Pre-payment Guaranteed Interest <span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                    <?php
                    $paymentInterest = $this->Common->getGuaranteedInterests();
                    echo $this->Form->input('per_payment_interest',array('label' => false,'div' => false, 'empty' => 'Pre-payment Guaranteed Interest','options'=>$paymentInterest,'class' => 'form-control', 'id'=>'per_payment_interest','maxlength' => 5));?> 
                </div>
            </div>
            <div class="col-md-4 form-group" style="display:none;" id="guaranteed_interest">
                <label class="form-label">Other Pre-payment Guaranteed Interest <span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                    <?php
                    echo $this->Form->input('other_pre_payment_interest',array('label' => false,'div' => false, 'placeholder' => 'Other Pre-payment Guaranteed Interest','class' => 'form-control','maxlength' => 50));?> 
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Pre-payment <span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                    <?php
                    $perPayment = $this->Common->getPrePayments();
                    echo $this->Form->input('pre-payment',array('label' => false,'div' => false, 'empty' => 'Pre-payment','options'=>$perPayment,'class' => 'form-control','id'=>'prePayment'));?> 
                </div>
            </div>
            <div class="col-md-4 form-group" style="display:none;" id="payment_interest">
                <label class="form-label">Other Pre-payment <span class="required"> * </span></label>
                <div class="input-with-icon">                                       
                    <i class=""></i>
                    <?php
                    echo $this->Form->input('other_pre_payment',array('label' => false,'div' => false, 'empty' => 'Pre-payment','type'=>'text','class' => 'form-control otherOption','min'=>1));?> 
                </div>
           </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Junior Financing Allowed <span class="required"> * </span></label>
                <div class="input-with-icon lineHeight55">                                 
                   
                    <?php $radioOption = array('yes' =>'Yes','no' =>'No');
                     $financingChecked ='no';
                     echo $this->Form->radio('financing_allowed',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'4','value'=> $financingChecked,'hiddenField' =>false,'style'=> "margin-left:12px"));?>
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Closing Time (Business Days) <span class="required"> * </span></label>
                <div class="input-with-icon">                                 
                   <?php echo $this->Form->input('business_days',array('label' => false,'div' => false, 'placeholder' => 'Closing Time (Business Days)','type'=>'number','class' => 'form-control','maxlength' => 5,'min'=>10));?>
               </div>
           </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Origination Fee ($) <span class="required"> * </span></label>
                <div class="input-with-icon">
                    <?php
                     echo $this->Form->input('origination_fee',array('label'=>false,'div' => false,'class' => 'form-control','placeholder' => 'Origination Fee','type'=>'text','value'=>$this->Session->read('adminSettings.origination_fee'),'readonly'=>'readonly'));?>
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label">Processing Fees ($) <span class="required"> * </span></label>
                <div class="input-with-icon">                                 
                    <?php
                    echo $this->Form->input('processing_fee',array('label'=>false,'div' => false,'class' => 'form-control','placeholder' =>'Processing Fees','type'=>'text','value'=>$this->Session->read('adminSettings.processing_fee'),'readonly'=>'readonly'));?>
                </div>
            </div>
        </div>
		<?php if($propertyDetail['ShortApplication']['loan_type'] == '2'){?>
			<div class="row col-md-12">
				<h3>Rehab Pre-Request Letter Information</h3><br />
				<div class="col-md-4 form-group">
					<label class="form-label">Rehab Loan Amount</label>
					<div class="input-with-icon">                                 
						<?php
						echo $this->Form->input('rehab_property_loan_amount',array('label'=>false,'div' => false,'class' => 'form-control','placeholder' =>'Rehab Loan Amount','type'=>'text','value'=>$propertyDetail['ShortApplication']['loan_value'],'readonly'=>'readonly'));?>
					</div>
				</div>
				<div class="col-md-4 form-group">
					<label class="form-label">Rehab Down Payment Percentage</label>
					<div class="input-with-icon">                                 
						<?php
						echo $this->Form->input('rehab_down_payment_percentage',array('label'=>false,'div' => false,'class' => 'form-control','placeholder' =>'Rehab Down Payment Percentage','type'=>'text','value'=>$propertyDetail['ShortApplication']['loan_to_value'],'readonly'=>'readonly'));?>
					</div>
				</div>
				<div class="col-md-4 form-group">
					<label class="form-label">Rehab Property Value</label>
					<div class="input-with-icon">                                 
						<?php
						echo $this->Form->input('rehab_property_value',array('label'=>false,'div' => false,'class' => 'form-control','placeholder' =>'Rehab Property Value','type'=>'text','value'=>$propertyDetail['ShortApplication']['loan_amount'],'readonly'=>'readonly'));?>
					</div>
				</div>
				<div class="col-md-4 form-group">
					<label class="form-label">Monthly Payment ($)<span class="required"> * </span></label>
					<div class="input-with-icon">                                     
					  <?php
					   echo $this->Form->input('rehab_monthly_payment',array('label' => false,'div' => false, 'placeholder' => 'Monthly Payment','class' => 'form-control maskIncome','type'=>'text','maxlength' => 20));?>      
					</div>
				</div>
				<div class="col-md-4 form-group">
					<label class="form-label">Closing Cost ($)<span class="required"> * </span></label>
					<div class="input-with-icon">                                     
					  <?php
					   echo $this->Form->input('rehab_closing_cost',array('label' => false,'div' => false, 'placeholder' => 'Closing Cost','class' => 'form-control maskIncome','type'=>'text','maxlength' => 20));?>      
					</div>
				</div>
			</div>
		<?php } ?>
        <hr/>   
        <div class="col-md 12">
            <div class="col-md-2 col-md-offset-10">
                <?php echo $this->Form->button('Generate Soft Quote', array('type' => 'submit','class' => 'btn btn-primary btn-cons sumitButton')); ?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>  
</div>