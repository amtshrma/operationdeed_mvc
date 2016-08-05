<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1><?php echo $this->Session->read('userTypeText');?> Registration</h1>
            <br>
            <div class="wizard-container" style="margin-right: 0;">
                <div data-step="1" class="wizard-step-complete"><span class="wizard-badge-complete">1</span><div class="step-number-complete">Step 1</div></div>
                <div data-step="1" class="wizard-step-complete"><span class="wizard-badge-complete">2</span><div class="step-number-complete">Step 2</div></div>
                <div data-step="3" class="wizard-step-active"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                <div style="clear:both"></div>
            </div>
            <?php
            echo $this->Form->create('User', array('id'=>'registerForm','type' => 'file','novalidate'=>'novalidate'));
            echo $this->Form->hidden('agreeDocuments', array('value'=>count($legalDocuments),'id'=>'legalDocumentCount'));    
            echo $this->Form->hidden('userType', array('value'=>$userDetail['user_type'],'id'=>'userType'));
            $allCommissions = $this->Common->getAllCommissions();
            $hireachyType = $this->Common->findHierarchyType($userDetail['user_type']);
            $referredUserType = $this->Common->findUpperHierarchyType($userDetail['user_type']);
            $userType = !empty($userTypes[$hireachyType]) ? $userTypes[$hireachyType] :'';
            echo $this->Form->hidden('hireachyType', array('value'=>$hireachyType,'id'=>'hireachyType'));
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Step 3 - Additional Information</h3>
                    <div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
                    <hr />
                    <center>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <?php echo $this->Form->input('UserDetail.employer_licence_type',array('label' => false,'div' => false, 'empty'=>'Select One','class' => 'form-control','options' => $licenceTypes,'id'=>'employerLicenceType','maxlength' => 100));?>
                            </div>
                            <div id="BRELiceneRow" class="col-lg-6" style="display: none;">
                                <?php echo $this->Form->input('UserDetail.bre_license_number',array('label' => false,'div' => false, 'placeholder' => 'BRE License','class' => 'form-control','type' => 'text','maxlength' => 12));?>
                            </div>
                            <div id="CFLLiceneRow" class="col-lg-6" style="display: none;">
                                <?php echo $this->Form->input('UserDetail.cfl_license_number',array('label' => false,'div' => false, 'placeholder' => 'CFL License','class' => 'form-control','type' => 'text','maxlength' => 12));?>
                            </div>
                        <?php //echo $referredUserType;
                        if(isset($referredUserType) && $referredUserType != ''){ ?>
                            <div class="col-lg-4" style="display:none;">
                                <?php echo $this->Form->input('UserDetail.referred_by',array('label' => false,'div' => false, 'empty' => 'Referred By','options'=>$referredBy,'selected'=>$referredUserType,'disabled'=>true,'class' => 'form-control','id' =>'referredByUserType'));
                                $referredUsers = $this->Common->getUpperHireachyUsers($referredUserType);
                                $selected = '';
                                $class = '';
                                if(!empty($referralID)) {
                                    $selected = base64_decode($referralID);
                                    $class = "disabled";
                                    echo $this->Form->hidden('UserDetail.referred_by_user_id', array('value'=>count($legalDocuments),'id'=>'legalDocumentCount'));

                                }
                                echo '</div><div class="col-lg-6">';
                                echo $this->Form->input('UserDetail.referred_by_user_id',array('label' => false,'div' => false, 'empty' => 'Select Sales Manager/ Director','class' => 'form-control', 'options'=>$referredUsers,'id'=>'referredUserID','selected'=>$selected, $class));
                            echo '</div>';
                        }
                        ?>
                        <div id="referredUserDetail" style="display:none;">
                            <div class="col-lg-4">
                            <?php echo $this->Form->input('UserDetail.referred_by_first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.referred_by_last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.referred_by_email',array('label' => false,'div' => false, 'placeholder' => 'Email  Address','class' => 'form-control'));?>
                            </div>
                        </div>
                        <?php
                        if($userDetail['user_type'] == 3 || $userDetail['user_type'] == 4 || $userDetail['user_type'] == 2 ){
                            echo '<div class="col-lg-6">';
                           
                            echo $this->Form->input('commission',array('label' => false,'div' => false,'class' => 'form-control','type'=>'number','min'=>'0.1','max'=>'100','step'=>'0.1','placeholder' => 'My Commission %','id'=>'myCommission'));
                            echo '</div>';
                        }
                        ?>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('UserDetail.NMLS_company',array('label' => false,'div' => false, 'placeholder' => 'NMLS Company','class' => 'form-control','type' => 'text','maxlength' => 6));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('UserDetail.NMLS_Individual',array('label' => false,'div' => false, 'placeholder' => 'NMLS Individual','class' => 'form-control','type' => 'text','maxlength' => 6));?>
                        </div>
                        <div style="clear: both"></div>
                        <?php if($userDetail['user_type'] == 3 || $userDetail['user_type'] == 4){
                            if(!empty($hireachyType)){
                        ?>
                            <span class="help">Note : When a user register for a <?php echo $userType; ?> under you, commission offered to user </span>
                            <div class="col-lg-4">
                            <?php  echo $this->Form->input('other_commission',array('label' => false,'div' => false,'class' => 'form-control','type'=>'number','min'=>'0.1','max'=>'100','step'=>'0.1','placeholder' => 'Select Commission %'));
                            echo '</div>';
                            }
                        }
                        ?>
                        <div class="bottonRegisterForm">
                            <h3>Please agree to the following </h3>
                            <?php $state = $this->Common->getStateName($userDetail['state']);
                                $city = $this->Common->getCityName($userDetail['city']);
                                $address = $userDetail['mailing_address']. ', '. $state . ', '. $city;
                            ?>
                            <ul class="legal_points registerStep3">
                                <?php
                                    if(count($legalDocuments) >0) { 
                                        foreach($legalDocuments  as $key=> $document) { 
                                            $val = $key+1;
                                            if(isset($document['Document']['name']) && $document['Document']['name'] !='') { 
                                                echo '<li> '; 
                                                    if(isset($document['Document']['upload']) && $document['Document']['upload'] != '') {
                                                        echo $this->Form->input("UserDetail.agreement.$key.name",array('value'=>$document['Document']['name'],'type' => 'hidden'));
                                                        echo $this->Html->link('Download '.$document['Document']['upload'], $this->Html->url( '/', true ).'app/webroot/admin_document/'.$document['Document']['upload'], array('class' => 'button','target'=>'_blank')) . ' Sign and upload the form ';
                                                        echo $this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file','placeholder'=>'Choose File'));
                                                    }else if(isset($document['Document']['document_description']) && $document['Document']['document_description'] != ''){ 
                                                        echo $this->Form->input("UserDetail.agreement.$key.name",array('value'=>$document['Document']['name'],'type' => 'hidden'));
                                                        echo $this->Html->link('Download '.$document['Document']['name'],array('controller'=>'homes','action'=>'create_pdf_document', $document['Document']['name']),array('escape'=>false,'target' => '_blank')) . ' Sign and upload the form '.$this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file')); 
                                                    }
                                                echo '</li>';
                                            }
                                        }
                                    }
                                ?>
                            
                            </ul>
                            <?php echo $this->Form->input('UserDetail.accept_terms',array('label'=>false,'div'=>false,'default'=>'1','type'=>'checkbox','options'=>array('1')));?><p>I accept the above legal</p> <br/><span class="accept_message"></span>
                            <div>
                                <?php
                                    echo $this->Form->input('check_address',array('label' => false,'div' => false, 'placeholder' => 'Address','class' => 'form-control off','type' => 'textarea','id'=>'checkAddressBox','style'=>'display:none;'));
                                ?>
                            </div>
                        </div>
                    </div>
                </center>
                </div>
                <!-- /.panel-body -->
            </div>
            <div class="buttons">
            <table border="0" width="100%">
                <tr>
                    <td align="left">
                        <?php //echo $this->Html->link('<span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel',array('controller'=>'homes','action'=>'shortAppStartup'),array('escape'=>false,'class'=>'btn btn-lg btn-cancel'));?>
                    <td align="right">
                        <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('class'=>'btn btn-lg btn-primary sumitButton','title'=>'step2','type'=>'submit','escape'=>false));?>
                    </td>
                </tr>
            </table>
            <br><br>
            </div>
            <?php echo $this->Form->end();?>
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<style>
    ul.documents div.error-message{
        float: none;
        margin-left: 23px;
    }
    select.form-control{
        width: 100% !important;
    }
</style>