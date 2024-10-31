<div class="mymo-item">
	<?php
    $other_name = get_post_meta($item->ID, 'other_name', true);
    $video_quality = get_post_meta($item->ID, 'video_quality', true);
    $tv_series = get_post_meta($item->ID, 'tv_series', true);
    $year = mymo_get_year_movie($item->ID);
    $short_description = esc_attr(strip_tags(get_the_excerpt($item->ID)));
    $title = esc_attr($item->post_title . ($other_name ? ' - ' . $other_name : ''));
	$genres = get_the_terms($item->ID, 'genre');
	$countries = get_the_terms($item->ID, 'country');
	
	$genre_str = '';
	if ($genres) {
		foreach ($genres as $genre) {
			$genre_str .= '<span class=category-name>'. @$genre->name .'</span>';
		}
    }
	
	$country_str = '';
	if ($countries) {
		foreach ($countries as $country) {
			$country_str .= '<span class=category-name>'. @$country->name .'</span>';
		}
    }
	?>
	<a class="mymo-thumb" href="<?php echo get_permalink($item->ID) ?>" title="<?php echo $title ?>">
		<figure>
			<img class="lazyload blur-up img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url(mymo_thumbnail($item->ID)) ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>">
		</figure>
		<span class="status"><?php echo $video_quality ?></span>
		<?php if($tv_series == 0) : ?>
		<span class="episode"><?php _e('Full', 'mymo') ?></span>
		<?php
        else :
            $current_episode = get_post_meta($item->ID, 'current_episode', true);
            $max_episode = get_post_meta($item->ID, 'max_episode', true);
        ?>
		<span class="episode"><?php __('Episode', 'mymo') ?> <?php echo $current_episode ?><?php echo $max_episode ? '/' . $max_episode : '' ?></span>
		<?php endif; ?>
  
		<div class="icon_overlay" data-html="true"
		     data-toggle="mymo-popover"
		     data-placement="top"
		     data-trigger="hover"
		     title="<span class=film-title><?php echo esc_html($item->post_title) ?></span>"
		     data-content="<div class=org-title><?php echo esc_html($other_name) ?> (<?php echo $year ?>)</div>                            <div class=film-meta>
                           <div class=film-content><?php echo $short_description ?></div>
                            <p class=category><?php _e('Countries', 'mymo') ?>: <?php echo $country_str ?></p>                                <p class=category><?php _e('Genres', 'mymo') ?>: <?php echo $genre_str ?></p>
                        </div>">
		</div>
		
		<div class="mymo-post-title-box">
			<div class="mymo-post-title ">
				<h2 class="entry-title"><?php echo $item->post_title ?></h2>
				<p class="original_title"><?php echo $other_name ?> <?php if ($year) : ?>(<?php echo $year ?>)<?php endif; ?></p>
			</div>
		</div>
	</a>
</div>