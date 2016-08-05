<?php
echo $this->Html->css('bootstrap-datepicker/datepicker');
?>
<div class="section first">
<div class=" p-b-60">
<div class="section dark-grey p-t-20  p-b-20 m-b-50">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Register</h2>
      </div>
      
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="container">
  <div class="row login-container column-seperation">  
    <div class="col-lg-12">    
        <?php
            echo $this->Form->create('User', array('id'=>'registerForm','type' => 'file','style'=>''));
            echo $this->Form->hidden('', array('value'=>count($legalDocuments),'id'=>'legalDocumentCount'));
           ?>
        <div class="row column-seperation">
           <div class="col-md-6">
                <h4>Basic Information</h4>            
                  <div class="form-group">
                     <label class="form-label">First Name<span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','type' => 'text','maxlength' => 25,'tabindex'=>'1'));?>    
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Last Name<span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','type' => 'text','maxlength' => 25,'tabindex'=>'2'));?>                                 
                     </div>
                  </div>
                 <div class="form-group">
                     <label class="form-label">User Type<span class="required"> * </span></label>
                     
                     <div class="input-with-icon  right smallInput">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.user_type',array('label' => false,'div' => false, 'placeholder' => 'User Type','class' => 'form-control','options'=>$userTypes,'tabindex'=>'3','id'=>'userType'));?>                               
                     </div>
                  </div>
                 <div class="form-group">
                     <label class="form-label">Email Address<span class="required"> * </span></label>
                     <span class="help">e.g. "email@address.com"</span>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','type' => 'text','tabindex'=>'4'));?>                                 
                     </div>
                </div>
                <div class="form-group">
                     <label class="form-label">Password<span class="required"> * </span></label>

                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                          <?php echo $this->Form->input('User.password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 20,'tabindex'=>'5'));?>                                 
                     </div>
                </div>
                <div class="form-group">
                     <label class="form-label">Confirm Password<span class="required"> * </span></label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('User.confirm_password',array('label' => false,'div' => false, 'placeholder' => 'Confirm Password','class' => 'form-control','type' => 'password','maxlength' => 20,'tabindex'=>'6'));?>                                 
                     </div>
                </div>
                <div class="form-group">
                     <label class="form-label">Company Name <span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                          <?php echo $this->Form->input('UserDetail.company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control','type' => 'text','maxlength' => 30,'tabindex'=>'7','value'=>'None'));?>                                 
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Company Position<span class="required"> * </span></label>
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.company_position',array('label' => false,'div' => false, 'placeholder' => 'Company Position','class' => 'form-control','type' => 'text','maxlength' => 30,'tabindex'=>'8','value'=>'None'));?>                                 
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Birthday</label>
                     <div class="input-with-icon smallInput">                                 
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.date_of_birth',array('label' => false,'div' => false, 'placeholder' => 'Birthday','class' => 'form-control','id'=>'dateOfBirth','type' => 'text','tabindex'=>'9'));?>
                          <span  style="display: none;" class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                     </div>
                  </div>
                   <div class="form-group">
                     <label class="form-label">Profile Picture</label>
                     <div class="">                                 
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.profile_pic',array('label' => false,'div' => false, 'placeholder' => 'Profile Picture','class' => '','type' => 'file','tabindex'=>'10'));?>
                        
                     </div>
                  </div>
              </div>
              <div class="col-md-6">
                <h4>Postal Information</h4>
                  <div class="form-group">
                     <label class="form-label">Mailing Address<span class="required"> * </span></label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                         <?php echo $this->Form->input('UserDetail.mailing_address',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address','class' => 'form-control','type' => 'textarea','tabindex'=>'11','rows'=>2));?>
                     </div>
                  </div>
                 <div class="form-group">
                     <label class="form-label">Mailing Address1</label>
                     
                     <div class="input-with-icon  right">                                       
                         <i class=""></i>
                       <?php echo $this->Form->input('UserDetail.mailing_address2',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address 2','class' => 'form-control','type' => 'text','tabindex'=>'12'));?>    
                     </div>
                  </div>
                   <div class="form-group">
                        <label class="form-label">State<span class="required"> * </span></label>
                        <div class="input-with-icon  right smallInput">                                       
                            <i class=""></i>
                           <?php echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'placeholder' => 'State','class' => 'form-control','options'=>$states,'tabindex'=>'13','id'=>'userStates'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">City<span class="required"> * </span></label>
                        <div class="input-with-icon  right smallInput">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.city',array('label' =>false,'div' => false, 'placeholder' => 'City','class' => 'form-control','tabindex'=>'14','options'=>'','id'=>'userCities'));?>   
                         </div>
                    </div>
                     <div class="form-group">
                        <label class="form-label">Zipcode<span class="required"> * </span></label>
                        <div class="input-with-icon  right smallInput">                                       
                            <i class=""></i>
                             <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','type' => 'text','maxlength' => 15,'tabindex'=>'15'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fax Number<span class="required"> * </span></label>
                        <div class="input-with-icon  right smallInput">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false, 'placeholder' => 'Fax Number','class' => 'form-control','type' => 'text','tabindex'=>'16'));?> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mobile Phone<span class="required"> * </span></label>
                        <span class="help">e.g. "(###) ### - ####" or "### ### - ####"</span>
                        <div class="input-with-icon  right smallInput">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false, 'placeholder' => 'Mobile Phone','class' => 'form-control','type' => 'text','tabindex'=>'17'));?>
                        </div>
                     </div>
                     <div class="form-group">
                       <label class="form-label">Office Phone</label>
                       <span class="help">e.g. "(###) ### - ####" </span>
                        <div class="input-with-icon  right smallInput">                                       
                            <i class=""></i>
                            <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => 'Office Phone','class' => 'form-control','type' => 'text','maxlength' => 15,'tabindex'=>'18'));?>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                     <?php echo $this->Form->input('register',array('label'=>false,'div' => false,'type '=> 'submit','class'=>'btn btn-primary btn-cons','name'=>'register-submit','value'=>'Register Now','id'=>'register-submit','tabindex'=>'24'));?>
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


<?php echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');?>
<script type="text/javascript">
jQuery(document).ready(function(){ 
    jQuery('#dateOfBirth').datepicker({
		format: "mm/dd/yyyy",
    });
});
</script>