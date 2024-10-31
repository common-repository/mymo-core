<div class="wrap mymo-wrap">
    <div id="icon-users" class="icon32"></div>
    <h1 class="wp-heading-inline"><?php _e('MyMo Core: Setting', 'mymo') ?></h1>
    
	<?php
	$recaptcha = get_option('mymo_recaptcha');
	$comment_type = get_option('mymo_comment_type');
	?>
	<div class="col-container mt-3">
		<form method="post" action="<?php echo admin_url('admin-ajax.php') ?>" class="mymo-ajax">
   
			<input type="hidden" name="action" value="mymo_save_general_setting">
			<?php wp_nonce_field('mymo_save_general_setting','mymo_save_general_setting'); ?>
   
			<div class="row">
    
				<div class="col-md-2">
                    <div class="list-group mt-5">
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action tab-content-link active" data-tab="general"><?php _e('General', 'mymo') ?></a>
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action tab-content-link" data-tab="recaptcha"><?php _e('Recaptcha', 'mymo') ?></a>
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action tab-content-link" data-tab="comments"><?php _e('Comments', 'mymo') ?></a>
                    </div>
				</div>
				
				<div class="col-md-8">
                    
                    <div class="status"></div>
                    
                    <div class="group-content">
                        <div class="card tab-content" id="tab-general">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-light"><?php _e('General', 'mymo') ?></h3>
                            </div>
        
                            <div class="card-body">
                                <div class="form-field form-required term-name-wrap">
                                    <label><?php _e('Facebook App ID', 'mymo') ?></label>
                                    <input type="text" name="mymo_fb_app_id" value="<?php echo esc_attr(get_option('mymo_fb_app_id')) ?>">
                                </div>
                            </div>
                        </div>
    
                        <div class="card tab-content" id="tab-recaptcha">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-light"><?php _e('Recaptcha', 'mymo') ?></h3>
                            </div>
        
                            <div class="card-body">
                                <div class="form-field form-required term-name-wrap">
                                    <label><?php _e('Recaptcha', 'mymo') ?></label>
                                    <select name="mymo_recaptcha" class="w-100">
                                        <option value="1" <?php if ($recaptcha == 1) echo 'selected' ?>><?php _e('Enabled', 'mymo') ?></option>
                                        <option value="0" <?php if ($recaptcha == 0) echo 'selected' ?>><?php _e('Disabled', 'mymo') ?></option>
                                    </select>
                                </div>
            
                                <div class="form-field form-required term-name-wrap">
                                    <label><?php _e('Recaptcha Key', 'mymo') ?></label>
                                    <input type="text" name="mymo_recaptcha_key" value="<?php echo esc_attr(get_option('mymo_recaptcha_key')) ?>">
                                </div>
            
                                <div class="form-field form-required term-name-wrap">
                                    <label><?php _e('Recaptcha Secret', 'mymo') ?></label>
                                    <input type="text" name="mymo_recaptcha_secret" value="<?php echo esc_attr(get_option('mymo_recaptcha_secret')) ?>">
                                </div>
                            </div>
                        </div>
    
                        <div class="card tab-content" id="tab-comments">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-light"><?php _e('Comments', 'mymo') ?></h3>
                            </div>
        
                            <div class="card-body">
                                <div class="form-field form-required term-name-wrap">
                                    <label><?php _e('Comment Type', 'mymo') ?></label>
                                    <select name="mymo_comment_type" class="w-100">
                                        <option value="site" <?php if ($comment_type == 'site') echo 'selected' ?>><?php _e('Default', 'mymo') ?></option>
                                        <option value="facebook" <?php if ($comment_type == 'facebook') echo 'selected' ?>><?php _e('Facebook', 'mymo') ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="submit">
                        <button type="submit" name="submit" class="button button-primary"><?php _e('Update Setting', 'mymo') ?></button>
                        <button type="reset" class="button button-cancel"><?php _e('Reset', 'mymo') ?></button>
                    </p>
     
				</div>
			</div>
			
		</form>
		
	</div>
</div>


