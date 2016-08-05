<?php
//header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
class MYPDF extends XTCPDF {
   
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', '', 16);
       
        $this->Cell(0, 10, 'Good Faith Estimate (HUD-GFE) '.$this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF('L', PDF_UNIT, 'GFE', true, 'UTF-8', false);

$pdf->SetSubject('(GFE)');
$pdf->AddPage();
$pdf->SetFont('times', '', 12);
$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

$html = '<h4>State of CaliforniaDepartment</h4>';
$html .='<p><img src ="'.BASE_URL.'img/front/attory_office.jpg" height ="50" style="float:left;margin-right : 1%;"/>Department of real eState <br />Serving Californians Since 1917</p>';
$html .= '<h2>Mortage Loan Disclosure Statement  / Good Faith Estimate <br /> Non Traditional Mortage Product (One to Four Residentail Units)</h2>';
$html .= '<p>RE 885 (Rev. 8/08)</p><hr/>';
$html .= 'Borrowers Name(s): '.$data["GFEStep1"]["DisclosureStatement"]["borrower_name"].' Real Property Collateral: The intended security for this proposed loan will be a Deed of Trust on (street address or legal description) '.$data["GFEStep1"]["DisclosureStatement"]["legal_description"].' This joint Mortgage Loan Disclosure Statement/Good Faith Estimate is being provided by '.$data["GFEStep1"]["DisclosureStatement"]["broker_name"].' , a real estate broker acting as a mortgage broker, pursuant to the Federal Real Estate Settlement Procedures Act (RESPA) if applicable and similar California law. In a transaction subject to RESPA, a lender will provide you with an additional Good Faith Estimate within three business days of the receipt of your loan application. You will also be informed of material changes before settlement/close of escrow. The name of the intended lender to whom your loan application will be delivered is:';
if($data["GFEStep1"]["DisclosureStatement"]["lender_type"] == "unknown"){
    $html .= '<input type="checkbox" checked="checked" value="unknown" name="lender_type" readonly="readonly"/> Unknown ';
}else{
    $html .= '<input type="checkbox"  value="unknown" name="lender_type" readonly="readonly"/> Unknown';
}
if($data["GFEStep1"]["DisclosureStatement"]["lender_type"] == "known"){
    $html .= '<input type="checkbox" checked="checked" value="known" name="lender_type" readonly="readonly"/>';
}else{
    $html .= ' <input type="checkbox"  value="known" name="lender_type" readonly="readonly"/>';
}
$html .= $data["GFEStep1"]["DisclosureStatement"]["lender_name"].' (Name of lender, if known)';

/*  step2 */
$html .= '<h2>Good Faith Extimate Of Closing Costs</h2>';
$html .= '<p>The information provided below reflects estimates of the charges you are likely to incur at the settlement of your loan. The fees, commissions, costs and expenses listed are estimates; the actual charges may be more or less. Your transaction may not involve a charge for every item listed and any additional items charged will be listed. The numbers listed beside the estimated items generally correspond to the numbered lines contained in the HUD-1 Settlement Statement which you will receive at settlement if this transaction is subject to RESPA. The HUD-1 Settlement Statement contains the actual costs for the items paid at settlement. When this transaction is subject to RESPA, by signing page four of this form you are also acknowledging receipt of the HUD Guide to Settlement Costs.</p>';

$html .='<table border="1" width="100%">
            <tr>
                <td style="text-align: center;">HUD - 1</td>
                <td style="text-align: center;">Item</td>
                <td style="text-align: center;">Paid To Others</td>
                <td style="text-align: center;">Paid To Broker</td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>800</b></td>
                <td colspan="3"><b>Items Payable in Connection with Loan</b></td>
            </tr>
            <tr>
                <td style="text-align: center;">801</td>
                <td>lenders Loan Origination Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["lender_origination_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["lender_origination_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">802</td>
                <td>Lenders Loan Discount Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["lender_loan_discount_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["lender_loan_discount_fee_other"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">801</td>
                <td>Appraisal Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["appraisal_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["appraisal_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">802</td>
                <td>Credit Report</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["credit_report_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["credit_report_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">801</td>
                <td>Lenders Inspection Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["lender_inception_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["lender_inception_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">802</td>
                <td>Mortgage Broker Commission/Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["mortage_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["mortage_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">801</td>
                <td>Tax Service Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["tax_service_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["tax_service_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">802</td>
                <td>Processing Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["processing_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["processing_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">801</td>
                <td>Underwriting Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["underwriting_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["underwriting_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">802</td>
                <td>Wire Transfer Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["wire_transfer_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["wire_transfer_fee_broker"].'</td>
            </tr>
            <tr>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other1"].'</td>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other2"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other3"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other4"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>900</b></td>
                <td colspan="3"><b>Items Required by Lender to be Paid in Advance</b></td>
            </tr>
            <tr>
                <td style="text-align: center;">901</td>
                <td>Interest for '.$data["GFEStep2"]["DisclosureStatement"]["interest_for_days"].' days at $ '.$data["GFEStep2"]["DisclosureStatement"]["interest_amount_per_day"].'per day </td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["inetrest_to_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["inetrest_to_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">902</td>
                <td>Mortgage Insurance Premiums</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["mortage_insurance_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["mortage_insurance_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">903</td>
                <td>Hazard Insurance Premiums</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["hazard_insurance_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["hazard_insurance_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">904</td>
                <td>County Property Taxes</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["county_taxes_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["county_taxes_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">905</td>
                <td>VA Funding Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["va_funding_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["va_funding_fee_broker"].'</td>
            </tr>
            <tr>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other11"].'</td>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other21"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other31"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other41"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>1000</b></td>
                <td colspan="3"><b>Reserves Deposited with Lender</b></td>
            </tr>
            <tr>
                <td style="text-align: center;">1001</td>
                <td>Hazard Insurance: '.$data["GFEStep2"]["DisclosureStatement"]["hazard_insurance_months"].' months at $ '.$data["GFEStep2"]["DisclosureStatement"]["hazard_amount_per_month"].' /mo. </td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["reserve_hazard_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["reserve_hazard_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">1002</td>
                <td>Mortgage Insurance: '.$data["GFEStep2"]["DisclosureStatement"]["mortagage_insurance_months"].' months at $ '.$data["GFEStep2"]["DisclosureStatement"]["mortgage_amount_per_month"].' /mo.</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["reserve_mortgage_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["reserve_mortgage_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">1004</td>
                <td>Co. Property Taxes: '.$data["GFEStep2"]["DisclosureStatement"]["company_taxas_months"].' months at $ '.$data["GFEStep2"]["DisclosureStatement"]["company_amount_taxes_per_month"].' /mo.</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["reserve_company_taxes_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["reserve_company_taxes_fee_broker"].'</td>
            </tr>
            <tr>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other12"].'</td>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other22"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other32"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other42"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>1100</b></td>
                <td colspan="3"><b>Title Charges</b></td>
            </tr>
            <tr>
                <td style="text-align: center;">1101</td>
                <td>Settlement or Closing/Escrow Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["setting_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["setting_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">1105</td>
                <td>Document Preparation Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["document_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["document_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">1106</td>
                <td>Notary Fee</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["notary_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["notary_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">1108</td>
                <td>Title Insurance</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["insurance_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["insurance_fee_broker"].'</td>
            </tr>
            <tr>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other13"].'</td>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other23"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other33"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other43"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>1200</b></td>
                <td colspan="3"><b>Government Recording and Transfer Charges</b></td>
            </tr>
            <tr>
                <td style="text-align: center;">1201</td>
                <td>Recording Fees</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["recording_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["recording_fee_broker"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;">1202</td>
                <td>City/County Tax/Stamps</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other_fee_broker"].'</td>
            </tr>
            <tr>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other14"].'</td>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other24"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other34"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other44"].'</td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>1300</b></td>
                <td colspan="3"><b>Additional Settlement Charges</b></td>
            </tr>
            <tr>
                <td style="text-align: center;">1302</td>
                <td>Pest Inspection</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["inspection_fee_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["inspection_fee_broker"].'</td>
            </tr>
            <tr>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other15"].'</td>
                <td>'.$data["GFEStep2"]["DisclosureStatement"]["other25"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other35"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["other45"].'</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><b>Subtotals of Initial Fees, Commissions, Costs and Expenses</b></td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["subtotal_other"].'</td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["subtotal_broker"].'</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><b>Total of Initial Fees, Commissions, Costs and Expenses</b></td>
                <td colspan="2">$ '.$data["GFEStep2"]["DisclosureStatement"]["total_fee_other_broker"].'
                </td>
            </tr>
            <tr>
                <td colspan="4"><b>Compensation to Broker (Not Paid Out of Loan Proceeds):</b></td>
            </tr>
            <tr>
                <td colspan="2">Mortgage Broker Commission/Fee</td>
                <td colspan="2">$ '.$data["GFEStep2"]["DisclosureStatement"]["mortage_broker_commission_fee_other"].'
                </td>
            </tr>
            <tr>
                <td colspan="2">Any Additional Compensation from Lender</td>
                <td>';
                    if($data["GFEStep2"]["DisclosureStatement"]["lender_conpensation_status"] == "no"){
                        $html .= '<input  type="checkbox" checked="checked" value="no" name="lender_conpensation_status" readonly="readonly"/> No ';
                    }else{
                        $html .= '<input  type="checkbox"  value="no" name="lender_conpensation_status" readonly="readonly"/> No';
                    }
                    if($data["GFEStep2"]["DisclosureStatement"]["lender_conpensation_status"] == "yes"){
                        $html .= '<input  type="checkbox" checked="checked" value="Yes" name="lender_conpensation_status" readonly="readonly"/> Yes ';
                    }else{
                        $html .= '<input  type="checkbox"  value="yes" name="lender_conpensation_status" readonly="readonly"/> Yes';
                    }
            $html .='
                    <br /> (Approximate Yield Spread Premium or Other Rebate)
                </td>
                <td>$ '.$data["GFEStep2"]["DisclosureStatement"]["additional_compensation_from_lender"].'</td>
            </tr>
    </table>
    <h2>ADDITIONAL REQUIRED CALIFORNIA DISCLOSURES</h2>
    <ol>
        <li>
            <table border="1" width="100%" style="font-size:16px;">
                <tr>
                    <td colspan="2">Proposed Loan Amount: </td>
                    <td colspan="2">'.$data["GFEStep3"]["DisclosureStatement"]["proposed_loan_amount"].' </td>
                </tr>
                <tr>                    
                    <td colspan="2" style="text-align: right;">Initial Commissions, Fees, Costs and Expenses Summarized on Page 1: </td>
                    <td colspan="2" style="text-align: left;">'.$data["GFEStep3"]["DisclosureStatement"]["expanses_summarized_total"].' </td>
                </tr>
                <tr>                    
                    <td colspan="2" style="text-align: right;">Payment of Other Obligations (List): Credit Life and/or Disability Insurance (see XIV below)</td>
                    <td colspan="2" style="text-align: left;">'.$data["GFEStep3"]["DisclosureStatement"]["payment_of_other_obligation"].' </td>
                </tr>
                <tr>                    
                    <td colspan="2" style="text-align: right;">'.$data["GFEStep3"]["DisclosureStatement"]["other1_payment_of_other_obligation"].'</td>
                    <td colspan="2" style="text-align: left;">'.$data["GFEStep3"]["DisclosureStatement"]["other2_payment_of_other_obligation"].' </td>
                </tr>
                <tr>                    
                    <td colspan="2" style="text-align: right;"><b>Subtotal of All Deductions: </b></td>
                    <td colspan="2" style="text-align: left;">'.$data["GFEStep3"]["DisclosureStatement"]["subtotal_of_all_deduction"].' </td>
                </tr>
                <tr>                    
                    <td colspan="2" style="text-align: right;"><b>Estimated Cash at Closing';
                    
                    if($data["GFEStep3"]["DisclosureStatement"]["closing_cash_to_you"] == "to you"){
                        $html .= '<input  type="checkbox" checked="checked" value="no" name="closing_cash_to_you" readonly="readonly"/> To You ';
                    }else{
                        $html .= '<input  type="checkbox"  value="no" name="closing_cash_to_you" readonly="readonly"/> To You';
                    }
                    if($data["GFEStep3"]["DisclosureStatement"]["closing_cash_to_you"] == "you pay"){
                        $html .= '<input  type="checkbox" checked="checked" value="Yes" name="closing_cash_to_you" readonly="readonly"/> ';
                    }else{
                        $html .= '<input  type="checkbox"  value="yes" name="closing_cash_to_you" readonly="readonly"/> ';
                    }

                $html .='That you must pay</b></td>
                    <td colspan="2" style="text-align: left;">'.$data["GFEStep3"]["DisclosureStatement"]["closing_loanAmount_to_you"].' </td>
                </tr>
            </table>
        </li>
        <li>
            <p>
                Proposed Loan Term: '.$data["GFEStep3"]["DisclosureStatement"]["proposed_loan_term"];
                if($data["GFEStep3"]["DisclosureStatement"]["proposed_loan_term_type"] == "years"){
                    $html .= '<input  type="checkbox" checked="checked" value="years" name="proposed_loan_term_type" readonly="readonly"/>Years';
                }else{
                    $html .= '<input  type="checkbox"  value="years" name="proposed_loan_term_type" readonly="readonly"/>Years';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["proposed_loan_term_type"] == "months"){
                    $html .= '<input  type="checkbox" checked="checked" value="months" name="proposed_loan_term_type" readonly="readonly"/>Months';
                }else{
                    $html .= '<input  type="checkbox"  value="months" name="proposed_loan_term_type" readonly="readonly"/>Months';
                }
        $html .='</p>
        </li>
        <li>
            <p>
                Proposed Interest Rate: '.$data["GFEStep3"]["DisclosureStatement"]["proposed_interest_rate"];
                if($data["GFEStep3"]["DisclosureStatement"]["proposed_interest_rate_type"] == "fixed_rate"){
                    $html .= '<input  type="checkbox" value="fixed_rate" checked="checked" name="proposed_interest_rate_type" readonly="readonly"/>Fixed Rate';
                }else{
                    $html .= '<input  type="checkbox" value="fixed_rate" name="proposed_interest_rate_type" readonly="readonly"/>Fixed Rate';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["proposed_interest_rate_type"] == "adjustable_rate"){
                    $html .= '<input  type="checkbox" value="adjustable_rate" checked="checked" name="proposed_interest_rate_type" readonly="readonly"/>Initial Adjustable Rate';
                }else{
                    $html .= '<input  type="checkbox" value="adjustable_rate" name="proposed_interest_rate_type" readonly="readonly"/>Initial Adjustable Rate';
                }
        $html .='</p>
        </li>
        <h3>If the Fixed Rate Box is checked in Section III immediately above, proceed to section X. Do not complete sections IV through IX.</h3>
        <li>
            <p>Initial Adjustable Rate in effect for '.$data["GFEStep3"]["DisclosureStatement"]["initial_adjustable_rate_for_months"].' months</p>
        </li>
        <li>
            <p>Fully Indexed Interest Rate '.$data["GFEStep3"]["DisclosureStatement"]["full_indexed_interest_rate"].' %</p>
        </li>
        <li>
            <p>Maximum Interest Rate  '.$data["GFEStep3"]["DisclosureStatement"]["maximum_interest_rate"].' %</p>
        </li>
        <li>
            <p>Proposed Initial (Minimum) Loan Payment $ '.$data["GFEStep3"]["DisclosureStatement"]["proposed_initial_loan"].' monthly</p>
        </li>
        <li>
            <p>Interest Rate can Increase '.$data["GFEStep3"]["DisclosureStatement"]["interest_rate_can_increase"].' % each '.$data["GFEStep3"]["DisclosureStatement"]["interest_rate_can_increase_months"].' months</p>
        </li>
        <li>
            <p>Payment Options end after '.$data["GFEStep3"]["DisclosureStatement"]["payment_options_end_after_months"].' Months or '.$data["GFEStep3"]["DisclosureStatement"]["payment_options_end_after_percent_loan"].' %  of Original Balance, whichever comes first</p>
        </li>
        <li>
            <p>After '.$data["GFEStep3"]["DisclosureStatement"]["after_these_months"].' months you will not have the option to make minimum or interest only payments and negative amortization (increases in your principal balance), if any, will no longer be allowed. Assuming you have made minimum payments, you may then have to make principal and interest payments of $ '.$data["GFEStep3"]["DisclosureStatement"]["capital_interest_payment"].' at the maximum interest rate in effect for the remaining '.$data["GFEStep3"]["DisclosureStatement"]["you_loan_balance_will_be"].' months of the loan. These payments will be significantly higher than the minimum or interest only payments.</p>
        </li>
        <li>
            <p>If your loan contains negative amortization, at the time no additional negative amortization will accrue, your loan balance will be $'.$data["GFEStep3"]["DisclosureStatement"]["capital_interest_payment"].' assuming minimum payments are made.</p>
        </li>
        <li>
            <p>The loan is subject to a balloon payment: ';
            
            if($data["GFEStep3"]["DisclosureStatement"]["balloon_payment"] == "no"){
                $html .= '<input  type="checkbox" value="no" checked="checked" name="balloon_payment" readonly="readonly" /> No';
            }else{
                $html .= '<input  type="checkbox" value="no" name="balloon_payment" readonly="readonly" />No ';
            }
            if($data["GFEStep3"]["DisclosureStatement"]["balloon_payment"] == "yes"){
                $html .= '<input  type="checkbox" value="yes" checked="checked" name="balloon_payment" readonly="readonly" /> Yes ';
            }else{
                $html .= '<input  type="checkbox" value="yes" name="balloon_payment" readonly="readonly" /> Yes ';
            }
        $html .= ' If Yes, the following paragraph applies and a final balloon payment of $ '.$data["GFEStep3"]["DisclosureStatement"]["balloon_payment_amount"].' will be due on '.$data["GFEStep3"]["DisclosureStatement"]["balloon_payment_due_date"].' [estimated date (month/day/year)].
            </p>
        </li>
        <h3>NOTICE TO BORROwER: IF YOU DO NOT HAVE THE FUNDS TO PAY THE BALLOON PAYMENT wHEN IT COMES DUE, YOU MAY HAVE TO OBTAIN A NEw LOAN AGAINST YOUR PROPERTY TO MAkE THE BAL LOON PAYMENT. IN THAT CASE, YOU MAY AGAIN HAVE TO PAY COMMISSIONS, FEES, AND EXPENSES FOR THE ARRANGING OFTHE NEw LOAN. IN ADDITION, IFYOU ARE UNABLE TO MAkE THE MONTHLY PAYMENTS OR THE BALLOON PAYMENT, YOU MAY LOSE THE PROPERTY AND ALL OF YOUR EQUITY THROUGH FORECLOSURE. kEEP THIS IN MIND IN DECIDING UPON THE AMOUNT AND TERMS OF THIS LOAN.</h3>
        <li>
            <p>Prepayments: The proposed loan has the following prepayment provisions:</p>';
            if($data["GFEStep3"]["DisclosureStatement"]["penalty_options"] == "no_prepayment"){
                $html .= '<input  type="checkbox" value="no_prepayment" checked="checked" name="penalty_options" readonly="readonly" /> No prepayment penalty (you will not be charged a penalty to pay off or refinance the loan before maturity)';
            }else{
                $html .= '<input  type="checkbox" value="no_prepayment" name="penalty_options" readonly="readonly" /> No prepayment penalty (you will not be charged a penalty to pay off or refinance the loan before maturity) ';
            }
            $html .= '<br />';
            if($data["GFEStep3"]["DisclosureStatement"]["penalty_options"] == "yes_prepayment"){
                $html .= '<input  type="checkbox" value="yes_prepayment" checked="checked" name="penalty_options" readonly="readonly" /> You will have to pay a prepayment penalty if the loan is paid off or refinanced in the first '.$data["GFEStep3"]["DisclosureStatement"]["penelty_years"].' years. The prepayment penalty could be as much as $'.$data["GFEStep3"]["DisclosureStatement"]["penelty_amount"].'. Any prepayment of principal in excess of 20% of the <p style="margin-left : 6%;">';
                if($data["GFEStep3"]["DisclosureStatement"]["original_loan_balance"] == "original_loan_balance"){
                    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;<input  value="original_loan_balance" type="checkbox" checked="checked" name="original_loan_balance" readonly="readonly" />  original loan balance or ';
                }else{
                    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;<input  value="original_loan_balance" type="checkbox" name="original_loan_balance" readonly="readonly" />  original loan balance or ';
                }
                $html .= '<br />';
                if($data["GFEStep3"]["DisclosureStatement"]["original_loan_balance"] == "unpaid_loan_balance"){
                    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;<input value="unpaid_loan_balance" type="checkbox" checked="checked" name="original_loan_balance" readonly="readonly" /> unpaid balance ';
                }else{
                    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;<input value="unpaid_loan_balance" type="checkbox" name="original_loan_balance" readonly="readonly" /> unpaid balance ';
                }
                $html .= '<br /><br />for the first '.$data["GFEStep3"]["DisclosureStatement"]["penalty_first_years"].' years will include a penalty not to exceed '.$data["GFEStep3"]["DisclosureStatement"]["penelty_not_exceed"].' months interest at the note interest rate but not more than the interest you would be charged if the loan were paid to maturity.';
            }else{
                $html .= '<input  value="yes_prepayment" type="checkbox" name="penalty_options" readonly="readonly" /> You will have to pay a prepayment penalty if the loan is paid off or refinanced in the first ______ years. The prepayment penalty could be as much as $___________. Any prepayment of principal in excess of 20% of the <p style="margin-left : 6%;">';
                if($data["GFEStep3"]["DisclosureStatement"]["original_loan_balance"] == "original_loan_balance"){
                    $html .= '<input value="original_loan_balance" type="checkbox" checked="checked" name="original_loan_balance" readonly="readonly" />  original loan balance or ';
                }else{
                    $html .= '<input value="original_loan_balance" type="checkbox" name="original_loan_balance" readonly="readonly" />  original loan balance or ';
                }
                $html .= '<br />';
                if($data["GFEStep3"]["DisclosureStatement"]["original_loan_balance"] == "unpaid_loan_balance"){
                    $html .= '<input value="unpaid_loan_balance" type="checkbox" checked="checked" name="original_loan_balance" readonly="readonly" /> unpaid balance ';
                }else{
                    $html .= '<input value="unpaid_loan_balance" type="checkbox" name="original_loan_balance" readonly="readonly" /> unpaid balance ';
                }
                $html .= '<br /><br /> for the first '.$data["GFEStep3"]["DisclosureStatement"]["penalty_first_years"].' years will include a penalty not to exceed '.$data["GFEStep3"]["DisclosureStatement"]["penelty_not_exceed"].' months interest at the note interest rate but not more than the interest you would be charged if the loan were paid to maturity.';
            }
        $html .='</p>';
        if($data["GFEStep3"]["DisclosureStatement"]["penalty_options"] == "other_prepayment"){
            $html .= '<p> <input value="other_prepayment" type="checkbox" checked="checked" name="penalty_options" readonly="readonly" />  Other - you will have to pay a prepayment penalty if the loan is paid off or refinanced in the first '.$data["GFEStep3"]["DisclosureStatement"]["penalty_first_years"].' years as follows:</p>
                    <p>'.$data["GFEStep3"]["DisclosureStatement"]["penalty_other_1"].'</p>
                    <p>'.$data["GFEStep3"]["DisclosureStatement"]["penalty_other_2"].'</p>
            ';
        }else{
            $html .= '<p> <input value="other_prepayment" type="checkbox" name="penalty_options" readonly="readonly" />  Other - you will have to pay a prepayment penalty if the loan is paid off or refinanced in the first ______ years as follows:</p>
                    <p style="border-bottom: 1px solid #333;">&nbsp;</p>
                    <p style="border-bottom: 1px solid #333;">&nbsp;</p>
            ';
        }   
        $html .= '</li>';
        $html .= '<li>
            <p>Taxes and Insurance: </p>';
            if($data["GFEStep3"]["DisclosureStatement"]["taxes_and_insurance"] == "impound_escrow"){
                $html .= '<input value="impound_escrow" type="checkbox" checked="checked" name="taxes_and_insurance" readonly="readonly" />';
            }else{
                $html .= '<input value="impound_escrow" type="checkbox" name="taxes_and_insurance" readonly="readonly" />';
            }
                $html .= 'There will be an impound (escrow) account which will collect approximately $'.$data["GFEStep3"]["DisclosureStatement"]["penalty_first_years"].' a month in addition to your principal and interest payments for the payment of <p style="margin-left : 4%;">';
                
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_escrow_insurance"] == "county_property"){
                    $html .= '<input value="county_property" type="checkbox" checked="checked" name="taxes_escrow_insurance" readonly="readonly" /> county property taxes*';
                }else{
                    $html .= '<input value="county_property" type="checkbox" name="taxes_escrow_insurance" readonly="readonly" /> county property taxes*';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_escrow_insurance"] == "hazard_insurance"){
                    $html .= '<input value="hazard_insurance" type="checkbox" checked="checked" name="taxes_escrow_insurance" readonly="readonly" /> hazard insurance';
                }else{
                    $html .= '<input value="hazard_insurance" type="checkbox" name="taxes_escrow_insurance" readonly="readonly" /> hazard insurance';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_escrow_insurance"] == "mortgage_insurance"){
                    $html .= '<input value="mortgage_insurance" type="checkbox" checked="checked" name="taxes_escrow_insurance" readonly="readonly" /> mortgage insurance';
                }else{
                    $html .= '<input value="mortgage_insurance" type="checkbox" name="taxes_escrow_insurance" readonly="readonly" /> mortgage insurance';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_escrow_insurance"] == "flood_insurance"){
                    $html .= '<input value="flood_insurance" type="checkbox" checked="checked" name="taxes_escrow_insurance" readonly="readonly" /> flood insurance';
                }else{
                    $html .= '<input value="flood_insurance" type="checkbox" name="taxes_escrow_insurance" readonly="readonly" /> flood insurance';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_escrow_insurance"] == "other"){
                    $html .= '<input value="other" type="checkbox" checked="checked" name="taxes_escrow_insurance" readonly="readonly" /> other ';
                }else{
                    $html .= '<input value="other" type="checkbox" name="taxes_escrow_insurance" readonly="readonly" /> other ';
                }
                $html .= $data["GFEStep3"]["DisclosureStatement"]["penalty_first_years"].'</p>';
            if($data["GFEStep3"]["DisclosureStatement"]["taxes_and_insurance"] == "no_impound_escrow"){
                $html .= '<input value="no_impound_escrow" type="checkbox" checked="checked" name="taxes_and_insurance" readonly="readonly" />';
            }else{
                $html .= '<input value="no_impound_escrow" type="checkbox" name="taxes_and_insurance" readonly="readonly" />';
            }
                $html .= 'If there is no impound (escrow) account you will have to plan for the payment of <p style="margin-left : 4%;">';
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_no_escrow_insurance"] == "county_property"){
                    $html .= '<input value="county_property" type="checkbox" checked="checked" name="taxes_no_escrow_insurance" readonly="readonly" /> county property taxes*';
                }else{
                    $html .= '<input value="county_property" type="checkbox" name="taxes_no_escrow_insurance" readonly="readonly" /> county property taxes*';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_no_escrow_insurance"] == "hazard_insurance"){
                    $html .= '<input value="hazard_insurance" type="checkbox" checked="checked" name="taxes_no_escrow_insurance" readonly="readonly" /> hazard insurance';
                }else{
                    $html .= '<input value="hazard_insurance" type="checkbox" name="taxes_no_escrow_insurance" readonly="readonly" /> hazard insurance';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_no_escrow_insurance"] == "mortgage_insurance"){
                    $html .= '<input value="mortgage_insurance" type="checkbox" checked="checked" name="taxes_no_escrow_insurance" readonly="readonly" /> mortgage insurance';
                }else{
                    $html .= '<input value="mortgage_insurance" type="checkbox" name="taxes_no_escrow_insurance" readonly="readonly" /> mortgage insurance';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_no_escrow_insurance"] == "flood_insurance"){
                    $html .= '<input value="flood_insurance" type="checkbox" checked="checked" name="taxes_no_escrow_insurance" readonly="readonly" /> flood insurance';
                }else{
                    $html .= '<input value="flood_insurance" type="checkbox" name="taxes_no_escrow_insurance" readonly="readonly" /> flood insurance';
                }
                if($data["GFEStep3"]["DisclosureStatement"]["taxes_no_escrow_insurance"] == "other"){
                    $html .= '<input value="other" type="checkbox" checked="checked" name="taxes_no_escrow_insurance" readonly="readonly" /> other ';
                }else{
                    $html .= '<input value="other" type="checkbox" name="taxes_escrow_insurance" readonly="readonly" /> other ';
                }
                $html .= $data["GFEStep3"]["DisclosureStatement"]["penalty_first_years"].' of approximately $ '.$data["GFEStep3"]["DisclosureStatement"]["no_escrow_other_option_description"].' per year</p>';
        $html .='</li>';
        $html .= '<h2>* In a purchase transaction, county property taxes are calculated based on the sales price of the property and may require the payment of an additional (supplemental) tax bill from the county tax authority by your lender (if escrowed) or you ifnot escrowed. </h2>
        <li>
            <p>Credit Life and/or Disability Insurance: The purchase of credit life and/or disability insurance by a borrower is NOT required 
 as a condition of making this proposed loan.</p>
        </li>
        <li>
            <p>Other Liens: Are there liens currently on this property for which the borrower is obligated?';
            if($data["GFEStep3"]["DisclosureStatement"]["other_liens_property_obligated"] == "no"){
                $html .= '<input value="no" type="checkbox" checked="checked" name="other_liens_property_obligated" readonly="readonly" /> No';
            }else{
                $html .= '<input value="no" type="checkbox" name="other_liens_property_obligated" readonly="readonly" /> No ';
            }
            if($data["GFEStep3"]["DisclosureStatement"]["other_liens_property_obligated"] == "yes"){
                $html .= '<input value="no" type="checkbox" checked="checked" name="other_liens_property_obligated" readonly="readonly" /> Yes';
            }else{
                $html .= '<input value="no" type="checkbox" name="other_liens_property_obligated" readonly="readonly" /> Yes ';
            }
        $html .= 'If Yes, describe below:</p>
            <table border="1" width="100%">
                <tr>
                    <th>Lien Holders Name</th>
                    <th>Amount Owning</th>
                    <th>Priority</th>
                </tr>
                <tr>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_holder_name_1"].'</td>
                     <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_owing_amount_1"].'</td>
                      <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_priority_1"].'</td>
                </tr>
                <tr>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_holder_name_2"].'</td>
                     <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_owing_amount_2"].'</td>
                      <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_priority_2"].'</td>
                </tr>
                <tr>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_holder_name_3"].'</td>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_owing_amount_3"].'</td>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["lien_priority_3"].'</td>
                </tr>
            </table>
            <p>Liens that will remain or are anticipated on this property after the proposed loan for which you are applying is made or arranged (including the proposed loan for which you are applying):</p>
            <table border="1" width="100%">
                <tr>
                    <th>Lien Holders Name</th>
                    <th>Amount Owning</th>
                    <th>Priority</th>
                </tr>
                <tr>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_holder_name_1"].'</td>
                     <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_owing_amount_1"].'</td>
                      <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_priority_1"].'</td>
                </tr>
                <tr>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_holder_name_2"].'</td>
                     <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_owing_amount_2"].'</td>
                      <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_priority_2"].'</td>
                </tr>
                <tr>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_holder_name_3"].'</td>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_owing_amount_3"].'</td>
                    <td>'.$data["GFEStep3"]["DisclosureStatement"]["anticipated_lien_priority_3"].'</td>
                </tr>
            </table>
            <p>NOTICE TO BORROWER: Be sure that you state the amount of all liens as accurately as possible. If you contract with the broker to arrange this loan, but it cannot be arranged because you did not state these liens correctly, you may be liable to pay commissions, costs, fees, and expenses even though you do not obtain the loan</p>
        </li>
        <li>
            <p>Article 7 Compliance: If this proposed loan is secured by a first deed of trust in a principal amount of less than $30,000 or secured by a junior lien in a principal amount of less than $20,000, the undersigned broker certifies that the loan will be made in compliance with Article 7 of Chapter 3 of the Real Estate Law.</p>
            <ol>
                <li>
                    This loan';
                    if($data["GFEStep3"]["DisclosureStatement"]["article7_compaliance_option"] == "may"){
                        $html .= '<input value="may" type="checkbox" checked="checked" name="article7_compaliance_option" readonly="readonly" /> May';
                    }else{
                        $html .= '<input value="may" type="checkbox" name="article7_compaliance_option" readonly="readonly" /> May ';
                    }
                    if($data["GFEStep3"]["DisclosureStatement"]["article7_compaliance_option"] == "will"){
                        $html .= '<input value="will" type="checkbox" checked="checked" name="article7_compaliance_option" readonly="readonly" /> Will';
                    }else{
                        $html .= '<input value="will" type="checkbox" name="article7_compaliance_option" readonly="readonly" /> Will ';
                    }
                    if($data["GFEStep3"]["DisclosureStatement"]["article7_compaliance_option"] == "will_not"){
                        $html .= '<input value="will_not" type="checkbox" checked="checked" name="article7_compaliance_option" readonly="readonly" /> Will Not';
                    }else{
                        $html .= '<input value="will_not" type="checkbox" name="article7_compaliance_option" readonly="readonly" /> Will Not ';
                    }
                    
                $html .=', be made wholly or in part from broker controlled funds as defined in Section 10241(j) of the Business and Professions Code.
                </li>
                <li>
                    <p>If the broker indicates in the above statement that the loan "may" be made out of broker-controlled funds, the broker must inform the borrower prior to the close of escrow if the funds to be received by the borrower are in fact broker-controlled funds.</p>
                </li>
            </ol>
        </li>
        <li>
            <p>This loan is based on limited or no documentation of your income and/or assets and may have a higher interest rate, or more points or fees than other products requiring documentation:';
            if($data["GFEStep3"]["DisclosureStatement"]["limited_loan_option"] == "no"){
                $html .= '<input value="no" type="checkbox" checked="checked" name="limited_loan_option" readonly="readonly" /> No';
            }else{
                $html .= '<input value="no" type="checkbox" name="limited_loan_option" readonly="readonly" /> No ';
            }
            if($data["GFEStep3"]["DisclosureStatement"]["limited_loan_option"] == "yes"){
                $html .= '<input value="yes" type="checkbox" checked="checked" name="limited_loan_option" readonly="readonly" /> Yes';
            }else{
                $html .= '<input value="yes" type="checkbox" name="limited_loan_option" readonly="readonly" /> Yes ';
            }
            $html .='</p>
        </li>
        <h2 style="text-align: center;">Notice To broker</h2>
        <p><b>If any of the columns in section XIX, Comparison of Sample Mortgage Features, on page 4 of this RE 885 form, are not completed, you must certify to the following:</b></p>
        <h3 style="text-align: center;">Certification</h3>
        <p>I, '.$data["GFEStep3"]["DisclosureStatement"]["certification_borrower_name"].', hereby certify (or declare) that the failure to complete the information in any or all of the columns (with the exception of the last column "Proposed Loan" in the Typical Mortgage Transactions portion of this RE 885) is either because (1) after a diligent search, I have determined that the product specified in that column is not available to consumers from mortgage lenders, or (2) the borrower to whom this form applies does not qualify for that particular product.</p>
        <p>I certify (or declare) under penalty of perjury under the laws of the State of California that the foregoing is true and correct.</p>
        <table border="1" width="100%">
            <tr>
                <td>
                    <p style="border-bottom : 1px solid #333;">';
                    if(!empty($data["GFEStep3"]["DisclosureStatement"]["brokerSignature"])){
                        $html .= '<img src="data:'.$data["GFEStep3"]["DisclosureStatement"]["brokerSignature"].'"/></p>';
                    }
                $html .= '
                </td>
               <td>
                    <p style="border-bottom : 1px solid #333;">Date : '.$data["GFEStep3"]["DisclosureStatement"]["certification_date"].'</p>
                </td>
            </tr>
        </table>
        <p>Disclosure Description : '.$data["GFEStep3"]["DisclosureStatement"]["disclosure_description"].'</p>
    </ol>
';
//echo $html;die;
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output(WWW_ROOT . 'files/pdf/GFE' . DS . 'GFE_'.base64_encode($this->Session->read("GFE_Loan_id")).'.pdf', 'F');