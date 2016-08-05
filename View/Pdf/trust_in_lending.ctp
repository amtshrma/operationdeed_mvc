<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
class MYPDF extends XTCPDF {
   
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', '', 12);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
         $this->Cell(0, 10, 'Truth in Lending Disclosure Statement', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF('L', PDF_UNIT, 'TIL', true, 'UTF-8', false);

$pdf->SetSubject('Truth in Lending Statement with Itemization');

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
$loanID = base64_encode($loanDetail['Loan']['id']);
$loanDate = date('dmYHi',strtotime($loanDetail['Loan']['created']));
$loanNumber = "LN - ".$loanDate .$loanDetail['Loan']['id'];
$data = str_replace('[Borrower Name]', $borrowerName, $data);
$data = str_replace('[Total Payment]', $amount, $data);
$data = str_replace('[Loan Number]', $loanNumber, $data);

$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
echo $pdf->Output(WWW_ROOT . 'files/pdf/TIL' . DS . 'TIL_'.$loanID.'.pdf', 'FI');
die();