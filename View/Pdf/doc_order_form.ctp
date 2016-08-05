<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');

$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Doc Request form');
$pdf->SetSubject('Doc Request form');

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

$loanID = base64_encode($arrDocOrder['DocOrderForm']['loan_id']);

echo $this->element('common/doc_order_form');
$data = $this->get('data');
$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();

//echo $pdf->Output(WWW_ROOT . 'files/pdf' . DS . 'trust_deed_flyer.pdf', 'I');
$pdf->Output(WWW_ROOT . 'files/pdf/doc_order_form' . DS . 'doc_order_form_'.$loanID.'.pdf', 'F');
