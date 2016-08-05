<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1>Short Application</h1>
            <br>
            <div class="wizard-container">
                <div data-step="1" class="wizard-step-active"><span class="wizard-badge-active">1</span><div class="step-number-active">Step 1</div></div>
                <div data-step="2" class="wizard-step"><span class="wizard-badge">2</span><div class="step-number">Step 2</div></div>
                <div data-step="3" class="wizard-step"><span class="wizard-badge">3</span><div class="step-number">Step 3</div></div>
                <div data-step="4" class="wizard-step"><span class="wizard-badge">4</span><div class="step-number">Step 4</div></div>
                <div data-step="5" class="wizard-step"><span class="wizard-badge">5</span><div class="step-number">Step 5</div></div>
                <div style="clear:both"></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Step 1 - Select your Broker</h3>
                    <br />
                    <center>
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('broker_name',array('label' => false,'div' => false, 'empty' => 'Broker Name','class' => 'form-control placeholder','id'=>'brokerID','style' => 'width:50%;float:none'));
                            echo $this->Form->hidden('broker_ID',array('id'=>'brokerIDD'));
                        ?>
                    </div>
                    <div style="clear: both"></div>
                    <div style="display: none;" class="form-group brookerInfoRow">
                        <div class="col-lg-4">
                            <label>First Name</label>
                            <?php echo $this->Form->input('first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'brokerFirstName','readonly'=>'readonly'));?>
                        </div>
                        <div class="col-lg-4">
                            <label>Last Name</label>
                            <?php echo $this->Form->input('last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','type' => 'text','maxlength' => 50,'id'=>'brokerLastName','readonly'=>'readonly'));?>
                        </div> 
                        <div class="col-lg-4">
                            <label>Email Address</label>
                            <?php echo $this->Form->input('email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control','type' => 'text','maxlength' => 100,'id'=>'brokerEmailID','readonly'=>'readonly'));?>
                        </div>
                    </div>
                    <div style="display: none;" class="defaultRow">
                        <div class="col-lg-4">
                            <label>Broker</label>
                            <?php echo $this->Form->input('default_broker',array('label' => false,'div' => false, 'placeholder' => 'Rockland','class' => 'form-control','readonly'=>'readonly','type' => 'text','maxlength' => 50,'value'=>'Rockland Assigned Broker'));?>
                        </div> 
                    </div>
                    <div style="clear: both"></div>
                    <br>				
                    * If you are already a registered Broker in Operation Trust Deed, please select a Broker, or else select No Broker.
                    </center>
                    <br>
                    <span class="redText">Note : * All fields are required to move on to next step.</span>
                </div>
                <!-- /.panel-body -->
            </div>
            <div class="buttons">
    
            <table border="0" width="100%">
            <tr>
            <td align="left"></td>
            <td align="right"><?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Next',array('class'=>'btn btn-lg btn-primary sumitButton','title'=>'step2','type'=>'submit','escape'=>false));?></td>
            </tr>
            </table>
            <br>
            </div>
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<?php
$brokersString = '';
foreach($brokers as $key=>$val){
	$brokersString .= '{ value: "'.$key.'", label: "'.$val.'" },';
}
echo $brokersString;
?>
<style>
    div.error-message{
        float: none;
    }
    .ui-widget-content{
        background: #324047;
        color: #fff;
    }
</style>
<script>
    var data = [<?php echo $brokersString;?>];
    jQuery(function() {
        jQuery("#brokerID").autocomplete({
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
				if(ui.item.value == 'none'){
					jQuery('.brookerInfoRow').hide();
					jQuery('.defaultRow').show();
                    jQuery('#brokerIDD').val('Rockland');
				}else {
                    jQuery('#brokerIDD').val(ui.item.value);
					var URL = BASE_URL+"users/fetch_user_detail"; 
					jQuery.ajax({
						type: "POST",
						url: URL,
						data: "userID= " + ui.item.value,
						success: function(data){
							data = JSON.parse(data);
							jQuery.each(data, function(index, value) { 
								jQuery('#brokerFirstName').val(value.first_name);
								jQuery('#brokerLastName').val(value.last_name);
								jQuery('#brokerEmailID').val(value.email_address);
							});
							jQuery('.brookerInfoRow').show();
							jQuery('.defaultRow').hide();
						}
					});
				}
			}	
        });
    });
</script>
<?php echo $this->Element('fronts/loader');?>