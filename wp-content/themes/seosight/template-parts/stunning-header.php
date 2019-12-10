<?php
/**
 * Template part for displaying aside widgets.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */

$options = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'stunning-show', array() ) : array();
$queried_object = get_queried_object();

$hide_title = $hide_breadcrumbs ='no';
$style = $class = '';
if ( function_exists( 'fw_get_db_customizer_option' ) ) {
	$class = 'stunning-header-custom';

    $bg_overlay           = fw_get_db_customizer_option( 'stunning_overlay', '' );
	$text_color           = fw_get_db_customizer_option( 'stunning_text_color', '' );
	$hide_title           = fw_get_db_customizer_option( 'stunning_hide_title', false );
	$hide_breadcrumbs     = fw_get_db_customizer_option( 'stunning_hide_breadcrumbs', false );

	$enable_customization = fw_get_db_post_option( get_the_ID(), 'custom-stunning/enable', 'no' );
	if ( is_category() ) {
		$enable_customization = fw_get_db_term_option( get_queried_object_id(), 'category', 'custom-stunning/enable', 'no' );
	}elseif(is_tax() && 'fw-portfolio-category' === $queried_object->taxonomy ){
		$enable_customization = fw_get_db_term_option( $queried_object->term_id, $queried_object->taxonomy, 'custom-stunning/enable', 'no' );
	}
	if ( 'yes' === $enable_customization ) {
		$options = fw_get_db_post_option( get_the_ID(), 'custom-stunning/yes/stunning-show', array() );
		if ( is_category() ) {
			$options = fw_get_db_term_option( get_queried_object_id(), 'category', 'custom-stunning/yes/stunning-show', array() );
		}elseif(is_tax() && 'fw-portfolio-category' === $queried_object->taxonomy ){
			$options = fw_get_db_term_option( $queried_object->term_id, $queried_object->taxonomy, 'custom-stunning/yes/stunning-show', array() );

		}
		$custom_title = fw_akg( 'yes/custom-title', $options, '' );
		$hide_title_meta       = fw_akg( 'yes/stunning_hide_title', $options, 'default' );
		$hide_breadcrumbs_meta = fw_akg( 'yes/stunning_hide_breadcrumbs', $options, 'default' );


		$hide_title = ( $hide_title_meta === 'default' ) ? $hide_title : $hide_title_meta;
		$hide_breadcrumbs = ( $hide_breadcrumbs_meta === 'default' ) ? $hide_breadcrumbs : $hide_breadcrumbs_meta;



		$bg_overlay       = fw_akg( 'yes/stunning_overlay', $options, $bg_overlay );
		$text_color       = ! empty( $meta_text_color ) ? $meta_text_color : $text_color;
	}

	if ( ! empty( $text_color ) ) {
        $class .= ' font-color-custom ';
	}
} ?>
<!-- Stunning header -->
<div id="stunning-header" class="stunning-header stunning-header-bg-gray <?php echo esc_attr( $class ) ?>">
    <?php if ( ! empty( $bg_overlay ) && function_exists( 'fw_html_tag' ) ) {
        echo fw_html_tag( 'div', array(
                'class' => 'overlay',
                'style' => 'background-color:' . esc_attr( $bg_overlay )
        ), true );
    } ?>
        <div class="stunning-header-content">
			<?php
			if ( 'yes' !== $hide_title ) {
			    if(!empty($custom_title)){
				    echo '<h1 class="stunning-header-title">' . esc_html( $custom_title ) . '</h1>';
                } elseif ( is_home() ) { ?>
                    <h1 class="stunning-header-title"><?php esc_html_e( 'Latest posts', 'seosight' ); ?></h1>
				<?php } elseif ( is_search() ) { ?>
                    <span class="stunning-header-title h1 page-title">
				<?php printf( esc_html__( 'Search Results for: %s', 'seosight' ), '<h1 class="stunning-header-title">"' . get_search_query() . '"</h1>' ); ?>
			</span>
				<?php } elseif ( function_exists( 'is_shop' ) && is_shop() ) {
					if ( is_shop() && apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
                        <h2 class="stunning-header-title h1"><?php woocommerce_page_title(); ?></h2>
					<?php } elseif ( is_product() ) { ?>
                        <h2 class="stunning-header-title h1"><?php esc_html_e( 'Product Details', 'seosight' ); ?></h2>
					<?php } elseif ( is_cart() || is_checkout() || is_checkout_pay_page() ) {
						the_title( '<h1 class="stunning-header-title h1">', '</h1>' );
					}
				} elseif ( is_page() || is_singular( 'fw-portfolio' ) ) {
					the_title( '<h1 class="stunning-header-title">', '</h1>' );
				} elseif ( is_singular() ) {
					the_archive_title( '<h2 class="stunning-header-title h1">', '</h2>' );
				} else {
					the_archive_title( '<h1 class="stunning-header-title">', '</h1>' );
				}
			}
			if ( function_exists( 'fw_ext_breadcrumbs' ) && ! is_home() && ! is_front_page() && ! is_search() && 'yes' !== $hide_breadcrumbs ) {
				fw_ext_breadcrumbs( '<i class="seoicon-right-arrow"></i>' );
			} ?>
        </div>
</div>
<!-- End Stunning header -->