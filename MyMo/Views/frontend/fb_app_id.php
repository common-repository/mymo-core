<?php
$fb_app_id = get_option('mymo_fb_app_id');
if($fb_app_id) : ?>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&autoLogAppEvents=1&version=v8.0&appId=<?php echo $fb_app_id ?>" nonce="ozkqznFT"></script>
<?php endif; ?>