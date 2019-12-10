<?php
/**
 * Replace default walker.
 *
 * @package seosight
 **/
/** @internal */

remove_filter('wp_nav_menu_args', '_filter_fw_ext_mega_menu_wp_nav_menu_args');
remove_filter('walker_nav_menu_start_el', '_filter_fw_ext_mega_menu_walker_nav_menu_start_el', 10);

/*Allow HTML in menu item description*/
remove_filter( 'nav_menu_description', 'strip_tags' );
function seosight_wp_setup_nav_menu_item( $menu_item ) {
	if ( isset( $menu_item->post_type ) ) {
		if ( 'nav_menu_item' == $menu_item->post_type ) {
			$menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
		}
	}

	return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'seosight_wp_setup_nav_menu_item' );


function seosight_add_icon_to_unyson() {
	/**
	 * Add Icon Pack for Unyson
	 */
	return array(
		'seotheme' => array(
			'name' => 'seotheme', // same as key
			'title' => 'Theme icon pack',
			'css_class_prefix' => 'seosight',
			'css_file' => get_template_directory().'/css/seotheme.css',
			'css_file_uri' => get_template_directory_uri().'/css/seotheme.css'
		)
	);
}
add_filter('fw:option_type:icon-v2:packs', 'seosight_add_icon_to_unyson');


function seosight_filter_mega_menu_icon_customizations($option) {
	$option['type'] = 'icon-v2';
	return $option;
}
add_filter(
	'fw:ext:megamenu:icon-option',
	'seosight_filter_mega_menu_icon_customizations'
);

function seosight_custom_packs_list($current_packs) {
	/**
	 * $current_packs is an array of pack names.
	 * You should return which one you would like to show in the picker.
	 */
	return array('seotheme','font-awesome');
}

add_filter('fw:option_type:icon-v2:filter_packs', 'seosight_custom_packs_list');