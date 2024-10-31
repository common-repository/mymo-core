<?php

namespace MyMo\Controllers\Backend;

use MyMo\Helpers\Request;

class MediaController {
	public function init() {
		add_action('wp_ajax_mymo_get_image', [$this, 'get_image']);
	}
	
	public function get_image() {
		$image_id = Request::input('id', null, Request::$INT);
		if( $image_id ){
			$image = wp_get_attachment_url( $image_id );
			
			$data = [
				'image'    => $image,
			];
			
			wp_send_json_success($data);
		} else {
			wp_send_json_error();
		}
	}
}