<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package AI Automation
 * @subpackage ai_automation
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ai_automation_categorized_blog() {
	$ai_automation_category_count = get_transient( 'ai_automation_categories' );

	if ( false === $ai_automation_category_count ) {
		// Create an array of all the categories that are attached to posts.
		$ai_automation_categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$ai_automation_category_count = count( $ai_automation_categories );

		set_transient( 'ai_automation_categories', $ai_automation_category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $ai_automation_category_count > 1;
}

if ( ! function_exists( 'ai_automation_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since AI Automation
 */
function ai_automation_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Flush out the transients used in ai_automation_categorized_blog.
 */
function ai_automation_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ai_automation_categories' );
}
add_action( 'edit_category', 'ai_automation_category_transient_flusher' );
add_action( 'save_post',     'ai_automation_category_transient_flusher' );