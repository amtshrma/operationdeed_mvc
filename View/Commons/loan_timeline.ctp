<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
       
        <div class="page-title"> <i class="icon-custom-left"></i>
            <h3><span class="semi-bold">Loan TimeLine</span></h3>
        </div>
        <div class="row">
            <div class="col-md-12 m-b-10">
                <?php //echo $this->Element('charts/bar_chart'); ?>
            </div>
            <div class="col-md-12 m-b-10">
                <?php echo $this->Element('charts/line_chart'); ?>
            </div>
            <div class="col-md-12 m-b-10">
                <?php //echo $this->Element('charts/combination_chart'); ?>
            </div>
            <div class="col-md-12 m-b-10">
                <?php //echo $this->Element('charts/pie_chart'); ?>
            </div>
            <div class="col-md-12 m-b-10">
                <?php //echo $this->Element('charts/donut_chart3d'); ?>
            </div>
        </div>
    </div>
</div>

<?php 
echo $this->Html->script(array('highcharts','highcharts-3d'));
?>