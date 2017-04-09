<?php
# ----------------------------------------------------------------------
#   Dr. Web  ################################
# ----------------------------------------------------------------------

/**
 * Zusätzliche Widget-Bereiche für Werbung und Newsletter
 * @author Andreas Hecht
 */
function drweb_header_widget_init() {
register_sidebar(array(
'name'          => 'Header Social Icons (Links)',
'id'            => 'hdwd',
'description'   => 'Der zweite Widgetbereich des Headers. Für Social Icons gedacht.',
'before_widget' => '<div class="left-area">',
'after_widget' => '</div>',
'before_title' => '',
'after_title' => '',
) );
}
add_action( 'widgets_init', 'drweb_header_widget_init' );


function drweb_ad_widget_init() {
register_sidebar(array(
'name'          => 'Ad Widget 1 Startseite',
'id'            => 'adeins',
'description'   => 'Ads in Loop - Startseite. Wird unterhalb des ersten Artikels angezeigt. WICHTIG: Nur belegen, wenn der Newsletter Widget-Bereich nicht belegt ist.',
'before_widget' => '<div class="ad-widget eins">',
'after_widget' => '</div>',
'before_title' => '',
'after_title' => '',
) );

 register_sidebar(array(
'name'          => 'Ad Widget 2 Startseite',
'id'            => 'adzwei',
'description'   => 'Ads in Loop 2 - Startseite. Zeigt Werbeblock mittig innerhalb der Startseite an.',
'before_widget' => '<div class="ad-widget zwei">',
'after_widget' => '</div>',
'before_title' => '',
'after_title' => '',
)  );
    
 register_sidebar(array(
'name'          => 'Ad Widget 3 Startseite',
'id'            => 'adpage',
'description'   => 'Zeigt einen Werbeblock oberhalb der Seiten-Pagination an.',
'before_widget' => '<div class="ad-widget-pagination">',
'after_widget' => '</div>',
'before_title' => '',
'after_title' => '',
)  );    
    
 register_sidebar(array(
'name'          => 'Ad Widget Single Top',
'id'            => 'addrei',
'description'   => 'Ads in Artikel oberhalb Beitragsbild',
'before_widget' => '<div class="ad-widget">',
'after_widget' => '</div>',
'before_title' => '',
'after_title' => '',
)  );
    
register_sidebar(array(
'name'          => 'Newsletter Startseite',
'id'            => 'advier',
'description'   => 'Zeigt ein Newsletter-Formular unterhalb des Hero-Bildes an.',
'before_widget' => '<div class="enews">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
) );
    
}
add_action( 'widgets_init', 'drweb_ad_widget_init' );



function drweb_remove_post_formats() {
    remove_theme_support( 'post-formats' );
    add_theme_support( 'post-formats', array( '' ) );
}
add_action( 'after_setup_theme', 'drweb_remove_post_formats', 11 );


/**
 * Blendet Werbeblöcke aus Textwidgets in die Loop ein: Archive
 * @author Andreas Hecht
 */
function drweb_archives_show_ad_widgets()
{
    static $count = 0;

    if ( ! is_category() )
        return;

    if ( 'loop_start' === current_filter() )
        return add_action( 'the_post', __FUNCTION__ )
            && add_action( 'loop_end', __FUNCTION__ );

    $count += 1;

    if ( 5 === $count )
        dynamic_sidebar( 'adzwei' );
    
        if ( 11 === $count )
        dynamic_sidebar( ' ' );

    if ( 13 === $count or 'loop_end' === current_filter() ) {
        dynamic_sidebar( ' ' );
        remove_action( 'the_post', __FUNCTION__ );
    }
}
add_action( 'loop_start', 'drweb_archives_show_ad_widgets' );


/**
 * Blendet Werbeblöcke aus Textwidgets in die Loop ein: Autor
 * @author Andreas Hecht
 */
function drweb_author_show_ad_widgets()
{
    static $count = 0;

    if ( ! is_author() )
        return;

    if ( 'loop_start' === current_filter() )
        return add_action( 'the_post', __FUNCTION__ )
            && add_action( 'loop_end', __FUNCTION__ );

    $count += 1;

    if ( 5 === $count )
        dynamic_sidebar( 'adzwei' );
    
        if ( 11 === $count )
        dynamic_sidebar( ' ' );

    if ( 13 === $count or 'loop_end' === current_filter() ) {
        dynamic_sidebar( ' ' );
        remove_action( 'the_post', __FUNCTION__ );
    }
}
add_action( 'loop_start', 'drweb_author_show_ad_widgets' );



/**
 * Blendet Werbeblöcke aus Textwidgets in die Loop ein: Blogansicht - alle Artikel
 * @author Andreas Hecht
 */
function drweb_blog_show_ad_widgets()
{
    static $count = 0;

    if ( ! is_home() )
        return;

    if ( 'loop_start' === current_filter() )
        return add_action( 'the_post', __FUNCTION__ )
            && add_action( 'loop_end', __FUNCTION__ );

    $count += 1;

    if ( 7 === $count )
        dynamic_sidebar( 'adzwei' );
    
        if ( 11 === $count )
        dynamic_sidebar( '' );

    if ( 13 === $count or 'loop_end' === current_filter() ) {
        dynamic_sidebar( ' ' );
        remove_action( 'the_post', __FUNCTION__ );
    }
}
add_action( 'loop_start', 'drweb_blog_show_ad_widgets' );


 /* =============================================================================
 8 - Vorbereitung auf infinite Scroll
============================================================================= */

//add_theme_support( 'infinite-scroll', array(
//    'type'           => 'scroll',
//    'footer_widgets' => false,
//    'container'      => 'grid-wrapper',
//   'wrapper'        => true,
//    'render'         => false,
//    'posts_per_page' => 10,
//) );





/**
 * Stylesheet Einbinden
 * @author Andreas Hecht
 */
function drweb_theme_name_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'drweb_theme_name_scripts' );


/**
 * Disable embeds on init.
 *
 * - Removes the needed query vars.
 * - Disables oEmbed discovery.
 * - Completely removes the related JavaScript.
 *
 * @since 1.0.0
 */
function disable_embeds_init() {
	/* @var WP $wp */
	global $wp;

	// Remove the embed query var.
	$wp->public_query_vars = array_diff( $wp->public_query_vars, array(
		'embed',
	) );

	// Remove the REST API endpoint.
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );

	// Turn off oEmbed auto discovery.
	add_filter( 'embed_oembed_discover', '__return_false' );

	// Don't filter oEmbed results.
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );

	// Remove all embeds rewrite rules.
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

	// Remove filter of the oEmbed result before any HTTP requests are made.
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}

add_action( 'init', 'disable_embeds_init', 9999 );

/**
 * Removes the 'wpembed' TinyMCE plugin.
 *
 * @since 1.0.0
 *
 * @param array $plugins List of TinyMCE plugins.
 * @return array The modified list.
 */
function disable_embeds_tiny_mce_plugin( $plugins ) {
	return array_diff( $plugins, array( 'wpembed' ) );
}

/**
 * Remove all rewrite rules related to embeds.
 *
 * @since 1.2.0
 *
 * @param array $rules WordPress rewrite rules.
 * @return array Rewrite rules without embeds rules.
 */
function disable_embeds_rewrites( $rules ) {
	foreach ( $rules as $rule => $rewrite ) {
		if ( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[ $rule ] );
		}
	}

	return $rules;
}

/**
 * Remove embeds rewrite rules on plugin activation.
 *
 * @since 1.2.0
 */
function disable_embeds_remove_rewrite_rules() {
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules( false );
}

register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );

/**
 * Flush rewrite rules on plugin deactivation.
 *
 * @since 1.2.0
 */
function disable_embeds_flush_rewrite_rules() {
	remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules( false );
}

register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );


 /* =============================================================================
 8 - INTRO DES ARTIKELS HIGHLIGHTEN
============================================================================= */

/**
 * Auto-Highlighting - Automatisches Highlighten des ersten Absatzes eines Beitrags
 * @author Andreas Hecht
 */
function tb_first_paragraph_highlight( $content ) {
    return preg_replace( '/<p([^>]+)?>/', '<p$1 class="opener">', $content, 1 );
}
add_filter( 'the_content', 'tb_first_paragraph_highlight' );


/**
 * Stellt Buttons für den Druck und das Kommentieren bereit.
 * @author Andreas Hecht
 */
function tb_print_comment() {
?>
<div id="printcomment">
<div class="printlink">
<a class="druck" href="javascript:window.print()" title="Beitrag ausdrucken"><i class="fa fa-print" aria-hidden="true"></i> Beitrag ausdrucken</a>
 </div>  
 <div class="printlink">
<a class="kommentar" href="#comments" title="Beitrag kommentieren"><i class="fa fa-comments-o" aria-hidden="true"></i> Deine Meinung hinterlassen</a>
</div>
</div>
<div class="clear"></div> 
<?php }


/* =============================================================================
    23 - DIE NEUE AUTORENBOX - REMOVE WP BIOGRAPHIA
============================================================================== */

/**
 * Author Bio Box Neu
 * @author Andreas Hecht
 */
function drweb_author_bio_box() {
?>
<div class="author-bio">
<div class="bio-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'128'); ?></div>
<div class="author-inner">
<p class="bio-name"><a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php the_author_meta('display_name'); ?></a></p>
<p class="bio-desc"><?php the_author_meta('description'); ?></p>
<?php
 $author_website = get_the_author_meta( 'url' );                                
$author_facebook_url = get_the_author_meta( 'facebook' );
$author_twitter_url  = get_the_author_meta( 'twitter' );
$author_feed_url     = get_the_author_meta( 'feedurl' );
$author_gplus_url    = get_the_author_meta( 'googleplus' );
$author_linkedin_url   = get_the_author_meta( 'linkedin' );
$author_xing_url   = get_the_author_meta( 'xing' );
$author_youtube_url   = get_the_author_meta( 'youtube' );                           

if ( $author_website || $author_facebook_url || $author_twitter_url || $author_feed_url || $author_gplus_url || $author_linkedin_url || $author_xing_url || $author_youtube_url ) {
?>
<div class="simple-social-icons">
<ul class="social-link clearfix">
       <!-- facebook -->
    <?php if ( ! empty( $author_website ) ) { ?>
    <li><a href="<?php echo esc_url( $author_website ); ?>" title="Authors Website" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a></li>
    <?php } // endif ?>
    <!-- facebook -->
    <?php if ( ! empty( $author_facebook_url ) ) { ?>
    <li><a href="<?php echo esc_url( $author_facebook_url ); ?>" title="Follow on Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
    <?php } // endif ?>

    <!-- twitter -->
    <?php if ( ! empty( $author_twitter_url ) ) { ?>
    <li><a href="<?php echo esc_url( $author_twitter_url ); ?>" title="Follow on Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
    <?php } // endif ?>

    <!-- feed -->
    <?php if ( ! empty( $author_feed_url ) ) { ?>
    <li><a href="<?php echo esc_url( $author_feed_url ); ?>" title="Subscribe to the Authors Feed" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
    <?php } // endif ?>

    <!-- google plus -->
    <?php if ( ! empty( $author_gplus_url ) ) { ?>
    <li><a href="<?php echo esc_url( $author_gplus_url ); ?>" title="Follow on Google+" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
    <?php } // endif ?>

    <!-- linkedin -->
    <?php if ( ! empty( $author_linkedin_url ) ) { ?>
    <li><a href="<?php echo esc_url( $author_linkedin_url ); ?>" title="Connect on LinkedIn" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
    <?php } // endif ?>
        <!-- flickr -->
    <?php if ( ! empty( $author_xing_url ) ) { ?>
    <li><a href="<?php echo esc_url( $author_xing_url ); ?>" title="Connect on Xing" target="_blank"><i class="fa fa-xing" aria-hidden="true"></i></a></li>
    <?php } // endif ?>
        <!-- flickr -->
    <?php if ( ! empty( $author_youtube_url ) ) { ?>
    <li><a href="<?php echo esc_url( $author_youtube_url ); ?>" title="Follow on Youtube" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
    <?php } // endif ?>
</ul>
</div>
</div>
<?php } // endif ?>
<!-- social-link -->
<div class="clear"></div>
</div>   
<?php }


/**
 * Neue Funktion für Seitentitel
 */

  function hu_site_title() {
    // Text or image?
    if ( false != hu_get_img_src_from_option( 'custom-logo' ) ) {
      $logo = '<img src="'. hu_get_img_src_from_option( 'custom-logo' ) . '" alt="'.get_bloginfo('name').'">';
    } else {
      $logo = get_bloginfo('name');
    }

    $link = '<a href="'.home_url('/').'" rel="home">'.$logo.'</a>';

    if ( is_front_page() || is_home() ) {
      $sitename = '<p class="site-title">'.$link.'</p>'."\n" . '<h1 class="title-image">DrWeb.de</h1>'."\n" . '<p class="title-image">Das Magazin für Webworker und Seitenbetreiber.</p>';
    } else {
      $sitename = '<p class="site-title">'.$link.'</p>'."\n" . '<p class="title-image">DrWeb.de</p>'."\n" . '<p class="title-image">Das Magazin für Webworker und Seitenbetreiber.</p>';
    }

    return $sitename;
  }




/**
 * Managed die Kontakt-Felder in der Autor-Bio
 * @author Based on Code by "Thomas Scholz" http://toscho.de
 * @version 1.0
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 */
                                 
// Die benötigten Felder hier eintragen, den Rest löschen. Der letzte Punkt darf kein Komma haben.
$Techbrain_Contactfields = new Techbrain_Contactfields(
	array (
		'Feed',
	    'Twitter',
        'Facebook',
        'GooglePlus',
        'Flickr',
        'Github',
        'Instagram',
        'LinkedIn',
        'Pinterest',
        'Vimeo',
        'Youtube'
	)
);


class Techbrain_Contactfields {
	public
		$new_fields
	,	$active_fields
	,	$replace
	;

	/**
	 * @param array $fields New fields: array ('Twitter', 'Facebook')
	 * @param bool $replace Replace default fields?
	 */
	public function __construct($fields, $replace = TRUE)
	{
		foreach ( $fields as $field )
		{
			$this->new_fields[ mb_strtolower($field, 'utf-8') ] = $field;
		}

		$this->replace = (bool) $replace;

		add_filter('user_contactmethods', array( $this, 'add_fields' ) );
	}

	/**
	 * Ändert die Kontaktfelder
	 * @param  $original_fields Original WP fields
	 * @return array
	 */
	public function add_fields($original_fields)
	{
		if ( $this->replace )
		{
			$this->active_fields = $this->new_fields;
			return $this->new_fields;
		}

		$this->active_fields = array_merge($original_fields, $this->new_fields);
		return $this->active_fields;
	}

	/**
	 * Hilfsfunktion
	 * @return array The currently active fields.
	 */
	public function get_active_fields()
	{
		return $this->active_fields;
	}
}



/**
 * Editor Style CSS
 * 
 */ 
function drweb_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'drweb_theme_add_editor_styles' );



// Add filter to execute shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');



//emoji aus dem header entfernen
function disable_emoji_dequeue_script() {
    wp_dequeue_script( 'emoji' );
}
add_action( 'wp_print_scripts', 'disable_emoji_dequeue_script', 100 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' );


/**
 * Remove Query Strings
 * @author Andreas Hecht
 * @param  [[Type]] $src [[Description]]
 * @return [[Type]] [[Description]]
 */
function evolution_remove_wp_ver_css_js( $src ) {

    if ( strpos( $src, 'ver=' ) )

        $src = remove_query_arg( 'ver', $src );

    return $src;
}
add_filter( 'style_loader_src', 'evolution_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'evolution_remove_wp_ver_css_js', 9999 );




 /* =============================================================================
 4 - Remove Hueman Main Style and Hueman Fontawesome
============================================================================= */


add_action('wp_print_styles', 'mytheme_dequeue_css_from_plugins', 100);
function mytheme_dequeue_css_from_plugins()  {
    wp_dequeue_style( "hueman-main-style" );  
    wp_deregister_style( 'hueman-main-style' );
    wp_dequeue_style( 'hueman-font-awesome' );
    wp_dequeue_style( "bcct_custom_style" );  
    wp_deregister_style( 'bcct_custom_style' );
    wp_dequeue_style( "contact-form-7" ); 
    wp_deregister_style( 'contact-form-7' ); 
    wp_dequeue_style( "wpdiscuz-font-awesome" );  
    wp_deregister_style( 'wpdiscuz-font-awesome' );
    wp_dequeue_style( "font-awesome-fa" );  
    wp_deregister_style( 'font-awesome-fa' );
}
load_theme_textdomain( 'hueman', get_template_directory().'/languages' );



/**
 * Befreit den Header von unnötigen Einträgen
 */ 
add_action('init', 'remheadlink');
function remheadlink()
	{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	//remove_action('wp_head', 'feed_links', 2);
	//remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'wp_shortlink_header', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	}


 /* =============================================================================
 2 - Dynamische Copyright Daten im Footer
============================================================================= */


// Dynamische Copyright Daten im Footer ausgeben. © Von Jahr bis Jahr...
// Im Theme wird die Funktion ausgegeben mit: 
/* <?php echo dw_dynamic_copyright(); ?> - Diesen Tag dorthin einfügen, wo das Copyright erscheinen soll */
function dw_dynamic_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "&copy; 1997";
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= ' - ' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}


/**
 * Keine eigenen Pingbacks zulassen
 * 
 */
function democratic_no_self_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}

add_action( 'pre_ping', 'democratic_no_self_ping' );

/* =============================================================================
 Post Thumbnails in Feed
============================================================================= */

function tb_featuredtoRSS($content) {
global $post;
if ( has_post_thumbnail( $post->ID ) ){
$content = '<div>' . get_the_post_thumbnail( $post->ID, 'large', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
}
return $content;
}
 
add_filter('the_excerpt_rss', 'tb_featuredtoRSS');
add_filter('the_content_feed', 'tb_featuredtoRSS');


/**
 * Clean wp-caption Output ohne die 10px, die WordPress hinzufügt
 * 
 */
function cleaner_caption( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() )
		return $output;

	/* Set up the default arguments. */
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	/* Set up the attributes for the caption <div>. */
	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	/* Open the caption <div>. */
	$output = '<div' . $attributes .'>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<p class="wp-caption-text"><span class="fa fw fa-camera fa-1x"></span>' . $attr['caption'] . '</p>';

	/* Close the caption </div>. */
	$output .= '</div>';

	/* Return the formatted, clean caption. */
	return $output;
}
add_filter( 'img_caption_shortcode', 'cleaner_caption', 10, 3 );




/* Die XMLRPC-Schnittstelle komplett abschalten */
add_filter( 'xmlrpc_enabled', '__return_false' );

/* Den HTTP-Header vom XMLRPC-Eintrag bereinigen */
add_filter( 'wp_headers', 'AH_remove_x_pingback' );
 function AH_remove_x_pingback( $headers )
 {
 unset( $headers['X-Pingback'] );
 return $headers;
 }


/* =================================================
    Custom Shortcodes und Funktionen
================================================= */

// add shortcode for authors page
// usage: [drweb_authors]
include __DIR__.'/shortcodes/drweb_authors.php';
add_shortcode('drweb_authors', 'drweb_authors_func');

/**
 * Alphabetical Taglist for  usage in
 */
function drweb_add_alphabetical_taglist( $atts ) {

	extract(shortcode_atts( array(
	    'version' => 'simple'
	), $atts ) );

 	$list = '';
	$tags = get_terms('post_tag' );
	$groups = array();

	if( $tags && is_array( $tags ) ) {
		foreach( $tags as $tag ) {
			$first_letter = strtoupper( $tag->name[0] );
			$groups[ $first_letter ][] = $tag;
		}
		if( !empty( $groups ) ) {{
          	$index_row .='<ul class="tagnav">';
         	foreach ($groups as $letter => $tags) {
         		if(preg_match("/^[a-zA-Z]+$/", $letter ) == 1) {
         			if ( $version == 'extended' ){
           				$index_row .= '<li><a href="#taglist__' . $letter . '" title="' . $letter . '">' . apply_filters( 'the_title', $letter ) . '</a></li>';

           			}
           			else{
           				$index_row .= '<li><a href="' . get_site_url() . '/tag/#taglist__' . $letter . '" title="' . $letter . '">' . apply_filters( 'the_title', $letter ) . '</a></li>';

           			}
           		}
			}
			$index_row .='</ul><div class="clear"></div>';}

			if ( $version == 'extended' ){

			 	$list .= '<div id="columns"><ul class="taglist">';
			 	foreach( $groups as $letter => $tags ) {
				 	if(preg_match("/^[a-zA-Z]+$/", $letter ) == 1) {
	            		$list .= '<li><h4 id="taglist__'.$letter.'">' . apply_filters( 'the_title', $letter ) . '</h4>';
						$list .= '<ul class="taglist__items">';
						foreach( $tags as $tag ) {
	               			$url = attribute_escape( get_tag_link( $tag->term_id ) );
							$name = apply_filters( 'the_title', $tag->name );
	               			$list .= '<li><a title="' . $name . '" href="' . $url . '"><strong>' . $name . '</strong>'. wp_trim_words($tag->description, 20, '...').'</a></li>';
						}
						$list .= '</ul></li>';
					}
				}
				$list .= '</ul></div>';
			}
		}
	}else{
		$list .= '<p>Sorry, but no tags were found</p>';
	}

	if ( $version == 'extended' ){
		return $index_row.$list;
	}
	else{
		return $index_row;
	}
}

add_shortcode( 'taglist' , 'drweb_add_alphabetical_taglist' );

/**
 * Set tag-cloud font-sizes for "Top Begriffe"-widget
 */
function set_tag_cloud_sizes($args) {
	$args['smallest'] = 10;
	$args['largest'] = 10;
	$args['number'] = 10;
	return $args;
}
add_filter('widget_tag_cloud_args','set_tag_cloud_sizes');

/* Bereits vorhandene Widgets und Shortcodes aus dem alten Theme laden */
require_once(__DIR__.'/widgets/LinkList.php');
require_once(__DIR__.'/widgets/drweb-social-follow.php');

/* Shortcodes */
require_once(__DIR__.'/shortcodes/drweb_newsletter_signup_form.php');
require_once(__DIR__.'/shortcodes/pullquote.php');

/* Meta boxes - Advertising */
require_once(__DIR__.'/meta_boxes/advertising_settings.php');


 /* =============================================================================
 11 - JavaScript für die Werbeblöcke laden
============================================================================= */

function drweb_theme_enqueue_scripts() {
    wp_enqueue_script('ads-controller', get_stylesheet_directory_uri().'/js/ads-controller-min.js', array(), filemtime(__DIR__.'/js/ads-controller-min.js'), true);
    wp_enqueue_script('ads-drweb', get_stylesheet_directory_uri().'/js/ads-drweb.js', array('ads-controller'), filemtime(__DIR__.'/js/ads-drweb.js'), true);
}
add_action( 'wp_enqueue_scripts', 'drweb_theme_enqueue_scripts' ); 


 /* =============================================================================
 13 - Werbung - kr_inject_content
============================================================================= */

/**
 * Fügt statische Inhalte (in der Regel Werbung) innerhalb von Artikeln ein,
 * falls sie älter als X Tage sind. Inhalt, Alter und Position werden in der
 * Funktion definiert.
 * @global type $post
 * @param type $content
 * @return string
 */
function kr_inject_content($content) {
	global $post;

	// Inhalt, der eingefügt werden soll;
		$injectedContent = '<div class="intra-content-ad" id="intra-content-ad" data-ad-zone-id="96"></div>';
		$injectedContentEnd = '<div id="article-end-ad" data-ad-zone-id="115"></div>';
				

	// Nur bei Einzelansicht einfügen
	if (!is_single() || is_product() )
		return $content;
	
	$content .= $injectedContentEnd;

	// Nur bei Artikeln ab einem gewissen Alter einfügen
	// Änderung 27.2.2014: Laut Giammarco nicht mehr gewünscht
	/*$date = new DateTime($post->post_date);
	$limit = new DateTime();
	$limit->modify('-15 days');
	if ($date > $limit) {
		return $content;
	}*/

	// Definiert die Positionierung. Schlüssel ist ein String, dessen Vorkommen
	// gezählt werden. Wert ist die Anzahl der Vorkommnisse des Schlüssel, bevor
	// der Inhalt eingefügt wird.
	// z.B. bedeutet <h2> => 2, dass der Inhalt vor der zweiten h2 eingefügt
	// werden würde.
	// Falls nicht genügend Vorkommnisse des Schlüssels gefunden wurden, werden
	// der Reihe nach die anderen Möglichkeiten versucht.
	$positions = array(
		'<h2>' => 2,
		'<h3>' => 2,
		'<p>' => 6
	);

	foreach ($positions as $delimiter => $position) {
		$splitContent = explode($delimiter, $content);
		if (count($splitContent) >= $position+1) {
			$splitContent[$position-1] .= $injectedContent;
			$content = implode($delimiter, $splitContent);
			break;
		}
	}

	return $content;
}
add_filter('the_content', 'kr_inject_content');

 /* =============================================================================
 13 - Werbung - Google Related Posts
============================================================================= */

function drweb_google_matched_posts() {
?>
<div class="matched-posts">    
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="autorelaxed"
     data-ad-client="ca-pub-1081357423874758"
     data-ad-slot="9081342000"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<?php }


 /* =============================================================================
 12 - Die Custom Loop für die Meta-Daten der Startseite - zusätzliche Anzeige des Autoren
============================================================================= */

	function dw_magazine_loop_meta() {

			echo '<p><span class="mh-meta-date updated"><i class="fa fa-clock-o"></i>' . get_the_date() . '</span>' . "\n";

			echo '<span class="mh-meta-author author vcard"><i class="fa fa-user"></i><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>' . "\n";

			echo '<span class="mh-meta-comments"><i class="fa fa-comment-o"></i>';
				mh_magazine_comment_count();
			echo '</span></p>' . "\n";
	}

/***** Comment Count Output *****/

	function mh_magazine_comment_count() {
		echo '<a class="mh-comment-count-link" href="' . esc_url(get_permalink() . '#mh-comments') . '">' . get_comments_number() . '</a>';
	}


/*  Theme setup - Einige Aenderungen zum Original
/* ------------------------------------ */

  function hu_setup() {
     // Load theme languages
    load_theme_textdomain( 'hueman', get_stylesheet_directory().'/languages' );

    // Enable header image
    // the header image is stored as a theme mod option
    // get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );
    // Backward compat : if a header-image was previously set by the user, then it becomes the default image, otherwise we fall back on the asset's default.
    $_old_header_image_val = hu_get_option('header-image');
    $did_user_set_an_image = false != $_old_header_image_val && ! empty($_old_header_image_val);
    $headers = apply_filters( 'hu_default_header_img' , array(
            'default-header' => array(
              'url'           => '%s/assets/front/img/header/default-header-280.jpg',
              'thumbnail_url' => '%s/assets/front/img/header/default-header-280.jpg',
              'description'   => 'Coffee'
            ),
            'yosemite' => array(
              'url'           => '%s/assets/front/img/header/yosemite-280.jpg',
              'thumbnail_url' => '%s/assets/front/img/header/yosemite-280.jpg',
              'description'   => 'Yosemite'
            ),
            'bridge' => array(
              'url'           => '%s/assets/front/img/header/bridge-280.jpg',
              'thumbnail_url' => '%s/assets/front/img/header/bridge-280.jpg',
              'description'   => 'Golden Gate Bridge'
            ),
            'nyc' => array(
              'url'           => '%s/assets/front/img/header/nyc-280.jpg',
              'thumbnail_url' => '%s/assets/front/img/header/nyc-280.jpg',
              'description'   => 'New York City'
            ),
            'california' => array(
              'url'           => '%s/assets/front/img/header/california-280.jpg',
              'thumbnail_url' => '%s/assets/front/img/header/california-280.jpg',
              'description'   => 'California'
            )
        )
    );
    register_default_headers( $headers );

    add_theme_support( 'custom-header', array(
        'default-image' => $did_user_set_an_image ? hu_get_img_src_from_option('header-image') : sprintf( '%1$s/assets/front/img/header/default-header-280.jpg' , get_template_directory_uri() ),
        'width'     => 1380,
        'height'    => 280,
        'flex-width' => true,
        'flex-height' => true,
        'header-text'  => false
    ) );

    // Enable Custom Logo
    add_theme_support( 'custom-logo', array(
        'width'     => 250,
        'height'    => 100,
        'flex-width' => true,
        'flex-height' => true,
    ) );

    // Enable title tag
    add_theme_support( 'title-tag' );
    // Enable automatic feed links
    // => Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Enable featured image
    add_theme_support( 'post-thumbnails' );
    //set_post_thumbnail_size( 1020, 480, true ); // default Post Thumbnail dimensions (cropped)

    // Declare WooCommerce support
    add_theme_support( 'woocommerce' );
    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Thumbnail sizes
    add_image_size( 'thumb-big', 1020, 480, true );
    add_image_size( 'thumb-medium', 520, 245, true );
    add_image_size( 'thumb-large', 720, 340, true );

    // Custom menu areas
    register_nav_menus( array(
      'topbar' => 'Topbar',
      'header' => 'Header',
      'footer' => 'Footer',
    ) );
  }
add_action( 'after_setup_theme', 'hu_setup' );

/* ------------------------------------------------------------------------- *
 *  Styles and scripts deaktivieren
/* ------------------------------------------------------------------------- */


/*  Enqueue javascript
/* ------------------------------------ */
//hook : wp_enqueue_scripts
  function hu_scripts() {

    wp_enqueue_script(
        'hu-front-scripts',
        sprintf('%1$s/assets/front/js/scripts%2$s.js' , get_template_directory_uri(), ( defined('WP_DEBUG') && true === WP_DEBUG ) ? '' : '.min' ),
        array( 'jquery', 'underscore' ),
        ( defined('WP_DEBUG') && true === WP_DEBUG ) ? time() : HUEMAN_VER,
        true
    );

    if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
      wp_enqueue_script( 'comment-reply' );
    }

    global $wp_registered_widgets;
    $_regwdgt = array();
    foreach ( $wp_registered_widgets as $_key => $_value) {
      $_regwdgt[] = $_key;
    }
    wp_localize_script(
          'hu-front-scripts',
          'HUParams',
          apply_filters( 'hu_customizr_script_params' , array(
              '_disabled'          => apply_filters( 'hu_disabled_front_js_parts', array() ),
              'SmoothScroll'      => array(
                'Enabled' => apply_filters('hu_enable_smoothscroll', ! wp_is_mobile() && hu_is_checked('smoothscroll') ),
                'Options' => apply_filters('hu_smoothscroll_options', array( 'touchpadSupport' => false ) )
              ),
              'centerAllImg'      => apply_filters( 'hu_center_img', true ),
              'timerOnScrollAllBrowsers' => apply_filters( 'hu_timer_on_scroll_for_all_browser' , true), //<= if false, for ie only
              'extLinksStyle'       => hu_is_checked('ext_link_style'),
              'extLinksTargetExt'   => hu_is_checked('ext_link_target'),
              'extLinksSkipSelectors'   => apply_filters(
                'hu_ext_links_skip_selectors',
                array(
                  'classes' => array('btn', 'button'),
                  'ids' => array()
                )
              ),
              'imgSmartLoadEnabled' => apply_filters( 'hu_img_smart_load_enabled', hu_is_checked('smart_load_img') ),
              'imgSmartLoadOpts'    => apply_filters( 'hu_img_smart_load_options' , array(
                    'parentSelectors' => array(
                        '.container .content',
                        '.container .sidebar',
                        '#footer',
                        '#header-widgets'
                    ),
                    'opts'     => array(
                        'excludeImg' => array( '.tc-holder-img' ),
                        'fadeIn_options' => 100
                    )
              )),
              'goldenRatio'         => apply_filters( 'hu_grid_golden_ratio' , 1.618 ),
              'gridGoldenRatioLimit' => apply_filters( 'hu_grid_golden_ratio_limit' , 350),
              'vivusSvgSpeed' => apply_filters( 'hu_vivus_svg_duration' , 300),
              'isDevMode' => ( defined('WP_DEBUG') && true === WP_DEBUG ) || ( defined('TC_DEV') && true === TC_DEV )
            )
        )//end of filter
       );

  }//function
add_action( 'wp_enqueue_scripts', 'hu_scripts' );

 /* =============================================================================
 ########  WOOCOMMERCE  #########################################################
============================================================================= */

/**
 * Remove WooCommerce Breadcrumbs
 * @author Andreas Hecht
 */
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'jk_remove_wc_breadcrumbs' );


/**
 * Zeigt die für den Shop wichtigen Links an.
 * @author Andreas Hecht
 */
function drweb_kundenlinks() {
?>
<div class="kundeninfos">
<p>
<a class="infolink" href="<?php echo home_url('/mein-konto/'); ?>"><i class="fa fa-user" aria-hidden="true"></i> Mein Konto</a> |
<a class="infolink" href="<?php echo home_url('/kundeninformation/'); ?>"><i class="fa fa-info" aria-hidden="true"></i> Kundeninformation</a>
</p>
</div>    
<?php }


/**
 * Remove WooCommerce Breadcrumbs
 */ 
remove_filter( 'woocommerce_product_thumbnails_columns', 'filter_woocommerce_product_thumbnails_columns', 10, 1 );

/*
 * wc_remove_related_products
 * 
 * Clear the query arguments for related products so none show.
 * Add this code to your theme functions.php file.  
 */
function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);
