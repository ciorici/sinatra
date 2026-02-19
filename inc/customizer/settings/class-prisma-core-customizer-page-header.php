<?php
/**
 * Prisma Core Page Title Settings section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Page_Header' ) ) :
	/**
	 * Prisma Core Page Title Settings section in Customizer.
	 */
	class Prisma_Core_Customizer_Page_Header {

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

			// Page Title Section.
			$options['section']['prisma_core_section_page_header'] = array(
				'title'    => esc_html__( 'Page Header', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_header',
				'priority' => 60,
			);

			// Page Header enable.
			$options['setting']['prisma_core_page_header_enable'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-toggle',
					'label'   => esc_html__( 'Enable Page Header', 'prisma-core' ),
					'section' => 'prisma_core_section_page_header',
				),
			);

			// Alignment.
			$options['setting']['prisma_core_page_header_alignment'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'     => 'prisma-core-alignment',
					'label'    => esc_html__( 'Title Alignment', 'prisma-core' ),
					'section'  => 'prisma_core_section_page_header',
					'choices'  => 'horizontal',
					'icons'    => array(
						'left'   => 'dashicons dashicons-editor-alignleft',
						'center' => 'dashicons dashicons-editor-aligncenter',
						'right'  => 'dashicons dashicons-editor-alignright',
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_page_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Spacing.
			$options['setting']['prisma_core_page_header_spacing'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-spacing',
					'label'       => esc_html__( 'Page Title Spacing', 'prisma-core' ),
					'description' => esc_html__( 'Specify Page Title top and bottom padding.', 'prisma-core' ),
					'section'     => 'prisma_core_section_page_header',
					'choices'     => array(
						'top'    => esc_html__( 'Top', 'prisma-core' ),
						'bottom' => esc_html__( 'Bottom', 'prisma-core' ),
					),
					'responsive'  => true,
					'unit'        => array(
						'px',
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_page_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Page Header design options heading.
			$options['setting']['prisma_core_page_header_heading_design'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'label'    => esc_html__( 'Design Options', 'prisma-core' ),
					'section'  => 'prisma_core_section_page_header',
					'required' => array(
						array(
							'control'  => 'prisma_core_page_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Page Header background design.
			$options['setting']['prisma_core_page_header_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Background', 'prisma-core' ),
					'section'  => 'prisma_core_section_page_header',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'prisma-core' ),
							'gradient' => esc_html__( 'Gradient', 'prisma-core' ),
							'image'    => esc_html__( 'Image', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_page_header_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_page_header_heading_design',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Page Header Text Color.
			$options['setting']['prisma_core_page_header_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Font Color', 'prisma-core' ),
					'section'  => 'prisma_core_section_page_header',
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'prisma-core' ),
							'link-color'       => esc_html__( 'Link Color', 'prisma-core' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_page_header_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_page_header_heading_design',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Page Header Border.
			$options['setting']['prisma_core_page_header_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Border', 'prisma-core' ),
					'section'  => 'prisma_core_section_page_header',
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
							'control'  => 'prisma_core_page_header_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_page_header_heading_design',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Page Header typography heading.
			$options['setting']['prisma_core_typography_page_header'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'label'    => esc_html__( 'Typography', 'prisma-core' ),
					'section'  => 'prisma_core_section_page_header',
					'required' => array(
						array(
							'control'  => 'prisma_core_page_header_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Page Header font size.
			$options['setting']['prisma_core_page_header_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Page Title Font Size', 'prisma-core' ),
					'description' => esc_html__( 'Choose your page title font size.', 'prisma-core' ),
					'section'     => 'prisma_core_section_page_header',
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
							'control'  => 'prisma_core_typography_page_header',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_page_header_enable',
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
new Prisma_Core_Customizer_Page_Header();
