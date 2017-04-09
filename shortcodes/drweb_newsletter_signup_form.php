<?php
/**
 * Shortcode for newsletter signup form
 */
function drweb_newsletter_signup_form( $atts ) {
	$form = '  
<div id="mc_embed_signup" class="mailchimp-signup-form">
<form action="//drweb.us1.list-manage.com/subscribe/post?u=1909951713873d746b1e007b0&amp;id=af0fbc3456" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
    <div id="mc_embed_signup_scroll">
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Deine E-Mail-Adresse" required>
	<input type="text" value="" name="FNAME" class="email" id="mce-FNAME" placeholder="Dein Name (optional)">
	<input type="hidden" name="KAMPAGNE" value="'.(isset($atts['default_campaign']) ? esc_attr($atts['default_campaign']) : "").'">
	<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_1909951713873d746b1e007b0_af0fbc3456" tabindex="-1" value=""></div>
    <div class="clear"></div>
    <center><input type="submit" value="Eintragen" name="subscribe" id="mc-embedded-subscribe" class="button"></center>
    </div>
</form>
</div>
';
	return $form;
}
add_shortcode('drweb_newsletter_signup_form', 'drweb_newsletter_signup_form');
