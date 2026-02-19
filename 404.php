<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<?php get_header(); ?>

<div class="pr-container">

	<div id="primary" class="content-area">

		<?php do_action( 'prisma_core_before_content' ); ?>

		<main id="content" class="site-content" role="main"<?php prisma_core_schema_markup( 'main' ); ?>>

			<?php do_action( 'prisma_core_content_404' ); ?>

		</main><!-- #content .site-content -->

		<?php do_action( 'prisma_core_after_content' ); ?>

	</div><!-- #primary .content-area -->

</div><!-- END .pr-container -->

<?php
get_footer();
