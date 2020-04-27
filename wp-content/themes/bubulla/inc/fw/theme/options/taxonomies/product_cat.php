<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => '',
		'type'    => 'box',
		'options' => array(
			'subheader'    => array(
				'label' => esc_html__( 'Additional Header', 'bubulla' ),
				'desc' => esc_html__( 'Use {{ to highlight }} the word', 'bubulla' ),
				'type'  => 'text',
			),			
		),
	),
);

