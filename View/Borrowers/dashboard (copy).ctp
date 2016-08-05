<div class="section first">
    <div class=" p-b-60">
    <div class="section dark-grey p-t-20  p-b-20 m-b-50">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Notification</h2>
          </div>
          
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
        <div class="container">
          <div class="row"  id="inbox-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="grid-body no-border email-body" >
							<br>
							 <div class="row-fluid" >
							 <div class="row-fluid dataTables_wrapper">
								
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
									  
									  <th class="medium-cell"></th>
									  <th ></th>
									  <th class="medium-cell"></th>
									</tr>
								  </thead>
								  <tbody>
                                  <?php //$userData = $this->Session->read('userInfo'); pr($userData);
                                  if(count($allNotifications) >0) { //pr($allNotifications);
                                  foreach($allNotifications as $notifications){ ?>
									<tr>
									 <td  class="small-cell v-align-middle"></td>
									  <td  class="small-cell v-align-middle">
									   <div class="star">
										<input id="checkbox9" type="checkbox" value="1" checked >
											<label for="checkbox9"></label>
										</div>
									  </td>
                                      <?php
                                       $notificationID = $notifications['Notification']['id'];
                                        $notification = $this->Common->getNotificationDetail($notificationID);?>
                                      
									 <td  class="tablefull v-align-middle"><?php echo $notification; ?></td>
									  <td class="tablefull v-align-middle"><?php
                                      if(isset($notifications['Notification']['created']) && $notifications['Notification']['created'] != ''){
                                      echo date("jS M, Y", strtotime($notifications['Notification']['created'])); ?></td>
								   <?php } else {
                                        echo "--";
                                     } ?>
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
    </div>
</div>