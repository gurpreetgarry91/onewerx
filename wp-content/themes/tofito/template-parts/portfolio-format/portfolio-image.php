<?php
/**
 * The template includes blog post format gallery.
 *
 * @package Pix-Theme
 * @since 1.0
 */
	
	// get the gallery images
	$size = (is_front_page()) && !is_home() ? 'portfolio-4col' : 'portfolio-3col';
	$gallery = rwmb_meta('post_image', 'type=image&size='.$size.'');
	$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
    $link = $full_image[0];

?>
<div class="detail-item">
	<p><?php echo pixtheme_limit_words(get_the_excerpt(), 20) ?></p>
	<div style="position:absolute; left:-99999px;">
			<?php
				foreach ($gallery as $key => $slide) {
					if($key>0)
					echo '<a href="' . esc_url($slide['url']) . '" rel=""><img src="' . esc_url($slide['url']) . '" width="' . esc_attr($slide['width']) . '" height="' . esc_attr($slide['height']) . '" alt="' .esc_attr($slide['alt']).'" title="' .esc_attr($slide['title']). '"/></a>';
				}
			?>
	</div>
    <a  href="<?php echo esc_url($link) ?>" class="btn-icon zoomPhoto"   >
        <i class="icon-picture icon-large"></i>
    </a>
</div>