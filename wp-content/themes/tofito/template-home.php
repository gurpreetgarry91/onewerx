<?php 
/**
 * The template for displaying page blocks.
 *
 * @package PixTheme
 * @since 1.0
 *
 * Template Name: Home
 */
get_header();

	// get the slider
	$pixtheme_slider = get_post_meta(get_the_ID(), 'homepage_slider', true);
		
?>
	<section id="home" class="section home-slider" >
		<?php echo pixtheme_get_theme_generator('pixtheme_slideshow', $pixtheme_slider); ?>
	</section>

	<?php 
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_parent'    => $post->ID,
			'order'          => 'ASC', 
			'orderby'        => 'menu_order'
		);
		$q = new WP_Query($args);
	?>



	<?php if ( $q->have_posts() ) : while (  $q->have_posts() ) :  $q->the_post(); ?>

	<?php 
		$custom_color = get_post_meta(get_the_ID(), 'cs_homepage_bgcolor', true);
		$bg_image = get_post_meta(get_the_ID(), 'homepage_bgimage', true);
		$src = wp_get_attachment_image_src($bg_image, 'full');

		$style = ($bg_image) ?'background-image:url('.$src[0].');':''; 
		$bg_color = ($custom_color) ? 'background-color:'.$custom_color : '';
		
		$page_template_name = get_post_meta($post->ID,'_wp_page_template',true);
	?>
	
	<?php
		if(pixtheme_get_slug(get_the_id()) == 'contact') { 
		?>

    
    
    	<section  >
        

        
            			<?php if ($style) { ?> <div class='bg' style="<?php echo esc_attr($style); ?>"   > </div>
                         <?php } ?>
                        
                        
                                <div class="point-contact" id="contact" ></div>
                                
                                
                
    		<?php get_template_part('template-contact'); ?>		
	</section>
    
    
	<?php } elseif($page_template_name == 'template-portfolio-1row.php' || $page_template_name == 'template-portfolio-2rows.php') { 
		?>
	<section  class="section section-white" >
    		<?php get_template_part('template-portfolio'); ?>		
	</section>
    
    
	<?php } else {  ?>
	<section class="<?php echo pixtheme_get_slug(get_the_id()); ?>" style=" <?php echo esc_attr($bg_color); ?> ">
    
    <div class="point-section" id="<?php echo pixtheme_get_slug(get_the_id()); ?>" ></div>
    
    
    	<?php if ($style) { ?> <div class="bg" style="<?php echo esc_attr($style); ?>"> </div> <?php } ?>
		<div class="container">
			<div class="row">
				<!-- BEGIN -->
				<?php the_content(); ?>
				
				<!-- END -->
			</div>
		</div>
	</section>
	<?php } endwhile ;endif; ?>
    
    
    
    		<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js'></script>
            <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.easypiechart.js'></script>


        


	<?php get_footer(); ?>

