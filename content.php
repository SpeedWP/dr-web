<article id="post-<?php the_ID(); ?>" <?php post_class( array('group', 'grid-item') ); ?>>	
	<div class="post-inner post-hover">
		
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php if ( has_post_thumbnail() ): ?>
					<?php the_post_thumbnail('thumb-medium'); ?>
				<?php else : ?>
				 <?php echo '<img class="placeholder" src="' . get_stylesheet_directory_uri() . '/images/placeholder-small.jpg' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />'; ?>
				<?php endif; ?>
				<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-play"></i></span>'; ?>
				<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-volume-up"></i></span>'; ?>
				<?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i></span>'; ?>
			</a>
		</div><!--/.post-thumbnail-->
		
		<div class="mh-image-caption mh-posts-digest-caption">
        <?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
        </div>
		
		<div class="mh-meta group">
			<?php echo dw_magazine_loop_meta(); ?>
		</div><!--/.post-meta-->
		
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2><!--/.post-title-->
		
		<?php if (ot_get_option('excerpt-length') != '0'): ?>
		<div class="entry excerpt">				
			<?php // the_excerpt(); ?>
		</div><!--/.entry-->		
		<?php endif; ?>
		
	</div><!--/.post-inner-->	
</article><!--/.post-->	