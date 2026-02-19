<?php
/**
 * Migration from Prisma Core theme.
 *
 * Migrates Customizer settings, widget assignments, and menu locations
 * from the original Prisma Core theme when users switch to the renamed fork.
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
		 * Primary class constructor.
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
			add_action( 'after_switch_theme', array( $this, 'maybe_migrate' ) );
		}

		/**
		 * Run migration if switching from old Prisma Core theme.
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
			if ( get_option( $current_slug . '_migrated_from_prisma-core' ) ) {
				return;
			}

			$old_mods = get_option( 'theme_mods_' . self::OLD_SLUG );

			if ( ! $old_mods || ! is_array( $old_mods ) ) {
				return; // No Prisma Core data to migrate.
			}

			$new_prefix = $current_slug . '_';

			$this->migrate_theme_mods( $old_mods, $current_slug, $new_prefix );
			$this->migrate_sidebar_widgets( $current_slug );
			$this->migrate_options( $current_slug );

			// Mark migration complete.
			update_option( $current_slug . '_migrated_from_prisma-core', true );
		}

		/**
		 * Migrate theme_mods (Customizer settings + menu locations).
		 *
		 * @since 1.4.0
		 * @param array  $old_mods     The old theme_mods_prisma-core array.
		 * @param string $current_slug The new theme slug.
		 * @param string $new_prefix   The new option key prefix.
		 */
		private function migrate_theme_mods( $old_mods, $current_slug, $new_prefix ) {
			$new_mods = array();

			foreach ( $old_mods as $key => $value ) {
				$new_key = $this->remap_key( $key, $new_prefix );
				$new_mods[ $new_key ] = $value;
			}

			// Remap nav_menu_locations keys (e.g. 'prisma-core-primary' → '{slug}-primary').
			if ( isset( $new_mods['nav_menu_locations'] ) && is_array( $new_mods['nav_menu_locations'] ) ) {
				$new_locations = array();
				foreach ( $new_mods['nav_menu_locations'] as $loc => $menu_id ) {
					$new_loc = str_replace( self::OLD_SLUG . '-', $current_slug . '-', $loc );
					$new_locations[ $new_loc ] = $menu_id;
				}
				$new_mods['nav_menu_locations'] = $new_locations;
			}

			// Only write if the new theme doesn't already have mods.
			$existing = get_option( 'theme_mods_' . $current_slug );
			if ( ! $existing || ! is_array( $existing ) || empty( $existing ) ) {
				update_option( 'theme_mods_' . $current_slug, $new_mods );
			}
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

			if ( $changed ) {
				update_option( 'sidebars_widgets', $sidebars );
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
		 * Keys like 'prisma_core_primary_color' become '{prefix}primary_color'.
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
	}

endif;

new Prisma_Core_Migration();
