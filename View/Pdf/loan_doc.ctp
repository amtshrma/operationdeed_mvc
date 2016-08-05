<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
 
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle($pdfTemplate['EmailTemplate']['name']);
$pdf->SetSubject($pdfTemplate['EmailTemplate']['name']);
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

/**
 *@pdf form values
 */

$currentDate = date('F, d, Y');
/*$loanAmount = '$'.$softQuoteDetail['SoftQuote']['loan_amount'];
$interestRate = $softQuoteDetail['SoftQuote']['interest_rate'].'%';
$loanTerm = $softQuoteDetail['SoftQuote']['loan_term'];
$prePayment = !empty($softQuoteDetail['SoftQuote']['other_pre_payment'])?$softQuoteDetail['SoftQuote']['other_pre_payment']:$softQuoteDetail['SoftQuote']['pre-payment'];


$closingTime = !empty($softQuoteDetail['SoftQuote']['business_days'])?$softQuoteDetail['SoftQuote']['business_days']:$softQuoteDetail['SoftQuote']['business_days'];
$originationFee = !empty($softQuoteDetail['SoftQuote']['origination_fee'])?$softQuoteDetail['SoftQuote']['origination_fee']:$softQuoteDetail['SoftQuote']['origination_fee'];
$processingFee = !empty($softQuoteDetail['SoftQuote']['processing_fee'])?$softQuoteDetail['SoftQuote']['processing_fee']:$softQuoteDetail['SoftQuote']['processing_fee'];
$loanPurpose = !empty($loanDetail['Loan']['purpose_of_loan'])?$loanDetail['Loan']['purpose_of_loan']:$loanDetail['Loan']['purpose_of_loan'];

$monthlyPayment = !empty($softQuoteDetail['SoftQuote']['monthly_payment'])?$softQuoteDetail['SoftQuote']['monthly_payment']:$softQuoteDetail['SoftQuote']['monthly_payment'];

$tempPropertyState = $softQuoteDetail['ShortApplication']['property_state'];
$tempPropertyCity = $softQuoteDetail['ShortApplication']['property_city'];
$propertyState = $this->Common->getStateName($tempPropertyState);
$propertyCity = $this->Common->getCityName($tempPropertyCity);
$address = $softQuoteDetail['ShortApplication']['property_address'] . ' ' .$propertyState . ','.$propertyCity;
$purpose = $loanPurpose . ' loan on the property located at '. $address;

$loanID = base64_encode($loanDetail['Loan']['id']);
$name = $softQuoteDetail['ShortApplication']['applicant_first_name']. ' '.$softQuoteDetail['ShortApplication']['applicant_last_name'];


$header = $templateHeader['CompanyTemplate']['template'];
*/
$lenderName = $this->Common->getLoanLender($loanId);
$borrowerDetail = $this->Common->getUserDetail($loanDetail['ShortApplication']['borrower_ID']);
$data = $pdfTemplate['EmailTemplate']['template'];
//$signature = $name;

$data = str_replace('{Lender}', $lenderName, $data);
$data = str_replace('{Loan Date}', $currentDate, $data);
$data = str_replace('{Borrower}', $borrowerDetail['User']['name'], $data);

/*$data = str_replace('{COMPANY_TEMPLATE_HEADER}', $header, $data);
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
$data = str_replace('{RCPFee}', $processingFee, $data);*/

$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
//echo $pdf->Output(WWW_ROOT . 'files/pdf/LetterOfIntent/borrower' . DS . 'LetterOfIntent_'.$loanID.'.pdf', 'F');
echo $pdf->Output(WWW_ROOT . 'files/pdf' . DS . 'LetterOfIntent'.'.pdf', 'FI');
die();

