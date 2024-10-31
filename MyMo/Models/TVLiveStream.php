<?php

namespace MyMo\Models;

use MyMo\Core\Model;

class TVLiveStream extends Model {
	protected $table = 'tv_live_stream';
	protected $fillable = [
		'label1',
		'label2',
		'label3',
		'stream_from1',
		'stream_from2',
		'stream_from3',
		'stream_url1',
		'stream_url2',
		'stream_url3',
	];
}