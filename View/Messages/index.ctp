<style>
    ul.tabNav{
		width: auto;
	}
    ul.tabNav li{
        line-height: 50px;
    }
    ul.tabNav li a{
        background: #334148;
        color: #fff;
        border: none;
    }
    ul.tabNav li a:hover{
        background: #333;
        color: #eee;
    }
    .table-responsive{
        min-height: 200px;
    }
    ul.tabNav li.active a{
        background: #eee;
        color: #000;
    }
</style>

<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<h3>Messages</h3><hr />
		<div class="row">
			<?php echo $this->Session->flash();?>
            <div class="col-md-3">
                <ul class="sidebar-nav tabNav">
                    <li class="active">
                        <?php echo $this->Html->link('Inbox',array('controller'=>'messages', 'action'=>'index'),array('escape' => false,'title' => 'Sent Messages','class'=>'inboxMesages')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Sent Messages',array('controller'=>'messages', 'action'=>'sent'),array('escape' => false,'title' => 'Sent Messages','class'=>'sentMesages')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Compose',array('controller'=>'messages', 'action'=>'compose'),array('escape' => false,'title' => 'Compose','class'=>'composeMesages')); ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="panel-group" id="accordion">
                <?php
                    if(count($getData)) {
                        foreach($getData as $key=>$message){ 
							$senderId = $message['Message']['sender_id'];
							$userDetail = $this->Common->getUserDetail($senderId);
							$senderName = $userDetail['User']['name'];
					?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><?php echo $key + 1;?>.  <a data-toggle="collapse" href="#collapse<?php echo $key;?>"><?php echo $message['Message']['subject'] .', '.$senderName .', '.date("jS M, Y", strtotime($message['Message']['created']));?> </a></h4>
								</div>
								<div id="collapse<?php echo $key;?>" class="panel-collapse collapse">
									<div class="panel-body"><?php echo $message['Message']['message'];?></div>
								</div>
							</div>
                            <?php
                            }
                        }else{?>
                            <p class="text-center blueText">No Message Found</p>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
	</div>
</div>