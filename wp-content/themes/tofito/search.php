
<?php
if( get_post() )
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
        </aside></div>
      <?php endif?>
      
      
    
       <div class="col-xs-12 col-sm-7 col-md-9  <?php if ($layout == '3'):?>  col2-left  <?php endif?>   <?php if ($layout == '2'):?>  col2-right  <?php endif?>">  
        <section role="main" class="main-content">
        
           <?php if ( have_posts() ) : ?>
           <div class="post-list">
                <?php get_template_part( 'loop', 'search' );?>
           </div>
            <?php else : ?>
                <div id="post-0" class="post no-results not-found">
                    <h1><?php _e( 'Nothing Found', 'PixTheme' ); ?></h1>
                    <div class="entry-content">
                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'PixTheme' ); ?></p>
                     </div><!-- .entry-content -->
                </div><!-- #post-0 -->
            <?php endif; ?>
        
        </section></div>
        
        
        
        	 
      
      
        <?php if ($layout == '2'):?>
	<div class="col-xs-12 col-sm-5 col-md-3">
        <aside class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
        </aside></div>
	  <?php endif?>
      
      
      
      
    
    </div>
    </div>
    </main>
    
    
    

  
 

<?php get_footer(); ?>
			
            
            