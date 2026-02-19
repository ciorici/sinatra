<?php
/**
 * The template for displaying header layout 3.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<div class="pr-header-container">
	<div class="pr-logo-container">
		<div class="pr-container">

			<?php
			do_action( 'prisma_core_header_widget_location', 'left' );
			prisma_core_header_logo_template();
			do_action( 'prisma_core_header_widget_location', 'right' );
			?>

			<span class="pr-header-element pr-mobile-nav">
				<?php prisma_core_hamburger( prisma_core_option( 'main_nav_mobile_label' ), 'prisma-core-primary-nav' ); ?>
			</span>

		</div><!-- END .pr-container -->
	</div><!-- END .pr-logo-container -->

	<div class="pr-nav-container">
		<div class="pr-container">

			<?php prisma_core_main_navigation_template(); ?>

		</div><!-- END .pr-container -->
	</div><!-- END .pr-nav-container -->
</div><!-- END .pr-header-container -->
