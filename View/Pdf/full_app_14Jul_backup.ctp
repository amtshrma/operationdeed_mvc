<?php
//header("Content-type: application/pdf");
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

$amount = !empty($loanDetail['Loan']['loan_amount'])?$loanDetail['Loan']['loan_amount']:'';
$interestRate = '0.30';
$propertyAddress = !empty($loanDetail['ShortApplication']['property_address'])?$loanDetail['ShortApplication']['property_address']:'';
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

$pdf->SetFont('times', '', 8);
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
$html .= '<table border="0" style="font-size:8px;line-height:12px;">
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">
                <table>
                    <tr >
                        <td style="width:60%;border-bottom-width:0.1px;">
                            <table>
                                <tr> 
                                    <td style="width:10%" >Mortgage<br/>Applied For</td>';
                                    $checked = '';
                                   
                                    foreach($mortageValues as $key=>$val){
                                        $checked = (!empty($data['LongApp']['mortage']) && $data['LongApp']['mortage'] == $key) ? 'checked ="checked"' : '';
                                       if($key == 'VA' || $key == 'FHA') {
                                         $width = '12%';
                                        }else {
                                             $width = '20%';
                                        }
             $html .= '<td style="width:'.$width.'"><input '.$checked.' type="checkbox" readonly="readonly"  value="'.$key.'" size="5" name="mortgage_type">'.$key.'</td>';
                                    
                                        if($key == 'Conventional'){
                                            echo "<br />";
                                        }
                                    }
                                if(!empty($data['LongApp']['mortage_other'])) { 
                                    $html .= '<td> Other : ' .$data['LongApp']['mortage_other']. '</td>';
                                }
$html .= '</tr>
                            </table>
                        </td>
                        <td style="width:40%;border-bottom-width:0.1px;">
                            <table>
                                <tr>
                                    <td style="border-left-width:0.1px;">Agency Case Number<br/>
                                    <input readonly="readonly" style="border-bottom-width:0.1px;border-right-width:0.1px;font-weight:bold;font-size:11px;" type="text" size="30" name="agency_number" value ="'.$data["LongApp"]["agency_case_number"].'"></td>
                                     <td style="border-left-width:0.1px;"> Lender Case Number<br/>
                                    <input readonly="readonly" style="border-bottom-width:0.1px;border-right-width:0.1px;font-weight:bold;font-size:11px;" type="text" size="30" name="agency_number" value ="'.$data["LongApp"]["lender_case_number"].'"></td>
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
                                   <td style="font-weight:bold;font-size:11px;">$'.$amount.'</td>
                               </tr>
                           </table>    
                         </td>
                         <td style="border-right-width:0.1px;width:15%">
                            <table>
                               <tr>
                                   <td>Interest Rate</td>
                               </tr>
                                <tr>
                                   <td style="font-weight:bold;font-size:11px;">'.$interestRate.'%</td>
                               </tr>
                           </table>    
                         </td>
                          <td style="border-right-width:0.1px;width:15%">
                            <table>
                               <tr>
                                   <td>No. of Months</td>
                               </tr>
                                <tr>
                                   <td style="font-weight:bold;font-size:11px;">'.$monthNumber.'</td>
                               </tr>
                           </table>    
                         </td>
                          <td style="width:55%">Amortization type
                           <table>
                                <tr>';
                                $checked = '';
                                    foreach($amortizationValues as $key=>$val){
                                        $checked = (!empty($data['LongApp']['amortization_type']) && $data['LongApp']['amortization_type'] == $key) ? 'checked = "checked"' : '';
                                
                    $html .='<td style="width:25%"><input '.$checked.' readonly="readonly" type="checkbox" value="'.$key.'" size="5" name="amortization_type">'.$key.'</td>';
                                    }
                    $html .='</tr>
                                <tr>';
                                if(!empty($data['LongApp']['amortization_other'])) {
                                    
                     $html .='<td style="width:25%">Other <input readonly="readonly" type="text" value="'.$data['LongApp']['amortization_other'].'" size="5" ></td>';
                                }
                                 if(!empty($data['LongApp']['arm_type'])) {
                     $html .='<td style="width:75%">ARM (type):<input readonly="readonly" type="text" value="'.$data['LongApp']['arm_type'].'" ></td>';
                     }
                     $html .='</tr>
                            </table>
                         </td>
                        </tr>
                </table>
            </td>
        </tr>
        </table>';
        $html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">II. PROPERTY INFROMATION AND PURPOSE OF LOAN</h4>';
$html .= '<table border="0" width="100%" style="line-height:15px;">
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:80%">
                <table>
                       <tr>
                           <td>Subject Property Address (street, city, state, & ZIP)</td>
                       </tr>
                        <tr>
                           <td style="font-weight:bold;font-size:11px;">'.$data['LongAppPropertyInformation']['property_address'].'</td>
                       </tr>
                  
                </table>    
            </td>
            <td style="border-bottom-width:0.1px;width:20%">
                 <table>
                    <tr>
                        <td >No. of Units</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">'.$data['LongAppPropertyInformation']['property_number_of_units'].'</td>
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
                       <td style="font-weight:bold;font-size:11px;">'.$data['LongAppPropertyInformation']['property_legal_description'].'</td>
                   </tr>
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;width:20%">
                <table>
                   <tr>
                       <td>Year Built</td>
                   </tr>
                    <tr>
                       <td style="font-weight:bold;font-size:11px;">'.$data['LongAppPropertyInformation']['property_year_built'].'</td>
                   </tr>
               </table>    
             </td>
        </tr>
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">
                <table>
                   <tr>
                       <td style="width:20%"> Purpose of Loan </td>'; 
                      $trim = '';  $width = '20%';
                       foreach($loanPurpose as $key=>$val){ 
                            if($key == 'Construction-Permanent'){ 
                               $html .= '</tr><tr>';
                               $width = '40%';
                            }
							$checked = (!empty($data['LongAppPropertyInformation']['loan_purpose']) && $data['LongAppPropertyInformation']['loan_purpose'] == $key) ? 'checked = "checked"' : '';
                           $html .= '<td style="width:'.$width.'"><input '.$checked.' type="checkbox" readonly="readonly"  value="'.$key.'" size="5" name="loan_purpose">'.$key.'</td>';
                        }
                        if(!empty($data['LongAppPropertyInformation']['property_other_loan'])){
                            $html .= $data['LongAppPropertyInformation']['property_other_loan'];
                        }
        $html .='</tr>
                    
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;width:40%">
                <table>
                   <tr>
                       <td>Property will be in:</td>
                   </tr>
                    <tr>';
                      foreach($propertyArray as $key=>$val){
                        $checked = (!empty($data['LongAppPropertyInformation']['property_purpose']) && $data['LongAppPropertyInformation']['property_purpose'] == $key) ? 'checked ="checked"' : '';
                         $html .='<td style="width:35%"><input '.$checked.' type="checkbox" readonly="readonly"  value="'.$key.'" size="5" name="loan_purpose">'.$key.'</td>';
                        }
          $html .='</tr>
               </table>    
             </td>
             
        </tr>';
        if($data['LongAppPropertyInformation']['loan_purpose'] == 'Construction' || $data['LongAppPropertyInformation']['loan_purpose'] == 'Construction-Permanent') {
     $html .='<tr>
            <td><strong>Complete this line if construction or construction-permanent loan.</strong></td>
        </tr>
          <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">
                <table>
                    <tr>
                        <td>Year Lot Acquired</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;"><input type="text" value="'.$data['LongAppPropertyInformation']['cons_year_acquired'].'" size="15" readonly="readonly"></td>
                    </tr>
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>  
                    <tr>
                        <td>Original Cost</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">$<input type="text" value="'.$data['LongAppPropertyInformation']['cons_original_cost'].'" size="15" readonly="readonly"></td>
                    </tr>    
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>   
                    <tr>
                        <td>Amount Existing Liens</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">$<input type="text" value="'.$data['LongAppPropertyInformation']['cons_amount_existing'].'" size="15" readonly="readonly"></td>
                    </tr>  
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                    <tr>
                        <td>(a) Present Value of Lot</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">$<input type="text" value="'.$data['LongAppPropertyInformation']['cons_present_value'].'" size="15" readonly="readonly"></td>
                    </tr>
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>  
                    <tr>
                        <td>Cost of Improvements</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">$<input type="text" value="'.$data['LongAppPropertyInformation']['cons_cost_improvements'].'" size="15" readonly="readonly"></td>
                    </tr>  
               </table>    
             </td>
              <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">
                <table>
                    <tr>
                        <td>Total (a + b)</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">$<input type="text" value="'.$data['LongAppPropertyInformation']['cons_total_cost'].'" size="15" readonly="readonly"></td>
                    </tr>    
               </table>    
             </td>
        </tr>';
        }else if($data['LongAppPropertyInformation']['loan_purpose'] == 'Refinance') {
    $html .='<tr>
            <td style="width:100%"><strong>Complete this line if this is a refinance loan.</strong></td>
        </tr>
          <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">
                <table>
                    <tr>
                        <td>Year Lot Acquired</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;"><input type="text" value="'.$data['LongAppPropertyInformation']['ref_year_acquired'].'" size="15" readonly="readonly"></td>
                    </tr>
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                    <tr>
                        <td>Original Cost</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">$<input type="text" value="'.$data['LongAppPropertyInformation']['ref_original_cost'].'" size="15" readonly="readonly"></td>
                    </tr>
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                    <tr>
                        <td>Amount Existing Liens</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">$<input type="text" value="'.$data['LongAppPropertyInformation']['ref_amount_existing'].'" size="15" readonly="readonly"></td>
                    </tr>   
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">
                <table>
                    <tr>
                        <td>Purpose of Refinance</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;"><input type="text" value="'.$data['LongAppPropertyInformation']['ref_purpose_refinance'].'" size="15" readonly="readonly"></td>
                    </tr>
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:30%">
                <table>
                    <tr>
                        <td style="width:100%">Describe Improvements';
                        $improvementArray = array('made'=>'Made','to be made' => 'To be made');
                        foreach($improvementArray as $key=>$val){
							$checked = (!empty($data['LongAppPropertyInformation']['ref_des_improvements']) && $data['LongAppPropertyInformation']['ref_des_improvements'] == $key) ? 'checked ="checked"' : '';
												
           $html .=' <input readonly="readonly" '.$checked.' type="checkbox" value="'.$key.'" name="improvement_type">'.$val;
                        }     
           $html .='</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;">Cost : $<input type="text" value="'.$data['LongAppPropertyInformation']['ref_cost_improvements'].'" size="15" readonly="readonly"></td>
                    </tr>    
               </table>    
             </td>
        </tr>';
        }
     $html .= '<tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:30%">
                <table>
                    <tr>
                        <td>Title will be held in what Name(s)</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;"><input readonly="readonly" type="text" value="'.$data['LongAppPropertyInformation']['title_name'].'" size="60" ></td>
                    </tr>
               </table>    
             </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:30%">
                <table>
                    <tr>
                        <td>Manner in which Title will be held</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;"><input readonly="readonly" type="text" value="'.$data['LongAppPropertyInformation']['title_manner'].'" size="15" ></td>
                    </tr>   
               </table>    
             </td>
             <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%">
                <table>
                    <tr>
                        <td>Estate will be held in:</td>';
                        foreach($estimateArray as $key=>$val){
                            $checked = '';
                            if(!empty($data['LongAppPropertyInformation']['estimates']) && $data['LongAppPropertyInformation']['estimates']) {
                                $checked = $data['LongAppPropertyInformation']['estimates'];
                            }elseif($key == 'Fee Simple')  { 
                                $checked = 'checked';
                            } 
         $html .='<td><input readonly="readonly"  '.$checked.' type="checkbox" value="'.$key.'" >'.$val.'</td>';
                        }
                       if(!empty($data['LongAppPropertyInformation']['expiration_date']) && $data['LongAppPropertyInformation']['expiration_date']) {
                      $html .='<td>'.$data['LongAppPropertyInformation']['expiration_date'].'</td>';  
                       }
          $html .='</tr>        
               </table>    
             </td>
             
        </tr>
        <tr>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%">
                <table>
                    <tr>
                        <td>Source of Down Payment, Settlement Charges and/or Subordinate Financing (explain)</td>
                    </tr>
                     <tr>
                        <td style="font-weight:bold;font-size:11px;"><input readonly="readonly" type="text" value="'.$data['LongAppPropertyInformation']['source_down_payment'].'" size="60"></td>
                    </tr> 
               </table>    
             </td>
        </tr>
</table>';

//Borrower Information or LongAppBorrower
$html .= '<h6 align="left">Borrower</h6><h4 align="center" style="background-color:#000;color:#FFFFFF;">III. BORROWER INFROMATION</h4><h6 align="right">Co-Borrower</h6>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
        <tr>
        <td style="width:50%;border-right-width:0.1px">
            <table>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>Borrowers Name (include Jr. or Sr. if applicable)</td>
                            </tr>
                             <tr>
                                <td style="font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['borrower_name'].'</td>
                            </tr>
                        </table>    
                    </td>
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td style="width:25%;border-right-width:0.1px;">Social Security Number</td>
                                <td style="width:25%;border-right-width:0.1px;">Home Phone (incl. area code</td>
                                <td style="width:30%;border-right-width:0.1px;">DOB (MM/DD/YYYY)</td>
                                <td style="width:20%;border-right-width:0.1px;">Yrs. School</td>
                            </tr>
                             <tr>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['borrower_social_security_number'].'</td>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['borrower_home_phone'].'</td>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['borrower_dob'].'</td>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['borrower_school_year'].'</td>
                            </tr>        
                        </table>          
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">                    
                        <table>
                            <tr style="border-right-width:0.1px;">';
                            $width = '30%';
                            foreach($maritalStatus as $key=>$val){
                                if($key == 'Separated'){ 
                                    $html .= '</tr><tr>';
                                    $width = '100%'; 
                                 }elseif($key == 'Unmarried'){ 
                                    $html .= '';
                                    $width = '70%'; 
                                 }
				$checked = (!empty($data['LongAppBorrower']['marital_status']) && $data['LongAppBorrower']['marital_status'] == $key) ? 'checked ="checked"' : '';
                                  
                        $html .='<td style="font-weight:bold;font-size:11px;width:'.$width.'"><input name="borrower_marital_status" readonly="readonly" '.$checked.' type="checkbox" value="'.$key.'" >'.$val.'</td>';
                            }
                        $html .='</tr>
                              
                        </table>    
                    </td>
                    <td>
                         <table>
                            <tr style="border-right-width:0.1px;width:50%">
                                <td>Dependants (not listed by Co-Borrower)</td>
                            </tr>
                            <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"> no.'.$data['LongAppBorrower']['borrower_dependent_number'].'</td>
                                <td style="border-bottom-width:0.1px;width:50%"> ages ';
                                
                                foreach($data['LongAppBorrower']['borrower_dependent_age']  as $key=>$val){
                                    $html .='<br>'.$val;
                                }
                    $html .='</td></tr>    
                        </table>   
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;width:100%">                    
                        <table>
                            <tr>
                               
                                <td style="width:60%">Present Address (street, city, state, ZIP)</td>
                                <td style="width:40%">';
                                $houseType = array('Own' => 'Own','Rent'=>'Rent');
                                foreach($houseType as $key=>$val){
				    $checked = (!empty($data['LongAppBorrower']['borrower_house_type']) && $data['LongAppBorrower']['borrower_house_type'] == $key) ? ' checked="checked"' : '';		
									
                            $html .='<input ' . $checked.' readonly="readonly" type="checkbox" value="'.$key.'" size="2" name="address_type">'.$val;
                                }
                               if(!empty($data['LongAppBorrower']['borrower_on_rent_years']) && $data['LongAppBorrower']['borrower_on_rent_years'] != ''){
                    $html .='<input style="font-weight:bold;font-size:11px;" type="text" value="'.$data['LongAppBorrower']['borrower_on_rent_years'].'" size="4" name="borrower_on_rent_years">No Yrs';
                                }
                            $html .='</td>
                            </tr>
                             <tr>
                                <td style="font-weight:bold;font-size:11px;">';
                                if(!empty($data['LongAppBorrower']['borrower_present_address'])) {
                                $tempState = $data['LongAppBorrower']['borrower_state'];
                                $state =  !empty($tempState) ? $states[$tempState] : '';
                                $html .= $data['LongAppBorrower']['borrower_present_address']. ',' .$data['LongAppBorrower']['borrower_city']. ', ' .$state. ', ' .$data['LongAppBorrower']['borrower_zip_code'];
                                    }
                            $html .='</td>
                            </tr>
                       
                        </table>    
                    
                    </td>
                
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>

                            <tr>
                                <td>Mailing Address, if different from Present Address</td>
                            </tr>
                             <tr>
                                <td style="font-weight:bold;font-size:11px;">
                                     '.$data['LongAppBorrower']['borrower_mailing_address'].'
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
                                <td>Co-Borrowers Name (include Jr. or Sr. if applicable)</td>
                            </tr>
                             <tr>
                                <td style="font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['co_borrower_name'].'</td>
                            </tr>
                                   
                                      
                        </table>    
                    
                    </td>
                
                </tr>
                 <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td style="width:25%;border-right-width:0.1px;">Social Security Number</td>
                                <td style="width:25%;border-right-width:0.1px;">Home Phone (incl. area code</td>
                                <td style="width:30%;border-right-width:0.1px;">DOB (MM/DD/YYYY)</td>
                                <td style="width:20%;border-right-width:0.1px;">Yrs. School</td>
                            </tr>
                             <tr>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['co_borrower_social_security_number'].'</td>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['co_borrower_home_phone'].'</td>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['co_borrower_dob'].'</td>
                                <td style="border-right-width:0.1px;font-weight:bold;font-size:11px;">'.$data['LongAppBorrower']['co_borrower_school_year'].'</td>
                            </tr>        
                        </table>    
                    
                    </td>
                
                </tr>
            <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">                    
                        <table>
                            <tr style="border-right-width:0.1px;">';
                            $width = '30%';
                            foreach($maritalStatus as $key=>$val){
                                if($key == 'Separated'){ 
                                    $html .= '</tr><tr>';
                                    $width = '100%'; 
                                 }elseif($key == 'Unmarried'){ 
                                    $html .= '';
                                    $width = '70%'; 
                                 }
				$checked = (!empty($data['LongAppBorrower']['cob_marital_status']) && $data['LongAppBorrower']['cob_marital_status'] == $key) ? 'checked ="checked"' : '';
                                  
                        $html .='<td style="font-weight:bold;font-size:11px;width:'.$width.'"><input name="borrower_marital_status" readonly="readonly" '.$checked.' type="checkbox" value="'.$key.'" >'.$val.'</td>';
                            }
                        $html .='</tr>
                              
                        </table>    
                    </td>
                    <td>
                         <table>
                            <tr style="border-right-width:0.1px;width:50%">
                                <td>Dependants (not listed by Borrower)</td>
                            </tr>
                            <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"> no.'.$data['LongAppBorrower']['co_borrower_dependent_number'].'</td>
                                <td style="border-bottom-width:0.1px;width:50%;font-weight:bold;font-size:11px;"> ages ';
                                
                                foreach($data['LongAppBorrower']['borrower_dependent_age']  as $key=>$val){
                                    $html .='<br>'.$val;
                                }
                    $html .='</td></tr>    
                        </table>   
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:100%">                    
                        <table>
                               <tr>
                                    <td style="width:60%">Present Address (street, city, state, ZIP)</td>
                                    <td style="width:40%">';
                                    $houseType = array('Own' => 'Own','Rent'=>'Rent');
                                    foreach($houseType as $key=>$val){
                                        $checked = (!empty($data['LongAppBorrower']['co_borrower_house_type']) && $data['LongAppBorrower']['co_borrower_house_type'] == $key) ? ' checked="checked"' : '';		
                                        
                                $html .='<input ' . $checked.' readonly="readonly" type="checkbox" value="'.$key.'" size="2" name="address_type">'.$val;
                                    }
                                   if(!empty($data['LongAppBorrower']['borrower_on_rent_years']) && $data['LongAppBorrower']['borrower_on_rent_years'] != ''){
                        $html .='<input readonly="readonly" type="text" value="'.$data['LongAppBorrower']['borrower_on_rent_years'].'" size="4" name="borrower_on_rent_years" style="font-weight:bold;font-size:11px;">No Yrs';
                                    }
                                $html .='</td>
                            </tr>
                             <tr>
                                <td style="font-weight:bold;font-size:11px;">';
                                if(!empty($data['LongAppBorrower']['co_borrower_present_address'])) {
                                    $tempState = $data['LongAppBorrower']['co_borrower_state'];
                                $state =  !empty($tempState) ? $states[$tempState] : '';
                             $html .= $data['LongAppBorrower']['co_borrower_present_address']. ',' .$data['LongAppBorrower']['co_borrower_city']. ', ' .$state. ', ' .$data['LongAppBorrower']['co_borrower_zip_code'];
                                }
                        $html .='</td>
                            </tr>
                        </table>    
                    </td> 
                </tr>
                <tr>
                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                        <table>
                            <tr>
                                <td>Mailing Address, if different from Present Address</td>
                            </tr>
                             <tr>
                                <td style="font-weight:bold;font-size:11px;">
                                     '.$data['LongAppBorrower']['co_borrower_mailing_address'].'
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
                        <td style="width:55%">Present Address (street, city, state, ZIP)</td>
                        <td style="width:45%">
                        </td>
                    </tr>
                </table>
            </td>
            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">                    
                <table>
                    <tr>
                        <td style="width:55%">Former Address (street, city, state, ZIP)</td>
                        <td style="width:45%">
                            <input readonly="readonly" type="checkbox" value="Own" size="2" name="address_type">Own
                            <input readonly="readonly" type="checkbox" value="Rent" size="2" name="address_type">Rent
                            <input readonly="readonly" type="text" value="" size="4" name="mortgage_type">No Yrs
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <input readonly="readonly" type="text" value="" size="100" name="">
                        </td>
                    </tr>
                            
                </table>
            </td>
        </tr>
        
</table>';
//Employment Information or LongAppBorrowerEmployment
$html .= '<h6 align="left">Borrower</h6><h4 align="center" style="background-color:#000;color:#FFFFFF;">IV. EMPLOYEMENT INFORMATION</h4><h6 align="right">Co-Borrower</h6>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;">                    
                                <table>
                                   
                                    <tr>
                                       <td style="width:50%;font-weight:bold;font-size:11px;">Name & Address of Employer<br/>'.$data['LongAppBorrowerEmployment']['borrower_employer_name'].'</td>
                                       <td style="border-right-width:0.1px;width:30%"><input type="checkbox" value="Self Employed" size="5" name="employement_type" readonly="readonly">Self Employed</td>
                                       <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:20%;font-weight:bold;font-size:11px;">Yrs. on this job<br/>'.$data['LongAppBorrowerEmployment']['borrower_years_job'].'</td>
                                    </tr>
                                    <tr>
                                       <td style="width:55%"></td>
                                       <td style="width:25%"></td>
                                       <td style="border-left-width:0.1px;width:20%;font-weight:bold;font-size:11px;">Yrs. employed in this
line of work/profession<br/>'.$data['LongAppBorrowerEmployment']['borrower_years_inthis_field'].'</td>
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
                                                    <td style="font-weight:bold;font-size:11px;">'.$data['LongAppBorrowerEmployment']['borrower_position'].'</td>
                                                    <td style="font-weight:bold;font-size:11px;">'.$data['LongAppBorrowerEmployment']['borrower_business_phone'].'</td>
                                                    
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
                                       <td style="width:50%;font-weight:bold;font-size:11px;">Name & Address of Employer<br/>'.$data['LongAppBorrowerEmployment']['co_borrower_employer_name'].'</td>
                                       <td style="border-right-width:0.1px;width:30%"><input type="checkbox" readonly="readonly" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                       <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:20%;font-weight:bold;font-size:11px;">Yrs. on this job<br/>'.$data['LongAppBorrowerEmployment']['co_borrower_years_job'].'</td>
                                    </tr>
                                    <tr>
                                       <td style="width:55%"></td>
                                       <td style="width:25%"></td>
                                       <td style="border-left-width:0.1px;width:20%;font-weight:bold;font-size:11px;">Yrs. employed in this
line of work/profession<br/>'.$data['LongAppBorrowerEmployment']['co_borrower_years_inthis_field'].'</td>
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
                                                    <td style="font-weight:bold;font-size:11px;">'.$data['LongAppBorrowerEmployment']['co_borrower_position'].'</td>
                                                    <td style="font-weight:bold;font-size:11px;">'.$data['LongAppBorrowerEmployment']['co_borrower_business_phone'].'</td>
                                                    
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
                                       <td style="width:50%">Name & Address of Employer<br/>'.$data['LongAppBorrowerEmployment']['borrower_prev_employer_name'].'</td>
                                       <td style="border-right-width:0.1px;width:28%"><input readonly="readonly" type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                       <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:22%">Dates (from - to)<br/>'.$data['LongAppBorrowerEmployment']['borrower_prev_job_from'].' - '.$data['LongAppBorrowerEmployment']['borrower_prev_job_to'].'</td>
                                    </tr>
                                    <tr>
                                       <td style="width:55%"><input readonly="readonly" type="text" value="" size="35" name="mortgage_type"></td>
                                       <td style="width:23%"></td>
                                       <td style="width:22%">Monthly Income<br/>$'.$data['LongAppBorrowerEmployment']['borrower_prev_monthly_income'].'</td>
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
                                                    <td>'.$data['LongAppBorrowerEmployment']['borrower_prev_position'].'</td>
                                                    <td>'.$data['LongAppBorrowerEmployment']['borrower_prev_business_phone'].'</td>
                                                    
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
                                       <td style="width:50%">Name & Address of Employer<br/>'.$data['LongAppBorrowerEmployment']['co_borrower_prev_employer_name'].'</td>
                                       <td style="border-right-width:0.1px;width:28%"><input readonly="readonly" type="checkbox" value="Self Employed" size="5" name="employement_type">Self Employed</td>
                                       <td style="border-right-width:0.1px;border-bottom-width:0.1px;width:22%">Dates (from - to)<br/>'.$data['LongAppBorrowerEmployment']['co_borrower_prev_job_from'].' - '.$data['LongAppBorrowerEmployment']['co_borrower_prev_job_to'].'</td>
                                    </tr>
                                    <tr>
                                       <td style="width:55%"><input readonly="readonly" type="text" value="" size="35" name="mortgage_type"></td>
                                       <td style="width:23%"></td>
                                       <td style="width:22%">Monthly Income<br/>$'.$data['LongAppBorrowerEmployment']['co_borrower_prev_monthly_income'].'</td>
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
                                                    <td>'.$data['LongAppBorrowerEmployment']['co_borrower_prev_position'].'</td>
                                                    <td>'.$data['LongAppBorrowerEmployment']['co_borrower_prev_business_phone'].'</td>
                                                    
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
                <td style="font-weight:bold;border-bottom-width:0.1px;border-right-width:0.1px;">Gross Monthly Income</td>
                <td style="font-weight:bold;border-bottom-width:0.1px;border-right-width:0.1px;">Borrower</td>
                <td style="font-weight:bold;border-bottom-width:0.1px;border-right-width:0.1px;">Co-Borrower</td>
                <td style="font-weight:bold;border-bottom-width:0.1px;border-right-width:0.1px;">Total</td>
                <td style="font-weight:bold;border-bottom-width:0.1px;border-right-width:0.1px;">Combined Monthly Housing Expense</td>
                <td style="font-weight:bold;border-bottom-width:0.1px;border-right-width:0.1px;">Present</td>
                <td style="font-weight:bold;border-bottom-width:0.1px;border-right-width:0.1px;">Proposed</td>
            </tr>
             <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Base Empl. Income*</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_base_income'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['co_borrower_base_income'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['total_income'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Rent</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_rate'].'</td>
                <td style="background-color:#D8D8D8; border-bottom-width:0.1px;border-right-width:0.1px;"></td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Overtime</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_overtime'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['co_borrower_overtime'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['total_overtime'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">First Mortgage (P&I)</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_mortage'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['proposed_mortage'].'</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Bonuses</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_bonus'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['co_borrower_bonus'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['total_bonus'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Other Financing (P&I)</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_financing'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['proposed_financing'].'</td>
            </tr>
             <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Commissions</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_commission'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['co_borrower_commission'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['total_commission'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Hazard Insurance</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_hazard_insurance'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['proposed_hazard_insurance'].'</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Dividends/Interest</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_dividend'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['co_borrower_dividend'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['total_dividend'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Real Estate Taxes </td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_real_taxes'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['proposed_real_taxes'].'</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Net Rental Income</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_rental_income'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['co_borrower_rental_income'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['total_rental_income'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Mortgage Insurance</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_mortage_insurance'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['proposed_mortage_insurance'].'</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Other (before completing, see the notice in "describe other income", below)</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_other'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['co_borrower_other'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['total_other'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Homeowner Assn. Dues</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_homeowner_dues'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['proposed_homeowner_dues'].'</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">Total</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_other'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_other'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['borrower_other'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;"><strong>Total</strong></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['present_total'].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;">$'.$data['LongAppBorrowerIncome']['proposed_total'].'</td>
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
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input readonly="readonly" type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input readonly="readonly" type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%">$'.$data['LongAppBorrowerIncome']['other_income'].'</td>
            </tr>
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input readonly="readonly" type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input readonly="readonly" type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input readonly="readonly" type="text" value="" size="15" name="total"></td>
            </tr>    
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%"><input readonly="readonly" type="text" value="" size="4" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:70%"><input readonly="readonly" type="text" value="" size="45" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input readonly="readonly" type="text" value="" size="15" name="total"></td>
            </tr>

        </table>';
//INCOME Information or LongAppBorrowerEmploymentInfo
$html .= '<h4 align="center" style="background-color:#000;color:#FFFFFF;">VI. ASSETS AND LIABILITIES</h4>';
$html .= '<p>This Statement and any applicable supporting schedules may be completed jointly by both married and unmarried Co-Borrowers if their assets and liabilities are sufficiently joined
so that the Statement can be meaningfully and fairly presented on a combined basis; otherwise, separate Statements and Schedules are required. If the Co-Borrower section was
completed about a spouse, this Statement and supporting schedules must be completed about that spouse also.</p>
<p align="right">Completed <input type="checkbox" readonly="readonly" value="jointly" size="2" name="completed">Jointly<input readonly="readonly" type="checkbox" value="not-jointly" size="2" name="completed">Not Jointly</p>';
$html .= '<table border="0" width="100%" style="font-size:11px;">
            <tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%">
                    <table>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%"> <strong>ASSETS</strong><br/> Description</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%"><strong>Cash or Market Value</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Cash deposit toward purchase held by: <br/><input type="text" value="" size="20" name="total"></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:40%">$<input readonly="readonly" type="text" value="" size="15" name="total"></td>
                            
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:100%"><strong>List checking and savings accounts below</strong></td>
                        </tr>';
                        if(!empty($data['LongAppBorrowerEmploymentInfo']['bank_name'])){
                            foreach($data['LongAppBorrowerEmploymentInfo']['bank_name'] as $key => $value) {
                                $html .= '<tr>
                                    <td style="border-bottom-width:0.1px;width:100%">Name and address of Bank, S&L, or Credit Union<br/>'.$value.'<br/>'.$data['LongAppBorrowerEmploymentInfo']['bank_address'][$key].'</td>
                                
                                </tr>                       
                                 <tr>
                                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Acct. no.'.$data['LongAppBorrowerEmploymentInfo']['account_no'][$key].'</td>
                                    <td style="border-bottom-width:0.1px;width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['amount'][$key].'</td>
                                </tr>';
                            }
                        }
                    $html .='<tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Stocks & Bonds (Company name/number
& description)<br/><input readonly="readonly" type="text" value="" size="20" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%"><br/>$'.$data['LongAppBorrowerEmploymentInfo']['stocks_and_bonds'].'</td>
                        </tr>                       
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Life insurance net cash value<br/>Face amount: $<input readonly="readonly" type="text" value="" size="15" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['life_insurance'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%"><strong>Subtotal Liquid Assets</strong></td>
                            <td style="border-bottom-width:0.1px;width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['subtotal_liquid_assests'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Real estate owned (enter market value from schedule of real estate owned)</td>
                            <td style="border-bottom-width:0.1px;width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['real_estate_owned'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Vested interest in retirement fund</td>
                            <td style="border-bottom-width:0.1px;width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['interest_on_retirement_fund'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Net worth of business(es) owned(attach financial statement)</td>
                            <td style="border-bottom-width:0.1px;width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['business_owned'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Automobiles owned (make and year)<br/><input type="text" value="" size="10" name="total"></td>
                            <td style="border-bottom-width:0.1px;width:45%">$'.$data['LongAppBorrowerEmploymentInfo']['automobile_owned'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:60%">Other Assets (itemize)<br/><input type="text" value="" size="10" name="total" readonly="readonly"></td>
                            <td style="border-bottom-width:0.1px;width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['other_assests'].'</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                         <tr>
                            <td style="border-right-width:0.1px;width:60%"><strong>Total Assets a.</strong></td>
                            <td style="width:40%">$'.$data['LongAppBorrowerEmploymentInfo']['total_assests'].'</td>
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
                            
                            </tr>';
                           // if(!empty($data['LongAppBorrowerEmploymentInfo']['lib_company_address'])){
                                foreach($data['LongAppBorrowerEmploymentInfo']['lib_company_address'] as $key => $value) {
                                $html .= '<tr>
                                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Name and address of Company<br/>'.$value.'</td>
                                    <td style="border-right-width:0.1px;width:25%">$ Payment/Months<br/>$'.$data['LongAppBorrowerEmploymentInfo']['lib_company_payment_per_month'][$key].'</td>
                                    <td style="border-right-width:0.1px;width:25%">$'.$data['LongAppBorrowerEmploymentInfo']['lib_company_unpaid_balance'][$key].'</td>
                                 </tr>
                                 <tr>
                                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Acct. no.'.$data['LongAppBorrowerEmploymentInfo']['lib_company_account_number'][$key].'</td>
                                    <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"></td>
                                 </tr>';
                                }
                            //}
                        $html .= '<tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Alimony/Child Support/Separate Maintenance Payments Owed to:<br/><input readonly="readonly" type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$ '.$data['LongAppBorrowerEmploymentInfo']['lib_child_support'].'</td>
                                <td style="background-color:#D8D8D8; border-right-width:0.1px;width:25%"></td>
                        
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">Job-Related Expense (child care, union dues, etc.)<input readonly="readonly" type="text" value="" size="20" name="total"></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$ '.$data['LongAppBorrowerEmploymentInfo']['lib_job_expanse'].'</td>
                                <td style="background-color:#D8D8D8; border-right-width:0.1px;width:25%"></td>
                               
                             </tr>
                             <tr>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><strong>Total Monthly Payments</strong></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$ <br/><input readonly="readonly" type="text" value="" size="20" name="total"></td>
                                <td style="background-color:#D8D8D8; border-right-width:0.1px;width:25%"></td>
                               
                             </tr>
                             <tr>
                                <td style="background-color:#D8D8D8; border-bottom-width:0.1px;border-right-width:0.1px;width:25%"><strong>Net Worth (a minus b)</strong></td>
                                <td style="border-bottom-width:0.1px; border-right-width:0.1px;width:25%"><strong>$ '.$data['LongAppBorrowerEmploymentInfo']['total_liabilities'].'</strong></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%"><strong>Total Liabilities b.</strong></td>
                                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:25%">$ '.$data['LongAppBorrowerEmploymentInfo']['final_assests'].'</td>
                               
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
            </tr>';
            if(!empty($data['LongAppBorrowerRealEstate']['other_property_address'])){
                foreach($data['LongAppBorrowerRealEstate']['other_property_address'] as $key => $value) {
$html .= '<tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">'.$value.'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:5%">'.ucfirst($data['LongAppBorrowerRealEstate']['other_property_type'][$key]).'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">$'.$data['LongAppBorrowerRealEstate']['present_market_value'][$key].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">$'.$data['LongAppBorrowerRealEstate']['mortage_amount'][$key].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$'.$data['LongAppBorrowerRealEstate']['rental_income'][$key].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$'.$data['LongAppBorrowerRealEstate']['mortage_payment'][$key].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$'.$data['LongAppBorrowerRealEstate']['misc_income'][$key].'</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$'.$data['LongAppBorrowerRealEstate']['total_income'][$key].'</td>
            </tr>';
                }
            }
 $html .= '<tr>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:20%"><input readonly="readonly" type="text" value="" size="15" name="total"></td>
                
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">Totals</td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:10%">$<input readonly="readonly" type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input readonly="readonly" type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input readonly="readonly" type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input readonly="readonly" type="text" value="" size="5" name="total"></td>
                <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:15%">$<input readonly="readonly" type="text" value="" size="5" name="total"></td>
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
                <td style="border-bottom-width:0.1px;width:35%">'.$data['LongAppBorrowerRealEstate']['altername_name'].'</td>
                <td style="border-bottom-width:0.1px;width:35%">'.$data['LongAppBorrowerRealEstate']['creditor_name'].'</td>
                <td style="border-bottom-width:0.1px;width:30%">'.$data['LongAppBorrowerRealEstate']['account_number'].'</td>
                
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
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_purchase_price'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">b. Alterations, improvements, repairs</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_repair_improvement'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">c. Land (if acquired separately)</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_land'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">d. Refinance (incl. debts to be paid off)</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_refinance_debt'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">e. Estimated prepaid items</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_estimated'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">f. Estimated closing costs</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_prepaid_estimate'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">g. PMI, MIP, Funding Fee</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_pmi_funding'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">h. Discount (if Borrower will pay)</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_discount'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%"><strong>i. Total costs (add items a through h)</strong></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_total_transaction_a_to_h'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">j. Subordinate financing</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_subordinate_financing'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">k. Borrowers closing costs paid by Seller</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_costs_pais_by_seller'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">l. Other Credits (explain)<br/><br/><input type="text" value="" size="25" name="other_credits"></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_other_credit'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">m. Loan amount <br/>(exclude PMI, MIP, Funding Fee financed)<br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_loan_amount_without_fee'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">n. PMI, MIP, Funding Fee financed<br/><br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_pmi_funding_fee'].'</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">o. Loan amount (add m & n)<br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_loan_amount'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">p. Cash from/to Borrower <br/>(subtract j, k, l & o from i)<br/></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:50%">$'.$data['LongAppBorrowerTransaction']['borrower_final_cash'].'</td>
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
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_outstanding_judgment']) && $data['LongAppBorrowerChecklist']['borrower_outstanding_judgment'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" name="purchase_price" readonly="readonly">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price" readonly="readonly">Yes<input type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">b. Have you been declared bankrupt within the past 7 years?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_declared_bankrupt']) && $data['LongAppBorrowerChecklist']['borrower_declared_bankrupt'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:65%">c. Have you had property foreclosed upon or given title or deed in lieu thereof in the last 7 years?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_property_forclosed']) && $data['LongAppBorrowerChecklist']['borrower_property_forclosed'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" readonly="readonly"  name="purchase_price">Yes<input type="checkbox" value="no" size="3" readonly="readonly"  name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">d. Are you a party to a lawsuit?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_party_lawsuit']) && $data['LongAppBorrowerChecklist']['borrower_party_lawsuit'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">e. Have you directly or indirectly been obligated on any loan which resulted in foreclosure, transfer of title in lieu of foreclosure, or judgment?<span style="font-size:8px;">(This would include such loans as home mortgage loans, SBA loans, home improvement loans,
educational loans, manufactured (mobile) home loans, any mortgage, financial obligation, bond,
or loan guarantee. If "Yes", provide details, including date, name and address of Lender, FHA or
VA case number, if any, and reasons for the action.)</span></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_loan_foreclosure_judgement']) && $data['LongAppBorrowerChecklist']['borrower_loan_foreclosure_judgement'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input type="checkbox" value="yes" size="3" name="purchase_price">Yes<input type="checkbox" value="no" size="3" readonly="readonly"  name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">f. Are you presently delinquent or in default on any Federal debt or any other loan, mortgage, financial obligation, bond, or loan guarantee?<span style="font-size:8px;">If "Yes", give details as described in the preceding question.</span></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_federal_debt']) && $data['LongAppBorrowerChecklist']['borrower_federal_debt'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">g. Are you obligated to pay alimony, child support, or separate maintenance?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_child_support']) && $data['LongAppBorrowerChecklist']['borrower_child_support'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input  readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">h. Is any part of the down payment borrowed</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%"> ';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_down_payment_borrowed']) && $data['LongAppBorrowerChecklist']['borrower_down_payment_borrowed'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">i. Are you a co-maker or endorser on a note?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_co-maker_endorser']) && $data['LongAppBorrowerChecklist']['borrower_co-maker_endorser'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">j. Are you a U.S. citizen?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_us_citizen']) && $data['LongAppBorrowerChecklist']['borrower_us_citizen'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                       <tr>
                            <td style="border-bottom-width:0.1px;width:65%">k. Are you a permanent resident alien?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_permanent_resident_alien']) && $data['LongAppBorrowerChecklist']['borrower_permanent_resident_alien'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:65%">l. <strong>Do you intend to occupy the property as your primary residence?</strong><span style="font-size:8px;">If "Yes", complete question m below</span></td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">';
                            $option = array('yes' => 'Yes', 'no'=>'No');
                            foreach($option as $key=>$value) {
                                $checked = (!empty($data['LongAppBorrowerChecklist']['borrower_primary_resident']) && $data['LongAppBorrowerChecklist']['borrower_primary_resident'] == $key) ? 'checked = "checked"' : '';
                                $html .= '<input '. $checked .'type="checkbox" value="'.$key.'" size="3" readonly="readonly"  name="purchase_price">'.$value;
                            }
    
                           $html .= '</td>
                         
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="checkbox" value="yes" size="3" name="purchase_price">Yes<input readonly="readonly"  type="checkbox" value="no" size="3" name="purchase_price">No</td>
                        </tr>
                         <tr>
                            <td style="border-bottom-width:0.1px;width:65%">m. Have you had an ownership interest in a property in the last three years?<br/>
                                (1) What type of property did you own-principal residence (PR),
second home (SH), or investment property (IP)?
                            </td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">'.$data['LongAppBorrowerChecklist']['type_of_property_own'].'</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="text" value="" size="10" name="purchase_price"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom-width:0.1px;width:65%">(2) How did you hold title to the home-solely by yourself (S),jointly with your spouse (SP), or jointly with another person (O)?</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:17%">'.$data['LongAppBorrowerChecklist']['solely_jointly_property'].'</td>
                            <td style="border-bottom-width:0.1px;border-right-width:0.1px;width:18%"><input readonly="readonly"  type="text" value="" size="10" name="purchase_price"></td>
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
        <td style="width:15%"><img src="data:'.$data["LongAppBorroweraAcknowledgement"]["borrower_signature"].'"/></td>
        <td style="font-size:12px;width:35%"><strong>X</strong></td>
        <td style="width:15%"><img src="data:'.$data["LongAppBorroweraAcknowledgement"]["co_borrower_signature"].'"/></td>
    </tr>
    
    </table>';
//echo $html; die();
       
                    
                     
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
echo $pdf->Output(WWW_ROOT . 'files/pdf/1003' . DS . '1003_'.$loanID.'.pdf', 'FI');
die();