<?php
$dashBoardDetail = json_decode($this->requestAction(array('controller'=>'admins','action'=>'admin_dashBoardDetail')), true);
?>
<div class="page-content">
   <div class="content sm-gutter">      
		<div class="row hidden-xlg">
			<div class="row 2col">
				<div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
					<div class="tiles blue added-margin">
						<div class="tiles-body">
							<div class="tiles-title">Total Loans</div>
							<div class="heading"><span class="animate-number" data-value="26.8" data-animation-duration="1200"><?php echo (!empty($dashBoardDetail['totalLoans'])) ? $dashBoardDetail['totalLoans'] : '0';?></span> Loans</div>
							<div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 4% higher <span class="blend">than last month</span></span></div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
					<div class="tiles green added-margin">
						<div class="tiles-body">
							<div class="tiles-title">Total Investment</div>
							<div class="heading"> $ <span class="animate-number"><?php echo (!empty($dashBoardDetail['allLoansInvestment'])) ? $dashBoardDetail['allLoansInvestment'] : '0';?></span></div>
							<div class="description">
								<i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 2% higher <span class="blend">than last month</span></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 spacing-bottom">
					<div class="tiles red added-margin">
						<div class="tiles-body">
							<div class="tiles-title">Todays Investment</div>
							<div class="heading"> $ <span class="animate-number"><?php echo (!empty($dashBoardDetail['todaysInvestment'])) ? $dashBoardDetail['todaysInvestment'] : '0';?></span> </div>
							<div class="description">
								<i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 5% higher <span class="blend">than yesterday</span></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="tiles purple added-margin">
						<div class="tiles-body">
							<div class="tiles-title">Todays Loans</div>
							<div class="row-fluid">
								<div class="heading"> <span class="animate-number"><?php echo (!empty($dashBoardDetail['todaysLoans'])) ? $dashBoardDetail['todaysLoans'] : '0';?></span> Loans </div>
							</div>
							<div class="description">
								<i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 3% higher <span class="blend">than last month</span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BEGIN DASHBOARD TILES -->
			<div class="row">
				<!-- sales graph -->
				<div class="col-md-7">
					<div class="grid simple vertical green">
						<div class="grid-title no-border">
							<h4>Loan <span class="semi-bold">Phase Graph</span></h4>
							<div class="tools"> <a href="javascript:;" class="collapse"></a></div>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="400px">
									<div class="col-md-12 m-b-10">
										<div id="container_pie3d" style="width:100%; height:400px;"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- notifications -->
				<div class="col-md-5">
					<div class="grid simple horizontal red">
						<div class="grid-title">
							<h4>Important <span class="semi-bold">Notifications</span></h4>
							<div class="tools"> <a href="javascript:;" class="collapse"></a></div>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="400px">
									<?php echo $this->Element('admin/notification'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- message -->
				<div class="col-md-5">
					<div class="grid simple horizontal red">
						<div class="grid-title">
							<h4><span class="semi-bold">Messages</span></h4>
							<div class="tools"> <a href="javascript:;" class="collapse"></a></div>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="300px">
									<?php echo $this->Element('admin/message'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- todo -->
				<div class="col-md-7">
					<div class="grid simple vertical green">
						<div class="grid-title no-border">
							<h4>To <span class="semi-bold">Do's</span></h4>
							<div class="tools"> <a href="javascript:;" class="collapse"></a></div>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="300px">
									<?php echo $this->Element('admin/todo'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--- sales graph chart -->
			<div class="row">
				<!-- message -->
				<div class="col-md-12">
					<div class="grid simple horizontal red">
						<div class="grid-title">
							<h4>Loan <span class="semi-bold">Graph Chart</span></h4>
							<div class="tools"> <a href="javascript:;" class="collapse"></a></div>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<div class="scroller scrollbar-dynamic" data-height="500px">
									<div id="container" style="width:100%; height:400px;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.container_pie3d .highcharts-container{
		height: 600px !important;
	}
	text[x = '952']{
		display: none !important;
	}
</style>
<script>
   jQuery(function () {
		jQuery(function() {
			jQuery( "#tabs" ).tabs();
		});
		var asset_allocation_pie_chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container_pie3d'
			},
			title: {
				text: 'Loan Tracking System',
				style: {
					fontSize: '17px',
					color: 'red',
					fontWeight: 'bold',
					fontFamily: 'Verdana'
				}
			},
			subtitle: {
				text: 'Operation Trust Deed',
				style: {
					fontSize: '15px',
					color: 'red',
					fontFamily: 'Verdana',
					marginBottom: '10px'
				},
				y: 40
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y} Loans</b>',
				percentageDecimals: 0
			},
		  plotOptions: {
			  pie: {
				//allowPointSelect: true,
				  size: '100%',
				  cursor: 'pointer',
				  point: {
                    events: {
                        click: function () {
							jQuery('#loansShowModel').modal({ keyboard: false });
							jQuery('#loansShowModel h4.modal-title').text('Loan Listing for '+this.name);
							jQuery('#loansShowModel .adminLoansModel').html('<p style="text-align: center; color : red;">Loading ... , Please wait.</p>');
							jQuery.ajax({
								cache: false,
								type: 'POST',
								url: BASE_URL+'admins/getloandByPhase/'+btoa(this.name),
								success: function(data) {
									jQuery('#loansShowModel .adminLoansModel').html(data);
								}
							});
                        }
                    }
				},
				  data: [
					['Phase A', <?php echo (!empty($loanTracking['A'])) ? $loanTracking['A'] : '0';?>],
					['Phase B', <?php echo (!empty($loanTracking['B'])) ? $loanTracking['B'] : '0';?>],
					['Phase C', <?php echo (!empty($loanTracking['C'])) ? $loanTracking['C'] : '0';?>],
					['Phase D', <?php echo (!empty($loanTracking['D'])) ? $loanTracking['D'] : '0';?>],
					['Phase E', <?php echo (!empty($loanTracking['E'])) ? $loanTracking['E'] : '0';?>],
					['Phase F', <?php echo (!empty($loanTracking['F'])) ? $loanTracking['F'] : '0';?>],
					['Phase G', <?php echo (!empty($loanTracking['G'])) ? $loanTracking['G'] : '0';?>],
					['Phase H', <?php echo (!empty($loanTracking['H'])) ? $loanTracking['H'] : '0';?>],
					['Phase I', <?php echo (!empty($loanTracking['I'])) ? $loanTracking['I'] : '0';?>],
					['Phase J', <?php echo (!empty($loanTracking['J'])) ? $loanTracking['J'] : '0';?>]
				  ].filter(function(data){
								return data[1] > 0;
						})
			  }
		  },
		  series: [{
			  type: 'pie',
			  name: 'Loans',
				dataLabels: {
					verticalAlign: 'top',
					enabled: true,
					color: '#000000',
					connectorWidth: 1,
					distance: -70,
					connectorColor: '#000000',
					formatter: function () {
						return Math.round(this.y)+' Loans,'+ Math.round(this.percentage)+ '%';
					}
				}
		  }, {
			  type: 'pie',
			  name: 'Loans',
			  dataLabels: {
				  enabled: true,
				  color: '#000000',
				  connectorWidth: 1,
				  distance: 5,
				  connectorColor: '#000000',
				  formatter: function () {
					return '<b>' + this.point.name + '</b><br /><br/> ' + Math.round(this.y) + ' Loans, '+Math.round(this.percentage) + ' %' ;
				  }
			  }
		  }],
		  exporting: {
			  enabled: false
		  },
		  credits: {
			  enabled: false
		  }
	  });
  
	});
	// combinational charts
	jQuery(function () {
        jQuery('#container').highcharts({
            title: {
                text: 'Sales Graph Chart',
				style: {
					fontSize: '17px',
					color: 'red',
					fontWeight: 'bold',
					fontFamily: 'Verdana',
				}
            },
            xAxis: {
                categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC']
            },
            labels: {
                items: [{
                    html: 'Total Loan',
                    style: {
                        left: '50px',
                        top: '18px',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                    }
                }]
            },
            series: [{
                type: 'column',
                name: 'Rockland Commercial',
                data: [
						<?php echo (!empty($totalLoansPerMonth['01'])) ? $totalLoansPerMonth['01'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['02'])) ? $totalLoansPerMonth['02'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['03'])) ? $totalLoansPerMonth['03'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['04'])) ? $totalLoansPerMonth['04'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['05'])) ? $totalLoansPerMonth['05'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['06'])) ? $totalLoansPerMonth['06'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['07'])) ? $totalLoansPerMonth['07'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['08'])) ? $totalLoansPerMonth['08'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['09'])) ? $totalLoansPerMonth['09'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['10'])) ? $totalLoansPerMonth['10'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['11'])) ? $totalLoansPerMonth['11'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['12'])) ? $totalLoansPerMonth['12'] : '0';?>,
					]
            },{
                type: 'spline',
                name: 'Average',
                data: [
						<?php echo (!empty($totalLoansPerMonth['01'])) ? $totalLoansPerMonth['01'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['02'])) ? $totalLoansPerMonth['02'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['03'])) ? $totalLoansPerMonth['03'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['04'])) ? $totalLoansPerMonth['04'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['05'])) ? $totalLoansPerMonth['05'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['06'])) ? $totalLoansPerMonth['06'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['07'])) ? $totalLoansPerMonth['07'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['08'])) ? $totalLoansPerMonth['08'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['09'])) ? $totalLoansPerMonth['09'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['10'])) ? $totalLoansPerMonth['10'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['11'])) ? $totalLoansPerMonth['11'] : '0';?>,
						<?php echo (!empty($totalLoansPerMonth['12'])) ? $totalLoansPerMonth['12'] : '0';?>,
					],
                marker: {
                    lineWidth: 1,
                    lineColor: Highcharts.getOptions().colors[4],
                    fillColor: 'white'
                }
            }, {
                type: 'pie',
                name: 'Total Loans',
                data: [{
                    name: 'Rockland Commercial',
                    y : <?php echo array_sum($totalLoansPerMonth);?>,
                    color: Highcharts.getOptions().colors[0] // Jane's color
                }],
                center: [100, 80],
                size: 100,
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }]
        });
    });
</script>