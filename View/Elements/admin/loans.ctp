<?php
$this->Js->JqueryEngine->jQueryObject = 'jQuery';
$this->Paginator->options(array(
	'update' => '#paginatedata',
	'evalScripts' => true,
	'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
	'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false))
));
if(!empty($loans)) {?>
    <table class="table table-striped table-flip-scroll cf table-hover table-condensed">
		<thead>
			<tr>
				<th style="width:1%" data-hide="phone,tablet">
					<div class="checkbox check-default">
					  <input type="checkbox" value="1" class="checkall" id="checkall">
					  <label for="checkall"></label>
					</div>
				</th>
				<th style="width:1%" data-hide="phone,tablet"><?php echo $this->Paginator->sort('Loan.status', 'Status'); ?></th>
				<th style="width:6%" ><?php echo $this->Paginator->sort('ShortApplication.loan_type', '	Loan Type'); ?></th>					
				<th style="width:3%"><?php echo $this->Paginator->sort('Loan.loan_amount', 'Loan Amount ($)'); ?></th>
				<th style="width:6%" ><?php echo $this->Paginator->sort('Loan.proprty_type', 'Property Type'); ?></th>
				<th style="width:5%" ><?php echo $this->Paginator->sort('state', 'State'); ?></th>
				<th style="width:5%"><?php echo $this->Paginator->sort('city', 'City'); ?></th>
				<th style="width:5%" >Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$i=1;
			foreach($loans as $key => $loan) {
				$loanid = $loan['Loan']['id'];
				$class = ($key%2 == 0) ? ' class="active"' : '';
				$status = $loan['Loan']['status'];
			?>				
            <tr>
                <td class="v-align-middle">
                    <div class="checkbox check-default">
                        <input type="checkbox" name="checkboxes[]" class ="chld" value="<?php echo base64_encode($loanid);?>" id="checkbox_<?php echo $i; ?>">
                        <label for="checkbox_<?php echo $i; ?>"></label>
                    </div>
                </td>
                <td class="v-align-middle">
                <?php
					if(array_key_exists($status, $loanStatus)) {
						echo $this->Form->button($loanStatus[$status], array('class'=>$statusClass[$status], 'id'=>base64_encode($loanid), 'value'=>$status, 'rel'=>'Loan', 'fld'=>'status'));
					}
				?>
                </td>
				<td class="v-align-middle"><?php $loanTypeId = $loan['ShortApplication']['loan_type']; echo array_key_exists($loanTypeId, $loanTypes)?$loanTypes[$loanTypeId]:''; ?></td>
				<td align="right"><?php echo _numberFormatCS($loan['ShortApplication']['loan_amount']); ?></td>
				<td><?php echo $loan['ShortApplication']['property_type']; ?></td>
				<td><?php echo ucfirst($this->Common->getStateName($loan['ShortApplication']['property_state'])); ?></td>
				<td><?php echo ucfirst($this->Common->getCityName($loan['ShortApplication']['property_city'])); ?></td>
                <td class="v-align-middle">
					<div class="fa-hover">
						<?php
						echo $this->Html->link('<i class="fa fa-male"></i>', array('controller'=>'users','action'=>'admin_view_user', base64_encode(base64_encode($loan['Loan']['borrower_id']))), array('escape' =>false, 'title'=>'View Borrower', 'alt'=>'View Borrower'));
						
						echo '&nbsp;&nbsp;';
						echo $this->Html->link('<i class="fa fa-sitemap"></i>', array('controller'=>'admins', 'action'=>'admin_loan_logs', base64_encode(base64_encode($loan['Loan']['short_app_id']))),array('escape' =>false, 'title'=>'View Loan Logs', 'alt'=>'View Loan Logs'));
						
						echo '&nbsp;&nbsp;';
						echo $this->Html->link('<i class="fa fa-anchor"></i>', array('controller'=>'admins', 'action'=>'admin_loan_timeline', base64_encode(base64_encode($loanid))),array('escape' =>false, 'title'=>'View Project Timeline / Loan Tracking System', 'alt'=>'View Project Timeline / Loan Tracking System'));
						?>
					</div>
				</td>
				</tr>
              <?php $i++;
			} ?>
		</tbody>
    </table>
        <div class="row grid-title">
            <div class="col-lg-3">
                <?php						
					echo $this->Form->select('status', $loanStatus, array('empty'=>'Select one to change status', 'class'=>'form-control chngstatus', 'rel'=>'Loan', 'fld'=>'status')); ?>
            </div>
            <div class="col-lg-9">
                <div class="paging" align="right">
                    <?php
                    if(count($loans) > 0) {
                        echo $this->element('pagination');                    
                    }                
                    ?>
                </div>
            </div>
        </div>
        <div class="row form-row">
			<div class="col-lg-1"> LEGENDS:</div>
			<div class="col-lg-2"><?php echo '<i class="fa fa-male"></i> View Borrower &nbsp;'; ?></div>
			<div class="col-lg-2"><?php echo '<i class="fa fa-sitemap"></i> View Loan Logs &nbsp;'; ?></div>
			<div class="col-lg-3"><?php echo '<i class="fa fa-anchor"></i> View Project Timeline &nbsp;'; ?></div>
			<div class="col-lg-2"><?php echo '<i class="fa fa-thumbs-up green"></i> Active &nbsp;'; ?></div>
			<div class="col-lg-2"><?php echo '<i class="fa fa-thumbs-down red"></i> Inactive &nbsp;'; ?></div>
        </div>
		<?php
}else{
	echo $this->element('admin/no_record_exists');
}
?>