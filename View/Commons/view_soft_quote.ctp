<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
     <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
          <h3>Pre-View Soft Quote Detail</h3><hr />
          <div class="row">
          <div class="table-responsive">
               <p><?php echo $this->Session->flash();?></p>
               <table class="table table-bordered table-hover" id="Loans" >
               <?php
                    echo $this->Form->create('SoftQuote', array('url' => array('controller' => 'commons', 'action' => 'view_soft_quote',base64_encode($data['SoftQuote']['id'])),'novalidate' => true,'class'=>'form-no-horizontal-spacing'));
                    $quoteID =  $data['SoftQuote']['id'];
                    $lienPositions = $this->Common->getSoftQuoteLien($quoteID);
                    $prePayments = $this->Common->getSoftQuotePerPayment($quoteID);
                    $prePaymentName = $this->Common->getSoftQuotePrePayment($quoteID);
                    $loanTerm = $this->Common->getSoftQuoteloanTerm($quoteID);
                    $propertyState = $data['ShortApplication']['property_state'];
                    $propertyCity= $data['ShortApplication']['property_state'];
                    $state = $this->Common->getStateName($propertyState);
                    $city = $this->Common->getCityName($propertyCity);
                    echo $this->Form->hidden('lienPositions',array('value'=>$lienPositions));
                    echo $this->Form->hidden('prePayments',array('value'=>$prePayments));
                    echo $this->Form->hidden('prePaymentName',array('value'=>$prePaymentName));
                    echo $this->Form->hidden('loanTerm',array('value'=>$loanTerm));
               ?> 
               <thead>
                    <tr>
                         <th>Fields</th>
                         <th>Value</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td>Date </td><td><b><?php echo date("jS F, Y", strtotime($data['SoftQuote']['created'])); ?></b></td>
                    </tr>
                    <tr>
                         <td>Lien Position </td><td><b><?php echo $lienPositions; ?></b></td>
                    </tr>
                    
                    <tr>
                         <td>Pre Payment </td><td><b><?php echo $prePayments; ?></b></td>
                    </tr>
                    <tr>
                         <td>Interest Rate </td><td><b><?php echo $data['SoftQuote']['interest_rate']; ?>% Interest Rate</b></p></td>
                    </tr>
                    <tr>
                         <td>Business Days </td><td><b><?php echo $data['SoftQuote']['business_days']; ?>	Business Days</b></td>
                    </tr>
                    <tr>
                         <td>Origination Fee </td><td><b>$<?php echo $data['SoftQuote']['origination_fee']; ?></b></td>
                    </tr>
                    <tr>
                         <td>Processing Fee </td><td><b>$<?php echo $data['SoftQuote']['processing_fee']; ?></b></td>
                    </tr>
                    <tr>
                         <td>Borrower Name </td><td><b><?php echo $data['ShortApplication']['applicant_first_name']. ' '. $data['ShortApplication']['applicant_last_name'] ; ?></b></td>
                    </tr>
                    <tr>
                         <td>Property Address </td><td><b><?php echo $state .', '. $city ; ?></b></td>
                    </tr>
                    <tr>
                         <td>Objective </td><td><b><?php echo $data['ShortApplication']['loan_objective']; ?></b></td>
                    </tr>
                    <?php
                    if($data['ShortApplication']['loan_type'] == '2'){
                    ?>
                         <tr>
                              <td colspan="2"><b>Rehab Property Detail</b></td>
                         </tr>
                         <tr>
                              <td>Rehab Loan Amount</td><td><b>$<?php echo $data['SoftQuote']['origination_fee']; ?></b></td>
                         </tr>
                         <tr>
                              <td>Rehab Down Payment Percentage</td><td><b>$<?php echo $data['SoftQuote']['processing_fee']; ?></b></td>
                         </tr>
                         <tr>
                              <td>Rehab Property Value</td><td><b><?php echo $data['ShortApplication']['applicant_first_name']. ' '. $data['ShortApplication']['applicant_last_name'] ; ?></b></td>
                         </tr>
                         <tr>
                              <td>Rehab Monthly Cost</td><td><b><?php echo $state .', '. $city ; ?></b></td>
                         </tr>
                         <tr>
                              <td>Rehab Closing Cost</td><td><b><?php echo $data['ShortApplication']['loan_objective']; ?></b></td>
                         </tr>  
                    <?php
                    }
                    ?>
               </tbody>
               </table>
          </div>
          <div class="form-actions">
               <div class="col-md-2 col-md-offset-10">
                    <?php echo $this->Form->button('Send Soft Quote', array('type' => 'submit','class' => 'btn btn-primary btn-cons','title'=>'Click To  Send Soft Quote to borrower')); ?>
                    <br />
               </div>
          </div>
          <?php echo $this->Form->end(); ?>
     </div>
</div>