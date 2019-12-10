<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Theme Includes
 */
require_once get_template_directory() . '/inc/init.php';

/**
 * TGM Plugin Activation
 */
require_once get_template_directory() . '/TGM-Plugin-Activation/class-tgm-plugin-activation.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function seosight_admin_customizations() {
	// Load admin panel customizations
	wp_enqueue_style(
		'seosight-admin-custom',
		get_template_directory_uri() . '/css/admin.css',
		array(),
		'1.0'
	);
	wp_enqueue_script(
		'seosight-admin-scripts',
		get_template_directory_uri() . '/js/admin-scripts.js',
		array( 'jquery' ),
		'1.0'
	);
}
add_action( 'admin_enqueue_scripts', 'seosight_admin_customizations' );

function seosight_yoast_kc_compitablity() {
    global $pagenow, $typenow;
    if ( empty( $typenow ) && ! empty( $_GET['post'] ) ) {
        $post    = get_post( $_GET['post'] );
        $typenow = $post->post_type;
    }
    if ( ( $pagenow == 'post.php' && $typenow == 'page' ) || ( $pagenow == 'post-new.php' && $typenow == 'page' ) ) {
        wp_enqueue_script('crum-yoast-seo', get_template_directory_uri() . '/js/king-yoast.js', array('jquery'), '', true);
    }
}
if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) || defined( 'WPSEO_VERSION' ) ){
    add_action('admin_enqueue_scripts', 'seosight_yoast_kc_compitablity');
}