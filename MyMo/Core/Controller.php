<?php

namespace MyMo\Core;

use MyMo\Helpers\Request;
use MyMo\Helpers\Validate;

class Controller {
	
	protected $path_view = MYMO_VIEWS_DIRECTORY;
	
	public function view_handle() {
		$this->action_handle();
		
		$view = Request::input('view');
		
		if ($view && method_exists($this, $view . '_view')) {
			return $this->{$view . '_view'}();
		}
		
		return $this->index_view();
	}
	
	public function action_handle() {
		$action = $this->current_action();
		if ($action && method_exists($this, $action . '_action')) {
			$this->{$action . '_action'}();
		}
	}
	
	protected function validate(array $rules, $attribute = []) {
		$validate = Validate::make($rules, $attribute);
		if (!$validate->validate()) {
			$this->response($validate->message(), 'error');
		}
	}
	
	protected function current_action() {
		if ( isset( $_REQUEST['filter_action'] ) && ! empty( $_REQUEST['filter_action'] ) ) {
			return false;
		}
		
		if ( isset( $_REQUEST['doaction2'] ) && isset( $_REQUEST['action2'] ) && -1 != $_REQUEST['action2'] ) {
			return sanitize_text_field($_REQUEST['action2']);
		}
		
		if ( isset( $_REQUEST['action'] ) && -1 != $_REQUEST['action'] ) {
			return sanitize_text_field($_REQUEST['action']);
		}
		
		return false;
	}
	
	protected function response($message, $status = 'success') {
		header( 'Content-Type: application/json' );
		echo json_encode([
			'status' => $status,
			'message' => $message
		]);
		die();
	}
	
	protected function redirect($url) {
		header( 'Content-Type: application/json' );
		echo json_encode([
			'status' => 'success',
			'redirect' => $url
		]);
		die();
	}
	
	protected function view($view, $params = []) {
		if(!empty($params)) {
			extract($params);
		}
		
		include $this->path_view . '/'. str_replace('.', '/', $view) .'.php';
	}
	
}