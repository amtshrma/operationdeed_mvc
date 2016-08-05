<?php
echo $this->Html->css('bootstrap-datepicker/datepicker');
?>
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
            <h1>Escrow Registration</h1>
            <br>
            <?php
                echo $this->Form->create('User', array('id'=>'registerForm','type' => 'file','novalidate'=>'novalidate'));
                echo $this->Form->hidden('User.user_type',array('value'=>11));
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
                    <h3>Step 1 - Basic Information</h3>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('User.first_name',array('label' => false,'div' => false, 'placeholder' => 'First Name','class' => 'form-control','maxlength' => 25, 'title' => 'First Name'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('User.last_name',array('label' => false,'div' => false, 'placeholder' => 'Last Name','class' => 'form-control','maxlength' => 25, 'title' => 'Last Name'));?>                                 
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('User.email_address',array('label' => false,'div' => false, 'placeholder' => 'Email Address','class' => 'form-control', 'title'=>'Email Address'));?>
                         <span class="help">e.g. "email@address.com"</span>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('User.password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 20,'title'=>'Password'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('User.confirm_password',array('label' => false,'div' => false, 'placeholder' => 'Confirm Password','class' => 'form-control','type' => 'password','maxlength' => 20, 'title'=>'Confirm Password'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.company_name',array('label' => false,'div' => false, 'placeholder' => 'Company Name','class' => 'form-control noValidate','type' => 'text','maxlength' => 30, 'title' => 'Company Name'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.company_position',array('label' => false,'div' => false, 'placeholder' => 'Company Position','class' => 'form-control noValidate','type' => 'text','maxlength' => 30, 'title' => 'Company Position'));?>
                    </div>
                    <div style="clear: both"></div>
                    <h4>Postal Information</h4>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.mailing_address',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address','class' => 'form-control', 'title' => 'Mailing Address'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.mailing_address2',array('label' => false,'div' => false, 'placeholder' => 'Mailing Address 2','class' => 'form-control noValidate', 'title' => 'Mailing Address 2'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.state',array('label' => false,'div' => false, 'placeholder' => 'State','class' => 'form-control','options'=>$states,'id'=>'userStates', 'title' => 'State'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.city',array('label' =>false,'div' => false, 'placeholder' => 'City','class' => 'form-control','options'=>'','id'=>'userCities', 'title' => 'City'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.zipcode',array('label' => false,'div' => false, 'placeholder' => 'Zipcode','class' => 'form-control','maxlength' => 10, 'title' => 'Zipcode'));?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('UserDetail.fax_number',array('label' => false,'div' => false, 'placeholder' => 'Fax Number','class' => 'form-control maskInput', 'title' => 'Fax Number'));?>
                    </div>
                    <div class="col-lg-4">
                    <?php echo $this->Form->input('UserDetail.mobile_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### ####','class' => 'form-control maskInput', 'title' => 'Mobile Phone'));?>
                    </div>
                    <div class="col-lg-4">
                    <?php echo $this->Form->input('UserDetail.office_phone',array('label' => false,'div' => false, 'placeholder' => '(###) ### ####','class' => 'form-control maskInput noValidate','maxlength' => 15, 'title' => 'Office Phone'));?>
                    </div>
                    <div style="clear: both"></div>
                    * Kindly fill all required fields and proceed.
                </div>
                <!-- /.panel-body -->
            </div>
            <div class="buttons">
            <table border="0" width="100%">
                <tr>
                    <td align="left">
                        <?php //echo $this->Html->link('<span class="glyphicon glyphicon-remove" style="color:#D9DEE2"></span>Cancel',array('controller'=>'homes','action'=>'shortAppStartup'),array('escape'=>false,'class'=>'btn btn-lg btn-cancel'));?>
                    <td align="right">
                        <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Register',array('class'=>'btn btn-lg btn-primary sumitButton','title'=>'step2','type'=>'submit','escape'=>false));?>
                    </td>
                </tr>
            </table>
            <br><br>
            <?php echo $this->Form->end();?>
        </center>
    </div>
</div>

<?php echo $this->Html->script('longApp/long_app.js');?>
<?php echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');?>
<script type="text/javascript">
jQuery(document).ready(function(){ 
    jQuery('#dateOfBirth').datepicker({
		format: "mm/dd/yyyy",
    });
});
</script>