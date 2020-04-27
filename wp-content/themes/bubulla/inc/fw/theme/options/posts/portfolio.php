<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(			
			'director'    => array(
				'label' => esc_html__( 'Director', 'bubulla' ),
				'type'  => 'text',
			),
			'rate'    => array(
				'label' => esc_html__( 'Rate', 'bubulla' ),
				'type'  => 'text',
			),			
			'year'    => array(
				'label' => esc_html__( 'Year', 'bubulla' ),
				'type'  => 'text',
			),
			'duration'    => array(
				'label' => esc_html__( 'Duration', 'bubulla' ),
				'type'  => 'text',
			),
			'photos' => array(
				'label' => esc_html__( 'Gallery', 'bubulla' ),
				'type'  => 'multi-upload',
			),
			'link'    => array(
				'label' => esc_html__( 'External Link', 'bubulla' ),
				'desc' => esc_html__( 'Replaces default link', 'bubulla' ),				
				'type'  => 'text',
			),			
		),
	),
);

