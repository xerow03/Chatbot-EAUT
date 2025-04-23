<?php
	
	$ai_automation_tp_theme_css = '';

	// 1st color
	$ai_automation_tp_color_option_first = get_theme_mod('ai_automation_tp_color_option_first', '#7834FF');
	if ($ai_automation_tp_color_option_first) {
		$ai_automation_tp_theme_css .= ':root {';
		$ai_automation_tp_theme_css .= '--color-primary1: ' . esc_attr($ai_automation_tp_color_option_first) . ';';
		$ai_automation_tp_theme_css .= '}';
	}

	// preloader
	$ai_automation_tp_preloader_color1_option = get_theme_mod('ai_automation_tp_preloader_color1_option');

	if($ai_automation_tp_preloader_color1_option != false){
	$ai_automation_tp_theme_css .='.center1{';
		$ai_automation_tp_theme_css .='border-color: '.esc_attr($ai_automation_tp_preloader_color1_option).' !important;';
	$ai_automation_tp_theme_css .='}';
	}
	if($ai_automation_tp_preloader_color1_option != false){
	$ai_automation_tp_theme_css .='.center1 .ring::before{';
		$ai_automation_tp_theme_css .='background: '.esc_attr($ai_automation_tp_preloader_color1_option).' !important;';
	$ai_automation_tp_theme_css .='}';
	}

	$ai_automation_tp_preloader_color2_option = get_theme_mod('ai_automation_tp_preloader_color2_option');

	if($ai_automation_tp_preloader_color2_option != false){
	$ai_automation_tp_theme_css .='.center2{';
		$ai_automation_tp_theme_css .='border-color: '.esc_attr($ai_automation_tp_preloader_color2_option).' !important;';
	$ai_automation_tp_theme_css .='}';
	}
	if($ai_automation_tp_preloader_color2_option != false){
	$ai_automation_tp_theme_css .='.center2 .ring::before{';
		$ai_automation_tp_theme_css .='background: '.esc_attr($ai_automation_tp_preloader_color2_option).' !important;';
	$ai_automation_tp_theme_css .='}';
	}

	$ai_automation_tp_preloader_bg_color_option = get_theme_mod('ai_automation_tp_preloader_bg_color_option');

	if($ai_automation_tp_preloader_bg_color_option != false){
	$ai_automation_tp_theme_css .='.loader{';
		$ai_automation_tp_theme_css .='background: '.esc_attr($ai_automation_tp_preloader_bg_color_option).';';
	$ai_automation_tp_theme_css .='}';
	}

	$ai_automation_tp_footer_bg_color_option = get_theme_mod('ai_automation_tp_footer_bg_color_option');


	if($ai_automation_tp_footer_bg_color_option != false){
	$ai_automation_tp_theme_css .='#footer{';
		$ai_automation_tp_theme_css .='background: '.esc_attr($ai_automation_tp_footer_bg_color_option).';';
	$ai_automation_tp_theme_css .='}';
	}

	// logo tagline color
	$ai_automation_site_tagline_color = get_theme_mod('ai_automation_site_tagline_color');

	if($ai_automation_site_tagline_color != false){
	$ai_automation_tp_theme_css .='.logo h1 a, .logo p a, .logo p.site-title a{';
	$ai_automation_tp_theme_css .='color: '.esc_attr($ai_automation_site_tagline_color).';';
	$ai_automation_tp_theme_css .='}';
	}

	$ai_automation_logo_tagline_color = get_theme_mod('ai_automation_logo_tagline_color');
	if($ai_automation_logo_tagline_color != false){
	$ai_automation_tp_theme_css .='p.site-description{';
	$ai_automation_tp_theme_css .='color: '.esc_attr($ai_automation_logo_tagline_color).';';
	$ai_automation_tp_theme_css .='}';
	}

	// footer widget title color
	$ai_automation_footer_widget_title_color = get_theme_mod('ai_automation_footer_widget_title_color');
	if($ai_automation_footer_widget_title_color != false){
	$ai_automation_tp_theme_css .='#footer h3, #footer h2.wp-block-heading{';
	$ai_automation_tp_theme_css .='color: '.esc_attr($ai_automation_footer_widget_title_color).';';
	$ai_automation_tp_theme_css .='}';
	}

	// copyright text color
	$ai_automation_footer_copyright_text_color = get_theme_mod('ai_automation_footer_copyright_text_color');
	if($ai_automation_footer_copyright_text_color != false){
	$ai_automation_tp_theme_css .='#footer .site-info p, #footer .site-info a {';
	$ai_automation_tp_theme_css .='color: '.esc_attr($ai_automation_footer_copyright_text_color).'!important;';
	$ai_automation_tp_theme_css .='}';
	}

	// header image title color
	$ai_automation_header_image_title_text_color = get_theme_mod('ai_automation_header_image_title_text_color');
	if($ai_automation_header_image_title_text_color != false){
	$ai_automation_tp_theme_css .='.box-text h2{';
	$ai_automation_tp_theme_css .='color: '.esc_attr($ai_automation_header_image_title_text_color).';';
	$ai_automation_tp_theme_css .='}';
	}

	// menu color
	$ai_automation_menu_color = get_theme_mod('ai_automation_menu_color');
	if($ai_automation_menu_color != false){
	$ai_automation_tp_theme_css .='.main-navigation a{';
	$ai_automation_tp_theme_css .='color: '.esc_attr($ai_automation_menu_color).';';
	$ai_automation_tp_theme_css .='}';
}