<style>
    .pageLoadOverlay{
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
<div class="pageLoadOverlay" style="padding: 10%;z-index: 9999999">
    <?php echo $this->Html->image('front/spinner.gif',array('style'=>'height:50px;'));?>
</div>
<!-- /#page-wrapper -->
<script>
    jQuery(window).load(function(){
        //jQuery(".pageLoadOverlay").slideUp( "1000", function() {
            jQuery('.pageLoadOverlay').hide();
        //});
    });
</script>