<div id="container_line_chart" style="width:100%; height:400px;"></div>
<div id="container_line_chart_timeline" style="width:100%; height:400px;"></div>
<div id="container_line_chart_time" style="width:100%; height:400px;"></div>

<script>

    $(function () {
        $('#container_line_chart').highcharts({
            title: {
                text: 'Loan Tracking System',
                x: 20 //center
            },
            subtitle: {
                text: '',
                x: 20
            },
            xAxis: {
                categories: [<?php if(!empty($arrCompletionPercent)) { foreach($arrCompletionPercent as $name=>$y) { echo "'".$name."', "; }} ?>]
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
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Loan Completed',
                data: [<?php
                    if(!empty($arrPhases)) {
                        
                        foreach($arrPhases as $name=>$y) {
                            
                            $lp = $y['LoanPhase']['loan_phase'];
                            $date = $y['LoanPhase']['created'];
                            
                            $y = date('Y', strtotime($date));
                            $m = date('m', strtotime($date));
                            $d = date('d', strtotime($date));
                            
                            if(array_key_exists($lp, $arrCompletionPercent)) {
                                
                                echo '['.$arrCompletionPercent[$lp];
                                echo '], ';
                            }
                        }
                    }
                    ?>]
            }]
        });
    });
    
    $(function () {
        $('#container_line_chart_timeline').highcharts({
            title: {
                text: 'Loan Tracking System',
                x: 20 //center
            },
            subtitle: {
                text: '',
                x: 20
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: [{
                title: {
                    text: 'Completion (%)'
                },
                min: 0
            },
            {
                title: {
                    text: 'Phases'
                },
                min: 0
            }],
            tooltip: {
                valueSuffix: '%',
                formatter: function () {
                    return Highcharts.dateFormat('%A, %b %e, %Y', new Date(this.x)) + '<br> Phase: <b>' + this.point.phase+ '</b><br>Completion: <b>' + this.point.y + '%</b>';
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Loan Completed',
                type: 'column',
                data: [<?php
                    if(!empty($arrPhases)) {
                        
                        $phases = array("A","B","C","D","E","F","G","H","I","J");
                        $i = 0;
                        foreach($arrPhases as $name=>$y) {
                            
                            $lp = $y['LoanPhase']['loan_phase'];
                            $date = $y['LoanPhase']['created'];
                            $y = date('Y', strtotime($date));
                            $m = date('m', strtotime($date));
                            $d = date('d', strtotime($date));
                            
                            if(array_key_exists($lp, $arrCompletionPercent)) {
                                
                                $cp = $arrCompletionPercent[$lp];
                                
                                echo '{';
                                echo 'x: Date.UTC('.$y.', '.$m.', '.$d.', 0, 0, 0, 0), ';
                                echo 'y: '.$cp.', ';
                                echo "phase: '".$phases[$i]."', ";
                                echo '}, ';
                            }
                            $i++;
                        }
                    }
                    ?>]
            }]
        });
    });
    
    
    $(function () {
        
        $('#container_line_chart_time').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Loan Tracking system'
            },
            subtitle: {
                text: 'RockLand'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                },
                title: {
                    text: 'Completion',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                },
                opposite: true
                
            }, { // Secondary yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Phases',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} %',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
                
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 80,
                verticalAlign: 'top',
                y: 55,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Phases',
                type: 'column',
                yAxis: 1,
                data: [<?php
                    if(!empty($arrPhases)) {
                        
                        foreach($arrPhases as $name=>$y) {
                            
                            $lp = $y['LoanPhase']['loan_phase'];
                            $date = $y['LoanPhase']['created'];
                            $y = date('Y', strtotime($date));
                            $m = date('m', strtotime($date));
                            $d = date('d', strtotime($date));
                            
                            if(array_key_exists($lp, $arrCompletionPercent)) {
                                
                                echo '[Date.UTC('.$y.', '.$m.', '.$d.', 0, 0, 0), ';
                                echo $arrCompletionPercent[$lp];                               
                                echo '], ';
                            }
                        }
                    }
                    ?>]
            }, {
                name: 'Completion',
                type: 'spline',
                data: [<?php
                    if(!empty($arrPhases)) {
                        
                        foreach($arrPhases as $name=>$y) {
                            
                            $lp = $y['LoanPhase']['loan_phase'];
                            $date = $y['LoanPhase']['created'];
                            $y = date('Y', strtotime($date));
                            $m = date('m', strtotime($date));
                            $d = date('d', strtotime($date));
                            
                            if(array_key_exists($lp, $arrCompletionPercent)) {
                                
                                echo '[Date.UTC('.$y.', '.$m.', '.$d.', 0, 0, 0), ';
                                echo $arrCompletionPercent[$lp];                               
                                echo '], ';
                            }
                        }
                    }
                    ?>],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]
        });
    });

</script>