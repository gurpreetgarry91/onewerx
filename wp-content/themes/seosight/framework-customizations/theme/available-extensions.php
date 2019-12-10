<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$extensions = array(
	'update-checker' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'Update checker', 'seosight' ),
		'description' => __( 'Update checker.', 'seosight' ),
		'thumbnail'   => get_template_directory_uri() . '/images/update-checker-extension-thumb.png',
		'download'    => array(
			'source' => 'custom',
			'opts'   => array(
				'remote' => 'https://up.crumina.net/extensions/update-checker.zip',
			),
		),
	),
);