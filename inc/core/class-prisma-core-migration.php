<?php
/**
 * Migration from Sinatra theme.
 *
 * Migrates Customizer settings, widget assignments, and menu locations
 * from the original Sinatra theme when users switch to the renamed fork.
 *
 * @package Prisma Core
 * @since   1.4.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Prisma_Core_Migration' ) ) :

	/**
	 * Prisma_Core_Migration Class.
	 *
	 * @since 1.4.0
	 */
	class Prisma_Core_Migration {

		/**
		 * Old theme slug to migrate from.
		 *
		 * @var string
		 */
		const OLD_SLUG = 'sinatra';

		/**
		 * Old option key prefix.
		 *
		 * @var string
		 */
		const OLD_PREFIX = 'sinatra_';

		/**
		 * Old plugin widget ID bases mapped to new equivalents.
		 *
		 * @var array
		 */
		const WIDGET_REMAP = array(
			'sinatra-core-custom-list-widget' => 'prisma-companion-custom-list-widget',
			'sinatra-core-posts-list-widget'  => 'prisma-companion-posts-list-widget',
		);

		/**
		 * Primary class constructor.
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
			add_action( 'after_switch_theme', array( $this, 'maybe_migrate' ) );
			add_action( 'admin_notices', array( $this, 'migration_notice' ) );
		}

		/**
		 * Run migration if switching from old Sinatra theme.
		 *
		 * @since 1.4.0
		 */
		public function maybe_migrate() {
			$current_slug = get_stylesheet();

			// No migration needed if we ARE the old theme.
			if ( self::OLD_SLUG === $current_slug ) {
				return;
			}

			// Already migrated.
			if ( get_option( $current_slug . '_migrated_from_sinatra' ) ) {
				return;
			}

			$old_mods = get_option( 'theme_mods_' . self::OLD_SLUG );

			if ( ! $old_mods || ! is_array( $old_mods ) ) {
				return; // No Sinatra data to migrate.
			}

			$new_prefix = str_replace( '-', '_', $current_slug ) . '_';

			$this->migrate_theme_mods( $old_mods, $current_slug, $new_prefix );
			$this->migrate_sidebar_widgets( $current_slug );
			$this->migrate_options( $current_slug );

			// Mark migration complete.
			update_option( $current_slug . '_migrated_from_sinatra', true );

			// Trigger one-time admin notice.
			set_transient( 'prisma_core_migration_notice', true, 60 );

			// Force dynamic CSS regeneration on next page load.
			delete_transient( 'prisma_core_has_dynamic_css' );
			delete_transient( 'prisma_core_google_fonts_enqueue' );
		}

		/**
		 * Migrate theme_mods (Customizer settings + menu locations).
		 *
		 * @since 1.4.0
		 * @param array  $old_mods     The old theme_mods_sinatra array.
		 * @param string $current_slug The new theme slug.
		 * @param string $new_prefix   The new option key prefix.
		 */
		private function migrate_theme_mods( $old_mods, $current_slug, $new_prefix ) {
			$new_mods = array();

			foreach ( $old_mods as $key => $value ) {
				$new_key = $this->remap_key( $key, $new_prefix );
				$new_mods[ $new_key ] = $value;
			}

			// Remap nav_menu_locations keys (e.g. 'sinatra-primary' → '{slug}-primary').
			if ( isset( $new_mods['nav_menu_locations'] ) && is_array( $new_mods['nav_menu_locations'] ) ) {
				$new_locations = array();
				foreach ( $new_mods['nav_menu_locations'] as $loc => $menu_id ) {
					$new_loc = str_replace( self::OLD_SLUG . '-', $current_slug . '-', $loc );
					$new_locations[ $new_loc ] = $menu_id;
				}
				$new_mods['nav_menu_locations'] = $new_locations;
			}

			// Merge migrated mods with any existing mods (existing values take precedence).
			$existing = get_option( 'theme_mods_' . $current_slug );
			if ( is_array( $existing ) && ! empty( $existing ) ) {
				$new_mods = array_merge( $new_mods, $existing );
			}
			update_option( 'theme_mods_' . $current_slug, $new_mods );
		}

		/**
		 * Migrate sidebar widget assignments.
		 *
		 * @since 1.4.0
		 * @param string $current_slug The new theme slug.
		 */
		private function migrate_sidebar_widgets( $current_slug ) {
			$sidebars = get_option( 'sidebars_widgets', array() );

			if ( ! is_array( $sidebars ) ) {
				return;
			}

			$remap = array(
				self::OLD_SLUG . '-sidebar'  => $current_slug . '-sidebar',
				self::OLD_SLUG . '-footer-1' => $current_slug . '-footer-1',
				self::OLD_SLUG . '-footer-2' => $current_slug . '-footer-2',
				self::OLD_SLUG . '-footer-3' => $current_slug . '-footer-3',
				self::OLD_SLUG . '-footer-4' => $current_slug . '-footer-4',
			);

			$changed = false;
			foreach ( $remap as $old_id => $new_id ) {
				if ( isset( $sidebars[ $old_id ] ) && ! isset( $sidebars[ $new_id ] ) ) {
					$sidebars[ $new_id ] = $sidebars[ $old_id ];
					$changed = true;
				}
			}

			// Remap widget instance IDs inside each sidebar.
			// e.g. 'sinatra-core-custom-list-widget-2' → 'prisma-companion-custom-list-widget-2'.
			foreach ( $sidebars as $sidebar_id => $widgets ) {
				if ( ! is_array( $widgets ) ) {
					continue;
				}
				foreach ( $widgets as $i => $widget_id ) {
					foreach ( self::WIDGET_REMAP as $old_base => $new_base ) {
						if ( strpos( $widget_id, $old_base ) === 0 ) {
							$sidebars[ $sidebar_id ][ $i ] = str_replace( $old_base, $new_base, $widget_id );
							$changed = true;
							break;
						}
					}
				}
			}

			if ( $changed ) {
				update_option( 'sidebars_widgets', $sidebars );
			}

			// Copy widget option data.
			// e.g. 'widget_sinatra-core-custom-list-widget' → 'widget_prisma-companion-custom-list-widget'.
			foreach ( self::WIDGET_REMAP as $old_base => $new_base ) {
				$old_option = get_option( 'widget_' . $old_base );
				if ( false !== $old_option && false === get_option( 'widget_' . $new_base ) ) {
					update_option( 'widget_' . $new_base, $old_option );
				}
			}
		}

		/**
		 * Migrate standalone options and transients.
		 *
		 * @since 1.4.0
		 * @param string $current_slug The new theme slug.
		 */
		private function migrate_options( $current_slug ) {
			// Theme updater version tracking.
			$old_updater = get_option( self::OLD_SLUG . '-theme-updater' );
			if ( false !== $old_updater ) {
				update_option( $current_slug . '-theme-updater', $old_updater );
			}
		}

		/**
		 * Remap an option key from old prefix to new prefix.
		 *
		 * Keys like 'sinatra_primary_color' become '{prefix}primary_color'.
		 * Keys without the old prefix (e.g. 'custom_logo') are left unchanged.
		 *
		 * @since 1.4.0
		 * @param string $key        The original key.
		 * @param string $new_prefix The new prefix.
		 * @return string Remapped key.
		 */
		private function remap_key( $key, $new_prefix ) {
			if ( strpos( $key, self::OLD_PREFIX ) === 0 ) {
				return $new_prefix . substr( $key, strlen( self::OLD_PREFIX ) );
			}
			return $key;
		}

		/**
		 * Display a one-time admin notice after migration.
		 *
		 * @since 1.4.0
		 */
		public function migration_notice() {
			if ( ! get_transient( 'prisma_core_migration_notice' ) ) {
				return;
			}

			delete_transient( 'prisma_core_migration_notice' );
			?>
			<div class="notice notice-success is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Sinatra settings migrated to Prisma Core.', 'prisma-core' ); ?></strong>
				</p>
				<p>
					<?php esc_html_e( 'Your Customizer settings, menus, and widgets have been transferred. Please install and activate the Prisma Companion plugin to restore widget functionality.', 'prisma-core' ); ?>
				</p>
				<p>
					<?php
					printf(
						/* translators: %s: plugin name wrapped in a link */
						esc_html__( 'Note: The Social Links widget from Sinatra Core has no equivalent in Prisma Companion. We recommend %s as a replacement.', 'prisma-core' ),
						'<a href="' . esc_url( admin_url( 'plugin-install.php?s=Social+Icons+Widget+WPZOOM&tab=search&type=term' ) ) . '">Social Icons Widget & Block by WPZOOM</a>'
					);
					?>
				</p>
			</div>
			<?php
		}
	}

endif;

new Prisma_Core_Migration();
