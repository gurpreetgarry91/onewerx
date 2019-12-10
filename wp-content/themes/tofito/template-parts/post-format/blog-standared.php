

    <div class="thumbnails">
    	<a href="<?php the_permalink()?>">
		<?php if ( has_post_thumbnail() ):?>  
        	<figure class="effect-milo"> <?php the_post_thumbnail(); ?> </figure>
		<?php else : ?>
        	<figure class="effect-milo"><img src="<?php echo get_template_directory_uri() ?>/images/noimage.jpg" alt="" /> <?php the_post_thumbnail(); ?> </figure>
		<?php endif; ?>
        </a>
    </div>

