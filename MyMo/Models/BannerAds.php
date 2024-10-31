<?php

namespace MyMo\Models;

use MyMo\Core\Model;

class BannerAds extends Model {
	protected $table = 'banner_ads';
	protected $changeby = false;
	protected $fillable = [
		'body',
	];
}