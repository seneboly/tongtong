<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'theme_block' => array(
		'title'   => esc_html__( 'Theme Block', 'bubulla' ),
		'label'   => esc_html__( 'Theme Block', 'bubulla' ),
		'type'    => 'select',
		'choices' => array(
			'none'  => esc_html__( 'Not Assigned', 'bubulla' ),
			'before_footer'  => esc_html__( 'Before Footer', 'bubulla' ),
			'subscribe'  => esc_html__( 'Subscribe', 'bubulla' ),
			'top_bar'  => esc_html__( 'Top Bar', 'bubulla' ),
		),
		'value' => 'none',
	)
);


