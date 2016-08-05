<?php
 echo $this->Html->script('ckeditor/ckeditor');
 echo $this->Html->script('admin/admin_common');
?>
<div class="page-content">
 <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li>
        <?php echo $this->Html->link('Documents', array('controller'=>'documents','action'=>'index'),array('class'=>'active'));?>
        </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <h3><?php echo $action; ?> - <span class="semi-bold">Documents</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          
          <div class="grid-body no-border">
          <?php 
            echo $this->Form->create('Document', array('id'=>'checklistId','type'=>'file','novalidate'=>'novalidate'));
            
            $id = '';
            $name = '';
             if(isset($this->request->data['Document']['id']) && !empty($this->request->data['Document']['id'])){
              $id = $this->data['Document']['id'];
             }
              if(isset($this->request->data['Document']['name']) && !empty($this->request->data['Document']['name'])){
              $name = $this->data['Document']['name'];
             }
             echo $this->Form->hidden('Document.id',array('value'=>base64_encode($id),'id'=>'documentID'));
             
             $oldDocument = '';
             if(isset($this->request->data['Document']['upload']) && !empty($this->request->data['Document']['upload'])){
              $oldDocument = $this->data['Document']['upload'];
             }
             echo $this->Form->hidden('Document.old_document',array('value'=>$oldDocument));
             ?>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-label">Document Type<span class="required"> * </span></label>
                            <div class="right">                                       
                                <i class=""></i>
                               <?php echo $this->Form->input('document_type', array('label' => false,'div' => false,'class' => 'form-control','options' =>$documentTypes));?>    
                           </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-label">User Type<span class="required"> * </span></label>
                            <div class="right">                                       
                                <i class="">Click / Hold Ctrl key to select multiple option</i>
                               <?php
                               $selected = '';
                                if(!empty($this->request->data['Document']) && isset($this->request->data['Document']['user_type'])){
                                 $selected = explode(',',$this->data['Document']['user_type']);
                               }
                               
                               $designationTypes = array("2" =>"Broker/Loan Officer", "3"=>"Sales Manager","4"=>"Sales Director","5" => "Processor","6" =>"Funder","7"=>"Investor","8"=>"Investment Manager","9"=>"Marketing Manager");
                               echo $this->Form->input('user_type', array('label' => false,'div' => false,'class' => 'form-control','multiple'=>true,'options' =>$designationTypes,'empty'=>'Select One','selected'=>$selected));?>    
                           </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Document Name<span class="required"> * </span></label>
                            <div class="right">                                       
                                <i class=""></i>
                               <?php echo $this->Form->input('document_name', array('label' => false,'div' => false,'class' => 'form-control','type' =>'text','value'=>$name));?>    
                           </div>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <span class="help">Note: Admin can <a href="javascript:void(0);" id="showUpload" title="Click here to upload">upload </a> legal agreement or copy template in below text box</span>
                           <?php
                           $uploadClass = 'none';
                            if(!empty($this->request->data['Document']) && isset($this->request->data['Document']['upload'])){
                             $uploadClass = 'block';

                            }
                           
                           echo $this->Form->input('document',array('label' => false,'div' => false,'class' => 'off','type' => 'file','id'=>'fileBox','style' =>'display:'.$uploadClass.';'));?>
                           <div class="right">                                       
                               <i class=""></i>
                              <?php
                              if(isset($this->request->data['Document']['upload']) && !empty($this->request->data['Document']['upload'])){
                                $document = $this->request->data['Document']['upload'];
                               echo $this->Html->link($document, '/admin_document/'.$document, array('class' => 'button','target'=>'_blank'));
                              } ?>
                              
                           </div>
                        </div>
                    </div>
                </div>
                <?php 
                 $editorClass = 'style="display:block;"';
                
                  if(empty($this->request->data['Document'])){
                   $editorClass = 'style="display:block;"';
                  }else if(!empty($this->request->data['Document']) && $this->request->data['Document']['document_description'] == ''){ 
                   $editorClass = 'style="display:none;"';
                  }
                  ?>
                <div class="row" id="templateContainer" <?php echo $editorClass; ?>>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Template <span class="required"> * </span></label>
                            <div class="right">                                       
                                <i class=""></i>
                               <?php
                              
                               echo $this->Form->input('document_description', array('label' => false,'div' => false,'class' => 'form-control ckeditor','name'=>"document_description",'type' =>'textarea','rows'=>'20','cols'=>'5','id'=>'document_description'));?>    
                           </div>
                        </div>    
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