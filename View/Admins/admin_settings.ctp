<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><p>YOU ARE HERE</p></li>
            <li>
                <?php echo $this->Html->link('Admin Setting', 'javascript:void(0);',array('class'=>'active'));?>
            </li>
        </ul>
        <div class="page-title">
            <?php echo $this->Html->link('<i class="icon-custom-left"></i>',array('controller'=>'admins','action'=>'listStates'),array('escape'=>false));?>
            <h3>Admin Setting</h3>
      </div> 
	<div class="row">
    <div class="col-md-12">
    <div class="grid simple">
		<?php echo $this->Session->flash();?>
		<div class="grid-body no-border">
		<br /><br />
        <?php
            echo $this->Form->create('AdminSetting', array('id'=>'TemplateId','novalidate'=>'novalidate','enctype'=>'multipart/form-data'));              
            echo $this->Form->hidden('AdminSetting.id',array('value'=>(!empty($this->request->data['AdminSetting']['id'])) ? $this->request->data['AdminSetting']['id'] : ''));
        ?>
            <div class="row">
				<div class="form-group col-md-3">
					<label class="form-label">Rockland Commission<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.rockland_commission',array('label' => false,'div' => false, 'placeholder' => 'Rockland Commission','class' => 'form-control','maxlength' => 11,'type'=>'number'));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Minimum Loan Amount<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.min_loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Minimum Loan Amount','class' => 'form-control','maxlength' => 50));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Maximum Loan Amount<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.max_loan_amount',array('label' => false,'div' => false, 'placeholder' => 'Maximum Loan Amount','class' => 'form-control','maxlength' => 20));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Fico Score<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.fico_score',array('label' => false,'div' => false, 'placeholder' => 'Fico Score','class' => 'form-control','maxlength' =>11));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Processing Fee<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.processing_fee',array('label' => false,'div' => false, 'placeholder' => 'Processing Fee','class' => 'form-control','maxlength' => 11));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Origination Fee<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.origination_fee',array('label' => false,'div' => false, 'placeholder' => 'Origination Fee','class' => 'form-control','maxlength' => 11));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Sales Director Fee<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.sales_director_fee',array('label' => false,'div' => false, 'placeholder' => 'Sales Director Fee','class' => 'form-control','maxlength' => 11,'type'=>'number'));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Processor Fee<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.processor_fee',array('label' => false,'div' => false, 'placeholder' => 'Processor Fee','class' => 'form-control','maxlength' => 11,'type'=>'number'));?>     
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Funder Fee<span class="required"> * </span></label>
					<div class="right">                                       
						<i class=""></i>
							<?php echo $this->Form->input('AdminSetting.funder_fee',array('label' => false,'div' => false, 'placeholder' => 'Funder Fee','class' => 'form-control','maxlength' => 11,'type'=>'number'));?>     
					</div>
				</div>
            </div>
            <div class="col-md-12">
                <div class="col-md-2 col-md-offset-10">
				<?php
                    echo $this->Form->button('Save Settings', array('type' => 'submit','class' => 'btn btn-primary btn-cons'));
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