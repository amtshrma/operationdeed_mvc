<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3><span class="semi-bold">Notification</span></h3>
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="emails" > 
                <thead>
                    <tr>
						<th style="text-align:center" class="tablefull v-align-middle">Notification</th>
						<th style="text-align:center" class="small-cell v-align-middle">Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
					if(count($allNotifications)){
                        foreach($allNotifications as $key=>$notifications){
                            $notificationID = $notifications['Notification']['id'];
                            $notification = $this->Common->getNotificationDetail($notificationID);?>
							<tr>
								<td class="tablefull v-align-middle"><?php echo $notification; ?></td>
								<td class="small-cell v-align-middle">
								<?php
                                      if(isset($notifications['Notification']['created']) && $notifications['Notification']['created'] != ''){
                                      echo date("jS M, Y", strtotime($notifications['Notification']['created']));
									} else {
                                        echo "--";
                                     } ?>
								</td>
							</tr>
				    <?php }
					}else{?>
                        <tr>
                            <td colspan="4">No Notification</td>
                        </tr>
                    <?php } ?>
                    </tbody>
            </table>
			<div class="paging" align="right">
			<?php
				if(count($allNotifications)){?>
					<ul class="pagination">                
						<li class="disabled">
							<?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?>
						</li>
						<li>
							<?php  echo $this->Paginator->numbers(array('separator' => ''));?>
						</li>
						<li>
							<?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?>
						</li>
					</ul>
			<?php
				}                
			?>
			</div>
		</div>	
	</div>	
<!-- END PAGE --> 
</div>