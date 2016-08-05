<style>
.textCenter{
	text-align: center;
}
i{
	font-weight: bold;
}
.tableTitle{
	background: #324047;
	padding: 10px 20px;
	border-radius: 4px;
	color: #fff;
}
.tableInnerTitle{
	background: #ccc;
	padding: 5px 10px;
}
a{
	font-weight : normal;
	color: #337ab7;
}
</style>
<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <!--<div class="content-container">-->
		<?php echo $this->Session->flash();?>
		<h3>
			Property Detail <?php echo $this->Html->link('Generate Soft Quote', array('controller'=>'commons','action'=>'soft_quote',base64_encode($shortAppDetail['ShortApplication']['id'])),array('title'=>'Generate Soft Quote'));?>
			<?php
			if(empty($shortAppDetail['PropertyDetail']['id'])){
				echo $this->Html->link('Get Property Detail', array('controller'=>'commons','action'=>'propertyDetail',base64_encode($shortAppDetail['ShortApplication']['id']),base64_encode('yes')),array('title'=>'Get Property Detail','class'=>'pull-right showLoader'));
			}	
			?>
		</h3>
		<br />
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#mapp">Map</a></li>
			<li><a data-toggle="tab" href="#propertyDetail">Property Detail</a></li>
			<li><a data-toggle="tab" href="#propertyHistory">Property History</a></li>
			<li><a data-toggle="tab" href="#parcelMap">Parcel Map</a></li>
			<li><a data-toggle="tab" href="#propertyComparables">Property Comparables</a></li>
			<li><a data-toggle="tab" href="#AVM">AVM</a></li>
		</ul>
		<div class="tab-content">
			<!-- maps -->
			<div id="mapp" class="tab-pane fade in active">
				<div id="map" style="width: 100%;height: 400px"></div>
			</div>
			<div id="propertyDetail" class="tab-pane fade">
				<div class="row table-responsive">
					<table class="table table-striped table-sm">
					   <tbody>
							<tr>
								<td colspan="2">
									<strong>Subject Property : <?php echo $shortAppDetail['ShortApplication']['property_address'].', '.$this->Common->getCityName($shortAppDetail['ShortApplication']['property_city']).', '.$this->Common->getStateName($shortAppDetail['ShortApplication']['property_state']).', '.$shortAppDetail['ShortApplication']['property_zipcode'];?></strong>
								</td>
							</tr>
							<!-- Ownership -->
							<?php
								if(!empty($shortAppDetail['PropertyDetail']['AvmPropertyValue']) && !empty($shortAppDetail['PropertyDetail']['AvmPropertyRange'])){
							?>
								<tr><td class="tableTitle" colspan="2"><i>AVM</i></td></tr>
								<tr>
									<td>
										<i>AVM Property Value ($) :</i> <?php echo $shortAppDetail['PropertyDetail']['AvmPropertyValue'];?>
									</td>
									<td>
										<i>AVM Property Range ($) :</i> <?php echo $shortAppDetail['PropertyDetail']['AvmPropertyRange'];?>
									</td>
								</tr>
							<?php } ?>
							
							<tr><td class="tableTitle" colspan="2"><i>Ownership</i></td></tr>
							<tr>
								<td>
									<i>Primary Owner :</i> <?php echo $shortAppDetail['PropertyDetail']['Owner1Full'];?>
								</td>
								<td>
									<i>Secondary Owner :</i> <?php echo $shortAppDetail['PropertyDetail']['Owner2Full'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Mail Address :</i> <?php echo $shortAppDetail['PropertyDetail']['MailAddress1'] . ', ' .$shortAppDetail['PropertyDetail']['MailCity'] . ', ' .$shortAppDetail['PropertyDetail']['MailZip'];?>
								</td>
								<td>
									<i>Vesting : </i><?php echo $shortAppDetail['PropertyDetail']['Vesting'];?>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<i>Legal :</i> <?php echo $shortAppDetail['PropertyDetail']['LegalDesc'];?>
								</td>
							</tr>
							<!-- Sale & Loan -->
							<tr><td class="tableTitle" colspan="2"><i>Sale & Loan</i></td></tr>
							<tr>
								<td>
									<i>Last Sale Amount : </i> <?php echo '$' . number_format($shortAppDetail['PropertyDetail']['LastSaleAmt'],2);?>
								</td>
								<td>
									<i>Loan Type : </i> <?php echo $shortAppDetail['PropertyDetail']['LastSaleLoanType'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Last Sale Date :</i> <?php echo date('M/d/Y', strtotime($shortAppDetail['PropertyDetail']['LastSaleDate']));?>
								</td>
								<td>
									<i>Year Built : </i><?php echo $shortAppDetail['PropertyDetail']['YearBuilt'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Last Sale Doc. No. : </i> <?php echo $shortAppDetail['PropertyDetail']['LastSaleDocNo'];?>
								</td>
								<td>
									<i>Last Sale Lender : </i> <?php echo $shortAppDetail['PropertyDetail']['LastSaleLender'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Latitude : </i> <?php echo $shortAppDetail['PropertyDetail']['Latitude'];?>
								</td>
								<td>
									<i>Longitude : </i> <?php echo $shortAppDetail['PropertyDetail']['Longitude'];?>
								</td>
							</tr>
							<!-- ASSESSMENT & TAX -->
							<tr><td class="tableTitle" colspan="2"><i>Assessment & Tax</i></td></tr>
							<tr>
								<td>
									<i>Value Structure ($): </i> <?php echo '$' .number_format($shortAppDetail['PropertyDetail']['ValueStruc'],2);?>
								</td>
								<td>
									<i>Tax Amt ($) : </i> <?php echo '$'.number_format($shortAppDetail['PropertyDetail']['TaxAmt'],2);?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Value Land ($):</i> <?php echo '$'.number_format($shortAppDetail['PropertyDetail']['ValueLand'],2);?>
								</td>
								<td>
									<i>Tax Area : </i><?php echo $shortAppDetail['PropertyDetail']['TaxArea'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Percent Improved (%): </i> <?php echo $shortAppDetail['PropertyDetail']['PctImproved'];?>
								</td>
								<td>
									<i>Value Total ($) : </i> <?php echo '$'. number_format($shortAppDetail['PropertyDetail']['ValueTotal'],2);?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Exemption : </i> <?php echo $shortAppDetail['PropertyDetail']['Exemption'];?>
								</td>
								<td></td>
							</tr>
							<!-- PROPERTY CHARACTERISTICS -->
							<tr><td class="tableTitle" colspan="2"><i>Property Characteristics</i></td></tr>
							<tr>
								<td>
									<i>Type : </i> <?php echo $shortAppDetail['PropertyDetail']['PropertyTypeDesc'];?>
								</td>
								<td>
									<i>Year Built : </i> <?php echo $shortAppDetail['PropertyDetail']['YearBuilt'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Rooms : </i> <?php echo $shortAppDetail['PropertyDetail']['Rooms'];?>
								</td>
								<td>
									<i>Parcel/APN : </i> <?php echo $shortAppDetail['PropertyDetail']['APN'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Beds :</i> <?php echo $shortAppDetail['PropertyDetail']['Beds'];?>
								</td>
								<td>
									<i>County : </i><?php echo $shortAppDetail['PropertyDetail']['SiteCounty'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Baths : </i> <?php echo $shortAppDetail['PropertyDetail']['Baths'];?>
								</td>
								<td>
									<i>Zoning : </i> <?php echo $shortAppDetail['PropertyDetail']['Zoning'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>SqFt (Structure) :</i> <?php echo $shortAppDetail['PropertyDetail']['SqFtStruc'];?>
								</td>
								<td>
									<i>Tract : </i><?php echo $shortAppDetail['PropertyDetail']['Tract'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>SqFt (Lot) : </i> <?php echo $shortAppDetail['PropertyDetail']['SqFtLot'];?>
								</td>
								<td>
									<i>Pool : </i> <?php echo $shortAppDetail['PropertyDetail']['Pool'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Stories :</i> <?php echo date('M d Y', strtotime($shortAppDetail['PropertyDetail']['Stories']));?>
								</td>
								<td>
									<i>View : </i><?php echo $shortAppDetail['PropertyDetail']['View'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Garage : </i> <?php echo $shortAppDetail['PropertyDetail']['Garage'];?>
								</td>
								<td>
									<i>Fireplace : </i> <?php echo $shortAppDetail['PropertyDetail']['Fireplace'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Number of Units : </i> <?php echo $shortAppDetail['PropertyDetail']['Units'];?>
								</td>
								<td>
									<i>Map Ref. : <?php echo $this->Html->link('View Property Image',$shortAppDetail['PropertyDetail']['MapImageURL'],array('target'=>'_blank'));?>
								</td>
							</tr>
					   </tbody>
					</table>
				</div>
			</div>
			
			<div id="propertyHistory" class="tab-pane fade">
				<!-- Transaction History-->
				<div class="row table-responsive">
					<table class="table table-striped table-sm">
						<tbody>
							<tr><td class="tableTitle" colspan="2"><i>Transaction History</i></td></tr>
							<?php foreach($shortAppDetail['PropertyHistory'] as $key=>$val){?>
							<tr><td class="tableInnerTitle" colspan="2"><i>Transaction <?php echo $key+1;?></i></td></tr>
							<tr>
								
								<td>
									<i>Sale Date : </i> <?php echo date('m/d/Y', strtotime($val['RecordingDate']));?>
								</td>
								<td>
									<i>Sale Price : </i> <?php if($val['SalePrice'] > 0 ) { echo '$'.number_format($val['SalePrice'],2); } ?>
								</td>
							</tr>
							<tr>
								
								<td>
									<i>Sale Type : </i> <?php echo $val['SaleType'];?>
								</td>
								<td>
									<i>Sale Price Type : </i> <?php echo $val['SalePriceType'];?>
								</td>
							</tr>
							<tr>
								
								<td>
									<i>Recording Date : </i> <?php echo date('m/d/Y', strtotime($val['RecordingDate']));?>
								</td>
								<td>
									<i>Document Number : </i> <?php echo $val['DocumentNumber'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Title Company : </i> <?php echo $val['TitleCompany'];?>
								</td>
								<td>
									<i>Document Type : </i> <?php echo $val['DocumentType'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Seller: </i> <?php echo $val['Seller'];?>
								</td>
								<td>
									<i>Buyer : </i> <?php echo $val['BuyerBorrower'];?>
								</td>
								
							</tr>
							<tr>
								
								<td>
									<i>Borrower Vesting : </i> <?php echo $val['BuyerBorrowerVesting'];?>
								</td>
								<td></td>
							</tr>
							<tr>
								<td>
									<i>Loan Doc No. # : </i> <?php echo $val['LoanDocNumber'];?>
								</td>
								<td>
									<i>Loan Type : </i> <?php echo $val['LoanDocumentType'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Lender : </i> <?php echo $val['Lender'];?>
								</td>
								<td>
									<i>Loan Term : </i> <?php echo $val['LoanTerm'];?>
								</td>
							</tr>
							<tr>
								<td>
									<i>Loan Amount ($) : </i> <?php if($val['LoanAmount'] > 0 ) { echo '$'.number_format($val['LoanAmount'],2); }?>
								</td>
								<td>
									<i>Interest Rate : </i> <?php echo $val['LoanInterestRate'];?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div id="parcelMap" class="tab-pane fade">
				<iframe style="border: 0;width:100%; height:auto;min-height: 500px;" src="<?php echo $shortAppDetail['PropertyDetail']['MapImageURL'];?>"></iframe>
			</div>
			<div id="propertyComparables" class="tab-pane fade">
				<div class="row table-responsive">
					<h3 class="tableTitle">Property Comparables</h3>
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th>Address</th>
								<th>Sale Price ($)</th>
								<th>Sale Date</th>
								<th>Beds</th>
								<th>Baths</th>
								<th>SqFt</th>
								<th>$/SqFt</th>
								<th>Lot</th>
								<th>Yr Bit</th>
								<th>Distance</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($shortAppDetail['PropertyComparable'] as $key=>$val){?>
							<tr>
								<td><?php echo $val['Address1'];?></td>
								<td><?php echo $val['SalePrice'];?></td>
								<td><?php echo date('M d Y',strtotime($val['SaleDate']));?></td>
								<td><?php echo $val['Beds'];?></td>
								<td><?php echo $val['Baths'];?></td>
								<td><?php echo $val['Address1'];?></td>
								<td><?php echo $val['Address1'];?></td>
								<td><?php echo $val['SqFtLot'];?></td>
								<td><?php echo $val['YearBuilt'];?></td>
								<td><?php echo $val['Distance'];?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div id="AVM" class="tab-pane fade">
				<?php
				//echo $shortAppDetail['PropertyDetail']['AVM'];
				if(isset($shortAppDetail['PropertyDetail']['AVM']) && $shortAppDetail['PropertyDetail']['AVM'] != '') { ?>
				<iframe style="border: 0;width:100%; height:auto;min-height: 500px;" src="<?php echo BASE_URL .'property_avm/'.$shortAppDetail['PropertyDetail']['AVM'];?>"></iframe>
				<?php } else {
					echo "AVM Not Available";
				} ?>
			</div>
		</div>
	</div>	
<!-- END PAGE --> 
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvCxXInKRXPN2iylxjT2hh_YmLJoXyqvA" type="text/javascript"></script>
<script type="text/javascript"> 
	function load() {
		var uluru = {lat: <?php echo $shortAppDetail['PropertyDetail']['Latitude'];?>, lng: <?php echo $shortAppDetail['PropertyDetail']['Longitude'];?>};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: uluru
		});
		var contentString = '<?php echo $shortAppDetail['ShortApplication']['property_name'];?>';
		var infowindow = new google.maps.InfoWindow({
		  content: contentString,
		  maxWidth: 200
		});
		var marker = new google.maps.Marker({
			position: uluru,
			map: map,
			title: 'Uluru (Ayers Rock)'
		});
		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});
	}
	load();
</script>
<?php echo $this->Element('fronts/loader');?>