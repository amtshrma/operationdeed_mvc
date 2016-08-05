<script type="text/javascript">
    jQuery('document').ready(function(){
        jQuery('a.acceptDocument').click(function(){
            jQuery("#denyDocument").modal("show");
            jQuery("#denyDocument #documentId").val(jQuery(this).attr('rel'));
            jQuery("#denyDocument #documentAction").val(jQuery(this).attr('title'));
        });
    });
</script>
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><p>YOU ARE HERE</p></li>
            <li><?php echo $this->Html->link('User', array('controller'=>'users','action'=>'index'),array('class'=>'active'));?></li>
        </ul>
        <div class="page-title"> <i class="icon-custom-left"></i>
            <h3>View - <span class="semi-bold">User Documents</span></h3>
        </div> 
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">          
                    <div class="grid-body no-border">
                        <div class="row column-seperation">
                            <div class="col-md-6">
                                <h4>Verify Documents</h4>
                                <table class="table table-striped table-flip-scroll cf table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Download</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                <?php
                                if(!empty($userDocuments)) :
                                    foreach($userDocuments as $key=>$val) :  
                                ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="form-label"><strong><?php echo $val['UserDocument']['document_name'];?></strong></label>
                                        </td>
                                        <td>
                                            <?php echo $this->html->link('Download',array(BASE_URL.'user_document/'.$val['UserDocument']['file_name']));?>
                                        </td>
                                        <td>
                                        <span>
                                            <?php
                                                if($val['UserDocument']['status']){
                                                    echo 'Approved';
                                                }else{
                                                    echo $this->Html->link('Accept','javascript:void();',array('title'=>'accept','rel'=>$val['UserDocument']['id'],'class'=>'acceptDocument','style'=>'color: green'));
                                                    echo ' / ';
                                                    echo $this->Html->link('Deny','javascript:void();',array('title'=>'deny','rel'=>$val['UserDocument']['id'],'class'=>'acceptDocument','style'=>'color: red'));
                                                }    
                                                ?>
                                        </span>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                endif;                                
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>