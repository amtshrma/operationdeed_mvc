<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1>Short Application</h1>
            <br>
            <div class="wizard-container">
                <div class="wizard-step-complete"><span class="wizard-badge-complete">1</span><div class="step-number-complete">Step 1</div></div>
                <div class="wizard-step-complete"><span class="wizard-badge-complete">2</span><div class="step-number-complete">Step 2</div></div>
                <div class="wizard-step-active"><span class="wizard-badge-active">3</span><div class="step-number-active">Step 3</div></div>
                <div class="wizard-step"><span class="wizard-badge">4</span><div class="step-number">Step 4</div></div>
                <div class="wizard-step"><span class="wizard-badge">5</span><div class="step-number">Step 5</div></div>
                <div style="clear:both"></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo $this->Session->flash();?>
                    <h3>Step 3 - Property Information</h3>
                    <br />
                    <center>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('property_address',array('label' => false,'div' => false, 'placeholder' => 'Property Address','class' => 'form-control','type' => 'text','maxlength' => 100));?>
                        </div>
                        <div class="col-lg-4">
                        <?php
                            $propertyTypes['other'] = 'Other';
                            echo $this->Form->input('property_type',array('label' => false,'div' => false, 'empty' => 'Property Type','options'=>$propertyTypes,'class' => 'form-control placeholder otherOption','maxlength' => 100,'id'=>'propertyType'));
                        ?>
                        </div>
                        <div class="other_Property_Type" style="display: none;">
                            <div class="col-lg-4">
                            <?php
                                echo $this->Form->input('other_property_type',array('label' => false,'div' => false, 'placeholder' => 'Other Property Type','type'=>'text','class' => 'form-control otherOption off','maxlength' => 100,'id'=>'other_Property_Type'));
                            ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <?php
                            $alt = (!empty($this->request->data['ShortApplication']['property_city'])) ? $this->request->data['ShortApplication']['property_city'] : '';
                            echo $this->Form->input('property_state',array('label' => false,'div' => false, 'empty' => 'Select Property State','class' => 'form-control placeholder','options' => $states,'tabindex'=>'9','id'=>'userStates','alt'=>$alt));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('property_city',array('label' => false,'div' => false, 'empty' => 'Select City','class' => 'form-control placeholder','options'=>'','id'=>'userCities'));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('property_zipcode',array('label' => false,'div' => false, 'placeholder' => 'Property ZipCode','class' => 'form-control placeholder','maxlength' => 20));?>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <br>
                    <span class="redText">* All fields are required to move on to next step.</span>
                    </center>
                </div>
                <!-- /.panel-body -->
            </div>
            <div class="buttons">
    
            <table border="0" width="100%">
                <tr>
                    <td align="left">
                        <?php //echo $this->Html->link('<span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel',array('controller'=>'homes','action'=>'shortAppStartup'),array('escape'=>false,'class'=>'btn btn-lg btn-cancel'));?>
                    </td>
                    <td align="right">
                        <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('class'=>'btn btn-lg btn-primary sumitButton','title'=>'step2','type'=>'submit','escape'=>false));?>
                    </td>
                </tr>
            </table>
            <br><br>
            </div>
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<?php echo $this->Element('fronts/loader');?>