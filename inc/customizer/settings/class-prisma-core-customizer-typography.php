<?php
/**
 * Prisma Core Base Typography section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Typography' ) ) :
	/**
	 * Prisma Core Typography section in Customizer.
	 */
	class Prisma_Core_Customizer_Typography {

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

			// Section.
			$options['section']['prisma_core_section_typography'] = array(
				'title'    => esc_html__( 'Base Typography', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_general',
				'priority' => 30,
			);

			// HTML base font size.
			$options['setting']['prisma_core_html_base_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Base Font Size', 'prisma-core' ),
					'description' => esc_html__( 'REM base of the root (html) element.', 'prisma-core' ),
					'section'     => 'prisma_core_section_typography',
					'min'         => 8,
					'max'         => 30,
					'step'        => 1,
					'unit'        => 'px',
					'responsive'  => true,
				),
			);

			// Anti-Aliased Font Smoothing.
			$options['setting']['prisma_core_font_smoothing'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Font Smoothing', 'prisma-core' ),
					'description' => esc_html__( 'Enable/Disable anti-aliasing font smoothing.', 'prisma-core' ),
					'section'     => 'prisma_core_section_typography',
				),
			);

			// Headings typography heading.
			$options['setting']['prisma_core_typography_body_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Body & Content', 'prisma-core' ),
					'section' => 'prisma_core_section_typography',
				),
			);

			// Body Font.
			$options['setting']['prisma_core_body_font'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_typography',
				'control'           => array(
					'type'     => 'prisma-core-typography',
					'label'    => esc_html__( 'Body Typography', 'prisma-core' ),
					'section'  => 'prisma_core_section_typography',
					'display'  => array(
						'font-family'     => array(),
						'font-subsets'    => array(),
						'font-weight'     => array(),
						'font-style'      => array(),
						'text-transform'  => array(),
						'text-decoration' => array(),
						'letter-spacing'  => array(),
						'font-size'       => array(),
						'line-height'     => array(),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_typography_body_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Headings typography heading.
			$options['setting']['prisma_core_typography_headings_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Headings (H1 - H6)', 'prisma-core' ),
					'section' => 'prisma_core_section_typography',
				),
			);

			// Headings default.
			$options['setting']['prisma_core_headings_font'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_typography',
				'control'           => array(
					'type'     => 'prisma-core-typography',
					'label'    => esc_html__( 'Headings Default', 'prisma-core' ),
					'section'  => 'prisma_core_section_typography',
					'display'  => array(
						'font-family'    => array(),
						'font-subsets'   => array(),
						'font-weight'    => array(),
						'font-style'     => array(),
						'text-transform' => array(),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_typography_headings_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			for ( $i = 1; $i <= 6; $i++ ) {

				$options['setting'][ 'prisma_core_h' . $i . '_font' ] = array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'prisma_core_sanitize_typography',
					'control'           => array(
						'type'     => 'prisma-core-typography',
						/* translators: %s Heading size */
						'label'    => esc_html( sprintf( __( 'H%s', 'prisma-core' ), $i ) ),
						'section'  => 'prisma_core_section_typography',
						'display'  => array(
							'font-family'     => array(),
							'font-subsets'    => array(),
							'font-weight'     => array(),
							'font-style'      => array(),
							'text-transform'  => array(),
							'text-decoration' => array(),
							'letter-spacing'  => array(),
							'font-size'       => array(),
							'line-height'     => array(),
						),
						'required' => array(
							array(
								'control'  => 'prisma_core_typography_headings_heading',
								'value'    => true,
								'operator' => '==',
							),
						),
					),
				);
			}

			$options['setting']['prisma_core_heading_em_font'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_typography',
				'control'           => array(
					'type'        => 'prisma-core-typography',
					'label'       => esc_html__( 'Heading Emphasized Text', 'prisma-core' ),
					'description' => esc_html__( 'Adds a separate font for styling of &lsaquo;em&rsaquo; tags, so you can create stylish typographic elements.', 'prisma-core' ),
					'section'     => 'prisma_core_section_typography',
					'display'     => array(
						'font-family'     => array(),
						'font-subsets'    => array(),
						'font-weight'     => array(),
						'font-style'      => array(),
						'text-transform'  => array(),
						'text-decoration' => array(),
						'letter-spacing'  => array(),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_typography_headings_heading',
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
new Prisma_Core_Customizer_Typography();
