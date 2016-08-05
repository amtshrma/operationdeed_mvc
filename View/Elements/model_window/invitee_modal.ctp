<script>
    jQuery(document).ready(function(){
    // on click check for validation
	$('.submitButton').click(function(){
		re = 0;
		var pattern = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		var emailAddress = $('#emailAddress').val();
		// textbox
		
        
        if(jQuery('#emailAddress').val() == ''){
            jQuery(this).addClass('validationError')
            re = 1;
        }else if(jQuery('#emailAddress').val() != ''){
            if(pattern.test(emailAddress) == false){
                jQuery(this).addClass('validationError')
                re = 1;
            }
        }
		
		// check for final errors
		if(re){
			jQuery('div#flashMessage1').show().text('Please fill valid email address.');
			//jQuery("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		}else{
			return true;
		}
	});
	
    }); 
</script>
<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Invite Member</h4>
</div>
<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
<?php echo $this->Form->create('TeamMember', array('url'=>array('controller'=>'commons','action'=>'send_invitee'),'id'=>'inviteMemberForm'));?> 
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="row">
            <div class="col-md-8">
                <?php echo $this->Form->input('userType',array('class'=>'input form-control','type'=>'hidden','value'=>$userType)); 
                     echo $this->Form->input('userID',array('class'=>'input form-control','type'=>'hidden','value'=>$userID)); ?>
                    <label class="control-label">Please fill invitee email address</label>  
                     <?php echo $this->Form->input('emailAddress',array('class'=>'input form-control','label'=>false,'id'=>'emailAddress')); ?>
                
            </div>
        </div>  
    </div>
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit('save',array('div'=>false,'class'=>'btn btn-primary','style'=>'padding:5px;','class'=>'submitButton')); ?>
</div>
 <?php echo $this->Form->end();  ?>
<!-- Modal End -->