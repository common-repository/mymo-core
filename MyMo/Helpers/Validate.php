<?php

namespace MyMo\Helpers;

use MyMo\Traits\CheckValidate;

class Validate {
	
	use CheckValidate;
	
	private $rules;
	private $attribute;
	private $message;
	
	/**
	 * Validate Rules
	 *
	 * @param array $rules
	 * @param array $attribute = []
	 * @return \MyMo\Helpers\Validate
	 */
	public static function make(array $rules, $attribute = []) {
		return (new static($rules, $attribute));
	}
	
	public function __construct(array $rules, $attribute = []) {
		$this->rules = $rules;
		$this->attribute = $attribute;
	}
	
	public function validate() {
		foreach ($this->rules as $key => $rule) {
			if (!$this->validate_rule($key, $rule)) {
				return false;
			}
		}
		return true;
	}
	
	public function message() {
		return $this->message;
	}
	
	private function validate_rule($key, $rule) {
		$rules = explode('|', $rule);
		foreach ($rules as $item) {
			if (!$this->check($key, $item)) {
				return false;
			}
		}
		
		return true;
	}
	
	private function check($key, $rule) {
		$method = explode(':', $rule);
		if (method_exists($this, 'check_' . $method[0])) {
			if (!$this->{'check_' . $method[0]}($key, $rule)) {
				return false;
			}
		}
		
		return true;
	}
	
	public static function validate_message() {
		return [
			'required' => __('The :attribute field is required.', 'mymo'),
			'email' => __('The :attribute must be a valid email address.', 'mymo'),
			'in' => __('The :attribute is invalid.', 'mymo'),
		];
	}
}