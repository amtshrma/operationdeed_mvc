<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Operation Trust Deed</title>
    <!-- Bootstrap Core CSS -->
    <?php
        echo $this->Html->css('longApp/bootstrap.min.css');
        echo $this->Html->css('longApp/font-awesome.min.css');
        // <!--Select Dropdown CSSS-->
        echo $this->Html->css('longApp/main.css');
        echo $this->Html->css('longApp/custom-responsive.css');
        echo $this->Html->css('front/developer.css');
        echo $this->Html->css('bootstrap-datepicker/datepicker');
		echo $this->Html->css('front/jquery-ui.css');
        echo $this->Html->script(array('longApp/jquery.min.js','jquery-validation/jquery.validate.min'));
    ?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<?php echo $this->Element('fronts/onload_page_loader');?>
    <?php
        $getUserList = $this->Common->getUserList($this->Session->read('userInfo.id'));
        $getUserList = json_decode($getUserList,true);
        $hasMessages = $getUserList['chat'];
        $getUserList = $getUserList['UserList'];
    ?>
    <!--header start-->
    <?php
		echo $this->Element('fronts/dashboard_common_header',array('hasMessages'=>$hasMessages));
	?>
    <!--header end-->
    <div id="wrapper" class=""> 
        <!-- Navigation -->
        <?php
		if($this->Session->read('userInfo.user_type') == '1'){
			echo $this->Element('fronts/borrower_nav');
		}else if($this->Session->read('userInfo.user_type') == '11'){
			echo $this->Element('fronts/escrow_top_nav');
		}else{
			echo $this->Element('fronts/dashboard_common_nav');
		}
        echo $this->fetch('content');
		?>
    </div>
    
    <!-- content end --->
    <script>
        var baseURL = BASE_URL = '<?php echo BASE_URL;?>';
    </script>
    <?php
        echo $this->Html->script(array('bootbox.min.js','front/jquery-ui.js','front/common.js','front/bootstrap.js','jquery.maskedinput','longApp/long_app.js'));
    ?>
<?php echo $this->Element('fronts/chat',array('getUserList'=>$getUserList));?>
<script>
// enabled button on page load
if(jQuery){
	jQuery('.enabledButton').prop('disabled', false);
}

jQuery('document').ready(function(){ 
	setTimeout(function(){
			jQuery('#flashMessage').hide('slow')
	}, 10000);
	// toggle
	jQuery("#menu-toggle").click(function(e) {
		e.preventDefault();
		jQuery("#wrapper").toggleClass("toggled");
	});
	// dob calender
	jQuery(document).ready(function(){
		var dateToday = new Date(); 
		jQuery('#dateOfBirth').datepicker({
											endDate: '+0d',
											autoclose: true	
									});
		jQuery('.date').datepicker({ format: "mm/dd/yyyy", startDate:new Date()});
	});
	// side bar height according to page height
	if(jQuery(window).width() > 850){
		jQuery('#sidebar-wrapper').css('height',jQuery(document).height());
		jQuery('input[type=text][readonly],input[type=number][readonly],input[type=email][readonly]').each(function(){
			jQuery(this).addClass('noValidate');	
		});
	}
	
    jQuery('.confirmAction').click(function(e) {
		bootbox.confirm('Are you sure ?', function(status) {
			if(status){
				return true;
			}else{
				return false;
			}
		});
	});
});
</script>
<!-- loan listing popup -->
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