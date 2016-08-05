<?php
//header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
 
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Letter Of Intent');
$pdf->SetSubject('Letter Of Intent');
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

/**
 *@pdf form values
 */

echo $this->element('common/loi_pdf');
$data = $this->get('data');

$loanID = $this->get('loanID');
$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
$pdf->Output(WWW_ROOT . 'files/pdf/LetterOfIntent' . DS . 'LetterOfIntent_'.$loanID.'.pdf', 'F');


