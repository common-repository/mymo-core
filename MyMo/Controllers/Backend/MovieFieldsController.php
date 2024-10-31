<?php

namespace MyMo\Controllers\Backend;

use MyMo\Helpers\Request;

class MovieFieldsController {
	
	public function init() {
		add_action('add_meta_boxes', array($this, 'add_movie_metaboxes'), 1);
		add_action('save_post', array($this, 'save_movie_meta'), 1, 2);
	}
	
	public function add_movie_metaboxes() {
		add_meta_box(
			'mymo_add_tv_serires_options',
			'Movie Type',
			array($this, 'tv_serires_options'),
			'movie',
			'normal',
			'default'
		);
		
		add_meta_box(
			'mymo_add_movie_options',
			'Information',
			array($this, 'movie_options'),
			'movie',
			'normal',
			'default'
		);
		
		add_meta_box(
			'mymo_add_poster_options',
			'Poster',
			array($this, 'poster_options'),
			'movie',
			'side',
			'default'
		);
	}
	
	public function movie_options() {
		global $post;
		
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'movie_metabox' );
		$other_name = get_post_meta($post->ID, 'other_name', true);
		$rating = get_post_meta($post->ID, 'rating', true);
		$release = get_post_meta($post->ID, 'release', true);
		$runtime = get_post_meta($post->ID, 'runtime', true);
		$trailer = get_post_meta($post->ID, 'trailer', true);
		
		// Output the field
		include MYMO_VIEWS_DIRECTORY . '/backend/movies/movie_fields.php';
	}
	
	public function tv_serires_options() {
		global $post;
		
		$tv_series = get_post_meta($post->ID, 'tv_series', true);
		$current_episode = get_post_meta($post->ID, 'current_episode', true);
		$max_episode = get_post_meta($post->ID, 'max_episode', true);
		
		// Output the field
		include MYMO_VIEWS_DIRECTORY . '/backend/movies/tv_series_fields.php';
	}
	
	public function poster_options() {
		global $post;
		
		$poster_id = get_post_meta($post->ID, 'poster', true);
		$poster = mymo_image_url($poster_id);
		// Output the field
		include MYMO_VIEWS_DIRECTORY . '/backend/movies/poster.php';
	}
	
	public function save_movie_meta($post_id, $post) {
		
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		
		if (! wp_verify_nonce( @$_POST['movie_metabox'], basename(__FILE__) ) ) {
			return $post_id;
		}
		
		$events_meta['search_title'] = get_the_title($post_id);
		$events_meta['other_name'] = Request::post('other_name');
		$events_meta['rating'] = Request::post('rating');
		$events_meta['release'] = Request::post('release');
		$events_meta['runtime'] = Request::post('runtime');
		$events_meta['trailer'] = Request::post('trailer', null, Request::$URL);
		$events_meta['video_quality'] = Request::post('video_quality', null, Request::$INT);
		$events_meta['tv_series'] = Request::post('tv_series', null, Request::$INT);
		$events_meta['poster'] = Request::post('poster', null, Request::$INT);
		
		if ($events_meta['tv_series'] == 1) {
			$events_meta['current_episode'] = Request::post('current_episode', null, Request::$INT);
			$events_meta['max_episode'] = Request::post('max_episode', null, Request::$INT);
		}
		
		if ( !get_post_meta( $post_id, 'views', true ) ) {
			$events_meta['views'] = 1;
		}
		
		foreach ( $events_meta as $key => $value ) :
			
			if ( 'revision' === $post->post_type ) {
				return false;
			}
			
			if ( get_post_meta( $post_id, $key, false ) ) {
				update_post_meta( $post_id, $key, $value );
			} else {
				add_post_meta( $post_id, $key, $value);
			}
			
			if ( $value === null ) {
				delete_post_meta( $post_id, $key );
			}
		
		endforeach;
		
	}
}