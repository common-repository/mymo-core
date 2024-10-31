<?php

namespace MyMo\Models;

use MyMo\Core\Model;

/**
 * MyMo\Models\MovieViews
 *
 * @property int $id
 * @property int $movie_id
 * @property string $day
 * @property int $views
 * @method static \MyMo\Models\MovieViews find($primaryKey, array $columns = ['*'])
 * @method static \MyMo\Models\MovieViews first_or_new(array $attributes)
 */
class MovieViews extends Model {
	protected $table = 'movie_views';
	protected $timestamps = false;
	protected $changeby = false;
}