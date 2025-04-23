<?php 
if (isset($_GET['import-demo']) && $_GET['import-demo'] == true) {

    // ------- Create Nav Menu --------
$ai_automation_menuname = 'Main Menus';
$ai_automation_bpmenulocation = 'primary-menu';
$ai_automation_menu_exists = wp_get_nav_menu_object($ai_automation_menuname);

if (!$ai_automation_menu_exists) {
    $ai_automation_menu_id = wp_create_nav_menu($ai_automation_menuname);

    // Create Home Page
    $ai_automation_home_title = 'Home';
    $ai_automation_home = array(
        'post_type' => 'page',
        'post_title' => $ai_automation_home_title,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'home'
    );
    $ai_automation_home_id = wp_insert_post($ai_automation_home);

    // Assign Home Page Template
    add_post_meta($ai_automation_home_id, '_wp_page_template', 'page-template/front-page.php');

    // Update options to set Home Page as the front page
    update_option('page_on_front', $ai_automation_home_id);
    update_option('show_on_front', 'page');

    // Add Home Page to Menu
    wp_update_nav_menu_item($ai_automation_menu_id, 0, array(
        'menu-item-title' => __('Home', 'ai-automation'),
        'menu-item-classes' => 'home',
        'menu-item-url' => home_url('/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $ai_automation_home_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create About Us Page with Dummy Content
    $ai_automation_about_title = 'About Us';
    $ai_automation_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $ai_automation_about = array(
        'post_type' => 'page',
        'post_title' => $ai_automation_about_title,
        'post_content' => $ai_automation_about_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'about-us'
    );
    $ai_automation_about_id = wp_insert_post($ai_automation_about);

    // Add About Us Page to Menu
    wp_update_nav_menu_item($ai_automation_menu_id, 0, array(
        'menu-item-title' => __('About Us', 'ai-automation'),
        'menu-item-classes' => 'about-us',
        'menu-item-url' => home_url('/about-us/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $ai_automation_about_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Services Page with Dummy Content
    $ai_automation_services_title = 'Services';
    $ai_automation_services_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $ai_automation_services = array(
        'post_type' => 'page',
        'post_title' => $ai_automation_services_title,
        'post_content' => $ai_automation_services_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'services'
    );
    $ai_automation_services_id = wp_insert_post($ai_automation_services);

    // Add Services Page to Menu
    wp_update_nav_menu_item($ai_automation_menu_id, 0, array(
        'menu-item-title' => __('Services', 'ai-automation'),
        'menu-item-classes' => 'services',
        'menu-item-url' => home_url('/services/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $ai_automation_services_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Pages Page with Dummy Content
    $ai_automation_pages_title = 'Pages';
    $ai_automation_pages_content = '<h2>Our Pages</h2>
    <p>Explore all the pages we have on our website. Find information about our services, company, and more.</p>';
    $ai_automation_pages = array(
        'post_type' => 'page',
        'post_title' => $ai_automation_pages_title,
        'post_content' => $ai_automation_pages_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'pages'
    );
    $ai_automation_pages_id = wp_insert_post($ai_automation_pages);

    // Add Pages Page to Menu
    wp_update_nav_menu_item($ai_automation_menu_id, 0, array(
        'menu-item-title' => __('Pages', 'ai-automation'),
        'menu-item-classes' => 'pages',
        'menu-item-url' => home_url('/pages/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $ai_automation_pages_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Contact Page with Dummy Content
    $ai_automation_contact_title = 'Contact';
    $ai_automation_contact_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $ai_automation_contact = array(
        'post_type' => 'page',
        'post_title' => $ai_automation_contact_title,
        'post_content' => $ai_automation_contact_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'contact'
    );
    $ai_automation_contact_id = wp_insert_post($ai_automation_contact);

    // Add Contact Page to Menu
    wp_update_nav_menu_item($ai_automation_menu_id, 0, array(
        'menu-item-title' => __('Contact', 'ai-automation'),
        'menu-item-classes' => 'contact',
        'menu-item-url' => home_url('/contact/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $ai_automation_contact_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Set the menu location if it's not already set
    if (!has_nav_menu($ai_automation_bpmenulocation)) {
        $locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
        if (empty($locations)) {
            $locations = array();
        }
        $locations[$ai_automation_bpmenulocation] = $ai_automation_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

        //---Header--//
        set_theme_mod('ai_automation_header_button', 'Get Start');
        set_theme_mod('ai_automation_header_link', '#');

         // Slider Section
        set_theme_mod('ai_automation_slider_arrows', true);
        set_theme_mod('ai_automation_slider_short_heading', 'Welcome To AI');
        set_theme_mod('ai_automation_slider_side_text', 'AI');

        for ($i = 1; $i <= 4; $i++) {
            $ai_automation_title = 'World Leading Artificial intelligence';
            $ai_automation_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text';

            // Create post object
            $my_post = array(
                'post_title'    => wp_strip_all_tags($ai_automation_title),
                'post_content'  => $ai_automation_content,
                'post_status'   => 'publish',
                'post_type'     => 'page',
            );

            /// Insert the post into the database
            $post_id = wp_insert_post($my_post);

            if ($post_id) {
                // Set the theme mod for the slider page
                set_theme_mod('ai_automation_slider_page' . $i, $post_id);

                $image_url = get_template_directory_uri() . '/assets/images/slider-img.png';
                $image_id = media_sideload_image($image_url, $post_id, null, 'id');

                if (!is_wp_error($image_id)) {
                    // Set the downloaded image as the post's featured image
                    set_post_thumbnail($post_id, $image_id);
                }
            }
        }

        // About Section
        set_theme_mod('ai_automation_about_enable', true);
        set_theme_mod('ai_automation_service_sub_heading', 'About Us');
        set_theme_mod('ai_automation_satisfied_client', '3.5');

        set_theme_mod('ai_automation_tab_heading1', 'Our Mission');
        set_theme_mod('ai_automation_tab_heading2', 'Our Vission');
        set_theme_mod('ai_automation_tab_para1', 'AI is used responsibly and equita The future of AI holds');
        set_theme_mod('ai_automation_tab_para2', 'AI is used responsibly and equita The future of AI holds');

        // Create About page and set the featured image
        $ai_automation_abt_title = 'The Worlds Top AI and Machine Learning Innovators';
        $ai_automation_abt_content = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto';

        $my_post = array(
            'post_title'    => wp_strip_all_tags($ai_automation_abt_title),
            'post_content'  => $ai_automation_abt_content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );

        // Insert the post into the database
        $post_id = wp_insert_post($my_post);

        if ($post_id) {
            // Set the theme mod for the About page
            set_theme_mod('ai_automation_about_page', $post_id);

            // Sideload image and set as the featured image
            $image_url = get_template_directory_uri() . '/assets/images/about-img.png';
            $image_id = media_sideload_image($image_url, $post_id, null, 'id');

            if (!is_wp_error($image_id)) {
                set_post_thumbnail($post_id, $image_id);
            }
        }


    }
?>