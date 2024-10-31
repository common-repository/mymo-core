<?php
$post_id = get_the_ID();
$title = esc_attr(get_the_title());
$tv_series = get_post_meta($post_id, 'tv_series', true);
$runtime = get_post_meta($post_id, 'runtime', true);
$release = get_post_meta($post_id, 'release', true);
$rating = get_post_meta($post_id, 'rating', true);
$year = mymo_get_year_movie($post_id);
$poster = get_post_meta($post_id, 'poster', true);
$trailer = get_post_meta($post_id, 'trailer', true);

$servers = mymo_get_servers($post_id);
$genres = get_the_terms($post_id, 'genre');
$countries = get_the_terms($post_id, 'country');
$tags = get_the_terms($post_id,'post_tag');
$related_movies = mymo_get_related_movies([@$genres[0]->term_id]);
$star = mymo_get_star_movie($post_id);
$view = isset($_GET['view']) ? (int) $_GET['view'] : null;

do_action('mymo_before_watch_movie', $post_id, $view);
?>

<?php get_header(); ?>

<?php
if ($view > 0) {
	include (MYMO_VIEWS_DIRECTORY . '/frontend/theme/movie_watch.php');
}
else {
    include (MYMO_VIEWS_DIRECTORY . '/frontend/theme/movie_info.php');
}
?>

<?php get_footer(); ?>