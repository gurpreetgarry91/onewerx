<?php




/********************* ADMIN LOGO ********************/

function my_login_logo(){
   echo '
   <style type="text/css">
        #login h1 a { background: url('. get_bloginfo('template_directory') .'/images/tofito.png) no-repeat 0 0 !important; 
		height: 35px;
        width: 310px; 
	}
    </style>';
}
add_action('login_head', 'my_login_logo');

add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );
add_filter( 'login_headertitle', create_function('', 'return false;') );




/********************* DEFINE MAIN PATHS ********************/

define('PixTheme_PLUGINS', get_template_directory() . '/addons'); // Shortcut to the /addons/ directory

$adminPath = get_template_directory() . '/library/admin/';
$funcPath  = get_template_directory() . '/library/functions/';
$incPath   = get_template_directory() . '/library/includes/';

global $pix_options;
$pix_options = isset($_POST['options']) ? $_POST['options'] : get_option('pix_general_settings');

/************************************************************/

/* include rwmb metabox */
if (!defined('RWMB_URL') && !defined('RWMB_DIR')) {
    define('RWMB_URL', trailingslashit(get_template_directory_uri() . "/library/functions/meta-box"));
    define('RWMB_DIR', trailingslashit(get_template_directory() . "/library/functions/meta-box"));
}

require_once RWMB_DIR . "meta-box.php";

/************* LOAD REQUIRED SCRIPTS AND STYLES *************/
function PixTheme_loadScripts()
{
    $pix_options = isset($_POST['options']) ? $_POST['options'] : get_option('pix_general_settings');
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_enqueue_style( 'style', get_stylesheet_uri() );
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font/font-awesome/css/font-awesome.min.css');
        wp_enqueue_style('icomoon', get_template_directory_uri() . '/font/icomoon/style.css');
        wp_enqueue_style('simple-line', get_template_directory_uri() . '/font/simple/simple-line-icons.css');
 
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/font/webfont/stylesheet.css');
        wp_enqueue_style('loader', get_template_directory_uri() . '/css/loader.css');
        wp_enqueue_style('bootstrap-min', get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.css');
        wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
        wp_enqueue_style('isotope-theme', get_template_directory_uri() . '/css/isotope.css');
        wp_enqueue_style('prettyphoto', get_template_directory_uri() . '/css/prettyphoto/default.css');
        wp_enqueue_style('prettyphoto-default', get_template_directory_uri() . '/css/prettyphoto/default.css');
        wp_enqueue_style('mobilemenu', get_template_directory_uri() . '/css/mobilemenu.css');
        wp_enqueue_style('theme', get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style('hover', get_template_directory_uri() . '/css/hover-min.css');
        wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
        wp_enqueue_style('innerpage', get_template_directory_uri() . '/css/innerpage.css');
        wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css');
        wp_enqueue_style('bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css');
		wp_enqueue_style('header-animate', get_template_directory_uri() . '/css/header-animate.css');
			wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css');
		
		
		
		
        wp_enqueue_style('debug', get_template_directory_uri() . '/css/debug.css');
    
        wp_enqueue_style('dynamic-styles', get_template_directory_uri() . '/css/dynamic-styles.php');
		
		
		

        
        
        // Register or enqueue scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('cssua', get_template_directory_uri() . '/js/cssua.min.js');
        wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js');
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
        wp_enqueue_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js');
		
        wp_enqueue_script('pathLoader', get_template_directory_uri() . '/js/pathLoader.js');
        wp_enqueue_script('classie', get_template_directory_uri() . '/js/classie.js');
		   wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js');
		   wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js');
		   
		   
		
		
        wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js');
        wp_enqueue_script('isotope-theme', get_template_directory_uri() . '/js/jquery.isotope.min.js');
        wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.min.js');
        wp_enqueue_script('jflickrfeed', get_template_directory_uri() . '/js/jflickrfeed.min.js');
        wp_enqueue_script('sly', get_template_directory_uri() . '/js/sly.min.js');
        wp_enqueue_script('package', get_template_directory_uri() . '/js/package.min.js');
        wp_enqueue_script('jquery.nav', get_template_directory_uri() . '/js/jquery.nav.js');
        wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js');
        wp_enqueue_script('Validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(
            'jquery'
        ), '3.2', true);
		
        
        if (!empty($pix_options['pix_contact_address'])) {
            wp_enqueue_script('Google-map-api', 'http://maps.google.com/maps/api/js?sensor=false');
            wp_enqueue_script('Google-map', get_template_directory_uri() . '/js/gmap3.min.js');
        }
        
        
        if (is_page_template('under-construction.php')) {
            wp_enqueue_script('Under-construction', get_template_directory_uri() . '/js/jquery.countdown.js', array(
                'jquery'
            ), '3.2', true);
        }
    }
}
add_action('wp_enqueue_scripts', 'PixTheme_loadScripts'); //Load All Scripts

function PixTheme_fonts()
{
    global $pix_options;
    $bodyFont     = isset($pix_options['pix_body_font']) ? $pix_options['pix_body_font'] : 'off';
    $headingsFont = (isset($pix_options['pix_headings_font']) && $pix_options['pix_headings_font'] !== 'off') ? $pix_options['pix_headings_font'] : 'off';
    $protocol     = is_ssl() ? 'https' : 'http';
    
    if ($bodyFont != 'off' && $bodyFont != '') {
        $api_font  = str_replace(" ", '+', $bodyFont);
        $font_name = str_replace(" ", '', $bodyFont);
        wp_enqueue_style('PixTheme-' . $font_name, "$protocol://fonts.googleapis.com/css?family=" . $api_font);
    }
    if ($headingsFont != 'off' && $headingsFont != '') {
        $api_font  = str_replace(" ", '+', $headingsFont);
        $font_name = str_replace(" ", '', $headingsFont);
        wp_enqueue_style('PixTheme-' . $font_name, "$protocol://fonts.googleapis.com/css?family=" . $api_font);
    }
    
}
add_action('wp_enqueue_scripts', 'PixTheme_fonts');

/************************************************************/


/********************* DEFINE MAIN PATHS ********************/

require_once($funcPath . 'helper.php');
require_once($incPath . 'OAuth.php');
require_once($incPath . 'twitteroauth.php');
require_once($funcPath . 'options.php');
require_once($incPath . 'portfolio_walker.php');
require_once($funcPath . 'post-types.php');
require_once($funcPath . 'widgets.php');
require_once($funcPath . '/shortcodes/shortcode.php');
require_once($adminPath . 'custom-fields.php');
require_once($adminPath . 'scripts.php');
require_once($adminPath . 'admin-panel/admin-panel.php');
require_once($adminPath . 'admin-panel/class-tgm-plugin-activation.php');
require_once($funcPath . 'functions.php');
require_once($funcPath . 'filters.php');
require_once($funcPath . 'common.php');

// Redirect To Theme Options Page on Activation
if (is_admin() && isset($_GET['activated'])) {
    wp_redirect(admin_url('admin.php?page=adminpanel'));
    unregister_sidebar('header-sidebar');
}

add_action('admin_enqueue_scripts', 'pixtheme_load_custom_wp_admin_style');
function pixtheme_load_custom_wp_admin_style()
{
    wp_register_script('custom_wp_admin_script', get_template_directory_uri() . '/js/custom-admin.js', false, '1.0.0');
    wp_enqueue_script('custom_wp_admin_script');
}
/************************************************************/

$pix_page= get_page_by_title('Blog');
$exclude = rwmb_meta( 'blog_page_categories_not' , 'type=taxonomy&taxonomy=category', $pix_page->ID);

/*************** AFTER THEME SETUP FUNCTIONS ****************/

add_action('after_setup_theme', 'PixTheme_setup');
function PixTheme_setup()
{
    // Language support 
    load_theme_textdomain('PixTheme', get_template_directory() . '/languages');
    $locale      = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if (is_readable($locale_file)) {
        require_once($locale_file);
    }
    
    // ADD SUPPORT FOR POST THUMBS 
    add_theme_support('post-thumbnails');
    // Define various thumbnail sizes
    add_image_size('portfolio-4-col', 270, 206, true);
    add_image_size('portfolio-3-col', 370, 282, true);
    add_image_size('blog-list1', 9999, 9999);
    add_image_size('blog-thumb', 50, 50, true);
    add_image_size('cat-thumb', 240, 300, true);
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array(
        'gallery',
        'quote',
        'video'
    ));
    //ADD SUPPORT FOR WORDPRESS 3 MENUS ************/
    
    add_theme_support('menus');
    //Register Navigations
    add_action('init', 'my_custom_menus');
    function my_custom_menus()
    {
        register_nav_menus(array(
            'primary_nav' => __('Primary Navigation', 'PixTheme'),
            'top_nav' => __('Top Navigation', 'PixTheme'),
            'footer_nav' => __('Footer Navigation', 'PixTheme')
        ));
    }
    
}

$args = array(
    'flex-width' => true,
    'width' => 350,
    'flex-height' => true,
    'height' => 'auto',
    'default-image' => get_template_directory_uri() . '/images/logo.jpg'
);
add_theme_support('custom-header', $args);

$args = array(
    'default-color' => 'FFFFFF'
);
add_theme_support('custom-background', $args);

/************************************************************/

/******* TGM Plugin ********/
add_action('tgmpa_register', 'pix_theme_register_required_plugins');

function pix_theme_register_required_plugins()
{
    
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        
       
        
        
        array(
            'name' => 'Regenerate Thumbnails', // The plugin name
            'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/library/includes/plugins/regenerate-thumbnails.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '2.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '' // If set, overrides default API URL and points to an external URL
        )
        
        
        
        
        
        
    );
    
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'tgmpa'),
            'menu_title' => __('Install Plugins', 'tgmpa'),
            'installing' => __('Installing Plugin: %s', 'tgmpa'), // %s = plugin name.
            'oops' => __('Something went wrong with the plugin API.', 'tgmpa'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa'), // %1$s = plugin name(s).
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'tgmpa'),
            'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'tgmpa'),
            'return' => __('Return to Required Plugins Installer', 'tgmpa'),
            'plugin_activated' => __('Plugin activated successfully.', 'tgmpa'),
            'complete' => __('All plugins installed and activated successfully. %s', 'tgmpa'), // %s = dashboard link.
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    
    tgmpa($plugins, $config);
    
}
/***************************/

/******* FIX THE PORTFOLIO CATEGORY PAGINATION ISSUE ********/

$option_posts_per_page = get_option('posts_per_page');
add_action('init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page()
{
    add_filter('option_posts_per_page', 'my_option_posts_per_page');
}
function my_option_posts_per_page($value)
{
    global $option_posts_per_page;
    if (is_tax('portfolio_category')) {
        $pageId = pixtheme_get_page_ID_by_page_template('portfolio-template3.php');
        if ($pageId) {
            $custom         = get_post_custom($pageId);
            $items_per_page = isset($custom['_page_portfolio_num_items_page']) ? $custom['_page_portfolio_num_items_page'][0] : '777';
            return $items_per_page;
        } else {
            return 4;
        }
    } else {
        return $option_posts_per_page;
    }
}

add_filter('widget_posts_args','pixtheme_modify_widget');
function pixtheme_modify_widget($params) {
	global $exclude;
	$cat_slug = array();
	foreach ($exclude as $cat) {
		array_push($cat_slug, '-'.$cat->term_id);
	}
	$params['cat'] = implode( ',', $cat_slug );
    return $params;
}

add_filter("widget_categories_args", "pixtheme_exclude_categories", 10, 1 );
function pixtheme_exclude_categories($cat_args){
	global $exclude;	
	$cat_slug = array();
	foreach ($exclude as $cat) {
		array_push($cat_slug, $cat->term_id);
	}
	$cat_args['exclude'] = implode( ',', $cat_slug );
	return $cat_args;
}

?>