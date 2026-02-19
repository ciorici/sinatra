<?php
/**
 * Template part for displaying media of the entry.
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

$prisma_core_post_format = get_post_format();

if ( is_single() ) {
	$prisma_core_post_format = '';
}

do_action( 'prisma_core_before_entry_thumbnail' );

get_template_part( 'template-parts/entry/format/media', $prisma_core_post_format );

do_action( 'prisma_core_after_entry_thumbnail' );
