<div id="mymo-carousel-widget-3xx-<?php echo $this->id ?>" class="wrap-slider">
	<div class="section-bar clearfix">
		<h3 class="section-title"><span><?php echo $title ?></span></h3>
	</div>
	<div id="<?php echo $this->id ?>" class="owl-carousel owl-theme">
        <?php if (isset($items)) : ?>
		<?php foreach($items as $item) : ?>
		<article class="thumb grid-item post-<?php echo $item->id ?>">
			<?php include MYMO_VIEWS_DIRECTORY . '/frontend/items/movie_item.php'; ?>
		</article>
		<?php endforeach; ?>
        <?php endif; ?>
	</div>
 
	<script type="text/javascript">
        jQuery(document).ready(function ($) {
            var owl = $('#<?php echo $this->id ?>');
            owl.owlCarousel({
                rtl: false,
                loop: true,
                margin: 4,
                <?php if ($autoplay == 1) : ?>
                autoplay: true,
                <?php endif; ?>
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: false,
                navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                responsiveClass: true,
                responsive: {0: {items: 2}, 480: {items: 3}, 600: {items: 4}, 1000: {items: 6}}
            })
        });
	</script>
</div>