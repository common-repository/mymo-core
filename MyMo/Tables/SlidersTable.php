<?php

namespace MyMo\Tables;

use MyMo\Helpers\Request;

if (!class_exists('WP_List_Table' )) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class SlidersTable extends \WP_List_Table {
	
	public function prepare_items()
	{
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();
		
		$perPage = $this->get_items_per_page('users_per_page');
		$data = $this->table_data();
		$totalItems = $this->count_data();
		
		$this->set_pagination_args( array(
			'total_items' => $totalItems,
			'per_page'    => $perPage
		) );
		
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $data;
	}
	
	public function get_columns()
	{
		$columns = array(
			'cb'       => '<input type="checkbox" />',
			'name'     => __( 'Name', 'mymo' ),
		);
		
		return $columns;
	}
	
	public function get_hidden_columns()
	{
		return array();
	}
	
	public function get_sortable_columns() {
		return array('name' => array('name', false));
	}
	
	public function column_default($item, $column_name )
	{
		switch($column_name) {
			case 'cb':
			case 'name':
				return $item[$column_name];
			case 'status':
				return $item[$column_name] == 1 ? __('Enabled', 'mymo') : __('Disabled', 'mymo');
			default:
				return print_r( $item, true ) ;
		}
	}
	
	public function get_bulk_actions() {
		$actions = array(
			'delete' => 'Delete',
		);
		return $actions;
	}
	
	protected function table_data() {
		global $wpdb;
		$table_prefix = $wpdb->prefix . MYMO_PREFIX;
		$currentPage = $this->get_pagenum();
		$perPage = $this->get_items_per_page('users_per_page');
		$startAt = $perPage * ($currentPage - 1);
		
		$wpdb_table = $table_prefix . 'sliders';
		$search_key = Request::input('s');
		
		$orderby = Request::get('orderby', 'id');
		$order = Request::get('order', 'DESC');
		
		$query = "SELECT
			`id`,
			`name`
		FROM $wpdb_table";
		
		$where = [];
		$params = [];
		
		if ($search_key) {
			$where[] = "`name` like %s";
			$params[] = '%'. $search_key .'%';
		}
		
		if ($where) {
			$query .= " WHERE " . implode(' AND ', $where);
		}
		
		$query .= " ORDER BY `$orderby` $order";
		$query .= " LIMIT $startAt, $perPage";
		
		if (empty($params)) {
			return $wpdb->get_results($query, ARRAY_A);
		}
		
		return $wpdb->get_results($wpdb->prepare($query, $params), ARRAY_A);
	}
	
	protected function count_data() {
		global $wpdb;
		$table_prefix = $wpdb->prefix . MYMO_PREFIX;
		$wpdb_table = $table_prefix . 'sliders';
		$search_key = Request::input('s');
		
		$where = [];
		$params = [];
		$sql = "SELECT COUNT(id) FROM $wpdb_table";
		
		if ($search_key) {
			$where[] = "name like %s";
			$params[] = '%'. $search_key .'%';
		}
		
		if ($where) {
			$sql .= " WHERE " . implode(' AND ', $where);
		}
		
		if (empty($params)) {
			return $wpdb->get_var($sql);
		}
		
		return $wpdb->get_var($wpdb->prepare($sql, $params));
	}
	
	protected function column_cb($item) {
		return sprintf(
			'<label class="screen-reader-text" for="item_' . $item['id'] . '">' . sprintf( __( 'Select %s', 'mymo' ), $item['name'] ) . '</label>'
			. "<input type='checkbox' name='items[]' id='item_{$item['id']}' value='{$item['id']}' />"
		);
	}
	
	protected function column_name($item) {
		$admin_page_url = admin_url('admin.php');
		
		$args_view = array(
			'page'      => Request::input('page'),
			'item'      => absint($item['id']),
		);
		
		$args_action = array(
			'page'      => Request::input('page'),
			'item'      => absint($item['id']),
			'_wpnonce'  => wp_create_nonce( 'bulk-' . $this->_args['plural']),
		);
		
		$view_link = esc_url(add_query_arg($args_view, $admin_page_url));
		$action_link = esc_url(add_query_arg($args_action, $admin_page_url));
		
		$actions['edit'] = '<a href="' . $view_link . '&view=form">' . __( 'Edit', 'mymo') . '</a>';
		$actions['delete'] = '<a href="' . $action_link . '&action=delete">' . __( 'Detele', 'mymo') . '</a>';
		
		$row_value = '<strong><a href="' . $view_link . '&view=form">' . $item['name'] . '</a></strong>';
		return $row_value . $this->row_actions( $actions );
	}
}