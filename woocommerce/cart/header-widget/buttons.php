<?php
/**
 * Header Cart Widget cart & checkout buttons.
 *
 * @package Prisma Core
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="pr-cart-buttons">
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="pr-btn btn-text-1" role="button">
		<span><?php esc_html_e( 'View Cart', 'prisma-core' ); ?></span>
	</a>

	<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="pr-btn btn-fw" role="button">
		<span><?php esc_html_e( 'Checkout', 'prisma-core' ); ?></span>
	</a>
</div>
