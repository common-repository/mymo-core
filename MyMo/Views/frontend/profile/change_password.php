<section>
	<div class="section-bar clearfix">
		<h3 class="section-title">
			<span><?php _e('Change password', 'mymo') ?></span><span class="count pull-right"><i></i> item</span>
		</h3>
	</div>
	
	<div class="mymo_box">
		<div class="col-sm-4">
			<form action="<?php echo admin_url('admin-ajax.php') ?>" method="post" class="form-ajax" data-success="change_password_success">
				<input type="hidden" name="action" value="mymo_change_password">
				<label><?php _e('Current password', 'mymo') ?></label>
				<div class="form-group pass_show">
					<input type="password" class="form-control" name="current_password" placeholder="<?php _e('Current password', 'mymo') ?>" required>
                    <span class="ptxt">Show</span>
				</div>
				
				<label><?php _e('New password', 'mymo') ?></label>
				<div class="form-group pass_show">
					<input type="password" class="form-control" name="password" placeholder="<?php _e('New password', 'mymo') ?>" required>
                    <span class="ptxt">Show</span>
				</div>
				
				<label><?php _e('Confirm password', 'mymo') ?></label>
				<div class="form-group pass_show">
					<input type="password" class="form-control" name="password_confirmation" placeholder="<?php _e('Confirm password', 'mymo') ?>" required>
                    <span class="ptxt">Show</span>
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-success"><?php _e('Update', 'mymo') ?></button>
				</div>
			</form>
		</div>
		<style>
			.pass_show{position: relative}
			.pass_show .ptxt {
				position: absolute;
				top: 50%;
				right: 10px;
				z-index: 1;
				color: #f36c01;
				margin-top: -10px;
				cursor: pointer;
				transition: .3s ease all;
			}
			.pass_show .ptxt:hover{color: #333333;}
		</style>
		<script type="text/javascript">
            jQuery('body').on('click', '.pass_show .ptxt', function () {
                jQuery(this).text($(this).text() == "Show" ? "Hide" : "Show");
                jQuery(this).prev().attr('type', function (index, attr) {
                    return attr == 'password' ? 'text' : 'password';
                });
            });

            function change_password_success(form) {
                window.location = "";
            }
		</script>
	</div>
	
	
	<div class="clearfix"></div>
</section>