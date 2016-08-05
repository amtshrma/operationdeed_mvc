<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Loan Detail</h4>
</div>

<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="form-group">
            <h3><?php echo date("jS F, Y", strtotime($data['Loan']['created'])); ?></h3>
            <span class="semi-bold">Loan Amount : $ <?php echo $data['Loan']['loan_amount']; ?></span>
             
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <span class="semi-bold">Property Information</span>
                    <?php $loanTerms = $this->Common->getLoanTerms();
                    $tempLoanTerm = $data['Loan']['loan_term_requested'];
                    if(!empty($loanTerms[$tempLoanTerm])) {
                    $loanTerm =  $loanTerms[$tempLoanTerm];
                    
                        }else {
                            $loanTerm =  "--";
                        }
                    ?>
                     <p>Property Value As-Is : <?php echo $data['Loan']['property_value_as']; ?></p>
                     <p>Property Value After-Repaired-Value (ARV) ($) : <?php echo $data['Loan']['property_value_after']; ?> </p>
                     <p>Property Value Appraised ($) : <?php echo $data['Loan']['property_value_appraised']; ?></p>
                     <p>Property Appraisal Date :<?php echo $data['Loan']['property_appraise_date']; ?> </p>
                     <p>Property Type : <?php echo $data['Loan']['proprty_type']; ?></p>
                     <p>Occupancy : <?php echo $data['Loan']['occupancy']; ?></p>
                     <p>Condition Of Property :<?php echo $data['Loan']['condition_of_property']; ?> </p>
                     <p>Gross Rental Income : <?php echo $data['Loan']['gross_rental_income']; ?></p>
                 
                     <p>Employment : <?php echo $data['Loan']['employment']; ?></p>
                
                </div>
                <div class="col-md-6">
                    <span class="semi-bold">Description Of Income</span>
                    <p>Current Monthly Gross Income : <?php echo $data['Loan']['monthly_gross_income']; ?></p>
                    <p>Loan Term Requested : <?php echo $loanTerm; ?></p>
                    <p>Income Documenation Provide : <?php echo $data['Loan']['income_documentation']; ?></p>
                    <p>Repayment of this Loan (exit strategy) :<?php echo $data['Loan']['repayment_strategy']; ?> </p>
                    <p>Liquid Assets : <?php echo $data['Loan']['liquid_assests']; ?></p>
                    <?php if(!empty($data['Loan']['other_real_estate'])){ echo '<p> Other Real Estate Owned : '. $data['Loan']['other_real_estate'] . '</p>'; } ?>
                    <?php if(!empty($data['Loan']['notes'])){ echo '<p> Notes : ' .$data['Loan']['notes'] . '</p>'; } ?>
                </div>
            </div>
        </div>  
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
<!-- Modal End -->