<div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="content">	
		<div class="row"  id="inbox-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="no-border email-body" >
							<br>
							 <div class="row-fluid" >
							 <div class="row-fluid dataTables_wrapper">
								<h2 class=" inline">Manage Commission</h2>
							 </div>	
							 <div class="grid-body ">
                                 <div class="row">
                                    <div class="col-lg-12">
                                        <div class="toolbar">
                                            <div class="table-tools-actions">
                                                <?php echo $this->Html->link('<button id="test2" style="margin-left:12px" class="btn btn-primary">Add New Commission</button>',array('controller'=>'checklists','action'=>'add'),array('escape' => false,'title' => 'Add New Commission'));?>
                                            </div>
                                        </div>
                                    <?php echo $this->Session->flash();?>   
                                    </div>         
                                </div>
                                <br/>
								<table class="table table-bordered table-condensed" id="example">
                                  <thead>
                                    <tr>
                                        <th style="width:8%">User Type</th>
									    <th style="width:8%">Commission</th>
                                        <th style="width:8%">Action</th>
									</tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        <td colspan="3" align="center">No Commission.</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>							
							 </div>							
							</div>
							</div>	
						</div>
					</div>
				</div>	
		</div>		
  </div>
  
  <!-- END PAGE --> 
</div>