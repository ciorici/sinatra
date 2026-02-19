<?php
/**
 * Prisma Core Base Colors section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Colors' ) ) :
	/**
	 * Prisma Core Colors section in Customizer.
	 */
	class Prisma_Core_Customizer_Colors {

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
			$options['section']['prisma_core_section_colors'] = array(
				'title'    => esc_html__( 'Base Colors', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_general',
				'priority' => 20,
			);

			// Accent color.
			$options['setting']['prisma_core_accent_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_color',
				'control'           => array(
					'type'        => 'prisma-core-color',
					'label'       => esc_html__( 'Accent Color', 'prisma-core' ),
					'description' => esc_html__( 'The accent color is used subtly throughout your site, to call attention to key elements.', 'prisma-core' ),
					'section'     => 'prisma_core_section_colors',
					'priority'    => 10,
					'opacity'     => false,
				),
			);

			// Body background heading.
			$options['setting']['prisma_core_body_background_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'priority' => 40,
					'label'    => esc_html__( 'Body Background', 'prisma-core' ),
					'section'  => 'prisma_core_section_colors',
					'toggle'   => false,
				),
			);

			// Content background heading.
			$options['setting']['prisma_core_content_colors_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'priority' => 50,
					'label'    => esc_html__( 'Content', 'prisma-core' ),
					'section'  => 'prisma_core_section_colors',
					'toggle'   => false,
				),
			);

			// Content text color.
			$options['setting']['prisma_core_content_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_color',
				'control'           => array(
					'type'     => 'prisma-core-color',
					'label'    => esc_html__( 'Text Color', 'prisma-core' ),
					'section'  => 'prisma_core_section_colors',
					'priority' => 50,
					'opacity'  => true,
				),
			);

			// Content text color.
			$options['setting']['prisma_core_content_link_hover_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_color',
				'control'           => array(
					'type'        => 'prisma-core-color',
					'label'       => esc_html__( 'Link Hover Color', 'prisma-core' ),
					'description' => esc_html__( 'This only applies to entry content area, other links will use the accent color on hover.', 'prisma-core' ),
					'section'     => 'prisma_core_section_colors',
					'priority'    => 50,
					'opacity'     => true,
				),
			);

			// Headings color.
			$options['setting']['prisma_core_headings_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_color',
				'control'           => array(
					'type'     => 'prisma-core-color',
					'label'    => esc_html__( 'Headings Color', 'prisma-core' ),
					'section'  => 'prisma_core_section_colors',
					'priority' => 50,
					'opacity'  => true,
				),
			);

			// Content background color.
			$options['setting']['prisma_core_boxed_content_background_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_color',
				'control'           => array(
					'type'        => 'prisma-core-color',
					'label'       => esc_html__( 'Boxed Content - Background Color', 'prisma-core' ),
					'description' => esc_html__( 'Only used if Site Layout is Boxed or Boxed Content.', 'prisma-core' ),
					'section'     => 'prisma_core_section_colors',
					'priority'    => 50,
					'opacity'     => true,
				),
			);

			return $options;
		}

	}
endif;
new Prisma_Core_Customizer_Colors();
