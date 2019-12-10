<?php
/**
 * The template includes blog post format audio.
 *
 * @package Pix-Theme
 * @since 1.0
 */
	// get meta value for audio
	$pixtheme_url = rwmb_meta('post_audio')
?>
<div class="entry-media">
	<?php echo do_shortcode($pixtheme_url); ?>
</div>