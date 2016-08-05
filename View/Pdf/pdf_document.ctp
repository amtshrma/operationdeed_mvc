<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');

$documentName = $pdfTemplate['Document']['name'];
class MYPDF extends XTCPDF {  
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', '', 12);
       
        $this->Cell(0, 10, $this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF('L', PDF_UNIT, 'GFE', true, 'UTF-8', false);

$pdf->SetSubject('('.$documentName.')');
$pdf->AddPage();
$pdf->SetFont('times', '', 12);
$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

/**
 *@pdf form values
 */
//$pdf->setFontSubsetting(true);

$data = $pdfTemplate['Document']['document_description'];
$firstName = ucfirst($userDetail['first_name']);
$lastName = ucfirst($userDetail['last_name']);
$firstNameInitial = substr($firstName, 0, 1);
$lastNameInitial = substr($lastName, 0, 1);
/*if($userDetail['company_name'] != 'None' && $userDetail['company_name'] != '') {
    $companyName = $userDetail['company_name'];
}else {
    $companyName = '';
}
if($userDetail['company_position'] != 'None' && $userDetail['company_position'] != '') {
    $companyPosition = $userDetail['company_position'];
}else {
    $companyPosition = '';
}*/
$companyName = '';
$companyPosition = '';

$userName = $firstName . ' '. $lastName;
$userInitial =  $firstNameInitial. ''.$lastNameInitial;
$day = date('d');
$month = date('m');
$year = date('Y');
$date = date('m/d/Y');
$data = str_replace('[UserName]', $userName, $data);
$data = str_replace('[UserIntials]', $userInitial, $data);

$data = str_replace('[Day]', $day, $data);
$data = str_replace('[Month]', $month, $data);
$data = str_replace('[Year]', $year, $data);
$data = str_replace('[Date]', $date, $data);
$data = str_replace('[Company]', $companyName, $data);
$data = str_replace('[CompanyPosition]', $companyPosition, $data);

$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
$file = $documentName .'_'.$userName.'.pdf'; 
echo $pdf->Output($file, 'D');
die();