<?php

namespace MyMo\Controllers\Backend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;
use MyMo\Models\Sliders;
use MyMo\Tables\SlidersTable;

class SlidersController extends Controller {
	
	public function init() {
		add_action('widgets_init', [$this, 'create_widget']);
		add_action('wp_ajax_mymo_save_slider', [$this, 'save_handle']);
	}
	
	public function index_view() {
		$table = new SlidersTable();
		$table->prepare_items();
		
		$this->view('backend.sliders.index', [
			'table' => $table,
		]);
	}
	
	public function form_view() {
		$item = Request::get('item');
		$item = Sliders::first_or_new(['id' => $item]);
		$banners = json_decode($item->content);
		
		$this->view('backend.sliders.form', [
			'item' => $item,
			'banners' => $banners,
		]);
	}
	
	public function save_handle() {
		if (!wp_verify_nonce($_POST['mymo_save_slider'],'mymo_save_slider')) {
			$this->response(__('Sorry, your nonce did not verify.', 'mymo'), 'error');
		}
		
		$this->validate([
			'name' => 'required',
		], [
			'name' => __('Slider Name', 'mymo'),
		]);
		
		$model = Sliders::first_or_new(['id' => Request::post('id')]);
		$model->fill(Request::post());
		
		$content = [];
		$title = Request::post('title', [], Request::$TEXT);
		$description = Request::post('description', [], Request::$TEXTAREA);
		$url = Request::post('url', [], Request::$URL);
		$banner = Request::post('banner', [], Request::$INT);
		
		if ($title) {
			foreach ($title as $index => $item) {
				$content[] = [
					'title' => $item,
					'description' => $description[$index],
					'url' => $url[$index],
					'banner' => $banner[$index],
				];
			}
		}
		
		$model->content = json_encode($content);
		$model->save();
		$this->redirect('admin.php?page=mymo-slider');
	}
	
	public function delete_action() {
		global $wpdb;
		$tbprefix = $wpdb->prefix . MYMO_PREFIX;
		
		$items = Request::input('items', []);
		$item = Request::input('item');
		if ($item) {
			$items[] = $item;
		}
		
		if ($items && is_array($items)) {
			$sql = "DELETE FROM `{$tbprefix}sliders` WHERE id IN (". implode(',', $items) .")";
			$wpdb->query($sql);
		}
	}
	
	public function create_widget() {
		register_widget('MyMo\Widgets\Slider');
	}
}