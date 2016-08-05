<?php
    echo $this->Html->script('jquery.maskMoney.js');
?>
<script>
    jQuery(document).ready(function(){
        jQuery('.maskInput').mask('(999) 999-9999');
        jQuery('.maskIncome').maskMoney({allowZero:false, allowNegative:false, defaultZero:true});
        jQuery('.dateInput').datepicker({ format: "mm/dd/yyyy", startDate:new Date()});
    });
</script>
<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Save Required Contacts</h4>
</div>
<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
<?php echo $this->Form->create('LoanReviewer', array('url'=>array('controller'=>'commons','action'=>'approve_document')));
echo $this->Form->input('loanID',array('class'=>'input form-control','type'=>'hidden','value'=>$loanID));
$checked = 'no';
$radioOption = array('yes' =>'Yes','no' =>'No');
?>  
<div class="modal-body">
    <div class="col-md-12" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-6">
                <h4>Escrow Officer</h4>
                <?php echo $this->Form->input('escrow_holder_name',array('class'=>'input form-control','label'=>false,'placeholder'=>'Name of Escrow Holder', 'title'=>'Name of Escrow Holder'));
                echo $this->Form->input('escrow_address',array('class'=>'input form-control','label'=>false, 'placeholder'=>'Address of Escrow','title'=>'Address of Escrow'));
                echo $this->Form->input('escrow_full_name',array('class'=>'input form-control','label'=>false, 'placeholder'=>'Escrow Officer Full Name','title' => 'Escrow Officer Full Name')); 
                echo $this->Form->input('escrow_phone_number',array('class'=>'input form-control maskInput','label'=>false, 'placeholder'=>'Escrow Officer Phone Number', 'title' => 'Escrow Officer Phone Number')); 
                echo $this->Form->input('escrow_email_address',array('class'=>'input form-control','label'=>false, 'placeholder' => 'Escrow Officer Email Address', 'title' => 'Escrow Officer Email Address')); 
                echo $this->Form->input('closing_date',array('class'=>'input form-control dateInput','label'=>false, 'placeholder' => 'Anticipated Closing Date', 'title' => 'Anticipated Closing Date'));
                 echo $this->Form->input('escrow_holder_address',array('class'=>'input form-control','label'=>false, 'placeholder' => 'Address of Escrow Holder', 'title' => 'Address of Escrow Holder')); 
                echo $this->Form->input('lender_cost',array('class'=>'input form-control maskIncome','label'=>false, 'placeholder' => 'Estimated Lender Costs', 'title' => 'Estimated Lender Costs'));
                 echo $this->Form->input('borrower_cost',array('class'=>'input form-control maskIncome','label'=>false, 'placeholder' => 'Estimated Borrower Costs', 'title' => 'Estimated Borrower Costs'));
                ?>
            </div>
            <div class="col-md-6">
               <h4>Title Officer</h4>
                <?php
                echo $this->Form->input('insurer_name',array('class'=>'input form-control','label'=>false, 'placeholder' => 'Name of Title Insurer', 'title' => 'Name of Title Insurer')); 
                echo $this->Form->input('insurer_address',array('class'=>'input form-control','label'=>false, 'placeholder' => 'Address of Title Insurer', 'title' => 'Address of Title Insurer'));
                echo $this->Form->input('title_officer_name',array('class'=>'input form-control','label'=>false, 'placeholder' => 'Title Officer Full Name', 'title' => 'Title Officer Full Name')); 
                echo $this->Form->input('title_officer_phone',array('class'=>'input form-control maskInput','label'=>false, 'placeholder' => 'Title Officer Phone Number', 'title' => 'Title Officer Phone Number'));
                echo $this->Form->input('title_officer_email',array('class'=>'input form-control','label'=>false, 'placeholder' => 'Title Officer Email Address', 'title' => 'Title Officer Email Address')); 
                echo $this->Form->input('insurance_policy_amount',array('class'=>'input form-control maskIncome','label'=>false, 'placeholder' => 'Insurane Policy Amount', 'title' => 'Insurane Policy Amount'));
                echo $this->Form->input('premium_amount',array('class'=>'input form-control maskIncome','label'=>false, 'placeholder' => 'Amount of Premium', 'title' => 'Amount of Premium'));
                echo $this->Form->radio('endorsements_option',$radioOption, array('class'=>'','legend'=>false, 'placeholder' => 'Endorsements','hiddenField' =>false, 'title' => 'Endorsements','value'=>$checked,'style'=> "margin-left:12px"));
                echo $this->Form->input('endorsements', array('class'=>'input form-control noValidate','label'=>false, 'placeholder' => 'Endorsements', 'title' => 'Endorsements','type'=>'textarea','rows'=>'2','style'=>'resize:none'));
                echo $this->Form->radio('borrower_indemnification_option',$radioOption, array('class'=>'','legend'=>false, 'placeholder' => 'Borrower Indemnification','hiddenField' =>false, 'title' => 'Borrower Indemnification','value'=>$checked,'style'=> "margin-left:12px"));
                echo $this->Form->input('borrower_indemnification', array('class'=>'input form-control noValidate','label'=>false, 'placeholder' => 'Borrower Indemnification', 'title' => 'Borrower Indemnification','type'=>'textarea','rows'=>'2','style' =>'resize :none'));
                ?>
            </div>
         </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Sales Broker</h4>
                <?php echo $this->Form->input('sales_agent_name',array('class'=>'input form-control','label'=>false,'placeholder'=>'Agent Name', 'title'=>'Agent Name'));
                echo $this->Form->input('sales_agent_address',array('class'=>'input form-control','label'=>false, 'placeholder'=>'Address of Agent Office','title'=>'Address of Agent Office'));
                echo $this->Form->input('sales_agent_phone',array('class'=>'input form-control maskInput','label'=>false, 'placeholder'=>'Agent Phone Number','title' => 'Agent Phone Number')); 
                echo $this->Form->input('sales_agent_email_adress',array('class'=>'input form-control','label'=>false, 'placeholder'=>' Email Address', 'title' => 'Email Address')); 
                ?>
            </div>
            <div class="col-md-6">
               <h4>Insurance Broker/Agent:</h4>
                <?php
                echo $this->Form->input('insurance_agent_name',array('class'=>'input form-control','label'=>false, 'placeholder' => 'Insurance Agent Name', 'title' => 'Insurance Agent Name')); 
                echo $this->Form->input('insurance_policy_amount',array('class'=>'input form-control maskIncome','label'=>false, 'placeholder' => 'Insurance Policy Amount', 'title' => 'Insurance Policy Amount'));
                echo $this->Form->input('insurance_premium_amount',array('class'=>'input form-control maskIncome','label'=>false, 'placeholder' => 'Amount of Premium', 'title' => 'Amount of Premium')); 
                echo $this->Form->radio('insurance_endorsements_option',$radioOption, array('class'=>'','legend'=>false, 'placeholder' => 'Endorsements', 'title' => 'Endorsements','hiddenField' =>false,'value'=>$checked,'style'=> "margin-left:12px"));
                 echo $this->Form->input('insurance_endorsements',array('class'=>'input form-control noValidate','label'=>false, 'placeholder' => 'Endorsements', 'title' => 'Endorsements','type'=>'textarea','rows'=>'2','style' =>'resize :none'));
                
                echo $this->Form->radio('insurance_borrower_indemnification_option', $radioOption, array('class'=>'','legend'=>false, 'placeholder' => 'Borrower Indemnification', 'title' => 'Borrower Indemnification','hiddenField' =>false,'value'=>$checked,'style'=> "margin-left:12px")); 
                 echo $this->Form->input('insurance_borrower_indemnification',array('class'=>'input form-control noValidate','label'=>false, 'placeholder' => 'Borrower Indemnification', 'title' => 'Borrower Indemnification','type'=>'textarea','rows'=>'2','style' =>'resize :none'))
                ?>
            </div>
         </div>
    </div>   
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-default btn-cons" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit('Submit',array('div'=>false,'class'=>'btn btn-primary btn-cons saveContacts')); ?>
</div>
 <?php echo $this->Form->end();  ?>
<!-- Modal End -->