<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');

$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Trust Deed Flyer');
$pdf->SetSubject('Trust Deed Flyer');

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
//pr($arrTrustDeed);
 
$purchasePrice = $arrTrustDeed['TrustDeed']['purchase_price'];
$tempEntitlementToDate = $arrTrustDeed['TrustDeed']['entitlement_todate'];
if($tempEntitlementToDate != 'NA'){
    $entitlementToDate = number_format($entitlementToDate, 2, '.', ',');
}else {
    $entitlementToDate = 'NA';
}

$total = $purchasePrice + $entitlementToDate;

$totalPPETD = number_format($total, 2, '.', ',');
$trustDeedPostions = $this->Common->getTrustDeedPosition();
//$trustDeedPrePays = $this->Common->getTrustDeedPrePay(); 
$trustDeedPrePays = $this->Common->getGuaranteedInterests();  pr($trustDeedPrePays);
//$trustDeedLoanTerms = $this->Common->getTrustDeedLoanTerm(); 
$trustDeedLoanTerms = $this->Common->getLoanTerms();
$trustDeedTrnsType = $this->Common->getDeedTransactionTypes(); 
$loanTrustDeed = $arrTrustDeed['TrustDeed']['trustdeed_position'];
$trustDeedPosition = 'NA';
if($loanTrustDeed != ''){
    $trustDeedPosition = $trustDeedPostions[$loanTrustDeed];
}
$loanNotePay = $arrTrustDeed['TrustDeed']['note_rate'];
$loanPrePay = $arrTrustDeed['TrustDeed']['pre_pay'];
$trustDeedPrePay = 'NA';
if($loanPrePay != ''){
    $trustDeedPrePay = $trustDeedPrePays[$loanPrePay];
}
$loanTerm = $arrTrustDeed['TrustDeed']['loan_term'];
$trustDeedLoanTerm = 'NA';
if($loanTerm != ''){
    $trustDeedLoanTerm = $trustDeedLoanTerms[$loanTerm];
}
$deedTransactionType = $arrTrustDeed['TrustDeed']['trans_type'];
$transactionType = 'NA';
if($deedTransactionType != ''){
    $trustDeedTransactionType = $trustDeedTrnsType[$deedTransactionType];
}
$reqFirstTdLoan = number_format($arrTrustDeed['TrustDeed']['req_loan_amount'], 2, '.', ',');
$ltv = $arrTrustDeed['TrustDeed']['ltv'];
$propertyType = $arrTrustDeed['TrustDeed']['property_type'];
$bed = $arrTrustDeed['TrustDeed']['bed'];
$bath = $arrTrustDeed['TrustDeed']['bath'];
$yearBuilt = $arrTrustDeed['TrustDeed']['year_built'];
$sq_ft_structure = $arrTrustDeed['TrustDeed']['sq_ft_structure'];
$sq_ft_lot = $arrTrustDeed['TrustDeed']['sq_ft_lot'];
$occupancy_type = $arrTrustDeed['TrustDeed']['occupancy_type'];
$monthly_rental_income = $arrTrustDeed['TrustDeed']['monthly_rental_income'];
$borrower_entity_type = $arrTrustDeed['TrustDeed']['borrower_entity_type'];
$personal_guarantor = $arrTrustDeed['TrustDeed']['personal_guarantor'];
$occupation_guarantor = $arrTrustDeed['TrustDeed']['occupation_guarantor'];
$exit_strategy = $arrTrustDeed['TrustDeed']['exit_strategy'];
$exit_strategy_other = $arrTrustDeed['TrustDeed']['exit_strategy_other'];
$exit = !empty($exit_strategy_other)?$exit_strategy_other:$exit_strategy;
$loanID = base64_encode($arrTrustDeed['TrustDeed']['loan_id']);

$propertyImages = '';
if(!empty($arrTrustDeed['TrustDeedUpload'])){
      foreach($arrTrustDeed['TrustDeedUpload'] as $uploads) { //pr($field);
        if(isset($uploads['property_image']) && $uploads['property_image'] != ''){
            $img = BASE_URL."upload/TrustDeedFlyer/".$uploads['property_image'];
            $imgSrc = '<img align="center" src="'.$img.'" height="200" width="300" border="0"  />';
            $propertyImages .= '<p>'.$imgSrc.'</p>';
            $propertyImages .= '<br>';
        }
    }
}

$dynamicFields = '';
if(!empty($arrTrustDeed['TrustDeedField'])){
     foreach($arrTrustDeed['TrustDeedField'] as $fields) {
        if(isset($fields['form_label']) && $fields['form_label'] != ''){
          $formValue = $fields['form_label'];
          $dynamicFields .= '<p>'.$fields['form_label'].' : '.$fields['form_value'].'</p>';
          $dynamicFields .= '<br/>';
        }
        
    }
}
$header = $templateHeader['CompanyTemplate']['template'];
 
$data = $pdfTemplate['EmailTemplate']['template'];

$data = str_replace('{COMPANY_TEMPLATE_HEADER}', $header, $data);
$data = str_replace('{TRUST DEED POSITION}', $trustDeedPosition, $data);
$data = str_replace('{LOAN NOTE PAY}', $loanNotePay, $data);
$data = str_replace('{TRUST DEED PERPAY}', $trustDeedPrePay, $data);
$data = str_replace('{TRUST DEED LOAN TERM}', $trustDeedLoanTerm, $data);
$data = str_replace('{TRUST DEED TRANSACTION TYPE}', $trustDeedTransactionType, $data);
$data = str_replace('{PURCHASE PRICE}', number_format($purchasePrice, 2, '.', ','), $data);
$data = str_replace('{ENTITLEMENT TO DATE}', $entitlementToDate, $data);

$data = str_replace('{LTV}', $ltv, $data);
$data = str_replace('{TOTAL PPETD}', $totalPPETD, $data);
$data = str_replace('{FIRST TD LOAN}', $reqFirstTdLoan, $data);

$data = str_replace('{PROPERTY TYPE}', $propertyType, $data);
$data = str_replace('{BED}', $bed, $data);
$data = str_replace('{BATH}', $bath, $data);

$data = str_replace('{YEAR BUILT}', $yearBuilt, $data);
$data = str_replace('{SQ FT STRUCTURE}', number_format($sq_ft_structure, 2, '.', ','), $data);
$data = str_replace('{SQ FT LOT}', number_format($sq_ft_lot, 2, '.', ','), $data);
$data = str_replace('{OCCUPANCY TYPE}', $occupancy_type, $data);
$data = str_replace('{MONTHLY RENTAL INCOME}', number_format($monthly_rental_income, 2, '.', ','), $data);
$data = str_replace('{BORROWER ENTITY TYPE}', $borrower_entity_type, $data);

$data = str_replace('{PERSONAL GUARANTOR}', $personal_guarantor, $data);
$data = str_replace('{OCCUPATION GUARANTOR}', $occupation_guarantor, $data);
$data = str_replace('{EXIT STRATEGY}', $exit, $data);
$data = str_replace('{MORE FIELDS}', $dynamicFields, $data);
$data = str_replace('{PROPERTY IMAGES}', $propertyImages, $data);
$pdf->writeHTML($data, true, false, true, false, '');
$pdf->lastPage();
//echo $pdf->Output(WWW_ROOT . 'files/pdf' . DS . 'trust_deed_flyer.pdf', 'I');
$pdf->Output(WWW_ROOT . 'files/pdf/TrustDeedFlyer' . DS . 'trust_deed_flyer_'.$loanID.'.pdf', 'F');