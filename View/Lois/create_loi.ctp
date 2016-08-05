<div class="page-content"> 
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="content">
    <div class="row"  id="inbox-wrapper">
    <div class="col-md-12">
    <div class="row">
    <div class="col-md-12">
    <div class="grid simple" >
    <div class="no-border email-body" >
    <br>
    <div class="row-fluid" >
        <div class="row-fluid dataTables_wrapper">
            <h2 class=" inline">Letter of Intent (LOI)</h2>
            <div class="clearfix"></div>
        </div>

        <div class="grid-body ">
        <?php
            echo $this->Form->create('Loi', array('url' => array('controller' => 'commons', 'action' => 'create_loi'),'novalidate' => true,'id'=>'trustDeedForm','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data'));
            
            ?>
            <div class="co
            l-lg-12">
                <div class="form-group col-lg-4">
                    <label>Loan Amount</label>
                    <?php echo $this->Form->input('loan_amount',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('1'=>'1st TD Loan', '2'=>'2nd TD Loan'), 'id'=>'loan_amount')); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Lien Position</label>
                    <?php echo $this->Form->input('lien_position',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('1'=>'1st Trust Deed Notice','2'=>'2nd Trust Deed Notice','other'=>'Other'), 'id'=>'lien_position'));
                    ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('lien_position_other',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Position','class' => 'form-control','type' => 'text','id'=>'lien_position_other')); ?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Interest Rate</label>
                    <?php echo $this->Form->input('lien_position_other',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text','id'=>'lien_position_other')); ?>   
                </div>
                <div class="form-group col-lg-4" style="display: none;">
                    <label>Terms</label>
                    <?php //echo $this->Form->input('lt_other',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term','class' => 'form-control','type' => 'text','id'=>'lt_other'));?>
                </div>
                <div class="form-group col-lg-4" style="display: none;">
                    <label>Interest Only</label>
                    <?php //echo $this->Form->input('lt_other',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term','class' => 'form-control','type' => 'text','id'=>'lt_other'));?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Pre-payment Terms</label>
                    <?php echo $this->Form->input('pre_pay_terms',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('3m-gi'=>'3-months Guaranteed Interest','6m-gi'=>'6-months Guaranteed Interest','9m-gi'=>'9-months Guaranteed Interest','12m-gi'=>'12-months Guaranteed Interest','3m-ppp'=>'3-Months Pre-payment Penalty','6m-ppp'=>'6-Months Pre-payment Penalty','9m-ppp'=>'9-Months Pre-payment Penalty','12m-ppp'=>'12-Months Pre-payment Penalty','other'=>'Other'), 'id'=>'pre_pay_terms')); ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('ppt_other',array('label' => false,'div' => false, 'placeholder' => 'Other Pre-payment Terms','class' => 'form-control','type' => 'text','id'=>'ppt_other'));?>
                </div>
                
            </div>

            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Pre-payment</label>
                    <?php
                    echo $this->Form->input('pre_payment',array('label' => false,'div' => false,'class' => 'form-control','options' => array('1'=>'1.00%','2'=>'2.00%','3'=>'3.00%', '6-mi'=>'6-Months Interest', '12-mi'=>'12-Months Interest', 'other'=>'Other'), 'id'=>'entitlement_todate'));?>
                </div>
                <div class="form-group col-lg-4" style="display: none;">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('pre_pay_other',array('label' => false,'div' => false, 'placeholder' => 'Other Pre-payment','class' => 'form-control','type' => 'text','id'=>'pre_pay_other')); ?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4 radio_btn">
                    <label>Junior Financing Allowed</label>
                    <?php $jfaOptions = array('0'=>'No', '1'=>'Yes');
                    echo $this->Form->radio('junior_fin_allowed', $jfaOptions, array('id'=>'junior_fin_allowed', 'legend'=>false));
                    ?>
                </div>
            </div>
            
            <div class="col-lg-12">                
                <div class="form-group col-lg-4">
                    <label>Closing Time(Business Days)</label>
                    <?php echo $this->Form->input('closing_time',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text','id'=>'ltv'));?>  
                </div>
                
                <?php /*
                <div class="form-group col-lg-4">
                    <label>LTV</label>
                    <?php echo $this->Form->input('ltv',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text','id'=>'ltv'));?>  
                </div> */ ?>
            </div>
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Origination Fee</label>
                    <div class="col-sm-12 input-group">                        
                        <?php echo $this->Form->input('monthly_rental_income',array('label' => false,'div' => false, 'placeholder' => 'Monthly Rental Income','class' => 'form-control','type' => 'text','id'=>'monthly_rental_income')); ?>
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>Processing Fees</label>
                    <div class="col-sm-12 input-group">
                        <span class="input-group-addon">$</span>
                        <?php echo $this->Form->input('monthly_rental_income',array('label' => false,'div' => false, 'placeholder' => 'Monthly Rental Income','class' => 'form-control','type' => 'text','id'=>'monthly_rental_income')); ?>                        
                    </div>
                </div>
            </div>
            
            
        </div>
    </div> 
    </div>
        <div class="col-lg-12">
            <div class="form-group col-lg-6"></div>
            <div class="form-group col-lg-6">
                <div class="col-lg-5"></div>
                <div class="col-lg-12">
                    <label>&nbsp;</label>
                    <?php
                    //if(isset($trustDeedId) && empty($trustDeedId)) {
                        
                        echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));   
                    /*} else {
                        
                        echo $this->Form->hidden('id');
                        echo $this->Form->button('Update', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));
                        
                        echo $this->Html->link('Preview', array('controller'=>'commons', 'action'=>'trust_deed', base64_encode('preview')), array('target' => 'blink;', 'class'=>'btn btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false));
                        
                        echo $this->Html->link('Final Publish', array('controller'=>'commons', 'action'=>'trust_deed', base64_encode('publish')), array('class'=>'btn btn-primary btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false));                           
                    }*/
                    ?>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>							
    </div>
    </div>	
    </div>
    </div>
    </div>	
    </div>		
</div>
<!-- END PAGE --> 
</div>

<script>

    $('#loan_term').on('change', function(){
        
        if($(this).val()=='other') {
            
            $('#lt_other').parent('div').show();
        } else {
            
            $('#lt_other').parent('div').hide();
        }
    });
    
    $('#entitlement_todate').on('change', function(){
        
        if($(this).val()=='SCS') {
            
            $('#scs_amount').parent('div').parent('div').show();
        } else {
            
            $('#scs_amount').parent('div').parent('div').hide();
        }
    });
    
    $('#exit_strategy').on('change', function(){
        
        if($(this).val()=='other') {
            
            $('#exit_strategy_other').parent('div').show();
        } else {
            
            $('#exit_strategy_other').parent('div').hide();
        }
    });
    
    if($('#exit_strategy').val()=='other') {
        
        $('#exit_strategy_other').parent('div').show();
    }
    
    //On edit - show selected value
    
    if($('#loan_term').val()=='other') {
        
        $('#lt_other').parent('div').show();
    }
   // alert($('#entitlement_todate').val());
    if($('#entitlement_todate').val()=='SCS') {
        
        $('#scs_amount').parent('div').parent('div').show();
    }
    
    if($('#exit_strategy').val()=='other') {
        
        $('#exit_strategy_other').parent('div').show();
    }
    
</script>