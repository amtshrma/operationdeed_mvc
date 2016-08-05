<?php echo $this->Html->script('review');
echo $this->Html->script('jquery.maskMoney.js');
?>
<script>
	jQuery('document').ready(function(){
		jQuery(".maskIncome").maskMoney({allowZero:false, allowNegative:true, defaultZero:false});
	});
</script>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
	<div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
    <h2 class=" inline">Processor Review</h2><hr />
	<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
	<?php 
	   echo $this->Form->create('review', array('novalidate' => true,'id'=>'reviewForm','class'=>'form-no-horizontal-spacing reviewForm'));
	   echo $this->Form->hidden('loanID',array('value' => $loanID,'id'=>'loanID'));
	?>
    <div class="row-fluid" >
        <div class="col-lg-12">
            <div class="form-group col-lg-4">
                <label>Has borrower filed BK</label> <br/>
                <?php
				$checked = 'no';
				 $radioOption = array('yes' =>'Yes','no' =>'No');
				echo $this->Form->radio('bk_filed', $radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'1','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
            </div>
			<div class="form-group col-lg-4">
				<label>How old is BK</label>
					<?php echo $this->Form->input('old_bk',array('label' => false,'div' => false, 'placeholder' => '','tabindex'=>'2','class' => 'form-control noValidate','type' => 'text','id'=>'note_rate','maxlength' => 12));?>
			</div>
			<div class="form-group col-lg-4">
				<label>BK Discharged or Dismissed</label><br/>
				<?php
				$bkOption = array('discharged' =>'Discharged','dismissed' =>'Dismissed');
				$bkchecked = 'dismissed';
			   echo $this->Form->radio('bk_discharged',$bkOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'3','hiddenField' =>false,'style'=> "margin:12px",'value'=>$bkchecked));?>
			</div>
		</div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Is borrower Divorced ?</label><br/>
				<?php
				$radioOption = array('yes' =>'Yes','no' =>'No');
			   echo $this->Form->radio('borrower_divorced',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'4','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
			</div>
			<div class="form-group col-lg-4">
				<label>Divorce Decree ?</label>
				<?php echo $this->Form->input('divorce_decree',array('label' => false,'div' => false, 'placeholder' => 'Divorce Decree','tabindex'=>'5','class' => 'form-control noValidate','type' => 'text','maxlength' => 50));?>
			</div>
			<div class="form-group col-lg-4">
				<label>NOD ?</label><span class="required"> * </span>
				<?php echo $this->Form->input('NOD',array('label' => false,'div' => false, 'placeholder' => 'NOD','tabindex'=>'6','class' => 'form-control','type'=>'text','maxlength' => 50));?>
			</div>
			<div class="form-group col-lg-4">
                  <label>NTS ?</label><span class="required"> * </span>
                  <?php echo $this->Form->input('NTS',array('label' => false,'div' => false, 'placeholder' => 'NTS','tabindex'=>'7','class' => 'form-control','type' => 'text','maxlength' => 50));?>
            </div>
			<div class="form-group col-lg-4">
				<label>Financial Audited ?</label><span class="required"> * </span>
				<?php
				echo $this->Form->input('financial_audited',array('label' => false,'div' => false, 'class' => 'form-control','placeholder'=>'Financial Audited','type'=>'text','maxlength' => 50));?>
			</div>
		</div>
        <div class="col-lg-12">
            <div class="form-group col-lg-4">
				<label>Are Property Taxes Delinquent</label><br/>
				<?php echo $this->Form->radio('taxes_Delinquent',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'4','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
            </div>
        </div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Is there more than one Property Securing Loan</label><br/>
			   
					<?php echo $this->Form->radio('securing_loan',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'4','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
				
			</div>
			<div class="form-group col-lg-4">
				<label>Does the property have an encumberance recorded at this time</label><br/>
					 <?php echo $this->Form->radio('encumberance_record',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'4','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
		
				<span class="err_req_loan_amount"></span>
			</div>
            <div class="form-group col-lg-4">
                <label>Any late payments over 60days in last 12 months</label><br/>
                <?php echo $this->Form->radio('late_payment',$radioOption,array('legend' => false,'label'=>false,'class' => 'maskIncome','tabindex'=>'4','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
            </div>
        </div>
        <div class="col-lg-12">  
			<div class="form-group col-lg-4">
				<label>If yes how many ?</label>
				<?php echo $this->Form->input('late_payment_count',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control noValidate','type' => 'text','maxlength' => 3));?>  
			</div> 
			<div class="form-group col-lg-4">
				<label>Do any of these Payment remain unpaid ?</label><br/>
				 <?php echo $this->Form->radio('unpaid_payment',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'4','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
			</div>
			<div class="form-group col-lg-4">
			   <label>If yes will proceeds of this loan be used to cure delinquency</label><br/>
				<?php echo $this->Form->input('cure_delinquency',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control noValidate','type' => 'text','maxlength' => 100));?>  
			 
		   </div>
        </div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
			   <label>If no source of funds to bring the loan current</label>
			  
			   <?php echo $this->Form->input('source_fund',array('label' => false,'div' => false,'class' => 'form-control noValidate','maxlength' => 50));?>
		   </div>
		</div><hr />
		<h3>Remaining Encumberances</h3>
		<div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Remaining Encumberances</label><span class="required"> * </span><br/>
			   <?php $radioOption = array('yes' =>'Yes','no' =>'No');
			   echo $this->Form->radio('remaining_encumberances',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'4','hiddenField' =>false,'style'=> "margin:12px",'value'=>$checked));?>
			</div> 
			<div class="form-group col-lg-4">
				<label>Position</label><span class="required"> * </span>
				<?php $positions = array('1'=>'1st','2'=>'2nd','3'=>'3rd','4'=>'Other');
					 echo $this->Form->input('position',array('label' => false,'div' => false, 'placeholder' => 'position','options'=>$positions,'class' => 'form-control'));?> 
			</div>
			<div class="form-group col-lg-4"  id="other_position">
				<label>Other Position</label>
				<?php 
					echo $this->Form->input('other_position',array('label' => false,'div' => false, 'Placeholder' => 'Other','class' => 'form-control noValidate','maxlength' => 5));?> 
			</div>
        </div>
		<div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Interest Rate</label>
				<?php echo $this->Form->input('interest_rate',array('label' => false,'div' => false, 'placeholder' => 'Interest Rate','class' => 'form-control','type' => 'text','maxlength' => 6,'value'=>$shortApplicationData['SoftQuote']['interest_rate'], 'readonly' =>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Beneficiary</label><span class="required"> * </span>
				<?php echo $this->Form->input('beneficiary',array('label' => false,'div' => false, 'placeholder' => 'Beneficiary','class' => 'form-control','type' => 'text','maxlength' => 20));?> 
			</div>
		</div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Original Loan Amount</label>
				<?php echo $this->Form->input('loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Original Loan Amount','class' => 'form-control maskIncome','type' => 'text','maxlength' => 12,'value'=>$shortApplicationData['ShortApplication']['loan_amount'], 'readonly' =>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Approximate Principal Balance</label><span class="required"> * </span>
				<?php echo $this->Form->input('principal_balance',array('label' => false,'div' => false, 'placeholder' => 'Approximate Principal Balance','class' => 'form-control maskIncome','type' => 'text','maxlength' => 12));?> 
			</div>
        </div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Monthly Payment</label>
				 <?php echo $this->Form->input('monthly_payment',array('label' => false,'div' => false, 'Placeholder' => 'Monthly Payment','class' => 'form-control maskIncome','maxlength' => 10,'value'=>$shortApplicationData['SoftQuote']['monthly_payment'], 'readonly' =>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Maturity Date</label>
				<?php echo $this->Form->input('maturity_date',array('label' => false,'div' => false, 'placeholder' => 'Maturity Date','class' => 'form-control datepicker','type' => 'text')); ?>           
			</div>
			<div class="form-group col-lg-4">
				<label>Balloon Payment</label><br/>
				<?php 
				 echo $this->Form->radio('balloon_payment',$radioOption,array('legend' => false,'label'=>false,'class' => '','hiddenField' =>false,'style'=> "margin-left:12px",'value'=>$checked));?>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>If Yes Amount</label>
				<?php echo $this->Form->input('balloon_amount',array('label' => false,'div' => false, 'placeholder' => 'Balloon Payment Amount','class' => 'form-control maskIncome noValidate','type' => 'text','maxlength' => 10));?> 
			</div>
        </div><hr />
        <h3>Appraisal</h3>
        <div class="col-lg-12">
            <div class="form-group col-lg-4">
                <label>Fair Market Value</label><span class="required"> * </span>                    
                <?php echo $this->Form->input('fair_market_value',array('label' => false,'div' => false, 'placeholder' => 'Fair Market Value','class' => 'form-control maskIncome','type' => 'text','maxlength' => 10));?> 
            </div>
			<div class="form-group col-lg-4">
				<label>Date of Appraisal</label><span class="required"> * </span>                    
				<?php echo $this->Form->input('date_of_appraisal',array('label' => false,'div' => false, 'placeholder' => 'Date of Appraisal','class' => 'form-control datepicker','type' => 'text'));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Name of Appraiser</label><span class="required"> * </span>
				<?php echo $this->Form->input('appraiser_name',array('label' => false,'div' => false, 'placeholder' => 'Name of Appraiser','class' => 'form-control','type' => 'text','maxlength' => 20));?> 
			</div>
		</div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Relationship of Appraiser to Broker</label><span class="required"> * </span>
				 <?php $positions = array('employee'=>'Employee','agent'=>'Agent','contractor,'=>'Contractor','other'=>'Other');
					echo $this->Form->input('appraiser_relationship',array('label' => false,'div' => false, 'empty' => 'Select One','options'=>$positions,'class' => 'form-control'));?>
			</div>
			<div class="form-group col-lg-4">
				<label>Address of Appraiser</label><span class="required"> * </span>                    
				<?php echo $this->Form->input('appraiser_address',array('label' => false,'div' => false, 'placeholder' => 'Address of Appraiser','class' => 'form-control','type' => 'text','maxlength' => 100));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Description of Property Improvement</label><span class="required"> * </span>                    
				<?php echo $this->Form->input('improvement_description',array('label' => false,'div' => false, 'placeholder' => 'Description of Property Improvement','class' => 'form-control','type' => 'textarea','rows'=>'2'));?> 
			</div>
        </div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Age</label><span class="required"> * </span>
				<?php echo $this->Form->input('age',array('label' => false,'div' => false, 'placeholder' => 'Age','class' => 'form-control maskUnit','type' => 'text','maxlength' => 2));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Sq. Ft.</label><span class="required"> * </span>
				<?php echo $this->Form->input('sq_ft',array('label' => false,'div' => false, 'placeholder' => 'Sq. Ft.','class' => 'form-control','type' => 'text','maxlength' => 8));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Type of Constrution</label><span class="required"> * </span>                    
				<?php echo $this->Form->input('constrution_type',array('label' => false,'div' => false, 'placeholder' => 'Type of Constrution','class' => 'form-control','type' => 'text','maxlength' => 20));?> 
			</div>
		</div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Gross Annual Income</label><span class="required"> * </span>                    
				<?php echo $this->Form->input('gross_income',array('label' => false,'div' => false, 'placeholder' => 'Gross Annual Income','class' => 'form-control maskIncome','type' => 'text','maxlength' => 20));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Estimated Net Annual Income</label><span class="required"> * </span>
				<?php echo $this->Form->input('estimated_income',array('label' => false,'div' => false, 'placeholder' => 'Estimated Net Annual Income','class' => 'form-control maskIncome','type' => 'text','maxlength' => 20));?> 
			</div>
		</div>
        <h3>Escrow</h3><hr />
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Name of Escrow Holder</label>                    
				<?php echo $this->Form->input('holder_name',array('label' => false,'div' => false, 'placeholder' => 'Name of Esrow Holder','class' => 'form-control','type' => 'text','maxlength' => 20, 'value' => $processDetail['escrow_holder_name'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Address of Escrow</label>                    
				<?php echo $this->Form->input('escrow_address',array('label' => false,'div' => false, 'placeholder' => 'Address of Escrow','class' => 'form-control','type' => 'text','maxlength' => 100, 'value' => $processDetail['escrow_address'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Escrow Officer Full Name</label>
				<?php echo $this->Form->input('escrow_officer_name',array('label' => false,'div' => false, 'placeholder' => 'Escrow Officer Full Name','class' => 'form-control','type' => 'text','maxlength' => 20, 'value' => $processDetail['escrow_full_name'],'readonly'=>true));?> 
			</div>
		</div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Escrow Officer Email Address</label>
				<?php echo $this->Form->input('escrow_email',array('label' => false,'div' => false, 'placeholder' => 'Escrow Officer Email Address','class' => 'form-control','type' => 'email','maxlength' => 40, 'value' => $processDetail['escrow_email_address'],'readonly'=>true));?> 
			</div>  
			<div class="form-group col-lg-4">
				<label>Escrow Officer Phone Number</label>                    
				<?php echo $this->Form->input('escrow_phone',array('label' => false,'div' => false, 'placeholder' => 'Escrow Officer Phone Number','class' => 'form-control maskInput','type' => 'text', 'value' => $processDetail['escrow_phone_number'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Anticipated Closing Date</label>
				<?php echo $this->Form->input('closing_',array('label' => false,'div' => false, 'placeholder' => 'Anticipated Closing Date','class' => 'form-control datepicker','type' => 'text', 'value' => $processDetail['closing_date'],'readonly'=>true));?> 
			</div>
        </div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Address of Escrow Holder</label>                    
				<?php echo $this->Form->input('holder_address',array('label' => false,'div' => false, 'placeholder' => 'Address of Escrow Holder','class' => 'form-control','type' => 'text','maxlength' => 100, 'value' => $processDetail['escrow_holder_address'],'readonly'=>true));?> 
			</div>
              
			<div class="form-group col-lg-4">
				<label>Estimated Lender Costs</label>
				<?php echo $this->Form->input('lender_costs',array('label' => false,'div' => false, 'placeholder' => 'Estimated Lender Costs','class' => 'form-control maskIncome','type' => 'text','maxlength' => 8, 'value' => $processDetail['lender_cost'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Estimated Borrower Costs</label>                    
				<?php echo $this->Form->input('borrower_cost',array('label' => false,'div' => false, 'placeholder' => 'Estimated Borrower Costs','class' => 'form-control maskIncome','type' => 'text','maxlength' => 8, 'value' => $processDetail['borrower_cost'],'readonly'=>true));?> 
			</div>
        </div><hr />
        <h3>Title</h3>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Name of Title Insurer</label>                    
				<?php echo $this->Form->input('insurer_name',array('label' => false,'div' => false, 'placeholder' => 'Name of Title Insurer','class' => 'form-control','type' => 'text','maxlength' => 20, 'value' => $processDetail['insurer_name'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Address of Title Insurer</label>
				<?php echo $this->Form->input('insurer_address',array('label' => false,'div' => false, 'placeholder' => 'Address of Title Insurer','class' => 'form-control','type' => 'text','maxlength' => 100, 'value' => $processDetail['insurer_address'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Title Officer Full Name</label>                    
				<?php echo $this->Form->input('title_officer_name',array('label' => false,'div' => false, 'placeholder' => 'Title Officer Full Name','class' => 'form-control','type' => 'text','maxlength' => 20, 'value' => $processDetail['title_officer_name'],'readonly'=>true));?> 
			</div>
		</div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Title Officer Phone Number</label>
				<?php echo $this->Form->input('title_officer_phone',array('label' => false,'div' => false, 'placeholder' => 'Title Officer Phone Number','class' => 'form-control maskInput','type' => 'text', 'value' => $processDetail['title_officer_phone'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Title Officer Email Address</label>                    
				<?php echo $this->Form->input('title_officer_email',array('label' => false,'div' => false, 'placeholder' => 'Title Officer Email Address','class' => 'form-control','type' => 'email','maxlength' => 40, 'value' => $processDetail['title_officer_email'],'readonly'=>true));?> 
			</div>
			<div class="form-group col-lg-4">
				<label>Insurane Policy Amount</label>
				<?php echo $this->Form->input('insurane_policy_amount',array('label' => false,'div' => false, 'placeholder' => 'Insurane Policy Amount','class' => 'form-control maskIncome','type' => 'text','maxlength' => 10, 'value' => $processDetail['insurance_policy_amount'],'readonly'=>true));?> 
            </div>
        </div>
        <div class="col-lg-12">
			<div class="form-group col-lg-4">
				<label>Amount of Premium</label>                    
				<?php echo $this->Form->input('premium_amount',array('label' => false,'div' => false, 'placeholder' => 'Amount of Premium','class' => 'form-control maskIncome','type' => 'text','maxlength' => 10, 'value' => $processDetail['premium_amount'],'readonly'=>true));?> 
			</div>
			<?php
			if($processDetail['endorsements_option'] == 'yes' && array_key_exists("endorsements",$processDetail)){ ?>
			<div class="form-group col-lg-4">
				<label>Endorsements?</label>
				<?php echo $this->Form->input('endorsements',array('label' => false,'div' => false, 'placeholder' => 'Endorsements','class' => 'form-control','type' => 'text','maxlength' => 100, 'value' => $processDetail['endorsements']));
				 ?> 
			</div>
			<?php }
			if($processDetail['borrower_indemnification_option'] == 'yes' && array_key_exists("borrower_indemnification",$processDetail)){ ?>?>
			<div class="form-group col-lg-4">
				<label>Borrower Indemnification ?</label>
				<?php echo $this->Form->input('borrower_indemnification',array('label' => false,'div' => false, 'placeholder' => 'Borrower Indemnification','class' => 'form-control','type' => 'text','maxlength' => 100, 'value' => $processDetail['borrower_indemnification']));?> 
			</div>
			<?php } ?>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-2 col-lg-offset-10">
            <?php 
                echo $this->Form->button('Submit Review', array('type' => 'submit','class' => 'btn btn-primary btn-cons sumitButton', 'div'=>false, 'label'=>false));   
            ?>
        </div>
    </div>
</div>
    <?php echo $this->Form->end(); ?>
</div>	
</div>
<!-- END PAGE --> 
