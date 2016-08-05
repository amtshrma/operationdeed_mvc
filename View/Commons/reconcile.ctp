<div id="page-content-wrapper" class="eqHeight page-content-wrapper">
    <div class="col-sm-12 col-md-12 col-lg-12 mid-div whiteBG">
        <ul class="breadcrumb">
            <li>
                <p>YOU ARE HERE</p>
            </li>
            <li>
                <?php echo $this->Html->link('Loan', array('controller'=>'commons','action'=>'loan'),array('class'=>'active'));?>
            </li>
        </ul>
        <?php echo $this->Form->create('LoanHoldRequest', array('novalidate' => true,'id'=>'trustDeedInvHoldReqForm','class'=>'form-no-horizontal-spacing','enctype'=>'multipart/form-data')); ?>
        <div class="row"  id="inbox-wrapper">
            <div class="col-md-12 whitebg">
                <h2 class=" inline">Accounting</h2>
                <div class="clearfix"></div>
                <div class="grid-body">
                    <p>Escrow Closing Statement : </p>
                    <p>Final Commission Statement : </p>
                    <p>Final Commission Statement : </p>
                </div> 
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>	
</div>
    
<!-- END PAGE --> 

<script>
    jQuery('.investor_type').click(function(e) {
        if(jQuery(this).val()=='fractional_trust_deed') {
            jQuery('.invtype').removeClass('hide');
        } else {
            jQuery('.invtype').addClass('hide');
        }
    });
</script>