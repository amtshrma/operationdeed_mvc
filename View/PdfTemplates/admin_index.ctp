<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>YOU ARE HERE</p>
        </li>
        <li><a href="#" class="active">Pdf Template</a> </li>
      </ul>
      <div class="page-title"> <?php echo $this->Html->link('<i class="icon-custom-left"></i>', 'javascript:history.go(-1)',array('escape' =>false, 'title'=>'Back', 'alt'=>'Back')); ?>
        <div class="col-sm-8">
			<h3><span class="semi-bold">Pdf Template</span></h3>
		</div>
		<div class="col-sm-3" align="right">
			<?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New PDF Template</button>',array('controller'=>'pdf_templates','action'=>'add'),array('escape' => false,'title' => 'PDF Template'));?>
		</div>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple">			
			<div class="grid-title">
				<div class="row form-row">
				<?php 
				$recordExits = false;          
				if(isset($getData) && !empty($getData))
				{
				   $recordExits = true;            
				} 
				echo $this->Form->create('Search', array('url' => array('controller' => 'pdf_templates', 'action' => 'index'),'id'=>'templatesearch','type'=>'get')); ?>
					<div class="col-lg-4 col-lg-search">   
						<?php
						$keyword = '';
						if(!empty($this->params->query)&& ($this->params->query['name'] !='')) {
							$keyword = $this->params->query['name'];	
						}
						echo $this->Form->input('name',array('label' => false,'div' => false,'value'=>$keyword, 'placeholder' => 'Search By Template Name','class' => 'form-control search_control'));?>		
					</div>
					<div class="col-lg-4 col-lg-search">                        
						<?php echo $this->Form->button('Search', array('type' => 'submit','class' => 'btn btn-default'));?>
						<?php echo $this->Html->link('List All',array('controller'=>'pdf_templates','action'=>'index'),array('class' => 'btn btn-default'));?>
					</div>
				<?php echo $this->Form->end(); ?>
				</div>
			</div>
            <div class="grid-body">
			<div class="row">
				<?php echo $this->Session->flash();?>   
			</div>
			<br/>	
			
			<div class="row">
			<?php if($recordExits){ ?>
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th style="width:16%" ><?php echo $this->Paginator->sort('name', 'Template Name'); ?></th>
					<th style="width:5%" >Actions</th>
                  </tr>
                </thead>
                <tbody>
				<?php //pr($getData);
					foreach($getData as $key => $getData){ ?>
                  <tr>
                    <td class="v-align-middle"><?php echo $getData['EmailTemplate']['name']; ?></td>
					<td class="v-align-middle">
						<?php
						echo $this->Html->link('<i class="fa fa-edit"></i>', array('controller'=>'pdf_templates','action'=>'add',base64_encode($getData['EmailTemplate']['id'])),array('escape' =>false, 'title'=>'Edit', 'alt'=>'Edit')); ?>
						
					</td>
                  </tr>
                 <?php } ?>
                </tbody>
              </table>
				<div class="row grid-title">                                    
                     <div class="col-lg-12">
						<div class="dataTables_paginate paging_bootstrap pagination">
						<?php
						   if($this->Paginator->param('pageCount') > 1)
						   {
							   echo $this->element('admin/pagination');                 
						   }
						   ?>
						</div>
					</div>
                 </div>
                <div class="row form-row">
					<div class="col-lg-2"> LEGENDS:</div>
					<div class="col-lg-2"><?php echo '<i class="fa fa-edit"></i> Edit &nbsp;'; ?></div>
				</div>
				<?php
                }else{ 
                    echo $this->element('admin/no_record_exists');
                } ?>
			  </div>
            </div>
          </div>
        </div>
      </div>
	</div>
  </div>