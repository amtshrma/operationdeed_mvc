<div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
 <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrappers">
  <!-- BEGIN MINI-PROFILE -->
   <div class="user-info-wrapper">	
	<div class="profile-wrapper">
	 <?php  echo $this->Html->image('avatar.jpg', array("width"=>"69","height"=>"69"));?>
	</div>
    <div class="user-info">
	  <div class="greeting">Welcome</div>
	  <div class="username">
		<?php
		$userData  = $this->Session->read('userInfo');
		if(!empty($userData) && $userData['first_name'] !='') {
		  echo $userData['first_name']; ?> <span class="semi-bold"><?php echo $userData['last_name']; ?></span>
		<?php }?>
      </div>
	  <div class="status">Status<a href="#">
		<div class="status-icon green"></div>
		Online</a>
	  </div>
    </div>
   </div>
  <!-- END MINI-PROFILE -->
  
  <!-- BEGIN MINI-WIGETS -->

   <!-- END MINI-WIGETS -->
   
   <!-- BEGIN SIDEBAR MENU -->	
	<p class="menu-title">BROWSE <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
      <ul>
         <li class="start">
         <?php
		 $controller = 'admins';
		 if(!empty($userData) && $userData['controller'] !=''){
		   $controller = $userData['controller'];
		 }
		 echo $this->Html->link('<i class="icon-custom-home"></i> <span class="title">Dashboard</span>',array('controller'=> $controller,'action'=>'dashboard'),array('escape' =>false,'Dashboard'));?>        
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
		  } }?>
       
      </ul>
	<div class="clearfix"></div>
    <!-- END SIDEBAR MENU --> 
 </div>

   <div class="inner-menu nav-collapse">   
    <div id="inner-menu">
        <div class="inner-wrapper" >
		 <?php echo $this->Html->link('<span class="bold">Compose</span>',array('controller'=>'messages', 'action'=>'compose'),array('class'=>'btn btn-block btn-primary','escape'=>false)); ?>
          
         </div>
         <div class="inner-menu-content">
          <p class="menu-title">FOLDER <span class="pull-right"><i class="icon-refresh"></i></span></p>
          </div>
         <ul class="big-items">
          <li class="active"><span class="badge badge-important">2</span><?php echo $this->Html->link('Inbox',array('controller'=>'messages','action'=>'index')) ;?></li>
          <li><?php echo $this->Html->link('Sent',array('controller'=>'messages','action'=>'sent')) ;?></li>
          
         </ul>
     </div> 
  </div>
 </div>
  <a href="#" class="scrollup">Scroll</a>
  <!-- END SIDEBAR --> 