<?php

namespace MyMo\Controllers\Backend;

class SliderMoviesController {
	public function init() {
		add_action('widgets_init', [$this, 'create_widget']);
	}
	
	public function create_widget() {
		register_widget('MyMo\Widgets\SliderMovies');
	}
}