<?php

/*************** PORTFOLIO POST-TYPES  *****************/

add_action('init', 'pixtheme_portfolio_register');

function pixtheme_portfolio_register() {	

	register_post_type( 'portfolio' , 
						array(
							'label' => 'Portfolio',
							'singular_label' => 'Portfolio',
							'exclude_from_search' => false,
							'publicly_queryable' => true,
							'menu_position' => null,
							'show_ui' => true, 
							'query_var' => true,
							'capability_type' => 'page',
							'hierarchical' => false,
							'edit_item' => __( 'Edit Work', 'PixTheme'),
							'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
						)
					);

	register_taxonomy( 'portfolio_category', 
						'portfolio', 
						array( 'hierarchical' => true, 
								'label' => __('Categories', 'PixTheme'),
								'singular_label' => __('Category', 'PixTheme'), 
								'public' => true,
  								'show_tagcloud' => false,
								'query_var' => 'true',
			 					'rewrite' => array('slug' => 'portfolio_category' , 'with_front' => false)
						)
					);  
	
	add_filter('manage_edit-portfolio_columns', 'pixtheme_portfolio_edit_columns');
	add_action('manage_posts_custom_column',  'pixtheme_portfolio_custom_columns');
	
	function pixtheme_portfolio_edit_columns($columns){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => 'Title',
			'portfolio_category' => 'Category',
			'portfolio_description' => 'Description',
			'portfolio_image' => 'Image Preview'
		);
	
		return $columns;
	}
	
	function pixtheme_portfolio_custom_columns($column){
		global $post;
		switch ($column)
		{
			case "portfolio_category":  
				echo get_the_term_list($post->ID, 'portfolio_category', '', ', ','');  
				break;  

			case 'portfolio_description':
				the_excerpt();  
				break;  

			case 'portfolio_image':
				the_post_thumbnail( 'blog-thumb' );
				break;
		}
	}
}


function pixtheme_post_type_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
    if ( strpos('%portfolio_category%', $post_link)  < 0 ) {
      return $post_link;
    }
    $post = get_post($id);
    if ( !is_object($post) || $post->post_type != 'portfolio' ) {
      return $post_link;
    }
    $terms = wp_get_object_terms($post->ID, 'portfolio_category');
    if ( !$terms ) {
      return str_replace('portfolio/category/%portfolio_category%/', '', $post_link);
    }
    return str_replace('%portfolio_category%', $terms[0]->slug, $post_link);
}
  
add_filter('post_type_link', 'pixtheme_post_type_link_filter_function', 1, 3);
  

add_action( 'admin_menu', 'pixtheme_register_portfolio_menu' );

function pixtheme_register_portfolio_menu() {
	add_submenu_page(
		'edit.php?post_type=portfolio',
		'Order portfolio',
		'Sort items',
		'edit_pages', 
		'portfolio-order',
		'pixtheme_portfolio_order_page'
	);
}


function pixtheme_portfolio_order_page() 
{
	?></pre>
	<div class="wrap">
        <h2>Sort Items</h2>
        Simply drag the items up or down and they will be saved in that order.
        
        <?php $slides = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) ); ?>
        <table id="sortable-table-portfolio" class="wp-list-table widefat fixed posts">
            <thead>
                <tr>
                    <th class="column-order">Order</th>
                    <th class="column-title">Title</th>
                    <th class="column-thumbnail">Thumbnail</th>
         
                </tr>
            </thead>
            <tbody data-post-type="portfolio"><!--?php while( $products--->
				<?php if( $slides->have_posts() )  : ?>
                    <?php while ($slides->have_posts()): $slides->the_post(); ?>
                        <tr id="post-<?php the_ID(); ?>">
                            <td class="column-order"><img title="" src="<?php echo get_stylesheet_directory_uri() . '/images/move-icon-vertical.png'; ?>" alt="Move Icon" height="32" /></td>
                            <td class="column-title"><strong><?php the_title(); ?></strong></td>
                    		<td class="column-thumbnail"><?php the_post_thumbnail( 'blog-thumb' ); ?></td>
                         </tr>
                    <?php endwhile; ?>
                <?php else : ?>        
                    No portfolio items found, make sure you create one.
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>	
            </tbody>
            <tfoot>
                <tr>
                    <th class="column-order">Order</th>
                    <th class="column-title">Title</th>
                    <th class="column-thumbnail">Thumbnail</th>
                </tr>
            </tfoot>
        </table>
 	</div>
	<pre>
	<!-- .wrap -->	
	<?php 
}

add_action( 'wp_ajax_pixtheme_portfolio_update_post_order', 'pixtheme_portfolio_update_post_order' );

function pixtheme_portfolio_update_post_order() {
	global $wpdb;

	$post_type     = $_POST['postType'];
	$order        = $_POST['order'];

	/**
	*    Expect: $sorted = array(
	*                menu_order => post-XX
	*            );
	*
	*/
	
	foreach( $order as $menu_order => $post_id )
	{
		$post_id         = intval( str_ireplace( 'post-', '', $post_id ) );
		$menu_order     = intval($menu_order);
		wp_update_post( array( 'ID' => $post_id, 'menu_order' => $menu_order ) );
	}

	die( '1' );
}

add_action('save_post', 'pixtheme_save_details');
function pixtheme_save_details(){

	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		
    if (isset($_POST['pixtheme_hidden_flag'])) {
	
		$custom_meta_fields = array(
			'_pixtheme_sidebar_pos',
			'_page_portfolio_cat',
			'_page_portfolio_num_items_page',
			'_portfolio_type',
			'_pixtheme_sidebar_post',
			'_pixtheme_post_head',
			'_pixtheme_post_slider',
			'_pixtheme_promotext',
			'_portfolio_no_lightbox',
			'_portfolio_link',
			'_portfolio_video',
			'_portfolio_featured',
			'_blog_videoap',
			'_blog_video',
			'_blog_mediatype'
		);
		
			
		foreach( $custom_meta_fields as $custom_meta_field ){
			if(isset($_POST[$custom_meta_field]) )
			{
				if(is_array($_POST[$custom_meta_field]))
				{
					$cats = '';
					foreach($_POST[$custom_meta_field] as $cat){
						$cats .= $cat . ",";
					}
					$data = substr($cats, 0, -1);
					update_post_meta($post->ID, $custom_meta_field, $data);
				}
				else
				{
					update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])) );
				}
			}
			else
			{
				delete_post_meta($post->ID, $custom_meta_field);
			}
		}
	
	}
}

function pixtheme_post_options($value){
	global $post;
?>

	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
		$id = $value['id'];
		$get_meta = get_post_custom($post->ID);
		$meta_box_value = get_post_meta($post->ID, $id, true);
		if( isset( $get_meta[$id][0] ) )
			$current_value = $get_meta[$id][0];
			
	switch ( $value['type'] ) {
		
		case 'text': ?>
			<input  name="<?php echo $value['id']; ?>" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo (isset($current_value) && !empty( $current_value )) ? $current_value : '' ?>" />
			<?php if (isset($value ['hint'])):?><a href="#" class="mo-help tooltip" title="<?php echo $value ['hint']?>"></a><?php endif?>
		<?php 
		break;

		case 'checkbox':
			if(isset($current_value) && !empty( $current_value ) ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input type="checkbox" name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />	
			<?php if (isset($value ['hint'])):?><a href="#" class="mo-help tooltip" title="<?php echo $value ['hint']?>"></a><?php endif?>		
		<?php	
		break;
		
		case 'select':
		?>
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if (isset($current_value) && !empty( $current_value ) && $current_value == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			<?php if (isset($value ['hint'])):?><a href="#" class="mo-help tooltip" title="<?php echo $value ['hint']?>"></a><?php endif?>
		<?php
		break;
		
		case 'textarea':
		?>
			<textarea style="direction:ltr; text-align:left; width:430px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="3" tabindex="4"><?php echo isset($current_value) ? $current_value : ''  ?></textarea>
			<?php if (isset($value ['hint'])):?><a href="#" class="mo-help tooltip" title="<?php echo $value ['hint']?>"></a><?php endif?>
		<?php
		break;
		
		case 'slider':
			if ($meta_box_value == '') $meta_box_value = 9;  
			echo '
			<script type="text/javascript">		
			jQuery(document).ready(function () {						
				jQuery( "#'.$value['id'].'-slider" ).slider({ 
					value: '.$meta_box_value.', 
					min: '.$value['min'].', 
					max: '.$value['max'].', 
					step: '.$value['step'].', 
					slide: function( event, ui ) { 
						jQuery( "#'.$value['id'].'" ).val( ui.value ); 
					} 
				});
			});
			</script>';  
			
			echo '<div id="'.$value['id'].'-slider" class="slider-container"></div>
			<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'.$meta_box_value.'" size="5" class="minimal-textbox custom-tm" />
			<div class="clear"></div>';
			if (isset($value ['hint'])):?><a href="#" class="mo-help tooltip" title="<?php echo $value ['hint']?>"></a><?php endif;
		break;
		
		case 'portfolio_cat':
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
					<input style="width: 14px;" type="checkbox" id="pcategory' . $category->cat_ID . '" name="' . $value[ 'id' ] . '[]" value="' . $category->cat_ID . '" ' . $checked . ' />
					<label for="pcategory'.$category->cat_ID.'" class="inline">' . $category->name . '</label>
					</li>';
			}
			
			echo '</ul>';
			if (isset($value ['hint'])):?><a href="#" class="mo-help tooltip" title="<?php echo $value ['hint']?>"></a><?php endif;
		break;
		
	
	} ?>
	</div>
<?php
}

?>