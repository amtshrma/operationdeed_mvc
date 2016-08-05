<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 whiteBG">
        <div class="row">
                <?php echo $this->Session->flash();
                    echo $this->Form->create('document', array('type' => 'file'));
                    echo $this->Form->input('loanID', array('name'=>"loanID",'type' => 'hidden','value'=>base64_encode($loanID),'id'=>'loanID'));?>
                <div class="col-md-12">
                    <div class="grid simple" >
                        <div class="no-border email-body" >
                            <h2>Approve/Deny Document</h2><hr />
                            <div class="grid-body">
                               <table class="table table-fixed-layout table-hover" width="100%" cellpadding="0" cellspacing="10">
                                <thead>
                                    <tr>
                                        <th class="medium-cell">Document</th>
                                        <th class="medium-cell">View</th>
                                        <th class="medium-cell">Action</th>
                                    </tr>
                                </thead>
                             <?php 
                                foreach($disclosureDocuments as $key=>$document){ ?>
                                <tr>
                                    <td>
					<?php echo $document['DisclosureApproval']['document'];
					echo $this->Form->input('document', array('name'=>"document",'type' => 'hidden','value'=>$document['DisclosureApproval']['id']));?>
                                    </td>
                                    <td>
					<?php
					    echo $this->Html->link($document['DisclosureApproval']['document'], BASE_URL.'files/pdf/'.$disclosure[$document['DisclosureApproval']['document']].'/'.$disclosure[$document['DisclosureApproval']['document']].'_'.base64_encode($loanID).'.pdf', array('class' => 'button','target'=>'_blank')); ?>
									</td>
                                    <td>
									<?php
									if($document['DisclosureApproval']['status'] == '1'){
										echo '<span class="greenText glyphicon glyphicon-ok" aria-hidden="true">Accepted</span>';
									}else{
										if($document['DisclosureApproval']['status'] == '2'){
										echo '<span class="redText glyphicon glyphicon-remove" aria-hidden="true">Denied</span>';
										echo '<br/>';
										}
										
									?>
										<a onclick="return edit_approval('<?php echo base64_encode($document['DisclosureApproval']['id']);?>','<?php echo base64_encode(2);?>','<?php echo base64_encode('DisclosureApproval');?>','<?php echo $disclosure[$document['DisclosureApproval']['document']];?>');" style="cursor:pointer;" title="Click here to deny">Deny</a>
										/
										<a title="Click here to accept" href="javascript:void(0);" onclick="return edit_approval('<?php echo base64_encode($document['DisclosureApproval']['id']);?>','<?php echo base64_encode(1);?>','<?php echo base64_encode('DisclosureApproval');?>','<?php echo $disclosure[$document['DisclosureApproval']['document']];?>');">Accept</a>
									<?php }?>
									</td>
                                </tr>
                                <?php } ?>
                                </table>
                            </div>							
                         </div>							
                    </div>
                </div>
               
            <?php echo $this->Form->end(); ?>
        </div>	
</div>
</div>
  <!-- END PAGE -->
