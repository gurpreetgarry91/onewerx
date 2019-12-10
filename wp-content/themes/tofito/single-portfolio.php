<?php /*** Portfolio Single Posts template. */ 

$pageId = isset ($_SESSION['PixTheme_page_id']) ? $_SESSION['PixTheme_page_id'] : pixtheme_get_page_ID_by_page_template('portfolio-template.php');
$get_meta = get_post_custom($pageId); 

$pix_options = get_option('pix_general_settings');
$portfolio_type = get_post_meta($pageId, "_portfolio_type", $single = false);
$paginationEnabled = (isset($portfolio_type) && !(empty ($portfolio_type))) ? $portfolio_type[0] : 0;
$page_template_name = get_post_meta($pageId,'_wp_page_template',true); 
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '2';

//$sidebar = pixtheme_get_option('sidebar_portfolio');
//$sidebarPos =  pixtheme_get_option('sidebar_pos');

?>



  <div data-dismiss="modal" class="close-modal">
                <span class="icon-close" aria-hidden="true"></span>
            </div>

 <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="modal-body">
                        
                        
                        <h3 class="modal-title"><?php the_title()?></h3>

        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        
        <?php the_content(); ?>  
		
        <?php endwhile; ?>
        
       </div></div></div></div>


      
      <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> <?php _e('Close Project', 'PixTheme')?></button> 
      
      
      
      
      
      
      
      
      
