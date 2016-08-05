<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <?php
  $heading = 'Approve';
  if($status == '2'){
    $heading = 'Deny';
  }
  ?>
  <h4 class="modal-title"><?php echo $heading; ?> Loan Doc Form</h4>
</div>
<?php echo $this->Form->create('Approval', array('url' => array('controller' => 'commons', 'action' => 'save_doc_order_remarks')));?> 
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="form-group">
            <label for="recipient-name" class="control-label">Remarks: Please fill your remarks</label>
             <?php echo $this->Form->textarea('remarks',array('class'=>'input form-control','rows'=>'5', 'style'=>'resize:none;')); ?>
        </div>
        <div class="form-group">
            
             <?php echo $this->Form->input('documentID',array('class'=>'input form-control','id'=>'document','type'=>'hidden','value'=>$docID));
              echo $this->Form->input('loanID',array('class'=>'input form-control','id'=>'loanID','type'=>'hidden','value'=>$loanID));
              echo $this->Form->input('status',array('class'=>'input form-control','type'=>'hidden','value'=>$status));
             
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