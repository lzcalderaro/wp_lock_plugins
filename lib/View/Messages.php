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

		if ( empty( $_GET['lock_message'] ) ) {
			return;
		}

		$message = '';
		$status  = 'error';

		switch ( $_GET['lock_message'] ) {
			case 1:
				$message = __( 'Plugin locked', 'wp_lock_plugins' );
			break;
			case 2:
				$message = __( 'Saved successfully', 'wp_lock_plugins' );
				$status = 'success';
			break;
			case 3:
				$message = __( 'Error saving', 'wp_lock_plugins' );
			break;
		}

		printf(
			'<div class="notice notice-%s is-dismissible">
			<p><strong>%s</strong></p>
			</div>',
			$status,
			$message
		);
	}
}
