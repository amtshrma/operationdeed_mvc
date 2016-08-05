<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Users Section</title>
    <?php
        echo $this->Html->css('front/bootstrap.css');
        echo $this->Html->css('front/simple-sidebar.css');
        echo $this->Html->css('front/font-awesome.min.css');
        echo $this->Html->css('front/slicknav.css');
        echo $this->Html->css('front/developer.css');
    ?>
    <style>
        a.list-group-item, button.list-group-item{
            padding-left: 6px;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div id="toggle-button"><a href="#menu-toggle" class="icon-block" id="menu-toggle" style="border:0"><i class="fa fa-bars" style="color:white;font-size:14pt"></i></a></div>
			<span id="untoggled_menu">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand"></li>
                    <div class="screen">
                       <center>
                            <?php
                                $profileImage = BASE_URL.'img/front/lock.svg';
                                if($this->Session->read('userDetail.profile_picture')){
                                    $profileImage = BASE_URL.'img/profile_pics/thumb/'.$this->Session->read('userDetail.profile_picture');
                                }
                            echo $this->Html->image($profileImage,array('class' => 'img-circle','width' => '75px','style' => 'border:3px solid #fff'));
                            ?>
                            <br><br>
                            <b>Welcome <?php echo $this->Session->read('userInfo.first_name');?></b>
                        </center>
                        <br><br><br>
                        <div class="list-group">
                        <?php    
                            $controller = 'admins';
                            if(!empty($userData) && $userData['controller'] !='') {
                                $controller = $userData['controller'];
                                $userID = $userData['id'];
                            }
                            echo $this->Html->link('<i class="fa fa-home fa-fw" style="font-size:16pt"></i>&nbsp; Dashboard',array('controller'=> 'homes','action'=>'dashboard'),array('escape' =>false,'class'=>'list-group-item','title'=>'Dashboard'));
                            $links = $this -> requestAction(array('controller' => 'admins','action' => 'getAllLinks'));        
                            if(count($links) >= 1) {
                                foreach($links as $linkData) {
                                    if($linkData != '' && isset($linkData)) {
                                        if(($linkData['Controller'] == $this->params['controller']) && ($linkData['Action'] == $this->params['action'])) {
                                            $activeStatus ="active";
                                        }else{
                                            $activeStatus =""; 
                                        }
                                        $action =str_replace("admin_","",$linkData['Action']);
                                        $name =str_replace("Manage","",$linkData['Name']);
                                    ?>
                                    <?php
                                        echo $this->Html->link('<i style="font-size:16pt" class="fa '.$linkData['Icon'].'"></i>&nbsp; '.$linkData['Name'],array("controller"=>$linkData['Controller'], "action" =>$linkData['Action']),array('escape' =>false,'title' => $linkData['Name'],'class'=>'list-group-item '.$activeStatus));
                                    }
                                }
                            }
                            echo $this->Html->link('<i class="fa fa-power-off fa-fw" style="font-size:16pt" ></i>&nbsp; Sign Out',array("controller"=>'homes', "action" =>'logout'),array('escape' =>false,'title' => 'Sign Out','class'=>'list-group-item '.$activeStatus));
                            ?>
                        </div>
                        <center>
                            <?php echo $this->Html->image('front/PMP-Logo.png',array('width' => '200px','style' => 'margin-top:150px'));?>
                        </center>
                    </div>
                </ul>
			</span>
			<span id="toggled_menu">
				<div style="min-height:20px"></div>
                <?php    
                    $controller = 'admins';
                    if(!empty($userData) && $userData['controller'] !='') {
                        $controller = $userData['controller'];
                        $userID = $userData['id'];
                    }
                    echo $this->Html->link('<i class="fa fa-home fa-fw" style="font-size:20pt"></i>',array('controller'=> 'homes','action'=>'dashboard'),array('escape' =>false,'class'=>'list-group-item','title'=>'Dashboard'));
                    $links = $this -> requestAction(array('controller' => 'admins','action' => 'getAllLinks'));        
                    if(count($links) >= 1) {
                        foreach($links as $linkData) {
                            if($linkData != '' && isset($linkData)) {
                                if(($linkData['Controller'] == $this->params['controller']) && ($linkData['Action'] == $this->params['action'])) {
                                    $activeStatus ="active";
                                }else{
                                    $activeStatus =""; 
                                }
                                $action =str_replace("admin_","",$linkData['Action']);
                                $name =str_replace("Manage","",$linkData['Name']);
                            ?>
                            <?php
                                echo $this->Html->link('<i style="font-size:20pt" class="fa '.$linkData['Icon'].'"></i>',array("controller"=>$linkData['Controller'], "action" =>$linkData['Action']),array('escape' =>false,'title' => $linkData['Name'],'class'=>'list-group-item '.$activeStatus));
                            }
                        }
                    }
                    echo $this->Html->link('<i class="fa fa-power-off fa-fw" style="font-size:20pt" ></i>',array("controller"=>'homes', "action" =>'logout'),array('escape' =>false,'title' => 'Sign Out','class'=>'list-group-item '.$activeStatus));
                ?>
			</span>
        </div>
        <!-- /#sidebar-wrapper -->
		<nav class="navbar navbar-default navbar-static-top" style="z-index:1">
            <div class="container">
				<div class="icon-wrapper">
                    <i class="fa fa-envelope icon-grey" style="font-size:14pt"></i>
                    <span class="badge">3</span>
                </div>
				&nbsp;&nbsp;&nbsp;
				<i class="fa fa-question-circle icon-grey" style="font-size:14pt"></i>
				&nbsp;
				<i class="fa fa-cog icon-grey" style="font-size:14pt;margin-right:25px"></i>
		  </div>
		</nav>
		<div class="content-container">
            <?php echo $this->fetch('content');?>
		</div>
		<ul id="menu">
			<li><a href="#"><i class="fa fa-home fa-fw" style="font-size:20pt"></i>&nbsp; Dashboard</a></li>
		    <li><a href="#"><i class="fa fa-file-text fa-fw" style="font-size:20pt"></i>&nbsp; Short App</a></li>
		    <li><a href="#"><i class="fa fa-clipboard fa-fw" style="font-size:20pt"></i>&nbsp; Long App</a></li>
		    <li><a href="#"><i class="fa fa-power-off fa-fw" style="font-size:20pt" ></i>&nbsp; Sign Out</a></li>
		</ul>

    </div>
    <!-- jQuery -->
    <script>
        var BASE_URL = '<?php echo BASE_URL;?>';
    </script>
    <?php
        echo $this->Html->script(array('front/jquery.js', 'front/bootstrap.min.js','front/jquery.slicknav.js'));
    ?>
    <!-- Menu Toggle Script -->
    <script>
    jQuery("#menu-toggle").click(function(e) {
        e.preventDefault();
        jQuery("#wrapper").toggleClass("toggled");
    });
    </script>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#menu').slicknav();
	});
	</script>
</body>
</html>