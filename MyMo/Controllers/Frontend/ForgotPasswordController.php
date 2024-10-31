<?php

namespace MyMo\Controllers\Frontend;

class ForgotPasswordController {
	public function init() {
		add_action("wp_ajax_mymo_forgot_password", [$this, 'handle']);
	}
	
	public function handle() {
		$email = $_POST['email'];
		
		$user = get_user_by( 'user_email', trim( $email ) );
		if (empty($user)) {
			$this->response(__('Email not exists.', 'mymo'), 'error');
		}
		
		$key = get_password_reset_key( $user );
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		$title = sprintf( __('[%s] Password Reset', 'mymo'), $blogname );
		
		$message = __('Someone requested that the password be reset for the following account:', 'mymo') . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf(__('Username: %s', 'mymo'), $user->user_login) . "\r\n\r\n";
		$message .= __('If this was a mistake, just ignore this email and nothing will happen.', 'mymo') . "\r\n\r\n";
		$message .= __('To reset your password, visit the following address:', 'mymo') . "\r\n\r\n";
		$message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login');
		
		if (!wp_mail($user->user_email, $title, $message)) {
			$this->response(__('The e-mail could not be sent.', 'mymo'), 'error');
		}
		
		$this->response(__('Link for password reset has been emailed to you. Please check your email.', 'mymo'));
	}
}