<div class="section first">
    <div class=" p-b-60">
    <div class="section dark-grey p-t-20  p-b-20 m-b-50">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Doc Order Form</h2>
		  </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
        <div class="container">
          <div class="row"  id="inbox-wrapper">
			<div class="col-md-12">
				<div class="row">
				<?php echo $this->Form->create('DocOrderApproval', array('id'=>'borrowerRegister','type' => 'file','style'=>''));
					echo $this->Form->hidden('id',array('value'=>$docApprovalID,'id'=>'hiddenApprovalID'));
					echo $this->Form->hidden('loanID',array('value'=>$loanId,'id'=>'hiddenLoanID'));
				
				?>
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="grid-body no-border email-body" >
							<br>
							 <div class="row-fluid">
								<div id="email-list">									
								<table class="table table-striped table-fixed-layout table-hover" > 
								  <thead>
									<tr>
									  <th class="small-cell"></th>
									  <th class="medium-cell"></th>
									  <th class="medium-cell"></th>
									</tr>
								  </thead>
								  <tbody>
                                <?php echo $this->element('common/doc_order_form');?>
								</tbody>
								</table>
								
							 </div>							
							 </div>							
							</div>
							</div>	
						</div>
				
				
			<div class="form-group col-lg-12">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                     <?php echo $this->Form->input('Approve',array('label'=>false,'div' => false,'type '=> 'button','class'=>'btn btn-primary btn-cons','name'=>'register-submit','value'=>'Approve','id'=>'approveButton'));?>
					  <?php echo $this->Form->input('Deny',array('label'=>false,'div' => false,'type '=> 'button','class'=>'btn btn-danger btn-cons','name'=>'register-submit','value'=>'Deny','id'=>'denyButton'));?>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
				</div>
			</div>	
		</div>
        </div>
    </div>
</div>
<?php //echo $this->element('sql_dump'); ?>