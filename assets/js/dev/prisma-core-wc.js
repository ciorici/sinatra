//--------------------------------------------------------------------//
// Prisma Core WooCommerce compatibility script.
//--------------------------------------------------------------------//
;(function( $ ) {
	"use strict";

	/**
	 * Cart dropdown timer.
	 * @type {Boolean}
	 */
	var cart_dropdown_timer = false;

	/**
	 * Common element caching.
	 */
	var $body    = $( 'body' );
	var $wrapper = $( '#page' );

	/**
	 * Holds most important methods that bootstrap the whole theme.
	 * 
	 * @type {Object}
	 */
	var PrismaCoreWC = {

		/**
		 * Start the engine.
		 *
		 * @since 1.0.0
		 */
		init: function() {

			// Document ready.
			$(document).ready( PrismaCoreWC.ready );

			// Ajax complete event.
			$(document).ajaxComplete( PrismaCoreWC.ajaxComplete );

			// On WooCommerce ajax added to cart event.
			$body.on( 'added_to_cart', PrismaCoreWC.addedToCart );

			// Bind UI actions.
			PrismaCoreWC.bindUIActions();
		},


		//--------------------------------------------------------------------//
		// Events
		//--------------------------------------------------------------------//

		/**
		 * Document ready.
		 *
		 * @since 1.0.0
		 */
		ready: function() {
			PrismaCoreWC.customDropdown();
			PrismaCoreWC.quantButtons();
		},

		/**
		 * On ajax request complete.
		 *
		 * @since 1.0.0
		 */
		ajaxComplete: function() {
			PrismaCoreWC.quantButtons();
		},

		/**
		 * On WooCommerce added to cart event.
		 *
		 * @since 1.0.0
		 */
		addedToCart: function() {
			PrismaCoreWC.showCartDropdown();
		},

		/**
		 * Bind UI actions.
		 *
		 * @since 1.0.0
		*/
		bindUIActions: function() {
			PrismaCoreWC.removeCartItem();			
		},


		//--------------------------------------------------------------------//
		// Functions
		//--------------------------------------------------------------------//

		/**
		 * Adds plus-munus quantity buttons to WooCommerce.
		 *
		 * @since 1.0.0
		*/
		quantButtons: function() {

			var $new_quantity,
				$quantity,
				$input,
				$this;

			// Append plus and minus buttons to cart quantity.
			var $quant_input = $( 'div.quantity:not(.appended), td.quantity:not(.appended)' ).find( '.qty' );

			if ( $quant_input.length && 'date' !== $quant_input.prop( 'type' ) && 'hidden' !== $quant_input.prop( 'type' ) ) {

				// Add plus and minus icons
				$quant_input.parent().addClass( 'appended' );
				$quant_input.after('<a href="#" class="pr-woo-minus">-</a><a href="#" class="pr-woo-plus">+</a>');

				$( '.pr-woo-plus, .pr-woo-minus' ).unbind( 'click' );
				$( '.pr-woo-plus, .pr-woo-minus' ).on( 'click', function (e) {
					e.preventDefault();

					$this         = $(this);
					$input        = $this.parent().find( 'input' );
					$quantity     = $input.val();
					$new_quantity = 0;
					
					if ( $this.hasClass( 'pr-woo-plus' ) ) {
						$new_quantity = parseInt( $quantity ) + 1;
					} else {
						if ( $quantity > 0 ) {
							$new_quantity = parseInt( $quantity ) - 1;
						}
					}
				
					$input.val( $new_quantity );

					// Trigger change.
					$quant_input.trigger( 'change' );
				});
			}
		},

		/**
		 * Shows cart dropdown widget for 5 seconds aftern an item has been added to the cart.
		 *
		 * @since 1.0.0
		*/
		showCartDropdown: function() {

			// Exit if header cart dropdown is not available.
			if ( ! $( '.pr-header-widget__cart' ).length ) {
				return;
			}

			$( '.pr-header-widget__cart' ).addClass( 'dropdown-visible' );
			
			setTimeout( function() {
				$( '#prisma-core-header-inner' ).find( '.pr-cart' ).find( '.pr-cart-count' ).addClass( 'animate-pop' );
			}, 100);

			if ( cart_dropdown_timer ) {
				clearTimeout( cart_dropdown_timer );
				cart_dropdown_timer = false;
			}

			cart_dropdown_timer = setTimeout( function() {
				$( '.pr-header-widget__cart' ).removeClass( 'dropdown-visible' ).find( '.dropdown-item' ).removeAttr( 'style' );
			}, 5000 );
		},

		/**
		 * Adds custom dropdown field for shop orderby.
		 *
		 * @since 1.0.0
		*/
		customDropdown: function() {

			if ( ! $( 'form.woocommerce-ordering' ).length ) {
				return;
			}

			var $select     = $( 'form.woocommerce-ordering .orderby' );
			var $form_wrap  = $( 'form.woocommerce-ordering' );
			var $sel_option = $( 'form.woocommerce-ordering .orderby option:selected' ).text();
			var chevron_svg = '<svg class="pr-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path d="M24.958 10.483c-0.534-0.534-1.335-0.534-1.868 0l-7.074 7.074-7.074-7.074c-0.534-0.534-1.335-0.534-1.868 0s-0.534 1.335 0 1.868l8.008 8.008c0.267 0.267 0.667 0.4 0.934 0.4s0.667-0.133 0.934-0.4l8.008-8.008c0.534-0.534 0.534-1.335 0-1.868z"></path></svg>';

			$form_wrap.append( '<span id="pr-orderby"><span>' + $sel_option + '</span>' + chevron_svg + '</span>' );
			$select.addClass( 'custom-select-loaded' );

			var $appended = $( '#pr-orderby' );
			$select.width( $appended.width() ).css( 'height', $appended.height() + 'px' );

			$select.change( function() {
				$appended.find( 'span' ).html( $( 'form.woocommerce-ordering .orderby option:selected' ).text());
				$( this ).width( $appended.width() );
			});
		},

		/**
		 * Removes an item from cart via ajax.
		 *
		 * @since 1.0.0
		*/
		removeCartItem: function() {
			var $this;

			// Exit if there is no cart item remove button.
			if ( ! $( '.pr-remove-cart-item' ).length ) {
				return;
			}

			$wrapper.on( 'click', '.pr-remove-cart-item', function(e) {
				
				e.preventDefault();
				$this = $(this);

				$this.closest( '.pr-cart-item' ).addClass( 'removing' );

				var data = {
					action: 'prisma_core_remove_wc_cart_item',
					_ajax_nonce: prisma_core_vars.nonce,
					product_key: $this.data( 'product_key' ),
				};

				$.post( prisma_core_vars.ajaxurl, data, function(response) {
					if ( response.success ) {
						$body.trigger( 'wc_fragment_refresh' );
					} else {
						$this.closest( '.pr-cart-item' ).removeClass( 'removing' );
					}
				});
			});
		},

	}; // END var PrismaCoreWC.

	PrismaCoreWC.init();
	window.prisma_core_wc = PrismaCoreWC;

})( jQuery );