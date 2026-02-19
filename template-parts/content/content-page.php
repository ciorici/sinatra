<?php
/**
 * Template part for displaying page layout in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php prisma_core_schema_markup( 'article' ); ?>>

<?php
if ( prisma_core_show_post_thumbnail() ) {
	get_template_part( 'template-parts/entry/format/media', 'page' );
}
?>

<div class="entry-content pr-entry">
	<?php
	do_action( 'prisma_core_before_page_content' );

	the_content();

	do_action( 'prisma_core_after_page_content' );
	?>
</div><!-- END .entry-content -->

<?php prisma_core_link_pages(); ?>

</article><!-- #post-<?php the_ID(); ?> -->
