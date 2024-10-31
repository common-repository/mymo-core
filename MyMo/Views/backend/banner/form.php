<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h2><?php echo __('Sliders', 'mymo') ?></h2>
	
	<div class="col-container">
		<div class="form-wrap">
			<form method="post" action="admin-ajax.php" class="validate mymo-ajax">
				<div class="status"></div>
				<input type="hidden" name="id" value="<?php echo esc_attr($item->id) ?>">
				<input type="hidden" name="action" value="mymo_save_banner">
				
				<?php wp_nonce_field('mymo_save_banner','mymo_save_banner'); ?>
				
				<div class="w-75">
					<div class="form-field form-required term-name-wrap">
						<label for="tag-name"><?php _e('Name', 'mymo') ?></label>
						<input id="tag-name" type="text" size="40" value="<?php echo esc_attr($item->name) ?>" required disabled>
						<p><?php _e('Name position the banner', 'mymo') ?></p>
					</div>
                    
                    <div class="form-field form-required term-name-wrap">
                        <label for="tag-name"><?php _e('Body', 'mymo') ?></label>
                        <textarea name="body" rows="5"><?php echo esc_textarea($item->body) ?></textarea>
                        <p><?php _e('Code banner ADS (HTML Code)', 'mymo') ?></p>
                    </div>
				</div>
				
				<p class="submit">
					<button type="submit" name="submit" class="button button-primary"><?php _e('Update ADs', 'mymo') ?></button>
					<span class="spinner"></span>
					
					<a href="admin.php?page=mymo-banner" class="button"><?php _e('Back to Banner ADS', 'mymo') ?></a>
				</p>
			</form>
		</div>
	</div>
	
	
</div>