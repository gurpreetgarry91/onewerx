<?php
// don't call file directly
if ( !defined( 'ABSPATH' ) )
    exit;

/*
 * Main class that holds the entire plugin
 */
class PWP_Lytebox {

    // public settings (are setted by site admin) 
    public $settings = array();
    // color themes available in plugin
    private $colors = array();     
    
    /*
     * Constructor 
     * Sets up all the appropriate hooks and actions
     */
    function __construct() {
        // is auto add all found pictures to the group (group has forvard/backvard buttons)
        $this->settings = array(
            'autogroup'  => get_option( 'pwpl_autogroup', '1' ),
            'colortheme' => get_option( 'pwpl_colortheme', 'black' ),
            'resizespeed' => get_option( 'pwpl_resizespeed', '5' ),
            );

        // Localize plugin
        add_action( 'init', array($this, 'localization_setup') );
                
        // Loads scripts and styles
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
        //add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_scripts') );

        register_activation_hook( PWPL_MAIN_FILE, array($this, 'on_activate') );
        register_deactivation_hook( PWPL_MAIN_FILE, array($this, 'on_deactivate') );

        // Settings
        add_action( 'admin_menu', array( $this, 'options_page'   ) );
        add_action( 'admin_init', array( $this, 'settings'       ) );
        // Add settings link on plugins list
        add_filter( 'plugin_action_links', array( $this, 'settings_link' ), 10, 2 );

        // add lydebox data to anchors
        add_filter('the_content', array($this, 'add_lytebox_data') );
    }

    /*
     * Initialize plugin for localization
     */
    public function localization_setup() {
        load_plugin_textdomain( 'pwpl', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

        // place it here to localise values
        $this->colors = array ( 
            'black' => __('Black' ,'pwpl'), 
            'grey'  => __('Gray'  ,'pwpl'), 
            'red'   => __('Red'   ,'pwpl'), 
            'green' => __('Green' ,'pwpl'), 
            'blue'  => __('Blue'  ,'pwpl'), 
            'gold'  => __('Gold'  ,'pwpl'), 
            'orange'=> __('Orange','pwpl'),
            );
    }
    
    /*
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        // styles
        wp_enqueue_style( 'pwpl-styles',   plugins_url( 'lytebox/lytebox.css', __FILE__ ), array(), date('Y-m-d') );
        // scripts
        wp_enqueue_script( 'pwpl-scripts',         plugins_url( 'scripts.js', __FILE__ ),  array('jquery'), date('Y-m-d'), true );
        wp_enqueue_script( 'pwpl-lytebox-scripts', plugins_url( 'lytebox/lytebox.js', __FILE__ ),  array('jquery'), date('Y-m-d'), true );

        // Localize and vars for javascripts
        wp_localize_script( 'pwpl-lytebox-scripts', 'pwpl', array(
            'colortheme' => $this->settings['colortheme'],
            'resizespeed' => $this->settings['resizespeed'],
        ) );
    }

    /*
     * Activation function
     */
    public function on_activate() {
        // make plugin options
		$options = array(
			'pwpl_autogroup' => get_option( 'pwpl_autogroup', 1 ),
			'pwpl_colortheme' => get_option( 'pwpl_colortheme', 'black' ),
			'pwpl_resizespeed' => get_option( 'pwpl_resizespeed', '5' ),
		);
		foreach ( $options as $key => $value ) {
			update_option( $key, $value );
		}
    }

    /*
     * Deactivation function
     */
    public function on_deactivate() {
    }



	/***********************************************************
     *
     * OPTIONS
     *
     **********************************************************/
    /*
	 * Options page
	 */
	public function options_page() {
		add_options_page(
			"PWP Lytebox Settings",         // title
			'PWP-Lytebox',                          // menu
			'manage_options',                       // capability
			'pwpl',                                 // menu slug
			array( $this, 'options_page_content' )  // content
		);
	}
	/*
	 * Options page content
	 */
	public function options_page_content() {
		?>
		<div class="wrap">
			<h2>PWP Lytebox Settings</h2>
			<form action="options.php" method="POST" id="pwpl-options-form">
				<?php
					settings_fields( 'pwpl' );        // pwpl - 'name' of my settings page
					do_settings_sections( 'pwpl' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/*
	 * Register settings and settings sections
	 */
	public function settings() {
		// Add settings section named 'pwpl_options' to settings page 'pwpl'
		add_settings_section( 'pwpl_options', 
                              __('Main settings','pwpl'), 
                              '', 
                              'pwpl' );
		// Settings
		$sets = array(
			'pwpl_colortheme' => array(
				'label'    => __( "Theme", 'pwpl' ),
				'callback' => 'pwpl_colortheme_cb',
			),
			'pwpl_resizespeed' => array(
				'label'    => __( "Resize speed", 'pwpl' ),
				'callback' => 'pwpl_resizespeed_cb',
			),
			'pwpl_autogroup' => array(
				'label'    => __( "Autogroup", 'pwpl' ),
				'callback' => 'pwpl_autogroup_cb',
			),
		);
		foreach ( $sets as $id => $settings ) {
            // add settings fields to settings section 'pwpl_options' on settings page 'pwpl'
			add_settings_field( $id, $settings['label'], array( $this, $settings['callback'] ), 'pwpl', 'pwpl_options' );

			// set sanitize callback functions to check user's input for settings fields
			$sanitize_callback = str_replace( 'pwpl', 'sanitize', $id );
			register_setting( 'pwpl', $id, array( $this, $sanitize_callback ) );
		};
    }
    public function pwpl_colortheme_cb(){
        ?>
        <p><select name="pwpl_colortheme">
        <?php foreach ($this->colors as $color_id=>$color_name ) {
            echo '<option '.($color_id==$this->settings['colortheme']?'selected':'').' value="'.$color_id.'">'.$color_name.'</option>';
        } ?>
        </select><span style="padding-left:20px;"><?php _e('Color scheme of modal window','pwpl'); ?></span></p>
        <?php
    }
    public function sanitize_colortheme( $option ) {
        $valid_colors = array_keys($this->colors);
        if ( in_array($option, $valid_colors) ) return $option;
        return 'black';
    }

    public function pwpl_resizespeed_cb(){
        ?>
        <p><input name="pwpl_resizespeed" class="regular-text" style="width:75px;" type="text" value="<?php echo esc_attr( $this->settings['resizespeed'] ); ?>" />
        <span style="padding-left:20px;"><?php _e('1-slowest, 10-fastest', 'pwpl'); ?></span>
        </p>
        <?php
    }    
    public function sanitize_resizespeed( $option ) {
        $option = absint ($option);
        if ( $option > 10 ) return 10;
        if ( $option < 1 )  return 1;
        return $option;
    }

    public function pwpl_autogroup_cb(){
		?>
		<p><label><input name="pwpl_autogroup" type="checkbox" value="1" <?php if ( $this->settings['autogroup'] ) echo 'checked="checked"'; ?> /><?php _e('Auto add all found images to a group', 'pwpl'); ?></label></p>
        <p><i><?php _e('When disabled, all opening pictures will not have "next" and "prev" buttons to see other images from the page, until you manually add <b>data-lyte-options="group:GROUP-NAME-HERE"</b> attribute in &lt;a&gt; tags of images you want to be groupped.', 'pwpl'); ?></i></p>
		<?php
    }
    public function sanitize_autogroup( $option ) {
        if ( $option ) return 1;
        return 0;
    }


    /*
     * Add settings link to plugins list page
     */
    public function settings_link( $links, $file ) {
        if ( $file == PWPL_MAIN_FILE ) {
            array_unshift( $links, sprintf( '<a href="%s">%s</a>',
                                            admin_url( 'options-general.php?page=pwpl' ),
                                            __( 'Settings', 'pwpl' )
            ) );
        }
        return $links;
    }
    /******************
     *  END OPTIONS
     ******************/

    /*
     * Add lytebox data to links
     */ 
    public function add_lytebox_data($content){
        global $post;
        // only those <a...><img...></a>, which have not "class" property in <a tag
        /*$content = preg_replace('|<a((?:(?!class).)+?><img.*?<\/a>)|is', '<a class="lytebox" data-lyte-options="group:pageimages"'.'$1', $content);
*/
        $out = array();
        preg_match_all('|(<a.*?>)(.+?)(</a>)|i', $content, $out, PREG_SET_ORDER);

        if ( !count($out) ) return $content; 

        foreach ( $out as $o) {
            $full_match = $o[0]; // we'll need it as search-mask later
            $open_a = $o[1];
            $anchor = $o[2];
            $close_a = $o[3];

            // use lytebox only for links pointing on images
            // do not use lytebox when link ends with ? or & symbol
            if (    preg_match('/href=.*?\.(gif)|(jpe?g)|(png).*?[\'\"]/is', $open_a) 
                && !preg_match('/href=.*?[?&][\'\"]/is', $open_a) ){

                // if the link already has a class property, add new class to existing ones
                if ( preg_match('|class=|', $open_a) ){
                    $open_a = preg_replace('|class=([\'\"])(.*?)([\'\"])|is', 'class=$1$2 lytebox$3', $open_a);
                }
                // else - create it
                else{
                    $open_a = str_replace('<a', '<a class="lytebox"', $open_a);
                }

                // auto make all pictures-links groupped
                if ($this->settings['autogroup']){
                    $open_a = str_replace('<a', '<a data-lyte-options="group:pageimages"', $open_a);
                }

                $replacement = $open_a.$anchor.$close_a;
                $content = str_replace ( $full_match, $replacement, $content );
            }

        }

        return $content;
    }
}

