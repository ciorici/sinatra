<?php
/**
 * The Database updater for Prisma Core.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.1.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Prisma_Core_DB_Updater' ) ) :

	/**
	 * Prisma_Core_DB_Updater Class.
	 */
	class Prisma_Core_DB_Updater {

		/**
		 * DB updates and callbacks that need to be run per version.
		 *
		 * @var array
		 */
		private static $db_updates = array(
			'1.1.0' => array(
				'v_1_1_0',
			),
		);

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			if ( is_admin() ) {
				add_action( 'admin_init', array( $this, 'updates' ) );
			} else {
				add_action( 'wp', array( $this, 'updates' ) );
			}
		}

		/**
		 * Implement theme update logic.
		 *
		 * @since 1.0.0
		 */
		public function updates() {

			$updates         = $this->get_db_update_callbacks();
			$current_version = get_option( 'prisma-core-theme-updater', '0.0.0' );

			if ( empty( $updates ) ) {
				return;
			}

			if ( ! is_null( $current_version ) && -1 < version_compare( $current_version, max( array_keys( $updates ) ) ) ) {
				return;
			}

			foreach ( $updates as $version => $callbacks ) {
				if ( version_compare( $current_version, $version, '<' ) ) {
					foreach ( $callbacks as $callback ) {
						call_user_func( array( 'Prisma_Core_DB_Updater', $callback ) );
					}
				}
			}

			// Update dynamic stylesheet on theme update.
			prisma_core_dynamic_styles()->update_dynamic_file();

			$this->update_db_version();
		}

		/**
		 * Update DB version to current.
		 *
		 * @param string|null $version New Astra theme version or null.
		 */
		public static function update_db_version( $version = null ) {
			update_option( 'prisma-core-theme-updater', PRISMA_CORE_THEME_VERSION );
		}

		/**
		 * Get list of DB update callbacks.
		 *
		 * @since  1.1.0
		 * @return array
		 */
		public function get_db_update_callbacks() {
			return self::$db_updates;
		}

		/**
		 * DB Update v1.1.0
		 *
		 * @since  1.1.0
		 * @return void
		 */
		public static function v_1_1_0() {

			prisma_core()->options->set(
				'prisma_core_single_post_elements',
				array(
					'thumb'          => prisma_core()->options->get( 'prisma_core_single_post_thumb' ),
					'category'       => prisma_core()->options->get( 'prisma_core_single_post_categories' ),
					'tags'           => prisma_core()->options->get( 'prisma_core_single_post_tags' ),
					'last-updated'   => prisma_core()->options->get( 'prisma_core_single_last_updated' ),
					'about-author'   => prisma_core()->options->get( 'prisma_core_single_about_author' ),
					'prev-next-post' => prisma_core()->options->get( 'prisma_core_single_post_next_prev' ),
				)
			);

			// Single Post Layout to Single Title Position.
			switch ( prisma_core()->options->get( 'prisma_core_single_post_layout' ) ) {

				case 'layout-1':
					prisma_core()->options->set( 'prisma_core_single_title_position', 'in-content' );
					break;

				case 'layout-2':
					prisma_core()->options->set( 'prisma_core_single_title_position', 'in-page-header' );
					break;
			}
		}
	}

endif;

new Prisma_Core_DB_Updater();
