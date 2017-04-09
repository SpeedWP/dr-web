<?php get_header(); ?>

<section class="content">

	<?php get_template_part('parts/page-title'); ?>

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>
			<article <?php post_class(); ?>>
				<div class="post-inner group">
                <div class="post-title-main-inner">
					<h1 class="post-title entry-title"><?php the_title(); ?></h1>
        <div class="mash-top">
         <?php echo do_shortcode('[shariff]'); ?>
         </div>
          <?php get_template_part('parts/single-author-date'); ?>
          
            <?php if ( is_active_sidebar( 'addrei' ) ) : ?>
		    <?php dynamic_sidebar( 'addrei' ); ?>
            <?php endif; ?>
          
         <?php if(!get_post_format()) {
               get_template_part('parts/post-standard');
          } else {
               get_template_part('parts/post-formats');
          } ?>
					</div><!-- end .post-title-main-inner -->

					<div class="clear"></div>

					<div class="<?php echo implode( ' ', apply_filters( 'hu_single_entry_class', array('entry','themeform') ) ) ?>">
						<div class="entry-inner">
							<?php the_content(); ?>
							<?php
                                if (function_exists('tb_print_comment')) {
                                    tb_print_comment(); }
                            ?>
							<div class="mashshare-bottom">
							<?php echo do_shortcode('[shariff]'); ?>
                            </div>
                            <?php echo drweb_author_bio_box(); ?>
                            <?php
                                    if (function_exists('drweb_google_matched_posts')) {
                                            drweb_google_matched_posts(); }
                            ?>
							<nav class="pagination group">
                <?php
                  //Checks for and uses wp_pagenavi to display page navigation for multi-page posts.
                  if ( function_exists('wp_pagenavi') )
                    wp_pagenavi( array( 'type' => 'multipart' ) );
                  else
                    wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','hueman'),'after'=>'</div>'));
                ?>
              </nav><!--/.pagination-->
						</div>

            <?php do_action( 'hu_after_single_entry_inner' ); ?>

						<div class="clear"></div>
					</div><!--/.entry-->

				</div><!--/.post-inner-->
			</article><!--/.post-->
		<?php endwhile; ?>

		<div class="clear"></div>
        <div class="post-title-main-inner">
		<?php the_tags('<p class="post-tags"><span>'.__('Tags:','hueman').'</span> ','','</p>'); ?>		

		<?php if ( 'content' == hu_get_option( 'post-nav' ) ) { get_template_part('parts/post-nav'); } ?>

		<?php if ( '1' != hu_get_option( 'related-posts' ) ) { get_template_part('parts/related-posts'); } ?>

		<?php if ( hu_is_checked('post-comments') ) { comments_template('/comments.php',true); } ?>

	</div><!--/.pad-->
    </div><!-- end .post-title-main-inner -->
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>