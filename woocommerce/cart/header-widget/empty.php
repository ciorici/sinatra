<?php
/**
 * Header Cart Widget empty cart.
 *
 * @package Prisma Core
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p class="pr-empty-cart"><?php esc_html_e( 'No products in the cart.', 'prisma-core' ); ?></p>
