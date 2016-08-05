<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Rockland - Admin </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<?php echo $this->Html->meta('favicon.ico', '/img/logo.png', array('type' => 'icon')); ?>
<!-- BEGIN CORE CSS FRAMEWORK -->
<?php
    echo $this->Html->css('pace/pace-theme-flash'); 
    echo $this->Html->css('boostrapv3/bootstrap.min');
    echo $this->Html->css('boostrapv3/bootstrap-theme.min'); 
    echo $this->Html->css('font-awesome/css/font-awesome');
    echo $this->Html->css('animate.min');
    echo $this->Html->script('jquery-1.8.3.min');
    echo $this->Html->script('jquery-validation/jquery.validate.min');
?>
<!-- END CORE CSS FRAMEWORK -->
<!-- BEGIN CSS TEMPLATE -->
<?php echo $this->Html->css('style'); 
    echo $this->Html->css('responsive');
    echo $this->Html->css('custom-icon-set');
?>
<!-- END CSS TEMPLATE -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="error-body no-top">
<div class="container">
   <?php echo $this->fetch('content'); ?>
</div>
<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK-->
<?php 
echo $this->Html->script('bootstrap/bootstrap.min');
echo $this->Html->script('pace/pace.min');
?>
<!-- BEGIN CORE TEMPLATE JS -->
<!-- END CORE TEMPLATE JS -->
</body>
</html>