<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<?php echo $this->Html->css('admin/custom_admin'); ?> 

	<script type="text/javascript">
    $(document).ready(function(){
   
        //Counter
        counter = 0;
        //Make element draggable
        $(".drag .control-group").draggable({
             cancel: '',
            helper:'clone',
            containment: 'frame',
            

            //When first dragged
            stop:function(ev, ui) {
            	var pos=$(ui.helper).offset();
            	objName = "#clonediv"+counter
            	$(objName).css({"left":pos.left,"top":pos.top});
            	$(objName).removeClass("drag");


               	//When an existiung object is dragged
                $(objName).draggable({
                	containment: 'parent',
                    stop:function(ev, ui) {
                    	var pos=$(ui.helper).offset();
                    	//console.log($(this).attr("id"));
						//console.log(pos.left)
                        //console.log(pos.top)
                    }
                });
            }
        });
        //Make element droppable
        $("#frame").droppable({
			drop: function(ev, ui) {
			var obj =  $(ui.draggable).clone();
        $(obj).appendTo($(this));
        $(obj).removeClass('control-group');
        $(obj).addClass('form-element');
            console.log((ui.draggable).clone());
                /*if (ui.helper.attr('id').search(/drag[0-9]/) != -1){
					counter++;
					var element=$(ui.draggable).clone();
					element.addClass("tempclass");
					$(this).append(element);
					$(".tempclass").attr("id","clonediv"+counter);
					$("#clonediv"+counter).removeClass("tempclass");

					//Get the dynamically item id
					draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
					itemDragged = "dragged" + RegExp.$1
					//console.log(itemDragged)

					$("#clonediv"+counter).addClass(itemDragged);
				}*/
        	}
        });
        
        //$('.form-element').on("click",function() {
        $( "body" ).on( "click", ".form-element", function() {
            
            $( ".popover" ).dialog();
        });
    });
	</script>
</head>

<body>

<div id="wrapper" style="width:900px;float:left;padding-left:1px !important;">
	<div id="options" style="width:400px;float:left;">
		<div id="drag1" class="drag">
            <div class="control-group">
                <label for="textinput" class="control-label">Text Input</label>
                <div class="controls">
                  <input type="text" class="form-control" placeholder="placeholder" name="textinput" id="textinput">
                </div>
            </div>
        </div>
		<div id="drag1" class="drag">
            <div class="control-group">
                <label for="textarea" class="control-label">Text Area</label>
            <div class="controls">                     
              <textarea name="textarea"  class="form-control" >default text</textarea>
            </div>
          </div>
        </div> 
		<div id="drag2" class="drag">
            <div class="control-group">
            <label for="radios" class="control-label">Multiple Radios</label>
            <div class="controls">
              <label for="radios-0" class="radio">
                <input type="radio" class="form-control" checked="checked" value="Option one" id="radios-0" name="radios">
                Option one
              </label>
              <label for="radios-1" class="radio">
                <input type="radio" class="form-control" value="Option two" id="radios-1" name="radios">
                Option two
              </label>
            </div>
          </div>
        </div> <!-- end of drag3 -->
        <div id="drag3" class="drag">
            <div class="control-group">
            <label for="selectbasic" class="control-label">Select Basic</label>
            <div class="controls">
              <select class="input-xlarge" class="form-control" name="selectbasic" id="selectbasic">
                <option>Option one</option>
                <option>Option two</option>
              </select>
            </div>
          </div>
        </div> <!-- end of drag4 -->
		<div id="drag4" class="drag">
            <div class="control-group">
            <label for="selectmultiple" class="control-label">Select Multiple</label>
            <div class="controls">
              <select multiple="multiple" class="input-xlarge" name="selectmultiple" id="selectmultiple">
                <option>Option one</option>
                <option>Option two</option>
              </select>
            </div>
          </div>
        </div> <!-- end of drag5 -->	
	</div><!-- end of options -->
	<div id="frame" style="float:right;border:2px solid black; width:400px;height:400px">
		
	</div><!-- end of frame -->
	<div class="popover fade right in" style="display:none;"><div class="arrow"></div><h3 class="popover-title">Text Input</h3><div class="popover-content"><form class="form">
  <div class="controls">
    
      
      
      
      
      
      
      
      
      
      
      
      
    <label class="control-label"> ID / Name </label>
<input type="text" value="textinput" id="id" name="id" data-type="input" class="input-large field">
<label class="control-label"> Label Text </label>
<input type="text" value="Text Input" id="label" name="label" data-type="input" class="input-large field">
<label class="control-label"> Placeholder </label>
<input type="text" value="placeholder" id="placeholder" name="placeholder" data-type="input" class="input-large field">
<label class="control-label"> Help Text </label>
<input type="text" value="help" id="helptext" name="helptext" data-type="input" class="input-large field">
<label class="checkbox control-group">
  <input type="checkbox" id="required" name="required" class="input-inline field" data-type="checkbox">
  Required
</label>


    <hr>
    <button class="btn btn-info" id="save">Save</button><button class="btn btn-danger" id="cancel">Cancel</button>
  </div>
</form>
</div></div>
    
</div><!-- end of wrapper -->
</body>
</html>
