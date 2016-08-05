<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
class MYPDF extends XTCPDF {
   
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', '', 12);
       
        $this->Cell(0, 10, 'Good Faith Estimate (HUD-GFE) '.$this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF('L', PDF_UNIT, 'GFE', true, 'UTF-8', false);

$pdf->SetSubject('(GFE)');
$pdf->AddPage();
$pdf->SetFont('times', '', 12);
$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

/**
 *@pdf form values
 */
//$pdf->setFontSubsetting(true);

$data = $pdfTemplate['EmailTemplate']['template'];
$borrowerID = $loanDetail['ShortApplication']['borrower_ID'];
$borrowerDetail = $this->Common->getUserDetail($borrowerID);
$borrowerName = !empty($borrowerDetail['User']['name'])?$borrowerDetail['User']['name']:'';
$amount = !empty($loanDetail['Loan']['loan_amount'])?$loanDetail['Loan']['loan_amount']:'';
$originationFee = Origination_fee;
$processingFee = Processing_fee;
$loanTerm = $interestRate = $monthlyPayment = $lenderFee = '';

if(!empty($softQuoteDetail)) {
    $loanTerm = !empty($softQuoteDetail['SoftQuote']['loan_term'])?$softQuoteDetail['SoftQuote']['loan_term']:'';
    $interestRate = !empty($softQuoteDetail['SoftQuote']['interest_rate'])?$softQuoteDetail['SoftQuote']['interest_rate']:'';
    $monthlyPayment = !empty($softQuoteDetail['SoftQuote']['monthly_payment'])?$softQuoteDetail['SoftQuote']['monthly_payment']:'';
    $lenderFee = !empty($softQuoteDetail['SoftQuote']['lender_fees'])?$softQuoteDetail['SoftQuote']['lender_fees']:'';
}

$loanID = base64_encode($loanDetail['Loan']['id']);
$loanDate = date('dmYHi',strtotime($loanDetail['Loan']['created']));
$loanNumber = "LN - ".$loanDate .$loanDetail['Loan']['id'];
$propertyAddress = !empty($loanDetail['ShortApplication']['property_address'])?$loanDetail['ShortApplication']['property_address']:'';
$gfeDate = date('Y-m-d');

$data = str_replace('[Borrower]', $borrowerName, $data);
$data = str_replace('[Loan Amount]', $amount, $data);
$data = str_replace('[Loan Number]', $loanNumber, $data);
$data = str_replace('[Property Address]', $propertyAddress, $data);
$data = str_replace('[Loan Term]', $loanTerm, $data);
$data = str_replace('[Interest Rate]', $interestRate, $data);
$data = str_replace('[Monthly Amount]', $monthlyPayment, $data);

$data = str_replace('[Lender Fee]', $lenderFee, $data);
$data = str_replace('[Broker Origination Fee]', $originationFee, $data);
$data = str_replace('[Broker Allocation Fee]', $originationFee, $data);
$data = str_replace('[Origination Charges]', $originationFee, $data);
$data = str_replace('[Date of GFE]', $gfeDate, $data);

$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
echo $pdf->Output(WWW_ROOT . 'files/pdf/GFE' . DS . 'GFE_'.$loanID.'.pdf', 'FI');
die();