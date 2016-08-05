<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
class MYPDF extends XTCPDF {
   
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', '', 16);
       
        $this->Cell(0, 10, 'Federal Truth In Lending '.$this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF('L', PDF_UNIT, 'GFE', true, 'UTF-8', false);

$pdf->SetSubject('(GFE)');
$pdf->AddPage();
$pdf->SetFont('times', '', 12);
$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

$html = '<h2>Federal Truth In Lending Disclosure Statement</h2>';
$html .='<table border="1" width="100%">
            <tr>
                <td colspan="2">
                    <p style="padding : 10px;">
                        Creator : <u>'.$data["DisclosureStatement"]["til_creater"].'</u>
                    </p>        
                </td>
                <td colspan="2">
                    <p style="padding : 10px;">
                        Loan Number : <u>'.$data["DisclosureStatement"]["til_loan_number"].'</u> <br/>
                        Borrower Name : <u>'.$data["DisclosureStatement"]["til_borrower_name"].'</u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: center;border : 1px solid #333;padding : 10px 20px;">
                        <b>Annual Percentage Rate</b>
                        <p>The cost of your credit as a yearly rate : $ <u>'.$data["DisclosureStatement"]["til_annual_percentage_rate"].'</u></p>
                    </p>
                </td>
                <td>
                    <p style="text-align: center;border : 1px solid #333;padding : 10px 20px;">
                        <b>Finanace Charge</b>
                        <p>The dollar amount the credit will cost you : $ <u>'.$data["DisclosureStatement"]["til_finance_charge"].'</u></p>
                    </p>
                </td>
                <td>
                    <p style="text-align: center;border : 1px solid #333;padding : 10px 20px;">
                        <b>Amount Financed</b>
                        <p>The amount of credit provided to you or on your behalf : $ <u>'.$data["DisclosureStatement"]["til_amount_credit"].'</u></p>
                    </p>
                </td>
                <td>
                    <p style="text-align: center;border : 1px solid #333;padding : 10px 20px;">
                        <b>Total Of Payments</b>
                        <p>The amount you will have paid after you have made all payments as scheduled : $ <u>'.$data["DisclosureStatement"]["til_total_of_payemtns"].'</u></p>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p style="padding : 10px;">
                        <h4>Your payment schedule will be:</h4>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;border : 1px solid #333;padding : 10px 20px;"><b>Number of Payments : </b> <u>'.$data["DisclosureStatement"]["til_balloon_pay_1"].'</u></td>
                <td style="text-align: center;border : 1px solid #333;padding : 10px 20px;"><b>Amount of Payments : </b> $ <u>'.$data["DisclosureStatement"]["til_balloon_pay_2"].'</u></td>
                <td colspan="2" style="text-align: center;border : 1px solid #333;padding : 10px 20px;"><b>When Payments are Due :</b> <u>'.$data["DisclosureStatement"]["til_balloon_pay_3"].'</u></td>
            </tr>
            <tr>
                <td style="padding : 10px 20px;">Insurance : </td>
                <td colspan="3" style="padding : 10px 20px;">Credit life and disability insurance is not required to obtain credit, and will not be provided unless you sign and agree to pay the additional cost. You may obtain property insurance from anyone you want that is acceptable to creditor.</td>
            </tr>
            <tr>
                <td style="padding : 10px 20px;">Security : </td>
                <td colspan="3" style="padding : 10px 20px;">You are giving a security interest in:  </td>
            </tr>
            <tr>
                <td style="padding : 10px 20px;">Late Charges : </td>
                <td colspan="3" style="padding : 10px 20px;">If a payment is late, you will be charged $<u>'.$data["DisclosureStatement"]["til_late_payment_charged"].'</u> of the payment.</td>
            </tr>
            <tr>
                <td style="padding : 10px 20px;">Filing Fee : </td>
                <td colspan="3" style="padding : 10px 20px;">$ <u>'.$data["DisclosureStatement"]["til_filing_fee"].'</u></td>
            </tr>
            <tr>
                <td style="padding : 10px 20px;">Pre-payment : </td>
                <td colspan="3" style="padding : 10px 20px;">If you pay off your loan early, you';
                if($data["DisclosureStatement"]["til_pre_payment_pay"] == "may"){
                    $html .= '<input  type="checkbox" checked="checked" value="may" name="til_pre_payment_pay" readonly="readonly"/> may ';
                }else{
                    $html .= '<input  type="checkbox"  value="may" name="til_pre_payment_pay" readonly="readonly"/> may';
                }
                if($data["DisclosureStatement"]["til_pre_payment_pay"] == "may_not"){
                    $html .= '<input  type="checkbox" checked="checked" value="may_not" name="til_pre_payment_pay" readonly="readonly"/> may not ';
                }else{
                    $html .= '<input  type="checkbox"  value="may_not" name="til_pre_payment_pay" readonly="readonly"/> may not';
                }
                
                $html .=' have to pay a penalty. If you pay off early, you';
                    if($data["DisclosureStatement"]["til_pre_payment_pay_early"] == "may"){
                        $html .= '<input  type="checkbox" checked="checked" value="may" name="til_pre_payment_pay_early" readonly="readonly"/> may ';
                    }else{
                        $html .= '<input  type="checkbox"  value="may" name="til_pre_payment_pay_early" readonly="readonly"/> may';
                    }
                    if($data["DisclosureStatement"]["til_pre_payment_pay_early"] == "may_not"){
                        $html .= '<input  type="checkbox" checked="checked" value="may_not" name="til_pre_payment_pay_early" readonly="readonly"/> may not ';
                    }else{
                        $html .= '<input  type="checkbox"  value="may_not" name="til_pre_payment_pay_early" readonly="readonly"/> may not';
                    }
                
                $html .=' be entitled to a refund of part of the finance charge.</td>
            </tr>
            <tr>
                <td style="padding : 10px 20px;">Assumption : </td>
                <td colspan="3" style="padding : 10px 20px;">Someone buying your property';
                    if($data["DisclosureStatement"]["til_assumption"] == "may"){
                        $html .= '<input  type="checkbox" checked="checked" value="may" name="til_assumption" readonly="readonly"/> may ';
                    }else{
                        $html .= '<input  type="checkbox"  value="may" name="til_assumption" readonly="readonly"/> may';
                    }
                    if($data["DisclosureStatement"]["til_assumption"] == "may_not"){
                        $html .= '<input  type="checkbox" checked="checked" value="til_assumption" name="til_pre_payment_pay_early" readonly="readonly"/> may not ';
                    }else{
                        $html .= '<input  type="checkbox"  value="may_not" name="til_assumption" readonly="readonly"/> may not';
                    }
                $html .= ' be allowed to assume the remainder of the mortgage on the original terms.</td>
            </tr>
            <tr>
                <td colspan="4" style="padding : 10px 20px;">See your contract documents for any additional information about non-payment, default, and required repayment in full before the scheduled date, and penalties.</td>
            </tr>
            <tr>
                <td colspan="4">
                    <ol>
                        <li>Amount Given to You Directly $ <u>'.$data["DisclosureStatement"]["til_directly_amount"].'</u></li>
                        <li>Amount Paid on Your Account $ <u>'.$data["DisclosureStatement"]["til_paid_account"].'</u></li>
                        <li>
                            Amounts Paid to Others on Your Behalf:
                            <ul>
                                <li>Lenders Title Insurance : $ <u>'.$data["DisclosureStatement"]["til_lenders_insurance"].'</u></li>
                                <li>Notary Fee : $ <u>'.$data["DisclosureStatement"]["til_notary_fee"].'</u></li>
                                <li>Recording Fee : $ <u>'.$data["DisclosureStatement"]["til_recording_fee"].'</u></li>
                                <li>Settlement or Closing/Escrow Pad : $ <u>'.$data["DisclosureStatement"]["til_closing_pad"].'</u></li>
                                <li>Settlement or Closing/Escrow Fee : $ <u>'.$data["DisclosureStatement"]["til_closing_fee"].'</u></li>
                            </ul>
                        </li>
                        <li>
                            Amounts Paid to Creditor or Agent on Your Behalf (not a prepaid finance charge):
                            <ul>
                                <li>Wire Transfer Fee - Rockland Commercial, Inc. $ <u>'.$data["DisclosureStatement"]["til_wire_tranfer_fee"].'</u></li>
                                <li>Rockland Commercial Wire Transfer F - Rockland Commercial, Inc $ <u>'.$data["DisclosureStatement"]["til_rocland_wire_tranfer"].'</u></li>
                                <li>Rockland Commercial Credit Investig $ <u>'.$data["DisclosureStatement"]["til_recoland_credit_investment"].'</u></li>
                            </ul>
                        </li>
                        <li>Amount Financed $ <u>'.$data["DisclosureStatement"]["til_amount_financed"].'</u></li>
                        <li>Prepaid Finance Charge $ <u>'.$data["DisclosureStatement"]["til_prepaid_finance"].'</u></li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="4">';
                    if($data["DisclosureStatement"]["til_if_checked"] == "if_checked"){
                        $html .= '<input  type="checkbox" checked="checked" value="if_checked name" name="til_if_checked" readonly="readonly"/> ';
                    }else{
                        $html .= '<input  type="checkbox"  value="if_checked" name="til_if_checked" readonly="readonly"/> ';
                    }
                $html .= ' if checked, a credit life and disability insurance disclosure is attached.</td>
            </tr>
            <tr>
            <td colspan="4">This property <br />';
                if($data["DisclosureStatement"]["til_principal_dwelling"] == "is"){
                    $html .= '<input  type="checkbox" checked="checked" value="is" name="til_principal_dwelling" readonly="readonly"/> is my principal dwelling';
                }else{
                    $html .= '<input  type="checkbox"  value="if_checked" name="til_principal_dwelling" readonly="readonly"/> is my principal dwelling';
                }
                $html .= '<br />';
                if($data["DisclosureStatement"]["til_principal_dwelling"] == "is_not"){
                    $html .= '<input  type="checkbox" checked="checked" value="if_checked name="til_principal_dwelling" readonly="readonly"/> is not my principal dwelling';
                }else{
                    $html .= '<input  type="checkbox"  value="if_checked" name="til_principal_dwelling" readonly="readonly"/> is not my principal dwelling';
                }
                $html .= '</td>
            </tr>
            <tr>
                <td colspan="4"><b><u>I/We acknowledge receipt of a copy of this statement.</u></b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td>
                    <p style="font-weight: bold;font-family: cursive;font-style: italic;text-align: center;font-size: 25px;"><b><u>'.$data["DisclosureStatement"]["til_borrower_name"].'</u></b></p>
                    <p style="text-align: center;">'.$data['DisclosureStatement']['today_date'].'</p>
                </td>
            </tr>
        </table>';
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output(WWW_ROOT . 'files/pdf/TIL' . DS . 'TIL_'.base64_encode($loanId).'.pdf', 'F');