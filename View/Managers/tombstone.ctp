<?php echo $this->Html->script('trust_deed'); ?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3><span class="semi-bold">Trust Deed Tombstone</span></h3>
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="example">
				  <thead>
					<tr>
					  <th class="small-cell" data-hide="phone,tablet">Borrower</th>
					  <th class="small-cell" data-hide="phone,tablet">Property Address</th>
					  <th class="small-cell" data-hide="phone,tablet">Loan Amount</th>
                      <th class="small-cell" data-hide="phone,tablet">Loan Date</th>
					  <th class="small-cell" data-hide="phone,tablet">Action</th>
					</tr>
				  </thead>
				  <tbody>
				 <?php if(count($trustDeedTombstones)>0) { //echo '<pre>';print_r($arrTrustDeed);
					$userData = $this->Session->read('userInfo');
					foreach($trustDeedTombstones as $key => $td) { 
						$loanID = $td['TrustDeedTombstones']['loan_id'];
						$shortAppExist = $this->Common->shortAppExist($loanID);
						if($shortAppExist == 1) { ?>
                        
                        <tr>
							<td><?php echo ucfirst($td['ShortApplication']['applicant_first_name']) . ' '.ucfirst($td['ShortApplication']['applicant_last_name']). '<br/>'.$td['ShortApplication']['applicant_email_ID']; ?></td>
							
							<td class="v-align-middle"><?php echo ucfirst($td['ShortApplication']['property_address']). ' - '.$td['ShortApplication']['property_state']. ', '.ucfirst($this->Common->getCityName($td['ShortApplication']['property_city'])); ?></td>
                            <td class="v-align-middle">$ <?php echo $td['ShortApplication']['loan_amount']; ?></td>
							<td><?php echo date('jS M, Y',strtotime($td['Loan']['created']));?></td>
							<td>
								<?php
								$value =  'files/pdf/TrustDeedTombstone/trust_deed_tombstone_'.base64_encode($loanID).'.pdf';
								
								echo '&nbsp;&nbsp;';
								echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>', $this->Html->url( '/', true ).'app/webroot/'.$value, array("title"=>"Preview Pdf", 'alt'=>'Preview Pdf', 'class' =>'', 'escape' => false,'target'=>'_blank'));
								?>
							</td>
						</tr>
					
					<?php }  } } else { ?>
						<tr>
							<td colspan="7" align="center">No Trust Deed Tombstone</td>
						</tr>
					<?php } ?>
				  </tbody>
				</table>
				<!--div class="paging" align="right">
				<?php
					if(count($arrTrustDeed)){?>
						<ul class="pagination">                
							<li class="disabled"><?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?></li>
							<li><?php  echo $this->Paginator->numbers(array('separator' => ''));?></li>
							<li><?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?></li>
						</ul>             
				<?php } ?>
			</div-->
		</div>							
	</div>
</div>

 
