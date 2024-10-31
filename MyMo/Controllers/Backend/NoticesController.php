<?php

namespace MyMo\Controllers\Backend;

class NoticesController {
	
	public function init() {
		$current_theme = get_option('stylesheet');
		if ($current_theme != 'mymo') {
			add_action('admin_notices', [$this, 'activate_theme']);
		}
	}
	
	public function activate_theme(){
		echo '<div class="notice notice-warning is-dismissible">
             <p>Plugin MyMo Core should be run with MyMo Theme. <a href="https://juzaweb.com/mymo.zip" target="_blank">Download MyMo Theme</a> or <a href="themes.php">Activate it</a>.</p>
         </div>';
	}
}