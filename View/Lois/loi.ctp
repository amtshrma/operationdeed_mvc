<?php echo $this->Html->script('loi'); ?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG"> 
        <h3>Letter of Intent (LOI)</h3><hr />
        <?php
			echo $this->Session->flash();
			echo $this->Form->create('Loi', array('novalidate' => true,'id'=>'trustDeedForm','class'=>'form-no-horizontal-spacing'));
			echo $this->Form->input('loanID', array('name'=>"loanID",'type' => 'hidden','value'=>$loanId,'id'=>'loanID'));
            if((!empty($letterOfIntentPdf['Loi']['borrower_upload_loi_pdf']) || !empty($letterOfIntentPdf['Loi']['borrower_signed_pdf'])) && $letterOfIntentPdf['Loi']['condition_satisfied'] != '1' ) {
        ?>
            <div class="col-md-2 col-md-offset-10">
                <input type="button" value="Condition Satisfied" id ="conditionSatisfied" title='Click to Approve' class="btn btn-primary btn-cons"/><br/>
            </div>
            <?php } ?>
        <div class="row">
            <div class="form-group col-lg-4">
                <label>Loan Amount</label>
                <?php
                    $loanAmount = '';
                    if(isset($propertyDetail['ShortApplication']['loan_amount']) && $propertyDetail['ShortApplication']['loan_amount'] != ''){
                        $loanAmount = $propertyDetail['ShortApplication']['loan_amount'];
                    }
                    echo $this->Form->input('loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Loan Amount','class' => 'form-control','type'=>'text','maxlength' => 55, 'value'=>$loanAmount, 'readonly' =>true));?>      
            </div>
            <div class="form-group col-lg-4">
                <label>Lien Position</label>
                   <?php $lienPosition = $this->Common->getLienPositions();
                    $selected = '';
                    if(isset($softQuoteDetail['SoftQuote']['lien_position']) && $softQuoteDetail['SoftQuote']['lien_position'] != ''){
                        $selected = $softQuoteDetail['SoftQuote']['lien_position'];
                    }
                    echo $this->Form->input('lien_position',array('label' => false,'div' => false, 'empty' => 'Lien Position','title' => 'Lien Position','class' => 'form-control otherLoiOption','options'=>$lienPosition,'tabindex'=>'2','maxlength' => 55,'selected'=>$selected,'disabled' =>true));?> 
                
            </div>
            <?php if(isset($softQuoteDetail['SoftQuote']['other_lien_positon']) && $softQuoteDetail['SoftQuote']['other_lien_positon'] != ''){
                $otherLienPosition = $softQuoteDetail['SoftQuote']['other_lien_positon'];
            ?>                    
            <div class="form-group col-lg-4" style="display: none;" id="other_Lien_Position">
                <label class="form-label">Other Lien Position<span class="required"> * </span></label>
                <div class="input-with-icon  right">                                       
                    <i class=""></i>
                    <?php
                        echo $this->Form->input('other_lien_positon',array('label' => false,'div' => false, 'empty' => 'Lien Position','title' => 'Lien Position','class' => 'form-control','type'=>'text','maxlength' => 55, 'value'=>$otherLienPosition, 'disabled' =>true));
                    ?>      
                </div>
            </div>
            <?php } ?>
            <div class="form-group col-lg-4">
                <label>Interest Rate</label>
                 <?php
                $interestRate = '';
                if(isset($softQuoteDetail['SoftQuote']['interest_rate']) && $softQuoteDetail['SoftQuote']['interest_rate'] != ''){
                    $interestRate = $softQuoteDetail['SoftQuote']['interest_rate'];
                }
                echo $this->Form->input('interest_rate',array('label' => false,'div' => false, 'placeholder' => 'Interest Rate','class' => 'form-control','maxlength' => 55,'value'=>$interestRate, 'readonly' =>true));?>
            </div>
            <div class="form-group col-lg-4">
                <label>Loan Term Requested</label>
                <?php $loanTerms = $this->Common->getLoanTerms();
                $loanTermSelected = '';
                if(isset($softQuoteDetail['SoftQuote']['loan_term']) && $softQuoteDetail['SoftQuote']['loan_term'] != '') {
                    if($softQuoteDetail['SoftQuote']['loan_term'] != 0){
                        $loanTermSelected = $softQuoteDetail['SoftQuote']['loan_term'];
                    }else {
                        $loanTermSelected = 'other';
                    }
                }
                echo $this->Form->input('loan_term',array('label' => false,'div' => false, 'empty' => 'Loan Term','class' => 'form-control otherLoiOption','options'=>$loanTerms,'maxlength' => 55,'id'=>'loanTermSelectBox','selected'=>$loanTermSelected, 'disabled' =>true));?>       
            </div>
            <?php if(isset($softQuoteDetail['SoftQuote']['other_loan_term']) && $softQuoteDetail['SoftQuote']['other_loan_term'] != ''){
                $otherTerm = $softQuoteDetail['SoftQuote']['other_loan_term'];
                
                ?>
            <div class="form-group col-lg-4">
                <label>Other Loan Term</label>
                <?php echo $this->Form->input('lt_other',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term','class' => 'form-control','type' => 'text','id'=>'lt_other','value' =>$otherTerm.'-months', 'disabled' =>true));?>
            </div>
            <?php } ?>
            <div class="form-group col-lg-4">
                <label>Interest Only Loan</label><br />
                <?php
                      $radioOption = array('yes' =>'Yes','no' =>'No');
                      $checked ='yes';
                      if(isset($softQuoteDetail['SoftQuote']['other_loan_term']) && $softQuoteDetail['SoftQuote']['other_loan_term'] != ''){
                         $checked = $softQuoteDetail['SoftQuote']['loan_interest_only'];
                      }
                      echo $this->Form->radio('loan_interest_only',$radioOption,array('legend' => false,'label'=>false,'class' => '','value'=>$checked,'hiddenField' =>false,'style'=> "margin-left:12px", 'disabled' =>true));?>
            </div>
            <div class="form-group col-lg-4">
                <label>Monthly Payment</label>
                <?php
                   $monthlyPayment = '';
                      if(isset($softQuoteDetail['SoftQuote']['monthly_payment']) && $softQuoteDetail['SoftQuote']['monthly_payment'] != ''){
                         $monthlyPayment = $softQuoteDetail['SoftQuote']['monthly_payment'];
                      }
                    echo $this->Form->input('monthly_payment',array('label' => false,'div' => false, 'placeholder' => 'Monthly Payment','class' => 'form-control','type' => 'text','value' =>$monthlyPayment, 'readonly' =>true));?>
            </div>
            <div class="form-group col-lg-4">
                <label>Pre-payment Guaranteed Interest</label>
                <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php $paymentInterest = $this->Common->getGuaranteedInterests();
                    $paymentSelected = '';
                      if(isset($softQuoteDetail['SoftQuote']['per_payment_interest']) && $softQuoteDetail['SoftQuote']['per_payment_interest'] != ''){
                        $paymentSelected = $softQuoteDetail['SoftQuote']['per_payment_interest'];
                        
                     } 
                     echo $this->Form->input('per_payment_interest',array('label' => false,'div' => false, 'empty' => 'Pre-payment Guaranteed Interest','options'=>$paymentInterest,'selected'=>$paymentSelected,'class' => 'form-control', 'id'=>'per_payment_interest', 'disabled' =>true));?> 
                </div>
                <span class="err_purchase_price"></span>
            </div>
            <?php if(isset($softQuoteDetail['SoftQuote']['other_pre_payment_interest']) && $softQuoteDetail['SoftQuote']['other_pre_payment_interest'] != ''){
                $otherPaymentInterest= $softQuoteDetail['SoftQuote']['other_pre_payment_interest'] ;
                ?>
            <div class="form-group col-lg-4">
                <div class="form-group"  id="guaranteed_interest">
                    <label class="form-label">Other Pre-payment Guaranteed Interest <span class="required"> * </span></label>
                    <div class="input-with-icon  right">                                       
                        <i class=""></i>
                        <?php
                       
                        echo $this->Form->input('other_pre_payment_interest',array('label' => false,'div' => false, 'placeholder' => 'Other Pre-payment Guaranteed Interest','class' => 'form-control','maxlength' => 55,'value' =>$otherPaymentInterest .'-months', 'disabled' =>true));?> 
                    </div>
                 </div>
           </div>
            <?php
            }
            if(isset($softQuoteDetail['SoftQuote']['pre-payment']) && $softQuoteDetail['SoftQuote']['pre-payment'] != ''){
            $paymentSelected  = $softQuoteDetail['SoftQuote']['pre-payment']
            ?>
            <div class="form-group col-lg-4">
                <label>Pre-payment</label>
               <?php
                     $perPayment = $this->Common->getPrePayments();
                     echo $this->Form->input('pre-payment',array('label' => false,'div' => false, 'empty' => 'Pre-payment','options'=>$perPayment,'class' => 'form-control','id'=>'prePayment','selected'=>$paymentSelected, 'disabled' =>true));?> 
            </div>
            <?php }
            if(isset($softQuoteDetail['SoftQuote']['other_pre_payment']) && $softQuoteDetail['SoftQuote']['other_pre_payment'] != ''){
            $perPaymentValue = $softQuoteDetail['SoftQuote']['other_pre_payment'];
            ?>
           <div class="form-group col-lg-4" id="payment_interest">
                 <label class="form-label">Other Pre-payment </label>
                 <div class="input-with-icon  right">                                       
                     <i class=""></i>
                     <?php
                     echo $this->Form->input('other_pre_payment',array('label' => false,'div' => false, 'empty' => 'Pre-payment','type'=>'text','class' => 'form-control otherLoiOption','maxlength' => 55,'value'=>$perPaymentValue, 'disabled' =>true));?> 
                 </div>
            </div>
            <?php } ?>
            <div class="form-group col-lg-4">
                <label>Junior Financing Allowed</label>
                <div class="col-sm-12 input-group">
                    
                    <?php $radioOption = array('yes' =>'Yes','no' =>'No');
                      $financingChecked ='no';
                      if(isset($softQuoteDetail['SoftQuote']['financing_allowed']) && $softQuoteDetail['SoftQuote']['financing_allowed'] != ''){
                        $financingChecked = $softQuoteDetail['SoftQuote']['financing_allowed'];
                      }
                      echo $this->Form->radio('financing_allowed',$radioOption,array('legend' => false,'label'=>false,'class' => '','value'=> $financingChecked,'hiddenField' =>false,'style'=> "margin-left:12px", 'disabled' =>true));?>
                </div>
                <span class="err_cost_to_date"></span>
            </div>
            <div class="form-group col-lg-4">
                <label>Closing Time (Business Days)</label>
              <?php
              $businessDays = '';
              if(!empty($softQuoteDetail['SoftQuote']['business_days']) && $softQuoteDetail['SoftQuote']['business_days'] != ''){
                 $businessDays = $softQuoteDetail['SoftQuote']['business_days'];
                }
                echo $this->Form->input('business_days',array('label' => false,'div' => false, 'placeholder' => 'Closing Time (Business Days)','type'=>'text','class' => 'form-control','maxlength' => 55, 'value'=>$businessDays, 'disabled' =>true));?>

            </div>
            <div class="form-group col-lg-4">
                <label>Origination Fee</label>
                <?php
                $originationFee = Origination_fee;
                 if(isset($softQuoteDetail['SoftQuote']['origination_fee']) && $softQuoteDetail['SoftQuote']['origination_fee'] != ''){
                 $originationFee = $softQuoteDetail['SoftQuote']['origination_fee'];
                }
                      echo $this->Form->input('origination_fee',array('label'=>false,'div' => false,'class' => 'form-control','placeholder' => 'Origination Fee','type'=>'text', 'value'=>$originationFee,'readonly'=>'readonly'));?>
            </div> 
            <div class="form-group col-lg-4">
                <label>Processing Fees</label>
                 <?php
                 $vall = '0';
                 if(count($loiCondition)){
                    $vall = count($loiCondition);
                 }
                  echo $this->Form->hidden('conditionCount', array('id'=>'conditionCount','value'=>$vall));
                      echo $this->Form->input('processing_fee',array('label'=>false,'div' => false,'class' => 'form-control','placeholder' =>'Processing Fees','type'=>'text','value'=>'$'.Processing_fee,'readonly'=>'readonly'));?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row-fluid">
            <?php if(!empty($loiCondition)){
                echo '<h3>Conditions</h3>';
                foreach($loiCondition as $key => $field) {
                    if(isset($field) && $field != ''){
                        $fieldID = isset($field['LoiCondition']['id'])?$field['LoiCondition']['id']:'';
                        echo $this->Form->hidden('LoiCondition.id.'.$key,array('value' => base64_encode($fieldID)));
                        $formValue = $field['LoiCondition']['condition'];
                        echo  '<div class="form-group col-lg-8">'.$this->Form->input('LoiCondition.condition.'.$key,array('value'=>$formValue,'label' => false,'class' => 'form-control','div' => false,'type' => 'textarea','cols'=>'2','rows'=>'2','style'=>'resize:none;')).'</div>';
                        if($key == 0) {
                            echo $this->Html->link('Add More','javascript:void(0)',array('class'=>'addNewFieldslink'));
                        }
                    }
                }
                echo "<div id= 'adduploader'></div>";
            }else { ?>
                <div class="row-fluid">
                    <h3>Conditions</h3>
                    <span class="help">Click to Add more link to add condition for LOI</span>
                </div>
                <div class="row-fluid">
                    <div class="col-md-8">
                        <?php echo $this->Form->input('LoiCondition.condition.0',array('label' => false,'div' => false, 'style' => 'display:inline-block !important', 'class' => 'form-control','placeholder' => 'Condition','type' => 'textarea','style'=>'resize:none;')); ?>
                    </div>
                    <div class="col-md-4">
                     <?php  echo $this->Html->link('Add More','javascript:void(0)',array('class'=>'addNewFieldslink')); echo "<br/>";?>
                    </div>
                </div>
                 <br/>
                <div id= "adduploader"></div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="col-md-2 col-md-offset-10">
			<label>&nbsp;</label>
              <?php //pr($letterOfIntentPdf);
                     $loanPhase = $this->Common->getDocumentSatus($loanId, 'E');
                      //pr($loanPhase);
                    /*if(!empty($letterOfIntentPdf) && isset($letterOfIntentPdf['Loi']['id'])) {
                         echo $this->Form->hidden('id',array('value'=>$letterOfIntentPdf['Loi']['id']));
                            if(!empty($letterOfIntentPdf['Loi']['id']) && isset($letterOfIntentPdf['Loi']['id']) && $letterOfIntentPdf['Loi']['pdf_name'] != '') {
                             echo $this->Form->button('Update', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));
                            }
                         echo $this->Html->link('Preview', array('controller'=>'lois', 'action'=>'loi', $loanId,base64_encode('preview')), array('target' => '_blank', 'class'=>'btn btn-cons', 'div'=>false, 'label'=>false));
                        
                        if(!empty($letterOfIntentPdf) && isset($letterOfIntentPdf['Loi']['pdf_name']) && $letterOfIntentPdf['Loi']['pdf_name'] != '') {
                            echo $this->Html->link('Flyby Publish', array('controller'=>'lois', 'action'=>'loi', $loanId,base64_encode('publish')), array('class'=>'btn btn-primary btn-cons',  'div'=>false, 'label'=>false));
                        }
                        if(!empty($loanPhase) && $loanPhase == 1){
                              echo $this->Html->link('Final Publish', array('controller'=>'lois', 'action'=>'loi', $loanId,base64_encode('final_publish')), array('class'=>'btn btn-primary btn-cons',  'div'=>false, 'label'=>false));
                        }
                    } else {
                        echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));
                        echo $this->Html->link('Preview', array('controller'=>'lois', 'action'=>'loi', $loanId,base64_encode('preview')), array('target' => '_blank', 'class'=>'btn btn-cons btn-primary', 'div'=>false, 'label'=>false));
                } */
                    //pr($letterOfIntentPdf);
                if(!empty($letterOfIntentPdf) && isset($letterOfIntentPdf['Loi']['id'])) {   
                    if($letterOfIntentPdf['Loi']['borrower_signed_pdf'] == '') {
                        echo $this->Html->link('Final Publish', array('controller'=>'lois', 'action'=>'loi', $loanId, base64_encode('final_publish')), array('class'=>'btn btn-primary btn-cons',  'div'=>false, 'label'=>false));
                    }
                }else {
                    echo $this->Form->button('Flyby Publish', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));
                }
            ?>
			</div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>