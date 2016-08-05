<script type="text/javascript">
function unpermit_value(val1){
    if (val1=='yes') {
        jQuery("#description").show();
    }else{
        jQuery("#description").hide();
    }
}
</script>
<style type="text/css">
.radio_btn > span {
    display: inline-flex;
}
</style>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h3>Document Requested By Processor</h3> <hr />
        <div class="col-md-12">
            <?php echo $this->Session->flash(); ?>
			<div id="flashMessage1" class="alert alert-danger" style="display:none;"></div>
            <br />
            <p>Please download below pre-formatted documents and save the document. Fill the documents and then scan them  and upload the documents or fax them to us. Please make sure to upload the document correctly.</p>
            <br />
            <?php
                echo $this->Form->create('Borrow',array('type'=>'file','name'=>'form1'));
                echo $this->Form->input('loan_ID',array('type' =>'hidden','value' => $loan_ID));
                echo $this->Form->input('short_app_id',array('type' =>'hidden','value' => $shortAppID));
                echo $this->Form->input('receiver_id',array('type' =>'hidden','value' => $loanOfficerID));
            ?>
            <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th><b>Document</b></th>
                    <th><b>Download Document</b></th>
                    <th><b>Upload Document</b></th>
                </thead>
                <tbody>
                    <?php
                    if(!empty($loanOfficerDoc)) { 
                        foreach($loanOfficerDoc as $key => $document) {  
                            $this->Form->hidden('documentID.'.$key,array('value'=>$document['AskDocument']['id']));
                            $documentId = $document['AskDocument']['document_id'];
                            $documentType = $document['AskDocument']['document_type'];
                            $documentDetail = $this->Common->getDocumentDetail($documentId, $documentType);
                            if($documentType == 'loan'){
                                $checklist = $documentDetail['LoanDocument']['checklistname'];
                                $download = $documentDetail['LoanDocument']['download_form'];
                                $value = BASE_URL.'document/'.$documentDetail['LoanDocument']['name'];
                            }else {
                                $checklist = $documentDetail['Checklist']['checklistname'];
                                $download = $documentDetail['Checklist']['download_form'];
                                $value  = BASE_URL.'upload/'.$documentDetail['Checklist']['value'];
                            }
                        ?>
                        <tr>
                        <td><?php echo $checklist;?></td>
                        <td>
                            <?php
                            if($download=='1') {
                                echo $this->Html->link('Download', $value, array('class' => 'button','target'=>'_blank'));
                            }else{
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $uploadDocument = true;
                            if($document['AskDocument']['status'] == '1'){
                                echo "<span class='greenText'>Document Accepted </span>";
                                $uploadDocument = false;
                            }else{
                                if($document['AskDocument']['status'] == '3'){
                                    echo "<span class='redText'>Document Denied </span> <br/>";
                                    $uploadDocument = true;
                                }else if($document['AskDocument']['status'] == '0' && !empty($document['AskDocument']['borrower_document'])){
                                    echo "<span class='greenText'>Document Uploaded</span> <br/>";
                                    $uploadDocument = false;
                                }
                                if($uploadDocument){
                                    echo $this->Form->hidden('askDocumentID.'.$key,array('value'=>(!empty($document['AskDocument']['id']) ? $document['AskDocument']['id'] : '')));
                                    echo $this->Form->input('document.'.$key,array('type'=>'file','id'=>'checklist_'.$document['AskDocument']['id'],'label'=>false));
                                }
                            }
                            ?>
                        </td>
                        </tr>
                        <?php 
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2 col-md-offset-10">
		<?php
		    echo $this->Form->button('Submit Document', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15'));?>
				</div>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>