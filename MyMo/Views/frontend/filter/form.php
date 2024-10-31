<div class="mymo-search-filter">
	<?php
	$genres = get_terms(['taxonomy' => 'genre']);
	$countries = get_terms(['taxonomy' => 'country']);
	$years = get_terms(['taxonomy' => 'movie_year']);
	?>
	<div class="btn-group col-md-12">
		<form action="<?php echo esc_url(mymo_get_search_url()) ?>" id="form-filter" class="form-inline" method="GET">
			<input type="hidden" name="q" value="">
			<div class="col-md-1 col-xs-12 col-sm-6">
				<div class="filter-box">
					<div class="filter-box-title"><?php _e('Sort', 'mymo') ?></div>
					<select class="form-control" id="sort" name="sort">
						<option value=""><?php _e('Sort', 'mymo') ?></option>
						<option value="latest"><?php _e('Latest', 'mymo') ?></option>
						<option value="top_views"><?php _e('Top views', 'mymo') ?></option>
						<option value="new_update"><?php _e('New update', 'mymo') ?></option>
					</select>
				</div>
			</div>
			
			<div class="col-md-1 col-xs-12 col-sm-6">
				<div class="filter-box">
					<div class="filter-box-title"><?php _e('Formats', 'mymo') ?></div>
					<select class="form-control" id="type" name="formality">
						<option value=""><?php _e('Formats', 'mymo') ?></option>
						<option value="1"><?php _e('Movies', 'mymo') ?></option>
						<option value="2"><?php _e('TV series', 'mymo') ?></option>
					</select>
				</div>
			</div>
			
			<div class="col-md-2 col-xs-12 col-sm-6">
				<div class="filter-box">
					<div class="filter-box-title"><?php _e('Status', 'mymo') ?></div>
					<select class="form-control" name="status">
						<option value=""><?php _e('Status', 'mymo') ?></option>
						<option value="completed"><?php _e('Completed', 'mymo') ?></option>
						<option value="ongoing"><?php _e('Ongoing', 'mymo') ?></option>
					</select>
				</div>
			</div>
			
			<div class="col-md-2 col-xs-12 col-sm-6">
				<div class="filter-box">
					<div class="filter-box-title"><?php _e('Country', 'mymo') ?></div>
					<select class="form-control" name="country">
						<option value=""><?php _e('Country', 'mymo') ?></option>
						<?php foreach($countries as $country) : ?>
							<option value="<?php echo $country->term_id ?>"><?php echo $country->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-1 col-xs-12 col-sm-6">
				<div class="filter-box">
					<div class="filter-box-title"><?php _e('Year', 'mymo') ?></div>
					<select class="form-control" name="release">
						<option value=""><?php _e('Year', 'mymo') ?></option>
						<?php foreach($years as $year) : ?>
							<option value="<?php echo $year->term_id ?>"><?php echo $year->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="col-md-3 col-xs-12 col-sm-6">
				<div class="filter-box">
					<div class="filter-box-title"><?php _e('Genre', 'mymo') ?></div>
					<select class="form-control" id="genre" name="genre">
						<option value=""><?php _e('Genre', 'mymo') ?></option>
						<?php foreach($genres as $genre) : ?>
							<option value="<?php echo $genre->term_id ?>"><?php echo $genre->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="col-md-2 col-xs-12 col-sm-6">
				<button type="submit" id="btn-movie-filter" class="btn btn-danger"><?php _e('Filter movies', 'mymo') ?></button>
			</div>
		</form>
	</div>
</div>
