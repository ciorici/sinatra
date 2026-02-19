<?php
/**
 * Prisma Core Sidebar section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Sidebar' ) ) :

	/**
	 * Prisma Core Sidebar section in Customizer.
	 */
	class Prisma_Core_Customizer_Sidebar {

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
			$options['section']['prisma_core_section_sidebar'] = array(
				'title'    => esc_html__( 'Sidebar', 'prisma-core' ),
				'priority' => 4,
			);

			// Default sidebar position.
			$options['setting']['prisma_core_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'prisma_core_section_sidebar',
					'label'       => esc_html__( 'Default Position', 'prisma-core' ),
					'description' => esc_html__( 'Choose default sidebar position layout. You can change this setting per page via metabox settings.', 'prisma-core' ),
					'choices'     => array(
						'no-sidebar'    => esc_html__( 'No Sidebar', 'prisma-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'prisma-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'prisma-core' ),
					),
				),
			);

			// Single post sidebar position.
			$options['setting']['prisma_core_single_post_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Single Post', 'prisma-core' ),
					'description' => esc_html__( 'Choose default sidebar position layout for single posts. You can change this setting per post via metabox settings.', 'prisma-core' ),
					'section'     => 'prisma_core_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'prisma-core' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'prisma-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'prisma-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'prisma-core' ),
					),
				),
			);

			// Single page sidebar position.
			$options['setting']['prisma_core_single_page_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Page', 'prisma-core' ),
					'description' => esc_html__( 'Choose default sidebar position layout for pages. You can change this setting per page via metabox settings.', 'prisma-core' ),
					'section'     => 'prisma_core_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'prisma-core' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'prisma-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'prisma-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'prisma-core' ),
					),
				),
			);

			// Archive sidebar position.
			$options['setting']['prisma_core_archive_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Archives & Search', 'prisma-core' ),
					'description' => esc_html__( 'Choose default sidebar position layout for archives and search results.', 'prisma-core' ),
					'section'     => 'prisma_core_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'prisma-core' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'prisma-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'prisma-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'prisma-core' ),
					),
				),
			);

			// Sidebar options heading.
			$options['setting']['prisma_core_sidebar_options_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Options', 'prisma-core' ),
					'section' => 'prisma_core_section_sidebar',
				),
			);

			// Sidebar style.
			$options['setting']['prisma_core_sidebar_style'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'prisma_core_section_sidebar',
					'label'       => esc_html__( 'Sidebar Style', 'prisma-core' ),
					'description' => esc_html__( 'Choose sidebar style.', 'prisma-core' ),
					'choices'     => array(
						'1' => esc_html__( 'Minimal', 'prisma-core' ),
						'2' => esc_html__( 'Title Focus', 'prisma-core' ),
						'3' => esc_html__( 'Widgets Separated', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sidebar width.
			$options['setting']['prisma_core_sidebar_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'section'     => 'prisma_core_section_sidebar',
					'label'       => esc_html__( 'Sidebar Width', 'prisma-core' ),
					'description' => esc_html__( 'Change your sidebar width.', 'prisma-core' ),
					'min'         => 15,
					'max'         => 50,
					'step'        => 1,
					'unit'        => '%',
					'required'    => array(
						array(
							'control'  => 'prisma_core_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sticky sidebar.
			$options['setting']['prisma_core_sidebar_sticky'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'prisma_core_section_sidebar',
					'label'       => esc_html__( 'Sticky Sidebar', 'prisma-core' ),
					'description' => esc_html__( 'Stick sidebar when scrolling.', 'prisma-core' ),
					'choices'     => array(
						''            => esc_html__( 'Disable', 'prisma-core' ),
						'sidebar'     => esc_html__( 'Stick first widget', 'prisma-core' ),
						'last-widget' => esc_html__( 'Stick last widget', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sidebar mobile position.
			$options['setting']['prisma_core_sidebar_responsive_position'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'prisma_core_section_sidebar',
					'label'       => esc_html__( 'Responsive Sidebar Position', 'prisma-core' ),
					'description' => esc_html__( 'Control sidebar position on smaller screens.', 'prisma-core' ),
					'choices'     => array(
						'hide'           => esc_html__( 'Hide', 'prisma-core' ),
						'before-content' => esc_html__( 'Before Content', 'prisma-core' ),
						'after-content'  => esc_html__( 'After Content', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_sidebar_options_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Sidebar typography heading.
			$options['setting']['prisma_core_typography_sidebar_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Typography', 'prisma-core' ),
					'section' => 'prisma_core_section_sidebar',
				),
			);

			// Sidebar widget heading.
			$options['setting']['prisma_core_sidebar_widget_title_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Widget Title Font Size', 'prisma-core' ),
					'description' => esc_html__( 'Specify sidebar widget title font size.', 'prisma-core' ),
					'section'     => 'prisma_core_section_sidebar',
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
							'control'  => 'prisma_core_typography_sidebar_heading',
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

new Prisma_Core_Customizer_Sidebar();
