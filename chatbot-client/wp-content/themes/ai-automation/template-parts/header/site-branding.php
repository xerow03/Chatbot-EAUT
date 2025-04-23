<?php
/*
* Display Logo and contact details
*/
?>
<div class="main-header">
    <div class="container headerbox py-2">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12 align-self-md-center">
            <div class="logo">
              <?php if( has_custom_logo() ) ai_automation_the_custom_logo(); ?>
              <?php if(get_theme_mod('ai_automation_site_title',true) == 1){ ?>
                <?php if (is_front_page() && is_home()) : ?>
                  <h1 class="text-capitalize">
                      <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                  </h1> 
                <?php else : ?>
                    <p class="text-capitalize site-title mb-1">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                    </p>
                <?php endif; ?>
              <?php }?>
              <?php $ai_automation_description = get_bloginfo( 'description', 'display' );
              if ( $ai_automation_description || is_customize_preview() ) : ?>
                <?php if(get_theme_mod('ai_automation_site_tagline',false)){ ?>
                  <p class="site-description mb-0"><?php echo esc_html($ai_automation_description); ?></p>
                <?php }?>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-7 col-md-4 col-5 align-self-center">
            <?php get_template_part('template-parts/navigation/site-nav'); ?>
          </div>
          <div class="col-lg-2 col-md-4 col-7 align-self-center">
            <div class="header-menu-right">
              <?php if (get_theme_mod('ai_automation_header_link') || get_theme_mod('ai_automation_header_button','Get Start')) : ?>
                <span class="header-btn text-center ps-md-3 ps-lg-4">
                  <a href="<?php echo esc_url(get_theme_mod('ai_automation_header_link')); ?>" class="book-appoin"><?php echo esc_html(get_theme_mod('ai_automation_header_button','Get Start')); ?></a>
                </span>
              <?php endif; ?>
            </div>
          </div>
        </div>
    </div>
</div>