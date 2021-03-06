<div id="wrapper" class="step step1 wrapper-fullwidth">
    <nav class="navbar navbar-default navbar-static-top"></nav>
    <center><h1>User Registration</h1></center>
    <div class="content-container-topalign">
        <div class="whitebox-wrapper">
            <div class="content-nomargin steps">
                <div data-step="1" class="wizard-step-complete"><span class="wizard-badge-active">1</span><div class="step-number-active">Step 1</div></div>
                <div data-step="2" class="wizard-step-complete"><span class="wizard-badge">2</span><div class="step-number">Step 2</div></div>
                <?php if(empty($shortAppID)){ ?>
                    <div data-step="3" class="wizard-step-active"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                <?php } ?>
                
                <div style="clear:both"></div>
            </div>
            <?php 
                echo $this->Form->create('User', array('id'=>'detailForm','novalidate'=>'novalidate','type' => 'file','style'=>''));
                echo $this->Form->hidden('agreeDocuments', array('value'=>count($legalDocuments),'id'=>'legalDocumentCount'));    
                echo $this->Form->hidden('userType', array('value'=>$userDetail['user_type'],'id'=>'userType'));
                $allCommissions = $this->Common->getAllCommissions();
                $hireachyType = $this->Common->findHierarchyType($userDetail['user_type']);
                $referredUserType = $this->Common->findUpperHierarchyType($userDetail['user_type']);
                $userType = !empty($userTypes[$hireachyType]) ? $userTypes[$hireachyType] :'';
                echo $this->Form->hidden('hireachyType', array('value'=>$hireachyType,'id'=>'hireachyType'));
            ?>
                <div class="whitebox">
                    <h3>Step 3 - Additional Information</h3>
                    <br />
                    <center>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.employer_licence_type',array('label' => false,'div' => false, 'empty'=>'Select One','class' => 'form-control','options' => $licenceTypes,'id'=>'employerLicenceType','maxlength' => 100));?>
                            </div>
                            <div id="BRELiceneRow" class="col-lg-4" style="display: none;">
                                <?php echo $this->Form->input('UserDetail.bre_license_number',array('label' => false,'div' => false, 'placeholder' => 'BRE License','class' => 'form-control','type' => 'text','maxlength' => 12));?>
                            </div>
                            <div id="CFLLiceneRow" class="col-lg-4" style="display: none;">
                                <?php echo $this->Form->input('UserDetail.cfl_license_number',array('label' => false,'div' => false, 'placeholder' => 'CFL License','class' => 'form-control','type' => 'text','maxlength' => 12));?>
                            </div>
                            <?php if($this->Session->read('userSessionData.user_type') == '7'){ ?>
                                <div class="col-lg-4">
                                    <?php
                                    echo $this->Form->input('User.investor_type',array('label' => false,'div' => false, 'class' => 'form-control','multiple'=>true,'options'=>$investorTypes,'id'=>'investorTypes','empty'=>'Select Option'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('UserDetail.lending_profile',array('label' => false,'div' => false, 'placeholder' => 'Lending Profile','class' => 'form-control','type'=>'text'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('UserDetail.loan_amount_outstanding',array('label' => false,'div' => false, 'placeholder' => 'Amount of Loans Outstanding','class' => 'form-control','maxlength' => 55));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('UserDetail.trust_deed_lending_year',array('label' => false,'div' => false, 'placeholder' => 'Years of Trust Deed Lending','class' => 'form-control','maxlength' => 55));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('UserDetail.counties',array('label' => false,'div' => false, 'placeholder' => 'Preferred Counties','class' => 'form-control','maxlength' => 55));?>
                                </div>
                            <?php } ?>
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
                                                        echo $this->Html->link('Download '.$document['Document']['name'],array('controller'=>'homes','action'=>'create_ndnca'),array('escape'=>false,'target' => '_blank')) . ' Sign and upload the form '.$this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file')); 
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
            <div class="buttons">
                <table border="0" width="106%">
                    <tr>
                        <td align="left">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel',BASE_URL,array('class'=>'btn btn-lg btn-cancel','escape'=>false));?>
                        </td>
                        <td align="right">
                            <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('class'=>'btn btn-lg btn-primary step','title'=>'step2','type'=>'submit','escape'=>false,'id'=>'step1'));?>
                        </td>
                    </tr>
                </table>
            </div>
            <?php echo $this->Form->end();?>
        </div>
    </div>
</div>