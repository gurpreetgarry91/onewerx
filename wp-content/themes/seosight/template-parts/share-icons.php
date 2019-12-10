<span class="label"><?php esc_html_e( 'Share', 'seosight' ); ?>:</span>
<button  class="social__item sharer" data-sharer="facebook" data-url="<?php the_permalink(); ?>">
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/facebook.svg" alt="">
</button>
<button class="social__item sharer" data-sharer="twitter" data-title="<?php echo esc_attr(get_the_title()); ?>" data-url="<?php the_permalink();?>" >
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/twitter.svg" alt="">
</button>
<button class="social__item sharer" data-sharer="linkedin" data-url="<?php the_permalink(); ?>">
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/linkedin.svg" alt="">
</button>
<button class="social__item sharer" data-sharer="googleplus" data-url="<?php the_permalink(); ?>">
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/google-plus.svg" alt="">
</button>
<button class="social__item sharer" data-sharer="pinterest" data-url="<?php the_permalink(); ?>" data-image="<?php the_post_thumbnail_url('large'); ?>" >
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/pinterest.svg" alt="">
</button>
<button class="social__item sharer" data-sharer="VK" data-url="<?php the_permalink(); ?>" data-image="<?php the_post_thumbnail_url('large'); ?>" >
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/vk.svg" alt="">
</button>