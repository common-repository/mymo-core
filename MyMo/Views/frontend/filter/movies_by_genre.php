<?php if (isset($items)) : ?>
<?php foreach($items as $item) : ?>
<article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-<?php echo $item->ID ?>">
	<?php include (MYMO_VIEWS_DIRECTORY . '/frontend/items/movie_item.php') ?>
</article>
<?php endforeach; ?>
<?php endif; ?>