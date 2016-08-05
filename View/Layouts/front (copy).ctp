<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $this->Html->charset('UTF-8'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Rockland</title>
<?php
echo $this->Html->css('admin/bootstrap'); 
echo $this->Html->css('style');
echo $this->Html->script('jquery.min');
echo $this->Html->script('jquery.validate');
echo $this->Html->script('common');
?>

</head>
<body>
<script type= "text/javascript">
    var baseURL = '<?php echo Configure::read("BASE_URL"); ?>';
</script>
<section id="main" class="wrapper">
    <header>
        <!--Logo Start-->
        <section class="logo"><?php echo $this->Html->image('logo.jpg'); ?></section>        
        <!--Logo Closed-->
    </header>
    <section id="content">
        <div class="row">
            <?php echo $this->fetch('content'); ?>                    
        </div>
        <div class="push"></div>
    </section>
</section>
 <?php echo $this->element('footer'); ?>
 </body>
</html>