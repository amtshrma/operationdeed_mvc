<?php echo $this->Html->script('admin/admin_login'); ?>
<div class="row login-container column-seperation">  
    <div class="col-md-4 col-md-offset-4">
        <center>
            <h2>Login in to Rockland</h2>
        </center>
        <br>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <?php echo $this->Session->flash();?>   
        <?php echo $this->Form->create('Admin', array('url' => array('controller' => 'admins', 'action' => 'login'),'id'=>'loginId'));?>
            <div class="form-group">
               <label class="form-label">Email</label>
                <div class="controls">
                    <div class="input-with-icon  right">                                       
                        <i class=""></i>
                        <?php echo $this->Form->input('email',array('label' => false,'div' => false, 'placeholder' => 'E-mail','class' => 'form-control user-name','maxlength' => 55));?>                                 
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <span class="help"></span>
                <div class="controls">
                    <div class="input-with-icon  right">                                       
                        <i class=""></i>
                          <?php echo $this->Form->input('password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control user-password','maxlength' => 30,'type '=> 'password'));?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="checkbox checkbox check-success">
                    <?php echo $this->Form->input('remember_me',array('label' => 'Keep me reminded','div' => false,'type '=> 'checkbox','checked' => $remember_me,'hiddenField'=>false));?> 
                </div>
            </div>
            <div class="col-md-3 col-md-offset-9">
                <?php echo $this->Form->submit('Login',array('class' => 'btn btn-primary btn-cons pull-right'));?>
            </div>
            <?php echo $this->Form->end(); ?>
    </div>
    </div>
</div>
<!-- END CONTAINER -->