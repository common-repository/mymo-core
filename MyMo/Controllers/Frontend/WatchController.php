<?php

namespace MyMo\Controllers\Frontend;

use MyMo\Helpers\Request;
use MyMo\Models\Movies;
use MyMo\Models\VideoFiles;

class WatchController {
	public function init() {
		add_action("wp_ajax_mymo_ajax_player", [$this, 'ajax_player']);
		add_action("wp_ajax_nopriv_mymo_ajax_player", [$this, 'ajax_player']);
	}
	
	public function ajax_player() {
		$movie = Movies::find(Request::post('movie'));
		$file_id = Request::post('file_id');
		$file = VideoFiles::find($file_id);
		
		if (empty($file)) {
			echo json_encode([
				'data' => [
					'status' => false,
				]
			]);
			die();
		}
		
		$files = $file->get_file_urls();
		if (empty($files)) {
			echo json_encode([
				'data' => [
					'status' => false,
				]
			]);
			die();
		}
		
		if(in_array($file->source, ['embed', 'youtube', 'vimeo'])) {
			$sources = file_get_contents(MYMO_VIEWS_DIRECTORY . '/frontend/watch/player_embed.php');
			$sources = str_replace('{{embedurl}}', @$files[0]->file, $sources);
		}
		else {
			$script = MYMO_VIEWS_DIRECTORY . '/frontend/watch/player_script.php';
			$sources = file_get_contents($script);
			$sources = str_replace('{{files}}', json_encode($files), $sources);
			$sources = str_replace('{{moviename}}', $movie->post_title, $sources);
			$sources = str_replace('{{poster}}', $movie->get_poster(), $sources);
		}
		
		echo json_encode([
			'data' => [
				'status' => true,
				'sources' => $sources,
			]
		]);
		die();
	}
}