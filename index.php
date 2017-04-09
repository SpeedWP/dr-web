<?php get_header(); ?>

<section class="content">
  <?php if ( ! hu_is_home_empty() ) : ?>
       <?php if( is_home() ) : ?>
       <?php else : ?>
    	<?php hu_get_template_part('parts/page-title'); ?>
        <?php endif; ?>
        
    	<div class="pad group">

    		<?php if ( hu_is_checked('featured-posts-enabled') ) { get_template_part('parts/featured'); } ?>

           <?php if ( is_active_sidebar( 'adeins' ) ) : // Werbung ?>
		    <?php dynamic_sidebar( 'adeins' ); ?>
            <?php endif; ?>
            
            <?php if( is_home() and !is_paged() ) : ?>
		    <?php dynamic_sidebar( 'advier' ); // Grosses Newsletter Formular ?>
            <?php endif; ?>
            
      			
      			<div id="grid-wrapper" class="post-list group">
      				<?php 
                    global $wp_query; 
                    echo '<div class="post-row">'; 
                    $query = new WP_Query( array( 'post__not_in' => get_option( 'sticky_posts' ) ) );
                    ?>
                    
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php get_template_part('content'); ?>
              <?php if( ( $wp_query->current_post + 1 ) % 2 == 0 ) { echo '</div><div class="post-row">'; }; endwhile; echo '</div>'; ?>
      			</div><!--/.post-list-->
      			<?php endif; ?>
      			
      		     <?php if ( is_active_sidebar( 'adpage' ) ) : // Werbung oberhalb Pagination ?>
		        <?php dynamic_sidebar( 'adpage' ); ?>
                <?php endif; ?>
            
      			<?php get_template_part('parts/pagination'); ?>

    	</div><!--/.pad-->
  <?php endif; ?>
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>