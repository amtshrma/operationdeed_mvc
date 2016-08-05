<?php
echo $this->Form->create('Request',array('id'=>'shortAppForm','novalidate'=>'novalidate'));
?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <center>
                <h1>Title 365 API Form</h1>
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <center>
                        <?php echo $this->Session->flash();?>
                        <div id="flashMessage1" class="alert alert-danger" style="display:none"></div>
                        <div class="form-group">
                            <h3>Property Information</h3>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('Request.Properties.Property.Address1',array('label' => false,'div' => false, 'placeholder' => 'Address','class' => 'form-control','maxlength' => 100));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('Request.Properties.Property.State',array('label' => false,'div' => false, 'empty' => 'Select Property State','class' => 'form-control','options' => $states,'id'=>'title365States'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('Request.Properties.Property.City',array('label' => false,'div' => false, 'empty' => 'Select City','class' => 'form-control placeholder','options'=>'','id'=>'title365Cities'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php echo $this->Form->input('Request.Properties.Property.ZipCode',array('label' => false,'div' => false, 'placeholder' => 'ZipCode','class' => 'form-control placeholder'));?>
                            </div>
                            <div class="col-lg-4">
                                <?php
                            $requestedServices = array(
                                                       'PrimaryMortgage_ShortTitlePolicy_FullEscrow' => 'PrimaryMortgage_ShortTitlePolicy_FullEscrow',
                                                       'PrimaryMortgage_FullTitlePolicy_FullEscrow' => 'PrimaryMortgage_FullTitlePolicy_FullEscrow',
                                                       'PrimaryMortgage_ShortTitlePolicy' => 'PrimaryMortgage_ShortTitlePolicy',
                                                       'PrimaryMortgage_FullTitlePolicy' => 'PrimaryMortgage_FullTitlePolicy',
                                                       'PrimaryMortgage_FullEscrow' => 'PrimaryMortgage_FullEscrow',
                                                       'PrimaryAndSecondaryMortgage_ShortTitlePolicy_FullEscrow' => 'PrimaryAndSecondaryMortgage_ShortTitlePolicy_FullEscrow',
                                                       'PrimaryAndSecondaryMortgage_FullTitlePolicy_FullEscrow' => 'PrimaryAndSecondaryMortgage_FullTitlePolicy_FullEscrow',
                                                       'PrimaryAndSecondaryMortgage_ShortTitlePolicy' => 'PrimaryAndSecondaryMortgage_ShortTitlePolicy',
                                                       'PrimaryAndSecondaryMortgage_FullTitlePolicy' => 'PrimaryAndSecondaryMortgage_FullTitlePolicy',
                                                       'PrimaryAndSecondaryMortgage_FullEscrow' => 'PrimaryAndSecondaryMortgage_FullEscrow',
                                                       'SecondaryMortgage_LimitedTitlePolicy_LimitedEscrow' => 'SecondaryMortgage_LimitedTitlePolicy_LimitedEscrow',
                                                       'SecondaryMortgage_LimitedTitlePolicy_FullEscrow' => 'SecondaryMortgage_LimitedTitlePolicy_FullEscrow',
                                                       'SecondaryMortgage_LimitedTitlePolicy_SubEscrow' => 'SecondaryMortgage_LimitedTitlePolicy_SubEscrow',
                                                       'SecondaryMortgage_LimitedTitlePolicy' => 'SecondaryMortgage_LimitedTitlePolicy',
                                                       'SecondaryMortgage_LimitedEscrow' => 'SecondaryMortgage_LimitedEscrow',
                                                       'SecondaryMortgage_FullEscrow' => 'SecondaryMortgage_FullEscrow',
                                                       'SecondaryMortgage_SubEscrow' => 'SecondaryMortgage_SubEscrow',
                                                       'LoanModification_ShortTitlePolicy_FullEscrow' => 'LoanModification_ShortTitlePolicy_FullEscrow',
                                                       'LoanModification_FullTitlePolicy_FullEscrow' => 'LoanModification_FullTitlePolicy_FullEscrow',
                                                       'LoanModification_ShortTitlePolicy' => 'LoanModification_ShortTitlePolicy',
                                                       'LoanModification_FullTitlePolicy' => 'LoanModification_FullTitlePolicy',
                                                       'LoanModification_FullEscrow' => 'LoanModification_FullEscrow',
                                                       'StandardPurchase_FullTitlePolicy_FullEscrow' => 'StandardPurchase_FullTitlePolicy_FullEscrow',
                                                       'StandardPurchase_FullTitlePolicy' => 'StandardPurchase_FullTitlePolicy',
                                                       'StandardPurchase_FullEscrow' => 'StandardPurchase_FullEscrow',
                                                       'PreSale_FullTitle_FullEscrow' => 'PreSale_FullTitle_FullEscrow',
                                                       'PreSale_FullTitle' => 'PreSale_FullTitle',
                                                       'PreSale_FullEscrow' => 'PreSale_FullEscrow',
                                                       'ShortSale_FullTitle_FullEscrow' => 'ShortSale_FullTitle_FullEscrow',
                                                       'ShortSale_FullTitle' => 'ShortSale_FullTitle',
                                                       'ShortSale_FullEscrow' => 'ShortSale_FullEscrow',
                                                       'StandardREO_FullTitlePolicy_FullEscrow' => 'StandardREO_FullTitlePolicy_FullEscrow',
                                                       'StandardREO_FullTitlePolicy' => 'StandardREO_FullTitlePolicy',
                                                       'StandardREO_FullEscrow' => 'StandardREO_FullEscrow',
                                                       'Foreclosure_TSG' => 'Foreclosure_TSG',
                                                       'Foreclosure_TSG_ShortForm' => 'Foreclosure_TSG_ShortForm',
                                                       'Foreclosure_TSG_Limited' => 'Foreclosure_TSG_Limited',
                                                       'Foreclosure_LitigationGuarantee' => 'Foreclosure_LitigationGuarantee',
                                                       'Foreclosure_PreliminaryJudicialReport' => 'Foreclosure_PreliminaryJudicialReport',
                                                       'LossMitigation_PrelimCommitment_forDeedinLieu' => 'LossMitigation_PrelimCommitment_forDeedinLieu',
                                                       'LossMitigation_Binder_forDeedinLieu' => 'LossMitigation_Binder_forDeedinLieu',
                                                       'LossMitigation_MortgagePriorityGuarantee' => 'LossMitigation_MortgagePriorityGuarantee',
                                                       'UninsuredProducts_LimitedPropertyReport' => 'UninsuredProducts_LimitedPropertyReport',
                                                       'UninsuredProducts_FullPropertyReport' => 'UninsuredProducts_FullPropertyReport',
                                                       'UninsuredProducts_ForeclosureInformationReport' => 'UninsuredProducts_ForeclosureInformationReport',
                                                       'UninsuredProducts_ForeclosureCertificate' => 'UninsuredProducts_ForeclosureCertificate',
                                                       'UninsuredProducts_ForeclosureReportFannieMae' => 'UninsuredProducts_ForeclosureReportFannieMae',
                                                       'UninsuredProducts_UninsuredTitleCurative' => 'UninsuredProducts_UninsuredTitleCurative'
                                                       );
                            echo $this->Form->input('Request.RequestedServices.RequestedService',array('label' => false,'div' => false, 'empty' => 'Select RequestedService','options'=>$requestedServices,'class' => 'form-control'));?>
                            </div>
                            <div class="col-lg-4">
                            <?php
                            $orderType = array(
                                               'Finance' => 'Finance',
                                               'Purchase' => 'Purchase',
                                               'REO' => 'REO',
                                               'Default' => 'Default'
                                               );
                            echo $this->Form->input('Request.OrderType',array('label' => false,'div' => false, 'empty' => 'Select Order Type','options'=>$orderType,'class' => 'form-control orderType'));?>
                            </div>
                            <div style="clear:both"></div>
                            <div class="Finance order_type" style="display: none;">
                                <h3>Order Type Finacne Detail</h3>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Finance.Loans.Loan.LoanAmount',array('label' => false,'div' => false, 'placeholder' => 'Enter Loan Amount','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Finance.Borrowers.Borrower.FirstName',array('label' => false,'div' => false, 'placeholder' => 'Borrower First Name','class' => 'form-control'));?>
                                </div>
                                 <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Finance.Borrowers.Borrower.LastName',array('label' => false,'div' => false, 'placeholder' => 'Borrower Last Name','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Finance.Borrowers.Borrower.Email',array('label' => false,'div' => false, 'placeholder' => 'Borrower Email','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Finance.Borrowers.Borrower.Phone',array('label' => false,'div' => false, 'placeholder' => 'Borrower Phone','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Finance.OrderDetailsFinance.OrderReferenceCode',array('label' => false,'div' => false, 'placeholder' => 'Order Reference Code','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php
                                    $ContactType = array('Individual' => 'Individual','Company' => 'Company');
                                    echo $this->Form->input('Request.Finance.Borrowers.Borrower.ContactType',array('label' => false,'div' => false, 'empty' => 'Select Contact Type','options'=>$ContactType,'class' => 'form-control'));?>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="Purchase order_type" style="display: none;">
                                <h3>Order Type Purchase Detail</h3>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Buyers.Buyer.FirstName',array('label' => false,'div' => false, 'placeholder' => 'Enter Buyer First Name','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Buyers.Buyer.LastName',array('label' => false,'div' => false, 'placeholder' => 'Enter Buyer Last Name','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Buyers.Buyer.Email',array('label' => false,'div' => false, 'placeholder' => 'Enter Buyer Email','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Sellers.Seller.FirstName',array('label' => false,'div' => false, 'placeholder' => 'Enter Buyer First Name','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Sellers.Seller.LastName',array('label' => false,'div' => false, 'placeholder' => 'Enter Buyer Last Name','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Sellers.Seller.Email',array('label' => false,'div' => false, 'placeholder' => 'Enter Buyer Email','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Borrowers.Borrower.FirstName',array('label' => false,'div' => false, 'placeholder' => 'Borrower First Name','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Borrowers.Borrower.LastName',array('label' => false,'div' => false, 'placeholder' => 'Borrower Last Name','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Borrowers.Borrower.Email',array('label' => false,'div' => false, 'placeholder' => 'Borrower Email','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.Borrowers.Borrower.Phone',array('label' => false,'div' => false, 'placeholder' => 'Borrower Phone','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php
                                    $ContactType = array('Individual' => 'Individual','Company' => 'Company');
                                    echo $this->Form->input('Request.Purchase.Borrowers.Borrower.ContactType',array('label' => false,'div' => false, 'empty' => 'Select Contact Type','options'=>$ContactType,'class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.OrderDetailsPurchase.SalePrice',array('label' => false,'div' => false, 'placeholder' => 'Sale Price','class' => 'form-control'));?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('Request.Purchase.OrderDetailsPurchase.ContractAcceptanceDate',array('label' => false,'div' => false, 'placeholder' => 'Datepicker','id'=>'calender','class' => 'form-control'));?>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                        <br>
                        * All fields are required to move on to next step.
                        </center>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <div class="buttons">
        
                <table border="0" width="100%">
                    <tr>
                        <td align="left"></td>
                        <td align="right">
                            <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right" style="color:#8ecaf9"></span>Place Order',array('class'=>'btn btn-lg btn-primary sumitButton','title'=>'step2','type'=>'submit','escape'=>false));?>
                        </td>
                    </tr>
                </table>
                <br><br>
                </div>
            </center>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php echo $this->Form->end();?>
<script>
jQuery(document).ready(function(){
    // property states
	if(jQuery('#title365States').val()){
		getCities(jQuery('#title365States').val());
	}
	jQuery('#title365States').change(function(){
        var stateName = jQuery(this).find('option:selected').val();
		getCities(stateName);
	});
    // OrderType
    jQuery('.orderType').change(function(){
        if(jQuery(this).val() == 'Finance'){
            jQuery('div.order_type').hide();
            jQuery('div.Finance').show();
        }else if(jQuery(this).val() == 'Purchase' || jQuery(this).val() == 'REO'){
            jQuery('div.order_type').hide();
            jQuery('div.Purchase').show();
        }else if(jQuery(this).val() == 'Default'){
            jQuery('div.order_type').hide();
            jQuery('div.Default').show();
        }
    });
});
// getCities
function getCities(stateName) { 
    var URL = BASE_URL+"homes/getCities/";
    jQuery.ajax({
        type: "POST",
        url: URL,
        data: "stateName= " + stateName,
        success: function(data){
            jQuery('#title365Cities').html('');
            jQuery('#title365Cities').html(data);
        }
    });
}
</script>