<form method="post" action="admin-ajax.php" class="validate mymo-ajax">
	<div class="status"></div>
	<input type="hidden" name="id" value="<?php echo esc_attr($item->id) ?>">
    <input type="hidden" name="file_id" value="<?php echo esc_attr($file_id) ?>">
	<input type="hidden" name="action" value="mymo_save_subtitle">
	<?php wp_nonce_field('mymo_save_subtitle','mymo_save_subtitle'); ?>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-label"><?php _e('Label', 'mymo') ?></label>
		<input name="label" id="tag-label" type="text" value="<?php echo esc_attr($item->label) ?>" required>
	</div>
    
    <div class="form-field form-required term-name-wrap">
        <label for="tag-url"><?php _e('Label', 'mymo') ?></label>
        <input name="url" id="tag-url" type="text" value="<?php echo esc_attr($item->url) ?>" required>
    </div>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-order"><?php _e('Order', 'mymo') ?></label>
		<input name="order" id="tag-order" type="number" value="<?php echo empty($item->order) ? 1 : esc_attr($item->order) ?>" required>
	</div>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-status"><?php _e('Status', 'mymo') ?></label>
		<select name="status" id="tag-status" class="w-100">
			<option value="1" <?php if ($item->status == 1) echo 'selected' ?>><?php _e('Enabled', 'mymo') ?></option>
			<option value="0" <?php if (!is_null($item->status) && $item->status == 0) echo 'selected' ?>><?php _e('Disabled', 'mymo') ?></option>
		</select>
	</div>
	
	<p class="submit">
		<button type="submit" name="submit" class="button button-primary"><?php isset($item) ? _e('Update Subtitle', 'mymo') : _e('Add Subtitle', 'mymo') ?></button>
		<span class="spinner"></span>
		<?php if ($item->id) : ?>
		<a href="edit.php?post_type=movie&page=mymo-subtitle" class="button"><?php _e('Back to Subtitle', 'mymo') ?></a>
		<?php endif; ?>
	</p>
</form>