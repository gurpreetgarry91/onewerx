<?php
/**
 * The template for registering metabox.
 *
 * @package PixTheme
 * @since 1.0
 */
add_filter( 'rwmb_meta_boxes', 'pixtheme_register_meta_boxes' );
add_filter( 'walker_nav_menu_start_el', 'pixtheme_one_page_nav_walker', 10, 4 );
//add_filter( 'pre_get_posts', 'pixtheme_SearchFilter' );

function pixtheme_register_meta_boxes( $meta_boxes ) {

	// 1st meta box
	$pixtheme_slider = pixtheme_all_sliders();
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'homepage',
		'title' => __( 'Page Options', 'rwmb' ),
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => __( 'Home Page Slider', 'rwmb' ),
				'id'    => "homepage_slider",
				'desc'  => __( 'Choose Home Page Slider.', 'rwmb' ),
				'type'  => 'select',
				'options' => $pixtheme_slider				
			),
			array(
				'name' => __('Sequence Slider:','rwmb'),
				'id'   => "sequence_upload",
				'type' => 'plupload_image',
				'max_file_uploads' => 25,
			),
			array(
				'name' => __( 'Custom Background Color', 'rwmb' ),
				'id'   => "cs_homepage_bgcolor",
				'desc'  => __( 'Select Home Page custom background Color.', 'rwmb' ),
				'type' => 'color',
			),
			array(
				'name'             => __( 'Background Image', 'rwmb' ),
				'id'               => "homepage_bgimage",
				'type'             => 'image_advanced',
				'desc'  => __( 'Upload background image for Home Page.', 'rwmb' ),
				'max_file_uploads' => 2,
			),
		)
		
	);

	$meta_boxes[] = array(
		'id' => 'post_types',
		'title' => __( 'Portfolio Option', 'rwmb' ),
		'pages' => array( 'portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => __( 'Post Types', 'rwmb' ),
				'id'       => "post_types_select",
				'type'     => 'select',
				'desc' => 'Select post types',
				'options'  => array(
					'image' => 'Image',
					'video' => 'Video',
					'link' => 'Modal',
					'custom' => 'Custom'
				)
			),
			array(
				'name' => __( 'Post Type For Image', 'rwmb' ),
				'id'   => "post_image",
				'type' => 'file_advanced',
				'desc' => "Upload post type image for your post.",
				'max_file_uploads' => 4,
				'mime_type' => 'application,audio,video',
			),
			array(
				'name'  => __( 'Post Type For Video', 'rwmb' ),
				'id'    => 'post_video_href',
				'type'  => 'text',
				'desc' => 'Enter video link eg (http://youtu.be/DoRMzGR7ZDA)'
			),
			array(
				'name' => __( '.', 'rwmb' ),
				'id'   => "post_video_width",
				'type' => 'slider',
				'desc' => __('Range video width', 'textdomain'),
				'suffix' => __( ' px', 'rwmb' ),
				'js_options' => array(
					'min'   => 100,
					'max'   => 2000,
					'step'  => 10,
				),
			),
			array(
				'name' => __( '.', 'rwmb' ),
				'id'   => "post_video_height",
				'type' => 'slider',
				'desc' => __('Range video height', 'textdomain'),
				'suffix' => __( ' px', 'rwmb' ),
				'js_options' => array(
					'min'   => 100,
					'max'   => 1000,
					'step'  => 5,
				),
			),
			array(
				'name'  => __( 'Custom Content', 'rwmb' ),
				'id'    => 'post_custom',
				'type'  => 'textarea',
				'desc' => '&lt;a class=&quot;btn-icon&quot; href=&quot;&quot;&gt;<br>
							&lt;i class=&quot;fa fa-pencil&quot;&gt;&lt;/i&gt;<br>
							&lt;/a&gt;',
			)
		)
	);
	

	$meta_boxes[] = array(
		
		'id' => 'post_format',
		'title' => __( 'Post Format Options', 'rwmb' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => __('Post Standared:', 'rwmb' ),
				'id'   => "post_standared",
				'type' => 'file_advanced',
				'max_file_uploads' => 4,
				'mime_type' => 'application,audio,video',
			),
			array(
				'name' => __('Post Gallery:','rwmb'),
				'id'   => "post_gallery",
				'type' => 'plupload_image',
				'max_file_uploads' => 25,
			),
			array(
				'name'  => __('Quote Source:', 'rwmb'),
				'id'    => "post_quote_source",
				'desc'  => '',
				'type'  => 'text',
				'std'   => '',
			),
			array(
				'name'  => __('Quote Content:', 'rwmb'),
				'id'    => "post_quote_content",
				'desc'  => '',
				'type'  => 'textarea',
				'std'   => '',
			),
			array(
				'name'  => __('Video','rwmb'),
				'id'    => "post_video",
				'desc'  => 'Video URL',
				'type'  => 'textarea',
				'std'   => '',
			)
		)
		
	);

	$meta_boxes[] = array(

		'id' => 'blog_page_options',
		'title' => __( 'Blog Options', 'rwmb' ),
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name'    => __( 'Post Per Page', 'rwmb' ),
				'id'      => "blog_post_per_page",
				'desc'  => 'Enter number of Post to Show on Page',
				'type'    => 'text',
				'std'   => __( '5', 'rwmb' )
			),
			array(
	            'name'    => __( 'Categories not to show', 'rwmb' ),
	            'id'      => "blog_page_categories_not",
	            'desc'  => __( "Select the categories that you wish not to dispaly on this blog page.", 'spnoy' ),
	            'type'    => 'taxonomy',
	            'options' => array(
	                'taxonomy' => 'category',
	                'type' => 'checkbox_list'
	            )
	        )

		)
	);
	return $meta_boxes;
}

function pixtheme_one_page_nav_walker($output, $item, $depth, $args) {
	
	if ( is_object($item) ) {  // Exectue only when it's in menu items

		$home_childs = array();  // Default value for home children
		$home_ids = array();
		$front_page_ID = get_option('page_on_front');
		$post_id = get_the_ID();
		
		$pages_id = pixtheme_get_home_ID();
		if(!empty($pages_id)){
			foreach ($pages_id as $page_id) {  // Store all the child pages included in Homepage
			
				//print_r($home_ids);
				if ( $page_id->ID ) {  // If home page was set
		
					$pages = get_pages( 'child_of=' . $page_id->ID );
					foreach ($pages as $child) {  // Store all the child pages included in Homepage
						$home_ids[$page_id->ID][] = $child->ID;
						array_push( $home_childs, $child->ID );
					}	
				}
			}
		}
		//print_r($home_childs);
		// If menu item's page is included in home page or menu item points to Homepage (frontpage)
		if ( in_array( $item->object_id , $home_childs ) || $item->url === pixtheme_get_home_front_page_url() ) {
			//echo $item->object_id . " - " .$item->url. " - " . pixtheme_get_home_front_page_url() . " - " . $post_id . "<br>";
			
			if ( $item->url === pixtheme_get_home_front_page_url() && !is_page_template('template-home.php') ) {  // Detect home menu item in other pages
				$url = home_url();
				$pattern = '/(?<=href\=")[^]]+?(?=")/';
				$output = preg_replace($pattern, $url, $output);
			} elseif( $post_id == $front_page_ID && in_array( $item->object_id , $home_ids[$post_id] ) && is_page_template('template-home.php') ) {
				$url = home_url() . '/#' . pixtheme_get_slug($item->object_id);
				//echo $url;
				$pattern = '/(?<=href\=")[^]]+?(?=")/';
				$output = preg_replace($pattern, $url, $output);
			} else {
				$parent_id = '';
				foreach ($home_ids as $key => $val){
					if(is_numeric(array_search($item->object_id, $val))){
						$parent_id = $key;
						break;
					}
				}
				
				if(is_numeric($parent_id)){
					$url = get_permalink($parent_id) . '#' . pixtheme_get_slug($item->object_id);
				}else{
					$url = home_url() . '/#' . pixtheme_get_slug($item->object_id);
				}				
				$pattern = '/(?<=href\=")[^]]+?(?=")/';
				$output = preg_replace($pattern, $url, $output);
			}

		} else {  // If it's a normal link to other pages add a class to it

			$dom = new DOMDocument;
			$dom->encoding = 'utf-8';
			$dom->loadHTML( mb_convert_encoding($output, "HTML-ENTITIES", "UTF-8") );

			$dom->removeChild($dom->firstChild);  // Remove <!DOCTYPE 
			$dom->replaceChild($dom->firstChild->firstChild->firstChild, $dom->firstChild); // Remove <html><body></body></html> 

			$anchors = $dom->getElementsByTagName('a');
			foreach($anchors as $anchor) {
				$anchor->setAttribute('class', 'external');
			}

			$output = $dom->saveHTML();

		}

	}
	
    return $output;
}

function pixtheme_SearchFilter($query) {
    if ($query->is_search) {
    $query->set('post_type', 'post');
    }
    return $query;
}
