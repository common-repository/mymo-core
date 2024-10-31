<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h1><?php _e('Video Servers', 'mymo') ?></h1>
    <div class="col-container">
        
        <div id="col-left">
            <div class="col-wrap">
                <div class="form-wrap">
                    <h2><?php _e('Add New Server', 'mymo') ?></h2>
                    
                    <?php include_once (__DIR__ . '/form.php') ?>
                </div>
            </div>
        </div>
        
        <div id="col-right">
            <div class="col-wrap">
                
                <form id="mymo-server-list-form" method="post">
                    <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']) ?>" />
                    <input type="hidden" name="post_type" value="<?php echo esc_attr($_REQUEST['post_type']) ?>" />
                    <input type="hidden" name="post" value="<?php echo esc_attr($_REQUEST['post']) ?>" />
		            <?php $table->search_box( __('Find', 'mymo'), 'mymo-server-find'); ?>
		            <?php $table->display(); ?>
                </form>
                
            </div>
        </div>
        
    </div>
</div>