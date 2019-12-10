<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options   = array(

			'primary_color'   => array(
				'type'     => 'rgba-color-picker',
				'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
				'label'    => esc_html__( 'Main accent color', 'seosight' ),
				'help'     => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
			),
			'secondary_color' => array(
				'type'     => 'rgba-color-picker',
				'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
				'label'    => esc_html__( 'Secondary accent color', 'seosight' ),
				'help'     => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),

			),

);




