<?php

/**
 * Option Page view.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\Requests;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class LockPlugins {

	const OPTION_NAME = 'lock_plugins_list';

	/**
	 * Save list lock plugins.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public static function save_plugin_list() {

		if ( empty( $_POST['lock_list'] ) ) {
			return;
		}

		if ( ! empty( get_option( static::OPTION_NAME ) ) ) {
			delete_option( static::OPTION_NAME );
		}

		add_option( static::OPTION_NAME, $_POST['lock_list'] );

		wp_redirect( admin_url( '/options-general.php?page=wp_lock_plugins.php' ), 301 );
		wp_exit();
	}

	/**
	 * Prevent Disable.
	 *
	 * @since  1.0.0
	 * @param  string $plugin
	 * @return void
	 */
	public function remove_disable( $plugin ) {

		global $wpdb;

		$table      = "{$wpdb->prefix}options";
		$where_name = static::OPTION_NAME;
		$query      = "SELECT option_value FROM {$table} WHERE option_name = '{$where_name}' ";
		$states     = $wpdb->get_results( $query );

		$option_value = unserialize( $states[0]->option_value );

		if ( is_array( $option_value ) && in_array( $plugin, $option_value ) ) {
			wp_safe_redirect( '/wp-admin/plugins.php?lock_plugins=1' );
			exit;
		}
	}


}
