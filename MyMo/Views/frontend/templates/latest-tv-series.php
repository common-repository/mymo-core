<?php
$args = [
	'post_type' => 'movie',
	'meta_key'   => 'tv_series',
	'meta_value' => '1',
	'orderby' => 'ID',
	'order'   => 'DESC',
];

$query = new WP_Query( $args );
?>

<?php get_header(); ?>

<div class="row container" id="wrapper">
	<div class="mymo-panel-filter">
		<div class="panel-heading">
			<div class="row">
				
				<div class="col-xs-8 hidden-xs">
					<div class="yoast_breadcrumb">
                        <span>
                            <span>
                                <a href="<?php echo esc_url(get_home_url()) ?>"><?php _e('Home', 'mymo') ?></a> »
                                <span class="breadcrumb_last" aria-current="page"><?php echo get_the_title(); ?></span>
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
		<section>
			<div class="section-bar clearfix">
				<h3 class="section-title">
					<span><?php echo get_the_title(); ?></span>
				</h3>
			</div>
			
			<div class="mymo_box">
				<?php if ( $query->have_posts() ) : ?>

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					
						<?php mymo_get_template_part( 'content', 'movie' ); ?>
					
					<?php endwhile; ?>
     
				<?php else : ?>
				
					<?php mymo_get_template_part( 'content', 'none' ); ?>
				
				<?php endif; ?>
    
			</div>
            
            <div class="clearfix"></div>
            <div class="text-center">
				<?php mymo_pagination(); ?>
            </div>
		
		</section>
	</main>
	
	<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
		<?php get_sidebar(); ?>
	</aside>
</div>

<?php get_footer(); ?>
