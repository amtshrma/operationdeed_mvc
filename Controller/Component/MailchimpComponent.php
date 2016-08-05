<?php
App::import('Vendor', 'Mailchimp', array('file' => 'Mailchimp/src/Mailchimp.php'));
class MailchimpComponent extends Component {
    public $helpers = array('Session', 'Html', 'Form');	//An array containing the names of helpers this controller uses. 
    public $components = array('Session','Email','Cookie');	//An array containing the names of components this controller uses.

/**********************************************************************************************************
    @Function Name  : set_api_key
    @Params	    : $apikey , $list_id
    @Description    : for setting api keys global variables
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/   
    function set_api_key($apikey,$list_id) {
        $this->api_key = $apikey;
        $this->list_id = $list_id;
        $this->mailChimp = new \Drewm\MailChimp($this->api_key);
    }   
   /***********************************************************************************************************
    @Function Name  : fetch_list
    @Params	    : $image name , $model
    @Description    : for fetching list of mails from mailchimp
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    function fetch_list(){
        $list = $this->mailChimp->call('lists/list', array(
                                    )
                                );
        return $list;
    }
    
/***********************************************************************************************************
    @Function Name  : batch_subscribe_list
    @Params	    : $image name , $model
    @Description    : for adding list of emails to mailchimp
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function batch_subscribe_list($batch_array){
         $batch_subscribe = $this->mailChimp->call('lists/batch-subscribe', array(
                                        'id' => $this->list_id,
                                        'batch' => $batch_array,
                                        'double_optin' => false,
                                        'update_existing' => false,
                                        'replace_interests' => true
                                )
                            );   
    }
    
/***********************************************************************************************************
    @Function Name  : add_segment
    @Params	    : $segment_name
    @Description    : Add Segment in Mailchimp list
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function add_segment($segment_name){
        $add_segment = $this->mailChimp->call('lists/static-segment-add', array(
                                        'id' => $this->list_id,
                                        'name' => $segment_name
                                    )
                            );
        return $add_segment;
    }

/***********************************************************************************************************
    @Function Name  : fetch_segment_list
    @Params	    : 
    @Description    : Add Segment in Mailchimp list
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function fetch_segment_list(){
        $segment_list = $this->mailChimp->call('lists/static-segments', array(
                                        'id' => $this->list_id
                                    )
                            );
        return $segment_list;
    }

/***********************************************************************************************************
    @Function Name  : add_segment_members
    @Params	    : $segment_id,$batch_segment_array
    @Description    : Add members in segment
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function add_segment_members($segment_id,$batch_segment_array){
        $add_segment_members = $this->mailChimp->call('lists/static-segment-members-add', array(
                                        'id' => $this->list_id,
                                        'seg_id' => $segment_id,
                                        'batch'=>$batch_segment_array
                                        
                                    )
                            );
        return $add_segment_members;
    }
    
/***********************************************************************************************************
    @Function Name  : delete_segment
    @Params	    : $segment_id
    @Description    : Delete Segment from Mailchimp list
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function delete_segment($segment_id){
        $delete_segment = $this->mailChimp->call('lists/segment-del', array(
                                        'id' => $this->list_id,
                                        'seg_id' => $segment_id
                                    )
                            );
        return $delete_segment;
    }
    
/***********************************************************************************************************
    @Function Name  : create_compaign
    @Params	    : $type,$options_array,$content_array,$segment_opts_array
    @Description    : Create compaign from segment
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function create_compaign($type,$options_array,$content_array,$segment_opts_array){
        $options_array['list_id']=$this->list_id;
        $create_compaign = $this->mailChimp->call("campaigns/create", array(
                                        'type' => $type,
                                        'options' => $options_array,
                                        'content' => $content_array,
                                        'segment_opts' => $segment_opts_array
                                    )
                                );
        return $create_compaign;
    }

/***********************************************************************************************************
    @Function Name  : fetch_template_list
    @Params	    : 
    @Description    : FETCH TEMPLATE LIST ARRAY
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function fetch_template_list(){
        $fetch_template_list_array = $this->mailChimp->call("templates/list",array(
                                   ));
        return $fetch_template_list_array;
    }
    
/***********************************************************************************************************
    @Function Name  : fetch_compaign_list
    @Params	    : 
    @Description    : FETCH COMPAIGN LIST
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function fetch_compaign_list(){
        $fetch_compaign_list_array = $this->mailChimp->call("campaigns/list",array(
                                   ));
        return $fetch_compaign_list_array;
    }
    
/***********************************************************************************************************
    @Function Name  : fetch_template_content
    @Params	    : $compaign_id
    @Description    : FETCH Template Content
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function fetch_template_content($compaign_id){
        $fetch_template_content_array = $this->mailChimp->call("campaigns/template-content",array(
                                                            'cid' => $compaign_id
                                   ));
        return $fetch_template_content_array;
    }
    
/***********************************************************************************************************
    @Function Name  : send_email
    @Params	    : $compaign_id
    @Description    : SEND MAIL FROM COMPAIGN
    @Author         : Shiv Kumar
    @date           : 7-Jan-2016
***********************************************************************************************************/

    public function send_email($compaign_id){
        $send_email = $this->mailChimp->call("campaigns/send",array(
                                                            'cid' => $compaign_id
                                   ));
        return $send_email;
    }
    
}