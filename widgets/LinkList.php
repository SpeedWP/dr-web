<?php
namespace drweb\Widgets;

use \WP_Widget;

class LinkList extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'drweb_widgets_linklist', // Base ID
			'Link List', // Name
			array( 'description' => 'Numbered list of links', )
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
	
		echo '<h4 class="mh-widget-title"><span>'.$instance['title'].'</span></h4>';
		echo '<ol>';
		for ($i = 1; $i <= 10 ; $i++) { 
			if (!empty($instance['name'.$i])) {
				echo '<li><a href="'.$instance['url'.$i].'">'.$instance['name'.$i].'</a></li>';
			}
		}
		echo '</ol>';			
		echo $args['after_widget'];
	}
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
     	$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php for ($i = 1; $i <= 10 ; $i++) { 
			$url = ! empty( $instance['url'.$i] ) ? $instance['url'.$i] : '';
			$name = ! empty( $instance['name'.$i] ) ? $instance['name'.$i] : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'name'.$i ); ?>">Link <?=$i?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'name'.$i ); ?>" name="<?php echo $this->get_field_name( 'name'.$i ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" placeholder="Bezeichnung"><br/>
				<input class="widefat" id="<?php echo $this->get_field_id( 'url'.$i ); ?>" name="<?php echo $this->get_field_name( 'url'.$i ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" placeholder="URL" style="margin-top: 5px;">
			</p>
		<?php }
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		for ($i = 1; $i <= 10 ; $i++) {
			$instance['name'.$i] = ( ! empty( $new_instance['name'.$i] ) ) ?  $new_instance['name'.$i] : '';
			$instance['url'.$i] = ( ! empty( $new_instance['url'.$i] ) ) ? strip_tags( $new_instance['url'.$i] ) : '';
		}
		return $instance;
	}


}

add_action( 'widgets_init', function(){
     register_widget( 'drweb\Widgets\LinkList' );
});