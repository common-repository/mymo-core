<?php

namespace MyMo\Widgets;

use MyMo\Helpers\Request;

class PopularMovies extends \WP_Widget {
	public function __construct() {
		parent::__construct(
			'mymo_popular_movies',
			'MyMo Popular Movies',
			array( 'description'  =>  'Widget show Popular Movies in Sidebar')
		);
	}
	
	public function form($instance) {
		$default = [
			'title' => '',
			'post_number' => 10,
			'tablist' => 'day,week,month,all',
		];
		
		$instance = wp_parse_args( (array) $instance, $default);
		$title = esc_attr($instance['title']);
		$post_number = esc_attr($instance['post_number']);
		$tablist = explode(',', $instance['tablist']);
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/popular_movies/form.php');
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = Request::sanitize($new_instance['title']);
		$instance['post_number'] = Request::sanitize($new_instance['post_number'], Request::$INT);
		$instance['tablist'] = implode(',', $new_instance['tablist']);
		
		return $instance;
	}
	
	public function widget($args, $instance ) {
		extract($args);
		$title = esc_attr($instance['title']);
		$post_number = esc_attr($instance['post_number']);
		$tablist = explode(',', $instance['tablist']);
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/popular_movies/widget.php');
	}
}