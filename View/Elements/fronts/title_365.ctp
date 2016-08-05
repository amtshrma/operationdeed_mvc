<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color:#D6DCE2;max-height:50px">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html"></a>
    </div>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu" style="color:#FFF">
                <center>
                <br><br><br>
                <?php echo $this->html->link($this->Html->image('front/lock.png',array('class'=>'img-circle','width' => '75px','style' => 'border:3px solid #fff')),array('controller'=>'homes','action'=>'registrationStartup'),array('escape'=>false));?>
                <br><br>
                </center>
                <br><br><br>
                <li>
                    <?php echo $this->Html->link('<i class="fa fa-home fa-fw" style="font-size:20pt"></i>&nbsp; OrderService',array('controller'=>'homes','action'=>'title365API'),array('escape'=>false));?>
                </li>
            </ul>
            <center>
                <?php echo $this->Html->image('front/PMP-Logo.png',array('width' => '200px','style' => 'margin-top:150px;margin-bottom:20px;'));?>            </center>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>