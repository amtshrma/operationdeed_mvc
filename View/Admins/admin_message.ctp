
<div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="content">    
	<div class="page-title" style="display:none"> <a href="#" id="btn-back"><i class="icon-custom-left"></i></a>
        <h3>Back- <span class="semi-bold">Messages</span></h3>
     </div>		
		<div class="row"  id="inbox-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="grid-body no-border email-body" >
							<br>
							 <div class="row-fluid" >
							 <div class="row-fluid dataTables_wrapper">
								<h2 class=" inline">Messages </h2>
								<!--div class="pull-right margin-top-20">
									<div class="dataTables_paginate paging_bootstrap pagination">
										<ul>
											<li class="prev disabled"><a href="#"><i class="fa fa-chevron-left"></i></a></li>
											<li class="active"><a href="#">1</a></li><li><a href="#">2</a></li>
											<li class="next"><a href="#"><i class="fa fa-chevron-right"></i></a></li>
										</ul>
									</div>
									<div class="dataTables_info hidden-xs" id="example_info">Showing <b>1 to 10</b> of 14 entries</div></div-->
									<div class="clearfix"></div>
								</div>
								
								<div id="email-list">									
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
                                  if(count($getData) >0) {
                                  foreach($getData as $message) { ?>
									<tr >
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
							 </div>							
							</div>
							</div>	
						</div>
					</div>
				</div>	
		</div>
		
	
  </div>
   <div class="clearfix"></div>
	<div class="admin-bar" id="quick-access" style="display:block">
		<div class="admin-bar-inner">
		
			<button class="btn btn-danger  btn-add" id="deleteMessage" type="button"><i class="icon-trash"></i> Move to trash</button>
			<button class="btn btn-white  btn-cancel" type="button">Cancel</button>
		</div>
	</div> 
  <!-- END PAGE --> 
</div>