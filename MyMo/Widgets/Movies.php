<?php
namespace MyMo\Widgets;

use MyMo\Helpers\Request;

class Movies extends \WP_Widget {
	
	public function __construct() {
		parent::__construct(
			'mymo_movies',
			'MyMo Movies',
			array( 'description'  =>  'Widget show Movies')
		);
	}
	
	public function form($instance) {
		$default = [
			'title' => '',
			'post_number' => 12,
			'type' => '',
			'sort' => 'id_DESC',
			'taxonomy' => '',
			'object_val' => '',
			'sub_genres' => '',
		];
		
		$instance = wp_parse_args( (array) $instance, $default);
		$title = esc_attr($instance['title']);
		$post_number = esc_attr($instance['post_number']);
		$type = esc_attr($instance['type']);
		$sort = esc_attr($instance['sort']);
		$taxonomy = esc_attr($instance['taxonomy']);
		$object_val = esc_attr($instance['object_val']);
		$sub_genres = explode(',', $instance['sub_genres']);
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/movies/form.php');
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$sub_genres = implode(',', $new_instance['sub_genres']);
		
		$instance['title'] = Request::sanitize($new_instance['title']);
		$instance['post_number'] = Request::sanitize($new_instance['post_number']);
		$instance['type'] = Request::sanitize($new_instance['type']);
		$instance['sort'] = Request::sanitize($new_instance['sort']);
		$instance['taxonomy'] = Request::sanitize($new_instance['taxonomy']);
		$instance['object_val'] = Request::sanitize($new_instance['object_val'], Request::$INT);
		$instance['sub_genres'] = Request::sanitize($sub_genres, Request::$INT);
		return $instance;
	}
	
	public function widget( $args, $instance ) {
		extract($args);
		$title = esc_attr($instance['title']);
		$post_number = esc_attr($instance['post_number']);
		$type = esc_attr($instance['type']);
		$sort = esc_attr($instance['sort']);
		$taxonomy = esc_attr($instance['taxonomy']);
		$object_val = esc_attr($instance['object_val']);
		$sub_genres = explode(',', $instance['sub_genres']);
		
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
		$child_genres = $this->get_child_genres($sub_genres);
		
		include (MYMO_VIEWS_DIRECTORY . '/widgets/movies/widget.php');
	}
	
	public function get_child_genres($genres) {
		$args = array(
			'taxonomy'         => 'genre',
			'fields'           => 'all',
			'term_taxonomy_id' => $genres,
		);
		$query = new \WP_Term_Query($args);
		if ($query->terms) {
			return $query->get_terms();
		}
		
		return [];
	}
	
}