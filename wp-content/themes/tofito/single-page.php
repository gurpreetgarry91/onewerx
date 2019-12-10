<?php /* Template Name: Single page */ 
	
$pix_options = get_option('pix_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$blogLayout =  isset ($pix_options['pix_blog_layout']) ? $pix_options['pix_blog_layout'][0] : '1';

?>

<?php get_header();?>

<div class="bg-wrapper">
  
    <section  id="columns" class="container_9 clearfix  <?php if ($layout == '3'):?>  col2-left  <?php endif?>   <?php if ($layout == '2'):?>  col2-right  <?php endif?>"> 
      
	  <?php if ($layout == '3'):?>
      	<aside class="column grid_2 omega" id="left_column">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
        </aside>
      <?php endif?>
      
      <!-- Center -->
      <article id="center_column" class=" grid_5">
      
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        
                <?php the_content(); ?>
          
        <?php endwhile; ?>	
  
      </article>
      
	  <?php if ($layout == '2'):?>
		<aside class="column grid_2 omega" id="right_column"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
        </aside>
	  <?php endif?>
      
  </section>  </div>
  
  

  

<?php get_footer();?>