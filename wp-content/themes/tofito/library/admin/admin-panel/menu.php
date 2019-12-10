<?php

/*** ADMIN MENU ****/

add_menu_page($theme_name, $theme_name, 'administrator', 'adminpanel', 'adminpanel',  get_template_directory_uri(). '/library/admin/images/logo.png');
	
add_submenu_page('adminpanel', $theme_name, 'General Settings', 'administrator', 'adminpanel', 'adminpanel');


?>
