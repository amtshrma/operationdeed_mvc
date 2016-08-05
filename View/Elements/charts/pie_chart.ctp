<div id="container_pie" style="width:100%; height:400px;"></div><script>

    $(function () {
        $('#container_pie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Pie Chart - Loan Tracking System'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: "Brands",
                colorByPoint: true,
                data: [
                <?php
                if(!empty($arrPhases)) {
                    $cnt = count($arrPhases)-1;
                    $i = 0;
                    foreach($arrPhases as $name=>$y) {
                        
                        $lp = $y['LoanPhase']['loan_phase'];
                        $date = $y['LoanPhase']['created'];
                        $y = date('Y', strtotime($date));
                        $m = date('m', strtotime($date));
                        $d = date('d', strtotime($date));
                        
                        if(array_key_exists($lp, $arrCompletionPercent)) {
                            
                            //echo '['.$arrCompletionPercent[$lp];
                            //echo ', Date.UTC('.$y.', '.$m.', '.$d.', 0, 0, 0)';                            
                            //echo '], ';                            
                            ?>
                            {
                                name: "<?php echo $lp; ?>",
                                y: <?php echo $arrCompletionPercent[$lp]; ?>,
                                <?php if($i==$cnt) { ?>
                                sliced: true,
                                selected: true
                                <?php } ?>
                            },
                            <?php
                        }
                        $i++;
                    }
                }
                ?>]
            }]
        });
    });
</script>