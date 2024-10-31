<?php
namespace MyMo\Widgets;

use MyMo\Helpers\Request;

class SliderMovies extends \WP_Widget {
	
	function __construct() {
		parent::__construct(
			'mymo_slider_movies',
			'MyMo Slider Movies',
			array( 'description'  =>  'Widget show slider movies')
		);
	}
	
	function form( $instance ) {
		$default = array(
			'title' => '',
			'post_number' => 12,
			'type' => '',
			'sort' => 'id_DESC',
			'taxonomy' => '',
			'object_val' => '',
			'autoplay' => 1,
		);
		
		$instance = wp_parse_args( (array) $instance, $default );
		$title = esc_attr( $instance['title'] );
		$post_number = esc_attr( $instance['post_number'] );
		$type = esc_attr( $instance['type'] );
		$sort = esc_attr( $instance['sort'] );
		$taxonomy = esc_attr( $instance['taxonomy'] );
		$object_val = esc_attr( $instance['object_val'] );
		$autoplay = esc_attr( $instance['autoplay'] );
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/slider_movies/form.php');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = Request::sanitize($new_instance['title']);
		$instance['post_number'] = Request::sanitize($new_instance['post_number']);
		$instance['type'] = Request::sanitize($new_instance['type']);
		$instance['sort'] = Request::sanitize($new_instance['sort']);
		$instance['taxonomy'] = Request::sanitize($new_instance['taxonomy']);
		$instance['object_val'] = Request::sanitize($new_instance['object_val'], Request::$INT);
		$instance['autoplay'] = Request::sanitize($new_instance['autoplay'], Request::$INT);
		return $instance;
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		$post_number = $instance['post_number'];
		$type = esc_attr( $instance['type'] );
		$sort = esc_attr( $instance['sort'] );
		$taxonomy = esc_attr( $instance['taxonomy'] );
		$object_val = esc_attr( $instance['object_val'] );
		$autoplay = esc_attr( $instance['autoplay'] );
		
		$args = [
			'post_type' => 'movie',
			'posts_per_page' => $post_number,
		];
		
		if ($type) {
			$args['meta_query'] = [
				[
					'key'     => 'tv_series',
					'value'   => $type == 'tv_series' ? 1 : 0,
				]
			];
		}
		
		if (in_array($taxonomy, ['genre', 'country'])) {
			$args['tax_query'] = [
				[
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => [$object_val],
				]
			];
		}
		
		if ($sort) {
			$split = explode('_', $sort);
			$order = in_array($split[1], ['ASC', 'DESC']) ? $split[1] : 'DESC';
			
			switch ($split[0]) {
				case 'ID';
					$args['orderby'] = $split[0];
					break;
				case 'view':
					$args['orderby']   = 'meta_value_num';
					$args['meta_key']  = 'views';
					break;
				case 'updated':
					$args['orderby'] = 'post_modified';
					break;
				default:
					$args['orderby'] = 'ID';
			}
			
			$args['order'] = $order;
		}
		
		$query = new \WP_Query($args);
		$items = $query->get_posts();
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/slider_movies/widget.php');
	}
	
}