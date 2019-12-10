<?php /* Template Name: Single Post */ 

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
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?>
          <?php   endif;?>
        </aside>
      </div>
      <?php endif?>
      <div class="col-xs-12 col-sm-7 col-md-9">
      <section role="main" class="main-content">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php esc_attr(the_ID());?>"<?php post_class('post format-image clearfix'); ?>>
          <?php			
                    $pixtheme_format  = get_post_format();
                    $pixtheme_format = !in_array($pixtheme_format, array("quote", "gallery", "video")) ? 'standared' : $pixtheme_format;
                    get_template_part( 'template-parts/post-format/blog', $pixtheme_format);
                    get_template_part( 'template-parts/blog-template/blog', 'template-single');
                ?>
          <h3 class="post-title">
            <?php the_title(); ?>
          </h3>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
          <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
          <div class="post-details"><span class="icon-tag" aria-hidden="true"></span>
            <?php if( has_category() ): ?>
            <?php _e( 'Category: ', 'PixTheme' ); ?>
            <?php the_category( ', ' ); ?>
            <?php endif; ?>
            <?php $tags_list = get_the_tag_list( '', __( ', ', 'PixTheme' ) );
                        if ( $tags_list ) :?>
            <?php printf( __( 'Tags: %1$s', 'PixTheme' ), $tags_list ); ?>
            <?php endif; // End if $tags_list ?>
          </div>
          <?php endif; // End if 'post' == get_post_type() ?>
          <?php wp_link_pages();?>
          </div>
        </article>
        <div class="comments-wrapper">
          <?php comments_template(); ?>
          <?php $test = false; if ($test) {comment_form(); } ?>
        </div>
        <?php endwhile; ?>
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
