<?php
class BA_Settings_Page
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
	private $plugin_title;
	private $root;

    /**
     * Start up
     */
    public function __construct($root, $tabs, $media_button = false)
    {
		$this->root = $root;
		$this->plugin_title = $root->plugin_title;
		$this->tabs = $tabs;
		$this->media_button = $media_button;
        add_action( 'admin_init', array( $this, 'setup_tabs' ) );
        add_action( 'admin_init', array( $this, 'admin_scripts' ) );
        add_action( 'admin_init', array( $this, 'create_settings' ) );
        add_action( 'admin_init', array( $this, 'check_for_clear_cookies' ) );
        add_action( 'wp_ajax_b_a_clear_cookies', array( $this, 'check_for_clear_cookies' ) );
    }
	
	function setup_tabs()
	{
		$tabs[] = array(
			'id' => 'contact_form_7', 
			'label' => 'Contact Form 7',
			'callback' => array($this, 'output_contact_form_7_fields'),
			'options' => array('icon' => 'pencil-square-o')
		);
		$tabs[] = array(
			'id' => 'conversion_cookies', 
			'label' => 'Reset Goals',
			'callback' => array($this, 'output_conversion_cookies_fields'),
			'options' => array(
				'icon' => 'refresh',
				'show_save_button' => false
			)
		);
		$tabs[] = array(
			'id' => 'shortcode_generator', 
			'label' => __('Shortcode Generator'),
			'callback' => array($this, 'output_shortcode_generator'),
			'options' => array('icon' => 'wrench')
		);
		
		$tabs = apply_filters('before_and_after_admin_settings_tabs', $tabs);
		foreach($tabs as $tab) {
			$this->tabs->add_tab(
				$tab['id'],
				$tab['label'],
				$tab['callback'],
				$tab['options']
			);
		}
	}
	
	function output_notification_fields()
	{
		// Output notification settings
		do_settings_sections( 'ba_notifications_settings' );
	}
	
	function output_contact_form_7_fields()
	{
		// Output notification settings
		do_settings_sections( 'ba_contact_form_7_settings' );
	}
	
	function output_hubspot_fields()
	{
		// Output notification settings
		do_settings_sections( 'ba_hubspot_settings' );
	}
	
	function output_conversion_cookies_fields()
	{
		// Output notification settings
		$this->output_clear_cookies_button();
	}
	
	function output_shortcode_generator()
	{
		if ( !empty($this->media_button) ) {
			$this->media_button->force_enqueue_admin_scripts();
		}
		?>
		<div id="gold_plugins_shortcode_generator wp-content-wrap">
			<h3>Shortcode Generator</h3>
			<p>Use this page to generate Goal shortcodes that you can use anywhere on your site.</p>
			<p>Instructions:</p>
			<ol>
				<li>Click the Before & After button, below, then select Add Goal</li>
				<li>Select a Goal from the options in the pop-up,</li>
				<li>Click "Insert Now" to finish generating the shortcode.</li>
				<li>Your will appear in the area below - simply copy and paste this into the Page or Post where you would like your Goal to appear!</li>
			</ol>
			
			<div id="before_after_shortcode_generator">
			<?php 
				$content = "";//initial content displayed in the editor_id
				$editor_id = "before_and_after_shortcode_generator";//HTML id attribute for the textarea NOTE hyphens will break it
				$settings = array(
					//'tinymce' => false,//don't display tinymce
					'quicktags' => false,
				);
				wp_editor($content, $editor_id, $settings); 
			?>
			</div>
		</div><!-- end #gold_plugins_shortcode_generator -->
		<?php
	}	
	
	function admin_scripts()
	{
		wp_enqueue_script(
			'gp-admin_v2',
			plugins_url('../assets/js/gp-admin_v2.js', __FILE__),
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script(
			'ba-admin_v1',
			plugins_url('../assets/js/ba-admin_v1.js', __FILE__),
			array( 'jquery' ),
			false,
			true
		);
	}
	
	function check_for_clear_cookies()
	{
		if (isset($_POST['b_a_clear_cookies']) && $_POST['b_a_clear_cookies'] == 'go') {
			$this->clear_goal_cookies();			
			if ( !empty($_POST['is_ajax']) ) {
				$json = json_encode( array(
					'msg' => $this->get_cookies_cleared_message()
				) );
				die( $json );
			} else {
				add_action( 'admin_notices', array($this, 'show_cookies_cleared_message') );			
			}
		}
	}
	
	function get_cookies_cleared_message()
	{
		return __( 'Your conversion cookies have been deleted. You will now see the Before state for all goals.', 'before_and_after' );
	}
	
	function show_cookies_cleared_message()
	{
		?>
		<div class="updated notice">
			<p><?php echo $this->get_cookies_cleared_message(); ?></p>
		</div>
		<?php
	}

	function clear_goal_cookies()
	{
		foreach ($_SESSION as $key => $value)
		{
			// test if $key starts with 'goal_'
			if (strpos($key, 'goal_') === 0) {
				// it does! so delete it
				unset($_SESSION[$key]);
			}
		}

		foreach ($_COOKIE as $key => $value)
		{			
			// delete cookie if it starts with 'b_a_a_g_'
			if (strpos($key, 'b_a_a_g_') === 0) {
				unset($_COOKIE[$key]);
				// set a new cookie with its expiration in the past 
				// so it will be deleted on next page load
				setcookie($key, '', time() - 3600, '/');
			}
		}
	}
	
    /**
     * Options page callback
	 * Note: Called in ba.menus.class, when the user accesses the Settings menu
     */
    public function output_settings_page()
    {	
		// Set class property
        $this->options = get_option( 'b_a_options' );
        ?>
        <div class="wrap before_after_wrapper before_and_after_settings is_pro">
			<h1 style="display:none"></h1>
            <div id="icon-options-general" class="icon32"></div>
			<?php $this->tabs->display(); ?>			
        </div>		
        <?php
    }

    /**
     * Register and add settings
     */
    public function create_settings()
    {        	
		// Generic setting. We need this for some reason so that we have a chance to save everything else.
        register_setting(
            'b_a_option_group', // Option group
            'b_a_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_field(
            'registration_email', // ID
            'Email', // Title 
            array( $this, 'registration_email_callback' ), // Callback
            'ba_registration_settings', // Page
            'registration' // Section           
        );      

        add_settings_field(
            'api_key', // ID
            'API Key', // Title 
            array( $this, 'api_key_callback' ), // Callback
            'ba_registration_settings', // Page
            'registration' // Section           
        );  

        add_settings_section(
            'ba_contact_form_7', // ID
            'Contact Form 7 Settings', // Title
            array( $this, 'print_contact_form_7_section_info' ), // Callback
            'ba_contact_form_7_settings' // Page
        );  
        add_settings_field(
            'reload_page_on_submit', 
            'Reload Page On Submit', 
            array( $this, 'reload_page_on_submit_callback' ), 
            'ba_contact_form_7_settings', 
            'ba_contact_form_7'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
		foreach($input as $key => $value)
		{
			switch($key)
			{
				case 'id_number':
					$new_input['id_number'] = absint( $input['id_number'] );
				break;

				case 'email':
				case 'subject':
				case 'email_body':
				case 'api_key':
				case 'registration_url':
				case 'registration_email':
				case 'portal_id':
				case 'form_guid':
				case 'hubspot_blacklist':
				case 'send_to_hubspot':
				case 'reload_page_on_submit':
					$new_input[$key] = sanitize_text_field( $input[$key] );
				break;

				default: // don't let any settings through unless they were whitelisted. (skip unknown settings)
					continue;
				break;			
			}
		}
		
        return $new_input;
    }

	 /** 
     * Print the Cintact Form 7 Section text
     */
    public function print_contact_form_7_section_info()
    {
        echo '<p>These settings control how Before &amp; After interacts with Contact Form 7.</p>';
    }
	
	function output_clear_cookies_button()
	{
		echo '<div id="conversion_cookies_message"></div>';
		echo '<h3>Reset All Goals For Current User</h3>';
		echo '<p>Click this button to delete all of your own conversion cookies. After this, you will again see the "Before" state of all goals.</p>';
		echo '<p><strong>This will not affect your users. It will only affect you.</strong></p><br>';
		echo '<input type="hidden" name="b_a_clear_cookies" value="go" />';
		echo '<button class="button button-primary" type="button" onclick="clear_conversion_cookies(this);"><span class="fa fa-refresh"></span> &nbsp; Reset Goals To Before State</button>';
	}
				
	public function reload_page_on_submit_callback()
   	{
		$reload_page_on_submit = isset( $options['reload_page_on_submit'] ) ? intval($options['reload_page_on_submit']) : 1;
		$checkbox_input = sprintf(
			'<input type="hidden" name="b_a_options[reload_page_on_submit]" value="0" />' .
			'<input type="checkbox" name="b_a_options[reload_page_on_submit]" id="b_a_options_reload_page_on_submit" value="1" %s />',
            		$reload_page_on_submit ? 'checked="CHECKED"' : ''
        	);
		$desc = 'Reload the page when CF7 forms are completed.';
		printf('<label for="b_a_options_auto_refresh_page">%s %s</label>', $checkbox_input, $desc);
		echo '<p class="description">This way your visitors will go ahead and see the "After" action for your Goal (e.g., your download link).</p>';
    }
	
	/* 
	 * Output the upgrade page
	 */
	function render_upgrade_page()
	{
		//setup coupon box
		$upgrade_page_settings = array(
			'plugin_name' 		=> 'Before And After Pro',
			'pitch' 			=> "When you upgrade, you'll instantly unlock advanced features including Conversion Tracking, Notifications, HubSpot Integration, and more!",
			'learn_more_url' 	=> 'https://goldplugins.com/our-plugins/before-and-after-pro/?utm_source=before_and_after_free&utm_campaign=subscribe_discount&utm_banner=learn_more',
			'upgrade_url' 		=> 'https://goldplugins.com/special-offers/upgrade-to-before-and-after-pro/?discount=success10&utm_source=before_and_after_free&utm_campaign=subscribe_discount&utm_banner=upgrade_page_coupon_box_success',
			'upgrade_url_promo' => 'https://goldplugins.com/special-offers/upgrade-to-before-and-after-pro/?discount=success10&utm_source=before_and_after_free&utm_campaign=subscribe_discount&utm_banner=upgrade_page_coupon_box_success',
			'text_domain' 		=> 'before-and-after',
			'testimonial' => array(
				'title' => 'Highly Recommended',
				'body' => 'The service I received from this company has been excellent and the app itself has been worthwhile. I highly recommend it.',
				'name' => 'Jodi Harrison',
			)
		);
		$img_base_url = plugins_url('../assets/img/upgrade/', __FILE__);
		?>		
		<div class="before_and_after_admin_wrap">
			<div class="gp_upgrade">
				<h1 class="gp_upgrade_header">Upgrade To Before And After Pro</h1>
				<div class="gp_upgrade_body">
				
					<div class="header_wrapper">
						<div class="gp_slideshow">
							<ul>
								<li class="slide"><img src="<?php echo $img_base_url . 'conversion-list.png'; ?>" alt="Screenshot of Conversions List" /><div class="caption">Records a conversion every time your Goals are completed</div></li>
								<li class="slide"><img src="<?php echo $img_base_url . 'conversion-details-1.png'; ?>" alt="Screenshot of a Conversion - Visitor Details" /><div class="caption">Captures visitor details for every conversion</div></li>
								<li class="slide"><img src="<?php echo $img_base_url . 'conversion-details-2.png'; ?>" alt="Screenshot of a Conversion - Conversion Information (e.g., timestamp and IP address)" /><div class="caption">Records IP address, timestamp, and more</div></li>
								<li class="slide"><img src="<?php echo $img_base_url . 'conversion-details-3.png'; ?>" alt="Screenshot of a Conversion - Captured Form Data" /><div class="caption">Captures all form data submitted with your Goals.</div></li>
								<li class="slide"><img src="<?php echo $img_base_url . 'download-log.png'; ?>" alt="Screenshot of Download Log" /><div class="caption">Logs every time your files are downloaded.</div></li>
								<li class="slide"><img src="<?php echo $img_base_url . 'notification-settings.png'; ?>" alt="Screenshot of Notifications Settings" /><div class="caption">Receive an notification email whenever your Goals are completed.</div></li>
								<li class="slide"><img src="<?php echo $img_base_url . 'hubspot-settings.png'; ?>" alt="Screenshot of HubSpot Settings" /><div class="caption">Connect your CF7 and Gravity Forms to HubSpot - automatically!</div></li>
							</ul>
							<a href="#" class="control_next">></a>
							<a href="#" class="control_prev"><</a>							
						</div>

						<script type="text/javascript">
							jQuery(function () {
								if (typeof(b_a_gold_plugins_init_upgrade_slideshow) == 'function') {
									b_a_gold_plugins_init_upgrade_slideshow();
								}
							});
						</script>						
						<div class="customer_testimonial">
								<div class="stars">
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
									<span class="dashicons dashicons-star-filled"></span>
								</div>
								<p class="customer_testimonial_title"><strong><?php echo $upgrade_page_settings['testimonial']['title']; ?></strong></p>
								“<?php echo $upgrade_page_settings['testimonial']['body']; ?>”
								<p class="author">— <?php echo $upgrade_page_settings['testimonial']['name']; ?></p>
						</div>
					</div>
					<div style="clear:both;"></div>
						<p class="upgrade_intro">Before And After Pro is the professional edition of Before And After, which adds conversion tracking, notifications, and other advanced featured. Its a great choice for any company that cares about tracking their leads.</p>
						<div class="upgrade_left_col">
						<div class="upgrade_left_col_inner">
							<h3>Before And After Pro Adds Powerful New Features, Including:</h3>
							<ul>
								<li>Conversion Tracking - Records the time, IP, submitted data, and other visitor information every time a Goal is completed.</li>
								<li>Notifications - Receive an email each time a Goal was completed, containing useful information about the visitor.</li>
								<li>HubSpot Integration - Connect your Contact Form 7 and Gravity Forms to your HubSpot forms.</li>
								<li>Download Logs - Once your visitors have converted, log every time they download your file.</li>
								<li>Outstanding support from our developers - submit tickets from within the plugin.</li>
								<li>A full year of technical support & automatic updates.</li>
							</ul>

							<p class="all_features_link">And many more! <a href="https://goldplugins.com/downloads/before-and-after-pro/?utm_source=before_and_after_upgrade_page_plugin&amp;utm_campaign=see_all_features">Click here for a full list of features included in Before And After Pro</a>.</p>
							<p class="upgrade_button"><a href="https://goldplugins.com/special-offers/upgrade-to-before-and-after-pro/?utm_source=before_and_after_free_plugin&utm_campaign=upgrade_page_button">Learn More</a></p>
						</div>
					</div>
					<div class="bottom_cols">
						<div class="how_to_upgrade">
							<h4>How To Upgrade:</h4>
							<ol>
								<li><a href="https://goldplugins.com/special-offers/upgrade-to-before-and-after-pro/?utm_source=before_and_after_free_plugin&utm_campaign=how_to_upgrade_steps">Purchase an API Key from GoldPlugins.com</a></li>
								<li>Install and Activate the Before &amp; After Pro plugin.</li>
								<li>Go to Before And After Settings &raquo; License Options menu, enter your API key and click Activate.</li>
							</ol>
							<p class="upgrade_more">That's all! Upgrading happens instantly, and won't affect your data..</p>
						</div>
						<div class="questions">
							<h4>Have Questions?</h4>
							<p class="questions_text">We can help. <a href="https://goldplugins.com/contact/">Click here to Contact Us</a>.</p>
							<p class="all_plans_include_support">All plans include a full year of technical support.</p>
						</div>
					</div>
				</div>
				
				<div id="signup_wrapper" class="upgrade_sidebar">
					<div id="mc_embed_signup">
						<div class="save_now">
							<h3>Save 10% Now!</h3>
							<p class="pitch">Subscribe to our newsletter now, and we’ll send you a coupon for 10% off your upgrade to the Pro version.</p>
						</div>
						<form action="https://goldplugins.com/atm/atm.php?u=403e206455845b3b4bd0c08dc&amp;id=a70177def0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
							<div class="fields_wrapper">
								<label for="mce-NAME">Your Name (optional)</label>
								<input value="golden" name="NAME" class="name" id="mce-NAME" placeholder="Your Name" type="text">
								<label for="mce-EMAIL">Your Email</label>
								<input value="services@illuminatikarate.com" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required="" type="email">
								<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
								<div style="position: absolute; left: -5000px;"><input name="b_403e206455845b3b4bd0c08dc_6ad78db648" tabindex="-1" value="" type="text"></div>
							</div>
							<div class="clear"><input value="Send My Coupon" name="subscribe" id="mc-embedded-subscribe" class="whiteButton" type="submit"></div>
							<p class="secure"><img src="/wp-content/plugins/before-and-after/assets/img/lock.png" alt="Lock" width="16px" height="16px">We respect your privacy.</p>
							
							<input id="mc-upgrade-plugin-name" name="mc-upgrade-plugin-name" value="<?php echo htmlentities($upgrade_page_settings['plugin_name']); ?>" type="hidden">
							<input id="mc-upgrade-link-per" name="mc-upgrade-link-per" value="<?php echo $upgrade_page_settings['upgrade_url_promo']; ?>" type="hidden">
							<input id="mc-upgrade-link-biz" name="mc-upgrade-link-biz" value="<?php echo $upgrade_page_settings['upgrade_url_promo']; ?>" type="hidden">
							<input id="mc-upgrade-link-dev" name="mc-upgrade-link-dev" value="<?php echo $upgrade_page_settings['upgrade_url_promo']; ?>" type="hidden">
							<input id="gold_plugins_already_subscribed" name="gold_plugins_already_subscribed" value="0" type="hidden">
						</form>					
					</div>
					
				</div>
			</div>
		</div>
		<script type="text/javascript">
		jQuery(function () {
			if (typeof(b_a_gold_plugins_init_coupon_box) == 'function') {
				b_a_gold_plugins_init_coupon_box();
			}
		});
		</script>
		<?php
	} 	
	
	//output the help page
	function render_help_page()
	{		
		//instantiate tabs object for output basic settings page tabs
		$tabs = new GP_Sajak( array(
			'header_label' => 'Help &amp; Instructions',
			'settings_field_key' => 'before-and-after-help-settings-group', // can be an array	
			'show_save_button' => false, // hide save buttons for all panels   		
		) );
		
		//$this->settings_page_top(false);
		
		
		$tabs_array[] = array (
			'id' 	=> 'help', // section id, used in url fragment
			'label' =>	'Help Center', // section label
			'callback' => array($this, 'output_help_page'), // display callback
			'options' => array(
				'class' => 'extra_li_class', // extra classes to add sidebar menu <li> and tab wrapper <div>
				'icon' => 'life-buoy' // icons here: http://fontawesome.io/icons/
			)
		);
				
		$tabs_array = apply_filters('before_and_after_admin_help_tabs', $tabs_array);		
		
		foreach( $tabs_array as $tab ) {
			$tabs->add_tab( 
				$tab['id'],
				$tab['label'],
				$tab['callback'],
				$tab['options']
			);
		}
		$tabs->display();
		
	//	$this->settings_page_bottom();
	}
	
	function output_help_page(){
		?>
		<h3>Help Center</h3>
		<div class="help_box">
			<h4>Have a Question?  Check out our FAQs!</h4>
			<p>Our FAQs contain answers to our most frequently asked questions.  This is a great place to start!</p>
			<p><a class="before_and_after_support_button" target="_blank" href="https://goldplugins.com/documentation/before-after-documentation/before-after-faqs/?utm_source=help_page">Click Here To Read FAQs</a></p>
		</div>
		<div class="help_box">
			<h4>Looking for Instructions? Check out our Documentation!</h4>
			<p>For a good start to finish explanation of how to add Testimonials and then display them on your site, check out our Documentation!</p>
			<p><a class="before_and_after_support_button" target="_blank" href="https://goldplugins.com/documentation/before-after-documentation/?utm_source=help_page">Click Here To Read Our Docs</a></p>
		</div>
		<?php		
	}	
	
}
