<?php
/**
 * Prisma Core Customizer widgets class.
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Prisma_Core_Customizer_Widget_Cart' ) ) :

	/**
	 * Prisma Core Customizer widget class
	 */
	class Prisma_Core_Customizer_Widget_Cart extends Prisma_Core_Customizer_Widget {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 * @param array $args An array of the values for this widget.
		 */
		public function __construct( $args = array() ) {

			parent::__construct( $args );

			$this->name        = esc_html__( 'Cart', 'prisma-core' );
			$this->description = esc_html__( 'Displays WooCommerce cart.', 'prisma-core' );
			$this->icon        = 'dashicons dashicons-cart';
			$this->type        = 'cart';
		}

		/**
		 * Displays the form for this widget on the Widgets page of the WP Admin area.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function form() {}
	}
endif;
