<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<div class="row" >
			<?php echo $this->Session->flash();
				echo $this->Form->create('Checklist', array('type' => 'file','novalidate'=>true));
				echo $this->Form->input('loanID', array('name'=>"loanID",'type' => 'hidden','value'=>$loanID,'id'=>'loanID'));?>
			<div class="col-md-12">
				<div class="grid simple" >
					<div class="no-border email-body" >
						<br>
						<div class="row-fluid" >
						   <h2 class=" inline">Review Checklist</h2>
						</div>
						<div class="col-md-12">
							<div class="col-md-2 col-md-offset-10">
							<?php
								$loanDetail = $this->Common->getLoanDetail($loanID);
								if(!empty($loanDetail['Loan']['soft_quate_id'])){
									echo $this->Html->link('Final Submission',array('controller'=>'processors','action'=>'disclosure_statement/'.base64_encode($loanID)),array('class'=>'btn btn-primary'));
									echo '<span class="hint">Click to futher process loan</span>';
								}else{
									echo $this->Html->link('Final Submission',array('controller'=>'commons','action'=>'soft_quote/'.base64_encode($loanDetail['Loan']['short_app_id']).'/'.base64_encode($loanID)),array('class'=>'btn btn-primary'));
									echo '<span class="hint">Click to futher process loan</span>';
								}
							?>
							</div>
						</div>
						<br/>
						<div class="grid-body">
						
						   <table class="table table-fixed-layout table-hover" width="100%" cellpadding="0" cellspacing="10">
                                <thead>
								<tr>
									<th class="medium-cell">Document</th>
									<th class="medium-cell">Download</th>
								</tr>
                                </thead>
						 <?php 
							foreach($allDocuments as $document){
								$documentId = $document['AskDocument']['document_id'];
								$documentType = $document['AskDocument']['document_type'];
								$documentDetail = $this->Common->getDocumentDetail($documentId, $documentType);
								if($documentType == 'loan'){
									$checklist = $documentDetail['LoanDocument']['checklistname'];
								}else {
									$checklist = $documentDetail['Checklist']['checklistname'];
								}?>
							<tr>
								<td><?php echo ucfirst($checklist) ?></td>
								
								<td>
									<?php //echo $document['AskDocument']['borrower_document'];
									if(!empty($document['AskDocument']['borrower_document']) && file_exists(WWW_ROOT.'borrower_document/'.$document['AskDocument']['borrower_document'])) {
										echo $this->Html->link($checklist, BASE_URL.'borrower_document/'.$document['AskDocument']['borrower_document'], array('class' => 'button','target'=>'_blank'));
									}else {
										echo 'NA';	
									} ?>
								</td>
							</tr>
						<?php } ?>
						</table>
						</div>							
					 </div>							
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="col-md-12">
				<div class="col-md-4">
					<?php
						echo $this->Html->link('Additional Document Request','javascript:void(0);',array('class'=>'btn btn-primary','onclick' =>'addMoreChecklist()'));
						echo '<br/>';
						echo '<span class="hint">Click to request additional document</span>';
						echo $this->Form->hidden('checklistCount',array('value'=>'0','id' =>'processorCheckListCount'));
					?>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class='col-md-12 addProcessorChecklist' id="options_0" style="display: none;">
				<div class="col-md-3">
					<?php
						echo $this->Form->input('checklist.type.0',array('options'=>array('property'=>'Property','loan'=>'Loan'),'empty'=>'Select Checklist Type','label'=>false,'div'=>false,'class'=>'form-control'));
					?>
				</div>
				<div class="col-md-3">
					<?php
						echo $this->Form->input('checklist.checklistname.0',array('label'=>false,'div'=>false,'class'=>'form-control'));
					?>
				</div>
				<div class="col-md-3">
					<?php
						echo $this->Form->input('checklist.document.0',array('type'=>'file','label'=>false,'div'=>false,'class'=>'form-control noValidate'));
					?>
				</div>
			</div>
			<div class="adddynamicProcessorChecklist"></div>
			<div class="col-md-2 col-md-offset-10">
				<?php
					echo $this->Form->submit('Submit Checklist',array('class'=>'btn btn-primary sumitButton submitAdditionalChecklist', 'style'=>"display: none;"));
				?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>	
	</div>
</div>
  <!-- END PAGE -->
