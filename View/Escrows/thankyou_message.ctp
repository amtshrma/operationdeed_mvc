<!-- Page Content -->
<style>
    div.sidebar{
        display: none;
    }
    div#page-wrapper{
        margin: auto;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <center>
            <h1>ThankYou</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <center>
                        <br />
                        <br />
                        Thank you for joining us. Email is sent to your email address. Click link to activate your account.
                        <br />
                        <br />
                        <?php
                            echo $this->html->link('Login Now',array('controller'=>'escrows','action'=>'index'),array('class'=>'btn btn-lg2 btn-primary btn-block-normal','escape'=>false));
                        ?>
                    </center>
                </div>
                <!-- /.panel-body -->
            </div>
        </center>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->