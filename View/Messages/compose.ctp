<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3>Compose Message</h3><hr />
		<?php echo $this->Session->flash();?>
		<div class="row">
            <div class="col-md-3">
                <ul class="sidebar-nav tabNav">
                    <li>
                        <?php echo $this->Html->link('Inbox',array('controller'=>'messages', 'action'=>'index'),array('escape' => false,'title' => 'Sent Messages','class'=>'inboxMesages')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Sent Messages',array('controller'=>'messages', 'action'=>'sent'),array('escape' => false,'title' => 'Sent Messages','class'=>'sentMesages')); ?>
                    </li>
                    <li class="active">
                        <?php echo $this->Html->link('Compose',array('controller'=>'messages', 'action'=>'compose'),array('escape' => false,'title' => 'Compose','class'=>'composeMesages')); ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
				<?php echo $this->Form->create('Message', array('novalidate' => true));?>
					<div class="form-group col-md-6">
						<label class="form-label">To</label>
						<div class="controls">
							<?php
							echo $this->Form->input('receiver',array('label' => false,'div' => false, 'empty' => 'User Type - Name','class' => 'form-control','empty' => 'Select One','id'=>'usersList'));
							echo $this->Form->hidden('receiver_id',array('type'=>'text','id' => 'receiver_id'));
							?> 
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="form-label">Internal / External E-Mail</label>
						<div style="padding: 10px;" class="controls">
							<label class="radio-inline"><input type="radio" name="data[Message][email_type]" checked="checked" value="1"><b>Internal E-Mail</b></label>
							<label class="radio-inline"><input type="radio" name="data[Message][email_type]" value="2"><b>External E-Mail</b></label>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="form-label">Subject</label>
						<div class="controls">
							<?php echo $this->Form->input('subject',array('label' => false,'div' => false, 'Subject' => 'City','class' => 'form-control','maxlength' =>100));?>    
						</div>
					</div>
					<div style="background: rgb(233, 233, 233);" class="form-group col-md-12">
						<?php echo $this->Form->input('message',array('label' => false,'div' => false,'class' => 'form-control','id'=>'text-editor','rows'=>'25'));?>
					</div>
					<div class="col-md-2 col-md-offset-10">
						<?php echo $this->Form->button('<i class="icon-envelope"></i> Send Message', array('type' => 'submit','class' => 'btn btn-primary btn-cons btn-add','escape'=>false)); ?>
					</div>
				<?php echo $this->Form->end();?>
            </div>
        </div>
	</div>
</div>
<?php
echo $this->Element('fronts/loader');
echo $this->Html->script('bootstrap-wysihtml5/wysihtml5-0.3.0');
echo $this->Html->script('bootstrap-wysihtml5/bootstrap-wysihtml5');
// get users list
$usersList = '';
foreach($allUsers as $key=>$user){
	if($user['User']['id'] == $this->Session->read('userInfo.id')){
		continue;
	}
	if($user['User']['user_type'] == ADMIN_USER_TYPE) {
		$userType = 'Admin';
	}else {
		$userType = $userTypes[$user['User']['user_type']];
	}
	$usersList .= '{ value: "'.$user['User']['id'].'", label: "'.$userType .' - '.$user['User']['name'].'" },';
}
?>
<script>
jQuery(document).ready(function() {
    jQuery('#text-editor').wysihtml5();	
  	jQuery("#quick-access").css("bottom","0px");		
});		
</script>
<?php echo $this->Html->css('bootstrap-wysihtml5/bootstrap-wysihtml5');?>
<style>
	ul.tabNav{
		width: auto;
	}
    ul.tabNav li{
        line-height: 50px;
    }
    ul.tabNav li a{
        background: #334148;
        color: #fff;
        border: none;
    }
    ul.tabNav li a:hover{
        background: #333;
        color: #eee;
    }
    .table-responsive{
        min-height: 200px;
    }
    ul.tabNav li.active a{
        background: #eee;
        color: #000;
    }
	div.table-responsive{
		padding: 0px 20px;
	}
</style>
<script>
    var data = [<?php echo $usersList;?>];
    jQuery(function() {
        jQuery("#usersList").autocomplete({
            source: data,
			minLength : 2,
            focus: function(event, ui) {
                // prevent autocomplete from updating the textbox
                event.preventDefault();
                // manually update the textbox
                jQuery(this).val(ui.item.label);
            },
            select: function(event, ui) {
                event.preventDefault();
                // manually update the textbox and hidden field
                jQuery(this).val(ui.item.label);
                jQuery('#receiver_id').val(ui.item.value);
			}
        });
    });
</script>