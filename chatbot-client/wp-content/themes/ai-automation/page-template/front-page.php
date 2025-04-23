<?php
/**
 * Template Name: Custom Home Page
 *
 * @package AI Automation
 * @subpackage ai_automation
 */

get_header(); ?>

<main id="tp_content" role="main">
	<?php do_action( 'ai_automation_before_slider' ); ?>

	<?php get_template_part( 'template-parts/home/slider' ); ?>
	<?php do_action( 'ai_automation_after_slider' ); ?>

	<?php get_template_part( 'template-parts/home/about-us' ); ?>
	<?php do_action( 'ai_automation_after_about-us' ); ?>

	<?php get_template_part( 'template-parts/home/home-content' ); ?>
	<?php do_action( 'ai_automation_after_home_content' ); ?>
</main>

<?php get_footer();