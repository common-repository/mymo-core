<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h2><?php echo __('Upload Videos', 'mymo') ?></h2>
	<div class="col-container">
		
		<div id="col-left">
			<div class="col-wrap">
				<div class="form-wrap">
					<h2><?php echo __('Add New Video', 'mymo') ?></h2>
					
					<?php include_once (__DIR__ . '/form.php') ?>
				</div>
			</div>
		</div>
		
		<div id="col-right">
			<div class="col-wrap">
				
				<form method="post" id="mymo-subtitle-form">
					<input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']) ?>" />
					<input type="hidden" name="post_type" value="<?php echo esc_attr($_REQUEST['post_type']) ?>" />
					<input type="hidden" name="file" value="<?php echo esc_attr($_REQUEST['file']) ?>" />
					
					<?php $table->search_box( __('Find', 'mymo'), 'mymo-subtitle-find'); ?>
					
					<?php $table->display(); ?>
				</form>
				
			</div>
		</div>
	
	</div>
</div>