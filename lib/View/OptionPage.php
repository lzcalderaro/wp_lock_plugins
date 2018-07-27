<?php

/**
 * Option Page view
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\View;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class OptionPage {

	/**
	 * View to list all plugins.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function wp_lock_page() {

		$list_table = new ViewListPlugins();
		$list_table->prepare_items();

		?>
			<div class="wrap">
				<div id="icon-users" class="icon32"></div>
				<h2>Lock Plugins</h2>
				<?php $list_table->display(); ?>
			</div>
		<?php
	}
}
