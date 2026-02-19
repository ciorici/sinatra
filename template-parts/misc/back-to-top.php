<?php
/**
 * The template for displaying scroll to top button.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<a href="#" id="pr-scroll-top" class="pr-smooth-scroll" title="<?php esc_attr_e( 'Scroll to Top', 'prisma-core' ); ?>" <?php prisma_core_scroll_top_classes(); ?>>
	<span class="pr-scroll-icon" aria-hidden="true">
		<?php echo prisma_core()->icons->get_svg( 'chevron-up', array( 'class' => 'top-icon' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo prisma_core()->icons->get_svg( 'chevron-up' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
	<span class="screen-reader-text"><?php esc_html_e( 'Scroll to Top', 'prisma-core' ); ?></span>
</a><!-- END #prisma-core-scroll-to-top -->
