<?php

namespace MyMo\Controllers\Backend;

use MyMo\Core\Controller;

class SettingController extends Controller {
	public function init() {
		add_action('wp_ajax_mymo_save_general_setting', [$this, 'save_handle']);
	}
	
	public function display_setting_menu() {
	
	}
	
	public function index_view() {
		$this->view('backend.setting.index');
	}
	
	public function save_handle() {
		if (!wp_verify_nonce($_POST['mymo_save_general_setting'],'mymo_save_general_setting')) {
			mymo_response(__('Sorry, your nonce did not verify.', 'mymo'), 'error');
		}
		
		$settings = [
			'mymo_fb_app_id',
			'mymo_recaptcha',
			'mymo_recaptcha_key',
			'mymo_recaptcha_secret',
			'mymo_comment_type',
		];
		
		foreach ($settings as $setting) {
			update_option($setting, esc_sql($_POST[$setting]));
		}
		
		$this->response(__('Update successfully.'));
	}
}