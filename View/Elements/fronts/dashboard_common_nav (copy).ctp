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
    <!-- /.navbar-header -->
   <?php $messageCount = $this->requestAction(array('controller' => 'commons','action' => 'getAllMessage'));
   if($messageCount != 0){
        $html = '<i class="fa fa-envelope icon-grey" style="font-size:14pt"></i><span class="badge">'.$messageCount.'</span>';
    }else {
        $html = '<i class="fa fa-envelope icon-grey" style="font-size:14pt"></i>';
    }
   ?>
    <ul class="nav navbar-top-links navbar-right" style="padding-top:15px;color:#5C6670">
        <li>
            <div class="icon-wrapper">
               <?php echo $this->html->link($html,array('controller'=>'messages','action'=>'index'),array('escape'=>false,'style'=>'padding:0px; color:#5c6670','title'=>'Messages'));
               ?>
            </div>
        </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li>
            <div class="icon-wrapper">
             <?php echo $this->html->link('<i class="fa fa-question-circle icon-grey" style="font-size:14pt"></i>',array('controller'=>'messages','action'=>'index'),array('escape'=>false,'style'=>'padding:0px; color:#5c6670','title'=>'Messages')); ?>
            </div>
        </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <li>
            <div class="icon-wrapper">
            <?php echo $this->html->link('<i class="fa fa-edit icon-grey" style="font-size:14pt"></i>',array('controller'=>'commons','action'=>'my_account'),array('escape'=>false,'style'=>'padding:0px; color:#5c6670','title'=>'My Account')); ?>
            </div>
        </li>
        <li>
            <div class="icon-wrapper">
                <?php
                // $hasMessages define in dasboard_common layout
                if($hasMessages){
                    $html = '<i class="fa fa-weixin" aria-hidden="true" style="font-size:14pt"></i><span class="badgeChat badge">'.$hasMessages.'</span>';
                }else{
                    $html = '<i class="fa fa-weixin" aria-hidden="true" style="font-size:14pt"></i>';
                }
                echo $this->html->link($html,'javascript:void(0);',array('escape'=>false,'style'=>'padding:0px; color:#5c6670','class'=>'chatIconClickAction','title'=>'Start Chat','style'=>'padding:0px; color:#5c6670')); ?>
            </div>
        </li>
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu" style="color:#FFF">
                <center>
                    <br><br><br>
                    <?php
                    $userData  = $this->Session->read('userInfo');
                    $userDetail  = $this->Session->read('userDetail');
                    $img = (!empty($userDetail['profile_picture'])) ? 'profile_pics/original/'.$userDetail['profile_picture'] : 'no-image.jpg';
                    echo $this->html->link($this->Html->image($img,array('class'=>'img-circle','style' => 'height: 100px;border:3px solid #fff')),array('controller'=>'homes','action'=>'dashboard'),array('escape'=>false,'class' => 'img-circle img-responsive'));
                    ?>
                    <br><br>
                    <b>Welcome
                        <?php
                            if(!empty($userData) && $userData['first_name'] !='') {
                                echo $userData['first_name']; ?> <span class="semi-bold"><?php echo $userData['last_name']; ?></span>
                    <?php } ?>
                    </b>
                </center>
                <br><br><br>
                <li class="start">
                <?php
                    $controller = 'admins';
                    if(!empty($userData) && $userData['controller'] !='') {
                        $controller = $userData['controller'];
                        $userID = $userData['id'];
                    }
                    echo $this->Html->link('<i class="fa fa-home fa-fw-2x"></i> <span class="title">Dashboard</span>',array('controller'=> 'homes','action'=>'dashboard'),array('escape' =>false,'Dashboard'));
                ?>        
                </li>
                <li class="start">
                <?php
                    echo $this->Html->link('<i class="fa fa-home fa-fw-2x"></i> <span class="title">Orders</span>',array('controller'=> 'homes','action'=>'orders'),array('escape' =>false,'Dashboard'));
                ?>        
                </li>
                <?php
                    $links = $this->requestAction(array('controller' => 'admins','action' => 'getAllLinks'));        
                    if(count($links)){ //pr($links);
                        foreach($links as $linkData) {
                            if($linkData != '' && isset($linkData)) {
                                if($linkData['Name'] == 'Short App'  || $linkData['Name'] == 'Loan') {
                                    if($userData['status'] != 1 ) {
                                        continue;
                                    }
                                }
                                if(($linkData['Controller'] == $this->params['controller']) && ($linkData['Action'] == $this->params['action'])) {
                                    $activeStatus ="active";
                                } else {
                                    $activeStatus =""; 
                                }
                                $action =str_replace("admin_","",$linkData['Action']);
                                $name =str_replace("Manage","",$linkData['Name']);
                                // create li
                                echo '<li class= "'.$activeStatus,'">';
                                echo $this->Html->link('<i class="fa '.$linkData['Icon'].'"></i><span class="title"> '.$linkData['Name'].'</span>',array("controller"=>$linkData['Controller'], "action" =>$linkData['Action']),array('escape' =>false,'title' => $linkData['Name']));
                                echo '</li>';
                            }
                        }
                    }
                echo '<li>';
                echo $this->Html->link('<i class="fa fa-sign-out"></i><span class="title"> Sign Out</span>',array("controller"=>'homes', "action" =>'logout'),array('escape' =>false,'title' => 'Sign Out'));
                echo '</li>';
            ?>
            </ul>
            <center>
                <?php echo $this->Html->image('front/PMP-Logo.png',array('width' => '200px','style' => 'margin-top:150px;margin-bottom:20px;'));?>
            </center>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>