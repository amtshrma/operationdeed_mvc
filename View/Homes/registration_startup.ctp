<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1>Welcome, Ready to get started !</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <center>
                    <h3>Start With OTD As!</h3>
                    <br />
                    <div class="col-lg-6">
                        <?php echo $this->Html->link('Borrower',array('controller'=>'homes','action'=>'shortAppStartup/'),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title' => 'Click to apply Short Application Or Register'));?>
                        <p class="customPStyle">Select if you are a Borrower looking for loan</p>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $this->Html->link('Broker',array('controller'=>'homes','action'=>'brokerStartup/'.base64_encode('broker')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title' => 'Click to register as Broker / Sales Manager / Sales Director'));?>
                        <p class="customPStyle">Select if you are a Broker looking to place private money loans</p>
                    </div>
                    <div style="clear: both;">&nbsp;</div>
                    <div class="col-lg-12">
                        <?php echo $this->Html->link('Investor',array('controller'=>'homes','action'=>'investorStartup/'.base64_encode('investor')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title' => 'Click to register as Investor / Investment Manager'));?>
                        <p class="customPStyle">Select if you are an Investor looking to invest in private money trustdeeds</p>
                    </div>
                    </center>
                </div>
                <!-- /.panel-body -->
            </div>
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<style>
    p.customPStyle{
        font-size: 10px;
        color: grey;
        font-style : italic;
    }
</style>