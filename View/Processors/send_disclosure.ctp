<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<div class="row">
			<?php echo $this->Session->flash();
				echo $this->Form->create('document', array('type' => 'file'));
				echo $this->Form->input('loanID', array('name'=>"loanID",'type' => 'hidden','value'=>$loanID,'id'=>'loanID'));?>
			<div class="col-md-12">
				<h3>Review Document</h3><hr />
				<div class="table-responsive">
					<table class="table table-fixed-layout table-hover" width="100%" cellpadding="0" cellspacing="10">
                        <thead>
							<tr>
								<th class="medium-cell">Document</th>
								<th class="medium-cell">View</th>
							</tr>
                        </thead>
						<?php 
						foreach($processorDocuments as $key=>$document){ ?>
							<tr>
								<td>
									<?php
										echo ucfirst($key);
										echo $this->Form->input('document', array('name'=>"document[]",'type' => 'hidden','value'=>$key));
									?>
								</td>
								<td>
									<?php echo $this->Html->link($key, BASE_URL.'files/pdf/'.$document.'/'.$document.'_'.base64_encode($loanID).'.pdf', array('class' => 'button','target'=>'_blank')); ?>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>							
			</div>							
			<div class="col-md-2 col-md-offset-10">
				<?php
					$disclosureStatus = $this->Common->getLoanDisclosureDetail($loanID);
					if($disclosureStatus){
						echo $this->Form->button('Approve',array('class'=>'btn btn-primary','id'=>'loanToFunder','type'=>'button'));
					}else{
						echo $this->Form->submit('Send',array('class'=>'btn btn-primary'));
					}
				?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="row">
			<p class="redText">Note : <?php echo ($disclosureStatus) ? 'Click to submit loan to funder' : 'Click to send document to broker and borrower';?></p>
		</div>
	</div>
</div>
<!-- END PAGE -->