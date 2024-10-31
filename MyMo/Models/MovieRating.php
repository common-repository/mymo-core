<?php

namespace MyMo\Models;

use MyMo\Core\Model;

/**
 * MyMo\Models\MovieRating
 *
 * @property int $id
 * @property int $movie_id
 * @property string $client_ip
 * @property int $star
 * @method static \MyMo\Models\MovieRating find($primaryKey, array $columns = ['*'])
 * @method static \MyMo\Models\MovieRating first_or_new(array $attributes)
 */

class MovieRating extends Model {
	protected $table = 'movie_rating';
	protected $changeby = false;
}