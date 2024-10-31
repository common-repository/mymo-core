<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<div class="col-container">
		
		<form id="mymo-banner-list-form" method="get">
			<input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']) ?>" />
   
			<?php $table->search_box( __('Find', 'mymo'), 'mymo-banner-find'); ?>
			<?php $table->display(); ?>
		</form>
	
	</div>
</div>