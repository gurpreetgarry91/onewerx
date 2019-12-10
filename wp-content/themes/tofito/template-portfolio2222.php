<?php 
/**
 * The template for displaying portfolio.
 *
 * @package Pix-Theme
 * @since 1.0
 *

 */
$pageId = $post->ID;
$_SESSION['PixTheme_page_id'] = $pageId;

$get_meta = get_post_custom($post->ID);
$portfolio_type = get_post_meta($post->ID, "_portfolio_type", $single = false);
$page_template_name = get_post_meta($post->ID,'_wp_page_template',true);

	$itemsize = 'row-one';
	$thumbsize = 'portfolio-3-col';
	// Check which layout was selected
	switch($page_template_name)
	{
		case 'portfolio-template-1row.php':
			$itemsize = 'row-one';	
			$thumbsize = 'portfolio-3-col';	
		break;
		
		case 'template-portfolio-2rows.php':
			$itemsize = 'row-two';	
			$thumbsize = 'portfolio-4-col';
		break;		
	}

if( get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = true) != '' ){ 
	$items_per_page = get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = false);
} 
else{ 
// else don't paginate
	$items_per_page[0] = 777;
}

?>
<?php the_content(); ?>


<div class="<?php echo esc_attr($itemsize)?> row-view">


<div class="portfolio-filter-wrap    animated " data-animation="bounceInRight"  >

<div class="anchore-fix-portfolio" id="latest-offers"  ></div>


  <ul class="portfolio-filter <?php echo ' non-paginated' ?>">
    <li><a href="#" class="active" data-filter="*">
      <?php _e('Show All', 'PixTheme')?>
      </a></li>
    <?php 
					$cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);                                                 
					$MyWalker = new PortfolioWalker();
					$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
					$categories = wp_list_categories ($args);
				?>
  </ul>
</div>
<div class="portfolio-frame animated" data-animation="bounceInRight"  >
  <div class="portfolio-slider sly-frame isotope <?php echo esc_attr($itemsize)?>  " >
    <?php if( $cats == '' ): ?>
    <p>
      <?php _e('No categories selected. To fix this, please login to your WP Admin area and set
					the categories you want to show by editing this page and setting one or more categories 
					in the multi checkbox field "Portfolio Categories".', 'Straight')?>
    </p>
    <?php else: ?>
    <?php 	
					// If the user hasn't set a number of items per page, then use JavaScript filtering
					if( $items_per_page == 777 ) : endif; 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					//  query the posts in selected terms
					$portfolio_posts_to_query = get_objects_in_term( explode( ",", $cats ), 'portfolio_category');
				 ?>
    <?php //if (!empty($portfolio_posts_to_query)):
					$wp_query = new WP_Query( array( 'post_type' => 'portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'post__in' => $portfolio_posts_to_query, 'paged' => $paged, 'showposts' => $items_per_page[0] ) );
			 					
					if ($wp_query->have_posts()):  ?>
    <?php while ($wp_query->have_posts()) : 							
						$wp_query->the_post();
						$custom = get_post_custom($post->ID);
							 
						// Get the portfolio item categories
						$cats = wp_get_object_terms($post->ID, 'portfolio_category');
											   
												
						if ($cats){
							$cat_slugs = '';
							foreach( $cats as $cat ){
								$cat_slugs .= $cat->slug . " ";
							}
						}
						?>
    <?php $link = ''; $thumbnail = get_the_post_thumbnail($post->ID, $thumbsize); ?>
    <div class="portfolio-item  <?php echo esc_attr($cat_slugs); ?> isotope-item" >
      <div class="item-thumbnail">
        <?php if (!empty($thumbnail)){ ?>
        <?php the_post_thumbnail($thumbsize, array('class' => 'cover')); ?>
        <?php }else {?>
        <img src="<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="<?php _e ('No preview image', 'PixTheme') ?>" />
        <?php } ?>
        <p class="car-title">
          <?php the_title() ?>
        </p>
      </div>
      <div class="item-hover">
        <div class="details">
          <div class="table">
            <div class="vertical-center">
              <?php	
						$pixtheme_format  = $custom['post_types_select'][0];						
						$pixtheme_format = (empty($pixtheme_format)) ? 'custom' : $pixtheme_format;
						get_template_part( 'template-parts/portfolio-format/portfolio', $pixtheme_format);
					?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <?php endwhile?>
    <?php endif?>
    <?php endif?>
  </div>
  <!--end--> 
  
</div>
<div class="portfolio-navigation home-portfolio-navigation"> <a class="btn btn-primary slider-direction prev-page" ><i class="icomoon-arrow-left2"></i></a> <a class="btn btn-primary slider-direction next-page" ><i class="icomoon-arrow-right2"></i></a> </div></div>


<!--Portfolio Modal Box (No content)-->
<?php 	if ($wp_query->have_posts()): 
    		while ($wp_query->have_posts()) : 							
						$wp_query->the_post(); ?>
	<div class="portfolio-modal modal fade" id="myModal<?php echo $post->ID; ?>"  >
        <div class="modal-content">
          
    
        </div> 
	</div>
    
	<?php endwhile?>
<?php endif?>

