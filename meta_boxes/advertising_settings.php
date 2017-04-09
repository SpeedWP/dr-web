<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function drweb_advertising_settings_meta_box() {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'drweb_advertising_settings_meta_box',
			__( 'Advertising Settings', 'magazine-basic' ),
			'drweb_advertising_settings_display',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'drweb_advertising_settings_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function drweb_advertising_settings_display( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'drweb_advertising_settings_data', 'drweb_advertising_settings_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'drweb_disable_advertising', true );

	echo '<input type="checkbox" id="drweb_disable_advertising" name="drweb_disable_advertising" value="true" '.($value=='true'?'checked':'').' />';
	echo '<label for="drweb_disable_advertising">';
	_e( 'Disable all advertising on this post?', 'magazine-basic' );
	echo '</label> ';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function drweb_advertising_settings_save( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['drweb_advertising_settings_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['drweb_advertising_settings_nonce'], 'drweb_advertising_settings_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if (isset($_POST['drweb_disable_advertising']) && $_POST['drweb_disable_advertising'] == 'true') {
		update_post_meta($post_id, 'drweb_disable_advertising', 'true');
	} else {
		delete_post_meta($post_id, 'drweb_disable_advertising');
	}	
}
add_action( 'save_post', 'drweb_advertising_settings_save' );