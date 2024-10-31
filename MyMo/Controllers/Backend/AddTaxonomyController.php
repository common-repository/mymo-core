<?php

namespace MyMo\Controllers\Backend;

class AddTaxonomyController {
	public function init() {
		add_action('init', [$this, 'create_genres'], 0);
		
		add_action('init', [$this, 'create_countries'], 0);
		
		add_action('init', [$this, 'create_years'], 0);
		
		add_action('init', [$this, 'create_video_qualities'], 0);
	}
	
	public function create_genres() {
		$labels = array(
			'name' => _x( 'Genre', 'Post Type General Name', 'mymo' ),
			'singular_name' => _x( 'Genre', 'Post Type General Name', 'mymo' ),
			'search_items' =>  __( 'Search Genres', 'mymo' ),
			'all_items' => __( 'All Genres', 'mymo' ),
			'parent_item' => __( 'Parent Genre', 'mymo' ),
			'parent_item_colon' => __( 'Parent Genre:', 'mymo' ),
			'edit_item' => __( 'Edit Genre', 'mymo' ),
			'update_item' => __( 'Update Genre', 'mymo' ),
			'add_new_item' => __( 'Add New Genre', 'mymo' ),
			'new_item_name' => __( 'New Genre Name', 'mymo' ),
			'menu_name' => __( 'Genres', 'mymo' ),
		);
		
		register_taxonomy('genre', array('movie'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'genre'),
		));
	}
	
	public function create_countries() {
		$labels = array(
			'name' => __( 'Country', 'mymo' ),
			'singular_name' => __( 'Country', 'mymo' ),
			'search_items' =>  __( 'Search Countries', 'mymo' ),
			'all_items' => __( 'All Countries', 'mymo' ),
			'parent_item' => __( 'Parent Country', 'mymo' ),
			'parent_item_colon' => __( 'Parent Genre:', 'mymo' ),
			'edit_item' => __( 'Edit Country', 'mymo' ),
			'update_item' => __( 'Update Country', 'mymo' ),
			'add_new_item' => __( 'Add New Country', 'mymo' ),
			'new_item_name' => __( 'New Genre Name', 'mymo' ),
			'menu_name' => __( 'Countries', 'mymo' ),
		);
		
		register_taxonomy('country', array('movie'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'country'),
		));
	}
	
	public function create_years() {
		$labels = array(
			'name' => _x( 'Year', 'Post Type General Name', 'mymo' ),
			'singular_name' => _x( 'Genre', 'Post Type General Name', 'mymo' ),
			'search_items' =>  __( 'Search Years', 'mymo' ),
			'all_items' => __( 'All Years', 'mymo' ),
			'parent_item' => __( 'Parent Year', 'mymo' ),
			'parent_item_colon' => __( 'Parent Year:', 'mymo' ),
			'edit_item' => __( 'Edit Year', 'mymo' ),
			'update_item' => __( 'Update Year', 'mymo' ),
			'add_new_item' => __( 'Add New Year', 'mymo' ),
			'new_item_name' => __( 'New Year Name', 'mymo' ),
			'menu_name' => __( 'Years', 'mymo' ),
		);
		
		register_taxonomy('movie_year', array('movie'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'year'),
		));
	}
	
	public function create_video_qualities() {
		$labels = array(
			'name' => _x( 'Quality', 'Post Type General Name', 'mymo' ),
			'singular_name' => _x( 'Quality', 'Post Type General Name', 'mymo' ),
			'search_items' =>  __( 'Search Qualities', 'mymo' ),
			'all_items' => __( 'All Qualities', 'mymo' ),
			'parent_item' => __( 'Parent Quality', 'mymo' ),
			'parent_item_colon' => __( 'Parent Quality:', 'mymo' ),
			'edit_item' => __( 'Edit Quality', 'mymo' ),
			'update_item' => __( 'Update Quality', 'mymo' ),
			'add_new_item' => __( 'Add New Quality', 'mymo' ),
			'new_item_name' => __( 'New Quality Name', 'mymo' ),
			'menu_name' => __( 'Qualities', 'mymo' ),
		);
		
		register_taxonomy('video_quality', array('movie'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			//'meta_box_cb' => [$this, 'cb_meta_box'],
			'rewrite' => array('slug' => 'quality'),
		));
	}
}