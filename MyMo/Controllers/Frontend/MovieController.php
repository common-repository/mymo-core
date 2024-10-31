<?php

namespace MyMo\Controllers\Frontend;

use MyMo\Core\Controller;
use MyMo\Helpers\Request;
use MyMo\Models\MovieViews;

class MovieController extends Controller {
	
	public function init() {
		add_filter('template_include', [$this, 'override_template']);
		add_filter('mymo_template_part', [$this, 'template_part'], 10, 3);
		
		add_action('wp_ajax_mymo_set_movie_view', [$this, 'set_movie_view']);
		add_action('wp_ajax_nopriv_mymo_set_movie_view', [$this, 'set_movie_view']);
		
		add_action('wp_ajax_mymo_ajax_popular_movies', [$this, 'ajax_popular_movies']);
		add_action('wp_ajax_nopriv_mymo_ajax_popular_movies', [$this, 'ajax_popular_movies']);
		
		add_action('wp_ajax_mymo_get_movies_by_genre', [$this, 'get_movies_by_genre']);
		add_action('wp_ajax_nopriv_mymo_get_movies_by_genre', [$this, 'get_movies_by_genre']);
	}
	
	public function override_template( $template ) {
		
		if ( is_singular( 'movie' ) ) {
			$template = MYMO_VIEWS_DIRECTORY . '/frontend/theme/single-movie.php';
		}
		
		return $template;
		
	}
	
	public function template_part($part, $slug, $name) {
		if ($name == 'movie') {
			return MYMO_VIEWS_DIRECTORY . '/frontend/theme/content-movie.php';
		}
		
		return '';
	}
	
	public function set_movie_view() {
		$post_id = Request::post('post_id');
		$views = get_post_meta($post_id, 'views', true);
		if (isset($_COOKIE['viewed'])) {
			$viewed = explode(',', $_COOKIE['viewed']);
			if (in_array($post_id, $viewed)) {
				echo json_encode([
					'view' => $views,
				]);
				die();
			}
		}
		
		if (empty($viewed)) {
			$viewed = [];
		}
		
		$views = $views + 1;
		$this->setView($post_id);
		
		$viewed[] = $post_id;
		setcookie('viewed', implode(',', $viewed), time() + 86400, '/');
		
		update_post_meta($post_id, 'views', $views);
		echo json_encode([
			'view' => $views,
		]);
		die();
	}
	
	public function ajax_popular_movies() {
		$type = Request::input('type');
		$showpost = Request::input('showpost');
		
		if ($showpost <= 0) {
			$showpost = 10;
		}
		
		$items = $this->getPopular($type, $showpost);
		
		$this->view('frontend.filter.popular_movies', [
			'items' => $items,
		]);
		die();
	}
	
	public function get_movies_by_genre() {
		$genre = Request::input('cat_id');
		$showpost = Request::input('showpost', 12);
		
		$args = [
			'post_type' => 'movie',
			'posts_per_page' => $showpost,
			'tax_query' => [
				[
					'taxonomy' => 'genre',
					'field'    => 'id',
					'terms'    => [$genre],
				],
			],
		];
		
		$query = new \WP_Query($args);
		$items = $query->get_posts();
		
		$this->view('frontend.filter.movies_by_genre', [
			'items' => $items,
		]);
		die();
	}
	
	protected function setView($post_id) {
		$model = MovieViews::first_or_new([
			'movie_id' => $post_id,
			'day' => date('Y-m-d'),
		]);
		
		$model->movie_id = $post_id;
		$model->views = doubleval($model->views) + 1;
		$model->day = date('Y-m-d');
		return $model->save();
	}
	
	protected function getPopular($type, $showpost) {
		global $wpdb;
		$prefix = $wpdb->prefix . MYMO_PREFIX;
		$params = [];
		$query = "SELECT {$wpdb->posts}.`ID`, {$wpdb->posts}.`post_title`
	    FROM {$wpdb->posts}
	    WHERE {$wpdb->posts}.`post_status` = 'publish'
	    AND {$wpdb->posts}.`post_type` = 'movie'
	    AND {$wpdb->posts}.`post_date` < NOW()";
		
		if ($type == 'day' || $type == 'month') {
			switch ($type) {
				case 'day': $date = date('Y-m-d');break;
				case 'month': $date = date('Y-m');break;
				default: $date = date('Y-m-d');break;
			}
			
			$query .= " AND {$wpdb->posts}.`ID` IN (
				SELECT `movie_id`
				FROM `{$prefix}movie_views`
				WHERE `day` LIKE %s
				ORDER BY `views` DESC
			)";
			$params[] = $date . '%';
		}
		
		if ($type == 'week') {
			$day = date('w');
			$week_start = date('Y-m-d', strtotime('-'. $day .' days'));
			$week_end = date('Y-m-d', strtotime('+'. (6-$day) .' days'));
			
			$query .= " AND {$wpdb->posts}.ID IN (
				SELECT movie_id
				FROM `{$prefix}movie_views`
				WHERE `day` >= %s
				AND `day` <= %s
				ORDER BY `views` DESC
			)";
			
			$params[] = $week_start;
			$params[] = $week_end;
		}
		
		$query .= " ORDER BY {$wpdb->posts}.`post_date` DESC";
		$query .= " LIMIT {$showpost}";
		
		if (empty($params)) {
			return $wpdb->get_results($query);
		}
		
		return $wpdb->get_results($wpdb->prepare($query, $params));
	}
	
}