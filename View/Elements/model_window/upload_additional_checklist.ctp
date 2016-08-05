<!-- Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add Checklist</h4>
</div>
<?php echo $this->Form->create('Checklist', array('type'=>'file','noValidate' =>false));
echo $this->Form->hidden('type',array('value'=>$checklist_type));
echo $this->Form->hidden('loan_id',array('value'=>$loanId));
?>
<div class="modal-body">
    <div class="row col-md-12" style="margin-top:20px;">  
        <div class="form-group">
            <label for="recipient-name" class="control-label">Checklist:</label>
            <?php echo $this->Form->input('checklistname',array('class'=>'input form-control', 'required'=>'required','label' =>false,'title' => 'Please Enter Checklist Name')); ?>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="control-label">Upload (if pre-formatted):</label>
            <?php echo $this->Form->input('document',array('class'=>'', 'type'=>'file','label' =>false)); ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo $this->Form->submit('Submit',array('div'=>false,'class'=>'btn btn-primary')); ?>
</div>
 <?php echo $this->Form->end();  ?>