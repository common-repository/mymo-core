<?php

namespace MyMo\Controllers\Frontend;

use MyMo\Helpers\Request;
use MyMo\Models\MovieRating;

class RatingController {
	public function init() {
		add_action("wp_ajax_mymo_rating", [$this, 'rating_handle']);
		add_action("wp_ajax_nopriv_mymo_rating", [$this, 'rating_handle']);
	}
	
	public function rating_handle() {
		$star = Request::post('value');
		$movie_id = Request::post('movie');
		
		if (empty($star)) {
			echo 0;
			die();
		}
		
		$client_ip = mymo_get_ip();
		
		$model = MovieRating::first_or_new([
			'movie_id' => $movie_id,
			'client_ip' => $client_ip,
		]);
		
		$model->movie_id = $movie_id;
		$model->client_ip = $client_ip;
		$model->star = $star;
		$model->save();
		
		echo mymo_get_star_movie($movie_id);
		die();
	}
}