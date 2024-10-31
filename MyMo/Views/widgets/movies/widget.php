<section id="mymo-advanced-widget-<?php echo $this->id ?>">
	<h4 class="section-heading">
		<a href="" title="<?php echo esc_attr($title) ?>">
			<span class="h-text"><?php echo $title ?></span>
		</a>
		
		<?php if($child_genres) : ?>
		<ul class="heading-nav pull-right hidden-xs">
			<?php foreach($child_genres as $child) : ?>
			<li class="section-btn mymo_ajax_get_post" data-catid="<?php echo $child->term_id ?>" data-showpost="<?php echo $post_number ?>" data-widgetid="mymo-advanced-widget-<?php echo $this->id ?>" data-layout="6col">
				<span data-text="<?php echo esc_attr($child->name) ?>"></span>
			</li>
            <?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</h4>
	
	<div id="mymo-advanced-widget-<?php echo $this->id ?>-ajax-box" class="mymo_box">
		<?php if(isset($items)) : ?>
		<?php foreach($items as $item) : ?>
		<article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-<?php echo $item->ID ?>">
			<?php include (MYMO_VIEWS_DIRECTORY . '/frontend/items/movie_item.php') ?>
		</article>
        <?php endforeach; ?>
		<?php endif; ?>
		
		<a href="" class="see-more"><?php _e('View all', 'mymo') ?> »</a>
	</div>
</section>
<div class="clearfix"></div>