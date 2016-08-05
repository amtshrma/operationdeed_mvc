<div class="container">
    <!-- Begin of rows -->
    <div class="col-md-6 col-md-offset-3 slide-row">
        <div class="panel-heading">
           <div class="row">
               <div class="col-xs-12">
                <?php echo $this->Session->flash();?> 
                   <div class="text-center"><h2><b>Short App Detail</b></h2></div>
               </div>                        
           </div>
       </div>
    <?php foreach($allApplications as $application) {
        $tempState = $application['ShortApplication']['property_state'];
        $state =  $states[$tempState];
        $tempPropertyType = $application['ShortApplication']['property_type'];
        $propertyType =  $propertyTypes[$tempPropertyType];
        $tempLoanType = $application['ShortApplication']['loan_type'];
        $loanType =  $loanTypes[$tempLoanType];
        $tempLoanReason = $application['ShortApplication']['loan_reason'];
        $loanReason =  $loanReasons[$tempLoanReason];
        $tempLoanAmount = $application['ShortApplication']['loan_amount'];
        $loanAmount =  $loanAmounts[$tempLoanAmount];
        $tempLoanValue = $application['ShortApplication']['loan_to_value'];
        $loanToValue =  $approxLoanValues[$tempLoanValue];
        
        //pr($application);?>
        <div class="slide-row">
            <div class="slide-content">
                <h4><?php echo ucfirst($application['ShortApplication']['property_name']). ' - '.$state. ', '.ucfirst($application['ShortApplication']['property_city']); ?></h4>
            </div>
            <div class="slide-footer">
                <p>Borrower Details</p>
                <p>Name : <?php echo $application['ShortApplication']['applicant_first_name'] . ' '.$application['ShortApplication']['applicant_last_name'];?> </p>
                <p>Email Address : <?php echo $application['ShortApplication']['applicant_email_ID']; ?></p>
                <p><b>Property Type  :</b> <?php echo $propertyType; ?></p>
                <p>Loan Details</p>
                <p><b>Loan Type :</b> <?php echo $loanType; ?></p>
                <p><b>Loan Reason : </b><?php echo $loanReason; ?></p>
                <p><b>Loan Amount : </b><?php echo $loanAmount; ?></p>
                <p><b>Loan Reason : </b><?php echo $loanReason; ?></p>
                <p><b>Apx. Loan to Value  : </b><?php echo $loanToValue; ?></p>
                <p><b>Loan Objective : </b><?php echo $application['ShortApplication']['loan_objective']; ?></p>
            </div>
        </div> 
  <?php } ?>
        <div class="clearfix"></div>
        <ul class="pagination pull-right">
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
        </ul>
   </div>
</div>