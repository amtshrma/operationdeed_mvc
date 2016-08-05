 <div class="page-content">
 <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li>
        <?php echo $this->Html->link('Short App', array('controller'=>'commons','action'=>'Short App'),array('class'=>'active'));?>
        </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3><span class="semi-bold">My Hierarchy</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-body no-border">          
            <div class="row">
               <div class="col-md-12"></div>
               <?php
               if(!empty($team)) {
                    //pr($team);
                    foreach($team as $arrTeam) { 
                         
                         ?>
                         <div class="col-md-12">
                              <h2><?php
                              
                              $userTypeId = $arrTeam['User']['user_type'];
                              $userType = $userTypes[$userTypeId];
                              
                              echo $arrTeam['Team']['team_funder'];
                              
                              $heref = '';
                              $titlef = '';
                              if($userId==$arrTeam['User']['id']) { $heref = 'error'; $titlef = 'You are here in hierarchy.'; }
                             ?></h2>                         
                         </div>
                         <div class="col-md-12 member-title <?php echo $heref; ?>" title="<?php echo $titlef; ?>">
                         <?php
                         echo ucfirst($userType).' : '.ucfirst($arrTeam['User']['first_name']).' '.ucfirst($arrTeam['User']['last_name']).' - '.$arrTeam['User']['email_address'];; ?></div>
                         <div class="col-md-12">
                         <?php
                         if(isset($arrTeam['TeamMember']) && !empty($arrTeam['TeamMember'])) {
                              
                              foreach($arrTeam['TeamMember'] as $member) {
                                   
                                   if(!empty($member['User']['id'])) {
                                        
                                        $memberTypeId = $member['User']['user_type'];
                                        $memberType = $userTypes[$memberTypeId];
                                        $memberUserId = $member['User']['id'];
                                        $memberFName = $member['User']['first_name'];
                                        $memberLName = $member['User']['last_name'];
                                        $memberEmail = $member['User']['email_address'];
                                        
                                        $arrMembers[$memberType][$memberUserId] = ucfirst($memberFName).' '.ucfirst($memberLName).' - '.$memberEmail;
                                   }
                              }
                         }
                         ?>
                         
                         <?php //Team Members
                         if(!empty($arrMembers)) {
                              
                              foreach($arrMembers as $mType=>$memberArr) {
                                   
                                   ?>
                                   <div class="col-md-12 member-title"><?php echo $mType; ?></div>
                                   <?php
                                   if(!empty($memberArr)) {
                                        
                                        foreach($memberArr as $muid => $m) {
                                             $here = '';
                                             $title = '';
                                             if($userId==$muid) { $here = 'error'; $title = 'You are here in hierarchy.'; }
                                             ?>
                                             <div class="col-md-5 input-div-border member-div" title="<?php echo $title; ?>">
                                                  <div class="input-div-margin <?php echo $here; ?>"><?php echo $m; ?></div>
                                             </div>
                                             <?php
                                        }
                                   }
                              }
                         }
                         ?>
                         </div>
                         <?php                    
                    }
               } else {
                    
                    echo '<div class="col-md-12 member-title error">'.HIRARCHY_NOT_FOUND.'</div>';
               }
               ?>
            </div>
            <hr/>
            
            <div class="form-actions">
               <div class="pull-left"></div>
               <div class="col-md-6 col-md-offset-3">
                 <?php //echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-danger btn-cons')); ?>
               </div>
          </div>
          
          </div>
        </div>
      </div>
    </div>
 </div>
</div>