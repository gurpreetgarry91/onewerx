<?php 
/**
 * The template for displaying page blocks.
 *
 * @package PixTheme
 * @since 1.0
 *
 * Template Name: Full Width
 */
get_header(); ?>
<main id="main" class="section">
	<div class="container">
		<div class="row">
			<?php
         		if ( have_posts() ) : the_post();
            	the_content();
				echo "";
               wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number'));
            	$pixtheme_comment = get_option('pixtheme_general');
            	if ($pixtheme_comment['comment_page'] == 'on' ) { comments_template( '', true ); } // page comment
         		endif;
      		?>
		</div>
	</div>
</main>
<?php get_footer(); ?>