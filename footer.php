        </div><!--/.main-inner-->
      </div><!--/.main-->
    </div><!--/.container-inner-->
  </div><!--/.container-->
  <?php do_action('__before_footer') ; ?>
      <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<div id="breadcrumbs">','</div> ');
        } ?> 
<div id="footer-line">
    <div class="footer-line-inner"></div>
</div>
  
  <footer id="footer">
    <?php if ( hu_is_checked('footer-ads') ) : ?>
      <?php
        ob_start();
        hu_print_widgets_in_location( 'footer-ads' );
        $full_width_widget_html = ob_get_contents();
      ?>
      <?php if ( ! empty($full_width_widget_html) ) : ob_end_clean(); ?>
        <section class="container" id="footer-full-width-widget">
          <div class="container-inner">
            <?php hu_print_widgets_in_location( 'footer-ads' ); ?>
          </div><!--/.container-inner-->
        </section><!--/.container-->
      <?php endif; ?>
    <?php endif; ?>

    <?php // footer widgets
    $_footer_columns = 0;
    if ( 0 != intval( hu_get_option( 'footer-widgets' ) ) ) {
      $_footer_columns = intval( hu_get_option( 'footer-widgets' ) );
      if( $_footer_columns == 1) $class = 'one-full';
      if( $_footer_columns == 2) $class = 'one-half';
      if( $_footer_columns == 3) $class = 'one-third';
      if( $_footer_columns == 4) $class = 'one-fourth';
    }


    //when do we display the widget wrapper on front end ?
    // - there's at least a column
    // - the widget zone(s) in the column(s) have at least one widget ( => is_active_sidebar() )

    //when do we display the widget wrapper when customizing ?
    //- there's at least one column

    $_bool = false;
    if ( hu_is_customizing() ) {
      $_bool = $_footer_columns > 0;
    } else {
      $_bool = $_footer_columns > 0;
      $_one_widget_zone_active = false;

      for ( $i = 1; $i <= $_footer_columns; $i++ ) {
        if ( $_one_widget_zone_active )
          continue;
        if ( apply_filters( 'hu_is_active_footer_widget_zone', is_active_sidebar( "footer-{$i}" ), $i, $_footer_columns ) )
          $_one_widget_zone_active = true;
      }//for

      $_bool = $_bool && $_one_widget_zone_active;
    }

    if ( $_bool ) : ?>
        <section class="container" id="footer-widgets">
          <div class="container-inner">
            
            <div class="pad group">

              <?php for ($i = 1; $i <= $_footer_columns ;$i++ ) : ?>
                  <div class="footer-widget-<?php echo $i; ?> grid <?php echo $class; ?> <?php if ( $i == $_footer_columns ) { echo 'last'; } ?>">
                    <?php hu_print_widgets_in_location( 'footer-' . $i ); ?>
                  </div>
              <?php endfor; ?>

            </div><!--/.pad-->

          </div><!--/.container-inner-->
        </section><!--/.container-->

    <?php endif; //$_bool ?>

      <?php if ( hu_has_nav_menu( 'footer' ) ): ?>
      <nav class="nav-container group" id="nav-footer">
        <div class="nav-toggle"><i class="fa fa-bars"></i></div>
        <div class="nav-text"><!-- put your mobile menu text here --></div>
        <div class="nav-wrap"><?php wp_nav_menu( array('theme_location'=>'footer','menu_class'=>'nav container group','container'=>'','menu_id'=>'','fallback_cb'=> 'hu_page_menu' ) ); ?></div>
      </nav><!--/#nav-footer-->
    <?php endif; ?>


    <section class="container" id="footer-bottom">
      <div class="container-inner">

        <div class="pad group">

          <div class="grid one-half">
            <?php $_footer_logo_img_src = apply_filters( 'hu_footer_logo_src', hu_get_img_src_from_option('footer-logo') ); ?>
            <?php if ( false !== $_footer_logo_img_src && ! empty($_footer_logo_img_src) ) : ?>
              <img id="footer-logo" src="<?php echo $_footer_logo_img_src; ?>" alt="<?php get_bloginfo('name'); ?>">
            <?php endif; ?>

            <div id="copyright">
             <p><?php echo dw_dynamic_copyright(); ?> - drweb.de, gegründet von Sven Lennartz.</p>
            </div><!--/#copyright-->

          </div>

          <div class="grid one-half last">
            <p><a href="//www.noupe.com" target="_blank" class="footer-text__noupe">dr. web <i class="fa fa-heart" aria-hidden="true"></i> noupe</a></p>
          </div>

        </div><!--/.pad-->

      </div><!--/.container-inner-->
    </section><!--/.container-->

  </footer><!--/#footer-->

</div><!--/#wrapper-->

<?php wp_footer(); ?>
<link href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo get_home_url(); ?>/wp-content/themes/drweb/css/print.css" rel="stylesheet" media="print" />
<!-- Dr. Web AD - Scripts -->
<div id="content-sponsors" data-ad-zone-id="119" data-ad-group="content-sponsors" data-ad-list="3" data-ad-mixin-zone-id="120" data-ad-mixin-list="1" data-ad-fetchonly="true"></div>
<div id="layerad_all" data-ad-zone-id="118"><!-- Layer ad zone on all pages --></div>
<?php
// Show layer ad only if article is older than 10 days.
if (is_single()) {
	$date = new DateTime($post->post_date);
	$limit = new DateTime();
	$limit->modify('-10 days');
	if ($date < $limit) {
		?>
	<div id="layerad" data-ad-zone-id="83"><!-- Layer ad zone on older articles --></div>
<?php } } ?>

<!-- Place as early in the document as possible, but not before the last ad target. -->
<script type='text/javascript'>/* <![CDATA[ */  AdsController.load();   /* ]]> */</script>
<script type='text/javascript'>/* <![CDATA[ */  AdsController.postLoad();   /* ]]> */</script>
<script type='text/javascript'>/* <![CDATA[ */  AdsController.postPostLoad();   /* ]]> */</script>

</body>
</html>
