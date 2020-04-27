<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bubulla_choices =  array();
$bubulla_choices['default'] = esc_html__( 'Default', 'bubulla' );

$bubulla_color_schemes = fw_get_db_settings_option( 'items' );
if ( !empty($bubulla_color_schemes) ) {

	foreach ($bubulla_color_schemes as $v) {

		$bubulla_choices[$v['slug']] = esc_html( $v['name'] );
	}
}

$bubulla_theme_config = bubulla_theme_config();
$bubulla_sections_list = bubulla_get_sections();


$options = array(
	'general' => array(
		'title'   => esc_html__( 'Page settings', 'bubulla' ),
		'type'    => 'box',
		'options' => array(		
			'general-box' => array(
				'title'   => __( 'General Settings', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(

					'margin-layout'    => array(
						'label' => esc_html__( 'Content Margin', 'bubulla' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Margins control for content', 'bubulla' ),
						'choices' => array(
							'default'  => esc_html__( 'Top And Bottom', 'bubulla' ),
							'top'  => esc_html__( 'Top Only', 'bubulla' ),
							'bottom'  => esc_html__( 'Bottom Only', 'bubulla' ),
							'disabled' => esc_html__( 'Margin Removed', 'bubulla' ),
						),
						'value' => 'default',
					),			
					'topbar-layout'    => array(
						'label' => esc_html__( 'Topbar section', 'bubulla' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array('default' => 'Default') + array('hidden' => 'Hidden') + $bubulla_sections_list['top_bar'],						
						'value'	=> 'default',
					),						
					'navbar-layout'    => array(
						'label' => esc_html__( 'Navbar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array( 'default'  	=> esc_html__( 'Default', 'bubulla' ) ) + $bubulla_theme_config['navbar'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'bubulla' ) ),
						'value' => $bubulla_theme_config['navbar-default'],
					),								
					'header-layout'    => array(
						'label' => esc_html__( 'Page Header', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'bubulla' ),
							'disabled' => esc_html__( 'Hidden', 'bubulla' ),
						),
						'value' => 'default',
					),						
					'subscribe-layout'    => array(
						'label' => esc_html__( 'Subscribe Block', 'bubulla' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Subscribe block before footer. Can be edited from Sections Menu.', 'bubulla' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'bubulla' ),
							'disabled' => esc_html__( 'Hidden', 'bubulla' ),
						),
						'value' => 'default',
					),		
					'before-footer-layout'    => array(
						'label' => esc_html__( 'Before Footer', 'bubulla' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Before footer sections. Edited in Sections menu.', 'bubulla' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'bubulla' ),
							'disabled' => esc_html__( 'Hidden', 'bubulla' ),
						),
						'value' => 'default',
					),	
					'footer-layout'    => array(
						'label' => esc_html__( 'Footer', 'bubulla' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before footer. Edited in Widgets menu.', 'bubulla' ),
						'choices' => $bubulla_theme_config['footer'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'bubulla' ) ),
						'value' => $bubulla_theme_config['footer-default'],
					),	
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'bubulla' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block parallax effect.', 'bubulla' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'bubulla' ),
							'disabled' => esc_html__( 'Disabled', 'bubulla' ),
						),
						'value' => 'default',
					),																			
					'color-scheme'    => array(
						'label' => esc_html__( 'Color Scheme', 'bubulla' ),
						'type'    => 'select',
						'choices' => $bubulla_choices,
						'value' => 'default',
					),		
					'body-bg'    => array(
						'label' => esc_html__( 'Background Scheme', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'White', 'bubulla' ),
							'black'  => esc_html__( 'Black', 'bubulla' ),
						),
						'value' => 'default',
					),						
					'background-image'    => array(
						'label' => esc_html__( 'Background Image', 'bubulla' ),
						'type'  => 'upload',
						'desc'   => esc_html__( 'Will be used to fill whole page', 'bubulla' ),
					),												
				),											
			),	
			'cpt' => array(
				'title'   => esc_html__( 'Blog / Gallery', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(				
					'sidebar-layout'    => array(
						'label' => esc_html__( 'Blog Sidebar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'hidden' => esc_html__( 'Hidden', 'bubulla' ),
							'left'  => esc_html__( 'Sidebar Left', 'bubulla' ),
							'right'  => esc_html__( 'Sidebar Right', 'bubulla' ),
						),
						'value' => 'hidden',
					),						
					'blog-layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'bubulla' ),
						'description'   => esc_html__( 'Used only for blog pages.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'bubulla' ),
							'classic'  => esc_html__( 'One Column', 'bubulla' ),
							'two-cols' => esc_html__( 'Two Columns', 'bubulla' ),
							'three-cols' => esc_html__( 'Three Columns', 'bubulla' ),
						),
						'value' => 'default',
					),
					'gallery-layout'    => array(
						'label' => esc_html__( 'Gallery Layout', 'bubulla' ),
						'description'   => esc_html__( 'Used only for gallery pages.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'bubulla' ),
							'col-2' => esc_html__( 'Two Columns', 'bubulla' ),
							'col-3' => esc_html__( 'Three Columns', 'bubulla' ),
							'col-4' => esc_html__( 'Four Columns', 'bubulla' ),
						),
						'value' => 'default',
					),					
				)
			)	
		)
	),
);

unset($options['general']['options']['general-box']['options']['footer-parallax']);
unset($options['general']['options']['general-box']['options']['before-footer-layout']);

