<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
 
$pdf = new XTCPDF('L', PDF_UNIT, 'Letter Of Intent', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Letter Of Intent');
$pdf->SetSubject('Letter Of Intent');

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

$purchasePrice = $arrTrustDeed['TrustDeed']['purchase_price'];
$entitlementToDate = $arrTrustDeed['TrustDeed']['entitlement_todate'];

$total = $purchasePrice + $entitlementToDate;

$totalPPETD = number_format($total, 2, '.', ',');

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

$html = '<table border="1" width="100%">
        <tr>
            <td style="width:20%"><img src="'.$logo.'" border="0" height="150px;" /></td>
            <td style="width:80%">
                <table border="0" cellspacing="8" style="font-size:16" align="right">
                    <tr>
                        <td>Rockland Commercial, Inc. 222 N Sepulveda Blvd STE 2000 El Segundo, CA 90245</td>
                    </tr>
                    <tr>
                        <td>Phone:(310)709-5752 Fax:(310)622-4186 <a href="www.californiaprivatemoneyloans.com">www.californiaprivatemoneyloans.com</a></td>
                    </tr>
                    <tr>
                        <td>Email: <a href="jchaney@rocklandcommercial.com" title="mailto :jchaney@rocklandcommercial.com">jchaney@rocklandcommercial.com</a></td>
                    </tr>
                    <tr>
                        <td>California Department of Real Estate - Real Estate Broker License #01475676</td>
                    </tr>                    
                </table>
            </td>
        </tr>
</table>';

$html .= '<table border="0" width="100%">
            <tr>
                <td style="font-size: 16px;font-weight: bold;">
                    TRUST DEED INVESTMENT PROPOSALS
                </td>
            </tr>
            <tr>
                <td style="font-size: 16px;font-weight: bold;padding-right: 300px;" align="right;">
                    INVESTMENTS: Jeff Chaney
                </td>
            </tr>            
        </table>';
 
$html .= '<table border="1" width="100%">';
$html .= '<tr>
                <td>';
        $html .= '<table border="0" cellspacing="10" cellpadding="0" style="font-size: 12px;">';
        $html .= '
                        <tr>
                            <td style="font-weight: bold;">1 Trust Deed Loan</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">9.99% Note Rate</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">3 Months Prepay</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;padding: 100px 100px 100px 100px;">12 Month Loan Term</td>
                        </tr>';        
        $html .= '
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Transaction Type: Purchase</td>
                        </tr>
                        
                        <tr>
                            <td>
                                <table border="0" width="70%">
                                    <tr>
                                        <td>
                                            Purchase Price :
                                        </td>
                                        <td align="right">
                                            $'.number_format($purchasePrice, 2, '.', ',').'
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Entitlements to date :
                                        </td>
                                        <td align="right">
                                            <u>$'.number_format($entitlementToDate, 2, '.', ',').'</u>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="right">
                                            $'.$totalPPETD.'
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Requested 1<sup>st</sup> TD Loan Amount: $'.$reqFirstTdLoan.'</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>LTV: '.$ltv.'%</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Property Addresses: 1900 Pacific Coast Hwy
</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Property Type: '.$propertyType.'</td>
                        </tr>
                        <tr>
                            <td>Property Description: '.$bed.' bed/'.$bath.' bath</td>
                        </tr>
                        <tr>
                            <td>Year Built: '.$yearBuilt.'</td>
                        </tr>
                        <tr>
                            <td>SqFt (Structure): '.number_format($sq_ft_structure, 2, '.', ',').' total</td>
                        </tr>
                        <tr>
                            <td>SqFt (Lot): '.number_format($sq_ft_lot, 2, '.', ',').' total</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Occupancy: '.$occupancy_type.' Occupied</td>
                        </tr>
                        <tr>
                            <td>Monthly Rental Income: $'.number_format($monthly_rental_income, 2, '.', ',').'/month</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Borrower: LLC'.$borrower_entity_type.'</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Fico: '.$personal_guarantor.'</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Occupation: '.$occupation_guarantor.'</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Exit Strategy: '.$exit.'</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        ';

        $html .= '
                    </table>
                </td>
                <td>
                    <table border="0" cellspacing="10" cellpadding="0">
                        <tr><td><img src="'.$img.'" border="0"  /></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td><img src="'.$img.'" border="0"  /></td></tr>
                    </table>
                </td>
            </tr>            
        </table>';        
        
$pdf->writeHTML($html, true, false, true, false, ''); 
$pdf->lastPage(); 
echo $pdf->Output(WWW_ROOT . 'files/pdf' . DS . 'letter_of_intent.pdf', 'F');