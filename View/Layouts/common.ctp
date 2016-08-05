<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Rockland - User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<?php echo $this->Html->meta('favicon.ico', '/img/logo.png', array('type' => 'icon')); ?>
<?php
    echo $this->Html->css(array('pace/pace-theme-flash',
                                'boostrapv3/bootstrap.min',
                                'boostrapv3/bootstrap-theme.min',
                                'font-awesome/css/font-awesome',
                                'bootstrap-datepicker/datepicker',
                                'animate.min',
                                'jquery-ui',
                                )); 
    
    echo $this->Html->script('jquery-1.10.2.js');//jquery-1.8.3.min
    echo $this->Html->script(array('jquery-ui',
                                    'bootstrap/bootstrap.min',
                                    'jquery-validation/jquery.validate.min'));
    
    echo $this->Html->css(array('style',
                                'responsive',
                                'custom-icon-set',
                                'magic_space',
                                'jquery-scrollbar/jquery.scrollbar',
                                'multi-select')); 
    
    echo $this->Html->script('jquery.multi-select');
?>
</head>

<body class="">
     <script type= "text/javascript">
        var baseURL = '<?php echo Configure::read("BASE_URL"); ?>';
    </script>
<?php echo $this->element('common/header'); ?>
<div class="page-container row-fluid">
<?php
    echo $this->element('common/navigation'); 
    echo $this->fetch('content'); 
    //echo $this->element('chat');
?>
<!-- END CHAT --> 	  
</div>
<!--[if lt IE 9]>
<script src="assets/plugins/respond.js"></script>
<![endif]-->

<?php
echo $this->Html->script(array('jquery.maskedinput',
                                'jquery-scrollbar/jquery.scrollbar.min.js',
                                
                                'bootstrap-datepicker/bootstrap-datepicker',
                                'bootstrap-timepicker',
                                'breakpoints',
                                'pace/pace.min',
                                'assets/core',
                                'assets/chat',
                                'assets/demo',
                                'assets/custom',
                                'bootbox.min',
                                'highcharts',
                                'highcharts-3d'
                                ));

//echo $this->Html->script('admin/dashboard');
?>

<script type="text/javascript">
    $(document).ready(function () {
        $(".input_mask_year").mask("9999");
        //$(".live-tile,.flip-list").liveTile();
    });
</script>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top: 40px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
        </div>
    </div>
  </div>
<!-- Modal End -->
</body>
</html>