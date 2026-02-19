<?php
/**
 * Prisma Core Customizer sections and panels.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Sections' ) ) :
	/**
	 * Prisma Core Customizer sections and panels.
	 */
	class Prisma_Core_Customizer_Sections {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom panels in Customizer.
			 */
			add_filter( 'prisma_core_customizer_options', array( $this, 'register_panel' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_panel( $options ) {

			// General panel.
			$options['panel']['prisma_core_panel_general'] = array(
				'title'    => esc_html__( 'General Settings', 'prisma-core' ),
				'priority' => 1,
			);

			// Header panel.
			$options['panel']['prisma_core_panel_header'] = array(
				'title'    => esc_html__( 'Header', 'prisma-core' ),
				'priority' => 3,
			);

			// Footer panel.
			$options['panel']['prisma_core_panel_footer'] = array(
				'title'    => esc_html__( 'Footer', 'prisma-core' ),
				'priority' => 5,
			);

			// Blog settings.
			$options['panel']['prisma_core_panel_blog'] = array(
				'title'    => esc_html__( 'Blog', 'prisma-core' ),
				'priority' => 6,
			);

			return $options;
		}
	}
endif;
new Prisma_Core_Customizer_Sections();
