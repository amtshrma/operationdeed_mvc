<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Operation Trust Deed - Long App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            echo $this->Html->css('longApp/bootstrap.min.css');
            echo $this->Html->css('longApp/font-awesome.min.css');
            // <!--Select Dropdown CSSS-->
            echo $this->Html->css('longApp/main.css');
            echo $this->Html->css('longApp/custom-responsive.css');
            echo $this->Html->css('front/developer.css');
            echo $this->Html->script(array('longApp/jquery.min.js'));
        ?>
        <script>
            var BASE_URL = '<?php echo BASE_URL;?>';
        </script>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
        <style>
            .sidebar-menu-box .sidebar-nav li a.active{
                background: #283439;
                text-decoration: none;
                color: #fff;
                text-indent: 15px;
                transition: all 0.3s ease;
                -moz-transition: all 0.3s ease;
                -webkit-transition: all 0.3s ease;
            }
        </style>
        <!--[if gte IE 9]>
        <style type="text/css">
            .gradient{
                filter:none;
            }
        </style>
        <![endif]-->
    </head>
    <body>
        <!--header start-->
            <?php echo $this->Element('longApp/longApp_header');?>
        <!--header end--> 
        <!--middle content start-->
        <div id="wrapper" class=""> 
          <!-- Sidebar -->
            <?php echo $this->Element('longApp/longApp_sidebar');?>
            <!-- /#sidebar-wrapper -->           
            <?php echo $this->fetch('content');?>
        </div>
        <!--middle content end--> 
        <?php
            echo $this->Html->script(array('longApp/bootstrap.min.js','longApp/custom.js','jquery.maskedinput','longApp/long_app.js'));
        ?>
        <!--Select Dropdown JS-->
    </body>
</html>