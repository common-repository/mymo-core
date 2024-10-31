<?php
$recently_visited = mymo_recently_visited();
?>
<?php do_action('mymo_header_profile') ?>

<div class="section-bar clearfix">
	<div class="section-title">
		<span><?php _e('Recently visited', 'mymo') ?></span>
	</div>
</div>

<section class="tab-content">
	<div role="tabpanel" class="tab-pane active">
		<div class="popular-post">
			<?php foreach($recently_visited as $item) : ?>
				<?php include (MYMO_VIEWS_DIRECTORY . '/frontend/items/mini_item.php') ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>