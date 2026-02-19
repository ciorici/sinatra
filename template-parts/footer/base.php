<?php
/**
 * The template for displaying theme footer.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<?php do_action( 'prisma_core_before_footer' ); ?>
<div id="prisma-core-footer" <?php prisma_core_footer_classes(); ?>>
	<div class="pr-container">
		<div class="pr-flex-row" id="prisma-core-footer-widgets">

			<?php prisma_core_footer_widgets(); ?>

		</div><!-- END .pr-flex-row -->
	</div><!-- END .pr-container -->
</div><!-- END #prisma-core-footer -->
<?php do_action( 'prisma_core_after_footer' ); ?>
