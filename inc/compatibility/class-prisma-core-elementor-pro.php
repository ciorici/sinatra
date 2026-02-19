<?php
/**
 * Prisma Core compatibility class for Elementor Pro.
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

// Return if Elementor not active.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

// PHP 5.3+ is required.
if ( ! version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	return;
}

if ( ! class_exists( 'Prisma_Core_Elementor_Pro' ) ) :

	/**
	 * Elementor compatibility.
	 */
	class Prisma_Core_Elementor_Pro {

		/**
		 * Singleton instance of the class.
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Elementor location manager
		 *
		 * @var object
		 */
		public $elementor_location_manager;

		/**
		 * Instance.
		 *
		 * @since 1.0.0
		 * @return Prisma_Core_Elementor_Pro
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Prisma_Core_Elementor_Pro ) ) {
				self::$instance = new Prisma_Core_Elementor_Pro();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function __construct() {

			// Register theme locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

			// Override templates.
			add_action( 'prisma_core_header', array( $this, 'do_header' ), 0 );
			add_action( 'prisma_core_footer', array( $this, 'do_footer' ), 0 );
			add_action( 'prisma_core_content_404', array( $this, 'do_content_none' ), 0 );
			add_action( 'prisma_core_content_single', array( $this, 'do_content_single_post' ), 0 );
			add_action( 'prisma_core_content_page', array( $this, 'do_content_single_page' ), 0 );
			add_action( 'prisma_core_content_archive', array( $this, 'do_archive' ), 0 );
		}

		/**
		 * Register Theme Location for Elementor.
		 *
		 * @param object $manager Elementor object.
		 * @since 1.0.0
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();

			$this->elementor_location_manager = \ElementorPro\Modules\ThemeBuilder\Module::instance()->get_locations_manager(); // phpcs:ignore PHPCompatibility.Syntax.NewDynamicAccessToStatic.Found
		}

		/**
		 * Override Header.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_header() {
			$did_location = $this->elementor_location_manager->do_location( 'header' );

			if ( $did_location ) {
				remove_action( 'prisma_core_header', 'prisma_core_topbar_output', 10 );
				remove_action( 'prisma_core_header', 'prisma_core_header_output', 20 );
			}
		}

		/**
		 * Override Footer.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_footer() {
			$did_location = $this->elementor_location_manager->do_location( 'footer' );

			if ( $did_location ) {
				remove_action( 'prisma_core_footer', 'prisma_core_footer_output', 20 );
				remove_action( 'prisma_core_footer', 'prisma_core_copyright_bar_output', 30 );
			}
		}

		/**
		 * Override Footer.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_content_none() {
			if ( ! is_404() ) {
				return;
			}

			$did_location = $this->elementor_location_manager->do_location( 'single' );

			if ( $did_location ) {
				remove_action( 'prisma_core_content_404', 'prisma_core_404_page_content' );
			}
		}

		/**
		 * Override Single Post.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_content_single_post() {
			$did_location = $this->elementor_location_manager->do_location( 'single' );

			if ( $did_location ) {
				remove_action( 'prisma_core_content_single', 'prisma_core_content_single' );
				remove_action( 'prisma_core_after_singular', 'prisma_core_output_comments' );
			}
		}

		/**
		 * Override Single Page.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_content_single_page() {
			$did_location = $this->elementor_location_manager->do_location( 'single' );

			if ( $did_location ) {
				remove_action( 'prisma_core_content_page', 'prisma_core_content_page' );
				remove_action( 'prisma_core_after_singular', 'prisma_core_output_comments' );
			}
		}

		/**
		 * Override Archive.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_archive() {
			$did_location = $this->elementor_location_manager->do_location( 'archive' );

			if ( $did_location ) {
				remove_action( 'prisma_core_before_content', 'prisma_core_archive_info' );
				remove_action( 'prisma_core_content_archive', 'prisma_core_content' );
			}
		}
	}

endif;

/**
 * Returns the one Prisma_Core_Elementor_Pro instance.
 */
function prisma_core_elementor_pro() {
	return Prisma_Core_Elementor_Pro::instance();
}

prisma_core_elementor_pro();
