    <footer>
	<div class="container">
    	<div class="col-sm-3">
        	<h3>Quick Links</h3>
            <ul>
            	<li><a href="#">Lorem ipsum dolor</a></li>
                <li><a href="#">In orci ipsum</a></li>
                <li><a href="#">Mauris feugiat augue</a></li>
                <li><a href="#">Sed sed consequat</a></li>
		<?php if(isset($static_page_array) && !empty($static_page_array)) {
		    foreach($static_page_array as $static_page) {?>
		<li>
		   <?php  $title = ucfirst($static_page['StaticPage']['title']);
		   $keyword = $static_page['StaticPage']['keyword'];
		    echo $this->Html->link($title,array('controller'=>'homes','action'=>'index',$keyword),array())?>
		</li>
		    
		<?php } } ?>
                <!--<li><?php //echo $this->Html->link('Terms and Release',array('controller'=>'homes','action'=>'index','termAndRelease'),array())?></li>
		<li><?php //echo $this->Html->link('Privacy Policy',array('controller'=>'homes','action'=>'index','privacy_policy'),array())?></li>
		<li><?php //echo $this->Html->link('About Us',array('controller'=>'homes','action'=>'index','about_us'),array())?></li>-->
		<li><?php echo $this->Html->link('FAQs',array('controller'=>'faqs','action'=>'index'),array())?></li>	         </ul>
        </div>
        <div class="col-sm-3">
        	<h3>Contact</h3>
            <ul>
            	<li>222 N Sepulveda Blvd STE 2000 El Segundo, CA 90245</li>
                <li>P: [800]572-4080</li>
                <li>F: [310]622-4186</li>
                <li>E: rocklandcommercial.com</li>
            </ul>
        </div>
        <div class="col-sm-5 pull-right">
        	<h3>Our social presence</h3>
            <ul class="social">
            	<li><a href="#"><img src="<?php echo BASE_URL;?>img/linkedin.png" alt="linked in" title="linked in"></a></li>
                <li><a href="#"><img src="<?php echo BASE_URL;?>img/fb.png" alt="facebook" title="facebook"></a></li>
                <li><a href="#"><img src="<?php echo BASE_URL;?>img/twitter.png" alt="twitter" title="twitter"></a></li>
                <li><a href="#"><img src="<?php echo BASE_URL;?>img/google+.png" alt="google+" title="google+"></a></li>
                <li><a href="#"><img src="<?php echo BASE_URL;?>img/youtube.png" alt="youtube" title="youtube"></a></li>
            </ul>
        </div>
    </div>
    <div class="sm-foot">
    	Copyright &copy; ROCKLAND 2015. All rights are reserved.
    </div>
</footer>