<?php get_header(); ?>

<section class="content">

	<?php // hu_get_template_part('parts/page-title'); ?>

	<div class="pad group">

		<?php while ( have_posts() ): the_post(); ?>

			<article <?php post_class('group'); ?>>
                
            <?php if ( is_page() ): ?>
		    <h1 class="title-page"><?php echo hu_get_page_title(); ?></h1>
	        <?php elseif ( is_search() ): ?>
		    <h1><?php echo hu_get_search_title(); ?></h1>
            <?php endif; ?>

				<?php hu_get_template_part('parts/page-image'); ?>

				<div class="entry themeform">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div><!--/.entry-->

			</article>

			<?php if ( hu_is_checked('page-comments') ) { comments_template('/comments.php',true); } ?>

		<?php endwhile; ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>