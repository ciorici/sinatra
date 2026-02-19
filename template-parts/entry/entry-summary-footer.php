<?php
/**
 * Template part for displaying entry footer.
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

?>

<?php do_action( 'prisma_core_before_entry_footer' ); ?>
<footer class="entry-footer">
	<?php

	// Allow text to be filtered.
	$prisma_core_read_more_text = apply_filters( 'prisma_core_entry_read_more_text', __( 'Read More', 'prisma-core' ) );

	?>
	<a href="<?php echo esc_url( prisma_core_entry_get_permalink() ); ?>" class="pr-btn btn-text-1"><span><?php echo esc_html( $prisma_core_read_more_text ); ?></span></a>
</footer>
<?php do_action( 'prisma_core_after_entry_footer' ); ?>
