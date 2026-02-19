<?php
/**
 * Template part for displaying entry thumbnail (featured image).
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

// Get default post media.
$prisma_core_media = prisma_core_get_post_media( '' );

if ( ! $prisma_core_media || post_password_required() ) {
	return;
}

$prisma_core_post_format = get_post_format();

// Wrap with link for non-singular pages.
if ( 'link' === $prisma_core_post_format || ! is_single( get_the_ID() ) ) {

	$prisma_core_icon = '';

	if ( is_sticky() ) {
		$prisma_core_icon = sprintf(
			'<span class="entry-media-icon" title="%1$s" aria-hidden="true"><span class="entry-media-icon-wrapper">%2$s%3$s</span></span>',
			esc_attr__( 'Featured', 'prisma-core' ),
			prisma_core()->icons->get_svg(
				'star',
				array(
					'class'       => 'top-icon',
					'aria-hidden' => 'true',
				)
			),
			prisma_core()->icons->get_svg( 'star', array( 'aria-hidden' => 'true' ) )
		);
	} elseif ( 'video' === $prisma_core_post_format ) {
		$prisma_core_icon = sprintf(
			'<span class="entry-media-icon" aria-hidden="true"><span class="entry-media-icon-wrapper">%1$s%2$s</span></span>',
			prisma_core()->icons->get_svg(
				'play',
				array(
					'class'       => 'top-icon',
					'aria-hidden' => 'true',
				)
			),
			prisma_core()->icons->get_svg( 'play', array( 'aria-hidden' => 'true' ) )
		);
	} elseif ( 'link' === $prisma_core_post_format ) {
		$prisma_core_icon = sprintf(
			'<span class="entry-media-icon" title="%1$s" aria-hidden="true"><span class="entry-media-icon-wrapper">%2$s%3$s</span></span>',
			esc_url( prisma_core_entry_get_permalink() ),
			prisma_core()->icons->get_svg(
				'external-link',
				array(
					'class'       => 'top-icon',
					'aria-hidden' => 'true',
				)
			),
			prisma_core()->icons->get_svg( 'external-link', array( 'aria-hidden' => 'true' ) )
		);
	}

	$prisma_core_icon = apply_filters( 'prisma_core_post_format_media_icon', $prisma_core_icon, $prisma_core_post_format );

	$prisma_core_media = sprintf(
		'<a href="%1$s" class="entry-image-link">%2$s%3$s</a>',
		esc_url( prisma_core_entry_get_permalink() ),
		$prisma_core_media,
		$prisma_core_icon
	);
}

$prisma_core_media = apply_filters( 'prisma_core_post_thumbnail', $prisma_core_media );

// Print the post thumbnail.
echo wp_kses(
	sprintf(
		'<div class="post-thumb entry-media thumbnail">%1$s</div>',
		$prisma_core_media
	),
	prisma_core_get_allowed_html_tags()
);
