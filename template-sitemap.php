<?php /* Template Name: Sitemap */ ?>
<?php get_header(); ?>

<section class="content">

	<div class="pad group">
 <article>
     <h1 class="title-page"><?php echo hu_get_page_title(); ?></h1>
	<div class="mh-row mh-sitemap clearfix">
		<div class="mh-col-1-3">
			<h5 class="mh-widget-title">
				<span class="mh-widget-title-inner">
					<?php esc_html_e('Neueste Artikel', 'mh-magazine'); ?>
				</span>
			</h5>
			<ul class="mh-sitemap-list"><?php
				$recent = new WP_query(array('posts_per_page' => 20));
				while ($recent->have_posts()) : $recent->the_post(); ?>
					<li class="sitemap-list-item">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</li><?php
				endwhile; wp_reset_postdata(); ?>
			</ul>
			<h5 class="mh-widget-title">
				<span class="mh-widget-title-inner">
					<?php esc_html_e('Seiten', 'mh-magazine'); ?>
				</span>
			</h5>
			<ul class="mh-sitemap-list"><?php
				wp_list_pages(array('title_li' => '', 'post_status' => 'publish')); ?>
			</ul>
		</div>
		<div class="mh-col-1-3">
			<h5 class="mh-widget-title">
				<span class="mh-widget-title-inner">
					<?php esc_html_e('Die Archive', 'mh-magazine'); ?>
				</span>
			</h5>
			<ul class="mh-sitemap-list">
				<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
			</ul>
		</div>
		<div class="mh-col-1-3">
			<h5 class="mh-widget-title">
				<span class="mh-widget-title-inner">
					<?php esc_html_e('Kategorien', 'mh-magazine'); ?>
				</span>
			</h5>
			<ul class="mh-sitemap-list"><?php
				wp_list_categories(array('title_li' => '', 'feed' => 'RSS', 'show_option_none' => esc_html__('No categories', 'mh-magazine'))); ?>
			</ul>
		</div>
	</div>
</article>
	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>