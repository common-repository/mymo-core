<div class="row container" id="wrapper">
    <?php
    $player_id = esc_attr($_GET['view']);
    ?>
	<div class="mymo-panel-filter">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8 hidden-xs">
					<div class="yoast_breadcrumb">
                        <span>
                            <span>
                                <a href="<?php echo get_home_url() ?>"><?php echo __('Home', 'mymo') ?></a> »
	                            
                                <?php if(isset($genres[0])) : ?>
                                    <a href="<?php echo get_term_link($genres[0]->term_id) ?>"><?php echo $genres[0]->name ?></a> »
                                <?php endif; ?>
	                            
                                <a href="<?php echo get_permalink($post_id) ?>"><?php echo $title ?></a> »

                                <span class="breadcrumb_last" aria-current="page"><?php echo __('Episode', 'mymo') ?> <?php echo mymo_get_video_file_label($player_id) ?></span>
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
				<?php
				$is_watch = 1;
				include_once MYMO_VIEWS_DIRECTORY . '/frontend/watch/global_script.php';
				?>
				
				<div class="clearfix"></div>
				<div class="text-center">
					<div class="textwidget">
					</div>
				</div>
				<div class="clearfix"></div>
				
				<div id="mymo-player-wrapper" class="ajax-player-loading" data-adult-content="">
					<div id="mymo-player-loader"></div>
					<div id="ajax-player" class="player"></div>
				</div>
				
				<div class="clearfix"></div>
				
				<div class="button-watch">
					<ul class="mymo-social-plugin col-xs-4 hidden-xs">
						<li class="fb-like" data-href="<?php echo mymo_get_current_url() ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
					</ul>
					<ul class="col-xs-12 col-md-8">
						<div id="autonext" class="btn-cs autonext">
							<i class="icon-autonext-sm"></i>
							<span><i class="hl-next"></i> <?php echo __('Autoplay next episode', 'mymo') ?>: <span id="autonext-status"><?php _e('On', 'mymo') ?></span></span>
						</div>
						
						<div id="explayer" class="hidden-xs">
							<i class="hl-resize-full"></i>
							<?php _e('Expand', 'mymo') ?>
						</div>
						
						<div id="toggle-light"><i class="hl-adjust"></i>
							<?php _e('Light off', 'mymo') ?>
						</div>
						
						<div id="report" class="mymo-switch">
							<i class="hl-attention"></i> <?php _e('Report', 'mymo') ?>
						</div>
						
						<div class="luotxem"><i class="hl-eye"></i>
							<span><?php echo get_post_meta($post_id, 'views', true); ?></span> <?php _e('Views', 'mymo') ?>
						</div>
						
						<div class="luotxem visible-xs-inline">
							<a data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> <?php _e('Share', 'mymo') ?></a>
						</div>
					
					</ul>
				</div>
				
				<div class="collapse" id="moretool">
					<ul class="nav nav-pills x-nav-justified">
						<li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
						<div class="fb-save" data-uri="" data-size="small"></div>
					</ul>
				</div>
				
				<div class="clearfix"></div>
				<?php mymo_ads('player_bottom', '<div class="mb-3">', '</div>') ?>
				
				<div class="text-center">
					
					<div class="textwidget">
						<style type="text/css">
							#main-contents{position:relative;}
							.float-left{position:absolute;left:-130px;top:0;}
							.float-right{position:absolute;right:-460px;top:0;}
						</style>
					
					</div>
				</div>
				<div class="clearfix"></div>
				
				<div class="title-block watch-page">
					<?php do_action('mymo_add_to_bookmark', $post_id, $title, $release) ?>
					
					<div class="title-wrapper full">
						<h1 class="entry-title"><a href="<?php echo get_permalink($post_id) ?>" title="<?php echo $title ?>" class="tl"><?php echo $title ?></a></h1>
						
						<span class="plot-collapse" data-toggle="collapse" data-target="#expand-post-content" aria-expanded="false" aria-controls="expand-post-content" data-text="<?php _e('Movie plot', 'mymo') ?>"><i class="hl-angle-down"></i></span>
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
				</div>
				
				<div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
					<article id="post-<?php echo $post_id ?>" class="item-content post-<?php echo $post_id ?>">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							
							<?php the_content(); ?>
						
						<?php endwhile; ?>
						<?php endif; ?>
					</article>
				</div>
				
				<div class="clearfix"></div>
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
                                <span class="hl-server"></span> <?php echo $server->name ?>
                            </span>
						
						<ul id="listsv-<?php echo $server->id ?>" class="mymo-list-eps">
							<?php foreach($video_files as $file) : ?>
							<li class="mymo-episode mymo-episode-<?php echo $file->id ?> <?php if($file->id == $player_id) : ?> active <?php endif; ?>"><a href="<?php echo mymo_get_current_url(['view' => $file->id]) ?>" title="1"><span class="mymo-info-<?php echo $file->id ?> box-shadow mymo-btn <?php if($file->id == $player_id) : ?> active <?php endif; ?>" data-post-id="<?php echo $post_id ?>" data-server="<?php echo $server->id ?>" data-episode-slug="<?php echo $file->id ?>" data-position="first" data-embed="0"><?php echo esc_html($file->label) ?></span></a></li>
							<?php endforeach; ?>
						</ul>
						
						<div class="clearfix"></div>
					</div>
					<div id="pagination-<?php echo $server->id ?>"></div>
					<?php endforeach; ?>
				</div>
				<div class="clearfix"></div>
				
				<?php
                if (comments_open()){
					comments_template();
				}
                ?>
				
				<div id="lightout"></div>
			
			</div>
		</section>
		
		<section class="related-movies">
			
			<div id="mymo_related_movies-2xx" class="wrap-slider">
				<div class="section-bar clearfix">
					<h3 class="section-title"><span><?php echo __('Similar Movies', 'mymo') ?></span></h3>
				</div>
				<div id="mymo_related_movies-2" class="owl-carousel owl-theme related-film">
                    <?php if ($related_movies) : ?>
					<?php foreach($related_movies as $item) : ?>
						<article class="thumb grid-item post-<?php echo $item->ID ?>">
							<?php include MYMO_VIEWS_DIRECTORY . '/frontend/items/relate_item.php' ?>
						</article>
					<?php endforeach; ?>
                    <?php endif; ?>
				</div>
				<script type="text/javascript">
                    jQuery(document).ready(function ($) {
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
                            responsive: {0: {items: 2}, 480: {items: 3}, 600: {items: 4}, 1000: {items: 4}}
                        })
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