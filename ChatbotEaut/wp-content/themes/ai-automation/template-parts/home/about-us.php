<?php
/**
 * Template part for displaying the about section
 *
 * @package AI Automation
 * @subpackage ai_automation
 */

$ai_automation_static_image = get_template_directory_uri() . '/assets/images/about-img.jpg';

// Check if the about section is enabled
if ( get_theme_mod( 'ai_automation_about_enable', true)) : ?>
    <section id="about" class="my-5 px-md-0 px-3">
        <div class="container">
            <?php
            // Fetch about page ID from customizer
            $ai_automation_about_page_id = absint( get_theme_mod( 'ai_automation_about_page' ) );
            // Check if a valid page is set for the about section
            if ( $ai_automation_about_page_id ) :
                $ai_automation_args = array(
                    'post_type' => 'page',
                    'p'         => $ai_automation_about_page_id,
                );
                $ai_automation_query = new WP_Query( $ai_automation_args );
                // Check if the query has posts
                if ( $ai_automation_query->have_posts() ) :
                    while ( $ai_automation_query->have_posts() ) : $ai_automation_query->the_post(); ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 align-self-center image-abt mb-3 position-relative">
                                <div class="about-block position-relative">
                                    <div class="about-image1">
                                        <div class="thumbnail position-relative">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'full', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
                                            <?php else : ?>
                                                <img src="<?php echo esc_url( $ai_automation_static_image ); ?>" alt="<?php esc_attr_e( 'Placeholder', 'ai-automation' ); ?>" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="abt-bg-img mb-3">
                                    <?php 
                                    $ai_automation_satisfied_client = get_theme_mod( 'ai_automation_satisfied_client', '' );
                                    if ( $ai_automation_satisfied_client ) : ?>
                                        <div class="satified-box mb-md-0 mb-2">
                                        <div class="start-yr-content">
                                            <div class="start-yr mb-2"><?php echo esc_html( $ai_automation_satisfied_client ); ?></div>
                                            <div class="year-text"><?php esc_html_e( 'Year Of Experience', 'ai-automation' ); ?></div>
                                        </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 align-self-center ps-lg-5">
                                <div class="match-heading">
                                    <?php 
                                    $ai_automation_sub_heading = get_theme_mod( 'ai_automation_service_sub_heading' );
                                    if ( $ai_automation_sub_heading ) : ?>
                                        <p class="mb-md-3 mb-2 abt-title"><?php echo esc_html( $ai_automation_sub_heading ); ?></p>
                                    <?php endif; ?>
                                    
                                    <h2 class="mb-3 text-capitalize">
                                        <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                    </h2>
                                </div>
                                <p class="mb-4 abt-content"><?php echo esc_html( wp_trim_words( get_the_content(), 38, '...' ) ); ?></p>
                                <div class="row">
                                    <?php for ($ai_automation_i = 1; $ai_automation_i <= 2; $ai_automation_i++) : ?>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="tab-item mb-3">
                                                <div class="tab-title">
                                                    <h3 class="mb-2"><?php echo esc_html(get_theme_mod('ai_automation_tab_heading' . $ai_automation_i)); ?></h3>
                                                </div>
                                                <div class="tab-description">
                                                    <p class="mb-0"><?php echo esc_html(get_theme_mod('ai_automation_tab_para' . $ai_automation_i)); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
            endif; ?>
        </div>
    </section>
<?php endif; ?>