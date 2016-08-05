<div class="section first">
<div class=" p-b-60">
<div class="section dark-grey p-t-20  p-b-20 m-b-50">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Additional Information</h2>
      </div>
      
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="container">
  <div class="row login-container column-seperation">  
    <div class="col-lg-12">    
        <?php
            echo $this->Form->create('User', array('id'=>'detailForm','type' => 'file','style'=>''));
            echo $this->Form->hidden('agreeDocuments', array('value'=>count($legalDocuments),'id'=>'legalDocumentCount'));    
            echo $this->Form->hidden('userType', array('value'=>$userDetail['user_type'],'id'=>'userType'));
            //echo $this->Form->hidden('userID', array('value'=>base64_decode($userDetail['user_id'])));
            $allCommissions = $this->Common->getAllCommissions();
            $hireachyType = $this->Common->findHierarchyType($userDetail['user_type']);
            $referredUserType = $this->Common->findUpperHierarchyType($userDetail['user_type']);
            $userType = !empty($userTypes[$hireachyType]) ? $userTypes[$hireachyType] :'';
            echo $this->Form->hidden('hireachyType', array('value'=>$hireachyType,'id'=>'hireachyType'));
           ?>
        
            <div class="row column-seperation">
              <div class="col-md-12">
                   <div class="row form-row">
                     <div class="col-md-6">
                       <label class="form-label">Employer Licence Type</label>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                           <?php echo $this->Form->input('UserDetail.employer_licence_type',array('label' => false,'div' => false, 'empty'=>'Select One','class' => 'form-control','options' => $licenceTypes,'id'=>'employerLicenceType','maxlength' => 100));?> 
                        </div>
                     </div>
                     <div class="col-md-6" id = "BRELiceneRow" style="display:block;">
                        <label class="form-label">BRE License</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.bre_license_number',array('label' => false,'div' => false, 'placeholder' => 'BRE License','class' => 'form-control','type' => 'text','maxlength' => 12));?>
                        </div>
                     </div>
                     <div class="col-md-6" id = "CFLLiceneRow" style="display:none;">
                        <label class="form-label">CFL License</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                       <?php echo $this->Form->input('UserDetail.cfl_license_number',array('label' => false,'div' => false, 'placeholder' => 'CFL License','class' => 'form-control','type' => 'text','maxlength' => 12));?>
                        </div>
                     </div>
                     
                  </div>
                  <div class="row form-row">
                    <?php if(isset($referredUserType) && $referredUserType != ''){?>
                     <div class="col-md-6">
                       <label class="form-label">Referred By</label>
                       
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                           <?php echo $this->Form->input('UserDetail.referred_by',array('label' => false,'div' => false, 'empty' => 'Referred By','options'=>$referredBy,'selected'=>$referredUserType,'disabled'=>true,'class' => 'form-control','id' =>'referredByUserType'));?>
                        </div>
                     </div>
                     <div class="col-md-6" id="userListingRow">
                        <label class="form-label">Select User</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php
                        $referredUsers = $this->Common->getUpperHireachyUsers($referredUserType);
                        echo $this->Form->input('UserDetail.referred_by_user_id',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control', 'options'=>$referredUsers,'id'=>'referredUserID'));?>
                        </div>
                     </div>
                     <?php } ?>
                     <div id="referredUserDetail" style="display:none;">
                        <div class="col-md-6">
                          <label class="form-label"> First Name</label>
                          
                           <div class="input-with-icon  right">                                       
                               <i class=""></i>
                              <?php echo $this->Form->input('UserDetail.referred_by_first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control'));?>
                           </div>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Last Name</label>
                          
                           <div class="input-with-icon  right">                                       
                               <i class=""></i>
                              <?php echo $this->Form->input('UserDetail.referred_by_last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control'));?>
                           </div>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Email Address</label>
                          
                           <div class="input-with-icon  right">                                       
                               <i class=""></i>
                              <?php echo $this->Form->input('UserDetail.referred_by_email',array('label' => false,'div' => false, 'placeholder' => 'Email  Address','class' => 'form-control'));?>
                           </div>
                        </div>
                     </div>
                      <div class="col-md-6">
                        <label class="form-label">NMLS Company</label>
                         <div class="input-with-icon  right smallInput">                                       
                             <i class=""></i>
                            <?php echo $this->Form->input('UserDetail.NMLS_company',array('label' => false,'div' => false, 'placeholder' => 'NMLS Company','class' => 'form-control','type' => 'text','maxlength' => 6));?>  
                         </div>
                      </div>
                      <div class="col-md-6" >
                         <label class="form-label">NMLS Individual</label>
                       
                         <div class="input-with-icon  right smallInput">                                       
                          <i class=""></i>
                          <?php echo $this->Form->input('UserDetail.NMLS_Individual',array('label' => false,'div' => false, 'placeholder' => 'NMLS Individual','class' => 'form-control','type' => 'text','maxlength' => 6));?>
                         </div>
                      </div>
                     <?php if($userDetail['user_type'] == 2 || $userDetail['user_type'] == 3 || $userDetail['user_type'] == 4){ ?>
                     <div class="col-md-6" >
                         <label class="form-label">My Commission</label>
                      
                         <div class="input-with-icon  right smallInput">                                       
                          <i class=""></i>
                          <?php echo $this->Form->input('commission',array('label' => false,'div' => false, 'class' => 'form-control','empty' => 'Select Commission','options'=>$allCommissions,'id'=>'myCommission'));?>
                         </div>
                    </div>
                     <?php } ?>
                        <?php if($userDetail['user_type'] == 3 || $userDetail['user_type'] == 4){
                   
                   if(!empty($hireachyType)) { 
                ?>
                <div class="col-md-12" >
                    <div class="col-md-8" >
                         <label class="form-label"><?php echo $userType . ' Commission';?></label>
                         <div class="input-with-icon  right smallInput">                                       
                          <i class=""></i>
                           <span class="help">Note : When a user register for a <?php echo $userType; ?> under you, commission offered to user </span>
                          <?php echo $this->Form->input('other_commission',array('label' => false,'div' => false, 'empty' => 'Select Commission','class' => 'form-control','options'=>$allCommissions));?>
                         </div>
                    </div>
                </div>
                
                <?php }  } ?>
                   
                  </div>
              </div>   
            </div>
            <div class="row">
             <div class="col-md-12">
           
                <div class="col-md-6 validationContainer">
                <h1>Please agree to the following </h1>
                <?php $state = $this->Common->getStateName($userDetail['state']);
                     $city = $this->Common->getCityName($userDetail['city']);
                     $address = $userDetail['mailing_address']. ', '. $state . ', '. $city;
                ?>
                   <ul class="legal_points">
                       <?php //$legalDocuments;
                       if(count($legalDocuments) >0) { 
                       foreach($legalDocuments  as $key=> $document) { 
                            $val = $key+1;
                            if(isset($document['Document']['name']) && $document['Document']['name'] !='') { 
                             echo '<li> '; 
                           
                            
                              if(isset($document['Document']['upload']) && $document['Document']['upload'] != '') {
                               echo $this->Form->input("UserDetail.agreement.$key.name",array('value'=>$document['Document']['name'],'type' => 'hidden'));
                               echo $this->Html->link('Download '.$document['Document']['upload'], $this->Html->url( '/', true ).'app/webroot/admin_document/'.$document['Document']['upload'], array('class' => 'button','target'=>'_blank')) . ' Sign and date the form, then'.$this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file'));
                               
                              } else if(isset($document['Document']['document_description']) && $document['Document']['document_description'] != '') { 
                               //echo $this->Html->link($document['Document']['upload'], $this->Html->url( '/', true ).'app/webroot/admin_document/'.$document['Document']['upload'], array('class' => 'button','target'=>'_blank'));
                                echo $this->Form->input("UserDetail.agreement.$key.name",array('value'=>$document['Document']['name'],'type' => 'hidden'));
                             echo $this->Html->link('Download '.$document['Document']['name'],array('controller'=>'homes','action'=>'create_ndnca'),array('escape'=>false,'target' => '_blank')) . ' Sign and date the form, then'.$this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file')); 
                            }
                           echo '</li>';
                          } } }?>
                  
                       <!--li >Download <?php  echo $this->Html->link('W-4', $this->Html->url( '/', true ).'app/webroot/admin_document/w9.pdf', array('class' => 'button','target'=>'_blank'));?> </li>
                       <li>Sign and date the form, then <a href="javascript:void(0);" id="fileButton" title="Click here to upload">upload </a> or fax to us <br/><br/>
                      <?php echo $this->Form->input('UserDetail.legal_document',array('label' => false,'div' => false, 'class' => 'off','type' => 'file','id'=>'fileBox','style="display:none;"'));?>
                       </li-->
                       <?php if($userDetail['user_type'] == 2){ ?>
                       <li>How will you like to be paid
                          <ul>
                           <li>
                             <input type="radio" value="wire"  checked="checked" class="paymentOption" name="paymentMethod" id="wireOption" style='margin:12px'>Wire<br/>
                              <span class="wireOption"><input type="checkbox" name="agree_wire_option"/> I agree to pay $30 wire fee </span> 
                           </li>
                           <li>
                             <input type="radio" value="check" class="paymentOption" name="paymentMethod" id="checkOption" style='margin:12px'>Check <br/>
                             <span class="off checkOption"><input type="checkbox" name="agree_check_option"> I agree to be sent to address <?php echo $address;?> or fill different <a href="javascript:void(0);" id="showAddressButton" title="Click to fill address"> address</a></span>
                           </li>
                          </ul>
                       </li>
                       <?php } ?>
                       <input type="checkbox" class="check-success" name="accept_terms" id="agreeCheckBox" value="1">I accept the above legal <br/><span class="accept_message"></span>
                       <div>
                        <?php
                         echo $this->Form->input('check_address',array('label' => false,'div' => false, 'placeholder' => 'Address','class' => 'form-control off','type' => 'textarea','id'=>'checkAddressBox'));?>
                        </div>
                </div>
             </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                     <?php echo $this->Form->input('register',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-primary btn-cons','name'=>'register-submit','value'=>'Submit','id'=>'detail-submit'));?>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->hidden('flag',array('label'=>false,'div' => false,'value'=>'0','id'=>'flagSubmit','tabindex'=>'25'));?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

</div>
</div>

