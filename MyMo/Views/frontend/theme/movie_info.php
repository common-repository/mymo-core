<div class="row container" id="wrapper">
    <?php
    $player_id = mymo_get_video_file($post_id);
    $play_link = add_query_arg('view', $player_id, get_permalink(get_the_ID()));
    ?>
	<div class="mymo-panel-filter">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8 hidden-xs">
					<div class="yoast_breadcrumb">
                        <span>
                            <span>
                                <a href="<?php echo get_home_url() ?>"><?php _e('Home', 'mymo') ?></a> »
                                <?php if(isset($genres[0])) : ?>
	                                <a href="<?php echo get_term_link($genres[0]->term_id) ?>"><?php echo $genres[0]->name ?></a> »
                                <?php endif; ?>

                                <span class="breadcrumb_last" aria-current="page"><?php echo $title ?></span>
                            </span>
                        </span>
					</div>
				</div>
				
				<?php do_action('mymo_ajax_filter') ?>
			
			</div>
		</div>
		<div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
			<div class="ajax"></div>
		</div>
	</div><!-- end panel-default -->
	
	<main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
		<section id="content">
			<div class="clearfix wrap-content">
				<?php include_once MYMO_VIEWS_DIRECTORY . '/frontend/watch/global_script.php'; ?>
				
				<div class="mymo-movie-wrapper">
					<div class="title-block watch-page">
                        <?php do_action('mymo_add_to_bookmark', $post_id, $title, $release) ?>
                        
						<div class="title-wrapper">
							<h1 class="entry-title" data-toggle="tooltip" title="<?php echo $title ?>"><?php echo $title ?><?php if ($year) : ?><span class="title-year"> (<a href="" rel="tag"><?php echo $year ?></a>)</span><?php endif; ?></h1>
						</div>
						
						<div class="ratings_wrapper hidden-xs">
							<div class="mymo_imdbrating taq-score">
								<span class="score"><?php echo $star ?></span><i>/</i>
								<span class="max-ratings">5</span>
								<span class="total_votes"><?php echo mymo_count_rating_movie($post_id) ?></span><span class="vote-txt"> <?php _e('Votes', 'mymo') ?></span>
							</div>
							<div class="rate-this">
								<div data-rate="<?php echo $star * 100 / 5 ?>" data-id="<?php echo $post_id ?>" class="user-rate user-rate-active">
                                    <span class="user-rate-image post-large-rate stars-large">
                                        <span style="width: <?php echo $star * 100 / 5 ?>%"></span>
                                    </span>
								</div>
							</div>
						</div>
						
						<div class="more-info">
							<?php if($tv_series == 0) : ?>
								<span><?php _e('Full', 'mymo') ?></span>
							<?php if ($runtime) : ?>
								<span><?php echo $runtime ?></span>
                            <?php endif; ?>
							<?php else : ?>
								<span><?php _e('Episode', 'mymo') ?>
									<?php
									$current_episode = get_post_meta($post_id, 'current_episode', true);
									$max_episode = get_post_meta($post_id, 'max_episode', true);
									echo $current_episode;
									echo $max_episode ? '/' . $max_episode : '';
									?></span>
							<?php endif; ?>
							<span>
                                <?php if ($genres) : ?>
                                <?php foreach($genres as $genre) : ?>
	                                <a href="<?php echo get_term_link($genre->term_id, 'genre') ?>" rel="category tag"><?php echo $genre->name ?></a>,
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </span>
						</div>
					</div>
					<div class="movie_info col-xs-12">
						<div class="movie-poster col-md-3">
							<img class="movie-thumb" src="<?php echo mymo_thumbnail($post_id) ?>" alt="<?php echo $title ?>">
							<div class="mymo_imdbrating"><span><?php echo $rating ?></span></div>
       
							<a href="<?php echo $play_link ?>" class="btn btn-sm btn-danger watch-movie visible-xs-block" rel="nofollow"><i class="hl-play"></i><?php _e('Watch', 'mymo') ?></a>
							
							<span id="show-trailer" data-url="<?php echo $trailer ? 'https://www.youtube.com/embed/' . mymo_get_youtube_id($trailer) : '' ?>" class="btn btn-sm btn-primary show-trailer">
                            <i class="hl-youtube-play"></i> <?php _e('Trailer', 'mymo') ?></span>
							
							<span class="btn btn-sm btn-success quick-eps" data-toggle="collapse" href="#collapseEps" aria-expanded="false" aria-controls="collapseEps">
                                    <i class="hl-sort-down"></i> <?php _e('Episodes', 'mymo') ?>
                            </span>
						</div>
						
						<div class="film-poster col-md-9">
							<div class="film-poster-img" style="background: url('<?php echo mymo_image_url($poster) ?>'); background-size: cover; background-repeat: no-repeat;background-position: 30% 25%;height: 300px;-webkit-filter: grayscale(100%); filter: grayscale(100%);"></div>
							<?php if($player_id) : ?>
								<div class="mymo-play-btn hidden-xs">
									<a href="<?php echo $play_link ?>" class="play-btn" title="<?php _e('Click to play', 'mymo') ?>" data-toggle="tooltip" data-placement="bottom" rel="nofollow"><?php _e('Click to play', 'mymo') ?></a>
								</div>
							<?php endif; ?>
							
							<div class="movie-trailer hidden"></div>
							<div class="movie-detail">
								<?php if($countries) : ?>
									<p class="actors"><?php _e('Countries', 'mymo') ?>:
										<?php foreach($countries as $country) : ?>
											<a href="<?php echo get_term_link($country->term_id, 'country') ?>" title="<?php echo esc_html($country->name) ?>"><?php echo $country->name ?></a>
										<?php endforeach; ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				
				</div>
				
				<div class="clearfix"></div>
				
				<div id="mymo_trailer"></div>
				
				<div class="collapse" id="collapseEps">
					<div class="text-center mymo-ajax-list-server">
						<div id="mymo-ajax-list-server">
							<!--<script>var svlists = [];</script>-->
						</div>
					</div>
					
					<div id="mymo-list-server" class="list-eps-ajax">
						<?php foreach($servers as $server) : ?>
							<?php
							$video_files = mymo_get_video_files($server->id);
							?>
							<div class="mymo-server show_all_eps" data-episode-nav="">
                            <span class="mymo-server-name">
                                <span class="hl-server"></span> <?php echo esc_html($server->name) ?>
                            </span>
								
								<ul id="listsv-<?php echo $server->id ?>" class="mymo-list-eps">
									<?php foreach($video_files as $file) : ?>
										<li class="mymo-episode mymo-episode-<?php echo $file->id ?>"><a href="<?php echo mymo_get_current_url(['view' => $file->id]) ?>" title="1"><span class="mymo-info-<?php echo $file->id ?> box-shadow mymo-btn" data-post-id="<?php echo $post_id ?>" data-server="<?php echo $server->id ?>" data-episode-slug="<?php echo $file->id ?>" data-position="first" data-embed="0"><?php echo esc_html($file->label) ?></span></a></li>
									<?php endforeach; ?>
								</ul>
								
								<div class="clearfix"></div>
							</div>
							<div id="pagination-<?php echo $server->id ?>"></div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="clearfix"></div>
    
				<!--<div class="mymo--notice">
				</div>-->
				
				<?php mymo_ads('player_bottom', '<div class="mb-3">', '</div>') ?>
    
				<div class="entry-content htmlwrap clearfix">
					<div class="video-item mymo-entry-box">
						<article id="post-<?php echo $post_id ?>" class="item-content">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								
								<?php the_content(); ?>
							
							<?php endwhile; ?>
							<?php endif; ?>
						</article>
						<div class="item-content-toggle">
							<div class="item-content-gradient"></div>
							<span class="show-more" data-single="true" data-showmore="<?php _e('Show more', 'mymo') ?>" data-showless="<?php _e('Show less', 'mymo') ?>"><?php _e('Show more', 'mymo') ?></span>
						</div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				
				<div class="comments">
					<?php
					if (comments_open()){
						comments_template();
					}
					?>
				</div>
			
			</div>
		
		</section>
		
		<section class="related-movies">
			
			<div id="mymo_related_movies-2xx" class="wrap-slider">
				<div class="section-bar clearfix">
					<h3 class="section-title"><span><?php _e('Similar Movies', 'mymo') ?></span></h3>
				</div>
                <?php if ($related_movies) : ?>
				<div id="mymo_related_movies-2" class="owl-carousel owl-theme related-film">
					<?php foreach($related_movies as $item) : ?>
						<article class="thumb grid-item post-<?php echo $item->ID ?>">
							<?php include MYMO_VIEWS_DIRECTORY . '/frontend/items/relate_item.php' ?>
						</article>
					<?php endforeach; ?>
				</div>
                <?php endif; ?>
                
				<script type="text/javascript">
                    $(document).on("turbolinks:load", function() {
                        var owl = $('#mymo_related_movies-2');
                        owl.owlCarousel({
                            loop: true,
                            margin: 4,
                            autoplay: true,
                            autoplayTimeout: 4000,
                            autoplayHoverPause: true,
                            nav: true,
                            navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                            responsiveClass: true,
                            responsive: {
                                0: {items:2},
                                480: {items:3},
                                600: {items:4},
                                1000: {items: 4}
                            }
                        });
                    });
				</script>
			</div>
		</section>
		
		<div class="the_tag_list">
            <?php if ($tags) : ?>
			<?php foreach($tags as $tag) : ?>
				<a href="<?php echo get_term_link($tag->term_id, 'post_tag') ?>" title="<?php echo esc_html($tag->name) ?>" rel="tag"><?php echo $tag->name ?></a>
			<?php endforeach; ?>
            <?php endif; ?>
		</div>
	</main>
	
	<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
		<?php get_sidebar(); ?>
	</aside>
</div>