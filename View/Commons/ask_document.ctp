<script type="text/javascript">
   function enquiry( doc, appid ) {
	  jQuery.ajax({
			type: "POST",
			url: BASE_URL+'commons/enquiry_document',
			data: {"appid": appid, "doc":doc},
			success: function(data) {
			   jQuery('.modal-content').html(data);
			   jQuery("#myModal").modal("show");
			}
		});
    }
	function accept_checklist(doc) {
		bootbox.confirm("Are you sure you want to accept this document?", function(result){
			if(result){
				window.location.href = BASE_URL+"commons/accept_document/"+doc;
			}
		 });
	}
</script>

<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<div class="row" >
			<?php echo $this->Session->flash();?>
			<?php 
				echo $this->Form->create('Common', array('type' => 'post'));
				echo $this->Form->input('shortappId', array('name'=>"shortappId",'type' => 'hidden','value'=>$shortAppId,'id'=>'shortappId'));
				echo $this->Form->input('loanID', array('name'=>"loanID",'type' => 'hidden','value'=>$loanID,'id'=>'loanID'));?>
			<div class="col-md-12">
				<div class="grid simple" >
					<div class="no-border email-body" >
						<h2 >Property Checklist</h2><hr />
						<div class="grid-body">
						<div class="row">
						 <?php $loanPhase = $this->Common->getDocumentSatus($loanID, 'B');
						 $loanProcessDetail = $this->Common->getLoanProcessingDetail($loanID);
						$askDocumentCount = $this->Common->askDocumentExist($loanID);
						 if(empty($loanPhase)) {
							if(!empty($loanProcessDetail)) {
								if(!empty($askDocumentCount)) {?>
								<div class="col-md-2 col-md-offset-7 form-group">
									<input type="button" value="Submit To Processing" id="approveButton" class="btn btn-primary btn-cons"/><br/>
									<span class="hint">Click to accept all needlist</span>
								</div>
								<?php } ?>
								<div class="col-md-3 pull-right">
									<?php  echo $this->Html->link('Add Property Checklist <span class="glyphicon glyphicon-plus"></span>','javascript:void(0)',array('class'=>'addChecklist','title'=>'Click to add more property checklist','id'=>'property','escape'=>false,'style'=>'float: right;'));?>
								</div>
						</div>
						 <?php } else { ?>
								<div class="col-md-2 col-md-offset-10 form-group">
									<input type="button" value="Submit To Processor" class="submitBrokerChecklist btn btn-primary btn-cons" title="Click to accept all additional checklist and notify processor"/><br/>
									
								</div>
						 
						 <?php } }?>
						   <table class="table table-fixed-layout table-hover" width="100%" cellpadding="0" cellspacing="10">
                                <thead>
								<tr>
									<th class="medium-cell">Document</th>
									<th class="medium-cell">Ask Document<br/><span class="hint">Select document to request. </span></th>
									<th class="medium-cell">Action<br/><span class="hint">Once borrower submit document, accept or deny document</span></th>
									<th class="medium-cell">Download <br/><span class="hint">Download to view borrower uploaded document.</span></th>
								</tr>
                                </thead>
						 <?php 
							$check1 ='';
							 foreach($propertyDocument as $member_checklist){
								$doc = $this->Common->checkAskedDocument($shortAppId, $loanID, $member_checklist['Checklist']['id'],'property');
								?>
								
							 <tr>
								<td><?php echo $member_checklist['Checklist']['checklistname']; ?></td>
								<td>
								<?php
									if(!empty($doc)){
										if($doc['AskDocument']['status'] == '1'){
											echo "<p class='greenText'>Document Accepted</p>";
										}else if($doc['AskDocument']['status'] == '3'){
											echo "<p class='redText'>Document Denied</p>";
										}else{
											if($doc['AskDocument']['borrower_document']){
												echo "<p class='greenText'>Document Uploaded</p>";
											}else{
												echo "<p class='redText'>Request Sent to borrower</p>";
											}
										}
									}else{
										echo $this->Form->checkbox('', array('name' => 'document[]','value'=>$member_checklist['Checklist']['id'],'class' => 'chld'));
									}
								?>
								</td>
								<td><?php
									if(!empty($doc)){
										$askButton = false;
										if($doc['AskDocument']['status'] == '1') { 
											echo "<span>Document Accepted </span>";
										}else if($doc['AskDocument']['status'] == '3') {
											echo "<span>Document Denied </span>";
										}else if($doc['AskDocument']['borrower_document']){
											$askButton = true;
										}
										$askDocumentID = $doc['AskDocument']['id'];
										if($askButton){
										?>
										<span><a onclick="return enquiry('<?php echo $askDocumentID;?>','<?php echo $shortAppId; ?>');" style="cursor:pointer;">Deny</a></span>
										<span style="margin-left:10%;"><a href="javascript:void(0);" onclick="return accept_checklist('<?php echo $askDocumentID;?>');">Accept</a></span>
							<?php
										}
									}
								?>
								</td>
								<td>
								<?php
								if(!empty($doc) && $doc['AskDocument']['borrower_document'] != '') {
									$documentID = $member_checklist['Checklist']['id'];
									$loanDocumentDetail = $this->Common->getBorrowerUpload($documentID,$loanID,'property');
									$document = isset($doc['AskDocument']['borrower_document'])?$doc['AskDocument']['borrower_document']:'';
									if(!empty($document)){
										echo "<span >".$this->Html->link('Download', $this->Html->url( '/', true ).'app/webroot/borrower_document/'.$document, array('class' => 'button','target'=>'_blank'));
									}
								?>
								<?php
								}else{ 
									echo '--';										
								}?>
								</td>
							</tr>
						<?php } ?>
						</table><br/><br/>
						<center><h1>Loan Checklist</h1></center>
						<?php  if(empty($loanPhase) && $loanPhase != 1) { ?>
						 <div class="col-md-12"><?php  echo $this->Html->link('Add Loan Checklist <span class="glyphicon glyphicon-plus"></span>','javascript:void(0)',array('class'=>'addChecklist','title'=>'Click to add more loan checklist','id'=>'loan','escape'=>false,'style'=>'float: right;'));?></div>
						 <?php } ?>
							<table class="table table-fixed-layout table-hover" width="100%" cellpadding="0" cellspacing="30">
								<thead>
									<tr>
										<th class="medium-cell">Document</th>
										<th class="medium-cell">Status <br/><span class="hint">Select document to request. </span></th>
										<th class="medium-cell">Action <br/><span class="hint">Once borrower submit document, accept or deny document</span></th>
										<th class="medium-cell">Download <br/><span class="hint">Once borrower submit document, download to view.</span></th>
									</tr>
								</thead>
								<?php
							foreach($loanDocuments as $checklist) { 
							   $doc = $this->Common->checkAskedDocument($shortAppId, $loanID, $checklist['LoanDocument']['id'],'loan');
							 ?>
							 <tr>
								 <td><?php echo $checklist['LoanDocument']['checklistname']; ?></td>
								 <td><?php
									if(!empty($doc)){
										if($doc['AskDocument']['status'] == '1'){
											echo "<p class='greenText'>Document Accepted</p>";
										}else if($doc['AskDocument']['status'] == '3'){
											echo "<p class='redText'>Document Denied</p>";
										}else{
											if($doc['AskDocument']['borrower_document']){
												echo "<p class='greenText'>Document Uploaded</p>";
											}else{
												echo "<p class='redText'>Request Sent to borrower</p>";
											}
										}
									}else{
										echo $this->Form->checkbox('', array('name' => 'loan_document[]','value'=>$checklist['LoanDocument']['id'],'class' => 'chld'));
									}
									?>
									 </td>
								<td><?php
									if(!empty($doc)){
										$askButton = false;
										if($doc['AskDocument']['status'] == '1') { 
											echo "<span>Document Accepted </span>";
										}else if($doc['AskDocument']['status'] == '3'){
											echo "<span>Document Denied </span>";
										}else if($doc['AskDocument']['borrower_document']){
											$askButton = true;
										}
										$askDocumentID = $doc['AskDocument']['id'];
										if($askButton){
										?>
											<span><a onclick="return enquiry('<?php echo $askDocumentID;?>','<?php echo $shortAppId; ?>');" style="cursor:pointer;">Deny</a></span>
											<span style="margin-left:10%;"><a href="javascript:void(0);" onclick="return accept_checklist('<?php echo $askDocumentID;?>');">Accept</a></span>
								<?php
										}
									}
									?>
								  </td>										 
								 <td>
								<?php if(!empty($doc) && $doc['AskDocument']['borrower_document'] != '') {
									 $documentID = $checklist['LoanDocument']['id'];
									 $documentDetail = $this->Common->getBorrowerUpload($documentID, $loanID,'loan');											 
									 $documentName = isset($documentDetail['AskDocument']['borrower_document'])?$documentDetail['AskDocument']['borrower_document']:'';
									 echo "<span style='margin-right:10px;margin-left:10px;'>".$this->Html->link('Download', $this->Html->url( '/', true ).'app/webroot/borrower_document/'.$documentName, array('class' => 'button','target'=>'_blank')); ?>
								   <?php } else {
									 echo "--";
								  }
								  ?>										
								 </td>										
							  </tr>
							  <?php									
							  } 
							  ?>								  
						   </table>
						</div>							
					 </div>							
				   </div>
				</div>
			<?php if(empty($loanPhase) && $loanPhase != 1) { ?>
				<div class="col-lg-12">
				   <div class="form-group col-lg-10"></div>
				   <div class="form-group col-lg-2">
						<?php echo $this->Form->submit('Request Documents', array('class'=>'btn btn-primary btn-cons showLoader', 'id'=>'requestDocument')); ?>
					</div>
				</div>
			<?php }
				 echo $this->Form->end(); ?>
			</div>	
	</div>
</div>
  <!-- END PAGE -->
<?php echo $this->Element('fronts/loader');?>