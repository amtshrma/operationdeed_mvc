<?php echo $this->Html->script('trust_deed'); ?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<?php echo $this->Html->link('<button  class="btn btn-primary pull-right">Publish</button>','javascript:void(0);',array('escape' => false,'title' => 'Publish','id'=>'publishButton'));?>
		<h3><span class="semi-bold">Trust Deed Flyers</span></h3>
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="example">
				  <thead>
					<tr>
					  <th style="width:2%">
						<div class="checkbox check-default">
							<input style="margin-left:1px;" type="checkbox" value="1" class="checkall" id="checkall">
							<label for="checkall"></label>
						</div>
					  </th>
					  <th class="small-cell" data-hide="phone,tablet">Trust Deed Position</th>
					  <th class="small-cell"  data-hide="phone,tablet">Loan Term</th>
					  <th class="small-cell" data-hide="phone,tablet">Transaction Type</th>
					  <th class="small-cell" data-hide="phone,tablet">Purchase Price</th>
					  <th class="small-cell" data-hide="phone,tablet">Requested Loan Amount</th>
					  <th class="small-cell" data-hide="phone,tablet">View Flyer</th>
					</tr>
				  </thead>
				  <tbody>
				 <?php if(count($arrTrustDeed)>0) { //echo '<pre>';print_r($arrTrustDeed);
					$userData = $this->Session->read('userInfo');
					foreach($arrTrustDeed as $key => $td) { 
						$loanID = $td['TrustDeed']['loan_id'];
						$shortAppExist = $this->Common->shortAppExist($loanID);
						if($shortAppExist == 1) {?>
						<tr>
							<td>
								<?php 
								if($td['TrustDeed']['status'] == 1) { ?>
								<div class="checkbox check-default">
									<input style="margin-left:1px;" type="checkbox" name="checkboxes[]" class ="chld" value="<?php echo base64_encode($td['TrustDeed']['id']);?>" id="checkbox_<?php echo $key; ?>">
									<label for="checkbox_<?php echo $key; ?>"></label>
								</div>
								<?php } ?>
							</td>
							<td><?php echo $this->Common->getTrustDeedFields('trustdeed_position', $td['TrustDeed']['trustdeed_position']); ?></td>
							<td class="v-align-middle"><?php echo $this->Common->getTrustDeedFields('loan_term', $td['TrustDeed']['loan_term']); ?></td>
							<td class="v-align-middle"><?php echo $this->Common->getTrustDeedFields('trans_type', $td['TrustDeed']['trans_type']); ?></td>
							<td><?php echo _numberFormatCS($td['TrustDeed']['purchase_price']); ?></td>
							<td><?php echo _numberFormatCS($td['TrustDeed']['req_loan_amount']); ?></td>
							<td>
								<?php
								$value =  BASE_URL.'files/pdf/TrustDeedFlyer/'.$td['TrustDeed']['pdf_name'];
								if(file_exists($value)){
									echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>', $this->Html->url( '/', true ).'app/webroot/'.$value, array("title"=>"Preview Pdf", 'alt'=>'Preview Pdf', 'class' =>'', 'escape' => false,'target'=>'_blank'));
								}
								?>
							</td>
						</tr>
					
					<?php }  } } else { ?>
						<tr>
							<td colspan="7" align="center">No Trust Deed</td>
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

 
