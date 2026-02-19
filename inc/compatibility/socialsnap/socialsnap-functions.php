<?php
/**
 * Prisma Core Social Snap compatibility functions.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.1.0
 */

if ( ! function_exists( 'prisma_core_entry_meta_shares' ) ) :
	/**
	 * Add share count information to entry meta.
	 *
	 * @since 1.1.0
	 */
	function prisma_core_entry_meta_shares() {

		$share_count = socialsnap_get_total_share_count();

		// Icon.
		$icon = prisma_core()->icons->get_meta_icon( 'share', prisma_core()->icons->get_svg( 'share-2', array( 'aria-hidden' => 'true' ) ) );

		$output = sprintf(
			'<span class="share-count">%3$s%1$s %2$s</span>',
			socialsnap_format_number( $share_count ),
			esc_html( _n( 'Share', 'Shares', $share_count, 'prisma-core' ) ),
			$icon
		);

		echo wp_kses( apply_filters( 'prisma_core_entry_share_count', $output ), prisma_core_get_allowed_html_tags() );
	}
endif;
