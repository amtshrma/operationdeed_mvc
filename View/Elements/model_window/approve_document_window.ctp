<!-- Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Deny/Approve Document</h4>
</div>
<?php echo $this->Form->create('UserDocument');?> 
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="form-group">
            <label for="recipient-name" class="control-label">Description:</label>
            <?php echo $this->Form->textarea('comment',array('class'=>'input form-control','rows'=>'5')); ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->hidden('id',array('id'=>'documentId','value'=>'')); ?>
            <?php echo $this->Form->hidden('status',array('id'=>'documentAction','value'=>'')); ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit('Deny',array('div'=>false,'class'=>'btn btn-primary')); ?>
</div>
 <?php echo $this->Form->end();  ?>