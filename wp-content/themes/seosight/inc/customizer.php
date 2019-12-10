<?php
if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Settings and options for online preview Customizer changes.
 *
 * @package Seosight
 */

global  $wp_customize;

if (isset($wp_customize) && $wp_customize->is_preview() ) {

	function _customizer_remove_sections( $wp_customize ) {

		$wp_customize->remove_section( 'background_image' );

	}
	add_action( 'customize_register' , '_customizer_remove_sections' );
}

if (defined('FW')):
	/**
	 * @param WP_Customize_Manager $wp_customize
	 * @internal
	 */
	function _action_customizer_live_fw_options( $wp_customize ) {
		// Header
		$wp_customize->get_setting( 'fw_options[logo-image]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[logo-title]' )->transport    = 'postMessage';
		$wp_customize->get_setting( 'fw_options[logo-subtitle]' )->transport = 'postMessage';
		// Stunning Header.
		$wp_customize->get_setting( 'fw_options[stunning_bg_image]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[stunning_bg_cover]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[stunning_bg_color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[stunning_text_color]' )->transport = 'postMessage';
		// Subscribe section
		$wp_customize->get_setting( 'fw_options[subscribe_bg_image]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[subscribe_bg_cover]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[subscribe_bg_color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[subscribe_text_color]' )->transport = 'postMessage';
		// Footer section
		$wp_customize->get_setting( 'fw_options[footer_bg_image]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_bg_cover]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_bg_color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_text_color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_title_color]' )->transport = 'postMessage';
		// Copyright section
		$wp_customize->get_setting( 'fw_options[footer_copyright]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[size_copyright_section]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[copyright_bg_color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[copyright_text_color]' )->transport = 'postMessage';

		$wp_customize->get_setting( 'fw_options[scroll_top_icon]' )->transport = 'postMessage';
		// SubHeader

		add_action( 'customize_preview_init', '_action_customizer_live_fw_options_preview' );

	}

	add_action( 'customize_register', '_action_customizer_live_fw_options' );

	/**
	 * @internal
	 */
	function _action_customizer_live_fw_options_preview() {
		$translation_array = array( 'templateUrl' => get_template_directory_uri() );
		wp_enqueue_script(
			'seosight-customizer',
			get_template_directory_uri() .'/js/customizer.js',
			array( 'jquery','customize-preview' ),
			fw()->theme->manifest->get_version(),
			true
		);
		wp_localize_script( 'seosight-customizer', 'theme_vars', $translation_array );
	}
endif;
