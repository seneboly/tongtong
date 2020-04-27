<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$bubulla_cfg = bubulla_theme_config();

$options = array(
    
    'bubulla_customizer' => array(
        'title' => esc_html__('Bubulla Colors', 'bubulla'),
        'position' => 1,
        'options' => array(

            'main_color' => array(
                'type' => 'color-picker',
                'value' => $bubulla_cfg['color_main'],
                'label' => esc_html__('Main Color', 'bubulla'),
            ),            
            'second_color' => array(
                'type' => 'color-picker',
                'value' => $bubulla_cfg['color_second'],
                'label' => esc_html__('Second Color', 'bubulla'),
            ),                
            'gray_color' => array(
                'type' => 'color-picker',
                'value' => $bubulla_cfg['color_gray'],
                'label' => esc_html__('Gray Color', 'bubulla'),
            ),
            'black_color' => array(
                'type' => 'color-picker',
                'value' => $bubulla_cfg['color_black'],
                'label' => esc_html__('Black Color', 'bubulla'),
            ),      
            'red_color' => array(
                'type' => 'color-picker',
                'value' => $bubulla_cfg['color_red'],
                'label' => esc_html__('Red Color', 'bubulla'),
            ),
            'white_color' => array(
                'type' => 'color-picker',
                'value' => $bubulla_cfg['color_white'],
                'label' => esc_html__('White Color', 'bubulla'),
            ),                          
            'navbar_dark_color' => array(
                'type' => 'rgba-color-picker',
                'value' => $bubulla_cfg['navbar_dark'],
                'label' => esc_html__('Navbar Dark Color', 'bubulla'),
            ),      
        ),
    ),
);

