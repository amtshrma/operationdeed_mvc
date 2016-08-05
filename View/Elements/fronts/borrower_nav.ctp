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
            <?php echo $this->Html->link('<i class="fa fa-home fa-fw" style="font-size:20pt"></i>&nbsp; Dashboard',array('controller'=>'borrowers','action'=>'dashboard'),array('escape'=>false));?>
        </li>
        <?php
            // find short app for based on ID
        $action = array('controller'=>'longApp','action'=>'shortApp');
        $this->Common->findShortApp($this->Session->read('userInfo.id'));
        if($this->Common->findShortApp($this->Session->read('userInfo.id')) == '1'){
            $action = array('controller'=>'longApp','action'=>'longAppStep1');
        }else if($this->Common->findShortApp($this->Session->read('userInfo.id')) == '2'){
            $action = 'javascript:void(0);';
        }
        ?>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-clipboard fa-fw" style="font-size:20pt"></i>&nbsp; Long App',$action,array('escape'=>false));?>
        </li>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-clipboard fa-fw" style="font-size:20pt"></i>&nbsp; Change Password',array('controller'=>'commons','action'=>'change_password'),array('escape'=>false));?>
        </li>
		<li>
            <?php echo $this->Html->link('<i class="fa fa-clipboard fa-fw" style="font-size:20pt"></i>&nbsp; Loans',array('controller'=>'borrowers','action'=>'borrowerLoans'),array('escape'=>false));?>
        </li>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-clipboard fa-fw" style="font-size:20pt"></i>&nbsp; Notification',array('controller'=>'borrowers','action'=>'notifications'),array('escape'=>false));?>
        </li>
		<li>
            <?php echo $this->Html->link('<i class="fa fa-power-off fa-fw" style="font-size:20pt"></i>&nbsp; Sign Out',array('controller'=>'homes','action'=>'logout'),array('escape'=>false));?>
        </li>
    </ul>
    <div class="col-sm-11 rock-mg">
        <center><?php echo $this->Html->image('longApp/rock-logo.png',array('class' => 'img-responsive'));?></center>
    </div>
</div>






<?php /*

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color:#D6DCE2;max-height:50px">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html"></a>
    </div>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu" style="color:#FFF">
                <center>
                <?php
                $userData  = $this->Session->read('userInfo');
                $userDetail  = $this->Session->read('userDetail');
                $image  = $this->Session->read('userDetail.profile_picture');
                if($image != 'defaultUser.jpg' && !empty($image)){
                    echo $this->Html->image('profile_pics/thumb/'.$image,array('class' => 'img-responsive img-circle','width'=>'80px;'));
                }else{
                    echo $this->Html->image('index.png',array('class' => 'img-responsive img-circle'));
                }?>
                <br><br>
                <b>Welcome <?php echo $this->Session->read('userInfo.first_name');?></b>
                </center>
                <br><br><br>
                </center>
                <li>
                    <?php echo $this->Html->link('<i class="fa fa-home fa-fw" style="font-size:20pt"></i>&nbsp; Dashboard',array('controller'=>'borrowers','action'=>'dashboard'),array('escape'=>false));?>
                </li>
                <?php
                    // find short app for based on ID
                    $action = array('controller'=>'longApp','action'=>'shortApp');
                    if($this->Common->findShortApp($this->Session->read('userInfo.email_address')) == '1'){
					$action = array('controller'=>'longApp','action'=>'longAppStep1');
				}else if($this->Common->findShortApp($this->Session->read('userInfo.email_address')) == '2'){
					$action = 'javascript:void(0);';
				}
                ?>
                <li>
                    <?php echo $this->Html->link('<i class="fa fa-clipboard fa-fw" style="font-size:20pt"></i>&nbsp; Long App',$action,array('escape'=>false));?>
                </li>
                <li>
                    <?php echo $this->Html->link('<i class="fa fa-power-off fa-fw" style="font-size:20pt"></i>&nbsp; Sign Out',array('controller'=>'borrowers','action'=>'logout'),array('escape'=>false));?>
                </li>
                <li>
                    <?php echo $this->Html->link('<i class="fa fa-clipboard fa-fw" style="font-size:20pt"></i>&nbsp; Change Password',array('controller'=>'commons','action'=>'change_password'),array('escape'=>false));?>
                </li>
            </ul>
            <center>
                <?php echo $this->Html->image('front/PMP-Logo.png',array('width' => '200px','style' => 'margin-top:150px;margin-bottom:20px;'));?>            </center>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
*/?>