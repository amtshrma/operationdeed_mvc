<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h3>Submit Loan Document</h3> <hr />
        <div class="col-lg-12">
            <?php echo $this->Session->flash(); ?>
            <p>Please download loan documents signed, initialed, and update where needed. Then scan in all documents and upload them back into the system.</p>
            <br/>
            <p>Note : Add more fields by clicking on the button</p>
            <?php
            $escrowDocuments = $this->Common->getLoanDocument();
            echo $this->Html->link('Add More','javascript:void(0)', array('class' => '','id'=> 'addEscrowDocument','style'=>'margin-left:20px;'));
            echo $this->Form->create('EscowDocument',array('type'=>'file','name'=>'form1'));
            echo $this->Form->input('loanID',array('type' =>'hidden','value' => $loanID));
            echo $this->Form->input('status',array('type' =>'hidden','value' => 0));
            if(!empty($escrowDocuments)){
                echo $this->Form->input('escrowCount',array('type' =>'hidden','value' => count($escrowDocuments),'id'=>'escrowDocumentCount'));
            }
            ?>
            <div class="table-responsive">
                <p><?php echo $this->Session->flash();?></p>
                <table class="table table-bordered table-hover" id="adduploader" >
                    <thead>
                        <th>Document</th>  
                        <th>Download Doc</th>  
                        <th>Upload Doc</th>  
                    </thead>
                    <?php
                    $loan_Id = base64_decode($loanID);
                    if(!empty($escrowDocuments)) {
                        $count = 0;
                        foreach($escrowDocuments as $key => $document) { ?>
                        <tr>
                            <td><?php echo $key;?></td>
                            <td>
                            <?php echo $this->Html->link($key, $this->Html->url( '/', true ).$document.$loan_Id.'.pdf', array('class' => 'button','target'=>'_blank')); ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->Form->input('upload.'.$count,array('label' => false,'div' => false,'class' => '','type'=>'file'));
                                ?>
                            </td>
                        </tr>
                        <?php
                            $count++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group col-lg-11"></div>
            <div class="form-group col-lg-1">
            <?php
                echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btn-cons','tabindex'=>'15'));?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    jQuery(document).on('click','#addEscrowDocument',function() { 
        html = '<tr><td></td><td></td><td>';
        html += '<input type="file" class="upload"/></td></tr><br/>';
        jQuery('#adduploader').append(html);
        changeName();
    });
});  
function changeName(){
    var count = jQuery('#escrowDocumentCount').val();
    jQuery('#adduploader  input.upload').each(function(i) {
        jQuery(this).attr('name','data[upload]['+(parseInt(count)+parseInt(1))+']');
        count++;
    });
}
</script>