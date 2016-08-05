<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <center><h1>Ready to register</h1></center>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <center>
                    <h3>Chose your option As Investor</h3>
                    <br />
                    <div class="form-group col-lg-6">
                        <?php echo $this->Html->link('Trust Deed <br />Investor',array('controller'=>'homes','action'=>'register/'.base64_encode('7')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'If you are a Trust Deed Investor register to see trust deed investment opportunities'));?>
                        <p class="customPStyle">Select if you are a trustdeed investor looking to register to view the available investments</p>
                    </div>
                    <div class="form-group col-lg-6">
                        <?php echo $this->Html->link('Investment <br />Manager',array('controller'=>'homes','action'=>'register/'.base64_encode('8')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'Investment Managers will register Investors and will be able to track team activity and commissions from their user Dashboard.'));?>
                        <p class="customPStyle">Select if you are an investment manager / client who are trustdeed investors you would like to register</p>
                    </div>
                    <br />
                    <h3> Or </h3>
                    <br />
                    <div class="col-lg-12">
                        <?php echo $this->Html->link('Investor Login',array('controller'=>'homes','action'=>'investor_login'),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title' => 'Investor Login'));?>
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