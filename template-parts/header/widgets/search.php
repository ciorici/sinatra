<?php
/**
 * The template for displaying theme header search widget.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<div aria-haspopup="true">
	<a href="#" class="pr-search">
		<?php echo prisma_core()->icons->get_svg( 'search', array( 'aria-label' => esc_html__( 'Search', 'prisma-core' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a><!-- END .pr-search -->

	<div class="pr-search-simple pr-search-container dropdown-item">
		<form role="search" aria-label="<?php esc_attr_e( 'Site Search', 'prisma-core' ); ?>" method="get" class="pr-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

			<label class="pr-form-label">
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'prisma-core' ); ?></span>
				<input type="search" class="pr-input-search" placeholder="<?php esc_attr_e( 'Search', 'prisma-core' ); ?>" value="<?php echo esc_attr( get_query_var( 's' ) ); ?>" name="s" autocomplete="off">
			</label><!-- END .sinara-form-label -->

			<?php prisma_core_animated_arrow( 'right', 'submit', true ); ?>

		</form>
	</div><!-- END .pr-search-simple -->
</div>
