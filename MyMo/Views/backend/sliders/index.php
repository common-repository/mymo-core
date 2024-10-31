<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h1 class="wp-heading-inline"><?php echo __('Sliders', 'mymo') ?></h1><a href="admin.php?page=mymo-slider&view=form" class="page-title-action">Add New</a>
 
	<div class="col-container">
		
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