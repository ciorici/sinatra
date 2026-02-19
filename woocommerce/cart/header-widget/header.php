<?php
/**
 * Header Cart Widget dropdown header.
 *
 * @package Prisma Core
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prisma_core_cart_count    = WC()->cart->get_cart_contents_count();
$prisma_core_cart_subtotal = WC()->cart->get_cart_subtotal();

?>
<div class="wc-cart-widget-header">
	<span class="pr-cart-count">
		<?php
		/* translators: %s: the number of cart items; */
		echo wp_kses_post( sprintf( _n( '%s item', '%s items', $prisma_core_cart_count, 'prisma-core' ), $prisma_core_cart_count ) );
		?>
	</span>

	<span class="pr-cart-subtotal">
		<?php
		/* translators: %s is the cart subtotal. */
		echo wp_kses_post( sprintf( __( 'Subtotal: %s', 'prisma-core' ), '<span>' . $prisma_core_cart_subtotal . '</span>' ) );
		?>
	</span>
</div>
