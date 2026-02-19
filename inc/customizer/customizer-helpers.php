<?php
/**
 * Prisma Core Customizer helper functions.
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
 * Returns array of available widgets.
 *
 * @since 1.0.0
 * @return array, $widgets array of available widgets.
 */
function prisma_core_get_customizer_widgets() {

	$widgets = array(
		'text'    => 'Prisma_Core_Customizer_Widget_Text',
		'nav'     => 'Prisma_Core_Customizer_Widget_Nav',
		'socials' => 'Prisma_Core_Customizer_Widget_Socials',
		'search'  => 'Prisma_Core_Customizer_Widget_Search',
		'button'  => 'Prisma_Core_Customizer_Widget_Button',
	);

	return apply_filters( 'prisma_core_customizer_widgets', $widgets );
}

/**
 * Get choices for "Hide on" customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function prisma_core_get_display_choices() {

	// Default options.
	$return = array(
		'home'       => array(
			'title' => esc_html__( 'Home Page', 'prisma-core' ),
		),
		'posts_page' => array(
			'title' => esc_html__( 'Blog / Posts Page', 'prisma-core' ),
		),
		'search'     => array(
			'title' => esc_html__( 'Search', 'prisma-core' ),
		),
		'archive'    => array(
			'title' => esc_html__( 'Archive', 'prisma-core' ),
			'desc'  => esc_html__( 'Dynamic pages such as categories, tags, custom taxonomies...', 'prisma-core' ),
		),
		'post'       => array(
			'title' => esc_html__( 'Single Post', 'prisma-core' ),
		),
		'page'       => array(
			'title' => esc_html__( 'Single Page', 'prisma-core' ),
		),
	);

	// Get additionally registered post types.
	$post_types = get_post_types(
		array(
			'public'   => true,
			'_builtin' => false,
		),
		'objects'
	);

	if ( is_array( $post_types ) && ! empty( $post_types ) ) {
		foreach ( $post_types as $slug => $post_type ) {
			$return[ $slug ] = array(
				'title' => $post_type->label,
			);
		}
	}

	return apply_filters( 'prisma_core_display_choices', $return );
}

/**
 * Get device choices for "Display on" customizer options.
 *
 * @since  1.2.0
 * @return array
 */
function prisma_core_get_device_choices() {

	// Default options.
	$return = array(
		'desktop' => array(
			'title' => esc_html__( 'Hide On Desktop', 'prisma-core' ),
		),
		'tablet' => array(
			'title' => esc_html__( 'Hide On Tablet', 'prisma-core' ),
		),
		'mobile' => array(
			'title' => esc_html__( 'Hide On Mobile', 'prisma-core' ),
		),
	);

	return apply_filters( 'prisma_core_device_choices', $return );
}
