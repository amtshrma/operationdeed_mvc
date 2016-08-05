<script type="text/javascript">
   function enquiry( doc, appid ) {
	  $.ajax({
			type: "POST",
			url: '/commons/enquiry_document',
			data: {"appid": appid, "doc":doc},
			success: function(data) {
				$('.modal-content').html(data);
				$("#myModal").modal("show");
			}
		});
    }
    function accept(doc) {
	  var accept=confirm("Are you sure you want to accept this document?");
	  if (accept==true) {
		window.location.href="/commons/accept_document/"+doc;
	  }
	
    }
</script>

<div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="content">
        
	<div class="page-title" style="display:none"> <a href="#" id="btn-back"><i class="icon-custom-left"></i></a>
        <h3>Back- <span class="semi-bold">Short App</span></h3>
     </div>		
		<div class="row"  id="inbox-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
					<?php 
						echo $this->Form->create('Common', array('type' => 'post'));
						echo $this->Form->input('shortappId', array('name'=>"shortappId",'type' => 'hidden','value'=>$shortAppId,'id'=>'shortappId'));
						echo $this->Form->input('loanID', array('name'=>"loanID",'type' => 'hidden','value'=>$loanID,'id'=>'loanID'));?>
						 <div class="grid simple" >
							<div class="no-border email-body" >
							  <br>
							   <div class="row-fluid" >
								   <div class="row-fluid dataTables_wrapper">
									  <h2 class=" inline">Ask Documents </h2>
									  <div class="clearfix"></div>
									</div>
								   <div class="grid-body">
								  <!--<h4 class=" inline">Upload Documents</h4>-->
								   
								   <h1>Property Checklist</h1>
								   <table class="table table-fixed-layout table-hover" width="100%" cellpadding="0" cellspacing="30">
									<thead>
									<tr>
									  <th class="medium-cell">Document</th>
									  <th class="medium-cell">Status</th>
									  <th class="medium-cell">Action</th>
									  <th class="medium-cell">Download</th>
									</tr>
								  </thead>
								 <?php 
									$check1 ='';
									 foreach($propertyDocument as $member_checklist){ //pr($member_checklist) ;
										$doc = $this->Common->checkdocument($shortAppId, $loanID, $member_checklist['Checklist']['id'],'property');
										 if(!empty($askdocumentinfo) && isset($askdocumentinfo)) {
											$docment = $askdocumentinfo['AskDocument']['document'];
											$document = explode(',',$docment);
											if(in_array($member_checklist['Checklist']['id'], $document)){
											   $check1="ask";  
											}
										}
									 ?>
									 <tr>
										 <td><?php echo $member_checklist['Checklist']['checklistname']; ?></td>
										 <td><?php
											 if(!empty($doc)){
											 }else{
												if($check1 == "ask"){
												   echo "Asked for Document";
												}else{
												    echo $this->Form->checkbox('', array('name' => 'document[]','value'=>$member_checklist['Checklist']['id']));
												}
											 }
									   ?></td>
										 <td><?php
										  
										  if(!empty($doc)){ 
											
											?></span><?php $acceptance_status = $this->Common->document_acceptance_status($doc);
											if($acceptance_status=='1'){
											    echo "<span>Document Accepted </span>";
											}else {
											 $enquiryDetail = $this->Common->getDeniedStatus($doc, base64_decode($shortAppId));
												if(!empty($enquiryDetail) && $enquiryDetail['Enquiry']['id']){
												   echo "Document Denied";
												}else {
												
											 ?>
											   <span><a onclick="return enquiry('<?php echo $doc;?>','<?php echo $shortAppId; ?>');" style="cursor:pointer;">Deny</a></span>
											   <span style="margin-left:10%;"><a onclick="return accept('<?php echo $doc;?>');">Accept</a></span>
											<?php }  }
										  }
										 ?></td>
										 <td>
										<?php  if(!empty($doc)){
										  $loanDocumentDetail = $this->Common->getBorrowerUpload($doc,'property');
										  $document = $loanDocumentDetail['UploadDocument']['uploaded_document'];
										 echo "<span >".$this->Html->link(
											'Download',
											$this->Html->url( '/', true ).'app/webroot/borrower_document/'.$document,
											array('class' => 'button','target'=>'_blank')
										); ?>
										<?php } else { 
										  echo '--';
										
										} ?>
										
										 </td>
										
									  </tr>
									  <?php
									  $check1='';
									  }
									  ?>
								   </table>
								   
								   <h1>Loan Checklist</h1>
								   <table class="table table-fixed-layout table-hover" width="100%" cellpadding="0" cellspacing="30">
									<thead>
									<tr>
									  <th class="medium-cell">Document</th>
									  <th class="medium-cell">Status</th>
									  <th class="medium-cell">Action</th>
									  <th class="medium-cell">Download</th>
									</tr>
								  </thead>
									
									 <?php									
									 foreach($loanDocuments as $checklist){ 
										$doc = $this->Common->checkdocument($shortAppId, $loanID, $checklist['LoanDocument']['id'],'loan');
										
										 if(!empty($askdocumentinfo) && isset($askdocumentinfo)){
											$docment = $askdocumentinfo['AskDocument']['loan_document'];
											$document = explode(',',$docment);
											if(in_array($checklist['LoanDocument']['id'],$document)){
											   $check1="ask";  
											}
										}
									 ?>
									 <tr>
										 <td><?php echo $checklist['LoanDocument']['checklistname']; ?></td>
										 <td><?php
											 if(!empty($doc)){
											 }else{
												if($check1 == "ask"){
												   echo "Asked for Document";
												}else{
												    echo $this->Form->checkbox('', array('name' => 'loan_document[]','value'=>$checklist['LoanDocument']['id']));
												}
											 }
									   ?></td>
										 <td><?php
										  
										  if(!empty($doc)){ 
											
											?></span><?php $acceptance_status = $this->Common->document_acceptance_status($doc);
											if($acceptance_status=='1'){
											    echo "<span> Document Accepted </span>";
											}else {
											 $enquiryDetail = $this->Common->getDeniedStatus($doc, base64_decode($shortAppId));
												if(!empty($enquiryDetail) && $enquiryDetail['Enquiry']['id']){
												   echo "Document Denied";
												}else {
												?>
											   <span><a onclick="return enquiry('<?php echo $doc;?>','<?php echo $shortAppId; ?>');" style="cursor:pointer;">Deny</a></span>
											   <span style="margin-left:10%;"><a onclick="return accept('<?php echo $doc;?>');">Accept</a></span>
											<?php   }
											 }
										 
										 ?></td>
										 <?php } ?>
										 
										 <td>
										<?php if(!empty($doc)){
										  $documentDetail = $this->Common->getBorrowerUpload($doc,'loan');
										  $documentName = $documentDetail['UploadDocument']['uploaded_document'];
										  echo "<span style='margin-right:10px;margin-left:10px;'>".$this->Html->link(
											'Download',
											$this->Html->url( '/', true ).'app/webroot/borrower_document/'.$documentName,
											array('class' => 'button','target'=>'_blank')); ?>
										<?php } ?>
										 </td>
										
									  </tr>
									  <?php
									  $check1='';
									  }
									  ?>
								  
								   </table>
								</div>							
							 </div>							
						   </div>
						</div>
						<div class="col-lg-12">
						   <div class="form-group col-lg-9"></div>
						   <div class="form-group col-lg-3">
							   <div class="col-lg-5"></div>
							   <div class="col-lg-12">
								   <label>&nbsp;</label>
								   <?php echo $this->Form->submit('Save', array('class'=>'btn btn-primary btn-cons')); ?>
								 </div>
						   </div>
						</div>
						 <?php echo $this->Form->end(); ?>
					 </div>
			   </div>
			</div>	
		</div>
  </div>
  <!-- END PAGE -->
  
</div>



