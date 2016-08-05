<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
          <div class="iconset top-menu-toggle-white"></div>
          </a> </li>
      </ul>
      <!-- BEGIN LOGO -->
      <?php //echo 'RockLand';
      
      echo $this->Html->link($this->Html->image('logo.png', array("class" => 'logo1',"width"=>"125","height"=>"54")),"/",array("escape"=>false)); ?>
      <!-- END LOGO -->
      <ul class="nav pull-right notifcation-center">
        <li class="dropdown" id="header_task_bar">
          <?php echo $this->Html->link('<div class="iconset top-home"></div>',array("controller"=>"brokers","action"=>"dashboard"),array("escape"=>false, "class" =>"dropdown-toggle active","data-toggle"=>"")); ?>
        </li>
        <!--<li class="dropdown" id="header_inbox_bar" > <a href="email.html" class="dropdown-toggle" >
          <div class="iconset top-messages"></div>         
          <span class="badge" id="msgs-badge">3 </a></li>-->
        <li class="dropdown" id="portrait-chat-toggler" style="display:none"> <a href="#sidr" class="chat-menu-toggle">
          <div class="iconset top-chat-white "></div>
          </a> </li>
      </ul>
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="header-quick-nav" >
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
            <div class="iconset top-menu-toggle-dark"></div>
            </a> </li>
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
      <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right">
        <div class="chat-toggler"> <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content='' data-toggle="dropdown" data-original-title="Notifications">
         
          <?php $allNotifications = $this->requestAction(array('controller'=>'homes', 'action'=>'getAllNotification')); ?>
            <div class="user-details">
              <div class="username">
              <?php if(count($allNotifications) >0 ){  ?>
                <span class="badge badge-important"><?php echo count($allNotifications); ?></span>
               <?php } 
                $userData  = $this->Session->read('userInfo');
                echo $userData['first_name'].' '.$userData['last_name'];?>
                <span class="bold">(<?php $utype = $userData['user_type']; echo $userTypes[$utype]; ?>)</span>
            </div>
          </div>
          <div class="iconset top-down-arrow"></div>
          </a>
          <div id="notification-list" style="display:none">
            <div style="width:300px">
            <?php
                  if(count($allNotifications) > 0) {
                    
                    foreach($allNotifications as $key=>$notification) {
                      
                      $notificationID = $notification['Notification']['id'];
                      $notificationContent = $this->Common->getCommonNotificationDetail($notificationID);
                      
                      if(isset($notificationContent) && $notificationContent != '') {
                        
                      ?>
                      <div class="notification-messages info">
                        <div class="user-profile">  </div>
                        <div class="message-wrapper">
                          <div class="description">
                          <?php echo $this->Form->hidden('notificationID_'.$notificationID,array('class'=>'unique-notification','value'=> $notificationID));
                          echo $notificationContent; ?> </div>
                          <div class="date pull-left"><?php echo date("jS F,Y", strtotime($notification['Notification']['created']));?></div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
             <?php }
             if($key >=4){ ?>
             
              <?php echo $this->html->link('See More',array('controller'=>'notifications','action'=>'index'),array('class'=>'pull-right','style'=>'font-size:11px;','title'=>'Click to see more')); ?>
              
              <?php break;
             }
             } } else { ?>
              <div class="notification-messages info">
                <div class="message-wrapper">
                  <div class="description"> No notification found</div>
                </div>
              </div>
             <?php } ?>
            </div>
          </div>
          <!--div class="profile-pic">
          <?php //echo $this->Html->image('avatar_small.jpg', array("width"=>"35","height"=>"35"));?>
          </div-->
        </div>
        <ul class="nav quick-section">
          <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
            <div class="iconset top-settings-dark "></div>
            </a>
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
              <!--<li><a href="user-profile.html"> My Account</a> </li>
              <li><a href="calender.html">My Calendar</a> </li>
              <li><a href="email.html"> My Inbox&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a> </li>-->
              <li><?php echo $this->Html->link('<i class="fa fa-user"></i> <span class="title">My Account</span>',array('controller'=> 'commons','action'=>'my_account'),array('escape' =>false,'My Account')); ?></li>
              <li class="divider"></li>
              <li><?php echo $this->Html->link('<i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out',array('controller'=> 'homes','action'=>'logout'),array('escape' =>false,'title' => 'Logout'));?></li>            
            </ul>
          </li>
          <li class="quicklinks"> <span class="h-seperate"></span></li>
          <!--li class="quicklinks"> <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" >
            <div class="iconset top-chat-dark "><span class="badge badge-important hide" id="chat-message-count">1</span></div>
            </a>
            <div class="simple-chat-popup chat-menu-toggle hide" >
              <div class="simple-chat-popup-arrow"></div>
              <div class="simple-chat-popup-inner">
                <div style="width:100px">
                  <div class="semi-bold">David Nester</div>
                  <div class="message">Hey you there </div>
                </div>
              </div>
            </div>
          </li!-->
        </ul>
      </div>
      <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->