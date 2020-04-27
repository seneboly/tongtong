<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'cut'    => array(
				'label' => esc_html__( 'Short Description', 'bubulla' ),
				'type'  => 'textarea',
			),			
			'items' => array(
				'label' => esc_html__( 'Social Icons For List', 'bubulla' ),
				'type' => 'addable-box',
				'value' => array(),
				'box-options' => array(
					'icon' => array(
						'label' => esc_html__( 'Icon', 'bubulla' ),
						'type'  => 'icon',
					),
					'href' => array(
						'label' => esc_html__( 'Link', 'bubulla' ),
						'desc' => esc_html__( 'If needed', 'bubulla' ),
						'type' => 'text',
						'value' => '#',
					),
				),
				'template' => '{{- icon }}',
			),			
		),
	),		
);

