<?php
/**
* Header Template
*
* Here we setup all logic and XHTML that is required for the header section of all screens.
*
* @package WooFramework
* @subpackage Template
*/
?>
<!DOCTYPE html>
<html class="noIE" <?php language_attributes(); ?>>
<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2351020966738534",
    enable_page_level_ads: true
  });
</script>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>
<?php bloginfo('name'); ?>
<?php wp_title(); ?>
</title>
<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php  $pix_options = get_option('pix_general_settings'); ?>
<?php if(!empty($pix_options['pix_favicon'])):?>
<link rel="shortcut icon" href="<?php echo esc_url($pix_options['pix_favicon']) ?>" />
<?php endif?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php 
		if (isset($pix_options['pix_custom_css'])) 
			echo "<style type=\"text/css\">".$pix_options['pix_custom_css']."</style>";
   		$bodyFont = isset($pix_options['pix_body_font']) ? $pix_options['pix_body_font'] : 'off';
		$headingsFont =(isset($pix_options['pix_headings_font']) && $pix_options['pix_headings_font'] !== 'off') ? $pix_options['pix_headings_font'] : 'off';
		$menuFont = (isset($pix_options['pix_menu_font']) && $pix_options['pix_menu_font'] !== 'off') ? $pix_options['pix_menu_font'] : 'off';
	
		$fonts['body, p'] = $bodyFont;
		$fonts['h1, h2, h3, h4, h5, h6, html .accordion-heading .accordion-toggle , html .products-grid .product-name a,.products-list .product-name a'] = $headingsFont;
		$fonts['html #dc_jqmegamenu_widget-2-item ul li a']  = $headingsFont;
		
		foreach ($fonts as $value => $key)
		{
			if($key != 'off' && $key != ''){ 
				$api_font = str_replace(" ", '+', $key);
				$font_name = pixtheme_font_name($key);
				
				echo "<style type=\"text/css\">".$value."{ font-family: '".esc_attr($key)."' !important; }</style>";			
			}
		}
	?>
<?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>   >


<div class="<?php if (is_front_page()){?>home-page<?php } else { ?> not-front<?php } ?>">

<?php 
	if( ($pix_options['pix_loader'] == 1 && is_front_page()) || $pix_options['pix_loader'] == 2){
?>

<div id="ip-container" class="ip-container">
<header class="ip-header">
  <div class="ip-loader">
    <div class="ip-logo "> <a title="pixtheme" href="<?php echo home_url() ?>"  class="logo ">
      <?php if(!empty($pix_options['pix_logo'])):?>
      <img src="<?php echo esc_url($pix_options['pix_logo']) ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" />
      <?php elseif ( get_header_image() ):?>
      <img src="<?php header_image(); ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" />
      <div class="logo-desc"> <?php echo isset($pix_options['pix_logotext']) ? $pix_options['pix_logotext'] : '' ?></div>
      <?php else:?>
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" />
      <div class="logo-desc"> <?php echo isset($pix_options['pix_logotext']) ? $pix_options['pix_logotext'] : '' ?></div>
      <?php endif?>
      </a> </div>
      
      
    <svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
    <path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,39.3,10z"/>
    <path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
    </svg> </div>
</header>
</div>

<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/loader.js'></script>

<?php 
	}
?>

<!-- Loader end -->





<header id="ha-header"  class="ha-header">
			
				


<?php if(!empty($pix_options['pix_header_img'])):?>
<div style="background-image:url(<?php echo esc_url($pix_options['pix_header_img']) ?>);" class="page-img">
<?php else:?>
<div style="background-image:url(<?php echo get_template_directory_uri() ?>/images/page-img.jpg);" class="page-img">
<?php endif?>



  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="logo "> <a title="pixtheme" href="<?php echo home_url() ?>" id="logo" class="logo ">
          <?php if(!empty($pix_options['pix_logo'])):?>
          <img src="<?php echo esc_url($pix_options['pix_logo']) ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" id="logo-image" />
          <?php elseif ( get_header_image() ):?>
          <img src="<?php header_image(); ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" id="logo-image" />
          <div class="logo-desc"> <?php echo isset($pix_options['pix_logotext']) ? $pix_options['pix_logotext'] : '' ?></div>
          <?php else:?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" id="logo-image" />
          <div class="logo-desc"> <?php echo isset($pix_options['pix_logotext']) ? $pix_options['pix_logotext'] : '' ?></div>
          <?php endif?>
          </a> </div>
      </div>
      <div class="col-sm-12 col-md-9 col-lg-9">
      
    <?php /*?>  
       <nav class="topmenu">
     <?php
                    wp_nav_menu(array( 
                        'theme_location' => 'top_nav',
                        'menu' =>'top_nav', 
                        'container'=>'', 
                        'depth' => 1, 
                        'menu_class' => 'nav pull-right btn-group-top-desctop'
                        ));
                    ?>
       </nav><?php */?>
       
                
        <nav role="navigation" class="main-nav clearfix">
        	<?php echo pixtheme_get_theme_generator('pixtheme_site_menu', 'menu main-menu hidden-xs'); ?>
        </nav>
        
        
        
        
      </div>
    </div>
  </div>
</div>




</header>


<!-- HEADER -->
<?php if (!is_page_template('under-construction.php')):?>
<?php endif; ?>
