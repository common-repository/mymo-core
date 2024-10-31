<?php

namespace MyMo\Models;

use MyMo\Core\Model;

/**
 * MyMo\Models\Movies
 *
 * @property int $ID
 * @property string $post_title
 * @method static \MyMo\Models\Movies find($primaryKey, array $columns = ['*'])
 * @method static \MyMo\Models\Movies first_or_new(array $attributes)
 */
class Movies extends Model {
	protected $table = 'posts';
	protected $primaryKey = 'ID';
	protected $prefix = '';
	protected $fillable = [];
	
	public function get_poster() {
		return mymo_image_url(get_post_meta($this->ID, 'poster', true));
	}
}