<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
		<span class="pull-right">
				<?php if(!empty($data['User']) && $data['User']['user_type'] == 3) {
				echo $this->Html->link('<button class="btn btn-lg btn-primary" type="submit"><span class="glyphicon" style="color:#8ecaf9"></span>Invite Broker</button>','javascript:void(0);',array('escape' => false,'title' => 'Invite Broker','id'=>base64_encode(2),'style'=>'padding:10px;','class'=>'pull-right inviteMember'));
			}else if(!empty($data['User']) && $data['User']['user_type'] == 4) {
				echo $this->Html->link('<button class="btn btn-lg btn-primary" type="submit"><span class="glyphicon" style="color:#8ecaf9"></span>Invite Broker</button>','javascript:void(0);',array('escape' => false,'title' => 'Invite Broker','id'=>base64_encode(2),'style'=>'padding:10px;','class'=>'pull-right inviteMember'));
			   
				echo $this->Html->link('<button class="btn btn-lg btn-primary" type="submit"><span class="glyphicon" style="color:#8ecaf9"></span>Invite Sales Manager</button>','javascript:void(0);',array('escape' => false,'title' => 'Invite Sales Manager','id'=>base64_encode(3),'style'=>'padding:10px;','class'=>'pull-right inviteMember'));
				
			} ?>
		</span>
        <h3>My Account</h3><hr />
        <br />
		<?php echo $this->Session->flash();?>
        <?php
            echo $this->Form->create('User', array('url' => array('controller' => 'commons', 'action' => 'my_account'),'id'=>'registerForm','type' => 'file','novalidate' => true,'class'=>'form-no-horizontal-spacing'));            
            echo $this->Form->hidden('User.id',array('value'=>base64_encode($data['User']['id']),'id'=>'userID'));
            echo $this->Form->hidden('UserDetail.id',array('value'=>base64_encode($data['UserDetail']['id']),'id'=>'userDetailID'));
            echo $this->Form->hidden('UserDetail.user_id',array('value'=>base64_encode($data['User']['id'])));
            echo $this->Form->hidden('User.user_type',array('value'=>$data['User']['user_type'],'id'=>'userType'));
			echo $this->Form->hidden('UserDetail.old_profile_pic',array('value'=>$data['UserDetail']['profile_picture']));
        ?>
             <div class="row">
                <div class="">
                      <div class="col-lg-4">
                         <div class="input-with-icon  right">                                       
                             <i class=""></i>
                             <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','tabindex'=>'1','maxlength' => 55,'value'=>$data['User']['first_name'],'title'=>'First Name'));?>      
                         </div>
                      </div>
                      <div class="col-lg-4">
                         <div class="input-with-icon  right">                                       
                             <i class=""></i>
                             <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','tabindex'=>'2','maxlength' => 55,'value'=>$data['User']['last_name'],'title'=>'Last Name'));?>                                 
                         </div>
                      </div>
                     <div class="col-lg-4">
                         <div class="input-with-icon  right">                                       
                             <i class=""></i>
                             <?php echo $this->Form->input('User.email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','tabindex'=>'4','maxlength' => 55,'value'=>$data['User']['email_address'],'readonly'=>'readonly','title'=>'Email Address'));?>                                 
                         </div>
                      </div>
                        <div class="col-lg-4">
                         <div class="input-with-icon  right">                                       
                             <i class=""></i>
                             <?php echo $this->Form->input('UserDetail.company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control','tabindex'=>'5','maxlength' => 55,'value'=>$data['UserDetail']['company_name'],'title'=>'Company Name'));?>                                 
                         </div>
                      </div>
                      <div class="col-lg-4">
                         <div class="input-with-icon  right">                                       
                             <i class=""></i>
                             <?php echo $this->Form->input('UserDetail.company_position',array('label' => false,'div' => false, 'placeholder' => 'Company Position','class' => 'form-control','tabindex'=>'6','maxlength' => 55,'value'=>$data['UserDetail']['company_position'],'title'=>'Company Position'));?>                                 
                         </div>
                      </div>
                      <div class="col-lg-4">
                         <div class="input-with-icon">                                 
                             <i class=""></i>
                             <?php echo $this->Form->input('UserDetail.birthdate', array('type' => 'text','label' => false,'dateFormat' => 'MDY','div'=>false, 'id'=>"dateOfBirth",'tabindex'=>'7','class' => 'form-control','placeholder' => 'Date Of Birth','value'=>$data['UserDetail']['birthdate'],'title'=>'Birth Date')); ?>
                         </div>
                      </div>
                       <div class="col-lg-4">
                        <?php if(!empty($data['UserDetail']) && ($data['UserDetail']['profile_picture'] != '') && ($data['UserDetail']['profile_picture'] != 'defaultUser.jpg')) {
                            $image =  '<img src="'.BASE_URL.'img/profile_pics/original/'.$data['UserDetail']['profile_picture'].'" width="80px" height="80px"/>';
                        }else { 
                            $image =  '<img src="'.BASE_URL.'img/index.png" width="80px" height="80px">';
                        }?>
                            <div class="">
                                <?php
                                echo $image; 
                                echo $this->Form->input('UserDetail.profile_pic',array('label' => false,'div' => false, 'placeholder' => 'Profile Picture','type'=>'file','tabindex'=>'8','class' => '','title'=>'Profile Picture'));?>
                             </div>
                      </div>
                       
                        <div class="col-lg-4">
                           <div class="input-with-icon  right">                                       
                               <i class=""></i>
                               <?php echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'empty' => 'State','class' => 'form-control','options'=>$states,'tabindex'=>'11', 'empty' => 'Select One','value'=>$data['UserDetail']['state'],'id'=>'userStates','title'=>'State'));?>
                               <span id="userState" style="display: none;"><?php echo $data['UserDetail']['state'];?></span>
                           </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-with-icon  right">                                       
                             <i class=""></i>
                            <?php echo $this->Form->input('UserDetail.city',array('label' => false,'div' => false, 'empty' => 'Chose State First','class' => 'form-control','options'=>'','id'=>'userCities','value'=>$data['UserDetail']['city'],'id'=>'userCities'));?>
                            
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                 <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','tabindex'=>'13','maxlength' => 6,'value'=>$data['UserDetail']['zipcode'],'title'=>'Zipcode'));?>
                            </div>
                         </div>
                          <div class="col-lg-4">
                            <div class="input-with-icon  right">                                       
                             <i class=""></i>
                            <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false, 'placeholder' => '###-###-####','class' => 'form-control maskInput','tabindex'=>'14','value'=>$data['UserDetail']['fax_number'],'title'=>'Fax Number'));?>   
                            </div>
                         </div>
                         <div class="col-lg-4">
                            <div class="input-with-icon  right">                                       
                                <i class=""></i>
                                <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => 'Office Phone','class' => 'form-control maskInput','tabindex'=>'15','value'=>$data['UserDetail']['office_phone'],'title'=>'Office Phone'));?>    
                            </div>
                         </div>
                          <div class="col-lg-4">
                            <div class="input-with-icon  right">                                       
                             <i class=""></i>
                            <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false, 'placeholder' => '###-###-####','class' => 'form-control maskInput','tabindex'=>'16','value'=>$data['UserDetail']['mobile_phone'],'title'=>'Mobile Phone'));?>   
                            </div>
                         </div>
                        <div class="col-lg-4">
                         <div class="input-with-icon  right">                                       
                             <i class=""></i>
                             <?php echo $this->Form->input('UserDetail.mailing_address',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address1','class' => 'form-control','tabindex'=>'9','type'=>'text','maxlength' => 100,'value'=>$data['UserDetail']['mailing_address'],'style'=>'resize:none; ','title'=>'Mailing Address1'));?>   
                         </div>
                      </div>
                     <div class="col-lg-4">
                         <div class="input-with-icon  right">                                       
                             <i class=""></i>
                           <?php echo $this->Form->input('UserDetail.mailing_address2',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address2','class' => 'form-control','type'=>'text','maxlength' => 100,'value'=>$data['UserDetail']['mailing_address2'],'style'=>'resize:none;','title'=>'Mailing Address2'));?>     
                         </div>
                      </div>
                    <div class="col-lg-4">
                       <div class="input-with-icon  right">                                       
                           <i class=""></i>
                          <?php echo $this->Form->input('UserDetail.employer_licence_type',array('label' => false,'div' => false,'options'=>$licenceTypes,'class' => 'form-control','tabindex'=>'17','maxlength' => 55,'id'=>'employerLicenceType','value'=>$data['UserDetail']['employer_licence_type'],'title'=>'Employer Licence Type'));?>   
                       </div>
                    </div>
                     <?php
                     $style = 'style="display:block;"';
                     $cflStyle = 'style="display:none;"';
                      if(!empty($data['UserDetail']) && $data['UserDetail']['bre_license_number'] != '') { 
                        $style = 'style="display:block;"';
                        $cflStyle = 'style="display:none;"';
                     }elseif(!empty($data['UserDetail']) && $data['UserDetail']['cfl_license_number'] != '') { 
                        $style = 'style="display:none;"';
                        $cflStyle = 'style="display:block;"';
                     }
                     ?>
                    
                    <div class="col-lg-4" id = "BRELiceneRow" <?php echo $style; ?> >
                       <div class="input-with-icon  right">                                       
                        <i class=""></i>
                       <?php echo $this->Form->input('UserDetail.bre_license_number',array('label' => false,'div' => false, 'placeholder' => 'BRE License','class' => 'form-control','tabindex'=>'18','maxlength' => 7,'value'=>$data['UserDetail']['bre_license_number'],'title'=>'BRE License'));?>
                       </div>
                    </div>
                    <div class="col-lg-4" id = "CFLLiceneRow" <?php echo $cflStyle; ?> >
                       <div class="input-with-icon  right">                                       
                        <i class=""></i>
                      <?php echo $this->Form->input('UserDetail.cfl_license_number',array('label' => false,'div' => false, 'placeholder' => 'CFL License','class' => 'form-control','tabindex'=>'19','maxlength' => 7,'value'=>$data['UserDetail']['cfl_license_number'],'title'=>'CFL License'));?>
                       </div>
                    </div><br/>
             
             
                   <?php
                    if(count($data['UserDocument']) == 0){
                      $count = '1';
                    }else {
                      $count = count($data['UserDocument']);
                    } ?>
                 <?php echo $this->Html->link('Add Document','javascript:void(0)',array('class'=>'addFile','title'=>'Click to upload'));   ?>   <i class="">Click to add documents</i>     
                  <br/><br/>
                    <span id="agreementCount" style="display:none;"><?php echo $count; ?> </span>
                     <?php  //pr($data['UserDocument']);
                      if(count($data['UserDocument']) > 0) { ?>
                          <h3>Legal Agreement </h3> 
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Name</label>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Upload</label>
                                </div>
                                 <div class="col-md-4">
                                    <label class="form-label">Download</label>
                                </div>
                                 
                            </div>
                      <?php  foreach($data['UserDocument'] as $key=> $document) { //pr($document);
                            if(isset($document['file_name']) && $document['file_name'] != '') { ?>
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php
                                        echo $this->Form->input("UserDetail.agreement.$key.id",array('value'=>$document['id'],'type' => 'hidden'));
                                        echo $this->Form->input("UserDetail.agreement.$key.name",array('value'=>$document['document_name'],'type' => 'text','class'=>'form-control','label'=>false)); ?>
                                    </div>
                                 </div>
                                 <div  class="col-md-4">
                                 <?php if($document['status'] == 0) { ?>
                               
                                   <div class="input-with-icon  right">
                                    <i class=""></i>
                                    <?php 
                                    echo $this->Form->input('UserDetail.agreement.'.$key.'.userDocument',array('label' => false,'div' => false, 'class' => '','type' => 'file'));?>
                                   </div>
                                
                                <?php } else {
                                    echo "N/A";
                                }?>
                                </div>
                              
                                <div  class="col-md-4">
                                   <div class="input-with-icon  right">
                                    <i class=""></i>
                                    <?php 
                                   $fileName = explode('_',$document['file_name']);
                                    echo $this->Html->link($fileName[1], $this->Html->url( '/', true ).'app/webroot/user_document/'.$document['file_name'], array('class' => 'button','target'=>'_blank'));
                                   ?>
                                   </div>
                                </div>
                           </div>
                        <?php }
                      }
                   } ?>
                   <div id="addFileDiv"></div>
                </div>
            </div> 
             <div class="buttons">
                <table border="0" width="100%">
                    <tr>
                        <td align="right">
                         <?php echo $this->Form->button('<span class="glyphicon" style="color:#8ecaf9"></span>Update', array('type' => 'submit','class' =>'btn btn-lg btn-primary')); ?>
                        </td>
                    </tr>
                </table>
                <br><br>	
			</div>
    <?php echo $this->Form->end(); ?>
    </center>
    </div>
  </div>
  <!-- END PAGE --> 
<?php echo $this->Element('fronts/loader');?>