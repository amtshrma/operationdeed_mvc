<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h3>Escrow Documents</h3><hr />
        <?php echo $this->Session->flash();?>
        <div class="row">
        <?php
            echo $this->Form->create('Loan Document', array('novalidate' => true,'id'=>'loanDocumentForm','class'=>'form-no-horizontal-spacing')); 
            echo $this->Form->hidden('loanID',array('value' => $loanId));
            if(count($escrowsDocuments) > 0){ ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="Loans">
                        <thead>
                            <tr>
                                <td class="text-center"><b>Documents Name</b></td>
                                <td class="text-center"><b>View File Link</b></td>
                            </tr>
                        </thead>
                        <thead>
                            <?php
                                foreach($escrowsDocuments as $key => $document) {
                                    $documentName = $document['EscrowDocument']['document'];
                                    if(!empty($documentName) && isset($documentName)) {
                                        $tempName = explode('.',$document['EscrowDocument']['document']);
                                    ?>
                                    <tr>
                                        <td><?php echo (!empty($tempName[1])) ? ($key+1).'.  '.$tempName[1] : '';?></td>
                                        <td><?php echo $this->Html->link('View', $this->Html->url( '/', true ).'app/webroot/escrow_document/'.$documentName, array('class' => 'button','target'=>'_blank'));?> <small>(Click On Link To View File)</small></td>
                                    </tr>
                                <?php
                                    }
                                }
                        ?>
                        </thead>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="col-md-2 col-md-offset-10">
            <?php
                echo $this->Form->button('Approve', array('type' => 'submit','class' => 'btn btn-primary btn-cons')); ?><br/>
        </div>
        <p>Note : <small class="help redText">Click approve button to approve all Loan documents.</small></p>
            <?php echo $this->Form->end(); ?>
    </div>
</div>