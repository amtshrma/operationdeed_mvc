<div class="page-content"> 
    <div class="content">    
	<div class="page-title" style="display:none"> <a href="#" id="btn-back"><i class="icon-custom-left"></i></a>
        <h3>Back- <span class="semi-bold">Team Listing</span></h3>
     </div>		
    <div class="row"  id="inbox-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple" >
                   <div class="no-border email-body" >
                   <br>
                    <div class="row-fluid" >
                    <div class="row-fluid dataTables_wrapper">
						<div class="col-xs-4">
							<h2 class=" inline">Team Listing</h2>
						</div>
						<div class="col-xs-8" align="right">
				<?php
						echo $this->Html->link('Create new team', array('controller'=>'admins', 'action'=>'manage_team', base64_encode(base64_encode($userId))), array('class'=>'btn')); ?>
						</div>		       
						<div class="clearfix"></div>		       
                   </div>
		    <div class="col-xs-12">
			<?php echo $this->Session->flash(); ?>
		    </div>
          
        <div id="accordion">
			<?php
			if(!empty($arrTeam)) { 
				foreach($arrTeam as $team) { 
				?>
			<div class="col-sm-12">
				<div class="col-sm-11"><span><?php echo $team['Team']['team_funder']; ?></span></div>
				<div class="col-sm-1">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-edit"></i>', array('controller' =>'admins' , 'action' => 'manage_team', base64_encode(base64_encode($userId)), base64_encode(base64_encode($team['Team']['id']))), array("title"=>"Edit", 'alt'=>'Edit', 'class' =>'edit', 'escape' => false)); ?></div>
			</div>			
			<div class="col-sm-12">
				<?php
				$displayArr = array();
				if(isset($team['TeamMember']) && !empty($team['TeamMember'])) {
					
					foreach($team['TeamMember'] as $member) {
						
						if($member['status']=='1') {
							
							$memberType = $member['member_type'];
							$memberId = $member['team_member_id'];
							$displayArr[$memberType][] = $memberId;
						}
					}
				}
				
				if(!empty($displayArr)) {
					
					foreach($displayArr as $memberType=>$memberArr) {
						
						$memberName = $userTypes[$memberType];
						echo '<i class="fa fa-hand-o-right"></i> <strong>'.$memberName.'</strong>';
						
						foreach($memberArr as $memberId) {
							
							$arrUser = $this->Common->getUserDetail($memberId);
							$displayUser = !empty($arrUser)?$arrUser['User']['first_name'].' '.$arrUser['User']['last_name'].' - '.$arrUser['User']['email_address']:'';
							
							echo !empty($displayUser)?'<p><i class="fa fa-male"></i> '.$displayUser.'</p>':'';
						}
					}
				} ?>
			</div>
			
			<?php }
			} else { ?>
				<h3>Click above button "Create a team" for Team Assignment.</h3>
			<?php } ?>
		</div>
		</div>							
	    </div>
	    </div>	
        </div>
        </div>
        </div>	
    </div>
		
  </div>
  
  <!-- END PAGE --> 
</div>
 <script>
$(function() {
	$( "#accordion" ).accordion();
	$( ".sub-accordion" ).accordion();
	$(".edit").click(function(){
		
		window.location.href=this.href;
	});
});
</script>