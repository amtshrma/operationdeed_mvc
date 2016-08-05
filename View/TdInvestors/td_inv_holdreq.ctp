<?php echo $this->Html->script('counter');
echo $this->Html->script('jquery.maskMoney.js');
?>
<script>
jQuery('document').ready(function(){
	jQuery('.maskIncome').maskMoney({allowZero:false, allowNegative:false, defaultZero:true});
});
</script>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h3>Trust Deed Investment Hold Requested</h3><hr />
		<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
		<?php
			echo $this->Form->create('LoanHoldRequest', array('novalidate' => true,'id'=>'trustDeedInvHoldReqForm','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data'));?>
		<div class="row">
		<div class="col-md-12">
			<?php 
            $holdReqId = !empty($holdReq['LoanHoldRequest']['id']) ? $holdReq['LoanHoldRequest']['id']:'';
            echo $this->Form->hidden('LoanHoldRequest.id',array('value' => base64_encode(base64_encode($holdReqId))));
			?>
			<div class="form-group col-md-4">
				<label>Investment Manager Referred by</label>
				<?php echo $this->Form->input('inv_manager_refby',array('label' => false, 'div' => false, 'empty' => 'Select One','class' => 'form-control noValidate', 'options' => $users)); ?>
			</div>                
            <div class="form-group col-md-4">
				<div class="form-group radio_btn">
				<label>Investor Type</label><br />
				<?php
				echo $this->Form->radio('investor_type', array('full_trust_deed'=>'Full Trust Deed', 'fractional_trust_deed'=>'Fractional Trust Deed'), array('legend'=>false, 'required'=>true,'legend' => false,'label'=>false,'class' => '','hiddenField' =>false,'style'=> "margin:6px", 'class'=>'investor_type', 'default'=>!empty($holdReq['LoanHoldRequest']['investor_type'])?$holdReq['LoanHoldRequest']['investor_type']:'')); ?>
					<div class="form-group invtype hide">
						<br />
						<div class="input-group">                        
						<?php
							$fractionalArray = array();
							$availableInvestment = $this->Common->getTotalHoldFractional($loanId);
							$message  = $availableInvestment .'% fractional investment is to be invested by other ';
							$availableInvestment = $this->Common->getTotalHoldFractional($loanId);
							for($ii = 1; $ii <= (100 - $availableInvestment)/10;$ii++){
								$fractionalArray[$ii*10] = $ii*10;
							}
							echo $this->Form->input('inv_type_fraction',array('label' => false,'div' => false, 'class' => 'form-control','options' => $fractionalArray,'empty'=>'Select One'));?>
							<span class="input-group-addon" style="padding:6px 8px;">%</span>
						</div>
						<span class="help"><?php echo $message;?></span>
					</div>
				</div>
            <?php /*} else { ?>
					<div class="form-group radio_btn">
					<label>Investor Type</label><br />
						<?php
						echo $this->Form->hidden('investor_type', array('value'=>'fractional_trust_deed')); ?>
						<span class="help"> Select Fractions that you want to invest</span>
						<div class="input-group">                        
							<?php
							$availableInvestment = $this->Common->getTotalHoldFractional($loanId);
							$message  = $availableInvestment .'% fractional investment is to be invested by other ';
							$disabled = $emptySelect = 'Select One';
							if(!empty($holdReq['LoanHoldRequest']['hold_by'])) {
								if($holdReq['LoanHoldRequest']['hold_by'] == $this->Session->read('userInfo.id')){
									if(!empty($holdReq['LoanHoldRequest']['inv_type_fraction'])) {
										$emptySelect = $holdReq['LoanHoldRequest']['inv_type_fraction'];
									}
									$message  = '';
									$disabled = 'true';
								}
							}
							echo $this->Form->hidden('available_fraction',array('value' =>$availableInvestment,'id' => 'hiddenFraction'));
							$fractionalArray = array();
							if($availableInvestment < 100){
								for($ii = 1; $ii <= (100 - $availableInvestment)/10;$ii++){
									$fractionalArray[$ii*10] = $ii*10;
								}
							}
							echo $this->Form->input('inv_type_fraction',array('label' => false,'div' => false, 'class' => 'form-control','empty'=>'Select One','options' => $fractionalArray ,'empty' =>$emptySelect, 'disabled'=>$disabled,'id' => 'fractionalSelectBox'));?>
							<span class="input-group-addon">%</span><br/>
						</div>
						<?php
							echo $message;
						?>
					</div>
                <?php }*/ ?>
            </div>

			<div class="form-group col-md-4">
				<label>Fractional Requested Standby Hold</label>
				<div class="radio_btn">
				<?php
				echo $this->Form->radio('fr_req_hold', array('1'=>'1-week', '2'=>'2-weeks', '3'=>'3-weeks'), array('legend'=>false, 'required'=>true, 'legend' => false,'label'=>false,'class' => '','hiddenField' =>false,'style'=> "margin:12px",'default'=>!empty($holdReq['LoanHoldRequest']['fr_req_hold'])?$holdReq['LoanHoldRequest']['fr_req_hold']:'')); ?>
				</div>
				<span class="radio_btn_error"></span>
			</div>
		</div><hr />
		<div class="col-md-12">
			<div class="form-group col-md-4">
				<label>48-hour Hold Requested (Full Only)</label>
				<div class="radio_btn">
				<?php                    
				echo $this->Form->radio('hrs_hold_req', array('1'=>'Yes', '0'=>'No'), array('legend'=>false, 'required'=>true,'legend' => false,'label'=>false,'class' => '','hiddenField' =>false,'style'=> "margin:12px", 'default'=>isset($holdReq['LoanHoldRequest']['hrs_hold_req'])?$holdReq['LoanHoldRequest']['hrs_hold_req']:'')); ?>
				</div>
				<span class="radio_btn_error"></span>
			</div>
			<div class="form-group col-md-4">
				<label>Needed Yield Requested To Hold</label>
				<div class="input-group">                        
					<?php echo $this->Form->input('yld_req_tohold', array('label' => false,'div' => false, 'class' => 'form-control form-control-short', 'id'=>'yld_req_tohold', 'value'=>!empty($holdReq['LoanHoldRequest']['yld_req_tohold'])?$holdReq['LoanHoldRequest']['yld_req_tohold']:''));?>
					
				</div>
				<span class="err_yld_req_tohold"></span>
			</div>
			<div class="form-group col-md-4">
				<label>Needed Term Requested To Hold</label>
				 <div class="input-group">   
					<?php echo $this->Form->input('term_req_tohold',array('label' => false,'div' => false, 'placeholder' => '','class' => 'form-control form-control-short', 'value'=>!empty($holdReq['LoanHoldRequest']['term_req_tohold'])?$holdReq['LoanHoldRequest']['term_req_tohold']:''));?>
				 </div>
			</div>
		</div><hr />
		<div class="col-md-12">
			<div class="form-group col-md-4">
				<label>Needed Loan Amount Requested To Hold</label>
				<div class="col-sm-12 input-group">
					<span class="input-group-addon">$</span>
					<?php echo $this->Form->input('loanamt_req_tohold',array('label' => false,'div' => false, 'placeholder' => '','type'=>'text','class' => 'maskIncome form-control form-control-short', 'id'=>'loanamt_req_tohold', 'value'=>!empty($holdReq['LoanHoldRequest']['loanamt_req_tohold'])?$holdReq['LoanHoldRequest']['loanamt_req_tohold']:'')); ?>
				</div>
				<span class="err_loanamt_req_tohold"></span>
			</div>    
			<div class="form-group col-md-4">
				<label>Back-up Hold Requested (Order Received)</label>
				<div class="radio_btn">
				<?php
				echo $this->Form->radio('bkup_hold_req', array('1'=>'1st', '2'=>'2nd', '3'=>'3rd', 'wf'=>'Willing to Fractional'), array('legend'=>false, 'required'=>true,'legend' => false,'label'=>false,'class' => '','hiddenField' =>false,'style'=> "margin:12px", 'default'=>!empty($holdReq['LoanHoldRequest']['bkup_hold_req'])?$holdReq['LoanHoldRequest']['bkup_hold_req']:'')); ?>
				</div>
			</div>
            <div class="form-group col-md-4">
				<label>Requesting Access to Full Loan File</label>
				<div class="radio_btn">
				<?php
				echo $this->Form->radio('req_access_flf', array('1'=>'Yes', '0'=>'No'), array('legend'=>false, 'required'=>true,'legend' => false,'label'=>false,'class' => '','hiddenField' =>false,'style'=> "margin:12px", 'default'=>isset($holdReq['LoanHoldRequest']['req_access_flf'])?$holdReq['LoanHoldRequest']['req_access_flf']:'')); ?>
				</div>
            </div>
		</div><hr />
		<div class="col-md-12">
            <div class="form-group col-md-4">
                <label>Additional Documentation Needed?</label>
				<div class="form-group">
				<?php
				echo $this->Form->radio('add_doc_need', array('1'=>'Yes', '0'=>'No'), array('legend'=>false, 'required'=>true, 'placeholder'=>'Additional Documentation', 'legend' => false,'label'=>false,'class' => 'document_needed','hiddenField' =>false,'style'=> "margin:12px",'default'=>isset($holdReq['LoanHoldRequest']['add_doc_need'])?$holdReq['LoanHoldRequest']['add_doc_need']:'')); ?>
				</div>
            </div>
            <div class="form-group col-md-4">
				<label>Commiting to fund within Days of Full File</label>
				<div class="radio_btn">
				<?php
				echo $this->Form->radio('file_fund_days', array('1'=>'1-day', '2'=>'2-days', '3'=>'3-days'), array('legend'=>false, 'required'=>true, 'legend' => false,'label'=>false,'class' => '','hiddenField' =>false,'style'=> "margin:12px",'default'=>!empty($holdReq['LoanHoldRequest']['file_fund_days'])?$holdReq['LoanHoldRequest']['file_fund_days']:'')); ?>
				</div>
            </div>
		</div><hr />
            <?php
            $display = '';
            if(!empty($holdReq) && $holdReq['LoanHoldRequest']['documentation']){
                $display = "hide";
            }
            ?>
            <div class="col-md-12 additional_documentation" <?php echo $display; ?>>
                <div class="form-group col-md-4">
					<label><strong>Notes : </strong></label>
					<div class="input-group">                        
                        <?php echo $this->Form->input('documentation', array('rows'=>'3','label' => false,'div' => false, 'class' => 'form-control form-control', 'style' =>'resize :none','value'=>!empty($holdReq['LoanHoldRequest']['documentation'])?$holdReq['LoanHoldRequest']['documentation']:''));?> 
                    </div>
                </div>
                <div class="col-md-6"></div>
                
            </div>
             <?php if(!empty($holdReq['CounterOffer'])){  ?>
                    
                <h3>Counter Option / Offer</h3>
                <div class="col-md-12">
                    <div class="form-group col-md-3"><h4 style="text-align: center;">Label</h4></div>
                    <div class="form-group col-md-3"><h4 style="text-align: center;">Offer</h4></div>
                    <div class="form-group col-md-3"><h4 style="text-align: center;">Expiration Date</h4></div>
                    <div class="form-group col-md-3"><h4 style="text-align: center;">Status</h4><span class="hint">Once funder approve/deny counter offer, status will be displayed</span></div>
                    
                </div>
                <?php //pr($holdReq);
                    foreach($holdReq['CounterOffer'] as $key => $field) {
                       
                        echo '<div class="col-md-12">';
                        if(isset($field['label']) && $field['label'] != ''){
                            $status =  $field['status'];
                            if($status == '2'){
                                $counterStatus = 'Offer Accepted';
                            }elseif($status == '1'){
                                $counterStatus = 'Offer Declined';
                            }else {
                                $counterStatus = 'Pending';
                            }
                            $formLabel = $field['label'];
                            $formValue = $field['offer'];
                            $date = $field['expiration_date'];
                            if($status == 0) {
                                echo  '<div class="form-group col-md-3">'.$this->Form->input('CounterOffer.Label.'.$key,array('value'=>$formLabel,'label' => false,'class' => 'form-control','div' => false,'type' => 'text')).'</div>';
                                echo  '<div class="form-group col-md-3">'.$this->Form->input('CounterOffer.Offer.'.$key,array('value'=>$formValue,'label' => false,'class' => 'form-control','div' => false,'type' => 'textarea','rows'=>'3','style' =>'resize :none')).'</div>';
                                echo  '<div class="form-group col-md-3">'.$this->Form->input('CounterOffer.ExpirationDate.'.$key,array('value'=>$date,'label' => false,'class' => 'form-control','div' => false,'type' => 'text')).'</div>';
                                echo  '<div class="form-group col-md-3" style="text-align:center;">'.$counterStatus.'</div>';
                            }else {
                                echo  '<div class="form-group col-md-3">'.$formLabel.'</div>';
                                echo  '<div class="form-group col-md-3">'.$date.'</div>';
                                echo  '<div class="form-group col-md-3">'.$formValue.'</div>';
                                echo  '<div class="form-group col-md-3" style="text-align:center;">'.$counterStatus.'</div>';
                            }
                        }
                        echo "</div>";
                }
            } else { ?>
            <div class="col-md-12">
                <div class="col-md-6">
                    <strong>Counter Option / Offer </strong>
                     <?php  echo $this->Html->link('Add More','javascript:void(0)',array('class'=>'addNewFieldslink','escape'=>false, 'style'=>"padding-left:40px;",'title' =>'Click to add counter offer')); echo "<br/>";?>
                </div><br/><br/><br/>
                <div class="col-md-12">
                    <div class="form-group col-md-3"><h4 style="text-align: center;">Label</h4></div>
                    <div class="form-group col-md-3"><h4 style="text-align: center;">Expiration Date</h4></div>
                    <div class="form-group col-md-3"><h4 style="text-align: center;">Offer</h4></div>
                    <div class="form-group col-md-3"><h4 style="text-align: center;" title="Once funder approve/deny counter offer, status will be displayed">Status Of Offer</h4></div>                    
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3">
                    <?php echo $this->Form->input('CounterOffer.Label.0',array('label' => false,'div' => false, 'style' => 'display:inline-block !important', 'class' => 'noValidate form-control','placeholder' => 'Label')); ?>
                </div>
                 <div class="form-group col-md-3">
                    <div class="input-with-icon input-append success">
                        <i class=""></i>
                        <?php echo $this->Form->input('CounterOffer.ExpirationDate.0', array('type' => 'text','label' => false, 'div'=>false,'class'=>'noValidate form-control date','dateFormat' => 'MDY', 'placeholder'=>'MM/DD/YYYY', 'value'=>isset($holdReq['expiration_date'])?date('m/d/Y', strtotime($holdReq['expiration_date'])):'')); ?>
                    </div>
                </div>
                
                <div class="col-md-3">
                   <?php echo $this->Form->input('CounterOffer.Offer.0',array('label' => false,'div' => false, 'rows'=>'1','style' => 'display:inline-block !important','type'=>'textarea', 'class' => 'noValidate form-control','placeholder' => 'Offer','style' =>'resize :none'));  ?> 
                </div>
               
            </div>
             <br/>
            <div id= "adduploader"></div>
            <?php  } ?>
     <?php if(empty($holdReq)) { ?>
        <div class="col-md-2 col-md-offset-10">
             <?php  echo $this->Form->button('<span class="glyphicon " style="color:#8ecaf9"></span>Submit Hold Request', array('type' => 'submit','class' => 'btn btn-primary sumitButton', 'div'=>false, 'label'=>false)); ?> 
        </div>
     
        <?php } ?>
 
  </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>	
</div>
    
<!-- END PAGE --> 

<script>
   
</script>