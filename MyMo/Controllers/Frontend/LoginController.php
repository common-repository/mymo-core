<?php

namespace MyMo\Controllers\Frontend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;

class LoginController extends Controller {
	public function init() {
		add_action("wp_ajax_nopriv_mymo_login", [$this, 'login_handle']);
	}
	
	public function login_handle() {
		$this->validate([
			'email' => 'required',
			'password' => 'required',
		], [
			'email' => __('Email', 'mymo'),
			'password' => __('Password', 'mymo'),
		]);
		
		$email = Request::post('email', '', Request::$TEXT);
		$username = $email;
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$user = get_user_by('email', $email);
			if ($user) {
				$username = $user->user_login;
			}
			else {
				$this->response(__('Wrong username or password.', 'mymo'), 'error');
			}
		}
		
		$info = [];
		$info['user_login'] = $username;
		$info['user_password'] = $_POST['password'];
		$info['remember'] = true;
		
		$user_signon = wp_signon($info, false);
		if (is_wp_error($user_signon) ){
			$this->response(__('Wrong username or password.', 'mymo'), 'error');
		}
		
		$this->response(__('Login successful, redirecting...', 'mymo'));
	}
}