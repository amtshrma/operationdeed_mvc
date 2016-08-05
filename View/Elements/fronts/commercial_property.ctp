<div class="col-lg-12">
    <div class="form-group col-lg-4">
    <label>Property Name</label>
    <?php
    $property_name='';
    if(isset($ChecklistFormDoc['ChecklistForm']['property_name']) && $ChecklistFormDoc['ChecklistForm']['property_name']){
        $property_name=$ChecklistFormDoc['ChecklistForm']['property_name'];
    }
    $typeofBuilding='';
    if(isset($ChecklistFormDoc['ChecklistForm']['typeofBuilding']) && $ChecklistFormDoc['ChecklistForm']['typeofBuilding']){
     $typeofBuilding=$ChecklistFormDoc['ChecklistForm']['typeofBuilding'];
    }
    $commercial_lease='';
    if(isset($ChecklistFormDoc['ChecklistForm']['commercial_lease']) && $ChecklistFormDoc['ChecklistForm']['commercial_lease']){
        $commercial_lease=$ChecklistFormDoc['ChecklistForm']['commercial_lease'];
    }
    $tenant='';
    if(isset($ChecklistFormDoc['ChecklistForm']['tenant']) && $ChecklistFormDoc['ChecklistForm']['tenant']){
        $tenant=$ChecklistFormDoc['ChecklistForm']['tenant'];
    }
    $apartment_utility = '';
    if(isset($ChecklistFormDoc['ChecklistForm']['apartment_utility']) && $ChecklistFormDoc['ChecklistForm']['apartment_utility']){
        $apartment_utility=$ChecklistFormDoc['ChecklistForm']['apartment_utility'];
    }
   echo $this->Form->input('property_name',array('label' => false,'div' => false, 'placeholder' => 'Property Name','class' => 'form-control','type' => 'text','id'=>'PropertyName','value'=>$property_name));?>
    </div>
    <div class="form-group col-lg-4">
        <label>Type of Building</label>
        <?php echo $this->Form->input('typeofBuilding',array('label' => false,'div' => false, 'empty' => 'Select Type of Building','class' => 'form-control','options' => array('apartment'=>'Apartments','office'=>'Office','retail'=>'Retail','industrial'=>'Industrial','othercommercial'=>'Other Commercial'), 'id'=>'typeofBuilding','value'=>$typeofBuilding));?>
    </div>
</div>
<div class="col-lg-12">
   <div class="form-group col-lg-4">
        <label># of Tenants</label>
        <?php echo $this->Form->input('tenant',array('label' => false,'div' => false, 'placeholder' => '# of Tenants','class' => 'form-control','type' => 'text','id'=>'tenant','value'=>$tenant));?>
    </div>
    <div class="form-group col-lg-4">
        <label>Apartment Utilities</label>
         <?php echo $this->Form->input('apartment_utility',array('label' => false,'div' => false, 'empty' => 'Select Apartment Utilities','class' => 'form-control','options' => array('individual'=>'Individually Metered','master'=>'Master Metered'), 'id'=>'apartment_utility','value'=>$apartment_utility));?>  
    </div>
    <div class="form-group col-lg-4">
        <label>Type of Commercial Lease</label>
        <?php echo $this->Form->input('commercial_lease',array('label' => false,'div' => false, 'empty' => 'Select Commercial lease','class' => 'form-control','options' => array('NNN'=>'NNN','NN'=>'NN','FullService'=>'Full Service','Gross'=>'Gross'), 'id'=>'commercial_lease','value'=>$commercial_lease));?>  
    </div>
</div>

 

