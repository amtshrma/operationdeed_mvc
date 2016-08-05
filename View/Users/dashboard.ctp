<?php
/*
echo $this->Html->css(array('../../assets/plugins/jquery-metrojs/MetroJs.min',
								  '../../assets/plugins/shape-hover/css/demo',
								  '../../assets/plugins/shape-hover/css/component',
								  '../../assets/plugins/owl-carousel/owl.carousel',
								  '../../assets/plugins/owl-carousel/owl.theme',
								  '../../assets/plugins/jquery-ricksaw-chart/css/rickshaw',
								  '../../assets/plugins/Mapplic/mapplic/mapplic'
								  )); 

//BEGIN CORE CSS FRAMEWORK 
echo $this->Html->css(array('../../assets/plugins/boostrapv3/css/bootstrap.min',
								  '../../assets/plugins/boostrapv3/css/bootstrap-theme.min',
								  '../../assets/plugins/font-awesome/css/font-awesome',
								  '../../assets/css/animate.min.',
								  '../../assets/plugins/jquery-scrollbar/jquery.scrollbar')); 

//END CORE CSS FRAMEWORK

//BEGIN CSS TEMPLATE
 echo $this->Html->css(array('../../assets/css/style',
								  '../../assets/css/responsive',
								  '../../assets/css/custom-icon-set',
								  '../../assets/css/magic_space'));
*/
?>
<!-- END CSS TEMPLATE -->

<div class="page-content">
<div class="content sm-gutter">      
<div class="row hidden-xlg">
	<!-- BEGIN DASHBOARD TILES -->
    <div class="row">
	<div class="tiles green">
	  <div class="tiles-body">
		<div class="heading"> Statistical </div>
		<p>Status : live</p>
		<p>Total Loans : <?php echo $totalLoans; ?></p>
	  </div>
	  <div class="tile-footer">
		<div class="iconplaceholder"><i class="fa fa-map-marker"></i></div>
		<?php echo $loanStates; ?> States, <?php echo $loanCities; ?> Cities </div>
	</div>
	 <div class="col-md-4 col-vlg-3 col-sm-6">
		 <div class="tiles green m-b-10">
		  <div class="tiles-body">
		  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			  <div class="tiles-title text-black">LOAN IN PROCESS / ACTIVE LOANS </div>
			  <div class="widget-stats">
			   <div class="wrapper transparent"> 
				 <span class="item-title">Total</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $activeLoan; ?>" data-animation-duration="700">0</span>
			  </div>
			  </div>
			  <div class="widget-stats">
				<div class="wrapper transparent">
				  <span class="item-title">Today</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $alToday; ?>" data-animation-duration="700">0</span> 
				</div>
			  </div>
			  <div class="widget-stats ">
				<div class="wrapper transparent"> 
				  <span class="item-title">This Month</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $alMonth; ?>" data-animation-duration="700">0</span> 
			   </div>
			  </div>
			  <div class="widget-stats">
			   <div class="wrapper last">
				 <span class="item-title">This Year</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $alYear; ?>" data-animation-duration="700">0</span> 
			   </div>
			 </div>
			  <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
				<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%" ></div>
			  </div>
			 <!--<div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>-->
			</div>
		 </div>
	 </div>
	 <div class="col-md-4 col-vlg-3 col-sm-6">
		<div class="tiles blue m-b-10">
		  <div class="tiles-body">
		  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			  <div class="tiles-title text-black">LOAN CLOSED </div>
			  <div class="widget-stats">
				<div class="wrapper transparent"> 
				  <span class="item-title">Total</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $closedLoan; ?>" data-animation-duration="700">0</span>
				</div>
			  </div>
			  <div class="widget-stats">
				<div class="wrapper transparent">
				  <span class="item-title">Today</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $clToday; ?>" data-animation-duration="700">0</span> 
				</div>
			  </div>
			  <div class="widget-stats ">
				<div class="wrapper transparent"> 
				  <span class="item-title">This Month</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $clMonth; ?>" data-animation-duration="700">0</span> 
			   </div>
			  </div>
			  <div class="widget-stats">
			   <div class="wrapper last">
				 <span class="item-title">This Year</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $clYear; ?>" data-animation-duration="700">0</span> 
			   </div>
			 </div>
			  <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
				<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%" ></div>
			  </div>
			 <!--<div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>-->
			</div>
		</div>	
	 </div>
	 <div class="col-md-4 col-vlg-3 col-sm-6">
		<div class="tiles purple m-b-10">
		  <div class="tiles-body">
		  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			  <div class="tiles-title text-black">LOAN ON HOLD </div>
			  <div class="widget-stats">
			   <div class="wrapper transparent"> 
				 <span class="item-title">Total</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $holdLoan; ?>" data-animation-duration="700">0</span>
			  </div>
			  </div>
			  <div class="widget-stats">
				<div class="wrapper transparent">
				  <span class="item-title">Today</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $hlToday; ?>" data-animation-duration="700">0</span> 
				</div>
			  </div>
			  <div class="widget-stats ">
				<div class="wrapper transparent"> 
				  <span class="item-title">This Month</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $hlMonth; ?>" data-animation-duration="700">0</span> 
				</div>
			  </div>
			  <div class="widget-stats">
				<div class="wrapper last">
				 <span class="item-title">This Year</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $hlYear; ?>" data-animation-duration="700">0</span> 
				</div>
			  </div>
			  <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
				<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%" ></div>
			  </div>
			 <!--<div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>-->
			</div>
		</div>	
	 </div>	
	 <div class="col-md-4 col-vlg-3 visible-xlg visible-sm col-sm-6">
		<div class="tiles red m-b-10">
		  <div class="tiles-body">
			<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			<div class="tiles-title text-black">OVERALL SALES </div>
			  <div class="widget-stats">
			   <div class="wrapper transparent"> 
				 <span class="item-title">Overall Sales</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $alToday; ?>" data-animation-duration="700">0</span>
			   </div>
			  </div>
			  <div class="widget-stats">
				<div class="wrapper transparent">
				  <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $alToday; ?>" data-animation-duration="700">0</span> 
				</div>
			  </div>
			  <div class="widget-stats ">
				<div class="wrapper last"> 
				  <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $alToday; ?>" data-animation-duration="700">0</span> 
			   </div>
			  </div>
			  <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
				<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%" ></div>
			  </div>
			 <!--<div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>-->
		  </div>			
		</div>	
	 </div>		
  </div>
  
  <!-- END DASHBOARD TILES -->	   
  <div class="col-md-12 m-b-10">
	<?php //echo $this->Element('charts/combination_chart'); ?>
  </div>
  <!--<div class="col-md-12 m-b-10">
	<div class="col-md-6 m-b-5">
	  <div id="container_pie" style="width:100%; height:400px;"></div>
	</div>
	<div class="col-md-6 m-b-5">
	  <div id="container_pie3d" style="width:100%; height:400px;"></div>
	</div>
  </div>-->
</div>
</div>

<!-- BEGIN CORE JS FRAMEWORK-->

<!--[if lt IE 9]>
<?php echo $this->Html->script('../../assets/plugins/respond'); ?>

<![endif]-->
<?php
echo $this->Html->script('admin/charts');

/*echo $this->Html->script(array('../../assets/plugins/jquery-1.8.3.min',
									 '../../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min',
									 '../../assets/plugins/boostrapv3/js/bootstrap.min',
									 '../../assets/plugins/breakpoints',
									 '../../assets/plugins/jquery-unveil/jquery.unveil.min',
									 '../../assets/plugins/jquery-block-ui/jqueryblockui',
									 '../../assets/plugins/jquery-lazyload/jquery.lazyload.min',
									 '../../assets/plugins/jquery-scrollbar/jquery.scrollbar.min'));*/
//END CORE JS FRAMEWORK

//BEGIN PAGE LEVEL JS
echo $this->Html->script(array(
							   //'../../assets/plugins/jquery-slider/jquery.sidr.min',
								//	 '../../assets/plugins/jquery-slimscroll/jquery.slimscroll.min',
									// '../../assets/plugins/pace/pace.min',
									 '../../assets/plugins/jquery-numberAnimate/jquery.animateNumbers',
									 //'../../assets/plugins/jquery-ricksaw-chart/js/raphael-min',
									 //'../../assets/plugins/jquery-ricksaw-chart/js/d3.v2',
									 //'../../assets/plugins/jquery-ricksaw-chart/js/rickshaw.min',
									 //'../../assets/plugins/jquery-sparkline/jquery-sparkline',
									 //'../../assets/plugins/skycons/skycons',
									 //'../../assets/plugins/owl-carousel/owl.carousel.min'
									 )); ?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

<?php /*echo $this->Html->script(array('../../assets/plugins/jquery-gmap/gmaps',
									 '../../assets/plugins/Mapplic/js/jquery.easing',
									 '../../assets/plugins/Mapplic/js/jquery.mousewheel',
									 '../../assets/plugins/Mapplic/js/hammer',
									 '../../assets/plugins/Mapplic/mapplic/mapplic',
									 '../../assets/plugins/jquery-flot/jquery.flot',
									 '../../assets/plugins/jquery-flot/jquery.flot.resize.min',
									 '../../assets/plugins/jquery-metrojs/MetroJs.min')); */?>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN CORE TEMPLATE JS -->

<?php echo $this->Html->script(array('../../assets/js/core',
									 //'../../assets/js/chat',
									 '../../assets/js/demo',
									 //'../../assets/js/dashboard_v2',
									 
									 )); ?>

<script type="text/javascript">
        $(document).ready(function () {
            $(".live-tile,.flip-list").liveTile();
        });
</script>

<!-- END CORE TEMPLATE JS -->