<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="dns-prefetch" href="//fonts.googleapis.com" />
<link rel="preconnect" href="//fonts.googleapis.com" />
<link href="https://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" />
<link rel="dns-prefetch" href="//opensource.keycdn.com" />
<link rel="preconnect" href="//opensource.keycdn.com" />
<link rel="dns-prefetch" href="//www.google-analytics.com" />
<link rel="preconnect" href="//www.google-analytics.com" />
<link rel="dns-prefetch" href="//www.googletagservices.com" />
<link rel="preconnect" href="//www.googletagservices.com" />
<link rel="dns-prefetch" href="//adserver.idg.de" />
<link rel="preconnect" href="//adserver.idg.de" />
<link rel="dns-prefetch" href="//www.googletagmanager.com" />
<link rel="preconnect" href="//www.googletagmanager.com" />
<link rel="dns-prefetch" href="//ajax.googleapis.com" />
<link rel="preconnect" href="//ajax.googleapis.com" />
<link rel="dns-prefetch" href="//a.optnmnstr.com" />
<link rel="preconnect" href="//a.optnmnstr.com" />
<link rel="dns-prefetch" href="//pagead2.googlesyndication.com" />
<link rel="preconnect" href="//pagead2.googlesyndication.com" />
<link rel="dns-prefetch" href="//tpc.googlesyndication.com" />
<link rel="preconnect" href="//tpc.googlesyndication.com" />
<link rel="dns-prefetch" href="//static.getclicky.com" />
<link rel="preconnect" href="//static.getclicky.com" />
<link rel="dns-prefetch" href="//auslieferung.commindo-media-ressourcen.de" />
<link rel="preconnect" href="//auslieferung.commindo-media-ressourcen.de" />
<meta name="google-site-verification" content="yQq-bnslN-qaNyEoyGLKyGcghHoDMK3yJYyaLvBItu0" />
<?php wp_head(); ?>
<?php if (is_home()) { // IDG Bannercode ?>
<!--Start TN Site Variablen-->
<script type="text/javascript">
	//GPT-JavaScript-Bibliothek
	(function() {
	var useSSL = 'https:' == document.location.protocol;
	var src = (useSSL ? 'https:' : 'http:') +
	'//www.googletagservices.com/tag/js/gpt.js';
	document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
	})();
	//Site-Variablen
	var idgStorage = new Object();
	idgStorage.adUnit1 = "/8456/IDG.DE_NET_Drweb.de";  //statisch alle Seiten
	idgStorage.sec = "home";  //dynamisch home=homepage article=Rest der Seite
	idgStorage.rs_tax = "no_tax";  //statisch alle seiten, wird mit Meta Tag Keywords befuellt,falls vorhanden
</script>
<!--Ende TN Site Variablen-->
	<!--Start TN Global Script-->
	<script src="//adserver.idg.de/gptjs/tn/tn_dogpt_sync.js" type="text/javascript"></script>
	<!--Ende TN Global Script-->
	<?php } else { ?>
	<!--Start TN Site Variablen-->
	<script type="text/javascript">
	//GPT-JavaScript-Bibliothek
	(function() {
	var useSSL = 'https:' == document.location.protocol;
	var src = (useSSL ? 'https:' : 'http:') +
	'//www.googletagservices.com/tag/js/gpt.js';
	document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
	})();
	//Site-Variablen
	var idgStorage = new Object();
	idgStorage.adUnit1 = "/8456/IDG.DE_NET_Drweb.de";  //statisch alle Seiten
	idgStorage.sec = "article";  //dynamisch home=homepage article=Rest der Seite
	idgStorage.rs_tax = "no_tax";  //statisch alle seiten, wird mit Meta Tag Keywords befuellt,falls vorhanden
</script>
<!--Ende TN Site Variablen-->
<!--Start TN Global Script-->
<script src="//adserver.idg.de/gptjs/tn/tn_dogpt_sync.js" type="text/javascript"></script>
<!--Ende TN Global Script-->
<?php } ?>
</head>
<body <?php body_class(); ?>>

<div id="ad_leaderboard" class="ad leaderboard" data-ad-zone-id="73" data-ad-visibility="(min-width: 1100px)"></div>

<div id="wrapper">

  <header id="header">
    <?php if ( has_nav_menu('topbar') ): ?>
      <nav class="nav-container group" id="nav-topbar">
        <div class="nav-toggle"><i class="fa fa-bars"></i></div>
        <div class="nav-text"><!-- put your mobile menu text here --></div>
        <div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>

        <div class="container">
          <div class="container-inner">
            <div class="toggle-search"><i class="fa fa-search"></i></div>
            <div class="search-expand">
              <div class="search-expand-inner">
                <?php get_search_form(); ?>
              </div>
            </div>
          </div><!--/.container-inner-->
        </div><!--/.container-->

      </nav><!--/#nav-topbar-->
    <?php endif; ?>

    <div class="container group">
      <div class="container-inner">
        <?php $_header_img_src = hu_get_img_src_from_option('header-image'); ?>
        <?php if ( ! $_header_img_src || empty( $_header_img_src ) ): //@fromfull to keep ?>

          <div class="group pad">
    
            <?php if ( is_active_sidebar( 'hdwd' ) ) : ?>
            <div class="zilla-one-third eins">
            <?php dynamic_sidebar( 'hdwd' ); ?>
            </div><!-- .zilla-one-third -->
            <?php endif; ?>
            
            <div class="zilla-one-third logo">
            <?php echo hu_site_title(); ?>
            <?php if ( hu_is_checked('site-description') ): ?><p class="site-description"><?php bloginfo( 'description' ); ?></p><?php endif; ?>
              </div><!-- .zilla-one-third -->
            
            <?php if ( hu_is_checked('header-ads') ): ?>
             <div class="zilla-one-third drei zilla-column-last">
              
                <?php hu_print_widgets_in_location( 'header-ads' ); ?>
            
              </div><!-- .zilla-one-third .zilla-column-last -->
            <?php endif; ?>

          </div>

        <?php else :  ?>

            <a href="<?php echo home_url('/'); ?>" rel="home">
              <img class="site-image" src="<?php echo hu_get_img_src_from_option('header-image'); ?>" alt="<?php echo get_bloginfo('name'); ?>">
            </a>

        <?php endif; ?>

        <?php if ( has_nav_menu('header') ): ?>
          <nav class="nav-container group" id="nav-header">
            <div class="nav-toggle"><i class="fa fa-bars"></i></div>
            <div class="nav-text">Menü</div>
            <div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'header','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
            <!-- Submenu Werbeblock -->
            <div id="ad_submenu" data-ad-zone-id="112" data-ad-visibility="(min-width: 870px)"></div>
          </nav><!--/#nav-header-->
        <?php endif; ?>

      </div><!--/.container-inner-->
    </div><!--/.container-->
  </header><!--/#header-->
  
  <!-- Billboard Werbung -->
<div id="billboard" data-ad-zone-id="84" data-ad-visibility="(min-width: 1100px)"></div>
<!-- Skyscraper -->
<div id="ad_skyscraper" class="ad skyscraper" data-ad-zone-id="55" data-ad-visibility="(min-width: 1100px)"></div>
 
  <?php do_action('__after_header') ; ?>
  <div class="container" id="page">
    <div class="container-inner">
     
      <div class="main">
       
       <?php if ( is_post_type_archive( 'product' ) ) : ?> 
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <div class="shop-wrap">
            <h1 class="shop-title"><?php woocommerce_page_title(); ?></h1>  <?php if (function_exists('drweb_kundenlinks') ) { echo drweb_kundenlinks(); } ?>
            </div><!-- /.shop-wrap -->
		<?php endif; ?>
        <?php endif; ?> 

        <div class="main-inner group">
