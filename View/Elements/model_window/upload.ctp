<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Upload Signed LOI</h4>
</div>
<?php echo $this->Form->create('LOI', array('url' => array('controller' => 'borrowers', 'action' => 'saveSignedLOI'),'enctype'=>'multipart/form-data'));?> 
<div class="modal-body">
    <div class="row col-md-6" style="margin-top:20px;">
        <div class="form-group">
             <?php echo $this->Form->input('loanId',array('class'=>'input form-control','id'=>'loanId','type'=>'hidden','value'=>$loanId)); ?>
             
        </div>
        <div class="form-group">
            <label for="recipient-name" class="control-label">Upload:</label>
             <?php echo $this->Form->input('borrower_loi',array('class'=>'input form-control','type'=>'file','label'=>false)); ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit('save',array('div'=>false,'class'=>'btn btn-primary')); ?>
</div>
 <?php echo $this->Form->end();  ?>

<!-- Modal End -->