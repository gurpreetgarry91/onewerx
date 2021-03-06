<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'stunning-show' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'value' => array(
				'label'        => esc_html__( 'Show stunning header?', 'seosight' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'seosight' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'seosight' )
				),
				'value'        => 'yes',
				'desc'         => esc_html__( 'Panel after header will be shown/hidden from frontend', 'seosight' ),
			)
		),
		'choices' => array(
			'yes'  => array(
				'custom-title' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Custom title text', 'seosight' ),
				),
				'padding-top'    => array(
					'type'  => 'text',
					'value' => '125px',
					'label' => esc_html__( 'Padding from Top', 'seosight' ),
				),
				'padding-bottom' => array(
					'type'  => 'text',
					'value' => '125px',
					'label' => esc_html__( 'Padding from Bottom', 'seosight' ),
				),
				'stunning_bg_image'   => array(
					'type'    => 'background-image',
					'value'   => 'none',
					'label'   => esc_html__( 'Background image', 'seosight' ),
					'desc'    => esc_html__( 'Select one of images or upload your own pattern', 'seosight' ),
					'choices' => seosight_backgrounds()
				),
				'stunning_bg_cover'   => array(
					'type'  => 'switch',
					'label' => esc_html__( 'Expand background', 'seosight' ),
					'desc'  => esc_html__( 'Don\'t repeat image and expand it to full section background', 'seosight' ),
				),
				'stunning_overlay'   => array(
					'type'  => 'rgba-color-picker',
					'label' => esc_html__( 'Color overlay', 'seosight' ),
					'desc'  => esc_html__( 'Layer with colored overlay for background image', 'seosight' ),
				),
				'stunning_bg_color'   => array(
					'type'  => 'color-picker',
					'value' => '#3e4d50',
					'label' => esc_html__( 'Background Color', 'seosight' ),
					'desc'  => esc_html__( 'If you choose no image to display - that color will be set as background', 'seosight' ),
					'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
				),
				'stunning_text_color' => array(
					'type'  => 'color-picker',
					'label' => esc_html__( 'Text Color', 'seosight' ),
					'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'seosight' ),
				),
				'stunning_hide_title'   => array(
					'label' => esc_html__( 'Hide title', 'seosight' ),
					'desc'  => esc_html__( 'Remove text with page title from stunning header section', 'seosight' ),
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'type'    => 'radio',
					'choices' => array(
						'default'        => __( 'Default', 'seosight' ),
						'no'          => __( 'Show', 'seosight' ),
						'yes'          => __( 'Hide', 'seosight' ),
					),
					'value'   => 'default'
				),
				'stunning_hide_breadcrumbs'   => array(
					'label' => esc_html__( 'Hide breadcrumbs', 'seosight' ),
					'desc'  => esc_html__( 'Remove breadcrumbs from stunning header section', 'seosight' ),
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'type'    => 'radio',
					'choices' => array(
						'default'        => __( 'Default', 'seosight' ),
						'no'          => __( 'Show', 'seosight' ),
						'yes'          => __( 'Hide', 'seosight' ),
					),
					'value'   => 'default'
				),
			),
		),
	),
);