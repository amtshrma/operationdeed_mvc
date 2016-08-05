<?php
 echo $this->Html->script('ckeditor/ckeditor');
?>
<div class="page-content">
 <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li>
        <?php echo $this->Html->link('Loan Doc Template',array('controller'=>'email_templates','action'=>'loan_doc','admin'=>true),array('class'=>'active'));?>
        </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3><?php echo $action; ?> - <span class="semi-bold">Loan Doc Template</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          
          <div class="grid-body no-border">
          <?php
            echo $this->Form->create(null, array('url' => array('controller' => 'email_templates', 'action' => 'admin_add_doc'),'id'=>'emailTemplateId'));              
             echo $this->Form->hidden('EmailTemplate.id',array('value'=>base64_encode($this->data['EmailTemplate']['id'])));
             ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                     <label class="form-label">Name<span class="required"> * </span></label>
                     <div class="right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('name',array('label' => false,'div' => false, 'placeholder' => 'Name','class' => 'form-control','maxlength' => 100));?>     
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Template<span class="required"> * </span></label>
                     <div class="right">                                       
                         <i class=""></i>
                        <?php echo $this->Form->input('template', array('id'=>'text-editor','label' => false,'div' => false,'class' => 'ckeditor form-control',"rows"=>"35",'style'=>'resize:none;'));?>    
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
<script type= "text/javascript">
function SetDynamicText()
{ 
    var DynamicText = document.getElementById('EmailtemplateDynamicText').value ;
    if(DynamicText==""){
       return false;
    }
   // tinyMCE.execInstanceCommand('content',"mceInsertContent",false,DynamicText);
   
    var editor_data = CKEDITOR.instances['editor1'].getData();
    var fulldata = DynamicText+editor_data;
CKEDITOR.instances['editor1'].setData(fulldata);
//var oEditor = CKEDITOR.instances.ckfinder;
//oEditor.insertHtml( DynamicText );
//CKEDITOR.instances[**ckeditorname**].setData(DynamicText)


    //var getvalues = tinyMCE.getContent() + DynamicText;
    //tinyMCE.setContent(getvalues);
} 
</script>

  