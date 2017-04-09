<?php 
function pbt_widget_login() { ?>
        <?php global $user_ID, $user_identity, $user_level ?>
        <?php if ( $user_ID ) : ?>
        <div class="widget-heading"><?php _e('Control Panel', "magazine-basic"); ?></div>
        <ul>
            <li><?php _e('Logged in as:', "magazine-basic"); ?><strong> <?php echo $user_identity ?></strong></li>
            <li><a href="<?php echo admin_url(); ?>"><?php _e('Dashboard', "magazine-basic"); ?></a></li>

            <?php if ( $user_level >= 1 ) : ?>
            <li><a href="<?php echo admin_url('post-new.php'); ?>"><?php _e('Write', "magazine-basic"); ?></a></li>
            <?php endif // $user_level >= 1 ?>

            <li><a href="<?php echo admin_url('profile.php'); ?>"><?php _e('Profile', "magazine-basic"); ?></a></li>
            <li><a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e('Log Out', "magazine-basic"); ?></a></li>
        </ul>

        <?php else : ?>

        <div class="widget-heading"><?php _e('User Login', "magazine-basic"); ?></div>
            <?php wp_login_form(); ?>
        <ul>
            <?php if ( get_option('users_can_register') ) { ?><li><a href="<?php echo home_url(); ?>/wp-register.php"><?php _e('Register', "magazine-basic"); ?></a></li><?php } ?>
            <li><a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword"><?php _e('Lost your password', "magazine-basic"); ?></a></li>
        </ul>
        <?php endif // get_option('users_can_register') ?>
<?php
}

function pbt_widget_myLogin($args) {
	extract($args); 
	echo $before_widget;
	pbt_widget_login();
	echo $after_widget; 
}
wp_register_sidebar_widget( 'user_login', __('MB - User Login', "magazine-basic"), 'pbt_widget_myLogin', array('description' => __('User login and control panel', "magazine-basic")) );
?>