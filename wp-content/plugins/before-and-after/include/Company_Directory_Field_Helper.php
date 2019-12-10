<?php

	class Company_Directory_Field_Helper
	{
		function __construct()
		{
			
		}
		
		function render_field($field_type, $search_field)
		{
			$template_path = dirname(dirname(plugin_dir_path( __FILE__ ))) . "/templates/fields/{$field_type}-field.php";
			$view_vars = array(
				'search_field' => $search_field,
			);
			$output = $this->render_template($template_path, $view_vars);
			return $output;
		}

		function render_template($templatePath, $vars = false)
		{
			$templateFile = basename($templatePath);

			// checks if the file exists in the theme first,
			// otherwise serve the file from the plugin
			if ( $theme_file = locate_template( array ( $templateFile ) ) ) {
				$real_template_path = $theme_file;
			} else {
				$real_template_path = $templatePath;
			}

			if (is_array($vars)) {
				extract($vars);
			}

			$html = '' . $real_template_path;
			if (file_exists($real_template_path)) {
				ob_start(); 
				require ($real_template_path);
				$html = ob_get_clean();
			}
			return $html;		
		}
		
		function checkbox_field($search_field)
		{
			return $this->render_field('checkbox', $search_field);
		}
		
		function date_field($search_field)
		{
			return $this->render_field('date', $search_field);
		}
		
		function email_field($search_field)
		{
			return $this->render_field('email', $search_field);
		}
		
		function phone_field($search_field)
		{
			return $this->render_field('phone', $search_field);
		}
		
		function radio_field($search_field)
		{
			return $this->render_field('radio', $search_field);
		}
		
		function select_field($search_field)
		{
			return $this->render_field('select', $search_field);
		}		

		function text_field($search_field)
		{
			return $this->render_field('text', $search_field);
		}
		
	}