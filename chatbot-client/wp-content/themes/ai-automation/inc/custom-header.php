<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package AI Automation
 * @subpackage ai_automation
 */

function ai_automation_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'ai_automation_custom_header_args', array(
        'default-text-color' => 'fff',
        'header-text'        => false,
        'width'              => 1600,
        'height'             => 400,
        'flex-width'         => true,
        'flex-height'        => true,
        'wp-head-callback'   => 'ai_automation_header_style',
        'default-image'      => get_template_directory_uri() . '/assets/images/sliderimage.png',
    ) ) );

    register_default_headers( array(
        'default-image' => array(
            'url'           => get_template_directory_uri() . '/assets/images/sliderimage.png',
            'thumbnail_url' => get_template_directory_uri() . '/assets/images/sliderimage.png',
            'description'   => __( 'Default Header Image', 'ai-automation' ),
        ),
    ) );
}
add_action( 'after_setup_theme', 'ai_automation_custom_header_setup' );

/**
 * Styles the header image based on Customizer settings.
 */
function ai_automation_header_style() {
    $ai_automation_header_image = get_header_image() ? get_header_image() : get_template_directory_uri() . '/assets/images/sliderimage.png';

    $ai_automation_height     = get_theme_mod( 'ai_automation_header_image_height', 400 );
    $ai_automation_position   = get_theme_mod( 'ai_automation_header_background_position', 'center' );
    $ai_automation_attachment = get_theme_mod( 'ai_automation_header_background_attachment', 1 ) ? 'fixed' : 'scroll';

    $ai_automation_custom_css = "
        .header-img, .single-page-img, .external-div .box-image-page img, .external-div {
            background-image: url('" . esc_url( $ai_automation_header_image ) . "');
            background-size: cover;
            height: " . esc_attr( $ai_automation_height ) . "px;
            background-position: " . esc_attr( $ai_automation_position ) . ";
            background-attachment: " . esc_attr( $ai_automation_attachment ) . ";
        }

        @media (max-width: 1000px) {
            .header-img, .single-page-img, .external-div .box-image-page img,.external-div,.featured-image{
                height: 250px !important;
            }
            .box-text h2{
                font-size: 27px;
            }
        }
    ";

    wp_add_inline_style( 'ai-automation-style', $ai_automation_custom_css );
}
add_action( 'wp_enqueue_scripts', 'ai_automation_header_style' );

/**
 * Enqueue the main theme stylesheet.
 */
function ai_automation_enqueue_styles() {
    wp_enqueue_style( 'ai-automation-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'ai_automation_enqueue_styles' );