<?php

namespace MyMo\Controllers\Frontend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;

class SearchController extends Controller {
	public function init() {
		add_filter('mymo_search_url', [$this, 'search_url']);
		add_action('mymo_search_input_name', [$this, 'search_input_name']);
		add_action('mymo_ajax_filter', [$this, 'ajax_filter_button']);
		
		add_action("wp_ajax_mymo_ajax_search", [$this, 'ajax_search_handle']);
		add_action("wp_ajax_nopriv_mymo_ajax_search", [$this, 'ajax_search_handle']);
		
		add_action("wp_ajax_mymo_ajax_filter", [$this, 'ajax_filter_form']);
		add_action("wp_ajax_nopriv_mymo_ajax_filter", [$this, 'ajax_filter_form']);
	}
	
	public function search_input_name($name) {
		$args = [
			'meta_key' => '_wp_page_template',
			'meta_value' => 'mymo-core/search.php',
			'number'       => 1,
		];
		$templates = get_pages($args);
		
		if (empty($templates)) {
			return $name;
		}
		
		return 'q';
	}
	
	public function search_url($url) {
		$args = [
			'meta_key' => '_wp_page_template',
			'meta_value' => 'mymo-core/search.php',
			'number'       => 1,
		];
		$templates = get_pages($args);
		
		if (empty($templates)) {
			return $url;
		}
		
		return get_permalink($templates[0]->ID);
	}
	
	public function ajax_filter_button() {
		$this->view('frontend.filter.ajax_filter');
	}
	
	public function ajax_search_handle() {
		$keyword = Request::input('q', '', Request::$TEXT);
		$args = [
			'post_type' => 'movie',
			'meta_query' => [
				'relation' => 'OR',
				[
					'key'     => 'search_title',
					'value'   => $keyword,
					'compare' => 'LIKE',
				],
				[
					'key'     => 'other_name',
					'value'   => $keyword,
					'compare' => 'LIKE',
				]
			]
		];
		
		$query = new \WP_Query($args);
		$items = $query->get_posts();
		
		$this->view('frontend.items.search_item', [
			'items' => $items,
			'keyword' => $keyword,
		]);
		die();
	}
	
	public function ajax_filter_form() {
		$this->view('frontend.filter.form');
		die();
	}
}