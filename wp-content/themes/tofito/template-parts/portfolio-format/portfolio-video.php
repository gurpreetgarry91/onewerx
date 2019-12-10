<?php
/**
 * The template includes blog post format audio.
 *
 * @package PixTheme
 * @since 1.0
 */
?>
<div class="detail-item">
    <p><?php echo pixtheme_limit_words(get_the_excerpt(), 20) ?></p>
    <?php if ( get_post_meta( get_the_ID(), 'post_video_href', true ) !== '' ): 
            $video_embed_code = get_post_meta( get_the_ID(), 'post_video_href', true );
			$video_width = get_post_meta( get_the_ID(), 'post_video_width', true );
			$video_height = get_post_meta( get_the_ID(), 'post_video_height', true );
	?>    
        <a  href="<?php echo esc_url($video_embed_code); ?>?width=<?php echo esc_attr($video_width); ?>&amp;height=<?php echo esc_attr($video_height); ?>" class="btn-icon video-popab"   >
            <i class="icon-film icon-large"></i>
        </a>
    <?php endif?>
</div>
