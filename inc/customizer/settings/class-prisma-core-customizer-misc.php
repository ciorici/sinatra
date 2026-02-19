<?php
/**
 * Prisma Core Misc section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Misc' ) ) :
	/**
	 * Prisma Core Misc section in Customizer.
	 */
	class Prisma_Core_Customizer_Misc {

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
			$options['section']['prisma_core_section_misc'] = array(
				'title'    => esc_html__( 'Misc Settings', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_general',
				'priority' => 60,
			);

			// Schema toggle.
			$options['setting']['prisma_core_enable_schema'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Schema Markup', 'prisma-core' ),
					'description' => esc_html__( 'Add structured data to your content.', 'prisma-core' ),
					'section'     => 'prisma_core_section_misc',
				),
			);

			// Custom form styles.
			$options['setting']['prisma_core_custom_input_style'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Custom Form Styles', 'prisma-core' ),
					'description' => esc_html__( 'Custom design for checkboxes and radio buttons.', 'prisma-core' ),
					'section'     => 'prisma_core_section_misc',
				),
			);

			// Page Preloader heading.
			$options['setting']['prisma_core_preloader_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Page Preloader', 'prisma-core' ),
					'section' => 'prisma_core_section_misc',
				),
			);

			// Enable/Disable Page Preloader.
			$options['setting']['prisma_core_preloader'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Enable Page Preloader', 'prisma-core' ),
					'description' => esc_html__( 'Show animation until page is fully loaded.', 'prisma-core' ),
					'section'     => 'prisma_core_section_misc',
					'required'    => array(
						array(
							'control'  => 'prisma_core_preloader_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Preloader visibility.
			$options['setting']['prisma_core_preloader_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Device Visibility', 'prisma-core' ),
					'description' => esc_html__( 'Devices where Page Preloader is displayed.', 'prisma-core' ),
					'section'     => 'prisma_core_section_misc',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'prisma-core' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'prisma-core' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'prisma-core' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_preloader_heading',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_preloader',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Scroll Top heading.
			$options['setting']['prisma_core_scroll_top_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Scroll Top Button', 'prisma-core' ),
					'section' => 'prisma_core_section_misc',
				),
			);

			// Enable/Disable Scroll Top.
			$options['setting']['prisma_core_enable_scroll_top'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Enable Scroll Top Button', 'prisma-core' ),
					'description' => esc_html__( 'A sticky button that allows users to easily return to the top of a page.', 'prisma-core' ),
					'section'     => 'prisma_core_section_misc',
					'required'    => array(
						array(
							'control'  => 'prisma_core_scroll_top_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Scroll Top device visibility.
			$options['setting']['prisma_core_scroll_top_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Device Visibility', 'prisma-core' ),
					'description' => esc_html__( 'Devices where the button is displayed.', 'prisma-core' ),
					'section'     => 'prisma_core_section_misc',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'prisma-core' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'prisma-core' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'prisma-core' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_enable_scroll_top',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_scroll_top_heading',
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
new Prisma_Core_Customizer_Misc();
