<?php

namespace MyMo\Controllers\Backend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;
use MyMo\Models\Movies;
use MyMo\Models\VideoFiles;
use MyMo\Models\VideoServers;
use MyMo\Tables\VideoFilesTable;

class VideoFilesController extends Controller {
	
	protected $prefix = 'movie_page_';
	protected $page = 'mymo-upload-video';
	
	public function init() {
		add_action('admin_menu', array($this, 'add_menu'));
		add_action('wp_ajax_mymo_save_upload', array($this, 'save_handle'));
	}
	
	public function add_menu() {
		add_submenu_page(
			null,
			__('Video Upload', 'mymo'),
			__('Video Upload', 'mymo'),
			'manage_options',
			$this->page,
			array($this, 'view_handle')
		);
	}
	
	public function index_view() {
		$table = new VideoFilesTable();
		$table->prepare_items();
		
		$server_id = Request::input('server');
		$server = VideoServers::find($server_id);
		
		$item_id = Request::input('item', null, Request::$INT);
		$item = VideoFiles::first_or_new(['id' => $item_id]);
		
		$this->view('backend.upload.index', [
			'table' => $table,
			'server' => $server,
			'item' => $item
		]);
	}
	
	public function form_view() {
		$item = Request::input('item');
		$item = VideoFiles::find($item);
		$this->view('backend.upload.form.edit_form', [
			'item' => $item
		]);
	}
	
	public function enabled_action() {
		global $wpdb;
		$nonce = Request::input('_wpnonce');
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		if (!wp_verify_nonce($nonce, 'bulk-' . $this->prefix . $this->page)) {
			$this->invalid_nonce_redirect();
			exit();
		}
		
		$items = Request::input('items', []);
		
		if ($items && is_array($items)) {
			$sql = "UPDATE {$tbprefix}video_files SET `status` = %d WHERE id IN (". implode(',', $items) .")";
			$wpdb->query($wpdb->prepare($sql, [1]));
		}
	}
	
	public function disabled_action() {
		global $wpdb;
		$nonce = Request::input('_wpnonce');
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		if (!wp_verify_nonce($nonce, 'bulk-' . $this->prefix . $this->page)) {
			$this->invalid_nonce_redirect();
			exit();
		}
		
		$items = Request::input('items', []);
		
		if ($items && is_array($items)) {
			$sql = "UPDATE {$tbprefix}video_files SET `status` = %d WHERE id IN (". implode(',', $items) .")";
			$wpdb->query($wpdb->prepare($sql, [0]));
		}
	}
	
	public function delete_action() {
		global $wpdb;
		$nonce = Request::input('_wpnonce');
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		if (!wp_verify_nonce($nonce, 'bulk-' . $this->prefix . $this->page)) {
			$this->invalid_nonce_redirect();
			exit();
		}
		
		$items = Request::input('items', []);
		$item = Request::input('item');
		if ($item) {
			$items[] = $item;
		}
		
		if ($items && is_array($items)) {
			$sql = "DELETE FROM `{$tbprefix}video_files` WHERE id IN (". implode(',', $items) .")";
			$wpdb->query($sql);
		}
	}
	
	public function save_handle() {
		
		if (!wp_verify_nonce($_POST['mymo_save_upload'],'mymo_save_upload')) {
			$this->response(__('Sorry, your nonce did not verify.', 'mymo'), 'error');
		}
		
		$this->validate([
			'label' => 'required',
			'server_id' => 'required',
			'order' => 'required',
		], [
			'label' => __('Label', 'mymo'),
			'server_id' => __('Server', 'mymo'),
			'order' => __('Order', 'mymo'),
		]);
		
		$server_id = Request::post('server_id');
		$server = VideoServers::find($server_id, ['movie_id']);
		if (empty($server)) {
			$this->response(__('Server is not exists', 'mymo'), 'error');
		}
		
		$movie = Movies::find($server->movie_id, ['ID']);
		$model = VideoFiles::first_or_new(['id' => Request::post('id')]);
		$model->fill(Request::post());
		$model->movie_id = $movie->ID;
		$model->server_id = $server_id;
		$model->save();
		
		$this->redirect('edit.php?post_type=movie&page=mymo-upload-video&view=index&server=' . $server_id);
	}
	
	public function get_file_source() {
		$source = [
			'mp4' => __('MP4 From URL', 'mymo'),
			//'webm' => __('WEBM From URL', 'mymo'),
			'm3u8' => __('M3U8 From URL', 'mymo'),
			'gdrive' => __('Google Drive URL', 'mymo'),
			//'upload' => __('Upload Video', 'mymo'),
			'youtube' => 'Youtube',
			'vimeo' => 'Vimeo',
			'embed' => __('Embed URL', 'mymo'),
		];
		
		return apply_filters('mymo_file_source', $source);
	}
	
	public function get_disabled_source() {
		return apply_filters('mymo_disabled_source', ['m3u8', 'gdrive']);
	}
}