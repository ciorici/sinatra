<?php
/**
 * Template part for displaying quote format entry.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}

$prisma_core_quote_content = apply_filters( 'prisma_core_post_format_quote_content', get_the_content() );
$prisma_core_quote_author  = apply_filters( 'prisma_core_post_format_quote_author', get_the_title() );
$prisma_core_quote_bg      = has_post_thumbnail() ? ' style="background-image: url(\'' . esc_url( get_the_post_thumbnail_url() ) . '\')"' : '';
?>

<div class="pr-blog-entry-content">
	<div class="entry-content pr-entry"<?php prisma_core_schema_markup( 'text' ); ?>>

		<?php if ( ! is_single() ) { ?>
			<a href="<?php the_permalink(); ?>" class="quote-link" aria-label="<?php esc_attr_e( 'Read more', 'prisma-core' ); ?>"></a>
		<?php } ?>

			<div class="quote-post-bg"<?php echo $prisma_core_quote_bg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>></div>

			<div class="quote-inner">

				<?php echo prisma_core()->icons->get_svg( 'quote', array( 'class' => 'icon-quote' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

				<h3><?php echo wp_kses( $prisma_core_quote_content, prisma_core_get_allowed_html_tags() ); ?></h3>
				<div class="author"><?php echo wp_kses( $prisma_core_quote_author, prisma_core_get_allowed_html_tags() ); ?></div>

			</div><!-- END .quote-inner -->

	</div>
</div><!-- END .pr-blog-entry-content -->
