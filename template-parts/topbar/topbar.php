<?php
/**
 * The template for displaying theme top bar.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>

<?php do_action( 'prisma_core_before_topbar' ); ?>
<div id="prisma-core-topbar" <?php prisma_core_top_bar_classes(); ?>>
	<div class="pr-container">
		<div class="pr-flex-row">
			<div class="col-md flex-basis-auto start-sm"><?php do_action( 'prisma_core_topbar_widgets', 'left' ); ?></div>
			<div class="col-md flex-basis-auto end-sm"><?php do_action( 'prisma_core_topbar_widgets', 'right' ); ?></div>
		</div>
	</div>
</div><!-- END #prisma-core-topbar -->
<?php do_action( 'prisma_core_after_topbar' ); ?>
