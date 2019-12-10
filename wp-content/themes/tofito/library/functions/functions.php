<?php
/**
 * The template for displaying page blocks.
 *
 * @package PixTheme
 * @since 1.0
 */
	if (!class_exists('PixThemeFunctions')) {

	class PixThemeFunctions {

			// site title
		function pixtheme_site_title() {
  			$out   = wp_title( '-', true, 'right' );
  			$out  .= get_bloginfo( 'name' );
  			$site_description = get_bloginfo( 'description', 'display' );
  			if ( !empty($site_description) && ( is_home() || is_front_page() ) ) {	$out  .= ' | '. $site_description; }
			return $out;
		}

		// site menu
		function pixtheme_site_menu($class = null) {
			if ( function_exists('wp_nav_menu')) {
				wp_nav_menu(array(
					'theme_location'  => 'primary_nav',
        			'container'       => false,
        			'menu_id'		  => 'main-menu',
        			'menu_class'      => $class
				));

				echo '<div class="visible-xs" id="mobile-menu">
            			<div class="dl-menuwrapper menu" id="dl-menu">
              				<button  class="dl-trigger"><i class="icomoon-reorder"></i></button>';
					wp_nav_menu(array(
						'theme_location'  => 'primary_nav',
            			'container'       => false,
            			'menu_class'		  => 'dl-menu',
					));
				echo'</div>';
				echo '</div>';
			}
		}

		// slideshow
		function pixtheme_slideshow($slider) {

			ob_start();			
			
			if (($slider) == 'slider2') {	
						
				$slides = rwmb_meta('sequence_upload', 'type=image&size=full');
				$out = "";
				$out .= '<div class="home-slider"> <div class="flexslider">';				
				$out .= '<ul class="slides">';				
				foreach($slides as $slide) {
					$out .= '<li><img alt="' . esc_attr($slide['alt']) . '" src="' . esc_url($slide['url']) . '" width="' . esc_attr($slide['width']) . '" height="' . esc_attr($slide['height']) . '" />';
					$out .= '<div class="flex-caption">';				
					$out .= $slide['description'];
					$out .= '<h3>' . $slide['caption'] . '</h3>';						
					$out .= '</div>';
					$out .= '</li>';				
				}	
				$out .= '</ul>';				
				$out .= '</div></div>';	
				return $out;
				
			} elseif(class_exists('RevSlider')) {
				putRevSlider($slider);
			}

			return ob_get_clean();
		}

		// get featured image
		function pixtheme_get_featured_image($args) {
			extract(shortcode_atts(array(
				'title' => '',
				'mode'	=> 'portfolio',
				'size'	=> ''
			), $args));

			// get post options
			if ($mode == 'blog') { echo get_the_post_thumbnail( get_the_id(), $size ); }
			$type = rwmb_meta('post_types');
			$output = '';

			switch ($type) {
				case 'image':

					$url = rwmb_meta('post_image');
					$img_url = wp_get_attachment_image_src($url, 'full');

					$output .= '<div class="item-thumbnail">';
					$output .= '<a href="#">'.get_the_post_thumbnail( get_the_id(), $size ).'</a>';
					$output .= '</div>';
					$output .= '<div class="item-hover">';
					$output .= '<div class="actions">';
					$output .= '<ul class="unstyled clearfix">';
					$output .= '<li><a href="'.$img_url[0].'" data-lightbox="true[gal2]"><i class="icomoon-images"></i></a></li>';
					$output .= '<li><a href="'.get_permalink().'"><i class="icomoon-link"></i></a></li>';
					$output .= '</ul></div>';
					$output .= '<div class="details">';
					$output .= '<div class="table">';
					$output .= '<div class="vertical-center"><h5 class="title">'.$title.'</h5></div>';
					$output .= '</div></div></div>';

					return $output;

				break;

				case 'video':

					// get post video options
					$video          = get_post_meta(get_the_ID(), 'post_video_link', true);
		            $video_width    = get_post_meta(get_the_ID(), 'post_video_width', true);
		            $video_width	= ($video_width)?$video_width:800;
		            $video_height   = get_post_meta(get_the_ID(), 'post_video_height', true);
		            $video_height	= ($video_height)?$video_height:480;
		            $video_src      = ($video)? $video.'?&amp;width='.$video_width.'&amp;height='.$video_height:'#';

					$output .= '<div class="item-thumbnail">';
					$output .= '<a href="#">'.get_the_post_thumbnail( get_the_id(), $size ).'</a>';
					$output .= '</div>';
					$output .= '<div class="item-hover">';
					$output .= '<div class="actions">';
					$output .= '<ul class="unstyled clearfix">';
					$output .= '<li><a href="'.$video_src.'" data-lightbox="true[gal2]"><i class="icomoon-play"></i></a></li>';
					$output .= '<li><a href="'.get_permalink().'"><i class="icomoon-link"></i></a></li>';
					$output .= '</ul></div>';
					$output .= '<div class="details">';
					$output .= '<div class="table">';
					$output .= '<div class="vertical-center"><h5 class="title">'.$title.'</h5></div>';
					$output .= '</div></div></div>';

					return $output;

				break;

				case 'custom':

					// get post video options
					$custom = get_post_meta(get_the_ID(), 'post_custom', true);
				
					$output .= '<div class="item-thumbnail">';
					$output .= '<div class="video-containers">'.do_shortcode($custom).'</div>';
					$output .= '</div>';
					$output .= '<div class="item-hover">';
					$output .= '<div class="details">';
					$output .= '<div class="table">';
					$output .= '<div class="vertical-center"><h5 class="title">'.$title.'</h5></div>';
					$output .= '</div></div></div>';

					return $output;

				break;
				
				default:
					# code...
					break;
			}
  	 	}

  	 	// read more
  	 	function pixtheme_post_read_more() {
  	 		$btn_name = get_option('pixtheme_blog');
  	 		$name = (empty($btn_name['button_name'])) ? 'Read More':$btn_name['button_name'];
  	 		return '<a href="'.get_permalink().'" title="'.get_the_title().'" class="readmore">'.$name.'</a>';
  	 	}






	} // end of class
} // end of if

function pixtheme_get_theme_generator($function) {
	global $theme_generator;
	if( !isset( $theme_generator ) ){
  		$theme_generator = new PixThemeFunctions;
		}
    $args = array_slice( func_get_args(), 1 );
    return call_user_func_array(array( &$theme_generator, $function ), $args );
}


?>