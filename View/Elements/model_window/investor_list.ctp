<!-- Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <?php if(!empty($data)) {  
        echo '<h4 class="modal-title">Select Investor to send Trust Deed Flyer</h4>';
    }?>
</div>
<div class="modal-body"> 
    <?php
        echo $this->Form->create('TrustDeed', array('url' => array('controller' => 'tdinvestors', 'action' => 'trust_deed_recipients'),'novalidate' => true,'id'=>'investorListForm'));
        echo $this->Form->input('loanId', array('type'=>'hidden','value'=>$loanId));
        echo $this->Form->input('trustDeedId', array('type'=>'hidden','value'=>$trustDeedId));
    ?> 
    <?php
        echo $this->Html->script(array('front/datatables.min.js'));
    ?>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>
                    <?php echo $this->Form->input('checkAll',array('label' => false,'div' => false,'type '=> 'checkbox','hiddenField'=>false,'class'=>'checkall'));?>
                </th>
                <th>Name</th>
                <th>Email</th>
                <th>Counties</th>
                <th>Lending Profile</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($data)){
                foreach($data as $key=>$val){ ?>
                    <tr>
                        <td><?php echo $this->Form->input('investor_Id.'.$key,array('label' => false,'div' => false,'type '=> 'checkbox','hiddenField'=>false,'class'=>'recipientID','value'=>base64_encode($val['User']['id'])));?></td>
                        <td><?php echo $val['User']['name'];?></td>
                        <td><?php echo $val['User']['email_address'];?></td>
                        <td><?php echo $val['UserDetail']['counties'];?></td>
                        <td><?php echo $val['UserDetail']['lending_profile'];?></td>
                    </tr>
                <?php }
            }else{
                echo '<tr><td colspan="5">No Investor Found.</td></tr>';   
            }
            ?>
        </tbody>
    </table>
    <script>
        jQuery(document).ready(function() {
            jQuery('#example').DataTable();
        });
    </script>
</div>
<div class="modal-footer">
    <?php if(!empty($data)){?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <?php echo $this->Form->submit('Submit',array('div'=>false,'class'=>'btn btn-primary','id'=>'sendTDEmail'));
    }
    ?>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('#investorSubmit').click(function(){
            jQuery('#investorForm').submit(); 
        });    
    });
</script>
<?php echo $this->Form->end();?>