<?php

/**
 * Option Page view.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\View;

/**
 * Option Page view
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
		<form method="POST" action="<?php echo admin_url( 'admin-post.php' ); ?>">
			<div class="wrap">
				<div id="icon-users" class="icon32"></div>
				<h2>Lock Plugins</h2>
				<?php $list_table->display(); ?>
			</div>
			<input type="hidden" name="action" value="save_lock_plugins" >
			<?php echo submit_button( 'Save' ); ?>
		</form>
		<?php
	}
}
