<?php
/**
 * Template part for displaying ”Show Comments” button.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

// Do not show if the post is password protected.
if ( post_password_required() ) {
	return;
}

$prisma_core_comment_count = get_comments_number();
$prisma_core_comment_title = esc_html__( 'Leave a Comment', 'prisma-core' );

if ( $prisma_core_comment_count > 0 ) {
	/* translators: %s is comment count */
	$prisma_core_comment_title = esc_html( sprintf( _n( 'Show %s Comment', 'Show %s Comments', $prisma_core_comment_count, 'prisma-core' ), $prisma_core_comment_count ) );
}

?>
<a href="#" id="prisma-core-comments-toggle" class="pr-btn btn-large btn-fw btn-left-icon">
	<?php echo prisma_core()->icons->get_svg( 'chat' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<span><?php echo $prisma_core_comment_title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
</a>
