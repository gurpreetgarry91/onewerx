<?php
class BA_Goal_Model
{
    /**
     * Holds the values to be used in the fields callbacks
     */
	const post_type = 'b_a_goal';
	private $root;
	private $plugin_title;

    /**
     * Start up
     */
    public function __construct($root)
    {
		$this->root = $root;
		$this->plugin_title = $root->plugin_title;
		$this->setup_custom_post_type();
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'wp_ajax_before_and_after_complete_goal', array( $this, 'ajax_complete_goal_by_id' ) );
		add_action( 'wp_ajax_nopriv_before_and_after_complete_goal', array( $this, 'ajax_complete_goal_by_id' ) );
		add_action( 'wp_enqueue_scripts', array($this, 'register_cookie_script') );
		add_filter( 'the_content', array($this, 'single_goal_content_filter') );
		add_action( 'added_user_meta', array($this, 'unhide_goals_in_menu_editor'), 10, 4 );		
		add_filter( 'manage_b_a_goal_posts_columns', array($this, 'output_custom_columns_head'), 10 );  
		add_action( 'manage_b_a_goal_posts_custom_column', array($this, 'output_custom_columns_content'), 10, 2 ); 
		add_action( 'template_redirect', array($this, 'catch_goal_protected_pages') ); 
	}
	
	function admin_init()
	{
		add_filter('manage_edit-goal_columns', array( $this, 'add_new_columns' ));
		add_filter('manage_edit-goals_columns', array( $this, 'add_new_columns' ));
		add_action('manage_goal_posts_custom_column', array( $this, 'manage_goal_columns' ), 10, 2);
	}
	
	function manage_goal_columns($column_name, $id) {
		global $wpdb;
		switch ($column_name) {
		case 'id':
			echo $id;
				break;
			
		case 'goal_shortcode':
/* 			$goal_id = intval(get_post_meta($id, 'goal_id', true));
			if ($goal_id > 0) {
				$my_goal = get_post($goal_id);
				$goal_title = apply_filters('the_title', $my_goal->post_title);
				$my_admin_url = admin_url( 'post.php?post=' . $goal_id . '&action=edit');
				$my_link = '<a class="row-title" href="' . $my_admin_url .'">' . htmlentities($goal_title) . '</a>';
				echo $my_link;
			} else {
				echo "";				
			}
 */
			echo '[goal id="' . $id . '"]';
			break;

			case 'complete_goal_shortcode':
			echo '[complete_goal id="' . $id . '"]';
			break;
			
		default:
			break;
		} // end switch
	}
	
	function add_new_columns($gallery_columns) {
		$gc = $this->array_put_to_position($gallery_columns, __('Complete Goal Shortcode'), 2, 'complete_goal_shortcode');
		$gc = $this->array_put_to_position($gallery_columns, __('Goal Shortcode'), 2, 'goal_shortcode');
		return $gc;
	}
	
	function array_put_to_position(&$array, $object, $position, $name = null)
	{
			$count = 0;
			$return = array();
			foreach ($array as $k => $v)
			{  
					// insert new object
					if ($count == $position)
					{  
							if (!$name) $name = $count;
							$return[$name] = $object;
							$inserted = true;
					}  
					// insert old object
					$return[$k] = $v;
					$count++;
			}  
			if (!$name) $name = $count;
			if (!$inserted) $return[$name];
			$array = $return;
			return $array;
	}		
	
	private function setup_custom_post_type()
	{
		// create the Goal custom post type
		$postType = array('name' => 'Goal', 'plural' => 'Goals', 'slug' => 'b_a_goals');
		$fields = array();
		$args = array(
			'supports' => array( 'title' ) // notably *not* thumbnail, comments, author, page attributes, etc
		);
		$args = apply_filters('b_a_goal_cpt_args', $args);
/* 		$fields[] = array('name' => 'before_goal_content', 'title' => 'Before', 'description' => 'Show this text to the user BEFORE they have completed this goal.', 'type' => 'textarea');	
		$fields[] = array('name' => 'after_goal_content', 'title' => 'After', 'description' => 'Show this text to the user AFTER they have completed this goal.', 'type' => 'textarea');	 */
		$this->root->custom_post_types[] = new B_A_CustomPostType($postType, $fields, true, $args);

		// setup the meta boxes on the Add/Edit Goal screen
		add_action('init', array($this, 'remove_unneeded_metaboxes')); // remove some default meta boxes
		add_action( 'admin_menu', array( $this, 'add_meta_boxes' ) ); // add our custom meta boxes

		// add a hook to save the new values of our Goal settings whenever the Goal is saved
		add_action( 'save_post', array( $this, 'save_goal_settings' ), 1, 2 );
		add_action( 'save_post', array( $this, 'save_page_protection_settings' ), 1, 2 );

		// add a special link to the Row Actions menu of each Goal, which displays the visitors who have completed the goal
		add_filter('page_row_actions', array( $this, 'add_page_row_actions' ), 10, 2);
		add_filter('post_row_actions', array( $this, 'add_page_row_actions' ), 10, 2);

	}

	// adds a special link to the Row Actions menu, to display the visitors who have completed each goal
	function add_page_row_actions($actions, $page_object)
	{
		if ($page_object->post_type == self::post_type)
		{
			unset($actions['view']); // remove View link
			unset($actions['inline hide-if-no-js']); // remove Quick Edit link
			$actions = apply_filters('before_and_after_admin_goals_row_actions', $actions, $page_object);
		}
		
		return $actions;
	}
	
	// saves the per-Goal settings. called whenever the Goal is saved
	function save_goal_settings()
	{
		global $post;
		
		// make sure  that the nonce matches and the user has permission to edit this goal
		if (!isset($_POST[ 'b_a_goal_settings_nonce' ]) || !wp_verify_nonce( $_POST[ 'b_a_goal_settings_nonce' ], 'b_a_goal_settings' ) ||
			!current_user_can( 'edit_post', $post->ID ) || 
			$post->post_type != self::post_type)
		{
			return;
		}
		
		$this->update_goal_setting_from_post($post->ID, 'before-action', '_goal_before_action');
		$this->update_goal_setting_from_post($post->ID, 'after-action', '_goal_after_action');
		$this->update_goal_setting_from_post($post->ID, 'before-values', '_goal_before_values');
		$this->update_goal_setting_from_post($post->ID, 'after-values', '_goal_after_values');
		
		// special: if the before-action is a contact form 7 or a gravity form, we need to save an extra meta value now so that we can query it later
		if ( $_POST[ 'before-action' ] == 'contact_form_7' && isset($_POST['before-values']['contact_form_7']) ) {
			$form_id = intval($_POST['before-values']['contact_form_7']);
			$goal_selector = 'cf7_' . $form_id;
		} else if ( $_POST[ 'before-action' ] == 'gravity_form' && isset($_POST['before-values']['gravity_form']) ) {
			$form_id = intval($_POST['before-values']['gravity_form']);
			$goal_selector = 'gform_' . $form_id;
		} else {
			$goal_selector = 'none';
		}
		update_post_meta($post->ID, '_goal_selector', $goal_selector);
		
		// add download keys for protected downloads
		if ( $_POST[ 'after-action' ] == 'file_url' ) {
			$this->add_download_keys($post->ID);
		}
	}
	
	function add_download_keys($goal_id)
	{
		// if this Goal already has a download key do not overwrite it
		$cur_key = get_post_meta($goal_id, '_b_a_download_key', true);
		if ( !empty($cur_key) ) {
			return;
		}
		
		// this Goal does not have a download key, so generate and save a random download key now
		$new_download_key = 'd_' . substr(md5(rand()), 0, 10) . substr(md5($goal_id), 0, 10);
		add_post_meta($goal_id, '_b_a_download_key', $new_download_key, true);
	}
		
	function save_page_protection_settings()
	{
		global $post;
				
		// return if b_a_protection fields are not present
		if ( empty($_POST['b_a_protection']) ) {
			return;
		}

		// make sure that the nonce matches and the user has permission to edit this page/post
		if ( empty($post)
			 || !in_array($post->post_type, array('post', 'page') )
			 || !current_user_can( 'edit_post', $post->ID )
			) {
			return;
		}
		
		$settings = $_POST['b_a_protection'];
		$enabled = !empty($settings) && !empty($settings['enabled']) ? 1 : 0;		
		
		$goal_id = !empty($settings['goal_id'])
						   ? $settings['goal_id']
						   : 0;
		
		$bounce_url = !empty($settings['bounce_url'])
					  ? $settings['bounce_url']
					  : '';

		$new_value = compact('enabled', 'goal_id', 'bounce_url');		
		update_post_meta( $post->ID, '_b_a_required_goal', $new_value );

		if ($enabled) {
			update_post_meta( $post->ID, '_b_a_protected', '1' );
		} else {
			delete_post_meta($post->ID, '_b_a_protected');
		}
	}
	
	
	
	// remove unneeded meta boxes from the Goal custom post type
	function remove_unneeded_metaboxes()
	{
		remove_post_type_support( self::post_type, 'editor' ); // note: may remove this later and replace with a custom field
		remove_post_type_support( self::post_type, 'excerpt' );
		remove_post_type_support( self::post_type, 'comments' );
		remove_post_type_support( self::post_type, 'author' );		
		remove_post_type_support( self::post_type, 'page-attributes' );		
		remove_post_type_support( self::post_type, 'thumbnail' );		
	}

	// add our custom meta boxes to capture per-Goal settings
	function add_meta_boxes()
	{
		add_meta_box( 'goal_before', 'Before', array( $this, 'display_before_meta_box' ), self::post_type, 'normal', 'high' );
		add_meta_box( 'goal_after', 'After', array( $this, 'display_after_meta_box' ), self::post_type, 'normal', 'high' );
		add_meta_box( 'goal_shortcodes', 'Shortcodes', array( $this, 'display_shortcodes_meta_box' ), self::post_type, 'side', 'default' );
		add_meta_box( 'before_and_after_protection', 'Before &amp; After', array( $this, 'display_protection_meta_box' ), array('post', 'page'), 'normal', 'default' );
	}
	
	// creates the "Before" meta box
	function display_before_meta_box()
	{
		global $post;
		?>
		<div class="form-wrap">
			<?php wp_nonce_field( 'b_a_goal_settings', 'b_a_goal_settings_nonce', false, true ); ?>
			<p>BEFORE the user has completed this goal, what should happen?</p>
			<ul class="b_a_options">
				<?php if (false): ?>
				<li>
					<input type="radio" name="before-action" id="before-redirect-page" value="redirect_page" <?php echo $this->is_radio_checked($post->ID, 'before-action', 'redirect_page')?> />
					<label for="before-redirect-page">Redirect to this page:</label>
					<div class="secondary-option form-field">
						<?php
							$currentPageId = $this->get_goal_setting_value($post->ID, 'before-values', 'redirect_page');
							$args = array(  'name' => 'before-values[redirect_page]',
											'selected' => $currentPageId,
									);
							wp_dropdown_pages($args);
						?>
					</div>
				</li>
				<li>
					<input type="radio" name="before-action" id="before-redirect-url" value="redirect_url" <?php echo $this->is_radio_checked($post->ID, 'before-action', 'redirect_url')?> />
					<label for="before-redirect-url">Redirect to this URL:</label>
					<div class="secondary-option form-field">
						<input type="text" name="before-values[redirect_url]" value="<?php echo $this->get_goal_setting_value($post->ID, 'before-values', 'redirect_url')?>"/>
					</div>
				</li>
				<?php endif; ?>
				<?php
					if(defined('WPCF7_VERSION')):
						$cf7_forms = $this->get_all_cf7_forms();
						if (is_array($cf7_forms) && count($cf7_forms) > 0):
				?>
				<li>
					<input type="radio" name="before-action" id="before-cf7-form" value="contact_form_7" <?php echo $this->is_radio_checked($post->ID, 'before-action', 'contact_form_7')?> />
					<label for="before-cf7-form">Show a Contact Form 7 form:</label>
					<div class="secondary-option form-field">
						<select name="before-values[contact_form_7]">
							<?php foreach($cf7_forms as $cf7_form): ?>
							<?php echo $this->display_option($post->ID, 'before-values', 'contact_form_7', $cf7_form->post_title, $cf7_form->ID); ?>
							<?php endforeach; ?>
						</select>
					</div>
				</li>
					<?php endif; // end "if has any cf7 forms" ?>
				<?php endif; // end "is_defined(WPCF7_VERSION)" ?>
				<?php
					if(class_exists('RGFormsModel')):
						$gravity_forms = RGFormsModel::get_forms( null, 'title' );
						if (is_array($gravity_forms) && count($gravity_forms) > 0): 							
				?>
				<li>
					<input type="radio" name="before-action" id="before-gravity-form" value="gravity_form" <?php echo $this->is_radio_checked($post->ID, 'before-action', 'gravity_form')?> />
					<label for="before-gravity-form">Show a Gravity Form:</label>
					<div class="secondary-option form-field">
						<select name="before-values[gravity_form]">
							<?php foreach($gravity_forms as $gravity_form): ?>
							<?php echo $this->display_option($post->ID, 'before-values', 'gravity_form', $gravity_form->title, $gravity_form->id); ?>
							<?php endforeach; ?>
						</select>
					</div>
				</li>
					<?php endif; // end "if has any gravity forms" ?>
				<?php endif; // end "if RGFormsModel exists" ?>
				<li>
					<input type="radio" name="before-action" id="before-text" value="free_text" <?php echo $this->is_radio_checked($post->ID, 'before-action', 'free_text')?> />
					<label for="before-text">Show the following text:</label>
					<div class="secondary-option form-field">
						<textarea name="before-values[free_text]" rows="5"><?php echo htmlentities( $this->get_goal_setting_value($post->ID, 'before-values', 'free_text') ); ?></textarea>
						<p class="description">HTML and shortcodes are allowed.</p>
					</div>
				</li>
			</ul>
			
			<?php if ( !defined('WPCF7_VERSION') && !class_exists('RGFormsModel') ): ?>
			<p><strong>Tip:</strong> Try installing <a href="https://plugins.wordpress.org/plugins/contact-form-7" target="_blank">Contact Form 7</a> or <a href="http://gravityforms.com" target="_blank">Gravity Forms</a> to add more options to this area!</p>
			<?php endif; ?>
			
			
		</div>
		<?php
	}

	// creates the "After" meta box
	function display_after_meta_box()
	{
		global $post;
		?>
		<div class="form-wrap">
			<p>AFTER the user has completed this goal, what should happen?</p>
			<ul class="b_a_options">
				<li>
					<input type="radio" name="after-action" id="after-redirect-page" value="redirect_page" <?php echo $this->is_radio_checked($post->ID, 'after-action', 'redirect_page')?> />
					<label for="after-redirect-page">Redirect to this page:</label>
					<div class="secondary-option form-field">
						<?php
							$currentPageId = $this->get_goal_setting_value($post->ID, 'after-values', 'redirect_page');
							$args = array(  'name' => 'after-values[redirect_page]',
											'selected' => $currentPageId,
									);
							wp_dropdown_pages($args);
						?>
					</div>
				</li>
				<li>
					<input type="radio" name="after-action" id="after-redirect-url" value="redirect_url" <?php echo $this->is_radio_checked($post->ID, 'after-action', 'redirect_url')?> />
					<label for="after-redirect-url">Redirect to this URL:</label>
					<div class="secondary-option form-field">
						<input type="text" name="after-values[redirect_url]" value="<?php echo $this->get_goal_setting_value($post->ID, 'after-values', 'redirect_url')?>"/>
					</div>
				</li>
				<li>
					<input type="radio" name="after-action" id="after-file-url"  value="file_url" <?php echo $this->is_radio_checked($post->ID, 'after-action', 'file_url')?>/>
					<label for="after-file-url">Link to a file to download:</label>
					<div class="dependent-option form-field">
						<label for="after-file-url">File URL:</label>
						<input type="text" name="after-values[file_url]" value="<?php echo $this->get_goal_setting_value($post->ID, 'after-values', 'file_url')?>" />
						<p class="description"><?php _e('A public URL where the file can be found.');?></p>
					</div>
					<div class="dependent-option form-field">
						<label for="after-file-url">File Name:</label>
						<input type="text" name="after-values[file_name]" value="<?php echo $this->get_goal_setting_value($post->ID, 'after-values', 'file_name')?>" placeholder="download.pdf" />
						<p class="description"><?php _e('Leave blank to use the file name from the URL.'); ?></p>
					</div>
					<div class="dependent-option form-field">
						<label for="after-file-url">Link Text</label>
						<input type="text" name="after-values[download_link_text]" value="<?php echo $this->get_goal_setting_value($post->ID, 'after-values', 'download_link_text', 'Please click here to complete your download.')?>" />
						<p class="description"><?php _e('The text to use for the download link.'); ?></p>
					</div>
					<div class="dependent-option form-field">
						<label for="after-file-url-no-key">Send users who try to download without completing the Goal to this URL:</label>
						<input type="text" name="after-values[file_url_no_key]" value="<?php echo $this->get_goal_setting_value($post->ID, 'after-values', 'file_url_no_key')?>" />
						<p class="description"><?php _e('Usually a URL where this Goal displayed.'); ?></p>
					</div>
				</li>
				<li>
					<input type="radio" name="after-action" id="after-text" value="free_text" <?php echo $this->is_radio_checked($post->ID, 'after-action', 'free_text')?> />
					<label for="after-text">Show the following text:</label>
					<div class="secondary-option form-field">
						<textarea name="after-values[free_text]" rows="5"><?php echo htmlentities( $this->get_goal_setting_value($post->ID, 'after-values', 'free_text') );?></textarea>
					</div>
				</li>
			</ul>
		</div>
		<?php
			
	}
	
	/* Displays a meta box with the shortcodes to display and complete the current goal */
	function display_shortcodes_meta_box()
	{
		global $post;
		$goal_code = sprintf('[goal id="%d"]', $post->ID);
		$complete_goal_code = sprintf('[complete_goal id="%d"]', $post->ID);
		$textarea_tmpl = '<div class="gp_code_example_wrapper"><textarea rows="1" class="gp_code_example">%s</textarea></div>';
		echo "<p>Add this shortcode to the page where you would like to <strong>display</strong> this goal:</p>";
		printf($textarea_tmpl, $goal_code);
		echo "<p>If you're using Contact Form 7 or Gravity Form, the goal will be automatically completed when the form is submitted.</p>";
		echo "<p>Otherwise, you can add this shortcode to any page (e.g., your Thank You page) to <strong>manually mark the goal as complete</strong>:</p>";
		printf($textarea_tmpl, $complete_goal_code);
	}

	/* Displays a meta box allowing the user to protect the current page with a Goal*/
	function display_protection_meta_box()
	{
		// init
		global $post;
		$has_b_a_hook = get_post_meta($post->ID, '_b_a_required_goal', true);
		$enabled = !empty($has_b_a_hook) && !empty($has_b_a_hook['enabled'])
				   ? 1
				   : 0;
				
		$current_goal_id = !empty($has_b_a_hook) && !empty($has_b_a_hook['goal_id'])
						   ? $has_b_a_hook['goal_id']
						   : 0;
		
		$bounce_url = !empty($has_b_a_hook) && !empty($has_b_a_hook['bounce_url'])
					  ? $has_b_a_hook['bounce_url']
					  : '';
					  
		// output form inputs
		
		echo '<h4>Page Protection</h4>';
		echo '<p><em>Enable Page Protection to require your visitors to complete one of your Goals before they can access this page. User who have not completed the Goal will be directed to the URL of your choice.</em></p>';

		echo '<p>';
		$checked = $enabled ? 'checked="checked"' : '';
		echo '<input type="hidden" name="b_a_protection[enabled]" value="0" />';
		printf( '<label for="b_a_protection_enabled"><input type="checkbox" id="b_a_protection_enabled" name="b_a_protection[enabled]" value="1" %s />Enable Page Protection</label>', $checked );
		echo '</p>';
		
		echo '<div id="b_a_page_protection_advanced_options" style="">';

		echo '<p>';
		printf( '<input type="hidden" name="b_a_protection[goal_id]" value="%d" />', $current_goal_id );
		echo '<label for="b_a_protection_goal_id">Require Visitors To Complete This Goal Before Viewing This Page:</label><br />';
		$this->generate_post_select( 'b_a_protection[goal_id]', 'b_a_protection_goal_id', self::post_type, $current_goal_id);
		echo '</p>';
		
		echo '<p>';
		echo '<label for="b_a_protection_bounce_url">Send users who have not completed the goal to this URL:</label><br />';
		printf( '<input type="hidden" name="b_a_protection[bounce_url]" value="%s" />', htmlentities($bounce_url) );
		printf( '<input class="widefat" type="text" id="b_a_protection_bounce_url" name="b_a_protection[bounce_url]" value="%s" />', htmlentities($bounce_url) );
		echo '</p>';
		
		echo '</div>';
		
		echo '<script type="text/javascript">';
		echo 'jQuery(function () {
				var update_opts = function () {
					var enabled = jQuery("#b_a_protection_enabled").attr("checked");
					var opts = jQuery("#b_a_page_protection_advanced_options").find("select, input[type=\"text\"]");
					var labels = jQuery("#b_a_page_protection_advanced_options").find("label");
					if ( enabled ) {
						labels.css("color", "black");
						opts.removeAttr("disabled");
					}
					else {
						labels.css("color", "gray");
						opts.attr("disabled", "disabled");
					}
				};			
				jQuery("#b_a_protection_enabled").on("click change", update_opts);
				update_opts();
		});';
		echo '</script>';
	}
	
	function generate_post_select($select_id, $select_name, $post_type, $selected = 0, $include_select_all_option = false)
	{
        $post_type_object = get_post_type_object($post_type);
        $label = $post_type_object->label;
		$args = array(
			'post_type'=> $post_type,
			'post_status'=> 'publish',
			'suppress_filters' => false,
			'posts_per_page'=> -1
		);
        $posts = get_posts($args);

        echo '<select name="'. $select_id .'" id="'.$select_id.'">';
		if ($include_select_all_option) {
			echo '<option value = "" >' . __('All') . $label .' </option>';
		}
        foreach ($posts as $post) {
            echo '<option value="', $post->ID, '"', $selected == $post->ID ? ' selected="selected"' : '', '>', $post->post_title, '</option>';
        }
        echo '</select>';
    }	
	
	/* 
	 * Returns true/false, indicating whether the specified goal has been completed 
	 * based on the users cookies / session
	 *
	 * @param	string	$goalName	Required. The name of the goal to check.
	 * @param	int		$goalId		Optional. The ID of the goal to check. Needed to check
	 *								cookies as well as session. Cookie check will be ignored
	 *								if omitted, but session check will remain in place.
	 */
	public function wasGoalCompleted($goalName, $goalId = 0)
	{
		$goal_completed = false;
		
		if ($goalId == 0) {
			$goalId = filter_var($goalName, FILTER_SANITIZE_NUMBER_INT);
		}
		
		// check for a cookie first 
		if ( $goalId > 0 && $this->check_cookie_for_goal($goalId) ) {
			$goal_completed = true;
		}
		// if not found in the cookies, check $_SESSION
		else if ( $this->check_goal_complete_in_session($goalName) ) {
			$goal_completed = true;
		}

		// allow the user to modify the result with a filter, then return it
		return apply_filters('b_a_was_goal_complete', $goal_completed, $goalName, $goalId);
	}
	
	/* Place a session variable that marks the current visitor as having completed the specified goal
	 * Note: this function does not support Conversion logging. Use completeGoalById for that (names were only used in v1, before conversions were added)
	*/
	public function completeGoal($goalName)
	{
		$alreadyCompleted = $this->wasGoalCompleted($goalName);
		if (!$alreadyCompleted) {
			$params = array(
				'goal_name' => $goalName,
				'goal_id' => false,
			);
			do_action('b_a_goal_complete', $params);
		}
		$this->store_goal_completion_cookies($goalName);
		return '';
	}

	/* Place a session variable that marks the current visitor as having completed the specified goal 
	 * Note: Will also log a conversion (Pro only)
	*/
	function completeGoalById($goalId, $goal_complete_url = '')
	{
		$goalName = 'Goal_ID_' . $goalId;
		$alreadyCompleted = $this->wasGoalCompleted($goalName, $goalId);
		$goal_after_action = get_post_meta($goalId, '_goal_after_action', true);
		
		if (!$alreadyCompleted) {
			$params = array(
				'goal_name' => $goalName,
				'goal_id' => $goalId,
				'goal_complete_url' => $goal_complete_url,
				'goal_after_action' => $goal_after_action
			);
			do_action('b_a_goal_complete', $params);
			do_action('b_a_goal_complete_' . $goalId, $params);			
		}

		// mark this goal as completed (in the session)
		$this->store_goal_completion_cookies($goalName, $goalId);

		return '';
	}
	
	// saves the value of a POST variable to the database
	private function update_goal_setting_from_post($post_id, $request_key, $meta_key)
	{
		if ( !empty($_POST[$request_key]) )
		{
			$val = $_POST[$request_key];
			return update_post_meta($post_id, $meta_key, $val);
		} else {
			return false;
		}
	}

	// returns the "checked" attribute for a radio button, depending on whether the setting specified matches the test value specified
	// returns either the string 'checked="checked"', or an empty string ''. These are intended to be used inside an <input type="radio" /> HTML tag
	private function is_radio_checked($goal_id, $setting_name, $setting_value)
	{
		if ($setting_name == 'before-action') {
			$val = get_post_meta($goal_id, '_goal_before_action', true);
		}
		else if ($setting_name == 'after-action') {
			$val = get_post_meta($goal_id, '_goal_after_action', true);		
		}
		if ($val == $setting_value) {
			return 'checked="checked"';			
		} else {
			return '';
		}
	}
	
	// returns a formatted HTML <option> tag with the specified settings
	private function display_option($goal_id, $setting_location, $setting_key, $option_text, $option_value = '')
	{
		$val = $this->get_goal_setting_value($goal_id, $setting_location, $setting_key);
		if($option_value == '') {
			$option_value = $option_text;
		}
		$selected = false;
		if($option_value == $val) {
			$selected = true;
		}
		$html = '<option value="' . htmlspecialchars($option_value) . '"';
		if ($selected) {
			$html .= ' selected="selected"';
		}
		$html .= '>' . htmlspecialchars($option_text) . '</option>';
		return $html;
	}

	public function get_goal_setting_value($goal_id, $setting_location, $setting_key, $default_value = '', $allow_empty = true)
	{
		if ($setting_location == 'before-values') {
			$vals = get_post_meta($goal_id, '_goal_before_values', true);
		}
		else if ($setting_location == 'after-values') {
			$vals = get_post_meta($goal_id, '_goal_after_values', true);		
		}
		
		if( $vals && is_array($vals) && isset($vals[$setting_key]) && ( $allow_empty || !empty($vals[$setting_key]) ) ) {
			return $vals[$setting_key];
		} else {
			return $default_value;
		}		
	}
	
	private function get_all_cf7_forms()
	{
		return get_posts(
			array(
				'post_type' => 'wpcf7_contact_form',
				'posts_per_page' => -1,
				'nopaging' => true,
				'orderby' => 'title',
				'order' => 'ASC'				
			)
		);		
	}	
	
	/*  
	 * Sets a cookie and a session variable marking the specified goal as complete.
	 *  
	 * @param	string	$goalName	Required. The name of the goal to check.
	 * @param	int		$goalId		Optional. The ID of the goal to check. Needed to check
	 *								cookies as well as session. Cookie check will be ignored
	 *								if omitted, but session check will remain in place.
	 */
	function store_goal_completion_cookies($goalName, $goalId = 0)
	{
		// mark this goal as completed in the session
		$this->mark_goal_complete_in_session($goalName);
		
		// back in the day, we didn't have goal IDs. So if one wasn't passed in,
		// try to figure it out by stripping out the non-integer chars
		if ($goalId == 0) {
			$goalId = filter_var($goalName, FILTER_SANITIZE_NUMBER_INT);
		}

		// if we found a valid goal ID, store a cookie marking it complete
		if ($goalId > 0) 
		{
			if ( !headers_sent() ) {
				// we haven't set the headers yet, so we can simply
				// set the cookie in the normal fashion
				$this->save_cookie_for_goal($goalId);
			}
			else {
				// it looks like the headers have already been sent, so
				// we'll have to make an AJAX call after the page loads
				// in order to set the cookies safely
				$this->set_cookie_for_goal_on_page_load($goalId);
			}
		}
	}
	
	/*  
	 * Stores a $_SESSION key marking the specified goal as complete
	 *  
	 * Used in conjunction with check_goal_complete_in_session()
	 *  
	 * @param	string	$goalName	Required. The name of the goal to set. 
	 *								Usually, they are: 'Goal_ID_' . $goalId
	 */
	function mark_goal_complete_in_session($goalName)
	{
		$sessionKey = 'goal_' . md5($goalName);
		$sessionValue = 'goal_completed_' . md5($goalName);
		$_SESSION[$sessionKey] = $sessionValue;		
	}
	
	/*  
	 * Checks the $_SESSION to see if the specified goal is marked complete.
	 * NOTE: even if not marked as complete in the session, a goal can be marked
	 * as completed by a cookie.
	 *  
	 * @param	string	$goalName	Required. The name of the goal to set. 
	 *								Usually, they are: 'Goal_ID_' . $goalId
	 */
	function check_goal_complete_in_session($goalName)
	{
		$sessionKey = 'goal_' . md5($goalName);
		$sessionValue = 'goal_completed_' . md5($goalName);
		return (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] == $sessionValue);
	}
	
	/*  
	 * Enqueues Javascript which will set a cookie to mark the goal as complete
	 * upon the next page load (via AJAX).
	 *  
	 * @param	int		$goalId		Required. The ID of the goal to complete.
	 */
	function set_cookie_for_goal_on_page_load($goalId)
	{
		$localize_vars = array(
			'before_and_after_user_vars' => array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'goal_to_complete' => $goalId,
				'complete_nonce' => wp_create_nonce('b_a_complete_goal_' . $goalId)
			)
		);
		$this->enqueue_cookie_script( $localize_vars );
	}
	
	/*  
	 * Sets a cookie marking the specified goal as complete.
	 * 
	 * Intended to be used via AJAX. Its easier to set cookies	via AJAX, as 
	 * there are no worries about echoing headers after output has started.
	 *  
	 * All params passed via $_REQUEST.
	 *  	 
	 * @param	integer	$_REQUEST['goal_id']	Required. The goal ID to mark as complete.
	 * @param	string	$_REQUEST['nonce']	Required. Wordpress nonce, created via
	 *										wp_create_nonce('b_a_complete_goal_' . $goal_id)
	 *  
	 */
	function ajax_complete_goal_by_id()
	{
		// check for required params
		if (empty($_REQUEST['goal_id']) || intval($_REQUEST['goal_id']) == 0 || empty($_REQUEST['nonce']) ) {
			echo "FAIL";
			wp_die();
		} else {		
			$goal_id = intval($_REQUEST['goal_id']);
		}
		
		// verify_nonce
		if ( !wp_verify_nonce( $_REQUEST['nonce'], 'b_a_complete_goal_' . $goal_id ) ) {
			echo "FAIL";
			wp_die();
		}
		
		// set cookie marking this goal as complete
		$this->save_cookie_for_goal($goal_id);
		
		// return safely
		echo 'OK';
		wp_die();
	}
	
	function save_cookie_for_goal($goal_id)
	{
		$cookieName = $this->get_cookie_name_for_goal($goal_id);
		$cookieValue = $this->get_cookie_value_for_goal($goal_id);
		$expiration_time = time() + (60 * 60 * 24 * 30); // 30 days
		setcookie($cookieName, $cookieValue, $expiration_time, '/');
	}

	function check_cookie_for_goal($goal_id)
	{
		$cookieName = $this->get_cookie_name_for_goal($goal_id);
		$cookieValue = $this->get_cookie_value_for_goal($goal_id);
		return ( !empty($_COOKIE[$cookieName]) && strcmp($_COOKIE[$cookieName], $cookieValue) === 0 );
	}

	function delete_cookie_for_goal($goal_id)
	{
		$cookieName = $this->get_cookie_name_for_goal($goal_id);
		$expiration_time = time() - 3600; // set expiration in past so cookie expires on next page load
		unset($_COOKIE[$cookieName]);		
		setcookie($cookieName, '', $expiration_time, '/');
	}
	
	function get_cookie_name_for_goal($goal_id)
	{
		$goalName = sprintf('Goal_ID_%d', $goal_id);
		return sprintf('b_a_a_g_%s_c', substr(md5($goalName), 0, 10));
	}

	function get_cookie_value_for_goal($goal_id)
	{
		return substr( md5( 'goal_completed_' . md5($goal_id) . get_site_url() ), 10, 12);
	}
	
	function register_cookie_script()
	{
		wp_register_script(
			'before_and_after-cookies',
			plugins_url('../assets/js/ba-cookies.js', __FILE__),
			array( 'jquery' ),
			false,
			true
		);
	}

	function enqueue_cookie_script( $localize_vars = array() )
	{
		wp_enqueue_script( 'before_and_after-cookies' );
		if ( !empty($localize_vars) ) {
			foreach ($localize_vars as $key => $value) {
				wp_localize_script('before_and_after-cookies', $key, $value);
			}
		}
	}

	function single_goal_content_filter($content)
	{
		if ( empty($this->in_widget) && empty($this->root->in_widget) && get_post_type() == 'b_a_goal' ) {
			global $post;
			$sc = sprintf('[goal id="%d"]', $post->ID);
			return do_shortcode($sc);
		}
		return $content;
	}
	
	/*
	 * Shows Before & After Goals shown by default on the menu editor screen.
	 *
	 * Background:
	 *
	 * Starting with WordPress 3.0, Custom Post Types are hidden from the menu 
	 * editor, but only when the user has never visited the menu editor screen
	 * before. This is caused by the odd way WordPress initializes the list of
	 * metaboxes to show on this screen (see wp_initial_nav_menu_meta_boxes).
	 * 	 
	 * Because there is not an appropriate filter to do so, we'll wait until 
	 * this value is first saved, and remove Before & After goals from the list
	 * of hidden metaboxes. This way only the initial setting is affected - if 
	 * a user explicitly hides our Goals they will remain hidden.
	 */
	function unhide_goals_in_menu_editor($mid, $object_id, $meta_key, $meta_value = '')
	{
		if ($meta_key == 'metaboxhidden_nav-menus') {
			$old_value = $meta_value;
			if(($key = array_search('add-post-type-b_a_goal', $meta_value)) !== false) {
				unset($meta_value[$key]);
				update_metadata('user', $object_id, $meta_key, $meta_value, $old_value);
			}
		}
	}
	
	function output_custom_columns_head($defaults)
	{
		// create array of custom columns to  insert into Goals post list
		$cols_to_add = array();
		$cols_to_add["b_a_goal_shortcode"] = __('Shortcode', 'before-and-after');
		$cols_to_add = apply_filters('before_and_after_admin_goals_list_columns', $cols_to_add, $defaults);
		
		// insert our custom columns at the 3rd position
		$defaults = 
			array_slice($defaults, 0, 2, true) +
			$cols_to_add + 
			array_slice($defaults, 2, count($defaults)-2, true);			
		return apply_filters('b_a_admin_columns_head', $defaults);
	}
	
	function output_custom_columns_content($column_name, $post_ID)
	{
		if ($column_name == 'b_a_goal_shortcode') {
			$my_shortcode = sprintf('[goal id="%d"]', $post_ID);
			printf('<textarea rows="1" onclick="this.select();" class="gp_code" style="height: 2em; margin-top: 10px; max-width:100%%">%s</textarea>', $my_shortcode);
		}		
		do_action('b_a_admin_columns_content', $column_name, $post_ID);
	}
	
	function goal_id_completed($goal_id)
	{
		$goal_name = 'Goal_ID_' . $goal_id;
		return $this->wasGoalCompleted($goal_name, $goal_id);
	}
	
	/* Enforces B&A's page protection */
	function catch_goal_protected_pages()
	{
		global $post;
		
		if ( empty($post) ) {
			return;
		}
		
		$is_protected = get_post_meta($post->ID, '_b_a_protected', true);
		if ( !empty($is_protected) ) {
			$has_b_a_hook = get_post_meta($post->ID, '_b_a_required_goal', true);
			if ( !empty($has_b_a_hook) ) {
				$complete = $this->goal_id_completed( $has_b_a_hook['goal_id'] );				
				if ( !$complete && !empty($has_b_a_hook['enabled']) && !empty($has_b_a_hook['bounce_url']) ) {
					// redirect visitor to specified bounce URL
					if ( wp_redirect($has_b_a_hook['bounce_url']) ) {
						exit;
					}
				}
			}
		}
	}
}
