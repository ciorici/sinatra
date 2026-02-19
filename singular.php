<?php
/**
 * The template for displaying all pages, single posts and attachments.
 *
 * This is a new template file that WordPress introduced in
 * version 4.3.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			<?php
			do_action( 'prisma_core_before_singular' );

			do_action( 'prisma_core_content_singular' );

			do_action( 'prisma_core_after_singular' );
			?>

		</main><!-- #content .site-content -->

		<?php do_action( 'prisma_core_after_content' ); ?>

	</div><!-- #primary .content-area -->

	<?php do_action( 'prisma_core_sidebar' ); ?>

</div><!-- END .pr-container -->

<?php
get_footer();
