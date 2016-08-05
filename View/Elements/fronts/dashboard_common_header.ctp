<header class="header header-row" role="header">
    <section class="container-fluid">
        <section class="row">
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <div class="icon-wrapper">
                        <a href="javascript:void(0);" onclick="window.history.back();" navbar-left"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
                    </div>
                </li>
                <?php
                $messageCount = $this->Common->getAllMessage($this->Session->read('userInfo.id'));
                $notificationCount = $this->Common->getAllNotification($this->Session->read('userInfo.id'));
                if($messageCount != 0){
                    $updateMessageStatus = base64_encode(1);
                    $message = '<i class="fa fa-envelope icon-grey" style="font-size:14pt"></i><span class="badge">'.$messageCount.'</span>';
                }else{
                    $updateMessageStatus = base64_encode(0);
                    $message = '<i class="fa fa-envelope icon-grey" style="font-size:14pt"></i>';
                }
                ?>
                <li>
                    <?php
                    echo '<div class="icon-wrapper">';
                    echo $this->html->link($message,array('controller'=>'messages','action'=>'index/'.$updateMessageStatus),array('escape'=>false,'style'=>'padding:0px; color:#5c6670','title'=>'Messages'));
                    echo '</div>';
                    ?>
                </li>
                <?php
                if($notificationCount != 0){
                    $updateNotificationStatus = base64_encode(1);
                    $notification = '<i class="fa fa-question-circle icon-grey" style="font-size:14pt"></i><span class="badge">'.$notificationCount.'</span>';
                }else{
                    $updateNotificationStatus = base64_encode(0);
                    $notification = '<i class="fa fa-question-circle icon-grey" style="font-size:14pt"></i>';
                }
                ?>
                <li>
                    <?php echo $this->html->link($notification,array('controller'=>'notifications','action'=>'index/'.$updateNotificationStatus),array('escape'=>false,'style'=>'padding:0px; color:#5c6670','title'=>'Notifications'));
                    ?>
                </li>
                <li>
                    <?php echo $this->html->link('<i class="fa fa-edit icon-grey" style="font-size:14pt"></i>',array('controller'=>'commons','action'=>'my_account'),array('escape'=>false,'style'=>'padding:0px; color:#5c6670','title'=>'My Account')); ?>
                </li>
                <li>
                <?php
                    // $hasMessages define in dasboard_common layout
                    if($hasMessages){
                        $html = '<i class="fa fa-weixin" aria-hidden="true" style="font-size:14pt"></i><span class="badge chatBadges">'.$hasMessages.'</span>';
                    }else{
                        $html = '<i class="fa fa-weixin" aria-hidden="true" style="font-size:14pt"></i><span class="badge chatBadges"></span>';
                    }
                    echo '<div class="icon-wrapper">';
                    echo $this->html->link($html,'javascript:void(0);',array('escape'=>false,'class'=>'chatIconClickAction','title'=>'Start Chat','style'=>'padding:0px; color:#5c6670'));
                    echo '</div>';
                    ?>
                </li>
            </ul>
        </section>
    </section>
</header>