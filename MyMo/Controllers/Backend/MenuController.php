<?php

namespace MyMo\Controllers\Backend;

class MenuController {
	
	public function init() {
		add_action('admin_menu', array($this, 'admin_menu'));
	}
	
	public function admin_menu() {
		add_menu_page(
			'MyMo Setting',
			'MyMo',
			'manage_options',
			'mymo-core',
			[$this, 'display_setting_menu'],
			'',
			2
		);
		
		add_submenu_page(
			'mymo-core',
			'MyMo Premium',
			'Premium',
			'manage_options',
			'mymo-core',
			[new PremiumController(), 'view_handle']
		);
		
		add_submenu_page(
			'mymo-core',
			'MyMo Setting',
			'Setting',
			'manage_options',
			'mymo-setting',
			[new SettingController(), 'view_handle']
		);
		
		add_submenu_page(
			'mymo-core',
			'MyMo Sliders',
			'Sliders',
			'manage_options',
			'mymo-slider',
			[new SlidersController(), 'view_handle']
		);
		
		add_submenu_page(
			'mymo-core',
			'MyMo Banner ADs',
			'Banner ADs',
			'manage_options',
			'mymo-banner',
			[new BannerAdsController(), 'view_handle']
		);
		
		do_action('mymo_core_admin_menu');
	}

	public function display_setting_menu() {
	
	}
}