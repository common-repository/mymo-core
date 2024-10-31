<?php

namespace MyMo\Controllers\Frontend;

class ProfileController {
	public function init() {
		add_filter('mymo_profile_menu', [$this, 'profile_menu']);
	}
	
	public function profile_menu($pages) {
		$args = [
			'meta_key' => '_wp_page_template',
			'meta_value' => 'mymo-core/profile.php',
			'number'       => 1,
		];
		$templates = get_pages($args);
		
		if (empty($templates)) {
			return $pages;
		}
		
		$pages[] = [
			'name' => __('Profile', 'mymo'),
			'url' => get_permalink($templates[0]->ID),
			'icon' => 'hl-user',
		];
		
		return $pages;
	}
}