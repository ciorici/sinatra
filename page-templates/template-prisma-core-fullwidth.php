<?php
/**
 * Template Name: Prisma Core Fullwidth
 *
 * 100% wide page template without vertical spacing.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content/content', 'prisma-core-fullwidth' );
	endwhile;
endif;
get_footer();
