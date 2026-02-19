<?php
/**
 * Template part for displaying video format entry.
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

if ( has_post_thumbnail() ) :

	get_template_part( 'template-parts/entry/format/media' );

else :

	$prisma_core_media = prisma_core_get_post_media( 'video' );

	if ( $prisma_core_media ) : ?>

		<div class="post-thumb entry-media thumbnail">
			<div class="pr-video-container">
				<?php echo $prisma_core_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>

		<?php
	endif;

endif;
