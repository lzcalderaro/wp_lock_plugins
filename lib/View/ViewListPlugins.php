<?php

/**
 * Manage all plugins.
 *
 * @link       https://github.com/lzcalderaro/wp_lock_plugins
 * @since      1.0.0
 *
 * @package    Lock Plugins
 */

namespace LockPlugins\View;

use LockPlugins\Utils\GetPlugins;
use WP_List_Table;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lock Plugins
 * @author     Luiz Calderaro <lzcalderaro@gmail.com>
 */
class ViewListPlugins extends WP_List_Table {

	/**
	 * Prepare the items for the table to process.
	 *
	 * @since  1.0.0
	 * @return Void
	 */
	public function prepare_items() {

		$columns  = $this->get_columns();
		$hidden   = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();
		$data     = $this->table_data();

		usort( $data, array( &$this, 'sort_data' ) );

		$per_page = 20;
		$current_page = $this->get_pagenum();
		$total_items = count( $data );

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
		) );

		$data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );

		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->items           = $data;
	}

	/**
	 * Override the parent columns method. Defines the columns to use in your listing table
	 *
	 * @return Array
	 */
	public function get_columns() {

		$columns = array(
			'status'  => 'status',
			'plugin'  => 'Plugin',
			'version' => 'Version',
			'author'  => 'Author',
		);

		return $columns;
	}

	/**
	 * Define which columns are hidden
	 *
	 * @return Array
	 */
	public function get_hidden_columns() {
		return array();
	}

	/**
	 * Define the sortable columns.
	 *
	 * @return Array
	 */
	public function get_sortable_columns() {

		return array(
			'plugin' => array(
				'plugin',
				false,
			),
		);
	}
	/**
	 * Get the table data.
	 *
	 * @since  1.0.0
	 * @return Array
	 */
	private function table_data() {

		$data    = array();
		$plugins = GetPlugins::get_all_plugins();

		foreach ( $plugins as $plugin ) {

			$data[] = array(
				'status'  => 'status',
				'plugin'  => $plugin['name'],
				'version' => $plugin['version'],
				'author'  => $plugin['author'],
			);
		}

		return $data;
	}
	/**
	 * Define what data to show on each column of the table
	 *
	 * @since  1.0.0
	 * @param  Array $item        Data
	 * @param  String $column_name - Current column name
	 *
	 * @return Mixed
	 */
	public function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'plugin':
			case 'version':
			case 'author':
			case 'status':
				return $item[ $column_name ];
			default:
				return print_r( $item, true );
		}
	}

	/**
	 * Allows you to sort the data by the variables set in the $_GET.
	 *
	 * @since  1.0.0
	 * @return Mixed
	 */
	private function sort_data( $a, $b ) {

		// Set defaults
		$orderby = 'plugin';
		$order   = 'asc';

		// If orderby is set, use this as the sort column
		if ( ! empty( $_GET['orderby'] ) ) {
			$orderby = $_GET['orderby'];
		}

		// If order is set use this as the order
		if ( ! empty( $_GET['order'] ) ) {
			$order = $_GET['order'];
		}

		$result = strcmp( $a [ $orderby ], $b [ $orderby ] );

		if ( $order === 'asc' ) {
			return $result;
		}

		return - $result;
	}
}
