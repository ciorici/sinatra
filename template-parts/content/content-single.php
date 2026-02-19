<?php
/**
 * Template for Single post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>

<?php do_action( 'prisma_core_before_article' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'prisma-core-article' ); ?><?php prisma_core_schema_markup( 'article' ); ?>>

	<?php
	if ( 'quote' === get_post_format() ) {
		get_template_part( 'template-parts/entry/format/media', 'quote' );
	}

	$prisma_core_single_post_elements = prisma_core_get_single_post_elements();

	if ( ! empty( $prisma_core_single_post_elements ) ) {
		foreach ( $prisma_core_single_post_elements as $prisma_core_element ) {

			if ( 'content' === $prisma_core_element ) {
				do_action( 'prisma_core_before_single_content' );
				get_template_part( 'template-parts/entry/entry', $prisma_core_element );
				do_action( 'prisma_core_after_single_content' );
			} else {
				get_template_part( 'template-parts/entry/entry', $prisma_core_element );
			}
		}
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'prisma_core_after_article' ); ?>
