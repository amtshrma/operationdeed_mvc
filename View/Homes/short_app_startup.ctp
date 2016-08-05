<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <center><h1>Ready to register</h1></center>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <center>
                    <h3>Chose your option As Borrower</h3>
                    <br />
                    <div class="form-group col-lg-6">
                        <?php echo $this->Html->link('Short <br />Application',array('controller'=>'homes','action'=>'shortApp/'),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'We pull an Automated Valuation and a property profile on your property.   This allows us to more accurately provide you a Soft Quote for your loan request'));?>
                    </div>
                    <div class="form-group col-lg-6">
                        <?php echo $this->Html->link('Register and Get <br /> Approved',array('controller'=>'homes','action'=>'register/'.base64_encode('1')),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title'=>'Once user account is activated borrowers will be able to fill out a Long App Application'));?>
                    </div>
                    <br />
                    <h3> Or </h3>
                    <br />
                    <div class="col-lg-12">
                        <?php echo $this->Html->link('Borrower Login',array('controller'=>'homes','action'=>'borrowerLogin'),array('class'=>'btn btn-lg2 btn-primary btn-block-normal toolTip','escape'=>false,'title' => 'Borrower Login'));?>
                    </div>
                    </div>
                    <br />
                    </center>
                </div>
                <!-- /.panel-body -->
            </div>
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
