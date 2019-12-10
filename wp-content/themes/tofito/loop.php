<?php /*** The loop that displays posts.***/ ?>

<?php 

$pix_options = get_option('pix_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';

?>

<?php if ( ! have_posts() ) : ?>
	<div  class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'PixTheme' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'PixTheme' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?> 

<?php while ( have_posts() ) : the_post(); ?>
    
    <div class="animated" data-animation="bounceInUp">
    
     <article id="post-<?php esc_attr(the_ID());?>" <?php post_class('clearfix'); ?> >     	
        <?php			
			$pixtheme_format  = get_post_format();
			$pixtheme_format = !in_array($pixtheme_format, array("quote", "gallery", "video")) ? 'standared' : $pixtheme_format;		
            get_template_part( 'template-parts/post-format/blog', $pixtheme_format);
            get_template_part( 'template-parts/blog-template/blog', 'template');
		?>  		
    </article>
    
    </div>
    

<?php endwhile;?>

<div class="pagination clearfix">
    <?php 
        if ( $wp_query->max_num_pages > 1 ) :
	include(PixTheme_PLUGINS. '/wp-pagenavi.php' );
	if(function_exists('wp_pagenavi')) { wp_pagenavi();}
	endif; 
    ?>
</div>
