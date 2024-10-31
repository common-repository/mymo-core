<?php

use MyMo\Models\BannerAds;
use MyMo\Models\MovieRating;
use MyMo\Models\VideoFiles;
use MyMo\Models\VideoServers;

if (!function_exists('dd')) {
	function dd($var) {
		var_dump($var);
		die();
	}
}

if (!function_exists('mymo_get_ip')) {
	function mymo_get_ip() {
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			return $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}
}

if (!function_exists('mymo_get_redirect')) {
	function mymo_get_redirect($url) {
		echo '<script>window.location.href = "'. esc_url($url) .'";</script>';
		die();
	}
}

if (!function_exists('mymo_get_servers')) {
	function mymo_get_servers($post_id) {
		$servers = VideoServers::get_rows(['movie_id' => $post_id, 'status' => 1], '`id`, `name`', '`order` ASC');
		return apply_filters('mymo_get_servers', $servers);
	}
}

if (!function_exists('mymo_get_video_files')) {
	function mymo_get_video_files($server_id) {
		return VideoFiles::get_rows(['server_id' => $server_id, 'status' => 1], '`id`, `label`', '`order` ASC');
	}
}

if (!function_exists('mymo_get_related_movies')) {
	function mymo_get_related_movies(array $genres, $limit = 4) {
		$args = array(
			'post_type' => 'movie',
			'posts_per_page' => $limit,
			'tax_query' => array(
				array(
					'taxonomy' => 'genre',
					'field'    => 'term_id',
					'terms'    => $genres,
				),
			),
		);
		
		$query = new WP_Query( $args );
		if ($query->have_posts()) {
			return $query->get_posts();
		}
		
		return false;
	}
}

if (!function_exists('mymo_count_rating_movie')) {
	function mymo_count_rating_movie($post_id) {
		//global $wpdb;
		//$prefix = $wpdb->prefix . MYMO_PREFIX;
		//$sql = "SELECT COUNT(id) FROM `{$prefix}movie_rating` WHERE `movie_id` = %d";
		//return $wpdb->get_var($wpdb->prepare($sql, [$post_id]));
		return MovieRating::get_var(['movie_id' => $post_id], 'COUNT(id)');
	}
}

if (!function_exists('mymo_total_rating_movie')) {
	function mymo_total_rating_movie($post_id) {
		global $wpdb;
		$prefix = $wpdb->prefix . MYMO_PREFIX;
		$sql = "SELECT SUM(star) FROM `{$prefix}movie_rating` WHERE `movie_id` = %d";
		return $wpdb->get_var($wpdb->prepare($sql, [$post_id]));
	}
}

if (!function_exists('mymo_get_star_movie')) {
	function mymo_get_star_movie($post_id) {
		$total = mymo_total_rating_movie($post_id);
		$count = mymo_count_rating_movie($post_id);
		if ($count <= 0) {
			return 0;
		}
		return round($total * 5 / ($count * 5), 2);
	}
}

if (!function_exists('mymo_get_video_file')) {
	function mymo_get_video_file($post_id) {
		global $wpdb;
		$prefix = $wpdb->prefix . MYMO_PREFIX;
		
		$sql = "SELECT id FROM `{$prefix}video_servers` WHERE `movie_id` = %d ORDER BY `order` ASC";
		$server_id = $wpdb->get_var($wpdb->prepare($sql, [$post_id]));
		if (empty($server_id)) {
			return 0;
		}
		
		$sql = "SELECT id FROM `{$prefix}video_files` WHERE `server_id` = %d ORDER BY `order` ASC";
		$file_id = $wpdb->get_var($wpdb->prepare($sql, [$server_id]));
		if (empty($file_id)) {
			return 0;
		}
		
		return apply_filters('mymo_get_video_file', $file_id);
	}
}

if (!function_exists('mymo_get_video_file_label')) {
	function mymo_get_video_file_label($file_id) {
		return VideoFiles::get_var(['id' => $file_id], '`label`');
	}
}

if (!function_exists('mymo_ads')) {
	function mymo_ads($key, $before = '', $after = '') {
		$ads = BannerAds::get_var(['key' => $key], '`body`');
		echo $before . $ads . $after;
	}
}

if (!function_exists('mymo_get_youtube_id')) {
	function mymo_get_youtube_id($url) {
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
		if (@$match[1]) {
			return $match[1];
		}
		return false;
	}
}

if (!function_exists('mymo_load_php')) {
	function mymo_load_php($directory) {
		if(is_dir($directory)) {
			$scan = scandir($directory);
			unset($scan[0], $scan[1]);
			
			foreach($scan as $file) {
				if ( is_dir( $directory . "/" . $file ) ) {
					mymo_load_php( $directory . "/" . $file );
				} else {
					if ( strpos( $file, '.php' ) !== false ) {
						require_once( $directory . "/" . $file );
					}
				}
			}
		}
	}
}

if (!function_exists('mymo_image_url')) {
	function mymo_image_url($image_id, $size = 'full') {
		if ($image_id) {
			$image = wp_get_attachment_image_src($image_id, $size);
			if ($image) {
				return $image[0];
			}
		}
		
		return MYMO_DIRECTORY_URI . '/assets/images/thumb.png';
	}
}

if (!function_exists('mymo_get_current_url')) {
	function mymo_get_current_url($params = []) {
		if (isset($_SERVER['HTTPS']) &&
		    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
		    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
		    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
			$protocol = 'https://';
		} else {
			$protocol = 'http://';
		}
		
		$current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		if ($params) {
			return add_query_arg($params, $current_url);
		}
		
		return $current_url;
	}
}

if (!function_exists('mymo_response')) {
	function mymo_response( $message, $status = 'success' ) {
		header( 'Content-Type: application/json' );
		echo json_encode( array( 'status' => $status, 'message' => $message ) );
		exit();
	}
}

if (!function_exists('mymo_redirect')) {
	function mymo_redirect( $url ) {
		header( 'Content-Type: application/json' );
		echo json_encode( array( 'status' => 'success', 'redirect' => $url ) );
		exit();
	}
}

if (!function_exists('mymo_thumbnail' ) ) {
	function mymo_thumbnail($post_id, $size = 'movie_thumb') {
		$thumbnail = get_the_post_thumbnail_url($post_id, $size);
		if ($thumbnail) {
			return $thumbnail;
		}
		
		return MYMO_DIRECTORY_URI . '/assets/images/thumb-default.png';
	}
}

if (!function_exists('mymo_get_profile_pages')) {
	function mymo_get_profile_pages() {
		$pages = [
			'profile' => [
				'name' => 'Profile',
				'path' => MYMO_VIEWS_DIRECTORY . '/frontend/profile/profile.php',
			],
			'change-password' => [
				'name' => 'Change password',
				'path' => MYMO_VIEWS_DIRECTORY . '/frontend/profile/change_password.php',
			]
		];
		
		return apply_filters('mymo_profile_pages', $pages);
	}
}

if (!function_exists('mymo_recently_visited')) {
	function mymo_recently_visited() {
		$viewed = isset($_COOKIE['viewed']) ? explode(',', $_COOKIE['viewed']) : [];
		if ($viewed) {
			$args = [
				'post_type' => 'movie',
				'post__in' => $viewed,
				'posts_per_page' => 5
			];
			
			$query = new WP_Query($args);
			
			return $query->get_posts();
		}
		
		return [];
	}
}

if (!function_exists('mymo_get_year_movie')) {
	function mymo_get_year_movie($movie_id) {
		$years = get_the_terms($movie_id, 'movie_year');
		
		if ($years && !is_a($years, WP_Error::class)) {
			return $years[0]->name;
		}
		
		return '';
	}
}