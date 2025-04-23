<?php

$ai_automation_tp_theme_css = '';

$ai_automation_theme_lay = get_theme_mod( 'ai_automation_tp_body_layout_settings','Full');
if($ai_automation_theme_lay == 'Container'){
$ai_automation_tp_theme_css .='body{';
$ai_automation_tp_theme_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
$ai_automation_tp_theme_css .='}';
$ai_automation_tp_theme_css .='@media screen and (max-width:575px){';
$ai_automation_tp_theme_css .='body{';
	$ai_automation_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left: 0px';
$ai_automation_tp_theme_css .='} }';
$ai_automation_tp_theme_css .='.scrolled{';
$ai_automation_tp_theme_css .='width: auto; left:0; right:0;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_theme_lay == 'Container Fluid'){
$ai_automation_tp_theme_css .='body{';
$ai_automation_tp_theme_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
$ai_automation_tp_theme_css .='}';
$ai_automation_tp_theme_css .='@media screen and (max-width:575px){';
$ai_automation_tp_theme_css .='body{';
	$ai_automation_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left:0px';
$ai_automation_tp_theme_css .='} }';
$ai_automation_tp_theme_css .='.scrolled{';
$ai_automation_tp_theme_css .='width: auto; left:0; right:0;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_theme_lay == 'Full'){
$ai_automation_tp_theme_css .='body{';
$ai_automation_tp_theme_css .='max-width: 100%;';
$ai_automation_tp_theme_css .='}';
}

$ai_automation_scroll_position = get_theme_mod( 'ai_automation_scroll_top_position','Right');
if($ai_automation_scroll_position == 'Right'){
$ai_automation_tp_theme_css .='#return-to-top{';
$ai_automation_tp_theme_css .='right: 20px;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_scroll_position == 'Left'){
$ai_automation_tp_theme_css .='#return-to-top{';
$ai_automation_tp_theme_css .='left: 20px;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_scroll_position == 'Center'){
$ai_automation_tp_theme_css .='#return-to-top{';
$ai_automation_tp_theme_css .='right: 50%;left: 50%;';
$ai_automation_tp_theme_css .='}';
}

// related post
$ai_automation_related_post_mob = get_theme_mod('ai_automation_related_post_mob', true);
$ai_automation_related_post = get_theme_mod('ai_automation_remove_related_post', true);
$ai_automation_tp_theme_css .= '.related-post-block {';
if ($ai_automation_related_post == false) {
    $ai_automation_tp_theme_css .= 'display: none;';
}
$ai_automation_tp_theme_css .= '}';
$ai_automation_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($ai_automation_related_post == false || $ai_automation_related_post_mob == false) {
    $ai_automation_tp_theme_css .= '.related-post-block { display: none; }';
}
$ai_automation_tp_theme_css .= '}';

// slider btn
$ai_automation_slider_buttom_mob = get_theme_mod('ai_automation_slider_buttom_mob', true);
$ai_automation_slider_button = get_theme_mod('ai_automation_slider_button', true);
$ai_automation_tp_theme_css .= '#slider .more-btn {';
if ($ai_automation_slider_button == false) {
    $ai_automation_tp_theme_css .= 'display: none;';
}
$ai_automation_tp_theme_css .= '}';
$ai_automation_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($ai_automation_slider_button == false || $ai_automation_slider_buttom_mob == false) {
    $ai_automation_tp_theme_css .= '#slider .more-btn { display: none; }';
}
$ai_automation_tp_theme_css .= '}';

//return to header mobile               
$ai_automation_return_to_header_mob = get_theme_mod('ai_automation_return_to_header_mob', true);
$ai_automation_return_to_header = get_theme_mod('ai_automation_return_to_header', true);
$ai_automation_tp_theme_css .= '.return-to-header{';
if ($ai_automation_return_to_header == false) {
    $ai_automation_tp_theme_css .= 'display: none;';
}
$ai_automation_tp_theme_css .= '}';
$ai_automation_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($ai_automation_return_to_header == false || $ai_automation_return_to_header_mob == false) {
    $ai_automation_tp_theme_css .= '.return-to-header{ display: none; }';
}
$ai_automation_tp_theme_css .= '}';

//blog description              
$ai_automation_mobile_blog_description = get_theme_mod('ai_automation_mobile_blog_description', true);
$ai_automation_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($ai_automation_mobile_blog_description == false) {
    $ai_automation_tp_theme_css .= '.blog-description{ display: none; }';
}
$ai_automation_tp_theme_css .= '}';

$ai_automation_footer_widget_image = get_theme_mod('ai_automation_footer_widget_image');
if($ai_automation_footer_widget_image != false){
$ai_automation_tp_theme_css .='#footer{';
$ai_automation_tp_theme_css .='background: url('.esc_attr($ai_automation_footer_widget_image).');';
$ai_automation_tp_theme_css .='}';
}

//Social icon Font size
$ai_automation_social_icon_fontsize = get_theme_mod('ai_automation_social_icon_fontsize');
$ai_automation_tp_theme_css .='.social-media a i{';
$ai_automation_tp_theme_css .='font-size: '.esc_attr($ai_automation_social_icon_fontsize).'px;';
$ai_automation_tp_theme_css .='}';

// site title and tagline font size option
$ai_automation_site_title_font_size = get_theme_mod('ai_automation_site_title_font_size', ''); {
$ai_automation_tp_theme_css .='.logo h1 a, .logo p a{';
$ai_automation_tp_theme_css .='font-size: '.esc_attr($ai_automation_site_title_font_size).'px !important;';
$ai_automation_tp_theme_css .='}';
}

$ai_automation_site_tagline_font_size = get_theme_mod('ai_automation_site_tagline_font_size', '');{
$ai_automation_tp_theme_css .='.logo p{';
$ai_automation_tp_theme_css .='font-size: '.esc_attr($ai_automation_site_tagline_font_size).'px;';
$ai_automation_tp_theme_css .='}';
}

$ai_automation_related_product = get_theme_mod('ai_automation_related_product',true);
if($ai_automation_related_product == false){
$ai_automation_tp_theme_css .='.related.products{';
	$ai_automation_tp_theme_css .='display: none;';
$ai_automation_tp_theme_css .='}';
}

//menu font size
$ai_automation_menu_font_size = get_theme_mod('ai_automation_menu_font_size', '');{
$ai_automation_tp_theme_css .='.main-navigation a, .main-navigation li.page_item_has_children:after, .main-navigation li.menu-item-has-children:after{';
	$ai_automation_tp_theme_css .='font-size: '.esc_attr($ai_automation_menu_font_size).'px;';
$ai_automation_tp_theme_css .='}';
}

// menu text transform
$ai_automation_menu_text_tranform = get_theme_mod( 'ai_automation_menu_text_tranform','');
if($ai_automation_menu_text_tranform == 'Uppercase'){
$ai_automation_tp_theme_css .='.main-navigation a {';
	$ai_automation_tp_theme_css .='text-transform: uppercase;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_text_tranform == 'Lowercase'){
$ai_automation_tp_theme_css .='.main-navigation a {';
	$ai_automation_tp_theme_css .='text-transform: lowercase;';
$ai_automation_tp_theme_css .='}';
}
else if($ai_automation_menu_text_tranform == 'Capitalize'){
$ai_automation_tp_theme_css .='.main-navigation a {';
	$ai_automation_tp_theme_css .='text-transform: capitalize;';
$ai_automation_tp_theme_css .='}';
}

//sale position
$ai_automation_scroll_position = get_theme_mod( 'ai_automation_sale_tag_position','right');
if($ai_automation_scroll_position == 'right'){
$ai_automation_tp_theme_css .='.woocommerce ul.products li.product .onsale{';
    $ai_automation_tp_theme_css .='right: 25px !important;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_scroll_position == 'left'){
$ai_automation_tp_theme_css .='.woocommerce ul.products li.product .onsale{';
    $ai_automation_tp_theme_css .='left: 25px !important; right: auto !important;';
$ai_automation_tp_theme_css .='}';
}

//Font Weight
$ai_automation_menu_font_weight = get_theme_mod( 'ai_automation_menu_font_weight','');
if($ai_automation_menu_font_weight == '100'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 100;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '200'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 200;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '300'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 300;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '400'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 400;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '500'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 500;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '600'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 600;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '700'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 700;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '800'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 800;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_menu_font_weight == '900'){
$ai_automation_tp_theme_css .='.main-navigation a{';
    $ai_automation_tp_theme_css .='font-weight: 900;';
$ai_automation_tp_theme_css .='}';
}

/*------------- Blog Page------------------*/
$ai_automation_post_image_round = get_theme_mod('ai_automation_post_image_round', 0);
if($ai_automation_post_image_round != false){
    $ai_automation_tp_theme_css .='.blog .box-image img{';
        $ai_automation_tp_theme_css .='border-radius: '.esc_attr($ai_automation_post_image_round).'px;';
    $ai_automation_tp_theme_css .='}';
}

$ai_automation_post_image_width = get_theme_mod('ai_automation_post_image_width', '');
if($ai_automation_post_image_width != false){
    $ai_automation_tp_theme_css .='.blog .box-image img{';
        $ai_automation_tp_theme_css .='Width: '.esc_attr($ai_automation_post_image_width).'px;';
    $ai_automation_tp_theme_css .='}';
}

$ai_automation_post_image_length = get_theme_mod('ai_automation_post_image_length', '');
if($ai_automation_post_image_length != false){
    $ai_automation_tp_theme_css .='.blog .box-image img{';
        $ai_automation_tp_theme_css .='height: '.esc_attr($ai_automation_post_image_length).'px;';
    $ai_automation_tp_theme_css .='}';
}

// footer widget title font size
$ai_automation_footer_widget_title_font_size = get_theme_mod('ai_automation_footer_widget_title_font_size', '');{
$ai_automation_tp_theme_css .='#footer h3, #footer h2.wp-block-heading{';
    $ai_automation_tp_theme_css .='font-size: '.esc_attr($ai_automation_footer_widget_title_font_size).'px;';
$ai_automation_tp_theme_css .='}';
}

// Copyright text font size
$ai_automation_footer_copyright_font_size = get_theme_mod('ai_automation_footer_copyright_font_size', '');{
$ai_automation_tp_theme_css .='#footer .site-info p{';
    $ai_automation_tp_theme_css .='font-size: '.esc_attr($ai_automation_footer_copyright_font_size).'px;';
$ai_automation_tp_theme_css .='}';
}

// copyright padding
$ai_automation_footer_copyright_top_bottom_padding = get_theme_mod('ai_automation_footer_copyright_top_bottom_padding', '');
if ($ai_automation_footer_copyright_top_bottom_padding !== '') { 
    $ai_automation_tp_theme_css .= '.site-info {';
    $ai_automation_tp_theme_css .= 'padding-top: ' . esc_attr($ai_automation_footer_copyright_top_bottom_padding) . 'px;';
    $ai_automation_tp_theme_css .= 'padding-bottom: ' . esc_attr($ai_automation_footer_copyright_top_bottom_padding) . 'px;';
    $ai_automation_tp_theme_css .= '}';
}

// copyright position
$ai_automation_copyright_text_position = get_theme_mod( 'ai_automation_copyright_text_position','Center');
if($ai_automation_copyright_text_position == 'Center'){
$ai_automation_tp_theme_css .='#footer .site-info p{';
$ai_automation_tp_theme_css .='text-align:center;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_copyright_text_position == 'Left'){
$ai_automation_tp_theme_css .='#footer .site-info p{';
$ai_automation_tp_theme_css .='text-align:left;';
$ai_automation_tp_theme_css .='}';
}else if($ai_automation_copyright_text_position == 'Right'){
$ai_automation_tp_theme_css .='#footer .site-info p{';
$ai_automation_tp_theme_css .='text-align:right;';
$ai_automation_tp_theme_css .='}';
}

// Header Image title font size
$ai_automation_header_image_title_font_size = get_theme_mod('ai_automation_header_image_title_font_size', '40');{
$ai_automation_tp_theme_css .='.box-text h2{';
    $ai_automation_tp_theme_css .='font-size: '.esc_attr($ai_automation_header_image_title_font_size).'px;';
$ai_automation_tp_theme_css .='}';
}

// header
$ai_automation_slider_arrows = get_theme_mod('ai_automation_slider_arrows',true);
if($ai_automation_slider_arrows == false){
$ai_automation_tp_theme_css .='.page-template-front-page .headerbox{';
    $ai_automation_tp_theme_css .='position:static; border-bottom: 1px solid #bbb';
$ai_automation_tp_theme_css .='}';
}
/*--------------------------- banner image Opacity -------------------*/
    $ai_automation_theme_lay = get_theme_mod( 'ai_automation_header_banner_opacity_color','0.5');
        if($ai_automation_theme_lay == '0'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.1'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.1';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.2'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.2';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.3'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.3';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.4'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.4';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.5'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.5';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.6'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.6';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.7'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.7';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.8'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.8';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '0.9'){
            $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
                $ai_automation_tp_theme_css .='opacity:0.9';
            $ai_automation_tp_theme_css .='}';
        }else if($ai_automation_theme_lay == '1'){
            $ai_automation_tp_theme_css .='#slider img{';
                $ai_automation_tp_theme_css .='opacity:1';
            $ai_automation_tp_theme_css .='}';
        }

    $ai_automation_header_banner_image_overlay = get_theme_mod('ai_automation_header_banner_image_overlay', true);
    if($ai_automation_header_banner_image_overlay == false){
        $ai_automation_tp_theme_css .='.single-page-img, .featured-image{';
            $ai_automation_tp_theme_css .='opacity:1;';
        $ai_automation_tp_theme_css .='}';
    }

    $ai_automation_header_banner_image_ooverlay_color = get_theme_mod('ai_automation_header_banner_image_ooverlay_color', true);
    if($ai_automation_header_banner_image_ooverlay_color != false){
        $ai_automation_tp_theme_css .='.box-image-page{';
            $ai_automation_tp_theme_css .='background-color: '.esc_attr($ai_automation_header_banner_image_ooverlay_color).';';
        $ai_automation_tp_theme_css .='}';
    }