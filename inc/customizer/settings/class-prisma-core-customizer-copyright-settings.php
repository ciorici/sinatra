<?php
/**
 * Prisma Core Copyright Bar section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Copyright_Settings' ) ) :
	/**
	 * Prisma Core Copyright Bar section in Customizer.
	 */
	class Prisma_Core_Customizer_Copyright_Settings {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Registers our custom options in Customizer.
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
			$options['section']['prisma_core_section_copyright_bar'] = array(
				'title'    => esc_html__( 'Copyright Bar', 'prisma-core' ),
				'priority' => 30,
				'panel'    => 'prisma_core_panel_footer',
			);

			// Enable Copyright Bar.
			$options['setting']['prisma_core_enable_copyright'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-toggle',
					'label'   => esc_html__( 'Enable Copyright Bar', 'prisma-core' ),
					'section' => 'prisma_core_section_copyright_bar',
				),
			);

			// Copyright Layout.
			$options['setting']['prisma_core_copyright_layout'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-radio-image',
					'section'     => 'prisma_core_section_copyright_bar',
					'label'       => esc_html__( 'Copyright Layout', 'prisma-core' ),
					'description' => esc_html__( 'Choose your site&rsquo;s copyright widgets layout.', 'prisma-core' ),
					'choices'     => array(
						'layout-1' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/copyright-layout-1.svg',
							'title' => esc_html__( 'Centered', 'prisma-core' ),
						),
						'layout-2' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/copyright-layout-2.svg',
							'title' => esc_html__( 'Inline', 'prisma-core' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Enable Copyright Bar.
			$options['setting']['prisma_core_copyright_separator'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'prisma_core_section_copyright_bar',
					'label'       => esc_html__( 'Copyright Separator', 'prisma-core' ),
					'description' => esc_html__( 'Select type of Copyright Separator.', 'prisma-core' ),
					'choices'     => array(
						'none'                => esc_html__( 'None', 'prisma-core' ),
						'contained-separator' => esc_html__( 'Contained Separator', 'prisma-core' ),
						'fw-separator'        => esc_html__( 'Fullwidth Separator', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright visibility.
			$options['setting']['prisma_core_copyright_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'prisma_core_section_copyright_bar',
					'label'       => esc_html__( 'Device Visibility', 'prisma-core' ),
					'description' => esc_html__( 'Devices where Copyright Bar is displayed.', 'prisma-core' ),
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'prisma-core' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'prisma-core' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'prisma-core' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright widgets heading.
			$options['setting']['prisma_core_copyright_heading_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-heading',
					'section'     => 'prisma_core_section_copyright_bar',
					'label'       => esc_html__( 'Copyright Bar Widgets', 'prisma-core' ),
					'description' => esc_html__( 'Click the Add Widget button to add available widgets to your Copyright Bar.', 'prisma-core' ),
					'required'    => array(
						array(
							'control'  => 'prisma_core_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright widgets.
			$options['setting']['prisma_core_copyright_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_widget',
				'control'           => array(
					'type'       => 'prisma-core-widget',
					'section'    => 'prisma_core_section_copyright_bar',
					'label'      => esc_html__( 'Copyright Bar Widgets', 'prisma-core' ),
					'widgets'    => array(
						'text'    => array(
							'max_uses' => 3,
						),
						'nav'     => array(
							'menu_location' => apply_filters( 'prisma_core_footer_menu_location', 'prisma-core-footer' ),
							'max_uses'      => 1,
						),
						'socials' => array(
							'max_uses' => 1,
							'styles'   => array(
								'minimal' => esc_html__( 'Minimal', 'prisma-core' ),
								'rounded' => esc_html__( 'Rounded', 'prisma-core' ),
							),
						),
					),
					'locations'  => array(
						'start' => esc_html__( 'Start', 'prisma-core' ),
						'end'   => esc_html__( 'End', 'prisma-core' ),
					),
					'visibility' => array(
						'all'                => esc_html__( 'Show on All Devices', 'prisma-core' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'prisma-core' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'prisma-core' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'prisma-core' ),
					),
					'required'   => array(
						array(
							'control'  => 'prisma_core_copyright_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#prisma-core-copyright',
					'render_callback'     => 'prisma_core_copyright_bar_output',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Copyright design options heading.
			$options['setting']['prisma_core_copyright_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'section'  => 'prisma_core_section_copyright_bar',
					'label'    => esc_html__( 'Design Options', 'prisma-core' ),
					'required' => array(
						array(
							'control'  => 'prisma_core_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright Background.
			$options['setting']['prisma_core_copyright_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'section'  => 'prisma_core_section_copyright_bar',
					'label'    => esc_html__( 'Background', 'prisma-core' ),
					'space'    => true,
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'prisma-core' ),
							'gradient' => esc_html__( 'Gradient', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_copyright_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_enable_copyright',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Copyright Text Color.
			$options['setting']['prisma_core_copyright_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'        => 'prisma-core-design-options',
					'section'     => 'prisma_core_section_copyright_bar',
					'label'       => esc_html__( 'Font Color', 'prisma-core' ),
					'description' => '',
					'space'       => true,
					'display'     => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'prisma-core' ),
							'link-color'       => esc_html__( 'Link Color', 'prisma-core' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'prisma-core' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_copyright_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_enable_copyright',
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
new Prisma_Core_Customizer_Copyright_Settings();
