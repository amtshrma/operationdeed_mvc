<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Rockland - Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<?php
    echo $this->Html->css('pace/pace-theme-flash'); 
    echo $this->Html->css('boostrapv3/bootstrap.min');
    echo $this->Html->css('boostrapv3/bootstrap-theme.min'); 
    echo $this->Html->css('font-awesome/css/font-awesome');
    echo $this->Html->css('animate.min');
    echo $this->Html->script('jquery-1.8.3.min');
    echo $this->Html->script('jquery-validation/jquery.validate.min');
    echo $this->Html->css('style'); 
    echo $this->Html->css('responsive');
    echo $this->Html->css('custom-icon-set');
    echo $this->Html->css('magic_space');
    echo $this->Html->css('jquery-scrollbar/jquery.scrollbar');
    echo $this->Html->css('jquery-datatable/css/jquery.dataTables');
?>

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="inner-menu-always-open extended-layout">
<!-- BEGIN HEADER -->
<?php echo $this->element('common/header'); ?>
<!-- END HEADER --> 
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid"> 
<!-- BEGIN SIDEBAR -->
<?php echo $this->element('common/email_navigation'); ?>
  <!-- BEGIN PAGE -->
<?php echo $this->fetch('content'); ?> 
<!-- BEGIN CHAT --> 
<?php echo $this->element('chat'); ?>
<!-- END CHAT -->
</div>
<!-- END CONTAINER --> 
<?php
echo $this->Html->script('jquery-scrollbar/jquery.scrollbar.min.js');
echo $this->Html->script('bootstrap/bootstrap.min');
echo $this->Html->script('breakpoints');
echo $this->Html->script('pace/pace.min');
echo $this->Html->script('assets/core');
echo $this->Html->script('assets/chat');
echo $this->Html->script('assets/demo');
echo $this->Html->script('assets/email_comman');
?>
<script type="text/javascript">
        $(document).ready(function () {
            //$(".live-tile,.flip-list").liveTile();
        });
</script>

<!-- END CORE TEMPLATE JS -->
</body>
</html>