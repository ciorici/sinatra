<?php
/**
 * Deprecated functions.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.2.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'prisma_core_get_meta_icon' ) ) {
	/**
	 * Get icon for post entry meta.
	 *
	 * @deprecated 1.2.0
	 * @param  string      $slug Icon slug.
	 * @param  string      $icon Icon markup.
	 * @param  int|WP_Post $post_id Post object or ID.
	 */
	function prisma_core_get_meta_icon( $slug = '', $icon = '', $post_id = '' ) {

		if ( prisma_core_display_notices() ) {
			trigger_error( 'Method prisma_core_get_meta_icon is deprecated since Prisma Core version 1.17. Use prisma_core()->icons->get_meta_icon( $slug, $icon, $post_id ) instead.', E_USER_DEPRECATED ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		}

		return prisma_core()->icons->get_meta_icon( $slug, $icon, $post_id );
	}
}

if ( ! function_exists( 'prisma_core_get_svg' ) ) {
	/**
	 * Return SVG markup.
	 *
	 * @deprecated 1.2.0
	 * @param  array $args Icon SVG args.
	 */
	function prisma_core_get_svg( $args = array() ) {

		if ( prisma_core_display_notices() ) {
			trigger_error( 'Method prisma_core_get_svg is deprecated since Prisma Core version 1.17. Use prisma_core()->icons->get_svg( $icon, $args ) instead.', E_USER_DEPRECATED ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		}

		$icon = isset( $args['icon'] ) ? $args['icon'] : '';

		return prisma_core()->icons->get_svg( $icon, $args );
	}
}
