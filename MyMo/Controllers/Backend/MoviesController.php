<?php

namespace MyMo\Controllers\Backend;

class MoviesController {
	
	public function init() {
		add_action('init', array($this, 'create_movie'), 0);
		add_filter('manage_edit-movie_columns', array($this, 'table_columns'));
		add_action('manage_posts_custom_column', array($this, 'columns_formatter'));
		add_filter('post_row_actions', array($this, 'upload_link'), 10, 2);
		add_action('widgets_init', [$this, 'create_widget']);
		add_action('widgets_init', [$this, 'create_widget_popular']);
	}
	
	public function create_movie() {
		$labels = array(
			'name'                => _x( 'Movies', 'Post Type General Name', 'mymo' ),
			'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'mymo' ),
			'menu_name'           => __( 'Movies', 'mymo' ),
			'parent_item_colon'   => __( 'Parent Movie', 'mymo' ),
			'all_items'           => __( 'All Movies', 'mymo' ),
			'view_item'           => __( 'View Movie', 'mymo' ),
			'add_new_item'        => __( 'Add New Movie', 'mymo' ),
			'add_new'             => __( 'Add New', 'mymo' ),
			'edit_item'           => __( 'Edit Movie', 'mymo' ),
			'update_item'         => __( 'Update Movie', 'mymo' ),
			'search_items'        => __( 'Search Movie', 'mymo' ),
			'not_found'           => __( 'Not Found', 'mymo' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'mymo' ),
		);
		
		$args = array(
			'label'               => __( 'movies', 'mymo' ),
			'description'         => __( 'Movie news and reviews', 'mymo' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				'thumbnail',
				'revisions',
				'comments',
			),
			'taxonomies' => array('post_tag'),
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
		
		register_post_type( 'movie', $args);
	}
	
	public function table_columns($columns) {
		unset($columns['tags']);
		$columns['title'] = __('Movie Name', 'mymo');
		
		$columns2['cb'] = $columns['cb'];
		$columns2['movie_thumb'] = __('Thumbnail', 'mymo');
		$columns2['title'] = $columns['title'];
		$columns2['tv_series'] = __('Type', 'mymo');
		$columns2['taxonomy-genre'] = $columns['taxonomy-genre'];
		$columns2['taxonomy-country'] = $columns['taxonomy-country'];
		$columns2['date'] = $columns['date'];
		return $columns2;
	}
	
	public function columns_formatter($column) {
		$post = get_the_ID();
		if ( 'movie_thumb' == $column ) {
			echo '<img width="185" height="250" src="'. esc_url(mymo_thumbnail($post)) .'" class="attachment-movie_thumb size-movie_thumb wp-post-image" alt="" loading="lazy">';
		}
		
		if ( 'tv_series' == $column ) {
			$tv_series = get_post_meta($post, 'tv_series', true );
			echo $tv_series == 1 ? __('TV Series', 'mymo') : __('Movie', 'mymo');
		}
	}
	
	public function upload_link($actions, $post)
	{
		if (in_array($post->post_type, array('movie')))
		{
			$actions['upload'] = '<a href="edit.php?post_type=movie&page=mymo-server-video&post=' . $post->ID . '" title="Server Upload Video for '. $post->post_title .'" rel="permalink">'. __('Upload Server', 'mymo') .'</a>';
		}
		
		return $actions;
	}
	
	public function create_widget() {
		register_widget('MyMo\Widgets\Movies');
	}
	
	public function create_widget_popular() {
		register_widget('MyMo\Widgets\PopularMovies');
	}
}