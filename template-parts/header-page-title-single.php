<?php
/**
 * Template part for displaying page header for single post.
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>

<div <?php prisma_core_page_header_classes(); ?><?php prisma_core_page_header_atts(); ?>>

	<?php do_action( 'prisma_core_page_header_start' ); ?>

	<?php if ( 'in-page-header' === prisma_core_option( 'single_title_position' ) ) { ?>

		<div class="pr-container">
			<div class="pr-page-header-wrapper">

				<?php
				if ( prisma_core_single_post_displays( 'category' ) ) {
					get_template_part( 'template-parts/entry/entry', 'category' );
				}

				if ( prisma_core_page_header_has_title() ) {
					echo '<div class="pr-page-header-title">';
					prisma_core_page_header_title();
					echo '</div>';
				}

				if ( prisma_core_has_entry_meta_elements() ) {
					get_template_part( 'template-parts/entry/entry', 'meta' );
				}
				?>

			</div>
		</div>

	<?php } ?>

	<?php do_action( 'prisma_core_page_header_end' ); ?>

</div>
