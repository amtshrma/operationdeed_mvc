<div class="logoHeaderR"> <a href="#menu-toggle" class="nav-icon" id="menu-toggle"></a>
    <div class="clearfix"></div>
</div>
<div id="sidebar-wrapper" class="eqHeight customScroll sidebar-menu-box">
    <div class="user-pr"><?php
    $image  = $this->Session->read('userData.UserDetail.profile_picture');
    if($image != 'defaultUser.jpg' && !empty($image)){
        echo $this->Html->image('profile_pics/thumb/'.$image,array('class' => 'img-responsive img-circle'));
    }else{
        echo $this->Html->image('index.png',array('class' => 'img-responsive img-circle'));
    }?>
        <h3>Welcome <?php echo $this->Session->read('userInfo.first_name');?></h3>
    </div>
    <ul class="sidebar-nav">
        <li>
            <?php echo $this->Html->link('<span class="la icon-1"></span>Dashboard',array('controller'=>'borrowers','action'=>'dashboard'),array('escape'=>false));?>
        </li>
        <?php
        // find short app for based on ID
        $action = array('controller'=>'longApp','action'=>'shortApp');
        if($this->Common->findShortApp($this->Session->read('userInfo.email_address'))){
            $action = array('controller'=>'longApp','action'=>'longAppStep1');
        }
        ?>
        <li>
            <?php echo $this->Html->link('<span class="la icon-2"></span>Long App',$action,array('escape'=>false,'class'=>'active'));?>
        </li>
        <li>
            <?php echo $this->Html->link('<span class="la icon-3"></span>Sign Out',array('controller'=>'borrowers','action'=>'logout'),array('escape'=>false));?>
        </li>
    </ul>
    <div class="col-sm-11 rock-mg">
        <center><?php echo $this->Html->image('longApp/rock-logo.png',array('class' => 'img-responsive'));?></center>
    </div>
</div>