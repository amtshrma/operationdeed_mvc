<!-- Page Content -->
<?php
    echo $this->Html->css('style_front');
    echo $this->Html->css('jquery-scrollbar/jquery.scrollbar');
?>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!--<div class="content-container">-->
        <div class="row">
            <?php echo $this->Session->flash();?>
            <div class="col-md-12">
                <div class="grid simple vertical green">
                    <div class="grid-title no-border">
                        <h4>Loan's <span class="semi-bold">Status</span></h4>
                        <div class="tools"><a href="javascript:;" class="collapse"></a></div>
                    </div>
                    <div class="grid-body no-border">
                        <div class="row-fluid">
                            <div class="scroller scrollbar-dynamic" data-height="500px">
                                <?php if($loanTracking){ ?>
                                    <div id="container_pie3d" style="width:100%; height:500px;"></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="col-md-7">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold">Notification</span></h4>
                        <div class="tools"><a href="javascript:;" class="collapse"></a></div>
                    </div>
                    <div class="grid-body no-border">
                        <div class="row-fluid">
                            <div class="scroller scrollbar-dynamic" data-height="500px">
                                <?php
                                    if(!empty($getData)) {
                                        foreach($getData as $key=>$val){ 
                                            $userDetail = $this->Common->getUserDetail($val['Notification']['sender_id']);
                                            $notification = $this->Common->getCommonNotificationDetail($val['Notification']['id']);
                                            ?>
                                            <div class="<?php echo ($key%2 == 0) ? 'alert alert-warning' : 'alert alert-info';?>">
                                                <p>
                                                    <?php
                                                        echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ';
                                                        if(isset($userDetail['User'])){
                                                            echo '<b>'.ucfirst($userDetail['User']['name']).'</b>, perform the action : ';
                                                        }
                                                        echo (isset($notification) && $notification != '') ? $notification : '';
                                                    ?>
                                                </p>
                                            </div>
                                        <?php
                                        }
                                    }else {
                                        echo 'Welcome to OTD.';
                                    }
                                    if(!empty($getData)) {
                                        echo $this->Html->link('View All',array('controller'=>'notifications','action'=>'index'),array('class'=>'pull-right'));				        }
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-5">
                <div class="grid simple horizontal red">
                    <div class="grid-title">
                        <h4><span class="semi-bold">To Do</span></h4>
                        <div class="tools"><a href="javascript:;" class="collapse"></a></div>
                    </div>
                    <div class="grid-body no-border">
                        <div class="row-fluid">
                            <div class="scroller scrollbar-dynamic" data-height="400px">
                                <?php
                                    if(!empty($allToDo)) {
                                        foreach($allToDo as $key=>$val){
											if(!empty($val['Notification']['sender_id'])){
												$userDetail = $this->Common->getUserDetail($val['Notification']['sender_id']);
												
											}
                                            ?>
                                            <div class="<?php echo ($key%2 == 0) ? 'alert alert-warning' : 'alert alert-info';?>">
                                                <p>
                                                    <?php
                                                        echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                                                        if(isset($userDetail['User'])){
                                                            echo '<b>'.ucfirst($userDetail['User']['name']).'</b>, perform the action : ';
                                                        }
                                                        echo (isset($val['Notification']['action']) && $val['Notification']['action'] != '') ? '<span class="todoClickEvent" id="'.base64_encode($val['Notification']['id']).'">'.$val['Notification']['action'].'</span>' : '';
                                                    ?>
                                                </p>
                                            </div>
                                        <?php
                                        }
                                    }else {
                                        echo 'Welcome to OTD.';
                                    }
                                  
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<?php echo $this->Html->script(array('highcharts.js','highcharts-3d.js')); ?>
<style>
	.container_pie3d, .container_pie3d .highcharts-container{
		height: 600px !important;
	}
    #loansShowModel{
        margin-top: 3% !important;
    }
    div.customClass{
        border: 1px dotted #ccc;
        padding: 10px 20px;
        border-radius: 2%;
    }
</style>
<?php if($loanTracking){ ?>
<script>
    jQuery(function () {
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
							jQuery('#loansShowModel h4.modal-title').html('Loan Listing for <span class="greenText">'+this.name+"</span>");
							jQuery('#loansShowModel .adminLoansModel').html('<p style="text-align: center; color : red;">Loading ... , Please wait.</p>');
							jQuery.ajax({
								cache: false,
								type: 'POST',
								url: BASE_URL+'commons/getloandByPhase/'+btoa(this.name),
								success: function(data) {
									jQuery('#loansShowModel .adminLoansModel').html(data);
								}
							});
                        }
                    }
				},
				  data: [
					['Phase A ( 10% Completed )', <?php echo (!empty($loanTracking['A'])) ? $loanTracking['A'] : '0';?>],
					['Phase B ( 20% Completed )', <?php echo (!empty($loanTracking['B'])) ? $loanTracking['B'] : '0';?>],
					['Phase C ( 30% Completed )', <?php echo (!empty($loanTracking['C'])) ? $loanTracking['C'] : '0';?>],
					['Phase D ( 40% Completed )', <?php echo (!empty($loanTracking['D'])) ? $loanTracking['D'] : '0';?>],
					['Phase E ( 50% Completed )', <?php echo (!empty($loanTracking['E'])) ? $loanTracking['E'] : '0';?>],
					['Phase F ( 60% Completed )', <?php echo (!empty($loanTracking['F'])) ? $loanTracking['F'] : '0';?>],
					['Phase G ( 70% Completed )', <?php echo (!empty($loanTracking['G'])) ? $loanTracking['G'] : '0';?>],
					['Phase H ( 80% Completed )', <?php echo (!empty($loanTracking['H'])) ? $loanTracking['H'] : '0';?>],
					['Phase I ( 90% Completed )', <?php echo (!empty($loanTracking['I'])) ? $loanTracking['I'] : '0';?>],
					['Phase J ( 100% Completed )', <?php echo (!empty($loanTracking['J'])) ? $loanTracking['J'] : '0';?>]
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
		  },{
                type: 'pie',
                name: 'Loans',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorWidth: 1,
                    distance: 5,
                    connectorColor: '#000000',
                    formatter: function () {
						return '<b>' + this.point.name + '</b><br /><br/>' + Math.round(this.y) + ' Loans, '+Math.round(this.percentage) + ' %' ;
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
</script>
<?php } ?>
<?php
    echo $this->Html->script(array('jquery-scrollbar/jquery.scrollbar.min.js','assets/core.js','breakpoints.js'));
?>