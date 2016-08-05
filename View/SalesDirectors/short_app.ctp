<div class="container shortAppcontainer">
    <span class="mb20">
		<h1>Short App</h1>						
	</span>
    <div class="col-xs-12 col-sm-12 col-md-4"><h3 class="mb20">Borrower </h3></div>
    <div class="col-xs-12 col-sm-12 col-md-4"><h3 class="mb20">Loan and Property</h3></div>
    <div class="col-xs-12 col-sm-12 col-md-4"><h3 class="mb20">Broker</h3></div>
   <div class="col-lg-12 lead"></div>
    <section class="col-xs-12 col-sm-6 col-md-12">
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
        
        ?>
		<article class="search-result row">
			
			<div class="col-xs-12 col-sm-12 col-md-4">
                <p>Name : <?php echo $application['ShortApplication']['applicant_first_name'] . ' '.$application['ShortApplication']['applicant_last_name'];?></p>
                <p>Email Address : <?php echo $application['ShortApplication']['applicant_email_ID']; ?></p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4">
				<h3><?php echo ucfirst($application['ShortApplication']['property_name']). ' - '.$state. ', '.ucfirst($application['ShortApplication']['property_city']); ?></h3>
                <p><b>Loan Type :</b> <?php echo $loanType; ?></p>
                <p><b>Loan Reason : </b><?php echo $loanReason; ?></p>
                <p><b>Loan Amount : </b><?php echo $loanAmount; ?></p>
                <p><b>Loan Reason : </b><?php echo $loanReason; ?></p>
                <p><b>Apx. Loan to Value  : </b><?php echo $loanToValue; ?></p>
                <p><b>Loan Objective : </b><?php echo $application['ShortApplication']['loan_objective']; ?></p>
			</div>
            <div class="col-xs-12 col-sm-12 col-md-4">
           <?php if(isset($application['ShortApplication']['broker_ID']) && $application['ShortApplication']['broker_ID'] != ''){
                $userDetail = $this->Common->getUserDetail($application['ShortApplication']['broker_ID']);
                if(!empty($userDetail)) { ?>
                    <p>Name : <?php echo $userDetail['User']['name'];?></p>
                    <p>Email Address : <?php echo $userDetail['User']['email_address']; ?></p>
                    <?php } else {?>
                    <p>N/A</p>
                    <?php }
               }else { 
                 echo "<p>N/A</p>";
                } ?>
			</div>
			<span class="clearfix borda"></span>
		</article>
<?php } ?>
    
	</section>
</div>