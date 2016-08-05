<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Enquiry</h4>
</div>
<?php echo $this->Form->create('Enquiry', array('url' => array('controller' => 'commons', 'action' => 'save_remarks')));?> 
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="form-group">
            <label for="recipient-name" class="control-label">Description:</label>
             <?php echo $this->Form->textarea('description',array('required'=>'required','oninvalid' => "setCustomValidity('Please Enter Reason/Description for deny')",'class'=>'input form-control','rows'=>'5','style'=>'resize: none;width: 100%')); ?>
        </div>
        <div class="form-group">
             <?php echo $this->Form->input('short_app',array('class'=>'input form-control','id'=>'shortapp','type'=>'hidden','value'=>$shortAppId)); ?>
             <?php echo $this->Form->input('document',array('class'=>'input form-control','id'=>'document','type'=>'hidden','value'=>$docID)); ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit('save',array('div'=>false,'class'=>'btn btn-primary')); ?>
</div>
 <?php echo $this->Form->end();  ?>
<!-- Modal End -->