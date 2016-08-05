<div class="container">
    <div class="row">
     <?php echo $this->Session->flash();?>   
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul id="nav">
             <li><?php echo $this->Html->link('Logout', array('controller'=>'homes','action'=>'logout'),array('escape' =>false,'title' => 'Logout'));?></li>   
          </ul>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                         <?php echo $this->Session->flash();?> 
                            <div class="text-center"><h2><b>Borrowers Dashboard</b></h2></div>
                        </div>                        
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
