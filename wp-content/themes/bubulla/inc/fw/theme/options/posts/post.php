<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'main' => array(
		'title'   => 'LTX Post Format',
		'type'    => 'box',
		'options' => array(
			'gallery'    => array(
				'label' => esc_html__( 'Gallery', 'bubulla' ),
				'desc' => esc_html__( 'Upload featured images for slider gallery post type', 'bubulla' ),
				'type'  => 'multi-upload',
			),				
		),
	),
);

