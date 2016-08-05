<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <center><h1>Ready to register</h1></center>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <center>
                    <h3>Chose your option As Manager</h3>
                    <br />
                    <div class="form-group col-lg-6">
                        <?php echo $this->Html->link('Marketing <br />Manager',array('controller'=>'homes','action'=>'register/'.base64_encode('9')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'If you are a Marketing manager register to see email Marketing  opportunities'));?>
                    </div>
                    <div class="form-group col-lg-6">
                        <?php echo $this->Html->link('Accounting <br />Manager',array('controller'=>'homes','action'=>'register/'.base64_encode('12')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'Accounting Managers will register will be able to track Commission.'));?>
                    </div>
                    <br />
                    <h3> Or </h3>
                    <br />
                    <div class="col-lg-12">
                        <?php echo $this->Html->link('Login',array('controller'=>'homes','action'=>'investor_login'),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title' => 'Investor Login'));?>
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
