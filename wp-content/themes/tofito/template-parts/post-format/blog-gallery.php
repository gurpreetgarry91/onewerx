<?php
/**
 * The template includes blog post format gallery.
 *
 * @package Pix-Theme
 * @since 1.0
 */
	
	// get the gallery images
	$size = (is_front_page()) && !is_home() ? 'portfolio-3col' : 'blog-post';
	$gallery = rwmb_meta('post_gallery', 'type=image&size='.$size.'');
 
	$argsThumb = array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => null,
		//'exclude' => get_post_thumbnail_id()
	);
	$attachments = get_posts($argsThumb);
	
if ($gallery || $attachment){
?>
<div class="entry-media">
	<div class="flexslider" data-autoplay="false" data-animation="slide" data-easing="easeInOutQuad" data-slideshow-speed="8000" data-animation-speed="1500" data-direction="true" data-control="true" data-smooth-height="true">
		<ul class="slides">
			<?php
            if($gallery){
				foreach ($gallery as $slide) {
					echo '<li>';
					echo '<img src="' . esc_url($slide['url']) . '" width="' . esc_attr($slide['width']) . '" height="' . esc_attr($slide['height']) . '" alt="' .esc_attr($slide['alt']).'" title="' .esc_attr($slide['title']). '" />';
					echo '</li>';
				}
			}elseif ($attachments) {
				foreach ($attachments as $attachment) {
					echo '<li><img src="'.wp_get_attachment_url($attachment->ID, 'full', false, false).'" alt="'.get_post_meta($attachment->ID, '_wp_attachment_image_alt', true).'" title="'.esc_attr(get_post_meta($attachment->ID, '_wp_attachment_image_title', true)).'" /></li>';
				}
			}
			
			?>
		</ul>
	</div>
</div>
<?php 
}
else{
?>
	<div class="thumbnails">
    	<a href="<?php the_permalink()?>">
		<?php if ( has_post_thumbnail() ):?>  
        	<figure class="effect-milo"> <?php the_post_thumbnail(); ?> </figure>
		<?php else : ?>
        	<figure class="effect-milo"><img src="<?php echo get_template_directory_uri() ?>/images/noimage.jpg" alt="" /> <?php the_post_thumbnail(); ?> </figure>
		<?php endif; ?>
        </a>
    </div>
<?php	
}
?>