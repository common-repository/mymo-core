<div class="htmlwrap clearfix">
	<?php
	$comment_type = get_option('mymo_comment_type');
	$comments_per_page = get_option('comments_per_page');
	?>
	
	<?php if($comment_type == 'facebook') : ?>
	<div class="fb-comments" data-href="<?php echo esc_url(mymo_get_current_url()) ?>" data-width="100%" data-mobile="true" data-colorscheme="dark" data-numposts="<?php echo $comments_per_page ?>" data-order-by="reverse_time"></div>
	<?php endif; ?>
	
	<?php if($comment_type == 'site' || empty($comment_type)) : ?>
 
	<?php comment_form(); ?>
 
	<hr class="color-text">
    <?php if (have_comments()) : ?>
    <div class="comment-list">
        <?php
            wp_list_comments(array(
                'style'       => 'div',
                'short_ping'  => true,
            ));
        ?>
    </div>
			
    <?php mymo_comments_pagination(); ?>
    
	<?php endif; ?>
 
	<?php endif; ?>
</div>