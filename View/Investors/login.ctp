<h1 style="text-align: center;">Welcome to Rockland </h1>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                         <?php echo $this->Session->flash();?> 
                            <div class="text-center"><h2><b>Login</b></h2></div>
                        </div>
                        
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'),'id'=>'loginForm','type' => 'file','style'=>'display:block;')); ?>
                                <div class="form-group">
                                     <?php echo $this->Form->input('email_address',array('label' => false,'div' => false, 'placeholder' => 'Email','class' => 'form-control','type' => 'text','maxlength' => 100,'tabindex'=>'1'));?>
                                </div>
                                <div class="form-group">
                                    <?php echo $this->Form->input('password',array('label' => false,'div' => false, 'placeholder' => 'Password','class' => 'form-control','type' => 'password','maxlength' => 100,'tabindex'=>'2'));?>
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $this->Form->end();
                          ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>