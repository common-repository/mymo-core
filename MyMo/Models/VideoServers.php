<?php

namespace MyMo\Models;

use MyMo\Core\Model;

/**
 * MyMo\Models\VideoServers
 *
 * @property int $id
 * @property string $name
 * @property int $movie_id
 * @property int $order
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @method static \MyMo\Models\VideoServers find($primaryKey, array $columns = ['*'])
 * @method static \MyMo\Models\VideoServers first_or_new(array $attributes)
 */
class VideoServers extends Model {
	protected $table = 'video_servers';
	protected $fillable = [
		'name',
		'order',
		'status',
	];
	
}