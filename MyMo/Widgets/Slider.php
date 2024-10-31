<?php
namespace MyMo\Widgets;

use MyMo\Helpers\Request;
use MyMo\Models\Sliders;

class Slider extends \WP_Widget {
	
	function __construct() {
		parent::__construct(
			'mymo_slider',
			'MyMo Slider',
			array( 'description'  =>  'Widget show slider')
		);
	}
	
	function form( $instance ) {
		$default = array(
			'speed' => 450,
			'autoplay' => 1,
			'slider' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $default);
		$slider = esc_attr($instance['slider']);
		$speed = esc_attr($instance['speed']);
		$autoplay = esc_attr($instance['autoplay']);
		$sliders = Sliders::get_rows([], '`id`, `name`');
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/slider/form.php');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['slider'] = Request::sanitize($new_instance['slider'], Request::$INT);
		$instance['speed'] = Request::sanitize($new_instance['speed'], Request::$INT);
		$instance['autoplay'] = Request::sanitize($new_instance['autoplay'], Request::$INT);
		return $instance;
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$slider = esc_attr($instance['slider']);
		$speed = esc_attr($instance['speed']);
		$autoplay = esc_attr($instance['autoplay']);
		
		$slider = Sliders::get_row(['id' => $slider]);
		$sliders = $slider ? json_decode($slider->content) : [];
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/slider/widget.php');
	}
	
}