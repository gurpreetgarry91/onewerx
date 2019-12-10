<?php
class BA_Menus
{
	var $root;
	
	public function __construct($root)
	{
		$this->root = $root;

		// setup hooks to create the admin menus
        add_action( 'admin_menu', array( $this, 'create_primary_admin_menu' ), 10 ); // note: set priority to <=9, else the "Goals" custom post type will override the first submenu
		add_action( 'admin_menu', array( $this, 'create_admin_submenus' ), 10 );		
		if ( !$this->root->is_pro() ) {		
			add_action( 'admin_menu', array( $this, 'add_upgrade_menu' ), 20 );	// late, to ensure last position
			add_action( 'admin_head', array( $this, 'admin_menu_css' ) );			
		}
	}
	
	// Creates the "Before & After" menu heading, and adds the Settings submenu to it
	function create_primary_admin_menu()
	{
		// Note: this will also create a child menu with the same name. 
		// We'll override that name in the next step, to make it read "Settings"
		add_menu_page( 
			$this->root->plugin_title . ' Settings',
			$this->root->plugin_title, 
			'manage_options',
			'before-and-after-settings',
			array( $this->root->Settings, 'output_settings_page' )
		);
	}
	
	// Add the submenus to our Before & After primary menu
	function create_admin_submenus()
	{
		// Add Goals as the first item
		add_submenu_page(
			'before-and-after-settings',
			'Goals', 
			'Goals',
			'manage_options', 
			'edit.php?post_type=b_a_goal'
		);

		// allow addons to add menus now
		do_action('before_and_after_add_menus', 'before-and-after-settings');

		// Add the Help & Troubleshooting menu
		add_submenu_page(
			'before-and-after-settings',
			'Help & Troubleshooting', 
			'Help & Troubleshooting',
			'manage_options', 
			'b_a_help_and_troubleshooting',
			array($this->root->Settings, 'render_help_page')
			
		);

		// We want the main menu's label to be "Before & After", but the first submenu's label to be "Settings",
		// so we must override the submenu's label (by default, both would be labeled "Before & After")		
		// IMPORTANT: this code needs to run *after* the other submenus have already been added, else it won't work
		global $submenu;
		$submenu['before-and-after-settings'][0][0] = __('Settings', 'before-and-after');
	}

	// Add the upgrade menu for free users
	function add_upgrade_menu()
	{
		add_submenu_page(
			'before-and-after-settings',
			__('Upgrade To Pro'),
			__('Upgrade To Pro'),
			'administrator',
			'before-and-after-upgrade-to-pro',
			array($this->root->Settings, 'render_upgrade_page')
		);
	}
	
	function admin_menu_css()
	{
		echo '<style>
		#adminmenu .before_and_after_admin_menu ul.wp-submenu > li:last-child > a {
			color: #3ce038;
			font-weight: bold;
		}
		</style>';
	}

	function show_upgrade_page()
	{
		echo "<h3>Upgrade To Before & After Pro</h3>";
		echo "You should upgrade to PRO! Then you'd be tracking Goal Conversions.";
	}
	function show_help_page()
	{
		include('pages/help.html');
	}
	
}