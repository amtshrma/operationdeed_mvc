<div class="section first">
    <div class=" p-b-60">
    <div class="section dark-grey p-t-20  p-b-20 m-b-50">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Notification</h2>
          </div>
          
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
        <div class="container">
          <div class="row login-container">
            <div class="row column-seperation">
                    <div class="col-lg-12">
                      <span class="help"></span>
                    </div>
                    <div class="col-lg-6 col-md-offset-2">
                        <?php
                        $quoteID =  $data['SoftQuote']['id'];
                        $lienPositions = $this->Common->getSoftQuoteLien($quoteID);
                        $prePayments = $this->Common->getSoftQuotePerPayment($quoteID);
                        $prePaymentName = $this->Common->getSoftQuotePrePayment($quoteID);
                        $loanTerm = $this->Common->getSoftQuoteloanTerm($quoteID);
                        $propertyState = $data['ShortApplication']['property_state'];
                        $propertyCity = $data['ShortApplication']['property_city'];
                        $state = $this->Common->getStateName($propertyState);
                        $city = $this->Common->getCityName($propertyCity);
                       
                         echo $this->Form->hidden('lienPositions',array('value'=>$lienPositions));
                         echo $this->Form->hidden('prePayments',array('value'=>$prePayments));
                         echo $this->Form->hidden('prePaymentName',array('value'=>$prePaymentName));
                         echo $this->Form->hidden('loanTerm',array('value'=>$loanTerm));
                         ?> 
                        <h3><?php echo date("jS F, Y", strtotime($data['SoftQuote']['created'])); ?></h3>
                        <h3><strong><?php echo $lienPositions; ?></strong></h3>
                        <h3><strong><?php echo $prePayments; ?></strong></h3>
                        <h3><strong><?php echo $data['SoftQuote']['interest_rate']; ?>% Interest Rate</strong></h3>
                        <h3><strong><?php echo $data['SoftQuote']['business_days']; ?>	Business Days</strong></h3>
                         <p><strong>Borrower Name : </strong><?php echo $data['ShortApplication']['applicant_first_name']. ' '. $data['ShortApplication']['applicant_last_name'] ; ?> </p>
                        <p><strong>Property Address : </strong><?php echo $state .' '. $city ; ?> </p>
                        <p><strong>Origination Fee : </strong>$<?php echo $data['SoftQuote']['origination_fee']; ?></p>
                        <p><strong>Processing Fee: </strong>$<?php echo $data['SoftQuote']['processing_fee']; ?></p>
                        <p><strong>Objective : </strong> <?php echo $data['ShortApplication']['loan_objective']; ?></p>
                        
                        <?php
                        $site_URL = Configure::read('BASE_URL');
                        $shortAppID = base64_encode($data['SoftQuote']['short_application_Id']);
                        $softQuoteID = base64_encode($data['SoftQuote']['id']);
                        echo '<p><a href="'.$site_URL.'homes/onlineLoanApplication/'.$shortAppID .'/'.$softQuoteID.'">Click here to apply for loan </a></p>'; ?>
                      
                    </div>
            </div>
          </div>
        </div>
    </div>
    <?php //echo $this->element('sql_dump'); ?>
</div>