<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3>Loans Payment Detail</h3><hr />
		<div class="row">
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="emails" > 
				<thead>
				<tr>
					<th class="small-cell">Sr No.</th>
					<th class="small-cell">Borrower Detail</th>
					<th class="small-cell">Broker Detail</th>
					<th class="medium-cell">Loan Amount ($)</th>
					<th class="medium-cell">Commission Percentage (%)</th>
					<th class="small-cell">My Commission($)</th>
					<th class="medium-cell">Status</th>
				</tr>
				</thead>
                <?php
                    if(count($userPayments)) {
                        foreach($userPayments as $key=>$payments) { ?>
							<tbody>
							<tr>
								<td class="small-cell v-align-middle"><?php echo $key+1;?></td>
								<td class="small-cell v-align-middle">
									<?php
										$borrowerDetai = $this->Common->getUserDetail($payments['Loan']['borrower_id']);
										echo $borrowerDetai['User']['first_name'].' '.$borrowerDetai['User']['last_name'].' <br />'.$borrowerDetai['User']['email_address'];
									?>		
								</td>
								<td class="small-cell v-align-middle">
								<?php
									$brokerDetail = $this->Common->getUserDetail($payments['UserPayment']['user_id']);
									echo $brokerDetail['User']['first_name'].' '.$brokerDetail['User']['last_name'].' <br />'.$brokerDetail['User']['email_address']
								?>
								</td>
								<td class="small-cell v-align-middle"><?php echo $payments['UserPayment']['loan_amount'];?></td>
								<td class="small-cell v-align-middle"><?php echo $payments['UserPayment']['commission_percentage'];?></td>
								<td class="small-cell v-align-middle"><?php echo $payments['UserPayment']['commission'];?></td>
								<td class="small-cell v-align-middle">
									<?php
										if($payments['UserPayment']['status']){
											$userDetail = $this->Common->getJuniorCommissionUser($payments['UserPayment']['loan_id'],$this->Session->read('userInfo.user_type'));
											if(empty($userDetail)){
												echo '<span title="Payment Received" class="greenText glyphicon glyphicon-ok"></span>';
											}else{
												echo $this->Html->link('Pay',array('controller'=>'accounts','action'=>'updateStaffPayment/'.base64_encode($userDetail).'/'.base64_encode($payments['UserPayment']['id'])),array('class'=> 'btn-primary btn-sm'));
											}
										}else{
											if(empty($payments['UserPayment']['payment_request'])){
												echo $this->Html->link('<button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-usd"></span> USD</button>',array('controller'=>'accounts','action'=>'requestPayment/'.base64_encode($payments['UserPayment']['id'])),array('escape'=>false,'title' => 'Request For Payment'));
											}else{
												echo '<span title="Payment Request Sent" class="blueText glyphicon glyphicon-ok"></span>';
											}
										}
									?>
								</td>
							</tr>
							<?php }
							}else{ ?>
								<tr colspan='7'>
									<td class="small-cell v-align-middle redText" style="text-align: center;" colspan="8">Right Now No Payment Paid You</td>
								</tr>
							<?php }?>
							</tbody>
			</table>
		</div>
		<div class="col-md-12">
			<?php
				if(count($userPayments)){?>
					<ul class="pagination">                
						<li class="disabled"><?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?></li>
						<li><?php  echo $this->Paginator->numbers(array('separator' => ''));?></li>
						<li><?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?></li>
					</ul>             
			<?php } ?>
		</div>
		
        <!--</div>-->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<style>
	a:hover{
		text-decoration: none;
	}
</style>
