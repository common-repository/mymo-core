<?php
use MyMo\Helpers\Request;
?>

<?php get_header(); ?>

<?php
$keyword = Request::input('q', '', Request::$TEXT);
$formality = Request::input('formality', '', Request::$TEXT);
$country = Request::input('country', null, Request::$INT);
$genre = Request::input('genre', null, Request::$INT);
$release = Request::input('release', null, Request::$INT);

$args = [];
$args = [
    'post_type' => 'movie'
];

if ($keyword) {
    $args['meta_query'][] = [
	    [
		    'relation' => 'OR',
		    [
			    'key'     => 'search_title',
			    'value'   => $keyword,
			    'compare' => 'LIKE',
		    ],
		    [
			    'key'     => 'other_name',
			    'value'   => $keyword,
			    'compare' => 'LIKE',
		    ]
	    ]
    ];
}

if ($formality) {
	$args['meta_query'][] = [
		'key'     => 'tv_series',
		'value'   => $formality == 2 ? 1 : 0,
	];
}

if (isset($args['meta_query']) && count($args['meta_query']) > 1) {
    $args['meta_query']['relation'] = 'AND';
}

if ($genre) {
    $args['tax_query'][] = [
	    'taxonomy' => 'genre',
	    'field'    => 'term_id',
	    'terms'    => [ $genre ],
    ];
}

if ($country) {
	$args['tax_query'][] = [
		'taxonomy' => 'country',
		'field'    => 'term_id',
		'terms'    => [ $country ],
	];
}

if ($release) {
	$args['tax_query'][] = [
		'taxonomy' => 'movie_year',
		'field'    => 'term_id',
		'terms'    => [ $release ],
	];
}

if (isset($args['tax_query']) && count($args['tax_query']) > 1) {
	$args['tax_query']['relation'] = 'AND';
}

$query = new WP_Query( $args );
?>
    <div class="row container" id="wrapper">
        <div class="mymo-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    
                    <div class="col-xs-8 hidden-xs">
                        <div class="yoast_breadcrumb">
                        <span>
                            <span>
                                <a href="<?php echo esc_url(get_home_url()) ?>"><?php echo __('Home', 'mymo') ?></a> »
                                <?php if ($s) : ?>
                                    <span class="breadcrumb_last" aria-current="page"><?php printf( __('Search results for "%1$s"', 'mymo'), $keyword); ?></span>
                                <?php else : ?>
                                    <span class="breadcrumb_last" aria-current="page"><?php echo __('Search results', 'mymo'); ?></span>
                                <?php endif; ?>
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
                    <?php if ($s) : ?>
                        <span><?php printf( __('Search results for "%1$s"', 'mymo'), $keyword); ?></span>
                    <?php else : ?>
                        <span><?php _e('Search results', 'mymo'); ?></span>
                    <?php endif; ?>
                    </h3>
                </div>
	
	            <?php mymo_ads('genre_header') ?>
                
                <div class="mymo_box">
	                <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		                <?php mymo_get_template_part( 'content', 'movie' ); ?>
	                <?php endwhile; ?>
		               
	                <?php else : ?>
		                <?php mymo_get_template_part( 'content', 'none' ); ?>
	                <?php endif; ?>
                </div>
                
                <div class="clearfix"></div>
                <div class="text-center">
	                <?php mymo_pagination( $query ); ?>
                </div>
                
            </section>
        </main>
        
        <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
	        <?php get_sidebar(); ?>
        </aside>
    </div>
<?php get_footer(); ?>