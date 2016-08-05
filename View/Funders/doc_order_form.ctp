<?php
echo $this->Html->css(array('jquery-ui','bootstrap-timepicker.min')); 
echo $this->Html->script(array('jquery-ui','bootstrap/bootstrap.min','bootstrap-timepicker'));
?>
<script>
jQuery(document).ready(function(){
	jQuery('.timepicker').timepicker();
});
</script>

<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
      <h3>Doc Order Form</h3><br />
     <?php echo $this->Session->flash();?>
     <div class="row panel panel-default">
        <div class="panel-body">
            <div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
        <?php
            $loanId = base64_decode(base64_decode($loanId));		
            $loanID = base64_encode($loanId);
            echo $this->Session->flash();
            echo $this->Form->create('DocOrderForm', array('novalidate' => true,'id'=>'DocOrderForm','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data'));?>
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Loan Amount</label>
                    <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('ShortApplication.loan_amount',array('label' => false,'div' => false, 'class' => 'form-control decimalOnly', 'value'=>isset($loanDetail['ShortApplication']['loan_amount'])?$loanDetail['ShortApplication']['loan_amount']:'')); ?>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>Interest Rate</label>
                    <div class="col-sm-12 input-group">
                    <?php echo $this->Form->input('SoftQuote.interest_rate',array('label' => false,'div' => false, 'class' => 'form-control decimalOnly', 'value'=>isset($sqd['SoftQuote']['interest_rate'])?$sqd['SoftQuote']['interest_rate']:'')); ?>
                    <span class="input-group-addon">%</span>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>First Name</label>
                    <?php echo $this->Form->input('ShortApplication.applicant_first_name',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>isset($sqd['ShortApplication']['applicant_first_name'])?$sqd['ShortApplication']['applicant_first_name']:'')); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Last Name</label>
                    <?php echo $this->Form->input('ShortApplication.applicant_last_name',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>isset($sqd['ShortApplication']['applicant_last_name'])?$sqd['ShortApplication']['applicant_last_name']:'')); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Lien Position</label>
                    <?php echo $this->Form->input('SoftQuote.lien_position',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>isset($sqd['SoftQuote']['lien_position'])?$sqd['SoftQuote']['lien_position']:'')); ?>
                </div>
                <?php if(isset($sqd['SoftQuote']['loan_term']) && $sqd['SoftQuote']['loan_term'] == 6) { ?>
                    <div class="form-group col-lg-4 loan_term_other">
                        <label>Loan Term Requested - Other (months)</label>
                        <?php
                        echo $this->Form->input('SoftQuote.other_loan_term',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term','readonly'=>'readonly','class' => 'form-control','type' => 'text','id'=>'lt_other','value' =>isset($sqd['SoftQuote']['other_loan_term'])?$sqd['SoftQuote']['other_loan_term']:''));?>
                    </div>
                <?php } else { ?>
                     <div class="form-group col-lg-4">
                        <label>Loan Term Requested</label>
                        <?php
                        $loanTerms = $this->Common->getLoanTerms();
                        echo $this->Form->input('SoftQuote.loan_term', array('label' => false,'div' => false, 'class' => 'form-control loan_term','disbaled'=>true,'options'=>$loanTerms, 'selected'=>isset($sqd['SoftQuote']['loan_term'])?$sqd['SoftQuote']['loan_term']:'')); ?>
                    </div>
                <?php } ?>
                <div class="form-group col-lg-4">
                    <label>Pre-payment Guaranteed Interest</label>
                    <div class="radio_btn">
                        <?php
                        $paymentInterest = $this->Common->getGuaranteedInterests();
                        $paymentSelected = isset($sqd['SoftQuote']['per_payment_interest'])?$sqd['SoftQuote']['per_payment_interest']:'';
                       $otherPaymentInterest = isset($sqd['SoftQuote']['other_pre_payment_interest'])?$sqd['SoftQuote']['other_pre_payment_interest']:'';
                         echo $this->Form->radio('SoftQuote.prepay_ginterest',  array('1'=>'Yes', '0'=>'No'), array('legend'=>false, 'required'=>true,'label'=>false,'class' => 'prepay_gi','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px", 'default'=>!empty($paymentSelected)?'1':'0',)); ?> 
                      
                    </div>                    
                </div>
                <div class="form-group col-lg-4 prepay <?php echo empty($paymentSelected)?'hide':''; ?>">
                    <label>&nbsp;</label>
                    <?php                    
                    echo $this->Form->input('SoftQuote.per_payment_interest', array('label' => false,'div' => false, 'class' => 'form-control ppi', 'options'=>$paymentInterest, 'selected'=>$paymentSelected)); ?>
                </div>
                <div class="form-group col-lg-4 ppio <?php echo ($paymentSelected != '9')?'hide':'' ?>">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('SoftQuote.prepay_other',array('label' => false,'div' => false, 'class' => 'form-control', 'placeholder' => 'Other Pre-payment Guaranteed Interest', 'value'=>$otherPaymentInterest .'-months')); ?>
                </div>
            
                <div class="form-group col-lg-4">
                    <label>Pre-payment Penalty</label>
                    <?php 
                    $prePayments = $this->Common->getPrePayments();
                    $prePayment = isset($sqd['SoftQuote']['pre-payment'])?$sqd['SoftQuote']['pre-payment']:'';
                    $otherPenalty = isset($sqd['SoftQuote']['other_pre_payment'])?$sqd['SoftQuote']['other_pre_payment']:'';
                    echo $this->Form->input('SoftQuote.prepay_panalty', array('label' => false,'div' => false, 'class' => 'form-control pp_penalty', 'options'=>$prePayments, 'selected'=>$prePayment)); ?>
                </div>
                <div class="form-group col-lg-4 ppp_other <?php echo ($prePayment != '6')?'hide':'' ?>">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('SoftQuote.prepay_panalty_other',array('label' => false,'div' => false, 'class' => 'form-control', 'placeholder' => 'Other Pre-payment Penalty', 'value'=>isset($sqd['SoftQuote']['other_pre_payment'])?$sqd['SoftQuote']['other_pre_payment'].'%':'')); ?>
                </div>
            
                <div class="form-group col-lg-4">
                    <label>Borrower Vesting</label>
                    <?php
                    $bv = $this->Common->getBrrowerVesting();
                    $vesting = isset($sqd['SoftQuote']['borrower_vesting'])?$sqd['SoftQuote']['borrower_vesting']:'';
                    echo $this->Form->input('DocOrderForm.borrower_vesting', array('label' => false,'div' => false, 'class' => 'form-control bvasting', 'options'=>$bv, 'selected'=>$vesting)); ?>
                </div>
                <div class="form-group col-lg-4 bv_other <?php echo ($vesting != 'other')?'hide':'' ?>">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('DocOrderForm.borrower_vesting_other', array('label' => false,'div' => false, 'class' => 'form-control', 'placeholder'=>'Other Borrower Vesting', 'value'=>(isset($arrDocOrder['DocOrderForm']['borrower_vesting_other']) && !empty($arrDocOrder['DocOrderForm']['borrower_vesting_other']))?$arrDocOrder['DocOrderForm']['borrower_vesting_other']:'')); ?>
                </div>
           
                <div class="form-group col-lg-4">
                    <label>Requested Signing Date </label>
                    <?php
                    echo $this->Form->input('DocOrderForm.req_signing_date', array('type'=>'text', 'label' => false,'div' => false, 'class' => 'form-control date', 'placeholder'=>'Pick a date', 'value'=>(isset($arrDocOrder['DocOrderForm']['req_signing_date']) && !empty($arrDocOrder['DocOrderForm']['req_signing_date']))?date('m-d-Y', strtotime($arrDocOrder['DocOrderForm']['req_signing_date'])):'')); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Requested Signing Time</label>
                    <div class="bootstrap-timepicker">
                        <?php echo $this->Form->input('DocOrderForm.req_signing_time', array('type'=>'text',  'label' => false,'div' => false, 'class' => 'form-control timepicker', 'value'=>(isset($arrDocOrder['DocOrderForm']['req_signing_time']) && !empty($arrDocOrder['DocOrderForm']['req_signing_time']))?$arrDocOrder['DocOrderForm']['req_signing_time']:'')); ?>
                        <i class="fa fa-icon-time"></i>
                    </div>                    
                </div>
                <div class="form-group col-lg-4">
                    <label>Name of Title Insurer</label>
                    <?php echo $this->Form->input('Review.insurer_name',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($reviews['insurer_name']) && !empty($reviews['insurer_name']))?$reviews['insurer_name']:'', 'readonly'=>true)); ?>
                </div>
            
                <div class="form-group col-lg-4">
                    <label>Address of Title Insurer </label>
                    <?php echo $this->Form->input('Review.insurer_address',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($reviews['insurer_address']) && !empty($reviews['insurer_address']))?$reviews['insurer_address']:'', 'readonly'=>true)); ?>
                </div>
                      
                <div class="form-group col-lg-4">
                    <label>Name of Title Officer</label>
                    <?php echo $this->Form->input('Review.title_officer_name',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($reviews['title_officer_name']) && !empty($reviews['title_officer_name']))?$reviews['title_officer_name']:'', 'readonly'=>true)); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Title Officer Phone Number</label>
                    <?php echo $this->Form->input('Review.title_officer_phone', array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($reviews['title_officer_phone']) && !empty($reviews['title_officer_phone']))?$reviews['title_officer_phone']:'', 'readonly'=>true)); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Title Officer Email </label>
                    <?php echo $this->Form->input('Review.title_officer_email', array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($reviews['title_officer_email']) && !empty($reviews['title_officer_email']))?$reviews['title_officer_email']:'', 'readonly'=>true)); ?>
                </div>
            
                <div class="form-group col-lg-4">
                    <label>Loan Beneficiary Full Name </label>
                    <?php echo $this->Form->input('DocOrderForm.beneficieary_name',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($arrDocOrder['DocOrderForm']['beneficieary_name']) && !empty($arrDocOrder['DocOrderForm']['beneficieary_name']))?$arrDocOrder['DocOrderForm']['beneficieary_name']:'')); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Lender Vesting</label>
                    <?php echo $this->Form->input('DocOrderForm.lender_vesting',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($arrDocOrder['DocOrderForm']['lender_vesting']) && !empty($arrDocOrder['DocOrderForm']['lender_vesting']))?$arrDocOrder['DocOrderForm']['lender_vesting']:'')); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Loan#</label>
                    <?php
                    echo $this->Form->input('DocOrderForm.loan_no',array('label' => false,'div' => false, 'class' => 'form-control', 'value'=>(isset($loanNumber) && !empty($loanNumber)?$loanNumber:''),'readonly'=>'readonly')); ?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group col-lg-12">
                    <label><strong>ITEMS SUBMITTED WITH THIS FORM</strong>(Please check items submitted with this form and upload forms for the selected items.)</label>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">
                  <?php echo $this->Form->input('DocOrderForm.final_teal',array('type'=>'checkbox', 'label' => false,'div' => false, 'id' => 'final_teal','class'=>'noValidate', 'checked'=>isset($arrDocOrder['DocOrderForm']['final_teal'])?$arrDocOrder['DocOrderForm']['final_teal']:'')); ?>
                  
                  <label for="final_teal"><?php echo $this->Html->link('Final TIL', $this->Html->url( '/', true ).'app/webroot/files/pdf/TIL/TIL_'.$loanID.'.pdf', array('class' => 'button','target'=>'_blank')); ?></label>
                </div>
                <div class="col-lg-3">
                  <?php echo $this->Form->input('DocOrderForm.final_gfe',array('class'=>'noValidate','type'=>'checkbox', 'label' => false,'div' => false, 'id' => 'final_gfe', 'checked'=>isset($arrDocOrder['DocOrderForm']['final_gfe'])?$arrDocOrder['DocOrderForm']['final_gfe']:'')); ?>
                  <label for="final_gfe"><?php echo $this->Html->link('Final GFE', $this->Html->url( '/', true ).'app/webroot/files/pdf/GFE/GFE_'.$loanID.'.pdf', array('class' => 'button','target'=>'_blank')); ?></label>
                </div>
                <div class="col-lg-3">
                  <?php echo $this->Form->input('DocOrderForm.final_1003',array('class'=>'noValidate','type'=>'checkbox', 'label' => false,'div' => false, 'id' => 'final_1003', 'checked'=>isset($arrDocOrder['DocOrderForm']['final_1003'])?$arrDocOrder['DocOrderForm']['final_1003']:'')); ?>
                  <label for="final_1003"><?php echo $this->Html->link('Final 1003', $this->Html->url( '/', true ).'app/webroot/files/pdf/1003/1003_'.$loanID.'.pdf', array('class' => 'button','target'=>'_blank')); ?></label>
                </div>
                <div class="col-lg-3">
                  <?php echo $this->Form->input('DocOrderForm.doc_order',array('class'=>'noValidate','type'=>'checkbox', 'label' => false,'div' => false, 'id' => 'doc_order', 'checked'=>isset($arrDocOrder['DocOrderForm']['doc_order'])?$arrDocOrder['DocOrderForm']['doc_order']:'')); ?>
                  <label for="doc_order">Final TIL</label>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-12">
                    <label></label>
                    <?php echo $this->element('common/file_upload'); ?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-12">
                    <label><strong>Rockland Commercial Broker Fees</strong></label>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Lender Fees</label>
                    <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('SoftQuote.lender_fees', array('type'=>'text', 'label' => false,'div' => false, 'class' => 'form-control decimalOnly', 'value'=>isset($sqd['SoftQuote']['lender_fees'])?$sqd['SoftQuote']['lender_fees']:'')); ?>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>Rockland Commercial Origination Fees</label>
                    <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('SoftQuote.origination_fee', array('type'=>'text', 'label' => false,'div' => false, 'class' => 'form-control decimalOnly', 'value'=>isset($sqd['SoftQuote']['origination_fee'])?$sqd['SoftQuote']['origination_fee']:'')); ?>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>Broker Fees</label>
                    <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('SoftQuote.borker_fees', array('type'=>'text', 'label' => false,'div' => false, 'class' => 'form-control decimalOnly', 'value'=>isset($sqd['SoftQuote']['borker_fees'])?$sqd['SoftQuote']['borker_fees']:'')); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Rockland Commercial Processing Fees</label>
                    <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('SoftQuote.processing_fee', array('type'=>'text', 'label' => false,'div' => false, 'class' => 'form-control decimalOnly', 'value'=>isset($sqd['SoftQuote']['processing_fee'])?$sqd['SoftQuote']['processing_fee']:'')); ?>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>Other Fees</label>
                    <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('SoftQuote.other_fees', array('type'=>'text', 'label' => false,'div' => false, 'class' => 'form-control decimalOnly', 'value'=>isset($sqd['SoftQuote']['other_fees'])?$sqd['SoftQuote']['other_fees']:'')); ?>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-12">            
                    <div class="col-lg-2 col-lg-offset-10">
                        <?php
                        echo $this->Form->button('Submit Doc Order Form', array('type' => 'submit','class' => 'btn btn-primary btn-cons sumitButton', 'div'=>false, 'label'=>false, 'id'=>'savedof'));
                        if(!empty($arrDocOrder)) {
                            echo '&nbsp;&nbsp;';
                            echo $this->Form->button('Submit Doc Order Form', array('type' => 'submit','class' => 'btn btn-primary btn-cons sumitButton', 'div'=>false, 'label'=>false, 'id'=>'savedof'));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </div>
 <?php echo $this->Form->end(); ?>
</div>	
    </div>
    
<!-- END PAGE --> 
<script type="text/javascript">
    jQuery('.prepay_gi').click(function(){
        
        if(jQuery(this).val()=='1') {
            
            jQuery('.prepay').removeClass('hide');
        } else {
            
            jQuery('.prepay').addClass('hide');
        }
    });
    
    jQuery('.ppi').change(function() {
        
        if(jQuery(this).val()=='9') {
            
            jQuery('.ppio').removeClass('hide');
        } else {
            
            jQuery('.ppio').addClass('hide');
        }
    });
    
    jQuery('.pp_penalty').change(function() {
        
        if(jQuery(this).val()=='6') {
            
            jQuery('.ppp_other').removeClass('hide');
        } else {
            
            jQuery('.ppp_other').addClass('hide');
        }
    });
    
    jQuery('.bvasting').change(function() {
        
        if(jQuery(this).val()=='other') {
            
            jQuery('.bv_other').removeClass('hide');
        } else {
            
            jQuery('.bv_other').addClass('hide');
        }
    });
    
    jQuery('.loan_term').change(function() {
        
        if(jQuery(this).val()=='6') {
            
            jQuery('.loan_term_other').removeClass('hide');
        } else {
            
            jQuery('.loan_term_other').addClass('hide');
        }
    });
</script>