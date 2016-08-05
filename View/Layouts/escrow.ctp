<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Rockland</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<?php 
/// load all css here 
    echo $this->Html->css('owl-carousel/owl.carousel');
    echo $this->Html->css('owl-carousel/owl.theme');
    echo $this->Html->css('headereffects/css/component');
    echo $this->Html->css('headereffects/css/normalize');
    echo $this->Html->css('rs-plugin/css/settings');
    echo $this->Html->css('pace/pace-theme-flash');
    echo $this->Html->css('boostrapv3/bootstrap.min');
    echo $this->Html->css('boostrapv3/bootstrap-theme.min'); 
    echo $this->Html->css('font-awesome/css/font-awesome');
    echo $this->Html->css('animate.min');
    echo $this->Html->script('jquery-1.8.3.min');
    echo $this->Html->script('jquery-validation/jquery.validate.min');
    echo $this->Html->css('front/style');
    echo $this->Html->css('front/magic_space');
    echo $this->Html->css('front/responsive');
    echo $this->Html->css('front/animate.min');
    echo $this->Html->css('front/custom');
   
?>
<!-- END CSS TEMPLATE -->
</head>
<!-- END HEAD -->
<body>
  <script type= "text/javascript">
    var baseURL = '<?php echo Configure::read("BASE_URL"); ?>';
  </script>
<div class="main-wrapper">
  <div role="navigation" class="navbar navbar-default navbar-static-top">
    <?php echo $this->element('fronts/escrow_top_nav');?>
  </div>
  <?php echo $content_for_layout; ?>
</div>
<?php 
    echo $this->Html->script('bootstrap/bootstrap.min');
    echo $this->Html->script('pace/pace.min');
    echo $this->Html->script('front/core');
    echo $this->Html->script('owl-carousel/owl.carousel.min');
    echo $this->Html->script('waypoints.min');
    echo $this->Html->script('parrallax/jquery.parallax-1.1.3');
    echo $this->Html->script('jquery-nicescroll/jquery.nicescroll.min');
    echo $this->Html->script('jquery-appear/jquery.appear');
    echo $this->Html->script('jquery-numberAnimate/jquery.animateNumbers');
   echo $this->Html->script('common');
?>

</body>
</html>

