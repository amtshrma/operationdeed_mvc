<?php
echo $this->Html->script('admin/admin_user');
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'),'id'=>'registerForm','type' => 'file','novalidate' => true));            
echo $this->Form->hidden('User.id',array('value'=>base64_encode($this->data['User']['id']),'id'=>'userID'));
echo $this->Form->hidden('UserDetail.id',array('value'=>base64_encode($this->data['UserDetail']['id']),'id'=>'userDetailID'));
?>
<div class="row padding_btm_20">
   <label class="brand_div"><?php echo $action; ?> User</label>    
</div>
<div id="busy-indicator"></div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>First Name<span class="required"> * </span></label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','tabindex'=>'1','maxlength' => 55));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group"> 
      <div class="col-lg-3 form-label">
          <label>Last Name<span class="required"> * </span></label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','tabindex'=>'2','maxlength' => 55));?>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>User Type<span class="required"> * </span></label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('User.user_type',array('label' => false,'div' => false, 'empty' => 'User Type','class' => 'form-control','options'=>$userTypes, 'empty' => 'Select One','tabindex'=>'3','maxlength' => 55));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>Email Address<span class="required"> * </span></label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('User.email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','tabindex'=>'4','maxlength' => 55));?>
      </div>
   </div>
</div>
<!--div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Password<span class="required"> * </span></label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type'=>'password','tabindex'=>'5','maxlength' => 55));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>Confirm Password<span class="required"> * </span></label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('confirm_password',array('label' => false,'div' => false, 'placeholder' => 'Confirm Password','class' => 'form-control','type'=>'password','tabindex'=>'6','maxlength' => 55));?>
      </div>
   </div>
</div-->
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Company Name<span class="required"> * </span></label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control','tabindex'=>'7','maxlength' => 55));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>Company Position<span class="required"> * </span></label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('UserDetail.company_position',array('label' => false,'div' => false, 'placeholder' => 'Company Position','class' => 'form-control','tabindex'=>'8','maxlength' => 55));?>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Mailing Address<span class="required"> * </span></label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.mailing_address',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address1','class' => 'form-control','tabindex'=>'9','type'=>'textarea','maxlength' => 100));?>
     </div>   
   </div>
   <div class="col-lg-6">
       <div class="form-group form-spacing">
           <div class="col-lg-3 form-label">
               <label>Mailing Address2</label>
           </div>
           <div class="col-lg-7 form-box">                
               <?php echo $this->Form->input('UserDetail.mailing_address2',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address2','class' => 'form-control','type'=>'textarea','tabindex'=>'10','maxlength' => 100));?>
           </div>
       </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>State<span class="required"> * </span></label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'empty' => 'State','class' => 'form-control','options'=>$states,'tabindex'=>'11', 'empty' => 'Select One'));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>City<span class="required"> * </span></label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('UserDetail.city',array('label' => false,'div' => false, 'placeholder' => 'City','class' => 'form-control','tabindex'=>'12','maxlength' =>100));?>
      </div>  
   </div>
</div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Zipcode<span class="required"> * </span></label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','tabindex'=>'13','maxlength' => 55));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>Office Phone</label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => 'Office Phone','class' => 'form-control','tabindex'=>'14','maxlength' => 55));?>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Mobile Phone<span class="required"> * </span></label><br/>
         <sub class="blue">###-###-#### </sub> <br/><sub class="blue">(###) ### - ####</sub>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false, 'placeholder' => '###-###-####','class' => 'form-control','tabindex'=>'15','maxlength' => 55));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>Fax Number<span class="required"> * </span></label><br/>
          <sub class="blue">(###) ### - ####</sub>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false, 'placeholder' => '###-###-####','class' => 'form-control','tabindex'=>'16','maxlength' => 55));?>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Birthday</label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.date_of_birth', array('type' => 'date','label' => false,'dateFormat' => 'MDY', 'empty' => 'Select','minYear' => date('Y')-100,'maxYear' => date('Y'), 'options' => array('1','2'),'tabindex'=>'17'));
 ?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>Profile Picture</label>
      </div>
      <div class="col-lg-7">                
          <?php echo $this->Form->input('UserDetail.profile_pic',array('label' => false,'div' => false, 'placeholder' => 'Profile Picture','type'=>'file','tabindex'=>'18','class' => '','maxlength' => 55));?>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Employer Licence Type</label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.employer_licence_type',array('label' => false,'div' => false,'options'=>$licenceTypes,'class' => 'form-control','tabindex'=>'19','maxlength' => 55,'id'=>'employerLicenceType'));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group" id = "BRELiceneRow" style="display:block;">
      <div class="col-lg-3 form-label">
          <label>BRE License</label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('UserDetail.bre_license_number',array('label' => false,'div' => false, 'placeholder' => 'BRE License','class' => 'form-control','tabindex'=>'20','maxlength' => 55));?>
      </div>  
   </div>
   <div class="col-lg-6 form-group" id = "CFLLiceneRow" style="display:none;">
      <div class="col-lg-3 form-label">
          <label>CFL License<span class="required"> * </span></label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('UserDetail.cfl_license_number',array('label' => false,'div' => false, 'placeholder' => 'CFL License','class' => 'form-control','tabindex'=>'20','maxlength' => 55));?>
      </div>  
   </div>
</div>

<div class="row">
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
         <label>Referred By</label>
     </div>
     <div class="col-lg-7 form-box">                
         <?php echo $this->Form->input('UserDetail.referred_by',array('label' => false,'div' => false, 'empty' => 'Referred By','options'=>$referredBy,'class' => 'form-control','tabindex'=>'19','id' =>'referredByUserType'));?>
     </div>   
   </div>
   <div class="col-lg-6 form-group">
      <div class="col-lg-3 form-label">
          <label>Select User</label>
      </div>
      <div class="col-lg-7 form-box">                
          <?php echo $this->Form->input('UserDetail.referred_by_user_id',array('label' => false,'div' => false, 'empty' => 'Select One','class' => 'form-control', 'options'=>$users,'tabindex'=>'20','maxlength' => 55));?>
      </div>  
   </div>
  
</div>
<div class="col-lg-12 form-spacing">&nbsp;</div>
<div class="col-lg-12">
    <div class="col-lg-12">
        <div class="col-lg-4">
          <!--blank div-->
        </div>
        <div class="col-lg-8 form-box">
            <?php echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-default','tabindex'=>'21'));?>
             &nbsp;
            <?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'btn btn-default','tabindex'=>'20'));?> 
        </div>
    </div>     
</div>
<div class="col-lg-12 form-spacing">&nbsp;</div>
<?php echo $this->Form->end(); ?>

