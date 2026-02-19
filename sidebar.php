<?php
/**
 * The template for displaying theme sidebar.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

if ( ! prisma_core_is_sidebar_displayed() ) {
	return;
}

$prisma_core_sidebar = prisma_core_get_sidebar();
?>

<aside id="secondary" class="widget-area pr-sidebar-container"<?php prisma_core_schema_markup( 'sidebar' ); ?> role="complementary">

	<div class="pr-sidebar-inner">
		<?php do_action( 'prisma_core_before_sidebar' ); ?>

		<?php
		if ( is_active_sidebar( $prisma_core_sidebar ) ) {

			dynamic_sidebar( $prisma_core_sidebar );

		} elseif ( current_user_can( 'edit_theme_options' ) ) {

			$prisma_core_sidebar_name = prisma_core_get_sidebar_name_by_id( $prisma_core_sidebar );
			?>
			<div class="pr-sidebar-widget pr-widget prisma-core-no-widget">

				<div class='h4 widget-title'><?php echo esc_html( $prisma_core_sidebar_name ); ?></div>

				<p class='no-widget-text'>
					<?php if ( is_customize_preview() ) { ?>
						<a href='#' class="prisma-core-set-widget" data-sidebar-id="<?php echo esc_attr( $prisma_core_sidebar ); ?>">
					<?php } else { ?>
						<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
					<?php } ?>
						<?php esc_html_e( 'Click here to assign a widget.', 'prisma-core' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
		?>

		<?php do_action( 'prisma_core_after_sidebar' ); ?>
	</div>

</aside><!--#secondary .widget-area -->

<?php
