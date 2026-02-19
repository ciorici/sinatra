<?php
/**
 * Template part for displaying page header.
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>

<div <?php prisma_core_page_header_classes(); ?><?php prisma_core_page_header_atts(); ?>>
	<div class="pr-container">

	<?php do_action( 'prisma_core_page_header_start' ); ?>

	<?php if ( prisma_core_page_header_has_title() ) { ?>

		<div class="pr-page-header-wrapper">

			<div class="pr-page-header-title">
				<?php prisma_core_page_header_title(); ?>
			</div>

			<?php $prisma_core_description = apply_filters( 'prisma_core_page_header_description', prisma_core_get_the_description() ); ?>

			<?php if ( $prisma_core_description ) { ?>

				<div class="pr-page-header-description">
					<?php echo wp_kses( $prisma_core_description, prisma_core_get_allowed_html_tags() ); ?>
				</div>

			<?php } ?>
		</div>

	<?php } ?>

	<?php do_action( 'prisma_core_page_header_end' ); ?>

	</div>
</div>
