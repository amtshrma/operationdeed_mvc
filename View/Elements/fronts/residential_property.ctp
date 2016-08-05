<?php
    $property_address = '';
    if(isset($ChecklistFormDoc['ChecklistForm']['property_address']) && $ChecklistFormDoc['ChecklistForm']['property_address']){
    $property_address=$ChecklistFormDoc['ChecklistForm']['property_name'];
    }
    $lease_term = '';
    if(isset($ChecklistFormDoc['ChecklistForm']['lease_term']) && $ChecklistFormDoc['ChecklistForm']['lease_term']){
        $lease_term=$ChecklistFormDoc['ChecklistForm']['lease_term'];
    }
    $moRent = '';
    if(isset($ChecklistFormDoc['ChecklistForm']['mo_Rent']) && $ChecklistFormDoc['ChecklistForm']['mo_Rent']){
        $lease_term=$ChecklistFormDoc['ChecklistForm']['mo_Rent'];
    }
   ?>
<div class="col-lg-12">
    <div class="form-group col-lg-4">
        <label>Property Address</label>
        <?php echo $this->Form->input('property_address',array('label' => false,'div' => false, 'placeholder' => 'Property Address','class' => 'form-control','type' => 'text','id'=>'Property Address','value'=>$property_address));?>
    </div>
    <div class="form-group col-lg-4">
        <label>Lease Term</label>
         <?php echo $this->Form->input('lease_term',array('label' => false,'div' => false, 'class' => 'form-control','id'=>'lease_term','value'=>$lease_term));?>  
    </div>
    <div class="form-group col-lg-4">
        <label>Mo Rent:</label>
        <?php echo $this->Form->input('mo_Rent',array('label' => false,'div' => false, 'class' => 'form-control', 'id'=>'mo_rent','value'=>$moRent));?>  
    </div>   
</div>

