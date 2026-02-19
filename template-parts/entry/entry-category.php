<?php
/**
 * Template part for displaying entry category.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<div class="post-category">

	<?php
	do_action( 'prisma_core_before_post_category' );

	if ( is_singular() ) {
		prisma_core_entry_meta_category( ' ', false );
	} else {
		if ( 'blog-horizontal' === prisma_core_get_article_feed_layout() ) {
			prisma_core_entry_meta_category( ' ', false );
		} else {
			prisma_core_entry_meta_category( ', ', false );
		}
	}

	do_action( 'prisma_core_after_post_category' );
	?>

</div>
