<!-- Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">
        <?php echo (!empty($status) && $status == '2') ? $title = 'Deny' : $title = 'Approve';?> Document
    </h4> 
</div>
<?php echo $this->Form->create('EditDocument',array('type'=>'file'));?> 
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">
          <span class="hint redText">Please download pre-formatted documents, sign document and then scan them  and upload the documents or fax them to us. Please make sure to upload the document correctly.</span>
        <?php if(!empty($status) && $status != '2') { ?> 
            <div class="form-group">
                <label for="recipient-name" class="control-label">Upload:</label>
                <?php echo $this->Form->input('upload',array('class'=>'','type'=>'file','label'=>false,'accept'=>'application/pdf')); ?>
            </div>
        <?php } ?>
        <div class="form-group">
            <label for="recipient-name" class="control-label">Description:</label>
            <?php echo $this->Form->textarea('comment',array('class'=>'input form-control','rows'=>'5','style'=>'resize : none;')); ?>
        </div
        <div class="form-group">
            <?php
                echo $this->Form->hidden('id',array('id'=>'documentId','value'=>$approvalID));
                echo $this->Form->hidden('status',array('id'=>'status','value'=>$status));
                echo $this->Form->hidden('model',array('id'=>'model','value'=>$model));
                echo $this->Form->hidden('loanID',array('id'=>'model','value'=>$loanID));
                echo $this->Form->hidden('document',array('id'=>'document','value'=>$documentt));
            ?>
            
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <?php echo $this->Form->submit($title ,array('div'=>false,'class'=>'btn btn-primary')); ?>
</div>
 <?php echo $this->Form->end();  ?>