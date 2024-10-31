<?php

namespace MyMo\Controllers\Backend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;
use MyMo\Models\VideoServers;
use MyMo\Tables\VideoServerTable;

class VideoServersController extends Controller {
	
	public function init() {
		add_action('admin_menu', array($this, 'add_submenu'));
		add_action('wp_ajax_mymo_save_server', array($this, 'save_handle'));
	}
	
	public function save_handle() {
		
		if (!wp_verify_nonce($_POST['mymo_save_server'],'mymo_save_server')) {
			$this->response(__('Sorry, your nonce did not verify.', 'mymo'), 'error');
		}
		
		$id = Request::post('id', null, Request::$INT);
		$name = Request::post('name', null, Request::$TEXT);
		$movie_id = Request::post('movie_id', null, Request::$INT);
		$order = Request::post('order', 1, Request::$INT);
		
		if (empty($name)) {
			$this->response(__('Server name is required', 'mymo'), 'error');
		}
		
		if (empty($order)) {
			$this->response(__('Order is required', 'mymo'), 'error');
		}
		
		if (empty($id)) {
			if (empty($movie_id)) {
				$this->response(__('Movie is required', 'mymo'), 'error');
			}
			
			$movie = get_post($movie_id);
			if (empty($movie) || $movie->post_type != 'movie') {
				$this->response(__('Movie is not exists', 'mymo'), 'error');
			}
		}
		
		$model = VideoServers::first_or_new(['id' => $id]);
		$model->fill(Request::post());
		$model->movie_id = $movie_id;
		$model->save();
		
		$post = $movie_id ? '&post=' . $movie_id : '';
		$this->redirect('edit.php?post_type=movie&page=mymo-server-video' . $post);
	}
	
	public function add_submenu() {
		add_submenu_page(
			null,
			__('Video Servers', 'mymo'),
			__('Video Servers', 'mymo'),
			'manage_options',
			'mymo-server-video',
			array($this, 'view_handle')
		);
	}
	
	public function index_view() {
		$table = new VideoServerTable();
		$table->prepare_items();
		
		$item = new VideoServers();
		$this->view('backend.servers.index', [
			'table' => $table,
			'item' => $item,
		]);
	}
	
	public function edit_view() {
		$item_id = Request::input('item');
		$item = VideoServers::first_or_new(['id' => $item_id]);
		
		$this->view('backend.servers.edit', [
			'item' => $item,
		]);
	}
}