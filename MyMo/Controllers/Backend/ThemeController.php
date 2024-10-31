<?php

namespace MyMo\Controllers\Backend;

class ThemeController {
	private $plugin_uri;
	
	public function init() {
		$this->plugin_uri = plugins_url('mymo-core');
		add_action('admin_enqueue_scripts', array($this, 'admin_style'));
		add_action('wp_enqueue_scripts', [$this, 'frontend_style'], 11);
		add_action('wp_head', [$this, 'header_script'], 5);
	}
	
	public function admin_style() {
		$styles = [
			'/assets/css/admin-mymo.css',
		];
		
		$scripts = [
			'/assets/js/admin-mymo.js'
		];
		wp_enqueue_media();
		$this->register_style($styles, 'admin');
		$this->register_script($scripts, 'admin');
	}
	
	public function frontend_style() {
		$styles = [
			'/assets/css/frontend-mymo.css'
		];
		
		$scripts = [
			'/assets/js/frontend-mymo.js',
		];
		
		$this->register_style($styles, 'core');
		$this->register_script($scripts, 'core');
	}
	
	public function header_script() {
		include (MYMO_VIEWS_DIRECTORY . '/frontend/header/header_script.php');
	}
	
	protected function register_style($styles, $id) {
		foreach ($styles as $index => $style) {
			wp_register_style( 'mymo-'. $id .'-' . $index, $this->plugin_uri . $style, 'all',MYMO_VERSION);
			wp_enqueue_style('mymo-'. $id .'-' . $index);
		}
	}
	
	protected function register_script($scripts, $id) {
		foreach ($scripts as $index => $script) {
			wp_register_script('mymo-' . $id . '-' . $index, $this->plugin_uri . $script, 'all', MYMO_VERSION);
			wp_enqueue_script('mymo-' . $id . '-' . $index);
		}
	}
}