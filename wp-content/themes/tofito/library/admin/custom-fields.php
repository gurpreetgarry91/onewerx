<?php

add_action("admin_init", "posts_init");
function posts_init(){
	add_meta_box("page_options", "PixTheme - Page Options", "page_options", "page", "normal", "high");
	//add_meta_box("portfolio_options", "PixTheme - Portfolio item options", "portfolio_options", "portfolio", "normal", "high");
}

function portfolio_options(){
	global $post ;
	$get_meta = get_post_custom($post->ID); 

?>	
		<div class="pixthemepanel-item">
			<input type="hidden" name="pixtheme_hidden_flag" value="true" />	
		
		
			<?php	
	
			pixtheme_post_options(				
				array(	"name" => "Item links to inner page",
						"id" => "_portfolio_no_lightbox",
						"type" => "checkbox",
						"hint" =>  "Thumbnail to link directly to the portfolio item detail or custom URL instead of opening the full image in the lightbox"
				));

			pixtheme_post_options(				
				array(	"name" => "Portfolio Item custom destination URL",
						"id" => "_portfolio_link",
						"hint" => "If you want the portfolio item have custom link rather going to item's details page. Example: http://www.pixtheme.com",
						"type" => "text")
				);
											
			pixtheme_post_options(				
				array(	"name" => "Portfolio third-party video in lightbox",
						"id" => "_portfolio_video",
						"hint" => "<strong>Supports Youtube, Vimeo, etc.. </strong><br /> Example:http://www.youtube.com/watch?v=ehuwoGVLyhg",
						"type" => "text"));
											
			pixtheme_post_options(				
				array(	"name" => "Make project featured",
						"id" => "_portfolio_featured",
						"type" => "select",
						"hint" => "If set, this item will appear in portfolio's featured items list when using [list_portfolio /] shortcode.",
						"type" => "checkbox"));
			?>
		</div>	
  <?php
}


function page_options(){
	global $post ;
	$get_meta = get_post_custom($post->ID);  
	
	$categories_obj = get_categories();
	$categories = array();
	$categories = array(''=> 'All Categories');
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
?>
		<input type="hidden" name="pixtheme_hidden_flag" value="true" />	
								
		<div class="pixthemepanel-item">
			
			<?php	
				pixtheme_post_options(
					array(
					"id" => "_page_portfolio_cat",
					"name" => "Portfolio Categories",
					"hint" => "Choose only if this page uses a Portfolio page template",
					"type" => "portfolio_cat")
				);	
				pixtheme_post_options(
					array(
					"id" => "_page_portfolio_num_items_page",
					"name" => "Portfolio items per page",
					"hint" => "Number of items displayed per page. Leave blank if you don't want to paginate the portfolio items.",
					"type"  => "slider",  
					"min"   => "0",  
					"max"   => "100",  
					"step"  => "1")
				);	
				pixtheme_post_options(
					array(
						"id" => "_portfolio_type",
						"name" => "Portfolio type",
						"hint" => "Choose over animated portfolio with pagination (all items displayed in one page) or non-animated portfolio with pagination enabled.<br /> Applies only to portfolio pages.",
						"type" => "select",
						"options" => array('0' => "Animated without pagination", '1' => "Non-animated with pagination")
					)
				);	
			?>	
		</div>

  <?php
}

global $new_meta_boxes;
$new_meta_boxes =
array(
	
	// Posts
	"_post_video" => array(
		"name" => "_post_video",
		"std" => "",
		"title" => "Vimeo video in post listing (just enter the video ID)",
		"description" => "Example: 19966855",
		"type" => "text",
		"location" => "Post"
	),
	
	"_page_layout" => array(
		"name" => "_page_layout",
		"std" => "",
		"title" => "Choose a layout",
		"description" => "If right or left sidebar layouts are chosen, make sure to choose a sidebar to display from the dropdown on the right.",
		"type" => "radio",
		"options" => array(
			array( "value" => "1", "text" => "Full width" ),
			array( "value" => "2", "text" => "Right Sidebar" ),
			array( "value" => "3", "text" => "Left Sidebar" ),
		),
		"blocksize" => "one_half",
		"location" => "Page"
	),
	
	// Pages	
	"_chosen_sidebar" => array(
		"name" => "_chosen_sidebar",
		"std" => "",
		"title" => "Choose a sidebar",
		"description" => "choose between existing sidebars.",
		"type" => "sidebar",
		"blocksize" => "one_half",
		"location" => "Page"
	),
	
	/*
	"_headline" => array(
		"name" => "_headline",
		"std" => "",
		"title" => "Alternative page title",
		"description" => "If you want to use a title other from the one displayed in menu (For example, page title for 'Portfolio' could be 'Recent works'",
		"type" => "text",
		"location" => "Page"
	),
	
	/*"_promo" => array(
		"name" => "_promo",
		"std" => "",
		"title" => "Promo text",
		"description" => "Page header with alternative background to put some promo text. Shortcodes are allowed",
		"type" => "textarea",
		"location" => "Page"
	),
	
	"_chosen_slider" => array(
		"name" => "_chosen_slider",
		"std" => "",
		"title" => "Choose a slider",
		"description" => "If set, the corresponding Revolution slider will appear on top of page. Paste the desired slider's id into this field. Example: mainslider1",
		"type" => "text",
		//"blocksize" => "one_half",
		"location" => "Page"
	),*/
);

function new_meta_boxes_page() {
	new_meta_boxes('Page');
}

function new_meta_boxes_portfolio() {
	new_meta_boxes('Portfolio');
}

function new_meta_boxes( $type ) {
	global $post, $new_meta_boxes;
	
	// Use nonce for verification
    echo '<input type="hidden" name="PixTheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<div class="form-wrap">';

	foreach($new_meta_boxes as $meta_box) {
		if( $meta_box['location'] == $type) {
			
			if ( $meta_box['type'] == 'title' ) {
				echo '<p style="font-size: 18px; font-weight: bold; font-style: normal; color: #e5e5e5; text-shadow: 0 1px 0 #111; line-height: 40px; background-color: #464646; border: 1px solid #111; padding: 0 10px; -moz-border-radius: 6px;">' . $meta_box[ 'title' ] . '</p>';
			} else {			
				$meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
		
				if(isset ($meta_box_value) && $meta_box_value == "")
					if(isset( $meta_box['std'])) $meta_box_value = $meta_box['std'];
				if (!isset($meta_box['blocksize'])) echo '<div class="clear"></div>';
				?>
				<div class="form-field form-required <?php echo isset($meta_box['blocksize']) ?  $meta_box[ 'blocksize' ] : ''?>">
				<?php 
				switch ( $meta_box['type'] ) {
					case 'text':
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong></label>';
						echo 	'<input type="text" name="' . $meta_box[ 'name' ] . '" value="' . htmlspecialchars( $meta_box_value ) . '" />';
						if (isset($meta_box[ 'description' ])) echo '<p>' . $meta_box[ 'description' ] . '</p>';
					break;
					
					case 'textarea':
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong></label>';
						echo 	'<textarea name="' . $meta_box[ 'name' ] . '" id ="'. $meta_box[ 'name' ].'">' . htmlspecialchars( $meta_box_value ). '</textarea>';
						if (isset($meta_box[ 'description' ])) echo '<p>' . $meta_box[ 'description' ] . '</p>';
					break;
					
					case 'checkbox':
						if($meta_box_value == '1'){ $checked = "checked=\"checked\""; }else{ $checked = "";} 
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong>&nbsp;
						<input style="width: 20px;" id ="'. $meta_box[ 'name' ].'" type="checkbox" name="' . $meta_box[ 'name' ] . '" value="1" ' . $checked . ' /></label>';
						if (isset($meta_box[ 'description' ])) echo '<p>' . $meta_box[ 'description' ] . '</p>';
					break;
					
					case 'sidebar':
					
					 global $post;
						$post_id = $post;
						if (is_object($post_id)) {
							$post_id = $post_id->ID;
						}
						$selected_sidebar = get_post_meta($post_id, 'sbg_selected_sidebar', true);
						if(!is_array($selected_sidebar)){
							$tmp = $selected_sidebar; 
							$selected_sidebar = array(); 
							$selected_sidebar[0] = $tmp;
						}
						$selected_sidebar_replacement = get_post_meta($post_id, 'sbg_selected_sidebar_replacement', true);
						if(!is_array($selected_sidebar_replacement)){
							$tmp = $selected_sidebar_replacement; 
							$selected_sidebar_replacement = array(); 
							$selected_sidebar_replacement[0] = $tmp;
						}
						?>
						
						<label for="<?php echo $meta_box[ 'name' ]?>"><strong><?php echo $meta_box[ 'title' ]?></strong></label>
						<input name="sbg_edit" type="hidden" value="sbg_edit" />
						
						<ul>
						<?php 
						global $wp_registered_sidebars;
						//var_dump($wp_registered_sidebars);		
							for($i=0;$i<1;$i++){ ?>
								<li>Replace 
								<select name="sidebar_generator[<?php echo $i?>]">
									<option value="0"<?php if($selected_sidebar[$i] == ''){ echo " selected";} ?>>WP Default Sidebar</option>
								<?php
								$sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
								if(is_array($sidebars) && !empty($sidebars)){
									foreach($sidebars as $sidebar){
										if($selected_sidebar[$i] == $sidebar['name']){
											echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
										}else{
											echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
										}
									}
								}
								?>
								</select>
								 with  
								<select name="sidebar_generator_replacement[<?php echo $i?>]">
									<option value="0"<?php if($selected_sidebar_replacement[$i] == ''){ echo " selected";} ?>>None</option>
								<?php
								
								$sidebar_replacements = $wp_registered_sidebars;//sidebar_generator::get_sidebars();
								if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
									foreach($sidebar_replacements as $sidebar){
										if($selected_sidebar_replacement[$i] == $sidebar['name']){
											echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
										}else{
											echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
										}
									}
								}
								?>
								</select> 
								
								</li>
							<?php } ?>
						</ul>
						
						<?php if (isset($meta_box[ 'description' ])) echo '<p class="top15">' . $meta_box[ 'description' ] . '</p>'; ?>
						<?php
					break;
					
					// slider
					case 'slider':
						
						if ($meta_box_value == '') $meta_box_value = 9;  
						echo '
						<script type="text/javascript">		
						jQuery(document).ready(function () {						
							jQuery( "#'.$meta_box['id'].'-slider" ).slider({ 
								value: '.$meta_box_value.', 
								min: '.$meta_box['min'].', 
								max: '.$meta_box['max'].', 
								step: '.$meta_box['step'].', 
								slide: function( event, ui ) { 
									jQuery( "#'.$meta_box['id'].'" ).val( ui.value ); 
								} 
							});
						});
						</script>';  
						
						//$value = $meta != '' ? $meta : '0';
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong></label>';
						echo '<div id="'.$meta_box['id'].'-slider" class="slider-container"></div>
						<input type="text" name="'.$meta_box['id'].'" id="'.$meta_box['id'].'" value="'.$meta_box_value.'" size="5" class="minimal-textbox" />
						<div class="clear"></div>';
						if (isset($meta_box[ 'description' ])) echo '<p>' . $meta_box[ 'description' ] . '</p>';
					break;
						
					case 'select':
						echo 	'<label for="' . $meta_box[ 'name' ] .'"><strong>' . $meta_box[ 'title' ] . '</strong></label>';
				        echo	'<select name="' . $meta_box[ 'name' ] . '" id ="'. $meta_box[ 'name' ].'">';
						// Loop through each option in the array
						foreach ($meta_box[ 'options' ] as $option) {
							if(is_array($option)) {
								echo '<option ' . ( $meta_box_value == $option['value'] ? 'selected="selected"' : '' ) . ' value="' . $option['value'] . '">' . $option['text'] . '</option>';
							} else {
   								echo '<option ' . ( $meta_box_value == $option ? 'selected="selected"' : '' ) . ' value="' . $option['value'] . '">' . $option['text'] . '</option>';
							}
						}
                        
						echo	'</select>';
						if (isset($meta_box[ 'description' ])) echo '<p>' . $meta_box[ 'description' ] . '</p>'; 
					break;
					
					// radio  
					case 'radio':  
					
						echo 	'<label><strong>' . $meta_box[ 'title' ] . '</strong></label>';
						echo '<div class="radio-container">';
						
						foreach ( $meta_box['options'] as $option ) { 
							$checked = ($meta_box_value == $option['value']) ? ' checked="checked"' : '';
							echo '
							<div class="radio-block">	
								<input type="radio" name="'.$meta_box['name'].'" id="radio_button_'.$option['value'].'" value="'.$option['value'].'" '.$checked.' /> 
								<label for="radio_button_'.$option['value'].'">'.$option['text'].'</label>
								<div class="clearbig"></div> 
							</div>';
						}  
						echo '</div><div class="clear"></div>';
						if (isset($meta_box[ 'description' ])) echo '<p>' . $meta_box[ 'description' ] . '</p>'; 
						
					break; 
						
					case 'portfolio_cat':
						echo 	'<label for="' . $meta_box[ 'name' ] .'" id ="'. $meta_box[ 'name' ].'"><strong>' . $meta_box[ 'title' ] . '</strong></label>';
						
						// Get the categories first
						$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0' );
						$categories = get_categories( $args ); 
						
						$selected_cats = explode( ",", $meta_box_value );
						
						echo '<ul class="portfolio-listing">';

						// Loop through each category
						foreach ($categories as $category) {
														
							foreach ($selected_cats as $selected_cat) {
        	           			if($selected_cat == $category->cat_ID){ $checked = 'checked="checked"'; break; } else { $checked = ""; }
		            	    }
							
			                echo '<li>
								<input style="width: 14px;" type="checkbox" id="pcategory' . $category->cat_ID . '" name="' . $meta_box[ 'name' ] . '[]" value="' . $category->cat_ID . '" ' . $checked . ' />
								<label for="pcategory'.$category->cat_ID.'" class="inline">' . $category->name . '</label>
								</li>';
						}
						
						echo '</ul>';
						if (isset($meta_box[ 'description' ])) echo '<p class="top15">' . $meta_box[ 'description' ] . '</p>'; 
					break;
				}
				
				
				echo '</div>';
				
			}
		}
	}
	
	echo '<div class="clear"></div></div>';
}


function save_postdata( $post_id ) {
	
	if ( !wp_verify_nonce(isset($_POST['PixTheme_meta_box_nonce']) ? $_POST['PixTheme_meta_box_nonce'] : '', basename(__FILE__)) ) {
		
		return $post_id;
	}
	
	if ( wp_is_post_revision( $post_id ) or wp_is_post_autosave( $post_id ) )
		return $post_id;
		
	global $post, $new_meta_boxes;

	foreach($new_meta_boxes as $meta_box) {
		
		if ( $meta_box['type'] != 'title)' ) {
		
			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			}
			
			if (isset($_POST[$meta_box['name']]) && is_array($_POST[$meta_box['name']]) ) {
				$cats = '';
				foreach($_POST[$meta_box['name']] as $cat){
					$cats .= $cat . ",";
				}
				$data = substr($cats, 0, -1);
			}
			
			else { $data = ''; if(isset($_POST[$meta_box['name']])) $data = $_POST[$meta_box['name']]; }			
			
			if(get_post_meta($post_id, $meta_box['name']) == "")
				add_post_meta($post_id, $meta_box['name'], $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'], true))
				update_post_meta($post_id, $meta_box['name'], $data);
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
				
		}
	}
}

add_action('save_post', 'save_postdata');

?>