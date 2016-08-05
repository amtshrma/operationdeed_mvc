<?php
echo $this->Html->css('bootstrap-datepicker/datepicker');
echo $this->Html->css('bootstrap-select2/select2');
echo $this->Html->script('admin/admin_user');
echo $this->Html->script('jquery.maskedinput');
?> 
<div class="page-content">
 <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li>
        <?php echo $this->Html->link('User', array('controller'=>'users','action'=>'index'),array('class'=>'active'));?>
        </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <h3 ><?php echo $action; ?> - <span class="semi-bold">User</span></h3>
      </div>
      <div class="page-title">
      
      </div>
      
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-body no-border">
          <?php
           if(!empty($this->data['User']) && $this->data['User']['id'] != '' && $this->data['User']['status'] != 0) {
                echo $this->Html->link('<button style="margin-left:12px" class="btn btn-primary pull-right">Enquiry</button>','javascript:void(0);',array('escape' => false,'title' => 'Enquiry','id'=>'sendMessageButton'));
                echo $this->Html->link('<button  style="margin-left:12px" class="btn btn-primary pull-right">Approve</button>','javascript:void(0);',array('escape' => false,'title' => 'Approve','id'=>'activateButton'));
             }
             //pr($this->data);
             echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'),'id'=>'registerForm','type' => 'file','novalidate' => true,'class'=>'form-no-horizontal-spacing'));            
             echo $this->Form->hidden('User.id',array('value'=>base64_encode($this->data['User']['id']),'id'=>'userID'));
             echo $this->Form->hidden('UserDetail.id',array('value'=>base64_encode($this->data['UserDetail']['id']),'id'=>'userDetailID'));
            
             ?>
            <div class="row column-seperation">
              <div class="col-md-6">
                <h4>Basic Information</h4>            
                  <div class="form-group">
                     <label class="form-label">First Name<span class="required"> * </span></label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'id'=>'first_name', 'placeholder' => 'First Name','class' => 'form-control','tabindex'=>'1','maxlength' => 20));?>      
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Last Name<span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'id'=>'last_name', 'placeholder' => 'Last Name','class' => 'form-control','tabindex'=>'2','maxlength' => 20));?>                                 
                     </div>
                  </div>
                 <div class="form-group">
                     <label class="form-label">User Type<span class="required"> * </span></label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php
                          $roleTypes['1'] = "Borrower";
                         echo $this->Form->input('User.user_type',array('label' => false,'div' => false, 'empty' => 'User Type','class' => 'form-control','options'=>$roleTypes, 'empty' => 'Select One','tabindex'=>'3','maxlength' => 50,'id'=>'user_type'));?>                                 
                     </div>
                  </div>
                 <div class="form-group">
                     <label class="form-label">Email Address<span class="required"> * </span></label>
                     <span class="help">e.g. "email@address.com"</span>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','tabindex'=>'4','maxlength' => 55));?>                                 
                     </div>
                  </div>
                <div class="form-group">
                     <label class="form-label">Company Name <span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control','tabindex'=>'5','maxlength' => 55));?>                                 
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Company Position<span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.company_position',array('label' => false,'div' => false, 'placeholder' => 'Company Position','class' => 'form-control','tabindex'=>'6','maxlength' => 55));?>                                 
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Birthday</label>
                     <div class="input-with-icon  input-append success date">                                 
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.date_of_birth', array('type' => 'text','label' => false,'dateFormat' => 'MDY','div'=>false, 'id'=>"dateOfBirth",'tabindex'=>'7')); ?>
                          <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                     </div>
                  </div>
                   <div class="form-group">
                     <label class="form-label">Profile Picture</label>
                     
                     <div class="">                                 
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.profile_pic',array('label' => false,'div' => false, 'placeholder' => 'Profile Picture','type'=>'file','tabindex'=>'8','class' => '','maxlength' => 55));?>
                        
                     </div>
                  </div>
              </div>
              <div class="col-md-6">
                <h4>Postal Information</h4>
                  <div class="form-group">
                     <label class="form-label">Mailing Address<span class="required"> * </span></label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.mailing_address',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address1','class' => 'form-control','tabindex'=>'9','type'=>'textarea','maxlength' => 100));?>   
                     </div>
                  </div>
                 <div class="form-group">
                     <label class="form-label">Mailing Address</label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                       <?php echo $this->Form->input('UserDetail.mailing_address2',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address2','class' => 'form-control','type'=>'textarea','tabindex'=>'10','maxlength' => 100));?>     
                     </div>
                  </div>
                   <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">State<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                            <?php //pr($this->data['UserDetail']);
                            $selected = '';
                            if($this->data['UserDetail'] && $this->data['UserDetail']['state']) {
                                $selected = $this->data['UserDetail']['state'];
                            }
                            echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'empty' => 'State','class' => 'form-control','options'=>$states,'tabindex'=>'11', 'empty' => 'Select One','id'=>'userStates','selected'=>$selected));?> 
                        </div>
                     </div>
                      <div class="col-md-6">
                        <label class="form-label">City<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php 
                        $citySelected = '';
                            if($this->data['UserDetail'] && $this->data['UserDetail']['city']) {
                                $citySelected = $this->data['UserDetail']['city'];
                            } 
                        echo $this->Form->input('UserDetail.city',array('label' => false,'div' => false, 'placeholder' => 'City','options'=>'','class' => 'form-control','tabindex'=>'12','id'=>'userCities', 'selected' =>$citySelected));?>    
                     </div>
                     </div>
                   </div>
                   
                    <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Zipcode<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                             <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','tabindex'=>'13','maxlength' => 10));?>
                        </div>
                     </div>
                      <div class="col-md-6">
                        <label class="form-label">Fax Number<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false,'class' => 'form-control maskInput','tabindex'=>'14'));?>   
                     </div>
                     </div>
                   </div>
                   
                   
                   <div class="row form-row">
                     <div class="col-md-6">
                       <label class="form-label">Office Phone</label>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                            <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => 'Office Phone','class' => 'form-control maskInput','tabindex'=>'15'));?>    
                        </div>
                     </div>
                      <div class="col-md-6">
                        <label class="form-label">Mobile Phone<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false,'class' => 'form-control maskInput','tabindex'=>'16'));?>   
                     </div>
                     </div>
                  </div>
              </div>
            </div>
            <hr/>
            <div class="row column-seperation">
              <div class="col-md-12">
                <h4>Additional Information</h4>            
                   <div class="row form-row">
                     <div class="col-md-6">
                       <label class="form-label">Employer Licence Type</label>
                       
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                           <?php echo $this->Form->input('UserDetail.employer_licence_type',array('label' => false,'div' => false,'options'=>$licenceTypes,'class' => 'form-control','tabindex'=>'17','maxlength' => 55,'id'=>'employerLicenceType'));?>   
                        </div>
                     </div>
                     <?php
                     $style = 'style="display:block;"';
                     $cflStyle = 'style="display:none;"';
                      if(!empty($this->data['UserDetail']) && $this->data['UserDetail']['bre_license_number'] != '') { 
                        $style = 'style="display:block;"';
                        $cflStyle = 'style="display:none;"';
                     }elseif(!empty($this->data['UserDetail']) && $this->data['UserDetail']['cfl_license_number'] != '') { 
                        $style = 'style="display:none;"';
                        $cflStyle = 'style="display:block;"';
                     }
                     ?>
                     <div class="col-md-6" id = "BRELiceneRow" <?php echo $style; ?>>
                        <label class="form-label">BRE License</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.bre_license_number',array('label' => false,'div' => false, 'placeholder' => 'BRE License','class' => 'form-control','tabindex'=>'18','maxlength' => 6));?>
                        </div>
                     </div>
                   
                     <div class="col-md-6" id = "CFLLiceneRow" <?php echo $cflStyle; ?>>
                        <label class="form-label">CFL License</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                       <?php echo $this->Form->input('UserDetail.cfl_license_number',array('label' => false,'div' => false, 'placeholder' => 'CFL License','class' => 'form-control','tabindex'=>'19','maxlength' => 6));?>
                        </div>
                     </div>
                  </div>
              </div>   
            </div>
            
              <div class="col-md-12">
               
                   <div class="row form-row">
                    <div class="col-md-6">
                       <label class="form-label">Commission</label>
                       
                        <div class="input-with-icon  right">                                       
                           <i class="">%</i>
                           <?php

                           $selected = '';
                           if(!empty($this->data['UserDetail']) && isset($this->data['UserDetail']['commission'])){
                            $selected = $this->data['UserDetail']['commission'];
                           } 
                           echo $this->Form->input('UserDetail.commission',array('label' => false,'div' => false,'class' => 'form-control commission','type'=>'number','min'=>'0.1','max'=>'100','step'=>'0.1','value'=>$selected));?>    
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Bonus (if any)</label>
                      
                        <div class="input-with-icon  left">                                       
                         <i class="">$</i>
                        <?php echo $this->Form->input('UserDetail.bonus',array('label' => false,'div' => false, 'placeholder' => 'Bonus','class' => 'form-control bonus','type'=>'text','maxlength' => 5,'title'=>'Enter Number'));?>
                        </div>
                     </div> 
                  </div>
              </div>   
           
            <div class="row column-seperation">
              <div class="col-md-12">
                <h4>Legal Agreement  <?php echo $this->Html->link('Add More','javascript:void(0)',array('class'=>'addFile','title'=>'Click to upload more'));   ?>   </h4> <i class="">Click Add More link to add multiple documents</i>     
                   <?php
                          if(count($this->data['UserDocument']) == 0){
                            $count = '1';
                          }else {
                            $count = count($this->data['UserDocument']);
                          }
                   
                   ?>
                    <span id="agreementCount" style="display:none;"><?php echo $count; ?> </span>
                      <?php
                      //pr($this->data['UserDocument']);
                      if(count($this->data['UserDocument']) > 0) { ?>
                         <div class="row form-row">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                            </div>
                             <div class="col-md-6">
                                <label class="form-label">Download</label>
                            </div>
                         </div>
                      <?php  foreach($this->data['UserDocument'] as $key=> $document) { //pr($document);
                            if(isset($document['file_name']) && $document['file_name'] != '') { ?>
                             <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php
                                        echo $this->Form->input("UserDetail.agreement.$key.id",array('value'=>$document['id'],'type' => 'hidden'));
                                        echo $this->Form->input("UserDetail.agreement.$key.name",array('value'=>$document['document_name'],'type' => 'text','label'=>false)); ?>
                                    </div>
                                 </div>
                                <div  class="col-md-6">
                                  
                                   <div class="input-with-icon  right">
                                    <i class=""></i>
                                    <?php 
                                   $fileName = explode('_',$document['file_name']);
                                    echo $this->Html->link($fileName[1], $this->Html->url( '/', true ).'app/webroot/user_document/'.$document['file_name'], array('class' => 'button'));
                                    echo $this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file'));?>
                                   </div>
                                </div>
                            </div>
                        <?php }
                      }
                   } else { ?>
                          <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php
                                        echo $this->Form->input("UserDetail.agreement.0.name",array('value'=>'','type' => 'text','label'=>false)); ?>
                                    </div>
                                 </div>
                                <div  class="col-md-6">
                                   <div class="input-with-icon  right">
                                    <i class=""></i>
                                    <?php 
                                    echo $this->Form->input('UserDetail.agreement.0.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file'));?>
                                   </div>
                                </div>
                            </div>
                    <?php } ?>
                  </div>
                   <div id="addFileDiv"></div>
              </div>   
         
            <div class="form-actions">
                <div class="pull-left">
                  <!--div class="checkbox checkbox check-success">
                    <input type="checkbox" value="1" id="chkTerms">
                    <label for="chkTerms">I Here by agree on the Term and condition. </label>
                  </div-->
                </div>
                <div class="pull-right">
                  <?php echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-danger btn-cons'));
                   echo $this->Form->button('Reset', array('type' => 'reset','class' => 'btn btn-white btn-cons'));?>
                </div>
            </div>
          <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>
<?php
   echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');
   echo $this->Html->script('bootstrap-select2/select2.min');
   
?>