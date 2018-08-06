<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class Plugin {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $pluginname    The string used to uniquely identify this plugin.
	 */
	protected $name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $name, $version ) {
		$this->name    = $name;
		$this->version = $version;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->set_admin_hooks();
	}

	/**
	 * Set all hooks.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	private function set_admin_hooks() {
		add_action( 'admin_menu', array( $this, 'options_page' ) );
		add_action( 'admin_post_save_lock_plugins', array( Requests\LockPlugins::class, 'save_plugin_list' ) );
		add_action( 'deactivated_plugin', array( Requests\LockPlugins::class, 'remove_disable' ) );
		add_action( 'activate_plugin', array( Requests\LockPlugins::class, 'remove_disable' ), 10, 1 );
		add_action( 'admin_notices', array( View\Messages::class, 'throw_messages' ) );
	}

	/**
	 * Set method to add options page.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function options_page() {

		$options_page = new View\OptionPage();

		add_options_page(
			__( 'Lock Plugins', 'wp_lock_plugins' ),
			__( 'Lock Plugins', 'wp_lock_plugins' ),
			'manage_options',
			'wp_lock_plugins.php',
			array( $options_page, 'wp_lock_page' )
		);
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new I18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );
		$plugin_i18n->load_plugin_textdomain();
	}
}
