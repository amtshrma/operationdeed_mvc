<?php echo $this->Html->script('trust_deed');
echo $this->Html->script('jquery.maskMoney.js');
?>
<script>
jQuery('document').ready(function(){
	jQuery(document).on('focus','.maskIncome',function() {
		jQuery('.maskIncome').maskMoney({allowZero:false, allowNegative:false, defaultZero:true});
	});
});
</script>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-md-12 whiteBG">
        <h3>Trust Deed Flyer</h3><hr />
       <?php echo $this->Form->create('TrustDeed', array('novalidate' => true,'id'=>'trustDeed','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data'));?>
        <div class="col-md-12">
        <?php
            echo $this->Form->hidden('fieldCount',array('value' => '','id'=>'totalfieldCount'));
            $trustDeedID = isset($this->request->data['TrustDeed']['id']) ? $this->request->data['TrustDeed']['id']:'';
            $loanID = isset($loanDetail['Loan']['id']) ? $loanDetail['Loan']['id'] : '';
            echo $this->Form->hidden('TrustDeed.id',array('value' => base64_encode($trustDeedID), 'id' => 'trustDeedId'));
            echo $this->Form->hidden('TrustDeed.loan_id',array('value' => base64_encode($loanID)));
            $readonly = '';
            if(!empty($propertyDetail)){
                $readonly = "readonly";
            }
            ?>
            <div class="form-group col-md-4">
                <label>Trust Deed Position</label>
                <?php echo $this->Form->input('trustdeed_position',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => $this->Common->getTrustDeedPosition(), 'id'=>'first_td_loan','default'=>$propertyDetail['SoftQuote']['lien_position']));?>
            </div>
            <div class="form-group col-md-4">
                <label>Note Rate</label>
                <div class="col-sm-12 input-group">
                    <?php echo $this->Form->input('note_rate',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','value'=>$propertyDetail['SoftQuote']['interest_rate'],'id'=>'note_rate'));?>
                    <span class="input-group-addon">%</span>
                </div>
                <span class="err_note_rate"></span>
            </div>
            <?php
            if(!empty($propertyDetail)) {
                if($propertyDetail['SoftQuote']['per_payment_interest'] == '9') { ?>
                    <div class="form-group col-md-4">
                        <label>Pre-payment Guaranteed Interest - Other</label>
                        <?php echo $this->Form->input('other_pre_pay',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','value' => $propertyDetail['SoftQuote']['other_pre_payment_interest'],'type'=>'text','readonly'=>'readonly')); ?>
                    </div>
            <?php
                }else{?>
                    <div class="form-group col-md-4">
                        <label>Pre-payment Guaranteed Interest</label>
                        <?php echo $this->Form->input('pre_pay',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => $this->Common->getGuaranteedInterests(), 'readonly'=>true,'selected'=>$propertyDetail['SoftQuote']['per_payment_interest']));?>
                    </div>
            <?php
                }
            }else{?>
                <div class="form-group col-md-4">
                    <label>Pre-payment Guaranteed Interest</label>
                    <?php echo $this->Form->input('pre_pay',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => $this->Common->getGuaranteedInterests()));?>
                </div>
        <?php } ?>
        </div>
        <div class="col-md-12">
        <?php
		$selected = '';
        if(!empty($propertyDetail)) {
            if($propertyDetail['SoftQuote']['other_loan_term'] != '') { 
				if($propertyDetail['SoftQuote']['loan_term'] == 0) { 
					$selected = 'other';	
				}
			?>
                <div class="form-group col-md-4">
                    <label>Loan Term</label>
                    <?php echo $this->Form->input('loan_term',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => $this->Common->getLoanTerms(), 'selected'=>$selected,'id'=>'loan_term','disabled'=>true));?>  
                </div>
                <div class="form-group col-md-4">
					<label>Other - Loan Term</label>
                    <?php echo $this->Form->input('lt_other',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term','class' => 'form-control','value'=>$propertyDetail['SoftQuote']['other_loan_term'],'type' => 'text','id'=>'lt_other','readonly'=>'readonly'));?>
                </div>
        <?php
            }
        }else {?>
            <div class="form-group col-md-4">
                <label>Loan Term</label>
                <?php echo $this->Form->input('loan_term',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term','class' => 'form-control','options' => $this->Common->getLoanTerms(),));?>
            </div>
    <?php }?>
        </div>
        <div class="col-md-12">
            <div class="form-group col-md-3">
                <label>Transaction Type</label>
                <?php echo $this->Form->input('trans_type',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' =>$this->Common->getDeedTransactionTypes() , 'id'=>'trans_type'));?>
            </div>
            <div class="form-group col-md-3">
                <label>Purchase Price</label>
                <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('purchase_price',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control maskIncome','value'=>$propertyDetail['PropertyDetail']['LastSaleAmt'],'id'=>'purchase_price','type'=>'text'));?>
                </div>
                <span class="err_purchase_price"></span>
            </div>
            <div class="form-group col-md-3">
                <label>Entitlements To Date</label>
                <?php
                $etdVal = isset($this->request->data['TrustDeed']['entitlement_todate']) ? $this->request->data['TrustDeed']['entitlement_todate']:'';
                echo $this->Form->input('entitlement_todate',array('label' => false,'div' => false, 'selected' => !empty($etdVal)?'Soft Costs Spent':'Not Applicable','class' => 'form-control','options' => array('NA'=>'Not Applicable','SCS'=>'Soft Costs Spent'), 'id'=>'entitlement_todate'));?>
            </div>
			<div class="form-group col-md-3" style="display: none;">
                <label>&nbsp;</label>
                <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('scs_amount',array('label' => false,'div' => false, 'placeholder' => 'Soft Costs Spent','class' => 'form-control maskIncome','type' => 'text','id'=>'scs_amount'));?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group col-md-4">
                <label>Total Cost To Date</label>
                <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php
					echo $this->Form->input('cost_to_date',array('label' => false,'div' => false, 'placeholder' => 'Total Cost To Date','class' => 'form-control maskIncome','value'=>$propertyDetail['PropertyDetail']['AvmPropertyValue'],'id'=>'cost_to_date','type'=>'text'));?>
                </div>
                <span class="err_cost_to_date"></span>
            </div>
            <div class="form-group col-md-4">
                <label>Requested Loan Amount</label>
                <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('req_loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Requested Loan Amount','class' => 'form-control maskIncome','type' => 'text','id'=>'req_loan_amount','value'=>$propertyDetail['ShortApplication']['loan_amount'], $readonly));?>
                </div>
                <span class="err_req_loan_amount"></span>
            </div>
            <div class="form-group col-md-4">
                <label>LTV</label>
                <?php
                $ltv = '';
                if(!empty($propertyDetail)) {
                    
                    $ltv =  $propertyDetail['ShortApplication']['loan_to_value'];
                    
                    echo $this->Form->input('ltv',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text','id'=>'ltv','value' => $ltv, $readonly));
                }?>  
            </div> 
        </div>
        <h3>Property Description</h3><hr />
        <div class="col-md-12">
            <div class="form-group col-md-3">
                <label>Property Type</label>
                <?php
                $selected = '';
                if(!empty($propertyDetail) && $propertyDetail['ShortApplication']['property_type'] != '') {
                    $selected = $propertyDetail['ShortApplication']['property_type']; 
                }else if(isset($this->request->data['TrustDeed']['property_type']) && $this->request->data['TrustDeed']['property_type'] !='') {
                    $selected = $this->request->data['TrustDeed']['property_type']; 
                }
                echo $this->Form->input('property_type',array('type'=>'text','label' => false,'div' => false, 'class' => 'form-control','value' => ucfirst(str_replace('-',' ',$selected))));?>
            </div>
            <div class="form-group col-md-3">
                <label># of Units</label>
                <?php
                $bed = $bath = $yearBuit = $sqFtStructure = $sqFtLot = '0' ;
                if(!empty($propertyDetail)){
                    $noOfUnits = ($propertyDetail['PropertyDetail']['Units']) ? $propertyDetail['PropertyDetail']['Units'] : '0';
                    $bed = ($propertyDetail['PropertyDetail']['Beds']) ? $propertyDetail['PropertyDetail']['Beds'] : '0';
                    $bath = ($propertyDetail['PropertyDetail']['Baths'] = '0.00') ? '0' : $propertyDetail['PropertyDetail']['Baths'];
                    $yearBuit = ($propertyDetail['PropertyDetail']['YearBuilt']) ? $propertyDetail['PropertyDetail']['YearBuilt'] : '0';
                    $sqFtStructure = ($propertyDetail['PropertyDetail']['SqFtStruc']) ? $propertyDetail['PropertyDetail']['SqFtStruc'] : '0';
                    $sqFtLot = ($propertyDetail['PropertyDetail']['SqFtLot']) ? $propertyDetail['PropertyDetail']['SqFtLot'] : '0';
                } 
                echo $this->Form->input('no_of_units',array('label' => false,'div' => false, 'placeholder' => '# of Units','class' => 'form-control','type' => 'text','id'=>'no_of_units','value'=>$noOfUnits, $readonly));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Bed</label>
                <?php
                
                echo $this->Form->input('bed',array('label' => false,'div' => false, 'placeholder' => 'Bed','class' => 'form-control','type' => 'text','id'=>'bed','value' => $bed, $readonly));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Bath</label>
                <?php echo $this->Form->input('bath',array('label' => false,'div' => false, 'placeholder' => 'Bath','class' => 'form-control','type' => 'text','id'=>'bath','value' => $bath, $readonly));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Year Built</label>
                <?php echo $this->Form->input('year_built',array('label' => false,'div' => false, 'placeholder' => 'Year Built','class' => 'form-control input_mask_year','type' => 'text','id'=>'year_built','value' => $yearBuit, $readonly));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Sq. Ft. Structure</label>
                <?php echo $this->Form->input('sq_ft_structure',array('label' => false,'div' => false, 'placeholder' => 'Sq. Ft. Structure','class' => 'form-control','type' => 'text','id'=>'sq_ft_structure','value' => $sqFtStructure, $readonly));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Sq. Ft. Lot</label>
                <?php echo $this->Form->input('sq_ft_lot',array('label' => false,'div' => false, 'placeholder' => 'Sq. Ft. Lot','class' => 'form-control','type' => 'text','id'=>'sq_ft_lot','value' => $sqFtLot, $readonly));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Occupancy type</label>
                 <?php echo $this->Form->input('occupancy_type',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('1'=>'Non-Owner','2'=>'owner'), 'id'=>'occupancy_type'));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Monthly Rental Income</label>
                <div class="col-sm-12 input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo $this->Form->input('monthly_rental_income',array('label' => false,'div' => false, 'placeholder' => 'Monthly Rental Income','class' => 'form-control maskIncome','type' => 'text','id'=>'monthly_rental_income')); ?> 
                </div>                    
            </div>
            <div class="form-group col-md-3">
                <label>Borrower Entity Type</label>
            <?php
        $entitySelected = (!empty($propertyDetail['ShortApplication']['company_select'])) ? $propertyDetail['ShortApplication']['company_select'] : '';
                $selectEntity = array('Individual'=>'Individual','LLC'=>'LLC','LLP'=>'LLP','Trust'=>'Trust','S-Corp'=>'S-Corp','C-Corp'=>'C-Corp');
                echo $this->Form->input('borrower_entity_type',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => $selectEntity, 'selected' => $entitySelected,'id'=>'borrower_entity_type'));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Personal Guarantor Fico</label>
                <?php echo $this->Form->input('personal_guarantor',array('label' => false,'div' => false, 'placeholder' => 'Personal Guarantor Fico','class' => 'form-control','value'=>$propertyDetail['ShortApplication']['fico_score'],'id'=>'personal_guarantor'));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Occupation of Guarantor</label>                    
                <?php echo $this->Form->input('occupation_guarantor',array('label' => false,'div' => false, 'placeholder' => 'Occupation of Guarantor','class' => 'form-control','type' => 'text','id'=>'occupation_guarantor'));?> 
            </div>
            <div class="form-group col-md-3">
                <label>Exit Strategy</label>
                <?php echo $this->Form->input('exit_strategy',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('refinance'=>'Refinance','cosntruction-loan'=>'Cosntruction Loan','sale-of-property'=>'Sale of the Property','other'=>'Other'), 'id'=>'exit_strategy'));?> 
            </div>
            <div class="form-group col-md-3" style="display: none;">
                <label>Other Exit Strategy</label>
                <?php echo $this->Form->input('exit_strategy_other',array('label' => false,'div' => false, 'placeholder' => 'Exit Strategy Other','class' => 'form-control','type' => 'text','id'=>'exit_strategy_other'));?> 
            </div>
        </div>
        <h3>Property Images</h3><hr />
        <div class="col-md-12">
        <?php
            if(!empty($this->request->data['TrustDeedUpload'])){
                foreach($this->request->data['TrustDeedUpload'] as $key => $image){
                    $imageCount = $key + 1;
                    if(isset($image['property_image']) && $image['property_image'] != ''){
                        $trustDeedImageID = isset($image['id'])?$image['id']:'';
                        echo $this->Form->hidden('TrustDeedUpload.id.'.$imageCount,array('value' => base64_encode($trustDeedImageID)));
                        $filePath = BASE_URL."upload/TrustDeedFlyer/".$image['property_image'];
                        echo  '<div class="form-group col-md-4">';
                        echo $this->Html->image($filePath,array('height'=>'100','width'=>'100'));
                        echo '<br/><br/>';
                        echo $this->Form->input('TrustDeedUpload.image'.$imageCount,array('label' => false,'div' => false,'type' => 'file')).'</div>';
                    }
                }
            } else { ?>
                    <div class="form-group col-md-4">
                        <label>Upload Image of Property #1</label>
                        <?php echo $this->Form->input('TrustDeedUpload.image1',array('type'=>'file', 'label' => false,'div' => false, 'class' => 'btn', 'id'=>'property_image1'));?> 
                    </div>
                    <div class="form-group col-md-4">
                        <label>Upload Image of Property #2</label>
                        <?php echo $this->Form->input('TrustDeedUpload.image2',array('type'=>'file', 'label' => false,'div' => false, 'class' => 'btn', 'id'=>'property_image2'));?> 
                    </div>
                    <div class="form-group col-md-4">
                        <label>Upload Image of Property #3</label>
                        <?php echo $this->Form->input('TrustDeedUpload.image3',array('type'=>'file', 'label' => false,'div' => false, 'class' => 'btn', 'id'=>'property_image3'));?> 
                    </div>
            <?php  } ?>
        </div>
        <h3>More Fields</h3>
        <span class="help">Click to Add more link to add fields for Trust Deed Flyer</span>
        <hr/>
        <div class="col-md-12">
        <?php
        if(!empty($this->request->data['TrustDeedField'])){
            foreach($this->request->data['TrustDeedField'] as $key => $field) { 
                if(isset($field['form_label']) && $field['form_label'] != ''){
                    $trustDeedFieldID = isset($field['id'])?$field['id']:'';
                    echo $this->Form->hidden('TrustDeedField.id.'.$key,array('value' => base64_encode($trustDeedFieldID)));
                    $formLabel = $field['form_label'];
                    $formValue = $field['form_value'];
                    echo  '<div class="form-group col-lg-4">'.$this->Form->input('TrustDeedField.FormLabel.'.$key,array('value'=>$formLabel,'label' => false,'class' => 'form-control','div' => false,'type' => 'text')).'</div>';
                    echo  '<div class="form-group col-lg-4">'.$this->Form->input('TrustDeedField.FormField.'.$key,array('value'=>$formValue,'label' => false,'class' => 'form-control','div' => false,'type' => 'text')).'</div>';
                }
            }    
        } else { ?>
            <div class="col-md-4">
                <?php echo $this->Form->input('TrustDeedField.FormLabel.0',array('label' => false,'div' => false, 'style' => 'display:inline-block !important', 'class' => 'form-control noValidate','placeholder' => 'Label')); ?>
            </div>
            <div class="col-md-4">
                <?php echo $this->Form->input('TrustDeedField.FormField.0',array('label' => false,'div' => false, 'style' => 'display:inline-block !important', 'class' => 'form-control noValidate'));  ?> 
            </div>
            <div class="col-md-4">
                <?php  echo $this->Html->link('Add More','javascript:void(0)',array('class'=>'addNewFieldslink')); echo "<br/>";?>
            </div>
            <div id= "adduploader"></div>
            <?php } ?>
        </div>
        <div class="col-md-2 col-md-offset-10">
            <label>&nbsp;</label>
            <?php 
            /*if(!empty($this->request->data['TrustDeed']) && isset($this->request->data['TrustDeed']['id'])) {
                 echo $this->Form->hidden('id',array('value'=>$this->request->data['TrustDeed']['id']));
                    if(!empty($this->request->data['TrustDeed']) && isset($this->request->data['TrustDeed']['pdf_name']) && $this->request->data['TrustDeed']['pdf_name'] != '') {
                     //echo $this->Form->button('Update', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));
                    }
                    echo '&nbsp';
                //echo $this->Html->link('Preview', array('controller'=>'commons', 'action'=>'trust_deed',base64_encode($loanID),base64_encode('preview')), array('target' => 'blank;', 'class'=>'btn btn-cons btn-primary', 'tabindex'=>'16', 'div'=>false, 'label'=>false));
                  echo '&nbsp';
                if(!empty($this->request->data['TrustDeed'])) {
                    echo $this->Html->link('Flyby Publish', array('controller'=>'commons', 'action'=>'trust_deed', base64_encode($loanID),base64_encode('publish')), array('class'=>'btn btn-primary btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false));
                }
                $loanPhase = $this->Common->getDocumentSatus(base64_encode($loanID), 'F');
                if(!empty($loanPhase) && $loanPhase == 1){
                    echo $this->Html->link('Final Publish', 'javascript:void(0)', array('class'=>'btn btn-primary btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false,'id'=>'finalPublishButton'));
                }
            } else {
                echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons sumitButton','tabindex'=>'15', 'div'=>false, 'label'=>false));
            }*/
            $loanPhase = $this->Common->getDocumentSatus(base64_encode($loanID), 'F');
            if(!empty($loanPhase) && $loanPhase == 1){
                echo $this->Html->link('Final Publish', 'javascript:void(0)', array('class'=>'btn btn-primary btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false,'id'=>'finalPublishButton'));
            } else {
                echo $this->Form->button('Flyby Publish', array('type' => 'submit','class' => 'btn btn-primary btn-cons sumitButton','tabindex'=>'15', 'div'=>false, 'label'=>false));
            }
        ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
    
<!-- END PAGE --> 
<style>
    input[type="file"].btn{
        background: #eee;
        color: #000;
    }
</style>
<script>
jQuery('#loan_term').on('change', function(){
    if(jQuery(this).val()=='other') {
        jQuery('#lt_other').parent('div').show();
    } else {
        jQuery('#lt_other').parent('div').hide();
    }
});

jQuery('#entitlement_todate').on('change', function(){
    if(jQuery(this).val()=='SCS') {
        jQuery('#scs_amount').parent('div').parent('div').show();
    } else {
        jQuery('#scs_amount').parent('div').parent('div').hide();
    }
});

jQuery('#exit_strategy').on('change', function(){
    if(jQuery(this).val()=='other') {
        jQuery('#exit_strategy_other').parent('div').show();
    } else {
        jQuery('#exit_strategy_other').parent('div').hide();
    }
});

if(jQuery('#exit_strategy').val()=='other') {
    jQuery('#exit_strategy_other').parent('div').show();
}

//On edit - show selected value

if(jQuery('#loan_term').val()=='other') {
    jQuery('#lt_other').parent('div').show();
}
// alert(jQuery('#entitlement_todate').val());
if(jQuery('#entitlement_todate').val()=='SCS') {
    jQuery('#scs_amount').parent('div').parent('div').show();
}

if(jQuery('#exit_strategy').val()=='other') {
    jQuery('#exit_strategy_other').parent('div').show();
}
</script>