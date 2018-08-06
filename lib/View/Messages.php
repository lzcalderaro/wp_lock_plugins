<?php

/**
 * Manage all messages.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\View;

/**
 * Manage all messages.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class Messages {

	/**
	 * Message to lock plugin.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function throw_messages() {

		if ( empty( $_GET['lock_plugins'] ) ) {
			return;
		}

		$message = '';
		switch ( $_GET['lock_plugins'] ) {
			case 1:
				$message = __( 'Plugin locked', 'lock-plugins' );
			break;
		}

		printf(
			'<div class="notice notice-error is-dismissible">
			<strong>%s</strong>
			</div>',
			$message
		);
	}
}
