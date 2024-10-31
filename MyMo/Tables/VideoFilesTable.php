<?php

namespace MyMo\Tables;

use MyMo\Helpers\Request;
use MyMo\Models\VideoFiles;

if (!class_exists('WP_List_Table' )) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class VideoFilesTable extends \WP_List_Table {
	
	public function prepare_items() {
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
	
	public function get_columns() {
		$columns = array(
			'cb'       => '<input type="checkbox" />',
			'label'     => __( 'Lable', 'mymo' ),
			'source'     => __( 'Source', 'mymo' ),
			'url'     => __( 'Url', 'mymo' ),
			'order'    => __('Order', 'mymo'),
			'status'     => __('Status', 'mymo'),
		);
		
		return $columns;
	}
	
	public function get_hidden_columns() {
		return array();
	}
	
	public function get_sortable_columns() {
		return array('label' => array('label', false));
	}
	
	public function column_default($item, $column_name )
	{
		switch($column_name) {
			case 'cb':
			case 'label':
			case 'source':
			case 'url':
			case 'order':
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
			'enabled' => 'Enabled',
			'disabled' => 'Disabled',
		);
		return $actions;
	}
	
	protected function get_table() {
		global $wpdb;
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		return $tbprefix . 'video_files';
	}
	
	protected function table_data() {
		global $wpdb;
		$currentPage = $this->get_pagenum();
		$perPage = $this->get_items_per_page('users_per_page');
		$startAt = $perPage * ($currentPage - 1);
		
		$dbtable = $this->get_table();
		$server_id = Request::input('server', null, Request::$INT);
		$search_key = Request::input('s', null, Request::$TEXT);
		
		$orderby = Request::input('orderby', 'order', Request::$TEXT);
		$order = Request::input('order', 'ASC', Request::$TEXT);
		
		$query = "SELECT
			`id`,
			`label`,
			`source`,
			`url`,
			`order`,
			`status`
		FROM $dbtable";
		
		$where = [];
		$params = [];
		if ($server_id) {
			$where[] = "server_id = %d";
			$params[] = $server_id;
		}
		
		if ($search_key) {
			$where[] = "name like %s";
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
		$dbtable = $this->get_table();
		$movie_id = Request::input('post');
		$search_key = Request::input('s');
		
		$where = [];
		$params = [];
		$sql = "SELECT COUNT(*) FROM $dbtable";
		
		if ($movie_id) {
			$where[] = "movie_id = %d";
			$params[] = $movie_id;
		}
		
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
			'<label class="screen-reader-text" for="item_' . $item['id'] . '">' . sprintf( __( 'Select %s', 'mymo' ), $item['label'] ) . '</label>'
			. "<input type='checkbox' name='items[]' id='item_{$item['id']}' value='{$item['id']}' />"
		);
	}
	
	protected function column_label($item) {
		$admin_page_url = admin_url('edit.php');
		
		$query_view = array(
			'post_type' => Request::input('post_type'),
			'page'      => Request::input('page'),
			'view'      => Request::input('view'),
			'server'    => Request::input('server', null, Request::$INT),
			'item'      => $item['id'],
		);
		
		$query_action = array(
			'post_type' => Request::input('post_type'),
			'page'      => Request::input('page'),
			'view'      => Request::input('view'),
			'server'    => Request::input('server', null, Request::$INT),
			'item'      => $item['id'],
			'_wpnonce'  => wp_create_nonce( 'bulk-' . $this->_args['plural']),
		);
		
		$view_link   = esc_url( add_query_arg( $query_view, $admin_page_url ) );
		$action_link = esc_url( add_query_arg( $query_action, $admin_page_url ) );
		
		unset($query_view['item']);
		$query_view['page'] = 'mymo-subtitle';
		$query_view['file'] = $item['id'];
		$subtitle_link = esc_url( add_query_arg( $query_view, $admin_page_url ) );
		$movie_id    = VideoFiles::get_var( ['id' => $item['id']], 'movie_id' );
		
		$actions['edit'] = '<a href="' . $view_link . '&view=form">' . __( 'Edit', 'mymo') . '</a>';
		$actions['delete'] = '<a href="' . $action_link . '&action=delete">' . __( 'Detele', 'mymo') . '</a>';
		$actions['view'] = '<a href="'. get_permalink($movie_id) .'?view='. $item['id'] .'" target="_blank">' . __( 'View', 'mymo') . '</a>';
		$actions['addsubtitle'] = '<a href="' . $subtitle_link .'">' . __( 'Add Subtitle', 'mymo') . '</a>';
		
		$row_value = '<strong><a href="' . $view_link . '&view=form">' . $item['label'] . '</a></strong>';
		return $row_value . $this->row_actions( $actions );
	}
	
}