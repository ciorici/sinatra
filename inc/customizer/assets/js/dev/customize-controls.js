;( function( api, $ ) {

	// Extends our custom "prisma-core-info" section. Make it visible.
	api.sectionConstructor[ 'prisma-core-info' ] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	// Custom Customizer Previewer class.
	api.prismaCoreCustomizerPreviewer = {
		init: function () {
			var self = this,
				control;

			// Listen to the "set-footer-widget" event.
			this.preview.bind( 'set-footer-widget', function( data ) {

				// Focus control.
		 		control = api.control( 'sidebars_widgets[' + data + ']' );
		 		control.focus();

		 		// Open widgets panel.
		 		api.Widgets.availableWidgetsPanel.open( control );
			} );

			// Listen to the "set-footer-widget" event.
			this.preview.bind( 'set-navigation-widget', function( data ) {

				// Focus control.
		 		control = api.control( 'nav_menu_locations[' + data + ']' );
		 		control.focus();
			} );
		}
	};

	// Store old previewer.
	var prismaCoreOldPreviewer = api.Previewer;
	api.Previewer = prismaCoreOldPreviewer.extend( {
		initialize: function( params, options ) {
			// Store a reference to the Previewer
			api.prismaCoreCustomizerPreviewer.preview = this;

			// Call the old Previewer's initialize function
			prismaCoreOldPreviewer.prototype.initialize.call( this, params, options );
		}
	} );

	// Change preview url for certain sections.
	_.each( prisma_core_customizer_localized.preview_url_for_section, function( url, id ) {
		if ( url ) {
			wp.customize.section( id, function ( section ) {
				section.expanded.bind( function ( isExpanded ) {
					if ( isExpanded ) {
						wp.customize.previewer.previewUrl.set( url );
					}
				});
			});
		}
	} );

	$( document ).ready( function($) {

		// Initialize our Previewer
		api.prismaCoreCustomizerPreviewer.init();

		// Display the first responsive control
		$( '.prisma-core-control-responsive' ).each( function(){
			$( this ).find('.control-responsive').first().addClass( 'active' );
		} );

		// Responsive switchers
		$( '.customize-control' ).on( 'click', '.prisma-core-responsive-switchers span', function( event ) {

			var $this               = $(this),
				$switcher_container = $this.closest( '.prisma-core-responsive-switchers' ),
				$switcher_buttons   = $switcher_container.find( 'li span' ),
				$device 	        = $( event.currentTarget ).data( 'device' ),
				$control         	= $( '.prisma-core-control-responsive' ),
				$body 		        = $( '.wp-full-overlay' ),
				$footer_devices     = $( '.wp-full-overlay-footer .devices' );

			if ( ! $switcher_container.hasClass( 'expanded' ) ) {
				$switcher_container.addClass( 'expanded' );
				$this.addClass( 'active' );
			} else {
				if ( $this.parent().is( ':first-child' ) ) {
					if ( $this.hasClass( 'active' ) ) {
						$switcher_container.removeClass( 'expanded' );
						$this.removeClass( 'active' );
					} else {
						$switcher_buttons.removeClass( 'active' );
						$this.addClass( 'active' );
					}
				} else {
					$switcher_buttons.removeClass( 'active' );
					$this.addClass( 'active' );
				}
			}

			// Control class
			$control.find( '.control-responsive' ).removeClass( 'active' );
			$control.find( '.control-responsive.' + $device ).addClass( 'active' );
			$control.removeClass( 'control-device-desktop control-device-tablet control-device-mobile' ).addClass( 'control-device-' + $device );

			// Wrapper class
			$body.removeClass( 'preview-desktop preview-tablet preview-mobile' ).addClass( 'preview-' + $device );

			// Panel footer buttons
			$footer_devices.find( 'button' ).removeClass( 'active' ).attr( 'aria-pressed', false );
			$footer_devices.find( 'button.preview-' + $device ).addClass( 'active' ).attr( 'aria-pressed', true );
		});

		// If panel footer buttons clicked
		$( '.wp-full-overlay-footer .devices button' ).on( 'click', function( event ) {

			// Set up variables
			var $this 		= $( this ),
				$devices 	= $( '.customize-control .prisma-core-responsive-switchers' ),
				$device 	= $( event.currentTarget ).data( 'device' ),
				$control 	= $( '.prisma-core-control-responsive' );

			// Button class
			$devices.find( 'span' ).removeClass( 'active' );
			$devices.find( 'span.preview-' + $device ).addClass( 'active' );

			// Add expanded class
			if ( 'desktop' === $device ) {
				$devices.removeClass( 'expanded' );
			} else {
				$devices.addClass( 'expanded' );
			}

			// Control class
			$control.find( '.control-responsive' ).removeClass( 'active' );
			$control.find( '.control-responsive.' + $device ).addClass( 'active' );
			$control.removeClass( 'control-device-desktop control-device-tablet control-device-mobile' ).addClass( 'control-device-' + $device );
		});

		// Tooltip positioning
		if ( $( '.prisma-core-tooltip' ).length ) {

			var $tooltip, $icon_pos_l, $icon_pos_r, $title_width;

			$( '.prisma-core-tooltip' ).each( function() {
				$tooltip = $(this);

				if ( $tooltip.hasClass('top-right-tooltip') || $tooltip.hasClass('small-tooltip') ) {
					return;
				}

				$title_width = $tooltip.closest( '.prisma-core-control-wrapper' ).outerWidth();

				$icon_pos_l = $tooltip.closest('.prisma-core-info-icon').css('position', 'static').position().left;
				$icon_pos_r = $title_width - $icon_pos_l;

				if ( $icon_pos_l < $icon_pos_r ) {
					$tooltip[0].style.setProperty( "--tooltip-left", Math.min( 104, $icon_pos_l ) + 'px' );
					$tooltip.css( 'left', Math.max(0, $icon_pos_l - 104) );
				} else {
					$tooltip.css( 'left', Math.min( $icon_pos_l - 90, $title_width - 208 ) );

					if ( $icon_pos_l < ( $title_width - 104 ) ) {
						$tooltip[0].style.setProperty( "--tooltip-left", '90px' );
					} else {
						$tooltip[0].style.setProperty( "--tooltip-left", ( $icon_pos_l - 178 ) + 'px' );
					}
				}

			});
		}
	});

} )( wp.customize, jQuery );