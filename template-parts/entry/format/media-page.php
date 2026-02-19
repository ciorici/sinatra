<?php
/**
 * Template part for displaying page featured image.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
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

$prisma_core_media = apply_filters( 'prisma_core_post_thumbnail', $prisma_core_media, get_the_ID() );

$prisma_core_classes = array( 'post-thumb', 'entry-media', 'thumbnail' );

$prisma_core_classes = apply_filters( 'prisma_core_post_thumbnail_wrapper_classes', $prisma_core_classes, get_the_ID() );
$prisma_core_classes = trim( implode( ' ', array_unique( $prisma_core_classes ) ) );

// Print the post thumbnail.
echo wp_kses_post(
	sprintf(
		'<div class="%2$s">%1$s</div>',
		$prisma_core_media,
		esc_attr( $prisma_core_classes )
	)
);
