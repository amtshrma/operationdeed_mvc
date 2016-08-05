<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Short App Detail</h4>
</div>

<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="form-group">
            <h3><?php echo date("jS F, Y", strtotime($data['ShortApplication']['created'])); ?></h3>
            <span class="semi-bold">Borrower Information</span>
             <p><?php echo $data['ShortApplication']['applicant_first_name']. ' '. $data['ShortApplication']['applicant_last_name'] ; ?> </p>
              <p><?php echo $data['ShortApplication']['applicant_email_ID']; ?> </p>
              <?php if(!empty($data['ShortApplication']['applicant_company_name'])) { echo '<p>Company : '.$data['ShortApplication']['applicant_company_name']. '</p>'; }?>
              <p><?php echo $data['ShortApplication']['applicant_phone']; ?> </p>
        </div>
         <div class="form-group">
            <span class="semi-bold">Property Information</span>
             <?php
                $propertyState = $data['ShortApplication']['property_state'];
                $propertyCity= $data['ShortApplication']['property_state'];
                $state = $this->Common->getStateName($propertyState);
                $city = $this->Common->getCityName($propertyCity);
                $tempPropertyType = $data['ShortApplication']['property_type'];
                if(!empty($propertyTypes[$tempPropertyType])) {
                    $propertyType =  $propertyTypes[$tempPropertyType];
                    
                }else {
                    $propertyType =  "--";
                }
               ?> 
                <p><?php echo $data['ShortApplication']['property_name']; ?></p>
                 <p>Property Type : <?php echo $propertyType; ?> </p>
                <p>Property Address : <?php echo $state .', '. $city ; ?> </p>
        </div>
        <div class="form-group">
            <span class="semi-bold">Loan Information</span>
            <?php $tempLoanType = $data['ShortApplication']['loan_type'];
                  $tempLoanReason = $data['ShortApplication']['loan_reason'];
                  $tempLoanAmount = $data['ShortApplication']['loan_amount'];
                  $tempLoanToValue = $data['ShortApplication']['loan_to_value'];
                  
                if(!empty($loanTypes[$tempLoanType])) {
                    $loanType =  $loanTypes[$tempLoanType];
                    
                }else {
                    $loanType =  "--";
                }
                if(!empty($loanReasons[$tempLoanReason])) {
                    $loanReason =  $loanReasons[$tempLoanReason];
                    
                }else {
                    $loanReason =  "--";
                } 
                if(!empty($loanAmounts[$tempLoanAmount])) {
                    $loanAmount =  $loanAmounts[$tempLoanAmount];
                    
                }else {
                    $loanAmount =  "--";
                }
                if(!empty($approxLoanValues[$tempLoanToValue])) {
                    $loanToValue =  $approxLoanValues[$tempLoanToValue];
                    
                }else {
                    $loanToValue =  "--";
                }
                ?>
            <p>Loan type : <?php echo $loanType; ?> </p>
            <p>Reason for loan : <?php echo $loanReason;?> </p>
            <p>Loan Amount :  <?php echo $loanAmount;?></p>
            <p>Apx. loan to value :  <?php echo $loanToValue;?></p>
            <p>Objective : <?php echo $data['ShortApplication']['loan_objective']; ?> </p>
        </div>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
<!-- Modal End -->