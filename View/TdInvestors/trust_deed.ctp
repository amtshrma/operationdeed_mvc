<?php echo $this->Html->script('trust_deed'); ?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
		<h3>Trust Deed Flyers</h3><hr />
		<p><?php echo $this->Session->flash();?></p>
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="example">
				<thead>
					<tr>
						<th class="small-cell" data-hide="phone,tablet">Trust Deed Position</th>
						<th class="small-cell" data-hide="phone,tablet">Loan Term</th>
						<th class="small-cell" data-hide="phone,tablet">Transaction Type</th>
						<th class="small-cell" data-hide="phone,tablet">Purchase Price</th>
						<th class="small-cell" data-hide="phone,tablet">Requested Loan Amount</th>
						<th class="small-cell" data-hide="phone,tablet">Action</th>
						<th class="small-cell" data-hide="phone,tablet">View PDF</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if(count($arrTrustDeed)>0) {
					foreach($arrTrustDeed as $key => $td) { 
						$loanID = $td['TrustDeed']['loan_id'];
						$link = $this->Common->getInvestorTrustDeedLink($loanID, $this->Session->read('userInfo.id'));
					?>
						<tr>
							<td><?php echo $this->Common->getTrustDeedFields('trustdeed_position', $td['TrustDeed']['trustdeed_position']); ?></td>
							<td class="v-align-middle"><?php echo $this->Common->getTrustDeedFields('loan_term', $td['TrustDeed']['loan_term']); ?></td>
							<td class="v-align-middle"><?php echo $this->Common->getTrustDeedFields('trans_type', $td['TrustDeed']['trans_type']); ?></td>
							<td><?php echo _numberFormatCS($td['TrustDeed']['purchase_price']); ?></td>
							<td><?php echo _numberFormatCS($td['TrustDeed']['req_loan_amount']); ?></td>
							<td><?php echo $this->Html->link($link['name'], $link['url'],$link['attr']); ?></td>
							<td>
								<?php
								$value =  'files/pdf/TrustDeedFlyer/'.$td['TrustDeed']['pdf_name'];
								$loanId = base64_encode(base64_encode($loanID));       
								echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>', $this->Html->url( '/', true ).'app/webroot/'.$value, array("title"=>"Preview Trust Deed Flyer Pdf", 'alt'=>'Preview Pdf', 'class' =>'', 'escape' => false,'target'=>'_blank'));
								?>
							</td>
						</tr>
						<?php
					}
				}else{?>
					<tr>
						<td colspan="7" align="center">No Trust Deed</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<?php
			/*if(count($arrTrustDeed)){?>
				<ul class="pagination">                
					<li class="disabled"><?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?></li>
					<li><?php  echo $this->Paginator->numbers(array('separator' => ''));?></li>
					<li><?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?></li>
				</ul>             
			<?php }*/ ?>
		</div>
	</div>
</div>