<?php
/**
 * The base template for displaying theme header area.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>
<?php do_action( 'prisma_core_before_header' ); ?>
<div id="prisma-core-header" <?php prisma_core_header_classes(); ?>>
	<?php do_action( 'prisma_core_header_content' ); ?>
</div><!-- END #prisma-core-header -->
<?php do_action( 'prisma_core_after_header' ); ?>
