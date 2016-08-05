<?php
//header("Content-type: application/pdf");
App::import('Vendor','xtcpdf');
 $amount ='12345';
 $interestRate = '0.30';
 $propertyAddress = 'sddasdasda';
 $noUnits = '12';
 $monthNumber = '17';
  $yearBuilt = '1234';
  $borrowerName = 'adasdasd';
  $phoneNumber = '122222';
  $dob = '12323';
$pdf = new XTCPDF('L', PDF_UNIT, 'Letter Of Intent', true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Good Faith Estimate (GFE)');
$pdf->SetSubject('Good Faith Estimate (GFE)');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// disable auto-page-break
//$pdf->SetAutoPageBreak(false, 0);

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
                       <td>Purpose of Loan
                        <table>
                         <tr>
                             <td style="width:20%"><input type="checkbox" value="purchase" size="5" name="mortgage_type">Purchase</td>
                             <td style="width:30%;"><input type="checkbox" value="construction" size="5" name="mortgage_type">Construction</td>
                             <td style="width:40%"><input type="checkbox" value="other" size="5" name="mortgage_type">Other (explain)<input type="text" value="" size="20" name="other_mortage"></td>
                         </tr>
                        <tr>
                             <td style="width:1%"></td>
                             <td style="width:20%"><input type="checkbox" value="VA" size="5" name="mortgage_type">Refinance</td>
                             <td style="width:45%;"><input type="checkbox" value="Conventional" size="5" name="mortgage_type">Construction-Permanent</td>
                            
                         </tr>
                     </table>
                     </td>
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
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"></td>
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
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">$<input type="text" value="" size="5" name="total"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input type="text" value="" size="5" name="total"></td>
            </tr>    
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input type="text" value="" size="5" name="total"></td>
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
                <td><strong>ASSETS</strong></td>
            
            </tr>



            </table>';



$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

/*$pdf->SetXY(15, 60);
$heading = '<h4 align="center">1. TYPE OF MORTAGE AND TERMS OF LOAN</h4>';
$pdf->writeHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, '', true);
// text on center
$pdf->Cell(20, 6, 'Mortgage');
$pdf->Cell(6, 0, $pdf->Checkbox('mortgage_type', 4, 0).$pdf->Cell(20, 5, 'VA'), 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
$pdf->Cell(6, 0, $pdf->Checkbox('mortgage_type', 4,0).$pdf->Cell(30, 5, 'Conventional'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(6, 0, $pdf->Checkbox('mortgage_type', 4,0).$pdf->Cell(30, 5, 'Other(explain)'), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(60, 0, 'Agency Case Number', 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(60, 0, 'Lender Case Number', 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');


$pdf->SetXY(15, 72);

// text on center
$pdf->Cell(25, 5, 'Applied For');
$pdf->Cell(6, 0, $pdf->Checkbox('applied_for', 4, 0).$pdf->Cell(12, 5, 'FHA'), 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
$pdf->Cell(25, 0, $pdf->Checkbox('applied_for', 4,0).$pdf->Cell(20, 5, 'USDA/Rural Housing Service'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 0, $pdf->TextField('other', 35, 6), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(10, 0, $pdf->TextField('agency number', 50, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(10, 0, $pdf->TextField('lender number', 50, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');



$pdf->SetXY(15, 82);
$pdf->Cell(40, 5, 'Amount');

$pdf->Cell(40, 0, 'Interest Rate %', 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(40, 0, 'No. of Months', 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(40, 0, 'Amortization Type:', 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(1, 0, $pdf->Checkbox('amortization_type', 4, 0).$pdf->Cell(30, 5, 'Fixed Rate'), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(70, 0, $pdf->Checkbox('amortization_type', 4, 0).$pdf->Cell(30, 5, 'Other (explain):').$pdf->TextField('other_amortization', 50, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');


$pdf->SetXY(15, 90);
$pdf->Cell(4, 5, '$');
$pdf->Cell(2, 0, $pdf->TextField('amount', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(2, 0, $pdf->TextField('interest_rate', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(32, 0, $pdf->TextField('no_of_months', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->Cell(1, 0, $pdf->Checkbox('amortization_type', 4, 0).$pdf->Cell(30, 5, 'GPM'), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(70, 0, $pdf->Checkbox('amortization_type', 4, 0).$pdf->Cell(30, 5, 'ARM (type):').$pdf->TextField('other_amortization', 50, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->SetXY(15, 100);
$head = '<h4 align="center">II. PROPERTY INFROMATION AND PURPOSE OF LOAN</h4>';
$pdf->writeHTMLCell(0, 0, '', '', $head, 0, 1, 0, true, '', true);
$pdf->SetXY(15, 110);
$pdf->Cell(240, 5, 'Subject Property Address (street, city, state, & ZIP)');

$pdf->Cell(20, 0, 'No. of Units', 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->SetXY(15, 115);
$pdf->Cell(240, 0, $propertyAddress, 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->Cell(20, 0, $noUnits, 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->SetXY(15, 120);
$pdf->Cell(240, 5, 'Legal Description of Subject Property (attach description if necessary)');

$pdf->Cell(20, 0, 'Year Built', 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->SetXY(15, 125);
$pdf->Cell(240, 0, $propertyAddress, 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->Cell(20, 0, $yearBuilt, 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

//Purpose Of Loan
$pdf->SetXY(15, 135);
$pdf->Cell(30, 5, 'Purpose Of Loan');
$pdf->Cell(2, 0, $pdf->Checkbox('loan_purpose', 4, 0).$pdf->Cell(15, 5, 'Purchase'), 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
$pdf->Cell(2, 0, $pdf->Checkbox('loan_purpose', 4,0).$pdf->Cell(25, 5, 'Construction'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(2, 0, $pdf->Checkbox('loan_purpose', 4,0).$pdf->Cell(30, 5, 'Other (explain)').$pdf->TextField('other_purpose', 50, 6), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(20, 5, 'Property will be:');

$pdf->SetXY(15, 140);
$pdf->Cell(30, 5, '');
$pdf->Cell(2, 0, $pdf->Checkbox('loan_purpose', 4, 0).$pdf->Cell(20, 5, 'Refinance'), 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
$pdf->Cell(50, 0, $pdf->Checkbox('loan_purpose', 4,0).$pdf->Cell(55, 5, 'Construction-Permanent'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(2, 0, $pdf->Checkbox('type_property', 4, 0).$pdf->Cell(35, 5, 'Primary Residence'), 0, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
$pdf->Cell(2, 0, $pdf->Checkbox('type_property', 4,0).$pdf->Cell(35, 5, 'Secondary Residence'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(2, 0, $pdf->Checkbox('type_property', 4,0).$pdf->Cell(30, 5, 'Investment'), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');

$pdf->SetXY(15, 150);
$pdf->Cell(300, 5, 'Complete this line if construction or construction-permanent loan.');

$pdf->SetXY(15, 155);
$pdf->Cell(40, 5, 'Year Lot Acquired');
$pdf->Cell(60, 5, 'Original Cost $');
$pdf->Cell(50, 5, 'Amount Existing Liens');
$pdf->Cell(50, 5, '(a) Present Value of Lot');
$pdf->Cell(50, 5, '(b) Cost of Improvements');
$pdf->Cell(40, 5, 'Total (a + b)');

$pdf->SetXY(15, 160);
$pdf->Cell(1, 0, $pdf->TextField('year_lot_accquired', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(20, 0, $pdf->TextField('original_cost', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(10, 0, $pdf->TextField('existing_liens', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(20, 0, $pdf->TextField('value_of_lots', 30, 6), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(15, 0, $pdf->TextField('improvements_cost', 30, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(10, 0, $pdf->TextField('total_cost', 30, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');


$pdf->SetXY(15, 170);
$pdf->Cell(300, 5, 'Complete this line if this is a refinance loan.');

$pdf->SetXY(15, 175);
$pdf->Cell(40, 5, 'Year Acquired');
$pdf->Cell(50, 5, 'Original Cost $');
$pdf->Cell(45, 5, 'Amount Existing Liens');
$pdf->Cell(45, 5, 'Purpose of Refinance');
$pdf->Cell(45, 5, 'Describe Improvements');

$pdf->Cell(2, 0, $pdf->Checkbox('type_improvement', 4,0).$pdf->Cell(15, 5, 'made'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(2, 0, $pdf->Checkbox('type_improvement', 4,0).$pdf->Cell(20, 5, 'to be made'), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');

$pdf->SetXY(15, 180);
$pdf->Cell(5, 0, $pdf->TextField('year_accquired', 30, 6), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(25, 0, $pdf->TextField('refinance_original_cost', 30, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(15, 0, $pdf->TextField('refinance_existing_liens', 30, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(15, 0, $pdf->TextField('purpose_of_refinance', 30, 6), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(10, 5, 'Cost');
$pdf->Cell(25, 0, $pdf->TextField('improvements_cost', 100, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->AddPage();

$pdf->SetXY(15, 10);
$pdf->Cell(100, 5, 'Title will be held in what Name(s)');
$pdf->Cell(100, 5, 'Manner in which Title will be held');
$pdf->Cell(45, 5, 'Estate will be held in:');
$pdf->Cell(2, 0, $pdf->Checkbox('type_estate', 4,0).$pdf->Cell(15, 5, 'Free Simple'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->SetXY(15, 15);
$pdf->Cell(30, 0, $pdf->TextField('title', 80, 6), 0, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(30, 0, $pdf->TextField('title_manner', 80, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(2, 0, $pdf->Checkbox('type_estate', 4,0).$pdf->Cell(15, 5, 'Leasehold'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetXY(15, 20);
$pdf->Cell(200, 5, 'Source of Down Payment, Settlement Charges and/or Subordinate Financing (explain)');
$pdf->Cell(50, 0, $pdf->TextField('title_manner', 250, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->SetXY(15, 25);

$pdf->Cell(50, 0, $pdf->TextField('title_manner', 150, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->SetXY(15, 30);
$borrowerHeading = '<h4 align="center">Borrower III. BORROWER INFROMATION Co-Borrower</h4> ';
$pdf->writeHTMLCell(0, 0, '', '', $borrowerHeading, 0, 1, 0, true, '', true);

$pdf->SetXY(15, 40);
$pdf->Cell(150, 5, 'Borrowers Name (include Jr. or Sr. if applicable)');
$pdf->Cell(150, 5, 'Co-Borrowers Name (include Jr. or Sr. if applicable)');

$pdf->SetXY(15, 45);
$pdf->Cell(150, 0, $borrowerName, 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(150, 0, $pdf->TextField('co-borrower', 250, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');


$pdf->SetXY(15, 55);
$pdf->Cell(43, 5, 'Social Security Number');
$pdf->Cell(50, 5, 'Home Phone(incl. area code)');
$pdf->Cell(20, 5, 'DOB');
$pdf->Cell(30, 5, 'Yrs. School');
$pdf->Cell(43, 5, 'Social Security Number');
$pdf->Cell(50, 5, 'Home Phone(incl. area code)');
$pdf->Cell(20, 5, 'DOB');
$pdf->Cell(30, 5, 'Yrs. School');


$pdf->SetXY(15, 60);
$pdf->Cell(1, 0, $pdf->TextField('borrower_ssn', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->Cell(50, 5, $phoneNumber);
$pdf->Cell(10, 5, $dob);
$pdf->Cell(1, 5, $pdf->TextField('borrower_school', 30, 6));

$pdf->Cell(1, 0, $pdf->TextField('co_borrower_ssn', 40, 6), 0, $ln=0, 'C', 0, '', 0, false, 'A', 'C');

$pdf->Cell(50, 5, $phoneNumber);
$pdf->Cell(10, 5, $dob);
$pdf->Cell(1, 5, $pdf->TextField('co_borrower_school', 30, 6));


$pdf->SetXY(15, 65);
$pdf->Cell(12, 0, $pdf->Checkbox('married', 4,0).$pdf->Cell(5, 5, 'Married'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(44, 0, $pdf->Checkbox('married', 4,0).$pdf->Cell(5, 5, 'Unmarried (include single,'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->Cell(70, 5, 'Dependents(not listed by Co-Borrower)');

$pdf->Cell(10, 0, $pdf->Checkbox('married', 4,0).$pdf->Cell(5, 5, 'Married'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(44, 0, $pdf->Checkbox('married', 4,0).$pdf->Cell(5, 5, 'Unmarried (include single,'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->Cell(70, 5, 'Dependents(not listed by Borrower)');
$pdf->Cell(20, 0, $pdf->Checkbox('married', 4,0).$pdf->Cell(5, 5, 'Married'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');



$pdf->SetXY(15, 70);
$pdf->Cell(20, 0, $pdf->Checkbox('married', 4,0).$pdf->Cell(5, 5, 'Separated'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(44, 0, $pdf->Cell(5, 5, 'divorced, widowed)'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->Cell(12, 5, 'no');
$pdf->Cell(5, 5, $pdf->TextField('borrower_no', 15, 6));
$pdf->Cell(12, 5, 'ages');
$pdf->Cell(5, 5, $pdf->TextField('borrower_age', 15, 6));
$pdf->Cell(20, 0, $pdf->Checkbox('married', 4,0).$pdf->Cell(5, 5, 'Separated'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(44, 0, $pdf->Cell(5, 5, 'divorced, widowed)'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->Cell(12, 5, 'no');
$pdf->Cell(5, 5, $pdf->TextField('borrower_no', 15, 6));
$pdf->Cell(10, 5, 'ages');
$pdf->Cell(5, 5, $pdf->TextField('borrower_age', 15, 6));


$pdf->SetXY(15, 75);
$pdf->Cell(80, 5, 'Present Address (street, city, state, ZIP)');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Own'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Rent'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 5, $pdf->TextField('borrower_no', 8, 6));
$pdf->Cell(8, 5, 'No.');
$pdf->Cell(12, 5, 'Yrs.');
$pdf->Cell(80, 5, 'Present Address (street, city, state, ZIP)');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Own'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Rent'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 5, $pdf->TextField('borrower_no', 8, 6));
$pdf->Cell(8, 5, 'No.');
$pdf->Cell(8, 5, 'Yrs.');


$pdf->SetXY(15, 85);
$pdf->Cell(20, 5, $pdf->TextField('address', 120, 6));
$pdf->Cell(20, 5, $pdf->TextField('address', 100, 6));

$pdf->SetXY(15, 95);

$pdf->Cell(140, 5, 'Mailing Address, if different from Present Address');
$pdf->Cell(140, 5, 'Mailing Address, if different from Present Address');

$pdf->SetXY(15, 105);

$pdf->Cell(20, 5, $pdf->TextField('address', 120, 6));
$pdf->Cell(20, 5, $pdf->TextField('address', 120, 6));

$pdf->SetXY(15, 125);
$pdf->Cell(140, 5, 'If residing at present address for less than two years, complete the following:');
$pdf->SetXY(15, 130);

$pdf->Cell(80, 5, 'Former Address (street, city, state, ZIP)');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Own'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Rent'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 5, $pdf->TextField('borrower_no', 8, 6));
$pdf->Cell(8, 5, 'No.');
$pdf->Cell(12, 5, 'Yrs.');
$pdf->Cell(80, 5, 'Former Address (street, city, state, ZIP)');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Own'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 0, $pdf->Checkbox('address', 4,0).$pdf->Cell(5, 5, 'Rent'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(5, 5, $pdf->TextField('borrower_no', 8, 6));
$pdf->Cell(8, 5, 'No.');
$pdf->Cell(8, 5, 'Yrs.');


$pdf->SetXY(15, 135);
$pdf->Cell(20, 5, $pdf->TextField('address', 120, 6));
$pdf->Cell(20, 5, $pdf->TextField('address', 100, 6));

$pdf->AddPage();

$pdf->SetXY(15, 10);
$employmentHeading = '<h4 align="center">Borrower III. EMPLOYEMENT INFROMATION Co-Borrower</h4> ';
$pdf->writeHTMLCell(0, 0, '', '', $employmentHeading, 0, 1, 0, true, '', true);


$pdf->SetXY(15, 20);
$pdf->Cell(60, 5, 'Name & Address of Employer');
$pdf->Cell(25, 0, $pdf->Checkbox('employer', 4,0).$pdf->Cell(5, 5, 'Self Employed'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(30, 5, 'Yrs. on this job');

$pdf->Cell(70, 5, 'Name & Address of Employer');
$pdf->Cell(25, 0, $pdf->Checkbox('employer', 4,0).$pdf->Cell(5, 5, 'Self Employed'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(30, 5, 'Yrs. on this job');


$pdf->SetXY(15, 25);
$pdf->Cell(20, 5, $pdf->TextField('address', 80, 6));
$pdf->Cell(20, 5, $pdf->TextField('job_year', 20, 6));
$pdf->Cell(20, 5, $pdf->TextField('address', 80, 6));
$pdf->Cell(20, 5, $pdf->TextField('job_year', 20, 6));

$pdf->SetXY(15, 35);
$pdf->Cell(85, 5, '');
$pdf->Cell(20, 5, 'Yrs. employed in this');
$pdf->Cell(105, 5, '');
$pdf->Cell(20, 5, 'Yrs. employed in this');


$pdf->SetXY(15, 40);
$pdf->Cell(85, 5, '');
$pdf->Cell(20, 5, 'line of work/profession');
$pdf->Cell(105, 5, '');
$pdf->Cell(20, 5, 'line of work/profession');


$pdf->SetXY(15, 45);
$pdf->Cell(85, 5, '');
$pdf->Cell(20, 5, $pdf->TextField('profession', 40, 6));
$pdf->Cell(65, 5, '');
$pdf->Cell(20, 5, $pdf->TextField('profession', 40, 6));

$pdf->SetXY(15, 55);
$pdf->Cell(65, 5, 'Position/Title/Type of Business');
$pdf->Cell(65, 5, 'Business Phone (incl. area code)');
$pdf->Cell(65, 5, 'Position/Title/Type of Business');
$pdf->Cell(65, 5, 'Business Phone (incl. area code)');

$pdf->SetXY(15, 60);

$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));
$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));
$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));
$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));

$pdf->SetXY(15, 70);
$pdf->Cell(260, 5, 'If employed in current position for less than two years or if currently employed in more than one position, complete the following:');
//repeat start
$pdf->SetXY(15, 75);

$pdf->Cell(60, 5, 'Name & Address of Employer');
$pdf->Cell(25, 0, $pdf->Checkbox('employer', 4,0).$pdf->Cell(5, 5, 'Self Employed'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(30, 5, 'Dates (from - to)');

$pdf->Cell(70, 5, 'Name & Address of Employer');
$pdf->Cell(25, 0, $pdf->Checkbox('employer', 4,0).$pdf->Cell(5, 5, 'Self Employed'), 0, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(30, 5, 'Dates (from -to)');


$pdf->SetXY(15, 80);
$pdf->Cell(20, 5, $pdf->TextField('address', 80, 6));
$pdf->Cell(20, 5, $pdf->TextField('job_year', 20, 6));
$pdf->Cell(20, 5, $pdf->TextField('address', 80, 6));
$pdf->Cell(20, 5, $pdf->TextField('job_year', 20, 6));



$pdf->SetXY(15, 85);
$pdf->Cell(85, 5, '');
$pdf->Cell(20, 5, 'Monthly Income');
$pdf->Cell(105, 5, '');
$pdf->Cell(20, 5, 'Monthly Income');

$pdf->SetXY(15, 90);
$pdf->Cell(85, 5, '');
$pdf->Cell(20, 5, $pdf->TextField('Income', 40, 6));
$pdf->Cell(65, 5, '');
$pdf->Cell(20, 5, $pdf->TextField('Income', 40, 6));

$pdf->SetXY(15, 95);
$pdf->Cell(65, 5, 'Position/Title/Type of Business');
$pdf->Cell(65, 5, 'Business Phone (incl. area code)');
$pdf->Cell(65, 5, 'Position/Title/Type of Business');
$pdf->Cell(65, 5, 'Business Phone (incl. area code)');

$pdf->SetXY(15, 100);

$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));
$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));
$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));
$pdf->Cell(5, 5, $pdf->TextField('profession', 60, 6));
//repeat end




/*
 
 
 $pdf->Cell(20, 5, 'Mortgage');
$pdf->Checkbox('VA', 4, 0);
$pdf->Cell(20, 5, 'VA');
$pdf->Checkbox('Conventional', 4,0);
$pdf->Cell(30, 5, 'Conventional');

$pdf->Checkbox('Other ', 4, 0);
$pdf->Cell(60, 5, 'Other(explain)');

$pdf->Cell(60, 5, 'Agency Case Number');

$pdf->Cell(60, 5, 'Lender Case Number');

$pdf->Ln(10);

$pdf->Cell(24,5, 'Applied for');
$pdf->Checkbox('FHA', 4, 1);
$pdf->Cell(20, 5, 'FHA');
$pdf->Checkbox('USDA/Rural', 4, 1);
$pdf->Cell(80,5, 'USDA/Rural Housing Service');
$pdf->TextField('agency number', 60, 6);
$pdf->TextField('lender number', 70, 6);
$pdf->Ln(11);

$pdf->Cell(44,5, 'Amount');
$pdf->Cell(44,5, 'Interest Rate');
$pdf->Cell(44,5, 'No of Months');
$pdf->Cell(24,5, 'Amortization Type');
$pdf->Ln(12);

$pdf->Cell(3,5, '$'). $pdf->TextField('amount', 41, 6);
$pdf->TextField('Interest Rate', 30, 6).$pdf->Cell(6,5, '%');
$pdf->TextField('No of Months', 30, 6);
$pdf->Cell(44,5, 'Fixed Rate');
$pdf->Checkbox('amortization_type', 4, 1);
$pdf->Cell(40, 5, 'Other (explain):');
$pdf->Checkbox('amortization_type', 4, 1);
$pdf->Ln(13);
$pdf->Cell(24,5, 'GPM');
$pdf->Checkbox('amortization_type', 4, 1);
$pdf->Cell(20, 5, 'ARM');
$pdf->Checkbox('amortization_type', 4, 1);
$pdf->Ln(13);
$txt = $pdf->Cell(44,10, 'Amount').$pdf->Checkbox('amortization_type', 4, 1);;
$pdf->MultiCell(55, 5, '[RIGHT] '.$txt, 1, 'R', 0, 1, '', '', true);
$pdf->MultiCell(55, 5, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(55, 5, '[DEFAULT] '.$txt, 1, '', 0, 1, '', '', true);*/

/*$pdf->SetXY(15, 120);

// text on center
$pdf->Cell(30, 0, 'Top-Center', 1, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
$pdf->Cell(30, 0, 'Center-Center', 1, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(30, 0, 'Bottom-Center', 1, $ln=0, 'C', 0, '', 0, false, 'B', 'C');
$pdf->Cell(30, 0, 'Ascent-Center', 1, $ln=0, 'C', 0, '', 0, false, 'A', 'C');
$pdf->Cell(30, 0, 'Baseline-Center', 1, $ln=0, 'C', 0, '', 0, false, 'L', 'C');
$pdf->Cell(30, 0, 'Descent-Center', 1, $ln=0, 'C', 0, '', 0, false, 'D', 'C');

$pdf->SetXY(15, 190);
// text on top
$pdf->Cell(30, 0, 'Top-Top', 1, $ln=0, 'C', 0, '', 0, false, 'T', 'T');
$pdf->Cell(30, 0, 'Center-Top', 1, $ln=0, 'C', 0, '', 0, false, 'C', 'T');
$pdf->Cell(30, 0, 'Bottom-Top', 1, $ln=0, 'C', 0, '', 0, false, 'B', 'T');
$pdf->Cell(30, 0, 'Ascent-Top', 1, $ln=0, 'C', 0, '', 0, false, 'A', 'T');
$pdf->Cell(30, 0, 'Baseline-Top', 1, $ln=0, 'C', 0, '', 0, false, 'L', 'T');
$pdf->Cell(30, 0, 'Descent-Top', 1, $ln=0, 'C', 0, '', 0, false, 'D', 'T');*/


$pdf->Output('dsd.pdf', 'I');
//$pdf->Output('example_014.pdf', 'I');
die(); 
    
 
// set default form properties
/*$pdf->setFormDefaultProp(array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 200), 'strokeColor'=>array(255, 128, 128)));

$pdf->SetFont('helvetica', 'BI', 18);
$pdf->Cell(0, 5, 'Example of Form', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('helvetica', '', 12);

// First name
$pdf->Cell(35, 5, 'First name:');
$pdf->TextField('firstname', 50, 5);
$pdf->Ln(6);

// Last name
$pdf->Cell(35, 5, 'Last name:');
$pdf->TextField('lastname', 50, 5);
$pdf->Ln(6);

// Gender
$pdf->Cell(35, 5, 'Gender:');
$pdf->ComboBox('gender', 30, 5, array(array('', '-'), array('M', 'Male'), array('F', 'Female')));
$pdf->Ln(6);

// Drink
$pdf->Cell(35, 5, 'Drink:');
//$pdf->RadioButton('drink', 5, array('readonly' => 'true'), array(), 'Water');
$pdf->RadioButton('drink', 5, array(), array(), 'Water');
$pdf->Cell(35, 5, 'Water');
$pdf->Ln(6);
$pdf->Cell(35, 5, '');
$pdf->RadioButton('drink', 5, array(), array(), 'Beer', true);
$pdf->Cell(35, 5, 'Beer');
$pdf->Ln(6);
$pdf->Cell(35, 5, '');
$pdf->RadioButton('drink', 5, array(), array(), 'Wine');
$pdf->Cell(35, 5, 'Wine');
$pdf->Ln(6);
$pdf->Cell(35, 5, '');
$pdf->RadioButton('drink', 5, array(), array(), 'Milk');
$pdf->Cell(35, 5, 'Milk');
$pdf->Ln(10);

// Newsletter
$pdf->Cell(35, 5, 'Newsletter:');
$pdf->CheckBox('newsletter', 5, true, array(), array(), 'OK');

$pdf->Ln(10);
// Address
$pdf->Cell(35, 5, 'Address:');
$pdf->TextField('address', 60, 18, array('multiline'=>true, 'lineWidth'=>0, 'borderStyle'=>'none'), array('v'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'dv'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'));
$pdf->Ln(19);

// Listbox
$pdf->Cell(35, 5, 'List:');
$pdf->ListBox('listbox', 60, 15, array('', 'item1', 'item2', 'item3', 'item4', 'item5', 'item6', 'item7'), array('multipleSelection'=>'true'));
$pdf->Ln(20);

// E-mail
$pdf->Cell(35, 5, 'E-mail:');
$pdf->TextField('email', 50, 5);
$pdf->Ln(6);

// Date of the day
$pdf->Cell(35, 5, 'Date:');
$pdf->TextField('date', 30, 5, array(), array('v'=>date('Y-m-d'), 'dv'=>date('Y-m-d')));
$pdf->Ln(10);

$pdf->SetX(50);*/
 
 
/*$html = '<table border="1" width="100%" style="font-size:10px;">
        <tr>
            <td style="width:50%">
                <table>
                    <tr>
                        <td  style="height:30px">Name of Originator Rockland Commercial, Inc.</td>
                    </tr>
                    <tr>
                        <td style="height:30px">Originator Address</td>
                        <td style="height:30px">[Originator Address]</td>
                    </tr>
                    <tr>
                        <td style="height:30px">Originator Phone Number (310) 662-4745</td>
                    </tr>
                    <tr>
                        <td style="height:30px">Originator Email jchaney@rocklandcommercial.com</td>
                    </tr>
                </table>    
            </td>
           
            
            
            <td style="width:50%">
                 <table>
                
                    <tr>
                        <td style="height:30px">Borrower</td>
                        <td style="height:30px">[Borrower]</td>
                    </tr>
                    <tr>
                        <td style="height:40px">Property Address</td>
                        <td style="height:40px">[Property Address]</td>
                    </tr>
                    <tr>
                        <td style="height:30px">Date of GFE</td>
                        <td style="height:30px">[Date of GFE]</td>
                    </tr>
                </table>    
            </td>
        </tr>
</table>';
$html .=  '<table width="100%" cellpadding="5"  style="font-size:10px;">

            <tr>
                <td style="width:30%">Purpose</td>
                <td style="width:70%">This GFE gives you an estimate of your settlement charges and loan terms if you are approved for this loan. For more information, see HUDs Special Information Booklet on settlement charges,
your Truth-in-Lending Disclosures, and other consumer information at www.hud.gov/respa. If you
decide you would like to proceed with this loan, contact us.</td>
            </tr>
             <tr>
                <td style="width:30%">Shopping for your loan</td>
                <td style="width:70%">Only you can shop for the best loan for you. Compare this GFE with other loan offers, so you can find the best loan. Use the shopping chart on page 3 to compare all the offers you receive.</td>
            </tr>
            <tr>
                <td style="width:30%">Important Dates</td>
                <td style="width:70%">1.The interest rate for this GFE is available through Not Available. After this time, the interest rate, some of your loan Origination Charges and the monthly payment shown below can
change until you lock your interest rate.<br/>
2. This estimate for all other settlement charges is available through / /. <br/>
3. After you lock your interest rate, you must go to settlement within Not Available days (your
rate lock period) to receive the locked interest rate. <br/>
4. You must lock the interest rate at least Not Available days before settlement.</td> <br/>
            </tr>
             <tr>
                <td style="width:30% height:30%">Summary of your loan</td>
                <td style="width:70%">
                    <table border= "1" width="100%" cellpadding="5"  style="font-size:10px;">
                        <tr>
                            <td>Your initial loan amount is</td>
                            <td>$ [Loan Amount]</td>
                        </tr>
                        <tr>
                            <td>Your loan term is</td>
                            <td>[Loan Term] years</td>
                        </tr>
                        <tr>
                            <td>Your initial interest rate is</td>
                            <td>[Interest Rate] %</td>
                        </tr>
                         <tr>
                            <td>Your initial monthly amount owed for principal,
interest, and any mortgage insurance is</td>
                            <td>$ [Monthly Amount] per month</td>
                        </tr>
                         <tr>
                            <td>Can your interest rate rise ?</td>
                            <td><input type="checkbox" name="interest_rate" style="width:20px;" value="no"/>No
                            <input type="checkbox" name="interest_rate" style="width:20px;" value="yes"/>Yes, it can rise to a maximum of 0.000%.The first change will be in</td>
                        </tr>
                         <tr>
                            <td>Even if you make payments on time, can your loan balance rise?</td>
                            <td><input type="checkbox" name="interest_rate" style="width:20px;" value="no"/>No
                            <input type="checkbox" name="interest_rate" style="width:20px;" value="yes"/>Yes, it can rise to a maximum of $0.00</td>
                        </tr>
                         <tr>
                            <td>Even if you make payments on time, can your monthly amount owed for principal, interest,
and any mortgage insurance rise ?</td>
                            <td><input type="checkbox" name="interest_rate" style="width:20px;" value="no"/>No
                            <input type="checkbox" name="interest_rate" style="width:20px;" value="yes"/>Yes, the first increase can be in and the monthly amount owed can rise to $0.00. The maximum it can ever rise to is $0.00.</td>
                        </tr>
                         <tr>
                            <td>Does your loan have a prepayment penalty?</td>
                            <td><input type="checkbox" name="interest_rate" style="width:20px;" value="no"/>No
                            <input type="checkbox" name="interest_rate" style="width:20px;" value="yes"/>Yes, your maximum prepayment penalty is $0.00</td>
                        </tr>
                         <tr>
                            <td>Does your loan have a balloon payment ?</td>
                            <td><input type="checkbox" name="interest_rate" style="width:20px;" value="no"/>No
                            <input type="checkbox" name="interest_rate" style="width:20px;" value="yes"/>Yes, you have a balloon payment of $70,700.00 due in 0.0 years.</td>
                        </tr>
                    </table>    
                
                </td>
             
            </tr>
            <tr>
                <td style="width:30%">Escrow account information</td>
                <td style="width:70%">Some lenders require an escrow account to hold funds for paying property taxes or other property-related charges in addition to your monthly amount owed of $ 833.33
Do we require you to have an escrow account for your loan ?<br/> 
<input type="checkbox" name="interest_rate" style="width:20px;" value="no"/> No, you do not have an escrow account. You must pay these charges directly when due.<br/>
<input type="checkbox" name="interest_rate" style="width:20px;" value="yes"/> Yes, you have an escrow account. It may or may not cover all of these charges. Ask us.</td>
            </tr>
            <tr>
                <td style="width:30%">Summary of your settlement charges</td>
                <td style="width:70%">
                <table border= "1" width="100%"  cellpadding="5" >
                    <tr>
                        <td style="width:5%">A</td>
                        <td style="width:70%">Your Adjusted Origination Charges (See page 2.)</td>
                        <td style="width:25%">$ [Origination Charges]</td>
                    </tr>
                    <tr>
                        <td style="width:5%">B</td>
                        <td style="width:70%">Your Charges for All Other Settlement Services (See page 2.)</td>
                        <td style="width:25%">$ [Settlement Services]</td>
                    </tr>
                     <tr>
                        <td style="width:4%">A</td>
                        <td style="width:4%">+</td>
                        <td style="width:4%">B</td>
                        <td style="width:65%">Total Estimated Settlement Charges</td>
                        <td style="width:23%">$ [Total Charges]</td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td style="width:30%">Understanding your estimated settlement charges</td>
                <td style="width:70%">
                <table border= "1" width="100%" cellpadding="5" style="font-size:10px;">
                    <tr>
                        <td>Your Adjusted Origination Charges</td>
                    </tr>
                    <tr>
                        <td style ="width:70%">1. <strong>Our Origination Charge</strong><br/>
                        This charge is for getting this loan for you. <br/>
                        Lender Fee ()  <br/>
                        Broker Origination Fee (0.00) <br/>
                        Broker Allocation Fee (0.00)</td>
                        <td style="width:30%"> $ [Origination Charge]<br/><br/>$ [Lender Fee]<br/>
                        $ [Broker Origination Fee] <br/>
                        $ [Broker Allocation Fee] </td>
                    </tr>
                     <tr>
                        <td style="width:70%">2. <strong>Your credit or charge (points) for the specific interest rate chosen</strong><br/>
                       <input type="checkbox" name="interest_charge" style="width:20px;" value="yes"/> The credit or charge for the interest rate of 10.000% is included in Our origination charge. (See item 1 above.). <br/>';
                       
                       
                       $html .= $pdf->Cell(44,5, 'Fixed Rate');
                        $html .=  $pdf->Checkbox('amortization_type', 4, 1);
                        
                        
                         $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true); 
                        $html2 = '<input type="checkbox" name="interest_charge" style="width:20px;" value="yes"/> You receive a credit of $0.00 for this interest rate of 10.000%. This credit reduces your settlement charges. <br/>
                         <input type="checkbox" name="interest_charge" style="width:20px;" value="yes"/> You pay a charge of $0.00 for this interest rate of 10.000%. This charge (points) increases your settlement charges.<br/>
                       The tradeoff table on page 3 shows that you can change your total settlement charges
by choosing a different interest rate for this loan.</td>
                        <td style="width:30%"> <br/>
                       <br/>
                        $ [Total Charge]</td>
                    </tr>
                    <tr>
                        <td style="width:10%">A</td>
                        <td style="width:60%"> Your Adjusted Origination Charges</td>
                        <td style="width:30%">$ [Adjusted Origination Charges]</td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:70%">
                <table border= "1" width="100%" cellpadding="5" style="font-size:8px;">
                    <tr>
                        <td>Your Charges for all Other Settlement Services</td>
                    </tr>
                    <tr>
                        <td style="width:70%">3. <strong>Required services that we select</strong><br/>
                       These charges are for services we require you to complete your settlement. We will choose the providers of these services. <br/>
                            <table width="100%">
                                <tr>
                                    <td style="width:50%"><strong>Service</strong></td>
                                    <td style="width:50%"><strong>Charge</strong></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Wire Transfer Fee</td>
                                    <td style="width:50%">$ [Wire Transfer Fee]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Underwriting Fee</td>
                                    <td style="width:50%">$ [Underwriting Fee]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Document Preparation Fee</td>
                                    <td style="width:50%">$ [Document Preparation Fee]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Rockland Commercial Wire Transfer Fee</td>
                                    <td style="width:50%">$ [Rockland Commercial Wire Transfer Fee]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Rockland Commercial Processing Fee</td>
                                    <td style="width:50%">$ [Rockland Commercial Processing Fee]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Rockland Commercial Underwriting Fe</td>
                                    <td style="width:50%">$ [Rockland Commercial Underwriting Fe]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Rockland Commercial Document Prepar</td>
                                    <td style="width:50%">$ [Rockland Commercial Document Prepar]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Rockland Commercial Credit Investing</td>
                                    <td style="width:50%">$ [Rockland Commercial Credit Investing]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Settlement or Closing/Escrow Pad</td>
                                    <td style="width:50%">$ [Settlement or Closing/Escrow Pad]</td>
                                </tr>
                                 <tr>
                                    <td style="width:50%">Settlement or Closing/Escrow Fee</td>
                                    <td style="width:50%">$ [Settlement or Closing/Escrow Fee]</td>
                                </tr>
                        
                            </table>
                        </td>
                        <td>$ [Total Fee]</td>
                    </tr>
                    <tr>
                        <td style="width:70%"><strong>4. Title services and lenders title insurance</strong><br/>This charge includes the services of a title or settlement agent, for example, and the
    title insurance to protect the lender if required.</td>
                        <td style="width:30%">$ [Service Charge]</td>
                    </tr>
                    <tr>
                        <td style="width:70%"><strong>5. Owners title insurance</strong><br/>You may purchase an owners title insurance policy to protect your interest in the property.</td>
                        <td style="width:30%">$ [Owners Insurance]</td>
                    </tr>
                    <tr>
                        <td style="width:70%"><strong>6. Required services that you can shop for</strong><br/>These charges are for the other services required to complete your settlement. We can identify providers of these services or you can shop for them yourself. Our estimates for providing these services are below.<br/>
                            <table>
                                <tr>
                                    <td style="width:50%"><strong>Service</strong></td>
                                    <td style="width:50%"><strong>Charge</strong></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">None</td>
                                    <td style="width:50%"></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:30%">$ [Required Services]</td>
                    </tr>
                     <tr>
                        <td style="width:70%"><strong>7. Government recording charges</strong><br/>These charges are for state and local fees to record your loan and title documents.</td>
                        <td style="width:30%">$ [Government Charges]</td>
                    </tr>
                    <tr>
                        <td style="width:70%"><strong>8. Transfer taxes</strong><br/>These charges are for state and local fees on mortgages and home sales.</td>
                        <td style="width:30%">$ [Transfer Taxes]</td>
                    </tr>
                    <tr>
                        <td style="width:70%"><strong>9.Initial Deposit for your escrow account </strong><br/>This charge is held in an escrow account to pay future recurring charges on your
property and includes <input type="checkbox" name="interest_charge" style="width:20px;" value="yes"/> all property taxes, <input type="checkbox" name="interest_charge" style="width:20px;" value="yes"/>all insurance, and <input type="checkbox" name="interest_charge" style="width:20px;" value="yes"/>other: .</td>
                        <td style="width:30%">$ [Mortgages Charges]</td>
                    </tr>
                    <tr>
                        <td style="width:70%"><strong>10. Daily Interest Charges</strong><br/>This charge is for the daily interest on your loan from the day of your settlement until
the first day of the next month or the first day of your normal mortgage payment cycle.
This amount is $27.77777778 per day for 30 days (if your settlement is 06/01/2013).</td>
                        <td style="width:30%">$ [Interest Charges]</td>
                    </tr>
                    <tr>
                        <td style="width:70%"><strong>11. Homeowners Insurance</strong><br/>This charge is for the insurance you must buy for the property to protect from a loss,
such as fire.<br/>
                            <table>
                                <tr>
                                    <td style="width:50%"><strong>Policy</strong></td>
                                    <td style="width:50%"><strong>Charge</strong></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">None</td>
                                    <td style="width:50%"></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:30%">$ [Interest Charges]</td>
                    </tr>
                    <tr>
                        <td style="width:5%"><strong>B</strong></td>
                        <td style="width:65%"><strong>Your Charges for All Other Settlement Services</strong></td>
                        <td style="width:30%">$ [Settlement Charges]</td>
                    </tr>
                    <tr>
                        <td style="width:3%"><strong>A</strong></td>
                        <td style="width:4%"><strong>+</strong></td>
                        <td style="width:3%"><strong>B</strong></td>
                        <td style="width:60%"><strong>Total Estimated Settlement Charges</strong></td>
                        <td style="width:30%">$ [Estimated Charges]</td>
                    </tr>
                </table>
                </td>
            </tr>
             <tr>
                <td style="width:30%">Instructions<br/>Understanding which charges can change at settlement</td>
                <td style="width:70% ;font-size:8px;">This GFE estimates your settlement charges. At your settlement, you will receive a HUD-1, a form that lists your actual costs.Compare the charges on the HUD-1 with the charges on this GFE. Charges can change if you select your own provider and do not use the companies we identify (see below for details.)<br/> 
                  <table border= "1" width="100%" cellpadding="5"  style="font-size:8px;">
                    <tr>
                        <td style="width:35%"><strong>These charges cannot increase at settlement</strong></td>
                        <td style="width:35%"><strong>The total of these charges can increase up to 10% at settlement</strong></td>
                        <td style="width:30%"><strong>These charges can change at settlement</strong></td>
                    </tr>
                    <tr>
                        <td style="width:35%">
                            <ul>
                                <li>Our origination charge</li>
                               <li>Your credit or charge (points) for the specific interest rate chosen (after you lock in your interest rate)</li>
                               <li>Your adjusted origination charges(after you lock in your interest rate)</li>
                              <li> Transfer taxes</li>
                            </ul>
                        </td>
                        <td style="width:35%">
                            <ul>
                                <li>Required services that we select</li>
                                <li>Title services and lenders insurance (if we select them or you use companies we identify)</li>
                                <li>Owners title insurance (if you use companies we identify)</li>
                                <li>Required services that you can shop for (if you use companies we identify)</li>
                                 <li>Government recording charges</li>
                            </ul>
                        </td>
                        <td style="width:30%">
                            <ul>
                                <li>Required services that you can shop for (if you do not use companies we
identify) </li>
                                <li> Title services and lenders insurance (if you do not use companies we identif</li>
                                <li>Owners title insurance (if you do not use companies we identify)</li>
                                <li>Initial deposit for your escrow account</li>
                                <li>Daily interest charges</li>
                                <li> Homeowners insurance</li>
                            </ul>    

                        </td>
                    </tr>
                     
                  </table>       
                </td>
            </tr>
            <tr>
                <td style="width:30%">Using the tradeoff table</td>
                <td style="width:70%; font-size:8px;">In this GFE, we offered you this loan with a particular interest rate and estimated settlement charges. However:<br/>
               <input type="checkbox" name="lower_settlement" style="width:20px;" value="yes"/> If you want to choose this same loan with lower settlement charges, then you will have a higher interest rate.<br/>
                <input type="checkbox" name="lower_interest" style="width:20px;" value="yes"/> If you want to choose this same loan with a lower interest rate, then you will have higher settlement charges.<br/>
                If you would like to choose an available option, you must ask us for a new GFE.<br/>
                Loan originators have the option to complete this table. Please ask for additional information if the table is not completed.<br/>
                  <table border="1" width="100%" cellpadding="5"  style="font-size:8px;">
                    <tr>
                        <td style="width:25%"></td>
                        <td style="width:20%"><strong>The Loan in this GFE</strong></td>
                        <td style="width:20%"><strong>The same loan with lower settlement charges</strong></td>
                        <td style="width:20%"><strong>The same loan with lower interest rate</strong></td>
                    </tr>
                    <tr>
                        <td style="width:25%">Your initial loan amount </td>
                        <td style="width:20%">$ [Loan Amount]</td>
                        <td style="width:20%">$ [Loan Amount Settlement]</td>
                        <td style="width:20%">$ [Loan Amount Interest]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Your initial interest rate amount</td>
                        <td style="width:20%"> [Interest Rate] %</td>
                        <td style="width:20%">[Interest Rate Settlement] %</td>
                        <td style="width:20%">[Lower Interest Rate Settlement] %</td>
                    </tr>
                    <tr>
                        <td style="width:25%">Your initial monthly amount owed</td>
                        <td style="width:20%"> [Interest Rate] %</td>
                        <td style="width:20%">[Interest Rate Settlement] %</td>
                        <td style="width:20%">[Lower Interest Rate Settlement] %</td>
                    </tr>
                    <tr>
                        <td style="width:25%">Change in the monthly amount owed from this GFE</td>
                        <td style="width:20%">No change</td>
                        <td style="width:20%">You will pay $[Monthly Payment] <strong> more </strong> every month</td>
                        <td style="width:20%">You will pay $ [Less Payment] <strong>less </strong>every month %</td>
                    </tr>
                    <tr>
                        <td style="width:25%">Change in the amount you will pay at the settlement with this interest rate</td>
                        <td style="width:20%"> No change</td>
                        <td style="width:20%">Your settlement charges will be reduced by $ [Reduction ]</td>
                        <td style="width:20%">Your settlement charges will increase by $ [Increased]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">How much your total estimated settlement charges will be</td>
                        <td style="width:20%">$ [Total Loan]</td>
                        <td style="width:20%">$ [Total Settlement] </td>
                        <td style="width:20%">$ [Total Interest]</td>
                    </tr>
                    </table>
                    <p>For an adjustable rate loan, the comparisons above are for initial interest rate before adjustments are made</p>
                </td>
            </tr>
            <tr>
                <td style="width:30%">Using the shopping chart</td>
                <td style="width:70%; font-size:8px;">Use this chart to compare GFEs from different loan originators. Fill in the information be using a different column for each GFE you receive. By comparing loan offers, you can shop for the best loan.<br/>
              
                  <table border= "1" width="100%" cellpadding="5"  style="font-size:8px;">
                    <tr>
                        <td style="width:25%"></td>
                        <td style="width:20%"><strong>This Loan</strong></td>
                        <td style="width:15%"><strong>Loan 2</strong></td>
                        <td style="width:15%"><strong>Loan 3</strong></td>
                        <td style="width:15%"><strong>Loan 4</strong></td>
                    </tr>
                    <tr>
                        <td style="width:25%">Loan originator name </td>
                        <td style="width:20%">[Originator Name]</td>
                        <td style="width:15%">[Loan 2 Originator]</td>
                        <td style="width:15%">[Loan 3 Originator]</td>
                        <td style="width:15%">[Loan 4 Originator]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Initial loan amount</td>
                        <td style="width:20%">$ [Loan Amount]</td>
                        <td style="width:15%">$ [Loan 2 Originator]</td>
                        <td style="width:15%">$ [Loan 3 Originator]</td>
                        <td style="width:15%">$ [Loan 4 Originator]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Loan term </td>
                        <td style="width:20%">$ [Loan Term]</td>
                        <td style="width:15%">$ [Loan 2 Term]</td>
                        <td style="width:15%">$ [Loan 3 Term]</td>
                        <td style="width:15%">$ [Loan 4 Term]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Initial interest rate</td>
                        <td style="width:20%"> [Interest Rate] %</td>
                        <td style="width:15%">[Interest Rate 2] %</td>
                        <td style="width:15%">[Interest Rate 3] %</td>
                        <td style="width:15%"> [Interest Rate 4]%</td>
                    </tr>
                    <tr>
                        <td style="width:25%">Initial monthly amount owed</td>
                        <td style="width:20%">$[Initial monthly]</td>
                        <td style="width:15%">$[Initial monthly 2] </td>
                        <td style="width:15%">$[Initial monthly 3] </td>
                        <td style="width:15%">$ [Initial monthly 4]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Rate lock period</td>
                        <td style="width:20%"> [Lock Period]</td>
                        <td style="width:15%">[Lock Period 2] </td>
                        <td style="width:15%">[Lock Period 3] </td>
                        <td style="width:15%">[Lock Period 4]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Can interest rate rise?</td>
                        <td style="width:20%"> [Interest Rate]</td>
                        <td style="width:15%">[Interest Rate Settlement] %</td>
                        <td style="width:15%">[Lower Interest Rate Settlement] %</td>
                        <td style="width:15%">$ [Loan Amount Interest]</td>
                    </tr>
                      <tr>
                        <td style="width:25%">Can loan balance rise?</td>
                        <td style="width:20%"> [Interest Rate] %</td>
                        <td style="width:15%">[Interest Rate Settlement] %</td>
                        <td style="width:15%">[Lower Interest Rate Settlement] %</td>
                        <td style="width:15%">$ [Loan Amount Interest]</td>
                    </tr>
                    <tr>
                        <td style="width:25%">Can monthly amount owed rise?</td>
                        <td style="width:20%"> [Interest Rate] %</td>
                        <td style="width:15%">[Interest Rate Settlement] %</td>
                        <td style="width:15%">[Lower Interest Rate Settlement] %</td>
                        <td style="width:15%">$ [Loan Amount Interest]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Prepayment penalty?</td>
                        <td style="width:20%"> [Interest Rate] %</td>
                        <td style="width:15%">[Interest Rate Settlement] %</td>
                        <td style="width:15%">[Lower Interest Rate Settlement] %</td>
                        <td style="width:15%">$ [Loan Amount Interest]</td>
                    </tr>
                     <tr>
                        <td style="width:25%">Balloon payment </td>
                        <td style="width:20%"> [Interest Rate] </td>
                        <td style="width:15%">[Interest Rate Settlement] %</td>
                        <td style="width:15%">[Lower Interest Rate Settlement] %</td>
                        <td style="width:15%">$ [Loan Amount Interest]</td>
                    </tr>
                    <tr>
                        <td style="width:25%">Total Estimated Settlement Charges</td>
                        <td style="width:20%">Total from Box A</td>
                        <td style="width:15%">[Interest Rate Settlement] %</td>
                        <td style="width:15%">[Lower Interest Rate Settlement] %</td>
                        <td style="width:15%">$ [Loan Amount Interest]</td>
                    </tr>
                    </table>
                    
                </td>
            </tr>
            <tr>
               <td style="width:30%">If your loan is sold in the future</td>
                <td style="width:70%; font-size:10px;">Some lenders may sell your loan after settlement. Any fees lenders receive in the future cannot change the loan you receive or the charges you paid at settlement.</td>
            </tr>
            
        </table><br/>
        
        
            
                <p>_________________________________</p>
                <p style="text-align:right">Date</p>
         
           
           
                <p style="text-align:right">x_________________________________</p>
                <p[Borrower] style="text-align:right">Date </p>';
 
/*$html .= '<p style="text-align:center"><span style="font-size:14px"><strong>Trust Deed flyer Draft</strong></span></p>

<p>{COMPANY_TEMPLATE_HEADER}</p>

<table border="0" style="width:100%">
	<tbody>
		<tr>
			<td style="width:50%">&nbsp;
			<table border="0" cellpadding="0" cellspacing="10" style="font-size:12px">
				<tbody>
					<tr>
						<td>{TRUST DEED POSITION}</td>
					</tr>
					<tr>
						<td>{LOAN NOTE PAY} Note Rate</td>
					</tr>
					<tr>
						<td>{TRUST DEED PERPAY} Prepay</td>
					</tr>
					<tr>
						<td>{TRUST DEED LOAN TERM} Loan Term</td>
					</tr>
					<tr>
						<td>Transaction Type: {TRUST DEED TRANSACTION TYPE}</td>
					</tr>
					<tr>
						<td>
						<table border="0" style="width:70%">
							<tbody>
								<tr>
									<td>Purchase Price :</td>
									<td>$ {PURCHASE PRICE}</td>
								</tr>
								<tr>
									<td>Entitlements to date :</td>
									<td><u>{ENTITLEMENT TO DATE}</u></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>$ {TOTAL PPETD}</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
					<tr>
						<td>Requested 1<sup>st</sup> TD Loan Amount: $ {FIRST TD LOAN}</td>
					</tr>
					<tr>
						<td>LTV: {LTV} %</td>
					</tr>
					<tr>
						<td>Property Type: {PROPERTY TYPE}</td>
					</tr>
					<tr>
						<td>Property Description: {BED} bed / {BATH} bath</td>
					</tr>
					<tr>
						<td>Year Built: {YEAR BUILT}</td>
					</tr>
					<tr>
						<td>SqFt (Structure): {SQ FT STRUCTURE} total</td>
					</tr>
					<tr>
						<td>SqFt (Lot): {SQ FT LOT} total</td>
					</tr>
					<tr>
						<td>Occupancy: {OCCUPANCY TYPE} Occupied</td>
					</tr>
					<tr>
						<td>Monthly Rental Income: $ {MONTHLY RENTAL INCOME} /month</td>
					</tr>
					<tr>
						<td>Borrower: LLC {BORROWER ENTITY TYPE}</td>
					</tr>
					<tr>
						<td>Fico: {PERSONAL GUARANTOR}</td>
					</tr>
					<tr>
						<td>Occupation: {OCCUPATION GUARANTOR}</td>
					</tr>
					<tr>
						<td>Exit Strategy: {EXIT STRATEGY}</td>
					</tr>
					<tr>
						<td>{MORE FIELDS}</td>
					</tr>
				</tbody>
			</table>
			</td>
			<td style="width:50%">{PROPERTY IMAGES}</td>
		</tr>
	</tbody>
</table>';*/
//$html = $pdfTemplate['EmailTemplate']['template'];
//$pdf->writeHTML($html, true, false, true, false, ''); 
//$pdf->lastPage(); 
//echo $pdf->Output(WWW_ROOT . 'files/pdf' . DS . 'letter_of_intent.pdf', 'I');
//$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html2, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true); 
//$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->Output('example_014.pdf', 'I');
die();