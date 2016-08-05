<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3><span class="semi-bold">Active Users</span></h3>
		<div class="row">
			<?php
			$search = '';
			if(isset($this->request->query['search'])){
				$search = $this->request->query['search'];
			}
			echo $this->Form->create('Search',array('type'=>'get','novalidate'=>true));?>
			<div class="col-md-2">
				<?php echo $this->Form->input('search',array('label' => false,'div' => false,'empty'=>'Select Option', 'options' => array(base64_encode(1)=>'Borrower',base64_encode(2)=>'Broker',base64_encode(3)=>'Sales Manager'), 'class' => 'form-control','default'=>$search));?>
			</div>
			<div class="col-md-1">
				<?php echo $this->Form->submit('Search',array('label' => false,'div' => false, 'class' => 'btn btn-primary form-control'));?>
			</div>
			<div class="col-md-1">
				<?php echo $this->Html->Link('List All',array('controller'=>'sales_directors','action'=>'user_list'),array('class' => 'btn btn-default form-control'));?>
			</div>
			<?php echo $this->Form->end();?>
		</div>
		<div class="row">
			<div class="table-responsive">
				<p><?php echo $this->Session->flash();?></p>
				<table class="table table-bordered table-hover" id="Loans" > 
				<thead>
					<tr>
						<th class="small-cell">Sr No.</th>
						
						<th class="small-cell">User Type</th>
						<th class="small-cell">Email Address</th>
						<th class="small-cell">Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if(count($users)){
						foreach($users as $key => $user) {
							$userID  = $user['User']['id'];
							$userDetail = $this->Common->getUserDetail($userID);?>
							<tr>
							   <td class="small-cell v-align-middle"><?php echo $key+1;?></td>
							 
							   <td class="small-cell v-align-middle">
									<?php echo ucfirst($user['User']['name']) ; ?>									
							   </td>
							   <td class="small-cell v-align-middle"><?php echo $user['User']['email_address']; ?></td>
						
							<td class="small-cell v-align-middle">
							<?php
							   echo '&nbsp;&nbsp;';
							   echo $this->Html->link('View Detail', 'javascript:void(0);',array('escape' =>false, 'title'=>'View Detail'));
							 ?>
							</td>
						</tr>
					<?php											
						}
					}else{?>
						<tr>
							<td colspan="8" align="center">No active user in your hireachy.</td>
						</tr>
				<?php } ?>
					</tbody>
				</table>
				<div class="paging" align="right">
				<?php
					if(count($users)){?>
						<ul class="pagination">                
							<li class="disabled"><?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?></li>
							<li><?php  echo $this->Paginator->numbers(array('separator' => ''));?></li>
							<li><?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?></li>
						</ul>             
				<?php } ?>
				</div>
				<?php //echo $this->Form->select('assign_loan', $teams, array('div'=>false, 'label'=>false, 'empty'=>'Select One')); ?>
			</div>
		</div>
	</div>
  <!-- END PAGE --> 
</div>