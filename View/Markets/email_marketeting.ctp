<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <!--<div class="content-container">-->
		<h3>Email Marketing</h3><hr />
		<p><?php echo $this->Session->flash();?></p>
        <?php echo $this->Form->create('EmailMarketing', array('id'=>'newsletter', 'novalidate'=>'novalidate'));?>
            <div class="form-group col-md-4">
                <label class="form-label">Email Marketing - Subject<span class="required"> * </span></label>
                <?php echo $this->Form->input('title', array('label'=>false, 'div'=>false, 'placeholder'=>'enter titile', 'class'=>'form-control', 'type'=>'text', 'maxlength'=>100, 'placeholder'=>'Email Marketing - Subject')); ?>
            </div>
			<div style="clear: both;"></div>
			<div class="form-group col-md-12">
				<label class="form-label">Select Flyer<span class="required"> * </span></label>
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="example">
						<thead>
						  <tr>
							<th style="width:2%"></th>
							<th class="small-cell" data-hide="phone,tablet">Trust Deed Position</th>
							<th class="small-cell"  data-hide="phone,tablet">Loan Term</th>
							<th class="small-cell" data-hide="phone,tablet">Transaction Type</th>
							<th class="small-cell" data-hide="phone,tablet">Purchase Price</th>
							<th class="small-cell" data-hide="phone,tablet">Requested Loan Amount</th>
							<th class="small-cell" data-hide="phone,tablet">Action</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						if(count($trustDeedDetail) > 0){
							$userData = $this->Session->read('userInfo');
							foreach($trustDeedDetail as $key => $td) { 
								$loanID = $td['TrustDeed']['loan_id'];
								$shortAppExist = $this->Common->shortAppExist($loanID);
								if($shortAppExist == 1) {?>
								<tr>
									<td>
										<?php 
										if($td['TrustDeed']['status'] == 1) { ?>
										<div class="checkbox check-default">
											<input style="margin-left:1px;" type="checkbox" name="EmailMarketing[trustdeedId][]" class ="chld" value="<?php echo base64_encode($td['TrustDeed']['id']);?>" id="checkbox_<?php echo $key; ?>">
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
										$value =  'files/pdf/TrustDeedFlyer/'.$td['TrustDeed']['pdf_name'];
										echo $this->Html->link('<i class="fa fa-lock"></i>', 'javascript:void();', array("title"=>"Cancel", 'alt'=>'Cancel', 'class' =>'cancelTrustDeed', 'escape' => false));
										echo '&nbsp;&nbsp;';
										echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>', $this->Html->url( '/', true ).'app/webroot/'.$value, array("title"=>"Preview Pdf", 'alt'=>'Preview Pdf', 'class' =>'', 'escape' => false,'target'=>'_blank'));
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
			<div style="clear: both;"></div>
            <div class="form-group col-md-2 col-md-offset-10">
                <?php
                    echo $this->Form->button('Send Campaigns', array('type' => 'submit','class' => 'btn btn-success btn-cons'));
                ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>