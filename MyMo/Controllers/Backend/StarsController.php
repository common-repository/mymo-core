<?php

namespace MyMo\Controllers\Backend;

class StarsController {
	public function init() {
		add_action('init', array($this, 'create_directors'), 0);
		add_action('init', array($this, 'create_writers'), 0);
		add_action('init', array($this, 'create_stars'), 0);
	}
	
	public function create_directors() {
		
		$labels = array(
			'name' => _x( 'Director', 'Post Type General Name', 'mymo' ),
			'singular_name' => _x( 'Director', 'Post Type General Name', 'mymo' ),
			'search_items' =>  __( 'Search Directors', 'mymo' ),
			'all_items' => __( 'All Directors', 'mymo' ),
			'parent_item' => __( 'Parent Director', 'mymo' ),
			'parent_item_colon' => __( 'Parent Director:', 'mymo' ),
			'edit_item' => __( 'Edit Director', 'mymo' ),
			'update_item' => __( 'Update Director', 'mymo' ),
			'add_new_item' => __( 'Add New Director', 'mymo' ),
			'new_item_name' => __( 'New Director Name', 'mymo' ),
			'menu_name' => __( 'Directors', 'mymo' ),
		);
		
		register_taxonomy('director', array('movie'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			'rewrite' => array('slug' => 'director'),
		));
	}
	
	public function create_writers() {
		
		$labels = array(
			'name' => _x( 'Writer', 'Post Type General Name', 'mymo' ),
			'singular_name' => _x( 'Writer', 'Post Type General Name', 'mymo' ),
			'search_items' =>  __( 'Search Writers', 'mymo' ),
			'all_items' => __( 'All Writers', 'mymo' ),
			'parent_item' => __( 'Parent Writer', 'mymo' ),
			'parent_item_colon' => __( 'Parent Writer:', 'mymo' ),
			'edit_item' => __( 'Edit Writer', 'mymo' ),
			'update_item' => __( 'Update Writer', 'mymo' ),
			'add_new_item' => __( 'Add New Writer', 'mymo' ),
			'new_item_name' => __( 'New Writer Name', 'mymo' ),
			'menu_name' => __( 'Writers', 'mymo' ),
		);
		
		register_taxonomy('writer', array('movie'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			'rewrite' => array('slug' => 'writer'),
		));
	}
	
	public function create_stars() {
		
		$labels = array(
			'name' => _x( 'Star', 'Post Type General Name', 'mymo' ),
			'singular_name' => _x( 'Star', 'Post Type General Name', 'mymo' ),
			'search_items' =>  __( 'Search Stars', 'mymo' ),
			'all_items' => __( 'All Stars', 'mymo' ),
			'parent_item' => __( 'Parent Star', 'mymo' ),
			'parent_item_colon' => __( 'Parent Star:', 'mymo' ),
			'edit_item' => __( 'Edit Star', 'mymo' ),
			'update_item' => __( 'Update Star', 'mymo' ),
			'add_new_item' => __( 'Add New Star', 'mymo' ),
			'new_item_name' => __( 'New Star Name', 'mymo' ),
			'menu_name' => __( 'Stars', 'mymo' ),
		);
		
		register_taxonomy('star', array('movie'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => false,
			'query_var' => true,
			'rewrite' => array('slug' => 'star'),
		));
	}
}