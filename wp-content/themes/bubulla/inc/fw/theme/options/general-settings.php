<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bubulla_theme_config = bubulla_theme_config();
$bubulla_sections_list = bubulla_get_sections();

$navbar_custom_assign = array();

if ( !empty( $bubulla_theme_config['navbar'] ) AND is_array($bubulla_theme_config['navbar']) AND sizeof( $bubulla_theme_config['navbar']) > 1 ) {

	$menus = get_terms('nav_menu');
	if ( !empty($menus) ) {

		$list = array();
		foreach ( $menus as $item ) {

			$list[$item->term_id] = $item->name;
		}

		foreach ( $bubulla_theme_config['navbar'] as $key => $val) {

			$navbar_custom_assign['navbar-'.$key.'-assign'] = array(
				'label' => sprintf( esc_html__( 'Navbar %s Assign', 'bubulla' ), ucwords($key) ),
				'type'    => 'select',
				'desc' => esc_html__( 'You can assign additional menus for inner navbar.', 'bubulla' ),
				'value' => 'default',
				'choices' => array('default' => esc_html__( 'Default', 'bubulla' )) + $list,
			);
		}

		$navbar_custom_assign = array();
	}
}

$options = array(
	'general' => array(
		'title'   => esc_html__( 'General', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => esc_html__( 'General Settings', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(						
					'page-loader'    => array(
						'type'    => 'multi-picker',
						'picker'       => array(
							'loader' => array(
								'label'   => esc_html__( 'Page Loader', 'bubulla' ),
								'type'    => 'select',
								'choices' => array(
									'disabled' => esc_html__( 'Disabled', 'bubulla' ),
									'image' => esc_html__( 'Image', 'bubulla' ),
									'enabled' => esc_html__( 'Theme Loader', 'bubulla' ),
								),
								'value' => 'enabled'
							)
						),						
						'choices' => array(
							'image' => array(
								'loader_img'    => array(
									'label' => esc_html__( 'Page Loader Image', 'bubulla' ),
									'type'  => 'upload',
								),
							),
						),
						'value' => 'enabled',
					),	
					'google_api'    => array(
						'label' => esc_html__( 'Google Maps API Key', 'bubulla' ),
						'desc'  => esc_html__( 'Required for contacts page, also used in widget. In order to use you must generate your own API on Google Maps Platform', 'bubulla' ),
						'type'  => 'text',
					),								
				),
			),
			'logo' => array(
				'title'   => esc_html__( 'Logo and Media', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(	
					'logo-box' => array(
						'title'   => esc_html__( 'Logo', 'bubulla' ),
						'type'    => 'box',
						'options' => array(			
							'favicon'    => array(
								'html' => esc_html__( 'To change Favicon go to Appearance -> Customize -> Site Identity', 'bubulla' ),
								'type'  => 'html',
							),		
				            'logo_height' => array(
				                'type'  => 'slider',
				                'value' => $bubulla_theme_config['logo_height'],
				                'properties' => array(

				                    'min' => 0,
				                    'max' => 200,
				                    'step' => 1,

				                ),
				                'label' => esc_html__('Logo Max Height, px', 'bubulla'),
				            ),  												
							'logo'    => array(
								'label' => esc_html__( 'Logo Black', 'bubulla' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'bubulla' ),
								'type'  => 'upload',
							),	
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White', 'bubulla' ),
								'type'  => 'upload',
							),
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'bubulla' ),
								'type'  => 'upload',
							),		
							'theme-icon-main'    => array(
								'label' => esc_html__( 'Headers icon', 'bubulla' ),
								'type'  => 'icon-v2',
							),								
							'widgets_bg'    => array(
								'label' => esc_html__( 'Sidebar Widgets Background', 'bubulla' ),
								'type'  => 'upload',
							),									
							'404_bg'    => array(
								'label' => esc_html__( '404 Background', 'bubulla' ),
								'type'  => 'upload',
							),	  										
						),
					),
				),
			),				
		),
	),
	'header' => array(
		'title'   => esc_html__( 'Header', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(
			'header-box-2' => array(
				'title'   => esc_html__( 'Navbar', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'navbar-default'    => array(
						'label' => esc_html__( 'Navbar Default', 'bubulla' ),
						'type'    => 'select',
						'value' => $bubulla_theme_config['navbar-default'],
						'choices' => $bubulla_theme_config['navbar'],
					),	
					'navbar-default-force'    => array(
						'label' => esc_html__( 'Navbar Default Override', 'bubulla' ),
						'desc'   => esc_html__( 'By default every page can have unqiue navbar setting. You can override them here.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled. Every page uses its own settings', 'bubulla' ),
							'force'  => esc_html__( 'Enabled. Override all site pages and use Navbar Default', 'bubulla' ),
						),
						'value' => 'disabled',
					),						
					'navbar-affix'    => array(
						'label' => esc_html__( 'Navbar Sticked', 'bubulla' ),
						'desc'   => esc_html__( 'May not work with all navbar types', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'' => esc_html__( 'Allways Static', 'bubulla' ),
							'affix'  => esc_html__( 'Sticked', 'bubulla' ),
						),
						'value' => '',
					),
					'navbar-breakpoint'    => array(
						'label' => esc_html__( 'Navbar Mobile Breakpoint, px', 'bubulla' ),
						'desc'   => esc_html__( 'Mobile menu will be displayed in viewports below this value', 'bubulla' ),
						'type'    => 'text',
						'value' => '1198',
					),												
					$navbar_custom_assign,
				)
			),
			'header-box-topbar' => array(
				'title'   => esc_html__( 'Topbar', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'topbar-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'You can edit topbar in sections menu of dashboard', 'bubulla' ),
					),					
					'topbar'    => array(
						'label' => esc_html__( 'Topbar visibility', 'bubulla' ),
						'desc'   => esc_html__( 'You can edit topbar layout in Sections menu', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always Visible', 'bubulla' ),
							'desktop'  => esc_html__( 'Desktop Visible', 'bubulla' ),
							'desktop-tablet'  => esc_html__( 'Desktop and Tablet Visible', 'bubulla' ),
							'mobile'  => esc_html__( 'Mobile only Visible', 'bubulla' ),
							'hidden' => esc_html__( 'Hidden', 'bubulla' ),
						),
						'value' => 'hidden',
					),					
					'topbar-section'    => array(
						'label' => esc_html__( 'Topbar section', 'bubulla' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $bubulla_sections_list['top_bar'],						
						'value'	=> '',
					),						
				)
			),			
			'header-box-icons' => array(
				'title'   => esc_html__( 'Icons and Elements', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(		
					'icons-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'Icons can be displayed in topbar using shortcode: [ltx-navbar-icons]', 'bubulla' ),
					),																
					'navbar-icons' => array(
		                'label' => esc_html__( 'Navbar / Topbar Icons', 'bubulla' ),
		                'desc' => esc_html__( 'Depends on theme style', 'bubulla' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'box-options' => array(
							'type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'picker'       => array(
									'type_radio' => array(
										'label'   => esc_html__( 'Type', 'bubulla' ),
										'type'    => 'radio',
										'choices' => array(
											'search' => esc_html__( 'Search', 'bubulla' ),
											'basket'  => esc_html__( 'WooCommerce Cart', 'bubulla' ),
											'profile'  => esc_html__( 'User Profile', 'bubulla' ),
											'social'  => esc_html__( 'Social Icon', 'bubulla' ),
										),
									)
								),
								'choices'      => array(
									'basket'  => array(
										'count'    => array(
											'label' => esc_html__( 'Count', 'bubulla' ),
											'type'    => 'select',
											'choices' => array(
												'show' => esc_html__( 'Show count label', 'bubulla' ),
												'hide'  => esc_html__( 'Hide count label', 'bubulla' ),
											),
											'value' => 'show',
										),											
									),
									'profile'  => array(
					                    'header' => array(
					                        'label' => esc_html__( 'Non-logged header', 'bubulla' ),
					                        'type' => 'text',
					                        'value' => '',
					                    ),										
									),
									'social'  => array(
					                    'text' => array(
					                        'label' => esc_html__( 'Header', 'bubulla' ),
					                        'type' => 'text',
					                    ),
					                    'subheader' => array(
					                        'label' => esc_html__( 'Subheader', 'bubulla' ),
					                        'type' => 'text',
					                    ),					                    
					                    'href' => array(
					                        'label' => esc_html__( 'External Link', 'bubulla' ),
					                        'type' => 'text',
					                        'value' => '#',
					                    ),											
									),		
								),
								'show_borders' => false,
							),	  														                	
							'icon-type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'value'        => array(
									'icon_radio' => 'default',
								),
								'picker'       => array(
									'icon_radio' => array(
										'label'   => esc_html__( 'Icon', 'bubulla' ),
										'type'    => 'radio',
										'choices' => array(
											'default'  => esc_html__( 'Default', 'bubulla' ),
											'fa' => esc_html__( 'FontAwesome', 'bubulla' )
										),
										'desc'    => esc_html__( 'For social icons you need to use FontAwesome in any case.',
											'bubulla' ),
									)
								),
								'choices'      => array(
									'default'  => array(
									),
									'fa' => array(
										'icon_v2'  => array(
											'type'  => 'icon-v2',
											'label' => esc_html__( 'Select Icon', 'bubulla' ),
										),										
									),
								),
								'show_borders' => false,
							),
							'icon-visible'        => array(
								'label'   => esc_html__( 'Visibility', 'bubulla' ),
								'type'    => 'radio',
								'value'    => 'hidden-mob',								
								'choices' => array(
									'hidden-mob'  => esc_html__( 'Hidden on mobile', 'bubulla' ),
									'visible-mob' => esc_html__( 'Visible on mobile', 'bubulla' )
								),
							),							
							'profile-name'        => array(
								'label'   => esc_html__( 'Profile Name', 'bubulla' ),
								'type'    => 'radio',
								'value'    => 'hidden',								
								'choices' => array(
									'hidden'  => esc_html__( 'Hidden', 'bubulla' ),
									'visible' => esc_html__( 'Visible', 'bubulla' )
								),
							),								
		                ),
                		'template' => '{{- type.type_radio }}',		                
                    ),
					'basket-icon'    => array(
						'label' => esc_html__( 'Basket icon in navbar', 'bubulla' ),
						'desc'   => esc_html__( 'As replacement for basket in topbar in mobile view', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Hidden', 'bubulla' ),
							'mobile'  => esc_html__( 'Visible on Mobile', 'bubulla' ),
						),
						'value' => 'disabled',
					),					
				),
			),
			'header-box-1' => array(
				'title'   => esc_html__( 'Page Header H1', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'pageheader-display'    => array(
						'label' => esc_html__( 'Page Header Visibility', 'bubulla' ),
						'desc'   => esc_html__( 'Status of Page Header with H1 and Breadcrumbs', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'bubulla' ),
							'disabled'  => esc_html__( 'Force Hidden on all Pages', 'bubulla' ),
						),
						'value' => 'fixed',
					),		
					'pageheader-overlay'    => array(
						'label' => esc_html__( 'Page Header Overlay', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
						),
						'value' => 'enabled',
					),	
					'header_fixed'    => array(
						'label' => esc_html__( 'Background parallax', 'bubulla' ),
						'desc'   => esc_html__( 'Parallax effect requires large images', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'bubulla' ),
							'fixed'  => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'fixed',
					),														
					'header_bg'    => array(
						'label' => esc_html__( 'Inner Pages Header Background', 'bubulla' ),
						'desc'  => esc_html__( 'By default header is gray, you can replace it with background image', 'bubulla' ),
						'type'  => 'upload',
					),  			
					'wc_bg'    => array(
						'label' => esc_html__( 'WooCommerce Header Background', 'bubulla' ),
						'desc'  => esc_html__( 'Used only for WooCommerce pages', 'bubulla' ),
						'type'  => 'upload',
					),  					
					'featured_bg'    => array(
						'label' => esc_html__( 'Featured Images as Background', 'bubulla' ),
						'desc'  => esc_html__( 'Use Featured Image for Page as Header Background for all the pages', 'bubulla' ),
						'type'    => 'select',						
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'disabled',
					),	
					'header-social'    => array(
						'label' => esc_html__( 'Social icons in page header', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'enabled',
					),	

				),
			),
		),
	),	
	'footer' => array(
		'title'   => esc_html__( 'Footer', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(

			'footer-box-1' => array(
				'title'   => esc_html__( 'Widgets', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'footer-layout-default'    => array(
						'label' => esc_html__( 'Footer Default Style', 'bubulla' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before copyright. Edited in Widgets menu.', 'bubulla' ),
						'choices' => $bubulla_theme_config['footer'],
						'value' => $bubulla_theme_config['footer-default'],
					),						
					'footer_widgets'    => array(
						'label' => esc_html__( 'Enable Footer Widgets', 'bubulla' ),
						'desc'   => esc_html__( 'Widgets controled in Appearance -> Widgets. Column will be hidden, then no active widgets exists', 'bubulla' ),	
						'type'  => 'checkbox',
						'value'	=> 'true',
					),					
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'bubulla' ),
						'type'    => 'select',							
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'disabled',
					),						
					'footer_bg'    => array(
						'label' => esc_html__( 'Footer Background', 'bubulla' ),
						'type'  => 'upload',
					),		
					'footer-box-1-1' => array(
						'title'   => esc_html__( 'Desktop widgets visibility', 'bubulla' ),
						'type'    => 'box',
						'options' => array(

							'footer_1_hide'    => array(
								'label' => esc_html__( 'Footer 1', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),						
							),
							'footer_2_hide'    => array(
								'label' => esc_html__( 'Footer 2', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),	
							),
							'footer_3_hide'    => array(
								'label' => esc_html__( 'Footer 3', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),	
							),
							'footer_4_hide'    => array(
								'label' => esc_html__( 'Footer 4', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),	
							),
						)
					),
					'footer-box-1-2' => array(
						'title'   => esc_html__( 'Notebook widgets visibility', 'bubulla' ),
						'type'    => 'box',
						'options' => array(

							'footer_1__hide_md'    => array(
								'label' => esc_html__( 'Footer 1', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),						
							),
							'footer_2_hide_md'    => array(
								'label' => esc_html__( 'Footer 2', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),	
							),
							'footer_3_hide_md'    => array(
								'label' => esc_html__( 'Footer 3', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),	
							),
							'footer_4_hide_md'    => array(
								'label' => esc_html__( 'Footer 4', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),	
							),
						)
					),					
					'footer-box-1-3' => array(
						'title'   => esc_html__( 'Mobile widgets visibility', 'bubulla' ),
						'type'    => 'box',
						'options' => array(
							'footer_1_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 1', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),
							),
							'footer_2_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 2', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),
							),
							'footer_3_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 3', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),
							),
							'footer_4_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 4', 'bubulla' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'bubulla'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'bubulla'),
								),
							),														
						)
					)
				),
			),
			'footer-box-subscribe' => array(
				'title'   => esc_html__( 'Subscribe and Other', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'footer-sections'    => array(
						'html' => esc_html__( 'You can edit all items in Sections menu of dashboard.', 'bubulla' ),
						'type'  => 'html',
					),							
					'subscribe-section'    => array(
						'label' => esc_html__( 'Subscribe block', 'bubulla' ),
						'desc' => esc_html__( 'Section displayed before widgets on every page. You can hide in on certain page in page settings.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $bubulla_sections_list['subscribe'],						
						'value'	=> '',
					),
					'before-footer-section'    => array(
						'label' => esc_html__( 'Before Footer section', 'bubulla' ),
						'desc' => esc_html__( 'Section displayed under all content before subscribe/widgets.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $bubulla_sections_list['before_footer'],
						'value'	=> '',
					),					
				),
			),	
			'footer-box-2' => array(
				'title'   => esc_html__( 'Go Top', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(															
					'go_top_visibility'    => array(
						'label' => esc_html__( 'Go Top Visibility', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always visible', 'bubulla' ),
							'desktop' => esc_html__( 'Desktop Only', 'bubulla' ),
							'mobile' => esc_html__( 'Mobile Only', 'bubulla' ),
							'hidden' => esc_html__( 'Hidden', 'bubulla' ),
						),						
						'value'	=> 'visible',
					),		
					'go_top_pos'    => array(
						'label' => esc_html__( 'Go Top Position', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'floating'  => esc_html__( 'Floating', 'bubulla' ),
							'static' => esc_html__( 'Static at the footer', 'bubulla' ),
						),						
						'value'	=> 'floating',
					),		
					'go_top_img'    => array(
						'label' => esc_html__( 'Go Top Image', 'bubulla' ),
						'type'  => 'upload',
					),		
					'go_top_icon'    => array(
						'label' => esc_html__( 'Go Top Icon', 'bubulla' ),
						'type'  => 'icon-v2',
					),					
					'go_top_text'    => array(
						'label' => esc_html__( 'Go Top Text', 'bubulla' ),
						'type'  => 'text',
					),														
				),
			),
			'footer-box-3' => array(
				'title'   => esc_html__( 'Copyrights', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(																							
					'copyrights'    => array(
						'label' => esc_html__( 'Copyrights', 'bubulla' ),
						'type'  => 'wp-editor',
					),									
				),
			),					
		),
	),	
	'layout' => array(
		'title'   => esc_html__( 'Posts Layout', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(

			'layout-box-1' => array(
				'title'   => esc_html__( 'Blog Posts', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(

					'blog_layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'bubulla' ),
						'desc'   => esc_html__( 'Default blog page layout.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'bubulla' ),
							'two-cols' => esc_html__( 'Two Columns', 'bubulla' ),
							'three-cols' => esc_html__( 'Three Columns', 'bubulla' ),
						),
						'value' => 'classic',
					),				
					'blog_list_sidebar'    => array(
						'label' => esc_html__( 'Blog List Sidebar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'bubulla' ),
							'left' => esc_html__( 'Left', 'bubulla' ),
							'right' => esc_html__( 'Right', 'bubulla' ),
						),
						'value' => 'right',
					),				
					'blog_post_sidebar'    => array(
						'label' => esc_html__( 'Blog Post Sidebar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'bubulla' ),
							'left' => esc_html__( 'Left', 'bubulla' ),
							'right' => esc_html__( 'Right', 'bubulla' ),
						),
						'value' => 'right',
					),																				
					'excerpt_auto'    => array(
						'label' => esc_html__( 'Excerpt Classic Blog Size', 'bubulla' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'bubulla' ),
						'value'	=> 350,
						'type'  => 'short-text',
					),
					'excerpt_masonry_auto'    => array(
						'label' => esc_html__( 'Excerpt Masonry Blog Size', 'bubulla' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'bubulla' ),
						'value'	=> 150,
						'type'  => 'short-text',
					),
					'blog_gallery_autoplay'    => array(
						'label' => esc_html__( 'Gallery post type autoplay, ms', 'bubulla' ),
						'desc'  => esc_html__( 'Set 0 to disable autoplay', 'bubulla' ),
						'type'  => 'text',
						'value' => '4000',
					),						
				)
			),
			'layout-box-2' => array(
				'title'   => esc_html__( 'Services', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(	
					'services_list_layout'    => array(
						'label' => esc_html__( 'Services List Layout', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'bubulla' ),
							'two-cols' => esc_html__( 'Two Columns', 'bubulla' ),
							'three-cols' => esc_html__( 'Three Columns', 'bubulla' ),
						),
						'value' => 'two-cols',
					),						
					'services_list_sidebar'    => array(
						'label' => esc_html__( 'Services List Sidebar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'bubulla' ),
							'left' => esc_html__( 'Left', 'bubulla' ),
							'right' => esc_html__( 'Right', 'bubulla' ),
						),
						'value' => 'hidden',
					),				
					'services_post_sidebar'    => array(
						'label' => esc_html__( 'Services Post Sidebar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'bubulla' ),
							'left' => esc_html__( 'Left', 'bubulla' ),
							'right' => esc_html__( 'Right', 'bubulla' ),
						),
						'value' => 'hidden',
					),					
				)
			),
			'layout-box-3' => array(
				'title'   => esc_html__( 'WooCommerce', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'shop_list_sidebar'    => array(
						'label' => esc_html__( 'WooCommerce List Sidebar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'bubulla' ),
							'left' => esc_html__( 'Left', 'bubulla' ),
							'right' => esc_html__( 'Right', 'bubulla' ),
						),
						'value' => 'left',
					),				
					'shop_post_sidebar'    => array(
						'label' => esc_html__( 'WooCommerce Product Sidebar', 'bubulla' ),
						'desc'   => esc_html__( 'Blog Post Sidebar', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'bubulla' ),
							'left' => esc_html__( 'Left', 'bubulla' ),
							'right' => esc_html__( 'Right', 'bubulla' ),
						),
						'value' => 'hidden',
					),											
					'excerpt_wc_auto'    => array(
						'label' => esc_html__( 'Excerpt WooCommerce Size', 'bubulla' ),
						'desc'  => esc_html__( 'Automaticly cuts description for products', 'bubulla' ),
						'value'	=> 50,
						'type'  => 'short-text',
					),		
					'wc_zoom'    => array(
						'label' => esc_html__( 'WooCommerce Product Hover Zoom', 'bubulla' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Enables mouse hover zoom in single product page', 'bubulla' ),
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'disabled',
					),
					'wc_columns'    => array(
						'label' => esc_html__( 'Columns number', 'bubulla' ),
						'desc'  => esc_html__( 'Overrides default WooCommerce settings', 'bubulla' ),
						'type'  => 'text',
						'value' => '3',
					),
					'wc_per_page'    => array(
						'label' => esc_html__( 'Products per Page', 'bubulla' ),
						'type'  => 'text',
						'value' => '6',
					),
					'wc_show_list_excerpt'    => array(
						'label' => esc_html__( 'Display Excerpt in Shop List', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'enabled',
					),					
					'wc_show_list_rate'    => array(
						'label' => esc_html__( 'Display Rate in Shop List', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'disabled',
					),
					'wc_show_list_attr'    => array(
						'label' => esc_html__( 'Display Attributes in Shop List', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'disabled',
					),
					'wc_show_more'    => array(
						'label' => esc_html__( 'Display Read More', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'bubulla' ),
							'enabled' => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'disabled',
					),					
					'wc_new_days'    => array(
						'label' => esc_html__( 'Number of days to display New label. Set 0 to hide.', 'bubulla' ),
						'type'  => 'text',
						'value' => '30',
					),						
				)
			),
			'layout-box-4' => array(
				'title'   => esc_html__( 'Gallery', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(													
					'gallery_layout'    => array(
						'label' => esc_html__( 'Default Gallery Layout', 'bubulla' ),
						'desc'   => esc_html__( 'Default galley page layout.', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'col-2' => esc_html__( 'Two Columns', 'bubulla' ),
							'col-3' => esc_html__( 'Three Columns', 'bubulla' ),
							'col-4' => esc_html__( 'Four Columns', 'bubulla' ),
						),
						'value' => 'col-2',
					),						
				)
			)
		)
	),
	'fonts' => array(
		'title'   => esc_html__( 'Fonts', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(

			'fonts-box' => array(
				'title'   => esc_html__( 'Fonts Settings', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'font-main'                => array(
						'label' => __( 'Main Font', 'bubulla' ),
						'type'  => 'typography-v2',
						'desc'	=>	esc_html__( 'Use https://fonts.google.com/ to find font you need', 'bubulla' ),
						'value'      => array(
							'family'    => $bubulla_theme_config['font_main'],
							'subset'    => 'latin-ext',
							'variation' => $bubulla_theme_config['font_main_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-main-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'bubulla' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "800,900"', 'bubulla' ),
						'type'  => 'text',
						'value'  => $bubulla_theme_config['font_main_weights'],							
					),											
					'font-headers'                => array(
						'label' => __( 'Headers Font', 'bubulla' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $bubulla_theme_config['font_headers'],
							'subset'    => 'latin-ext',
							'variation' => $bubulla_theme_config['font_headers_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-headers-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'bubulla' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'bubulla' ),
						'type'  => 'text',
						'value'  => $bubulla_theme_config['font_headers_weights'],						
					),
					'font-subheaders'                => array(
						'label' => __( 'SubHeaders Font', 'bubulla' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $bubulla_theme_config['font_subheaders'],
							'subset'    => 'latin-ext',
							'variation' => $bubulla_theme_config['font_subheaders_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-subheaders-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'bubulla' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'bubulla' ),
						'type'  => 'text',
						'value'  => $bubulla_theme_config['font_subheaders_weights'],						
					),							
				),
			),
			'fontello-box' => array(
				'title'   => esc_html__( 'Fontello', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'fontello-css'    => array(
						'label' => esc_html__( 'Fontello Codes CSS', 'bubulla' ),
						'desc'  => esc_html__( 'Upload *-codes.css postfix file here', 'bubulla' ),
						'type'  => 'upload',
						'images_only' => false,
					),		
					'fontello-ttf'    => array(
						'label' => esc_html__( 'Fontello TTF', 'bubulla' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-eot'    => array(
						'label' => esc_html__( 'Fontello EOT', 'bubulla' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-woff'    => array(
						'label' => esc_html__( 'Fontello WOFF', 'bubulla' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-woff2'    => array(
						'label' => esc_html__( 'Fontello WOFF2', 'bubulla' ),
						'type'  => 'upload',
						'images_only' => false,
					),							
					'fontello-svg'    => array(
						'label' => esc_html__( 'Fontello SVG', 'bubulla' ),
						'type'  => 'upload',
						'images_only' => false,
					),												
				),
			),

		),
	),	
	'social' => array(
		'title'   => esc_html__( 'Social', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(
			'social-box' => array(
				'title'   => esc_html__( 'Social', 'bubulla' ),
				'type'    => 'tab',
				'options' => array(
					'target-social'    => array(
						'label' => esc_html__( 'Open social links in', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'self'  => esc_html__( 'Same window', 'bubulla' ),
							'blank' => esc_html__( 'New window', 'bubulla' ),
						),
						'value' => 'self',
					),		
					'social-header' => array(
                        'label' => esc_html__( 'Social Header', 'bubulla' ),
                        'type' => 'text',
                        'value' => 'Follow us',
                    ),		  
		            'social-icons' => array(
		                'label' => esc_html__( 'Social Icons', 'bubulla' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'desc' => esc_html__( 'Visible in inner page header', 'bubulla' ),
		                'box-options' => array(
		                    'icon_v2' => array(
		                        'label' => esc_html__( 'Icon', 'bubulla' ),
		                        'type'  => 'icon-v2',
		                    ),
		                    'text' => array(
		                        'label' => esc_html__( 'Text', 'bubulla' ),
		                        'desc' => esc_html__( 'If needed', 'bubulla' ),
		                        'type' => 'text',
		                    ),
		                    'href' => array(
		                        'label' => esc_html__( 'Link', 'bubulla' ),
		                        'type' => 'text',
		                        'value' => '#',
		                    ),		                    
		                ),
                		'template' => '{{- text }}',		                
                    ),								
				),
			),
		),
	),	
	'colors' => array(
		'title'   => esc_html__( 'Colors Schemes', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(			
			'schemes-box' => array(
				'title'   => esc_html__( 'Additional Color Schemes Settings', 'bubulla' ),
				'type'    => 'box',
				'options' => array(
					'advice'    => array(
						'html' => esc_html__( 'You also need to change the global settings in Appearance -> Customize -> Bubulla settings', 'bubulla' ),
						'type'  => 'html',
					),	
					'items' => array(
						'label' => esc_html__( 'Theme Color Schemes', 'bubulla' ),
						'type' => 'addable-box',
						'value' => array(),
						'desc' => esc_html__( 'Can be selected in page settings', 'bubulla' ),
						'box-options' => array(
							'slug' => array(
								'label' => esc_html__( 'Scheme ID', 'bubulla' ),
								'type' => 'text',
								'desc' => esc_html__( 'Required Field', 'bubulla' ),
								'value' => '',
							),							
							'name' => array(
								'label' => esc_html__( 'Scheme Name', 'bubulla' ),
								'desc' => esc_html__( 'Required Field', 'bubulla' ),
								'type' => 'text',
								'value' => '',
							),
							'logo'    => array(
								'label' => esc_html__( 'Logo Black', 'bubulla' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'bubulla' ),
								'type'  => 'upload',
							),
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White', 'bubulla' ),
								'type'  => 'upload',
							),		
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'bubulla' ),
								'type'  => 'upload',
							),		
							'main-color'  => array(
								'label' => esc_html__( 'Main Color', 'bubulla' ),
								'type'  => 'color-picker',
							),
							'second-color' => array(
								'label' => esc_html__( 'Second Color', 'bubulla' ),
								'type'  => 'color-picker',
							),
							'gray-color' => array(
								'label' => esc_html__( 'Gray Color', 'bubulla' ),
								'type'  => 'color-picker',
							),								
							'black-color' => array(
								'label' => esc_html__( 'Black Color', 'bubulla' ),
								'type'  => 'color-picker',
							),	
							'white-color' => array(
								'label' => esc_html__( 'White Color', 'bubulla' ),
								'type'  => 'color-picker',
							),								
						),
						'template' => '{{- name }}',
					),
				),
			),
		),
	),	
	'popup' => array(
		'title'   => esc_html__( 'Popup', 'bubulla' ),
		'type'    => 'tab',
		'options' => array(
			'popup-box' => array(
				'title'   => esc_html__( 'Popup settings', 'bubulla' ),
				'type'    => 'box',
				'options' => array(						
					'popup-status'    => array(
						'label'   => esc_html__( 'Status', 'bubulla' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'bubulla' ),
							'enabled'  => esc_html__( 'Enabled', 'bubulla' ),
						),
						'value' => 'disabled'
					),						
					'popup-hours'    => array(
						'label' => esc_html__( 'Period hidden, days', 'bubulla' ),
						'type'  => 'text',
						'value'	=>	'24',
					),						
					'popup-text'    => array(
						'label' => esc_html__( 'Popup text', 'bubulla' ),
						'type'  => 'wp-editor',
					),
					'popup-bg'    => array(
						'label' => esc_html__( 'Popup Background', 'bubulla' ),
						'type'  => 'upload',
					),					
					'popup-yes'    => array(
						'label' => esc_html__( 'Yes button', 'bubulla' ),
						'type'  => 'text',
						'value'	=>	'Yes',
					),	
					'popup-no'    => array(
						'label' => esc_html__( 'No button', 'bubulla' ),
						'type'  => 'text',
						'value'	=>	'No',
					),																
					'popup-no-link'    => array(
						'label' => esc_html__( 'No link', 'bubulla' ),
						'type'  => 'text',
						'value'	=>	'https://google.com',
					),																
				),	
			),
		),
	),
);

unset($options['popup']);
unset($options['header']['header-box-topbar']);

if ( function_exists('ltx_share_buttons_conf') ) {

	$share_links = ltx_share_buttons_conf();

	$share_links_options = array();
	if ( !empty($share_links) ) {

		$share_links_options = array(

			'share_icons_hide' => array(
                'label' => esc_html__( 'Hide all share icons block', 'bubulla' ),
                'type'  => 'checkbox',
                'value'	=>	false,
            ),
		);
		foreach ( $share_links as $key => $item ) {

			$state = fw_get_db_settings_option( 'share_icon_' . $key );

			$value = false;
			if ( is_null($state) AND $item['active'] == 1 ) {

				$value = true;
			}

			$share_links_options[] =
			array(
				'share_icon_'.$key => array(
	                'label' => $item['header'],
	                'type'  => 'checkbox',
	                'value'	=>	$value,
	            ),
			);
		}
	}

	$share_links_options['share-add'] = array(

        'label' => esc_html__( 'Custom Share Buttons', 'bubulla' ),
        'type' => 'addable-box',
        'value' => array(),
        'desc' => esc_html__( 'You can use {link} and {title} variables to set url. E.g. "http://www.facebook.com/sharer.php?u={link}"', 'bubulla' ),
        'box-options' => array(
            'icon' => array(
                'label' => esc_html__( 'Icon', 'bubulla' ),
                'type'  => 'icon-v2',
            ),
            'header' => array(
                'label' => esc_html__( 'Header', 'bubulla' ),
                'type' => 'text',
            ),
            'link' => array(
                'label' => esc_html__( 'Link', 'bubulla' ),
                'type' => 'text',
                'value' => '',
            ),		  
            'color' => array(
                'label' => esc_html__( 'Color', 'bubulla' ),
                'type' => 'color-picker',
                'value' => '',
            ),		              
        ),
		'template' => '{{- header }}',		                
    );

	$options['social']['options']['share-box'] = array(
		'title'   => esc_html__( 'Share Buttons', 'bubulla' ),
		'type'    => 'tab',
		'options' => $share_links_options,
	);
}

