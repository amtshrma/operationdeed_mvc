<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Operation Trust Deed</title>
    <!-- Bootstrap Core CSS -->
    <?php
        echo $this->Html->css('front/bower_components/bootstrap/dist/css/bootstrap.css');
        echo $this->Html->css('front/bower_components/metisMenu/dist/metisMenu.css');
        echo $this->Html->css('front/dist/css/sb-admin-2.css');
        echo $this->Html->css('front/bower_components/font-awesome/css/font-awesome.css');
        echo $this->Html->css('front/developer.css');
        echo $this->Html->css('bootstrap-datepicker/datepicker');
        echo $this->Html->css('front/jquery-ui.css');
        echo $this->Html->script(array('front/bower_components/jquery/dist/jquery.min.js'));
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php
        $getUserList = $this->requestAction(array('controller'=>'commons','action'=>'getUserList'));
        $getUserList = json_decode($getUserList,true);
        $hasMessages = $getUserList['chat'];
        $getUserList = $getUserList['UserList'];
    ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php echo $this->Element('fronts/dashboard_common_nav',array('hasMessages'=>$hasMessages));?>
        <?php echo $this->fetch('content');?>
    </div>
    <script>
        var BASE_URL = '<?php echo BASE_URL;?>';
    </script>
    <?php
        echo $this->Html->script(array('front/jquery-ui.js','front/short_app.js','front/bower_components/bootstrap/dist/js/bootstrap.min.js','front/bower_components/metisMenu/dist/metisMenu.min.js','front/dist/js/sb-admin-2.js','bootstrap-datepicker/bootstrap-datepicker','jquery.maskedinput'));
    ?>
    <script>
        jQuery("#menu-toggle").click(function(e) {
            e.preventDefault();
            jQuery("#wrapper").toggleClass("toggled");
        });
        jQuery(document).ready(function(){ 
            jQuery('#dateOfBirth').datepicker();
        });
    </script>
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top: 40px;">
    <div class="modal-dialog">
        <div class="modal-content">
          
        </div>
    </div>
  </div>
<!-- Modal End -->

<!-- show user list -->
<div class="chat-window-wrapper" style="display: none;">
	<h4>User List</h4>
    <ul style="overflow-y: scroll;height: 88%;">
    <?php
        // on the top of page
        if(count($getUserList)){
            foreach($getUserList as $k=>$val){?>
                <li>
                    <a class="<?php echo ($val['User']['message']) ? 'greenText' : '';?>" onclick="openChatWindow('<?php echo $val['User']['first_name'];?>','<?php echo $val['User']['id'];?>')" href="javascript:void(0);"><i class="fa fa-user" aria-hidden="true"></i> <i><?php echo $val['User']['first_name'].' '.$val['User']['last_name'];?></i> <i class="fa fa-circle" aria-hidden="true"></i></a>
                </li>
        <?php
            }
        }
    ?>
    </ul>
</div>
<!-- show chat list -->
<div class="chat-window-listChat" style="display: none;">
	<h4>Chat With <b class="chatUserName">&nbsp;</b> <a href="javascript:void(0);" class="closeChatRoom" onclick="closeChatRoom()"><i class="fa fa-times" aria-hidden="true"></i></a></h4>
    <div class="listMessages" style="overflow-y: scroll;height: 88%;">
        <ul>
           <p>Please wait ..</p>
        </ul>
    </div>
    <div class="sendMessage">
        <input type="text" class="postChatMessage" placeholder="Type Message"/>
    </div>
</div>


<script>
jQuery('document').ready(function(){    
    jQuery('.confirmAction').click(function(){
        var status = confirm("Are you sure ?");    
        if(!status){
            return false;
        }else{
            return true;
        }
    });
    jQuery('.postChatMessage').keyup(function(e){
        if(e.keyCode == '13'){
            jQuery('div.chat-window-listChat ul').append('<li class="right"><i>shalini says ...</i><br /> '+jQuery(this).val()+'</li>')
            var message = jQuery(this).val();
            jQuery(this).val('');
            jQuery.get(BASE_URL+"/homes/postUserMessages/"+jQuery(this).attr('alt')+'/'+message, function( data ) {
                jQuery(".listMessages ul" ).html( data );
            });
            jQuery('div.chat-window-listChat .listMessages').animate({scrollTop: jQuery('div.chat-window-listChat ul').height()}, 500);
        } 
    });
});
jQuery(function(){
    jQuery('a.chatIconClickAction').click(function(){
        jQuery('div.chat-window-wrapper').toggle();
        jQuery('span.badgeChat').text('');
    });    
});

function openChatWindow(username,userId){
    jQuery('div.chat-window-wrapper').hide();
    jQuery('div.chat-window-listChat').show();
    jQuery('b.chatUserName').text(username);
    jQuery('input.postChatMessage').attr('alt',userId);
    var clearInterValId = setInterval(function(){
                                jQuery.get(BASE_URL+"/homes/getUserMessages/"+userId, function( data ) {
                                    jQuery( ".listMessages ul" ).html( data );
                            });
                            }, 5000);
    jQuery('a.closeChatRoom').attr('title',clearInterValId);   
}

function closeChatRoom(){
    clearInterval(jQuery('a.closeChatRoom').attr('title'));
    jQuery('div.chat-window-wrapper').show();
    jQuery('div.chat-window-listChat').hide();
    jQuery( ".listMessages ul" ).html('');
}


</script>
</body>
</html>