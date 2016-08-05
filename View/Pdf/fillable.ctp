<?php
header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
class MYPDF extends XTCPDF {
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', '', 12);
        $this->Cell(0, 1, 'Freddie Mac Form 65 01/04', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Freddie Mac Form 65 01/04', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$loanPurpose = !empty($loanDetail['Loan']['purpose_of_loan'])?$loanDetail['Loan']['purpose_of_loan']:'';
$amount = !empty($loanDetail['Loan']['loan_amount'])?$loanDetail['Loan']['loan_amount']:'';
$interestRate = '0.30';
$propertyAddress = !empty($loanDetail['Loan']['address'])?$loanDetail['Loan']['address']:'';
$noUnits = !empty($propertyDetail['TrustDeed']['no_of_units'])?$propertyDetail['TrustDeed']['no_of_units']:'';
$monthNumber = '17';
$yearBuilt = !empty($propertyDetail['TrustDeed']['year_built'])?$propertyDetail['TrustDeed']['year_built']:'';

$borrowerID = $loanDetail['ShortApplication']['borrower_ID'];
$borrowerDetail = $this->Common->getUserDetail($borrowerID);

$phoneNumber = !empty($loanDetail['ShortApplication']['applicant_phone'])?$loanDetail['ShortApplication']['applicant_phone']:'';
$dob = !empty($borrowerDetail['UserDetail']['birthdate'])?$borrowerDetail['UserDetail']['birthdate']:'';
$borrowerName = !empty($borrowerDetail['User']['name'])?$borrowerDetail['User']['name']:'';
$loanID = base64_encode($loanDetail['Loan']['id']);

$pdf = new MYPDF('L', PDF_UNIT, '1003', true, 'UTF-8', false);
$pdf->SetTitle('1003');
$pdf->SetSubject('1003');
$pdf->AddPage();

$pdf->SetFont('times', '', 12);
$logo = '/app/webroot/img/banner.jpg';
$img = '/app/webroot/img/pdf.jpg';

/**
 *@pdf form values
 */
$pdf->setFontSubsetting(true);

$html = '<h1 align="center">Uniform Residential Loan Application</h1><p>This application is designed to be completed by the applicant(s) with the Lenders assistance. Applicants should complete this form as "Borrower" or "Co-Borrower", as applicable.Co-Borrower information must also be provided (and the appropriate box checked) when <input type="checkbox" name="firstName" size="5" value="fsfsf" style="width:30%;height:30%"/>the income or assets of a person other than the "Borrower" (including the Borrowers spouse) will be used as a basis for loan qualification or <input type="checkbox" name="firstName" size="5" value="1" style="width:30px;height:30px"/>the income or assets of the Borrowers spouse will not be used as a basis for loan qualification, but his or her liabilities
must be considered because the Borrower resides in a community property state, the security property is located in a community property state, or the Borrower is relying on other
property located in a community property state as a basis for repayment of the loan.</p>';

$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">I. TYPE OF MORTAGE AND TERMS OF LOAN</h4>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">
                <table>
                    <tr>
                        <td style="width:15%">Mortgage</td>
                        <td style="width:15%"><input type="checkbox" value="VA" size="5" name="mortgage_type">VA</td>
                        <td style="width:25%;"><input type="checkbox" value="Conventional" size="5" name="mortgage_type">Conventional</td>
                        <td style="width:30%"><input type="checkbox" value="Conventional" size="5" name="mortgage_type">Other (explain)</td>
                    </tr>
                   <tr>
                        <td style="width:15%">Applied For</td>
                        <td style="width:15%"><input type="checkbox" value="VA" size="5" name="mortgage_type">FHA</td>
                        <td style="width:25%;"><input type="checkbox" value="Conventional" size="5" name="mortgage_type">USDA/Rural Housing Service</td>
                        <td style="width:20%" ><input type="text" value="" size="20" name="other_mortage"></td>
                    </tr>
                </table>    
            </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">
                 <table>
                    <tr>
                        <td >Agency Case Number</td>
                    </tr>
                     <tr>
                        <td><input type="text" size="30" name="agency_number"></td>
                    </tr>
                </table>    
            </td>
            <td style="border-bottom-width:0.1px;width:25%">
                 <table>
                    <tr>
                        <td>Lender Case Number</td>
                    </tr>
                     <tr>
                        <td><input type="text" size="30" name="lender_number"></td>
                    </tr>
                </table>    
            </td>
        </tr>
        <tr>
            <td style="border-right-width:0.1px;width:15%">
                <table>
                   <tr>
                       <td>Amount</td>
                   </tr>
                    <tr>
                       <td>$'.$amount.'</td>
                   </tr>
               </table>    
             </td>
             <td style="border-right-width:0.1px;width:15%">
                <table>
                   <tr>
                       <td>Interest Rate</td>
                   </tr>
                    <tr>
                       <td>'.$interestRate.'%</td>
                   </tr>
               </table>    
             </td>
              <td style="border-right-width:0.1px;width:15%">
                <table>
                   <tr>
                       <td>No. of Months</td>
                   </tr>
                    <tr>
                       <td>'.$monthNumber.'</td>
                   </tr>
               </table>    
             </td>
              <td style="width:55%">Amortization type
               <table>
                    <tr>
                        <td style="width:25%"><input type="checkbox" value="Fixed Rate" size="5" name="amortization_type">Fixed Rate</td>
                        <td style="width:75%"><input type="checkbox" value="Other" size="5" name="amortization_type">Other (explain):<input type="text" value="" size="20" name="other_amortization_type"></td>
                    </tr>
                    <tr>
                        <td style="width:25%"><input type="checkbox" value="Fixed Rate" size="5" name="amortization_type">GPM</td>
                        <td style="width:75%"><input type="checkbox" value="Other" size="5" name="amortization_type">ARM (type):<input type="text" value="" size="20" name="other_amortization_type"></td>
                    </tr>
                </table>
             </td>
            </tr>
        
</table>';
$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">II. PROPERTY INFROMATION AND PURPOSE OF LOAN</h4>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:85%">
                <table>
                       <tr>
                           <td>Subject Property Address (street, city, state, & ZIP)</td>
                       </tr>
                        <tr>
                           <td>'.$propertyAddress.'</td>
                       </tr>
                  
                </table>    
            </td>
            <td style="border-bottom-width:0.1px;width:15%">
                 <table>
                    <tr>
                        <td >No. of Units</td>
                    </tr>
                     <tr>
                        <td>'.$noUnits.'</td>
                    </tr>
                </table>    
            </td>
           
        </tr>
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:80%">
                <table>
                   <tr>
                       <td>Legal Description of Subject Property (attach description if necessary)</td>
                   </tr>
                    <tr>
                       <td><input type="text" value="" size="20" name="other_amortization_type"></td>
                   </tr>
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;width:15%">
                <table>
                   <tr>
                       <td>Year Built</td>
                   </tr>
                    <tr>
                       <td>'.$yearBuilt.'</td>
                   </tr>
               </table>    
             </td>
        </tr>
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">
                <table>
                   <tr>
                       <td>Purpose of Loan - '.$loanPurpose.'</td>
                   </tr>
                    
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;width:40%">
                <table>
                   <tr>
                       <td>Property will be in:</td>
                   </tr>
                    <tr>
                       <td style="width:35%"><input type="checkbox" value="primary" size="5" name="mortgage_type">Primary Residence</td>
                        <td style="width:35%"><input type="checkbox" value="secondary" size="5" name="mortgage_type">Secondary Residence</td>
                         <td style="width:30%;"><input type="checkbox" value="Investment" size="5" name="mortgage_type">Investment</td>
                   </tr>
               </table>    
             </td>
             
        </tr>
        <tr>
            <td><strong>Complete this line if construction or construction-permanent loan.</strong></td>
        </tr>
          <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Year Lot Acquired</td>
                               </tr>
                                <tr>
                                   <td><input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Original Cost</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Amount Existing Liens</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>(a) Present Value of Lot</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Cost of Improvements</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
              <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Total (a + b)</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="0" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
        </tr>
        <tr>
            <td style="width:100%"><strong>Complete this line if this is a refinance loan.</strong></td>
        </tr>
          <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Year Lot Acquired</td>
                               </tr>
                                <tr>
                                   <td><input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Original Cost</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Amount Existing Liens</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Purpose of Refinance</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td style="width:100%">Describe Improvements
                                    <input type="checkbox" value="made" size="5" name="improvement_type">made
                                   <input type="checkbox" value="be_made" size="5" name="improvement_type">to be made
                                   </td>
                               </tr>
                                <tr>
                                   <td>Cost : $<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
               </table>    
             </td>
        </tr>
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:30%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Title will be held in what Name(s)</td>
                               </tr>
                                <tr>
                                   <td><input type="text" value="" size="60" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:30%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Manner in which Title will be held</td>
                               </tr>
                                <tr>
                                   <td>$<input type="text" value="" size="15" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Estate will be held in:</td>
                              
                                   <td><input type="checkbox" value="simple" size="5" name="mortgage_type">Fee Simple</td>
                                    <td><input type="checkbox" value="leasehold" size="5" name="mortgage_type">Leasehold</td>
                               </tr>
                                
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
             
        </tr>
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%">
                <table>
                   <tr>
                       <td>
                            <table>
                               <tr>
                                   <td>Source of Down Payment, Settlement Charges and/or Subordinate Financing (explain)</td>
                               </tr>
                                <tr>
                                   <td><input type="text" value="" size="60" name="mortgage_type"></td>
                               </tr>
                           </table>    
                        </td>
                    </tr>
                             
               </table>    
             </td>
        </tr>
</table>';

//Borrower Information

$html .= '<h6 align="left">Borrower</h6><h4 align="center" style="background-color:#000;color:#FFFFFF;">III. BORROWER INFROMATION</h4><h6 align="right">Co-Borrower</h6>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
        <tr>
        <td style="width:50%">
            <table>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td>Borrowers Name (include Jr. or Sr. if applicable)</td>
                                        </tr>
                                         <tr>
                                            <td>'.$borrowerName.'</td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                                      
                        </table>    
                    
                    </td>
                
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td style="width:25%">Social Security Number</td>
                                            <td style="width:25%">Home Phone (incl. area code</td>
                                            <td style="width:25%">DOB (MM/DD/YYYY)</td>
                                            <td style="width:15%">Yrs. School</td>
                                        </tr>
                                         <tr>
                                            <td><input type="text" value="" size="15" name="mortgage_type"></td>
                                            <td>'.$phoneNumber.'</td>
                                            <td>'.$dob.'</td>
                                            <td><input type="text" value="" size="20" name="mortgage_type"></td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                                      
                        </table>    
                    
                    </td>
                
                </tr>
            
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td style="width:30%"><input type="checkbox" value="married" size="2" name="mortgage_type">Married</td>
                                            <td style="width:30%"><input type="checkbox" value="unmarried" size="2" name="mortgage_type">Unmarried(include single,divorced, widowed)</td>
                                            <td style="width:40%"><input type="checkbox" value="" size="2" name="mortgage_type">Dependents (not listed by Co-Borrower)</td>
                                        
                                        </tr>
                                         <tr>
                                            <td style="width:30%"><input type="checkbox" value="separated" size="2" name="mortgage_type">Separated</td>
                                            <td style="width:30%"></td>
                                            <td style="width:40%">no.<input type="text" value="" size="4" name="mortgage_type">ages.<input type="text" value="" size="4" name="mortgage_type"></td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr> 
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td style="width:55%">Present Address (street, city, state, ZIP)</td>
                                            <td style="width:45%">
                                                <input type="checkbox" value="Own" size="2" name="address_type">Own
                                                <input type="checkbox" value="Rent" size="2" name="address_type">Rent
                                                <input type="text" value="" size="4" name="mortgage_type">No Yrs
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <input type="text" value="" size="100" name="">
                                            </td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                        </table>    
                    
                    </td>
                
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td>Mailing Address, if different from Present Address</td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <input type="text" value="" size="100" name="">
                                            </td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                        </table>    
                    
                    </td>
                
                </tr>
            </table>
        </td>

        <td style="width:50%">
             <table>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td>Co-Borrowers Name Name (include Jr. or Sr. if applicable)</td>
                                        </tr>
                                         <tr>
                                            <td><input type="text" value="" size="60" name="mortgage_type"></td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                                      
                        </table>    
                    
                    </td>
                
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td style="width:25%">Social Security Number</td>
                                            <td style="width:25%">Home Phone (incl. area code</td>
                                            <td style="width:25%">DOB (MM/DD/YYYY)</td>
                                            <td style="width:15%">Yrs. School</td>
                                        </tr>
                                         <tr>
                                            <td><input type="text" value="" size="15" name="mortgage_type"></td>
                                            <td><input type="text" value="" size="20" name="mortgage_type"></td>
                                            <td><input type="text" value="" size="20" name="mortgage_type"></td>
                                            <td><input type="text" value="" size="20" name="mortgage_type"></td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                                      
                        </table>    
                    
                    </td>
                
                </tr>
            
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td style="width:30%"><input type="checkbox" value="married" size="2" name="mortgage_type">Married</td>
                                            <td style="width:30%"><input type="checkbox" value="unmarried" size="2" name="mortgage_type">Unmarried(include single,divorced, widowed)</td>
                                            <td style="width:40%"><input type="checkbox" value="" size="2" name="mortgage_type">Dependents (not listed by Borrower))</td>
                                        
                                        </tr>
                                         <tr>
                                            <td style="width:30%"><input type="checkbox" value="separated" size="2" name="mortgage_type">Separated</td>
                                            <td style="width:30%"></td>
                                            <td style="width:40%">no.<input type="text" value="" size="4" name="mortgage_type">ages.<input type="text" value="" size="4" name="mortgage_type"></td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr> 
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td style="width:55%">Present Address (street, city, state, ZIP)</td>
                                            <td style="width:45%">
                                                <input type="checkbox" value="Own" size="2" name="address_type">Own
                                                <input type="checkbox" value="Rent" size="2" name="address_type">Rent
                                                <input type="text" value="" size="4" name="mortgage_type">No Yrs
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <input type="text" value="" size="100" name="">
                                            </td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                        </table>    
                    
                    </td>
                
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>
                                     <table>
                                        <tr>
                                            <td>Mailing Address, if different from Present Address</td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <input type="text" value="" size="100" name="">
                                            </td>
                                        </tr>
                                    </table>    
                                 </td>
                             </tr>
                        </table>    
                    
                    </td>
                
                </tr>
            </table>
        
        
        </td>
        </tr>
        <tr>
            <td style="width:100%;border-bottom-width:0.1px;"><strong>If residing at present address for less than two years, complete the following:</strong></td>
        </tr>
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">                    
                <table>
                    <tr>
                        <td>
                             <table>
                                <tr>
                                    <td style="width:55%">Former Address (street, city, state, ZIP)</td>
                                    <td style="width:45%">
                                        <input type="checkbox" value="Own" size="2" name="address_type">Own
                                        <input type="checkbox" value="Rent" size="2" name="address_type">Rent
                                        <input type="text" value="" size="4" name="mortgage_type">No Yrs
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <input type="text" value="" size="100" name="">
                                    </td>
                                </tr>
                            </table>    
                         </td>
                     </tr>
                </table>
            </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">                    
                <table>
                    <tr>
                        <td>
                             <table>
                                <tr>
                                    <td style="width:55%">Former Address (street, city, state, ZIP)</td>
                                    <td style="width:45%">
                                        <input type="checkbox" value="Own" size="2" name="address_type">Own
                                        <input type="checkbox" value="Rent" size="2" name="address_type">Rent
                                        <input type="text" value="" size="4" name="mortgage_type">No Yrs
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <input type="text" value="" size="100" name="">
                                    </td>
                                </tr>
                            </table>    
                         </td>
                     </tr>
                </table>
            </td>
        </tr>
        
</table>';
//Employment Information
$html .= '<h6 align="left">Borrower</h6><h4 align="center" style="background-color:#000;color:#FFFFFF;">IV. EMPLOYEMENT INFORMATION</h4><h6 align="right">Co-Borrower</h6>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td>
                                             <table>
                                                <tr>
                                                   <td style="width:50%">Name & Address of Employer<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="border-right-width:0.1px;width:30%"><input type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                                   <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:20%">Yrs. on this job<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                                <tr>
                                                   <td style="width:55%"><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="width:25%"></td>
                                                   <td style="width:20%">Yrs. employed in this
line of work/profession<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                </table>    
                            </td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td style="border-bottom-width:0.1px;border-right-width:0.1px;">
                                             <table>
                                                <tr>
                                                    <td style="width:60%">Position/Title/Type of Business</td>
                                                    <td style="width:40%">Business Phone (incl. area code)</td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td><input type="text" value="" size="45" name="mortgage_type"></td>
                                                    <td><input type="text" value="" size="50" name="mortgage_type"></td>
                                                    
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                              
                                </table>    
                            
                            </td>
                        
                        </tr>
                    
                       
                    </table>
                </td>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td>
                                             <table>
                                                <tr>
                                                   <td style="width:50%">Name & Address of Employer<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="border-right-width:0.1px;width:30%"><input type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                                   <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:20%">Yrs. on this job<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                                <tr>
                                                   <td style="width:55%"><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="width:25%"></td>
                                                   <td style="width:20%">Yrs. employed in this
line of work/profession<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                </table>    
                            </td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td style="border-bottom-width:0.1px;border-right-width:0.1px;">
                                             <table>
                                                <tr>
                                                    <td style="width:60%">Position/Title/Type of Business</td>
                                                    <td style="width:40%">Business Phone (incl. area code)</td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td><input type="text" value="" size="45" name="mortgage_type"></td>
                                                    <td><input type="text" value="" size="50" name="mortgage_type"></td>
                                                    
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                              
                                </table>    
                            
                            </td>
                        
                        </tr>
                    
                       
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%"><strong>If employed in current position for less than two years or if currently employed in more than one position, complete the following:</strong></td>
            </tr>
            <tr>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td>
                                             <table>
                                                <tr>
                                                   <td style="width:50%">Name & Address of Employer<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="border-right-width:0.1px;width:28%"><input type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                                   <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:22%">Dates (from - to)<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                                <tr>
                                                   <td style="width:55%"><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="width:23%"></td>
                                                   <td style="width:22%">Monthly Income<br/>$<input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                </table>    
                            </td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td style="border-bottom-width:0.1px;border-right-width:0.1px;">
                                             <table>
                                                <tr>
                                                    <td style="width:60%">Position/Title/Type of Business</td>
                                                    <td style="width:40%">Business Phone (incl. area code)</td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td><input type="text" value="" size="45" name="mortgage_type"></td>
                                                    <td><input type="text" value="" size="50" name="mortgage_type"></td>
                                                    
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                              
                                </table>    
                            
                            </td>
                        
                        </tr>
                    
                       
                    </table>
                </td>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td>
                                             <table>
                                                <tr>
                                                   <td style="width:50%">Name & Address of Employer<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="border-right-width:0.1px;width:28%"><input type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                                   <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:22%">Dates (from - to)<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                                <tr>
                                                   <td style="width:55%"><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="width:23%"></td>
                                                   <td style="width:22%">Monthly Income<br/>$<input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                </table>    
                            </td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td style="border-bottom-width:0.1px;border-right-width:0.1px;">
                                             <table>
                                                <tr>
                                                    <td style="width:60%">Position/Title/Type of Business</td>
                                                    <td style="width:40%">Business Phone (incl. area code)</td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td><input type="text" value="" size="45" name="mortgage_type"></td>
                                                    <td><input type="text" value="" size="50" name="mortgage_type"></td>
                                                    
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                              
                                </table>    
                            
                            </td>
                        
                        </tr>
                    
                       
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td>
                                             <table>
                                                <tr>
                                                   <td style="width:50%">Name & Address of Employer<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="border-right-width:0.1px;width:28%"><input type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                                   <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:22%">Dates (from - to)<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                                <tr>
                                                   <td style="width:55%"><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="width:23%"></td>
                                                   <td style="width:22%">Monthly Income<br/>$<input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                </table>    
                            </td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td style="border-bottom-width:0.1px;border-right-width:0.1px;">
                                             <table>
                                                <tr>
                                                    <td style="width:60%">Position/Title/Type of Business</td>
                                                    <td style="width:40%">Business Phone (incl. area code)</td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td><input type="text" value="" size="45" name="mortgage_type"></td>
                                                    <td><input type="text" value="" size="50" name="mortgage_type"></td>
                                                    
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                              
                                </table>    
                            
                            </td>
                        
                        </tr>
                    
                       
                    </table>
                </td>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td>
                                             <table>
                                                <tr>
                                                   <td style="width:50%">Name & Address of Employer<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="border-right-width:0.1px;width:28%"><input type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                                   <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:22%">Dates (from - to)<br/><input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                                <tr>
                                                   <td style="width:55%"><input type="text" value="" size="35" name="mortgage_type"></td>
                                                   <td style="width:23%"></td>
                                                   <td style="width:22%">Monthly Income<br/>$<input type="text" value="" size="35" name="mortgage_type"></td>
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                </table>    
                            </td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                    <tr>
                                        <td style="border-bottom-width:0.1px;border-right-width:0.1px;">
                                             <table>
                                                <tr>
                                                    <td style="width:60%">Position/Title/Type of Business</td>
                                                    <td style="width:40%">Business Phone (incl. area code)</td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td><input type="text" value="" size="45" name="mortgage_type"></td>
                                                    <td><input type="text" value="" size="50" name="mortgage_type"></td>
                                                    
                                                </tr>
                                            </table>    
                                         </td>
                                     </tr>
                                              
                                </table>    
                            
                            </td>
                        
                        </tr>
                    
                       
                    </table>
                </td>
            </tr>
</table>';
//INCOME Information
$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">V. MONTHLY INCOME AND COMBINED HOUSING EXPENSE INFORMATION</h4>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Gross Monthly Income</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Borrower</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Co-Borrower</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Total</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Combined Monthly Housing Expense</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Present</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Proposed</td>
            </tr>
             <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Base Empl. Income*</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Rent</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="total"></td>
                <td style="background-color:#D8D8D8; border-bottom-width:0.1px;border-right-width:0.1px;"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Overtime</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">First Mortgage (P&I)</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Bonuses</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Other Financing (P&I)</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
            </tr>
             <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Commissions</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Hazard Insurance</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Dividends/Interest</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Real Estate Taxes</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Net Rental Income</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Mortgage Insurance</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Other (before completing, see the notice in "describe other income", below)</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Homeowner Assn. Dues</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><input type="text" value="" size="45" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Total</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="base_income"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><strong>Total</strong></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$<input type="text" value="" size="45" name="total"></td>
            </tr>
</table>';

$html .= '<p style="font-size:10px;"><strong>* Self Employed Borrower(s) may be required to provide additional documentation such as tax returns and financial statements.</strong></p><p style="font-size:10px;"><strong>Describe Other Income Notice: Alimony, child support, or separate maintenance income need not be revealed if the
Borrower (B) or Co-Borrower (C) does not choose to have it considered for repaying this loan.</strong></p>';

$html .= '<table border="0" width="100%" style="font-size:11px;">

            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">B/C</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">Monthly Amount</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">$<input type="text" value="" size="15" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input type="text" value="" size="15" name="total"></td>
            </tr>    
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input type="text" value="" size="15" name="total"></td>
            </tr>

        </table>';
//INCOME Information
$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">VI. ASSETS AND LIABILITIES</h4>';
$html .= '<p>This Statement and any applicable supporting schedules may be completed jointly by both married and unmarried Co-Borrowers if their assets and liabilities are sufficiently joined
so that the Statement can be meaningfully and fairly presented on a combined basis; otherwise, separate Statements and Schedules are required. If the Co-Borrower section was
completed about a spouse, this Statement and supporting schedules must be completed about that spouse also.</p>
<p align="right">Completed <input type="checkbox" value="jointly" size="2" name="completed">Jointly<input type="checkbox" value="not-jointly" size="2" name="completed">Not Jointly</p>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%"> <strong>ASSETS</strong><br/> Description</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%"><strong>Cash or Market Value</strong></td>
                        
                        </tr>
                        <tr>
                            <td ></td>
                            
                            
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Cash deposit toward purchase held by: <br/><input type="text" value="" size="20" name="total"></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                            
                        </tr>
                        
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:100%"><strong>List checking and savings accounts below</strong></td>
                        
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:100%">Name and address of Bank, S&L, or Credit Union<br/><input type="text" value="" size="20" name="total"></td>
                        
                        </tr>                       
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Acct. no.<input type="text" value="" size="15" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>      
                         <tr>
                            <td style="border-bottom-width:0.1px;width:100%">Name and address of Bank, S&L, or Credit Union<br/><input type="text" value="" size="20" name="total"></td>
                        
                        </tr>                       
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Acct. no.<input type="text" value="" size="15" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:100%">Name and address of Bank, S&L, or Credit Union<br/><input type="text" value="" size="20" name="total"></td>
                        
                        </tr>                       
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Acct. no.<input type="text" value="" size="15" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:100%">Name and address of Bank, S&L, or Credit Union<br/><input type="text" value="" size="20" name="total"></td>
                        
                        </tr>                       
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Acct. no.<input type="text" value="" size="15" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Stocks & Bonds (Company name/number
& description)<br/><input type="text" value="" size="20" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<br/><input type="text" value="" size="20" name="total"></td>
                        </tr>                       
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Life insurance net cash value<br/>Face amount: $<input type="text" value="" size="15" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%"><strong>Subtotal Liquid Assets</strong></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Real estate owned (enter market value from schedule of real estate owned)</td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Vested interest in retirement fund</td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Net worth of business(es) owned(attach financial statement)</td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Automobiles owned (make and year)<br/><input type="text" value="" size="10" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:45%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Other Assets (itemize)<br/><input type="text" value="" size="10" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                        <tr>
                            <td></td>
                        
                        </tr>
                         <tr>
                            <td style="border-right-width:0.1px;width:60%"><strong>Total Assets a.</strong></td>
                            <td style="width:40%">$<input type="text" value="" size="15" name="total"></td>
                        </tr>
                    </table>
                
                
                </td>
              
                <td style="border-right-width:0.1px;width:60%"><strong>Liabilities and Pledged Assets.</strong>List the creditors name, address and account number for all outstanding debts, including automobile loans, revolving charge accounts, real estate loans, alimony, child support,stock pledges, etc. Use continuation sheet, if necessary. Indicate by (*) those liabilities which will be satisfied upon sale of real estate owned upon refinancing of the subject property.<br/>
                        <table>
                            <tr>
                            
                                <td style="border-bottom-width:0.1px; border-right-width:0.1px;width:50%"><strong>LIABILITIES</strong></td>
                                 <td style="border-bottom-width:0.1px; border-right-width:0.1px;width:25%"><strong>Monthly Payment &
Months Left to Pay</strong></td>
                                   <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%"><strong>Unpaid Balance</strong></td>  
                            
                            </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$<br/><input type="text" value="" size="20" name="total"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                               
                             </tr>
                              <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$<br/><input type="text" value="" size="20" name="total"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                               
                             </tr>
                              <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$<br/><input type="text" value="" size="20" name="total"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                               
                             </tr>
                              <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$<br/><input type="text" value="" size="20" name="total"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                               
                             </tr>
                              <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$<br/><input type="text" value="" size="20" name="total"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                               
                             </tr>
                              <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$<br/><input type="text" value="" size="20" name="total"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                               
                             </tr>
                              <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-right-width:0.1px;width:25%">$<br/><input type="text" value="" size="20" name="total"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                               
                             </tr>
                              <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Alimony/Child Support/Separate Maintenance Payments Owed to:<br/><input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$ <br/><input type="text" value="" size="20" name="total"></td>
                                <td style="background-color:#D8D8D8; border-right-width:0.1px;width:25%"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Job-Related Expense (child care, union dues, etc.)<input type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$ <br/><input type="text" value="" size="20" name="total"></td>
                                <td style="background-color:#D8D8D8; border-right-width:0.1px;width:25%"></td>
                               
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><strong>Total Monthly Payments</strong></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$ <br/><input type="text" value="" size="20" name="total"></td>
                                <td style="background-color:#D8D8D8; border-right-width:0.1px;width:25%"></td>
                               
                             </tr>
                             <tr>
                                <td style="background-color:#D8D8D8; border-bottom-width:0.1px;border-right-width:0.1px;width:25%"><strong>Net Worth (a minus b)</strong></td>
                                <td style="border-bottom-width:0.1px; border-right-width:0.1px;width:25%"><strong>$</strong><input type="text" value="" size="15" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%"><strong>Total Liabilities b.</strong></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$<input type="text" value="" size="15" name="total"></td>
                               
                             </tr>
                             
                        </table>
                </td>
            </tr>
            
        </table>';
//Real Estate Owned or LongAppBorrowerRealEstate
$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">VI. ASSETS AND LIABILITIES(cont.)</h4>';
$html .= '<p><strong>Schedule of Real Estate Owned </strong>(If additional properties are owned, use continuation sheet.)</p>';

$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">Property Address (enter S if sold, PS if pending sale or R if rental being held for income)</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">Type of Property</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">Present Market Value</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">Amount of Mortgages & Liens</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">Mortgage Payments</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">Insurance, Maintenance,
Taxes & Misc.</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">Net
Rental Income</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="15" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:5%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="15" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:5%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
            </tr>
             <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="15" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:5%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%"><input type="text" value="" size="5" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input type="text" value="" size="15" name="total"></td>
                
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">Totals</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input type="text" value="" size="5" name="total"></td>
            </tr>
        </table>';
$html .= '<p><strong>List any additional names under which credit has previously been received and indicate appropriate creditor name(s) and account number(s):</p>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="width:35%">Alternate Name</td>
                <td style="width:35%">Creditor Name</td>
                <td style="width:30%">Account Number</td>
                
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;width:35%"><input type="text" value="" size="25" name="alternate_name"></td>
                <td style="border-bottom-width:0.1px;width:35%"><input type="text" value="" size="25" name="creditor_name"></td>
                <td style="border-bottom-width:0.1px;width:30%"><input type="text" value="" size="25" name="account_number"></td>
                
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;width:35%"><input type="text" value="" size="25" name="alternate_name2"></td>
                <td style="border-bottom-width:0.1px;width:35%"><input type="text" value="" size="25" name="creditor_name2"></td>
                <td style="border-bottom-width:0.1px;width:30%"><input type="text" value="" size="25" name="account_number2"></td>
                
            </tr>    
    </table>';
//DETAILS OF TRANSACTION or LongAppBorrowerTransaction
$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="width:40%">
                    <h4 align="center" style="background-color:#000;color:#FFFFFF;">VII. DETAILS OF TRANSACTION</h4>
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">a. Purchase price</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$<input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">b. Alterations, improvements, repairs</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">c. Land (if acquired separately)</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">d. Refinance (incl. debts to be paid off)</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">e. Estimated prepaid items</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">f. Estimated closing costs</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">g. PMI, MIP, Funding Fee</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">h. Discount (if Borrower will pay)</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><strong>i. Total costs (add items a through h)</strong></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">j. Subordinate financing</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">k. Borrowers closing costs paid by Seller</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">l. Other Credits (explain)<br/><br/><input type="text" value="" size="25" name="other_credits"></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">m. Loan amount <br/>(exclude PMI, MIP, Funding Fee financed)<br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">n. PMI, MIP, Funding Fee financed<br/><br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">o. Loan amount (add m & n)<br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">p. Cash from/to Borrower <br/>(subtract j, k, l & o from i)<br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><input type="text" value="" size="15" name="purchase_price"></td>
                        </tr>
                    </table>

                
                </td>
                <td style="width:60%">
                    <h4 align="center" style="background-color:#000;color:#FFFFFF;">VIII. DECLARATIONS</h4>
                  
                    <table>
                        <tr>
                            <td style="width:65%;font-size:10px;"><strong>If you answer "Yes" to any questions a through i, please use continuation sheet for explanation.</strong></td>
                            <td style="border-bottom-width:0.1px; border-right-width:0.1px; width:17%;font-size:10px;"><strong>Borrower</strong></td>
                            <td style="border-bottom-width:0.1px; border-right-width:0.1px; width:18%;font-size:10px;"><strong>Co-Borrower</strong></td>
                        </tr>
                        <tr>
                            <td style="width:70%"></td>
                            <td style="border-bottom-width:0.1px; border-right-width:0.1px; width:15%"><strong>Yes &nbsp;&nbsp;&nbsp;No</strong></td>
                            <td style="border-bottom-width:0.1px; border-right-width:0.1px; width:15%"><strong>Yes &nbsp;&nbsp;&nbsp;No</strong></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">a. Are there any outstanding judgments against you?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">b. Have you been declared bankrupt within the past 7 years?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:65%">c. Have you had property foreclosed upon or given title or deed in lieu thereof in the last 7 years?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">d. Are you a party to a lawsuit?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Ye<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">e. Have you directly or indirectly been obligated on any loan which resulted in foreclosure, transfer of title in lieu of foreclosure, or judgment?<span style="font-size:8px;">(This would include such loans as home mortgage loans, SBA loans, home improvement loans,
educational loans, manufactured (mobile) home loans, any mortgage, financial obligation, bond,
or loan guarantee. If "Yes", provide details, including date, name and address of Lender, FHA or
VA case number, if any, and reasons for the action.)</span></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">f. Are you presently delinquent or in default on any Federal debt or any other loan, mortgage, financial obligation, bond, or loan guarantee?<span style="font-size:8px;">If "Yes", give details as described in the preceding question.</span></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">g. Are you obligated to pay alimony, child support, or separate maintenance?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">h. Is any part of the down payment borrowed</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">i. Are you a co-maker or endorser on a note?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">j. Are you a U.S. citizen?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                       <tr>
                            <td style="border-bottom-width:0.1px;width:65%">k. Are you a permanent resident alien?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:65%">l. <strong>Do you intend to occupy the property as your primary residence?</strong><span style="font-size:8px;">If "Yes", complete question m below</span></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:65%">m. Have you had an ownership interest in a property in the last three years?<br/>
                                (1) What type of property did you own-principal residence (PR),
second home (SH), or investment property (IP)?
                            </td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="text" value="" size="10" name="purchase_price"></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="text" value="" size="10" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">(2) How did you hold title to the home-solely by yourself (S),jointly with your spouse (SP), or jointly with another person (O)?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"><input type="text" value="" size="10" name="purchase_price"></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="text" value="" size="10" name="purchase_price"></td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
        </table>';
//ACKNOWLEDGMENT AND AGREEMENT
$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">IX. ACKNOWLEDGMENT AND AGREEMENT</h4>
<p>Each of the undersigned specifically represents to Lender and to Lenders actual or potential agents, brokers, processors, attorneys, insurers, servicers, successors and assigns and agrees and acknowledges that: (1) the information provided in this application is true and correct as of the date set forth opposite my signature and that any intentional or negligent misrepresentation of this information contained in this application may result in civil liability, including monetary damages, to any person who may suffer any loss due to reliance upon any misrepresentation that I have made on this application, and/or in criminal penalties including, but not limited to, fine or imprisonment or both under the provisions of Title 18, United States Code, Sec. 1001, et seq.; (2) the loan requested pursuant to this application (the "Loan") will be secured by a mortgage or deed of trust on the property
described herein; (3) the property will not be used for any illegal or prohibited purpose or use; (4) all statements made in this application are made for the purpose of obtaining a residential mortgage loan; (5) the property will be occupied as indicated herein; (6) any owner or servicer of the Loan may verify or reverify any information contained in the application from any source named in this application, and Lender, its successors or assigns may retain the original and/or an electronic record of this application, even if the Loan is not approved; (7) the Lender and its agents, brokers, insurers, servicers, successors and assigns may continuously rely on the information contained in the application, and I am obligated to amend and/or supplement the information provided in this application if any of the material facts that I have represented herein should change prior to closing of the Loan; (8) in the event that my payments on the Loan become delinquent, the owner or servicer of the Loan may, in addition to any other rights and remedies that it may have relating to such delinquency, report my name and account information to one or more consumer credit reporting agencies; (9) ownership of the Loan and/or administration of the Loan account may be transferred with such notice as may be required by law; (10) neither Lender nor its agents, brokers, insurers, servicers, successors or assigns has made any representation or warranty, express or implied, to me regarding the property or the condition or value of the property; and (11) my transmission of this application as an "electronic record" containing my "electronic signature," as those terms are defined in applicable federal and/or state laws (excluding audio and video recordings), or my facsimile transmission of this application containing a fascimile of my signature, shall be as effective, enforceable and valid as if a paper version of this application were delivered containing my original written signature.</p>
<table border="0" width="100%" style="font-size:11px;">
    <tr>
        <td style="border-top-width:0.1px;width:35%">Borrowers Signature</td>
        <td style="border-top-width:0.1px;width:15%">Date</td>
        <td style="border-top-width:0.1px;width:35%">Co-Borrowers Signature</td>
        <td style="border-top-width:0.1px;width:15%">Date</td>
    </tr>
    <tr>
        <td style="font-size:12px;width:35%"><strong>X</strong></td>
        <td style="width:15%"></td>
        <td style="font-size:12px;width:35%"><strong>X</strong></td>
        <td style="width:15%"></td>
    </tr>
    
    </table>';
$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">X. INFORMATION FOR GOVERNMENT MONITORING PURPOSES</h4>';
$html .= '<p>The following information is requested by the Federal Government for certain types of loans related to a dwelling in order to monitor the lenders compliance with equal credit opportunity, fair housing and home mortgage disclosure laws. You are not required to furnish this information, but are encouraged to do so. The law provides that a lender may discriminate neither on the basis of this information, nor on whether you choose to furnish it. If you furnish the information, please provide both ethnicity and race. For race, you may check more than one designation. If you do not furnish ethnicity, race, or sex, under Federal regulations, this lender is required to note the information on the basis of visual observation or surname. If you do not wish to furnish the information, please check the box below. (Lender must review the above material to assure that the disclosures satisfy all requirements to which the lender is subject under applicable state law for the particular type of loan applied for.)
</p>
<table border="0" width="100%" style="font-size:11px;">
    <tr>
        <td style="border-bottom-width:0.2px;width:50%;border-right-width:0.2px;">
            <table border="0" width="100%" style="font-size:11px;">
                <tr>
                    <td style="border-bottom-width:0.1px;width:20%"><strong>BORROWER</strong></td>
                    <td style="border-bottom-width:0.1px;width:70%"><input type="checkbox" value="yes" size="3" name="purchase_price">I do not wish to furnish this information</td>
        
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;width:20%"><strong>Ethnicity:</strong></td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">Hispanic or Latino</td>
                    <td style="border-bottom-width:0.1px;width:50%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">Not Hispanic or Latino</td>    
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;width:20%"><strong>Race:</strong></td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">American Indian or Alaska Native</td>
                    <td style="border-bottom-width:0.1px;width:20%"><input type="checkbox" value="asian" size="3" name="purchase_price">Asian</td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">Black or African American</td> 
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;width:20%"></td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">Native Hawaiian or Other Pacific Islander</td>
                    <td style="border-bottom-width:0.1px;width:50%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">White</td>    
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;width:20%">Sex</td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">Female</td>
                    <td style="border-bottom-width:0.1px;width:50%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">Male</td>    
                </tr>
            </table>
        </td>
        <td style="border-bottom-width:0.2px;width:50%;border-right-width:0.2px;width:50%">
             <table border="0" width="100%" style="font-size:11px;">
                <tr>
                    <td style="border-bottom-width:0.1px;width:20%;font-size:8px;"><strong>CO-BORROWER</strong></td>
                    <td style="border-bottom-width:0.1px;width:70%"><input type="checkbox" value="yes" size="3" name="purchase_price">I do not wish to furnish this information</td>
        
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;width:20%"><strong>Ethnicity:</strong></td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">Hispanic or Latino</td>
                    <td style="border-bottom-width:0.1px;width:50%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">Not Hispanic or Latino</td>    
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;width:20%"><strong>Race:</strong></td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">American Indian or Alaska Native</td>
                    <td style="border-bottom-width:0.1px;width:20%"><input type="checkbox" value="asian" size="3" name="purchase_price">Asian</td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">Black or African American</td> 
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;width:20%"></td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">Native Hawaiian or Other Pacific Islander</td>
                    <td style="border-bottom-width:0.1px;width:50%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">White</td>    
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;width:20%">Sex</td>
                    <td style="border-bottom-width:0.1px;width:30%"><input type="checkbox" value="hispanic" size="3" name="purchase_price">Female</td>
                    <td style="border-bottom-width:0.1px;width:50%"><input type="checkbox" value="not_hispanic" size="3" name="purchase_price">Male</td>    
                </tr>
            </table>
        </td>
    </tr>
</table>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
    <tr>
        <td style="border-bottom-width:0.2px;width:30%;border-right-width:0.2px;">
           <table border="0" width="100%" style="font-size:11px;">
                <tr>    
                    <td><strong>To be Completed by Interviewer</strong><br/>
                    This application was taken by:
                    </td>
                
                </tr>
                 
                 <tr>    
                    <td><input type="checkbox" value="hispanic" size="3" name="purchase_price">Face-to-face interview</td>
                </tr>
                 <tr>    
                    <td><input type="checkbox" value="hispanic" size="3" name="purchase_price">Mail</td>
                </tr>
                <tr>    
                    <td><input type="checkbox" value="hispanic" size="3" name="purchase_price">Telephone</td>
                </tr>
                   <tr>    
                    <td><input type="checkbox" value="hispanic" size="3" name="purchase_price">Internet</td>
                </tr>
           
           </table>
        
        
        </td>
        <td style="border-bottom-width:0.2px;width:35%;border-right-width:0.2px;">
             <table border="0" width="100%" style="font-size:11px;">
                <tr>    
                    <td style="border-bottom-width:0.1px;">Interviewers Name (print or type)<br/>
                        <input type="text" value="" size="15" name="purchase_price">
                    </td>
                </tr>
                 <tr> 
                    <td style="border-bottom-width:0.1px;">Interviewers Signature<br/>
                        <input type="text" value="" size="15" name="purchase_price">
                    </td>
                </tr>
                 <tr> 
                    <td style="border-bottom-width:0.1px;">Interviewers Phone Number (incl. area code)<br/>
                        <input type="text" value="" size="15" name="purchase_price">
                    </td>
                </tr>
              </table>   
        
        </td>
        <td style="border-bottom-width:0.2px;width:35%;border-right-width:0.2px;">
            <table border="0" width="100%" style="font-size:11px;">
                <tr>    
                    <td>Name and Address of Interviewers Employer<br/>
                        <input type="text" value="" size="25" name="purchase_price">
                    </td>
                    
                </tr>
              </table>   
        </td>
    </tr>
    </table>';
$html .= '<h3 align="center" style="background-color:#000;color:#FFFFFF;">Continuation Sheet/Residential Loan Application </h3>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
        <tr>
            <td style="border-bottom-width:0.2px;width:30%;border-right-width:0.2px;">
            Use this continuation sheet if you need more space to complete the Residential Loan Application. Mark B for Borrower or C for Co-Borrower.
    
            </td>
            
            <td style="border-bottom-width:0.2px;border-right-width:0.2px;">
                <table border="0" width="100%" style="font-size:11px;">
                <tr>    
                    <td style="border-bottom-width:0.2px;border-right-width:0.2px;">Borrower:<br/>
                        <input type="text" value="" size="25" name="purchase_price">
                    </td>
                    
                </tr>
                 <tr>    
                    <td style="border-bottom-width:0.2px;border-right-width:0.2px;">Co-Borrower:<br/>
                        <input type="text" value="" size="25" name="purchase_price">
                    </td>
                    
                </tr>
              </table>  

            </td>
             <td style="border-bottom-width:0.2px;border-right-width:0.2px;">
                <table border="0" width="100%" style="font-size:11px;">
                <tr>    
                    <td style="border-bottom-width:0.2px;border-right-width:0.2px;">Agency Case Number:<br/>
                        <input type="text" value="" size="25" name="purchase_price">
                    </td>
                    
                </tr>
                 <tr>    
                    <td style="border-bottom-width:0.2px;border-right-width:0.2px;">Lender Case Number:<br/>
                        <input type="text" value="" size="25" name="purchase_price">
                    </td>
                    
                </tr>
              </table>  

            </td>
        </tr></table>';

$html .= ' <input type="text" value="" size="200" name="description">';

$html .= '<p>I/We fully understand that it is a Federal crime punishable by fine or imprisonment, or both, to knowingly make any false statements concerning any of the above facts as applicable
under the provisions of Title 18, United States Code, Section 1001, et seq. </p>
<table border="0" width="100%" style="font-size:11px;">
    <tr>
        <td style="border-right-width:0.2px;border-top-width:0.1px;width:35%">Borrowers Signature</td>
        <td style="border-right-width:0.2px;border-top-width:0.1px;width:15%">Date</td>
        <td style="border-right-width:0.2px;border-top-width:0.1px;width:35%">Co-Borrowers Signature</td>
        <td style="border-right-width:0.2px;border-top-width:0.1px;width:15%">Date</td>
    </tr>
    <tr>
        <td style="border-bottom-width:0.2px;border-right-width:0.2px;font-size:12px;width:35%"><strong>X</strong></td>
        <td style="border-bottom-width:0.2px;border-right-width:0.2px;width:15%"></td>
        <td style="border-bottom-width:0.2px;border-right-width:0.2px;font-size:12px;width:35%"><strong>X</strong></td>
        <td style="border-bottom-width:0.2px;border-right-width:0.2px;width:15%"></td>
    </tr>
    
    </table>';
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
echo $pdf->Output(WWW_ROOT . 'files/pdf/1003' . DS . '1003_'.$loanID.'.pdf', 'FI');
die();