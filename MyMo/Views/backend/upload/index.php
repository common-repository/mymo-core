<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h2><?php echo __('Upload Videos', 'mymo') ?></h2>
    <div class="col-container">
        
        <div id="col-left">
            <div class="col-wrap">
                <div class="form-wrap">
                    <?php include_once (__DIR__ . '/form/add_form.php') ?>
                </div>
            </div>
        </div>
        
        <div id="col-right">
            <div class="col-wrap">
                
                <form id="mymo-server-list-form" method="get">
                    <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']) ?>" />
                    <input type="hidden" name="post_type" value="<?php echo esc_attr($_REQUEST['post_type']) ?>" />
                    <input type="hidden" name="view" value="<?php echo esc_attr($_REQUEST['view']) ?>" />
                    <input type="hidden" name="server" value="<?php echo esc_attr($_REQUEST['server']) ?>" />
                    
		            <?php $table->search_box( __('Find', 'mymo'), 'mymo-server-find'); ?>
		            <?php $table->display(); ?>
                </form>
                
    
            </div>
        </div>
    
    </div>
</div>