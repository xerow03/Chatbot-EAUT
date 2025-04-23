<?php
/**
 * Template part for displaying slider section
 *
 * @package AI Automation
 * @subpackage ai_automation
 */

$ai_automation_static_image = get_template_directory_uri() . '/assets/images/slider-img.png';

$ai_automation_slider_arrows = get_theme_mod('ai_automation_slider_arrows', true);
?>
<?php if ($ai_automation_slider_arrows) : ?>
  <section id="slider" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sliderbg.png');">
    <?php 
      // Get side text for the slider
      $ai_automation_side_text = get_theme_mod( 'ai_automation_slider_side_text', 'AI' ); 
      if ( ! empty( $ai_automation_side_text ) ) : ?>
        <p class="welcome-text m-0"><?php echo esc_html( $ai_automation_side_text ); ?></p>
    <?php endif; ?>
    <div class="container">
      <div class="owl-carousel owl-theme">
        <?php 
        $ai_automation_slide_pages = array();
        for ($ai_automation_count = 1; $ai_automation_count <= 3; $ai_automation_count++) {
          $mod = absint(get_theme_mod('ai_automation_slider_page' . $ai_automation_count));
          if ($mod != 0) {
            $ai_automation_slide_pages[] = $mod;
          }
        }

        if (!empty($ai_automation_slide_pages)) :
          $ai_automation_args = array(
            'post_type' => 'page',
            'post__in' => $ai_automation_slide_pages,
            'orderby' => 'post__in'
          );
          $ai_automation_query = new WP_Query($ai_automation_args);
          if ($ai_automation_query->have_posts()) :
            while ($ai_automation_query->have_posts()) : $ai_automation_query->the_post(); ?>
              <div class="item">
                <div class="row m-0">
                  <div class="col-lg-6 col-md-6 col-12 slider-content-col align-self-center">
                    <div class="carousel-caption">
                      <div class="inner_carousel">
                        <?php if (get_theme_mod('ai_automation_slider_short_heading')) : ?>
                          <p class="slidetop-text mb-2"><?php echo esc_html(get_theme_mod('ai_automation_slider_short_heading')); ?></p>
                        <?php endif; ?>
                        <h1 class="mb-md-3 mb-0">
                          <a href="<?php the_permalink(); ?>" class="text-capitalize"><?php the_title();?></a>
                        </h1>
                        <p class="mb-0 slide-content"><?php echo wp_kses_post(wp_trim_words(get_the_content(), 25)); ?></p>
                        <div class="site-search mt-4">
                          <form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="search" id="search-field" class="search-field" 
                                placeholder="<?php echo esc_attr__('What can I help with?', 'ai-automation'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
                            <button type="submit" class="search-submit">
                                <span class="screen-reader-text"><?php esc_html_e('Search', 'ai-automation'); ?></span>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12 slider-img-col align-self-center">
                    <?php if (has_post_thumbnail()) : ?>
                      <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>" />
                    <?php else : ?>
                      <img src="<?php echo esc_url($ai_automation_static_image); ?>" alt="<?php esc_attr_e('Slider Image', 'ai-automation'); ?>" />
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          else : ?>
            <div class="no-postfound"><?php esc_html_e('No posts found', 'ai-automation'); ?></div>
          <?php endif;
        endif; ?>
      </div>

      <!-- custom pagination -->
        <div class="custom-pagination">
            <span class="pagination-item active" data-slide="<?php echo esc_attr( 0 ); ?>">
                <?php echo esc_html__( '01', 'ai-automation' ); ?>
            </span>
            <span class="pagination-item" data-slide="<?php echo esc_attr( 1 ); ?>">
                <?php echo esc_html__( '02', 'ai-automation' ); ?>
            </span>
            <span class="pagination-item" data-slide="<?php echo esc_attr( 2 ); ?>">
                <?php echo esc_html__( '03', 'ai-automation' ); ?>
            </span>
        </div>
    </div>

    <div class="clearfix"></div>
  </section>
<?php endif; ?>