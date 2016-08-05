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
	switch($switchcase){
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
			<!--div class="profile-wrapper">
				<?php echo $this->Html->image('d.jpg', array("width"=>"69","height"=>"69"));?>
			</div-->
			<div class="user-info">
				<div class="greeting">Welcome</div>
				<div class="username">
					<?php echo $loggedUserInfo['first_name']; ?> <span class="semi-bold"><?php echo $loggedUserInfo['last_name']; ?></span>
				</div>
			</div>
		</div>
		<!-- END MINI-PROFILE -->
		<!-- BEGIN SIDEBAR MENU -->
		<br /><br />
        <ul>
			<li class="start <?php echo $dashboard; ?>">
			  <?php echo $this->Html->link('<i class="icon-custom-home"></i> <span class="title">Dashboard</span>',array('controller'=> 'admins','action'=>'dashboard'),array('escape' =>false,'Dashboard')); ?> 
			</li>
        <!--li class=""> <a href="email.html"> <i class="fa fa-envelope"></i> <span class="title">Email</span> <span class=" badge badge-disable pull-right ">203</span></a> </li-->
			<li class=""> <a href="javascript:;"> <i class="fa fa fa-copy"></i> <span class="title">Templates</span> <span class="arrow "></span> </a>
				<ul class="sub-menu">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-file-text"></i><span class="title">Email Templates</span>',array('controller'=>'email_templates','action'=>'index','admin'=>true),array('escape' =>false,'Email Templates'));?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-file-text"></i><span class="title">Pdf Templates</span>',array('controller'=>'pdf_templates','action'=>'index','admin'=>true),array('escape' =>false,'Pdf Templates')); ?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-file-text"></i><span class="title">Loan Docs Templates</span>',array('controller'=>'email_templates','action'=>'loan_doc','admin'=>true),array('escape' =>false,'Loan Docs Templates')); ?>
					</li>
				</ul>
			</li> 
			<li class="<?php echo $docs;?>">
				<a href="javascript:;">
					<i class="fa fa-file-text"></i> <span class="title">Documents</span><span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="<?php echo $checklistsDocs;?>">
					   <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
					   <span class="title">Property Documents</span>',array('controller'=>'checklists','action'=>'index','admin'=>true),array('escape' =>false,'Manage Property Documents'));?>
					</li>
					<li class="<?php echo $loanDocs;?>">
					   <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
					   <span class="title">Loan Documents</span>',array('controller'=>'checklists','action'=>'loan_document','admin'=>true),array('escape' =>false,'Loan Documents'));?>
					</li>
					<li class="<?php echo $companyTemp;?>">
					   <?php echo $this->Html->link('<i class="fa fa-file-text"></i>
					   <span class="title">Company Templates</span>',array('controller'=>'admins','action'=>'template','admin'=>true),array('escape' =>false,'Manage Templates'));?>        
					</li>
				</ul>
			</li>
			<li class="<?php echo $manageDocs;?>">
				<?php
					echo $this->Html->link('<i class="fa fa-legal"></i><span class="title">Legal Agreement</span>',array('controller'=>'documents','action'=>'index','admin'=>true),array('escape' =>false,'Manage Legal Agreement'));
				?>
			</li>
			<li class="<?php echo $teamass; ?>">
				<?php echo $this->Html->link('<i class="fa fa-group"></i><span class="title">Team Assignment</span>',array('controller'=>'admins','action'=>'team_assignment','admin'=>true),array('escape' =>false,'Funders Team'));?>
			</li>
			<li class="<?php echo $users; ?>">
				<?php echo $this->Html->link('<i class="fa fa-user"></i><span class="title">User Listing</span>',array('controller'=>'users','action'=>'index','admin'=>true),array('escape' =>false,'User')); ?>
			</li>
			<li class="<?php echo $investors; ?>">
				<?php echo $this->Html->link('<i class="fa fa-user-md"></i><span class="title">Investor Listing</span>',array('controller'=>'investors','action'=>'index','admin'=>true),array('escape' =>false,'Email Template')); ?>
			</li>
			<li class="<?php echo $loans; ?>">
				<?php echo $this->Html->link('<i class="fa fa-dollar"></i><span class="title">Loan Listing</span>',array('controller'=>'admins','action'=>'loans','admin'=>true),array('escape' =>false,'Loans'));?>
			</li>
			<li class="<?php echo (!empty($stateCity)) ? 'open' : '';?>">
				<a href="javascript:;">
					<i class="fa fa-th-list"></i> <span class="title">City / States</span> <span class="arrow <?php echo (!empty($stateCity)) ? 'open' : '';?>"></span>
				</a>
				<ul class="sub-menu" style="<?php echo (!empty($stateCity)) ? 'display:block;' : 'display:none;';?>">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-flag"></i><span class="title">Manage States</span>',array('controller'=>'admins','action'=>'list_states','admin'=>true),array('escape' =>false,'Manage States')); ?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-group"></i><span class="title">Manage Cities</span>',array('controller'=>'admins','action'=>'list_cities','admin'=>true),array('escape' =>false,'Manage States')); ?>
					</li>
				</ul>
			</li>
			<li class=""> <a href="javascript:;"> <i class="fa fa-th-list"></i> <span class="title">Setting</span> <span class="arrow "></span> </a>
				<ul class="sub-menu">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-hand-o-right"></i><span class="title">Admin Settings</span>',array('controller'=>'admins','action'=>'settings','admin'=>true),array('escape' =>false,'Admin Settings')); ?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-file-text"></i><span class="title">Manage Loan Reason</span>',array('controller'=>'admins','action'=>'loan_reasons','admin'=>true),array('escape' =>false,'Manage Loan Reason')); ?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-file-text"></i><span class="title">Manage Loan Phases</span>',array('controller'=>'admins','action'=>'loanPhases','admin'=>true),array('escape' =>false,'Manage Loan Reason')); ?>
					</li>
				</ul>
			</li>
		</ul>
		<div class="clearfix"></div>
		<!-- END SIDEBAR MENU -->
    </div>
</div>
<a href="#" class="scrollup">Scroll</a>