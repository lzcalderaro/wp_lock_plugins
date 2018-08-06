<?php

/**
 * List all plugins info.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\Utils;

/**
 * List all plugins info.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class GetPlugins {

	/**
	 * List all plugins to lock.
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
