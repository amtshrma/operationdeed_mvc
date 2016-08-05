<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse ">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="header-seperation">
            <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
                    <div class="iconset top-menu-toggle-white"></div>
                    </a>
                </li>
            </ul>
            <!-- BEGIN LOGO -->
            <div class="logo" style="text-align: center;font-size: 40px;">
                <?php echo $this->Html->link('Rockland',array("controller"=>"admins","action"=>"dashboard"),array("escape"=>false)); ?>
            </div>
            <!-- END LOGO -->
            <ul class="nav notifcation-center">
                <li class="dropdown" id="portrait-chat-toggler" style="display:none">
                    <a href="#sidr" class="chat-menu-toggle"><div class="iconset top-chat-white "></div></a>
                </li>
            </ul>
        </div>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="header-quick-nav" >
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="pull-left">
                <ul class="nav quick-section">
                    <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
                      <div class="iconset top-menu-toggle-dark"></div>
                      </a>
                    </li>
                </ul>
            </div>      
            <!-- BEGIN CHAT TOGGLER -->
            <div class="pull-right">
                <div class="chat-toggler">
                    <a href="javascript:void(0)">
                        <div class="user-details">
                            <div class="username"> <b>Welcome </b> <?php echo $loggedUserInfo['first_name'].' '.$loggedUserInfo['last_name']; ?></div>
                        </div>
                    </a>
                </div>
                <ul class="nav quick-section ">
                    <li class="quicklinks">
                        <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
                            <div class="iconset top-settings-dark "></div>
                        </a>
                        <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;Admin Settings',array('controller'=>'admins','action'=>'settings','admin' => true),array('escape' =>false,'title' => 'Logout')); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;Loan Reasons',array('controller'=>'admins','action'=>'loan_reasons','admin' => true),array('escape' =>false,'title' => 'Logout')); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;Loan Phases',array('controller'=>'admins','action'=>'loanPhases','admin' => true),array('escape' =>false,'title' => 'Logout')); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;Video Tutorials',array('controller'=>'admins','action'=>'manageVideo','admin' => true),array('escape' =>false,'title' => 'Logout')); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out',array('controller'=>'admins','action'=>'logout','admin' => true),array('escape' =>false,'title' => 'Logout')); ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END CHAT TOGGLER -->
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<style>
    .header .chat-toggler{
        min-width: 100px;
    }
    .iconset.top-settings-dark{
        background-position: -237px -6px;
    }
</style>