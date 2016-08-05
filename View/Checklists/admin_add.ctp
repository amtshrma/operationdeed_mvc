<div class="page-content">
 <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li>
        <?php echo $this->Html->link('Checklists', array('controller'=>'checklists','action'=>'index'),array('class'=>'active'));?>
        </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <h3><?php echo $action; ?> - <span class="semi-bold">Documents</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
            <?php echo $this->Session->flash();?>
          <div class="grid-body no-border">
        <?php 
            echo $this->Form->create('Checklist', array('id'=>'checklistId','type'=>'file','novalidate'=>'novalidate'));
            $id = (!empty($this->request->data['Checklist']['id'])) ? $this->request->data['Checklist']['id'] : '';
            echo $this->Form->hidden('Checklist.id',array('value'=>base64_encode($id)));
            $oldDocument = (!empty($this->request->data['Checklist']['value'])) ? $this->request->data['Checklist']['value'] : '';
            echo $this->Form->hidden('Checklist.old_document',array('value'=>$oldDocument));
        ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                     <label class="form-label">Document Name<span class="required"> * </span></label>
                     <div class="right">                                       
                        <i class=""></i>
                        <?php echo $this->Form->input('checklistname',array('label' => false,'div' => false, 'placeholder' => 'Name','class' => 'form-control','maxlength' => 100));?>     
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Property Type<span class="required">*</span><br/>
                     <span class="help"> Note : Select All if document is needed for all checklists</span></label>
                     <div class="right">                                       
                         <i class=""></i>
                        <?php
                        $propertyTypes['all'] = 'All'; 
                        echo $this->Form->input('property_type', array('label' => false,'div' => false,'class' => 'form-control','options' =>$propertyTypes,'default'=>'all'));?>    
                  </div>
                  </div>     
                  <div class="form-group">
                     <label class="form-label">Upload<span class="required"> * </span></label>
                     <div class="right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('document', array('label' => false,'div' => false,'class' => '','type'=>'file'));
                        if(isset($this->request->data['Checklist']['value']) && !empty($this->request->data['Checklist']['value'])){
                          $document = $this->request->data['Checklist']['value'];
                         echo $this->Html->link($document, '/upload/'.$document, array('class' => 'button','target'=>'_blank'));
                        } ?>
                        
                     </div>
                     
                  </div>      
              </div>
            </div>
            <div class="form-actions">
                <div class="pull-left"></div>
                <div class="pull-right">
                    <?php
                    echo $this->Form->button($buttonText, array('type' => 'submit','class' => 'btn btn-danger btn-cons'));
                    echo $this->Form->button('Reset', array('type' => 'reset','class' => 'btn btn-white btn-cons'));?>
                </div>
            </div>
             <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>


  