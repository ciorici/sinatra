<?php
/**
 * The template for displaying call to action in pre footer.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

$prisma_core_cta_text = apply_filters( 'prisma_core_pre_footer_cta_text', prisma_core_option( 'pre_footer_cta_text' ) );

$prisma_core_cta_button_args = array(
	'text'    => prisma_core_option( 'pre_footer_cta_btn_text' ),
	'url'     => prisma_core_option( 'pre_footer_cta_btn_url' ),
	'new_tab' => prisma_core_option( 'pre_footer_cta_btn_new_tab' ),
	'class'   => 'pr-btn btn-large',
);
$prisma_core_cta_button_args = apply_filters( 'prisma_core_pre_footer_cta_button', $prisma_core_cta_button_args );

$prisma_core_cta_button = '';

if ( $prisma_core_cta_button_args['text'] || is_customize_preview() ) {
	$prisma_core_cta_button = sprintf(
		'<a href="%1$s" class="%2$s" role="button" %3$s>%4$s</a>',
		esc_url( $prisma_core_cta_button_args['url'] ),
		esc_attr( $prisma_core_cta_button_args['class'] ),
		$prisma_core_cta_button_args['new_tab'] ? 'target="_blank" rel="noopener noreferrer"' : 'target="_self"',
		esc_html( $prisma_core_cta_button_args['text'] )
	);
}

// Classes.
$prisma_core_cta_classes    = array( 'pr-container', 'pr-pre-footer-cta' );
$prisma_core_cta_visibility = prisma_core_option( 'pre_footer_cta_visibility' );

if ( 'all' !== $prisma_core_cta_visibility ) {
	$prisma_core_cta_classes[] = 'prisma-core-' . $prisma_core_cta_visibility;
}

$prisma_core_cta_classes = apply_filters( 'prisma_core_pre_footer_cta_classes', $prisma_core_cta_classes );
$prisma_core_cta_classes = trim( implode( ' ', $prisma_core_cta_classes ) );

?>
<div class="<?php echo esc_attr( $prisma_core_cta_classes ); ?>">
	<div class="pr-flex-row middle-md">

		<div class="col-xs-12 col-md-8 center-xs start-md">
			<p class="h3"><?php echo wp_kses_post( $prisma_core_cta_text ); ?></p>
		</div>

		<div class="col-xs-12 col-md-4 center-xs end-md">
			<?php echo $prisma_core_cta_button; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

	</div>
</div>
