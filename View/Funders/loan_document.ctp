<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h2>Loan Document</h2><hr />
        <?php
            echo $this->Form->create('Loan Document', array('novalidate' => true,'id'=>'loanDocumentForm','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data'));
            echo $this->Form->hidden('loanID',array('value' => $loanId));
        ?>
        <div class="row-fluid">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="col-md-8"><strong>Document</strong></div>
                    <div class="col-md-4"><strong>View</strong></div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-8"><strong>Document</strong></div>
                    <div class="col-md-4"><strong>View</strong></div>
                </div>
            </div>
            <hr />
            <div class='col-md-12 customPadding'>
            <?php foreach($loanDocs as $key=>$doc){ ?>
                <?php if($key%2 == 0){ echo "</div><div class='col-md-12 customPadding'>"; } ?>
                <div class="col-md-6">
                   <div class="col-md-8"><?php echo $doc['EmailTemplate']['name']; ?></div>
                   <div class="col-md-4"><?php echo $this->Html->link('View',array('controller'=>'loans','action'=>'create_pdf',$loanId, base64_encode($doc['EmailTemplate']['id'])),array('escape'=>false,'target' => '_blank')); ?></div>
               </div>
            <?php } ?>
            </div>
            <div class="col-md-2 col-md-offset-10">
                <?php echo $this->Form->button('Approve Docs', array('type' => 'submit','class' => 'btn btn-primary','title'=>'Click to approve all loan documents')); ?>
            </div>
            <p class="help redText">** Note : Click Approve Doc button to accept all loan documents.</p>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<style>
    div.customPadding div.col-md-6{
        padding: 10px 5px;
    }
</style>