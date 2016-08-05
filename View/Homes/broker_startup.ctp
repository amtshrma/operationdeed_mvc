<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <center><h1>Ready to register</h1></center>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <center>
                    <h3>Chose your option As OTD Staff</h3>
                    <br />
                    <div class="form-group col-lg-4">
                        <?php echo $this->Html->link('Sales Manager',array('controller'=>'homes','action'=>'register/'.base64_encode('3')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'Sales Managers will register their Loan Officers and Administrate their Team from their Admin/Dashboard'));?>
                    </div>
                    <div class="form-group col-lg-4">
                        <?php echo $this->Html->link('Broker/Loan <br />Officer',array('controller'=>'homes','action'=>'register/'.base64_encode('2')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'You must be employed under a Broker or CFL and provide your active license and your Broker or CFL active license'));?>
                    </div>
                    <div class="form-group col-lg-4">
                        <?php echo $this->Html->link('Sales Director',array('controller'=>'homes','action'=>'register/'.base64_encode('4')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'Sales Director will register Sales Managers and Broker/Loan Officers, and will be able to track team activity and commission from their user Dashboard'));?>
                    </div>
                    <div style="clear: both;"></div>
                    <h3> Or </h3>
                    <div class="col-lg-12">
                        <?php echo $this->Html->link('Staff Login',array('controller'=>'homes','action'=>'login'),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title' => 'Staff Login'));?>
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
