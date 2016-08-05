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
                        <?php
                        if(isset($referredUserType) && $referredUserType != ''){?>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('UserDetail.referred_by',array('label' => false,'div' => false, 'empty' => 'Referred By','options'=>$referredBy,'selected'=>$referredUserType,'disabled'=>true,'class' => 'form-control','id' =>'referredByUserType'));
                                $referredUsers = $this->Common->getUpperHireachyUsers($referredUserType);
                                echo '</div><div class="col-lg-4">';
                                echo $this->Form->input('UserDetail.referred_by_user_id',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control', 'options'=>$referredUsers,'id'=>'referredUserID'));
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
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('UserDetail.NMLS_company',array('label' => false,'div' => false, 'placeholder' => 'NMLS Company','class' => 'form-control','type' => 'text','maxlength' => 6));?>
                        </div>
                        <div class="col-lg-4">
                            <?php echo $this->Form->input('UserDetail.NMLS_Individual',array('label' => false,'div' => false, 'placeholder' => 'NMLS Individual','class' => 'form-control','type' => 'text','maxlength' => 6));?>
                        </div>
                        <?php
                        if($userDetail['user_type'] == 2 || $userDetail['user_type'] == 3 || $userDetail['user_type'] == 4){
                            echo '<div class="col-lg-4">';
                            echo $this->Form->input('commission',array('label' => false,'div' => false, 'class' => 'form-control','empty' => 'My Commission','options'=>$allCommissions,'id'=>'myCommission'));
                            echo '</div>';
                        }
                        ?>
                        <div style="clear: both"></div>
                        <?php if($userDetail['user_type'] == 3 || $userDetail['user_type'] == 4){
                            if(!empty($hireachyType)){
                        ?>
                            <span class="help">Note : When a user register for a <?php echo $userType; ?> under you, commission offered to user </span>
                            <div class="col-lg-4">
                            <?php echo $this->Form->input('other_commission',array('label' => false,'div' => false, 'empty' => 'Select Commission','class' => 'form-control','options'=>$allCommissions));
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
                                                        echo $this->Html->link('Download '.$document['Document']['name'],array('controller'=>'homes','action'=>'create_ndnca'),array('escape'=>false,'target' => '_blank')) . ' Sign and upload the form '.$this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file')); 
                                                    }
                                                echo '</li>';
                                            }
                                        }
                                    }
                                ?>
                                <?php if($userDetail['user_type'] == 2){ ?>
                                    <li>How will you like to be paid
                                        <ul>
                                            <li>
                                                <input type="radio" value="wire"  <?php if(!empty($this->request->data['UserDetail']['paymentMethod']) && $this->request->data['UserDetail']['paymentMethod'] == 'wire'){ echo 'checked';}?> class="paymentOption" name="data[UserDetail][paymentMethod]" id="wireOption" style='margin:12px'>Wire<br/>
                                                <span class="wireOption"><input type="checkbox" name="data[UserDetail][agree_wire_option]"/> I agree to pay $30 wire fee </span>
                                                <?php
                                                if(!empty($this->request->data['UserDetail']['paymentMethod']) && $this->request->data['UserDetail']['paymentMethod'] == 'wire' && !empty($validationErrors)){
                                                    echo '<div class="error-message">'.$validationErrors.'</div>';
                                                }
                                                ?>
                                            </li>
                                            <li>
                                                <input type="radio" <?php if((!empty($this->request->data['UserDetail']['paymentMethod']) && $this->request->data['UserDetail']['paymentMethod'] == 'check')){ echo 'checked';}else if((empty($this->request->data['UserDetail']['paymentMethod']))){ echo 'checked';}?> value="check" class="paymentOption" name="data[UserDetail][paymentMethod]" id="checkOption" style='margin:12px'>Check <br/>
                                                <span class="off checkOption"><input type="checkbox" name="data[UserDetail][agree_check_option]"> I agree to be sent to address <?php echo $address;?> or fill different <a href="javascript:void(0);" id="showAddressButton" title="Click to fill address"> address</a></span>
                                                <?php
                                                if(!empty($this->request->data['UserDetail']['paymentMethod']) && $this->request->data['UserDetail']['paymentMethod'] == 'check' && !empty($validationErrors)){
                                                    echo '<div class="error-message">'.$validationErrors.'</div>';
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
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