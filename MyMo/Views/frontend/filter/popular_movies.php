<?php if (isset($items)) : ?>
	<?php foreach($items as $item) : ?>
		<?php include (MYMO_VIEWS_DIRECTORY . '/frontend/items/mini_item.php') ?>
	<?php endforeach; ?>
<?php endif; ?>