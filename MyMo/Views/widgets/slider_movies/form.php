<div class="mymo-widget mymo-widget-slider-movies">
	<?php
	$genres = get_terms(['taxonomy' => 'genre']);
	$countries = get_terms(['taxonomy' => 'country']);
	?>
    <p>
		<?php echo __('Title', 'mymo') ?>
        <input type="text" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $title ?>" class="w-100" />
    </p>
    
    <p>
		<?php echo __('Type', 'mymo') ?>
        <select name="<?php echo $this->get_field_name('type') ?>" class="w-100">
            <option value=""><?php echo __('All', 'mymo') ?></option>
            <option value="movies" <?php if ($type == 'movies') echo 'selected'; ?>><?php echo __('Movies', 'mymo') ?></option>
            <option value="tv_series" <?php if ($type == 'tv_series') echo 'selected'; ?>><?php echo __('TV Series', 'mymo') ?></option>
        </select>
    </p>
    
    <p>
		<?php echo __('Taxonomy', 'mymo') ?>
        <select name="<?php echo $this->get_field_name('taxonomy') ?>" class="mymo-select-taxonomy w-100">
            <option value=""><?php echo __('All', 'mymo') ?></option>
            <option value="genre" <?php if ($taxonomy == 'genre') echo 'selected'; ?>><?php echo __('Genre', 'mymo') ?></option>
            <option value="country" <?php if ($taxonomy == 'country') echo 'selected'; ?>><?php echo __('Country', 'mymo') ?></option>
        </select>
    </p>
    
    <div class="box-hidden mymo-box mymo-box-genres">
        <p>
			<?php echo __('Genre', 'mymo') ?>
            <select name="<?php echo $this->get_field_name('object_val') ?>" class="object-val w-100">
                <option value=""><?php echo __('All', 'mymo') ?></option>
				<?php foreach ($genres as $genre) : ?>
                    <option value="<?php echo $genre->term_id ?>" <?php if ($genre->term_id == $object_val) echo 'selected'; ?>><?php echo $genre->name ?></option>
				<?php endforeach; ?>
            </select>
        </p>
    </div>
    
    <div class="box-hidden mymo-box mymo-box-countries">
        <p>
			<?php echo __('Country', 'mymo') ?>
            <select name="<?php echo $this->get_field_name('object_val') ?>" class="object-val w-100">
                <option value=""><?php echo __('All', 'mymo') ?></option>
				<?php foreach ($countries as $country) : ?>
                    <option value="<?php echo $country->term_id ?>" <?php if ($country->term_id == $object_val) echo 'selected'; ?>><?php echo $country->name ?></option>
				<?php endforeach; ?>
            </select>
        </p>
    </div>
    
    <p>
		<?php echo __('Sort', 'mymo') ?>
        <select name="<?php echo $this->get_field_name('sort') ?>" class="w-100">
            <option value="id_DESC" <?php if ($sort == 'id_DESC') echo 'selected'; ?>><?php echo __('Latest', 'mymo') ?></option>
            <option value="id_ASC" <?php if ($sort == 'id_ASC') echo 'selected'; ?>><?php echo __('Oldest', 'mymo') ?></option>
            <option value="view_ASC" <?php if ($sort == 'view_ASC') echo 'selected'; ?>><?php echo __('Views low to high', 'mymo') ?></option>
            <option value="view_DESC" <?php if ($sort == 'view_DESC') echo 'selected'; ?>><?php echo __('Views high to low', 'mymo') ?></option>
            <option value="updated_DESC" <?php if ($sort == 'updated_DESC') echo 'selected'; ?>><?php echo __('Update Latest', 'mymo') ?></option>
            <option value="updated_ASC" <?php if ($sort == 'updated_ASC') echo 'selected'; ?>><?php echo __('Update Oldest', 'mymo') ?></option>
        </select>
    </p>
    
    <p><?php echo __('Post number', 'mymo') ?> <input type="number" name="<?php echo $this->get_field_name('post_number') ?>" value="<?php echo $post_number ?>" class="w-100" /></p>

    <p>
        <?php echo __('Autoplay', 'mymo') ?>
        <select name="<?php echo $this->get_field_name('autoplay') ?>">
            <option value="1" <?php if ($autoplay == 1) echo 'selected'; ?>><?php _e('Enabled', 'mymo') ?></option>
            <option value="0" <?php if ($autoplay == 1) echo 'selected'; ?>><?php _e('Disabled', 'mymo') ?></option>
        </select>
    </p>
</div>