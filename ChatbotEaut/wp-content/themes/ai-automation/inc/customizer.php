<?php
/**
 * AI Automation: Customizer
 *
 * @package AI Automation
 * @subpackage ai_automation
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Ai_Automation_Customize_register( $wp_customize ) {

	require get_parent_theme_file_path('/inc/controls/range-slider-control.php');

	require get_parent_theme_file_path('/inc/controls/icon-changer.php');
	
	// Register the custom control type.
	$wp_customize->register_control_type( 'Ai_Automation_Toggle_Control' );
	
	//Register the sortable control type.
	$wp_customize->register_control_type( 'Ai_Automation_Control_Sortable' );

	//add home page setting pannel
	$wp_customize->add_panel( 'ai_automation_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Custom Home page', 'ai-automation' ),
	    'description' => __( 'Description of what this panel does.', 'ai-automation' ),
	) );
	
	//TP GENRAL OPTION
	$wp_customize->add_section('ai_automation_tp_general_settings',array(
        'title' => __('TP General Option', 'ai-automation'),
        'priority' => 1,
        'panel' => 'ai_automation_panel_id'
    ) );

    $wp_customize->add_setting('ai_automation_tp_body_layout_settings',array(
        'default' => 'Full',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
    $wp_customize->add_control('ai_automation_tp_body_layout_settings',array(
        'type' => 'radio',
        'label'     => __('Body Layout Setting', 'ai-automation'),
        'description'   => __('This option work for complete body, if you want to set the complete website in container.', 'ai-automation'),
        'section' => 'ai_automation_tp_general_settings',
        'choices' => array(
            'Full' => __('Full','ai-automation'),
            'Container' => __('Container','ai-automation'),
            'Container Fluid' => __('Container Fluid','ai-automation')
        ),
	) );

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('ai_automation_sidebar_post_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_sidebar_post_layout',array(
        'type' => 'radio',
        'label'     => __('Post Sidebar Position', 'ai-automation'),
        'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'ai-automation'),
        'section' => 'ai_automation_tp_general_settings',
        'choices' => array(
            'full' => __('Full','ai-automation'),
            'left' => __('Left','ai-automation'),
            'right' => __('Right','ai-automation'),
            'three-column' => __('Three Columns','ai-automation'),
            'four-column' => __('Four Columns','ai-automation'),
            'grid' => __('Grid Layout','ai-automation')
        ),
	) );

	// Add Settings and Controls for post sidebar Layout
	$wp_customize->add_setting('ai_automation_sidebar_single_post_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_sidebar_single_post_layout',array(
        'type' => 'radio',
        'label'     => __('Single Post Sidebar Position', 'ai-automation'),
        'description'   => __('This option work for single blog page', 'ai-automation'),
        'section' => 'ai_automation_tp_general_settings',
        'choices' => array(
            'full' => __('Full','ai-automation'),
            'left' => __('Left','ai-automation'),
            'right' => __('Right','ai-automation'),
        ),
	) );

	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('ai_automation_sidebar_page_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_sidebar_page_layout',array(
        'type' => 'radio',
        'label'     => __('Page Sidebar Position', 'ai-automation'),
        'description'   => __('This option work for pages.', 'ai-automation'),
        'section' => 'ai_automation_tp_general_settings',
        'choices' => array(
            'full' => __('Full','ai-automation'),
            'left' => __('Left','ai-automation'),
            'right' => __('Right','ai-automation')
        ),
	) );

	$wp_customize->add_setting( 'ai_automation_sticky', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_sticky', array(
		'label'       => esc_html__( 'Show Sticky Header', 'ai-automation' ),
		'section'     => 'ai_automation_tp_general_settings',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_sticky',
	) ) );

	//tp typography option
	$ai_automation_font_array = array(
		''                       => 'No Fonts',
		'Abril Fatface'          => 'Abril Fatface',
		'Acme'                   => 'Acme',
		'Anton'                  => 'Anton',
		'Architects Daughter'    => 'Architects Daughter',
		'Arimo'                  => 'Arimo',
		'Arsenal'                => 'Arsenal',
		'Arvo'                   => 'Arvo',
		'Alegreya'               => 'Alegreya',
		'Alfa Slab One'          => 'Alfa Slab One',
		'Averia Serif Libre'     => 'Averia Serif Libre',
		'Bangers'                => 'Bangers',
		'Boogaloo'               => 'Boogaloo',
		'Bad Script'             => 'Bad Script',
		'Bitter'                 => 'Bitter',
		'Bree Serif'             => 'Bree Serif',
		'BenchNine'              => 'BenchNine',
		'Cabin'                  => 'Cabin',
		'Cardo'                  => 'Cardo',
		'Courgette'              => 'Courgette',
		'Cherry Swash'           => 'Cherry Swash',
		'Cormorant Garamond'     => 'Cormorant Garamond',
		'Crimson Text'           => 'Crimson Text',
		'Cuprum'                 => 'Cuprum',
		'Cookie'                 => 'Cookie',
		'Chewy'                  => 'Chewy',
		'Days One'               => 'Days One',
		'Dosis'                  => 'Dosis',
		'Droid Sans'             => 'Droid Sans',
		'Economica'              => 'Economica',
		'Fredoka One'            => 'Fredoka One',
		'Fjalla One'             => 'Fjalla One',
		'Francois One'           => 'Francois One',
		'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
		'Gloria Hallelujah'      => 'Gloria Hallelujah',
		'Great Vibes'            => 'Great Vibes',
		'Handlee'                => 'Handlee',
		'Hammersmith One'        => 'Hammersmith One',
		'Inconsolata'            => 'Inconsolata',
		'Indie Flower'           => 'Indie Flower',
		'Inter'                  => 'Inter',
		'IM Fell English SC'     => 'IM Fell English SC',
		'Julius Sans One'        => 'Julius Sans One',
		'Josefin Slab'           => 'Josefin Slab',
		'Josefin Sans'           => 'Josefin Sans',
		'Kanit'                  => 'Kanit',
		'Karla'                  => 'Karla',
		'Lobster'                => 'Lobster',
		'Lato'                   => 'Lato',
		'Lora'                   => 'Lora',
		'Libre Baskerville'      => 'Libre Baskerville',
		'Lobster Two'            => 'Lobster Two',
		'Merriweather'           => 'Merriweather',
		'Monda'                  => 'Monda',
		'Montserrat'             => 'Montserrat',
		'Muli'                   => 'Muli',
		'Marck Script'           => 'Marck Script',
		'Noto Serif'             => 'Noto Serif',
		'Open Sans'              => 'Open Sans',
		'Overpass'               => 'Overpass',
		'Overpass Mono'          => 'Overpass Mono',
		'Oxygen'                 => 'Oxygen',
		'Orbitron'               => 'Orbitron',
		'Patua One'              => 'Patua One',
		'Pacifico'               => 'Pacifico',
		'Padauk'                 => 'Padauk',
		'Playball'               => 'Playball',
		'Playfair Display'       => 'Playfair Display',
		'PT Sans'                => 'PT Sans',
		'Philosopher'            => 'Philosopher',
		'Permanent Marker'       => 'Permanent Marker',
		'Poiret One'             => 'Poiret One',
		'Quicksand'              => 'Quicksand',
		'Quattrocento Sans'      => 'Quattrocento Sans',
		'Raleway'                => 'Raleway',
		'Rubik'                  => 'Rubik',
		'Rokkitt'                => 'Rokkitt',
		'Russo One'              => 'Russo One',
		'Righteous'              => 'Righteous',
		'Slabo'                  => 'Slabo',
		'Source Sans Pro'        => 'Source Sans Pro',
		'Shadows Into Light Two' => 'Shadows Into Light Two',
		'Shadows Into Light'     => 'Shadows Into Light',
		'Sacramento'             => 'Sacramento',
		'Shrikhand'              => 'Shrikhand',
		'Tangerine'              => 'Tangerine',
		'Ubuntu'                 => 'Ubuntu',
		'VT323'                  => 'VT323',
		'Varela Round'           => 'Varela Round',
		'Vampiro One'            => 'Vampiro One',
		'Vollkorn'               => 'Vollkorn',
		'Volkhov'                => 'Volkhov',
		'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
	);

	$wp_customize->add_section('ai_automation_typography_option',array(
		'title'         => __('TP Typography Option', 'ai-automation'),
		'priority' => 1,
		'panel' => 'ai_automation_panel_id'
   	));

   	$wp_customize->add_setting('ai_automation_heading_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ai_automation_sanitize_choices',
	));
	$wp_customize->add_control(	'ai_automation_heading_font_family', array(
		'section' => 'ai_automation_typography_option',
		'label'   => __('heading Fonts', 'ai-automation'),
		'type'    => 'select',
		'choices' => $ai_automation_font_array,
	));

	$wp_customize->add_setting('ai_automation_body_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ai_automation_sanitize_choices',
	));
	$wp_customize->add_control(	'ai_automation_body_font_family', array(
		'section' => 'ai_automation_typography_option',
		'label'   => __('Body Fonts', 'ai-automation'),
		'type'    => 'select',
		'choices' => $ai_automation_font_array,
	));

	//TP Preloader Option
	$wp_customize->add_section('ai_automation_prelaoder_option',array(
		'title'         => __('TP Preloader Option', 'ai-automation'),
		'priority' => 1,
		'panel' => 'ai_automation_panel_id'
	) );

	$wp_customize->add_setting( 'ai_automation_preloader_show_hide', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_preloader_show_hide', array(
		'label'       => esc_html__( 'Show / Hide Preloader Option', 'ai-automation' ),
		'section'     => 'ai_automation_prelaoder_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_preloader_show_hide',
	) ) );

	$wp_customize->add_setting( 'ai_automation_tp_preloader_color1_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_tp_preloader_color1_option', array(
			'label'     => __('Preloader First Ring Color', 'ai-automation'),
	    'description' => __('It will change the complete theme preloader ring 1 color in one click.', 'ai-automation'),
	    'section' => 'ai_automation_prelaoder_option',
	    'settings' => 'ai_automation_tp_preloader_color1_option',
  	)));

  	$wp_customize->add_setting( 'ai_automation_tp_preloader_color2_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_tp_preloader_color2_option', array(
			'label'     => __('Preloader Second Ring Color', 'ai-automation'),
	    'description' => __('It will change the complete theme preloader ring 2 color in one click.', 'ai-automation'),
	    'section' => 'ai_automation_prelaoder_option',
	    'settings' => 'ai_automation_tp_preloader_color2_option',
  	)));

  	$wp_customize->add_setting( 'ai_automation_tp_preloader_bg_color_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_tp_preloader_bg_color_option', array(
			'label'     => __('Preloader Background Color', 'ai-automation'),
	    'description' => __('It will change the complete theme preloader bg color in one click.', 'ai-automation'),
	    'section' => 'ai_automation_prelaoder_option',
	    'settings' => 'ai_automation_tp_preloader_bg_color_option',
  	)));

	//TP Color Option
	$wp_customize->add_section('ai_automation_color_option',array(
     'title'         => __('TP Color Option', 'ai-automation'),
     'priority' => 1,
     'panel' => 'ai_automation_panel_id'
    ) );
    
	$wp_customize->add_setting( 'ai_automation_tp_color_option_first', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_tp_color_option_first', array(
			'label'     => __('Theme First Color', 'ai-automation'),
	    'description' => __('It will change the complete theme color in one click.', 'ai-automation'),
	    'section' => 'ai_automation_color_option',
	    'settings' => 'ai_automation_tp_color_option_first',
  	)));

	//TP Blog Option
	$wp_customize->add_section('ai_automation_blog_option',array(
        'title' => __('TP Blog Option', 'ai-automation'),
        'priority' => 1,
        'panel' => 'ai_automation_panel_id'
    ) );

    $wp_customize->add_setting('ai_automation_edit_blog_page_title',array(
		'default'=> 'Home',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_edit_blog_page_title',array(
		'label'	=> __('Change Blog Page Title','ai-automation'),
		'section'=> 'ai_automation_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ai_automation_edit_blog_page_description',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_edit_blog_page_description',array(
		'label'	=> __('Add Blog Page Description','ai-automation'),
		'section'=> 'ai_automation_blog_option',
		'type'=> 'text'
	));

	/** Meta Order */
    $wp_customize->add_setting('blog_meta_order', array(
        'default' => array('date', 'author', 'comment','category'),
        'sanitize_callback' => 'ai_automation_sanitize_sortable',
    ));
    $wp_customize->add_control(new Ai_Automation_Control_Sortable($wp_customize, 'blog_meta_order', array(
    	'label' => esc_html__('Meta Order', 'ai-automation'),
        'description' => __('Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'ai-automation') ,
        'section' => 'ai_automation_blog_option',
        'choices' => array(
            'date' => __('date', 'ai-automation') ,
            'author' => __('author', 'ai-automation') ,
            'comment' => __('comment', 'ai-automation') ,
            'category' => __('category', 'ai-automation') ,
        ) ,
    )));

    $wp_customize->add_setting( 'ai_automation_excerpt_count', array(
		'default'              => 35,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ai_automation_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'ai_automation_excerpt_count', array(
		'label'       => esc_html__( 'Edit Excerpt Limit','ai-automation' ),
		'section'     => 'ai_automation_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('ai_automation_read_more_text',array(
		'default'=> __('Read More','ai-automation'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_read_more_text',array(
		'label'	=> __('Edit Button Text','ai-automation'),
		'section'=> 'ai_automation_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ai_automation_post_image_round', array(
	  'default' => '0',
      'sanitize_callback' => 'ai_automation_sanitize_number_range',
	));
	$wp_customize->add_control(new Ai_Automation_Range_Slider($wp_customize, 'ai_automation_post_image_round', array(
       'section' => 'ai_automation_blog_option',
      'label' => esc_html__('Edit Post Image Border Radius', 'ai-automation'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 180,
        'step' => 1
    )
	)));

	$wp_customize->add_setting('ai_automation_post_image_width', array(
	  'default' => '',
      'sanitize_callback' => 'ai_automation_sanitize_number_range',
	));
	$wp_customize->add_control(new Ai_Automation_Range_Slider($wp_customize, 'ai_automation_post_image_width', array(
       'section' => 'ai_automation_blog_option',
      'label' => esc_html__('Edit Post Image Width', 'ai-automation'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 367,
        'step' => 1
    )
	)));

	$wp_customize->add_setting('ai_automation_post_image_length', array(
	  'default' => '',
      'sanitize_callback' => 'ai_automation_sanitize_number_range',
	));
	$wp_customize->add_control(new Ai_Automation_Range_Slider($wp_customize, 'ai_automation_post_image_length', array(
       'section' => 'ai_automation_blog_option',
      'label' => esc_html__('Edit Post Image height', 'ai-automation'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 900,
        'step' => 1
    )
	)));
	
	$wp_customize->add_setting( 'ai_automation_remove_read_button', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_remove_read_button', array(
		'label'       => esc_html__( 'Show / Hide Read More Button', 'ai-automation' ),
		'section'     => 'ai_automation_blog_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_remove_read_button',
	) ) );

	$wp_customize->add_setting( 'ai_automation_remove_tags', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_remove_tags', array(
		'label'       => esc_html__( 'Show / Hide Tags Option', 'ai-automation' ),
		'section'     => 'ai_automation_blog_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_remove_tags',
	) ) );

	$wp_customize->add_setting( 'ai_automation_remove_category', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_remove_category', array(
		'label'       => esc_html__( 'Show / Hide Category Option', 'ai-automation' ),
		'section'     => 'ai_automation_blog_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_remove_category',
	) ) );

	$wp_customize->add_setting( 'ai_automation_remove_comment', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'ai_automation_sanitize_checkbox',
 	) );

	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_remove_comment', array(
	 'label'       => esc_html__( 'Show / Hide Comment Form', 'ai-automation' ),
	 'section'     => 'ai_automation_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'ai_automation_remove_comment',
	) ) );

	$wp_customize->add_setting( 'ai_automation_remove_related_post', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'ai_automation_sanitize_checkbox',
 	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_remove_related_post', array(
	 'label'       => esc_html__( 'Show / Hide Related Post', 'ai-automation' ),
	 'section'     => 'ai_automation_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'ai_automation_remove_related_post',
	) ) );

	$wp_customize->add_setting('ai_automation_related_post_heading',array(
		'default'=> __('Related Posts','ai-automation'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_related_post_heading',array(
		'label'	=> __('Edit Section Title','ai-automation'),
		'section'=> 'ai_automation_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ai_automation_related_post_per_page', array(
		'default'              => 3,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ai_automation_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'ai_automation_related_post_per_page', array(
		'label'       => esc_html__( 'Related Post Per Page','ai-automation' ),
		'section'     => 'ai_automation_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 3,
			'max'              => 9,
		),
	) );

	$wp_customize->add_setting( 'ai_automation_related_post_per_columns', array(
		'default'              => 3,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ai_automation_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'ai_automation_related_post_per_columns', array(
		'label'       => esc_html__( 'Related Post Per Row','ai-automation' ),
		'section'     => 'ai_automation_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 4,
		),
	) );

	$wp_customize->add_setting('ai_automation_post_layout',array(
        'default' => 'image-content',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_post_layout',array(
        'type' => 'radio',
        'label'     => __('Post Layout', 'ai-automation'),
        'section' => 'ai_automation_blog_option',
        'choices' => array(
            'image-content' => __('Media-Content','ai-automation'),
            'content-image' => __('Content-Media','ai-automation'),
        ),
	) );

	//MENU TYPOGRAPHY
	$wp_customize->add_section( 'ai_automation_menu_typography', array(
    	'title'      => __( 'Menu Typography', 'ai-automation' ),
    	'priority' => 2,
		'panel' => 'ai_automation_panel_id'
	) );

	$wp_customize->add_setting('ai_automation_menu_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ai_automation_sanitize_choices',
	));
	$wp_customize->add_control(	'ai_automation_menu_font_family', array(
		'section' => 'ai_automation_menu_typography',
		'label'   => __('Menu Fonts', 'ai-automation'),
		'type'    => 'select',
		'choices' => $ai_automation_font_array,
	));

	$wp_customize->add_setting('ai_automation_menu_font_weight',array(
        'default' => '',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_menu_font_weight',array(
     'type' => 'radio',
     'label'     => __('Font Weight', 'ai-automation'),
     'section' => 'ai_automation_menu_typography',
     'type' => 'select',
     'choices' => array(
         '100' => __('100','ai-automation'),
         '200' => __('200','ai-automation'),
         '300' => __('300','ai-automation'),
         '400' => __('400','ai-automation'),
         '500' => __('500','ai-automation'),
         '600' => __('600','ai-automation'),
         '700' => __('700','ai-automation'),
         '800' => __('800','ai-automation'),
         '900' => __('900','ai-automation')
     ),
	) );

	$wp_customize->add_setting('ai_automation_menu_text_tranform',array(
		'default' => '',
		'sanitize_callback' => 'ai_automation_sanitize_choices'
 	));
 	$wp_customize->add_control('ai_automation_menu_text_tranform',array(
		'type' => 'select',
		'label' => __('Menu Text Transform','ai-automation'),
		'section' => 'ai_automation_menu_typography',
		'choices' => array(
		   'Uppercase' => __('Uppercase','ai-automation'),
		   'Lowercase' => __('Lowercase','ai-automation'),
		   'Capitalize' => __('Capitalize','ai-automation'),
		),
	) );
	$wp_customize->add_setting('ai_automation_menu_font_size', array(
	  'default' => '',
      'sanitize_callback' => 'ai_automation_sanitize_number_range',
	));
	$wp_customize->add_control(new Ai_Automation_Range_Slider($wp_customize, 'ai_automation_menu_font_size', array(
        'section' => 'ai_automation_menu_typography',
        'label' => esc_html__('Font Size', 'ai-automation'),
        'input_attrs' => array(
          'min' => 0,
          'max' => 20,
          'step' => 1
    )
	)));

	$wp_customize->add_setting( 'ai_automation_menu_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_menu_color', array(
			'label'     => __('Change Menu Color', 'ai-automation'),
	    'section' => 'ai_automation_menu_typography',
	    'settings' => 'ai_automation_menu_color',
  	)));

	// Top Bar
	$wp_customize->add_section( 'ai_automation_topbar', array(
    	'title'      => __( 'Header Details', 'ai-automation' ),
    	'priority' => 2,
    	'description' => __( 'Add your contact details', 'ai-automation' ),
		'panel' => 'ai_automation_panel_id'
	) );

	$wp_customize->add_setting('ai_automation_header_button',array(
		'default'=> 'Get Start',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_header_button',array(
		'label'	=> __('Change Header Button Text','ai-automation'),
		'section'=> 'ai_automation_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ai_automation_header_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('ai_automation_header_link',array(
		'label'	=> __('Add Header Button Link','ai-automation'),
		'section'=> 'ai_automation_topbar',
		'type'=> 'url'
	));

	//home page slider
	$wp_customize->add_section( 'ai_automation_slider_section' , array(
    	'title'      => __( 'Slider Section', 'ai-automation' ),
    	'priority' => 2,
		'panel' => 'ai_automation_panel_id'
	) );

	$wp_customize->add_setting( 'ai_automation_slider_arrows', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_slider_arrows', array(
		'label'       => esc_html__( 'Show / Hide slider', 'ai-automation' ),
		'section'     => 'ai_automation_slider_section',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_slider_arrows',
	) ) );

	for ( $ai_automation_count = 1; $ai_automation_count <= 3; $ai_automation_count++ ) {

		$wp_customize->add_setting( 'ai_automation_slider_page' . $ai_automation_count, array(
			'default'           => '',
			'sanitize_callback' => 'ai_automation_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'ai_automation_slider_page' . $ai_automation_count, array(
			'label'    => __( 'Select Slide Image Page', 'ai-automation' ),
			'section'  => 'ai_automation_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('ai_automation_slider_side_text',array(
		'default'=> 'AI',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_slider_side_text',array(
		'label'	=> __('Change Background Text','ai-automation'),
		'section'=> 'ai_automation_slider_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ai_automation_slider_short_heading',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_slider_short_heading',array(
		'label'	=> __('Add short Heading','ai-automation'),
		'section'=> 'ai_automation_slider_section',
		'type'=> 'text'
	));

	// About Us Section
	$wp_customize->add_section('ai_automation_about_section', array(
	    'title'    => __('About Us Section', 'ai-automation'),
	    'panel'    => 'ai_automation_panel_id',
	    'priority' => 3,
	));

	$wp_customize->add_setting('ai_automation_about_enable', array(
	    'default'           => true,
	    'transport'         => 'refresh',
	    'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	));
	$wp_customize->add_control(new Ai_Automation_Toggle_Control($wp_customize, 'ai_automation_about_enable', array(
	    'label'    => esc_html__('Show / Hide Section', 'ai-automation'),
	    'section'  => 'ai_automation_about_section',
	    'type'     => 'toggle',
	    'settings' => 'ai_automation_about_enable',
	)));

	$wp_customize->add_setting('ai_automation_service_sub_heading', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_service_sub_heading', array(
	    'label'    => __('Section Sub Title', 'ai-automation'),
	    'section'  => 'ai_automation_about_section',
	    'type'     => 'text'
	));

	// Add a default "Select" option to the dropdown
	$wp_customize->add_setting('ai_automation_about_page', array(
	    'default'           => '0', 
	    'sanitize_callback' => 'ai_automation_sanitize_dropdown_pages'
	));
	$wp_customize->add_control('ai_automation_about_page', array(
	    'label'    => __('Select About Page', 'ai-automation'),
	    'section'  => 'ai_automation_about_section',
	    'type'     => 'dropdown-pages'
	));

	$wp_customize->add_setting('ai_automation_satisfied_client',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_satisfied_client',array(
		'label'	=> __('Add Total Year Of Experience','ai-automation'),
		'section'	=> 'ai_automation_about_section',
		'type'		=> 'text'
	));

	for($ai_automation_i=1;$ai_automation_i<=2;$ai_automation_i++) {

	    $wp_customize->add_setting('ai_automation_tab_heading'.$ai_automation_i,array(
	        'default'=> '',
	        'sanitize_callback' => 'sanitize_text_field'
	    ));
	    $wp_customize->add_control('ai_automation_tab_heading'.$ai_automation_i,array(
	        'label' => __('About Title ','ai-automation').$ai_automation_i,
	        'section'=> 'ai_automation_about_section',
	        'setting'=> 'ai_automation_tab_heading'.$ai_automation_i,
	        'type'=> 'text'
	    ));

	    $wp_customize->add_setting('ai_automation_tab_para'.$ai_automation_i,array(
	        'default'=> '',
	        'sanitize_callback' => 'sanitize_text_field'
	    ));
	    $wp_customize->add_control('ai_automation_tab_para'.$ai_automation_i,array(
	        'label' => __('About Description','ai-automation').$ai_automation_i,
	        'section'=> 'ai_automation_about_section',
	        'setting'=> 'ai_automation_tab_para'.$ai_automation_i,
	        'type'=> 'text'
	    ));
  	}

	//footer
	$wp_customize->add_section('ai_automation_footer_section',array(
		'title'	=> __('Footer Widget Settings','ai-automation'),
		'panel' => 'ai_automation_panel_id',
		'priority' => 4,
	));

	$wp_customize->add_setting('ai_automation_footer_columns',array(
		'default'	=> 4,
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_footer_columns',array(
		'label'	=> __('Footer Widget Columns','ai-automation'),
		'section'	=> 'ai_automation_footer_section',
		'setting'	=> 'ai_automation_footer_columns',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 4,
		),
	));
	$wp_customize->add_setting( 'ai_automation_tp_footer_bg_color_option', array(
		'default' => '#151515',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_tp_footer_bg_color_option', array(
		'label'     => __('Footer Widget Background Color', 'ai-automation'),
		'description' => __('It will change the complete footer widget backgorund color.', 'ai-automation'),
		'section' => 'ai_automation_footer_section',
		'settings' => 'ai_automation_tp_footer_bg_color_option',
	)));

	$wp_customize->add_setting('ai_automation_footer_widget_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'ai_automation_footer_widget_image',array(
       'label' => __('Footer Widget Background Image','ai-automation'),
       'section' => 'ai_automation_footer_section'
	)));

	//footer widget title font size
	$wp_customize->add_setting('ai_automation_footer_widget_title_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_footer_widget_title_font_size',array(
		'label'	=> __('Change Footer Widget Title Font Size in PX','ai-automation'),
		'section'	=> 'ai_automation_footer_section',
	    'setting'	=> 'ai_automation_footer_widget_title_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'ai_automation_footer_widget_title_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_footer_widget_title_color', array(
			'label'     => __('Change Footer Widget Title Color', 'ai-automation'),
	    'section' => 'ai_automation_footer_section',
	    'settings' => 'ai_automation_footer_widget_title_color',
  	)));
  	
	$wp_customize->add_setting( 'ai_automation_return_to_header', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_return_to_header', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'ai-automation' ),
		'section'     => 'ai_automation_footer_section',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_return_to_header',
	) ) );

	$wp_customize->add_setting('ai_automation_return_icon',array(
		'default'	=> 'fas fa-arrow-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ai_Automation_Icon_Changer(
       $wp_customize,'ai_automation_return_icon',array(
		'label'	=> __('Return to header Icon','ai-automation'),
		'transport' => 'refresh',
		'section'	=> 'ai_automation_footer_section',
		'type'		=> 'icon'
	)));

	//footer
	$wp_customize->add_section('ai_automation_footer_copyright_section',array(
		'title'	=> __('Footer Copyright Settings','ai-automation'),
		'description'	=> __('Add copyright text.','ai-automation'),
		'panel' => 'ai_automation_panel_id',
		'priority' => 5,
	));

	$wp_customize->add_setting('ai_automation_footer_text',array(
		'default'	=> 'AI Automation WordPress Theme',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_footer_text',array(
		'label'	=> __('Copyright Text','ai-automation'),
		'section'	=> 'ai_automation_footer_copyright_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('ai_automation_footer_copyright_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_footer_copyright_font_size',array(
		'label'	=> __('Change Footer Copyright Font Size in PX','ai-automation'),
		'section'	=> 'ai_automation_footer_copyright_section',
	    'setting'	=> 'ai_automation_footer_copyright_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'ai_automation_footer_copyright_text_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_footer_copyright_text_color', array(
			'label'     => __('Change Footer Copyright Text Color', 'ai-automation'),
	    'section' => 'ai_automation_footer_copyright_section',
	    'settings' => 'ai_automation_footer_copyright_text_color',
  	)));

  	$wp_customize->add_setting('ai_automation_footer_copyright_top_bottom_padding',array(
		'default'	=> '',
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_footer_copyright_top_bottom_padding',array(
		'label'	=> __('Change Footer Copyright Padding in PX','ai-automation'),
		'section'	=> 'ai_automation_footer_copyright_section',
	    'setting'	=> 'ai_automation_footer_copyright_top_bottom_padding',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	// Add Settings and Controls for Scroll top
	$wp_customize->add_setting('ai_automation_copyright_text_position',array(
        'default' => 'Center',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_copyright_text_position',array(
        'type' => 'radio',
        'label'     => __('Copyright Text Position', 'ai-automation'),
        'description'   => __('This option work for Copyright', 'ai-automation'),
        'section' => 'ai_automation_footer_copyright_section',
        'choices' => array(
            'Right' => __('Right','ai-automation'),
            'Left' => __('Left','ai-automation'),
            'Center' => __('Center','ai-automation')
        ),
	) );

	//Mobile resposnsive
	$wp_customize->add_section('ai_automation_mobile_media_option',array(
		'title'         => __('Mobile Responsive media', 'ai-automation'),
		'description' => __('Control will not function if the toggle in the main settings is off.', 'ai-automation'),
		'priority' => 5,
		'panel' => 'ai_automation_panel_id'
	) );

	$wp_customize->add_setting( 'ai_automation_mobile_blog_description', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new ai_automation_Toggle_Control( $wp_customize, 'ai_automation_mobile_blog_description', array(
		'label'       => esc_html__( 'Show / Hide Blog Page Description', 'ai-automation' ),
		'section'     => 'ai_automation_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_mobile_blog_description',
	) ) );

	$wp_customize->add_setting( 'ai_automation_return_to_header_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_return_to_header_mob', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'ai-automation' ),
		'section'     => 'ai_automation_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_return_to_header_mob',
	) ) );

	$wp_customize->add_setting( 'ai_automation_slider_buttom_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_slider_buttom_mob', array(
		'label'       => esc_html__( 'Show / Hide Slider Button', 'ai-automation' ),
		'section'     => 'ai_automation_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_slider_buttom_mob',
	) ) );

	$wp_customize->add_setting( 'ai_automation_related_post_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_related_post_mob', array(
		'label'       => esc_html__( 'Show / Hide Related Post', 'ai-automation' ),
		'section'     => 'ai_automation_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_related_post_mob',
	) ) );

    // Add Settings and Controls for Scroll top
	$wp_customize->add_setting('ai_automation_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_scroll_top_position',array(
        'type' => 'radio',
        'label'     => __('Scroll to top Position', 'ai-automation'),
        'description'   => __('This option work for scroll to top', 'ai-automation'),
        'section' => 'ai_automation_footer_section',
        'choices' => array(
            'Right' => __('Right','ai-automation'),
            'Left' => __('Left','ai-automation'),
            'Center' => __('Center','ai-automation')
        ),
	) );
	
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';

	//site Title
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'Ai_Automation_Customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'Ai_Automation_Customize_partial_blogdescription',
	) );

	$wp_customize->add_setting( 'ai_automation_site_title', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_site_title', array(
		'label'       => esc_html__( 'Show / Hide Site Title', 'ai-automation' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_site_title',
	) ) );

	// logo site title size
	$wp_customize->add_setting('ai_automation_site_title_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_site_title_font_size',array(
		'label'	=> __('Site Title Font Size in PX','ai-automation'),
		'section'	=> 'title_tagline',
		'setting'	=> 'ai_automation_site_title_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
		    'step'             => 1,
			'min'              => 0,
			'max'              => 30,
			),
	));

	$wp_customize->add_setting( 'ai_automation_site_tagline_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_site_tagline_color', array(
			'label'     => __('Change Site Title Color', 'ai-automation'),
	    'section' => 'title_tagline',
	    'settings' => 'ai_automation_site_tagline_color',
  	)));

	$wp_customize->add_setting( 'ai_automation_site_tagline', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_site_tagline', array(
		'label'       => esc_html__( 'Show / Hide Site Tagline', 'ai-automation' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_site_tagline',
	) ) );

	// logo site tagline size
	$wp_customize->add_setting('ai_automation_site_tagline_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_site_tagline_font_size',array(
		'label'	=> __('Site Tagline Font Size in PX','ai-automation'),
		'section'	=> 'title_tagline',
		'setting'	=> 'ai_automation_site_tagline_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 30,
		),
	));

	$wp_customize->add_setting( 'ai_automation_logo_tagline_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_logo_tagline_color', array(
			'label'     => __('Change Site Tagline Color', 'ai-automation'),
	    'section' => 'title_tagline',
	    'settings' => 'ai_automation_logo_tagline_color',
  	)));

    $wp_customize->add_setting('ai_automation_logo_width',array(
	   'default' => 80,
	   'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_logo_width',array(
		'label'	=> esc_html__('Here You Can Customize Your Logo Size','ai-automation'),
		'section'	=> 'title_tagline',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('ai_automation_per_columns',array(
		'default'=> 3,
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_per_columns',array(
		'label'	=> __('Product Per Row','ai-automation'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

	$wp_customize->add_setting('ai_automation_product_per_page',array(
		'default'=> 9,
		'sanitize_callback'	=> 'ai_automation_sanitize_number_absint'
	));
	$wp_customize->add_control('ai_automation_product_per_page',array(
		'label'	=> __('Product Per Page','ai-automation'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'ai_automation_product_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_product_sidebar', array(
		'label'       => esc_html__( 'Show / Hide Shop Page Sidebar', 'ai-automation' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_product_sidebar',
	) ) );
	$wp_customize->add_setting('ai_automation_sale_tag_position',array(
        'default' => 'right',
        'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
	$wp_customize->add_control('ai_automation_sale_tag_position',array(
        'type' => 'radio',
        'label'     => __('Sale Badge Position', 'ai-automation'),
        'description'   => __('This option work for Archieve Products', 'ai-automation'),
        'section' => 'woocommerce_product_catalog',
        'choices' => array(
            'left' => __('Left','ai-automation'),
            'right' => __('Right','ai-automation'),
        ),
	) );
	$wp_customize->add_setting( 'ai_automation_single_product_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_single_product_sidebar', array(
		'label'       => esc_html__( 'Show / Hide Product Page Sidebar', 'ai-automation' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_single_product_sidebar',
	) ) );

	$wp_customize->add_setting( 'ai_automation_related_product', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Ai_Automation_Toggle_Control( $wp_customize, 'ai_automation_related_product', array(
		'label'       => esc_html__( 'Show / Hide related product', 'ai-automation' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'ai_automation_related_product',
	) ) );

	
	//Page template settings
	$wp_customize->add_panel( 'ai_automation_page_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Page Template Settings', 'ai-automation' ),
	    'description' => __( 'Description of what this panel does.', 'ai-automation' ),
	) );

	// 404 PAGE
	$wp_customize->add_section('ai_automation_404_page_section',array(
		'title'         => __('404 Page', 'ai-automation'),
		'description'   => 'Here you can customize 404 Page content.',
		'panel' => 'ai_automation_page_panel_id'
	) );

	$wp_customize->add_setting('ai_automation_edit_404_title',array(
		'default'=> __('Oops! That page cant be found.','ai-automation'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('ai_automation_edit_404_title',array(
		'label'	=> __('Edit Title','ai-automation'),
		'section'=> 'ai_automation_404_page_section',
		'type'=> 'text',
	));

	$wp_customize->add_setting('ai_automation_edit_404_text',array(
		'default'=> __('It looks like nothing was found at this location. Maybe try a search?','ai-automation'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_edit_404_text',array(
		'label'	=> __('Edit Text','ai-automation'),
		'section'=> 'ai_automation_404_page_section',
		'type'=> 'text'
	));

	// Search Results
	$wp_customize->add_section('ai_automation_no_result_section',array(
		'title'         => __('Search Results', 'ai-automation'),
		'description'   => 'Here you can customize Search Result content.',
		'panel' => 'ai_automation_page_panel_id'
	) );

	$wp_customize->add_setting('ai_automation_edit_no_result_title',array(
		'default'=> __('Nothing Found','ai-automation'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('ai_automation_edit_no_result_title',array(
		'label'	=> __('Edit Title','ai-automation'),
		'section'=> 'ai_automation_no_result_section',
		'type'=> 'text',
	));

	$wp_customize->add_setting('ai_automation_edit_no_result_text',array(
		'default'=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','ai-automation'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ai_automation_edit_no_result_text',array(
		'label'	=> __('Edit Text','ai-automation'),
		'section'=> 'ai_automation_no_result_section',
		'type'=> 'text'
	));

	 // Header Image Height
    $wp_customize->add_setting(
        'ai_automation_header_image_height',
        array(
            'default'           => 400,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'ai_automation_header_image_height',
        array(
            'label'       => esc_html__( 'Header Image Height', 'ai-automation' ),
            'section'     => 'header_image',
            'type'        => 'number',
            'description' => esc_html__( 'Control the height of the header image. Default is 350px.', 'ai-automation' ),
            'input_attrs' => array(
                'min'  => 220,
                'max'  => 1000,
                'step' => 1,
            ),
        )
    );

    // Header Background Position
    $wp_customize->add_setting(
        'ai_automation_header_background_position',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'ai_automation_header_background_position',
        array(
            'label'       => esc_html__( 'Header Background Position', 'ai-automation' ),
            'section'     => 'header_image',
            'type'        => 'select',
            'choices'     => array(
                'top'    => esc_html__( 'Top', 'ai-automation' ),
                'center' => esc_html__( 'Center', 'ai-automation' ),
                'bottom' => esc_html__( 'Bottom', 'ai-automation' ),
            ),
            'description' => esc_html__( 'Choose how you want to position the header image.', 'ai-automation' ),
        )
    );

    // Header Image Parallax Effect
    $wp_customize->add_setting(
        'ai_automation_header_background_attachment',
        array(
            'default'           => 1,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'ai_automation_header_background_attachment',
        array(
            'label'       => esc_html__( 'Header Image Parallax', 'ai-automation' ),
            'section'     => 'header_image',
            'type'        => 'checkbox',
            'description' => esc_html__( 'Add a parallax effect on page scroll.', 'ai-automation' ),
        )
    );

        //Opacity
	$wp_customize->add_setting('ai_automation_header_banner_opacity_color',array(
       'default'              => '0.5',
       'sanitize_callback' => 'ai_automation_sanitize_choices'
	));
    $wp_customize->add_control( 'ai_automation_header_banner_opacity_color', array(
		'label'       => esc_html__( 'Header Image Opacity','ai-automation' ),
		'section'     => 'header_image',
		'type'        => 'select',
		'settings'    => 'ai_automation_header_banner_opacity_color',
		'choices' => array(
           '0' =>  esc_attr(__('0','ai-automation')),
           '0.1' =>  esc_attr(__('0.1','ai-automation')),
           '0.2' =>  esc_attr(__('0.2','ai-automation')),
           '0.3' =>  esc_attr(__('0.3','ai-automation')),
           '0.4' =>  esc_attr(__('0.4','ai-automation')),
           '0.5' =>  esc_attr(__('0.5','ai-automation')),
           '0.6' =>  esc_attr(__('0.6','ai-automation')),
           '0.7' =>  esc_attr(__('0.7','ai-automation')),
           '0.8' =>  esc_attr(__('0.8','ai-automation')),
           '0.9' =>  esc_attr(__('0.9','ai-automation'))
		), 
	) );

   $wp_customize->add_setting( 'ai_automation_header_banner_image_overlay', array(
	    'default'   => true,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'ai_automation_sanitize_checkbox',
	));
	$wp_customize->add_control( new ai_automation_Toggle_Control( $wp_customize, 'ai_automation_header_banner_image_overlay', array(
	    'label'   => esc_html__( 'Show / Hide Header Image Overlay', 'ai-automation' ),
	    'section' => 'header_image',
	)));

    $wp_customize->add_setting('ai_automation_header_banner_image_ooverlay_color', array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ai_automation_header_banner_image_ooverlay_color', array(
		'label'    => __('Header Image Overlay Color', 'ai-automation'),
		'section'  => 'header_image',
	)));

    $wp_customize->add_setting(
        'ai_automation_header_image_title_font_size',
        array(
            'default'           => 40,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'ai_automation_header_image_title_font_size',
        array(
            'label'       => esc_html__( 'Change Header Image Title Font Size', 'ai-automation' ),
            'section'     => 'header_image',
            'type'        => 'number',
            'description' => esc_html__( 'Control the font Size of the header image title. Default is 32px.', 'ai-automation' ),
            'input_attrs' => array(
                'min'  => 10,
                'max'  => 200,
                'step' => 1,
            ),
        )
    );

	$wp_customize->add_setting( 'ai_automation_header_image_title_text_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ai_automation_header_image_title_text_color', array(
			'label'     => __('Change Header Image Title Color', 'ai-automation'),
	    'section' => 'header_image',
	    'settings' => 'ai_automation_header_image_title_text_color',
  	)));

}
add_action( 'customize_register', 'Ai_Automation_Customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since AI Automation 1.0
 * @see Ai_Automation_Customize_register()
 *
 * @return void
 */
function Ai_Automation_Customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since AI Automation 1.0
 * @see Ai_Automation_Customize_register()
 *
 * @return void
 */
function Ai_Automation_Customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( ! defined( 'AI_AUTOMATION_PRO_THEME_NAME' ) ) {
	define( 'AI_AUTOMATION_PRO_THEME_NAME', esc_html__( 'AI Automation Pro Theme', 'ai-automation'));
}
if ( ! defined( 'AI_AUTOMATION_PRO_THEME_URL' ) ) {
	define( 'AI_AUTOMATION_PRO_THEME_URL', esc_url('https://www.themespride.com/products/artificial-intelligence-wordpress-theme', 'ai-automation'));
}

if ( ! defined( 'AI_AUTOMATION_DOCS_URL' ) ) {
	define( 'AI_AUTOMATION_DOCS_URL', esc_url('https://page.themespride.com/demo/docs/ai-automation-lite/'));
}

if ( ! defined( 'AI_AUTOMATION_DEMO_TITLE' ) ) {
	define( 'AI_AUTOMATION_DEMO_TITLE', esc_html__( 'Click to View Site', 'ai-automation' ));
}
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Ai_Automation_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Ai_Automation_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Ai_Automation_Customize_Section_Pro(
				$manager,
				'ai_automation_section_pro',
				array(
					'priority'   => 9,
					'title'    => AI_AUTOMATION_PRO_THEME_NAME,
					'pro_text' => esc_html__( 'Upgrade Pro', 'ai-automation' ),
					'pro_url'  => esc_url( AI_AUTOMATION_PRO_THEME_URL, 'ai-automation' ),
				)
			)
		);

		// Register sections.
		$manager->add_section(
			new ai_automation_Customize_Section_Pro(
				$manager,
				'ai_automation_documentation',
				array(
					'priority'   => 500,
					'title'    => esc_html__( 'Theme Documentation', 'ai-automation' ),
					'pro_text' => esc_html__( 'Click Here', 'ai-automation' ),
					'pro_url'  => esc_url( AI_AUTOMATION_DOCS_URL, 'ai-automation'),
				)
			)
		);

		// Register sections.
		$manager->add_section(
			new ai_automation_Customize_Section_Pro(
				$manager,
				'ai_automation_section_pro_demo',
				array(
					'priority'   => 9,
					'title'    => AI_AUTOMATION_DEMO_TITLE,
					'pro_text' => esc_html__( 'View Site', 'ai-automation' ),
					'pro_url'  => esc_url( home_url() ),
				)
			)
		);

	}
	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'ai-automation-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'ai-automation-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Ai_Automation_Customize::get_instance();