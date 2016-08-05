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
                    <h2>Processor Checklist</h2>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="container">
            <div class="col-lg-12">
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs" id="tab-2">
                        <li class="active"><a href="#checklistContainer">Checklist</a></li>
                        <li><a href="#detailContainer">Property Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane " id="checklistContainer">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    <h3>Submit Document</h3>
                                    Please download below pre-formatted documents and save the documet. Fill the documents and then scan them  and upload the documents or fax them to us. Please make sure to upload the document correctly.  <br/>
                                    <?php
                                    echo $this->Form->create('Borrow',array('type'=>'file','name'=>'form1'));
                                    echo $this->Form->input('loan_id',array('type' =>'hidden','value' => base64_encode($loan_id)));
                                    echo $this->Form->input('short_app_id',array('type' =>'hidden','value' => $shortAppID));
                                    echo $this->Form->input('receiver_id',array('type' =>'hidden','value' => $loanOfficerID));
                                    ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Document</th>  
                                            <th>Download Doc</th>  
                                            <th>Upload Doc</th>  
                                        </tr>
                                        <?php
                                        $loan_id = base64_encode($loan_id);
                                        if(!empty($checklistname)) {
                                            foreach($checklistname as $key => $checklist) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $checklist['Checklist']['checklistname'];?></td>
                                                <td>
                                                <?php
                                                if($checklist['Checklist']['download_form']=='1') {
                                                echo $this->Html->link('Download', $this->Html->url( '/', true ).'app/webroot/upload/'.$checklist['Checklist']['value'], array('class' => 'button','target'=>'_blank'));
                                                } else {
                                                    echo "--";
                                                    
                                                }?></td>
                                                <td>
                                                <?php
                                                $accept=$this->Common->borrower_acceptance_status($loan_id,$checklist['Checklist']['value'],'property');
                                                if(isset($accept) && $accept == 0){ 
                                                echo "Document Uploaded.";
                                                }elseif(isset($accept) && $accept == 1){  
                                                echo "Document Accepted.";
                                                }else { 
                                                echo $this->Form->input('document.'.$key,array('type'=>'file','value'=>$checklist['Checklist']['value'],'id'=>$checklist['Checklist']['value'],'label'=>false));
                                                } ?></td>
                                            </tr>
                                            <?php 
                                            }
                                        }
                                        if(!empty($documentName)) {
                                            foreach($documentName as $loanKey => $loanDocument) { ?>
                                            <tr>
                                                <td><?php echo $loanDocument['LoanDocument']['checklistname'];?></td>
                                                <td>
                                                <?php
                                                if($loanDocument['LoanDocument']['download_form']=='1') {
                                                
                                                echo $this->Html->link('Download', $this->Html->url( '/', true ).'app/webroot/document/'.$loanDocument['LoanDocument']['name'], array('class' => 'button','target'=>'_blank')
                                                ); } ?></td>
                                                <td>
                                                <?php
                                                
                                                $accept = $this->Common->borrower_acceptance_status($loan_id, $loanDocument['LoanDocument']['name'],'loan');
                                                
                                                if(isset($accept) && $accept == 0){ 
                                                echo "Document Uploaded.";
                                                }elseif(isset($accept) && $accept == 1){  
                                                echo "Document Accepted.";
                                                }else { 
                                                echo $this->Form->input('loan_document.'.$loanKey,array('type'=>'file','value'=>$loanDocument['LoanDocument']['name'],'id'=>$loanDocument['LoanDocument']['name'],'label'=>false));
                                                } ?></td>
                                            </tr>
                                            <?php 
                                            }
                                        }
                                        ?>
                                    </table>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-6"></div>
                                        <div class="form-group col-lg-6">
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-1">
                                                <label>&nbsp;</label>
                                                <?php
                                                echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15'));?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    echo $this->Form->end();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="detailContainer">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Property Details</h3><br>
                                    <?php
                                    echo $this->Form->create('ChecklistForm',array('name'=>'form1','id'=>'form1'));
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-4">
                                        <label>Property Name</label>
                                        <?php
                                        $property_name='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['property_name']) && $ChecklistFormDoc[0]['ChecklistForm']['property_name']){
                                        $property_name=$ChecklistFormDoc['ChecklistForm']['property_name'];
                                        }
                                        $clientobjective='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['client_objective']) && $ChecklistFormDoc[0]['ChecklistForm']['client_objective']){
                                        $clientobjective=$ChecklistFormDoc['ChecklistForm']['client_objective'];
                                        }
                                        $typeofBuilding='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['typeofBuilding']) && $ChecklistFormDoc[0]['ChecklistForm']['typeofBuilding']){
                                        $typeofBuilding=$ChecklistFormDoc['ChecklistForm']['typeofBuilding'];
                                        }
                                        $parkingSpacecover='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['parkingSpacecover']) && $ChecklistFormDoc[0]['ChecklistForm']['parkingSpacecover']){
                                        $parkingSpacecover=$ChecklistFormDoc['ChecklistForm']['parkingSpacecover'];
                                        }
                                        $parkingSpaceuncover='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['parkingSpaceuncover']) && $ChecklistFormDoc[0]['ChecklistForm']['parkingSpaceuncover']){
                                        $parkingSpaceuncover=$ChecklistFormDoc['ChecklistForm']['parkingSpaceuncover'];
                                        }
                                        $Buildingrating='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['Buildingrating']) && $ChecklistFormDoc[0]['ChecklistForm']['Buildingrating']){
                                        $Buildingrating=$ChecklistFormDoc['ChecklistForm']['Buildingrating'];
                                        }
                                        $Buildingarearating='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['Buildingarearating']) && $ChecklistFormDoc[0]['ChecklistForm']['Buildingarearating']){
                                        $Buildingarearating=$ChecklistFormDoc['ChecklistForm']['Buildingarearating'];
                                        }
                                        $commercial_lease='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['commercial_lease']) && $ChecklistFormDoc[0]['ChecklistForm']['commercial_lease']){
                                        $commercial_lease=$ChecklistFormDoc['ChecklistForm']['commercial_lease'];
                                        }
                                        $environmentconcern='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['environmentconcern']) && $ChecklistFormDoc[0]['ChecklistForm']['environmentconcern']){
                                        $environmentconcern=$ChecklistFormDoc['ChecklistForm']['environmentconcern'];
                                        }
                                        $yearbuilt='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['yearbuilt']) && $ChecklistFormDoc[0]['ChecklistForm']['yearbuilt']){
                                        $yearbuilt=$ChecklistFormDoc['ChecklistForm']['yearbuilt'];
                                        }
                                        $typecons='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['typeofconstruction']) && $ChecklistFormDoc[0]['ChecklistForm']['typeofconstruction']){
                                        $typecons=$ChecklistFormDoc['ChecklistForm']['typeofconstruction'];
                                        }
                                        $tenant='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['tenant']) && $ChecklistFormDoc[0]['ChecklistForm']['tenant']){
                                        $tenant=$ChecklistFormDoc['ChecklistForm']['tenant'];
                                        }
                                        $describerecent='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['describerecentrenovation']) && $ChecklistFormDoc[0]['ChecklistForm']['describerecentrenovation']){
                                        $describerecent=$ChecklistFormDoc['ChecklistForm']['describerecentrenovation'];
                                        }
                                        $apartment_utility='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['apartment_utility']) && $ChecklistFormDoc[0]['ChecklistForm']['apartment_utility']){
                                        $apartment_utility=$ChecklistFormDoc['ChecklistForm']['apartment_utility'];
                                        }
                                        $areaenvconcern='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['areaenvironmentconcern']) && $ChecklistFormDoc[0]['ChecklistForm']['areaenvironmentconcern']){
                                        $areaenvconcern=$ChecklistFormDoc['ChecklistForm']['areaenvironmentconcern'];
                                        }
                                        $type='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['type']) && $ChecklistFormDoc[0]['ChecklistForm']['type']){
                                        $type=$ChecklistFormDoc['ChecklistForm']['type'];
                                        }
                                        $describe='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['describe_building_unpermit']) && $ChecklistFormDoc[0]['ChecklistForm']['describe_building_unpermit']){
                                        $describe=$ChecklistFormDoc['ChecklistForm']['describe_building_unpermit'];
                                        }
                                        $tenantexpense='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['tenantexpense']) && $ChecklistFormDoc[0]['ChecklistForm']['tenantexpense']){
                                        $tenantexpense=$ChecklistFormDoc['ChecklistForm']['tenantexpense'];
                                        }
                                        $shortappidupdate='';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['short_app_id']) && $ChecklistFormDoc[0]['ChecklistForm']['short_app_id']){
                                        $shortappidupdate=$ChecklistFormDoc['ChecklistForm']['short_app_id'];
                                        }
                                        $id = '';
                                        if(isset($ChecklistFormDoc['ChecklistForm']['id']) && $ChecklistFormDoc[0]['ChecklistForm']['id']){
                                        $id = $ChecklistFormDoc['ChecklistForm']['id'];
                                        }
                                        echo $this->Form->input('property_name',array('label' => false,'div' => false, 'placeholder' => 'Property Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'PropertyName','value'=>$property_name));?>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Client Objective</label>
                                            <?php echo $this->Form->input('client_objective',array('label' => false,'div' => false, 'empty' => 'Select Client Objective','class' => 'form-control','options' => array('LTH'=>'Long-Term Hold','RS'=>'Rehabilitation Sale','TISS'=>'Tenant improve Stabalize Sale'), 'id'=>'clientObjective','value'=>$clientobjective));?>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Type of Building</label>
                                            <?php echo $this->Form->input('typeofBuilding',array('label' => false,'div' => false, 'empty' => 'Select Type of Building','class' => 'form-control','options' => array('apartment'=>'Apartments','office'=>'Office','retail'=>'Retail',''=>'othercommercial',''=>'Other Commercial'), 'id'=>'typeofBuilding','value'=>$typeofBuilding));?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-4">
                                            <label># of Parking Spaces Covered</label>
                                            <?php echo $this->Form->input('parkingSpacecover',array('label' => false,'div' => false, 'placeholder' => '# of Parking Spaces Covered','class' => 'form-control','type' => 'text','id'=>'parkingSpace','value'=>$parkingSpacecover));?>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label># of Parking Spaces Un-covered</label>
                                            <?php echo $this->Form->input('parkingSpaceuncover',array('label' => false,'div' => false, 'placeholder' => '# of Parking Spaces Un-covered','class' => 'form-control','type' => 'text','id'=>'parkingSpaceuncover','value'=>$parkingSpaceuncover));?>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Buidling Rating</label>
                                            <?php echo $this->Form->input('Buildingrating',array('label' => false,'div' => false, 'empty' => 'Select Buidling Rating','class' => 'form-control','options' => array('A+'=>'A+','A'=>'A','B+'=>'B+','B'=>'B','C'=>'C'), 'id'=>'Buildingrating','value'=>$Buildingrating));?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-4">
                                            <label>Building Area Rating</label>
                                            <?php echo $this->Form->input('Buildingarearating',array('label' => false,'div' => false, 'empty' => 'Select Buidling Area Rating','class' => 'form-control','options' => array('A'=>'A','B'=>'B','C'=>'C'), 'id'=>'Buildingarearating','value'=>$Buildingarearating));?>  
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Type of Commercial Lease</label>
                                            <?php echo $this->Form->input('commercial_lease',array('label' => false,'div' => false, 'empty' => 'Select Commercial lease','class' => 'form-control','options' => array('NNN'=>'NNN','NN'=>'NN','FullService'=>'Full Service','Gross'=>'Gross'), 'id'=>'commercial_lease','value'=>$commercial_lease));?>  
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Describe any Environmental Concerns</label>
                                            <?php echo $this->Form->input('environmentconcern',array('label' => false,'div' => false, 'placeholder' => 'Environmental Concerns','class' => 'form-control','type' => 'text','id'=>'environmentconcern','value'=>$environmentconcern));?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-4">
                                        <label>Year Built</label>
                                        <?php echo $this->Form->input('yearbuilt',array('label' => false,'div' => false, 'placeholder' => 'Year Built','class' => 'form-control','type' => 'text','id'=>'yearbuilt','value'=>$yearbuilt));?>
                                        </div>
                                        <div class="form-group col-lg-4">
                                        <label>Type of Construction</label>
                                        <?php echo $this->Form->input('typecons',array('label' => false,'div' => false, 'placeholder' => 'Type of Construction','class' => 'form-control','type' => 'text','id'=>'typecons','value'=>$typecons));?>
                                        </div>
                                        <div class="form-group col-lg-4">
                                        <label># of Tenants</label>
                                        <?php echo $this->Form->input('tenant',array('label' => false,'div' => false, 'placeholder' => '# of Tenants','class' => 'form-control','type' => 'text','id'=>'tenant','value'=>$tenant));?>
                                        </div>        
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-12">
                                        <label>Describe recent renovations</label>
                                        <?php echo $this->Form->textarea('describerecent',array('label' => false,'div' => false, 'placeholder' => 'Describe recent renovations','class' => 'form-control','id'=>'describerecent','rows'=>'5','value'=>$describerecent));?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-4">
                                        <label>Apartment Utilities</label>
                                         <?php echo $this->Form->input('apartment_utility',array('label' => false,'div' => false, 'empty' => 'Select Apartment Utilities','class' => 'form-control','options' => array('individual'=>'individually metered','master'=>'master metered'), 'id'=>'apartment_utility','value'=>$apartment_utility));?>  
                                        </div>
                                        <div class="form-group col-lg-4">
                                        <label>Surrounding Area Environmental Concerns</label>
                                        <?php echo $this->Form->input('areaenvconcern',array('label' => false,'div' => false, 'empty' => 'Select Surrounding Area','class' => 'form-control','options' => array('gas_station'=>'Gas Station','laundry'=>'Laundry Mat','brownSite'=>'Brown Site','other'=>'Other'), 'id'=>'areaenvconcern','value'=>$areaenvconcern));?>  
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
                                            'onclick'=>'unpermit_value(this.value)',
                                            'value'=>$type
                                            );
                                            
                                            echo $this->Form->radio('type', $options, $attributes); ?></span>
                                        </div>    
                                    </div>
                                    <div class="col-lg-12" id="description" <?php if($type=='yes'){ }else{ ?>style="display:none;"
                                <?php } ?>>
                                        <div class="form-group col-lg-12">
                                            <label>Describe</label>
                                            <?php echo $this->Form->textarea('describe',array('label' => false,'div' => false, 'placeholder' => 'Description','class' => 'form-control','id'=>'describe','rows'=>'5','value'=>$describe));?>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-12">
                                        <label>Describe Tenant Expense Responsilbities</label>
                                        <?php echo $this->Form->textarea('tenantexpense',array('label' => false,'div' => false, 'placeholder' => 'Describe Tenant Expense Responsilbities','class' => 'form-control','id'=>'tenantexpense','rows'=>'5','value'=>$tenantexpense));?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-6"></div>
                                        <div class="form-group col-lg-6">
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-1">
                                                <label>&nbsp;</label>
                                                <?php
                                                echo $this->Form->input('loan_id',array('type' =>'hidden','value' => base64_encode($loan_id)));
                                                echo $this->Form->hidden('id',array('value'=>$id));
                                                echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15'));?>
                                            </div>
                                        </div>
                                    </div>
                                <?php echo $this->Form->end();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>