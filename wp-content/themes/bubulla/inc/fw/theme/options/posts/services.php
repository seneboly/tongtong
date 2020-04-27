<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(			
			'header'    => array(
				'label' => esc_html__( 'Alternative Header', 'bubulla' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'bubulla' ),
				'type'  => 'text',
			),		
			'image' => array(
				'label' => esc_html__( 'Additional Image', 'bubulla' ),
				'desc' => esc_html__( 'Can be used in services shortcodes or as shadow', 'bubulla' ),				
				'type'  => 'upload',
			),
			'cut'    => array(
				'label' => esc_html__( 'Short Description', 'bubulla' ),
				'type'  => 'textarea',
			),								
			'link'    => array(
				'label' => esc_html__( 'External Link', 'bubulla' ),
				'desc' => esc_html__( 'Replaces default service link (get more)', 'bubulla' ),				
				'type'  => 'text',
			),		
			'link_header'    => array(
				'label' => esc_html__( 'Get More Header', 'bubulla' ),
				'type'  => 'text',
			),				
			'link_more'    => array(
				'label' => esc_html__( 'External Link', 'bubulla' ),
				'desc' => esc_html__( 'Replaces default service link (read mode)', 'bubulla' ),				
				'type'  => 'text',
			),		
			'more_header'    => array(
				'label' => esc_html__( 'Read More Header', 'bubulla' ),
				'type'  => 'text',
			),				
		),
	),
);

