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
            foreach($getUserList as $k=>$val){
                if(!empty($val['User']['first_name']) && $val['User']['last_name']){
                $Icolor = ($val['User']['logged_in'] == '1') ? 'greenText' : '';
				?>
                <li>
                    <a class="<?php echo ($val['User']['message']) ? 'greenText' : '';?>" onclick="openChatWindow('<?php echo $val['User']['first_name'];?>','<?php echo $val['User']['id'];?>')" href="javascript:void(0);"><i class="fa fa-user" aria-hidden="true"></i> <i><?php echo $val['User']['first_name'].' '.$val['User']['last_name'];?></i>&nbsp;&nbsp;<i class="<?php echo $Icolor;?> fa fa-circle" aria-hidden="true"></i></a>
                </li>
        <?php
                }
            }
        }
    ?>
    </ul>
</div>
<!-- show chat list -->
<div class="chat-window-listChat" style="display: none;">
	<center>
        <i><h4>Chat With <b class="chatUserName">&nbsp;</b> <a href="javascript:void(0);" class="closeChatRoom" onclick="closeChatRoom()"><i class="fa fa-times" aria-hidden="true"></i></a></h4></i>
    </center>
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
        // open user list
        jQuery('a.chatIconClickAction').click(function(){
            jQuery('div.chat-window-wrapper').toggle();
            jQuery('span.chatBadges').html('');
        });
        // get chat update frequestly
        setInterval(function(){
                    jQuery.get(BASE_URL+"commons/getUserListUpdated/", function( data ) {
                        data = JSON.parse(data);
                        jQuery('span.chatBadges').html(data.chat);
                        jQuery('div.chat-window-wrapper ul').html(data.UserList);
                    });
        }, 15000);
        // posr user message
        jQuery('.postChatMessage').keyup(function(e){
            if(e.keyCode == '13'){
                jQuery('div.chat-window-listChat ul').append('<li class="right"><i><?php echo $this->Session->read('userInfo.first_name');?></i><br /> '+jQuery(this).val()+'</li>')
                var message = jQuery(this).val();
                jQuery(this).val('');
                jQuery.get(BASE_URL+"homes/postUserMessages/"+jQuery(this).attr('alt')+'/'+message, function( data ) {
                    jQuery(".listMessages ul" ).html( data );
                });
                jQuery('div.chat-window-listChat .listMessages').animate({scrollTop: jQuery('div.chat-window-listChat ul').height()}, 500);
            } 
        }); 
    });
    
    function openChatWindow(username,userId){
        jQuery('div.chat-window-wrapper').hide();
        jQuery('div.chat-window-listChat').show();
        jQuery('b.chatUserName').text(username);
        jQuery('input.postChatMessage').attr('alt',userId);
        var clearInterValId = setInterval(function(){
                                    jQuery.get(BASE_URL+"homes/getUserMessages/"+userId, function( data ) {
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