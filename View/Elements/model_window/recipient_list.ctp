<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Select Investor to send Trust Deed Flyer</h4>
</div>
<?php echo $this->Form->create('TrustDeed', array('url' => array('controller' => 'tdinvestors', 'action' => 'send_td_emails'),'novalidate'=>'novalidate','id'=>'investorListForm'));
    echo $this->Form->hidden('trustDeedID',array('label' => false, 'value'=>$trustDeedIds));
?> 
<div class="modal-body"> 
      <?php 
  if(!empty($data)) { ?>
     <div class="row col-md-12" style="margin-top:20px;">
        <div class="col-md-1" style="margin-left:10px;margin-top:10px;">
         <?php echo $this->Form->input('checkAll',array('label' => false,'div' => false,'type '=> 'checkbox','hiddenField'=>false,'class'=>'checkall'));
         ?>
        </div>
        <div class="col-md-4" style="margin-top:10px;"><b>Investor</b></div>
    </div>
    
    <?php foreach($data as $key=>$val) { //pr($val);
    ?>
    <div class="row col-md-12" style="margin-top:20px;">
        <div class="col-md-1" style="margin-left:10px;margin-top:10px;">
         <?php echo $this->Form->input('investor_Id.'.$key,array('label' => false,'class'=>'recipientID','div' => false,'type '=> 'checkbox','hiddenField'=>false,'value'=>base64_encode($val['User']['id'])));
         ?>
        </div>
        <div class="col-md-4" style="margin-top:10px;">
          <div class="input-div-margin"><?php echo $val['User']['name'] .'<br/>'.$val['User']['email_address'] ;?></div>
        </div>
    </div>
  
  <?php }
  }
  ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->button('save',array('div'=>false,'class'=>'btn btn-primary','type'=>'button','id'=>'sendTDEmail')); ?>
</div>
 <?php echo $this->Form->end();  ?>
<div class="modal-footer">&nbsp;</div>
<!-- Modal End -->