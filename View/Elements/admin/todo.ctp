<div class="table-responsive">									
	<table class="table table-striped table-fixed-layout table-hover" id="emails" > 
	  <thead>
		<tr>
		  
		  <th class="medium-cell"></th>
		 
		  <th class="medium-cell"></th>
		</tr>
	  </thead>
	  <tbody>
	  <?php 
	  if(count($allTodos) >0) {
	  foreach($allTodos as $toDo) { ?>
		<tr>
		
		 
		 <td  class="tablefull v-align-middle"><?php echo $toDo['Todo']['to_do']; ?></td>
		  <td class="tablefull v-align-middle"><?php echo date("jS M, Y", strtotime($toDo['Todo']['created'])); ?></td>
	   
		</tr>
		<?php } } else { ?>
		<tr>
			<td colspan="5" align="center">No Records Found</td>
		</tr>
		<?php  }?>
	</tbody>
	</table>
 </div>	