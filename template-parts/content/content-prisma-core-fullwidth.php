<?php
/**
 * Template part for displaying content of Prisma Core Canvas [Fullwidth] page template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php prisma_core_schema_markup( 'article' ); ?>>
	<div class="entry-content pr-entry pr-fullwidth-entry">
		<?php
		do_action( 'prisma_core_before_page_content' );

		the_content();

		do_action( 'prisma_core_after_page_content' );
		?>
	</div><!-- END .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
