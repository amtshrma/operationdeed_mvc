<script type="text/javascript">
   function unpermit_value(val1){
   if (val1=='yes') {
   $("#description").show();
   }else{
     $("#description").hide();
   }
   }
</script>
<div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="content">    
		
		<div class="row"  id="inbox-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="no-border email-body" >
							<br>
							 <div class="row-fluid" >
							 <div class="row-fluid dataTables_wrapper">
								<h2 class=" inline">Checklist </h2>
								
									<div class="clearfix"></div>
								</div>
								
								 <div class="grid-body ">
                              <div class="col-lg-12">
                                 <div class="form-group col-lg-3">
                         <label>Property Name</label>
                         <?php echo $this->Form->input('property_name',array('label' => false,'div' => false, 'placeholder' => 'Property Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'PropertyName'));?>
                     </div>
                     <div class="form-group col-lg-3">
                         <label>Client Objective</label>
                         <?php echo $this->Form->input('client_objective',array('label' => false,'div' => false, 'empty' => 'Select Client Objective','class' => 'form-control','options' => array('LTH'=>'Long-Term Hold','RS'=>'Rehabilitation Sale','TISS'=>'Tenant improve Stabalize Sale'), 'id'=>'clientObjective'));?>
                     </div>
                     <div class="form-group col-lg-3">
                         <label>Type of Building</label>
                         <?php echo $this->Form->input('typeofBuilding',array('label' => false,'div' => false, 'empty' => 'Select Type of Building','class' => 'form-control','options' => array('apartment'=>'Apartments','office'=>'Office','retail'=>'Retail',''=>'othercommercial',''=>'Other Commercial'), 'id'=>'typeofBuilding'));?>
                     </div>
                     <div class="form-group col-lg-3">
                         <label># of Tenants</label>
                         <?php echo $this->Form->input('tenant',array('label' => false,'div' => false, 'placeholder' => '# of Tenants','class' => 'form-control','type' => 'text','id'=>'tenant'));?>
                     </div>
                              </div>
                           <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                         <label># of Parking Spaces Covered</label>
                         <?php echo $this->Form->input('parkingSpacecover',array('label' => false,'div' => false, 'placeholder' => '# of Parking Spaces Covered','class' => 'form-control','type' => 'text','id'=>'parkingSpace'));?>
                     </div>
                            <div class="form-group col-lg-4">
                         <label># of Parking Spaces Un-covered</label>
                         <?php echo $this->Form->input('parkingSpaceuncover',array('label' => false,'div' => false, 'placeholder' => '# of Parking Spaces Un-covered','class' => 'form-control','type' => 'text','id'=>'parkingSpaceuncover'));?>
                     </div>
                        <div class="form-group col-lg-4">
                              <label>Buidling Rating</label>
                         <?php echo $this->Form->input('Buildingrating',array('label' => false,'div' => false, 'empty' => 'Select Buidling Rating','class' => 'form-control','options' => array('A+'=>'A+','A'=>'A','B+'=>'B+','B'=>'B','C'=>'C'), 'id'=>'Buildingrating'));?>
                        </div>
                           </div>
                             <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <label>Building Area Rating</label>
                         <?php echo $this->Form->input('Buildingarearating',array('label' => false,'div' => false, 'empty' => 'Select Buidling Area Rating','class' => 'form-control','options' => array('A'=>'A','B'=>'B','C'=>'C'), 'id'=>'Buildingarearating'));?>  
                            </div>
                             
                             <div class="form-group col-lg-4">
                                    <label>Type of Commercial Lease</label>
                                     <?php echo $this->Form->input('commercial_lease',array('label' => false,'div' => false, 'empty' => 'Select Commercial lease','class' => 'form-control','options' => array('NNN'=>'NNN','NN'=>'NN','FullService'=>'Full Service','Gross'=>'Gross'), 'id'=>'commercial_lease'));?>  
                                </div>
                              <div class="form-group col-lg-4">
                         <label>Describe any Environmental Concerns</label>
                         <?php echo $this->Form->input('environmentconcern',array('label' => false,'div' => false, 'placeholder' => 'Environmental Concerns','class' => 'form-control','type' => 'text','id'=>'environmentconcern'));?>
                     </div>
                             </div>
                             <div class="col-lg-12">
                              <div class="form-group col-lg-4">
                         <label>Year Built</label>
                         <?php echo $this->Form->input('yearbuilt',array('label' => false,'div' => false, 'placeholder' => 'Year Built','class' => 'form-control','type' => 'text','id'=>'yearbuilt'));?>
                     </div>
                               <div class="form-group col-lg-3">
                         <label>Type of Construction</label>
                         <?php echo $this->Form->input('typecons',array('label' => false,'div' => false, 'placeholder' => 'Type of Construction','class' => 'form-control','type' => 'text','id'=>'typecons'));?>
                     </div>
                               <div class="form-group col-lg-5 radio_btn">
                                 <label>Does the building have any unpermitted units?</label><br>
                                <?php
                             $options = array(
    'yes' => 'Yes',
    'no' => 'No'
);

$attributes = array(
    'legend' => false,
    'onclick'=>'unpermit_value(this.value)'
);

echo $this->Form->radio('type', $options, $attributes); ?>
                              </div>
                             </div>
                               <div class="col-lg-12" id="description" style="display:none;">
                                <div class="form-group col-lg-12">
                         <label>Describe</label>
                         <?php echo $this->Form->textarea('describe',array('label' => false,'div' => false, 'placeholder' => 'Description','class' => 'form-control','id'=>'describe','rows'=>'5'));?>
                     </div>
                              </div>
                                 <div class="col-lg-12">
                                <div class="form-group col-lg-12">
                         <label>Describe recent renovations</label>
                         <?php echo $this->Form->textarea('describerecent',array('label' => false,'div' => false, 'placeholder' => 'Describe recent renovations','class' => 'form-control','id'=>'describerecent','rows'=>'5'));?>
                     </div>
                              </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-6">
                                    <label>Apartment Utilities</label>
                                     <?php echo $this->Form->input('apartment_utility',array('label' => false,'div' => false, 'empty' => 'Select Apartment Utilities','class' => 'form-control','options' => array('individual'=>'individually metered','master'=>'master metered'), 'id'=>'apartment_utility'));?>  
                                </div>
                                 <div class="form-group col-lg-6">
                                <label>Surrounding Area Environmental Concerns</label>
                         <?php echo $this->Form->input('areaenvconcern',array('label' => false,'div' => false, 'empty' => 'Select Surrounding Area','class' => 'form-control','options' => array('gas_station'=>'Gas Station','laundry'=>'Laundry Mat','brownSite'=>'Brown Site','other'=>'Other'), 'id'=>'areaenvconcern'));?>  
                            </div> 
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-12">
                         <label>Describe Tenant Expense Responsilbities</label>
                         <?php echo $this->Form->textarea('tenantexpense',array('label' => false,'div' => false, 'placeholder' => 'Describe Tenant Expense Responsilbities','class' => 'form-control','id'=>'tenantexpense','rows'=>'5'));?>
                     </div>
                              </div>
			    <div class="multi_family_div" style="display: none;">
                            <div class="col-lg-12">
			       <div class="form-group col-lg-4">
                         <label>Property Ownership/Vesting Type & Name</label>
                         <?php echo $this->Form->input('propertyownership',array('label' => false,'div' => false, 'placeholder' => 'Property Ownership/Vesting Type & Name','class' => 'form-control','id'=>'propertyownership','type'=>'text'));?>
                     </div>
                                 <div class="form-group col-lg-4">
                         <label>Rent Roll</label>
                         <?php echo $this->Form->input('rentroll',array('label' => false,'div' => false, 'placeholder' => 'Rent Roll','class' => 'form-control','id'=>'rentroll','type'=>'file'));?>
                     </div>
                             <div class="form-group col-lg-4">
                         <label>Leases & Estoppels</label>
                         <?php echo $this->Form->input('leases',array('label' => false,'div' => false, 'placeholder' => 'Leases & Estoppels','class' => 'form-control','id'=>'leases','type'=>'file'));?>
                     </div>
                            </div>
                            <div class="col-lg-12">
			        <div class="form-group col-lg-4">
                         <label>Insurance Agent Info</label>
                         <?php echo $this->Form->input('agentinfo',array('label' => false,'div' => false, 'placeholder' => 'Insurance Agent Info','class' => 'form-control','id'=>'agentinfo','type'=>'file'));?>
                     </div> 
                                 <div class="form-group col-lg-4">
                         <label>Management Resume</label>
                         <?php echo $this->Form->input('mgmtresume',array('label' => false,'div' => false, 'placeholder' => 'Management Resume','class' => 'form-control','id'=>'mgmtresume','type'=>'file'));?>
                     </div>
                             <div class="form-group col-lg-4">
                         
                     <label>Laundry Lease</label>
                                   <?php echo $this->Form->input('laundrylease',array('label' => false,'div' => false, 'placeholder' => 'Laundry Lease','class' => 'form-control','id'=>'laundrylease','type'=>'file'));?>
                     </div>
                              
                            </div> 
                            <div class="col-lg-12">
                                 <div class="form-group col-lg-4">
                                 <label>Deposit Receipt (EMD) if Purchase</label>
                                   <?php echo $this->Form->input('deposttreceipt',array('label' => false,'div' => false, 'placeholder' => 'Deposit Receipt (EMD)','class' => 'form-control','id'=>'deposttreceipt','type'=>'file'));?>
                                 </div>
                                  <div class="form-group col-lg-4">
                                 <label>Preliminary Title Report</label>
                                   <?php echo $this->Form->input('preminarytitle',array('label' => false,'div' => false, 'placeholder' => 'Preliminary Title','class' => 'form-control','id'=>'preminarytitle','type'=>'file'));?>
                                 </div>
                                   <div class="form-group col-lg-4">
                                <label>Professional Property Management Info</label>
                         <?php echo $this->Form->input('propertymgmtinfo',array('label' => false,'div' => false, 'placeholder' => 'Property Management Info','class' => 'form-control','id'=>'propertymgmtinfo','type'=>'file'));?>
                                 </div>
                                 
                            </div>
			   
			    <div class="col-lg-12">
                               <div class="form-group col-lg-4">
                         <label>Income & Expense</label>
                         <?php echo $this->Form->input('expense',array('label' => false,'div' => false, 'placeholder' => 'Income & Expense','class' => 'form-control','id'=>'expense','type'=>'file'));?>
                     </div>
				<div class="form-group col-lg-4">
                         <label>Escrow Instructions</label>
                         <?php echo $this->Form->input('escrow_instruction',array('label' => false,'div' => false, 'placeholder' => 'Escrow Instructions','class' => 'form-control','id'=>'escrow_instruction','type'=>'file'));?>
                     </div>
                               <div class="form-group col-lg-4">
                         <label>Purchase Contract</label>
                         <?php echo $this->Form->input('purchasecontt',array('label' => false,'div' => false, 'placeholder' => 'Purchase Contract','class' => 'form-control','id'=>'purchasecontt','type'=>'file'));?>
                     </div>  
			    </div>
                             </div>
			    <div>
			     <div>
			      <div class="rehab_div" style="display:none;">
				<div class="col-lg-12">
				  <div class="form-group col-lg-4">
				    <label>Rehab Budget</label>
				    <?php echo $this->Form->input('rehab_budget',array('label' => false,'div' => false, 'placeholder' => 'Rehab Budget','class' => 'form-control','id'=>'rehabbudget','type'=>'file'));?>
				</div>
				    <div class="form-group col-lg-4">
				    <label>Rehabbers Resume</label>
				    <?php echo $this->Form->input('rehab_resume',array('label' => false,'div' => false, 'placeholder' => 'Rehabbers Resume','class' => 'form-control','id'=>'rehabresume','type'=>'file'));?>
				</div>
				     <div class="form-group col-lg-4">
				    <label>Property Inspection Acceptance Form</label>
				    <?php echo $this->Form->input('rehab_resume',array('label' => false,'div' => false, 'placeholder' => 'Property Inspection Acceptance Form','class' => 'form-control','id'=>'propertyacceptance','type'=>'file'));?>
				</div> 
				</div>
				<div class="col-lg-12">
				  <div class="form-group col-lg-4">
				    <label>Buider's Risk Insurance Policy</label>
				    <?php echo $this->Form->input('budget_risk',array('label' => false,'div' => false,'class' => 'form-control','id'=>'budgetrisk','type'=>'file'));?>
				</div>
				  <div class="form-group col-lg-4">
				    <label>Contractors Resume</label>
				    <?php echo $this->Form->input('contract_resume',array('label' => false,'div' => false,'class' => 'form-control','id'=>'contractresume','type'=>'file'));?>
				</div>
				   <div class="form-group col-lg-4">
				    <label>Construction Contract</label>
				    <?php echo $this->Form->input('const_contract',array('label' => false,'div' => false,'class' => 'form-control','id'=>'constcontract','type'=>'file'));?>
				</div>
				</div>
				<div class="col-lg-12">
				  <div class="form-group col-lg-4">
				    <label>Architect's Resume</label>
				    <?php echo $this->Form->input('architect_resume',array('label' => false,'div' => false,'class' => 'form-control','id'=>'architectresume','type'=>'file'));?>
				</div>
				  <div class="form-group col-lg-4">
				    <label>Architects Contract</label>
				    <?php echo $this->Form->input('architect_resume',array('label' => false,'div' => false,'class' => 'form-control','id'=>'architectresume','type'=>'file'));?>
				</div>
				</div>
			      </div>
			     </div> 
			    </div>
			    <div class="col-lg-12">
                                <div class="form-group col-lg-6">
                        
                     </div> <div class="form-group col-lg-6">
                     <div class="col-lg-5"></div><div class="col-lg-1">
                     <label>&nbsp;</label>
                      <?php echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15'));?>
                      </div>
                     </div>
                              </div>
                             </div>
                              </div>							
							 </div>							
							</div>
							</div>	
						</div>
					</div>
				</div>	
		</div>
		
  </div>
  
  <!-- END PAGE --> 
</div>