<div id="container" style="width:100%; height:400px;"></div>
<div id="container_line_chart" style="width:100%; height:400px;"></div>
<?php
$xAxis = $yAxis = '[';
if(!empty($arrCompletionPercent)) {
    foreach($arrCompletionPercent as $key=>$val){
        $xAxis .= "'".$key.' ('.$val."%)'";
        if($key != 'J'){
            $xAxis .= ',';
        }       
    }
}
$xAxis .= ']';
if(!empty($arrPhases)) {
    foreach($arrPhases as $name=>$y) {
        $lp = $y['LoanPhase']['loan_phase'];
        if(array_key_exists($lp, $arrCompletionPercent)) {
            $yAxis .= $arrCompletionPercent[$lp];
            if($lp != 'J'){
                $yAxis .= ',';
            }
        }
    }
    $yAxis .= ']';
}
?>
<script>
jQuery(function () {
    jQuery('#container_line_chart').highcharts({
        title: {
            text: 'Loan Tracking System',
            x: 20 //center
        },
        subtitle: {
            text: '',
            x: 20
        },
        xAxis: {
            categories: <?php echo $xAxis;?>,
        },
        yAxis: {
            title: {
                text: 'Completion (%)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '%',
            pointFormat: '<span>{series.name}</span>: <b>{point.y}</b> <br/><span>{series.created}</span>',
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            borderWidth: 0
        },
        series: [{
            name: 'Loan Completed',
            data: <?php echo $yAxis;?>
        }]
    });
});

jQuery(function () {
    jQuery('#container').highcharts({
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'Loan Tracking System',
        },
        subtitle: {
            text: 'Loan Life Cycle'
        },
        xAxis: [{
            categories: <?php echo $xAxis;?>
        }],
        yAxis: [{ 
            labels: {
                format: '{value} %',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Loan Completed Percentage',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: 'Loan Completed',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} %',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
            name: 'Loan Completed Percentage',
            type: 'column',
            yAxis: 1,
            data: <?php echo $yAxis;?>,
            tooltip: {
                valueSuffix: ' %'
            }

        }, {
            name: 'Loan Completed',
            type: 'spline',
            data: <?php echo $yAxis;?>,
            tooltip: {
                valueSuffix: '%'
            }
        }]
    });
});
</script>
<style>
    text[x = "962"]{
        display: none !important;
    }
</style>