<?php
/**
 * Plugin Name: Noupe Social Follow Buttons
 * Description: Zeigt Social Media Follow Buttons im Header an..
 * Version: 1.0.0
 * Author: Andreas Hecht
 * Author URI: http://www.democraticpost.de
 */
/*  Copyright 2016  Andreas Hecht */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */

 register_widget( 'DrWeb_SocialFollowWidget' );


class DrWeb_SocialFollowWidget extends WP_Widget {


	function __construct() {
		$widget_ops = array('classname' => 'drweb_social_follow_widget', 'description' => __( 'Zeigt Social Media Follow Buttons im Header oder Footer an.', 'revothemes') );
		parent::__construct('DrWeb_social_follow', __('DrWeb SocialFollow', 'revothemes'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;


?>
   <div class="social-buttons">
                <ul>
                    <li class="social-facebook"><a href="https://www.facebook.com/DrWebMagazin" target="_blank" title="Follow us on Facebook" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-twitter"><a href="https://twitter.com/drwebmagazin" target="_blank" title="Follow us on Twitter" rel="nofollow"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-gplus"><a href="https://plus.google.com/103443335248647770600" target="_blank" title="Follow us on Google+" rel="nofollow"><i class="fa fa-google-plus"></i></a></li>

                    <li class="social-rss"><a href="http://feeds.feedburner.com/drwebmagazin" target="_blank" title="Subscribe to our RSS-feed"><i class="fa fa-rss"></i></a></li>
               </ul>
    </div>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}