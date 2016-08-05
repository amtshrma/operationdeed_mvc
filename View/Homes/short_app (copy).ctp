<div class="section first">
    <div class=" p-b-60">
    <div class="section dark-grey p-t-20  p-b-20 m-b-50">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Apply Online</h2>
          </div>
          
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
        <div class="container">
          <div class="row login-container">  
            <?php echo $this->Form->create('ShortApplication', array('url' => array('controller' => 'homes', 'action' => 'shortApp'),'id'=>'shortAppForm','novalidate' => true)); ?>
              <div class="row column-seperation">
                    <div class="col-lg-12">
                      <span class="help">If you are already registered Broker in Operation Trust Deed, please select Broker.</span>
                    </div>
                    <div class="col-lg-12">
                    <h2>Broker Information</h2><br/>
                        <div class="form-group col-lg-4">
                             <label>Select Broker</label>
                             <?php
                             $brokers['none'] = 'None';
                             echo $this->Form->input('broker_ID',array('label' => false,'div' => false, 'empty' => 'Select Broker','class' => 'form-control','options' => $brokers, 'id'=>'brokerID'));?>
                        </div>
                        <div style="display: none;" class="brookerInfoRow">
                           <div class="form-group col-lg-4">
                               <label>First Name</label>
                               <?php echo $this->Form->input('first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'brokerFirstName','readonly'=>'readonly'));?>
                           </div>
                           <div class="form-group  col-lg-4">
                               <label>Last Name</label>
                               <?php echo $this->Form->input('last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'brokerLastName','readonly'=>'readonly'));?>
                           </div> 
                           <div class="form-group col-lg-4">
                               <label>Email Address</label>
                               <?php echo $this->Form->input('email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','type' => 'text','maxlength' => 100,'id'=>'brokerEmailID','readonly'=>'readonly'));?>
                           </div>
                       </div>
                        <div style="display: none;" class="defaultRow">
                             <div class="form-group  col-lg-4">
                               <label>Broker</label>
                               <?php echo $this->Form->input('default_broker',array('label' => false,'div' => false, 'placeholder' => 'Rockland','class' => 'form-control','readonly'=>'readonly','type' => 'text','maxlength' => 50,'value'=>'Rockland'));?>
                           </div> 
                        </div>
                    </div>
                </div>
               <hr/>
               <div class="row column-seperation">
                    <div class="col-lg-12">
                        <h2>Borrower Information</h2>
                         <div class="form-group col-lg-4">
                             <label>First Name<span class="required"> * </span></label>
                             <?php echo $this->Form->input('applicant_first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','type' => 'text','maxlength' => 100,'tabindex'=>'1'));?>
                         </div>
                         <div class="form-group  col-lg-4">
                             <label>Last Name<span class="required"> * </span></label>
                             <?php echo $this->Form->input('applicant_last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','type' => 'text','maxlength' => 100,'tabindex'=>'2'));?>
                         </div> 
                         <div class="form-group col-lg-4">
                             <label>Email Address<span class="required"> * </span></label>
                             <?php echo $this->Form->input('applicant_email_ID',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','type' => 'text','maxlength' => 100,'tabindex'=>'3'));?>
                         </div>
                         <div class="form-group col-lg-4">
                             <label>Company Name</label> 
                             <?php
                                $selectCompany = array('0'=>'None','1'=>'Individual');
                             echo $this->Form->input('company_select',array('label' => false,'div' => false, 'empty' => 'Select Company','class' => 'form-control','options' => $selectCompany, 'id'=>'companyOption'));
                             echo '<br/>';
                             echo $this->Form->input('applicant_company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control companyInput','type' => 'text','maxlength' => 100, 'style'=>'display:none','tabindex'=>'4'));?>
                         </div>
                         <div class='form-group col-lg-4'>
                             <label>Mobile Phone<span class="required"> * </span></label>
                             <?php echo $this->Form->input('applicant_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### - ####','class' => 'form-control','type' => 'text','maxlength' => 100,'tabindex'=>'5'));?>
                         </div>
                    </div>
               </div>
                <hr/>
                 <div class="row column-seperation">
                    <div class="col-lg-12">
                        <h1>Property Information</h1>
                         <div class='form-group col-lg-4'>
                             <label>Property Name<span class="required"> * </span></label>
                             <?php echo $this->Form->input('property_name',array('label' => false,'div' => false, 'placeholder' => 'Property Name','class' => 'form-control','type' => 'text','maxlength' => 100,'value'=>'Rental1','tabindex'=>'6'));?>
                         </div>
                         <div class="form-group col-lg-4">
                             <label>Property Type<span class="required"> * </span></label>
                             <?php echo $this->Form->input('property_type',array('label' => false,'div' => false, 'empty' => 'Property Type','options'=>$propertyTypes,'class' => 'form-control otherOption','maxlength' => 100,'tabindex'=>'7','id'=>'propertyType'));
                             echo $this->Form->input('other_property_type',array('label' => false,'div' => false, 'placeholder' => 'Other Property Type','type'=>'text','class' => 'form-control otherOption off','maxlength' => 100,'tabindex'=>'7','id'=>'other_Property_Type'));?>
                         </div>
                          <div class="form-group col-lg-4">
                             <label>Property Address<span class="required"> * </span></label>
                             <?php echo $this->Form->input('property_address',array('label' => false,'div' => false, 'placeholder' => 'Property Address','class' => 'form-control','maxlength' => 100,'tabindex'=>'8')); ?>
                            
                         </div>
                         <div class="form-group col-lg-4">
                             <label>Property State<span class="required"> * </span></label>
                             <?php echo $this->Form->input('property_state',array('label' => false,'div' => false, 'empty' => 'Property State','class' => 'form-control','options' => $states,'tabindex'=>'9','id'=>'userStates'));?>
                         </div>
                         <div class="form-group col-lg-4">
                             <label>Property City<span class="required"> * </span></label>
                             <?php echo $this->Form->input('property_city',array('label' => false,'div' => false, 'placeholder' => 'Property City','class' => 'form-control','options'=>'','id'=>'userCities','tabindex'=>'10'));?>
                         </div>                    
                    </div>
                 </div>
                <hr/>    
               <div class="row column-seperation">
                <div class="col-lg-12">    
                    <h1>Loan Request</h1>
                     <div class="form-group col-lg-4">
                         <label>Type Of Loan<span class="required"> * </span></label>
                         <?php echo $this->Form->input('loan_type',array('label' => false,'div' => false, 'empty' => 'Type Of Loan','options'=>$loanTypes,'class' => 'form-control','maxlength' => 100,'tabindex'=>'11'));?>
                     </div>
                     <div class="form-group  col-lg-4">
                         <label>Reason for loan<span class="required"> * </span></label>
                         <?php echo $this->Form->input('loan_reason',array('label' => false,'div' => false, 'empty' => 'Reason for loan','options'=>$loanReasons,'class' => 'form-control','maxlength' => 100,'tabindex'=>'12'));?>
                     </div>
                     <div class="form-group col-lg-4">
                         <label>Loan Amount<span class="required"> * </span></label>
                         <?php echo $this->Form->input('loan_amount',array('label' => false,'div' => false, 'empty' => 'Loan Amount','options'=>$loanAmounts,'class' => 'form-control','maxlength' => 100,'tabindex'=>'13'));?>
                     </div>
                     <div class="form-group col-lg-4">
                         <label>Apx. Loan to Value <span class="required"> * </span></label>
                         <?php echo $this->Form->input('loan_to_value',array('label' => false,'div' => false, 'empty' => 'Apx. Loan to Value','options'=>$approxLoanValues,'class' => 'form-control','maxlength' => 100,'tabindex'=>'14'));?>
                     </div>
                     <div class="form-group col-lg-4">
                         <label>Specific Loan Objective <span class="required"> * </span></label>
                         <?php echo $this->Form->input('loan_objective',array('label' => false,'div' => false, 'placeholder' => 'Specific Loan Objective','class' => 'form-control','type'=>'textarea','maxlength' => 100,'tabindex'=>'15'));?>
                    </div>
                    </div>
               </div>
               <div class="form-group col-lg-12">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                    <?php echo $this->Form->button('Apply', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'16'));?>
                    </div>
                </div>
            </div>
               
            </div>
        </div>
    </div>
</div>