<?php
/**
 * Prisma Core Top Bar Settings section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Top_Bar' ) ) :
	/**
	 * Prisma Core Top Bar Settings section in Customizer.
	 */
	class Prisma_Core_Customizer_Top_Bar {

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
			$options['section']['prisma_core_section_top_bar'] = array(
				'title'    => esc_html__( 'Top Bar', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_header',
				'priority' => 10,
			);

			// Enable Top Bar.
			$options['setting']['prisma_core_top_bar_enable'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Enable Top Bar', 'prisma-core' ),
					'description' => esc_html__( 'Top Bar is a section with widgets located above Main Header area.', 'prisma-core' ),
					'section'     => 'prisma_core_section_top_bar',
				),
			);

			// Top Bar container width.
			$options['setting']['prisma_core_top_bar_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Top Bar Width', 'prisma-core' ),
					'description' => esc_html__( 'Stretch the Top Bar container to full width, or match your site&rsquo;s content width.', 'prisma-core' ),
					'section'     => 'prisma_core_section_top_bar',
					'choices'     => array(
						'content-width' => esc_html__( 'Content Width', 'prisma-core' ),
						'full-width'    => esc_html__( 'Full Width', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar visibility.
			$options['setting']['prisma_core_top_bar_visibility'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Device Visibility', 'prisma-core' ),
					'description' => esc_html__( 'Devices where the Top Bar is displayed.', 'prisma-core' ),
					'section'     => 'prisma_core_section_top_bar',
					'choices'     => array(
						'all'                => esc_html__( 'Show on All Devices', 'prisma-core' ),
						'hide-mobile'        => esc_html__( 'Hide on Mobile', 'prisma-core' ),
						'hide-tablet'        => esc_html__( 'Hide on Tablet', 'prisma-core' ),
						'hide-mobile-tablet' => esc_html__( 'Hide on Mobile and Tablet', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar widgets heading.
			$options['setting']['prisma_core_top_bar_heading_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-heading',
					'label'       => esc_html__( 'Top Bar Widgets', 'prisma-core' ),
					'description' => esc_html__( 'Click the Add Widget button to add available widgets to your Top Bar.', 'prisma-core' ),
					'section'     => 'prisma_core_section_top_bar',
					'required'    => array(
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar widgets.
			$options['setting']['prisma_core_top_bar_widgets'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_widget',
				'control'           => array(
					'type'       => 'prisma-core-widget',
					'label'      => esc_html__( 'Top Bar Widgets', 'prisma-core' ),
					'section'    => 'prisma_core_section_top_bar',
					'widgets'    => array(
						'text'    => array(
							'max_uses' => 3,
						),
						'nav'     => array(
							'max_uses' => 1,
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
							'control'  => 'prisma_core_top_bar_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
				'partial'           => array(
					'selector'            => '#prisma-core-topbar',
					'render_callback'     => 'prisma_core_topbar_output',
					'container_inclusive' => true,
					'fallback_refresh'    => true,
				),
			);

			// Top Bar widget separator.
			$options['setting']['prisma_core_top_bar_widgets_separator'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Widgets Separator', 'prisma-core' ),
					'description' => esc_html__( 'Display a separator line between widgets.', 'prisma-core' ),
					'section'     => 'prisma_core_section_top_bar',
					'choices'     => array(
						'none'    => esc_html__( 'None', 'prisma-core' ),
						'regular' => esc_html__( 'Regular', 'prisma-core' ),
						'slanted' => esc_html__( 'Slanted', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_top_bar_heading_widgets',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar design options heading.
			$options['setting']['prisma_core_top_bar_heading_design_options'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-heading',
					'label'    => esc_html__( 'Design Options', 'prisma-core' ),
					'section'  => 'prisma_core_section_top_bar',
					'required' => array(
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar Background.
			$options['setting']['prisma_core_top_bar_background'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Background', 'prisma-core' ),
					'section'  => 'prisma_core_section_top_bar',
					'display'  => array(
						'background' => array(
							'color'    => esc_html__( 'Solid Color', 'prisma-core' ),
							'gradient' => esc_html__( 'Gradient', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_top_bar_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar Text Color.
			$options['setting']['prisma_core_top_bar_text_color'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Font Color', 'prisma-core' ),
					'section'  => 'prisma_core_section_top_bar',
					'display'  => array(
						'color' => array(
							'text-color'       => esc_html__( 'Text Color', 'prisma-core' ),
							'link-color'       => esc_html__( 'Link Color', 'prisma-core' ),
							'link-hover-color' => esc_html__( 'Link Hover Color', 'prisma-core' ),
						),
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_top_bar_heading_design_options',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Top Bar Border.
			$options['setting']['prisma_core_top_bar_border'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_design_options',
				'control'           => array(
					'type'     => 'prisma-core-design-options',
					'label'    => esc_html__( 'Border', 'prisma-core' ),
					'section'  => 'prisma_core_section_top_bar',
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
							'control'  => 'prisma_core_top_bar_enable',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_top_bar_heading_design_options',
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
new Prisma_Core_Customizer_Top_Bar();
