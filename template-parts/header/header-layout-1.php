<?php
/**
 * The template for displaying header layout 1.
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>

<div class="pr-container pr-header-container">

	<?php
	prisma_core_header_logo_template();
	prisma_core_main_navigation_template();

	do_action( 'prisma_core_header_widget_location', array( 'left', 'right' ) );
	?>

	<span class="pr-header-element pr-mobile-nav">
		<?php prisma_core_hamburger( prisma_core_option( 'main_nav_mobile_label' ), 'prisma-core-primary-nav' ); ?>
	</span>

</div><!-- END .pr-container -->
