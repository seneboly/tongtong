<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			"subheader" => array(
				"label" => esc_html__("Subheader", 'bubulla'),
				"type" => "text"
			),							
			"cut" => array(
				"label" => esc_html__("Excerpt", 'bubulla'),
				"type" => "textarea"
			),							
			"price" => array(
				"label" => esc_html__("Price", 'bubulla'),
				'desc' => esc_html__( 'Use {{ brackets }} to add postfix', 'bubulla' ),
				"type" => "text"
			),		
			'link'    => array(
				'label' => esc_html__( 'External Link', 'bubulla' ),
				'desc' => esc_html__( 'Replaces default service link (get more)', 'bubulla' ),				
				'type'  => 'text',
			),							
		),
	),		
);

