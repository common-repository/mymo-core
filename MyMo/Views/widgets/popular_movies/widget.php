<div id="mymo_tab_popular_videos-widget-5" class="widget mymo_tab_popular_videos-widget">
    <div class="section-bar clearfix">
        <div class="section-title">
            <span><?php echo esc_html($title) ?></span>
            <ul class="mymo-popular-tab" role="tablist">
                <?php if (in_array('day', $tablist)) : ?>
                <li role="presentation" class="active">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="<?php echo $post_number ?>" data-type="day"><?php echo __('Day', 'mymo') ?></a>
                </li>
                <?php endif; ?>
	            <?php if (in_array('day', $tablist)) : ?>
                <li role="presentation">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="<?php echo $post_number ?>" data-type="week"><?php echo __('Week', 'mymo') ?></a>
                </li>
	            <?php endif; ?>
	            <?php if (in_array('month', $tablist)) : ?>
                <li role="presentation">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="<?php echo $post_number ?>" data-type="month"><?php echo __('Month', 'mymo') ?></a>
                </li>
                <?php endif; ?>
	            <?php if (in_array('all', $tablist)) : ?>
                <li role="presentation">
                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="<?php echo $post_number ?>" data-type="all"><?php echo __('All', 'mymo') ?></a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    
    <section class="tab-content">
        <div role="tabpanel" class="tab-pane active mymo-ajax-popular-post">
            <div class="mymo-ajax-popular-post-loading hidden"></div>
            <div id="mymo-ajax-popular-post" class="popular-post"></div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>