<?php

if (!is_user_logged_in()) {
    wp_redirect(home_url());
    die();
}

?>

<?php get_header(); ?>

<div class="row container" id="wrapper">
	<div class="mymo-panel-filter">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8 hidden-xs">
					<div class="yoast_breadcrumb"><span>
                            <span>
                                <a href="<?php echo esc_url(get_home_url()) ?>"><?php _e('Home', 'mymo') ?></a> »
                                <span class="breadcrumb_last" aria-current="page"><?php the_title(); ?></span>
                            </span>
                        </span>
					</div>
				</div>
				
				<?php do_action('mymo_ajax_filter') ?>
    
			</div>
		</div>
		<div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
			<div class="ajax"></div>
		</div>
	</div>
    
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div class="section-bar clearfix">
            <h3 class="section-title">
                <span><?php the_title() ?></span>
            </h3>
            
            <div class="profile-sidebar">
                
                <div class="profile-userpic">
                    <img src='http://1.gravatar.com/avatar/7162c5aa667c497c4d1b90b36c60eaea?s=200&#038;d=mm&#038;r=g' srcset='http://1.gravatar.com/avatar/7162c5aa667c497c4d1b90b36c60eaea?s=400&#038;d=mm&#038;r=g 2x' class='avatar avatar-200 photo' height='200' width='200' />
                </div>
                
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <a href=""></a>
                    </div>
                    <div class="profile-usertitle-job">
                        subscriber
                    </div>
                </div>
                
                <div class="profile-usermenu">
					<?php
					$pages = mymo_get_profile_pages();
					$page_link = get_permalink(get_the_ID());
					$view = isset($_GET['v']) ? $_GET['v'] : 'profile';
					?>
                    <ul class="nav">
                        
                        <?php foreach ($pages as $key => $page) : ?>
                        
                            <li <?php if ($view == $key) echo 'class="active"' ?>>
                                <a href="<?php echo esc_url($page_link) ?><?php echo $key == 'profile' ? '' : '?v=' . esc_attr($key) ?>"><i class="hl-user"></i> <?php _e($page['name'], 'mymo') ?></a>
                            </li>
                        
                        <?php endforeach; ?>
                        
                        <li>
                            <a href="<?php echo wp_logout_url() ?>" data-turbolinks="false"><i class="hl-off"></i> <?php _e('Logout', 'mymo') ?></a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
    </aside>
	
	<main id="main-contents" class="col-xs-12 col-sm-12 col-md-12">
        
        <?php
        $file_path = isset($pages[$view]['path']) ?
            $pages[$view]['path'] :
                $pages['profile']['path'];
        if (file_exists($file_path)) {
	        include ($file_path);
        }
        ?>
		
		<div class="clearfix"></div>
	</main>

</div>

<?php get_footer(); ?>