<?php
?>
	<div class="post-format">
		<div class="image-container">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
                $caption = get_post(get_post_thumbnail_id())->post_excerpt;
				if ( isset($caption) && $caption ) echo '<p class="post-image-caption"><span class="fa fw fa-camera fa-1x"></span>'.$caption.'</p>';
} else {
    echo '<img class="placeholder" src="' . get_stylesheet_directory_uri() . '/images/placeholder-big.jpg' . '" alt="' . esc_html__('Kein Beitragsbild', 'mh-magazine') . '" />';
        } ?>
		</div>
	</div>