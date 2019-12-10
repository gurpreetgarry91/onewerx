<?php 
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
        
   
            <?php
				if ( have_posts() ) 
					the_post();
				rewind_posts();       
				get_template_part( 'loop', 'archive' );
            ?>
    
        
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