<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><p>YOU ARE HERE</p></li>
            <li>
                <?php echo $this->Html->link('Manage Video', array('controller'=>'admins','action'=>'manageVideo'),array('class'=>'active'));?>
            </li>
        </ul>
        <div class="page-title">
            <?php echo $this->Html->link('<i class="icon-custom-left"></i>',array('controller'=>'admins','action'=>'manageVideo'),array('escape'=>false));?>
            <h3><?php echo $action;?> - <span class="semi-bold">Video</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          
          <div class="grid-body no-border">
          <?php
            echo $this->Form->create('VideoTutorial', array('id'=>'TemplateId','novalidate'=>'novalidate','enctype'=>'multipart/form-data'));              
            echo $this->Form->hidden('VideoTutorial.id',array('value'=>(!empty($this->request->data['VideoTutorial']['id'])) ? $this->request->data['VideoTutorial']['id'] : ''));
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Video Title<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                                <?php echo $this->Form->input('VideoTutorial.title',array('label' => false,'div' => false, 'placeholder' => 'Video Title','class' => 'form-control','maxlength' => 150));?>     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Video URL<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                                <?php echo $this->Form->input('VideoTutorial.video_url',array('label' => false,'div' => false, 'placeholder' => 'Video URL','class' => 'form-control','maxlength' => 150));?>     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Video Description</label>
                        <div class="right">                                       
                            <i class=""></i>
                                <?php echo $this->Form->textarea('VideoTutorial.description',array('label' => false,'div' => false, 'placeholder' => 'Video Description','class' => 'form-control','rows'=>'5','style'=>'resize : none;'));?>     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                            <?php echo $this->Form->input('VideoTutorial.status',array('style' => 'width : 5%','type'=>'checkbox','label' => false,'div' => false,'value'=>'1','class' => 'pull-left form-control'));?>     
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