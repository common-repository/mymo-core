<?php

namespace MyMo\Controllers\Backend;


class TVLiveController {
	public function init() {
		//add_action('init', [$this, 'create_tv_live'], 0);
	}
	
	public function create_tv_live() {
		$labels = array(
			'name'                => _x( 'TV Live', 'Post Type General Name', 'mymo' ),
			'singular_name'       => _x( 'TV Live', 'Post Type Singular Name', 'mymo' ),
			'menu_name'           => __( 'TV Live', 'mymo' ),
			'parent_item_colon'   => __( 'Parent TV Live', 'mymo' ),
			'all_items'           => __( 'All TV Live', 'mymo' ),
			'view_item'           => __( 'View TV Live', 'mymo' ),
			'add_new_item'        => __( 'Add New TV Live', 'mymo' ),
			'add_new'             => __( 'Add New', 'mymo' ),
			'edit_item'           => __( 'Edit TV Live', 'mymo' ),
			'update_item'         => __( 'Update TV Live', 'mymo' ),
			'search_items'        => __( 'Search TV Live', 'mymo' ),
			'not_found'           => __( 'Not Found', 'mymo' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'mymo' ),
		);
		
		$args = array(
			'label'               => __( 'tv-live', 'mymo' ),
			'description'         => __( 'TV Live news and reviews', 'mymo' ),
			'labels'              => $labels,
			'supports'            => [
				'title',
				'editor',
				'thumbnail',
				'revisions',
				'comments',
			],
			'taxonomies' => ['category'],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'yarpp_support'       => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'menu_icon' => 'dashicons-format-video',
		);
		
		register_post_type( 'tv_live', $args);
	}
}