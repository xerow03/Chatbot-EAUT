<?php
/**
 * AI Automation functions and definitions
 *
 * @package AI Automation
 * @subpackage ai_automation
 */

function ai_automation_setup() {

	load_theme_textdomain( 'ai-automation', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'ai-automation-featured-image', 2000, 1200, true );
	add_image_size( 'ai-automation-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary-menu'    => __( 'Primary Menu', 'ai-automation' ),
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
    	'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', ai_automation_fonts_url() ) );
}
add_action( 'after_setup_theme', 'ai_automation_setup' );

/**
 * Register custom fonts.
 */
function ai_automation_fonts_url(){
	$ai_automation_font_url = '';
	$ai_automation_font_family = array();
	$ai_automation_font_family[] = 'Oswald:200,300,400,500,600,700';
	$ai_automation_font_family[] = 'Roboto:100,100i,300,400,400i,500,500i,700,700i,900,900i';

	$ai_automation_font_family[] = 'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Bad Script';
	$ai_automation_font_family[] = 'Bebas Neue';
	$ai_automation_font_family[] = 'Fjalla One';
	$ai_automation_font_family[] = 'PT Sans:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'PT Serif:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900';
	$ai_automation_font_family[] = 'Roboto Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700';
	$ai_automation_font_family[] = 'Alex Brush';
	$ai_automation_font_family[] = 'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Playball';
	$ai_automation_font_family[] = 'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Julius Sans One';
	$ai_automation_font_family[] = 'Arsenal:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Slabo 13px';
	$ai_automation_font_family[] = 'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900';
	$ai_automation_font_family[] = 'Overpass Mono:wght@300;400;500;600;700';
	$ai_automation_font_family[] = 'Source Sans Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900';
	$ai_automation_font_family[] = 'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900';
	$ai_automation_font_family[] = 'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$ai_automation_font_family[] = 'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700';
	$ai_automation_font_family[] = 'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$ai_automation_font_family[] = 'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$ai_automation_font_family[] = 'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Quicksand:wght@300;400;500;600;700';
	$ai_automation_font_family[] = 'Padauk:wght@400;700';
	$ai_automation_font_family[] = 'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$ai_automation_font_family[] = 'Inconsolata:wght@200;300;400;500;600;700;800;900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$ai_automation_font_family[] = 'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$ai_automation_font_family[] = 'Pacifico';
	$ai_automation_font_family[] = 'Indie Flower';
	$ai_automation_font_family[] = 'VT323';
	$ai_automation_font_family[] = 'Dosis:wght@200;300;400;500;600;700;800';
	$ai_automation_font_family[] = 'Frank Ruhl Libre:wght@300;400;500;700;900';
	$ai_automation_font_family[] = 'Fjalla One';
	$ai_automation_font_family[] = 'Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Oxygen:wght@300;400;700';
	$ai_automation_font_family[] = 'Arvo:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Noto Serif:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Lobster';
	$ai_automation_font_family[] = 'Crimson Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700';
	$ai_automation_font_family[] = 'Yanone Kaffeesatz:wght@200;300;400;500;600;700';
	$ai_automation_font_family[] = 'Anton';
	$ai_automation_font_family[] = 'Libre Baskerville:ital,wght@0,400;0,700;1,400';
	$ai_automation_font_family[] = 'Bree Serif';
	$ai_automation_font_family[] = 'Gloria Hallelujah';
	$ai_automation_font_family[] = 'Abril Fatface';
	$ai_automation_font_family[] = 'Varela Round';
	$ai_automation_font_family[] = 'Vampiro One';
	$ai_automation_font_family[] = 'Shadows Into Light';
	$ai_automation_font_family[] = 'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$ai_automation_font_family[] = 'Rokkitt:wght@100;200;300;400;500;600;700;800;900';
	$ai_automation_font_family[] = 'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Francois One';
	$ai_automation_font_family[] = 'Orbitron:wght@400;500;600;700;800;900';
	$ai_automation_font_family[] = 'Patua One';
	$ai_automation_font_family[] = 'Acme';
	$ai_automation_font_family[] = 'Satisfy';
	$ai_automation_font_family[] = 'Josefin Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700';
	$ai_automation_font_family[] = 'Quattrocento Sans:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Architects Daughter';
	$ai_automation_font_family[] = 'Russo One';
	$ai_automation_font_family[] = 'Monda:wght@400;700';
	$ai_automation_font_family[] = 'Righteous';
	$ai_automation_font_family[] = 'Lobster Two:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Hammersmith One';
	$ai_automation_font_family[] = 'Courgette';
	$ai_automation_font_family[] = 'Permanent Marke';
	$ai_automation_font_family[] = 'Cherry Swash:wght@400;700';
	$ai_automation_font_family[] = 'Cormorant Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700';
	$ai_automation_font_family[] = 'Poiret One';
	$ai_automation_font_family[] = 'BenchNine:wght@300;400;700';
	$ai_automation_font_family[] = 'Economica:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Handlee';
	$ai_automation_font_family[] = 'Cardo:ital,wght@0,400;0,700;1,400';
	$ai_automation_font_family[] = 'Alfa Slab One';
	$ai_automation_font_family[] = 'Averia Serif Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700';
	$ai_automation_font_family[] = 'Cookie';
	$ai_automation_font_family[] = 'Chewy';
	$ai_automation_font_family[] = 'Great Vibes';
	$ai_automation_font_family[] = 'Coming Soon';
	$ai_automation_font_family[] = 'Philosopher:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Days One';
	$ai_automation_font_family[] = 'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Shrikhand';
	$ai_automation_font_family[] = 'Tangerine:wght@400;700';
	$ai_automation_font_family[] = 'IM Fell English SC';
	$ai_automation_font_family[] = 'Boogaloo';
	$ai_automation_font_family[] = 'Bangers';
	$ai_automation_font_family[] = 'Fredoka One';
	$ai_automation_font_family[] = 'Volkhov:ital,wght@0,400;0,700;1,400;1,700';
	$ai_automation_font_family[] = 'Shadows Into Light Two';
	$ai_automation_font_family[] = 'Marck Script';
	$ai_automation_font_family[] = 'Sacramento';
	$ai_automation_font_family[] = 'Unica One';
	$ai_automation_font_family[] = 'Dancing Script:wght@400;500;600;700';
	$ai_automation_font_family[] = 'Exo 2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$ai_automation_font_family[] = 'DM Serif Display:ital@0;1';
	$ai_automation_font_family[] = 'Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800';
	$ai_automation_font_family[] = 'Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800';

	$ai_automation_query_args = array(
		'family'	=> rawurlencode(implode('|',$ai_automation_font_family)),
	);
	$ai_automation_font_url = add_query_arg($ai_automation_query_args,'//fonts.googleapis.com/css');
	return $ai_automation_font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $ai_automation_font_url ) );
}

/**
 * Register widget area.
 */
function ai_automation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'ai-automation' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ai-automation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'ai-automation' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'ai-automation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'ai-automation' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ai-automation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ai-automation' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ai-automation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ai-automation' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ai-automation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'ai-automation' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ai-automation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'ai-automation' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ai-automation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'ai_automation_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ai_automation_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ai-automation-fonts', ai_automation_fonts_url(), array(), null );

	// owl
	wp_enqueue_style( 'owl-carousel-css', get_theme_file_uri( '/assets/css/owl.carousel.css' ) );

	// Bootstrap
	wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( '/assets/css/bootstrap.css' ) );

	// Theme stylesheet.
	wp_enqueue_style( 'ai-automation-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/tp-theme-color.php' );
	wp_add_inline_style( 'ai-automation-style',$ai_automation_tp_theme_css );
	wp_style_add_data('ai-automation-style', 'rtl', 'replace');
	require get_parent_theme_file_path( '/tp-body-width-layout.php' );
	wp_add_inline_style( 'ai-automation-style',$ai_automation_tp_theme_css );
	wp_style_add_data('ai-automation-style', 'rtl', 'replace');

	// Theme block stylesheet.
	wp_enqueue_style( 'ai-automation-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'ai-automation-style' ), '1.0' );

	// Fontawesome
	wp_enqueue_style( 'fontawesome-css', get_theme_file_uri( '/assets/css/fontawesome-all.css' ) );
	

	wp_enqueue_script( 'ai-automation-custom-scripts', get_template_directory_uri() . '/assets/js/ai-automation-custom.js', array('jquery'), true );


	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ), true );

	wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri( '/assets/js/owl.carousel.js' ), array( 'jquery' ), true );

	wp_enqueue_script( 'ai-automation-focus-nav', get_template_directory_uri() . '/assets/js/focus-nav.js', array('jquery'), true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$ai_automation_body_font_family = get_theme_mod('ai_automation_body_font_family', '');

	$ai_automation_heading_font_family = get_theme_mod('ai_automation_heading_font_family', '');

	$ai_automation_menu_font_family = get_theme_mod('ai_automation_menu_font_family', '');

	$ai_automation_tp_theme_css = '
		body, p.simplep, .more-btn a{
		    font-family: '.esc_html($ai_automation_body_font_family).';
		}
		h1,h2, h3, h4, h5, h6, .menubar,.logo h1, .logo p.site-title, p.simplep a, #slider p.slidertop-title, .more-btn a,.wc-block-checkout__actions_row .wc-block-components-checkout-place-order-button,.wc-block-cart__submit-container a,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, #theme-sidebar button[type="submit"],
#footer button[type="submit"]{
		    font-family: '.esc_html($ai_automation_heading_font_family).';
		}
	';
	wp_add_inline_style('ai-automation-style', $ai_automation_tp_theme_css);
}
add_action( 'wp_enqueue_scripts', 'ai_automation_scripts' );

/*radio button sanitization*/
function ai_automation_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Sanitize Sortable control.
function ai_automation_sanitize_sortable( $val, $setting ) {
	if ( is_string( $val ) || is_numeric( $val ) ) {
		return array(
			esc_attr( $val ),
		);
	}
	$sanitized_value = array();
	foreach ( $val as $item ) {
		if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
			$sanitized_value[] = esc_attr( $item );
		}
	}
	return $sanitized_value;
}
/* Excerpt Limit Begin */
function ai_automation_excerpt_function($excerpt_count = 35) {
    $ai_automation_excerpt = get_the_excerpt();

    $ai_automation_text_excerpt = wp_strip_all_tags($ai_automation_excerpt);

    $ai_automation_excerpt_limit = esc_attr(get_theme_mod('ai_automation_excerpt_count', $excerpt_count));

    $ai_automation_theme_excerpt = implode(' ', array_slice(explode(' ', $ai_automation_text_excerpt), 0, $ai_automation_excerpt_limit));

    return $ai_automation_theme_excerpt;
}

function ai_automation_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'ai_automation_loop_columns');
if (!function_exists('ai_automation_loop_columns')) {
	function ai_automation_loop_columns() {
		$columns = get_theme_mod( 'ai_automation_per_columns', 3 );
		return $columns;
	}
}

// Category count 
function ai_automation_display_post_category_count() {
    $ai_automation_category = get_the_category();
    $ai_automation_category_count = ($ai_automation_category) ? count($ai_automation_category) : 0;
    $ai_automation_category_text = ($ai_automation_category_count === 1) ? 'category' : 'categories'; // Check for pluralization
    echo $ai_automation_category_count . ' ' . $ai_automation_category_text;
}

//post tag
function ai_automation_custom_tags_filter($ai_automation_tag_list) {
    // Replace the comma (,) with an empty string
    $ai_automation_tag_list = str_replace(', ', '', $ai_automation_tag_list);

    return $ai_automation_tag_list;
}
add_filter('the_tags', 'ai_automation_custom_tags_filter');

function ai_automation_custom_output_tags() {
    $ai_automation_tags = get_the_tags();

    if ($ai_automation_tags) {
        $ai_automation_tags_output = '<div class="post_tag">Tags: ';

        $ai_automation_first_tag = reset($ai_automation_tags);

        foreach ($ai_automation_tags as $tag) {
            $ai_automation_tags_output .= '<a href="' . esc_url(get_tag_link($tag)) . '" rel="tag" class="me-2">' . esc_html($tag->name) . '</a>';
            if ($tag !== $ai_automation_first_tag) {
                $ai_automation_tags_output .= ' ';
            }
        }

        $ai_automation_tags_output .= '</div>';

        echo $ai_automation_tags_output;
    }
}
//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'ai_automation_per_page', 20 );
function ai_automation_per_page( $ai_automation_cols ) {
  	$ai_automation_cols = get_theme_mod( 'ai_automation_product_per_page', 9 );
	return $ai_automation_cols;
}

function ai_automation_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function ai_automation_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function ai_automation_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/**
 * Use front-page.php when Front page displays is set to a static page.
 */
function ai_automation_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template','ai_automation_front_page_template' );

// logo
function ai_automation_logo_width(){

	$ai_automation_logo_width   = get_theme_mod( 'ai_automation_logo_width', 80 );

	echo "<style type='text/css' media='all'>"; ?>
		img.custom-logo{
		    width: <?php echo absint( $ai_automation_logo_width ); ?>px;
		    max-width: 100%;
		}
	<?php echo "</style>";
}

add_action( 'wp_head', 'ai_automation_logo_width' );


/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Load Theme Web File
 */
require get_parent_theme_file_path('/inc/wptt-webfont-loader.php' );
/**
 * Load Theme Web File
 */
require get_parent_theme_file_path( '/inc/controls/customize-control-toggle.php' );
/**
 * load sortable file
 */
require get_parent_theme_file_path( '/inc/controls/sortable-control.php' );

/**
 * TGM Recommendation
 */
require get_parent_theme_file_path( '/inc/TGM/tgm.php' );

/**
 * About Theme Page
 */
require get_parent_theme_file_path( '/inc/about-theme.php' );

// footer link
define('AI_AUTOMATION_CREDIT',__('https://www.themespride.com/products/free-ai-wordpress-theme','ai-automation') );
if ( ! function_exists( 'ai_automation_credit' ) ) {
	function ai_automation_credit(){
		echo "<a href=".esc_url(AI_AUTOMATION_CREDIT)." target='_blank'>".esc_html__(get_theme_mod('ai_automation_footer_text',__('AI Automation WordPress Theme','ai-automation')))."</a>";
	}
}

//Admin Enqueue for Admin
function ai_automation_admin_enqueue_scripts(){
	wp_enqueue_style('ai-automation-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
	wp_register_script( 'ai-automation-admin-script', get_template_directory_uri() . '/assets/js/ai-automation-admin.js', array( 'jquery' ), '', true );

	wp_localize_script(
		'ai-automation-admin-script',
		'ai_automation',
		array(
			'admin_ajax'	=>	admin_url('admin-ajax.php'),
			'wpnonce'			=>	wp_create_nonce('ai_automation_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('ai-automation-admin-script');

    wp_localize_script( 'ai-automation-admin-script', 'ai_automation_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'ai_automation_admin_enqueue_scripts' );

// get started
add_action( 'wp_ajax_ai_automation_dismissed_notice_handler', 'ai_automation_ajax_notice_handler' );

function ai_automation_ajax_notice_handler() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'ai_automation_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function ai_automation_activation_notice() { 

	if ( ! get_option('dismissed-get_started', FALSE ) ) { ?>

    <div class="ai-automation-notice-wrapper updated notice notice-get-started-class is-dismissible" data-notice="get_started">
        <div class="ai-automation-getting-started-notice clearfix">
            <div class="ai-automation-theme-notice-content">
                <h2 class="ai-automation-notice-h2">
                    <?php
                printf(
                /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                    esc_html__( 'Welcome! Thank you for choosing %1$s!', 'ai-automation' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                ?>
                </h2>

                <p class="plugin-install-notice"><?php echo sprintf(__('Click here to get started with the theme set-up.', 'ai-automation')) ?></p>

                <a class="ai-automation-btn-get-started button button-primary button-hero ai-automation-button-padding" href="<?php echo esc_url( admin_url( 'themes.php?page=ai-automation-about' )); ?>" ><?php esc_html_e( 'Begin Installation - Import Demo', 'ai-automation' ) ?></a><span class="ai-automation-push-down">
                <?php
                    /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                    printf(
                        'or %1$sCustomize theme%2$s</a></span>',
                        '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                        '</a>'
                    );
                ?>
            </div>
        </div>
    </div>
<?php }

}
add_action( 'admin_notices', 'ai_automation_activation_notice' );

add_action('after_switch_theme', 'ai_automation_setup_options');
function ai_automation_setup_options () {
    update_option('dismissed-get_started', FALSE );
}