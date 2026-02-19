<?php
/**
 * Prisma Core Logo section in Customizer.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Prisma_Core_Customizer_Logo' ) ) :
	/**
	 * Prisma Core Logo section in Customizer.
	 */
	class Prisma_Core_Customizer_Logo {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom options in Customizer.
			 */
			add_filter( 'prisma_core_customizer_options', array( $this, 'register_options' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Logo Retina.
			$options['setting']['prisma_core_logo_default_retina'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_background',
				'control'           => array(
					'type'        => 'prisma-core-background',
					'section'     => 'title_tagline',
					'label'       => esc_html__( 'Retina Logo', 'prisma-core' ),
					'description' => esc_html__( 'Upload exactly 2x the size of your default logo to make your logo crisp on HiDPI screens. This options is not required if logo above is in SVG format.', 'prisma-core' ),
					'priority'    => 20,
					'advanced'    => false,
					'strings'     => array(
						'select_image' => __( 'Select logo', 'prisma-core' ),
						'use_image'    => __( 'Select', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '!=',
						),
					),
				),
				'partial'           => array(
					'selector'            => '.prisma-core-logo',
					'render_callback'     => 'prisma_core_logo',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Logo Max Height.
			$options['setting']['prisma_core_logo_max_height'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Logo Height', 'prisma-core' ),
					'description' => esc_html__( 'Maximum logo image height.', 'prisma-core' ),
					'section'     => 'title_tagline',
					'priority'    => 30,
					'min'         => 0,
					'max'         => 1000,
					'step'        => 10,
					'unit'        => 'px',
					'responsive'  => true,
					'required'    => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '!=',
						),
					),
				),
			);

			// Logo margin.
			$options['setting']['prisma_core_logo_margin'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-spacing',
					'label'       => esc_html__( 'Logo Margin', 'prisma-core' ),
					'description' => esc_html__( 'Specify spacing around logo. Negative values are allowed.', 'prisma-core' ),
					'section'     => 'title_tagline',
					'settings'    => 'prisma_core_logo_margin',
					'priority'    => 40,
					'choices'     => array(
						'top'    => esc_html__( 'Top', 'prisma-core' ),
						'right'  => esc_html__( 'Right', 'prisma-core' ),
						'bottom' => esc_html__( 'Bottom', 'prisma-core' ),
						'left'   => esc_html__( 'Left', 'prisma-core' ),
					),
					'responsive'  => true,
					'unit'        => array(
						'px',
					),
				),
			);

			// Show tagline.
			$options['setting']['prisma_core_display_tagline'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-toggle',
					'label'    => esc_html__( 'Display Tagline', 'prisma-core' ),
					'section'  => 'title_tagline',
					'settings' => 'prisma_core_display_tagline',
					'priority' => 80,
				),
				'partial'           => array(
					'selector'            => '.prisma-core-logo',
					'render_callback'     => 'prisma_core_logo',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Site Identity heading.
			$options['setting']['prisma_core_logo_heading_site_identity'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'label'    => esc_html__( 'Site Identity', 'prisma-core' ),
					'section'  => 'title_tagline',
					'settings' => 'prisma_core_logo_heading_site_identity',
					'priority' => 50,
					'toggle'   => false,
				),
			);

			// Logo typography heading.
			$options['setting']['prisma_core_typography_logo_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'label'    => esc_html__( 'Typography', 'prisma-core' ),
					'section'  => 'title_tagline',
					'priority' => 100,
					'required' => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '==',
						),
					),
				),
			);

			// Site title font size.
			$options['setting']['prisma_core_logo_text_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'       => 'prisma-core-range',
					'label'      => esc_html__( 'Site Title Font Size', 'prisma-core' ),
					'section'    => 'title_tagline',
					'priority'   => 100,
					'min'        => 8,
					'max'        => 30,
					'step'       => 1,
					'responsive' => true,
					'unit'       => array(
						array(
							'id'   => 'px',
							'name' => 'px',
							'min'  => 8,
							'max'  => 90,
							'step' => 1,
						),
						array(
							'id'   => 'em',
							'name' => 'em',
							'min'  => 0.5,
							'max'  => 5,
							'step' => 0.01,
						),
						array(
							'id'   => 'rem',
							'name' => 'rem',
							'min'  => 0.5,
							'max'  => 5,
							'step' => 0.01,
						),
					),
					'required'   => array(
						array(
							'control'  => 'custom_logo',
							'value'    => false,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_typography_logo_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Prisma_Core_Customizer_Logo();
