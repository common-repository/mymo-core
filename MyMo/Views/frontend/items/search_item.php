<li><?php echo __('Result for keyword', 'mymo') ?>: <strong class="text-danger"><?php echo $keyword ?></strong></li>
<?php if (isset($items)) : ?>
<?php foreach($items as $item) : ?>
<?php
$other_name = get_post_meta($item->ID, 'other_name', true);
$title = esc_attr($item->post_title . ($other_name ? ' - ' . $other_name : ''));
?>
<li class="exact_result">
	<a href="<?php echo get_permalink($item->ID) ?>" title="<?php echo $title ?>">
		<div class="mymo_list_item">
			<div class="image"><img src="<?php echo esc_url(mymo_thumbnail($item->ID)) ?>" alt="<?php echo $title ?>"></div>
			<span class="label"><?php echo $item->post_title ?></span>
			<span class="enName"><?php echo $other_name ?></span>
			<span class="date"><?php echo get_post_time('U', false, $item->ID) ?></span>
		</div>
	</a>
</li>
<?php endforeach; ?>
<?php endif; ?>