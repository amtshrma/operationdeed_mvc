<div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
      <div class="user-info-wrapper">
        <div class="profile-wrapper">
        <?php  echo $this->Html->image('h.jpg', array("width"=>"69","height"=>"69"));?>
        </div>
        <div class="user-info">
          <div class="greeting">Welcome</div>
          <div class="username">
          <?php
          $userData  = $this->Session->read('userInfo');
          if(!empty($userData) && $userData['first_name'] !='') {
            echo $userData['first_name']; ?> <span class="semi-bold"><?php echo $userData['last_name']; ?></span>
          <?php } ?>
          </div>
          <div class="status">Status<a href="#"><div class="status-icon green"></div>Online</a></div>
        </div>
      </div>
      <!-- END MINI-PROFILE -->
      <!-- BEGIN SIDEBAR MENU -->
      <p class="menu-title">BROWSE <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
      <ul>
        <li class="start">
         <?php
         $controller = 'admins';
		  if(!empty($userData) && $userData['controller'] !='') {
		   $controller = $userData['controller'];
		   $userID = $userData['id'];
		  }
          echo $this->Html->link('<i class="icon-custom-home"></i> <span class="title">Dashboard</span>',array('controller'=> 'homes','action'=>'dashboard'),array('escape' =>false,'Dashboard'));
		// echo $this->Html->link('<i class="fa fa-user"></i> <span class="title">My Account</span>',array('controller'=> 'commons','action'=>'my_account'),array('escape' =>false,'My Account'));
		 ?>        
        </li>
        <?php
        $links = $this -> requestAction(array('controller' => 'admins','action' => 'getAllLinks'));        
        if(count($links) >= 1) {
		  
          foreach($links as $linkData) {
			
            if($linkData != '' && isset($linkData)) {
			  
              if(($linkData['Controller'] == $this->params['controller']) && ($linkData['Action'] == $this->params['action'])) {
				
                $activeStatus ="active";
              }else {
				
                $activeStatus =""; 
              }
			  
              $action =str_replace("admin_","",$linkData['Action']);
              $name =str_replace("Manage","",$linkData['Name']);
			  ?>
			  <li class= "<?php echo $activeStatus; ?>">
			  <?php echo $this->Html->link('<i class="fa '.$linkData['Icon'].'"></i><span class="title">'.$linkData['Name'].'</span>',array("controller"=>$linkData['Controller'], "action" =>$linkData['Action']),array('escape' =>false,'title' => $linkData['Name']));?></li>
			  <?php
			}
		  }
        } ?>
        
	  </ul>
      <div class="clearfix"></div>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>