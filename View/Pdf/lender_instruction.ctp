<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');

$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Lender Instructions');
$pdf->SetSubject('Lender Instructions');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// disable auto-page-break
//$pdf->SetAutoPageBreak(false, 0);

$pdf->AddPage();


$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

/**
 *@pdf form values
 */

 

$loanID = base64_encode($loanDetail['Loan']['id']);



//$header = $templateHeader['CompanyTemplate']['template'];
 
$data = $pdfTemplate['EmailTemplate']['template'];



$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
//echo $pdf->Output(WWW_ROOT . 'files/pdf' . DS . 'trust_deed_flyer.pdf', 'I');
echo $pdf->Output(WWW_ROOT . 'files/pdf/LenderInstruction' . DS . 'lender_instruction'.$loanID.'.pdf', 'FI');
die();