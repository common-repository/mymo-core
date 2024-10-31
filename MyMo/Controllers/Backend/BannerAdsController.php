<?php

namespace MyMo\Controllers\Backend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;
use MyMo\Models\BannerAds;
use MyMo\Tables\BannerAdsTable;

class BannerAdsController extends Controller {
	
	public function init() {
		add_action('wp_ajax_mymo_save_banner', [$this, 'save_handle']);
	}
	
	public function index_view() {
		$table = new BannerAdsTable();
		$table->prepare_items();
		
		$this->view('backend.banner.index', [
			'table' => $table,
		]);
	}
	
	public function form_view() {
		$item = Request::get('item');
		$item = BannerAds::find($item);
		
		$this->view('backend.banner.form', [
			'item' => $item,
		]);
	}
	
	public function save_handle() {
		if (!wp_verify_nonce($_POST['mymo_save_banner'],'mymo_save_banner')) {
			$this->response(__('Sorry, your nonce did not verify.', 'mymo'), 'error');
		}
		
		$this->validate([
			'id' => 'required',
		], [
			'id' => __('Name position', 'mymo'),
		]);
		
		$model = BannerAds::find(Request::post('id'));
		$model->fill(Request::post());
		$model->save();
		
		$this->redirect('admin.php?page=mymo-banner');
	}
}