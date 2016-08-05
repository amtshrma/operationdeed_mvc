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
            <h2 class=" inline">Team Assignment</h2>
            <div class="clearfix"></div>
        </div>
        <div class="grid-body ">
        <?php
            echo $this->Form->create('TeamAssignment', array('novalidate' => true,'id'=>'TeamAssignmentForm','class'=>'required form-no-horizontal-spacing'));
            //echo $this->Form->hidden('funder_team',array('value' => '','id'=>'totalfieldCount'));
            
            $arrBroker = $this->Common->__getTeamByType('2');
            $arrSManager = $this->Common->__getTeamByType('3');
            $arrSDirector = $this->Common->__getTeamByType('4');
            $arrProcessor = $this->Common->__getTeamByType('5'); ?>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-12">
                   <label>Team Processor</label>
                   <?php echo $this->Form->select('processor', $arrProcessor, array('label'=>false, 'div'=>false, 'id'=>'processor', 'multiple'=>'multiple', 'default'=>isset($arrOptions[5])?$arrOptions[5]:'')); ?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-12">
                   <label>Team Sales Director</label>
                   <?php echo $this->Form->select('sdirector', $arrSDirector, array('label'=>false, 'div'=>false, 'id'=>'sales-director', 'multiple'=>'multiple', 'default'=>isset($arrOptions[4])?$arrOptions[4]:'')); ?>                    
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-12">
                   <label>Team Sales Manager</label>
                   <?php echo $this->Form->select('smanager', $arrSManager, array('label'=>false, 'div'=>false, 'id'=>'sales-manager', 'multiple'=>'multiple', 'default'=>isset($arrOptions[3])?$arrOptions[3]:'')); ?>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group col-lg-12">
                   <label>Team Broker/Loan Officer</label>
                   <?php
                   echo $this->Form->select('broker', $arrBroker, array('label'=>false, 'div'=>false, 'id'=>'broker', 'multiple'=>'multiple', 'default'=>isset($arrOptions[2])?$arrOptions[2]:'')); ?>
                  
                    <?php /*
                    <select id='broker' multiple='multiple'>
                    <?php if(!empty($arrBroker)) { foreach($arrBroker as $brokerId=>$broker) { ?>
                      <option value='<?php echo $brokerId; ?>' <?php echo (isset($arrOptions[2]) && !empty($arrOptions[2]) && in_array($brokerId, $arrOptions[2]))?'selected':''; ?>><?php echo $broker; ?></option>
                      <?php }} ?>
                    </select> */ ?>
                </div>
            </div>
            
        </div>
        </div>
    </div>
    </div>
        <div class="col-lg-12">
            <div class="form-group col-lg-9"></div>
            <div class="form-group col-lg-3">
                <div class="col-lg-5"></div>
                <div class="col-lg-12">
                    <label>&nbsp;</label>
                    <?php                    
                    echo $this->Form->button('Save', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15', 'div'=>false, 'label'=>false)); ?>
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

<script>

$('#TeamAssignmentForm').submit(function(){
    
    if(confirm('Are you sure? Want to save current selected team.')) {
        return true;
    }
    return false;
});

$('#processor').multiSelect({
  selectableHeader: "<div class='custom-header'>Selectable items</div>",
  selectionHeader: "<div class='custom-header'>Selection items</div>",
  //selectableFooter: "<div class='custom-header'>Selectable footer</div>",
 // selectionFooter: "<div class='custom-header'>Selection footer</div>",
 
 afterSelect: function(values){ // send ajax request on selection
    
    
    //alert("Select value: "+values);
  },
  afterDeselect: function(values){ //send ajax request on deselection
    
    
    //alert("Deselect value: "+values);
  }
});

$('#sales-director').multiSelect({
  selectableHeader: "<div class='custom-header'>Selectable items</div>",
  selectionHeader: "<div class='custom-header'>Selection items</div>",
  //selectableFooter: "<div class='custom-header'>Selectable footer</div>",
  //selectionFooter: "<div class='custom-header'>Selection footer</div>"
});
$('#sales-manager').multiSelect({
  selectableHeader: "<div class='custom-header'>Selectable items</div>",
  selectionHeader: "<div class='custom-header'>Selection items</div>",
  //selectableFooter: "<div class='custom-header'>Selectable footer</div>",
  //selectionFooter: "<div class='custom-header'>Selection footer</div>"
});
$('#broker').multiSelect({
  selectableHeader: "<div class='custom-header'>Selectable items</div>",
  selectionHeader: "<div class='custom-header'>Selection items</div>",
  //selectableFooter: "<div class='custom-header'>Selectable footer</div>",
  //selectionFooter: "<div class='custom-header'>Selection footer</div>"
});
</script>