<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-11 mid-div">
        <!--<div class="content-container">-->
		<h3><span class="semi-bold">Orders</span></h3>
		<div class="table-responsive">
			<p><?php echo $this->Session->flash();?></p>
			<table class="table table-bordered table-hover" id="emails" > 
                <thead>
                    <tr>
						<th class="small-cell">Sr No.</th>
                        <th class="small-cell">Order</th>
						<th class="small-cell">Property Detail</th>
						<th class="small-cell">Officer Detail</th>
						<th class="small-cell">Order Number</th>
						<th class="small-cell">Order Type</th>
						<th class="small-cell">Transection ID</th>
						<th class="small-cell">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
					if(count($getOrders)){
                        foreach($getOrders as $key=>$order) {
                            $request = json_decode($order['Title365Order']['request'],true);                           
                            $property = $request['Request']['Properties']['Property'];
                            $orderType = $request['Request']['OrderType'];
                            ?>
							<tr>
								<td class="small-cell v-align-middle"><?php echo $key+1;?></td>
                                <td class="small-cell v-align-middle">
                                    <?php
                                        echo $orderType; 
                                    ?>
                                </td>
								<td class="small-cell v-align-middle">
                                    <?php
                                        echo $property['Address1'].', '.$property['State'].', '.$property['City'].', '.$property['ZipCode'];
                                    ?>
                                </td>
                                <td class="small-cell v-align-middle">
                                    <?php
                                        $officer_detail = json_decode($order['Title365Order']['officer_detail'],true);
                                        echo $officer_detail['FirstName'].', '.$officer_detail['LastName'].'<br />';
                                        echo $officer_detail['Address1'].', '.$officer_detail['Address2'].'<br />';
                                        echo $officer_detail['City'].'<br />';
                                        echo 'Company Name :- '.$officer_detail['CompanyName'].'<br />';
                                        echo 'Phone:- '.$officer_detail['Phone'].'<br />';
                                    ?>
                                </td>
                                <td class="small-cell v-align-middle"><?php echo $order['Title365Order']['order_number'];?></td>
                                <td class="small-cell v-align-middle"><?php echo $order['Title365Order']['order_type'];?></td>
                                <td class="small-cell v-align-middle"><?php echo $order['Title365Order']['transection_id'];?></td>
								<td class="small-cell v-align-middle">
                                    <span class="muted">
                                        <?php echo $this->Html->link('<i class="fa fa-eye"></i></a>',array('controller' => 'homes','action' => 'orderDetail/'.$order['Title365Order']['id']),array('escape'=> false,'title'=>'View Order Detail'));?>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i></a>',array('controller' => 'homes','action' => 'cancelOrder/'.$order['Title365Order']['id']),array('class'=>'confirmAction','escape'=> false,'title'=>'Cancel Order'));?>
                                </td>
							</tr>
				    <?php }
					}else{?>
                        <tr>
                            <td colspan="4">No Orders Found.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
            </table>
			<div class="paging" align="right">
			<?php
				if(count($getOrders)){?>
					<ul class="pagination">                
						<li class="disabled">
							<?php echo $this->Paginator->prev(' << ' . __(''),array(),null,array('class' => 'prev disabled'));?>
						</li>
						<li>
							<?php  echo $this->Paginator->numbers(array('separator' => ''));?>
						</li>
						<li>
							<?php   echo $this->Paginator->next(' >> ' . __(''),array(),null,array('class' => 'next disabled'));?>
						</li>
					</ul>
			<?php
				}                
			?>
			</div>
		</div>	
	</div>	
<!-- END PAGE --> 
</div>