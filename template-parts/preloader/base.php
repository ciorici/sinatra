<?php
/**
 * The template for displaying page preloader.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>

<div id="pr-preloader"<?php prisma_core_preloader_classes(); ?>>
	<?php get_template_part( 'template-parts/preloader/preloader', prisma_core_option( 'preloader_style' ) ); ?>
</div><!-- END #pr-preloader -->
