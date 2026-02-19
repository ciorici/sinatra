<?php
/**
 * Template part for displaying post in post listing.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<?php do_action( 'prisma_core_before_article' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'prisma-core-article' ); ?><?php prisma_core_schema_markup( 'article' ); ?>>

	<?php
	$prisma_core_blog_entry_format = get_post_format();

	if ( 'quote' === $prisma_core_blog_entry_format ) {
		get_template_part( 'template-parts/entry/format/media', $prisma_core_blog_entry_format );
	} else {

		$prisma_core_blog_entry_elements = prisma_core_get_blog_entry_elements();

		if ( ! empty( $prisma_core_blog_entry_elements ) ) {
			foreach ( $prisma_core_blog_entry_elements as $prisma_core_element ) {
				get_template_part( 'template-parts/entry/entry', $prisma_core_element );
			}
		}
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'prisma_core_after_article' ); ?>
