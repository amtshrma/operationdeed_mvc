<div class="page-title"> 
        
		<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Compose</button>','javascript:void(0);',array('escape' => false,'title' => 'Compose','id'=>'composeMessageButton'));?>
      </div>
<div class="table-responsive">
	
	<table class="table table-striped table-fixed-layout table-hover" id="emails" > 
	  <thead>
		<tr>
		  <th class="small-cell"></th>
		  <th class="small-cell"></th>
		  <th class="medium-cell"></th>
		  <th ></th>
		  <th class="medium-cell"></th>
		</tr>
	  </thead>
	  <tbody>
	  <?php 
	  if(count($allMessages) >0) {
	  foreach($allMessages as $message) { ?>
		<tr>
		 <td  class="small-cell v-align-middle">
		  <div class="checkbox check-success ">
		  
				<input  type="checkbox" value="1" >
				<label for="checkbox8"></label>
			</div>
		 </td>
		  <td  class="small-cell v-align-middle">
		   <div class="star">
			<input id="checkbox9" type="checkbox" value="1" checked >
				<label for="checkbox9"></label>
			</div>
		  </td>
		  <td  class="v-align-middle">David Nester</td>
		 <td  class="tablefull v-align-middle"><?php echo substr($message['Message']['message'],0,100); ?></td>
		  <td class="tablefull v-align-middle"><?php echo date("jS M, Y", strtotime($message['Message']['created'])); ?></td>
	   
		</tr>
		<?php } } else { ?>
		<tr>
			<td colspan="5" align="center">No Records Found</td>
		</tr>
		<?php  }?>
	</tbody>
	</table>
 </div>	