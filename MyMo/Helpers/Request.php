<?php

namespace MyMo\Helpers;

class Request {
	
	public static $TEXT = 'text';
	public static $INT = 'int';
	public static $TEXTAREA = 'textarea';
	public static $FLOAT = 'float';
	public static $URL = 'url';
	public static $EMAIL = 'email';
	
	public static function get($key = null, $default = null, $type = 'text') {
		if ($key) {
			
			if (isset($_GET[$key])) {
				return esc_sql(static::sanitize($_GET[$key], $type));
			}
			
			return $default;
		}
		
		return esc_sql($_GET);
	}
	
	public static function post($key = null, $default = null, $type = 'text') {
		if ($key) {
			
			if (isset($_POST[$key])) {
				return esc_sql(self::sanitize($_POST[$key], $type));
			}
			
			return $default;
		}
		
		return esc_sql($_POST);
	}
	
	public static function input($key = null, $default = null, $type = 'text') {
		if ($key) {
			if (isset($_REQUEST[$key])) {
				return esc_sql(self::sanitize($_REQUEST[$key], $type));
			}
			
			return $default;
		}
		
		return esc_sql($_REQUEST);
	}
	
	public static function sanitize($val, $type = 'text') {
		if (is_array($val)) {
			foreach ($val as $key => $item) {
				$val[$key] = self::sanitize($item, $type);
			}
			
			return $val;
		}
		
		return self::sanitize_val($val, $type);
	}
	
	protected static function sanitize_val($val, $type = 'text') {
		switch ($type) {
			case 'text': return sanitize_text_field($val);
			case 'textarea'; return sanitize_textarea_field($val);
			case 'ini'; return intval($val);
			case 'float'; return floatval($val);
			case 'url'; return esc_url($val);
			case 'email'; return sanitize_email($val);
		}
		
		return sanitize_text_field($val);
	}
}