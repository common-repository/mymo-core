<?php

namespace MyMo\Core;

class MyMo {
	public function init() {
		add_image_size('movie_thumb', 185, 250, true);
		
		foreach (glob(MYMO_APP_DIRECTORY . "/Controllers/Backend/*.php") as $filename) {
			$class_name = 'MyMo\Controllers\Backend\\' . str_replace('.php', '', basename($filename));
			if (class_exists($class_name)) {
				$obj = new $class_name();
				$obj->init();
			}
		}
		
		foreach (glob(MYMO_APP_DIRECTORY . "/Controllers/Frontend/*.php") as $filename) {
			$class_name = 'MyMo\Controllers\Frontend\\' . str_replace('.php', '', basename($filename));
			if (class_exists($class_name)) {
				$obj = new $class_name();
				$obj->init();
			}
		}
	}
}