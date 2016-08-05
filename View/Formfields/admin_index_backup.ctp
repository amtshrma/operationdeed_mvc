
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<?php echo $this->Html->script('formBuilder.js');
  echo $this->Html->css('formBuilder'); ?>
  <script>
  jQuery(document).ready(function($) {
    'use strict';
    $('textarea').formBuilder();
  });
  </script>


 
 <?php echo $this->Form->create(null, array('url' => array('controller' => 'formfields', 'action' => 'index'),'id'=>'loginId'));?>      
    <textarea name="formBuilder" id="formBuilder" cols="30" rows="10"></textarea>
    <input type="submit" value="Submit"/> 
<?php echo $this->Form->end(); ?>

