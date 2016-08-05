<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');

$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Trust Deed Tombstone');
$pdf->SetSubject('Trust Deed Tombstone');

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

$newData = $newImages = $data = '';
foreach($publishedFields as $key=>$val) { 
    if(!empty($val)){
        $file_path = BASE_URL."upload/TrustDeedFlyer/";
            $notArrayKey = array('trust_deed_upload');
            if(in_array($val['published_field'],$notArrayKey)){
                $newImages .= '<tr>';
                $newImages .= '<td><img src="'.$file_path.$val['published_field_value'].'"/></td>';
                $newImages .= '</tr>';
            }else{
                $newData .= '<tr>';
                $newData .= '<td>'.str_replace('_',' ',$val['published_field']) .'  :  '. $val['published_field_value'] .'</td>';
                $newData .= '</tr>';
            }
       
    }
}
$data .= '<p style="text-align:center"><span style="font-size:14px"><strong>Trust Deed Tombstone</strong></span></p><p>'.$templateHeader.'</p><table border="1" style="width:100%"><tbody><tr><td style="width:50%">&nbsp;<table border="0" cellpadding="0" cellspacing="10" style="font-size:12px"><tbody>'.$newData.'</tbody></table></td><td><table border="0" cellpadding="0" cellspacing="10" style="font-size:12px"><tbody>'.$newImages.'</tbody></table></td></tr></tbody></table>';

$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
//echo $pdf->Output(WWW_ROOT . 'files/pdf' . DS . 'trust_deed_flyer.pdf', 'I');

echo $pdf->Output(WWW_ROOT . 'files/pdf/TrustDeedTombstone' . DS . 'trust_deed_tombstone_'.$loanId.'.pdf', 'F');