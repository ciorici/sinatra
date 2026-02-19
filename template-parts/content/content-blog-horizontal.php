<?php
/**
 * Template part for displaying blog post - horizontal.
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

		$prisma_core_classes     = array();
		$prisma_core_classes[]   = 'pr-blog-entry-wrapper';
		$prisma_core_thumb_align = prisma_core_option( 'blog_image_position' );
		$prisma_core_thumb_align = apply_filters( 'prisma_core_horizontal_blog_image_position', $prisma_core_thumb_align );
		$prisma_core_classes[]   = 'pr-thumb-' . $prisma_core_thumb_align;
		$prisma_core_classes     = implode( ' ', $prisma_core_classes );
		?>

		<div class="<?php echo esc_attr( $prisma_core_classes ); ?>">
			<?php get_template_part( 'template-parts/entry/entry-thumbnail' ); ?>

			<div class="pr-entry-content-wrapper">

				<?php
				if ( prisma_core_option( 'blog_horizontal_post_categories' ) ) {
					get_template_part( 'template-parts/entry/entry-category' );
				}

				get_template_part( 'template-parts/entry/entry-header' );
				get_template_part( 'template-parts/entry/entry-summary' );


				if ( prisma_core_option( 'blog_horizontal_read_more' ) ) {
					get_template_part( 'template-parts/entry/entry-summary-footer' );
				}

				get_template_part( 'template-parts/entry/entry-meta' );
				?>
			</div>
		</div>

	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'prisma_core_after_article' ); ?>
