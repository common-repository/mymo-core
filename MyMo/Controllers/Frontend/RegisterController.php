<?php

namespace MyMo\Controllers\Frontend;

use MyMo\Core\Controller;

class RegisterController extends Controller {
	public function init() {
		add_action("wp_ajax_nopriv_mymo_register", [$this, 'register_handle']);
	}
	
	public function register_handle() {
		$name = stripcslashes($_POST['name']);
		$username = stripcslashes($_POST['username']);
		$email = stripcslashes($_POST['email']);
		$password = $_POST['new_user_password'];
		$user_data = [
			'user_login' => $username,
			'user_email' => $email,
			'user_pass' => $password,
			'user_nicename' => $name,
			'display_name' => $name,
			'role' => 'subscriber'
		];
		
		$user_id = wp_insert_user($user_data);
		if (!is_wp_error($user_id)) {
			wp_set_current_user($user_id, $username);
			wp_set_auth_cookie($user_id);
			do_action('wp_login', $username);
			
			$this->response(__('Register successful, redirecting...', 'mymo'));
		}
		
		if (isset($user_id->errors['empty_user_login'])) {
			$this->response(__('User Name and Email is required.', 'mymo'), 'error');
		}
		
		if (isset($user_id->errors['existing_user_login'])) {
			$this->response(__('User name already exixts.', 'mymo'), 'error');
		}
		
		if (isset($user_id->errors['existing_user_email'])) {
			$this->response(__('Sorry, that email address is already used!', 'mymo'), 'error');
		}
		
		$this->response(__('Error Occured please fill up the sign up form carefully.', 'mymo'), 'error');
	}
}