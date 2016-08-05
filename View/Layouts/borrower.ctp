<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Operation Trust Deed - Long App</title>
    <!-- Bootstrap Core CSS -->
    <?php
        echo $this->Html->css('front/bower_components/bootstrap/dist/css/bootstrap.css');
        echo $this->Html->css('front/bower_components/metisMenu/dist/metisMenu.css');
        echo $this->Html->css('front/dist/css/sb-admin-2.css');
        echo $this->Html->css('front/bower_components/font-awesome/css/font-awesome.css');
        echo $this->Html->css('front/developer.css');
        echo $this->Html->css('bootstrap-datepicker/datepicker');
        echo $this->Html->css('front/jquery-ui.css');
        echo $this->Html->script(array('front/bower_components/jquery/dist/jquery.min.js'));
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php echo $this->Element('fronts/borrower_nav');?>
        <?php echo $this->fetch('content');?>
    </div>
    <script>
        var BASE_URL = '<?php echo BASE_URL;?>';
    </script>
    <?php
        echo $this->Html->script(array('front/jquery-ui.js','front/long_app.js','front/bower_components/bootstrap/dist/js/bootstrap.min.js','front/bower_components/metisMenu/dist/metisMenu.min.js','front/dist/js/sb-admin-2.js','bootstrap-datepicker/bootstrap-datepicker','jquery.maskedinput'));
    ?>
    <script>
        jQuery("#menu-toggle").click(function(e) {
            e.preventDefault();
            jQuery("#wrapper").toggleClass("toggled");
        });
        jQuery(document).ready(function(){ 
            jQuery('#dateOfBirth').datepicker();
        });
    </script>
</body>
</html>