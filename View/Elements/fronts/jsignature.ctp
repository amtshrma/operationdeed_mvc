<?php
echo $this->Html->script('jsignature/flashcanvas.js');
?>
<div id="signature"></div>
<div id="tools" style="text-align:center;"></div>
<input name="data[DisclosureStatement][brokerSignature]" type='hidden' id="senderSignature"/>
<script>
(function(jQuery) {
	var topics = {};
	jQuery.publish = function(topic, args) {
	    if (topics[topic]) {
	        var currentTopic = topics[topic],
	        args = args || {};
	        for (var i = 0, j = currentTopic.length; i < j; i++) {
	            currentTopic[i].call(jQuery, args);
	        }
	    }
	};
	jQuery.subscribe = function(topic, callback) {
	    if (!topics[topic]) {
	        topics[topic] = [];
	    }
	    topics[topic].push(callback);
	    return {
	        "topic": topic,
	        "callback": callback
	    };
	};
	jQuery.unsubscribe = function(handle) {
	    var topic = handle.topic;
	    if (topics[topic]) {
	        var currentTopic = topics[topic];
	
	        for (var i = 0, j = currentTopic.length; i < j; i++) {
	            if (currentTopic[i] === handle.callback) {
	                currentTopic.splice(i, 1);
	            }
	        }
	    }
	};
})(jQuery);
</script>
<?php
    echo $this->Html->script('jsignature/jSignature.min.noconflict.js');
?>
<script>
(function(jQuery){
jQuery(document).ready(function() {
	// This is the part where jSignature is initialized.
	var jQuerysigdiv = jQuery("#signature").jSignature({'UndoButton':false,'width':'100%','height':'150px','showLine' : false})
	// All the code below is just code driving the demo. 
	, jQuerytools = jQuery('#tools')
	, jQueryextraarea = jQuery('#displayarea')
	, pubsubprefix = 'jSignature.demo.'
	
	var export_plugins = jQuerysigdiv.jSignature('listPlugins','export');
	var chops = ['<a href="javascript:void(0);" class="btn btn-primary btn-cons btn-success">Confirm</a>'];
	jQuery(chops.join('')).bind('click', function(e){
		var data = jQuerysigdiv.jSignature('getData', 'image')
		if(jQuery.isArray(data) && data.length === 2){
			jQuery('#senderSignature').val(data.join(','))
			jQuery.publish(pubsubprefix + data[0], data);
		}
	}).appendTo(jQuerytools);
	jQuery('<a href="javascript:void(0)" style="margin-left : 1%;" class="btn btn-primary btn-cons btn-danger">Reset</a>').bind('click', function(e){
		jQuerysigdiv.jSignature('reset')
	}).appendTo(jQuerytools);
	//jQuery('<div><textarea id="signature" name="data[Loi][signature] "style="display:none;width:10%;height:7em;"></textarea></div>').appendTo(jQuerytools);
})
})(jQuery)
</script>
<style>
	#signature{
		border : 1px solid #ccc;
		height:100px;
		width: 371px;
		margin-left: 274px;
	}
	.customClass{
		padding: 0px 5px;
		font-size: 12px;
	}
	#tools{
		margin-top: 7%;
		margin-left : 274px;
	}
</style>