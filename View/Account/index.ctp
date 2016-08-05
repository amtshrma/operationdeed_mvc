<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<h3>Loans Accounts Detail</h3><hr />
		<div class="row">
			<?php
			$loan_id = '';
			$search = '';
			if(isset($this->request->query['search'])){
				$search = $this->request->query['search'];
			}
			if(isset($this->request->query['loan_number'])){
				$loan_id = $this->request->query['loan_number'];
			}
			echo $this->Form->create('Search',array('type'=>'get','novalidate'=>true));?>
			<div class="col-md-2">
				<?php echo $this->Form->input('search',array('label' => false,'div' => false,'empty'=>'Select Option', 'options' => array(base64_encode(1)=>'Paid',base64_encode(0)=>'Un-Paid'), 'class' => 'form-control','default'=>$search));?>
			</div>
			<div class="col-md-3">
				<?php
				$getAllLoanIds = $this->Common->getAllLoanIds();
				echo $this->Form->input('loan_number',array('label' => false,'div' => false,'empty'=>'Select Loan Number', 'options' => $getAllLoanIds, 'class' => 'form-control','default'=>$loan_id));?>
			</div>
			<div class="col-md-1">
				<?php echo $this->Form->submit('Search',array('label' => false,'div' => false, 'class' => 'btn btn-primary form-control'));?>
			</div>
			<div class="col-md-1">
				<?php echo $this->Html->Link('List All',array('controller'=>'accounts','action'=>'index'),array('class' => 'btn btn-default form-control'));?>
			</div>
			<?php echo $this->Form->end();?>
		</div>
		<div class="row">
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="emails" > 
				<thead>
				<tr>
					<th class="small-cell">Sr No.</th>
					<th class="small-cell">Borrower Detail</th>
					<th class="small-cell">Commission User Detail</th>
					<th class="medium-cell">Loan Amount ($)</th>
					<th class="medium-cell">Commission ($)</th>
					<th class="medium-cell">Cheque Image</th>
					<th class="medium-cell">Status</th>
				</tr>
				</thead>
                <?php
                    if(count($userPayments)) {
                        foreach($userPayments as $key=>$payments) { ?>
							<tbody>
							<tr class="<?php echo ($payments['UserPayment']['payment_request'] && empty($payments['UserPayment']['status'])) ? 'redText' : '';?>">
								<td class="small-cell v-align-middle"><?php echo $key+1;?></td>
								<td class="small-cell v-align-middle">
									<?php
										$userDetail = $this->Common->getUserDetail($payments['Loan']['borrower_id']);
										echo $userDetail['User']['first_name'].' '.$userDetail['User']['last_name'].' <br />'.$userDetail['User']['email_address'];
									?>		
								</td>
								<td class="small-cell v-align-middle">
								<?php
									$brokerDetail = $this->Common->getUserDetail($payments['UserPayment']['user_id']);
									echo $brokerDetail['User']['first_name'].' '.$brokerDetail['User']['last_name'].' <br />'.$brokerDetail['User']['email_address']
								?>
								</td>
								<td class="small-cell v-align-middle"><?php echo $payments['UserPayment']['loan_amount'];?></td>
								<td class="small-cell v-align-middle"><?php echo $payments['UserPayment']['commission'];?></td>
								<td class="small-cell v-align-middle">
									<?php
									if($payments['UserPayment']['cheque_image']){
										if($payments['UserPayment']['cheque_image'] == 'default_cheque.png'){
                                            echo $this->Html->image($payments['UserPayment']['cheque_image'],array('class'=>'img-circle img-responsive','style'=>'height : 50px'));
                                        }else{
                                            echo $this->Html->image('uploadCheckImages/original/'.$payments['UserPayment']['cheque_image'],array('class'=>'img-circle img-responsive','style'=>'height : 50px'));
                                        }
									}
								?></td>
								<td class="small-cell v-align-middle">
									<?php
										if($payments['UserPayment']['status']){
											if($payments['UserPayment']['status'] == '1'){
												echo '<span class="greenText glyphicon glyphicon-ok"></span>';
											}else{
												echo '<span class="redText glyphicon glyphicon-remove"></span>';
											}
										}else{
											echo $this->Html->link('Pay',array('controller'=>'accounts','action'=>'updatePaymentStatus/'.base64_encode($payments['UserPayment']['id']).'/'.base64_encode('1')),array('class'=> 'btn-primary btn-sm'));
											echo "&nbsp;";
											echo $this->Html->link('Cancel',array('controller'=>'accounts','action'=>'updatePaymentStatus/'.base64_encode($payments['UserPayment']['id']).'/'.base64_encode('2')),array('class'=>'btn-danger btn-sm'));
										}
									?>
								</td>
							</tr>
							<?php }
							}else{ ?>
								<tr colspan='7'>
									<td class="small-cell v-align-middle redText" style="text-align: center;" colspan="8">No Record Found</td>
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
