<form method="post" action="admin-ajax.php" class="validate mymo-ajax">
	<div class="status"></div>
	<input type="hidden" name="id" value="<?php echo esc_attr($item->id) ?>">
	<input type="hidden" name="action" value="mymo_save_upload">
	<input type="hidden" name="server_id" value="<?php echo isset($_GET['server']) ? esc_attr($_GET['server']) : '' ?>">
 
	<?php wp_nonce_field('mymo_save_upload','mymo_save_upload'); ?>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-label"><?php _e('Label', 'mymo') ?></label>
		<input name="label" id="tag-label" type="text" size="40" value="<?php echo esc_attr($item->label) ?>" required>
        <p><?php _e('The label of file or episode (E.x: MP4, MKV, 1, 2, 3,...)', 'mymo') ?></p>
	</div>
    
    <div class="form-field form-required term-name-wrap">
        <label for="tag-source"><?php _e('Source', 'mymo') ?></label>
        <select name="source" id="tag-source" class="w-100">
            <?php
            $disabled_source = $this->get_disabled_source();
            foreach ($this->get_file_source() as $key => $value) {
                echo '<option value="'. $key .'" '. (($item->source == $key) ? 'selected' : '') .' '. (in_array($key, $disabled_source) ? 'disabled' : '') .'>'. $value .' '. (in_array($key, $disabled_source) ? '('. __('Only Premium', 'mymo') . ')' : '' ) .'</option>';
            }
            ?>
        </select>
    </div>
    
    <div class="form-field form-required term-name-wrap">
        <label for="tag-url"><?php _e('Url Video', 'mymo') ?></label>
        <input name="url" id="tag-url" type="text" value="<?php echo esc_url($item->url) ?>" size="40" required>
        <a href="javascript:void(0)" class="button mymo-select-media-url" data-output="#tag-url"><?php _e('Select Media', 'mymo') ?></a>
    </div>
    
	<div class="form-field form-required term-name-wrap">
		<label for="tag-order"><?php _e('Order', 'mymo') ?></label>
		<input name="order" id="tag-order" type="number" value="<?php echo $item->order ? esc_attr($item->order) : '1' ?>" size="40" required>
	</div>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-status"><?php _e('Status', 'mymo') ?></label>
		<select name="status" id="tag-status" class="w-100">
			<option value="1" <?php if ($item->status == 1) echo 'selected' ?>><?php _e('Enabled', 'mymo') ?></option>
			<option value="0" <?php if (!is_null($item->status) && $item->status == 0) echo 'selected' ?>><?php _e('Disabled', 'mymo') ?></option>
		</select>
	</div>
	
	<p class="submit">
		<button type="submit" name="submit" class="button button-primary"><?php echo $item->id ? __('Update File', 'mymo') : __('Add New File', 'mymo') ?></button>
		<span class="spinner"></span>
  
		<?php if (isset($item)) { ?>
		    <a href="edit.php?post_type=movie&page=mymo-upload-video&view=index&server=<?php echo urlencode($_REQUEST['server']) ?>" class="button"><?php _e('Back to Videos', 'mymo') ?></a>
		<?php } else { ?>
            <a href="edit.php?post_type=movie&page=mymo-server-video&post=<?php echo $server->movie_id ?>" class="button"><?php _e('Back to Servers', 'mymo') ?></a>
        <?php } ?>
	</p>
</form>