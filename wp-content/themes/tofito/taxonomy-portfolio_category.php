<?php get_header();
get_template_part('portfolio_header'); 
	//global $paged;
 	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	$pageId = $_SESSION['PixTheme_page_id'];
	if (!$pageId) $pageId = pixtheme_get_page_ID_by_page_template('portfolio-template-3columns.php');
	$get_meta = get_post_custom($pageId);
	//$weblusive_sidebar_pos = $get_meta["_weblusive_sidebar_pos"][0];
	//get_template_part( 'library/includes/page-head' ); 

	$portfolio_type = get_post_meta($pageId, "_portfolio_type", $single = false);
	$paginationEnabled = (isset($portfolio_type) && !(empty ($portfolio_type))) ? $portfolio_type[0] : 0;
	$page_template_name = get_post_meta($pageId,'_wp_page_template',true); 


	$itemsize = 'column-three';	
	$itemlayout = 'span4';	
	$colnumber = 3;
	$thumbsize = 'portfolio-3-col';
	// Check which layout was selected
	switch($page_template_name)
	{
		case 'portfolio-template-3columns.php':
			$itemsize = 'column-three';	
			$thumbsize = 'portfolio-3-col';
			$itemlayout = 'span4';
			$colnumber = 3;			
		break;
		
		case 'portfolio-template-4columns.php':
			$itemsize = 'column-four';	
			$thumbsize = 'portfolio-4-col';
			$itemlayout = 'span3';	
			$colnumber = 4;
		break;		
	}
?>






<main class="section" id="main">
  <div class="container">
    <div class="row"> 
    
    
    
    
		<?php echo pixtheme_getPageContent($pageId); ?>
        
         <div class="portfolio-filter-wrap   <?php echo esc_attr($itemsize)?> ">
         
<ul class="portfolio-filter">
			<li><a href="<?php echo get_page_link($pageId) ?>"><?php _e('Show All', 'PixTheme')?></a></li>
			<?php 
				$cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
				$MyWalker = new PortfolioWalker2();
				$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
				$categories = wp_list_categories ($args);
			?>
			<!-- End Portfolio Navigation -->
		</ul>
        
       </div>
       

        
                
       <div class="portfolio-frame" >
      <div class="portfolio-slider sly-frame isotope <?php echo esc_attr($itemsize)?>" >
      
      
			<?php
            $counter=1;
			if ($wp_query->have_posts()):
				while ($wp_query->have_posts()) : 							
					$wp_query->the_post();
					$custom = get_post_custom($post->ID);
					// Get the portfolio item categories
					$cats = wp_get_object_terms($post->ID, 'portfolio_category');
					if ($cats):
						$cat_slugs = '';
						foreach( $cats as $cat ) {$cat_slugs .= $cat->slug . " ";}
					endif;
					$link = ''; $thumbnail = get_the_post_thumbnail($post->ID, $thumbsize);
					?>
						
             <div class="portfolio-item  <?php echo esc_attr($cat_slugs); ?> isotope-item" >

          <div class="item-thumbnail"> 
          
        <?php if (!empty($thumbnail)){ ?>
								<?php the_post_thumbnail($thumbsize, array('class' => 'cover')); ?>
							<?php }else {?>
								 <img src="<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="<?php _e ('No preview image', 'PixTheme') ?>" />
							<?php } ?>	
                            
                            
            <p class="car-title"><?php the_title() ?></p>
          </div>
          
          <div class="item-hover">
            <div class="details">
              <div class="table">
                <div class="vertical-center">
                  <div class="detail-item">
                  
            
                   
               
                  
                  
                  	<p><?php echo pixtheme_limit_words(get_the_excerpt(), 20) ?></p>
								<?php if( !empty ( $custom['_portfolio_video'][0] ) ) : $link = $custom['_portfolio_video'][0]; ?>
									<a class="btn"  href="<?php echo esc_url($link) ?>" class="button btn-icon fancybox-video fancybox.iframe"   >
										<i class="icon-film icon-large"></i>
									</a>
								<?php elseif( isset($custom['_portfolio_link'][0]) && $custom['_portfolio_link'][0] != '' ) : ?>
									<a class="btn"  href="<?php echo esc_url($custom['_portfolio_link'][0]) ?>" class="button btn-icon" target="_blank"  >
										<i class="icon-external-link icon-large"></i>
									</a>
								<?php elseif(  isset( $custom['_portfolio_no_lightbox'][0] )  &&  $custom['_portfolio_no_lightbox'][0] !='' ) : $link = get_permalink(get_the_ID());  ?>
									<a class="btn"  href="<?php echo esc_url($link); ?>" class="button btn-icon-link" >
										<i class="fa fa-location-arrow icon-large"></i>
									</a>
								<?php else : ?>
									<?php  
										$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
										$link = $full_image[0];
									?>
									<a class="btn"  href="<?php echo esc_url($link) ?>" class="button btn-icon"   >
										<i class="icon-zoom-in icon-large"></i>
									</a>
								<?php endif?>			
                                   </div>

                                
                                 </div>
              </div>
            </div>
          </div>
          
        </div>	
                    
					<?php $counter++; endwhile; ?>				
				<?php endif?>
			</div>
			<?php if ($paginationEnabled ):?>
				<?php if ( $wp_query->max_num_pages > 1 ): ?>
					<div class="pagination-list blog-pagination">
						<?php include(PixTheme_PLUGINS . '/wp-pagenavi.php' ); wp_pagenavi(); ?> 
						<div class="clear"></div>
					</div>
				<?php endif?>
			<?php endif?>		

</div></div></main>


<?php get_footer() ?>