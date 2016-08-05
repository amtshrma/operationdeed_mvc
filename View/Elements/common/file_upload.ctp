<?php echo $this->Html->css('../plupload/js/jquery.ui.plupload/css/jquery.ui.plupload'); ?>

<?php echo $this->Html->script(array('../plupload/js/plupload.full.min',
                                     '../plupload/js/jquery.ui.plupload/jquery.ui.plupload'
                                     )); ?>
<div id="uploader">
    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
</div>
<script type="text/javascript">
// Initialize the widget when the DOM is ready
jQuery(function() {
jQuery.fn.plupload =	jQuery("#uploader").plupload({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '<?php echo $upload_url.'/'.$loanId; ?>',
        
		// User can upload no more then 20 files in one go (sets multiple_queues to false)
		max_file_count: 20,
		
		chunk_size: '1mb',
        
		// Resize images on clientside if we can
		/*resize : {
			width : 200, 
			height : 200, 
			quality : 90,
			crop: true // crop to exact dimensions
		},*/
		
		filters : {
			// Maximum file size
			max_file_size : '1000mb',
			// Specify what files to browse for
			mime_types: [
				{title : "files", extensions : "doc,docx,pdf"},
				{title : "Zip files", extensions : "zip"}
			]
		},
        
		// Rename files by clicking on their titles
		rename: true,
		
		// Sort files
		sortable: true,
        
		// Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
		dragdrop: true,
        
		// Views to activate
		views: {
			list: true,
			thumbs: false, // Show thumbs
			active: 'thumbs'
		},
        
		// Flash settings
		flash_swf_url : '../../js/Moxie.swf',
        
		// Silverlight settings
		silverlight_xap_url : '../../js/Moxie.xap',     
        // redirect mod
        preinit : attachCallbacksdoc
	});
});

// added redirect function after uploaded
function attachCallbacksdoc(uploader) {
uploader.bind('FileUploaded', function(Up, File, Response) {
    if( (uploader.total.uploaded + 1) == uploader.files.length) {
        
        //window.location = 'http://playground.saint.com.au/westcoast/view.php';
        //window.location.reload(true);
        //var params = {"pid":pid, "click":'docs'}
        //var url = "/properties/property";
        //
        //jQuery.post(url, params, function(data) {
        //      jQuery("#loader").hide();
        //      jQuery("#showAjax").html(data);
        //});
    }
    });
}
</script>