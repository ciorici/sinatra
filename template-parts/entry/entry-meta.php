<?php
/**
 * Template part for displaying entry meta info.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Only show meta tags for posts.
 */
if ( ! in_array( get_post_type(), (array) apply_filters( 'prisma_core_entry_meta_post_type', array( 'post' ) ), true ) ) {
	return;
}

do_action( 'prisma_core_before_entry_meta' );

// Get meta items to be displayed.
$prisma_core_meta_elements = prisma_core_get_entry_meta_elements();

if ( ! empty( $prisma_core_meta_elements ) ) {

	echo '<div class="entry-meta"><div class="entry-meta-elements">';

	do_action( 'prisma_core_before_entry_meta_elements' );

	// Loop through meta items.
	foreach ( $prisma_core_meta_elements as $prisma_core_meta_item ) {

		// Call a template tag function.
		if ( function_exists( 'prisma_core_entry_meta_' . $prisma_core_meta_item ) ) {
			call_user_func( 'prisma_core_entry_meta_' . $prisma_core_meta_item );
		}
	}

	// Add edit post link.
	$prisma_core_edit_icon = prisma_core()->icons->get_meta_icon( 'edit', prisma_core()->icons->get_svg( 'edit-3', array( 'aria-hidden' => 'true' ) ) );

	prisma_core_edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				$prisma_core_edit_icon . __( 'Edit <span class="screen-reader-text">%s</span>', 'prisma-core' ),
				prisma_core_get_allowed_html_tags()
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

	do_action( 'prisma_core_after_entry_meta_elements' );

	echo '</div></div>';
}

do_action( 'prisma_core_after_entry_meta' );
