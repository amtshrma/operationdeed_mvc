<script type="text/javascript">
   function unpermit_value(val1){
      if (val1=='yes') {
         $("#description").show();
      }else{
        $("#description").hide();
      }
   }
</script>
<style type="text/css">
    .radio_btn > span {
      display: inline-flex;
      }
</style>
<div class="section first">
    <div class=" p-b-60">
    <div class="section dark-grey p-t-20  p-b-20 m-b-50">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Checklist</h2>
          </div>
          
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
        <div class="container">
          <div class="row login-container">
            <div class="row column-seperation">
                    
                    <div class="col-lg-12">
                    
                    <div class="form-group col-lg-4">
                         <label>Property Name</label>
                         <?php echo $this->Form->input('property_name',array('label' => false,'div' => false, 'placeholder' => 'Property Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'PropertyName'));?>
                     </div>
                     <div class="form-group col-lg-4">
                         <label>Client Objective</label>
                         <?php echo $this->Form->input('client_objective',array('label' => false,'div' => false, 'empty' => 'Select Client Objective','class' => 'form-control','options' => array('LTH'=>'Long-Term Hold','RS'=>'Rehabilitation Sale','TISS'=>'Tenant improve Stabalize Sale'), 'id'=>'clientObjective'));?>
                     </div>
                     <div class="form-group col-lg-4">
                         <label>Type of Building</label>
                         <?php echo $this->Form->input('typeofBuilding',array('label' => false,'div' => false, 'empty' => 'Select Type of Building','class' => 'form-control','options' => array('apartment'=>'Apartments','office'=>'Office','retail'=>'Retail',''=>'othercommercial',''=>'Other Commercial'), 'id'=>'typeofBuilding'));?>
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
                               <div class="form-group col-lg-4">
                         <label>Type of Construction</label>
                         <?php echo $this->Form->input('typecons',array('label' => false,'div' => false, 'placeholder' => 'Type of Construction','class' => 'form-control','type' => 'text','id'=>'typecons'));?>
                     </div>
                       <div class="form-group col-lg-4">
                         <label># of Tenants</label>
                         <?php echo $this->Form->input('tenant',array('label' => false,'div' => false, 'placeholder' => '# of Tenants','class' => 'form-control','type' => 'text','id'=>'tenant'));?>
                     </div>        
                             </div>
                       
                     <div class="col-lg-12">
                        <div class="form-group col-lg-12">
                         <label>Describe recent renovations</label>
                         <?php echo $this->Form->textarea('describerecent',array('label' => false,'div' => false, 'placeholder' => 'Describe recent renovations','class' => 'form-control','id'=>'describerecent','rows'=>'5'));?>
                        </div>
                     </div>
                    <div class="col-lg-12">
                                <div class="form-group col-lg-4">
                                    <label>Apartment Utilities</label>
                                     <?php echo $this->Form->input('apartment_utility',array('label' => false,'div' => false, 'empty' => 'Select Apartment Utilities','class' => 'form-control','options' => array('individual'=>'individually metered','master'=>'master metered'), 'id'=>'apartment_utility'));?>  
                                </div>
                                 <div class="form-group col-lg-4">
                                <label>Surrounding Area Environmental Concerns</label>
                         <?php echo $this->Form->input('areaenvconcern',array('label' => false,'div' => false, 'empty' => 'Select Surrounding Area','class' => 'form-control','options' => array('gas_station'=>'Gas Station','laundry'=>'Laundry Mat','brownSite'=>'Brown Site','other'=>'Other'), 'id'=>'areaenvconcern'));?>  
                            </div>
                             <div class="form-group col-lg-4 radio_btn">
                                 <label>Does the building have any unpermitted units?</label>
                                 <span>
                                <?php
                             $options = array(
    'yes' => 'Yes',
    'no' => 'No'
);

$attributes = array(
    'legend' => false,
    'onclick'=>'unpermit_value(this.value)'
);

echo $this->Form->radio('type', $options, $attributes); ?></span>
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
                         <label>Describe Tenant Expense Responsilbities</label>
                         <?php echo $this->Form->textarea('tenantexpense',array('label' => false,'div' => false, 'placeholder' => 'Describe Tenant Expense Responsilbities','class' => 'form-control','id'=>'tenantexpense','rows'=>'5'));?>
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