<?php
echo $this->Html->css('bootstrap-datepicker/datepicker');
echo $this->Html->css('bootstrap-select2/select2');
echo $this->Html->script('admin/admin_user');
?> 
<div class="page-content">
 <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li>
         <?php echo $this->Html->link('Investor', array('controller'=>'investors','action'=>'index'),array('class'=>'active'));?>
        </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <h3><?php echo $action; ?> - <span class="semi-bold">Investor</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          
          <div class="grid-body no-border">
         <?php 
            echo $this->Form->create('User', array('url' => array('controller' => 'investors', 'action' => 'add'),'id'=>'registerForm','type' => 'file','novalidate' => true));            
            echo $this->Form->hidden('User.id',array('value'=>base64_encode($this->data['User']['id']),'id'=>'userID'));
            echo $this->Form->hidden('User.user_type',array('value'=>7));
            echo $this->Form->hidden('UserDetail.id',array('value'=>base64_encode($this->data['UserDetail']['id']),'id'=>'userDetailID'));
             ?>
            <div class="row column-seperation">
              <div class="col-md-6">
                <h4>Basic Information</h4>            
                  <div class="form-group">
                     <label class="form-label">First Name<span class="required"> * </span></label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                          <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','tabindex'=>'1','maxlength' => 55));?>      
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Last Name<span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','tabindex'=>'2','maxlength' => 55));?>                                 
                     </div>
                  </div>
                 <div class="form-group">
                     <label>Investor Type<span class="required"> * </span></label>
                     <span class="help">Click control to select both investor type.</span>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('User.investor_type',array('label' => false,'div' => false, 'class' => 'form-control','multiple'=>true,'options'=>$investorTypes, 'tabindex'=>'3','maxlength' => 55, 'id'=>'investorTypes'));?>                            
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
                            <?php echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'empty' => 'State','class' => 'form-control','options'=>$states,'tabindex'=>'11', 'empty' => 'Select One'));?> 
                        </div>
                     </div>
                      <div class="col-md-6">
                        <label class="form-label">City<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.city',array('label' => false,'div' => false, 'placeholder' => 'City','class' => 'form-control','tabindex'=>'12','maxlength' =>100));?>    
                        </div>
                     </div>
                   </div>

                    <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Zipcode<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                             <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','tabindex'=>'13','maxlength' => 55));?>
                        </div>
                     </div>
                      <div class="col-md-6">
                        <label class="form-label">Fax Number<span class="required"> * </span></label>
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false, 'placeholder' => '###-###-####','class' => 'form-control','tabindex'=>'14','maxlength' => 55));?>   
                     </div>
                     </div>
                   </div>
                   <div class="row form-row">
                     <div class="col-md-6">
                       <label class="form-label">Office Phone</label>
                       <span class="help">e.g. "(###) ### - ####"</span>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                            <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => 'Office Phone','class' => 'form-control','tabindex'=>'15','maxlength' => 55));?>    
                        </div>
                     </div>
                      <div class="col-md-6">
                        <label class="form-label">Mobile Phone<span class="required"> * </span></label>
                        <span class="help">e.g. "(###) ### - ####"</span>
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false, 'placeholder' => '###-###-####','class' => 'form-control','tabindex'=>'16','maxlength' => 55));?>   
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
                       <label>BRE Brooker</label>
                       
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                            <?php $radioOption = array('1' =>'Yes','0' =>'No');
          echo $this->Form->radio('UserDetail.license_number',$radioOption,array('legend' => false,'label'=>false,'class' => '','tabindex'=>'20','hiddenField' =>false,'style'=> "margin-left:12px"));?>
                        </div>
                     </div>
                     <div class="col-md-6">
                         <label>BRE License Number</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.bre_license_number',array('label' => false,'div' => false, 'placeholder' => 'BRE License','class' => 'form-control','tabindex'=>'20','maxlength' => 55));?>
                        </div>
                     </div>
                  </div>
                  <div class="row form-row">
                     <div class="col-md-6">
                      <label>Amount of Loans Outstanding</label>
                       
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                          <?php echo $this->Form->input('UserDetail.loan_amount_outstanding',array('label' => false,'div' => false, 'placeholder' => 'Amount of Loans Outstanding','class' => 'form-control','tabindex'=>'21','maxlength' => 55));?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label>Years of Trust Deed Lending</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.trust_deed_lending_year',array('label' => false,'div' => false, 'placeholder' => 'Years of Trust Deed Lending','class' => 'form-control','type'=>'text','tabindex'=>'18','maxlength' => 55,'id'=>"lendingYear"));?>
                        </div>
                     </div>
                  </div>
                    <div class="row form-row">
                     <div class="col-md-6">
                      <label>Preferred Counties</label>
                       
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                          <?php echo $this->Form->input('UserDetail.counties',array('label' => false,'div' => false, 'placeholder' => 'Preferred Counties','class' => 'form-control','tabindex'=>'21','maxlength' => 55));?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label>Lending Profile</label>
                      
                        <div class="input-with-icon  right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.lending_profile',array('label' => false,'div' => false, 'placeholder' => 'Lending Profile','type'=>'textarea','tabindex'=>'18','class' => 'form-control'));?>
                        </div>
                     </div>
                  </div>
                  
              </div>   
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