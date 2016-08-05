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
            echo $this->Html->link('<i class="fa fa-home fa-fw-2x"></i> <span class="title">Dashboard</span>',array('controller'=> 'homes','action'=>'dashboard'),array('escape' =>false,'Dashboard'));
            ?>        
        </li>
        <!--li>
            <?php
                echo $this->Html->link('<i class="fa fa-home fa-fw-2x"></i> <span class="title">Orders</span>',array('controller'=> 'homes','action'=>'orders'),array('escape' =>false,'Dashboard'));
            ?>        
        </li-->
          <li>
            <?php
                echo $this->Html->link('<i class="fa fa-asterisk" aria-hidden="true"></i> <span class="title">Change Password</span>',array('controller'=> 'commons','action'=>'change_password'),array('escape' =>false,'Change Password'));
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
        if(in_array($userData['user_type'],array('2','3','4','5','6'))){
            echo '<li>';
            echo $this->Html->link('<i class="fa fa-usd"></i><span class="title"> Loan Commission</span>',array('controller'=>'accounts','action'=>'showCommissionList'),array('escape'=>false));
            echo '</li>';
        }
        echo '<li>';
        echo $this->Html->link('<i class="fa fa-sign-out"></i><span class="title"> Sign Out</span>',array("controller"=>'homes', "action" =>'logout'),array('escape' =>false,'title' => 'Sign Out'));
        echo '</li>';
        ?>
    </ul>
    <div class="col-sm-11 rock-mg">
        <center><?php echo $this->Html->image('longApp/rock-logo.png',array('class' => 'img-responsive'));?></center>
    </div>
</div>