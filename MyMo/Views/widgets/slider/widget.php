<div class="container">
	<div class="text-center"></div>
	<div class="row fullwith-slider">
		<!-- Wrapper For Slides -->
		<div id="mymo-fullwith-slider-<?php echo $this->id ?>" class="owl-carousel owl-carousel-fullwidth owl-theme">
			<?php foreach($sliders as $index => $item) : ?>
			<div class="post-<?php echo $index ?> item">
				<a href="<?php echo esc_url(@$item->url) ?>" title="<?php echo esc_attr(@$item->title) ?>">
					<img src="<?php echo mymo_image_url(@$item->banner) ?>" alt="<?php echo esc_attr(@$item->title) ?>" class="slide-image" />
					<div class="slide-text">
						<h3 class="slider-title"><?php echo @$item->title ?></h3>
						<div class="slider-meta hidden-xs">
							<p><?php echo esc_html(@$item->description) ?></p>
                        </div>
					</div>
				</a>
			</div>
			<?php endforeach; ?>
		</div><!-- End of Wrapper For Slides -->
		<script type="text/javascript">
            jQuery(document).ready(function($) {
                var owl = $('#mymo-fullwith-slider-<?php echo $this->id ?>');
                owl.owlCarousel({
                    rtl:false,
                    items: 1,
                    loop: true,
                    animateOut: 'fadeOutLeft',
                    animateIn: 'fadeInRight',
	                <?php if ($speed > 0) : ?>
                    smartSpeed: 450,
	                <?php endif; ?>
	                <?php if ($autoplay == 1) : ?>
                    autoplay: true,
	                <?php endif; ?>
                    autoplayTimeout: 4000,
                    autoHeight: true,
                    autoplayHoverPause: true,
                    nav: true,
                    navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                    responsiveClass: true,
                });
            });
		</script>
	
	</div>
</div>