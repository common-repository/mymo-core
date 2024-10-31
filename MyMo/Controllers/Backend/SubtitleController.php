<?php

namespace MyMo\Controllers\Backend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;
use MyMo\Models\Subtitle;
use MyMo\Tables\SubtitleTable;

class SubtitleController extends Controller {
	protected $prefix = 'movie_page_';
	protected $page = 'mymo-subtitle';
	
	public function init() {
		add_action('admin_menu', [$this, 'add_menu']);
		add_action('wp_ajax_mymo_save_subtitle', [$this, 'save_handle']);
	}
	
	public function add_menu() {
		add_submenu_page(
			null,
			__('Video Upload', 'mymo'),
			__('Video Upload', 'mymo'),
			'manage_options',
			'mymo-subtitle',
			[$this, 'view_handle']
		);
	}
	
	public function index_view() {
		$file_id = Request::get('file');
		$item = new Subtitle();
		
		$table = new SubtitleTable();
		$table->prepare_items();
		
		$this->view('backend.subtitle.index', [
			'file_id' => $file_id,
			'table' => $table,
			'item' => $item,
		]);
	}
	
	public function edit_view() {
		$file_id = Request::get('file');
		$item_id = Request::get('item');
		$item = Subtitle::first_or_new(['id' => $item_id]);
		
		$this->view('backend.subtitle.edit', [
			'file_id' => $file_id,
			'item' => $item,
		]);
	}
	
	public function enabled_action() {
		global $wpdb;
		$nonce = Request::input('_wpnonce');
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		if (!wp_verify_nonce($nonce, 'bulk-' . $this->prefix . $this->page)) {
			die('Verify nonce error');
		}
		
		$items = Request::input('items', []);
		
		if ($items && is_array($items)) {
			$sql = "UPDATE `{$tbprefix}video_files_subtitle` SET `status` = %d WHERE `id` IN (". implode(',', $items) .")";
			$wpdb->query($wpdb->prepare($sql, [1]));
		}
	}
	
	public function disabled_action() {
		global $wpdb;
		$nonce = Request::input('_wpnonce');
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		if (!wp_verify_nonce($nonce, 'bulk-' . $this->prefix . $this->page)) {
			die('Verify nonce error');
		}
		
		$items = Request::input('items', []);
		
		if ($items && is_array($items)) {
			$sql = "UPDATE {$tbprefix}video_files_subtitle SET `status` = %d WHERE id IN (". implode(',', $items) .")";
			$wpdb->query($wpdb->prepare($sql, [0]));
		}
	}
	
	public function delete_action() {
		global $wpdb;
		$nonce = Request::input('_wpnonce');
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		if (!wp_verify_nonce($nonce, 'bulk-' . $this->prefix . $this->page)) {
			die('Verify nonce error');
		}
		
		$items = Request::input('items', []);
		$item = Request::input('item');
		if ($item) {
			$items[] = $item;
		}
		
		if ($items && is_array($items)) {
			$sql = "DELETE FROM `{$tbprefix}video_files_subtitle` WHERE id IN (". implode(',', $items) .")";
			$wpdb->query($sql);
		}
	}
	
	public function save_handle() {
		$this->validate([
			'label' => 'required',
			'url' => 'required',
			'order' => 'required',
			'status' => 'required|in:0,1',
		], [
			'label' => __('Label', 'mymo'),
			'url' => __('Url Subtitle', 'mymo'),
			'order' => __('Order', 'mymo'),
			'status' => __('Status', 'mymo'),
		]);
		
		if (!wp_verify_nonce($_POST['mymo_save_subtitle'],'mymo_save_subtitle')) {
			$this->response(__('Sorry, your nonce did not verify.', 'mymo'), 'error');
		}
		
		$file_id = Request::post('file_id');
		$model = Subtitle::first_or_new(['id' => Request::post('id')]);
		$model->fill(Request::post());
		$model->video_file_id = $file_id;
		$model->save();
		
		$this->redirect('edit.php?post_type=movie&page=mymo-subtitle&file=' . $file_id);
	}
}