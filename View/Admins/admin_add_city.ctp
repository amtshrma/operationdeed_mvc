<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><p>YOU ARE HERE</p></li>
            <li>
                <?php echo $this->Html->link('Cities', array('controller'=>'admins','action'=>'list_cities'),array('class'=>'active'));?>
            </li>
        </ul>
        <div class="page-title">
            <?php echo $this->Html->link('<i class="icon-custom-left"></i>',array('controller'=>'admins','action'=>'listStates'),array('escape'=>false));?>
            <h3><?php echo $action;?> - <span class="semi-bold">City</span></h3>
      </div> 
   <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-body no-border">
            <?php
                echo $this->Form->create('City', array('id'=>'TemplateId','novalidate'=>'novalidate'));              
                echo $this->Form->hidden('City.id',array('value'=>(!empty($this->request->data['City']['id'])) ? $this->request->data['City']['id'] : ''));
            ?>  
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Name<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                                <?php echo $this->Form->input('City.city',array('label' => false,'div' => false, 'placeholder' => 'City Name','class' => 'form-control','maxlength' => 50));?>     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select State<span class="required"> * </span></label>
                        <div class="right">                                       
                            <i class=""></i>
                                <?php echo $this->Form->input('City.state_id',array('options'=>$state,'label' => false,'div' => false, 'empty' => 'Select City','class' => 'form-control','maxlength' => 50));?>     
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="right">                                       
                            <i class=""></i>
                            <?php echo $this->Form->input('City.status',array('style' => 'width : 5%','type'=>'checkbox','label' => false,'div' => false,'value'=>'1','class' => 'pull-left form-control'));?>     
                        </div>
                    </div>
                    <div class="form-group">
                        <br />
                        <label class="form-label">Order</label>
                        <div class="right">                                       
                            <i class=""></i>
                            <?php echo $this->Form->input('City.order',array('style' => 'width : 5%','type'=>'checkbox','label' => false,'div' => false,'value'=>'1','class' => 'pull-left form-control'));?>     
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