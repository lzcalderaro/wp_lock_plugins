<?php

/**
 * Manage all plugins.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\Utils;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class GetPlugins {

	/**
	 * View to list all plugins.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public static function get_all_plugins() {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$all_plugins = get_plugins();
		$return      = array();

		foreach ( $all_plugins as $path => $plugins ) {

			$return[] = array(
				'path'    => $path,
				'name'    => $plugins['Name'],
				'version' => $plugins['Version'],
				'author'  => $plugins['Author'],
			);
		}

		return $return;
	}
}
