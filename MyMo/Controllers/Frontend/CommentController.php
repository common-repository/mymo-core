<?php

namespace MyMo\Controllers\Frontend;

class CommentController {
	public function init() {
		add_filter('comments_template', [$this, 'comments_template'], 10, 1);
	}
	
	public function comments_template($theme_template) {
		return (MYMO_VIEWS_DIRECTORY . '/frontend/theme/comments.php');
	}
}