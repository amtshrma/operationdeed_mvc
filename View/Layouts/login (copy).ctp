<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
     <?php
        echo $this->Html->css('front/bootstrap.css');
        echo $this->Html->css('front/signin.css');
        echo $this->Html->css('front/font-awesome.min.css');
        echo $this->Html->css('front/developer.css');
        echo $this->Html->css('bootstrap-datepicker/datepicker');
    ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var BASE_URL = '<?php echo BASE_URL;?>';
    </script>
  </head>
  <body>
    <div class="container">
        <?php echo $this->fetch('content');?>
    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php
        echo $this->Html->script(array('front/jquery.js', 'front/bootstrap.min.js'));
    ?>
     </body>
    <script>
        jQuery('document').ready(function(){
            // set provide
            jQuery('a.socialButton').click(function() {
                var provider = jQuery(this).attr('id'); 
                jQuery('#selectedProvider').val(provider);
            });
            // redirect to url
            jQuery('select#selectedSocialUser').change(function() {
                var provider = jQuery('#selectedProvider').val();
                var selectType =  jQuery(this).val();
                var URL = BASE_URL+"homes/social_login/"+provider+"/"+selectType;
                window.location = URL;
            });
        });
  </script>
</html>