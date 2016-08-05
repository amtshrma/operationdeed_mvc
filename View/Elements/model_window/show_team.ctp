<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?php echo isset($modelHeader)?$modelHeader:'Modal Header'; ?></h4>
</div>

<div class="modal-body">
  <?php
  if(!empty($arrTeam)) {    
    
    echo '<h3>';
    echo $teamName = $arrTeam['Team']['team_funder'];
    echo '</h3>';
    echo '<h4>Funder : ';
    echo !empty($arrTeam)?ucfirst($arrTeam['User']['first_name']).' '.ucfirst($arrTeam['User']['last_name']).' - '.$arrTeam['User']['email_address']:'';
    echo '</h4>';
    
    if(isset($arrTeam['TeamMember']) && !empty($arrTeam['TeamMember'])) {
      
      foreach($arrTeam['TeamMember'] as $teamMember) {
        
        if($teamMember['status']=='1') {
          
          $userType = $teamMember['member_type'];
          $memberType = !empty($userType)?$userTypes[$userType]:'';
          $member = $this->Common->getUserDetail($teamMember['team_member_id']);
          $memberName = !empty($member)?ucfirst($member['User']['first_name']).' '.ucfirst($member['User']['last_name']).' - '.$member['User']['email_address']:'';
          $teamMemberArr[$memberType][] = $memberName;
        }
      }
    }
    
    if(!empty($teamMemberArr)) {
      echo '<div class="row col-md-12" style="margin-top:20px;">';
      foreach($teamMemberArr as $key=>$val) {
        
        echo '<div class="row col-md-12" style="margin-top:10px;"><strong>'.$key.'</strong>';echo '</div>';
        foreach($val as $user) {
          echo '<div class="col-md-5" style="margin-left:20px;margin-top:10px;border: 1px dotted #6f7b8a;">';
            echo '<div class="input-div-margin">'.$user.'</div>';
          echo '</div>';
        }
        
      }
      echo '</div>';
    }
  }
  ?>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
<!-- Modal End -->