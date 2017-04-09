<?php
/**
 * Shortcode for pullquote
 */

function drweb_addpullquote( $atts, $content = null ) {
	echo '<blockquote class="blockquote--alt">'; echo $content;
	echo '<div class="socialsharing">';
	echo '<a href="http://twitter.com/share?url='; the_permalink(); echo '" class="sharing sharing--twitter popup"><span>Twitter</span></a>';
	echo '<a href="https://www.facebook.com/sharer/sharer.php?u='; the_permalink(); echo '" class="sharing sharing--facebook popup"><span>Facebook</span></a>';
	echo '</div>';
	echo'</blockquote>';
}
add_shortcode( 'pullquote', 'drweb_addpullquote' );
