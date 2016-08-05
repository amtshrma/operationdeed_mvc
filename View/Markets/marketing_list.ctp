<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <!--<div class="content-container">-->
		<h3>Marketing List></h3><hr />
		<p><?php echo $this->Session->flash();?></p>
        <div class="table-responsive">
		<?php echo $this->Form->create('MarketList', array('id'=>'MarketList', 'novalidate'=>'novalidate'));?>
		<div class="col-md-12">
			<div class="col-md-3">
                <?php echo $this->Form->input('MarketList.ShortApplication.property_type',array('options'=>$property_type,'label' => false, 'div' => false, 'empty'=>'Select Property', 'class' => 'form-control','id'=>'NewsletterTemplate'));?>
            </div>
			<div class="col-md-3">
				<?php echo $this->Form->input('MarketList.Loan.create',array('label' => false, 'div' => false, 'placeholder'=>'Loan Originate date', 'class' => 'form-control date','id'=>'loanOriginateDate'));?>
			</div>
            <div class="col-md-3">
                <?php echo $this->Form->input('MarketList.Loan.loan_maturity_date',array('label' => false, 'div' => false, 'placeholder'=>'Loan Maturity date', 'class' => 'form-control date','id'=>'loanMaturityDate'));?>
            </div>
			<div class="col-md-3">
				<?php echo $this->Form->input('MarketList.SoftQuote.interest_rate',array('type'=>'number','label' => false, 'div' => false, 'placeholder'=>'Loan Interest', 'class' => 'form-control','id'=>'loanInterest'));?>
			</div>
		</div><br /><br />
		<div class="col-md-12">
			<div class="col-md-3">
				<?php echo $this->Form->input('MarketList.ShortApplication.loan_to_value',array('options'=>$loanToValue,'label' => false, 'div' => false, 'empty'=>'Loan Value', 'class' => 'form-control','id'=>'loanInterest'));?>
			</div>
			<div class="col-md-3">
				<?php
					echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-success btn-cons'));
				?>
			</div>
			<div class="col-md-3">
				<?php
					echo $this->Html->link('Export As Excel', array('controller' => 'markets','action'=>'createExcelMarketList'),array('class' => 'btn btn-success btn-cons'));
				?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<br /><br /><br /><br />
        <table class="table table-bordered table-condensed table-hover" id="example">
			<thead>
                <tr>
					<th style="width:8%">Team</th>
					<th style="width:8%">Borrower</th>
					<th style="width:8%" data-hide="phone,tablet">Loan Date</th>
					<th style="width:8%" data-hide="phone,tablet">Property Location</th>
					<th style="width:8%" data-hide="phone,tablet">Loan Reason</th>
					<th style="width:8%" data-hide="phone,tablet">Loan Amount</th>
					<th style="width:8%" data-hide="phone,tablet">Interest Rate</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(count($loanData)){
                foreach($loanData as $key=>$val){?>
					<tr>
						<td><?php echo $this->Common->getTeamName($val['Loan']['team_id']);?></td>
						<td><?php echo $val['ShortApplication']['applicant_first_name'].' '.$val['ShortApplication']['applicant_last_name'];?></td>
						<td><?php echo date('M d Y',strtotime($val['Loan']['created']));?></td>
						<td><?php echo $val['ShortApplication']['property_address'].' '.$this->Common->getStateName($val['ShortApplication']['property_state']).' '.$this->Common->getCityName($val['ShortApplication']['property_city']);?></td>
						<td><?php echo $val['ShortApplication']['loan_objective'];?></td>
						<td><?php echo '$'.$val['ShortApplication']['loan_amount'];?></td>
						<td><?php echo (!empty($val['SoftQuote']['interest_rate'])) ? $val['SoftQuote']['interest_rate'] : 'N/A'.' %';?></td>
                    </tr>
			<?php }
            }
            ?>
            </tbody>
        </table>
        <?php echo $this->Element('/admin/pagination');?>
		</div>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    jQuery(".date").datepicker({
			dateFormat : 'mm/dd/yy'
	});
});
</script>