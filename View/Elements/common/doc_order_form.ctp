<?php
$pdfUrl = '/app/webroot/files/pdf/';
$loanID = base64_encode($arrDocOrder['DocOrderForm']['loan_id']);
$header = $templateHeader['CompanyTemplate']['template'];
$data = $pdfTemplate['EmailTemplate']['template'];
$data = str_replace('{COMPANY_TEMPLATE_HEADER}', $header, $data);
pr($data);
if($arrDocOrder['DocOrderForm']['borrower_vesting'] == 'other') {
    $vesting = 'Other - '.$arrDocOrder['DocOrderForm']['borrower_vesting_other'];
}else {
        
    $vesting = $arrDocOrder['DocOrderForm']['borrower_vesting'];
}
$loanAmount = isset($sqd['SoftQuote']['loan_amount'])?$sqd['SoftQuote']['loan_amount']:'';
$loanFirstName = isset($sqd['ShortApplication']['applicant_first_name'])?$sqd['ShortApplication']['applicant_first_name']:'';
$loanLastName = isset($sqd['ShortApplication']['applicant_last_name'])?$sqd['ShortApplication']['applicant_last_name']:'';
$borrowerName = $loanFirstName.' '.$loanLastName;
$interestRate = isset($sqd['SoftQuote']['interest_rate'])?$sqd['SoftQuote']['interest_rate']:'';
$loanTypeId = isset($sqd['ShortApplication']['loan_type'])?$sqd['ShortApplication']['loan_type']:'';
$loanType = !empty($loanTypeId)?$loanTypes[$loanTypeId]:'';
$loanTerm = isset($sqd['SoftQuote']['loan_term'])?$sqd['SoftQuote']['loan_term']:'';
$prePayment = isset($sqd['SoftQuote']['pre-payment'])?$sqd['SoftQuote']['pre-payment']:'';
$prePaymentOther = isset($sqd['SoftQuote']['other_pre_payment'])?$sqd['SoftQuote']['other_pre_payment']:'';
$prePaymentPanalty = !empty($prePaymentOther)?$prePaymentOther:$prePayment;
$prePayment = isset($sqd['SoftQuote']['pre-payment'])?$sqd['SoftQuote']['pre-payment']:'';
$borrowerVesting = isset($vesting)?$vesting:'';
$signingDate = isset($arrDocOrder['DocOrderForm']['req_signing_date'])?_dateFormatFront($arrDocOrder['DocOrderForm']['req_signing_date']):'';
$signingTime = isset($arrDocOrder['DocOrderForm']['req_signing_time'])?$arrDocOrder['DocOrderForm']['req_signing_time']:'';
$companyName = isset($sqd['ShortApplication']['applicant_company_name'])?$sqd['ShortApplication']['applicant_company_name']:'';
$toName = isset($reviews['title_officer_name'])?$reviews['title_officer_name']:'';
$toEmail = isset($reviews['title_officer_email'])?$reviews['title_officer_email']:'';
$toPhone = isset($reviews['title_officer_phone'])?$reviews['title_officer_phone']:'';
$eoName = isset($reviews['escrow_full_name'])?$reviews['escrow_full_name']:'';
$eoEmail = isset($reviews['escrow_email_address'])?$reviews['escrow_email_address']:'';
$eoPhone = isset($reviews['escrow_phone_number'])?$reviews['escrow_phone_number']:'';

$lenderVesting = isset($arrDocOrder['DocOrderForm']['lender_vesting'])?$arrDocOrder['DocOrderForm']['lender_vesting']:'';
$loanNo = isset($arrDocOrder['DocOrderForm']['loan_no'])?$arrDocOrder['DocOrderForm']['loan_no']:'';
$finalTeal = (!empty($arrDocOrder['DocOrderForm']['final_teal']) && ($arrDocOrder['DocOrderForm']['final_teal']=='1'))?'<a href="'.$pdfUrl.'TIL/TIL_'.$loanID.'.pdf" target="_blank">View</a>':'Not Submitted';
$finalGfe = (!empty($arrDocOrder['DocOrderForm']['final_gfe']) && ($arrDocOrder['DocOrderForm']['final_gfe']=='1'))?'<a href="'.$pdfUrl.'GFE/GFE_'.$loanID.'.pdf" target="_blank">View</a>':'Not Submitted';
$final1003 = (!empty($arrDocOrder['DocOrderForm']['final_1003']) && ($arrDocOrder['DocOrderForm']['final_1003']=='1'))?'<a href="'.$pdfUrl.'1003/1003_'.$loanID.'.pdf" target="_blank">View</a>':'Not Submitted';
$docOrder = (!empty($arrDocOrder['DocOrderForm']['doc_order']) && ($arrDocOrder['DocOrderForm']['doc_order']=='1'))?'<a href="'.$pdfUrl.'doc_order_form/doc_order_form_'.$loanID.'.pdf" target="_blank">View</a>':'Not Submitted';

$borkerFees = isset($sqd['SoftQuote']['borker_fees'])?$sqd['SoftQuote']['borker_fees']:'';
$lenderFees = isset($sqd['SoftQuote']['lender_fees'])?$sqd['SoftQuote']['lender_fees']:'';
$originationFees = Origination_fee;
$lenderFees = isset($sqd['SoftQuote']['lender_fees'])?$sqd['SoftQuote']['lender_fees']:'';


$data = str_replace('{LOAN_AMOUNT}', $loanAmount, $data);
$data = str_replace('{BORROWER_NAME}', $borrowerName, $data);
$data = str_replace('{INTEREST_RATE}', $interestRate, $data);
$data = str_replace('{LOAN_TYPE}', $loanType, $data);
$data = str_replace('{TERM_MONTH}', $loanTerm, $data);
$data = str_replace('{PRE_PAYMENT_PENALTY}', $prePaymentPanalty, $data);
$data = str_replace('{BORROWER_VESTING}', $borrowerVesting, $data);
$data = str_replace('{SIGNING_DATE}', $signingDate, $data);
$data = str_replace('{SIGNING_TIME}', $signingTime, $data);
$data = str_replace('{TITLE_COMPANY}', $companyName, $data);
$data = str_replace('{TO_NAME}', $toName, $data);
$data = str_replace('{TO_EMAIL}', $toEmail, $data);
$data = str_replace('{TO_PHONE}', $toPhone, $data);
$data = str_replace('{EO_NAME}', $eoName, $data);
$data = str_replace('{EO_EMAIL}', $eoEmail, $data);
$data = str_replace('{EO_PHONE}', $eoPhone, $data);
$data = str_replace('{LENDER}', '', $data);
$data = str_replace('{LENDER_VESTING}', $lenderVesting, $data);
$data = str_replace('{LOAN_NO}', $loanNo, $data);

$data = str_replace('{FINAL_TIL}', $finalTeal, $data);
$data = str_replace('{FINAL_GFL}', $finalGfe, $data);
$data = str_replace('{FINAL_1003}', $final1003, $data);
$data = str_replace('{DOC_ORDER}', $docOrder, $data);
$data = str_replace('{RC_BROKER_FEES}', $borkerFees, $data);
$data = str_replace('{LENDER_FEES}', $lenderFees, $data);
$data = str_replace('{ORIGINATION_FEES}', $originationFees, $data);
$data = str_replace('{BROKER_FEES}', $borkerFees, $data);

$this->set('data',$data);
$this->set('loanID',$loanID);

