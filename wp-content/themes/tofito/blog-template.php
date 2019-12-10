<?php /* Template Name: Blog Template*/ 

$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '2';
$posts_per_page = rwmb_meta('blog_post_per_page');
$exclude = rwmb_meta( 'blog_page_categories_not' , 'type=taxonomy&taxonomy=category');
$cat_slug = array();
foreach ($exclude as $cat) {
	array_push($cat_slug, $cat->term_id);
}
$pix_options = get_option('pix_general_settings');
$titles = 1;
$blogLayout =  isset ($pix_options['pix_blog_layout']) ? $pix_options['pix_blog_layout'][0] : '0';
?>
<?php get_header();?>


<?php if (isset($woocommerce)) woocommerce_breadcrumb(); ?>
<main class="section" id="main">
  <div class="container">
    <div class="row">
      <?php if ($layout == '3'):?>
      <div class="col-xs-12 col-sm-5 col-md-3">
        <aside class="sidebar">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?>
          <?php   endif;?>
        </aside>
      </div>
      <?php endif?>
      <div class="col-xs-12 col-sm-7 col-md-9">
        <section role="main" class="main-content">
          <?php 
                    $temp = $wp_query;
                    $wp_query= null;
                    $wp_query = new WP_Query();
                    $args = array(
                        'posts_per_page'  => $posts_per_page,
                        'post_type'       => 'post',
                        'paged'           => $paged,
                        'category__not_in' => $cat_slug
                     );
                    $wp_query->query($args);			
                    get_template_part( 'loop', 'index' );
                ?>
        </section>
      </div>
      <?php if ($layout == '2'):?>
      <div class="col-xs-12 col-sm-5 col-md-3">
        <aside class="sidebar">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?>
          <?php   endif;?>
        </aside>
      </div>
      <?php endif?>
    </div>
  </div>
</main>
<?php get_footer();?>
