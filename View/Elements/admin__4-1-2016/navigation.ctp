<?php
// Active Link as per page click
  if($this->Session->read('loggedUserInfo.id')) {
    
    $dashboard = '';
    
    $docs = '';
    $checklistsDocs  = '';
    $loanDocs = '';
    $manageDocs = '';
    $companyTemp = '';
    
    $teamass = '';
    $users = '';
    $investors = '';
    $loans = '';
    
    $switchcase = strtolower($this->params["controller"]).'-'.strtolower($this->params["action"]);
   
    switch($switchcase) {
    
    case "checklists-admin_index":
    case "checklists-admin_loan_document":
    case "documents-admin_index":
    case "admins-admin_template":
          $docs = "active";
          break;
    case "checklists-admin_index":
          $checklistsDocs = "active";
          break;
    case "checklists-admin_loan_document":
          $loanDocs = "active";
          break;
    case "documents-admin_index":
          $manageDocs = "active";
          break;
    case "admins-admin_template":
          $companyTemp = "active";
          break;
    case "admins-admin_team_assignment":
          $teamass = "active";
          break;
    case "users-admin_index":
          $users = "active";
          break;
    case "investors-admin_index":
          $investors = "active";
          break;
    case "admins-admin_loans":
          $loans = "active";
          break;    
    default:
          $dashboard = "active";
          break;
    }
  }
?>

<div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
      <div class="user-info-wrapper">
        <div class="profile-wrapper"><?php echo $this->Html->image('d.jpg', array("width"=>"69","height"=>"69"));?> </div>
        <div class="user-info">
          <div class="greeting">Welcome</div>
          <div class="username"><?php echo $loggedUserInfo['first_name']; ?> <span class="semi-bold"><?php echo $loggedUserInfo['last_name']; ?></span></div>
          <div class="status">Status<a href="#">
            <div class="status-icon green"></div>
            Online</a></div>
        </div>
      </div>
      <!-- END MINI-PROFILE -->
      <!-- BEGIN SIDEBAR MENU -->
      <p class="menu-title">BROWSE <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
      <ul>
        <li class="start <?php echo $dashboard; ?>">
          <?php echo $this->Html->link('<i class="icon-custom-home"></i> <span class="title">Dashboard</span>',array('controller'=> 'admins','action'=>'dashboard'),array('escape' =>false,'Dashboard')); ?> 
	    </li>
        <li class=""> <a href="email.html"> <i class="fa fa-envelope"></i> <span class="title">Email</span> <span class=" badge badge-disable pull-right ">203</span></a> </li>
        <li class=""> <a href="javascript:;"> <i class="fa fa fa-copy"></i> <span class="title">Templates</span> <span class="arrow "></span> </a>
            <ul class="sub-menu">
              <li > <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
            <span class="title">Email Templates</span>','/admin/email_templates/',array('escape' =>false,'Email Templates')); ?> </li>
              <li > <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
            <span class="title">Pdf Templates</span>','/admin/pdf_templates',array('escape' =>false,'Pdf Templates')); ?>  </li>
            </ul>
        </li> 
        <li class="<?php echo $docs;?>">
         <a href="javascript:;"> <i class="fa fa-file-text"></i> <span class="title">Documents</span>
         <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li class="<?php echo $checklistsDocs;?>">
               <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
               <span class="title">Property Documents</span>','/admin/checklists/',array('escape' =>false,'Manage Property Documents'));?>
            </li>
            <li class="<?php echo $loanDocs;?>">
               <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
               <span class="title">Loan Documents</span>','/admin/checklists/loan_document',array('escape' =>false,'Loan Documents'));?>        
            </li>
            <li class="<?php echo $manageDocs;?>">
               <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
               <span class="title">Manage Documents</span>','/admin/documents',array('escape' =>false,'Manage Document'));?>        
            </li>
            <li class="<?php echo $companyTemp;?>">
               <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
               <span class="title">Company Templates</span>','/admin/admins/template',array('escape' =>false,'Manage Templates'));?>        
            </li>
          </ul>
        </li>
        <li class="<?php echo $teamass; ?>">
          <?php echo $this->Html->link('<i class="fa fa-group"></i>
          <span class="title">Team Assignment</span>','/admin/admins/team_assignment',array('escape' =>false,'Funders Team')); ?>        
        </li>
        <li class="<?php echo $users; ?>"> <?php echo $this->Html->link('<i class="fa fa-user"></i>
          <span class="title">User Listing</span>','/admin/users/',array('escape' =>false,'User')); ?> </li>
        <li class="<?php echo $investors; ?>"> <?php echo $this->Html->link('<i class="fa fa-user-md"></i>
          <span class="title">Investor Listing</span>','/admin/investors/',array('escape' =>false,'Email Template')); ?> </li>        
        <li class="<?php echo $loans; ?>">
          <?php echo $this->Html->link('<i class="fa fa-dollar"></i>
          <span class="title">Loan Listing</span>','/admin/admins/loans',array('escape' =>false,'Loans')); ?>
        </li>
        
        <!--<li class=""> <a href="email.html"> <i class="fa fa-envelope"></i> <span class="title">Email</span> <span class=" badge badge-disable pull-right ">203</span></a> </li>
        <li class=""> <a href="../../frontend/index.html"> <i class="fa fa-flag"></i>  <span class="title">Frontend</span></a></li>
        <li class=""> <a href="javascript:;"> <i class="fa fa fa-adjust"></i> <span class="title">Themes</span> <span class="arrow "></span> </a>
            <ul class="sub-menu">
              <li > <a href="theme_coporate.html">Coporate </a> </li>
              <li > <a href="theme_simple.html">Simple</a> </li>
              <li > <a href="theme_elegant.html">Elegant</a> </li>
            </ul>
        </li>    
        <li class=""> <a href="javascript:;"> <i class="fa fa-file-text"></i> <span class="title">Layouts</span> <span class="arrow "></span> </a>
            <ul class="sub-menu">
              <li > <a href="layout_options.html"> Layout Options </a> </li>
              <li > <a href="boxed_layout.html">Boxed Layout </a> </li>
              <li > <a href="boxed_layout_v2.html">Inner Boxed Layout </a> </li>
              <li > <a href="extended_layout.html">Extended Layout</a> </li>
              <li > <a href="RTL.html">RTL Layout</a> </li>
              <li > <a href="horizontal_menu.html">Horizontal Menu</a> </li>
              <li > <a href="horizontal_menu_boxed.html">Horizontal Menu & Boxed</a> </li>               
            </ul>
        </li>         
        <li class=""> <a href="javascript:;"> <i class="icon-custom-ui"></i> <span class="title">UI Elements</span> <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li > <a href="typography.html"> Typography </a> </li>
            <li > <a href="messages_notifications.html"> Messages & Notifications </a> </li>
            <li > <a href="notifications.html"> Notifications </a> </li>
            <li > <a href="icons.html">Icons</a> </li>
            <li > <a href="buttons.html">Buttons</a> </li>
            <li > <a href="tabs_accordian.html"> Tabs & Accordions </a> </li>
            <li > <a href="sliders.html">Sliders</a> </li>
            <li > <a href="group_list.html">Group list </a> </li>
          </ul>
        </li>
        <li class=""> <a href="javascript:;"> <i class="icon-custom-form"></i> <span class="title">Forms</span> <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li > <a href="form_elements.html">Form Elements </a> </li>
            <li > <a href="form_validations.html">Form Validations</a> </li>
          </ul>
        </li>
        <li class=""> <a href="javascript:;"> <i class="icon-custom-portlets"></i> <span class="title">Grids</span> <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li > <a href="grids_simple.html">Simple Grids</a> </li>
            <li > <a href="grids_draggable.html">Draggable Grids </a> </li>
          </ul>
        </li>
        <li class=""> <a href="javascript:;"> <i class="icon-custom-thumb"></i> <span class="title">Tables</span> <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li > <a href="tables.html"> Basic Tables </a> </li>
            <li > <a href="datatables.html"> Data Tables </a> </li>
          </ul>
        </li>
        <li class=""> <a href="javascript:;"> <i class="icon-custom-map"></i> <span class="title">Maps</span> <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li > <a href="google_map.html"> Google Maps </a> </li>
            <li > <a href="vector_map.html"> Vector Maps </a> </li>
          </ul>
        </li>
        <li class=""> <a href="charts.html"> <i class="icon-custom-chart"></i> <span class="title">Charts</span> </a> </li>
        <li class=""> <a href="javascript:;"> <i class="icon-custom-extra"></i> <span class="title">Extra</span> <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li > <a href="user-profile.html"> User Profile </a> </li>
            <li > <a href="time_line.html"> Time line </a> </li>
            <li > <a href="support_ticket.html"> Support Ticket </a> </li>
            <li > <a href="gallery.html"> Gallery</a> </li>
            <li class=""><a href="calender.html"> Calendar</a> </li>
            <li > <a href="search_results.html"> Search Results </a> </li>
            <li > <a href="invoice.html"> Invoice </a> </li>
            <li > <a href="404.html"> 404 Page </a> </li>
            <li > <a href="500.html"> 500 Page </a> </li>
            <li > <a href="blank_template.html"> Blank Page </a> </li>
            <li > <a href="login.html"> Login </a> </li>
            <li > <a href="login_v2.html">Login v2</a> </li>
            <li > <a href="lockscreen.html"> Lockscreen </a> </li>
          </ul>
        </li>
        <li class=""> <a href="javascript:;"> <i class="fa fa-folder-open"></i> <span class="title">Menu Levels</span> <span class="arrow "></span> </a>
          <ul class="sub-menu">
            <li > <a href="javascript:;"> Level 1 </a> </li>
            <li > <a href="javascript:;"> <span class="title">Level 2</span> <span class="arrow "></span> </a>
              <ul class="sub-menu">
                <li > <a href="javascript:;"> Sub Menu </a> </li>
                <li > <a href="ujavascript:;"> Sub Menu </a> </li>
              </ul>
            </li>
          </ul>
        </li>-->
        <li class="hidden-lg hidden-md hidden-xs" id="more-widgets" > <a href="javascript:;"> <i class="fa fa-plus"></i></a>
          <ul class="sub-menu">
            <li class="side-bar-widgets">
              <!--<p class="menu-title">FOLDER <span class="pull-right"><a href="#" class="create-folder"><i class="icon-plus"></i></a></span></p>
              <ul class="folders" >
                <li><a href="#">
                  <div class="status-icon green"></div>
                  My quick tasks </a> </li>
                <li><a href="#">
                  <div class="status-icon red"></div>
                  To do list </a> </li>
                <li><a href="#">
                  <div class="status-icon blue"></div>
                  Projects </a> </li>
                <li class="folder-input" style="display:none">
                  <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" id="folder-name">
                </li>
              </ul>-->
              <p class="menu-title">PROJECTS </p>
              <div class="status-widget">
                <div class="status-widget-wrapper">
                  <div class="title">Freelancer<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>
                  <p>Redesign home page</p>
                </div>
              </div>
              <div class="status-widget">
                <div class="status-widget-wrapper">
                  <div class="title">envato<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>
                  <p>Statistical report</p>
                </div>
              </div>
            </li>
          </ul>
        </li>
      </ul>
      <div class="side-bar-widgets">
        <!--<p class="menu-title">FOLDER <span class="pull-right"><a href="#" class="create-folder"> <i class="fa fa-plus"></i></a></span></p>
        <ul class="folders" >
          <li><a href="#">
            <div class="status-icon green"></div>
            My quick tasks </a> </li>
          <li><a href="#">
            <div class="status-icon red"></div>
            To do list </a> </li>
          <li><a href="#">
            <div class="status-icon blue"></div>
            Projects </a> </li>
          <li class="folder-input" style="display:none">
            <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" >
          </li>
        </ul>-->
        <p class="menu-title">PROJECTS </p>
        <div class="status-widget">
          <div class="status-widget-wrapper">
            <div class="title">Freelancer<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>
            <p>Redesign home page</p>
          </div>
        </div>
        <div class="status-widget">
          <div class="status-widget-wrapper">
            <div class="title">envato<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>
            <p>Statistical report</p>
          </div>
        </div>
      </div>      
      <div class="clearfix"></div>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <a href="#" class="scrollup">Scroll</a>
  <div class="footer-widget">
    <!--<div class="progress transparent progress-small no-radius no-margin">
      <div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="79%" style="width: 79%;"></div>
    </div>-->
    <div class="pull-right">
      <!--<div class="details-status"> <span class="animate-number" data-value="86" data-animation-duration="560">86</span>% </div>-->
      <a href="lockscreen.html"><i class="fa fa-power-off"></i></a></div>
  </div>