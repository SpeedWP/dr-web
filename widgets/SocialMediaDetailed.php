<?php
class drwebsocialize_widget extends WP_Widget {

function __construct() {
parent::__construct(
'drwebsocialize_widget', 
__('Social Media (detailed)', 'drwebsocialize_widget_domain'), 
array( 'description' => __( 'Links zu Facebook, Twitter, G+ und RSS (ausführlich)', 'drwebsocialize_widget_domain' ), ) 
);
}

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$checkbox_full = $instance['checkbox_full'] ? true : false;
// variables to edit

$link_facebook = 'https://www.facebook.com/DrWebMagazin'; // link to facebook
$link_twitter = 'http://twitter.com/drwebmagazin'; // link to twitter
$link_google = 'https://plus.google.com/103443335248647770600'; // link to google+
$link_rss = 'http://feeds.feedburner.com/drwebmagazin'; // link to rss
$icon_size = 24; // icon size in pixels
$icon_padding = 10; // padding from icon to text

// 
$icon_padding_calc = $icon_size + $icon_padding;


// widget specific styling if needed
?>
<style type="text/css">
<!--

#drwebsocialize .social-links {
	overflow: hidden;
}
#drwebsocialize a {
	display: block;
	margin-bottom: 10px;
	font-weight: bold;
	float: left;
	width: 50%;
}
#drwebsocialize a span {
	margin: 0 0 0 <?php echo $icon_padding_calc; ?>px;
	padding: 0;
	font-size: 14px;
	line-height: 24px;
}
#drwebsocialize a.facebook {
	background: url('http://www.drweb.de/magazin/wp-content/themes/magazine-basic/images/icons/facebook.png') left no-repeat;
	background-size: <?php echo $icon_size; ?>px;
}
#drwebsocialize a.twitter {
	background: url('http://www.drweb.de/magazin/wp-content/themes/magazine-basic/images/icons/twitter.png') left no-repeat;
	background-size: <?php echo $icon_size; ?>px;
}
#drwebsocialize a.google {
	background: url('http://www.drweb.de/magazin/wp-content/themes/magazine-basic/images/icons/google-plus.png') left no-repeat;
	background-size: <?php echo $icon_size; ?>px;
}
#drwebsocialize a.rss {
	background: url('http://www.drweb.de/magazin/wp-content/themes/magazine-basic/images/icons/rss.png') left no-repeat;
	background-size: <?php echo $icon_size; ?>px;
}
#drwebsocialize p {
	font-size: 14px;
	clear: both;
	margin: 0;
}
#drwebsocialize .people {
	text-align: center;
	overflow: hidden;
	margin: 5px 0 0;
}
#drwebsocialize .people img {
	display: inline-block;
	width: 60px;
	height: auto;
	border: 1px solid #eee;
	border-radius: 2px;
	float: left;
	margin: 0 10px 10px 0;
}
#drwebsocialize.drwebsocialize-small a{
	margin-bottom: 0;
	background-size: 20px;
	float: none;
	display: inline-block;
	width: auto;
}
#drwebsocialize.drwebsocialize-small span{
	font-weight: normal;
	margin: 0 0 0 29px;
}

-->
</style>
<?php

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
?>
<div id="drwebsocialize" class="<?php if (!$checkbox_full) echo "drwebsocialize-small"; ?>">
	<div class="social-links">
		<div class="social-links__wrapper"><a class="facebook" target="_blank" href="<?php echo $link_facebook; ?>"><span>Facebook</span></a></div>
		<div class="social-links__wrapper"><a class="twitter" target="_blank" href="<?php echo $link_twitter; ?>"><span>Twitter</span></a></div>
		<div class="social-links__wrapper"><a class="google" target="_blank" href="<?php echo $link_google; ?>"><span>Google+</span></a></div>
		<div class="social-links__wrapper"><a class="rss" target="_blank" href="<?php echo $link_rss; ?>"><span>RSS</span></a></div>
	</div>
	<?php if ($checkbox_full) { ?>
	<div class="people">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people.png" /> 
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people2.png" /> 
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people3.png" />
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people4.png" />
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people5.png" />
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people6.png" />
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people7.png" />
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/people8.png" />
	</div>
	<p>
			<strong>Danke!</strong><br />
			15.434 Webworker sind uns schon sozial gewogen.
	</p>
	<?php } ?>
</div><!-- #drwebsocialize -->
<?php
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Die Soziale Tat', 'drwebsocialize_widget_domain' );
}
// Widget admin form
?>
<p>
    <input class="checkbox" type="checkbox" <?php checked($instance['checkbox_full'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_full'); ?>" name="<?php echo $this->get_field_name('checkbox_full'); ?>" /> 
    <label for="<?php echo $this->get_field_id('checkbox_full'); ?>">People hinzufügen</label>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['checkbox_full'] = $new_instance['checkbox_full'];
return $instance;
}
} // Class drwebsocialize_widget ends here

// Register and load the widget
function drwebsocialize_load_widget() {
	register_widget( 'drwebsocialize_widget' );
}
add_action( 'widgets_init', 'drwebsocialize_load_widget' );

/* Stop Adding Functions Below this Line */