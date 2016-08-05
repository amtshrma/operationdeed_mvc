<!-- Page Content -->
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
		<div class="col-md-8">
        <!--<div class="content-container">-->
		<h3><span class="semi-bold">Notifications</span></h3><hr />
			<p><?php echo $this->Session->flash();?></p>
            <?php
                if(count($getData)){
                    foreach($getData as $key=>$notification) { 
						$notificationID = $notification['Notification']['id'];
						$notificationContent = $this->Common->getCommonNotificationDetail($notificationID);
						if(isset($notificationContent) && $notificationContent != ''){
							$userDetail = $this->Common->getUserDetail($notification['Notification']['sender_id']);
							if(!isset($userDetail['User'])){
								continue;
							}
						?>
							<div class="alert alert-info">
								<p>
									<?php
										echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ';
										echo '<b>'.ucfirst($userDetail['User']['name']).'</b>, perform the action : '.$notificationContent;
									?>
								</p>
							</div>
					<?php
						}
					}
				}else{?>
					<div class="alert alert-danger">
						No Records Found
					</div>
        <?php  } ?>
			<div class="paging" align="right">
			<?php
				if(count($getData)){?>
					<ul class="pagination">                
						<li class="disabled"><?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?></li>
						<li><?php  echo $this->Paginator->numbers(array('separator' => ''));?></li>
						<li><?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?></li>
					</ul>             
			<?php } ?>
			</div>
		</div>
	</div>
  <!-- END PAGE --> 
</div>