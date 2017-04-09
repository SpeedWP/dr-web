<?php get_header(); ?>

<section class="content">

	<?php // hu_get_template_part('parts/page-title'); ?>

	<div class="pad group error">
        <h1><?php echo hu_get_404_title(); ?></h1>
		<div class="box-grey">
			<?php get_search_form(); ?>
		</div>

		<div class="entry">
            <center><p><?php _e( 'The page you are trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'hueman' ); ?></p></center>
			<center><p><a class="green-button" href="<?php echo get_home_url(); ?>/sitemap/" title="Versuche doch unsere Sitemap"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Vielleicht könnte Dir unsere Sitemap hilfreich sein?</a> &nbsp;&nbsp;
			
                <a class="blue-button" href="<?php echo get_home_url(); ?>/tag/" title="Versuche doch unser Schlagwort-Register"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Versuche doch unser Schlagwort-Register</a></p></center>
		</div>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>