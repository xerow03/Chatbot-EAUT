<?php

require get_template_directory() . '/inc/TGM/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function ai_automation_register_recommended_plugins() {
	$plugins = array(
		array(
            'name'             => __( 'Advanced Appointment Booking & Scheduling', 'ai-automation' ),
            'slug'             => 'advanced-appointment-booking-scheduling',
            'required'         => false,
            'force_activation' => false,
        ),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'ai_automation_register_recommended_plugins' );
