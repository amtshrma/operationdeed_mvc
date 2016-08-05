<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <!--<div class="content-container">-->
		<h3><span class="semi-bold">Order Detail</span></h3>
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
            <?php
            if(count($orderDetail)){
				//pr($orderDetail);
			}else{
				echo 'No Order Found';
			}
			?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tbody>
						<?php
						if(!empty($documentIDArray->GetOrderStatusResult->StatusEvents->StatusEvent)){
							foreach($documentIDArray->GetOrderStatusResult->StatusEvents->StatusEvent as $key=>$val){
								echo '<tr>';
								echo '<td>'.$val->Description.'</td>';
								echo '<td>';
								if($val->DocumentID != 0){
									echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>',array('controller'=>'homes','action'=>'viewDocument/'.$val->DocumentID),array('escape'=>false,'target'=>'_blank'));
								}
								echo '</td>';
								echo '</tr>';
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<!-- END PAGE -->
</div>