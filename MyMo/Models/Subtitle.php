<?php

namespace MyMo\Models;

use MyMo\Core\Model;

/**
 * MyMo\Models\Subtitle
 *
 * @property int $id
 * @property string $label
 * @property string $url
 * @property int $order
 * @property int $status
 * @property int $video_file_id
 * @method static \MyMo\Models\Subtitle find($primaryKey, array $columns = ['*'])
 * @method static \MyMo\Models\Subtitle first_or_new(array $attributes)
 */
class Subtitle extends Model {
	protected $table = 'video_files_subtitle';
	protected $fillable = [
		'label',
		'url',
		'order',
		'status',
	];
}