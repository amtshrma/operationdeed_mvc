<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-8 col-lg-12 whiteBG">
        <div class="col-md-12">
		<?php
			echo $this->Session->flash();
            echo '<h2>Update Payment Status</h2>';
            echo $this->Form->create('UserPayment', array('novalidate' => true,'type' => 'file','class'=>'form-no-horizontal-spacing'));
            ?>
			<div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
			<div class="table-responsive">
				<table class="table table-bordered table-hover"> 
					<tbody>
						<tr>
							<td>Loan Amount ($) :</td><td><?php echo '$'.$userPaymentDetail['UserPayment']['loan_amount'];?></td>
						</tr>
						<tr>
							<td>User Name:</td>
							<td>
							<?php
							$userDetail = $this->Common->getUserDetail(base64_decode($userId));
							echo $userDetail['User']['first_name'].' '.$userDetail['User']['last_name'];?></td>
						</tr>
						<tr>
							<td>Email Address :</td><td><?php echo $userDetail['User']['email_address'];?></td>
						</tr>
						<tr>
							<td>Commission ($) :</td>
							<td><?php echo $this->Form->input('commission',array('label'=>false,'div'=>false,'class'=>'form-control'));?></td>
						</tr>
						<tr>
							<td>Comment :</td>
							<td><?php
									echo $this->Form->input('account_manager_comment',array('label' => false,'div' => false,'type'=>'textarea','rows'=>'3','title'=>'Profile Picture','style'=>'resize: none;'));
								?>
							</td>
						</tr>
						<!--tr>
							<td>Upload Check Image :</td>
							<td>
								<?php
								//echo $this->Form->input('cheque_image',array('label' => false,'div' => false,'type'=>'file','title'=>'Profile Picture'));
								?>
							</td>
						</tr-->
					</tbody>
				</table>
			</div>
        </div>
        <hr/>
		<div class="col-md-12">
			<div class="col-md-2 col-md-offset-10">
				<?php echo $this->Form->button('Payment Sent', array('type' => 'submit','class' => 'sumitButton btn btn-primary btn-cons sumitButton')); ?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>  
</div>