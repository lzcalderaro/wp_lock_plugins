<?php

/**
 * Manage all plugins requests.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\Requests;

/**
 * Manage all plugins requests.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class LockPlugins {

	/**
	 * Option name to save, update and consult.
	 * @since 1.0.0
	 */
	const OPTION_NAME = 'lock_plugins_list';

	/**
	 * Save plugins list.
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

		$response = '&lock_message=2';
		if ( add_option( static::OPTION_NAME, $_POST['lock_list'] ) === false ) {
			$response = '&lock_message=3';
		}

		wp_safe_redirect( admin_url( '/options-general.php?page=wp_lock_plugins.php' . $response ), 301 );
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
			wp_safe_redirect( '/wp-admin/plugins.php?lock_message=1' );
			wp_exit();
		}
	}
}
