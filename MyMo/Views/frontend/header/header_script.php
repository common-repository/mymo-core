<script type='text/javascript'>
    /* <![CDATA[ */
    var mymo = {
        "ajax_url": "<?php echo admin_url('admin-ajax.php') ?>",
        "light_mode":"0",
        "light_mode_btn":"1",
        "ajax_live_search":"1",
        "sync": null,
        "db_redirect_url": "",
        "languages": {
            'notification': '<?php echo __('Notification', 'mymo') ?>',
            'nothing_found': '<?php echo __('Nothing found', 'mymo') ?>',
            'remove_all': '<?php echo __('Remove all', 'mymo') ?>',
            'bookmark': '<?php echo __('Bookmark', 'mymo') ?>',
        }
    };

    var langs = {
        'data_error': '<?php echo __('Data Error', 'mymo') ?>'
    };
    /* ]]> */
</script>

<script type='text/javascript'>
    /* <![CDATA[ */
    var ajax_auth_object = {
        "logined": "<?php echo is_user_logged_in() ? 1 : 0 ?>",
        "user_registration": "<?php echo get_option('users_can_register') ?>",
        "redirecturl":"<?php echo mymo_get_current_url() ?>",
        "loadingmessage":"<?php echo __('Please wait...', 'mymo') ?>",
        "recaptcha":"<?php echo get_option('mymo_recaptcha') ?>",
        "sitekey":"<?php echo get_option('mymo_recaptcha_key') ?>",
        "languages":{
            "login":"<?php echo __('Login', 'mymo') ?>",
            "register":"<?php echo __('Register', 'mymo') ?>",
            "forgotpassword":"<?php echo __('Forgot password ?', 'mymo') ?>",
            "already_account":"<?php echo __('Already have an account', 'mymo') ?>",
            "create_account":"<?php echo __('Create account', 'mymo') ?>",
            "reset_captcha":"<?php echo __('Reset captcha', 'mymo') ?>",
            "name":"<?php echo __('Fullname', 'mymo') ?>",
            "username":"<?php echo __('Username', 'mymo') ?>",
            "email":"<?php echo __('Email', 'mymo') ?>",
            "username_email":"<?php echo __('Username or Email', 'mymo') ?>",
            "password":"<?php echo __('Password', 'mymo') ?>",
            "reset_password":"<?php echo __('Reset password', 'mymo') ?>",
            "login_with":"<?php echo __('Login with', 'mymo') ?>",
            "register_with":"<?php echo __('Register with', 'mymo') ?>",
            "or":"<?php echo __('or', 'mymo') ?>",
            "apparently_there_are_no_posts_to_show": "<?php echo __('Apparently there are no posts to show', 'mymo') ?>"
        }
    };
    /* ]]> */
</script>