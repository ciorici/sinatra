<?php
/**
 * Template part for displaying post format image entry.
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

$prisma_core_media = prisma_core_get_post_media( 'image' );

if ( ! $prisma_core_media || post_password_required() ) {
	return;
}

?>

<div class="post-thumb entry-media thumbnail">

	<?php
	if ( ! is_single( get_the_ID() ) ) {
		$prisma_core_media = sprintf(
			'<a href="%1$s" class="entry-image-link">%2$s</a>',
			esc_url( prisma_core_entry_get_permalink() ),
			$prisma_core_media
		);
	}

	echo $prisma_core_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
</div>
