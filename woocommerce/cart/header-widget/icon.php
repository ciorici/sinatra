<?php
/**
 * Header Cart Widget icon.
 *
 * @package Prisma Core
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prisma_core_cart_count = WC()->cart->get_cart_contents_count();
$prisma_core_cart_icon  = apply_filters( 'prisma_core_wc_cart_widget_icon', 'shopping-cart' );

?>
<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="pr-cart">
	<?php echo prisma_core()->icons->get_svg( $prisma_core_cart_icon ); ?>
	<?php if ( $prisma_core_cart_count > 0 ) { ?>
		<span class="pr-cart-count"><?php echo esc_html( $prisma_core_cart_count ); ?></span>
	<?php } ?>
</a>
