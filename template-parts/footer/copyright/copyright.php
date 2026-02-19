<?php
/**
 * The template for displaying theme copyright bar.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<?php do_action( 'prisma_core_before_copyright' ); ?>
<div id="prisma-core-copyright" <?php prisma_core_copyright_classes(); ?>>
	<div class="pr-container">
		<div class="pr-flex-row">

			<div class="col-xs-12 center-xs col-md flex-basis-auto start-md"><?php do_action( 'prisma_core_copyright_widgets', 'start' ); ?></div>
			<div class="col-xs-12 center-xs col-md flex-basis-auto end-md"><?php do_action( 'prisma_core_copyright_widgets', 'end' ); ?></div>

		</div><!-- END .pr-flex-row -->
	</div>
</div><!-- END #prisma-core-copyright -->
<?php do_action( 'prisma_core_after_copyright' ); ?>
