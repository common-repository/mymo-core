<?php

namespace MyMo\Models;

use MyMo\Core\Model;

/**
 * MyMo\Models\Sliders
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @method static \MyMo\Models\Sliders find($primaryKey, array $columns = ['*'])
 * @method static \MyMo\Models\Sliders first_or_new(array $attributes)
 */
class Sliders extends Model {
	protected $table = 'sliders';
	protected $fillable = [
		'name',
	];
}