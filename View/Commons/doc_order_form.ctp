<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <h2>Doc Order Form</h2><hr/>
        <div class="row">
            <?php echo $this->Form->create('DocOrderApproval', array('id'=>'borrowerRegister','type' => 'file','style'=>''));
            echo $this->Form->hidden('id',array('value'=>$docApprovalID,'id'=>'hiddenApprovalID'));
            echo $this->Form->hidden('loanID',array('value'=>$loanId,'id'=>'hiddenLoanID'));?>
            <div class="col-md-12">
                <?php
                    $this->element('common/doc_order_form');
                    $data = $this->get('data');
                    echo $data;
                ?> 
            </div>
            <?php
                $userID = $this->Session->read('userInfo.id');
               $check = $this->Common->docOrderApproval($docApprovalID, $userID);
                if($check != 1) {
                    ?>
                    <div class="form-group col-lg-12">
                        <div class="col-md-2 col-md-offset-10">
                            <?php echo $this->Form->input('Approve',array('label'=>false,'div' => false,'type '=> 'button','class'=>'btn btn-primary btn-cons','value'=>'Approve','id'=>'approveDocOrderButton'));?>
                            <?php echo $this->Form->input('Deny',array('label'=>false,'div' => false,'type '=> 'button','class'=>'btn btn-danger btn-cons','name'=>'register-submit','value'=>'Deny','id'=>'denyDocOrderButton'));?>
                        </div>
                    </div>
                <?php
                }
                echo $this->Form->end(); ?>
        </div>
    </div>
</div>