<?php
$item = new stdClass();
$item->ID = get_the_ID();
$item->post_title = get_the_title();
?>
<article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-<?php echo $item->ID; ?>" id="post-<?php echo $item->ID; ?>">
    <?php include (MYMO_VIEWS_DIRECTORY . '/frontend/items/movie_item.php'); ?>
</article>