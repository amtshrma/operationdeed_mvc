 <div class="container">
    <div class="compressed">
      <div class="navbar-header">
        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <?php echo $this->html->link($this->html->image('logo.png',array('data-src' => Configure::read('BASE_URL').'img/logo.png','data-src-retina' => Configure::read('BASE_URL').'img/logo.png','width' => '119','height' => '80')),'javascript:void(0)',array('escape'=>false,'class'=>'navbar-brand compressed'));?>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right" >
          <li><?php echo $this->Html->link('Home',array('controller'=>'homes','action'=>'index')); ?></li>
      
          
         <li><?php echo $this->Html->link('Short App',array('controller'=>'borrowers','action'=>'shortapp')); ?></li>
          <!--li><?php echo $this->Html->link('Messages',array('controller'=>'borrowers','action'=>'messages')); ?></li-->
          <li>
               <?php $notifications = $this->requestAction(array('controller'=>'homes', 'action'=>'getUnreadNotification'));
               if($notifications > 0){
                  $link = '<span class="badge badge-important">'.$notifications.'</span> Notifications'; 
               }else {
                  $link = 'Notifications';
               }
               echo $this->Html->link($link,array('controller'=>'borrowers','action'=>'dashboard'), array('escape'=>false)); ?>

          </li>
          <?php  
          $userData  = $this->Session->read('userInfo'); 
          if(!empty($userData) && $userData['first_name'] != '') { ?>
          <li><?php echo $this->Html->link('Logout', array('controller'=>'homes','action'=>'borrower_logout'),array('escape' =>false,'title' => 'Logout'));?></li>
          <?php } ?>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
