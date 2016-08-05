<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><p>YOU ARE HERE</p></li>
            <li>
                <?php echo $this->Html->link('Loan Reasons', array('controller'=>'admins','action'=>'loan_reasons'),array('class'=>'active'));?>
            </li>
        </ul>
        <div class="page-title">
            <?php echo $this->Html->link('<i class="icon-custom-left"></i>',array('controller'=>'admins','action'=>'listStates'),array('escape'=>false));?>
            <h3><?php echo $action;?> - <span class="semi-bold">Loan Reason</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          
          <div class="grid-body no-border">
          <?php
            echo $this->Form->create('LoanReason', array('id'=>'TemplateId','novalidate'=>'novalidate','enctype'=>'multipart/form-data'));              
            echo $this->Form->hidden('LoanReason.id',array('value'=>(!empty($this->request->data['LoanReason']['id'])) ? $this->request->data['LoanReason']['id'] : ''));
        ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Loan Reason<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                                <?php echo $this->Form->input('LoanReason.loan_reason',array('label' => false,'div' => false, 'placeholder' => 'LoanReason','class' => 'form-control','maxlength' => 100));?>     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">LTV Max %<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                            <?php
                           
                            echo $this->Form->input('LoanReason.loan_value_max',array('label' => false,'div' => false, 'placeholder' => 'LTV','type'=>'number','class' => 'form-control','min'=>'10','max' => "100"));?>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">ARV Max %</label>
                        <div class="right">                                       
                            <i class=""></i>
                            <?php echo $this->Form->input('LoanReason.after_repair_max',array('label' => false,'div' => false, 'placeholder' => 'ARV','type'=>'number','class' => 'form-control','min'=>'10','max' => "100"));?>  
                        </div>
                    </div> 
                    
                </div>
            </div>
            <div class="col-md-5">
                <div class="pull-left"></div>
                <div class="pull-right">
                <?php
                    echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-danger btn-cons'));
                ?>
                </div>
            </div>
             <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>