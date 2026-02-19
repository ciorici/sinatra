//--------------------------------------------------------------------//
// Prisma Core script that handles our admin functionality.
//--------------------------------------------------------------------//

;(function($) {

	"use strict";

	/**
	 * Holds most important methods that bootstrap the whole admin area.
	 * 
	 * @type {Object}
	 */
	var PrismaCoreAdmin = {

		/**
		 * Start the engine.
		 *
		 * @since 1.0.0
		 */
		init: function() {
			
			// Document ready
			$(document).ready( PrismaCoreAdmin.ready );

			// Window load
			$(window).on( 'load', PrismaCoreAdmin.load );

			// Bind UI actions
			PrismaCoreAdmin.bindUIActions();

			// Trigger event when Prisma Core fully loaded
			$(document).trigger( 'prismaCoreReady' );
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
		},


		/**
		 * Window load.
		 *
		 * @since 1.0.0
		 */
		load: function() {

			// Trigger resize once everything loaded.
			window.dispatchEvent( new Event( 'resize' ) );
		},


		/**
		 * Window resize.
		 *
		 * @since 1.0.0
		*/
		resize: function() {
		},


		//--------------------------------------------------------------------//
		// Functions
		//--------------------------------------------------------------------//


		/**
		 * Bind UI actions.
		 *
		 * @since 1.0.0
		*/
		bindUIActions: function() {
			var $wrap = $( '#wpwrap' );
			var $body = $( 'body' );
			var $this;

			$wrap.on( 'click', '.plugins .pr-btn:not(.active)', function(e){

				e.preventDefault();

				if ( $wrap.find( '.plugins .pr-btn.in-progress' ).length ) {
					return;
				}

				$this = $(this);

				PrismaCoreAdmin.pluginAction( $this );
			});

			$( document ).on('wp-plugin-install-success', PrismaCoreAdmin.pluginInstallSuccess );
			$( document ).on('wp-plugin-install-error',   PrismaCoreAdmin.pluginInstallError);
		},

		pluginAction: function( $button ) {

			$button.addClass( 'in-progress' ).attr( 'disabled', 'disabled' ).html( prisma_core_strings.texts[ $button.data('action') + '-inprogress' ] );

			if ( 'install' === $button.data( 'action' ) ) {

				if ( wp.updates.shouldRequestFilesystemCredentials && ! wp.updates.ajaxLocked ) {
					wp.updates.requestFilesystemCredentials( event );

					$( document ).on( 'credential-modal-cancel', function() {

						$button.removeAttr('disabled').removeClass( 'in-progress' ).html( prisma_core_strings.texts.install );

						wp.a11y.speak( wp.updates.l10n.updateCancel, 'polite' );
					} );
				}

				wp.updates.installPlugin( {
					slug: $button.data('plugin')
				});

			} else {
				
				var data = {
					_ajax_nonce: prisma_core_strings.wpnonce,
					plugin: $button.data('plugin'),
					action: 'prisma-core-plugin-' + $button.data('action'),
				};

				$.post( prisma_core_strings.ajaxurl, data, function( response ){
					if ( response.success ) {
						if ( $button.data('redirect') ) {
							window.location.href = $button.data('redirect');
						} else {
							location.reload();
						}
					} else {
						$( '.plugins .pr-btn.in-progress' ).removeAttr('disabled').removeClass( 'in-progress primary' ).addClass('secondary' ).html( prisma_core_strings.texts.retry );
					}
				});
			}
		},

		pluginInstallSuccess: function( event, response ) {

			event.preventDefault();

			var $message = jQuery(event.target);
			var $init = $message.data('init');
			var activatedSlug; 

			if ( typeof $init === 'undefined' ) {
				activatedSlug = response.slug;
			} else {
				activatedSlug = $init;
			}

			var $button = $( '.plugins a[data-plugin="' + activatedSlug + '"]' );

			$button.data( 'action', 'activate' );

			PrismaCoreAdmin.pluginAction( $button );
		},

		pluginInstallError: function( event, response ) {

			event.preventDefault();

			var $message = jQuery(event.target);
			var $init = $message.data('init');
			var activatedSlug; 

			if ( typeof $init === 'undefined' ) {
				activatedSlug = response.slug;
			} else {
				activatedSlug = $init;
			}

			var $button = $( '.plugins a[data-plugin="' + activatedSlug + '"]' );

			$button.attr( 'disabled', 'disabled' ).removeClass( 'in-progress primary' ).addClass('secondary' ).html( wp.updates.l10n.installFailedShort );
		},

	}; // END var PrismaCoreAdmin

	PrismaCoreAdmin.init();
	window.prismaCoreAdmin = PrismaCoreAdmin;
	
})(jQuery);