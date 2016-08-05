<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><p>YOU ARE HERE</p></li>
            <li>
                <?php echo $this->Html->link('Loan Phase', array('controller'=>'admins','action'=>'loanPhases'),array('class'=>'active'));?>
            </li>
        </ul>
        <div class="page-title">
            <?php echo $this->Html->link('<i class="icon-custom-left"></i>',array('controller'=>'admins','action'=>'loanPhases'),array('escape'=>false));?>
            <h3><?php echo $action;?> - <span class="semi-bold">Loan Phase</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          
          <div class="grid-body no-border">
          <?php
            echo $this->Form->create('PhaseName', array('id'=>'TemplateId','novalidate'=>'novalidate','enctype'=>'multipart/form-data'));              
            echo $this->Form->hidden('PhaseName.id',array('value'=>(!empty($this->request->data['PhaseName']['id'])) ? $this->request->data['PhaseName']['id'] : ''));
        ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Loan Phase<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                                <?php echo $this->Form->input('PhaseName.phase_name',array('label' => false,'div' => false, 'placeholder' => 'Phase Name','class' => 'form-control','maxlength' => 100));?>     
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="pull-left"></div>
                <div class="pull-right">
                <?php
                    echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-primary btn-cons'));
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