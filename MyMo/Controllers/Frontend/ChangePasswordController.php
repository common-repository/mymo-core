<?php

namespace MyMo\Controllers\Frontend;

use MyMo\Core\Controller;

class ChangePasswordController  extends Controller {
	public function init() {
		add_action("wp_ajax_mymo_change_password", [$this, 'handle']);
	}
	
	public function handle() {
		global $current_user;
		$current_password = $_POST['current_password'];
		$password = $_POST['password'];
		$password_confirmation = $_POST['password_confirmation'];
		
		if (empty($current_password) || empty($password)) {
			$this->response(__('Please enter Current password and New password', 'mymo'), 'error');
		}
		
		if (!$current_user || !wp_check_password($current_password, $current_user->user_pass, $current_user->ID)) {
			$this->response(__('Current password incorrect', 'mymo'), 'error');
		}
		
		if ($password != $password_confirmation) {
			$this->response(__('Password and password confirmation don\'t match', 'mymo'), 'error');
		}
		
		wp_set_password($password, $current_user->ID);
		
		$this->response('Change password successfully.');
	}
}