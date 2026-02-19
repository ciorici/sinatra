<?php
/**
 * Prisma Core Main Header Settings section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Main_Header' ) ) :
	/**
	 * Prisma Core Main Header section in Customizer.
	 */
	class Prisma_Core_Customizer_Main_Header {

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

			// Main Header Section.
			$options['section']['prisma_core_section_main_header'] = array(
				'title'    => esc_html__( 'Main Header', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_header',
				'priority' => 20,
			);

			// Header Layout.
			$options['setting']['prisma_core_header_layout'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-radio-image',
					'label'       => esc_html__( 'Header Layout', 'prisma-core' ),
					'description' => esc_html__( 'Pre-defined positions of header elements, such as logo and navigation.', 'prisma-core' ),
					'section'     => 'prisma_core_section_main_header',
					'choices'     => array(
						'layout-1' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/header-layout-1.svg',
							'title' => esc_html__( 'Header 1', 'prisma-core' ),
						),
						'layout-2' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/header-layout-2.svg',
							'title' => esc_html__( 'Header 2', 'prisma-core' ),
						),
						'layout-3' => array(
							'image' => PRISMA_CORE_THEME_URI . '/inc/customizer/assets/images/header-layout-3.svg',
							'title' => esc_html__( 'Header 3', 'prisma-core' ),
						),
					),
				),
			);

			// Header container width.
			$options['setting']['prisma_core_header_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Header Width', 'prisma-core' ),
					'description' => esc_html__( 'Stretch the Header container to full width, or match your site&rsquo;s content width.', 'prisma-core' ),
					'section'     => 'prisma_core_section_main_header',
					'choices'     => array(
						'content-width' => esc_html__( 'Content Width', 'prisma-core' ),
						'full-width'    => esc_html__( 'Full Width', 'prisma-core' ),
					),
				),
			);

			// Header widgets heading.
			$options['setting']['prisma_core_header_heading_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-heading',
					'label'       => esc_html__( 'Header Widgets', 'prisma-core' ),
					'description' => esc_html__( 'Click the Add Widget button to add available widgets to your Header. Click the down arrow icon to expand widget options.', 'prisma-core' ),
					'section'     => 'prisma_core_section_main_header',
					'space'       => true,
				),
			);

			// Header widgets.
			$options['setting']['prisma_core_header_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_widget',
				'control'           => array(
					'type'       => 'prisma-core-widget',
					'label'      => esc_html__( 'Header Widgets', 'prisma-core' ),
					'section'    => 'prisma_core_section_main_header',
					'widgets'    => apply_filters(
						'prisma_core_main_header_widgets',
						array(
							'search' => array(
								'max_uses' => 1,
							),
							'button' => array(
								'max_uses' => 1,
							),
						)
					),
					'locations'  => array(
						'left'  => esc_html__( 'Left', 'prisma-core' ),
						'right' => esc_html__( 'Right', 'prisma-core' ),
					),
					'visibility' => array(
						'all'                => esc_html__( 'Show on All Devices', 'prisma-core' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'prisma-core' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'prisma-core' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'prisma-core' ),
					),
					'required'   => array(
						array(
							'control'  => 'prisma_core_header_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#prisma-core-header',
					'render_callback'     => 'prisma_core_header_content_output',
					'container_inclusive' => false,
					'fallback_refresh'    => true,
				),
			);

			// Header widget separator.
			$options['setting']['prisma_core_header_widgets_separator'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Widgets Separator', 'prisma-core' ),
					'description' => esc_html__( 'Display a separator line between widgets.', 'prisma-core' ),
					'section'     => 'prisma_core_section_main_header',
					'choices'     => array(
						'none'    => esc_html__( 'None', 'prisma-core' ),
						'regular' => esc_html__( 'Regular', 'prisma-core' ),
						'slanted' => esc_html__( 'Slanted', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_header_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Header design options heading.
			$options['setting']['prisma_core_header_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Design Options', 'prisma-core' ),
					'section' => 'prisma_core_section_main_header',
					'space'   => true,
				),
			);

			// Header Background.
			$options['setting']['prisma_core_header_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'        => 'prisma-core-design-options',
					'label'       => esc_html__( 'Background', 'prisma-core' ),
					'description' => '',
					'section'     => 'prisma_core_section_main_header',
					'space'       => true,
					'display'     => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'prisma-core' ),
							'gradient' => esc_html__( 'Gradient', 'prisma-core' ),
							'image'    => esc_html__( 'Image', 'prisma-core' ),
						),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_header_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Header Text Color.
			$options['setting']['prisma_core_header_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Font Color', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_header',
					'space'    => true,
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Tagline Color', 'prisma-core' ),
							'link-color'       => esc_html__( 'Link Color', 'prisma-core' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_header_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Header Border.
			$options['setting']['prisma_core_header_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Border', 'prisma-core' ),
					'section'  => 'prisma_core_section_main_header',
					'space'    => true,
					'display'  => array(
						'border' => array(
							'style'     => esc_html__( 'Style', 'prisma-core' ),
							'color'     => esc_html__( 'Color', 'prisma-core' ),
							'width'     => esc_html__( 'Width (px)', 'prisma-core' ),
							'positions' => array(
								'top'    => esc_html__( 'Top', 'prisma-core' ),
								'bottom' => esc_html__( 'Bottom', 'prisma-core' ),
							),
							'separator' => esc_html__( 'Separator Color', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_header_heading_design_options',
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
new Prisma_Core_Customizer_Main_Header();
