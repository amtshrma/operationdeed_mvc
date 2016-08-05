<div class="container"> 
    <div class="compressed">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo $this->html->link($this->html->image('logo.png',array('data-src' => Configure::read('BASE_URL').'img/logo.png','data-src-retina' => Configure::read('BASE_URL').'img/logo.png','width' => '119','height' => '80')),'/',array('escape'=>false,'class'=>'navbar-brand'));?>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right" >
                <li><?php echo $this->Html->link('Home',array('controller'=>'homes','action'=>'index')); ?></li>
                <li><?php echo $this->Html->link('Investors',array('controller'=>'investors','action'=>'index')); ?></li>
               <li><?php echo $this->Html->link('SignUp',array('controller'=>'homes','action'=>'register')); ?></li>
               <li><?php echo $this->Html->link('Borrower SignIn',array('controller'=>'homes','action'=>'borrower')); ?></li>
                <li><?php echo $this->Html->link('Investor SignUp','/investor'); ?></li>
                <li><?php echo $this->Html->link('Escrow SignUp','/escrows'); ?></li>
                <li><?php echo $this->Html->link('Apply Online',array('controller'=>'homes','action'=>'shortApp')); ?></li>
                <li><?php echo $this->Html->link('Contact',array('controller'=>'homes','action'=>'index')); ?></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

