<?php
namespace drweb\Widgets;

use \WP_Widget;

class SocialMediaCompact extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'drweb_widgets_socialmedia_compact', // Base ID
			'Social Media Icons (compact)', // Name
			array( 'description' => 'List of social media icons without text.', )
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
?>		
			<a href="http://feeds.feedburner.com/drwebmagazin" rel="nofollow" target="_blank" class="rss"><img width="64" height="64" src="<?=get_stylesheet_directory_uri()?>/images/icons/rss.png" alt="Am Ball bleiben. RSS" title="Am Ball bleiben. RSS"></a>
			<a href="https://www.facebook.com/DrWebMagazin" rel="nofollow" target="_blank" class="facebook"><img width="64" height="64" src="<?=get_stylesheet_directory_uri()?>/images/icons/facebook.png" alt="Am Ball bleiben. Facebook" title="Am Ball bleiben. Facebook"></a>
			<a href="http://twitter.com/drwebmagazin" rel="nofollow" target="_blank" class="twitter"><img width="64" height="64" src="<?=get_stylesheet_directory_uri()?>/images/icons/twitter.png" alt="Am Ball bleiben. Twitter" title="Am Ball bleiben. Twitter"></a>
			<a href="https://plus.google.com/103443335248647770600" rel="nofollow" target="_blank" class="google-plus"><img width="64" height="64" src="<?=get_stylesheet_directory_uri()?>/images/icons/google-plus.png" alt="Am Ball bleiben. Google+" title="Am Ball bleiben. Google+"></a>
			
			<?php echo $args['after_widget']; ?>
		
		<?php }
}


add_action( 'widgets_init', function(){
     register_widget( 'drweb\Widgets\SocialMediaCompact' );
});