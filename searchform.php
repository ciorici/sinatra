<?php
/**
 * The template for displaying search form.
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

// Support for custom search post type.
$prisma_core_post_type = apply_filters( 'prisma_core_search_post_type', 'all' );
$prisma_core_post_type = 'all' !== $prisma_core_post_type ? '<input type="hidden" name="post_type" value="' . esc_attr( $prisma_core_post_type ) . '" />' : '';
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input type="search" class="search-field" aria-label="<?php esc_attr_e( 'Enter search keywords', 'prisma-core' ); ?>" placeholder="<?php esc_attr_e( 'Search', 'prisma-core' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
		<?php echo $prisma_core_post_type; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<button role="button" type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'prisma-core' ); ?>">
			<?php echo prisma_core()->icons->get_svg( 'search', array( 'aria-hidden' => 'true' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</button>
	</div>
</form>
