<div class="form-field">
	<label for="tv_series"><?php echo __('Type', 'mymo') ?></label><br>
	<select name="tv_series" id="tv_series" class="w-100">
		<option value="0" <?php if ($tv_series == 0) echo 'selected' ?>><?php echo __('Movie', 'mymo') ?></option>
		<option value="1" <?php if ($tv_series == 1) echo 'selected' ?>><?php echo __('TV Series', 'mymo') ?></option>
	</select>
</div>

<div class="box-hidden box-tv_series-fields" <?php if ($tv_series == 1) echo 'style="display: block;"' ?>>
	<div class="form-field">
		<label for="current_episode"><?php echo __('Current Episode', 'mymo') ?></label><br>
		<input type="number" name="current_episode" id="current_episode" value="<?php echo esc_attr($current_episode) ?>">
	</div>
	
	<div class="form-field">
		<label for="max_episode"><?php echo __('Max Episode', 'mymo') ?></label><br>
		<input type="number" name="max_episode" id="max_episode" value="<?php echo esc_attr($max_episode) ?>">
	</div>
</div>