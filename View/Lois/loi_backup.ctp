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
            echo $this->Form->create('TrustDeed', array('url' => array('controller' => 'commons', 'action' => 'trust_deed'),'novalidate' => true,'id'=>'trustDeedForm','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data'));
            
            ?>
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Trust Deed Position</label>
                    <?php echo $this->Form->input('trustdeed_position',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('1'=>'1st TD Loan', '2'=>'2nd TD Loan'), 'id'=>'first_td_loan'));?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Note Rate</label>
                    <div class="col-sm-12 input-group">
                        <?php echo $this->Form->input('note_rate',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text','id'=>'note_rate'));?>
                        <span class="input-group-addon">%</span>
                    </div>
                    <span class="err_note_rate"></span>
                </div>
                <div class="form-group col-lg-4">
                    <label>Pre-pay</label>
                    <?php echo $this->Form->input('pre_pay',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('3'=>'3-months Guaranteed Interest','6'=>'6-months Guaranteed Interest','9'=>'9-months Guaranteed Interest','12'=>'3-months Guaranteed Interest'), 'id'=>'pre_pay'));
                    ?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Loan Term</label>
                    <?php echo $this->Form->input('loan_term',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('3'=>'3-months','6'=>'6-months','12'=>'12-months','24'=>'24-months','other'=>'other'), 'id'=>'loan_term'));?>  
                </div>
                <div class="form-group col-lg-4" style="display: none;">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('lt_other',array('label' => false,'div' => false, 'placeholder' => 'Other Loan Term','class' => 'form-control','type' => 'text','id'=>'lt_other'));?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Transaction Type</label>
                    <?php echo $this->Form->input('trans_type',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('purchase'=>'Purchase','ref_rate_n_term'=>'Refinance Rate & Term','ref_cash_out'=>'Refinace Cash-Out'), 'id'=>'trans_type'));?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Purchase Price</label>
                    <div class="col-sm-12 input-group">
                        <span class="input-group-addon">$</span>
                        <?php echo $this->Form->input('purchase_price',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text','id'=>'purchase_price'));?>
                    </div>
                    <span class="err_purchase_price"></span>
                </div>
                
            </div>

            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Entitlements To Date</label>
                    <?php echo $this->Form->input('entitlement_todate',array('label' => false,'div' => false, 'selected' => 'Not Applicable','class' => 'form-control','options' => array('NA'=>'Not Applicable','SCS'=>'Soft Costs Spent'), 'id'=>'entitlement_todate'));?>
                </div>
                <div class="form-group col-lg-4" style="display: none;">
                    <label>&nbsp;</label>
                    <div class="col-sm-12 input-group">
                        <span class="input-group-addon">$</span>
                        <?php echo $this->Form->input('scs_amount',array('label' => false,'div' => false, 'placeholder' => 'Soft Costs Spent','class' => 'form-control','type' => 'text','id'=>'scs_amount'));?>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Total Cost To Date</label>
                    <div class="col-sm-12 input-group">
                        <span class="input-group-addon">$</span>
                        <?php echo $this->Form->input('cost_to_date',array('label' => false,'div' => false, 'placeholder' => 'Total Cost To Date','class' => 'form-control','type' => 'text','id'=>'cost_to_date'));?>
                    </div>
                    <span class="err_cost_to_date"></span>
                </div>
                <div class="form-group col-lg-4">
                    <label>Requested Loan Amount</label>
                    <div class="col-sm-12 input-group">
                        <span class="input-group-addon">$</span>
                        <?php echo $this->Form->input('req_loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Requested Loan Amount','class' => 'form-control','type' => 'text','id'=>'req_loan_amount'));?>
                    </div>
                    <span class="err_req_loan_amount"></span>
                </div>
                <div class="form-group col-lg-4">
                    <label>LTV</label>
                    <?php echo $this->Form->input('ltv',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control','type' => 'text','id'=>'ltv'));?>  
                </div> 
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Property Type</label>
                    <?php echo $this->Form->input('property_type',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('sfr'=>'SFR','multifamily'=>'Multifamily','retail_neighborhood'=>'Retail Neighborhood','retail_single_tenant'=>'Retail Single Tenant','retail_strip_center'=>'Retail Strip Center','office'=>'Office','industrial'=>'Industrial','land'=>'Land'), 'id'=>'property_type'));?>
                </div>
            </div>
            
            <div class="col-lg-12">                
                <div class="form-group col-lg-12">
                    <label>Property Description</label>                    
                </div>
            </div>
            
            <div class="col-lg-12">                
                <div class="form-group col-lg-3">
                    <label># of Units</label>
                    <?php echo $this->Form->input('no_of_units',array('label' => false,'div' => false, 'placeholder' => '# of Units','class' => 'form-control','type' => 'text','id'=>'no_of_units'));?> 
                </div>
                <div class="form-group col-lg-3">
                    <label>Bed</label>
                    <?php echo $this->Form->input('bed',array('label' => false,'div' => false, 'placeholder' => 'Bed','class' => 'form-control','type' => 'text','id'=>'bed'));?> 
                </div>
                <div class="form-group col-lg-3">
                    <label>Bath</label>
                    <?php echo $this->Form->input('bath',array('label' => false,'div' => false, 'placeholder' => 'Bath','class' => 'form-control','type' => 'text','id'=>'bath'));?> 
                </div>
                <div class="form-group col-lg-3">
                    <label>Year Built</label>
                    <?php echo $this->Form->input('year_built',array('label' => false,'div' => false, 'placeholder' => 'Year Built','class' => 'form-control input_mask_year','type' => 'text','id'=>'year_built'));?> 
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-3">
                    <label>Sq. Ft. Structure</label>
                    <?php echo $this->Form->input('sq_ft_structure',array('label' => false,'div' => false, 'placeholder' => 'Sq. Ft. Structure','class' => 'form-control','type' => 'text','id'=>'sq_ft_structure'));?> 
                </div>
                <div class="form-group col-lg-3">
                    <label>Sq. Ft. Lot</label>
                    <?php echo $this->Form->input('sq_ft_lot',array('label' => false,'div' => false, 'placeholder' => 'Sq. Ft. Lot','class' => 'form-control','type' => 'text','id'=>'sq_ft_lot'));?> 
                </div>
                <div class="form-group col-lg-3">
                    <label>Occupancy type</label>
                     <?php echo $this->Form->input('occupancy_type',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('1'=>'Non-Owner','2'=>'owner'), 'id'=>'occupancy_type'));?> 
                </div>
                <div class="form-group col-lg-3">
                    <label>Monthly Rental Income</label>
                    <div class="col-sm-12 input-group">
                        <span class="input-group-addon">$</span>
                        <?php echo $this->Form->input('monthly_rental_income',array('label' => false,'div' => false, 'placeholder' => 'Monthly Rental Income','class' => 'form-control','type' => 'text','id'=>'monthly_rental_income')); ?> 
                    </div>                    
                </div>
            </div>
            
            <div class="col-lg-12">                
                
                <div class="form-group col-lg-4">
                    <label>Borrower Entity Type</label>
                    <?php echo $this->Form->input('borrower_entity_type',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('individual'=>'Individual','ltd-liabiity-company'=>'Limited Liabiity Company','ltd-partnership'=>'Limited Partnership','corporation'=>'Corporation','trust'=>'Trust'), 'id'=>'borrower_entity_type'));?> 
                </div>
                <div class="form-group col-lg-4">
                    <label>Personal Guarantor Fico</label>
                    <?php echo $this->Form->input('personal_guarantor',array('label' => false,'div' => false, 'placeholder' => 'Personal Guarantor Fico','class' => 'form-control','type' => 'text','id'=>'personal_guarantor'));?> 
                </div>
                <div class="form-group col-lg-4">
                    <label>Occupation of Guarantor</label>                    
                    <?php echo $this->Form->input('occupation_guarantor',array('label' => false,'div' => false, 'placeholder' => 'Occupation of Guarantor','class' => 'form-control','type' => 'text','id'=>'occupation_guarantor'));?> 
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Exit Strategy</label>
                    <?php echo $this->Form->input('exit_strategy',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control','options' => array('refinance'=>'Refinance','cosntruction-loan'=>'Cosntruction Loan','sale-of-property'=>'Sale of the Property','other'=>'Other'), 'id'=>'exit_strategy'));?> 
                </div>
                <div class="form-group col-lg-4" style="display: none;">
                    <label>&nbsp;</label>
                    <?php echo $this->Form->input('exit_strategy_other',array('label' => false,'div' => false, 'placeholder' => 'Exit Strategy Other','class' => 'form-control','type' => 'text','id'=>'exit_strategy_other'));?> 
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-4">
                    <label>Upload Image of Property #1</label>
                    <?php echo $this->Form->input('TrustDeedUpload.image1',array('type'=>'file', 'label' => false,'div' => false, 'class' => 'form-control', 'id'=>'property_image1'));?> 
                </div>
                <div class="form-group col-lg-4">
                    <label>Upload Image of Property #2</label>
                    <?php echo $this->Form->input('TrustDeedUpload.image2',array('type'=>'file', 'label' => false,'div' => false, 'class' => 'form-control', 'id'=>'property_image2'));?> 
                </div>
                <div class="form-group col-lg-4">
                    <label>Upload Image of Property #3</label>
                    <?php echo $this->Form->input('TrustDeedUpload.image3',array('type'=>'file', 'label' => false,'div' => false, 'class' => 'form-control', 'id'=>'property_image3'));?> 
                </div>
            </div>
        </div><?php  ?>
    </div> 
    </div>
        <div class="col-lg-12">
            <div class="form-group col-lg-6"></div>
            <div class="form-group col-lg-6">
                <div class="col-lg-5"></div>
                <div class="col-lg-12">
                    <label>&nbsp;</label>
                    <?php 
                    if(empty($arrTrustDeed)) {
                        
                        
                        echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));   
                    } else {
                        
                        echo $this->Form->hidden('id');
                        echo $this->Form->button('Update', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false));
                        
                        echo $this->Html->link('Preview', array('controller'=>'commons', 'action'=>'trust_deed', base64_encode('preview')), array('target' => 'blink;', 'class'=>'btn btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false));
                        
                        
                        echo $this->Html->link('Final Publish', array('controller'=>'lois', 'action'=>'loi', base64_encode('publish')), array('class'=>'btn btn-primary btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false));
                        
                        echo $this->Html->link('Preview', array('controller'=>'lois', 'action'=>'loi', base64_encode('preview')), array('class'=>'btn btn-primary btn-cons', 'tabindex'=>'16', 'div'=>false, 'label'=>false));             
                    }
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
