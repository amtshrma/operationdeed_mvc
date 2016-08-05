<div class="logoHeaderR"> <a href="#menu-toggle" class="nav-icon" id="menu-toggle"></a>
    <div class="clearfix"></div>
</div>
<div id="sidebar-wrapper" class="eqHeight customScroll sidebar-menu-box">
    <div class="user-pr">
        <?php
        $userData  = $this->Session->read('userInfo');
        $userDetail  = $this->Session->read('userDetail');
        $image  = $this->Session->read('userDetail.profile_picture');
        if($image != 'defaultUser.jpg' && !empty($image)){
            echo $this->Html->image('profile_pics/thumb/'.$image,array('class' => 'img-responsive img-circle','width'=>'80px;'));
        }else {
            echo $this->Html->image('index.png',array('class' => 'img-responsive img-circle'));
        }?>
        <h3>Welcome <?php echo $this->Session->read('userInfo.first_name');?></h3>
    </div>
    <!-- /.navbar-top-links -->
    <ul class="sidebar-nav">
        <li>
        <?php //pr($userData);
            $controller = 'admins';
            if(!empty($userData) && $userData['controller'] !='') {
                $controller = $userData['controller'];
                $userID = $userData['id'];
            }
            echo $this->Html->link('<i class="fa fa-home fa-fw-2x"></i> <span class="title">Dashboard</span>',array('controller'=> 'escrows','action'=>'dashboard'),array('escape' =>false,'Dashboard'));
            ?>        
        </li>
       <li><?php echo $this->Html->link('<i class="fa fa-sign-out"></i><span class="title"> Sign Out</span>',array("controller"=>'escrows', "action" =>'logout'),array('escape' =>false,'title' => 'Sign Out')); ?></li>
    </ul>
    <div class="col-sm-11 rock-mg">
        <center><?php echo $this->Html->image('longApp/rock-logo.png',array('class' => 'img-responsive'));?></center>
    </div>
</div>