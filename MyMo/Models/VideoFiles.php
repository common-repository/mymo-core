<?php

namespace MyMo\Models;

use MyMo\Core\Model;

/**
 * MyMo\Models\VideoFiles
 *
 * @property int $id
 * @property string $label
 * @property string $source
 * @property string $url
 * @property int $movie_id
 * @property int $server_id
 * @property int $order
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @method static \MyMo\Models\VideoFiles find($primaryKey, array $columns = ['*'])
 * @method static \MyMo\Models\VideoFiles first_or_new(array $attributes)
 */
class VideoFiles extends Model {
	protected $table = 'video_files';
	protected $fillable = [
		'label',
		'source',
		'url',
		'order',
		'status',
	];
	
	public function get_file_urls() {
		$result = [];
		switch ($this->source) {
			case 'youtube';
				$result = $this->get_video_youtube();break;
			case 'vimeo':
				$result = $this->get_video_vimeo();break;
			case 'mp4';
				$result = $this->get_video_url('mp4');break;
			case 'mkv';
				$result = $this->get_video_url('mkv');break;
			case 'webm':
				$result = $this->get_video_url('webm');break;
			case 'embed':
				$result = $this->get_video_url('embed');break;
		}
		
		return apply_filters('mymo_get_file_urls', $result, (object) $this->attributes);
	}
	
	protected function get_extension() {
		$file_name = basename($this->url);
		return explode('.', $file_name)[count(explode('.', $file_name)) - 1];
	}
	
	protected function get_video_youtube() {
		return [
			(object) [
				'file' => 'https://www.youtube.com/embed/' . mymo_get_youtube_id($this->url),
				'type' => 'mp4',
			]
		];
	}
	
	protected function get_video_vimeo() {
		return [
			(object) [
				'file' => 'https://player.vimeo.com/video/' . get_vimeo_id($this->url),
				'type' => 'mp4',
			]
		];
	}
	
	protected function get_video_url($type) {
		$subtitles = Subtitle::get_rows(['video_file_id' => $this->id], '*', '`order` ASC');
		if (empty($subtitles)) {
			return [
				(object) [
					'file' => $this->url,
					'type' => $type,
				]
			];
		}
		
		$tracks = [];
		foreach ($subtitles as $subtitle) {
			$tracks[] = (object) [
				'kind' => 'captions',
                'file' => $subtitle->url,
                'label' => $subtitle->label
			];
		}
		
		return [
			(object) [
				'file' => $this->url,
				'type' => $type,
				'tracks' => $tracks
			]
		];
	}
}