<?php
/**
 * Prisma Core Layout section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Layout' ) ) :
	/**
	 * Prisma Core Layout section in Customizer.
	 */
	class Prisma_Core_Customizer_Layout {

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
			$options['section']['prisma_core_layout_section'] = array(
				'title'    => esc_html__( 'Layout', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_general',
				'priority' => 10,
			);

			// Site layout.
			$options['setting']['prisma_core_site_layout'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'prisma_core_layout_section',
					'label'       => esc_html__( 'Site Layout', 'prisma-core' ),
					'description' => esc_html__( 'Choose your site&rsquo;s main layout.', 'prisma-core' ),
					'choices'     => array(
						'fw-contained'    => esc_html__( 'Full Width: Contained', 'prisma-core' ),
						'fw-stretched'    => esc_html__( 'Full Width: Stretched', 'prisma-core' ),
						'boxed-separated' => esc_html__( 'Boxed Content', 'prisma-core' ),
						'boxed'           => esc_html__( 'Boxed', 'prisma-core' ),
					),
				),
			);

			// Container width.
			$options['setting']['prisma_core_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'section'     => 'prisma_core_layout_section',
					'label'       => esc_html__( 'Content Width', 'prisma-core' ),
					'description' => esc_html__( 'Change your site&rsquo;s main container width.', 'prisma-core' ),
					'min'         => 500,
					'max'         => 1920,
					'step'        => 10,
					'unit'        => 'px',
					'required'    => array(
						array(
							'control'  => 'prisma_core_site_layout',
							'value'    => 'fw-stretched',
							'operator' => '!=',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Prisma_Core_Customizer_Layout();
