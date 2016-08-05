<div class="page-content">
<div class="content sm-gutter">      
<div class="row hidden-xlg">
	   <!-- BEGIN DASHBOARD TILES -->
	  <div class="row">	 
		<div class="col-md-4 col-vlg-3 col-sm-6">
			<div class="tiles green m-b-10">
              <div class="tiles-body">
			  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title text-black">OVERALL SALES </div>
			         <div class="widget-stats">
                      <div class="wrapper transparent"> 
						<span class="item-title">Overall Visits</span> <span class="item-count animate-number semi-bold" data-value="2415" data-animation-duration="700">0</span>
					  </div>
                    </div>
                    <div class="widget-stats">
                      <div class="wrapper transparent">
						<span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="751" data-animation-duration="700">0</span> 
					  </div>
                    </div>
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
						<span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="1547" data-animation-duration="700">0</span> 
					 </div>
                    </div>
                    <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
                      <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%" ></div>
                    </div>
                    <div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>
			  </div>			
			</div>
		</div>
		<div class="col-md-4 col-vlg-3 col-sm-6">
			<div class="tiles blue m-b-10">
              <div class="tiles-body">
			  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title text-black">OVERALL VISITS </div>
			         <div class="widget-stats">
                      <div class="wrapper transparent"> 
						<span class="item-title">Overall Visits</span> <span class="item-count animate-number semi-bold" data-value="15489" data-     animation-duration="700">0</span>
					  </div>
                    </div>
                    <div class="widget-stats">
                      <div class="wrapper transparent">
						<span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="551" data-animation-duration="700">0</span> 
					  </div>
                    </div>
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
						<span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="1450" data-animation-duration="700">0</span> 
					 </div>
                    </div>
                    <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
                      <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="54%" ></div>
                    </div>
                    <div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>
			  </div>			
			</div>	
		</div>
		<div class="col-md-4 col-vlg-3 col-sm-6">
			<div class="tiles purple m-b-10">
              <div class="tiles-body">
			  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title text-black">SERVER LOAD </div>
			         <div class="widget-stats">
                      <div class="wrapper transparent"> 
						<span class="item-title">Overall Load</span> <span class="item-count animate-number semi-bold" data-value="5695" data-animation-duration="700">0</span>
					  </div>
                    </div>
                    <div class="widget-stats">
                      <div class="wrapper transparent">
						<span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="568" data-animation-duration="700">0</span> 
					  </div>
                    </div>
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
						<span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="12459" data-animation-duration="700">0</span> 
					 </div>
                    </div>
                    <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
                      <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="90%" ></div>
                    </div>
                    <div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>
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
						<span class="item-title">Overall Sales</span> <span class="item-count animate-number semi-bold" data-value="5669" data-animation-duration="700">0</span>
					  </div>
                    </div>
                    <div class="widget-stats">
                      <div class="wrapper transparent">
						<span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="751" data-animation-duration="700">0</span> 
					  </div>
                    </div>
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
						<span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="1547" data-animation-duration="700">0</span> 
					 </div>
                    </div>
                    <div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
                      <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="64.8%" ></div>
                    </div>
                    <div class="description"> <span class="text-white mini-description ">4% higher <span class="blend">than last month</span></span></div>
			  </div>			
			</div>	
		</div>		
	 </div>
	 
	  <!-- END DASHBOARD TILES -->
	   
	   <div class="col-md-12 m-b-10">
			  <?php echo $this->Element('charts/combination_chart'); ?>
	   </div>
	   <div class="col-md-12 m-b-10">
			  <div class="col-md-6 m-b-5">
				 <div id="container_pie" style="width:100%; height:400px;"></div>
			  </div>
			  <div class="col-md-6 m-b-5">
				 <div id="container_pie3d" style="width:100%; height:400px;"></div>
			  </div>
	   </div>
</div>
</div>

<!-- BEGIN CORE JS FRAMEWORK-->

<!--[if lt IE 9]>
<?php echo $this->Html->script('assets/plugins/respond'); ?>

<![endif]-->
<?php
echo $this->Html->script('admin/charts');
echo $this->Html->script(array('jquery-numberAnimate/jquery.animateNumbers')); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<?php echo $this->Html->script(array('assets/core','assets/demo')); ?>