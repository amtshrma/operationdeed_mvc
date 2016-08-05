<?php
$currentDate = date('F, d, Y');

$loanAmount = '$'.$propertyDetail['ShortApplication']['loan_amount'];
$interestRate = $loanTerm = $prePayment = $closingTime = $monthlyPayment = '';

if(!empty($softQuoteDetail)) { 
      $interestRate = $softQuoteDetail['SoftQuote']['interest_rate'].'%';
      $loanTerm = $softQuoteDetail['SoftQuote']['loan_term'];
      $prePayment = !empty($softQuoteDetail['SoftQuote']['other_pre_payment'])?$softQuoteDetail['SoftQuote']['other_pre_payment']:       $softQuoteDetail['SoftQuote']['pre-payment'];
      $closingTime = !empty($softQuoteDetail['SoftQuote']['business_days'])?$softQuoteDetail['SoftQuote']['business_days']:$softQuoteDetail['SoftQuote']['business_days'];
      $monthlyPayment = !empty($softQuoteDetail['SoftQuote']['monthly_payment'])?$softQuoteDetail['SoftQuote']['monthly_payment']:$softQuoteDetail['SoftQuote']['monthly_payment'];
}

$originationFee = Origination_fee;
$processingFee = Processing_fee;
$loanPurpose = !empty($propertyDetail['ShortApplication']['loan_objective'])?$propertyDetail['ShortApplication']['loan_objective']:$propertyDetail['ShortApplication']['loan_objective'];



$tempPropertyState = $propertyDetail['ShortApplication']['property_state'];
$tempPropertyCity = $propertyDetail['ShortApplication']['property_city'];
$propertyState = $this->Common->getStateName($tempPropertyState);
$propertyCity = $this->Common->getCityName($tempPropertyCity);
$address = $propertyDetail['ShortApplication']['property_address'] . ' ' .$propertyState . ','.$propertyCity;
$purpose = $loanPurpose . ' loan on the property located at '. $address;

$loanID = base64_encode($loanDetail['Loan']['id']);
$name = $propertyDetail['ShortApplication']['applicant_first_name']. ' '.$propertyDetail['ShortApplication']['applicant_last_name'];
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

$header = $templateHeader['CompanyTemplate']['template'];

$data = $pdfTemplate['EmailTemplate']['template'];
$signature = $name;
if(isset($letterOfIntentPdf['Loi']['borrower_digital_signature']) && $letterOfIntentPdf['Loi']['borrower_digital_signature'] != '') {
      $tempSignature = $letterOfIntentPdf['Loi']['borrower_digital_signature'];
      $signature .= '<img src="data:'.$tempSignature.'" height="100px" width="100px"/>';
}

$data = str_replace('{COMPANY_TEMPLATE_HEADER}', $header, $data);
$data = str_replace('{NAME}', $name, $data);
$data = str_replace('{CURRENT_DATE}', $currentDate, $data);
$data = str_replace('{LOAN_AMOUNT}', $loanAmount, $data);
$data = str_replace('{INTEREST_RATE}', $interestRate, $data);
$data = str_replace('{TERM}', $loanTerm, $data);
$data = str_replace('{PAYMENT_TERM}', $prePayment, $data);
$data = str_replace('{CONDITION}', $condition, $data);
$data = str_replace('{SIGNATURE}', $signature, $data);
$data = str_replace('{PURPOSE}', $purpose, $data);
$data = str_replace('{MONTHLY_PAYMENT}', $monthlyPayment, $data);
$data = str_replace('{COLLATERAL}', $loanTerm, $data);
$data = str_replace('{CLOSING_TIME}', $closingTime, $data);
$data = str_replace('{RCOFee}', $originationFee, $data);
$data = str_replace('{RCPFee}', $processingFee, $data);
$data = str_replace('{DATE}', $currentDate, $data);


$this->set('data',$data);
$this->set('loanID',$loanID);
