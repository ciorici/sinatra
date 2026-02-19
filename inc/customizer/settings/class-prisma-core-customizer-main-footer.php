<?php
/**
 * Prisma Core Main Footer section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Main_Footer' ) ) :
	/**
	 * Prisma Core Main Footer section in Customizer.
	 */
	class Prisma_Core_Customizer_Main_Footer {

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
			$options['section']['prisma_core_section_main_footer'] = array(
				'title'    => esc_html__( 'Main Footer', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_footer',
				'priority' => 20,
			);

			// Enable Footer.
			$options['setting']['prisma_core_enable_footer'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-toggle',
					'label'   => esc_html__( 'Enable Main Footer', 'prisma-core' ),
					'section' => 'prisma_core_section_main_footer',
				),
			);

			// Footer Layout.
			$options['setting']['prisma_core_footer_layout'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-radio-image',
					'label'       => esc_html__( 'Column Layout', 'prisma-core' ),
					'description' => esc_html__( 'Choose your site&rsquo;s footer column layout.', 'prisma-core' ),
					'section'     => 'prisma_core_section_main_footer',
					'choices'     => array(
						'layout-1' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/footer-layout-1.svg',
							'title' => esc_html__( '1/4 + 1/4 + 1/4 + 1/4', 'prisma-core' ),
						),
						'layout-2' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/footer-layout-2.svg',
							'title' => esc_html__( '1/3 + 1/3 + 1/3', 'prisma-core' ),
						),
						'layout-3' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/footer-layout-3.svg',
							'title' => esc_html__( '2/3 + 1/3', 'prisma-core' ),
						),
						'layout-4' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/footer-layout-4.svg',
							'title' => esc_html__( '1/3 + 2/3', 'prisma-core' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#prisma-core-footer-widgets',
					'render_callback'     => 'prisma_core_footer_widgets',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Center footer widgets..
			$options['setting']['prisma_core_footer_widgets_align_center'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-toggle',
					'label'    => esc_html__( 'Center Widget Content', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_footer',
					'required' => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#prisma-core-footer-widgets',
					'render_callback'     => 'prisma_core_footer_widgets',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Main Footer visibility.
			$options['setting']['prisma_core_footer_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Device Visibility', 'prisma-core' ),
					'description' => esc_html__( 'Devices where Main Footer is displayed.', 'prisma-core' ),
					'section'     => 'prisma_core_section_main_footer',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'prisma-core' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'prisma-core' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'prisma-core' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Design Options heading.
			$options['setting']['prisma_core_footer_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'label'    => esc_html__( 'Design Options', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_footer',
					'required' => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Background.
			$options['setting']['prisma_core_footer_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Background', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_footer',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'prisma-core' ),
							'gradient' => esc_html__( 'Gradient', 'prisma-core' ),
							'image'    => esc_html__( 'Image', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_footer_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Text Color.
			$options['setting']['prisma_core_footer_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Font Color', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_footer',
					'display'  => array(
						'color' => array(
							'text-color'         => esc_html__( 'Text Color', 'prisma-core' ),
							'link-color'         => esc_html__( 'Link Color', 'prisma-core' ),
							'link-hover-color'   => esc_html__( 'Link Hover Color', 'prisma-core' ),
							'widget-title-color' => esc_html__( 'Widget Title Color', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_footer_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer Border.
			$options['setting']['prisma_core_footer_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Border', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_footer',
					'display'  => array(
						'border' => array(
							'style'     => esc_html__( 'Style', 'prisma-core' ),
							'color'     => esc_html__( 'Color', 'prisma-core' ),
							'width'     => esc_html__( 'Width (px)', 'prisma-core' ),
							'positions' => array(
								'top'    => esc_html__( 'Top', 'prisma-core' ),
								'bottom' => esc_html__( 'Bottom', 'prisma-core' ),
							),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_footer_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer typography heading.
			$options['setting']['prisma_core_typography_main_footer_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'label'    => esc_html__( 'Typography', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_footer',
					'required' => array(
						array(
							'control'  => 'prisma_core_enable_footer',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Footer widget title font size.
			$options['setting']['prisma_core_footer_widget_title_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Widget Title Font Size', 'prisma-core' ),
					'description' => esc_html__( 'Choose your widget title font size.', 'prisma-core' ),
					'section'     => 'prisma_core_section_main_footer',
					'responsive'  => true,
					'unit'        => array(
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
					'required'    => array(
						array(
							'control'  => 'prisma_core_typography_main_footer_heading',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_enable_footer',
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
new Prisma_Core_Customizer_Main_Footer();
