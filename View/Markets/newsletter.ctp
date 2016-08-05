<?php
    echo $this->Html->css(array('multi-select')); 
    echo $this->Html->script('jquery.multi-select');
?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <!--<div class="content-container">-->
		<h3><span class="semi-bold">News Letters</span></h3>
		<p><?php echo $this->Session->flash();?></p>
        <?php echo $this->Form->create('Newsletter', array('id'=>'newsletter', 'novalidate'=>'novalidate'));?>
        <div class="table-responsive">
            <div class="form-group col-md-4">
                <label class="form-label">Select a template<span class="required"> * </span></label>
                <div class="right">
                    <?php echo $this->Form->select('template', $templates, array('label' => false, 'div' => false, 'empty'=>'Select Newsletter', 'class' => 'form-control','id'=>'NewsletterTemplate')); //'Please select a template' ?>
                </div>
                <div class="right error error_template"></div>
            </div>
            <div class="form-group col-md-12">                     
                <div class="right" style="clear: both;text-align: center;">                                       
                    <?php
                        echo $this->Html->image('no-image.png', array('style'=>'display: none;','id'=>'preview_template'));
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-10">
                    <label class="form-label">Emails for newsletter<span class="required"> * </span><br/>
                    <?php
                        echo $this->Form->select('to', $arrUser, array('label'=>false, 'div'=>false, 'id'=>'multiselect', 'multiple'=>'multiple'));
                    ?>
                    <div class="right error error_newsletter"></div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">Subject<span class="required"> * </span></label>
                <div class="right">                                       
                    <?php echo $this->Form->input('subject', array('label'=>false, 'div'=>false, 'placeholder'=>'enter subject', 'class'=>'form-control', 'type'=>'text', 'maxlength'=>100, 'value'=>'Newsletter')); ?>
                </div>
                <div class="right error error_subject"></div>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">From Email<span class="required"> * </span></label>
                <div class="right">                                       
                    <?php echo $this->Form->input('from_email', array('label'=>false, 'div'=>false, 'placeholder'=>'enter from email', 'class'=>'form-control', 'type'=>'text', 'maxlength'=>100, 'value'=>'manishksmd@gmail.com')); ?>
                </div>
                <div class="right error error_from_email"></div>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">From name<span class="required"> * </span></label>
                <div class="right">                                       
                    <?php echo $this->Form->input('from_name', array('label'=>false, 'div'=>false, 'placeholder'=>'enter from name', 'class'=>'form-control', 'type'=>'text', 'maxlength'=>100, 'value'=>'Operation Trust Deed')); ?>
                </div>
                <div class="right error error_from_name"></div>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">To name<span class="required"> * </span></label>
                <div class="right">                                       
                    <?php echo $this->Form->input('to_name', array('label'=>false, 'div'=>false, 'placeholder'=>'enter to name', 'class'=>'form-control', 'type'=>'text', 'maxlength'=>100, 'value'=>'Rockland')); ?>
                </div>
                <div class="right error error_to_name"></div>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">Title<span class="required"> * </span></label>
                <div class="right">                                       
                    <?php echo $this->Form->input('title', array('label'=>false, 'div'=>false, 'placeholder'=>'enter titile', 'class'=>'form-control', 'type'=>'text', 'maxlength'=>100, 'value'=>'Newsletter - Operation Trust Deed')); ?>
                </div>
                <div class="right error error_title"></div>
            </div>
            <div class="form-actions" style="clear: both;">
                <div class="pull-right">
                <?php
                    echo $this->Form->button('Send Email', array('type' => 'submit','class' => 'btn btn-success btn-cons'));
                ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    jQuery('#multiselect').multiSelect({
        selectableHeader: "<div class='custom-header'>Selectable Users</div>",
        selectionHeader: "<div class='custom-header'>Selection Users</div>",
    });
});
</script>