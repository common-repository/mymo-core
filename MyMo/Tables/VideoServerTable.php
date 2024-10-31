<?php

namespace MyMo\Tables;

use MyMo\Helpers\Request;
use MyMo\Models\VideoServers;

if (!class_exists('WP_List_Table' )) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class VideoServerTable extends \WP_List_Table {
	
	public function prepare_items()
	{
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();
		
		$this->handle_table_actions();
		
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
			'movie' => __('Movie', 'mymo'),
			'order'    => __('Order', 'mymo'),
			'status'     => __('Status', 'mymo'),
		);
		
		if (isset($_REQUEST['post'])) {
			unset($columns['movie']);
		}
		
		return $columns;
	}
	
	public function get_hidden_columns()
	{
		return array();
	}
	
	public function get_sortable_columns() {
		return array(
			'name' => array('name', false),
			'order' => array('order', false),
		);
	}
	
	public function column_default($item, $column_name) {
		switch($column_name) {
			case 'cb':
			case 'name':
			case 'order':
			case 'movie':
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
		return $tbprefix . 'video_servers';
	}
	
	protected function column_cb( $item ) {
		return sprintf(
			'<label class="screen-reader-text" for="item_' . $item['id'] . '">' . sprintf( __( 'Select %s', 'mymo' ), $item['name'] ) . '</label>'
			. "<input type='checkbox' name='items[]' id='item_{$item['id']}' value='{$item['id']}' />"
		);
	}
	
	protected function column_name($item) {
		$view_link = $this->get_action_link($item);
		$movie_id    = VideoServers::get_var( ['id' => $item['id']], 'movie_id' );
		
		$actions['edit'] = '<a href="' . $view_link . '&view=edit">' . __( 'Edit', 'mymo') . '</a>';
		$actions['upload_videos'] = '<a href="edit.php?post_type=movie&page=mymo-upload-video&view=index&server='. $item['id'] .'">' . __( 'Add Video', 'mymo') . '</a>';
		$actions['delete'] = '<a href="' . $view_link . '&action=delete">' . __( 'Detele', 'mymo') . '</a>';
		$actions['view'] = '<a href="'. get_permalink($movie_id) .'" target="_blank">' . __( 'View', 'mymo') . '</a>';
		
		$row_value = '<a href="' . $view_link . '&action=edit"><strong>' . $item['name'] . '</strong></a>';
		return $row_value . $this->row_actions( $actions );
	}
	
	protected function handle_table_actions() {
		global $wpdb;
		$the_table_action = $this->current_action();
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		if (in_array($the_table_action, ['enabled', 'disabled'])) {
			$nonce = Request::input('_wpnonce');
			if (!wp_verify_nonce($nonce, 'bulk-' . $this->_args['plural'])) {
				$this->invalid_nonce_redirect();
				exit();
			}
			
			$items = Request::input('items', []);
			$status = $the_table_action == 'enabled' ? 1 : 0;
			
			if ($items && is_array($items)) {
				$sql = "UPDATE {$tbprefix}video_servers SET `status` = %d WHERE id IN (". implode(',', $items) .")";
				$wpdb->query($wpdb->prepare($sql, [$status]));
			}
			
			$this->graceful_exit();
		}
		
		if ($the_table_action == 'delete') {
			$nonce = Request::input('_wpnonce');
			if (!wp_verify_nonce($nonce, 'bulk-' . $this->_args['plural'])) {
				$this->invalid_nonce_redirect();
				exit();
			}
			
			$items = Request::input('items', []);
			$item = Request::input('item');
			if ($item) {
				$items[] = $item;
			}
			
			if ($items && is_array($items)) {
				$sql = "DELETE FROM {$tbprefix}video_servers WHERE id IN (". implode(',', $items) .")";
				$wpdb->query($sql);
			}
		}
	}
	
	protected function table_data() {
		global $wpdb;
		
		$currentPage = $this->get_pagenum();
		$perPage = $this->get_items_per_page('users_per_page');
		$startAt = $perPage * ($currentPage - 1);
		
		$tbtable = $this->get_table();
		$movie_id = Request::input('post', null, Request::$INT);
		$search_key = Request::input('s', null, Request::$TEXT);
		
		$orderby = Request::input('orderby', 'id');
		$order = Request::input('order', 'DESC');
		
		$orderby = '`a`.`' . $orderby . '`';
		
		$query = "SELECT
			`a`.`id`,
			`a`.`name`,
			`a`.`order`,
			`a`.`status`,
			`b`.`post_title` AS `movie`
		FROM `$tbtable` AS a
		JOIN ". $wpdb->prefix ."posts AS b ON b.id = a.movie_id";
		
		$where = [];
		$params = [];
		if ($movie_id) {
			$where[] = "a.movie_id = %d";
			$params[] = $movie_id;
		}
		
		if ($search_key) {
			$where[] = "a.name like %s";
			$params[] = '%'. $search_key .'%';
		}
		
		if ($where) {
			$query .= " WHERE " . implode(' AND ', $where);
		}
		
		$query .= " ORDER BY $orderby $order, `order` ASC";
		$query .= " LIMIT $startAt, $perPage";
		
		if (empty($params)) {
			return $wpdb->get_results($query, ARRAY_A);
		}
		
		return $wpdb->get_results($wpdb->prepare($query, $params), ARRAY_A);
	}
	
	protected function count_data() {
		global $wpdb;
		
		$tbtable = $this->get_table();
		$movie_id = Request::input('post', null, Request::$INT);
		$search_key = Request::input('s', null, Request::$TEXT);
		
		$where = [];
		$params = [];
		$sql = "SELECT COUNT(*) FROM `$tbtable`";
		
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
	
	protected function get_action_link($item) {
		$admin_page_url = admin_url('edit.php');
		
		$query_view = array(
			'post_type'    => Request::input('post_type', null, Request::$TEXT),
			'page'         => Request::input('page', null, Request::$TEXT),
			'item'         => absint($item['id']),
			'_wpnonce' => wp_create_nonce( 'bulk-' . $this->_args['plural'] ),
		);
		
		if (isset($_REQUEST['post'])) {
			$query_view['post'] = Request::input('post', null, Request::$INT);
		}
		
		return esc_url(add_query_arg($query_view, $admin_page_url));
	}
}