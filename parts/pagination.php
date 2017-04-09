<nav class="pagination group">
	<?php if ( function_exists('wp_pagenavi') ): ?>
		<?php wp_pagenavi(); ?>
	<?php else: ?>
<?php the_posts_pagination( array(
                                    'type' => 'list',
                                    'mid_size' => 2,
                                    'prev_text' => '&laquo; Zurück',
                                    'next_text' => 'Vorwärts &raquo;',
                                    )  ); ?>
	<?php endif; ?>
</nav><!--/.pagination-->
