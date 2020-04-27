<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'subheader'    => array(
				'label' => esc_html__( 'Subheader', 'bubulla' ),
				'type'  => 'text',
			),
			'rate'    => array(
				'type'    => 'select',
				'label' => esc_html__( 'Rate', 'bubulla' ),				
				'description'   => esc_html__( 'Null for hidden', 'bubulla' ),
				'choices' => array(
					0,1,2,3,4,5
				),
			),						
			'short'    => array(
				'type'    => 'checkbox',
				'label' => esc_html__( 'Short Testimonial', 'bubulla' ),				
				'description'   => esc_html__( 'Image will be hiddem and layout inverted', 'bubulla' ),
			),				
		),
	),		
);

