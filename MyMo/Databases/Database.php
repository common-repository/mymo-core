<?php

namespace MyMo\Databases;

class Database {
	public function basic_table() {
		global $wpdb;
		$table_prefix = $wpdb->prefix . MYMO_PREFIX;
		$database = file_get_contents(__DIR__ . '/database.sql');
		$split = explode(';', $database);
		
		foreach ($split as $query) {
			if (empty(trim($query))) {
				continue;
			}
			
			$query = str_replace('MYMO_PREFIX', $table_prefix, trim($query));
			$wpdb->query($query);
		}
		
		$banners = [
			'home_header' => 'Home Page Header',
			'genre_header' => 'Genre Page and Country page Header',
			'player_bottom' => 'Player Bottom',
		];
		
		foreach ($banners as $key => $banner) {
			if ($wpdb->get_row("SELECT id FROM `{$table_prefix}banner_ads` WHERE `key` = '$key'")) {
				continue;
			}
			
			$sql = "INSERT INTO `{$table_prefix}banner_ads` VALUES (NULL, %s, %s, NULL, 1, NULL, NULL);";
			$wpdb->query($wpdb->prepare($sql, [$key, $banner]));
		}
	}
}