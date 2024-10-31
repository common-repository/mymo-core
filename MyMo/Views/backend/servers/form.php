<form method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')) ?>" class="validate mymo-ajax">
 
	<div class="status"></div>
	<input type="hidden" name="id" value="<?php echo esc_attr($item->id) ?>">
	<input type="hidden" name="action" value="mymo_save_server">
	<input type="hidden" name="movie_id" value="<?php echo isset($_GET['post']) ? esc_attr($_GET['post']) : (isset($item) ? esc_attr($item->movie_id) : '') ?>">
	<?php wp_nonce_field('mymo_save_server','mymo_save_server'); ?>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-name"><?php _e('Name', 'mymo') ?></label>
		<input name="name" id="tag-name" type="text" size="40" value="<?php echo esc_attr($item->name) ?>" required>
        <p><?php _e('The name of server (E.x: Server 1, Server HD, ...)', 'mymo') ?></p>
	</div>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-order"><?php _e('Order', 'mymo') ?></label>
		<input name="order" id="tag-order" type="number" value="<?php echo $item->order ? esc_attr($item->order) : '1' ?>" required>
        <p><?php _e('Server display order', 'mymo') ?></p>
	</div>
	
	<div class="form-field form-required term-name-wrap">
		<label for="tag-status"><?php _e('Status', 'mymo') ?></label>
		<select name="status" id="tag-status" class="w-100">
			<option value="1" <?php if ($item->status == 1) echo 'selected' ?>><?php _e('Enabled', 'mymo') ?></option>
			<option value="0" <?php if (!is_null($item->status) && $item->status == 0) echo 'selected' ?>><?php _e('Disabled', 'mymo') ?></option>
		</select>
        <p><?php _e('If Disabled, Server will not show in the frontend', 'mymo') ?></p>
	</div>
	
	<p class="submit">
		<button type="submit" name="submit" class="button button-primary"><?php echo $item->id ? __('Update Server', 'mymo') : __('Add New Server', 'mymo') ?></button>
		<span class="spinner"></span>
  
		<?php if ($item->id) { ?>
		<a href="edit.php?post_type=movie&page=mymo-server-video<?php echo isset($_REQUEST['post']) ? '&post=' . urlencode(esc_attr($_REQUEST['post'])) : '' ?>" class="button"><?php _e('Back to Servers', 'mymo') ?></a>
		<?php } ?>
	</p>
</form>