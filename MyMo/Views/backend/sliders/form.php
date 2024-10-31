<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h2><?php _e('Sliders', 'mymo') ?></h2>
	
	<div class="col-container">
        <div class="form-wrap">
            <form method="post" action="admin-ajax.php" class="validate mymo-ajax">
                <div class="status"></div>
                <input type="hidden" name="id" value="<?php echo esc_attr($item->id) ?>">
                <input type="hidden" name="action" value="mymo_save_slider">
                <input type="hidden" name="server_id" value="<?php echo isset($_GET['server']) ? $_GET['server'] : '' ?>">
				<?php wp_nonce_field('mymo_save_slider','mymo_save_slider'); ?>
                
                <div class="w-75">
                    <div class="form-field form-required term-name-wrap">
                        <label for="tag-name"><?php _e('Name', 'mymo') ?></label>
                        <input name="name" id="tag-name" type="text" class="w-100" value="<?php echo esc_attr($item->name) ?>" required>
                        <p><?php _e('Name of the slider', 'mymo') ?></p>
                    </div>
                    
                    <div id="banner-list">
                        <?php if ($banners) : ?>
                        <?php foreach ($banners as $index => $banner) : ?>
                                <?php
                                    $image_id = @$banner->banner;
                                    $image = mymo_image_url($image_id);
                                ?>
                                <div class="banner-item mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="banner-image">
                                                <img src="<?php echo esc_url($image) ?>" class="w-100" id="preview-banner-<?php echo ($index+1) ?>">
                                                <input type="hidden" name="banner[]" id="banner-<?php echo ($index+1) ?>" value="<?php echo esc_attr($image_id); ?>">
                                            </div>
                                            <div class="choose-banner">
                                                <a href="javascript:void(0)" class="mymo-select-media button button-primary" data-preview="#preview-banner-<?php echo ($index+1) ?>" data-output="#banner-<?php echo ($index+1) ?>"><?php _e('Choose Banner', 'mymo') ?></a>
                                            </div>
                                        </div>
                
                                        <div class="col-md-9">
                                            <div class="form-required term-name-wrap">
                                                <label><?php _e('Name', 'mymo') ?></label>
                                                <input name="title[]" type="text" class="w-100" value="<?php echo esc_attr(@$banner->title) ?>">
                                                <p><?php _e('Title in banner', 'mymo') ?></p>
                                            </div>
                    
                                            <div class="form-required term-name-wrap">
                                                <label><?php _e('Description', 'mymo') ?></label>
                                                <textarea name="description[]" rows="4" class="w-100"><?php echo esc_textarea(@$banner->description) ?></textarea>
                                                <p><?php _e('Description in banner', 'mymo') ?></p>
                                            </div>
                    
                                            <div class="form-required term-name-wrap">
                                                <label><?php _e('Link', 'mymo') ?></label>
                                                <input name="url[]" type="text" class="w-100" value="<?php echo esc_url(@$banner->url) ?>">
                                                <p><?php _e('Link to when clicking on the banner', 'mymo') ?></p>
                                            </div>
                                        </div>
                                    </div>
        
                                </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
    
                    <div class="mt-2">
                        <span><a href="javascript:void(0)" class="add-banner-slider"><?php _e('Add new banner', 'mymo') ?></a></span>
                    </div>
                </div>
                
                <p class="submit">
                    <button type="submit" name="submit" class="button button-primary"><?php echo $item->id ? __('Update Slider', 'mymo') : __('Add New Slider', 'mymo') ?></button>
                    <span class="spinner"></span>
                    
                    <a href="admin.php?page=mymo-slider" class="button"><?php _e('Back to Sliders', 'mymo') ?></a>
                </p>
            </form>
        </div>
	</div>
    
    <template id="banner-template">
        <div class="banner-item mb-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="banner-image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/thumb.png') ?>" class="w-100" id="preview-banner-{id}">
                        <input type="hidden" name="banner[]" id="banner-{id}">
                    </div>
                    <div class="choose-banner">
                        <a href="javascript:void(0)" class="mymo-select-media button button-primary" data-preview="#preview-banner-{id}" data-output="#banner-{id}"><?php _e('Choose Banner', 'mymo') ?></a>
                    </div>
                </div>
    
                <div class="col-md-9">
                    <div class="form-required term-name-wrap">
                        <label><?php _e('Name', 'mymo') ?></label>
                        <input name="title[]" type="text" class="w-100" value="">
                        <p><?php _e('Title in banner', 'mymo') ?></p>
                    </div>
        
                    <div class="form-required term-name-wrap">
                        <label><?php _e('Description', 'mymo') ?></label>
                        <textarea name="description[]" rows="4" class="w-100"></textarea>
                        <p><?php _e('Description in banner', 'mymo') ?></p>
                    </div>
        
                    <div class="form-required term-name-wrap">
                        <label><?php _e('Link', 'mymo') ?></label>
                        <input name="url[]" type="text" class="w-100" value="">
                        <p><?php _e('Link to when clicking on the banner', 'mymo') ?></p>
                    </div>
                </div>
            </div>
            
        </div>
    </template>
</div>