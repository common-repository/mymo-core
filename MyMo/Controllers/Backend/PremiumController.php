<?php

namespace MyMo\Controllers\Backend;

use MyMo\Core\Controller;

class PremiumController extends Controller {
	public function init() {
	
	}
	
	public function index_view() {
		$features = [
			'Fully Ajax Load Page' => [1, 1],
			'Play Upload Video' => [1, 1],
			'Play MP4 Video Url' => [1, 1],
			'Play Embed Video Url' => [1, 1],
			'Play HLS (m3u8) Video Url' => [0, 1],
			'Play Google Drive Video Url' => [0, 1],
			'Slider Management' => [1, 1],
			'Slider Movies' => [1, 1],
			'Popular Movies' => [1, 1],
			'Bookmark Movies' => [0, 1],
			'Rating Movies' => [1, 1],
			'Banner ADs' => [1, 1],
			//'Video ADs' => [0, 1],
			//'Notification' => [0, 1],
			//'Block IP Country' => [0, 1],
			//'Paid Membership' => [0, 1],
			//'Import Movies From TMDB' => [0, 1],
			//'Auto Download Remote Video' => [0, 1],
			//'Auto Upload Backup Video' => [0, 1],
			//'Multi Qualities Video Upload' => [0, 1],
			//'User Upload Movies' => [0, 1],
			//'User Add ADs' => [0, 1],
			//'Pay Per Click' => [0, 1],
			//'Pay Per Upload' => [0, 1],
			//'Subtitle Support' => [1, 1],
			//'Social Login' => [1, 1],
			'Facebook Comment' => [1, 1],
			'Recaptcha V3' => [1, 1],
			'Ajax Filter' => [1, 1],
			'User Profile' => [1, 1],
		];
		
		$this->view('backend.premium.index', [
			'features' => $features
		]);
	}
}