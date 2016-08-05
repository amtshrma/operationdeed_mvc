<style>
    .overlay{
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #333;
        opacity : 0.7;
        z-index: 9999;
        color: white;
        display: inline-block;
        text-align: center;
    }
    .overlay img {
        margin-top: 20%;
    }
</style>
<div id="overlay" class="overlay" style="display: none; padding: 15%;z-index : 9999999">
    <?php echo $this->Html->image('front/spinner.gif',array('style'=>'height:50px;'));?>
</div>
<!-- /#page-wrapper -->
<script>
    jQuery(document).ready(function(){
        jQuery('button[type="submit"], .showLoader').click(function(){
            jQuery("html, body").animate({ scrollTop: 0 }, "slow");
            jQuery('.overlay').show();
            jQuery('.overlay').css('height',jQuery(document).height());
        });    
    });
</script>