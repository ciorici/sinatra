<?php
/**
 * The template for displaying theme pre footer bar.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

?>

<div id="pr-pre-footer">

	<?php
	if ( prisma_core_is_pre_footer_cta_displayed() ) {
		get_template_part( 'template-parts/pre-footer/call-to-action' );
	}
	?>

</div><!-- END #pr-pre-footer -->
