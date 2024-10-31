<?php

namespace MyMo\Controllers\Backend;

class TemplateController {
	public function init() {
		add_filter( 'page_template', [$this, 'profile'] );
		add_filter( 'theme_page_templates', [$this, 'profile_select'], 10, 4 );
		
		add_filter( 'page_template', [$this, 'search'] );
		add_filter( 'theme_page_templates', [$this, 'search_select'], 10, 4 );
		
		add_filter( 'page_template', [$this, 'all_movies'] );
		add_filter( 'theme_page_templates', [$this, 'all_movies_select'], 10, 4 );
		
		add_filter( 'page_template', [$this, 'latest_movies'] );
		add_filter( 'theme_page_templates', [$this, 'latest_movies_select'], 10, 4 );
		
		add_filter( 'page_template', [$this, 'latest_tv_series'] );
		add_filter( 'theme_page_templates', [$this, 'latest_tv_series_select'], 10, 4 );
	}

	function profile( $page_template ){
		
		if ( get_page_template_slug() == 'mymo-core/profile.php' ) {
			$page_template = MYMO_VIEWS_DIRECTORY . '/frontend/templates/profile.php';
		}
		
		return $page_template;
	}
	
	function profile_select( $post_templates, $wp_theme, $post, $post_type ) {
		
		$post_templates['mymo-core/profile.php'] = __('Profile');
		
		return $post_templates;
	}
	
	function search( $page_template ){
		
		if ( get_page_template_slug() == 'mymo-core/search.php' ) {
			$page_template = MYMO_VIEWS_DIRECTORY . '/frontend/templates/search.php';
		}
		
		return $page_template;
	}
	
	function search_select( $post_templates, $wp_theme, $post, $post_type ) {
		
		$post_templates['mymo-core/search.php'] = __('Search');
		
		return $post_templates;
	}
	
	function all_movies( $page_template ){
		
		if ( get_page_template_slug() == 'mymo-core/all_movies.php' ) {
			$page_template = MYMO_VIEWS_DIRECTORY . '/frontend/templates/all-movies.php';
		}
		
		return $page_template;
	}
	
	function all_movies_select( $post_templates, $wp_theme, $post, $post_type ) {
		
		$post_templates['mymo-core/all_movies.php'] = __('All Movies & TV Series');
		
		return $post_templates;
	}
	
	function latest_movies( $page_template ){
		
		if ( get_page_template_slug() == 'mymo-core/latest_movies.php' ) {
			$page_template = MYMO_VIEWS_DIRECTORY . '/frontend/templates/latest-movies.php';
		}
		
		return $page_template;
	}
	
	function latest_movies_select( $post_templates, $wp_theme, $post, $post_type ) {
		
		$post_templates['mymo-core/latest_movies.php'] = __('Latest Movies');
		
		return $post_templates;
	}
	
	function latest_tv_series( $page_template ){
		
		if ( get_page_template_slug() == 'mymo-core/latest_tv_series.php' ) {
			$page_template = MYMO_VIEWS_DIRECTORY . '/frontend/templates/latest-tv-series.php';
		}
		
		return $page_template;
	}
	
	function latest_tv_series_select( $post_templates, $wp_theme, $post, $post_type ) {
		
		$post_templates['mymo-core/latest_tv_series.php'] = __('Latest TV Series');
		
		return $post_templates;
	}
}