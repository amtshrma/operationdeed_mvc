<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3>Letter Of Intent</h3>
		<div class="col-md-12">
			<?php echo $this->Form->create('Loi', array('id'=>'borrowerRegister','type' => 'file')); ?>
            <div id="borrowerSignOfIntent">									
                <div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
                <div class="table-responsive">
                <table class="table table-striped table-fixed-layout table-hover" id="emails" > 
                    <thead>
                        <tr>
                            <th class="small-cell"></th>
                            <th class="medium-cell"></th>
                            <th ></th>
                            <th class="medium-cell"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $loanAmount = '$'.$shortAppDetail['ShortApplication']['loan_amount'];
                        $interestRate = $loanTerm = $prePayment = $closingTime = $monthlyPayment = '';
                        if(!empty($softQuoteDetail)) {
                            $interestRate = !empty($softQuoteDetail['SoftQuote']['interest_rate']) ? $softQuoteDetail['SoftQuote']['interest_rate'].'%' : '';
                            $loanTerm = !empty($softQuoteDetail['SoftQuote']['loan_term']) ? $softQuoteDetail['SoftQuote']['loan_term'] : '';
                            $prePayment = !empty($softQuoteDetail['SoftQuote']['other_pre_payment'])?$softQuoteDetail['SoftQuote']['other_pre_payment']:$softQuoteDetail['SoftQuote']['pre-payment'];
                            $closingTime = !empty($softQuoteDetail['SoftQuote']['business_days'])?$softQuoteDetail['SoftQuote']['business_days']:$softQuoteDetail['SoftQuote']['business_days'];
                            $monthlyPayment = !empty($softQuoteDetail['SoftQuote']['monthly_payment'])?$softQuoteDetail['SoftQuote']['monthly_payment']:$softQuoteDetail['SoftQuote']['monthly_payment'];
                        }
                        $originationFee = Origination_fee;
                        $processingFee = Processing_fee;
                        $loanPurpose = !empty($shortAppDetail['ShortApplication']['loan_objective'])?$shortAppDetail['ShortApplication']['loan_objective']:$shortAppDetail['Loan']['purpose_of_loan'];
                        $tempPropertyState = $shortAppDetail['ShortApplication']['property_state'];
                        $tempPropertyCity = $shortAppDetail['ShortApplication']['property_city'];
                        $propertyState = $this->Common->getStateName($tempPropertyState);
                        $propertyCity = $this->Common->getCityName($tempPropertyCity);
                        $address = $shortAppDetail['ShortApplication']['property_address'] . ' ' .$propertyState . ','.$propertyCity;
                        $purpose = $loanPurpose . ' loan on the property located at '. $address;
                        $loanID = base64_encode($loanDetail['Loan']['id']);
                        $name = $shortAppDetail['ShortApplication']['applicant_first_name']. ' '.$shortAppDetail['ShortApplication']['applicant_last_name'];
                        $condition = '';
                        if(!empty($loiCondition)){
                            foreach($loiCondition as $key => $field) { //pr($field);
                                if(isset($field) && $field != '') {
                                    $formValue = $field['LoiCondition']['condition'];
                                    $condition .= '<p>'.$formValue.'</p>';
                                    $condition .= '<br/>';
                                }
                            }
                        }
                        $signature =  $this->element('fronts/jsignature_borrower');
                        //$signature .=   '<p>'.$name.'</p>';
                        $signature .= '<div class="pull-right">Note : Click Confirm Button to confirm and Reset Button to retry</div>';
                        $header = $templateHeader['CompanyTemplate']['template'];
                        $data = $pdfTemplate['EmailTemplate']['template'];
                        $currentDate =  date("jS M, Y", strtotime(CURRENT_DATE_TIME_DB));
                        $data = str_replace('{COMPANY_TEMPLATE_HEADER}', $header, $data);
                        $data = str_replace('{NAME}', $name, $data);
                        $data = str_replace('{CURRENT_DATE}', $currentDate, $data);
                        $data = str_replace('{SIGNATURE}', $signature, $data);
						$data = str_replace('{DATE}', ' : '.date('m D Y'), $data);
                        $data = str_replace('{LOAN_AMOUNT}', $loanAmount, $data);
                        $data = str_replace('{INTEREST_RATE}', $interestRate, $data);
                        $data = str_replace('{TERM}', $loanTerm, $data);
                        $data = str_replace('{PAYMENT_TERM}', $prePayment, $data);
                        $data = str_replace('{CONDITION}', $condition, $data);
                        $data = str_replace('{PURPOSE}', $purpose, $data);
                        $data = str_replace('{MONTHLY_PAYMENT}', $monthlyPayment, $data);
                        $data = str_replace('{COLLATERAL}', $loanTerm, $data);
                        $data = str_replace('{CLOSING_TIME}', $closingTime, $data);
                        $data = str_replace('{RCOFee}', $originationFee, $data);
                        $data = str_replace('{RCPFee}', $processingFee, $data);
                        echo $data;
                    ?>
                    </tbody>
                </table>
                </div>
			</div>
        </div>
        <div class="row">
            <div class="col-sm-2 col-sm-offset-10">
                <?php echo $this->Form->button('Sign & Submit',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-primary btn-cons sumitButton','name'=>'register-submit','id'=>'register-submit'));?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
	</div>	
</div>
<style>
    p{
        line-height: 30px;
    }
</style>