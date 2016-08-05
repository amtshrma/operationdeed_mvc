<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Rockland - Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<?php echo $this->Html->meta('favicon.ico', '/img/logo.png', array('type' => 'icon')); ?>
<?php
    echo $this->Html->css('pace/pace-theme-flash'); 
    echo $this->Html->css('boostrapv3/bootstrap.min');
    echo $this->Html->css('boostrapv3/bootstrap-theme.min'); 
    echo $this->Html->css('font-awesome/css/font-awesome');
    echo $this->Html->css('animate.min');
    echo $this->Html->css('jquery-ui');
    echo $this->Html->css('jquery-scrollbar/jquery.scrollbar');
    
    echo $this->Html->script(array('jquery-1.10.2.js', 'jquery-ui'));
    //echo $this->Html->script('jquery-1.8.3.min');
    echo $this->Html->script('jquery-validation/jquery.validate.min');
    
    echo $this->Html->css(array('style',
                                'responsive',
                                'custom-icon-set',
                                'magic_space',
                                'multi-select'));
    
    echo $this->Html->script('jquery.multi-select');    
?>
<style>
    .error-message{
        color: #f00;
    }
</style>
</head>

<body class="">
         <script type= "text/javascript">
        var baseURL = BASE_URL = '<?php echo Configure::read("BASE_URL"); ?>';
    </script>
<?php echo $this->element('admin/header'); ?>
<div class="page-container row-fluid">
<?php
    echo $this->element('admin/navigation'); 
    echo $this->fetch('content');
    
    //echo $this->element('admin/footer'); 
?>
<!-- END CHAT --> 	  
</div>
<?php echo $this->element('chat'); ?>
<!--[if lt IE 9]>
<script src="assets/plugins/respond.js"></script>
<![endif]-->

<?php
    echo $this->Html->script(array('jquery-scrollbar/jquery.scrollbar.min.js',
                                'bootstrap/bootstrap.min',
                                'breakpoints',
                                'pace/pace.min',
                                'bootbox.min',
                                'highcharts',
                                'highcharts-3d','assets/core.js','assets/demo.js'
                                ));
?>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top: 40px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
        </div>
    </div>
  </div>
<!-- Modal End -->
<script>
    jQuery('.confirmAction').click(function(){
        var status = confirm("Are you sure ?");    
        if(!status){
            return false;
        }else{
            return true;
        }
    });
</script>
<!-- Modal -->
<div id="loansShowModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="text-align: left;" class="modal-title">Loans Listing</h4>
            </div>
            <div class="modal-body adminLoansModel" style="background: #fff;">
            </div>
        </div>
    </div>
</div>
</body>
</html>