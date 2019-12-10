
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 */


$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '2';
$pix_options = get_option('pix_general_settings');
$blogLayout =  isset ($pix_options['pix_blog_layout']) ? $pix_options['pix_blog_layout'][0] : '0';
?>

<?php get_header();?>





<main class="section" id="main">
  <div class="container">
    <div class="row"> 
    
      <?php if ($layout == '3'):?>
      <div class="col-xs-12 col-sm-5 col-md-3">
        <aside class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
        </aside>
      </div>
      <?php endif?>
            
       <div class="col-xs-12 col-sm-7 col-md-9  <?php if ($layout == '3'):?>  col2-left  <?php endif?>   <?php if ($layout == '2'):?>  col2-right  <?php endif?>">  
        <section role="main" class="main-content">
        
            <div class="post-list">
                <?php 
                    $temp = $wp_query;
                    $wp_query= null;
                    $wp_query = new WP_Query();
                    $pp = get_option('posts_per_page');
                    $wp_query->query('posts_per_page='.$pp.'&paged='.$paged);			
                    get_template_part( 'loop', 'index' );
                ?>   
        	</div>
        
        </section>
       </div>
      
        <?php if ($layout == '2'):?>
        <div class="col-xs-12 col-sm-5 col-md-3">
            <aside class="sidebar">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
            </aside>
        </div>
        <?php endif?>
      
    </div>
  </div>
</main>
    
<?php get_footer(); ?>