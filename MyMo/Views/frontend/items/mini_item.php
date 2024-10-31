<div class="item post-<?php echo $item->ID ?>">
    <?php
    $other_name = get_post_meta($item->ID, 'other_name', true);
    $year = mymo_get_year_movie($item->ID);
    $title = esc_attr($item->post_title . ($other_name ? ' - ' . $other_name : ''));
    $views = get_post_meta($item->ID, 'views', true);
    ?>
	<a href="<?php echo get_permalink($item->ID) ?>" title="<?php echo $title ?>">
		<div class="item-link">
			<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url(mymo_thumbnail($item->ID)) ?>" class="lazyload blur-up post-thumb" alt="<?php echo $title ?>" title="<?php echo $title ?>" />
		</div>
		<h3 class="title"><?php echo esc_html($item->post_title) ?></h3>
		<p class="original_title"><?php echo esc_html($other_name) ?> <?php if ($year) : ?>(<?php echo $year ?>)</p><?php endif; ?>
	</a>
	<div class="viewsCount"><?php echo $views ?> <?php _e('Views', 'mymo') ?></div>
</div>