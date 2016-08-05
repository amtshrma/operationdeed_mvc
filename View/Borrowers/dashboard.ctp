<!-- Page Content -->
<?php
    echo $this->Html->css('style_front');
    echo $this->Html->css('jquery-scrollbar/jquery.scrollbar');
?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div whiteBG">
        <?php echo $this->Session->flash();?>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal red">
                    <div class="grid-title no-border">
                        <h4>Welcome <span class="semi-bold"><?php echo $this->Session->read('userInfo.name');?></span></h4>
                        <div class="tools"><a href="javascript:;" class="collapse"></a></div>
                    </div>
                    <div class="grid-body no-border">
                        <div class="row-fluid">
                            <div class="scroller scrollbar-dynamic" data-height="500px">
                                <?php
                                    $str = 'Start your first long App by clicking on the button below.';
                                    $action = array('controller'=>'longApp','action'=>'shortApp');
                                    $longAppStatus = $this->Common->findShortApp($this->Session->read('userInfo.id'));
                                    if($longAppStatus == '1'){
                                        $action = array('controller'=>'longApp','action'=>'longAppStep1');
                                    }else if($longAppStatus == '2'){
                                        $action = 'javascript:void(0);';
                                        $str = 'You have Already Filled Long App, A Person from OTD will contact you shortlly.';
                                    }
                                if($longAppStatus != '2'){
                                ?>
                                
                                <p class="greenText text-center"><?php echo $str;?></p>
                                <br /><br />
                                <p class="text-center">
                                <?php
                                    echo $this->html->link('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span> Start a Long App Now',$action,array('class'=>'btn btn-lg2 btn-primary btn-block-normal','escape'=>false));
                                }
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="grid simple vertical green">
                    <div class="grid-title no-border">
                       <h4>To<span class="semi-bold">do's</span></h4>
                        <div class="tools"><a href="javascript:;" class="collapse"></a></div>
                    </div>
                    <div class="grid-body no-border">
                        <div class="row-fluid">
                            <div class="scroller scrollbar-dynamic" data-height="500px">
                                
                                <?php
                                    if(!empty($allToDo)){
                                        foreach($allToDo as $key=>$val){
                                            $userDetail = $this->Common->getUserDetail($val['Notification']['sender_id']);
                                            if(isset($userDetail['User'])){
                                                
                                            ?>
                                            <div class="<?php echo ($key%2 == 0) ? 'alert alert-warning' : 'alert alert-info';?>">
                                                <p>
                                                    <?php
                                                        echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ';
                                                        echo '<b>'.ucfirst($userDetail['User']['name']).'</b>,  perform the action : ';
                                                        echo (isset($val['Notification']['action']) && $val['Notification']['action'] != '') ? $val['Notification']['action'] : '';
                                                    ?>
                                                </p>
                                            </div>
                                        <?php }
                                        }
                                    }else {
                                        echo 'Welcome to OTD.';
                                    }
                                    if(!empty($getData)) {
                                        echo $this->Html->link('View All',array('controller'=>'notifications','action'=>'index'),array('class'=>'pull-right'));
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="grid simple horizontal red">
                    <div class="grid-title no-border">
						 <h4>Noti<span class="semi-bold">fication's</span></h4>
                        
                        <div class="tools"><a href="javascript:;" class="collapse"></a></div>
                    </div>
                    <div class="grid-body no-border">
                        <div class="row-fluid">
                            <div class="scroller scrollbar-dynamic" data-height="500px">
                             
                                <?php
                                    if(!empty($getData)){
                                        foreach($getData as $key=>$val){
                                            $userDetail = $this->Common->getUserDetail($val['Notification']['sender_id']);
                                            if(isset($userDetail['User'])){
                                                $notification = $this->Common->getNotificationDetail($val['Notification']['id']);
                                            ?>
                                            <div class="<?php echo ($key%2 == 0) ? 'alert alert-warning' : 'alert alert-info';?>">
                                                <p>
                                                    <?php
                                                        echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ';
                                                        echo '<b>'.ucfirst($userDetail['User']['name']).'</b>,  perform the action : ';
                                                        echo (isset($notification) && $notification != '') ? $notification : '';
                                                    ?>
                                                </p>
                                            </div>
                                        <?php }
                                        }
                                    }else {
                                        echo 'Welcome to OTD.';
                                    }
                                    if(!empty($getData)) {
                                        echo $this->Html->link('View All',array('controller'=>'notifications','action'=>'index'),array('class'=>'pull-right'));
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php
    echo $this->Html->script(array('jquery-scrollbar/jquery.scrollbar.min.js','assets/core.js','breakpoints.js'));
?>