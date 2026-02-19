<?php
/**
 * Template part for displaying entry tags.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

$prisma_core_entry_elements    = prisma_core_option( 'single_post_elements' );
$prisma_core_entry_footer_tags = isset( $prisma_core_entry_elements['tags'] ) && $prisma_core_entry_elements['tags'] && has_tag();
$prisma_core_entry_footer_date = isset( $prisma_core_entry_elements['last-updated'] ) && $prisma_core_entry_elements['last-updated'] && get_the_time( 'U' ) !== get_the_modified_time( 'U' );

$prisma_core_entry_footer_tags = apply_filters( 'prisma_core_display_entry_footer_tags', $prisma_core_entry_footer_tags );
$prisma_core_entry_footer_date = apply_filters( 'prisma_core_display_entry_footer_date', $prisma_core_entry_footer_date );

// Nothing is enabled, don't display the div.
if ( ! $prisma_core_entry_footer_tags && ! $prisma_core_entry_footer_date ) {
	return;
}
?>

<?php do_action( 'prisma_core_before_entry_footer' ); ?>

<div class="entry-footer">

	<?php
	// Post Tags.
	if ( $prisma_core_entry_footer_tags ) {
		prisma_core_entry_meta_tag(
			'<div class="post-tags"><span class="cat-links">',
			'',
			'</span></div>',
			0,
			false
		);
	}

	// Last Updated Date.
	if ( $prisma_core_entry_footer_date ) {

		$prisma_core_before = '<span class="last-updated pr-iflex-center">';

		if ( true === prisma_core_option( 'single_entry_meta_icons' ) ) {
			$prisma_core_before .= prisma_core()->icons->get_svg( 'edit-3' );
		}

		prisma_core_entry_meta_date(
			array(
				'show_published' => false,
				'show_modified'  => true,
				'before'         => $prisma_core_before,
				'after'          => '</span>',
			)
		);
	}
	?>

</div>

<?php do_action( 'prisma_core_after_entry_footer' ); ?>
