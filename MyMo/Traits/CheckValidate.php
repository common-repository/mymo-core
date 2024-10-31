<?php

namespace MyMo\Traits;

use MyMo\Helpers\Request;

trait CheckValidate {
	
	private function make_message($key, $rule) {
		return str_replace(':attribute', (isset($this->attribute[$key]) ? $this->attribute[$key] : ucfirst(str_replace(['_', '-'], ' ', $key))), static::validate_message()[$rule]);
	}
	
	private function check_required($key, $rule) {
		if (!isset($_REQUEST[$key])) {
			return false;
		}
		
		if ($_REQUEST[$key] === null) {
			$this->message = $this->make_message($key, $rule);
			return false;
		}
		
		return true;
	}
	
	private function check_email($key, $rule) {
		$val = Request::input($key);
		if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
			$this->message = $this->make_message($key, $rule);
			return true;
		}
		return false;
	}
	
	private function check_in($key, $rule) {
		$val = Request::input($key);
		$rule = explode(':', $rule);
		if (in_array($val, explode(',', $rule[1]))) {
			$this->message = $this->make_message($key, $rule);
			return true;
		}
		return false;
	}
}