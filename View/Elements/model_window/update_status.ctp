<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Enquiry</h4>
</div>
<?php echo $this->Form->create('Message', array('url'=>array('controller'=>'users','action'=>'save_enquiry')));?> 
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="form-group">
            <label class="control-label">Remarks: Please fill your remarks</label>
             <?php echo $this->Form->textarea('message',array('class'=>'input form-control','rows'=>'5')); ?>
        </div>
        <div class="form-group">
             <?php
              echo $this->Form->input('receiver_id',array('class'=>'input form-control','type'=>'hidden','value'=>$userID));
             echo $this->Form->input('subject',array('class'=>'input form-control','type'=>'hidden','value'=>'Enquiry'));
             ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit('save',array('div'=>false,'class'=>'btn btn-primary')); ?>
</div>
 <?php echo $this->Form->end();  ?>
<!-- Modal End -->