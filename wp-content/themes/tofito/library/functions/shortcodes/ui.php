<?php
$page = htmlentities($_GET['page']);

?>
<!DOCTYPE html>
<head>
	<script type="text/javascript" src="../../../../../../wp-includes/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="../../../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	
	<link rel='stylesheet' href='shortcode.css' type='text/css' media='all' />
<?php
if( $page == 'panel' ){
?>
	<script type="text/javascript">
		var AddPanel = {
			e: '',
			init: function(e) {
				AddPanel.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var PanelType = jQuery('#PanelType').val();
				var PanelTitle = jQuery('#PanelTitle').val();
					var Panelicon = jQuery('#Panelicon').val();
				var PanelContent = jQuery('#PanelContent').val();

				var output = '[panel ';
		
				if(PanelType) {
					output += 'type="'+PanelType+'" ';
				}
				if(PanelTitle) {
					output += 'title="'+PanelTitle+'" ';
				}
				if(Panelicon) {
					output += 'icon="'+icon+'" '; 
				}
				
				output += ']'+PanelContent+'[/panel]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddPanel.init, AddPanel);

	</script>
	<title>Add Panel</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="PanelTitle">Title :</label>
		<input id="PanelTitle" name="PanelTitle" type="text" value="" />
	</p>
    	<p>
		<label for="Panelicon">Icon :</label>
		<input id="Panelicon" name="Panelicon" type="text" value="" />
	</p>
    
	<p>
		<label for="PanelType">Type :</label>
		<select id="PanelType" name="PanelType">
			<option value="regular">Regular</option>
			<option value="callout">Callout</option>
                        <option value="widgets">Widget Style</option>
		</select>
	</p>
	
	<p>
		<label for="PanelContent">Content : </label>
		<textarea id="PanelContent" name="PanelContent" col="20"></textarea>
	</p>
	<p><a class="add" href="javascript:AddPanel.insert(AddPanel.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'featserv' ){
?>
	<script type="text/javascript">
		var FeatServ = {
			e: '',
			init: function(e) {
				FeatServ.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var FSTitle = jQuery('#FSTitle').val();
				var FSicon = jQuery('#FSicon').val();
				var FSContent = jQuery('#FSContent').val();

				var output = '[featserv ';
		
				if(FSTitle) {
					output += 'title="'+FSTitle+'" ';
				}
				if(FSicon) {
					output += 'icon="'+FSicon+'" '; 
				}
				
				output += ']'+FSContent+'[/featserv]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(FeatServ.init, FeatServ);

	</script>
	<title>Featured Services</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="FSTitle">Title :</label>
		<input id="FSTitle" name="FSTitle" type="text" value="" />
	</p>
    	<p>
		<label for="FSicon">Icon :</label>
		<input id="FSicon" name="FSicon" type="text" value="" />
	</p>
    	
	<p>
		<label for="FSContent">Content : </label>
		<textarea id="FSContent" name="FSContent" col="20"></textarea>
	</p>
	<p><a class="add" href="javascript:FeatServ.insert(FeatServ.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'dealpan' ){
?>
	<script type="text/javascript">
		var DealPanel = {
			e: '',
			init: function(e) {
				DealPanel.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var DPTitle = jQuery('#DPTitle').val();
				var DPicon = jQuery('#DPicon').val();
				var DPOffers = jQuery('#DPOffers').val();
				var DPHref = jQuery('#DPHref').val();

				var output = '[dealpan ';
		
				if(DPTitle) {
					output += 'title="'+DPTitle+'" ';
				}
				
				if(DPOffers) {
					output += 'offers="'+DPOffers+'" '; 
				}
				
				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(DealPanel.init, DealPanel);

	</script>
	<title>Deal Panel</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="DPTitle">Title :</label>
		<input id="DPTitle" name="DPTitle" type="text" value="" />
	</p>
  	
	<p>
		<label for="DPOffers">Number Offers  : </label>
		<input id="DPOffers" name="DPOffers" type="text" value="" />
	</p>
   
	<p><a class="add" href="javascript:DealPanel.insert(DealPanel.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'animated' ){
?>
	<script type="text/javascript">
		var animated = {
			e: '',
			init: function(e) {
				animated.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var aAnimate = jQuery('#aAnimate').val();
				var aContent = jQuery('#aContent').val();

				var output = '[animated ';
		
				if(aAnimate) {
					output += 'animate="'+aAnimate+'" ';
				}
				
				output += ']'+aContent+'[/animated]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(animated.init, animated);

	</script>
	<title>Info Table</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="aAnimate">Animate :</label>
		
        
 		<select id="aAnimate" name="aAnimate">
        <optgroup label="Attention Seekers">
          <option value="bounce">bounce</option>
          <option value="flash">flash</option>
          <option value="pulse">pulse</option>
          <option value="rubberBand">rubberBand</option>
          <option value="shake">shake</option>
          <option value="swing">swing</option>
          <option value="tada">tada</option>
          <option value="wobble">wobble</option>
        </optgroup>

        <optgroup label="Bouncing Entrances">
          <option value="bounceIn">bounceIn</option>
          <option value="bounceInDown">bounceInDown</option>
          <option value="bounceInLeft">bounceInLeft</option>
          <option value="bounceInRight">bounceInRight</option>
          <option value="bounceInUp">bounceInUp</option>
        </optgroup>

        <optgroup label="Bouncing Exits">
          <option value="bounceOut">bounceOut</option>
          <option value="bounceOutDown">bounceOutDown</option>
          <option value="bounceOutLeft">bounceOutLeft</option>
          <option value="bounceOutRight">bounceOutRight</option>
          <option value="bounceOutUp">bounceOutUp</option>
        </optgroup>

        <optgroup label="Fading Entrances">
          <option value="fadeIn">fadeIn</option>
          <option value="fadeInDown">fadeInDown</option>
          <option value="fadeInDownBig">fadeInDownBig</option>
          <option value="fadeInLeft">fadeInLeft</option>
          <option value="fadeInLeftBig">fadeInLeftBig</option>
          <option value="fadeInRight">fadeInRight</option>
          <option value="fadeInRightBig">fadeInRightBig</option>
          <option value="fadeInUp">fadeInUp</option>
          <option value="fadeInUpBig">fadeInUpBig</option>
        </optgroup>

        <optgroup label="Fading Exits">
          <option value="fadeOut">fadeOut</option>
          <option value="fadeOutDown">fadeOutDown</option>
          <option value="fadeOutDownBig">fadeOutDownBig</option>
          <option value="fadeOutLeft">fadeOutLeft</option>
          <option value="fadeOutLeftBig">fadeOutLeftBig</option>
          <option value="fadeOutRight">fadeOutRight</option>
          <option value="fadeOutRightBig">fadeOutRightBig</option>
          <option value="fadeOutUp">fadeOutUp</option>
          <option value="fadeOutUpBig">fadeOutUpBig</option>
        </optgroup>

        <optgroup label="Flippers">
          <option value="flip">flip</option>
          <option value="flipInX">flipInX</option>
          <option value="flipInY">flipInY</option>
          <option value="flipOutX">flipOutX</option>
          <option value="flipOutY">flipOutY</option>
        </optgroup>

        <optgroup label="Lightspeed">
          <option value="lightSpeedIn">lightSpeedIn</option>
          <option value="lightSpeedOut">lightSpeedOut</option>
        </optgroup>

        <optgroup label="Rotating Entrances">
          <option value="rotateIn">rotateIn</option>
          <option value="rotateInDownLeft">rotateInDownLeft</option>
          <option value="rotateInDownRight">rotateInDownRight</option>
          <option value="rotateInUpLeft">rotateInUpLeft</option>
          <option value="rotateInUpRight">rotateInUpRight</option>
        </optgroup>

        <optgroup label="Rotating Exits">
          <option value="rotateOut">rotateOut</option>
          <option value="rotateOutDownLeft">rotateOutDownLeft</option>
          <option value="rotateOutDownRight">rotateOutDownRight</option>
          <option value="rotateOutUpLeft">rotateOutUpLeft</option>
          <option value="rotateOutUpRight">rotateOutUpRight</option>
        </optgroup>

        <optgroup label="Specials">
          <option value="hinge">hinge</option>
          <option value="rollIn">rollIn</option>
          <option value="rollOut">rollOut</option>
        </optgroup>

        <optgroup label="Zoom Entrances">
          <option value="zoomIn">zoomIn</option>
          <option value="zoomInDown">zoomInDown</option>
          <option value="zoomInLeft">zoomInLeft</option>
          <option value="zoomInRight">zoomInRight</option>
          <option value="zoomInUp">zoomInUp</option>
        </optgroup>

        <optgroup label="Zoom Exits">
          <option value="zoomOut">zoomOut</option>
          <option value="zoomOutDown">zoomOutDown</option>
          <option value="zoomOutLeft">zoomOutLeft</option>
          <option value="zoomOutRight">zoomOutRight</option>
          <option value="zoomOutUp">zoomOutUp</option>
        </optgroup>
      </select>
      
      
      
	</p>	
	<p>
		<label for="aContent">Content : </label>
		<textarea id="aContent" name="aContent" col="20"></textarea>
	</p>
   
	<p><a class="add" href="javascript:animated.insert(animated.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'reviews' ){
?>
	<script type="text/javascript">
		var Reviews = {
			e: '',
			init: function(e) {
				Reviews.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				
				var output = "[reviewgroup]";
				
				jQuery("input[id^=RevName]").each(function(intIndex, objValue) {
					output +='[review name="'+jQuery(this).val()+'"';						
					var obj_image = jQuery('input[id^=RevImage]').get(intIndex);
					if(obj_image.value)	
						output +=' image="'+obj_image.value+'"';
					var obj_job = jQuery('input[id^=RevJob]').get(intIndex);
					if(obj_job.value)	
						output +=' job="'+obj_job.value+'"';		
					output +=']';					
					var obj = jQuery('textarea[id^=RevContent]').get(intIndex);					
					output += obj.value;					
					output += "[/review]";
				});
				
				output += '[/reviewgroup]';
				
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Reviews.init, Reviews);
		
		jQuery(document).ready(function() {
			jQuery("#add-tab").click(function() {
				jQuery('#TabShortcodeContent').append('<p><label for="RevImage[]">Image :</label><input id="RevImage[]" name="RevImage[]" type="text" value="" /></p><p><label for="RevName[]">Name :</label><input id="RevName[]" name="RevName[]" type="text" value="" /></p><p><label for="RevJob[]">Job :</label><input id="RevJob[]" name="RevJob[]" type="text" value="" />	</p><p><label for="RevContent[]">Content : </label><textarea id="RevContent[]" name="RevContent[]" col="20"></textarea>	</p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Reviews Panel</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="TabShortcodeContent">
	<p>
		<label for="RevImage[]">Image :</label>
		<input id="RevImage[]" name="RevImage[]" type="text" value="" />
	</p>
	<p>
		<label for="RevName[]">Name :</label>
		<input id="RevName[]" name="RevName[]" type="text" value="" />
	</p>    
    <p>
		<label for="RevJob[]">Job :</label>
		<input id="RevJob[]" name="RevJob[]" type="text" value="" />
	</p>	
	<p>
		<label for="RevContent[]">Content : </label>
		<textarea id="RevContent[]" name="RevContent[]" col="20"></textarea>
	</p>
    <hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-tab">+ Add Review</a></strong>
	<p><a class="add" href="javascript:Reviews.insert(Reviews.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'progress' ){
?>
	<script type="text/javascript">
		var AddProgress = {
			e: '',
			init: function(e) {
				AddProgress.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var ProgressType = jQuery('#ProgressType').val();
				var ProgressAnim = jQuery('#ProgressAnim').val();
				var ProgressStyle = jQuery('#ProgressStyle').val();
				var ProgressMeter = jQuery('#ProgressMeter').val();
				var ProgressClass = jQuery('#ProgressClass').val();
				
				var output = '[progressbar ';
		
				if(ProgressType) {
					output += 'type="'+ProgressType+'" ';
				}
				if(ProgressMeter) {
					output += 'meter="'+ProgressMeter+'" ';
				}
				if(ProgressAnim) {
					output += 'animated="'+ProgressAnim+'" ';
				}
				if(ProgressStyle) {
					output += 'style="'+ProgressStyle+'" ';
				}
				if(ProgressClass) {
					output += 'class="'+ProgressClass+'" ';
				}
				
				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddProgress.init, AddProgress);

	</script>
	<title>Add Progress bar</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="ProgressType">Type :</label>
		<select id="ProgressType" name="ProgressType">
			<option value="progress-info">Regular (blue)</option>
			<option value="progress-success">Success (green)</option>
			<option value="progress-danger">Danger (red)</option>
			<option value="progress-warning">Warning (orange)</option>		
		</select>
	</p>
	<p>
		<label for="ProgressStyle">Style :</label>
		<select id="ProgressStyle" name="ProgressStyle">
			<option value="">Regular</option>
			<option value="progress-striped">Striped</option>	
		</select>
	</p>
	<p>
		<label for="ProgressAnim">Animated :</label>
		<select id="ProgressAnim" name="ProgressAnim">
			<option value="">No</option>
			<option value="active">Yes</option>
		</select>
	</p>
	
	<p>
		<label for="ProgressMeter">Progress meter :</label>
		<select id="ProgressMeter" name="ProgressMeter">
			<option value="10">10%</option>
			<option value="20">20%</option>
			<option value="30">30%</option>
			<option value="40">40%</option>
			<option value="50">50%</option>
			<option value="60">60%</option>
			<option value="70">70%</option>
			<option value="80">80%</option>
			<option value="90">90%</option>
			<option value="100">100%</option>
		</select>
	</p>
	<p>
		<label for="ProgressClass">Additional CSS class :</label>
		<input id="ProgressClass" name="ProgressClass" type="text" value="" />
	</p>
	
	<p><a class="add" href="javascript:AddProgress.insert(AddProgress.e)">insert into post</a></p>
</form>
<!--/*************************************/ --> 
<?php } elseif( $page == 'dropdown' ){ ?>

	<script type="text/javascript">
		var DropdownButton = {
			e: '',
			init: function(e) {
				DropdownButton.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[dropbuttongroup";
				var Type = jQuery('#Type').val();
				var Title = jQuery('#Title').val();
				
				if(Type) {
					output+= ' type="'+Type+'"';
				}
				
				if(Title) {
					output+= ' title="'+Title+'"';
				}
				
				output += "]";
				
				jQuery("input[id^=dropbutton_title]").each(function(intIndex, objValue) {
					output +='[dropbutton';
					output += ' title="'+jQuery(this).val()+'"';
					var obj1 = jQuery('input[id^=dropbutton_url]').get(intIndex);
					output += ' url= "'+obj1.value+'"';
					
					var obj2 = jQuery('input[id^=dropbutton_divider]').get(intIndex);
					output += ' divider= "'+obj2.value+'"]';
									
					var obj = jQuery('input[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/dropbutton]";
				});
				
				
				output += '[/dropbuttongroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(DropdownButton.init, DropdownButton);

		jQuery(document).ready(function() {
			jQuery("#add-dropbutton").click(function() {
				jQuery('#DropbuttonShortcodeContent').append('<p><label for="dropbutton_title[]">Item Title</label><input id="dropbutton_title[]" name="dropbutton_title[]" type="text" value="" /></p><p><label for="dropbutton_url[]">Item URL</label><input id="dropbutton_url[]" name="dropbutton_url[]" type="text" value="" /></p><p><label for="Content[]">Item Content</label><input id="Content[]" name="Content[]" type="text" value="" /></p><p><label for="dropbutton_divider[]">Insert divider after item</label><input id="dropbutton_divider[]" name="dropbutton_divider[]" type="checkbox" value="1" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Add Dropdown button</title>

</head>
<body>
<form id="DropbuttonShortcode">
<div id="DropbuttonShortcodeContent">
	<p>
		<label for="Title">Title</label>
		<input id="Title" name="Title" type="text" value="" />
	</p>
	<p>
		<label for="Type">Type :</label>
		<select id="Type" name="Type">
			<option value="">Default</option>
			<option value="split">Split</option>
		</select>		
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
	<p>
		<label for="dropbutton_title[]">Item Title</label>
		<input id="dropbutton_title[]" name="dropbutton_title[]" type="text" value="" />
	</p>
	<p>
		<label for="dropbutton_url[]">Item URL</label>
		<input id="dropbutton_url[]" name="dropbutton_url[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Item Content</label>
		<input id="Content[]" name="Content[]" type="text" value="" />
	</p>
	<p>
		<label for="dropbutton_divider[]">Insert divider after item</label>
		<input id="dropbutton_divider[]" name="dropbutton_divider[]" type="checkbox" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-dropbutton">+ Add Item</a></strong>
	<p><a class="add" href="javascript:DropdownButton.insert(DropdownButton.e)">insert into post</a></p>
</form>
<!--/*************************************/ --> 

<?php
} elseif( $page == 'button' ){
 ?>
 	<script type="text/javascript">
		var AddButton = {
			e: '',
			init: function(e) {
				AddButton.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var ButtonColor = jQuery('#ButtonColor').val();
				var ButtonSize = jQuery('#ButtonSize').val();
				var ButtonLink = jQuery('#ButtonLink').val();
                                var ButtonStatus = jQuery('#ButtonStatus').val();
				var ButtonText = jQuery('#ButtonText').val();
				var ButtonTarget = jQuery('#ButtonTarget').val();
                                var ButtonIcon = jQuery('#ButtonIcon').val();

				var output = '[button ';
				
				if(ButtonColor) {
					output += 'color="'+ButtonColor+'" ';
				}
				if(ButtonSize) {
					output += 'size="'+ButtonSize+'" ';
				}


                                if(ButtonStatus){
                                        output += 'status="'+ButtonStatus+'" ';
                                }

				if(ButtonLink) {
					output += 'link="'+ButtonLink+'" ';
				} 
                                if(ButtonIcon){
                                        output += 'icon="'+ButtonIcon+'" ';
                                }
				if(ButtonTarget) {
					output += 'target="_blank" ';
				}
                               


				output += ']'+ButtonText+'[/button]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddButton.init, AddButton);

	</script>
	<title>Add Buttons</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="ButtonColor">Button Color:</label>
		<select id="ButtonColor" name="ButtonColor">
			<option value="">Default</option>
			<option value="btn-info">Info</option>
			<option value="btn-success">Success</option>
			<option value="btn-warning">Warning</option>
                        <option value="btn-danger">Danger</option>
		</select>
	</p>
	<p>
		<label for="ButtonSize">Button Size :</label>
		<select id="ButtonSize" name="ButtonSize">
			<option value="btn-mini">Tiny</option>
			<option value="btn-small">Small</option>
			<option value="">Medium</option>
			<option value="btn-large">Large</option>
		</select>
	</p>
	
        <p>
		<label for="ButtonStatus">Button Status:</label>
		<select id="ButtonStatus" name="ButtonStatus">
			<option value="">Enabled</option>
			<option value="disabled">Disabled</option>
		</select>
	</p>
       
	<p>
		<label for="ButtonLink">Button Link :</label>
		<input id="ButtonLink" name="ButtonLink" type="text" value="http://" />
	</p>
	<p>
		<label for="ButtonTarget">Open Link in a new window : </label>
		<input id="ButtonTarget" name="ButtonTarget" type="checkbox"  />
	</p>
	</p>
	<p>
		<label for="ButtonText">Button Text :</label>
		<input id="ButtonText" name="ButtonText" type="text" value="" />
	</p>
        <p>
		<label for="ButtonIcon">Button Icon :</label>
		<input id="ButtonIcon" name="ButtonIcon" type="text"/>                
	</p>

	<p><a class="add" href="javascript:AddButton.insert(AddButton.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<!--/*************************************/ -->

<?php } elseif( $page == 'tabs' ){ ?>

	<script type="text/javascript">
		var tabs = {
			e: '',
			init: function(e) {
				tabs.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[tabgroup]";
				
				jQuery("input[id^=tab_title]").each(function(intIndex, objValue) {
					output +='[tab title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/tab]";
				});
				
				
				output += '[/tabgroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(tabs.init, tabs);

		jQuery(document).ready(function() {
			jQuery("#add-tab").click(function() {
				jQuery('#TabShortcodeContent').append('<p><label for="tab_title[]">Tab Title</label><input id="tab_title[]" name="tab_title[]" type="text" value="" /></p><p><label for="Content[]">Tab Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Tabs</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="TabShortcodeContent">
	<p>
		<label for="tab_title[]">Tab Title</label>
		<input id="tab_title[]" name="tab_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Tab Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-tab">+ Add Tab</a></strong>
	<p><a class="add" href="javascript:tabs.insert(tabs.e)">insert into post</a></p>
</form>
<!-- ************************************* -->

<?php } elseif( $page == 'ftabs' ){ ?>

	<script type="text/javascript">
		var ftabs = {
			e: '',
			init: function(e) {
				ftabs.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[ftabgroup]";
				
				jQuery("input[id^=ftab_title]").each(function(intIndex, objValue) {
					output +='[ftab title="'+jQuery(this).val()+'"';
					var obj_icon = jQuery('input[id^=ftab_icon]').get(intIndex);
					output +=' icon="'+obj_icon.value+'"';	
					var obj_name = jQuery('input[id^=ftab_kpname]').get(intIndex);	
					output +=' kpname="'+obj_name.value+'"';
					var obj_kp1 = jQuery('input[id^=ftab_kp01]').get(intIndex);
					var obj_kp2 = jQuery('input[id^=ftab_kp02]').get(intIndex);
					var obj_kp3 = jQuery('input[id^=ftab_kp03]').get(intIndex);
					var obj_kp4 = jQuery('input[id^=ftab_kp04]').get(intIndex);
					var obj_kp5 = jQuery('input[id^=ftab_kp05]').get(intIndex);
					var obj_kp6 = jQuery('input[id^=ftab_kp06]').get(intIndex);
					var obj_kp7 = jQuery('input[id^=ftab_kp07]').get(intIndex);
					var obj_kp8 = jQuery('input[id^=ftab_kp08]').get(intIndex);
					var obj_kp9 = jQuery('input[id^=ftab_kp09]').get(intIndex);
					var obj_kp10 = jQuery('input[id^=ftab_kp10]').get(intIndex);
					var obj_kp11 = jQuery('input[id^=ftab_kp11]').get(intIndex);
					var obj_kp12 = jQuery('input[id^=ftab_kp12]').get(intIndex);	
					if(obj_kp1.value)
						output +=' kp1="'+obj_kp1.value+'"';
					if(obj_kp2.value)
						output +=' kp2="'+obj_kp2.value+'"';	
					if(obj_kp3.value)
						output +=' kp3="'+obj_kp3.value+'"';
					if(obj_kp4.value)
						output +=' kp4="'+obj_kp4.value+'"';	
					if(obj_kp5.value)
						output +=' kp5="'+obj_kp5.value+'"';	
					if(obj_kp6.value)
						output +=' kp6="'+obj_kp6.value+'"';	
								if(obj_kp7.value)
						output +=' kp7="'+obj_kp7.value+'"';
					if(obj_kp8.value)
						output +=' kp8="'+obj_kp8.value+'"';
					if(obj_kp9.value)
						output +=' kp9="'+obj_kp9.value+'"';	
					if(obj_kp10.value)
						output +=' kp10="'+obj_kp10.value+'"';	
					if(obj_kp11.value)
						output +=' kp11="'+obj_kp11.value+'"';	
					if(obj_kp12.value)
						output +=' kp12="'+obj_kp12.value+'"';			
					output +=']';					
					var obj = jQuery('textarea[id^=fContent]').get(intIndex);					
					output += obj.value;					
					output += "[/ftab]";
				});
				
				
				output += '[/ftabgroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(ftabs.init, ftabs);

		jQuery(document).ready(function() {
			jQuery("#add-tab").click(function() {
				jQuery('#TabShortcodeContent').append('<p><label for="ftab_title[]">Tab Title</label><input id="ftab_title[]" name="ftab_title[]" type="text" value="" /></p><p><label for="ftab_icon[]">Tab Icon </label><input id="ftab_icon[]" name="ftab_icon[]" type="text" value="" /></p><p><label for="fContent[]">Tab Content</label><textarea  style="height:100px;  width:400px;" id="fContent[]" name="fContent[]" type="text" value=""></textarea></p><p><label for="ftab_kpname[]">Tab Key Points Name</label><input id="ftab_kpname[]" name="ftab_kpname[]" type="text" value="" /></p><p><label for="ftab_kp01[]">Tab Key Point 1</label><input id="ftab_kp01[]" name="ftab_kp01[]" type="text" value="" /></p><p><label for="ftab_kp02[]">Tab Key Point 2</label><input id="ftab_kp02[]" name="ftab_kp02[]" type="text" value="" /></p><p><label for="ftab_kp03[]">Tab Key Point 3</label>		<input id="ftab_kp03[]" name="ftab_kp03[]" type="text" value="" /></p><p><label for="ftab_kp04[]">Tab Key Point 4</label><input id="ftab_kp04[]" name="ftab_kp04[]" type="text" value="" /></p><p><label for="ftab_kp05[]">Tab Key Point 5</label><input id="ftab_kp05[]" name="ftab_kp05[]" type="text" value="" /></p><p><label for="ftab_kp06[]">Tab Key Point 6</label><input id="ftab_kp06[]" name="ftab_kp06[]" type="text" value="" /></p><p><label for="ftab_kp07[]">Tab Key Point 7</label><input id="ftab_kp07[]" name="ftab_kp07[]" type="text" value="" />	</p><p><label for="ftab_kp08[]">Tab Key Point 8</label><input id="ftab_kp08[]" name="ftab_kp08[]" type="text" value="" /></p><p><label for="ftab_kp09[]">Tab Key Point 9</label>		<input id="ftab_kp09[]" name="ftab_kp09[]" type="text" value="" /></p><p><label for="ftab_kp10[]">Tab Key Point 10</label><input id="ftab_kp10[]" name="ftab_kp10[]" type="text" value="" /></p><p><label for="ftab_kp11[]">Tab Key Point 11</label><input id="ftab_kp11[]" name="ftab_kp11[]" type="text" value="" /></p><p><label for="ftab_kp12[]">Tab Key Point 12</label><input id="ftab_kp12[]" name="ftab_kp12[]" type="text" value="" /></p> <hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add FTabs</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="TabShortcodeContent">
	<p>
		<label for="ftab_title[]">Tab Title</label>
		<input id="ftab_title[]" name="ftab_title[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_icon[]">Tab Icon </label>
		<input id="ftab_icon[]" name="ftab_icon[]" type="text" value="" />
	</p>    
	<p>
		<label for="fContent[]">Tab Content</label>
		<textarea style="height:100px; width:400px;" id="fContent[]" name="fContent[]" type="text" value="" ></textarea>
	</p>
    <p>
		<label for="ftab_kpname[]">Tab Key Points Name</label>
		<input id="ftab_kpname[]" name="ftab_kpname[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp01[]">Tab Key Point 1</label>
		<input id="ftab_kp01[]" name="ftab_kp01[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp02[]">Tab Key Point 2</label>
		<input id="ftab_kp02[]" name="ftab_kp02[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp03[]">Tab Key Point 3</label>
		<input id="ftab_kp03[]" name="ftab_kp03[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp04[]">Tab Key Point 4</label>
		<input id="ftab_kp04[]" name="ftab_kp04[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp05[]">Tab Key Point 5</label>
		<input id="ftab_kp05[]" name="ftab_kp05[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp06[]">Tab Key Point 6</label>
		<input id="ftab_kp06[]" name="ftab_kp06[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp07[]">Tab Key Point 7</label>
		<input id="ftab_kp07[]" name="ftab_kp07[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp08[]">Tab Key Point 8</label>
		<input id="ftab_kp08[]" name="ftab_kp08[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp09[]">Tab Key Point 9</label>
		<input id="ftab_kp09[]" name="ftab_kp09[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp10[]">Tab Key Point 10</label>
		<input id="ftab_kp10[]" name="ftab_kp10[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp11[]">Tab Key Point 11</label>
		<input id="ftab_kp11[]" name="ftab_kp11[]" type="text" value="" />
	</p>
    <p>
		<label for="ftab_kp12[]">Tab Key Point 12</label>
		<input id="ftab_kp12[]" name="ftab_kp12[]" type="text" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-tab">+ Add Tab</a></strong>
	<p><a class="add" href="javascript:ftabs.insert(ftabs.e)">insert into post</a></p>
</form>
<!-- ************************************* -->

<?php } elseif( $page == 'atabs' ){ ?>

	<script type="text/javascript">
		var atabs = {
			e: '',
			init: function(e) {
				atabs.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[atabgroup]";
				
				jQuery("input[id^=atab_title]").each(function(intIndex, objValue) {
					output +='[atab title="'+jQuery(this).val()+'"';
					var obj_icon = jQuery('input[id^=atab_icon]').get(intIndex);
					output +=' icon="'+obj_icon.value+'"';	
					var obj_img = jQuery('input[id^=atab_img]').get(intIndex);
					output +=' image="'+obj_img.value+'"';				
					output +=']';					
					var obj = jQuery('textarea[id^=aContent]').get(intIndex);
					output += obj.value;					
					output += "[/atab]";
				});
				
				
				output += '[/atabgroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(atabs.init, atabs);

		jQuery(document).ready(function() {
			jQuery("#add-tab").click(function() {
				jQuery('#TabShortcodeContent').append('<p><label for="atab_title[]">Tab Title</label><input id="atab_title[]" name="atab_title[]" type="text" value="" /></p><p><label for="atab_icon[]">Tab Icon</label><input id="atab_icon[]" name="atab_icon[]" type="text" value="" /></p><p><label for="atab_img[]">Tab Image</label><input id="atab_img[]" name="atab_img[]" type="text" value="" /></p><p><label for="aContent[]">Tab Content</label><textarea  style="height:100px;  width:400px;" id="aContent[]" name="aContent[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add About Tabs</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="TabShortcodeContent">
	<p>
		<label for="atab_title[]">Tab Title</label>
		<input id="atab_title[]" name="atab_title[]" type="text" value="" />
	</p>
    <p>
		<label for="atab_icon[]">Tab Icon</label>
		<input id="atab_icon[]" name="atab_icon[]" type="text" value="" />
	</p>
    <p>
		<label for="atab_img[]">Tab Image</label>
		<input id="atab_img[]" name="atab_img[]" type="text" value="" />
	</p>
	<p>
		<label for="aContent[]">Tab Content</label>
		<textarea style="height:100px; width:400px;" id="aContent[]" name="aContent[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-tab">+ Add Tab</a></strong>
	<p><a class="add" href="javascript:atabs.insert(atabs.e)">insert into post</a></p>
</form>
<!-- ************************************* -->

<?php } elseif( $page == 'toggle' ){ ?>

	<script type="text/javascript">
		var toggle = {
			e: '',
			init: function(e) {
				toggle.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[togglegroup]";
				
				jQuery("input[id^=toggle_title]").each(function(intIndex, objValue) {
					output +='[toggle title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/toggle]";
				});
				
				
				output += '[/togglegroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(toggle.init, toggle);

		jQuery(document).ready(function() {
			jQuery("#add-toggle").click(function() {
				jQuery('#ToggleShortcodeContent').append('<p><label for="toggle_title[]">Toggle Title</label><input id="toggle_title[]" name="toggle_title[]" type="text" value="" /></p><p><label for="Content[]">Toggle Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Toggle</title>

</head>
<body>
<form id="TogglesShortcode">
<div id="ToggleShortcodeContent">
	<p>
		<label for="toggle_title[]">Toggle Title</label>
		<input id="toggle_title[]" name="toggle_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Toggle Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-toggle">+ Add Toggle</a></strong>
	<p><a class="add" href="javascript:toggle.insert(toggle.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'accordion' ){ ?>

	<script type="text/javascript">
		var accordion = {
			e: '',
			init: function(e) {
				accordion.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[accordiongroup]";
				
				jQuery("input[id^=accordion_title]").each(function(intIndex, objValue) {
					output +='[accordion title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/accordion]";
				});
				
				
				output += '[/accordiongroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(accordion.init, accordion);

		jQuery(document).ready(function() {
			jQuery("#add-accordion").click(function() {
				jQuery('#accordionShortcodeContent').append('<p><label for="accordion_title[]">accordion Title</label><input id="accordion_title[]" name="accordion_title[]" type="text" value="" /></p><p><label for="Content[]">accordion Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add accordion</title>

</head>
<body>
<form id="accordionsShortcode">
<div id="accordionShortcodeContent">
	<p>
		<label for="accordion_title[]">Title</label>
		<input id="accordion_title[]" name="accordion_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-accordion">+ Add accordion tab</a></strong>
	<p><a class="add" href="javascript:accordion.insert(accordion.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'testimonial' ){ ?>
	<script type="text/javascript">
		var Testimonial = {
			e: '',
			init: function(e) {
				Testimonial.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var output = "[testimonialgroup]";
				
				jQuery("input[id^=authorName]").each(function(intIndex, objValue) {
					output +='[testimonial title="'+jQuery(this).val()+'"';
					var obj1 = jQuery('input[id^=authorPosition]').get(intIndex);
					if (obj1) output += ' position="'+obj1.value+'"';
					output += "]";
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/testimonial]";
				});
				
				
				output += '[/testimonialgroup]';
				
				
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Testimonial.init, Testimonial);
		jQuery(document).ready(function() {
			jQuery("#add-testimonial").click(function() {
				jQuery('#testimonialShortcodeContent').append('<p><label for="authorName[]">Author Name</label><input id="authorName[]" name="authorName[]" type="text" value="" /></p><p><label for="authorPosition[]">Author Position</label><input id="authorPosition[]" name="authorPosition[]" type="text" value="" /></p><p><label for="Content[]">Text</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Insert Testimonial</title>

</head>
<body>
<form id="GalleryShortcode">
	<div id="testimonialShortcodeContent">
		<p>
			<label for="authorName[]">Author Name</label>
			<input id="authorName[]" name="authorName[]" type="text" value="" />
		</p>
		<p>
			<label for="authorPosition[]">Author Position</label>
			<input id="authorPosition[]" name="authorPosition[]" type="text" value="" />
		</p>
		<p>
			<label for="Content[]">Text : </label>
			<textarea id="Content[]" name="Content[]" col="20"></textarea>
		</p>
		<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
	</div>
	<strong><a style="cursor: pointer;" id="add-testimonial">+ Add another testimonial</a></strong>
	<p><a class="add" href="javascript:Testimonial.insert(Testimonial.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'accordion' ){ ?>

	<script type="text/javascript">
		var accordion = {
			e: '',
			init: function(e) {
				accordion.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[accordiongroup]";
				
				jQuery("input[id^=accordion_title]").each(function(intIndex, objValue) {
					output +='[accordion title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/accordion]";
				});
				
				
				output += '[/accordiongroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(accordion.init, accordion);

		jQuery(document).ready(function() {
			jQuery("#add-accordion").click(function() {
				jQuery('#accordionShortcodeContent').append('<p><label for="accordion_title[]">accordion Title</label><input id="accordion_title[]" name="accordion_title[]" type="text" value="" /></p><p><label for="Content[]">accordion Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add accordion</title>

</head>
<body>
<form id="accordionsShortcode">
<div id="accordionShortcodeContent">
	<p>
		<label for="accordion_title[]">Title</label>
		<input id="accordion_title[]" name="accordion_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-accordion">+ Add accordion tab</a></strong>
	<p><a class="add" href="javascript:accordion.insert(accordion.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'testimonial' ){ ?>
	<script type="text/javascript">
		var Testimonial = {
			e: '',
			init: function(e) {
				Testimonial.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var authorName = jQuery('#authorName').val();
				var authorPosition = jQuery('#authorPosition').val();
				var Content = jQuery('#Content').val();


				var output = '[testimonial ';
				
				
				if(authorName) {
					output += 'authorname="'+authorName+'" ';
				}
				
				if(authorPosition) {
					output += 'authorposition="'+authorPosition+'" ';
				}

				output += ']'+Content+'[/testimonial]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Testimonial.init, Testimonial);

	</script>
	<title>Insert Testimonial</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="authorName">Author Name</label>
		<input id="authorName" name="authorName" type="text" value="" />
	</p>
	<p>
		<label for="authorPosition">Author Position</label>
		<input id="authorPosition" name="authorPosition" type="text" value="" />
	</p>
	<p>
		<label for="Content">Content : </label>
		<textarea id="Content" name="Content" col="20"></textarea>
	</p>
	
	<p><a class="add" href="javascript:Testimonial.insert(Testimonial.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->


<?php } elseif( $page == 'banner' ){ ?>

	<script type="text/javascript">
		var banner = {
			e: '',
			init: function(e) {
				banner.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
                            
                var alertTitle=jQuery('#alertTitle').val();
				  var alertBg=jQuery('#alertBg').val();
				   var alertUrl=jQuery('#alertUrl').val();
				var bannerType = jQuery('#bannerType').val();
				var Content = jQuery('#Content').val();

				var output = '[banner ';
				
					
				if(alertTitle){
					output+= 'title="'+alertTitle+'" ';
				}
					
					
				if(alertBg){
					output+= 'alertBg="'+alertBg+'" '; 
				}
				
				
					if(alertUrl){
					output+= 'alertUrl="'+alertUrl+'" '; 
				}
				
				
				if(bannerType) {
					output += 'type="'+bannerType+'"';
				}
			
				output += ']'+Content+'[/banner]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(banner.init, banner);

	</script>
	<title>Add Banner box</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="bannerType">Type :</label>
		<select id="bannerType" name="bannerType">
        

            <option value="alert-banner-white">Banner (White)</option>
            <option value="alert-banner-black">Banner (Black)</option>
            <option value="alert-banner-text">Banner (Only text)</option>
		</select>
	</p>
	<p>
		<label for="alertTitle">Title :</label>
		<input type="text" id="alertTitle" name="alertTitle" />
	</p>
    	<p>
		<label for="alertBg">Image url :</label>
		<input type="text" id="alertBg" name="alertBg" />
	</p>
    <p>
		<label for="alertBg">Banner link:</label>
		<input type="text" id="alertUrl" name="alertUrl" />
	</p>
	<p>
		<label for="Content">Content : </label>
		<textarea id="Content" name="Content" col="20"></textarea>
	</p>
	
	
	<p><a class="add" href="javascript:banner.insert(banner.e)">insert into post</a></p>
</form>

<?php } elseif( $page == 'alert' ){ ?>

	<script type="text/javascript">
		var alert = {
			e: '',
			init: function(e) {
				alert.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
                            
                var alertTitle=jQuery('#alertTitle').val();
				  var alertBg=jQuery('#alertBg').val();
				var alertType = jQuery('#alertType').val();
				var Content = jQuery('#Content').val();

				var output = '[alert ';
				
				if(alertTitle){
					output+= 'title="'+alertTitle+'" ';
				}
					
				if(alertBg){
					output+= 'alertBg="'+alertBg+'" '; 
				}
				if(alertType) {
					output += 'type="'+alertType+'"';
				}
			
				output += ']'+Content+'[/alert]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(alert.init, alert);

	</script>
	<title>Add Alert box</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="alertType">Type :</label>
		<select id="alertType" name="alertType">
        
			<option value="alert-block">Default (orange)</option>
			<option value="alert-success">Success (Green)</option>
			<option value="alert-error">Error (Red)</option>
			<option value="alert-info">Info (blue)</option>

		</select>
	</p>
	<p>
		<label for="alertTitle">Title :</label>
		<input type="text" id="alertTitle" name="alertTitle" />
	</p>
    	
	<p>
		<label for="Content">Content : </label>
		<textarea id="Content" name="Content" col="20"></textarea>
	</p>
	
	
	<p><a class="add" href="javascript:alert.insert(alert.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->








<?php } elseif( $page == 'video' ){ ?>

	<script type="text/javascript">
		var Video = {
			e: '',
			init: function(e) {
				Video.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var site = jQuery('#site').val();
				var id = jQuery('#id').val();
				var width = jQuery('#width').val();
				var height = jQuery('#height').val();
				var autoplay = jQuery('#autoplay').val();

				var output = '[video ';
				
				if(id) {
					output += 'id="'+id+'" ';
				}
				
				if(site) {
					output += ' site="'+site+'" ';
				}
				
				if(width) {
					output += ' width="'+width+'" ';
				}
				if(height) {
					output += ' height="'+height+'" ';
				}
				
				if(autoplay) {
					output += ' autoplay="'+autoplay+'" ';
				}

				output += ' /]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Video.init, Video);

	</script>
	<title>Add Video</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="site">Website : </label>
		<select id="site" name="site">
			<option value="youtube">Youtube</option>
			<option value="vimeo">Vimeo</option>
			<option value="dailymotion">Dailymotion</option>
			<option value="bliptv">BlipTV</option>
			<option value="veoh">Veoh</option>
			<option value="viddler">Viddler</option>
		</select>
	</p>
	<p>
		<label for="id">Id (Copy the ID from video URL here) :</label>
		<input id="id" name="id" type="text" value="" />
	</p>
	<p>
		<label for="width">Width :</label>
		<input style="width:40px;" id="width" name="width" type="text" value="" />
	</p>
	<p>
		<label for="height">Height :</label>
		<input style="width:40px;"  id="height" name="height" type="text" value="" />
	</p>
	<p>
		<label for="autoplay">Autoplay : </label>
		<select id="autoplay" name="autoplay">
			<option value="0">No</option>
			<option value="1">Yes</option>
		</select>
	</p>
	
	<p><a class="add" href="javascript:Video.insert(Video.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'audio' ){ ?>

	<script type="text/javascript">
		var AddAudio = {
			e: '',
			init: function(e) {
				AddAudio.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				
				var title = jQuery('#audioTitle').val();
				var poster = jQuery('#audioPoster').val();
				var mp3Url = jQuery('#mp3Url').val();
				var m4aUrl = jQuery('#m4aUrl').val();
				var oggUrl = jQuery('#oggUrl').val();
				
				var output = '[audio ';
				
				if(title) {
					output += 'title="'+title+'" ';
				}	
				if(poster) {
					output += ' poster="'+poster+'" ';
				}	
				if(mp3Url) {
					output += ' mp3="'+mp3Url+'" ';
				}				
				if(m4aUrl) {
					output += ' m4a="'+m4aUrl+'" ';
				}				
				if(oggUrl) {
					output += ' ogg="'+oggUrl+'" ';
				}

				output += ' /]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddAudio.init, AddAudio);

	</script>
	<title>Add Native audio</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="audioTitle">Title : </label>
		<input id="audioTitle" name="audioTitle" type="text" value="" />
	</p>
	<p>
		<label for="audioPoster">Poster image : </label>
		<input id="audioPoster" name="audioPoster" type="text" value="" />
	</p>
	<p>
		<label for="mp3Url">Mp3 file Url : </label>
		<input id="mp3Url" name="mp3Url" type="text" value="" />
	</p>
	<p>
		<label for="m4aUrl">M4A file Url : </label>
		<input id="m4aUrl" name="m4aUrl" type="text" value="" />
	</p>
	<p>
		<label for="oggUrl">OGG file Url : </label>
		<input id="oggUrl" name="oggUrl" type="text" value="" />
	</p>

	
	<p><a class="add" href="javascript:AddAudio.insert(AddAudio.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'shvideo' ){ ?>

	<script type="text/javascript">
		var shVideo = {
			e: '',
			init: function(e) {
				shVideo.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				
				var title = jQuery('#videoTitle').val();
				var poster = jQuery('#videoPoster').val();
				var mp4Url = jQuery('#mp4Url').val();
				var m4vUrl = jQuery('#m4vUrl').val();
				var ogvUrl = jQuery('#ogvUrl').val();

				var output = '[shvideo ';
				
				if(title) {
					output += 'title="'+title+'" ';
				}	
				if(poster) {
					output += ' poster="'+poster+'" ';
				}	
				if(mp4Url) {
					output += 'mp4="'+mp4Url+'" ';
				}				
				if(m4vUrl) {
					output += 'm4v="'+m4vUrl+'" ';
				}				
				if(ogvUrl) {
					output += 'ogv="'+ogvUrl+'" ';
				}

				output += ' /]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(shVideo.init, shVideo);

	</script>
	<title>Add Native video</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="videoTitle">Title : </label>
		<input id="videoTitle" name="videoTitle" type="text" value="" />
	</p>
	<p>
		<label for="videoPoster">Poster image : </label>
		<input id="videoPoster" name="videoPoster" type="text" value="" />
	</p>
	<p>
		<label for="mp4Url">Mp4 file Url : </label>
		<input id="mp4Url" name="mp4Url" type="text" value="" />
	</p>
	<p>
		<label for="m4vUrl">M4V file Url : </label>
		<input id="m4vUrl" name="m4vUrl" type="text" value="" />
	</p>
	<p>
		<label for="ogvUrl">OGV file Url : </label>
		<input id="ogvUrl" name="ogvUrl" type="text" value="" />
	</p>

	
	<p><a class="add" href="javascript:shVideo.insert(shVideo.e)">insert into post</a></p>
</form>

<!--/*************************************/ -->


<?php } elseif( $page == 'slider' ){ ?>
	
	<script type="text/javascript">
		var Slider = {
			e: '',
			init: function(e) {
				Slider.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[slider ";
				
				
				output += "]";
				
				jQuery("textarea[id^=slide_title]").each(function(intIndex, objValue) {
					var obj = jQuery('input[id^=slide_image]').get(intIndex);
                                        output +='[slideritem image="'+ obj.value +'"]'+jQuery(this).val();
					
					output += "[/slideritem]";
				});
				
				
				output += '[/slider]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Slider.init, Slider);

		jQuery(document).ready(function() {
			jQuery("#add-slide").click(function() {
				jQuery('#SlideShortcodeContent').append('<p><label for="slide_image[]">Slide Image URL</label><input id="slide_image[]" name="slide_image[]" type="text" value="http://" /></p><p><label for="slide_title[]">Slide overlay text</label><textarea id="slide_title[]" name="slide_title[]" cols="10"></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Add Slider</title>

</head>
<body>

<form id="SliderShortcode">
<div id="SlideShortcodeContent">
	<p>
		<label for="slide_image[]">Slide Image URL</label>
		<input id="slide_image[]" name="slide_image[]" type="text" value="" />
	</p>
	
	<p>
		<label for="slide_title[]">Slide overlay Text:</label>
		<textarea id="slide_title[]" name="slide_title[]"  cols="10" ></textarea>
	</p>
	
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-slide">+ Add Slide</a></strong>
	<p><a class="add" href="javascript:Slider.insert(Slider.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'oslider' ){ ?>
	
	<script type="text/javascript">
		var Oslider = {
			e: '',
			init: function(e) {
				Oslider.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[oslider ";
				var interval = jQuery('#interval').val();
				
				if(interval) {
					output += 'interval="'+interval+'"';
				}
				
				output += "]";
				
				jQuery("input[id^=slide_title]").each(function(intIndex, objValue) {
					output +='[oslideritem title="'+jQuery(this).val()+'"';
					var obj = jQuery('input[id^=slide_image]').get(intIndex);
					output += ' image="'+ obj.value +'"]';
					output += "[/oslideritem]";
				});
				
				
				output += '[/oslider]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Oslider.init, Oslider);

		jQuery(document).ready(function() {
			jQuery("#add-slide").click(function() {
				jQuery('#SlideShortcodeContent').append('<p><label for="slide_title[]">Slide Title</label><input id="slide_title[]" name="slide_title[]" type="text" value="" /></p><p><label for="slide_image[]">Slide Image URL</label><input id="slide_image[]" name="slide_image[]" type="text" value="http://" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Add Orbit Slider</title>

</head>
<body>

<form id="SliderShortcode">
<div id="SlideShortcodeContent">
	<p>
		<label for="interval">Interval (in milliseconds)</label>
		<input id="interval" name="interval" type="text" value="4000" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
	<p>
		<label for="slide_title[]">Slide Title</label>
		<input id="slide_title[]" name="slide_title[]" type="text" value="" />
	</p>
	<p>
		<label for="slide_image[]">Slide Image URL</label>
		<input id="slide_image[]" name="slide_image[]" type="text" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-slide">+ Add Slide</a></strong>
	<p><a class="add" href="javascript:Oslider.insert(Oslider.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'carousel' ){ ?>
	
	<script type="text/javascript">
		var Carousel = {
			e: '',
			init: function(e) {
				Carousel.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[carousel ";
				var title = jQuery('#carouselTitle').val();
				var type = jQuery('#carouselType').val();
				var auto = jQuery('#carouselAuto').val();
				var min = jQuery('#carouselMin').val();
				var max = jQuery('#carouselMax').val();
				
				if(title) {
					output += 'title="'+title+'"';
				}
				if(type) {
					output += ' type="'+type+'"';
				}
				if(auto) {
					output += ' automatic="'+auto+'"';
				}
				if(min) {
					output += ' min="'+min+'"';
				}
				if(max) {
					output += ' max="'+max+'"';
				}
				output += "]";
				
				jQuery("textarea[id^=carousel_content]").each(function(intIndex, objValue) {
					output +='[caritem]'+jQuery(this).val()+'[/caritem]';
				});
				
				output += '[/carousel]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Carousel.init, Carousel);

		jQuery(document).ready(function() {
			jQuery("#add-carousel").click(function() {
				jQuery('#SlideShortcodeContent').append('<p><label for="carousel_content[]">Slide Content</label><textarea style="height:100px; width:400px;" id="carousel_content[]" name="carousel_content[]" type="text" value="" ></textarea></p>');
			});
		});
		
	</script>
	<title>Add Carousel slide</title>

</head>
<body>

<form id="CarouselShortcode">
<div id="SlideShortcodeContent">
	<p>
		<label for="carouselTitle">Carousel title</label>
		<input id="carouselTitle" name="carouselTitle" type="text" value="" />
	</p>
	<p>
		<label for="carouselType">Carousel type</label>
		<select id="carouselType" name="carouselType">
			<option value="logo_slide">Logo slider</option>
			<option value="custom_slide">Custom content</option>
		</select>
	</p>
	<p>
		<label for="carouselAuto">Automatic sliding</label>
		<select id="carouselAuto" name="carouselAuto">
			<option value="false">No</option>
			<option value="true">Yes</option>
		</select>
	</p>
	
	<p>
		<label for="carouselMin">Min. visible items</label>
		<input id="carouselMin" name="carouselMin" type="text" value="1" />
	</p>
	<p>
		<label for="carouselMax">Max. visible items</label>
		<input id="carouselMax" name="carouselMax" type="text" value="6" />
	</p>
	<p>
		<label for="carousel_content[]">Slide Content</label>
		<textarea style="height:100px; width:400px;" id="carousel_content[]" name="carousel_content[]" type="text" value="" ></textarea>
	</p>
</div>
	<strong><a style="cursor: pointer;" id="add-carousel">+ Add slide</a></strong>
	<p><a class="add" href="javascript:Carousel.insert(Carousel.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'contacts' ){ ?>
	<script type="text/javascript">
		
		var Contact = {
			e: '',
			init: function(e) {
				Contact.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				
				var output = "[contactgroup]";
				
				jQuery("input[id^=Contactname]").each(function(intIndex, objValue) {
					output +='[contact';
					var obj_avatar = jQuery('input[id^=Avatar]').get(intIndex);
					if(obj_avatar.value)
						output +=' avatar="'+obj_avatar.value+'"';
					output +=' name="'+jQuery(this).val()+'"';						
					var obj_postition = jQuery('input[id^=postition]').get(intIndex);
					if(obj_postition.value)	
						output +=' postition="'+obj_postition.value+'"';
					var obj_skill = jQuery('select[id^=ContactSkill]').get(intIndex);
					if(obj_skill.value)
						output +=' skill="'+obj_skill.value+'"';	
					var obj_fb = jQuery('input[id^=Contactfb]').get(intIndex);	
					if(obj_fb.value)
						output +=' fb="'+obj_fb.value+'"';
					var obj_twitter = jQuery('input[id^=Contacttwitter]').get(intIndex);	
					if(obj_twitter.value)
						output +=' twitter="'+obj_twitter.value+'"';
					var obj_google = jQuery('input[id^=Contactgoogle]').get(intIndex);	
					if(obj_google.value)
						output +=' google="'+obj_google.value+'"';
					var obj_linkedin = jQuery('input[id^=Contactlinkedin]').get(intIndex);	
					if(obj_linkedin.value)
						output +=' linkedin="'+obj_linkedin.value+'"';			
					output +=']';					
					var obj = jQuery('textarea[id^=Contactcontent]').get(intIndex);					
					output += obj.value;					
					output += "[/contact]";
				});
				
				output += '[/contactgroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Contact.init, Contact);
		
		jQuery(document).ready(function() {
			jQuery("#add-tab").click(function() {
				jQuery('#TabShortcodeContent').append('<p><label for="Avatar[]">Avatar</label><input id="Avatar[]" name="Avatar[]" type="text" value="" /></p><p><label for="Contactname[]">Name</label><input id="Contactname[]" name="Contactname[]" type="text" value="" /></p><p><label for="postition[]">Position</label><input id="postition[]" name="postition[]" type="text" value="" /></p><p><label for="Contactcontent[]">Content : </label><textarea id="Contactcontent[]" name="Contactcontent[]" col="20" style="width:200px; height:50px"></textarea></p><p><label for="ContactSkill[]">Skill :</label><select id="ContactSkill[]" name="ContactSkill[]"><option value="10">10%</option>			<option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select></p><p><label for="Contactfb[]">Facebook</label><input id="Contactfb[]" name="Contactfb[]" type="text" value="" />	</p><p><label for="Contacttwitter[]">Twitter</label><input id="Contacttwitter[]" name="Contacttwitter[]" type="text" value="" />	</p><p><label for="Contactgoogle[]">Google+</label><input id="Contactgoogle[]" name="Contactgoogle[]" type="text" value="" /></p><p><label for="Contactlinkedin[]">Linkedin</label><input id="Contactlinkedin[]" name="Contactlinkedin[]" type="text" value="" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Insert contact details</title>


</head>
<body>

<form id="GalleryShortcode">
<div id="TabShortcodeContent">
	<p>
		<label for="Avatar[]">Avatar</label>
		<input id="Avatar[]" name="Avatar[]" type="text" value="" />
	</p>
    <p>
		<label for="Contactname[]">Name</label>
		<input id="Contactname[]" name="Contactname[]" type="text" value="" />
	</p>
	<p>
		<label for="postition[]">Position</label>
		<input id="postition[]" name="postition[]" type="text" value="" />
	</p>	
	<p>
		<label for="Contactcontent[]">Content : </label>
		<textarea id="Contactcontent[]" name="Contactcontent[]" col="20" style="width:200px; height:50px"></textarea>
	</p>
    <p>
    	<label for="ContactSkill[]">Skill :</label>
		<select id="ContactSkill[]" name="ContactSkill[]">
			<option value="10">10%</option>
			<option value="20">20%</option>
			<option value="30">30%</option>
			<option value="40">40%</option>
			<option value="50">50%</option>
			<option value="60">60%</option>
			<option value="70">70%</option>
			<option value="80">80%</option>
			<option value="90">90%</option>
			<option value="100">100%</option>
		</select>
    </p>
    <p>
		<label for="Contactfb[]">Facebook</label>
		<input id="Contactfb[]" name="Contactfb[]" type="text" value="" />
	</p>
	<p>
		<label for="Contacttwitter[]">Twitter</label>
		<input id="Contacttwitter[]" name="Contacttwitter[]" type="text" value="" />
	</p>
	<p>
		<label for="Contactgoogle[]">Google+</label>
		<input id="Contactgoogle[]" name="Contactgoogle[]" type="text" value="" />
	</p>
    <p>
		<label for="Contactlinkedin[]">Linkedin</label>
		<input id="Contactlinkedin[]" name="Contactlinkedin[]" type="text" value="" />
	</p>
    <hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-tab">+ Add Contact</a></strong>
	<p><a class="add" href="javascript:Contact.insert(Contact.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='fblock') {?>
    <script type="text/javascript">
        var fblock={
            e: '',
            init: function(e){
                fblock.e=e,
                tinyMCEPopup.resizeToInnerSize();
            },
            insert: function createGalleryShortcode(e){
                var Icon=jQuery('#fblockIcon').val();
                var Link=jQuery('#fblockLink').val();
                var Content=jQuery('#fblockContent').val();
                
                var output='[fblock';
                if(Icon){
                    output+=' icon="'+Icon+'"';
                }
                if(Link){
                    output+=' link="'+Link+'"';
                }
                
                output+=']'+Content+'[/fblock]';
                tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		tinyMCEPopup.close();
            }
        }
        tinyMCEPopup.onInit.add(fblock.init, fblock);
    </script>
    <title>Insert Featured Block</title>
</head>
<body>
    <form id="GalleryShortcode">
         <p>
            <label for="fblockIcon">Block Image url:</label>
            <input type="text" id="fblockIcon">
        </p>
        <p>
            <label for="fblockLink">Block Link To:</label>
            <input type="text" id="fblockLink">
        </p>
        <p>
            <label for="fblockContent">Block Content:</label>
            <textarea id="fblockContent" cols="10"></textarea>
        </p>
        
        <p><a class="add" href="javascript:fblock.insert(fblock.e)">insert into post</a></p>
        
    </form>
<!--/*************************************/ -->

<?php } elseif($page=='tblock'){ ?>
<script type="text/javascript">
    var tblock={
        e:'',
        init:function(e){
            tblock.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert:function createGalleryShortcode(e){
            var Title=jQuery('#tblockTitle').val();
			var Content=jQuery('#tblockContent').val();
            
            var output='[tblock';
            if(Title){
                output+=' title="'+Title+'"';
            }
           
            output+=']'+Content+'[/tblock]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(tblock.init, tblock);
</script>
<title>Add Title Block</title>
</head>
<body>
    <form id="GalleryShortcode">
        <p>
            <label for="tblockTitle">Block Title:</label>
            <input type="text" id="tblockTitle">
        </p>
        <p>
            <label for="tblockContent">Block Content:</label>
            <textarea id="tblockContent" cols="10"></textarea>
        </p>
        <p><a class="add" href="javascript:tblock.insert(tblock.e)">insert into post</a></p>
        
    </form>
<!--/*************************************/ -->

<?php } elseif($page=='oblock'){ ?>
<script type="text/javascript">
    var oblock={
        e:'',
        init:function(e){
            oblock.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert:function createGalleryShortcode(e){
            var Title=jQuery('#oblockTitle').val();
            var Content=jQuery('#oblockContent').val();
			 
            var output='[oblock';
            if(Title){
                output+=' title="'+Title+'"';
            }
           
            output+=']'+Content+'[/oblock]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(oblock.init, oblock);
</script>
<title>Add Title Block Simple</title>
</head>
<body>
    <form id="GalleryShortcode">
        <p>
            <label for="oblockTitle">Block Title:</label>
            <input type="text" id="oblockTitle">
        </p>
        <p>
            <label for="oblockContent">Block Content:</label>
            <textarea id="oblockContent" cols="10"></textarea>
        </p>
        <p><a class="add" href="javascript:oblock.insert(oblock.e)">insert into post</a></p>
        
    </form>
<!--/*************************************/ -->

<?php } elseif($page=='brandblock'){ ?>
<script type="text/javascript">
    var brandblock={
        e:'',
        init:function(e){
            brandblock.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert:function createGalleryShortcode(e){
            var Url=jQuery('#brandUrl').val();
			var Img=jQuery('#brandImage').val();
            
            var output='[brandblock';
            if(Url){
                output+=' url="'+Url+'"';
            }
			if(Img){
                output+=' image="'+Img+'"';
            }
           
            output+='/]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(brandblock.init, brandblock);
</script>
<title>Add Brand Block</title>
</head>
<body>
    <form id="GalleryShortcode">
        <p>
            <label for="brandUrl">Url:</label>
            <input type="text" id="brandUrl">
        </p>
        <p>
            <label for="brandImage">Image:</label>
            <input type="text" id="brandImage">
        </p>
        <p><a class="add" href="javascript:brandblock.insert(brandblock.e)">insert into post</a></p>
        
    </form>
<!--/*************************************/ -->

<?php } elseif($page=='reveal') { ?>
<script type="text/javascript">
    var reveal={
        e:'',
        init:function(e){
            reveal.e=e;
            tinyMcePopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
            var ButtonColor = jQuery('#ButtonColor').val();
            var Buttonsize = jQuery('#Buttonsize').val();
            var Buttontext = jQuery('#Buttontext').val();
            
            var RevTitle = jQuery('#revTitle').val();
            var RevContent = jQuery('#revContent').val();
            
            var output = '[reveal';
            if(ButtonColor) {
                output += ' color="'+ButtonColor+'" ';
            }
            if(Buttonsize) {
                output += ' size="'+Buttonsize+'" ';
            }
            if(Buttontext){
                output+=' button="'+Buttontext+'"';
            }

            if(RevTitle){
                output+=' revtitle="'+RevTitle+'"';
            }
            

            output += ']'+RevContent+'[/reveal]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
	
	}
}
tinyMCEPopup.onInit.add(reveal.init, reveal);

</script>
<title>Add Modal Box</title>
</head>
<body>
    <form id="GalleryShortcode">
	<p>
		<label for="ButtonColor">Color:</label>
		<select id="ButtonColor" name="ButtonColor">
			<option value="">Default</option>
			<option value="btn-info">Info</option>
			<option value="btn-success">Success</option>
			<option value="btn-alert">Alert</option>
		</select>
	</p>
	<p>
		<label for="Buttonsize">Button Size :</label>
		<select id="Buttonsize" name="Buttonsize">
			<option value="btn-mini">Tiny</option>
			<option value="btn-small">Small</option>
			<option value="">Medium</option>
			<option value="btn-large">Large</option>
		</select>
        </p>
	
	<p>
		<label for="Buttontext">Button Text :</label>
		<input id="Buttontext" name="Buttontext" type="text" value="" />
	</p>
        <hr>
        
        <p>
            <label for="revTitle">Modal Box Title</label>
            <input type="text" id="revTitle" name="revTitle">
        </p>
        <p>
            <label for="revContent">Modal Box Content</label>
            <textarea id="revContent" name="revContent" col="10"></textarea>
        </p>

	<p><a class="add" href="javascript:reveal.insert(reveal.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='popover') { ?>
<script type="text/javascript">
    var popover={
        e:'',
        init:function(e){
            popover.e=e;
            tinyMcePopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
			
            var PopIcon = jQuery('#popIcon').val();
            var PopTitle = jQuery('#popTitle').val();			
            var PopContent = jQuery('#popContent').val();
            
            var output = '[popover';
            			
			if(PopIcon){
                output+=' icon="'+PopIcon+'"';
            }
            if(PopTitle){
                output+=' title="'+PopTitle+'"';
            }
            

            output += ']'+PopContent+'[/popover]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
	
	}
}
tinyMCEPopup.onInit.add(popover.init, popover);

</script>
<title>Add Popover Box</title>
</head>
<body>
    <form id="GalleryShortcode">
	        
        <p>
            <label for="popIcon">Modal Box Icon</label>
            <input type="text" id="popIcon" name="popIcon">
        </p>
        <p>
            <label for="popTitle">Modal Box Title</label>
            <input type="text" id="popTitle" name="popTitle">
        </p>
        <p>
            <label for="popContent">Modal Box Content</label>
            <textarea id="popContent" name="popContent" col="10"></textarea>
        </p>

	<p><a class="add" href="javascript:popover.insert(popover.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='tooltip') { ?>
<script type="text/javascript">
    var tooltip={
        e:'',
        init: function(e){
            tooltip.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
            var ToolContent=jQuery('#tooltipContent').val();
            var Text=jQuery('#text').val();
            
            var output='[tooltip ';
           
            if(Text){
                output+='text="'+Text+'" ';
            }
            output+=']'+ToolContent+'[/tooltip]'
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
	
	}
}
tinyMCEPopup.onInit.add(tooltip.init, tooltip);
</script>
<title>Add Tooltip</title>
</head>
<body>
    <form id="GalleryShortcode">
        <p>
            <label for="text">The text of which is assigned Tooltip</label>
            <input type="text" id="text" name="text" >
        </p>
	
        <p>
            <label for="tooltipContent">Tooltip Content</label>
            <textarea  id="tooltipContent" name="tooltipContent" col="20"></textarea>
        </p>
       
        <p><a class="add" href="javascript:tooltip.insert(tooltip.e)">insert into post</a></p>
</form>




<?php } elseif($page=='portlisting') { ?>

	<script type="text/javascript">
		var portlisting = {
			e: '',
			init: function(e) {
				portlisting.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var title = jQuery('#portfolioTitle').val();
				var limit = jQuery('#portfolioLimit').val();
				var featured = jQuery('#portfolioFeatured').val();

				var output = '[portlist ';
				
				if(title) {
					output += 'title="'+title+'"';
				}
				if(limit) {
					output += ' limit="'+limit+'"';
				}
				
				if(featured) {
					output += ' featured="'+featured+'"';
				}

				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(portlisting.init, portlisting);

	</script>
	<title>Add Portfolio Listing</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="portfolioTitle">Title</label>
		<input id="portfolioTitle" name="portfolioTitle" type="Text" value="Recent Work" />
	</p>
	<p>
		<label for="portfolioLimit">Items limit</label>
		<input id="portfolioLimit" name="portfolioLimit" type="Text" value="6" />
	</p>
	<p>
		<label for="portfolioFeatured">Type of items to show</label>
		<select id="portfolioFeatured" name="portfolioFeatured">
			<option value="0">All items</option>
			<option value="1">Only featured items</option>
		</select>
	</p>
	
	<p><a class="add" href="javascript:portlisting.insert(portlisting.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='bloglisting') { ?>



	<script type="text/javascript">
		var blogList = {
			e: '',
			init: function(e) {
				blogList.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var title = jQuery('#blogTitle').val();
				var limit = jQuery('#blogLimit').val();
				var category = jQuery('#blogCategory').val();
				var type = jQuery('#blogLayout').val();
				var order = jQuery('#blogOrder').val();
				var orderby = jQuery('#blogOrderby').val();

				var output = '[list_posts ';
				
				if(title) {
					output += 'title="'+title+'"';
				}
				if(limit) {
					output += ' limit="'+limit+'"';
				}
				if(category) {
					output += ' category="'+category+'"';
				}
				if(type) {
					output += ' type="'+type+'"';
				}
				if(order) {
					output += ' order="'+order+'"';
				}
				if(orderby) {
					output += ' orderby="'+orderby+'"';
				}

				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(blogList.init, blogList);

	</script>
	<title>Add blog Listing</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="blogTitle">Title</label>
		<input id="blogTitle" name="blogTitle" type="Text" value="Latest from the blog" />
	</p>
	<p>
		<label for="blogLimit">Items limit</label>
		<input id="blogLimit" name="blogLimit" type="Text" value="5" />
	</p>
	<p>
		<label for="blogCategory">Category</label>
		<input id="blogCategory" name="blogCategory" type="Text" value="" />
		<br /><small style="margin-left:150px">Specify category Id or leave blank to display items from all categories.</small>
	</p>
	<p>
		<label for="blogLayout">Type of layout</label>
		<select id="blogLayout" name="blogLayout">
			<option value="1">Carousel (1 item shown at a time, with sliding)</option>
			<option value="2">Regular listing (with image thumbs)</option>
		</select>
	</p>
	<p>
		<label for="blogOrder">Posts order</label>
		<select id="blogOrder" name="blogOrder">
			<option value="DESC">Descending</option>
			<option value="ASC">Ascending</option>
		</select>
	</p>
	<p>
		<label for="blogOrderby">Order by:</label>
		<select id="blogOrderby" name="blogOrderby">
			<option value="date">Date</option>
			<option value="id">ID</option>
			<option value="author">Author</option>
			<option value="title">Title</option>
			<option value="comment_count">Number of comments</option>
			<option value="rand">Randomly</option>
		</select>
	</p>
	
	<p><a class="add" href="javascript:blogList.insert(blogList.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='social') { ?>
<script type="text/javascript">
    var social={
        e:'',
        init:function(e){
            social.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert: function createGalleryShortCode(e){
            
            var Icon=jQuery('#icon').val();
            var Link=jQuery('#link').val();
            
            var output = '[social]';
            jQuery("select[id^=icon]").each(function(intIndex, objValue) {
		output +='[soc_button icon="'+jQuery(this).val()+'"';
		var obj = jQuery('input[id^=link]').get(intIndex);
		output += ' link="'+obj.value+'" ';
		output += "/]";
            });
				
            output += '[social/]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(social.init, social);
    jQuery(document).ready(function() {
        jQuery("#add-social").click(function() {
            jQuery('#SocShortcodeContent').append('<p><label for="icon[]">Social Button</label><select id="icon[]" name="icon[]"><option value="rss">RSS</option><option value="fb">Facebook</option><option value="twet">Twitter</option><option value="google">Google+</option><option value="pin">Pinterest</option></select></p><p><label for="link[]">Link to:</label><input type="text" id="link[]" name="link[]"></p><hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
    });
    });
</script>
<title>Add Social Button</title>
</head>
<body>
    <form id="GalleryShortcode">
        <div id="SocShortcodeContent">
            <p>
            <label for="icon[]">Social Button</label>
            <select id="icon[]" name="icon[]">
                <option value="rss">RSS</option>
                <option value="fb">Facebook</option>
                <option value="twet">Twitter</option>
                <option value="google">Google+</option>
                <option value="pin">Pinterest</option>
            </select>
            </p>
            <p>
                <label for="link[]">Link to (without http):</label>
                <input type="text" id="link[]" name="link[]">
            </p>
            <p>
                <hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />  
            </p>
        </div>
        <strong><a style="cursor: pointer;" id="add-social">+ Add Social Button</a></strong>
        <p>
            <a class="add" href="javascript:social.insert(social.e)">Insert into post</a>
        </p>
    </form>
<!--/*************************************/ -->

<?php } elseif($page=='sidenav') { ?>


<script type="text/javascript">
		var sidenav = {
			e: '',
			init: function(e) {
				sidenav.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[sidenav]";
				
				jQuery("input[id^=pageLink]").each(function(intIndex, objValue) {
					output +='[sideitem link="'+jQuery(this).val()+'"]';
					var obj = jQuery('input[id^=pageName]').get(intIndex);
					output += obj.value;
					output += "[/sideitem]";
				});
				
				
				output += '[/sidenav]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(sidenav.init, sidenav);

		jQuery(document).ready(function() {
			jQuery("#add-sideitem").click(function() {
				jQuery('#SideItemShortcodeContent').append('<p><label for="pageName[]">Menu Item Name</label><input id="pageName[]" name="pageName[]" type="text" value="" /></p><p><label for="pageLink[]">Menu Item Link</label><input  id="pageLink[]" name="pageLink[]" type="text" value="" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Side Navigation</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="SideItemShortcodeContent">
	<p>
		<label for="pagName[]">Menu Item Name</label>
		<input id="pageName[]" name="pageName[]" type="text" value="" />
	</p>
	<p>
		<label for="pageLink[]">Menu Item Link</label>
		<input  id="pageLink[]" name="pageLink[]" type="text" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-sideitem">+ Add Navigation Item</a></strong>
	<p><a class="add" href="javascript:sidenav.insert(sidenav.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='joyride') { ?>

<script type="text/javascript">
    var joyride={
        e:'',
        init:function(e){
            joyride.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
           
            var output='[joyride]';
            jQuery("input[id^=joytitle]").each(function(intIndex, objValue) {
		output +='[joystop joytitle="'+jQuery(this).val()+'" ';
		var obj = jQuery('textarea[id^=joytext]').get(intIndex);
		output += 'joytext="'+obj.value+'" ';
                var obj2 = jQuery('select[id^=joybutton]').get(intIndex);
                output+='joybutton="'+obj2.value+'"]';
                var content=jQuery('textarea[id^=content]').get(intIndex);
                output +=content.value;
		output += "[/joystop]";
				});
				
		output+='[/joyride]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(joyride.init, joyride);
    jQuery(document).ready(function() {
			jQuery("#add-joystop").click(function() {
				jQuery('#JoyrideShortcodeContent').append('<p><label for="joytitle[]">Title</label><input type="text" id="joytitle[]" name="joytitle[]"></p><p><label for="joytext[]">Joyride Text</label><textarea id="joytext[]" name="joytext[]" col="20"></textarea></p><p><label for="joybutton[]">Joyride Button</label><select id="joybutton[]" name="joybutton[]"><option value="next">Button Next</option><option value="finish">Button Finish</option></select></p><p><label for="content[]">Your Text</label><textarea id="content[]" name="content[]" col="20"></textarea></p><hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
</script>
<title>Add Joyride</title>
</head>
<body>
    <form id="GalleryShortcode">
     <div id="JoyrideShortcodeContent">
        <p>
            <label for="joytitle[]">Title</label>
            <input type="text" id="joytitle[]" name="joytitle[]">
        </p>
        <p>
            <label for="joytext[]">Joyride Text</label>
            <textarea id="joytext[]" name="joytext[]" col="20"></textarea>
        </p>
        <p>
            <label for="joybutton[]">Joyride Button</label>
            <select id="joybutton[]" name="joybutton[]">
                <option value="next">Button Next</option>
                <option value="finish">Button Finish</option>
            </select>
        </p>
        <p>
            <label for="content[]">Your Text</label>
            <textarea id="content[]" name="content[]" col="20"></textarea>
        </p>
        <hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
    </div>
	<strong><a style="cursor: pointer;" id="add-joystop">+ Add Joyride Stop</a></strong>
        <p>
            <a class="add" href="javascript:joyride.insert(joyride.e)">Insert into post</a>
        </p>
    </form>
<!---->
<?php } ?>

</body>
</html>
